<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>基本配置</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<style type="text/css">
.configTab{display: none;}
.js_showBox{border-radius: 0;width: 240px;height: 110px;margin:0 auto;overflow: hidden; vertical-align: middle;text-align: center;border-radius:10px; line-height: 110px;}
.js_showBox img{vertical-align: middle;display: inline-block;width: auto!important;height: auto!important;max-width: 240px;min-height: auto!important;}
.form-upload p{line-height: 22px;}
.js_showBox{border:1px solid #eee;border-radius: 4px;}
.logo-name b{font-size:14px;color:#999;}
</style>
</head>
<body class="ks-wrap">
	
	<div class="ks-wbox bRadius10">
			<!--header-->
		    <div class="ks-head-box">
		     	
				<h3 class="ks-head-title2">网站设置
					<div class="fr">	
									<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor31"><i class="iconfont icon-qm" ></i></a>											
					</div>
				
				</h3>
		    </div>
		    <!--header-->
			<!--tab-->
	     	<div class="ks-head-tab">
	     			<ul class="clearfix">
	     				<li class="curr"><a href="<?php echo M_URL('config/Index','','',GP('appid-1'));?>">基本配置</a></li>
	     				<li><a href="<?php echo M_URL('Website','websitedomain'); ?>">域名设置</a></li>
	     				
	     				<li><a href="<?php echo M_URL('login/Index','','',GP('appid-20'));?>">第三方登录</a></li>
	     				<li><a href="<?php echo M_URL('Website','websiteContact'); ?>">联系方式</a></li>
	     				<li><a href="<?php echo M_URL('config/Index','wxinfo','',GP('appid-1'));?>">店铺介绍</a></li>
	     			</ul>
	     	</div>
	    	 <!--/tab-->
   	
			
			<!--table-->
			<form target="hidframe" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','websiteAdd','',GP(''));?>" method="post" class="commentForm" enctype="multipart/form-data">
		     <div class="configTab" style="display:block;">
		     	<div class="Created-largetTitle pt20">
					<span>1</span>
					<div class="Created-title"><span>基本信息设置</span></div>
				</div>
			     <div class="form-box form-upload-box">   	
			     	<div class="form-row">
						<span class="name">网站开通</span>
						<div class="clearfix">
	                       <label class="">
							 <input type="radio" name="status" class="radioInput" <?php if(isset($info)){if($info['status']==3) echo 'checked="checked"';} ?> value="3"/>
							 <span class="">正常</span>
						   </label>
	                       <label class="">
	                         <input type="radio" name="status" class="radioInput" <?php if(isset($info)){if($info['status']==0) echo 'checked="checked"';} ?>  value="0" />
	                         <span class="">关闭</span>
	                       </label>
	                     </div>
					</div>
                   	<div class="form-row">
						<span class="name">网站名称</span>
						<input type="text" name="sitename" id="sitename" value="<?php if(isset($info))echo $info['sitename'];?>" class="form-textbox" >
					</div>
					<div class="form-row" style="display: none;">
						<span class="name">是否开启百度图片缓存</span>
						<div class="form-switch clearfix" open-value="1">
							<label><input type="radio" name="isbos" value="1" <?php if($info['isbos'] == 1){ echo 'checked="checked"'; }?> class="radioInput">启用</label> 
		           			<label><input type="radio" name="isbos" value="0" <?php if($info['isbos'] == 0){ echo 'checked="checked"'; }?> class="radioInput">不启用</label>
	           			</div>
					</div>
					<!--前台 logo-->
					<div class="form-upload" style="top: 0;">
	              		<div class="js_uploadBox">
	              			<div class="js_showBox">
	              			<img class="js_logoBox block logo" src="<?php if(!empty($info)){echo Img($info['logo']);}else{ echo nopic(1);} ?>" ></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-logo',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
									<span class="js_uploadText">上传图片</span></a>
			                    <p class="logo-name"><b>前台logo</b></p> 
			                    <p>限制：2MB,支持jpg|png|gif</p> 
			                    <p style="margin-top: 0;">请上传图片尺寸145*50的大小最佳；该图片用于网站全局logo</p>
			                     <input type="hidden" name="logo">
			               </div> 
					    </div>
	              	</div>
	              	
	              	<!--后台 loginlogo-->
	              	<div class="form-upload" style="top:340px;z-index: 8;">
	              		<div class="js_uploadBox">
	              			<div class="js_showBox">
	              			<img class="js_logoBox block loginlogo" src="<?php if(!empty($info)){echo Img($info['loginlogo']);}else{ echo nopic(1);} ?>" ></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-loginlogo',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
									<span class="js_uploadText">上传图片</span></a>
								<p class="logo-name"><b>后台入口logo</b></p> 
			                    <p>限制：2MB,支持jpg|png|gif</p> 
			                    <p style="margin-top: 0;">请上传图片尺寸145*50的大小最佳；该图片用于网站登录时logo</p>
			                     <input type="hidden" name="loginlogo">
			               </div> 
					    </div>
	              	</div>
	              	
	                <!--前台 homelogo-->
	              	<div class="form-upload" style="top:680px;z-index: 8;">
	              		<div class="js_uploadBox">
	              			<div class="js_showBox">
	              			<img class="js_logoBox block homelogo" src="<?php if(!empty($info)){echo Img($info['homelogo']);}else{ echo nopic(1);} ?>" ></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-homelogo',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
									<span class="js_uploadText">上传图片</span></a>
								<p class="logo-name"><b>后台logo</b></p> 
			                    <p>限制：2MB,支持jpg|png|gif</p> 
			                    <p style="margin-top: 0;">请上传图片尺寸145*50的大小最佳；该图片用于网站前台登录时logo</p>
			                     <input type="hidden" name="homelogo">
			               </div> 
					    </div>
	              	</div>
	              	
					<div class="form-row">
						<span class="name">版权信息</span>
						<textarea name="copyright" rows="2" cols="20" class="form-textarea" id="copyright"><?php  if(isset($info)) echo $info["copyright"]?></textarea>
					</div>
					<div class="form-row clearfix">
						<span class="name">是否开启水印</span>
						<div class="form-switch" open-value="1">
							<label><input type="radio" name="isshuiyin" value="1" <?php if($isshuiyin == 1){ echo 'checked="checked"'; }?> class="radioInput">启用</label>
		           			<label><input type="radio" name="isshuiyin" value="0" <?php if($isshuiyin == 0){ echo 'checked="checked"'; }?> class="radioInput">不启用</label>
	           			</div>
					</div>
					<div class="form-row sydiv fl" <?php if($isshuiyin == 1){ echo 'style="display:block"'; }else{ echo 'style="display:none"';}?> >
						<div class="js_uploadBox">
		              		<div class="js_showBox bRadiusn">
		              		<img id="shuiyin" class="js_logoBox block shuiyin" src="<?php if(!empty($info)){echo Img($info['shuiyin']);}else{ echo '/Public/uploads/common/timg.jpg';}?>"></div>
			                <div class="btn-upload clearfix" style="text-align: center; margin-top: 30px;">
			                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-shuiyin',true));?>','930px','610px',{title:'选择图片',type:'top'});"  class="selectImageBtn">
			                    <span class="ks-bt bt-pur fn" style="background: #fff;">上传图片</span>
			                   	</a>
			                    <p class="c-999">限制：2MB,支持jpg|png|gif</p> 
			                     <input type="hidden" name="shuiyin">
			                </div>
						</div>
					</div>
					<div class="clearfix"></div>
				 </div>
			 </div>
			 <!--2-->
		     <div class="configTab" style="display: block;">
		     	<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title">  
						<span>SEO选项</span>
					</div>
				</div>
				 <div class="form-box form-upload-box">
				 	<div class="form-row">
						<span class="name">站点标题</span>
						 <input type="text" name="seotitle" value="<?php if(isset($info))echo $info["seotitle"]?>" class="form-textbox">
					</div>
	
					<div class="form-row">
						<span class="name">网站&nbsp;&nbsp;META&nbsp;&nbsp;关键词&nbsp;&nbsp;(<span class="c-red fsize12">针对搜索引擎设置的网页关键词,多个关键词请用,号分隔</span>)</span>
						<textarea name="metakeywords" rows="2" cols="20" class="form-textarea" id="copyrightinfo"><?php if(isset($info))echo $info["metakeywords"]?></textarea>
					</div>
					<div class="form-row">
						<span class="name">网站&nbsp;&nbsp;META&nbsp;&nbsp;网页描述(<span class="c-red fsize12">针对搜索引擎设置的网页描述,多个描述请用,号分隔</span>)</span>
						<textarea name="metadescription" rows="2" cols="20" class="form-textarea" id="copyrightinfo"><?php if(isset($info)) echo $info["metadescription"]?></textarea>
					</div>
				 </div>
			</div>
			
		   <div id="ksBoxFooter">
				<div class="form-footer clearfix">
					<span class="d-inline-block">
					<button type="button" id="StartBtn" id="StartBtn" class="ks-bt bt-pue"><?php if(!empty($info)){echo "保存配置";}else{echo "添加配置";} ?></button>
					
				 	</span>
				
				</div>
			</div>
	        <!--/table-->
	                
	 		<!--footer-->
			<div class="ks-bom clearfix">
				<span class="fl">
							
				</span>
						
				<div class="fr">
							
				</div>
			</div>
			<!--/footer-->
		</form>
	</div>

	    
   
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
		$('#StartBtn').on('click', function() {
			$("#myform").submit();		
		});	
		$(function(){
			$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
			$("input[type=file]").each(function(){
			});
		});
		$('[name=isshuiyin]').click(function(){
			if($(this).val() == 1){
				$('.sydiv').css('display','block');
			}else{
				$('.sydiv').css('display','none');
			}
		})
		$('[name=issbos]').click(function(){
			if($(this).val() == 1){
				$('.sydiv').css('display','block');
			}else{
				$('.sydiv').css('display','none');
			}
		})
		
		function cleckSitename(){
		    var sitename = document.getElementById("sitename").value;
			if(sitename!= ""){
			  var url = "<?php echo M_URL('website','cleckSitename'); ?>";
			  var data ={
			   sitename:sitename,
			  };
			  $.ajax({
					type:"post",
					url:url,
					data:data,
					success:function(text){
						$("#un_ck").html(result.result_desc);
					   	if(result.result_code == "OK"){
						 	$("#un_ck").css("color","green");
					   	}else{
						   alert("ss");
						  $("#un_ck").css("color","red");
					    }
					},
					error:function(){
						alert("发生了错误,请检查!");
					}
			  })
			}
		}

		
		
		
	});


</script>
<script>


</script>
</body>
</html>