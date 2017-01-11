$(function () {
    var member = new memberCommon();

    // 手机Start
    $("#r-phone-a1").on("click", function () {
        $(".content[tag='phone'] .am-tab-panel[data-tab-panel-1]>div").css("visibility", "hidden");
        $(".content[tag='phone'] .am-tab-panel[data-tab-panel-2]>div").css("visibility", "hidden");
    });

    //发送手机验证码按钮
    $("#sCode1-bt").one("click", function () {
        clickSend.apply(this);
    });
    function clickSend() {
        //验证手机号合法
        var phoneNum = $("#r-phone").val().trim();
        var objThis = $(this);
        if (member.ckEpt(phoneNum)) {
            if (member.ckStr(phoneNum, "phone")) {
                member.msgCode(phoneNum, 1, function (result) {
                    if (result.msg == "success") {
                        sobeyAlert("发送成功！");
                    } else {
                        sobeyAlert(result.error);
                    }
                });

                //倒计时读秒
                var _S = 60;
                var tempInterval = setInterval(function () {
                    if (_S == 0) {
                        clearInterval(tempInterval);
                        objThis.css("color", "#333");
                        objThis.html("重新发送");
                        $("#sCode1-bt").one("click", function () {
                            clickSend.apply(this);
                        });
                    } else {
                        objThis.css("color", "#999999");
                        objThis.html("重新发送 " + (--_S));
                    }
                }, 1000);
            } else {
                sobeyAlert("请填写正确的手机号！");
            }
        } else {
            sobeyAlert("手机号不能为空！");
        }
    };
    //图片验证码刷新
    $("#r-imgScode-bt").on("click", function () {
        console.log($(this).find("img"));
        $(this).find("img")[0].src = urlPre+'/api/member/captcha?' + Math.random();
    });
    //手机输入框离开事件
    $("#r-phone").on("blur", function () {
        var phoneNum = $("#r-phone").val().trim();
        var objThis = $(this);
        //验证手机号
        if (member.ckEpt(phoneNum)) {
            if (member.ckStr(phoneNum, "phone")) {
                member.ckEx({"type": "mobile", "mobile": phoneNum}, function (result) {
                    if (result.msg == "success") {
                        objThis.attr("tag", "true");
                    } else {
                        alert(result.error);
                        objThis.attr("tag", "false");
                        return;
                    }
                });

            } else {
                objThis.attr("tag", "false");
                sobeyAlert("请填写正确的手机号！");
                return;
            }
        } else {
            objThis.attr("tag", "false");
            sobeyAlert("手机号不能为空！");
            return;
        }
    });

    //用户名输入框离开事件
    $("#r-userName").on("blur", function () {
        var userName = $("#r-userName").val().trim();
        var objThis = $(this);
        //验证用户名
        if (member.ckEpt(userName)) {
            if (member.ckStr(userName, "name")) {
                member.ckEx({"type": "loginname", "loginname": userName}, function (result) {
                    if (result.msg == "success") {
                        objThis.attr("tag", "true");
                    } else {
                        alert(result.error);
                        objThis.attr("tag", "false");
                        return;
                    }
                });

            } else {
                sobeyAlert("用户名只能是4~16位字符或数字！");
                objThis.attr("tag", "false");
                return;
            }
        } else {
            sobeyAlert("用户名不能为空！");
            objThis.attr("tag", "false");
            return;
        }
    });
    //手机号注册第一步按钮
    $("#phone-reg-bt").on("click", function () {
        var userPass = $("#r-passWord").val().trim();
        var imgScode = $("#r-imgScode").val().trim();
        //验证密码
        if (member.ckEpt(userPass)) {
            if (member.ckStr(userPass, "password")) {
            } else {
                sobeyAlert("密码只能是4~20位字符、数字或下划线！");
                return;
            }
        } else {
            sobeyAlert("密码不能为空！");
            return;
        }
        //图片验证码

        member.imgScode(imgScode, function (result) {
            if (result.msg == "success") {
                if (eval($("#r-phone").attr("tag")) && eval($("#r-userName").attr("tag"))) {
                    $(".content[tag='phone'] .am-tab-panel[data-tab-panel-1]>div").css("visibility", "visible");
                    $("#r-phone-a2").click();
                }
            } else {
                sobeyAlert("验证码错误！");
                return;
            }
        });

    });
    //手机号注册第二步按钮
    $("#phone-reg-bt2").on("click", function () {
        var sCode1 = $("#sCode1").val().trim();
        var phoneNum = $("#r-phone").val().trim();
        member.sCode(phoneNum, sCode1, function (result) {
            if (result.msg == "success") {
                //执行注册
                var data = {
                    "SignupForm": {
                        "mobile": $("#r-phone").val().trim(),
                        "password": $("#r-passWord").val().trim(),
                        "loginname": $("#r-userName").val().trim()
                    },
                    "type": "mobile"

                }
                member.regUser(data, function (result) {
                    $("#r-phone-success").html("恭喜您，" + phoneNum + "账号注册成功!");
                    $("#r-phone-success2").html("5秒后自动跳转或点击跳转");
                    $(".content[tag='phone'] .am-tab-panel[data-tab-panel-2]>div").css("visibility", "visible");
                    $("#r-phone-a3").click();
                    setTimeout(function () {
                        window.location.href = $("#r-phone-success2").attr("href");
                    }, 5000);
                });
            } else {
                sobeyAlert("验证码错误！");
                return;
            }
        });
    });
    // 手机End


    //邮箱Start
    $("#r-email-a1").on("click", function () {
        $(".content[tag='email'] .am-tab-panel[data-tab-panel-1]>div").css("visibility", "hidden");
        $(".content[tag='email'] .am-tab-panel[data-tab-panel-2]>div").css("visibility", "hidden");
    });

    //图片验证码刷新
    $("#r-imgScode-e-bt").on("click", function () {
        console.log($(this).find("img"));
        $(this).find("img")[0].src = 'http://www.newcollege.com/api/member/captcha?' + Math.random();
    });

    //邮箱输入框离开事件
    $("#r-email").on("blur", function () {

        var objThis = $(this);
        var emailNum = objThis.val().trim();
        //验证邮箱地址
        if (member.ckEpt(emailNum)) {
            if (member.ckStr(emailNum, "email")) {
                member.ckEx({"type": "email", "email": emailNum}, function (result) {
                    if (result.msg == "success") {
                        objThis.attr("tag", "true");
                    } else {
                        alert(result.error);
                        objThis.attr("tag", "false");
                        return;
                    }
                });

            } else {
                objThis.attr("tag", "false");
                sobeyAlert("请填写正确的邮箱地址！");
                return;
            }
        } else {
            objThis.attr("tag", "false");
            sobeyAlert("邮箱地址不能为空！");
            return;
        }
    });
//用户名输入框离开事件
    $("#r-userName-e").on("blur", function () {

        var objThis = $(this);
        var userName = objThis.val().trim();
        //验证用户名
        if (member.ckEpt(userName)) {
            if (member.ckStr(userName, "name")) {
                member.ckEx({"type": "loginname", "loginname": userName}, function (result) {
                    if (result.msg == "success") {
                        objThis.attr("tag", "true");
                    } else {
                        alert(result.error);
                        objThis.attr("tag", "false");
                        return;
                    }
                });

            } else {
                sobeyAlert("用户名只能是4~16位字符或数字！");
                objThis.attr("tag", "false");
                return;
            }
        } else {
            sobeyAlert("用户名不能为空！");
            objThis.attr("tag", "false");
            return;
        }
    });
    //邮箱注册第一步按钮
    $("#email-reg-bt").on("click", function () {
        var userPass = $("#r-passWord-e").val().trim();
        var imgScode = $("#r-imgScode-e").val().trim();
        //验证密码
        if (member.ckEpt(userPass)) {
            if (member.ckStr(userPass, "password")) {
            } else {
                sobeyAlert("密码只能是4~20位字符、数字或下划线！");
                return;
            }
        } else {
            sobeyAlert("密码不能为空！");
            return;
        }
        //图片验证码

        member.imgScode(imgScode, function (result) {
            if (result.msg == "success") {
                if (eval($("#r-email").attr("tag")) && eval($("#r-userName-e").attr("tag"))) {

                    //执行注册
                    var data = {
                        "SignupForm": {
                            "email": $("#r-email").val().trim(),
                            "password": $("#r-passWord-e").val().trim(),
                            "loginname": $("#r-userName-e").val().trim()
                        },
                        "type": "email"

                    }
                    member.regUser(data, function (result) {
                        if (result.code == "0000") {
                            $("#r-email-success2").html("5秒后自动跳转或点击跳转");
                            $(".content[tag='email'] .am-tab-panel[data-tab-panel-1]>div").css("visibility", "visible");
                            $("#r-email-a2").click();
                            setTimeout(function () {
                                window.location.href = $("#r-email-success2").attr("href");
                            }, 5000);
                        }else{
                            sobeyAlert(result.error);
                            //sobeyAlert("注册失败");
                        }
                    });

                }
            } else {
                sobeyAlert("验证码错误！");
                return;
            }
        });

    });
    //邮箱End
    //切换注册方式
    $("#use-email").on("click", function () {
        $(".content[tag='phone']").hide();
        $(".content[tag='email']").show(300);
    });
    $("#use-phone").on("click", function () {
        $(".content[tag='email']").hide();
        $(".content[tag='phone']").show(300);
    });


})