<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ContentCatlog;

/**
 * ContentCatlogSearch represents the model behind the search form about `backend\models\ContentCatlog`.
 */
class ContentCatlogSearch extends ContentCatlog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catid', 'pid'], 'integer'],
            [['catname'], 'safe'],
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
        $query = ContentCatlog::find();

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
            'catid' => $this->catid,
            'pid' => $this->pid,
        ]);

        $query->andFilterWhere(['like', 'catname', $this->catname]);

        return $dataProvider;
    }
}
