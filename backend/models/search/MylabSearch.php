<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mylab;

/**
 * MylabSearch represents the model behind the search form about `backend\models\Mylab`.
 */
class MylabSearch extends Mylab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_id', 'totals', 'userid', 'created_at', 'updated_at', 'status'], 'integer'],
            [['lab_name', 'lab_code'], 'safe'],
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
        $query = Mylab::find();
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
            'lab_id' => $this->lab_id,
            'totals' => $this->totals,
            'userid' => $this->userid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'lab_name', $this->lab_name])
            ->andFilterWhere(['like', 'lab_code', $this->lab_code]);

        return $dataProvider;
    }
}
