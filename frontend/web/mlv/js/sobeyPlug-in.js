function sobeyAlert(str,callback){
	var _htmlObj = "";	
	_htmlObj += '<div class="sobey-alert">';
	_htmlObj += '<div class="sobey-alert-wrap">';
	_htmlObj += '<div class="sobey-alert-box">';	
	_htmlObj += '<div>';
	_htmlObj += '<i></i>';
	_htmlObj += '<h2>'+ str +'</h2>';
	_htmlObj += '<p></p>';
	_htmlObj += '<button>确定</button>';
	_htmlObj += '</div></div></div></div>';	
	$("body").append(_htmlObj);
	$(".sobey-alert button").one("click",function(){
		close_sobeyAlert();
		if(!!callback){
			callback();	
		}
		
	});
}
function close_sobeyAlert(){
	$(".sobey-alert").remove();
}
