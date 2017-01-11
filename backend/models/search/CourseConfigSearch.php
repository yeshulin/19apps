<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CourseConfig;

/**
 * CourseConfigSearch represents the model behind the search form about `common\models\CourseConfig`.
 */
class CourseConfigSearch extends CourseConfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_config_id', 'parent', 'order', 'type'], 'integer'],
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
        $query = CourseConfig::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->parent = 0;

        $this->load($params);

        $query->orderBy(['parent'=>SORT_ASC, 'order'=>SORT_DESC]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'course_config_id' => $this->course_config_id,
            'parent' => $this->parent,
            'order' => $this->order,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
