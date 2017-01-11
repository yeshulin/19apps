<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/7/26
 * Time: 13:29
 */

namespace frontend\models;

use common\models\Certification;
use common\models\CourseConfig;
use common\models\CourseConfigId;
use common\models\Lab;
use common\models\Live;
use common\models\Practical;
use Yii;
use common\models\Goods as ComGoods;

class Goods extends ComGoods
{
    public $pagesize;

    public $page;

    public $items;

    /**
     * //搜索规则   主表商品表别名a 附表b 附表关联 c .....
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->pagesize = isset($params['pagesize']) ? intval($params['pagesize']) : 10;
        $this->page = isset($params['page']) ? intval($params['page']) : 1;

        self::load($params, '');

        if ($params['GoodsType']) {
            $this->type = intval($params['GoodsType']);
        }

        $query = self::find()->alias('a');
        $query->joinWith(['goodsAttr attr']);

        $query = $this->leftJoinByQueryType($query, $this->type);

        $query->where(['a.status' => self::STATUS_DEFAULT]);

        $query->andWhere([
            'a.type' => $this->type,
        ]);
//        var_dump($this->type);exit;
       /* *
         * 搜索功能实现
        * */
        switch ($this->type)
        {
            case self::TYPE_COURSE:
                $query = $this->courseQuery($query, $params);
//                var_dump($query);
                break;

            case self::TYPE_LIVE:
//                $query->andFilterWhere(['like', 'a.goods_name', $this->goods_name]);
                break;

            case self::TYPE_LAB:
//                $query->andFilterWhere(['like', 'a.goods_name', $this->goods_name]);
                break;

            case self::TYPE_PRACTICAL:
//                $query->andFilterWhere(['like', 'a.goods_name', $this->goods_name]);
                break;

            case self::TYPE_ZYRZ:
//                $query->andFilterWhere(['like', 'a.goods_name', $this->goods_name]);
                break;

            case self::TYPE_PXCC:
//                $query->andFilterWhere(['like', 'a.goods_name', $this->goods_name]);
                break;
        }
//exit;
//        $query->andFilterWhere(['like', 'a.goods_name', $this->goods_name])
//            ->andFilterWhere(['like', 'a.keywords', $this->keywords]);

        $totalCount = $query->count();
        $this->page = $this->page > 0 ? $this->page : 1;
        $this->pagesize = $this->pagesize > 0 ? $this->pagesize : 1;
        if ($this->pagesize > 20)
        {
            $this->pagesize = 20;
        }

        $pages = ceil($totalCount/$this->pagesize);
        if ($this->page > $pages && $pages != 0) {
            $this->page = $pages;
        }
//        var_dump($query->createCommand()->getRawSql());exit;
//        var_dump($query->asArray(true)->all());exit;
        return [
            'data'=>$query->offset(($this->page -1) * $this->pagesize)->limit($this->pagesize)->asArray(true)->all(),
            'total'=>intval($totalCount),
            'currentPage'=>$this->page,
            'pageSize'=>$this->pagesize,
        ];
    }

    public function courseQuery($query, $params)
    {
        if (isset($params['config']) && !empty($params['config']))
        {
            $type = CourseConfig::TYPE_COURSE;
            if (isset($params['index']))
            {
                $type = CourseConfig::TYPE_INDEX;
            }
            $config = explode(',', $params['config']);
            $CourseConfigModel = CourseConfigId::findAll(['course_config_id'=>$config[0], 'type'=>$type]);
            unset($config[0]);
            $configId = [];
            foreach ($CourseConfigModel as $m)
            {
                $configId[] = $m->course_id;
                foreach ($config as $course_config_id) {
                    $ConfigModel = CourseConfigId::findOne(['course_config_id' => $course_config_id, 'course_id' => $m->course_id, 'type' => $type]);
                    if ($ConfigModel == null) {
                        $configId = [];
                        break;
                    } else {
                        $configId[] = $ConfigModel->course_id;
                    }
                }
            }
//return $configId;

            $query->andWhere(['IN', 'b.course_id', $configId]);
//            $query->andWhere(['IN', 'c.course_config_id', $configId]);

//            $query->andWhere(['c.type'=>$type]);
        }

        if (isset($params['courseName']) && !empty($params['courseName']))
        {
            $query->andWhere(['LIKE', 'b.course_name', $params['courseName']]);
//            $query->andWhere(['LIKE', 'a.goods_name', $params['courseName']]);
        }

        if (isset($params['keywords']) && !empty($params['keywords']))
        {
            $query->andWhere(['LIKE', 'a.keywords', $params['keywords']]);
        }
        if (isset($params['create_at']))
        {
            $learnnumber = $params['create_at'] == 1 ? SORT_DESC : SORT_ASC;
            $query->addOrderBy(['b.create_at'=>$learnnumber]);
        }

        if (isset($params['learnnumber']))
        {
            $learnnumber = $params['learnnumber'] == 1 ? SORT_DESC : SORT_ASC;
            $query->addOrderBy(['b.learnnumber'=>$learnnumber]);
        }
        if (isset($params['likenumber']))
        {
            $learnnumber = $params['likenumber'] == 1 ? SORT_DESC : SORT_ASC;
            $query->addOrderBy(['b.likenumber'=>$learnnumber]);
        }
        return $query;
    }

    /**
     * 商品关联数据
     * @param $query
     * @param $type
     * @return mixed
     */
    public static function leftJoinByQueryType($query, $type)
    {
        switch ($type)
        {
            case self::TYPE_COURSE:
                $query->innerJoinWith(['course b']);
                break;

            case self::TYPE_LIVE:
                $query->innerJoinWith(['live b']);
                break;

            case self::TYPE_LAB:
                $query->innerJoinWith(['lab b']);
                break;

            case self::TYPE_PRACTICAL:
                $query->innerJoinWith(['practical b']);
                break;

            case self::TYPE_ZYRZ:
                $query->innerJoinWith(['certification b']);
                break;
        }
        return $query;
    }

    /**
     * 获取关联课程信息
     * @return $this
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['course_id'=>'association_id'])->asArray(true);
    }

    /**
     * 获取关联实验室信息
     * @return $this
     */
    public function getLab()
    {
        return  $this->hasOne(Lab::className(), ['labid'=>'association_id'])->asArray(true);
    }

    /**
     * 获取关联直播信息
     * @return $this
     */
    public function getLive()
    {
        return  $this->hasOne(Live::className(), ['liveid'=>'association_id'])->asArray(true);
    }

    /**
     * 获取关联实训信息
     * @return $this
     */
    public function getPractical()
    {
        return  $this->hasOne(Practical::className(), ['practicalid'=>'association_id'])->asArray(true);
    }

    /**
     * 获取关联实训信息
     * @return $this
     */
    public function getCertification()
    {
        return  $this->hasOne(Certification::className(), ['certificationid'=>'association_id'])->asArray(true);
    }


}