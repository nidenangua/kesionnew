<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>收款设置</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/pay.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">

    <div class="ks-head-box">
     	
				
	<div class="ks-head-nav" style="border-bottom: 1px solid #eee;">
		<!--标题-->
		 <a href="javascript:history.go(-1)">结算中心</a><a><em>/</em>收款设置</a><span><em>/</em>支付宝商户号</span>
		<!--标题-->
	</div> 
		
    </div>
 
	 
     
	<!--table-->
	<form target="hidframe" id="myform" action="" method="post">  
	
<!--支付宝-->
 <div class="wx-container" >
		<div class="ws-tab" >
			<div class="wx-line"></div>
			<ul class="clearfix">
				<li class="curr" >
					<div class="wx-tab-item">
						<span>1</span>
						<p>接入支付宝电脑网站支付</p>
					</div>					
				</li>
				<li data-code="2">
					<div class="wx-tab-item">
						<span>2</span>
						<p>配置支付宝PID和KEY</p>
					</div>					
				</li>
				<li data-code="3">
					<div class="wx-tab-item">
						<span>3</span>
						<p>验证支付信息</p>
					</div>					
				</li>
				<li data-code="4">
					<div class="wx-tab-item">
						<span>4</span>
						<p>完成</p>
					</div>					
				</li>
			</ul>
		</div>
		
		<!--微信认证服务号-->
	<div class="wx-container">
		<div class="wx-content clearfix" style="display: block;">
			<div class="wx-left">
				<div class="wx-radio-box">
					<div class="wx-s-title">
						1.1我已开通支付宝账号
					</div>
					<div class="wx-radio">
						<label for="wxradio1" class="label-on">
              			<input type="radio" id="wxradio1" value="1" class="radioInput" name="wxradio" onclick="radioShow(this,2)"  <?php if($radios[0]==1){ echo 'checked';} ?> <?php if(!empty($weixinstatus)){echo 'disabled'; } ?>>是</label>
		              	<label for="wxradio2" class="">
		              			 <input type="radio" id="wxradio2" value="2" class="radioInput" name="wxradio" onclick="radioShow(this,2)" <?php if($radios[0]==2){ echo 'checked';} ?> <?php if(!empty($weixinstatus)){echo 'disabled'; } ?> >否 
		              			 <a target="_Blank" href="https://memberprod.alipay.com/account/reg/index.htm">立即申请</a></label>		 
					</div>
				</div>
				<div class="wx-radio-box">
					<div class="wx-s-title">
						1.2此账号已申请电脑网站支付
					</div>
					<div class="wx-radio">
						<label for="wxradio3" class="label-on">
		              		<input type="radio" id="wxradio3" value="1" class="radioInput" name="wxradio1" onclick="radioShow(this,3)" <?php if($radios[1]==1){ echo 'checked';} ?> <?php if(!empty($weixinstatus)){echo 'disabled'; } ?>>是
		              	</label>
		              	<label for="wxradio4" class="">
	              			 <input type="radio" id="wxradio4" value="2" class="radioInput" name="wxradio1" onclick="radioShow(this,3)" <?php if($radios[1]==2){ echo 'checked';} ?> <?php if(!empty($weixinstatus)){echo 'disabled'; } ?> >否 
		              	 <a target="_Blank" href="https://www.alipay.com/">立即开通</a></label>		 
					</div>
				</div>
				<div class="wx-confirm">
					<div class="wx-checkbox">
						
							<label class="mr30"><input value="1" type="checkbox"name="roll" onclick="execute(this)">
								<span >我已完成上述配置</span></label>
						<div class="wx-inline">
							
							<button class="ks-bt bt-gg ml20" data-code="2" onclick="tabClick(this)" id="step1" disabled>下一步</button>
						</div>
					</div>
				</div>
			
			</div>
			<div class="wx-right">
				<p style="margin-bottom: 30px;">您授权的支付宝商户号须满足以下条件:</p>
				<p>这是支付宝说明信息，需要文案填充</p>
			</div>
		</div>
		
		
	
	
		<!--设置支付信息-->
		<div class="wx-content clearfix" style="display: none;">
			<div class="wx-left">
				<div class="wx-s-title">
						将以下配置文件配置到对应位置	
				</div>
				<div class="wx-s-txt">
					<span>支付编号(Mchld)：</span>
					<div class="wx-s-btn">
						<input class="form-textbox"  name="MchId"   type="text" value="<?php if(!empty($content[0])){echo $content[0];} ?>"/>
						<p>支付编号填写的是您的支付账户</p>
					</div>
				</div>
				<div class="wx-s-txt">
					<span>合作伙伴身份(PID)：</span>
					<div class="wx-s-btn">
						<input class="form-textbox"  name="PID"   type="text" value="<?php if(!empty($content[1])){echo $content[1];} ?>"/>
						<p>如何获取合作伙伴身份</p>
					</div>
				</div>
				<div class="wx-s-txt">
					<span>安全校验(key)：</span>
					<div class="wx-s-btn">
						<input class="form-textbox"  name="key"   type="text" value="<?php if(!empty($content[2])){echo $content[2];} ?>"/>
					</div>
				</div>
				
				
				<div class="wx-confirm">
					<div class="wx-checkbox">
						<label class="mr30"><input value="1" type="checkbox"name="roll" id="config2" onclick="configClick(2)">
						<span >我已完成上述配置</span></label>
						<div class="wx-inline">
							<button type="button" class="ks-bt bt-defalut" data-code="1" onclick="tabClick(this)">上一步</button>
							<button type="button" class="ks-bt bt-gg ml20"data-code="3" onclick="tabClick(this)" id="step2" disabled>下一步</button>
						</div>
					</div>
				</div>
			</div>
			<div class="wx-right">
				<p style="margin-bottom: 30px;">支付说明文案？</p>
				<p>支付说明文案支付说明文案支付说明文案支付说明文案支付说明文案支付说明文案<font style="color:#e5412c;">支付说明文案	</font></p>
			</div>
		</div>
		
		
		<!--验证支付信息-->
		<div class="wx-content clearfix" style="display: none;">
			<div class="wx-left">
				<div class="wx-code">
					
					<p>请到新开页面扫描上方二维码支付0.01元，此费用为验证支</br>付信息配置是否正确所用，不予退还</p>
					<p>
						<label  id="successTxt"  for="success" class="label-on" style="display: none;">
		              		<input type="radio"value="1" class="radioInput" name="success" checked="checked">验证成功，请继续下一步</label>
					</p>
				</div>
				
				<div class="wx-confirm">
					<div class="wx-checkbox">
					
						<div class="wx-inline">
							<button type="button" class="ks-bt bt-defalut" data-code="2" onclick="tabClick(this)">上一步</button>
							<button type="button" class="ks-bt bt-gg ml20"data-code="4" onclick="tabClick(this)" id="step4" disabled>下一步</button>
						</div>
					</div>
				</div>
			</div>	
			<div class="wx-right">
				<p>支付信息配置正确：</p>
				<p style="margin-bottom: 30px;">扫码后点击支付按钮正常输入密码支付</p>
				<p>支付信息配置有误：</p>
				<p>点击支付后提示长按二维码支付-- 请检查支付授权目录配置是否有误</p>
			</div>	
				
		</div>	
		
		<!--配置成功-->
		
   		<div class="wx-content clearfix" style="display: none;">
   		 <div class="wx-left">	
   			<div class="wx-success">
   				<div class="wx-s-icon">
   					<i class="iconfont icon-zhengque"></i>
   				</div>
   				<p class="wx-s-title1">配置成功</p>
   				<p class="wx-s-mg">以下为 支付宝认证服务号渠道专属店铺链接，通过此链接购买的支付金额会直接进入</br>你的服务号对应的微信支付账户(默认链接已自动替换为此链接)</p>
   				<p><a>https://kskesion.com</a><button class="bt-pue">复制链接</button></p>
   			</div>
   		</div>	
   		<div class="wx-right">
   				<p style="margin-bottom: 20px;">特别提醒：</p>
				<p style="margin-bottom: 10px;">开启认证服务号渠道后，请勿在未认证的公众号中售卖商品，否则可能出现用户无法支付等严重后果！此种情况由微信打击跨号支付造成</p>
				<a style="color: #e5412c;">点击查看解决方案</a>
				
   		</div>
	</form>
 </div>	
            
