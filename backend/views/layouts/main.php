<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="gray-bg">
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => '首页', 'template' => '<li><i class="fa fa-home"></i>{link}</li>'],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<a style="position: absolute; top:0;top: 10px;right: 20px;" href="javascript:location.replace(location.href);"
   title="刷新"><i class="fa fa-refresh"></i></a>

<?php $this->beginBody() ?>
<div class="wrapper wrapper-content  animated fadeInRight">

    <?= $content ?>
</div>
<?php $this->endBody() ?>
<?php //$this->registerJs('var K_Config={uploadJson:"'.Url::to(['attached/upload/json']).'",fileManagerJson:"'.Url::to(['attached/upload/images']).'",allowFileManager:true};function K(obj){KindEditor.ready(function(K){K.create(obj,K_Config)})};function UploadImage(Obj,Type,TextObj){TextObj=TextObj==undefined?Obj:TextObj;var showRemote=true,showLocal=true;if(Type==1){showRemote=false}else if(Type==2){showLocal=false}KindEditor.ready(function(K){var editor=K.editor(K_Config);K(Obj).click(function(){editor.loadPlugin("image",function(){editor.plugin.imageDialog({showRemote:showRemote,showLocal:showLocal,imageUrl:K(TextObj).val(),clickFn:function(url,title,width,height,border,align){K(TextObj).val(url);editor.hideDialog()}})})})})}', \yii\web\View::POS_HEAD); ?>

