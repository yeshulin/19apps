<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '确认订单';
$this->registerJsFile('@web/mlv/js/Area.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/AreaData_min.js', ['position' => \yii\web\View::POS_HEAD]);
?>
<div class="site-index">
	<form method="POST" action="<?=Url::to(['order/submit'])?>">
        <input type="hidden" name="remarks" value="<?=\Yii::$app->request->post('remarks')?>">
        <input type="hidden" name="isCart" value="<?=$isCart?>">
        <table class="list-style" width="100%">
         <thead>
                        <tr>                                
                                <td>商品图片</td>
                                <td>商品信息</td>
                                <td>单价（属性）</td>
                                <td>数量</td>
                                <td>金额（元）</td>                               
                        </tr>
                </thead>
                   <tbody>

        <?php $i=0;foreach ($goods as $key => $value) { ?>
        <tr>
        <td>
        	<input type="hidden" name="goods[<?=$i?>][goods_id]" value="<?=$value['goods_id']?>">
        	<img src="<?=$value['goods_thumb']?>">
                </td>
                <td>
        	<p><?=$value['goods_name']?></p>
                </td>
                <td>
        	<?php 
        	if(!empty($value['goodsAttr'])){
        		foreach ($value['goodsAttr'] as $k => $vo) {
                    if($vo['num']>0){
        	?>
        		<p>
                    <input type="hidden" name="goods[<?=$i?>][attr][]" value="<?=$vo['uniquekey']?>">
                    <input type="hidden" price="<?=$vo['money']?>" name="goods[<?=$i?>][<?=$vo['uniquekey']?>]" value="<?php echo $vo['num']>0 ? $vo['num'] : 1 ?>"> 
                    <?php if($vo['inputtype']=='text'){ echo $vo['num'].' '; } echo $vo['name']; if($value['selltype']==0){ echo ' * ￥'.$vo['money']; }?>
                </p>
        	<?php
        		}}?>
        	<?php
        	}else{
        	?>
        		<p><?php if ($value['selltype']==0){ echo '￥'.$value['money']; }?></p>
        	<?php } ?>
            <input type="hidden" price="<?=$value['money']; ?>" name="goods[<?=$i?>][num]" value="<?=$value['num']?>">
                </td>
                <td>
                    <p>* <?=$value['num']?></p>
                </td>
                <td>
                <?php if ($value['selltype']==0){ ?>
                 <em class="list-price">1</em>
                <?php }else { ?>
                 <em>后台议价</em>
                <?php } ?>
                </td>
                </tr>
        <?php $i++;} ?>
                </tbody>
        </table>
        <div class="clearfix">
                <p class="order-address">
                <span>
                        收获地址：
                </span>
                
                <select name="addressid">
                        <?php foreach ($address as $key => $value) { ?>
                            <option value="<?=$value['id']?>" contact="<?=$value['contact']?>" mobile="<?=$value['mobile']?>" address="<?=$value['address']?>" linkage="<?=$value['linkage']?>"></option>
                        <?php } ?>
                </select>
        </p>
        </div>
        <div class="clearfix">
                 <p class="list-sub-p">
                <input type="submit" name="提交">
                <span>
                <?php if ($selltype==0){ ?>总价：<em class="total-price"></em><?php } ?>
                </span>
        </p>
        </div>
        
	</form>
</div>
<script>
        $(function(){
                $("body .list-price").each(function(i,obj){
                        var parent = $(obj).parents("tr");
                        listPrice(parent);
                });

                function listPrice(objTr){
                        var _price = parseInt(objTr.find("input[price]").attr("price"));
                        var _num = parseInt(objTr.find("input[price]").val());
                        objTr.find(".list-price").html(_price*_num);
                        tatlePrice();
                }
                function tatlePrice(){
                        var price = 0;

                        $(".list-style .list-price").each(function(i,obj){
                                var _price  = parseInt($(obj).html());
                                price += _price;

                        });
                        $(".total-price").html(price);
                }
                $("select[name='addressid'] option").each(function() {
                    var _linkage = $(this).attr('linkage').split(",");
                    var area;
                    if (_linkage[2] != 0) {
                        area = getAreaNamebyID(_linkage[2]);
                    } else if (_linkage[1] != 0) {
                        area = getAreaNamebyID(_linkage[1]);
                    } else {
                        area = getAreaNamebyID(_linkage[0]);
                    }
                    var contact = $(this).attr('contact');
                    var mobile = $(this).attr('mobile');
                    var address = $(this).attr('address');
                    $(this).html(contact+"-"+mobile+"-"+area+" "+address);
                    
                });
        });
        function getAreaNamebyID(areaID) {
            var areaName = "";
            if (areaID.length == 2) {
                areaName = area_array[areaID];
            } else if (areaID.length == 4) {
                var index1 = areaID.substring(0, 2);
                areaName = area_array[index1] + " " + sub_array[index1][areaID];
            } else if (areaID.length == 6) {
                var index1 = areaID.substring(0, 2);
                var index2 = areaID.substring(0, 4);
                areaName = area_array[index1] + " " + sub_array[index1][index2] + " " + sub_arr[index2][areaID];
            }
            return areaName;
        }

</script>
