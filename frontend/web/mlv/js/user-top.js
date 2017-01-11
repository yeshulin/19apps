$(function(){
function initUserTop(){
		var userTop = {
			_head : $("#userTop-head"),
			_name : $("#userTop-name"),
			_balance : $("#userTop-balance"),
			_msg : $("#userTop-msg"),
			_disCou : $("#userTop-disCou"),
			_care : $("#userTop-care"),
			_fans : $("#userTop-fans")
		}	
		//设置用户名
		if(userInfo.nickname){
			userTop._name.html(userInfo.nickname);
		}else{
			userTop._name.html(userInfo.username);
		}
		//设置头像
		if(userInfo.headimg){
			//urlPre + 
			userTop._head[0].src = userInfo.headimg;
		}else{			
			userTop._head[0].src = urlPre + "mlv/img/temp/head.jpg";
		}

	}
	//用户中心头部初始化
	initUserTop();
})