<?php $this->registerJs('var K_Config = {
    uploadJson: "' . Url::to(["attached/upload/json"]) . '",
    fileManagerJson: "' . Url::to(["attached/upload/upload"]) . '",
    allowFileManager: true,
};
IMG_Config = {
    uploadJson: "' . Url::to(["attached/upload/json"]) . '",
    fileManagerJson: "' . Url::to(["attached/upload/upload"]) . '",
    allowFileManager: true,
    items:["multiimage"]
};
function K(obj) {
    KindEditor.ready(function (K) {
        K.create(obj, K_Config)
    })
};
function thumb_images(uploadid,returnid) {
    var d = window.top.art.dialog({id:uploadid}).data.iframe;
	var in_content = d.$("#att-status").html().substring(1);
	if(in_content==""){
		return false;
	}
	if($("#"+returnid+"_preview").attr("src")) {
		$("#"+returnid+"_preview").attr("src",in_content);
	}
	$("#"+returnid).val(in_content);
};
function KCustom(obj,Config) {
    KindEditor.ready(function (K) {
        K.create(obj, Config)
    })
};
function UploadMultiImage(Obj, Type, TextObj,ImgObj) {
    TextObj = TextObj == undefined ? Obj : TextObj;
    var showRemote = true, showLocal = true;
    if (Type == 1) {
        showRemote = false
    } else if (Type == 2) {
        showLocal = false
    }
    KindEditor.ready(function (K) {
        var editor = K.editor(IMG_Config);
        K(Obj).click(function () {
            editor.loadPlugin("multiimage", function () {
                editor.plugin.multiImageDialog({
                    showRemote: showRemote,
                    showLocal: showLocal,
                    imageUrl: K(TextObj).val(),
                    clickFn: function (url, title, width, height, border, align) {
                        var json={};
                        if(K(TextObj).val()!=""){
                            var val=JSON.parse(K(TextObj).val());
                        }else{
                            var val="";
                        }
                        var urlL=0;
                        var varL=url.length;
                        jQuery.each(val,function(index,e){
                               json[urlL]=e;
                               urlL++;
                        })
                        for(var i=0;i<varL;i++)
                        {
                            json[urlL+i]={};
                            json[urlL+i]["url"]=url[i].url;
                            var num = parseInt(urlL)+parseInt(i);
                            json[urlL+i]["alt"]=num;
                            $("#photoShow").append("<img id=\"img_photo\" src=\""+url[i].url+"\" width=\"150px\" height=\"150px\" alt=\""+num+"\" title=\"点击更换图片\" style=\"cursor:pointer\">");
                        }
                        console.log(JSON.stringify(json));
                        K(TextObj).val(JSON.stringify(json));
                        editor.hideDialog();
                    }
                })
            })
        })
    })
};
function ShowElement(element,type,method,id,num,islayer,modify,userid)
{
    var oldhtml = element.innerHTML; //获得元素之前的内容
    var code="";
    var newobj = document.createElement("input");　//创建一个input元素
    if ((oldhtml.length!=0 || oldhtml!=0 ) && modify)
    {
        return false;
    }
    newobj.type = "text";　 //为newobj元素添加类型
    newobj.value = oldhtml;
    //设置newobj失去焦点的事件
    newobj.onblur = function(){
　　element.innerHTML = this.value ? this.value : oldhtml;　//当触发时判断newobj的值是否为空，为空则不修改，并返回oldhtml。
        if (this.value != "")
        {
            if(element.innerHTML != oldhtml)
            {
                if(confirm("确认提交么?此后将不能修改!")){
                    $.post(method,{id:id,code:this.value},function(data){
                        if(data.code == "0000" )
                        {
                            if(islayer){
                                // alert("修改成功");
                                 layer.open({
                                    type: 2,
                                    title: "激活码生成",
                                    shadeClose: true,
                                    shade: 0.8,
                                    area: ["50% ", "80%"],
                                    content: "' . \yii\helpers\Url::to(["activation/create"]) . '&type="+type+"&num="+num+"&id="+id+"&userid="+userid,
                                });
                            }
                        }else{
                            alert(data.error);
                        }
                    })

                }else{
                    element.innerHTML = oldhtml;
                }
            }
        }
　　}
    element.innerHTML = "";　//设置元素内容为空
    element.appendChild(newobj);　//添加子元素　
    newobj.focus();　//获得焦点
}
function ShowTime(element,type,method,id,num,islayer,modify)
{
    var oldhtml = element.innerHTML; //获得元素之前的内容
    var code="";
    var newobj = document.createElement("input");　//创建一个input元素
    if ((oldhtml.length!=0 || oldhtml!=0 ) && modify)
    {
        return false;
    }
    newobj.type = "text";　 //为newobj元素添加类型
    newobj.id="timepick";
    newobj.class="timepick";
    newobj.value = oldhtml;
    $("#timepick").remove();//删除旧元素,防止多次点击
    element.innerHTML = "";　//设置元素内容为空
    element.appendChild(newobj);　//添加子元素　
    newobj.focus();　//获得焦点
    //设置newobj失去焦点的事件

    laydate({
            elem: "#timepick",
            format: "YYYY/MM/DD hh:mm:ss",
            min: laydate.now(), //设定最小日期为当前日期
            istime: true,
            istoday: false,
            choose: function(datas){
            element.innerHTML = datas;
//                end.min = datas; //开始日选好后，重置结束日的最小日期
//                end.start = datas //将结束日的初始值设定为开始日
        　　element.innerHTML = datas ? datas : oldhtml;　//当触发时判断newobj的值是否为空，为空则不修改，并返回oldhtml。
                if (this.value != "") {
                    if(element.innerHTML != oldhtml){
                        if(confirm("确认提交么?")){
                            $.post(method,{id:id,code:datas},function(data){
                                if(data.code == "0000" ){
                                    if(islayer){
                                        // alert("修改成功");
                                         layer.open({
                                            type: 2,
                                            title: "激活码生成",
                                            shadeClose: true,
                                            shade: 0.8,
                                            area: ["50% ", "80%"],
                                            content: "' . \yii\helpers\Url::to(["activation/create"]) . '&type="+type+"&num="+num+"&id="+id,
                                        });
                                    }
                                }else{
                                    alert(data.error);
                                }
                            })
                        }else{
                            element.innerHTML = oldhtml;
                        }
                    }
                }
        　　}
        });
}
function UploadImage(Obj, Type, TextObj,ImgObj) {
    TextObj = TextObj == undefined ? Obj : TextObj;
    var showRemote = true, showLocal = true;
    if (Type == 1) {
        showRemote = false
    } else if (Type == 2) {
        showLocal = false
    }
    KindEditor.ready(function (K) {
        var editor = K.editor(K_Config);
        K(Obj).click(function () {
            editor.loadPlugin("image", function () {
                editor.plugin.imageDialog({
                    showRemote: showRemote,
                    showLocal: showLocal,
                    imageUrl: K(TextObj).val(),
                    clickFn: function (url, title, width, height, border, align) {
                        if(ImgObj!=undefined){
                            K(ImgObj)[0].src=url;
                        }
                        K(TextObj).val(url);
                        editor.hideDialog()
                    }
                })
            })
        })
    })
}
function Play(id)
{
    layer.open({
        type: 2,
        title: "视频播放",
        shadeClose: false,
        shade: 0.8,
        area: [\'766px\', \'479px\'],
        content: "'.Url::to(['/video/play', 'id'=>'']).'"+id //iframe的url
    });
}
', \yii\web\View::POS_HEAD) ?>
<?php $this->registerJs("
    var vms_url='" . Yii::$app->params['vms_url'] . "';
    var vms_siteid=" . Yii::$app->params['vms_siteid'] . ";"
) ?>
</body>
</html>
<?php $this->endPage() ?>
