$(document).ready(function(){  
	//手机扫描登录
  // $("#loginimg").click(function(){  
  // 	$("#login").css('display','none');
  // 	$("#erm").css('display','block');
  // });  
  
  //  $("#ermimg").click(function(){  
  // 	$("#login").css('display','block');
  // 	$("#erm").css('display','none');
  // }); 

  var member = new memberCommon();

  $("#login-bt").on("click",function(){
  	var _data = 
  		{
		  "LoginForm": {
		    "password": $("#f-user-psw").val(),
		    "loginname": $("#f-user-name").val()
		  }
		}
		if(member.ckEpt(_data.LoginForm.loginname) && member.ckEpt(_data.LoginForm.password)){
				member.login(_data,function(result){
  			//// console.log(result);
  			if(result.msg == "success"){
          			window.location.reload();
  			}else{
				sobeyAlert("用户名或密码错误！");
  			}
  			});
		}else{
			sobeyAlert("用户名或密码不能为空！");
		}

  });

  $('#doc-prompt-toggle').on('click', function() {
    $('#my-prompt').modal({
      relatedTarget: this,
      closeOnConfirm:false,
      onConfirm: function(e) {
        
        // alert('你输入的是：' + e.data || '')
        if(member.ckStr(e.data,"phone")){

            member.ckEx({"type": "mobile","mobile": e.data},function(mb_result){
              var _E=e;
                if(mb_result.msg == "success"){
                   $(".my-prompt-alert").html("此手机不存在！");
                }else{
                    member.msgCode(e.data,1,function(msg_result){
                      if(msg_result.msg=="success"){
                           $('#my-prompt').modal("close");
                           $('#my-prompt2').modal({
                              relatedTarget: this,
                              closeOnConfirm:false,
                              onConfirm: function(e) {                  
                                // alert('你输入的是：' + e.data || '')

                                if(!member.ckEpt(e.data[1])){
                                  $(".my-prompt-alert2").html("密码不能为空！");
                                  return;
                                }else if(!member.ckStr(e.data[1],"password")){
                                  $(".my-prompt-alert2").html("密码格式错误！");
                                  return;
                                }else if(e.data[1] != e.data[2]){
                                   $(".my-prompt-alert2").html("两次密码输入不一致！");
                                  return;
                                }else{
                                   member.getPwd(JSON.stringify({"mobile_verify":e.data[0],"Member": {"mobile": _E.data,"password": e.data[1]}}),function(reset_result){
                                          // console.log(reset_result);
                                          if(reset_result.msg=="success"){
                                              $('#my-prompt2').modal("close");  
                                              $("#my-alert").modal("open");
                                              $("#my-alert").find(".my-prompt-alert4").html("修改密码成功！");
                                          }else{
                                            $(".my-prompt-alert2").html(reset_result.error);
                                          }
                                          
                                    });
                                }


                               
                                // console.log(e.data);


                              },
                              onCancel: function(e) {
                                // alert('不想说!');
                              }
                            });
                      }else{
                        $(".my-prompt-alert").html(msg_result.error);
                      }
                    });
                }
            });

           

        }else if(member.ckStr(e.data,"email")){

            


            member.ckEx({"type": "email","email": e.data},function(mb_result){
              var _E=e;
                if(mb_result.msg == "success"){
                   $(".my-prompt-alert").html("此邮箱不存在！");
                }else{
                    member.sendEmail({"email": e.data,"type":"password"},function(msg_result){
                      if(msg_result.msg=="success"){
                           $('#my-prompt').modal("close");
                           $("#my-alert").modal("open");
                           $("#my-alert").find(".my-prompt-alert3").html("重置密码邮件以发送至保密邮箱，请查收！");
                      }else{
                        $(".my-prompt-alert").html(msg_result.error);
                      }
                    });
                }
            });



        }else{
          $(".my-prompt-alert").html("手机号或邮箱格式错误！"); 
        }
      },
      onCancel: function(e) {
        $(".my-prompt-alert").html("请输入手机号或邮箱");
        // alert('不想说!');
      }
    });
  });

  $("#my-alert").on("closed.modal.amui",function(){
      $(this).find(".my-prompt-alert3").html(" ");
  });


  if(window.location.search.split("?")[1]){    
     $('#my-prompt3').modal({
      relatedTarget: this,
       closeOnConfirm:false,
      onConfirm: function(e) {
         if(!member.ckEpt(e.data[0])){
            $(".my-prompt-alert3").html("密码不能为空！");
            return;
          }else if(!member.ckStr(e.data[0],"password")){
            $(".my-prompt-alert3").html("密码格式错误！");
            return;
          }else if(e.data[0] != e.data[1]){
             $(".my-prompt-alert3").html("两次密码输入不一致！");
            return;
          }else{
             member.getPwd(JSON.stringify({"code":window.location.search.split("?")[1],"Member": {"password": e.data[1]}}),function(reset_result){
                    // console.log(reset_result);
                    if(reset_result.msg=="success"){
                        $('#my-prompt3').modal("close");  
                        $("#my-alert").modal("open");
                        $("#my-alert").find(".my-prompt-alert4").html("修改密码成功！");
                    }else{
                      $(".my-prompt-alert3").html(reset_result.error);
                    }
                    
              });
          }
      },
      onCancel: function(e) {
        // alert('不想说!');
      }
    });
  }
})