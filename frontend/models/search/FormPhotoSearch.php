<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FormPhoto;

/**
 * FormPhotoSearch represents the model behind the search form about `frontend\models\FormPhoto`.
 */
class FormPhotoSearch extends FormPhoto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at','updated_at','college'], 'integer'],
            [[ 'ip', 'photo', 'name', 'info', 'looks', 'indeximg', 'address', 'status'], 'safe'],
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
        $query = FormPhoto::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

//        $query->andFilterWhere(['like', 'username', $this->username])
           $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'looks', $this->looks])
            ->andFilterWhere(['like', 'indeximg', $this->indeximg])
            ->andFilterWhere(['like', 'college', $this->college])
            ->andFilterWhere(['like', 'address', $this->address])
//            ->andFilterWhere(['like', 'arrdata', $this->arrdata])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
