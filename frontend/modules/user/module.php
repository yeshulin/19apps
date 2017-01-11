<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:26
 */
namespace frontend\modules\user;

use yii\base\Module as BaseModule;

class module extends BaseModule
{
    public $modelMap = [];
    /** @var bool Whether to show flash messages. */
    public $enableFlashMessages = true;

    public $controllerNamespace = 'frontend\modules\user\controllers';

    public function init()
    {
        parent::init();

    }
}
