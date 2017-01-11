<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Course;

/**
 * CourseSearch represents the model behind the search form about `common\models\Course`.
 */
class CourseSearch extends Course
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'authorid', 'type', 'userid', 'status', 'create_at', 'update_at'], 'integer'],
            [['course_name', /*'brief', 'description', 'thumb'*/], 'safe'],
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
        $query = Course::find()->alias('a');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->status = self::STATUS_DEFAULT;

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'a.course_id' => $this->course_id,
            'a.authorid' => $this->authorid,
            'a.type' => $this->type,
            'a.userid' => $this->userid,
            'a.status' => $this->status,
            'a.create_at' => $this->create_at,
            'a.update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'a.course_name', $this->course_name])
            ->andFilterWhere(['like', 'a.brief', $this->brief])
            ->andFilterWhere(['like', 'a.description', $this->description])
            ->andFilterWhere(['like', 'a.thumb', $this->thumb]);

        return $dataProvider;
    }
}
