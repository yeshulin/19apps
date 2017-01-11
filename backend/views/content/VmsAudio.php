
<?php //var_dump($pages);exit;?>
<?php //$this->registerJsFile("@web/statics/js/jquery.sgallery.js");exit;?>
<script language="javascript" type="text/javascript" src="/statics/js/vms/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="/statics/js/vms/jquery.sgallery.js"></script>
<script language="javascript" type="text/javascript" src="/statics/js/vms/styleswitch.js"></script>

<link href="/statics/js/vms/swfupload.css" rel="stylesheet" type="text/css" />
<link href="/statics/js/vms/reset.css" rel="stylesheet" type="text/css" />
<link href="/statics/js/vms/zh-cn-system.css" rel="stylesheet" type="text/css" />
<div class="bk20"></div>
<div class="pad-lr-10">
    <form name="searchform" action="" method="get" >
        <input type="hidden" value="content/get-video-vms" name="r">
        <input type="hidden" value="Audio" name="getType">
<!--        <input type="hidden" value="init" name="a">-->
<!--        <input type="hidden" name="pc_hash" value="--><?php //echo $_SESSION['pc_hash']?><!--">-->
<!--        <table width="100%" cellspacing="0" class="search-form">-->
            <tbody>
            <tr>
                <td><div class="explain-col">
                        音频名称  <input type="text" value="<?php echo isset($get['name'])?$get['name']:''?>" class="input-text" name="name">
<!--                        上传时间 --><?php //echo form::date('starttime',$_GET['starttime'])?><!--- --><?php //echo form::date('endtime',$_GET['endtime'])?>
                        <input type="submit" value="搜索" class="button" name="dosubmit">
                        <input type="hidden" value="<?php echo Yii::$app->request->getCsrfToken(); ?>" name="YII_CSRF_TOKEN" />
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="bk20 hr"></div>
    <ul class="video-list contentList" id="fsUploadProgress">
        <?php $Lists = $infos['video'] ? $infos['video'] : $infos['video']; ?>
        <?php foreach($Lists as $r) {
            ?>
            <li>
                <div class="img-wrap">
                    <a href="javascript:;" vid="<?php echo $r['id']?>" onclick="javascript:album_cancel(this)"><div class="icon"></div><?php echo $r['title'];?>
                    </a>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<div style="clear:both;" id="pages" class="text-c"><?php echo $pages?></div>
<div ><span id="tijiao" style="display:none;">提交</span></div>
<script type="text/javascript">

    function album_cancel(obj,id){
        $("#fsUploadProgress li div a").removeClass("on");
        $("#fsUploadProgress li div a").attr("id","");
        $(obj).addClass("on");
        $(obj).attr("id","active-on");
    }

</script>
<script language="javascript" type="text/javascript" src="/statics/js/content_addtop.js?v=<?php echo time();?>"></script>
<script language="javascript" type="text/javascript" src="/statics/js/cookie.js"></script>
<script language="javascript" type="text/javascript" src="/statics/js/hotkeys.js"></script>
<script language="javascript" type="text/javascript" src="/statics/js/colorpicker.js"></script>
<script>
    var CKEDITOR = window.parent.CKEDITOR;
    $.ajaxSetup({
        async : false
    });

    var okListener = function(event){
        if(!$("#fsUploadProgress li").find(".on")){
            return false;
        }
        var d = '';
        var vid = $("#fsUploadProgress li").find(".on").attr("vid");
        var title = $("#fsUploadProgress li").find(".on").text();
        $.get('index.php', {m:'video', c:'audio', a:'get_vms_html', vid:vid}, function(data){
            if (data==1) {
                alert('视频地址错误！');
                d = false;
            } else {
                var _data = $(data);
                _data[0].innerHTML = "<img style='vertical-align: middle;' src='/statics/js/ckeditor/plugins/vmsaudio/music.gif' />"+title;
                $.each(_data,function(k, v){
                    d += this.outerHTML.toString();
                })

            }
        });
        console.log(d);
        if(d !== false){
            this._.editor.insertHtml("<div class='vms-audio' style=''>"+d+"</div>");
        }
        CKEDITOR.dialog.getCurrent().removeListener("ok", okListener);
    };
    CKEDITOR.dialog.getCurrent().on("ok", okListener);
</script>
