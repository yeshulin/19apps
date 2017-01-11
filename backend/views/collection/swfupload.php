<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta charset="utf-8">
    <title>视频上传</title>
    <link href="/phpcms/templates/default/video/styles/style.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="/phpcms/templates/default/video/scripts/jquery1.8.2.js"></script>
    <script type="text/javascript" src="/phpcms/templates/default/video/scripts/main.js"></script>
    <script type="text/javascript" src="/phpcms/templates/default/video/swfobject.js"></script>
    <link rel="stylesheet" href="/phpcms/templates/default/video/styles/video_upload.css">
    <script type="text/javascript">


        function getRequestParams(){
            var _url = window.location.search,

                reg = new RegExp("((\\w+?)(\\s*=\\s*)(.*?)(?:&))", "g"),
                result = "",
                map = {},
                requestUrl = [];
            while ((result = reg.exec(_url)) != null)
            {
                map[result[2]] = result[4];
            }
            requestUrl.push(map['host']+"?");
            requestUrl.push('method=getCatalogAndTranscode&');
            requestUrl.push('siteId={$vms_siteid}');
            requestUrl.push('catalogIds='+<?=$catid?>+'&');
            requestUrl.push('isPublish='+map['isPublish']);
            return requestUrl.join("");
        }


        function getRequestServer(){
            var _url = window.location.search,
                reg = new RegExp("((\\w+?)(\\s*=\\s*)(.*?)(?:&))", "g"),
                result = "",
                map = {};
            while ((result = reg.exec(_url)) != null)
            {
                map[result[2]] = result[4];
            }
            return map['server'];
        }

        function getRequestSiteId(){
            var _url = window.location.search,
                reg = new RegExp("((\\w+?)(\\s*=\\s*)(.*?)(?:&))", "g"),
                result = "",
                map = {};
            while ((result = reg.exec(_url)) != null)
            {
                map[result[2]] = result[4];
            }
            return map['siteId'];
        }
        function getRequestIsPublish(){
            var _url = window.location.search,
                reg = new RegExp("((\\w+?)(\\s*=\\s*)(.*?)(?:&))", "g"),
                result = "",
                map = {};
            while ((result = reg.exec(_url)) != null)
            {
                map[result[2]] = result[4];
            }
            return map['isPublish'];
        }


        //上传插件的初始化配置参数
        var swfVersionStr = "11.1.0";
        var xiSwfUrlStr = "";
        var flashvars = {};
        flashvars.fileType="*.wmv;*.mp4;*.rmvb;*.avi;";
        // flashvars.fileType="*.wmv;*.flv;*.mp4;*.rmvb;*.rm;*.avi;*.3gp;*.mpeg;*.mp3;";
        flashvars.fileDescription="音频视频文件(*.wmv;*.flv;*.mp4;*.rmvb;*.rm;*.avi;*.3gp;*.mpeg;*.mp3;*m2t)";
        flashvars.server=getRequestServer();
        flashvars.alphaTest=0;//当前按钮的alpha值
        flashvars.buttonMode=true;//是否显示手型

        flashvars.fileProgressFun="onFileProgressChangge";//配置上传进度回调方法
        flashvars.addFileFun="onFileListChange";//配置添加文件回调方法
        flashvars.uploadErrorFun="onUploadError";//配置上传错误回调方法
        flashvars.stateChanggeFun="onStateChange";//配置上传状态改变方法

        var params = {};
        params.quality = "high";
        params.bgcolor = "#ebf4ff";
        params.wmode="transparent"
        params.allowscriptaccess = "sameDomain";
        params.allowfullscreen = "true";
        var attributes = {};
        attributes.id = "Uploader";
        attributes.name = "Uploader";
        attributes.align = "middle";
        swfobject.embedSWF(
            "/phpcms/templates/default/video/Uploader.swf", "flashContent",
            "190", "45",
            swfVersionStr, xiSwfUrlStr,
            flashvars, params, attributes);

        //视频上传需要用到的方法
        //定时控制id
        var intervalId;
        var uploadStatus = 1;
        //队列添加完毕,开始上传
        function StartUploadClicked(data)
        {
            //对上传视频的非空判断
            var obj = document.getElementById("Uploader").getFileList();
            if (obj == '[]') {
                alert("您尚未选择需要上传的视频文件");
                return;
            }
            var json = strToJson(obj);
            var reg = new RegExp('.MP4|.WMV|.AVI|.RMVB');
            var ext = json[0].fileType.toUpperCase();
            if(!reg.test(ext)){
                alert("请上传正确的视频文件");
                CancelUpload(json[0].id);
                return;
            }
            //if(json.fileType)
            //基本信息
            var transceodeGroup = 1; //$("#trascodeSelect a").text();
            var catalogId = <?=$catid?>;// $("#catalogSelect a").text();

            var siteid = {$vms_siteid}; //"2" //;
            var isPublish = 1;
            var type = "video";
            var datatype = 0;//0,表示只填入一个数据,所有上传都传递这一个数据 1,标识填入上传长度个数据,每个上传对应一个数据

            var data = '[';

            //console.log(json);
            for (var i = 0 ,j = json.length; i < j ;i++) {
                data += '{"transcodeGroup":'+ transceodeGroup +',"catalogId":'+ catalogId+',"tags":"'+ json[i].fileName+'","title":"'+ json[i].fileName +'","description":"'+ json[i].fileName +'","id":"'+ json[i].id +'"},';
            }
            if (data.length > 1){
                data = data.substr(0,data.length-1);
            }
            data += ']';
            // console.log(siteid);
            // console.log(type);
            // console.log(datatype);
            // console.log(data);
            // console.log(isPublish);
            document.getElementById("Uploader").startUpload(siteid,type,datatype,data,isPublish);
        }

        //清空上传列表
        function removefileList()
        {
            document.getElementById("Uploader").removeFileList();
            var obj = document.getElementById("Uploader").getFileList();
            //console.log("当前列表数据:"+obj);
            $('#loadingList1').html("<div>" + '已取消视频上传' + "<div>");
        }

        //分别取消每个文件的上传 ---传入id
        function CancelUpload(cancelId)
        {
            var obj = document.getElementById("Uploader").getFileList();
            if(obj != [])
            {
                //var b =JSON.parse(obj);
                //   console.log("取消上传的id为:"+cancelId);
                document.getElementById("Uploader").cancelUpload(cancelId);
                var objj = document.getElementById("Uploader").getFileList();
                // console.log("当前列表数据:"+objj);
                //将选择的视频插入到列表中
                //setUploadListToDiv(ob);
                //将每个取消的视频隐藏掉
                $('#' + cancelId).hide();
                document.getElementById("btns").style.visibility = "visible";
            }
        }

        //取得上传列表的数据,内部调用,传入当前的列表
        function GetcurrentfileList()
        {
            var obj = document.getElementById("Uploader").getFileList();
        }

        //取得当前上传文件的进度 需要点击上传后才能生效(不支持断点续传,一个文件一个文件的上传)
        function onFileProgressChangge(obj)
        {
            setUploadProgress(obj);
        }

        //添加文件,添加完成事件
        function onFileListChange()
        {

            var obj = document.getElementById("Uploader").getFileList();
            // console.log("当前列表数据:"+obj);
            //将选择的视频插入到列表中
            setUploadListToDiv(obj);
            document.getElementById("btns").style.visibility = "hidden";
        }
        //获取上传的视频的列表
        function setUploadListToDiv(obj){
            var json = strToJson(obj);
            var fileListHtml = "";

            for (var i = 0 ,j = json.length; i < j;i++) {
                var sizeValue = json[i].size/1024/1024;
                var size = sizeValue.toFixed(2);
                fileListHtml += '<div class="loadingList1" id="'+ json[i].id +'">';
                fileListHtml += 	'<span class="name">'+json[i].fileName+'</span>';
                fileListHtml +=		'<div class="loadingUtils1">';
                fileListHtml += 		'<div class="loadingView1">';
                fileListHtml += 			'<div class="v1">';
                fileListHtml += 				'<div id="completeWidth" class="v1_complete" style="width:0%;"></div>';
                fileListHtml += 			'</div>';
                fileListHtml +=  			'<div class="v_num" id="complete">0%</div>';
                fileListHtml +=  			'<div class="v_oper">';
                fileListHtml +=  				'<a href="#" class="dele" onclick="CancelUpload(\''+ json[i].id +'\')">取消上传</a>';
                fileListHtml +=  			'</div>';
                fileListHtml +=  		'</div>';
                fileListHtml +=  		'<ul>';
                fileListHtml +=  			'<li class="p1">上传速度：0KB/s</li>';
                fileListHtml +=  			'<li class="p2">已上传：12MB/'+ size +'MB</li>';
                fileListHtml +=  			'<li class="p3">剩余时间：</li>';
                fileListHtml +=  		'</ul>';
                fileListHtml +=  		'<div style="display:none;">' + size;
                fileListHtml +=  		'</div>';
                fileListHtml +=  	'</div>';
                fileListHtml +=  '</div>';
            }
            $('#showFileList').html(fileListHtml);
        }
        //设置进度条的渐变样式
        function setUploadProgress(obj){
            var perId = obj.id;
            var size = obj.size;
            var sizeTrans = (size/1024/1024).toFixed(2);
            var uploadedBytes = obj.uploadedBytes;
            var uploadedBytesTrans = (uploadedBytes/1024/1024).toFixed(2);
            var instantSpeed = obj.instantSpeed;
            var timeLeft = obj.timeLeft;
            var timeM = Math.round(timeLeft/60);
            var timeS = timeLeft%60;
            var progress = Math.round((uploadedBytes/size)*100);
            //设置上传进度
            $("#"+ perId).find("#completeWidth").attr("style","width:"+ progress +"%");
            $("#"+ perId).find("#complete").text("" + progress + "%");
            $("#"+ perId +" li").first().text("上传速度：" + instantSpeed + "/s");
            $("#"+ perId +" li").eq(1).text("已上传" + uploadedBytesTrans + "MB/" + sizeTrans + "MB");
            $("#"+ perId +" li").last().text("剩余时间：" + timeM + "分" + timeS + "秒" );
        }

        //当前状态改变触发
        function onStateChange(id,type,data)
        {
            //	console.log("id值为:"+id+",Type为:"+type+",返回数据:"+data);
            var s = "状态改变,id值为:"+id+",Type为:"+type+",返回数据:"+data;
            if(type=="Completed")
            {
                var ss = "上传"+id+"完毕返回数据为:backUploadUrl:"+data.backUploadUrl+",fileName:"+data.fileName + " ,id:"+data.id + ",status:"+ data.status;
                //alert(ss)
                //将取消上传隐藏掉，改为上传成功
                $("#"+ id).find(".v_oper").html('<span href="#" class="ok">上传成功！</span>');
                //成功后关闭dialog窗口
//                console.log(data);
//                console.log(window.parent.$("input[name='<?=$_GET['textareaid']?>']"));
                window.parent.$("input[name='<?=$_GET['textareaid']?>']").val(data.id);
                window.parent.objArt.close();

            }
        }

        //如果上传失败报错
        function onUploadError(id,data)
        {
            var s = "id:"+data.id+",信息:"+data.des;
            $("#"+ id).find(".v_oper").html('<span href="#" class="fail">上传失败</span>');
        }
        function cancelbtnhandle()
        {
            window.close();
        }

    </script>
