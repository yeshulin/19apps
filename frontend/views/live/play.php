<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '视频播放';
?>
<?php
    $this->registerJsFile('@web/mlv/js/jquery-1.9.1.min.js',['position'=>\yii\web\View::POS_HEAD]);  
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');    
    $this->registerJsFile('@web/mlv/js/jsrender.min.js',['position'=>\yii\web\View::POS_HEAD]);	
    $this->registerJsFile('@web/SobyePlayer/history/history.js',['position'=>\yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/SobyePlayer/swfobject.js',['position'=>\yii\web\View::POS_HEAD]);
   	
        // $this->registerJsFile('@web/mlv/js/SobyePlayer/play.js',['position'=>\yii\web\View::POS_HEAD]);	
            // $this->registerJsFile('@web/mlv/js/SobyePlayer/play2.js',['position'=>\yii\web\View::POS_HEAD]);	
    $this->registerCssFile('@web/mlv/css/amazeui.min.css'); 
    $this->registerCssFile('@web/mlv/css/css.css');
	$this->registerCssFile('@web/mlv/css/head.css');
    ?>

    <script>
        var userInfo = <?php echo Yii::$app->user->identity?json_encode(Yii::$app->user->identity->toArray()):"null"?>;
        var urlPre = "<?=Url::to('@web/', true)?>";
    </script>
<div id="videoBox">

</div>
<?php
$user = \Yii::$app->user->identity;
if($user){
	$userid = $user['id'];
	$username = $user['username'];
	$uimg = $user['headimg'];
}else{
	$arr[]=rand(100,10);
  	$arr=array_unique($arr);
	$userid = uniqid();
	$username = '用户'.time().rand(10,100);
	$uimg = urlencode(\Yii::$app->params['staticUrl'].'mlv/img/member/nophoto.gif');
}
?>
<!-- <iframe id="iframe_real" scrolling="no" src="http://chat.hqyunjiao.com:55151?room_id=2<?=$data['roomId']?>&userid=<?=$userid?>&username=<?=$username?>&uimg=<?=$uimg?>" width="280" height="420" frameborder="0"></iframe> -->
<style>
	body{
		padding-top: 0 !important;
	}
	.pc-video-text{
		padding: 40px 0 70px 0
	}
</style>
<script type="text/javascript">
$(function(){
	var _iframe_src = "http://chat.hqyunjiao.com:55151?room_id=2<?=$data['roomId']?>&userid=<?=$userid?>&username=<?=$username?>&uimg=<?=$uimg?>";

	browserRedirect();
	

	function browserRedirect() {
	            var sUserAgent = navigator.userAgent.toLowerCase();
	            var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
	            var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
	            var bIsMidp = sUserAgent.match(/midp/i) == "midp";
	            var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
	            var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
	            var bIsAndroid = sUserAgent.match(/android/i) == "android";
	            var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
	            var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
	            var bIsWX = sUserAgent.match(/MicroMessenger/i) == "micromessenger";
	            var bIsMB = sUserAgent.match(/mobile/i) == "mobile";
	            if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM || bIsWX || bIsMB) {
	            	$(".footer").hide();  
	            	renderPhone();  
	            	return "phone";     

	            	    
	            } else {
	            	renderPc();
	            	return "pc";
	            	
	            }
	        }

	     

	        function renderPc(){
	        	var renderData = [{}];
	        	var _model = $(document.createElement("script"));
				var _src = urlPre + "/mlv/js/model/video_content.html";
				_model.attr("tag","pc");
				_model.attr("id","pc");
				// _model.attr("src",_src);
				_model.attr("type","text/x-jsrender");
				_model.addClass("render-model");				
				// $.get(_src,function(data){
				// 	console.log(data);
				// });
				$.ajax({
					async:true,
					url:_src,
					dataType : "html",
					success:function(_html){			

						//请求数据并且组装
						var roomId = parseInt(window.location.search.split("=")[1]);
						var data = JSON.stringify({
							"roomId": roomId,
    						"sessionid":0
						})
						$.post(urlPre + "/api/live/roomshow",data,function(data){
							 //console.log(data.data);
							
							if(!!data.data){
								renderData = [{
								"roomName" : data.data.roomName,
								"ownerName" : data.data.ownerName,
								"videourl":"<?=$data['outStreamUrl']['flv']?>",
								"room_notice" : data.data.room_notice?data.data.room_notice:"华栖云教，是成都华栖云科技有限公司的核心业务，承担着面向教育行业进行媒体混合云服务的业务拓展，提供云端教学、实训、直播等云服务的核心任务，通过在线课程、技能培训、专业认证、教育直播、云端实验室、企业实训、云校园综合解决方案等多种产品，为教育机构和从业人员，提供无处不在、随时可用的专业云服务",
								"head_img" : data.data.head_img?data.data.head_img:"暂无头像",
								"iframeSrc" : _iframe_src,
								"hasData": true							
								}];
								// console.log(1);
								_model.html($(_html).find("#pc")[0]);
								$("head").append(_model[0]);	
								var template = $.templates("#pc");
								var htmlOutput = template.render(renderData);		
								$("#videoBox").html(htmlOutput);	
							
							}else{
								renderData = [{
								"roomName" : "暂无房间",
								"ownerName" : "暂无作者",
								"videourl":"null",
								"room_notice":"华栖云教，是成都华栖云科技有限公司的核心业务，承担着面向教育行业进行媒体混合云服务的业务拓展，提供云端教学、实训、直播等云服务的核心任务，通过在线课程、技能培训、专业认证、教育直播、云端实验室、企业实训、云校园综合解决方案等多种产品，为教育机构和从业人员，提供无处不在、随时可用的专业云服务",
								"head_img" : "暂无头像"	,
								"iframeSrc" : _iframe_src,
								"hasData": false					
								}];
								// console.log(1);
								_model.html($(_html).find("#pc")[0]);
								$("head").append(_model[0]);	
								var template = $.templates("#pc");
								var htmlOutput = template.render(renderData);		
								$("#videoBox").html(htmlOutput);
							}
							

							// console.log(2);
						});

									
					},
					error:function(result){
						// console.log(2);
						// console.log(result);
					}
				});


	        }

	        function renderPhone(){
	        	var data = [{}];
	        	var _model = $(document.createElement("script"));
				var _src = urlPre + "/mlv/js/model/video_content.html";
				_model.attr("tag","phone");
				_model.attr("id","phone");
				// _model.attr("src",_src);
				_model.attr("type","text/x-jsrender");
				_model.addClass("render-model");				
				// $.get(_src,function(data){
				// 	console.log(data);
				// });
				$.ajax({
					async:true,
					url:_src,
					dataType : "html",
					success:function(_html){					
						
						//请求数据并且组装
						var roomId = parseInt(window.location.search.split("=")[1]);
						var data = JSON.stringify({
							"roomId": roomId,
    						"sessionid":0
						})
						$.post(urlPre + "/api/live/roomshow",data,function(data){
							// console.log(data);
							if(!!data.data){
								renderData = [{
								"roomName" : data.data.roomName,
								"ownerName" : data.data.ownerName,
								"videourl":"<?=$data['outStreamUrl']['m3u8']?>",
								"room_notice" : data.data.room_notice?data.data.room_notice:"华栖云教，是成都华栖云科技有限公司的核心业务，承担着面向教育行业进行媒体混合云服务的业务拓展，提供云端教学、实训、直播等云服务的核心任务，通过在线课程、技能培训、专业认证、教育直播、云端实验室、企业实训、云校园综合解决方案等多种产品，为教育机构和从业人员，提供无处不在、随时可用的专业云服务",
								"head_img" : data.data.head_img?data.data.head_img:urlPre+"/mlv/img/temp/head.jpg",
								"iframeSrc" : _iframe_src,
								"hasData": true	 							
							}];
							// console.log(1);
							_model.html($(_html).find("#phone")[0]);
							$("head").append(_model[0]);	
							var template = $.templates("#phone");
							var htmlOutput = template.render(renderData);		
							$("#videoBox").html(htmlOutput);	
							// console.log(2);
							}else{
								renderData = [{
								"roomName" : "暂无房间",
								"ownerName" : "暂无作者",
								"videourl":"null",
								"room_notice":"华栖云教，是成都华栖云科技有限公司的核心业务，承担着面向教育行业进行媒体混合云服务的业务拓展，提供云端教学、实训、直播等云服务的核心任务，通过在线课程、技能培训、专业认证、教育直播、云端实验室、企业实训、云校园综合解决方案等多种产品，为教育机构和从业人员，提供无处不在、随时可用的专业云服务",
								"head_img" : "暂无头像"	,
								"iframeSrc" : _iframe_src,
								"hasData": false					
								}];
								// console.log(1);
								_model.html($(_html).find("#phone")[0]);
								$("head").append(_model[0]);	
								var template = $.templates("#phone");
								var htmlOutput = template.render(renderData);		
								$("#videoBox").html(htmlOutput);	
							}
							
							

						});			
					},
					error:function(result){
						// console.log(2);
						// console.log(result);
					}
				});
	        }

})
        
    </script>