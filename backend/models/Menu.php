<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $route
 * @property integer $order
 * @property resource $data
 *
 * @property Menu $parent0
 * @property Menu[] $menus
 */
class Menu extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','route'],'required'],
            [['order'], 'integer'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route'], 'string', 'max' => 256],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'parent' => '父级ID',
            'route' => '路由',
            'order' => '排序',
            'data' => '数据',
        ];
    }

    static public function getMenuByid($parent = 0, $PermissionsByUser = []){
        if ($parent == 0) {
            $where = 'parent is null';
        }
        else {
            $where = ['parent'=> $parent];
        }
        $permissionMenu = [];
        $menuModel = new Menu();
        $menus = $menuModel->find()->where($where)->all();
        if (is_array($menus)) {
            foreach ($menus as $k => $v) {
                if (($one = $menuModel->find()->where(['parent' => $v['id']])->one()) !== null && !empty($menusReturn = self::getMenuByid($v['id'], $PermissionsByUser))) {
                    $permissionMenu[$k]['label'] = $v['name'];
                    $permissionMenu[$k]['url'] = '';
                    $permissionMenu[$k]['items'] = self::getMenuByid($v['id'], $PermissionsByUser);
                }
                else if (!empty($v['route'])) {
                    $route = trim($v['route'], '/');
                    if (strpos($route, '/')) {
                        $permission = str_replace('/', '::', $route);
                    }
                    else{
                        $permission = $route.'::*';
                    }
                    if (in_array($permission, $PermissionsByUser) || in_array('*::*', $PermissionsByUser)) {
                        $permissionMenu[$k]['label'] = $v['name'];
                        $permissionMenu[$k]['url'] = [$v['route']];
                    }
                }
            }
        }
        return $permissionMenu;
    }


    static public function getMenuByUserid($userid){
        $PermissionsByUser = array_keys(Yii::$app->authManager->getPermissionsByUser($userid));
        return self::getMenuByid(0, $PermissionsByUser);
    }

    public static function getMenuList($parent = 0, $menusList = ['null'=>'一级菜单'], $ri = 0){
        $ri ++;
        if ($parent == 0) {
            $where = 'parent is null';
        }
        else {
            $where = ['parent'=> $parent];
        }
        $menus = self::find()->where($where)->orderBy(['order'=>SORT_DESC])->all();
        foreach ($menus as $v) {
            $menusList[$v['id']] = '├'.str_repeat('-', $ri*5) .$v['name'];
            if (self::find()->where(['parent'=>$v['id']])->one() !== null) {
                $menusList = self::getMenuList($v['id'], $menusList,$ri);
            }
        }
        return $menusList;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }
}
