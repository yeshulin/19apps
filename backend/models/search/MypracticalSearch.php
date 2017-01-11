<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mypractical;

/**
 * MypracticalSearch represents the model behind the search form about `backend\models\Mypractical`.
 */
class MypracticalSearch extends Mypractical
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['practical_id', 'totals', 'userid', 'created_at', 'updated_at', 'status'], 'integer'],
            [['practical_name', 'practical_code'], 'safe'],
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
        $query = Mypractical::find();

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
            'practical_id' => $this->practical_id,
            'totals' => $this->totals,
            'userid' => $this->userid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'practical_name', $this->practical_name])
            ->andFilterWhere(['like', 'practical_code', $this->practical_code]);

        return $dataProvider;
    }
}
