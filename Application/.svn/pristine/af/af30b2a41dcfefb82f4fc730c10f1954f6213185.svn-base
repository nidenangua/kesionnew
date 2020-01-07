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
.form-kmode{box-shadow: 0px 0px 6px #CCCCCC; height: 60px; margin-bottom: 20px; position: relative;}
.kmode-pdl{position: relative; padding-left:30%;}
.kmode-new{position: absolute; left: 0px; top: 0px; height: 100%;width: 30%;line-height: 60px;}
.kmode-title{font-size: 1.8em; margin-left:20px;}
.kmode-info{line-height: 60px;}
.kmode-stat{line-height: 60px; width: 160px; text-align: left;}
.change-af{border:solid 2px #00acc6; color:#00acc6 ; border-radius: 10px; padding: 0px 5px;cursor: pointer;}
.change-ft{background: #00C665; padding: 8px 12px; color: white; border-radius: 20px; cursor: pointer;}
</style> 
</head>
<body class="ks-wrap">
<div class="divBlock Blockemail" >
    <div class="center"  style="height:0px;">  
     <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable mt-20">
     <tr>
         <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">邮箱：</td>
         <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><input type="text" name="email" class="inputText bRadius5 w300 pl30"></td>
     </tr>
     <tr><td></td><td><button id="getemail" onClick="getemail();" class="ks-bt bt-pue">发送邮箱验证码</button></td></tr>
     <script>
		function getemail(){//获得验证码
			var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
			var email=$("input[name='email']").val();
			var isEmail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/; 
			isok =isEmail.test(email)
			if(!isok){
				alert('邮箱号格式不正确');
				return false;
			 }
			SetTime(curCount,email); 
		}	
		function SetTime(curCount,email){//获得验证码的时候获得短信
			var userid = '<?php echo $this->userid;?>';
			var wxid   = '<?php echo $this->wxid;?>';
			if($("#getemail").attr('date')==1){
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
			}else {
				$("#getemail").attr('date',1);
				curCount--;
				$("#getemail").html(curCount + "秒后重新发送");
			}
				},1000)	
		}
	 </script>
     </table>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$('#ks-content').height($(window).height()-$('.generalTitle').outerHeight());

$(window).resize(function(){
	$('#ks-content').height($(window).height()-$('.generalTitle').outerHeight());
});
function noedit(){
	alert('用户名和电话不一致时才可绑定');
}
</script>
</body>
</html>