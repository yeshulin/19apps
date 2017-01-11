<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Certification;

/**
 * CertificationSearch represents the model behind the search form about `backend\models\Certification`.
 */
class CertificationSearch extends Certification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['certificationid', 'order', 'status', 'create_at', 'update_at'], 'integer'],
            [['certification_name', 'examtype', 'studyway', 'object', 'brief', 'people'], 'safe'],
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
        $query = Certification::find();

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
            'certificationid' => $this->certificationid,
            'order' => $this->order,
            'status' => $this->status,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'certification_name', $this->certification_name])
            ->andFilterWhere(['like', 'examtype', $this->examtype])
            ->andFilterWhere(['like', 'studyway', $this->studyway])
            ->andFilterWhere(['like', 'object', $this->object])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'people', $this->people]);

        return $dataProvider;
    }
}
