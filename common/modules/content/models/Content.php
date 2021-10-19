<?php

namespace common\modules\content\models;

use mix8872\filesAttacher\behaviors\FileAttachBehavior;
use Yii;

/**
 * This is the model class for table "content".
 *
 * @property int $id [int(11)]
 * @property string $code [varchar(255)]
 * @property string $type [varchar(255)]
 * @property string $title [varchar(255)]
 * @property string $title_en [varchar(255)]
 * @property bool $as_slider [tinyint(1)]
 * @property string $summary
 * @property string $summary_en
 * @property string $content
 * @property string $content_en
 * @property string $tags [varchar(255)]
 * @property string $seo_title [varchar(255)]
 * @property string $seo_description
 * @property string $seo_keywords [varchar(255)]
 * @property int $status [int(1)]
 * @property int $order [int(11)]
 * @property string $template [varchar(255)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 */

class Content extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 1;
    public const TYPE_PAGE = 0;
    public const TYPE_TEXT = 1;

    public $types = [
        self::TYPE_PAGE => 'Страница',
        self::TYPE_TEXT => 'Текстовая область',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => FileAttachBehavior::class,
                'tags' => ['images'],
                'deleteOld' => []
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['status'], 'integer'],
            [['full'], 'boolean'],
            [['code', 'sideTitle', 'sideText', 'sideUrl', 'sideBtn', 'template'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Код'),
            'status' => Yii::t('app', 'Активно'),
            'title' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Текст'),
            'images' => Yii::t('app', 'Изображения'),
            'full' => Yii::t('app', 'На всю ширину'),
            'sideTitle' => Yii::t('app', 'Боковой блок - заголовок'),
            'sideText' => Yii::t('app', 'Боковой блок - текст'),
            'sideUrl' => Yii::t('app', 'Боковой блок - ссылка'),
            'sideBtn' => Yii::t('app', 'Боковой блок - кнопка'),
            'template' => Yii::t('app', 'Шаблон'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(ContentContent::class, ['contentId' => 'id'])->andWhere(['lang' => Yii::$app->language]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(ContentContent::class, ['contentId' => 'id']);
    }
}
