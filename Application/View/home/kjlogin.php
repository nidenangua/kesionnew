<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	.divBlock{ position:absolute; left:0; right:0; top:0; bottom:0; z-index:999; } .layer { position:absolute; left:0; right:0; top:0; bottom:0; z-index:1000; background: gray; filter:alpha(opacity=60); -moz-opacity: 0.6; /*Firefox私有，透明度50%*/ opacity: 0.6; /*其他，透明度50%*/ }
    .divBlock .center{  position: absolute; left: 200px; right: 200px; height:150px; top: 70px; bottom: 400px; width: 35%; background: rgb(255,255,255); margin: 100px auto; padding: 60px 20px 100px 20px; z-index: 1001; }
	.btn-getsms { display: block; cursor: pointer; float: right; height: 36px; width: 97px; background-color: #7dbbfa; margin-top: 6px; margin-right: 8px; margin-left: 0; color: #fff; font-size: 12px; line-height: 36px; border-radius: 0; text-align: center; position: absolute; right: 160px; top: 14px; }
</style>
</head>
<body class="hidden">
	<div class="ks-wrap">
		<div class="bRadius10 bg-white ks-wbox ks-sBox">
			  <div class="generalTitle">
			     <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
				 <span class="gTitle fsize18 c-3e verAlignMiddle">便捷登陆</span>
			  </div>
			  <div id="ks-contentas">  
			  <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable mt-20">
			     <tr>
				     <td class="w20"></td>
				     <td class="leftTd alignRight pr20"><img src="<?php echo UOOT;?>Public/app/images/<?php if($this->userinfo['emailbing']=='1'){?>opened.png<?php }else{?>nonactivated.png<?php }?>" class="verAlignMiddle"></td>
					 <td class="leftTd alignLife fsize18 c-017 pr10">邮箱验证</td>
			         <?php if($this->userinfo['emailbing']=='1'){?>
					 <td class="leftTd alignLife fsize12 c-92 pr0">绑定邮箱：<?php echo $this->userinfo['email']; ?></td>
			         <td class="leftTd alignLife" style="position:relative"><a href="javascript:void(0)" onClick="layerHide('.Blockemail','.layeremail')" class="fsize12 c-blue">修改</a></td>
			         <?php }else{?>
			         <td class="leftTd alignLife fsize12 c-92 pr0">验证后，可用于登录、找回密码、增加安全级别</td>
			         <td class="leftTd alignCenter">
			         	<a href="javascript:void(0)" onClick="layerHide('.Blockemail','.layeremail')" class="fsize12 c-92 operaBtn alignCenter block bRadius3 edit-layeremail">立即验证</a></td>
					 <?php }?>
					 <td class="w120"></td>
				 </tr>
				 <tr>
				     <td class="w20"></td>
					 <td class="leftTd alignRight pr20"><img src="<?php echo UOOT;?>Public/app/images/<?php if($this->userinfo['mobilebing']=='1'){?>opened.png<?php }else{?>nonactivated.png<?php }?>" class="verAlignMiddle"></td>
				     <td class="leftTd alignLife fsize18 c-017 pr10">手机验证</td>
			         <?php if($this->userinfo['mobilebing']=='1'){?>
			         <td class="leftTd alignLife fsize12 c-92 pr0">您的手机：<?php echo $this->userinfo['mobile']; ?> 可用于登录，找回密码</td>
			         <td class="leftTd alignLife" style="position:relative"><a href="javascript:void(0)" onClick="layerHide('.divBlock','.layer')" class="fsize12 c-blue">修改</a></td>
					 <?php }else{?>
			         <td class="leftTd alignLife fsize12 c-92 pr0">绑定后，可用于登录，找回密码</td>
			         <td class="leftTd alignLife " style="position:relative">
			         	<a href="javascript:void(0)" <?php if($this->userinfo['username']!==$this->userinfo['mobile']){?>onClick="layerHide('.divBlock','.layer')"<?php }else{ ?>onClick="noedit();"<?php } ?>  class="ks-bt bt-def">立即绑定</a></td>
					 <?php }?>
					 <td class="w120"></td>
				 </tr>
				 <tr>
				     <td class="w20"></td>
					 <td class="leftTd alignRight pr20"><img src="<?php echo UOOT;?>Public/app/images/<?php if($this->userinfo['qqbing']=='1'){?>opened.png<?php }else{?>nonactivated.png<?php }?>" class="verAlignMiddle"></td>
				     <td class="leftTd alignLife fsize18 c-017 pr10">绑定qq</td>
					 <td class="leftTd alignLife fsize12 c-92 pr0">
			         <?php if($this->userinfo['qqbing']=='1'){?>
			         您已绑定了qq，可用该qq号码快速登录
					 <?php }else{?>
			         绑定后，可用该qq号码快速登录
					 <?php }?>
			         </td>
					 <?php if($this->userinfo['qqbing']=='1'){?>
			         <td class="leftTd alignLife"><a href="<?php echo M_URL('Login','apilogin',1);?>" target="_top" class="fsize12 c-blue ">修改</a></td>
					 <?php }else{?>
			         <td class="leftTd alignLife"><a href="<?php echo M_URL('Login','apilogin',1);?>" target="_top" class="ks-bt bt-def">立即绑定</a></td>
					 <?php }?>
					 <td class="w120"></td>
				 </tr>
				 <tr>
				     <td class="w20"></td>
					 <td class="leftTd alignRight pr20"><img src="<?php echo UOOT;?>Public/app/images/nonactivated.png" class="verAlignMiddle"></td>
				     <td class="leftTd alignLife fsize18 c-017 pr10">绑定微信</td>
					 <td class="leftTd alignLife fsize12 c-92 pr0">绑定后，可用该微信号码快速登录</td>
					 <td class="alignLife"><a href="" class="ks-bt bt-def">立即绑定</a></td>
					 <td class="w120"></td>
				 </tr>
			  </table>
			</div>
		</div>
	</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	
	$('#ks-content').height($(window).height()-$('.generalTitle').outerHeight());
	
	$(window).resize(function(){
		$('#ks-content').height($(window).height()-$('.generalTitle').outerHeight());
	});
	
	function layerHide(c1,c2){
		
		$(c1).show();
		$(c2).click(function(){
			$(c1).hide();
		});
	}
	function noedit(){
		alert('用户名和电话不一致时才可绑定');
	}
</script>
<div class="divBlock Blockemail" style="display:none">  
        <div class="layer layeremail"></div>  
        <form target="hidframe" method="post" action="<?php echo M_URL('Kjlogin','emailBing');  ?>" class="form-horizontal">
        <div class="center"  style="height:0px;">  
         <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable mt-20">
         <tr>
             <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">邮箱：</td>
             <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><input type="text" name="email" class="inputText bRadius5 w300 pl30"></td>
	     </tr>
         <tr><span id="getemail" onClick="getemail();" class="btn-getsms">发送邮箱验证码</span></tr>
         <script>
			function getemail()//获得验证码
			{
				var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
				var email=$("input[name='email']").val();
				var isEmail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/; 
				isok =isEmail.test(email)
				if(!isok)
				{
					alert('邮箱号格式不正确');
					return false;
				 }
				SetTime(curCount,email); 
			}	
			function SetTime(curCount,email) //获得验证码的时候获得短信
			{
				var userid = '<?php echo $this->userid;?>';
				var wxid   = '<?php echo $this->wxid;?>';
				if($("#getemail").attr('date')==1) 
				{
					return false;
				}
				$.post("/Plus/Kesion.ajax.php?act=SendEmail",{"email":email,"modelname":"Validate","userid":userid,"wxid":wxid},function(data){
					if(data==-1){Alert('发送失败');}else{Alert('发送成功');}
				});
				var InterValObj = window.setInterval(function(){
				if (curCount == 0 ){              
					window.clearInterval(InterValObj);//停止计时器
					//$("#check").removeAttr("disabled");//启用按钮
					$("#getemail").html("重新发送验证码");
					$("#getemail").attr('date',0);
				}
				else {
					$("#getemail").attr('date',1);
					curCount--;
					$("#getemail").html(curCount + "秒后重新发送");
				}
					},1000)	
			}
		</script>
         </table>
         </div>
        </form>
</div>
<div class="divBlock" style="display:none">  
        <div class="layer"></div>  
        <form target="hidframe" method="post" action="<?php echo M_URL('Kjlogin','moblieBing');  ?>" class="form-horizontal">
        <div class="center">  
         <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable mt-20">
         <tr>
             <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">用户名：</td>
             <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><input type="text" name="username" class="inputText bRadius5 w300 pl30"></td>
	     </tr>
         <?php if($this->Sms->smsState('Validate')){ ?>
         <tr>
             <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">短信验证码：</td>
             <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><input type="text" name="code"  class="inputText bRadius5 w300 pl30"><span id="getyanma" onClick="getcode();" class="btn-getsms">发送验证码</span></td>
         </tr>
         <script>
			function getcode()//获得验证码
			{
				var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
				var regusername=$("input[name='username']").val();
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
				var userid = '<?php echo $this->userid;?>';
				var wxid   = '<?php echo $this->wxid;?>';
				if($("#getyanma").attr('date')==1) 
				{
					return false;
				}
				$.post("/Plus/Kesion.ajax.php?act=SendEx&type=userCor",{"phone":phone,"modelname":"Validate","userid":userid,"wxid":wxid},function(data){
					if(data==-1){Alert('发送失败');}else{Alert('发送成功');}
				});
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
         </table>
         <button type="submit" >确认绑定</button>
         </div>
        </form>
    </div>  
 
 
</body>
</html>