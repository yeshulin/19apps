function memberCommon (){
    var objThis = this;
    var preSrc = urlPre;    
    //用户登录
    memberCommon.prototype.login = function(data,callback){
        var endSrc = "api/member/login";      
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json")
    };
    //用户注册
      memberCommon.prototype.regUser = function(data,callback){        
        var endSrc = "api/member/reg";  
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    
     //修改个人信息
      memberCommon.prototype.update = function(data,callback){        
        var endSrc = "api/member/update";  
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
	//上传头像
      memberCommon.prototype.uploadHead = function(data,callback){        
        var endSrc = "api/member/headimg";  
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //上传图片
    memberCommon.prototype.uploadImg = function(data,callback){
        var endSrc = "api/member/img";
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
     //用户退出
      memberCommon.prototype.logout = function(callback){        
        var endSrc = "api/member/logout";  
        var data = {};
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //修改个人密码
    memberCommon.prototype.pwd = function(data,callback){
        var endSrc = "api/member/reset-pwd";
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //找回个人密码
    memberCommon.prototype.getPwd = function(data,callback){
        var endSrc = "api/member/forget-pwd";
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
     //邮箱激活
    memberCommon.prototype.acEmail = function(data,callback){
        var endSrc = "api/member/active";      
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json")
    };
      //发送邮件
    memberCommon.prototype.sendEmail = function(data,callback){
        var endSrc = "api/sms/email";      
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json")
    };
    //发送短信验证码
    memberCommon.prototype.msgCode = function(num,isReg,callback){
        var endSrc = "api/sms/send";     
        var sdData = {
            "mobile": num,
            "isReg" : isReg
        }
        $.post(preSrc+endSrc,sdData,function(result){
             callback(result);
        },"json");
    };
    //短信验证码验证
    memberCommon.prototype.sCode = function(num,str,callback){
        var endSrc = "api/sms/yanzheng";     
        var sdData = {
            "mobile_verify": str,
            "mobile" : num
        }
        $.post(preSrc+endSrc,sdData,function(result){
             callback(result);
        },"json");
    };
    //图片验证码验证
    memberCommon.prototype.imgScode = function(str,callback){
        var endSrc = "api/member/yanzheng";     
        var sdData = {
              "verify_code": str
            }
        $.post(preSrc+endSrc,sdData,function(result){
             callback(result);
        },"json");
    };
    //正则匹配字符串
    memberCommon.prototype.ckStr = function(str,type){
        var regStr = {
            name : /^[0-9a-zA-Z]{4,16}$/,
            phone : /^1[3|4|5|7|8]\d{9}$/,
            email : /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
            password : /^[0-9_a-zA-Z]{6,20}$/,
            idcard15 : /^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/,
            idcard18 : /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/
        }
        if(eval("regStr."+type).test(str)){
            console.log(true);
            return true;

        }else{
            console.log(false);
            return false;
        }       
    };
    //验证用户名邮箱手机号是否存在
    memberCommon.prototype.ckEx = function(data,callback){        
        var endSrc = "api/member/validate";  
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //判断字符串是否不为空，返回true则不为空
    memberCommon.prototype.ckEpt = function(str){
        //通过为true
        if(str.trim() == ""){
            return false;
        }else{
            return true;
        }
    };
    //添加修改个人地址
    memberCommon.prototype.addressadd = function(data,callback){
        var endSrc = "api/address/create";
        //console.log(data);
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //添加修改个人地址
    memberCommon.prototype.addressedit = function(data,callback){
        var endSrc = "api/address/update";
        //console.log(data);
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //默认地址
    memberCommon.prototype.addressdefault = function(data,callback){
        var endSrc = "api/address/setdefault";
        //console.log(data);
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //删除个人地址
    memberCommon.prototype.addressdel = function(data,callback){
        var endSrc = "api/address/delete?id="+data.id;
        //console.log(data);
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //添加反馈
    memberCommon.prototype.feedbackadd = function(data,callback){
        var endSrc = "api/feedback/create";
        //console.log(data);
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //删除反馈
    memberCommon.prototype.feedbackdel = function(data,callback){
        var endSrc = "api/feedback/delete?id="+data.id;
        //console.log(data);
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //添加机构
    memberCommon.prototype.organAdd = function(data,callback){
        var endSrc = "api/organ/create";
        //console.log(data);
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //机构信息更改
    memberCommon.prototype.organEdit = function(data,callback){
        var endSrc = "api/organ/update";
        //console.log(data);
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };
    //激活码激活
    memberCommon.prototype.activation = function(data,callback){
        var endSrc = "api/grant/act";
        $.post(preSrc+endSrc,data,function(result){
            callback(result);
        },"json");
    };

   
}