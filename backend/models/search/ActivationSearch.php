<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Activation;

/**
 * ActivationSearch represents the model behind the search form about `backend\models\Activation`.
 */
class ActivationSearch extends Activation
{
    public $make_time_start;
    public $make_time_end;
    public $end_time_start;
    public $end_time_end;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activid', 'type', 'status', 'userid', 'm_userid', 'start_time', 'product_id', 'videoplay_id', 'm_type'], 'integer'],
            [['activ_code', 'lot_number', 'username', 'm_username','end_time','make_time'], 'safe'],

            [['end_time_start','end_time_end','make_time_start','make_time_end'],'safe']
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
        $query = Activation::find();

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
        $end_time_start=strtotime($this->end_time_start);
        $end_time_end=strtotime($this->end_time_end);
        $make_time_start=strtotime($this->make_time_start);
        $make_time_end=strtotime($this->make_time_end);
        // grid filtering conditions
        $query->andFilterWhere([
            'activid' => $this->activid,
            'type' => $this->type,
//            'make_time' => $this->make_time,
            'status' => $this->status,
            'userid' => $this->userid,
            'm_userid' => $this->m_userid,
            'start_time' => $this->start_time,
//            'end_time' => $this->end_time,
            'product_id' => $this->product_id,
            'videoplay_id' => $this->videoplay_id,
            'm_type' => $this->m_type,
        ]);

        $query->andFilterWhere(['like', 'activ_code', $this->activ_code])
            ->andFilterWhere(['like', 'lot_number', $this->lot_number])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['>=', 'end_time', $end_time_start])
            ->andFilterWhere(['>=', 'make_time', $make_time_start])
            ->andFilterWhere(['like', 'm_username', $this->m_username]);
        if($end_time_end){
            $query->andFilterWhere(['<=', 'end_time', $end_time_end]);
        }
        if($make_time_end){
            $query->andFilterWhere(['<=', 'make_time', $make_time_end]);
        }

        return $dataProvider;
    }
}
