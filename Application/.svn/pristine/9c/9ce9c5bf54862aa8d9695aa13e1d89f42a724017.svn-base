<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>联系方式</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
	.Created-largetTitle .Created-title {border-bottom: 1px solid #eee;}
</style>
</head>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">
	
	<!--header-->
    <div class="ks-head-box">
     	
		<h3 class="ks-head-title2">网站设置
			<div class="fr">	
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor65"><i class="iconfont icon-qm" ></i></a>											
			</div>
		
		</h3>
    </div>
    <!--header-->
	<!--tab-->
 	<div class="ks-head-tab">
 			<ul class="clearfix">
 				<li><a href="<?php echo M_URL('config/Index','','',GP('appid-1'));?>">基本配置</a></li>
 				<li><a href="<?php echo M_URL('Website','websitedomain'); ?>">域名设置</a></li>
 				
 				<li><a href="<?php echo M_URL('login/Index','','',GP('appid-20'));?>">第三方登录</a></li>
 				<li class="curr"><a href="<?php echo M_URL('Website','websiteContact'); ?>">联系方式</a></li>
 				<li><a href="<?php echo M_URL('config/Index','wxinfo','',GP('appid-1'));?>">网校介绍</a></li>
 			</ul>
 	</div>
	 <!--/tab-->
			     
			  
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
	
			</div>					
					
			<div class="back-bt clearfix fr mt10" style="display: none;">
		        <div class="ks-view-tab">		
					<ul >
		        		<li class="fl curr"><a href="javascript::">正&nbsp;&nbsp;&nbsp;常</a></li>
		       			<li class="fl"><a href="javascript::">关&nbsp;&nbsp;&nbsp;闭</a></li>
				   </ul>	 
				</div>
			
			</div>
					
		</div>
		<!--/widget-->
	     
		<!--table-->
		<form target="hidframe" id="myform" action="<?php echo M_URL('Website','addContact');  ?>" method="post" enctype="multipart/form-data">
            <div  id="contact" a="<?php echo $info["customerstatus"]; ?>" >
                <div  width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
                   
                     <div class="Created-largetTitle">
						<span>1</span>
						<div class="Created-title">  
							<span>QQ客服设置</span>
							
						</div>
					</div>
                    <div class="mt10">
                        <div  class="leftTd alignRight fsize16 c-92 w120 pt0"></div>
                        <div  class="rightTd alignLife">
                            <div class="recordData" data-id="1">
                   <?php foreach($qqno as $v){$html="";if(!isset($v[0])){$v[0]="";}if(!isset($v[1])){$v[1]="";}		
		$html=$html."<div class='recordBox mt10'>
                        <input type='text' name='qquser[]' value='$v[0]'  placeholder='QQ客服' class='inputText bRadius5 w190 c-92'>
                        <input type='text' name='qq[]' value='$v[1]' placeholder='QQ号' class='inputText bRadius5 w190 ml20 c-92'><a href='javascript:void(0)' class='delete c-blue ml10'>删除</a>
                    </div> ";
                   echo $html;}?>
                            <a href="javascript:void(0)" class="block c-blue hLh30 addRecord">新增</a>
			             </div>
			            </div>
			        </div>
            	</div>
	            <div  width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
	                
	                 <div class="Created-largetTitle pt20">
						<span>2</span>
						<div class="Created-title">  
							<span>QQ群设置</span>
							
						</div>
					</div>
	                <div>
	                    <div  class="leftTd alignRight fsize16 c-92 w120 pt0"></div>
	                    <div  class="rightTd alignLife">
	                        <div class="recordData" data-id="1">
	                            <?php foreach($qqgroup as $v){
								if(!isset($v[0])){$v[0]="";}
								if(!isset($v[1])){$v[1]="";}	
					$html="";	
					$html=$html."<div class='recordBox mt10'>
	                            <input type='text' name='qqgroudname[]' value='$v[0]' placeholder='QQ群' class='inputText bRadius5 w190 c-92'>
	                            <input type='text' name='qqgroud[]' value='$v[1]' placeholder='QQ群号' class='inputText bRadius5 w190 ml20 c-92'><a href='javascript:void(0)' class='delete c-blue ml10'>删除</a>
	                        </div>";echo $html;}?>
	                        	<a href="javascript:void(0)" class="block c-blue hLh30 addRecord">新增</a>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
			    <div  width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
			        
			        <div class="Created-largetTitle pt20">
						<span>3</span>
						<div class="Created-title">  
							<span>联系电话设置</span>
							
						</div>
					</div>
			        
			        <div>
			            <div  class="leftTd alignRight fsize16 c-92 w120">工作时间</div>
			            <div  class="rightTd alignLife">
			                <input type="text" name="workTime" value="<?php if(isset($info)){echo $info["worktime"];}?>" class="inputText bRadius5 w400 c-92">
			            </div>
			        </div>
			        <div>
			            <div  class="leftTd alignRight fsize16 c-92 w120 pt0"></div>
			            <div  class="rightTd alignLife">
			                <div class="recordData" data-id="1">
			                    <?php foreach($contacts as $v){
								 if(!isset($v[0])){$v[0]="";}
								if(!isset($v[1])){$v[1]="";}		
							$html="";	
							$html=$html."<div class='recordBox mt10'>
			                    <input type='text' name='contactperson[]' value='$v[0]' placeholder='联系人' class='inputText bRadius5 w190 c-92'>
			                    <input type='text' name='contactnum[]' value='$v[1]' placeholder='电话' class='inputText bRadius5 w190 ml20 c-92'><a href='javascript:void(0)' class='delete c-blue ml10'>删除</a>
			                </div> ";echo $html;}?>
			                <a href="javascript:void(0)" class="block c-blue hLh30 addRecord">新增</a>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			
			<div  width="100%" cellpadding="0" cellspacing="0" border="0" >
			  
			      <div class="Created-largetTitle pt20">
						<span>4</span>
						<div class="Created-title">  
							<span>其他设置</span>
							
						</div>
					</div>
			    <div class="form-row"><div  class="name">微信二维码</div></div>
			    <div style="position: relative; height:320px;">
			    	<div class="form-upload" style="left: 0px; top: 30px;">
	              		<div class="js_uploadBox">
	              			<div class="js_showBox bRadiusn"><img class="js_logoBox block weixinqr" src="<?php if(!empty($info["weixinqr"])){echo Img($info["weixinqr"]);}else{echo nopic(7);} ?>" ></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-weixinqr',true));?>','930px','610px',{title:'选  择图片'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
			                    <p>限制：2MB,支持jpg|png|gif</p> 
			                     <input type="hidden" name="weixinqr">
			               </div> 
					    </div>
	              	</div>	
			   </div>
			   <div class="form-row">
			        <div  class="name">工作邮箱</div>
			        <div  class="rightTd alignLife">
			            <input type="text" name="email" value="<?php if(isset($info)){echo $info["workemail"];}?>" class="inputText bRadius5 w400 c-92">
			        </div>
			    </div>
			    <div class="form-row">
			        <div  class="name">工作地址</div>
			        <div  class="rightTd alignLife">
			            <input type="text" name="address" value="<?php if(isset($info)){echo $info["address"];}?>" class="inputText bRadius5 w400 c-92"><!--<a href="" class="ml10"><img src="<?php echo UOOT;?>Public/app/images/mapicon.png" class="verAlignMiddle" width="25"></a>-->
			        </div>
			    </div>
			     <div class="form-row">
			        <div  class="name">传真</div>
			        <div  class="rightTd alignLife">
			            <input type="text" name="fax" value="<?php if(isset($info)){echo $info["fax"];}?>" class="inputText bRadius5 w400 c-92">
			        </div>
			    </div>
			</div>
		</form>
	    <!--/table-->
	            
		<!--footer-->
		<div id="ksBoxFooter" class="form-footer">
			<div class="d-inline-block" >
				<input type="button" id="StartBtn" class="ks-bt bt-pue" value="确认修改" name="confirm">
				
			</div>
		</div>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			$('#StartBtn').on('click', function() {
				$("#myform").submit();
			});
			$('.recordData').each(function() {
				var num = $(this).find('.recordBox').size();
				$(this).attr('data-id',num);
			});
			/*增加和删除数据*/
			$('.recordData').find('.delete:first').remove();
			$('.recordBox:first').removeClass("mt10");
			$(".gTable .addRecord").click(function(){
				var i = $(this).parents('.recordData').attr('data-id');i++;
				if(i<=3){
					var html = $(this).siblings(".recordBox:first").html();
					newHtml = '<div class="recordBox mt10">'+html+'<a href="javascript:void(0)" class="delete c-blue ml10">删除</a></div>';
					$(this).before(newHtml);
					a = i-1;
					$(this).siblings('.recordBox:eq('+a+')').find('.inputText').val('');
				}else{
					i=3;
					parent.layer.msg('最多只能加三条记录');
				};
				$(this).parents('.recordData').attr('data-id',i);
				$(".recordBox").on('click','.delete',function(){
					i--;
					$(this).parents('.recordData').attr('data-id',i);
					$(this).parents('.recordBox').remove();
				});
			});
			$(".recordBox").on('click','.delete',function(){
				var i = $(this).parents('.recordData').attr('data-id');i--;
				$(this).parents('.recordData').attr('data-id',i);
				$(this).parents('.recordBox').remove();
			});
			$(".weixin-ul li").click(function(){
				$(".weixin-ul li").removeClass("curr");
				$(this).addClass("curr");
				var index = $(this).index();
				if(index==1){
					$("#contact").show();
				}else{
					$("#contact").hide();
				}
			});
		});
	
	
	</script>
	
</body>
</html>

