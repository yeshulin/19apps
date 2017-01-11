<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 */
class Role extends AuthItem
{
//    public $name;
//    public $description;
//    public $rule_name;
//    public $name;


    public function rules(){
        return [
            [['name'],'string','max'=>20],
            [['name'],'required'],
//            ['description','filter','filter'=>function($value){
//                return Html::encode($value);
//            }],
        ];
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),  //自动设置 created_at updated_at
        ];
    }


    public function attributeLabels(){
        return [
            'name'=>'角色名称',
            'description'=>'角色描述',
        ];
    }

    public function getRolePermission($name){
        $authManager = Yii::$app->authManager;
        $premission = array_keys($authManager->getPermissions());
        $RolePermission = array_keys($authManager->getPermissionsByRole($name));
        $exts = [];
        foreach ($premission as $name) {
            if (!in_array($name, $RolePermission)) {
                $exts[] = $name;
            }
        }
        $Routes = [
            'avaliable' => $exts,
            'assigned' => $RolePermission,
        ];
        return $Routes;
    }

    public function getRoles(){
        $roles = Yii::$app->authManager->getRoles();
//        return $roles;
        $role = ['null'=> ''];
        foreach ($roles as $v):
            $role[$v->name] = $v->name;
        endforeach;
        return $role;
    }

    public function _save(){
        if($this->validate()){
            $authManager = Yii::$app->authManager;
            $role = $authManager->createRole($this->name);
            $role->description = '创建了 ' . $this->name. ' 角色';
//            $role->type = 2;
            $authManager->add($role);
            return true;
        }else{
            return false;
        }
    }

    public function _update($name){
        if($this->validate()){
            $authManager = Yii::$app->authManager;
            $role = $authManager->getRole($name);
            if($role) {
                $authManager->remove($role);
                $role = $authManager->createRole($name);
                $authManager->add($role);
                return true;
            }
        }
        return false;
    }
}
