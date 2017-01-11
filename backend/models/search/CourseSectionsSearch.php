<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CourseSections;

/**
 * CourseSectionsSearch represents the model behind the search form about `common\models\CourseSections`.
 */
class CourseSectionsSearch extends CourseSections
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sectionid', 'courseid', 'order'], 'integer'],
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
        $query = CourseSections::find();

        $courseid = isset($params['courseid']) ? $params['courseid'] : null;
        if (!is_null($courseid))
        {
            $this->courseid = $courseid;
            $query->where([ 'courseid' => $courseid]);
        }

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
            'sectionid' => $this->sectionid,
            'courseid' => $this->courseid,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
