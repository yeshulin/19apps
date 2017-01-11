<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '联系我们';
$this->registerJsFile('@web/mlv/js/amazeui.min.js');    
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
$this->registerJsFile('@web/mlv/js/get-data.js', ['position'=>\yii\web\View::POS_HEAD]); 
?>
<style>
	body{
		background: #eee;
	}
	.contact-box .contact-item1{
		width: 580px;
		height: 235px;
		background-color: #ffffff;
		border-bottom: 1px solid #d0d0d0;
		float: left;
		padding: 0 22px;
		margin-bottom: 30px;
	}
	.contact-box .contact-item1 dt{
		    height: 65px;
    padding-top: 20px;
    font-weight: bold;
    font-size: 18px;
    color: #333333;
    border-bottom: 1px solid #eeeeee;
	}
	.contact-box .contact-item1 dt i{
		float: right;
		cursor: pointer;
	}
	.contact-box .contact-item1 dd{
		padding-left: 18px;
		padding-top: 20px;
	}
	.contact-box .contact-item1 dd p{
		font-size: 14px;
		color: #666666;
		margin-bottom: 15px;
	}
	.contact-box .contact-item1 dd p span{
		margin-right: 70px;
	}
	/*分割*/
	.contact-box .contact-item2{
		width: 380px;
		height: 220px;
		background-color: #ffffff;
		border-bottom: 1px solid #d0d0d0;
		float: left;
		padding: 0 22px;
		margin-left: 30px;;
		margin-bottom: 40px;
	}
	.contact-box .contact-item2 dt{
		    height: 54px;
    padding-top: 16px;
    font-weight: bold;
    font-size: 14px;
    color: #666666;
    border-bottom: 1px solid #eeeeee;
    padding-left: 9px;
	}
	.contact-box .contact-item2 dt i{
		float: right;
		cursor: pointer;
	}
	.contact-box .contact-item2 dd{
		padding-left: 9px;
		padding-top: 10px;
		padding-right: 12px;
	}
	.contact-box .contact-item2 dd p{
		font-size: 14px;
		color: #999999;		
		line-height: 24px;
	}	
	/*分割*/
	.map-icon1{
		display: block;
		width: 28px;
		height: 28px;
		background: url(<?=Url::to('@web/mlv/img/icon/map-icon.png', true)?>) no-repeat 0 0;
	}
	.map-icon2{
		display: block;
		width: 28px;
		height: 28px;
		background: url(<?=Url::to('@web/mlv/img/icon/map-icon.png', true)?>) no-repeat -28px 0;
	}
	.map-icon3{
		display: block;
		width: 28px;
		height: 28px;
		background: url(<?=Url::to('@web/mlv/img/icon/map-icon.png', true)?>) no-repeat -56px 0;
	}
	.map-icon3:hover{
		background-position: 0 0;
	}
	
	.map-mask{
		width:100%;
		height:100%;
		position:fixed;
		background:rgba(0,0,0,0.7);
		top:0;
		left:0;
		display:none;
		z-index: 1;
	}
	.map-content{
		width:1220px;
		height:420px;
		margin:0 auto;
		margin-top:200px;
		background:#fff;
	}
	.contact-box .contact-item1:nth-child(even){float:right;}

</style>
<div class="bread-crumbs">
            <div>
                <a href="#">首页</a>
                <span>&nbsp;&gt;&nbsp;</span>
                <span>联系我们</span>
            </div>
</div>
<script tag="contactus_list" id="cause_list" type="text/x-jsrender" class="render-model">
	<dl class="contact-item1">
		<dt>
			<i class="map-icon3 map-info"  data-map="{{:city}}"></i>
			<span>【{{:title}}】</span>
		</dt>
		<dd>
			<p>地址：{{:address}}</p>
			<p>邮编：{{:zipcode}}</p>
			<p>电话：{{:phone}}</p>
			<p>传真：{{:fax}}</p>
		</dd>
	</dl>
</script>

<div>
	<div class="inner">
		<div class="clearfix">
			<div class="contact-box clearfix" id="contactus">
				
			</div>
			<!--div style="margin-top: 70px;margin-bottom: 25px;">
				<h2 class="title-stl2">
				<span>广电销售中心</span>
				<i></i>
			</h2>	
				
			</div>
			
			<div class="contact-box clearfix" style="margin-left: -30px;">
				<dl class="contact-item2">
					<dt>
						<i class="map-icon3 map-info"   data-map="chengdu"></i>
						<span>【成都总部】</span>
					</dt>
					<dd>
						<p>地址：四川省成都市高新区新加坡工业园新元大道南二路2号</p>
						<p>邮编：150090</p>
						<p>电话：0451-55195719</p>
						<p>传真：0451-55195720</p>
					</dd>
				</dl>
				
			</div-->
		</div>
		
	</div>
</div>
<div class="map-mask">
    <div class="map-content">
    <iframe src="/mlv/map.html" width="1200" height="400" frameborder="0" scrolling="no" style="margin-left:5px;margin-top:5px;" id="iframe"></iframe>
    </div>
</div>
<script type="text/javascript">
var getDataObj = new getData();

function doData1(target){
	getDataObj.getContactus(function(result){
		var u_data = $.map(result.data,function(n){
			return n;
		});
		var template = $.templates("#cause_list");
		var htmlOutput = template.render(u_data);		
		target.html(htmlOutput);			
	});
}

	$(function(){
		doData1($("#contactus"));

		$("body").on("click",".map-info",function(){
					var content = urlPre + "/mlv/map/map" + $(this).data("map") + ".html";
					$("#iframe").attr("src",content);
					$(".map-mask").fadeIn();
				}
			);
			$(".map-mask").on("click",function(){
					$(".map-mask").fadeOut(
						function(){
							$("#iframe").attr("src","");
						}
					);
				}
			);
			$(".map-content").on("click",function(){
					return false;
				}
			);
	})
</script>
