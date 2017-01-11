<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Video;

/**
 * VideoSearch represents the model behind the search form about `backend\models\Video`.
 */
class VideoSearch extends Video
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['videoid','type', 'status'], 'integer'],
            [['vmsid', 'videoname'], 'safe'],
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
        $query = Video::find();

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
            'videoid' => $this->videoid,
            'time' => $this->time,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'userid' => $this->userid,
            'usertype' => $this->usertype,
            'type' => $this->type,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'vmsid', $this->vmsid])
            ->andFilterWhere(['like', 'videoname', $this->videoname])
            ->andFilterWhere(['like', 'thumb', $this->thumb]);

        return $dataProvider;
    }
}
