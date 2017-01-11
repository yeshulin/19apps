<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Organ;

/**
 * OrganSearch represents the model behind the search form about `frontend\models\Organ`.
 */
class OrganSearch extends Organ
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'mobile', 'created_at', 'status', 'updated_at', 'usertype'], 'integer'],
            [[ 'name', 'email', 'phoneman', 'detail', 'organbook_img', 'info','card_num'], 'safe'],
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
        $query = Organ::find();

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
            'mobile' => $this->mobile,
//            'created_at' => $this->created_at,
            'status' => $this->status,
//            'updated_at' => $this->updated_at,
            'usertype' => $this->usertype,
        ]);

            $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phoneman', $this->phoneman])
            ->andFilterWhere(['like', 'detail', $this->detail])
//            ->andFilterWhere(['like', 'organbook_img', $this->organbook_img])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'card_num', $this->card_num]);

        return $dataProvider;
    }
}