</head>

<body>
<div class="video_upload">
    <div class="select_file">
        <div id="showFileList" class="file_sele_list">
        </div>
        <div id="btns" class="file_btn">
            <div class="flashContent"><div id="flashContent"></div></div>
            <input type="button" />
        </div>
    </div>


    <div class="opr_btn">
        <a href="#" class="ok" onclick="StartUploadClicked();">保存</a>
        <a href="#" class="cancel" onclick=" window.parent.objArt.close();">取消</a>
    </div>
</div>
</body>
<script type="text/javascript">
    $(".select").each(function(){
        $(this).selectCopy();
    });



    //非空提示的样式控制
    $(".opr_panel").find("input,textarea").focus(function(){
        $(this).parent(".c2").removeClass("inp_error");
    });

    var transcode = "";
    var catalog = "";
    var data =getRequestParams();
    //根据获取的json数据拼接转码组的下拉选项
    function setTranscodeSelect(tra){
        var htmlLi="";
        var defaultTranscode = "";
        var defaultTranscodeId = null;
        if (tra.length <= 0) {
            alert("没有获取到转码组");
            return;
        }else{
            defaultTranscode = tra[0].name;
            defaultTranscodeId = tra[0].id;
            changeTrascodeImage(tra[0].id);
            for (var i = 0,j = tra.length ;i<j;i++) {
                var trascodeId = tra[i].id;
                var trascodeName= tra[i].name;
                htmlLi += "<li value=\"" + trascodeId + "\">" + trascodeName + "</li>";
            }

            //设置默认转码组
            var catalogDefault = $("#trascodeSelect a");
            catalogDefault.html(defaultTranscode);
            catalogDefault.attr("name",defaultTranscodeId);
            //将转码组<li>标签嵌入页面
            var traUl = $("#trascodeSelect ul");
            traUl.html(htmlLi);
        }
    }
    //根据获取的json数据拼接栏目的下拉选项
    function setCatalogSelect(catalog){
        var htmlLi = "";
        var defaultCatalog = "";
        var defaultCatalogId = null;
        if (catalog.length <= 0) {
            alert("没有获取到栏目")
            return;
        }else{
            defaultCatalog = catalog[0].name;
            defaultCatalogId = catalog[0].id;
            for (var i = 0,j = catalog.length ;i<j;i++) {
                var catalogId = catalog[i].id;
                var catalogName= catalog[i].name;
                htmlLi += "<li value=\"" + catalogId + "\">" + catalogName + "</li>";
                //获取默认栏目
            }
            //设置默认栏目
            var catalogDefault = $("#catalogSelect a");
            catalogDefault.html(defaultCatalog);
            catalogDefault.attr("name",defaultCatalogId);
            //将<li>标签嵌入页面
            var catalogUl = $("#catalogSelect ul");
            catalogUl.html(htmlLi);
        }
    }
    //选择码率的同时切换图片
    $("#trascodeSelect ul").find("li").live("click",function(){
        var traId = $(this).val();
        changeTrascodeImage(traId);
    });
    //根据码率id切换显示码率的图片
    function changeTrascodeImage(id){
        //var imageIds = new Array();
        var htmlImg = "";
        for (var i = 0,j = transcode.length ;i<j;i++) {
            var trascodeId = transcode[i].id;
            if (trascodeId == id) {
                var codes = transcode[i].codes;
                for (var m = codes.length - 1; m >= 0 ;m--) {
                    var imageId = codes[m].id;
                    var alias = codes[m].alias;
                    htmlImg += "<li>" + alias + "</li>";
                    $(".malv_panel").html(htmlImg);
                }
                return;
            }
        }
    }

    //将字符串转换为json对象
    function strToJson(str){
        return JSON.parse(str);
    }

</script>
</html>