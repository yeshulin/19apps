<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Lab;

/**
 * LabSearch represents the model behind the search form about `backend\models\Lab`.
 */
class LabSearch extends Lab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['labid', /*'order',*/ 'status',/* 'create_at', 'update_at'*/], 'integer'],
            [['lab_name', /*'brief',*/ 'link'], 'safe'],
            [['type'], 'string'],
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
        $query = Lab::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->status = self::STATUS_DEFAULT;

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'labid' => $this->labid,
            'type' => $this->type,
            'order' => $this->order,
            'status' => $this->status,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'lab_name', $this->lab_name])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
