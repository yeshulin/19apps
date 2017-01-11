<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Practical;

/**
 * PracticalSearch represents the model behind the search form about `backend\models\Practical`.
 */
class PracticalSearch extends Practical
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['practicalid', /*'order',*/ 'status',/* 'create_at', 'update_at'*/], 'integer'],
            [['practical_name', /*'brief',*/ 'link'], 'safe'],
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
        $query = Practical::find();

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
            'practicalid' => $this->practicalid,
            'type' => $this->type,
            'order' => $this->order,
            'status' => $this->status,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'practical_name', $this->practical_name])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
