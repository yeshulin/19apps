<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/7/30
 * Time: 12:19
 */

namespace frontend\models;

use Yii;
use common\models\Myfavorite as ComMyfavorite;

class Myfavorite extends ComMyfavorite
{
    public $pagesize;

    public $page;


    public function save($runValidation = true, $attributeNames = null)
    {
        $this->userid = Yii::$app->user->id;
        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }

    public function search($params)
    {
        $this->pagesize = isset($params['pagesize']) ? intval($params['pagesize']) : 10;
        $this->page = isset($params['page']) ? intval($params['page']) : 1;

        $query = self::find()->alias('a')->where(['a.userid'=>Yii::$app->user->id]);

        $query->joinWith(['course b']);

        $totalCount = $query->count();
        $this->page = $this->page > 0 ? $this->page : 1;
        $this->pagesize = $this->pagesize > 0 ? $this->pagesize : 1;
        if ($this->pagesize > 20)
        {
            $this->pagesize = 20;
        }
        $pages = ceil($totalCount/$this->pagesize);
        if ($this->page > $pages) {
            $this->page = $pages;
        }

        $data = $query->offset(($this->page -1) * $this->pagesize)->limit($this->pagesize)->asArray(true)->all();

        return [
            'data'=>$data,
            'total'=>$totalCount,
            'currentPage'=>$this->page,
            'pageSize'=>$this->pagesize
        ];
    }
}