<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/8
 * Time: 18:10
 */

namespace backend\widgets;

use backend\assets\KindedtiorAsset;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\InputWidget;

/**
 * Class Kindedtior
 * 编辑器使用
 *
    Kindedtior::widget([
        'kindeditor'=>'//配置选项，参阅Kindeditor官网文档(定制菜单等)',
        'widget'=>'uploadImage', //编辑器模式 默认NULL 编辑器 uploadImage 上传图片
        'toolbars' => 'basic', //（默认）basic  编辑器简单模式   full 全部
        'uploadImageType' => 0, //上传图片  0 本地加网络空间  1 本地 2网络
        'preview'=>true, //上传图片之后是否显示图片
    ]);
 *
 * @package backend\widgets
 */
class Kindedtior extends InputWidget
{
    //配置选项，参阅Kindeditor官网文档(定制菜单等)
    public $kindeditor;

    //默认配置
    public $toolbars = 'basic';
    public $widget = null;
    public $uploadImageType = 0;
    public $preview = true;
    protected $_options; // 0 网络加本地   1 本地  2 网络
    protected $attributes;
    protected $KindView;
    protected $kindeditorJs;


    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (isset($this->options['id'])) {
            $this->id = $this->options['id'];
        } else {
            $this->id = $this->hasModel() ? Html::getInputId($this->model,
                $this->attribute) : $this->id;
        }
        $this->attributes['id'] = $this->id;
        if (!empty($this->options))
        {
            $this->attributes = ArrayHelper::merge($this->attributes, $this->options);
        }
        $this->_options = [
            'uploadJson'=> Url::to(["attached/upload/json"]),
            'fileManagerJson' => Url::to(["attached/upload/upload"]),
            'allowFileManager' => true,
            'width'=>'100%',
            'height' => '300px',
        ];
        parent::init();
    }


    public function run()
    {
        switch ($this->widget)
        {
            case 'uploadImage':
                return $this->createUploadImage();
                break;

            default:
                return $this->createTextarea();
                break;
        }
    }

    /**
     * 编辑器图片上传插件
     * @return string
     */
    protected function createUploadImage()
    {
        $this->attributes['class'] = 'form-control';
        $this->attributes['style'] = 'width:40%; DISPLAY: initial;';
        $uploadImageType = '';
        if ($this->uploadImageType == 1)
        {
            $uploadImageType = 'showRemote : false,';
        }
        elseif ($this->uploadImageType == 2)
        {
            $uploadImageType = 'showLocal : false,';
        }
        $preview = '';
        if ($this->preview)
        {
            $preview = " $(\"#".$this->id."\").click()";
        }
        $kindeditorJs = $this->createTextareaConfig();
        $id = 'K-'.$this->id;
        $js = <<<JS
var editor = K.editor($kindeditorJs);
K('#$id').click(function() {
    editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
            $uploadImageType
            imageUrl : K('#$this->id').val(),
            clickFn : function(url, title, width, height, border, align) {
                K('#$this->id').val(url);
                editor.hideDialog();
                $preview
            }
        });
    });
});
JS;
        $this->registerJs($js);
        $this->KindView->registerJs('
            $("#'.$this->id.'").on("click", function(){
                var url = $(this).val();
                layer.open({
                    type: 1,
                    title: \'图片预览\',
                    skin: \'layui-layer-demo\',
                    closeBtn: false,
                    shift: 2,
                    shadeClose: true,
                    content: \'<img src="\'+url+\'" width="260px" height:150px; />\'
                });
            })
        ', View::POS_END);
        if ($this->hasModel()) {
            $Html = Html::activeTextInput($this->model, $this->attribute, $this->attributes);
        } else {
            $Html = Html::input($this->name, $this->value, $this->attributes);
        }
        return Html::tag('div', $Html.Html::button('上传图片', ['class' => 'btn btn-success', 'id'=>$id]));
    }

    /**
     * 生成客户端脚本
     */
    protected function createTextareaConfig()
    {

        if (!empty($this->kindeditor)) {
            $this->kindeditor = ArrayHelper::merge($this->_options, $this->kindeditor);
        } else {
            $this->kindeditor = $this->_options;
        }
        $this->KindView = $this->getView();
        KindedtiorAsset::register($this->KindView);
        return Json::encode($this->kindeditor);

    }

    /**
     * JS注册
     * @param $kindeditorJs
     */
    protected function registerJs($kindeditorJs)
    {
        $js = "KindEditor.ready(function (K) { " . $kindeditorJs . " });";
        $this->KindView->registerJs($js, View::POS_END);
    }

    /**
     * 编辑器创建
     * @return string
     */
    protected function createTextarea()
    {
        switch ($this->toolbars) {
            case 'null':
                $this->_options['items'] = [];
                break;

            case 'full':
                $this->_options['items'] = [
                    'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
                    'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                    'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                    'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                    'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                    'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
                    'flash', 'media', 'vmsvideo',/* 'vmsaudio',*/ 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
//                    'anchor', 'link', 'unlink', 'vms', 'vmsa', '|', 'about'
                ];
                break;

            default:
                $this->_options['items'] = [
                    'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons', 'image','vmsvideo', 'link'
                ];
                break;
        }
        $kindeditorJs = $this->createTextareaConfig();
        $this->registerJs("K.create('#" . $this->id . "', " . $kindeditorJs . ");");
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, $this->attributes);
        } else {
            return Html::textarea($this->name, $this->value, $this->attributes);
        }
    }
}