<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FormCollection;

/**
 * FormCollectionSearch represents the model behind the search form about `frontend\models\FormCollection`.
 */
class FormCollectionSearch extends FormCollection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','created_at', 'updated_at', 'looknum', 'goodcomment', 'status','college'], 'integer'],
            [[ 'ip', 'rz_head_img', 'zskvideo', 'name', 'info', 'looks', 'rz_content_img'], 'safe'],
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
        $query = FormCollection::find();

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
//            'userid' => $this->userid,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'looknum' => $this->looknum,
            'goodcomment' => $this->goodcomment,
            'status' => $this->status,
        ]);

//        $query->andFilterWhere(['like', 'username', $this->username])
            $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'rz_head_img', $this->rz_head_img])
            ->andFilterWhere(['like', 'zskvideo', $this->zskvideo])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'looks', $this->looks])
            ->andFilterWhere(['like', 'college', $this->college])
            ->andFilterWhere(['like', 'rz_content_img', $this->rz_content_img]);

        return $dataProvider;
    }
}
