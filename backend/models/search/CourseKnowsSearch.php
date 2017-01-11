<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CourseKnows;

/**
 * CourseKnowsSearch represents the model behind the search form about `common\models\CourseKnows`.
 */
class CourseKnowsSearch extends CourseKnows
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['knowsid', 'barsid', 'type', 'linkid', 'order'], 'integer'],
            [['name'], 'safe'],
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
        $query = CourseKnows::find();

        // add conditions that should always apply here

        $barsid = isset($params['barsid']) ? $params['barsid'] : null;
        if (!is_null($barsid))
        {
            $this->courseid = isset($params['courseid']) ? $params['courseid'] : null;
            $this->sectionid = isset($params['sectionid']) ? $params['sectionid'] : null;
            $this->barsid = $barsid;
            $query->where([ 'barsid' => $barsid]);
        }

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
            'knowsid' => $this->knowsid,
            'barsid' => $this->barsid,
            'type' => $this->type,
            'linkid' => $this->linkid,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
