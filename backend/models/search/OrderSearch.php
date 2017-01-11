<?php

namespace backend\models\search;

use common\models\Order;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    public $username;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trade_sn', 'type', 'contactname', 'phone', 'username', 'status', 'created_at'], 'safe'],
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
        $query = Order::find();
        $query->joinWith(['member']);
        $query->select("co_order.*, co_member.username");

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

        $query->andFilterWhere([
            'co_order.status' => $this->status,
        ]);

        $query->andFilterWhere([
            'co_order.type' => $this->type,
        ]);

        if ($this->created_at) {
            $createdAt = strtotime($this->created_at);
            $createdAtEnd = $createdAt + 24 * 3600;
            $query->andWhere("co_order.created_at >= {$createdAt} AND co_order.created_at <= {$createdAtEnd}");
        }
        
        $query->orderBy([
            'created_at' => SORT_DESC,
        ]);

        $query->andFilterWhere(['co_order.status' => $this->status])
            ->andFilterWhere(['like', 'co_member.username', $this->username])
            ->andFilterWhere(['like', 'trade_sn', $this->trade_sn])
            ->andFilterWhere(['like', 'contactname', $this->contactname])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
