<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Link;

/**
 * LinkSearch represents the model behind the search form about `common\models\Link`.
 */
class LinkSearch extends Link
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['linkid', 'linktype', 'order', 'status', 'create_at', 'linkcatid'], 'integer'],
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
        $query = Link::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['status'=>self::STATUS_DEFAULT]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'linkid' => $this->linkid,
            'linktype' => $this->linktype,
            'order' => $this->order,
            'status' => $this->status,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'introduce', $this->introduce]);

        return $dataProvider;
    }
}
