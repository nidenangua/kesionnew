<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.ui-popup-backdrop {
	opacity: 0.05!important;
}
</style>
</head>
<body>
<br/><br/>
<table width="70%" align="center">
<tr>
<td colspan="3">
<img src="<?php echo $res['figureurl_qq_2'];?>"/>
<br/>
<br/><strong><font size="3">您好<span style='color:red'><?php echo $res['nickname'];?></span>,下午好！</font></strong><br/><br/>
</td>
</tr>
<tr>
<td  width="48%" valign="top">
<strong><font size="3" color="#0066CC">1、如果您已有账号，可以快速绑定</font></strong>
<form target="hidframe" id="myform" action="<?php echo M_URL('Login','check');?>" method="post">
     <br/>
     <input type="hidden" name="openid" value="<?php echo $loginfo['openid'];?>"/>
     原有用 户 名：<input type="text"  class="textbox" name="username2" maxlength="25"/><br/>
     原有登录密码：<input type="password" class="textbox" name="password2" maxlength="25"/><br/>
     <br/>
     <input type="button" onclick="do_reg();" class="btn" value="快速绑定"/>
</form>
<br/>
<font color=red>提示:捆绑成功之后,下次使用[{$Title}]方式登录即可直接登录到捆绑后的帐号。</font>
</td>
<td width="1" style="border-left:1px solid #f1f1f1">&nbsp;</td>
<td valign="top">
<strong><font size="3" color="#0066CC">2、如果还没有账号，您可以快速注册</font></strong>
<form target="hidframe" id="myform2" action="<?php echo M_URL('Login','doRegister');?>" method="post">
     <input type="hidden" name="openid" value="<?php echo $loginfo['openid'];?>"/>
     <input type="hidden" name="defaultpic" value="<?php echo $res['figureurl_qq_2'];?>"/>
     用户头像：<img src="<?php echo $res['figureurl_qq_2'];?>" width="30"/><br/>
     用 户 名：<input type="text" class="textbox" name="username" value="<?php echo $res['nickname'];?>" maxlength="25"/><br/>
     二级域名：<input type="text" class="textbox" name="domain" maxlength="25"/>.zuojy.com<br/>
     登录密码：<input type="password" class="textbox" name="password" maxlength="25"/><br/>
     性别：<?php echo $res['gender'];?><br/>
     <div>手机号码：<input name="mobile"  type="text" class="textbox" > </div>
     <?php if($this->Sms->smsState('Register')){ ?>
     <div><a href="#" id="getyanma" onClick="getcode();" class="code">获取验证码</a><input placeholder="请输入验证码" name="code" type="text" class="codeText"/></div>
<script>
function getcode()//获得验证码
{
    var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
	var regusername = $("input[name='mobile']").val();
    var reg  =/^1[345678]\d{9}$/;
    isok =reg.test(regusername)
    if(!isok)
    {
        alert('手机号格式不正确');
        return false;
     }
    SetRemainTime(curCount,regusername); 
}	
function SetRemainTime(curCount,phone) //获得验证码的时候获得短信
{
    if($("#getyanma").attr('date')==1) 
    {
        return false;
    }
    $.post("/Plus/Kesion.ajax.php?module=reg&act=SendEx",{"phone":phone,"modelname":"Register"},function(data){});
    var InterValObj = window.setInterval(function(){
    if (curCount == 0 ){              
        window.clearInterval(InterValObj);//停止计时器
        //$("#check").removeAttr("disabled");//启用按钮
        $("#getyanma").html("重新发送验证码");
        $("#getyanma").attr('date',0);
    }
    else {
        $("#getyanma").attr('date',1);
        
        curCount--;
        $("#getyanma").html(curCount + "秒后重新发送");
    }
        },1000)	
}
</script>
<?php } ?>
<div>注册类型：
<span class="on"><input name="usertype" type="radio" value="1" <?php if(isset($users))echo "value='$users[usertype]'";  ?> checked>教师</span><span><input name="usertype" type="radio" value="2" <?php if(isset($users))echo "value='$users[usertype]'";  ?>>机构</span><div class="clear"></div>
</div>
<input type="button" value="快速注册" onclick="do_reg2();" />
</form>
</td>
</tr>
</table>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function do_reg()
{
	var username = $("input[name='username2']").val();
	var password = $("input[name='password2']").val();
	if(!username)
	{
		Alert('原有用户名不能为空');
		return false;
	}
	if(!password)
	{
		Alert('原有登录密码不能为空');
		return false;
	}
	$("#myform").submit();	
}
function do_reg2()
{
	var username = $("input[name='username']").val();
	var password = $("input[name='password']").val();
	var mobile = $("input[name='mobile']").val();
	var reg = /^1[34578]\d{9}$/;
	isok= reg.test(mobile);
	if(!username)
	{
		Alert('用户名不能为空');
		return false;
	}
	if(!password)
	{
		Alert('登录密码不能为空');
		return false;
	}
	if(!mobile)
	{
		Alert('手机号码不能为空');
		return false;
	}
	if (!isok) 
	{
		Alert("手机号码机格式不正确");
		return;
	}
	$("#myform2").submit();	
}
</script>