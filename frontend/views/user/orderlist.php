  <?php
    use yii\helpers\url;
    ?>
 <?php
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');    
    $this->registerCssFile('@web/mlv/css/amazeui.min.css');
 ?>
 
 
 <script tag="cause_list" id="cause_list" type="text/x-jsrender" class="render-model">
 	<tr>
			<td><a href="/user/order/view?trade_sn={{:trade_sn}}">{{:trade_sn}}</a></td>
			<td>{{for goods}}
				    <p>
				    {{if goods_info.type==1}}
				    	<a href="<?=Url::to(['/site/goods'])?>?id={{:goods_info.goods_id}}" target="_blank">{{:goods_info.goods_name}}</a>
				    {{else}}
				    	{{:goods_info.goods_name}}
				    {{/if}}
				    {{if goods_info.attrs}}
				    	&nbsp;
					    ({{for goods_info.attrs}}
					    	{{if inputtype=='text'}} {{:num}} {{/if}} {{:name}}&nbsp;
					    {{/for}})
				    {{/if}}
				    * {{:num}}
				    </p>
				{{/for}}</td>
			<td>¥{{:price}}</td>
			<td>
				{{if status == 'unpay'}}
						{{if type == 0}}
							等待付款
							{{else}}
							议价订单
						{{/if}}
					{{/if}}
				{{if status == 'success'}}订单完成{{/if}}
				{{if status == 'cancel'}}订单已取消{{/if}}
				{{if status == 'del'}}订单已被删除{{/if}}
				{{if status == 'timeout'}}订单超时{{/if}}
			</td>
			<td>
				{{if status == 'unpay'}}
				{{if type==0}}<a href="/site/order/pay?trade_sn={{:trade_sn}}">立即付款</a>{{/if}}  <a href="/user/order/cancel?trade_sn={{:trade_sn}}">取消订单</a>
				{{/if}}
			</td>
		</tr> 	
 </script>
<div class="user-content">
	<div class="user-main-box">
		<div class="am-tabs">			
			<ul class="am-tabs-nav am-nav am-nav-tabs">					
				<div class="l">我的订单</div>
			</ul>					 
		  <div class="am-tabs-bd">
		    <table class="list-style" style="width: 100%;">
		    	<thead>
		    		<tr>
		    			<td>订单号</td>
		    			<td>商品</td>
		    			<td>总价</td>
		    			<td>订单状态</td>
		    			<td>操作</td>
		    		</tr>
		    	</thead>
		    	<tbody  id="user-myOrder">
		    			
		    	</tbody>
		    </table>
		  </div>
		  <div class="text-center" style="padding: 30px 0" id="page"></div>
		</div>
	</div>
</div>
<script>
var rendDataObj = new renderData(); 
var getDataObj = new getData();

	function doData1(pagesize,current,target,pageObj){
			getDataObj.getMyorder(pagesize,current,function(result){
				var u_data = $.map(result.data.data,function(n){
					return n;
				});
				var template = $.templates("#cause_list");
				var htmlOutput = template.render(u_data);		
				target.html(htmlOutput);
				if(pageObj){
						var _pageObj = $.extend(pageObj,{
							currentPage:result.data.currentPage,
							pageSize:result.data.pageSize,
							total:result.data.total,
							dataTarget : target
						});
						rendDataObj.renderPageModel(_pageObj);	
					}
				
			});
	}

$(function(){
	doData1(10,1,$("#user-myOrder"),{
		page_target : "#page",
		page_btFn : "doData1"
	});
});

</script>