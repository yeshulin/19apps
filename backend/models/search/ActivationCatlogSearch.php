<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ActivationCatlog;

/**
 * ActivationCatlogSearch represents the model behind the search form about `backend\models\ActivationCatlog`.
 */
class ActivationCatlogSearch extends ActivationCatlog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['cat_name'], 'safe'],
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
        $query = ActivationCatlog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'cat_name', $this->cat_name]);

        return $dataProvider;
    }
}
