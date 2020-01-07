<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.ksBoxLine{bottom: 40px; background: none;text-align: center;border-top:0}	
span#NEC{display: inline-block;}	
.generalTitle {height: 90px;line-height: 70px;}
</style>
</head>
<body class="ks-wrap">
	    <div  class="rightModel  bRadius10" style="overflow: hidden;"> 	
	    	
	    <!--内容-->
	    
	    		<div id="ksBoxHead" class=" clearfix">	    	
	    			<div class="Header-tool clearfix">
						<div class="Tool-Title">
						
						<!--图像-->
						<span class="Tool-icon">
							<i class="iconfont icon-xingquxiaozu"></i>
						</span>
						<!--图像-->
						
						
						<!--标题-->
						<p>微信公众号</p>
						<!--标题-->
						
						</div>
						<!--操作范围-->
						
						<!--菜单-->
						<?php include  CURR_VIEW_PATH . "left_menu.php";?>
						<!--菜单-->
						
						<!--操作范围-->
					
					</div>
					
	
				   
			    </div>
			    
			    
				<div id="ksBoxContent" class="bg-white mt20  bRadius10 ">
					
			     	<div class="wexin-header clearfix p15">
			            <div class="col-sm-4 step select">
			                <a href="javascript:;">1</a>
			            </div>
			            <div class="col-sm-4 step">
			                <a href="javascript:;">2</a>
			            </div>
			            <div class="col-sm-4 step">
			                <a href="javascript:;">3</a>
			            </div>
			        </div>
	        	<form class="form-horizontal" method="post"   target="hidframe" action="<?php {echo M_URL($this->AppName.'/Index','doWechatConfig','',GP(""));} ?>" id="myform">
	            	<!--第一步-->
	            	<div class="win-item" >
	               		<div class="wexin-title">
	                   	 第一步：填写微信公众号类型与基本信息
	                	</div>
				        <div class="open-key clearfix">
				            <span class="key-open mt7 fl">是否对接公众号：</span>
				            <div class="fl">
				                <div class="radio radio-info  radio-inline">
				                    <input  id="mbings1"type="radio"  <?php if(isset($value['status']) and $value['status']==1){echo "checked";}  ?>  value="1"  name="status"><label for="mbings1"> 是 </label>
				                </div>
				                <div class="radio radio-info  radio-inline">
				                    <input  id="mbings2"  type="radio" <?php if(empty($value) OR $value['status']==0){echo "checked";}  ?>    name="status"  value="0" ><label for="mbings2"> 否 </label>
				                </div>
				            </div>
				        </div>
		        
		        
		        
		        		<div class="show-box val-1" <?php if($value['status']==0){?>style="display:none"<?php }else{?> style="display:block"<?php }?> >
		        		
					        <div class="form-group clearfix">
					            <label class="fl mt7 col-sm-2 control-label">公众号类型</label>
					            <div class="col-sm-2 w200">
					                <select class="new-form" name="weixintype">
					                   <option value="1" <?php if(isset($value['weixintype']) and $value['weixintype']==1){echo "selected";} ?>>--服务号--</option>
					                    <option value="0" <?php if(isset($value['weixintype']) and $value['weixintype']==0){echo "selected";} ?>>--订阅号--</option>
					                </select>
					            </div>
					        </div>
			        
			        
			        
			       			<div class="form-group clearfix">
					            <label class="fl mt7 col-sm-2 control-label">认证情况 </label>
					           	<div class="col-sm-8 ">
					               	<div class="radio radio-info  radio-inline">
					                   <input  id="rz1"type="radio" checked="checked" value="1"    name="weixinstatus"><label for="rz1"> 已认证 </label>
					               	</div>
					              	<div class="radio radio-info  radio-inline">
					                   <input  id="rz2"  type="radio" checked="checked" value="0" name="weixinstatus"><label for="rz2"> 未认证 </label>
					               	</div>
					           	</div>
						        <div class="img-tips mb15 p25 clearfix">
						            <label class="col-sm-2 taps-left" style="text-align: left;">注 ：请确认您的公众账号</label>
						            <div class="col-sm-6">
						                <div class="w240">
						                    <img src="<?php echo UOOT;?>Public/uploads/common/account1.png">
						                </div>
						            </div>
						        </div>
						        <div class="form-group clearfix">
						            <label class="col-sm-2 control-label">公众号名称</label>
						            <div class="col-sm-4">
						              <input class="form-control" type="text" value="<?php if(!empty($value)){echo $value['weixinname'];} ?>"  name="weixinname"  placeholder="请输入公众号名称">
						            </div>
						        </div>
						        <div class="form-group clearfix">
						            <label class="col-sm-2 control-label" >公众号原始ID</label>
						            <div class="col-sm-4">
						                <input class="form-control" type="text" value="<?php if(!empty($value)){echo $value['weixinid'];} ?>" placeholder="请输入公众号原始ID" name="weixinid">
						            </div>
						        </div>
					        	<!--<div class="form-group clearfix">
					            <label class="col-sm-2 control-label">权限说明</label>
					            <div class="col-sm-5">-->
								<!--     <input class="form-control" type="text" readonly placeholder="您可以使用[自定义菜单]，[粉丝管理],[回复粉丝]等高级功能">-->
					                <!--<span style="line-height: 35px;" class="border">
					                    	您可以使用[自定义菜单]，[粉丝管理],[回复粉丝]等高级功能
					                </span>
					            </div>
					        </div>-->
			        		</div>
		        
	
					        <div class="show-box val-0" <?php if(isset($value['status']) and $value['status']==1){?>style="display:none"<?php }?> >
					            <button type="button"   num="3"   class="btn btn-primary btn-s-md ">保存</button>
					        </div>
				         
		                	<div class="col-sm-5"></div>
		       	 	</div>
	       		</div>
	       		
	       		
	            <!--第二步-->
	            <div class="win-item" style="display: none">
	                <div class="wexin-title">
	                   	 第二步： 配置微信开发者凭据
	                </div>
	                <input type="hidden"  name="id" value="<?php if(!empty($value)){echo $value['id'];} ?>">
	                <div class="form-group">
	                    <label class="control-label col-sm-2">AppID(应用ID)</label>
	                    <div class="col-sm-4">
	                        <input class="form-control" value="<?php if(!empty($value)){echo $value['appid'];} ?>" type="text" placeholder="请输入AppId" name="appid">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-2">AppSecret(应用钥匙)</label>
	                    <div class="col-sm-4">
	                        <input class="form-control" value="<?php if(!empty($value)){echo $value['appsecret'];} ?>" type="text" placeholder="请输入AppSecret" name="appsecret">
	                    </div>
	                </div>
	                <div class="img-tips mb15 p25 clearfix">
	                    <label class="col-sm-5 taps-left" >
	                        	注：返回开发者中心，将AppID(应用ID)以及AppSecret(应用密钥)拷贝到上表中
	                    </label>
	                    <div class="col-sm-2"></div>
	                    <div class="col-sm-5">
	                        <div class="w240">
	                            <img src="<?php echo UOOT;?>Public/uploads/common/account3.jpg">
	                        </div>
	                    </div>
	                </div>
	                
	                <div class="col-sm-5"></div>
	                <div class="col-sm-4">
	                   
	                </div>
	                   
	            </div>
	            <!--第三步-->
	            <div class="win-item" style="display:none">
	                <div class="wexin-title">
	                    	第三步：进入微信公众平台并设置接口
	                </div>
			        <div class="steps ">
			            <div class="ct-mb first ">
			                <div class="number">1</div>
			                <div class="ct-m clearfix">
			                    <div class="ct-m-l">
			                        <label class="">进入微信公共平台<a class="ct-color" href="http://mp.weixin.qq.com" target="_blank">http://mp.weixin.qq.com</a></label>
			                        <p>登入微信公众平台，点击进入【开发者中心】</p>
			                    </div>
			                    <div class="ct-m-r">
			                        <img src="<?php echo UOOT;?>Public/uploads/common/account21.jpg">
			                    </div>
			                    <img src="<?php echo UOOT;?>Public/uploads/common/bzjt01.png" class="bzjt">
			                </div>
			            </div>
			            <div class="ct-mb second ">
			                <div class="number">2</div>
			                <div class="ct-m clearfix">
			                    <div class="ct-m-l">
			                        <label class="">修改服务器配置</label>
			                        <p>在服务器配置处，点击【修改配置】</p>
			                    </div>
			                    <div class="ct-m-r">
			                        <img src="<?php echo UOOT;?>Public/uploads/common/account22.jpg">
			                    </div>
			                    <img src="<?php echo UOOT;?>Public/uploads/common/bzjt02.png" class="bzjt">
			                </div>
			            </div>
			            <div class="ct-mb third ">
			                <div class="number">3</div>
			                <div class="ct-m clearfix">
			                    <div class="ct-m-l">
			                        <label class="">配置微信接口</label>
			                        <p>分别将下方的信息复制到【接口配置信息】的输入框</p>
			                        <div class="ct-mt">
			                            <p class="url">Url</p>
			                            <input type="text" name="url" readonly class="form-control" value="https://<?php if(!empty($domain)){echo $domain['domain'];} ?>/home.html/wechat/Wx" >
			                        </div>
			                        <div class="ct-mt">
			                            <p class="url">Token</p>
			                            <input type="text" name="token"  class="form-control" value="<?php if(!empty($value)){echo $value['token'];} ?>">
			                        </div>
			                        <div class="ct-mt">
			                            <p class="url"> EncodingAESKey</p>
			                            <input type="text" name="encodingaeskey"  class="form-control" >
			                        </div>
			                    </div>
			                    <div class="ct-m-r">
			                        <img src="<?php echo UOOT;?>Public/uploads/common/account23.png">
			                    </div>
			                    <img src="<?php echo UOOT;?>Public/uploads/common/bzjt02.png" class="bzjt">
			                </div>
			            </div>
			        </div>
	            </div>
	        	</form>
        	</div> 
         	   <!--第二步-->
         	    <div class="clearfix ksBoxLine">  
            	<span id="NEC">
            		<button type="button"  num="1" id="nexts"  class="ks-bt bt-pue mr10">下一步</button> 
		        	<a href="javascript:history.go(-1);" class="ks-bt bt-pue">取消并返回</a>  
            		
            	</span>          	
            	
                <span id="SEC" style="display: none;">
                	<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr10" >&nbsp;&nbsp;确&nbsp;&nbsp;认&nbsp;&nbsp;</button>
		        	<a href="javascript:history.go(-1);" class="ks-bt bt-pue">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</a>  
                </span>
                          
            </div> 
	  			<!--内容-->
   
    	
    </div>
    
	<div id="ksBoxFooter" >
		<div style=" height: 80px;"></div>
	</div> 
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
//上方跳页
$('.step').click(function(){
	var weixinname = $('[name=weixinname]').val();
	var weixinid = $('[name=weixinid]').val();
	var appid = $('[name=appid]').val();
	var appsecret = $('[name=appsecret]').val();
	if($("#mbings1").prop('checked')){
		if($(this).index() == 2){
			if(weixinname ==""){
	    		Alert('请填写微信名称');
	    	}else if(weixinid == ""){
	    		Alert('请填写微信原始ID');
	    	}else if(appid == ""){
	    		Alert('请填写微信appid');
	    	}else if(appsecret ==""){
	    		Alert('请填写微信appsecret');
	    	}else{
	    		$(this).addClass('select').siblings().removeClass('select');
	    		$('.win-item:eq('+$(this).index()+')').show().siblings().hide();
	    	}
		}else if($(this).index() !=0){
			if(weixinid == ""){
	    		Alert('请填写微信原始ID');
	    	}else if(weixinname ==""){
	    		Alert('请填写微信名称');
	    	}else{
	    		$(this).addClass('select').siblings().removeClass('select');
	    		$('.win-item:eq('+$(this).index()+')').show().siblings().hide();
	    	}
		}else if($(this).index() !=1){
			if(appid == ""){
	    		Alert('请填写微信appid');
	    	}else if(appsecret ==""){
	    		Alert('请填写微信appsecret');
	    	}else{
	    		$(this).addClass('select').siblings().removeClass('select');
	    		$('.win-item:eq('+$(this).index()+')').show().siblings().hide();
	    	}
		}
	}
   
})
//下一步判断
var nums = 1;

