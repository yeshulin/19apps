<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Sms;

/**
 * SmsSearch represents the model behind the search form about `frontend\models\Sms`.
 */
class SmsSearch extends Sms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'posttime', 'send_userid', 'status'], 'integer'],
            [['mobile', 'id_code', 'msg', 'return_id', 'ip'], 'safe'],
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
        $query = Sms::find();

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
            'posttime' => $this->posttime,
            'send_userid' => $this->send_userid,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'id_code', $this->id_code])
            ->andFilterWhere(['like', 'msg', $this->msg])
            ->andFilterWhere(['like', 'return_id', $this->return_id])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
