<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Activationlog;

/**
 * ActivationlogSearch represents the model behind the search form about `backend\models\Activationlog`.
 */
class ActivationlogSearch extends Activationlog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid'], 'integer'],
            [['activ_code'], 'safe'],
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
        $query = Activationlog::find();

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
//            'crated_at' => $this->crated_at,
        ]);

        $query->andFilterWhere(['like', 'activ_code', $this->activ_code]);

        return $dataProvider;
    }
}
