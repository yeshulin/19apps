<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Live;

/**
 * LiveSearch represents the model behind the search form about `backend\models\Live`.
 */
class LiveSearch extends Live
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['liveid',/* 'order',*/ 'status',/* 'create_at', 'update_at'*/], 'integer'],
            [['live_name'/*, 'brief', 'thumb', 'overview', 'flow', 'scene'*/], 'safe'],
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
        $query = Live::find();

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
            'liveid' => $this->liveid,
            'order' => $this->order,
            'status' => $this->status,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'live_name', $this->live_name])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'thumb', $this->thumb])
            ->andFilterWhere(['like', 'overview', $this->overview])
            ->andFilterWhere(['like', 'flow', $this->flow])
            ->andFilterWhere(['like', 'scene', $this->scene]);

        return $dataProvider;
    }
}
