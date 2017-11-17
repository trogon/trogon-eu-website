<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Page;

/**
 * PageSearch represents the model behind the search form about `common\models\Page`.
 */
class PageSearch extends Page
{
    /**
     * @inheritdoc
     */
	public function attributes()
	{
		// add related fields to searchable attributes
		return array_merge(parent::attributes(), [
			'user.fullname',
		]);
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['title', 'alias', 'content'], 'safe'],
			[['user.fullname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Page::find()
			->joinWith('user', false);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$dataProvider->sort->attributes['user.fullname'] = [
			'asc' => ['{{%user}}.lastname' => SORT_ASC, '{{%user}}.firstname' => SORT_ASC],
			'desc' => ['{{%user}}.lastname' => SORT_DESC, '{{%user}}.firstname' => SORT_DESC],
		];

		$dataProvider->sort->defaultOrder = [
			'title' => SORT_ASC,
		];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'content', $this->content]);

        $query->andFilterWhere(['or', 
				['like', '{{%user}}.lastname', $this->getAttribute('user.fullname')],
				['like', '{{%user}}.firstname', $this->getAttribute('user.fullname')],
			]);

        return $dataProvider;
    }
}
