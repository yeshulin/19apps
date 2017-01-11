
<?php //var_dump($infos['video']);?>
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
    <form name="searchform"  method="get" action="/index.php?r=content/get-video-vms">
        <input type="hidden" value="content/get-video-vms" name="r">
<!--        <input type="hidden" value="video_for_ck" name="c">-->
<!--        <input type="hidden" value="init" name="a">-->
<!--        <table width="100%" cellspacing="0" class="search-form">-->
            <tbody>
            <tr>
                <td><div class="explain-col">
                        <!--select name='catid'>
                                <option value='11'>索贝学院</option>
                                <option value='13'>课件库-中级</option>
                                <option value='14'>课件库-高级</option>
                            </select--> 视频名称  <input type="text" value="<?php echo isset($get['name'])?$get['name']:''?>" class="input-text" name="name">
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
        <?php foreach($infos['video'] as $r) {
            if($r['imagePath']=='') $r['imagePath'] = '/statics/js/vms/nopic.jpg';
            ?>
            <li>
                <div class="img-wrap">
                    <a href="javascript:;" vid="<?php echo $r['id']?>"
                       programlength="<?php echo $r['programLength']?>"
                       picp="<?php echo $r['imagePath']?>"
                       onclick="javascript:album_cancel(this,'<?php echo $r['id']?>','<?php echo $r['imagePath']?>')">
                        <div class="icon"></div>
                        <img src="<?php echo $r['imagePath']?>" vid="<?php echo $r['id'];?>" programlength="<?php echo $r['programLength']?>" path="<?php echo $r['imagePath'];?>" width="120" title="<?php echo $r['title']?>"/>
                    </a>
                    <?php echo $r['title'];?>
                </div>
            </li>
        <?php } ?>
    </ul>

    <div id="video-paths" class="hidden"></div>
    <div id="video-ids" class="hidden"></div>
    <div id="video-status-del" class="hidden"></div>
    <div id="video-name" class="hidden"></div>
    <div id="video-programlengths" class="hidden"></div>
</div>
<div style="clear:both;" id="pages" class="text-c"><?php echo $pages?></div>
<div ><span id="tijiao" style="display:none;">提交</span></div>
<script type="text/javascript">
    $(document).ready(function(){
        set_status_empty();
    });
    function set_status_empty(){
        $('#video-paths').html('');
        $('#video-ids').html('');
        $('#video-programlengths').html('');
        $('#video-name').html('');
    }
    function album_cancel(obj,id,source){
        $("#fsUploadProgress li div a").removeClass("on");
        $("#fsUploadProgress li div a").attr("id",'');
        var src = $(obj).children("img").attr("path");
        var vid = $(obj).children("img").attr("vid");
        var programlength = $(obj).children("img").attr("programlength");
        var filename = $(obj).children("img").attr("title");
        if($(obj).hasClass('on')){
            $(obj).removeClass("on");
            var imgstr = $("#video-paths").html();
            var length = $("a[class='on']").children("img").length;
            var strs = filenames = vids = '';
            $.get('index.php?m=video&c=video&a=swfupload_json_del&id='+id+'&src='+source+'&pc_hash=<?php //echo $_SESSION["pc_hash"] ?>');
            for(var i=0;i<length;i++){
                strs = '|'+$("a[class='on']").children("img").eq(i).attr('path');
                vids = '|'+$("a[class='on']").children("img").eq(i).attr('vid');
                programlengths = '|'+$("a[class='on']").children("img").eq(i).attr('programlength');
                filenames = '|'+$("a[class='on']").children("img").eq(i).attr('title');
            }
            $('#video-paths').html(strs);
            $('#video-ids').html(vids);
            $('#video-programlengths').html(programlengths);
            $('#video-name').html(filenames);
        } else {
            var num = $('#video-paths').html().split('|').length;
            $(obj).addClass("on");
            $(obj).attr("id","active-vms-on");
            $.get('index.php?m=video&c=video&a=swfupload_json&id='+id+'&src='+source+'&pc_hash=<?php //echo $_SESSION["pc_hash"] ?>');
            $('#video-paths').html(src);
            $('#video-ids').html(vid);
            $('#video-programlengths').html(programlength);
            $('#video-name').html(filename);
        }
    }

    function Selectd(type){
        var src = '';
        var vid = '';
        var filename = '';
        if (type==1) {
            $('.img-wrap a').each(function (){
                if (!$(this).hasClass('on')){
                    src = $(this).attr('picp');
                    vid = $(this).attr('vid');
                    programlength = $(this).attr('programlength');
                    filename = $(this).children("img").attr("title");
                    $(this).addClass("on");
                    $('#video-paths').append(src);
                    $('#video-programlengths').append(programlength);
                    $('#video-ids').append(vid);
                    $('#video-name').append(filename);
                }
            })
        } else if(type==0) {
            $('.img-wrap a').each(function (){
                if ($(this).hasClass('on')){
                    $(this).removeClass('on');
                }
            })
            $('#video-paths').html('');
            $('#video-ids').html('');
            $('#video-programlengths').html('');
            $('#video-name').html('');
        }
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
        var vid = $('#video-ids').html();
        var d = '';

        $.get('index.php', {m:'video', c:'video_for_ck', a:'get_vms_html', vid:vid}, function(data){
            if (data==1) {
                alert('视频地址错误！');
                d = false;
            } else {
                d = data;
            }
        });
        if(d !== false){
            this._.editor.insertHtml("<div class='vms-video' style='min-width:500px;min-height:250px;text-align:center;background:url("+'"'+$('#video-paths').html()+'"'+") no-repeat'>"+d+"</div>");

        }
        CKEDITOR.dialog.getCurrent().removeListener("ok", okListener);
    };
    CKEDITOR.dialog.getCurrent().on("ok", okListener);

    $('#tijiao').click(function(event) {

        var vidoid= $('#video-ids').html();
        var videoname=$('#video-name').html()
        var vlent=$('#video-programlengths').html()
        var img=$('#video-paths').html();
        if(vidoid==null  || vidoid==undefined || vidoid==''){
            alert('你没有选择');
        }else{

            var videotime=parent.document.getElementById("rightMain").contentWindow.document.getElementById("videotime");
            var thumb=parent.document.getElementById("rightMain").contentWindow.document.getElementById("thumb");
            var vname = parent.document.getElementById("rightMain").contentWindow.document.getElementById("videoname");
            var vid = parent.document.getElementById("rightMain").contentWindow.document.getElementById("vmsid");
            var disimg = parent.document.getElementById("rightMain").contentWindow.document.getElementById("thumb_preview");
            vid.value = vidoid;
            vname.value=videoname;
            videotime.value=vlent;
            thumb.value=img;
            disimg.src=img;
            window.top.art.dialog({id:'add'}).close();
            return true;
        }
    });
