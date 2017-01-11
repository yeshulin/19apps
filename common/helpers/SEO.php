<?php
namespace common\helpers;

/*
 *  网站title,keywords,description设置
 * */
use Yii;

class SEO
{
    static public $title='';
    static public $keywords='';
    static public $description='';
    static public $suffix='';

    static private function set()
    {
        self::$title=Yii::$app->params['web-title'];
        self::$suffix=Yii::$app->params['web-suffix'];
        self::$keywords=Yii::$app->params['web-keywords'];
        self::$description=Yii::$app->params['web-description'];
    }
    /*
     * @params
     * title    网站标题
     * keywords 关键词
     * description      描述
     * */
    static public function setSEO($title='',$keywords='',$description=''){
        self::set();
        if(empty($title)){
            $title=self::$title;
        }
        if(empty($keywords)){
            $keywords=self::$keywords;
        }
        if(empty($description)){
            $description=self::$description;
        }
        Yii::$app->params['web-title']=$title.self::$suffix;
        Yii::$app->params['web-keywords']=$keywords;
        Yii::$app->params['web-description']=$description;
        return true;
    }
}

?>