<?php

namespace common\modules\content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\content\models\Content;

/**
 * TextBlockSearch represents the model behind the search form of `common\modules\content\models\TextBlock`.
 */
class ContentSearch extends Content
{
    public $contentId;
    public $title;
    public $description;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['code', 'title', 'description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Content::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->_pageSize ?? '10',
            ]
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'code',
                'status',
                'title' => [
                    'asc' => ['title' => SORT_ASC],
                    'desc' => ['title' => SORT_DESC],
                    'label' => 'Title',
                    'default' => SORT_ASC
                ],
                'description' => [
                    'asc' => ['description' => SORT_ASC],
                    'desc' => ['description' => SORT_DESC],
                    'label' => 'Description',
                    'default' => SORT_ASC
                ],
            ],
            //'defaultOrder' => ['title' => SORT_ASC] // TODO: change default order
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status
        ]);
        $query->andFilterWhere(['like', 'code', $this->code]);
        if (!empty($this->title)) {
            $query->andFilterWhere(['like', 'title', $this->title]);
        }
        if (!empty($this->description)) {
            $query->andFilterWhere(['like', 'description', $this->description]);
        }

        return $dataProvider;
    }
}
