<?php
/**
 * Created by PhpStorm.
 * User: Mix
 * Date: 05.06.2018
 * Time: 10:31
 */

namespace common\components;

use yii\base\InvalidConfigException;
use common\models\Search as SearchModel;

class Search extends \yii\base\Component
{
    public $models;

    /**
     * Search constructor.
     */
    public function init()
    {
        parent::init();

        if (!isset($this->models) || !is_array($this->models)) {
            return new InvalidConfigException('models must be defined and must be array');
        }

        foreach ($this->models as &$model) {
            if (!isset($model['fields'])) {
                return new InvalidConfigException('fields in models must be defined and must be array');
            }
            if (is_array($model['fields'])) {
                $model['fields'] = implode(', ', $model['fields']);
            }
        }
    }

    public function find($query)
    {
        $result = [
            'query' => $this->cleanQuery($query),
        ];
        $query = $this->processQuery($query);
        $results = array();
        foreach ($this->models as $model => $fields) {
            $results = array_merge($results, SearchModel::find($query, $model, $fields['fields']));
        }
        $result['results'] = $results;
        return $result;
    }

    /**
     * @param $query
     * @return string
     */
    private function processQuery($query)
    {
        $result = '';
        $query = $this->cleanQuery($query);
        $tokens = explode(' ', $query);
        foreach ($tokens as &$token) {
            $result .= '*' . $token . '*';
        }
        return $result;
    }

    private function cleanQuery($query)
    {
        return trim(preg_replace('/[^а-яёa-z\d\s]/ui', ' ', $query));
    }
}