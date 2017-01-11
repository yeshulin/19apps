<?php

namespace backend\models\search;

use common\models\Advertisement;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdvertisementSearch extends Advertisement
{
    public $username;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['display_name', 'created_at'], 'safe'],
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
        $query = Advertisement::find();

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

        
        if ($this->created_at) {
            $createdAt = strtotime($this->created_at);
            $createdAtEnd = $createdAt + 24 * 3600;
            $query->andWhere("created_at >= {$createdAt} AND created_at <= {$createdAtEnd}");
        }

        $query->andFilterWhere(['display_name' => $this->display_name]);

        return $dataProvider;
    }
}
