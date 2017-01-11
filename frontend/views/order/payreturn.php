<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '获取支付状态';

?>
<div class="site-index">
<style><!--
.spinner9 {
  margin: 100px auto 20px;
  width: 90px;
  height: 60px;
  text-align: center;
  font-size: 10px;
}

.spinner9 > div {
  background-color: #f60;
  height: 100%;
  width: 6px;
  display: inline-block;
  
  -webkit-animation: stretchdelay 1.2s infinite ease-in-out;
  animation: stretchdelay 1.2s infinite ease-in-out;
}

.spinner9 .rect2 {
  -webkit-animation-delay: -1.1s;
  animation-delay: -1.1s;
}

.spinner9 .rect3 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

.spinner9 .rect4 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}

.spinner9 .rect5 {
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}

@-webkit-keyframes stretchdelay {
  0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  
  20% { -webkit-transform: scaleY(1.0) }
}

@keyframes stretchdelay {
  0%, 40%, 100% { 
    transform: scaleY(0.4);
    -webkit-transform: scaleY(0.4);
  }  20% { 
    transform: scaleY(1.0);
    -webkit-transform: scaleY(1.0);
  }
}
--></style>
<div class="spinner9">
<div class="rect1">&nbsp;</div>
<div class="rect2">&nbsp;</div>
<div class="rect3">&nbsp;</div>
<div class="rect4">&nbsp;</div>
<div class="rect5">&nbsp;</div>
</div>
<p style="color: #999;text-align: center;    padding-bottom: 200px;">正在获取支付状态...</p>

</div>
<script>
var a;
var i;
function checkstatus(){
    $.ajax({
        url: "<?=$statusurl?>",
        contentType: 'application/json',
        type: 'post',
        dataType: 'json',
        data:  JSON.stringify({"trade_sn":"<?=$trade_sn?>"}),
        success: function(result){
            if(result.code=='0000'){
                if(result.data.code==0){
                    sobeyAlert('支付成功',function(){
                      window.location.href="<?=Url::to(['/user/order/list'])?>";
                    });
                    clearInterval(a);
                }
            }
        }
    });
    i++;
    if(i>10){
      clearInterval(a);
      sobeyAlert('获取订单支付状态失败',function(){
        window.location.href="<?=Url::to(['/user/order/list'])?>";
      });
    }
}
$(function(){
    i = 0;
    a = setInterval(checkstatus,3000);
});
</script>
