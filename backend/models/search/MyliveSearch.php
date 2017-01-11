<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mylive;

/**
 * MyliveSearch represents the model behind the search form about `backend\models\Mylive`.
 */
class MyliveSearch extends Mylive
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['live_id', 'userid', 'roomid', 'created_at', 'updated_at', 'status'], 'integer'],
            [['live_name', 'tongdao', 'qiehuan', 'liuliang'], 'safe'],
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
        $query = Mylive::find();

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
            'live_id' => $this->live_id,
            'userid' => $this->userid,
            'roomid' => $this->roomid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'live_name', $this->live_name])
            ->andFilterWhere(['like', 'tongdao', $this->tongdao])
            ->andFilterWhere(['like', 'qiehuan', $this->qiehuan])
            ->andFilterWhere(['like', 'liuliang', $this->liuliang]);

        return $dataProvider;
    }
}
