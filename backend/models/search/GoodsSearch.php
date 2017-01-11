<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Goods;

/**
 * GoodsSearch represents the model behind the search form about `common\models\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'type', 'association_id', 'status', 'create_at', 'update_at'], 'integer'],
            [['goods_name', 'keywords', 'goods_thumb'], 'safe'],
            [['price', 'money'], 'number'],
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
        $query = Goods::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (is_null($this->status))
        {
            $query->andWhere(['<>', 'status', self::STATUS_DELETE]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'goods_id' => $this->goods_id,
            'price' => $this->price,
            'money' => $this->money,
            'type' => $this->type,
            'association_id' => $this->association_id,
            'status' => $this->status,
//            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);
        $this->create_at_start = $this->create_at_start ? strtotime($this->create_at_start) : '';
        $this->create_at_end = $this->create_at_end ? strtotime($this->create_at_end) : '';


        $query->andFilterWhere(['like', 'goods_name', $this->goods_name])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
//            ->andFilterWhere(['like', 'goods_thumb', $this->goods_thumb])
            ->andFilterWhere(['BETWEEN', 'create_at', $this->create_at_start, $this->create_at_end]);

        return $dataProvider;
    }
}
