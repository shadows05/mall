$(function () {
    $.formValidator.initConfig({
        theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
            edit();
            return false;
        }});
    $("#loginName").formValidator({onShow:"",onFocus:"会员账号应该为5-16字母、数字或下划线",onCorrect:"输入正确"}).inputValidator({min:5,max:16,onError:"会员账号应该为5-16字母、数字或下划线"}).regexValidator({
        regExp:"username",dataType:"enum",onError:"会员账号格式错误"
    }).ajaxValidator({
        dataType : "json",
        async : true,
        url : "{:U('Admin/Users/checkLoginKey')}",
        success : function(data){
            var json = WST.toJson(data);
            if( json.status == "1" ) {
                return true;
            } else {
                return false;
            }
            return "该账号已被使用";
        },
        buttons: $("#dosubmit"),
        onError : "该账号已存在。",
        onWait : "请稍候..."
    }).defaultPassed();
    $("#userName").formValidator({
        onShow:"",onFocus:"请输入真实用户名"
    }).inputValidator({
        min:1,max:50,onError:"请输入正确的用户名"
    });
    $("#loginPwd").formValidator({
        onShow:"",onFocus:"登录密码长度应该为5-20位之间"
    }).inputValidator({
        min:5,max:50,onError:"登录密码长度应该为5-20位之间!!!"
    });
    $("#userPhone").formValidator({
        onShow:"",onFocus:"请输入正确的手机号"
    }).inputValidator({min:11,max:11,onError:"你输入的手机号码非法,请确认"}).regexValidator({
        regExp:"mobile",dataType:"enum",onError:"手机号码格式错误"
    }).ajaxValidator({
        dataType : "json",
        async : true,
        url : "{:U('Admin/Users/checkLoginKey')}",
        success : function(data){
            var json = WST.toJson(data);
            if( json.status == "1" ) {
                return true;
            } else {
                return false;
            }
            return "该手机号码已被使用";
        },
        buttons: $("#dosubmit"),
        onError : "该手机号码已存在。",
        onWait : "请稍候..."
    }).defaultPassed();
    $("#userIdcard").formValidator({
        onShow:"",onFocus:"请输入正确的身份证号"
    }).inputValidator({min:17,max:18,onError:"你输入的身份证号码非法,请确认"}).regexValidator({
        regExp:"idcard",dataType:"enum",onError:"身份证号码格式错误"
    }).ajaxValidator({
        dataType : "json",
        async : true,
        url : "{:U('Admin/Users/checkLoginKey')}",
        success : function(data){
            var json = WST.toJson(data);
            if( json.status == "1" ) {
                return true;
            } else {
                return false;
            }
            return "该身份证号码已被使用";
        },
        buttons: $("#dosubmit"),
        onError : "该身份证号码已存在。",
        onWait : "请稍候..."
    }).defaultPassed();
    $("#userWebchat").formValidator({
        onShow:"",onFocus:"请输入正确的微信号"
    }).inputValidator({min:1,onError:"请输入微信号"}).ajaxValidator({
        dataType : "json",
        async : true,
        url : "{:U('Admin/Users/checkLoginKey')}",
        success : function(data){
            var json = WST.toJson(data);
            if( json.status == "1" ) {
                return true;
            } else {
                return false;
            }
            return "该微信号码已被使用";
        },
        buttons: $("#dosubmit"),
        onError : "该微信号码已存在。",
        onWait : "请稍候..."
    }).defaultPassed();
    $("#userEmail").inputValidator({min:0,max:25,onError:"你输入的邮箱长度非法,请确认"}).regexValidator({
        regExp:"email",dataType:"enum",onError:"邮箱格式错误"
    }).ajaxValidator({
        dataType : "json",
        async : true,
        url : "{:U('Admin/Users/checkLoginKey')}",
        success : function(data){
            var json = WST.toJson(data);
            if( json.status == "1" ) {
                return true;
            } else {
                return false;
            }
            return "该电子邮箱已被使用";
        },
        buttons: $("#dosubmit"),
        onError : "该账号已存在。",
        onWait : "请稍候..."
    }).defaultPassed().unFormValidator(true);

    $("#userQQ").formValidator({
        empty:true,onShow:"",onFocus:"QQ号码只能是数字"
    }).regexValidator({
        regExp:"num1",dataType:"enum",onError:"QQ号码格式错误"
    });

    $("#userPhone").blur(function(){
        if($("#userPhone").val()==''){
            $("#userPhone").unFormValidator(true);
        }else{
            $("#userPhone").unFormValidator(false);
        }
    });
    $("#userEmail").blur(function(){
        if($("#userEmail").val()==''){
            $("#userEmail").unFormValidator(true);
        }else{
            $("#userEmail").unFormValidator(false);
        }
    });
});
function edit(){
    var params = {};
    params.loginName = $.trim($('#loginName').val());
    params.loginPwd = $.trim($('#loginPwd').val());
    params.userName = $.trim($('#userName').val());
    params.userQQ = $.trim($('#userQQ').val());
    params.userIdcard = $.trim($('#userIdcard').val());
    params.userWebchat = $.trim($('#userWebchat').val());
    params.userScore = 0;
    params.userTotalScore = 0;
    params.userPhone = $.trim($('#userPhone').val());
    params.userPhoto = $.trim($('#userPhoto').val());
    params.userStatus = $('input[name="userStatus"]:checked').val();
    params.userSex = $('input[name="userSex"]:checked').val();
    params.userEmail = $.trim($('#userEmail').val());
    params.id = $('#id').val();
    Plugins.waitTips({title:'信息提示',content:'正在提交数据，请稍后...'});
    $.post("{:U('Admin/Users/edit')}",params,function(data,textStatus){
        var json = WST.toJson(data);
        if(json.status=='1'){
            Plugins.setWaitTipsMsg({ content:'操作成功',timeout:1000,callback:function(){
                location.href='{:U("Admin/Users/index")}';
            }});
        }else if(json.status=='-2'){
            Plugins.setWaitTipsMsg({content:'用户手机,微信号码或邮箱已存在!',timeout:1000});
        }else{
            Plugins.closeWindow();
            Plugins.Tips({title:'信息提示',icon:'error',content:'操作失败!',timeout:1000});
        }
    });
}
