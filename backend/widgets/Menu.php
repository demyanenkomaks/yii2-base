<?php
namespace backend\widgets;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * Class Menu
 * Theme menu widget.
 */
class Menu extends \yii\widgets\Menu
{
    /**
     * @inheritdoc
     */
    public $linkTemplate = '<a href="{url}"{attr}>{icon} {label}</a>';
    /**
     * @inheritdoc
     * Styles all labels of items on sidebar by AdminLTE
     */
    public $labelTemplate = '<span>{label}</span>';
    public $submenuTemplate = "\n<ul class='submenu' {show}>\n{items}\n</ul>\n";
    public $activateParents = true;
    public $defaultIconHtml = '<i class="ti-pin-alt"></i> ';
    public $options = ['id' => 'sidebar-menu', 'tag' => 'div'];
    public $isParentCssClass = 'has_sub';

    /**
     * @var string is prefix that will be added to $item['icon'] if it exist.
     * By default uses for Font Awesome (http://fontawesome.io/)
     */

    private $noDefaultAction;
    private $noDefaultRoute;

    /**
     * Renders the menu.
     */
    public function run()
    {
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        $posDefaultAction = strpos($this->route, Yii::$app->controller->defaultAction);
        if ($posDefaultAction) {
            $this->noDefaultAction = rtrim(substr($this->route, 0, $posDefaultAction), '/');
        } else {
            $this->noDefaultAction = false;
        }
        $posDefaultRoute = strpos($this->route, Yii::$app->controller->module->defaultRoute);
        if ($posDefaultRoute) {
            $this->noDefaultRoute = rtrim(substr($this->route, 0, $posDefaultRoute), '/');
        } else {
            $this->noDefaultRoute = false;
        }
        $items = $this->normalizeItems($this->items, $hasActiveChild);
        if (!empty($items)) {
            $options = $this->options;

            if ($this->options['tag']) {
                $ul = Html::tag('ul', $this->renderItems($items));
                echo Html::tag($this->options['tag'], $ul, $options);
            } else {
                echo Html::tag('ul', $this->renderItems($items), $options);
            }
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        if (isset($item['items'])) {
            $labelTemplate = '<a href="{url}">{icon} {label} <div class="arrow-down"></div></a>';
            $linkTemplate = '<a href="{url}">{icon} {label} <div class="arrow-down"></div></a>';
        } else {
            $labelTemplate = $this->labelTemplate;
            $linkTemplate = $this->linkTemplate;
        }

        $replacements = [
            '{label}' => strtr($this->labelTemplate, ['{label}' => $item['label']]),
            '{icon}' => empty($item['icon']) ? $this->defaultIconHtml
                : '<i class="' . $item['icon'] . '"></i> ',
            '{url}' => isset($item['url']) ? Url::to($item['url']) : 'javascript:void(0);',
            '{attr}' => Html::renderTagAttributes(ArrayHelper::getValue($item, 'linkOptions', [])),
        ];

        $template = ArrayHelper::getValue($item, 'template', isset($item['url']) ? $linkTemplate : $labelTemplate);

        return strtr($template, $replacements);
    }

    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     */
    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                Html::addCssClass($options, $this->activeCssClass);
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                Html::addCssClass($options, $this->firstItemCssClass);
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                Html::addCssClass($options, $this->lastItemCssClass);
            }
            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $menu .= strtr($this->submenuTemplate, [
                    '{show}' => $item['active'] ? "style='display: block'" : '',
                    '{items}' => $this->renderItems($item['items']),
                ]);
                Html::addCssClass($options, $this->isParentCssClass);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }
        return implode("\n", $lines);
    }

    /**
     * @inheritdoc
     */
    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $items[$i]['icon'] = isset($item['icon']) ? $item['icon'] : '';
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
        }
        return array_values($items);
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
            }
            $route = ltrim($route, '/');
            if ($route != $this->route && $route !== $this->noDefaultRoute && $route !== $this->noDefaultAction) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }
}
