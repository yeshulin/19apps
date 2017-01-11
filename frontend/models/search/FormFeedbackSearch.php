<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FormFeedback;

/**
 * FormFeedbackSearch represents the model behind the search form about `frontend\models\FormFeedback`.
 */
class FormFeedbackSearch extends FormFeedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'created_at','updated_at'], 'integer'],
            [['username', 'ip', 'leibie', 'goods_name', 'yjleibie', 'content', 'status'], 'safe'],
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
        $query = FormFeedback::find();

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
            'userid' => $this->userid,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'leibie', $this->leibie])
            ->andFilterWhere(['like', 'goods_name', $this->goods_name])
            ->andFilterWhere(['like', 'yjleibie', $this->yjleibie])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