</script>




<?php
/*<link href="{CSS_PATH}video_store.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]><link href="{CSS_PATH}ielt9.css" rel="stylesheet" type="text/css" /><![endif]-->
<script type="text/javascript" src="{JS_PATH}/jquery.min.js"></script>
<script type="text/javascript" src="{JS_PATH}video/swfobject.js"></script>
<script type="text/javascript" src="{JS_PATH}video/swfobject2.js"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
var js4swf = {
    onInit: function(list){
        // 初始化时调用, 若 list.length > 0 代表有可续传文件
        // [{file}, {file}]
		if(list.length > 0) {
		    var length = list.length-1;
			$('#list_name').html("文件：《"+list[length].name+"》未上传完成，如需续传，请重新选择该文件");
		}
        this.showMessage('init', list);
    },
    onSelect: function(files){
        // 选中文件后调用, 返回文件列表
        // [{file}, {file}]
        this.showMessage('select', files);
    },
    onSid: function(evt){
        // 获得 sid 后返回, 更新 sid 用 (key, sid, name, type, size)
		if ($('#title').val()==''){
			$('#title').val(evt.name);
		}
		var ku6vid = evt.vid;
		$.get('index.php', {m:'video', c:'vid', a:'check', vid:ku6vid});
        this.showMessage('sid', evt);
    },
    onStart: function(){
        // 开始上传 (选择文件后自动开始)
        this.showMessage('start');
    },
    onCancel: function(){
        // 上传取消事件

        this.showMessage('cancel');
    },
    onProgress: function(evt){
        // 上传进度事件 (bytesLoaded, bytesTotal, speed) m=1 时没有这事件
        this.showMessage('progress', evt);
    },
    onComplete: function(evt){
        // 上传完成事件 (包含文件信息和完成后返回数据(data))
		$('#vid').val(evt.vid);
		var title = $('#title').val();
		var description = $('#description').val();
		var vid = $('#vid').val();
		$.get('index.php', {m:'video', c:'video_for_ck', a:'add_f_ckeditor', title:title, userupload:'1', description:description, vid:vid}, function(data){
			if (data==1) {
				alert('操作失败，您没有选择视频或者视频正在上传中...');
				return false;
			} else if(data==2) {
				alert('视频标题不能为空！');
				return false;
			} else if(data==3) {
				alert('视频上传出现错误，请重试！');
				return false;
			} else {
				$('#video_url').val(data);
			}
		});
        this.showMessage('complete', evt);

    },
    onWarn: function(evt){
        // 报错事件 (key, message)
        //this.showMessage('warn', evt);
		alert(evt.msg);
    },
    showMessage: function(){
        console.log(arguments);
    }
};
function checkform() {
	if($('#vid').val()=='0') {
		alert('您没有选择视频，或者视频正在上传中...');
		return false;
	}
	if($('#title').val()=='') {
		alert('请填写标题');
		$('#title').focus();
		return false;
	}
}
//-->
</SCRIPT>
<script type="text/javascript">
var flashvars = { m: "1", u: "{$flash_info['userid']}", ctime: "{$flash_info['passport_ctime']}", sig:"{$flash_info['passport_sig']}", c: "vms", t: "1", n: "js4swf", k: "190000" ,ms:"39",s: "8000000"};
var params = { allowScriptAccess: "always" , wmode: "transparent"};
var attributes = { };
swfobject.embedSWF("{$flash_info['flashurl']}", "ku6uploader", "450", "45", "10.0.0", null, flashvars, params, attributes);
</script>
<input type="hidden" name="video_url" id="video_url" value="">
<div class="m_box">
	<div class="clr h_box">
		<ul class="clr">
			<li><a href="#" title="#ct2" >上传视频</a></li>
			<li><a href="#" title="#ct1" class="ac">从视频库选择</a></li>
		</ul>
	</div>
    <div class="clr ct" id="ct1">
    	<div class="l">
        	<div class="r1">
           	  <form action="" method="get">
                	<label style="font-size: 12px;" title="本站上传视频">原创<input type="checkbox" id="userupload" name="userupload" title="本站上传视频"></label> <input name="title" id="title_s" type="text" class="s_ipt"/><input type="button" id="search" value="搜索" class="s_btn" onclick="get_videoes(1);"/>
                </form>
          </div>
        	<div class="r2">
            	<ul class="clr col3" id="ulic">
				{if !empty($infos)}
				{loop $infos $info}
                    <li><div class="w9"><a href="javascript:void(0);" title="{$info['title']}" data-vid="{$info['vid']}" onclick="a_click(this);"><span></span><img src="{if $info['picpath']}{$info['picpath']}{else}{IMG_PATH}admin_img/bfqicon1.jpg{/if}" width="90" height="51" /></a><p>{str_cut($info['title'], 18)}</p></div></li>
				{/loop}
				{else}
					&nbsp;&nbsp;&nbsp;&nbsp;视频库中没有您的视频，请先上传视频！
				{/if}
                </ul>
            </div>
        	<div class="r3">
            	<div class="ipages">
                	{$pages}
                </div>
            </div>
        </div>
    	<div class="r" id="video_view"><img src="{IMG_PATH}spyl.jpg" width="300" height="225" /></div>
    </div>
  <div class="clr ct ctc2" id="ct2">
    	<div class="r1">
		<form action="index.php?m=video&c=video_for_ck&a=add_f_ckeditor" onsubmit="return checkform()" id="myvideo" method="post">
			<input type="hidden" name="userupload" value="1">
        	<div class="content pad-6">
  <table width="100%" cellspacing="0" class="table_form frm_tb">
    <tbody>
      <tr>
        <th width="80" class="tbb"> 视频上传 </th>
        <td class="tbb">
          <div id="ku6uploader"></div><BR><span id="list_name" style="color:red"></span></td>
      </tr>
      <tr>
        <th width="80">标题 </th>
        <td><input type="text" name="title" size="40" value="" id="title"><span id="balance"><span></td>
      </tr>
      <tr>
        <th width="80"> 摘要 </th>
        <td><textarea name="description" id="description" style="width:98%;height:46px;"></textarea><input type="hidden" name="vid" id="vid" value="">
          </td>
      </tr>
    </tbody>
  </table>
</div>
</form>
        </div>
  </div>
</div>
{php $player_url = pc_base::load_config('ku6server', 'player_url');$video_setting = getcache('video', 'video');}
<script type="text/javascript">

function get_videoes(page) {
			var title = $('#title_s').val();
			var userupload = 0;
			if ($('#userupload').attr('checked')=='checked') {
				userupload = 1;
			}
			$.get('index.php', {m:'video', c:'video_for_ck', a:'search', title:title, page:page, userupload:userupload}, function(data){
				var obj = eval('(' + data + ')');
				$('.ipages').html(obj.pages);
				$('#ulic').html(obj.html);
			});
		}

var CKEDITOR = window.parent.CKEDITOR;

var okListener = function(event){
	var video_url = document.getElementById("video_url").value;
	if (video_url=='') {
	} else {
		video_url = $('#video_view').html();
		this._.editor.insertHtml(video_url);
		CKEDITOR.dialog.getCurrent().removeListener("ok", okListener);
	}
};
CKEDITOR.dialog.getCurrent().on("ok", okListener);

function set_video(vname) {
	document.getElementById("video_url").value = vname;
}
$.ajaxSetup({
    async : false
});
function a_click(obj) {
	var vid = $(obj).attr('data-vid');
	var vid_msg = '';
	var d = '';
	$.get('index.php', {m:'video', c:'video_for_ck', a:'check_vid', vid:vid}, function(data){
		if (data==1) {
			alert('视频地址错误！');
			vid_msg = false;
		} else {
			d = data;
			vid_msg = true;
		}
	});
	if (vid_msg) {
		$("#ulic div.w9 a").removeClass("ac");
		$(obj).addClass("ac");
		$('#video_url').val(vid);
		$('#video_view').html(d);
	}
}
$('#ct2').hide();
$('.h_box ul a').click(function(e){
	$('.h_box ul li a').removeClass('ac');
	$(this).addClass('ac');
	$('.ct').hide();
	$($(this).attr("title")).show();
});
</script>
*/ ?>