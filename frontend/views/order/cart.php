<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '购物车';
?>
<div class="site-index">

                            
 
	<form method="POST" action="<?=Url::to(['order/confirm'])?>">
	<input type="hidden" name="isCart" value="1">

        <table class="list-style" width="100%">
         <thead>
                        <tr>
                                <td style="width:100px;">&nbsp;</td>
                                <td>商品图片</td>
                                <td>商品信息</td>
                                <td>单价（属性）</td>
                                <td>数量</td>
                                <td>金额（元）</td>
                                <td style="width:100px;">操作</td>
                        </tr>
                </thead>
                   <tbody>
        <?php $i=0; foreach ($goods as $key => $value) { ?>
        <tr id="cart_goods_<?=$value['cartkey']?>">
            <td>
                <input type="checkbox" name="goods[<?=$i?>][goods_id]" value="<?=$value['goods_id']?>" checked>
            </td>
        	<td>
                <img src="<?=$value['goods_thumb']?>">
            </td>
        	<td>
                <p><?=$value['goods_name']?></p>
            </td>
        	<td class="list-style-num">
                <?php 
                if(!empty($value['goodsAttr'])){
                        foreach ($value['goodsAttr'] as $k => $vo) {
                            if($vo['num']>0){
                ?>
                        <p>
                            <input type="hidden" name="goods[<?=$i?>][attr][]" value="<?=$vo['uniquekey']?>"><?=$vo['name']?>： ￥<?=$vo['money']?>
                            <?php if($vo['inputtype']=='text'){ ?>
                                *<input maxNum="50" type="text" price="<?=$vo['money']?>" name="goods[<?=$i?>][<?=$vo['uniquekey']?>]" value="<?php echo $vo['num']>0 ? $vo['num'] : 1 ?>">
                            <?php }else{ ?>
                                <input type="hidden" price="<?=$vo['money']?>" name="goods[<?=$i?>][<?=$vo['uniquekey']?>]" value="<?php echo $vo['num']>0 ? $vo['num'] : 1 ?>">
                            <?php } ?>
                        </p>
                <?php
                       } }?>
                <?php
                }else{
                ?>
                        <p>￥<?=$value['money']; ?></p>
                <?php } ?>
            </td>
            <td class="list-style-num">
                <p> * <?php if($value['type']==1){ ?><input type="hidden" price="<?=$value['money']; ?>" name="goods[<?=$i?>][num]" value="1">1<?php }else{ ?><input maxNum="50" type="text" price="<?=$value['money']; ?>" name="goods[<?=$i?>][num]" value="<?=$value['num']?>"><?php } ?></p>
            </td>
        	<td>
                <em class="list-price">
                                1
                </em>
            </td>
            <td><a href="javascript:void(0)" onclick="delgoods(this)" cartkey="<?=$value['cartkey']?>">删除</a></td>
        </tr>
        <?php $i++;} ?>
            </tbody>
        </table>
        <div class="clearfix">
                <p class="list-sub-p">
                <input type="submit" name="提交">
                <span>
                总价：<em class="total-price"></em>
                </span>
        </p>
        </div>
        
        
	</form>
</div>
<script>
function delgoods(e){
    var cartkey = $(e).attr('cartkey');
    $.ajax({
        url: "<?=Url::to(['/site/order/cartdel'])?>",
        type: 'post',
        dataType: 'json',
        data: {
            'cartkey': cartkey
        },
        success: function(result){
            if(result.status==1){
                $('#cart_goods_'+cartkey).remove();
            }else{
                sobeyAlert(result.msg,function(){return;});
            }
        }
    });
}
$(function(){
        $("body").on("keyup",".list-style-num input[price]",function(){
                var objThis = $(this);

                var num = Math.abs(parseInt(objThis.val().replace(/[^1-9]/ig,"")));

                if(isNaN(num)){
                        objThis.val("1");
                       
                }else{
                        if(num > parseInt(objThis.attr("maxNum"))){
                                objThis.val(parseInt(objThis.attr("maxNum")));
                        }else{
                                objThis.val(num);                                
                        }
                        
                }
                console.log(objThis.parents("tr"));
                listPrice(objThis.parents("tr"));
        });
        $("body").on("change","input[type='checkbox']",function(){
                tatlePrice();
        })

        //初始化
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

                $(".list-style input[type='checkbox']:checked").each(function(i,obj){
                        var _price  = parseInt($(obj).parents("tr").find(".list-price").html());
                        price += _price;

                });
                $(".total-price").html(price);
        }

})

</script>