</div>

<!--支付宝-->

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script src="<?php echo UOOT;?>Public/common/js/clipboard.min.js"></script>
<script>
	module.require(['$','backstage'],function(){
		
		
		
		/*认证服务号*/
		  var radioval =$('input:radio[name="wxradio"]:checked').val();
		 var radioval2 =$('input:radio[name="wxradio1"]:checked').val();
		
		  if(radioval==1){
		  	$('#radio2').show();
		  }else{
		  	$('#radio2').hide();
		  }
		   
		  if(radioval2==1){
		  	$('#radio3').show();
		  }else{
		  	$('#radio3').hide();
		  }
		  
		  var radis = $('.wx-radio').find('input[type="radio"]').attr('disabled');
			if(radis=='disabled') {
				$('#step1').addClass('light');
				$('#step1').removeAttr("disabled")
			}
			
			
	   $('.wx-radio').find('input').each(function(){
	   	   var radioDis = $(this).attr('disabled');
	   	   if (radioDis=='disabled'){
	   	   	$(this).parent('label').addClass('unclick')
	   	   }
	   })
		
		
/*		function copyTxt(){
			var copytxt  = document.createElement('<p cc>');
			
					
		}
		*/
		//复制文本
			
			
			
		
		
		  
	
		
		
		
		
		
		/*设置切换*/
		$("#upload").change(function () {
	        var formData = new FormData();
	        formData.append("myfile", document.getElementById("upload").files[0]);   
	        $.ajax({
	            url: "<?php echo M_URL($this->AppName.'/Index','imgload','',GP('')); ?>",
	            type: "POST",
	            data: formData,
	            /**
	            *必须false才会自动加上正确的Content-Type
	            */
	            contentType: false,
	            /**
	            * 必须false才会避开jQuery对 formdata 的默认处理
	            * XMLHttpRequest会对 formdata 进行正确的处理
	            */
	            processData: false,
	            success: function (data) {
	            	var data = JSON.parse(data);
	                if (data.result == "succeed") {
	                   $('#current_wx_verify').show();
	                   $('#filename').html(data.info);
	                   Alert(data.info);
	                }
	                if (data.result == "error") {
	                    Alert(data.info);
	                }
	                $("#imgWait").hide();
	            },
	            error: function () {
	                alert("上传失败！");
	            }
	        });
	    });
		
	});
	function configClick(step){
		
		 if (step===2)	 { //第三步骤
			var textVal = $('.wx-s-btn').find('.form-textbox').val();
				
		  
			if(textVal!=''&&  getId('config2').checked){
				
				$('#step2').addClass('light')
				$('#step2').removeAttr("disabled")
			}	
			
		}else if(step===0){
			var radis = $('.wx-radio').find('input[type="radio"]').attr('disabled');
			if(radis=='disabled') {
				$('#step1').addClass('light')
			}
			
		}
		
	}
	function tabClick(target){
		var _this = $(target);
		var code =  parseInt(_this.attr('data-code'))-1;
		
		console.log(code)
		configClick(code);
		var ordersn = '';
		if(code ==2){
			ordersn = '';
			outTradeNo = '';
			for(var i=0;i<6;i++) //6位随机数，用以加在时间戳后面。
			{
			    outTradeNo += Math.floor(Math.random()*10);
			}
			ordersn = new Date().getTime() + outTradeNo; 
			window.open('https:<?php echo M_URL($this->AppName.'/Index','paycode','',GP('type-'.$type)); ?>'+'&MchId='+$('[name=MchId]').val()+'&PID='+$('[name=PID]').val()+'&key='+$('[name=key]').val()+'&ordersn='+ordersn);   
			$('.wx-content').eq(code).show().siblings().hide();		
			$('.ws-tab').find('li').eq(code).addClass('curr')	
			var a = function(){
				$.ajax({
					type:"post",
					url:'<?php echo M_URL($this->AppName.'/Index','rechargebackW','',GP('type-'.$type));?>',
					data:{
					     "ordersn":ordersn,
					},
					success:function(data){
						if(data=='succeed'){
							
						$('#successTxt').show();
						$('#step4').removeAttr("disabled");
						$('#step4').addClass('light')
						
					}},
				    error:function(){
					    return false;
					}
				});
			}
			var time = setInterval(a,5000);	
		}else{
			$('.wx-content').eq(code).show().siblings().hide();		
			$('.ws-tab').find('li').eq(code).addClass('curr')	
		}
		
	}
	
	
	/*radioshow*/
	function radioShow(target,type){
			
			var _this =$(target);
		 var code =$(_this).val();
		
		
		 if (code==1) {
		 	$('#radio'+type).show();			 			 	
		 }else if(code==2){
		 	$('#radio'+type).hide();	
		 }
	}
	
	//授权成功执行
	function execute(target){
		
		var wxradio = $('input:radio[name="wxradio"]:checked').val();
		var wxradio1 = $('input:radio[name="wxradio1"]:checked').val();
		
		if(wxradio ==1 && wxradio1==1){
			$('#step1').addClass('light')
	  		$('#step1').removeAttr("disabled")
		}
		
		
	}
	
	
	
	//复制文本 

	//关闭窗口
	function closepo(target){	
		alert('sss')				
		$(target).parents('.popup-open').find('.popup-close').click()			
	}
    /*授权认证*/
	function empower(){
		window.open('<?php echo M_URL('wechat/Index','wechatConfig','',GP('')); ?>');
		
		var _html = '<div class="modal-box"><div class="modal-box-txt" style="height:150px;text-align:center;line-height:120px;font-size:14px">请在新窗口中完成微信公众号授权！<a style="color:#2a75ed">查看授权教程</a></div>'+
					'<div class="modal-btn" style="text-align:center;padding:10px;border-bottom:1px solid #eee"><button class="ks-bt bt-pue" style="float:none;display:inline-block;min-width:150px;height:40px;line-height:40px" onclick="frames[\'main\'].execute(this)">授权成功</button>'+
					'<button class="ks-bt bt-defalut" onclick="frames["main"].closepo(this)" style="float:none;display:inline-block;min-width:150px;margin-left:20px;height:40px;line-height:40px">授权失败，重试</button>  </div>  </div>'	
					
		top.popup.open(false,{
			title:'提示',
			area:['640px','auto'],
			content:_html
		});
	 
	
    }
   
   
   //文本复制
   function copyUrl(id){
			var Url2 = document.getElementById(id);
			Url2.select(); //选择对象
			document.execCommand("Copy"); //执行浏览器复制命令
			Alert("复制成功！",2)
		}

			
</script>
</body>
</html>
