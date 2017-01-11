$(function(){
	var member = new memberCommon();
	var acCode = window.location.search.split("?")[1];
	member.acEmail({
		 "code": acCode,
	},function(result){
		console.log(result);
		if(result.msg == "success"){
			$(".content[tag='email'] .am-tab-panel[data-tab-panel-2]>div").css("visibility","visible");
			$(".content[tag='email'] .am-tab-panel[data-tab-panel-2]>div").eq(0).show();
			$(".content[tag='email'] .am-tab-panel[data-tab-panel-2]>div").eq(1).hide();
		}
	});
})