$('#nexts').click(function() {
	var num = $(this).attr('num');
	console.log(num);
	if(num==2){$("#SEC").show();$("#NEC").hide();} 
		
		nums++;
	$(this).attr("num",nums)
	var weixinname = $('[name=weixinname]').val();
	var weixinid = $('[name=weixinid]').val();
	var appid = $('[name=appid]').val();
	var appsecret = $('[name=appsecret]').val();
    if (num==1) {
    	if(weixinname ==""){
    		Alert('请填写微信名称');
    	}else if(weixinid == ""){
    		Alert('请填写微信原始ID');
    	}else{
    		$('.step:eq('+num+')').addClass('select').siblings().removeClass('select')
    		$('.win-item:eq('+num+')').show().siblings().hide();
    	}
    }else if(num==2){
    	if(appid == ""){
    		Alert('请填写微信appid');
    	}else if(appsecret ==""){
    		Alert('请填写微信appsecret');
    	}else{
    		$('.step:eq('+num+')').addClass('select').siblings().removeClass('select')
    		$('.win-item:eq('+num+')').show().siblings().hide();
    	}
    }
})
//是否开启微信对接
$('[name=status]').click(function(){
	$.ajax({
        type : "post", 
        data :{status:$(this).val()},
        url : "<?php echo  M_URL($this->AppName.'/test','statusSetting','',GP(''));?>", 
        success : function (data){
            if(data =='设置成功'){
            	Alert('设置成功');
            	//location.reload()
            }else{
            	Alert('设置出错，请稍后在试一试，如果一直这样请联系科汛客服');
            	//location.reload()
            }
        }
	});
});
</script>
<script>
function  do_reg(){
var urlRound="<?php echo M_URL($this->AppName.'/Index','doWechatConfig','',GP(''));?>";
var wechatConfig="<?php echo M_URL($this->AppName.'/Index','wechatConfig','',GP(''));?>";
var count ="<?php echo M_URL($this->AppName.'/Index','index','',GP(''));?>";
   $.ajax({
			type:"post",
			url:urlRound,
			data:$("#myform").serialize(),
            success:function(data,textStatus){
				if(data == "failed"){
					Alert('APPID或appsecret写错请检查');
					return false;
                  }else{
					Alert(data);
					window.location.href =count;
				 }
	        },
			error:function(){
				Alert("发生了错误,请检查!");
			}
	})
	
       $("#myform").submit();
  }
    
    
radiotabs('status','.show-box');
$(function(){
	var index ="<?php if(isset($value) and !empty($value)){echo $value['status'];} ?>";
//    alert(index);
	if(index==0) {
		$('.val-0').show();
		$('.val-1').hide()
	}else if(index==1){
		$('.val-1').show();
		$('.val-0').hide()
	}
})
var n='';
var m='';
var arr='12345567890qwertyuioppasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'
for(i=0;i<43;i++){
    n+=arr.substr(Math.round(Math.random()*61),1);
}
for(i=0;i<6;i++){
    m+=arr.substr(Math.round(Math.random()*61),1);
}
if($("input[name='encodingaeskey']").val() == ''){
	$("input[name='encodingaeskey']").val(n);
}
if($("input[name='token']").val() == ''){
	$("input[name='token']").val(m);
}
</script>
</body>
</html>