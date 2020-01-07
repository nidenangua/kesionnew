<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title>用户信息</title>
    <link href="//ks.kesion.com/Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="//ks.kesion.com/Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>  
<style type="text/css">
	*{margin: 0px;padding: 0px;}
	li{list-style-type: none;}
	.wrap-margin{margin:40px 30px;}
	.wrap-margin ul li{margin:10px 0px;}
	.info-head{text-align:center;}
	.info-head img{width:86px;height:86px;border-radius: 50%;}
	.info-cont{color: #888;}
	.info-cont span{font-size: 12px;color: #888;}
	.info-cont input[type=text]{font-size: 12px; line-height:28px;text-indent:5px;border: 1px #E5E5E5 solid;border-radius: 3px;width: 100%;}
	.sms{width:28%;border: solid 1px #E5E5E5;border-radius: 3px;background: #FFFFFF;font-size: 12px;text-align: center;height: 30px;}  
</style>  
<body>
	
	<div class="wrap-margin">
		<ul>
			<li>
				<div class="info-head">
					<img class="headImg" src="<?php echo $this->upload->getHead($values['userid']); ?>"/>
					<p><?php echo $values['name']; ?></p>
				</div>
			</li>
			
			<li>
				<div class="info-cont">
					<span>账号：</span>
					<?php echo $values['username']; ?>
				</div>
			</li>
			
			<li>
				<div class="info-cont">
					<span>手机号：</span>
					<?php echo $values['mobile']; ?>
				</div>
			</li>
			<form target="hidframe"  action="<?php echo M_URL('h5market','dobing',$values['userid'].'&wxid='.$wxid,GP("")); ?>" method="post" id="myform">
				<?php if(empty($values['emergencyopenid'])){ ?>
					<li>
						<div class="info-cont">
							<span>家长姓名：</span>
							<input type="text" name="emergencyContact" placeholder="请输入家长姓名" />
						</div>
					</li>
					<li>
						<div class="info-cont">
							<span>家长手机号：</span>
							<input type="text" id="regPhone" name="emergencyContactTel" placeholder="请输入家长手机号" />
							<input type="hidden" name="mobile" value="<?php echo $values['mobile']; ?>" />
						</div>
					</li>
					<li>
						<div class="info-cont">
							<span>短信验证码：</span>
							<div>
								<input type="text" name="code" placeholder="" style="width: 70%;" />
								<input type="button" name="button" onClick="getcode(this,'regPhone','Register')" placeholder="" class="sms getcode" value="发送验证码" />
							</div> 
						</div>
					</li>
					
					<li>
						<div class="info-cont clearfix">
							<span>是否接收相关学生信息推送：</span>
							<div>
								<label for="receive1"><input checked="" id="receive1" type="radio"value="1" name="receive" />是</label>
								<label for="receive2"><input id="receive2" type="radio"value="0" name="receive"/>否</label>
							</div>
							
						</div>
					</li>
					<div class="info-head">
							<img class="headImg" src="<?php echo getsession('wxuser')->headimgurl; ?>"/>
							<input type="hidden" value="<?php echo getsession('wxuser')->headimgurl; ?>" name="emergencyhead" />
							<p>家长头像</p>
						</div>
						</li>
					<li>
				
						<div class="info-cont clearfix" style="text-align: center;">
							<input type="submit" class="ks-bt bt-def fn" value="绑定学生" />
						</div>
					</li>
					<?php }else{ ?>
						<li>
							<div class="info-cont">
								<span>家长姓名：</span>
								<input type="text" name="emergencyContact" disabled placeholder="请输入家长姓名" value="<?php echo $values['emergencyContact']; ?>" />
							</div>
						</li>
						<li>
							<div class="info-cont">
								<span>家长手机号：</span>
								<input type="text" id="regPhone" disabled  name="emergencyContactTel" value="<?php echo $values['emergencyContactTel']; ?>" placeholder="请输入家长手机号" />
							</div>
						</li>
						<li>
							<div class="info-cont clearfix">
								<span>是否接收相关学生信息推送：</span>
								<div>
									<label for="receive1"><input disabled id="receive1" type="radio"value="1" name="receive" <?php if($values['isreceive']==1){ echo 'checked'; } ?> />是</label>
									<label for="receive2"><input disabled id="receive2" type="radio"value="0" name="receive" <?php if($values['isreceive']==1){ echo 'checked'; } ?> />否</label>
								</div>
								
							</div>
						</li>
						<li>
						<div class="info-head">
							<img class="headImg" src="<?php echo getsession('wxuser')->headimgurl; ?>"/>
							<p>家长头像</p>
						</div>
						</li>
						<li>
							<div class="info-cont clearfix" style="text-align: center;">
								<input type="button" class="ks-bt bt-def fn" disabled value="已经绑定" />
							</div>
						</li>
					<?php } ?>
					
			</form>
		</ul>
		
		
		
	</div>
	
	
</body>
<script src="/Public/common/js/jquery.js"></script>
<script>
	//验证手机号格式是否正确
 	function verifyPhoneNumber(phoneId){
 		var phoneValue = $.trim(document.getElementById(phoneId).value);  
 		if(phoneValue==''){
 			alert($('#'+phoneId).attr('placeholder'));
        	document.getElementById(phoneId).focus();
            return false;
 		};
 		var reg  =/^1[345678]\d{9}$/;        
        var isok = reg.test(phoneValue);
        if(!isok)
        {
        	alert('手机号格式不正确');
        	document.getElementById(phoneId).focus();
            return false;
        };
        
        return true;
        
 	};
	function getcode(target,phoneId,modelname){
        var curCount = 60;     
        if(verifyPhoneNumber(phoneId)){
        	SetRemainTime(target,curCount,document.getElementById(phoneId).value,modelname); 
        };
    }
    //重新发送验收吗
	        function SetRemainTime(target,curCount,phone,modelname){
	        	var $target = $(target);
	        	var wxid    = "<?php echo $wxid; ?>";
	            if($target.attr('date')==1){
	            	return false;
	            }else{
	            	$target.val("正在发送...");
	            	$target.attr('date',1);
	            }
	            $.post("/Plus/Kesion.ajax.php?act=SendEx&type=memberReg",{"phone":phone,"modelname":modelname,"wxid":wxid},function(data){
	            	
	            	var InterValObj = window.setInterval(function(){
			            if (curCount == 0 ){              
			                window.clearInterval(InterValObj);
			                $target.val("重发验证码");
			                $target.attr('date',0);
			            }else {
			                curCount--;
			                $target.val(curCount + "秒后重发");
			            }
	            	},1000);
	            	
	            });
	            
	        };
</script>
</html>