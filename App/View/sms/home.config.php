<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>短信设置</title>

<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
	.ks-txtLeft h3{height: 20px;line-height: 20px;margin-bottom: 10px;}
	.ks-first {margin-left: -15px;padding-left: 10px;border-left:3px solid #2878FF}
	.ml50{margin-left: 50px!important;}
	.check-crb{padding: 30px;text-align: center;}
	.check-empty{text-align: center;font-size: 16px;color:#333;margin-bottom: 20px;}
	.check-icon {display: inline-block;width: 45px;height: 45px;border-radius: 50%;background: red;vertical-align: middle;text-align: center;line-height: 45px;margin-bottom: 10px;}
	.check-icon i{font-size: 24px;color: #fff;}
</style>
</head>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
     	<h3 class="ks-head-title2">消息设置
     		<div class="fr">	
     			<span class="fl name-nowrap">
 					累计充值短信<font class="c-86A8F"><?php echo getLimitService(1,1);?></font>条
 					剩余短信<font class="c-86A8F"><?php echo getLimitService(1);?></font>条
				 </span>
			
				  <a class="ks-setting-icon ks-setting-icon1 fl ml10" target="_blank" href="<?php echo M_URL('Shop','coludmanage',1);?>">购买短信</a>
				 
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor35"><i class="iconfont icon-qm"></i></a>		
													
			</div>
     		
     	</h3>
    </div>
    <!--header-->
	<!--tab-->
	<div class="ks-head-tab">
		<ul class="clearfix">
		<li class="curr"><a href="<?php echo M_URL('sms/Index','','',GP('appid-17'));?>">短信设置</a></li>
		<li><a href="<?php echo M_URL('email/Index','','',GP('appid-18'));?>">邮箱设置</a></li>
		<li><a href="<?php echo M_URL('Massage','config');?>">站内信设置</a></li>
		</ul>
	</div>
	 <!--/tab-->   
		  
	<!--widget-->
	<div class="ks-head-widget clearfix">
					
				
		<div class="clearfix">
			<span class="fl fsize14 mr10 c-666">是否开启短信</span>
			<span class="fl">
			<div class="form-switch" open-value="1">
				<label for="isshow1"><input type="radio" value="0" onclick="Payswitch(0)" <?php  if(isset($setting[1])){if($setting[1]==0) echo "checked";}?> >不用展示</label>
				<label for="isshow0"><input type="radio" value="1" onclick="Payswitch(1)"  <?php  if(isset($setting[1])){if($setting[1]==1) echo "checked";}else{echo 'checked';}?> >前台展示</label>
			</div>
			</span>
			
			
			<span class="fr">
				<a href="<?php echo M_URL($this->AppName.'/Index','config','',GP('')); ?>" class="fr ks-bt bt-pue mr10">查看短信使用明细</a>
			</span>
		</div>
		
		<div class="ks-search-box mt20">
		<?php if($setting[1]==1){?>	
    		<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','smssign','',GP('')); ?>" method="post" id="myform1" > 		
				<h3 style="margin-bottom: 10px;">短信签名</h3> 
				<input type="text" class="form-textbox w200 fl" <?php if($smssignstatus!=0){?>disabled="disabled"<?php }?> name="signsms" value="<?php echo $signvalue['signsms'];?>">
				<?php if($smssignstatus==0){?>	 
				<button <?php if($realnamestatus==1){?>type="submit"<?php }else{?>type="button" onclick="checkAffirm();"<?php }?> class="ks-bt bt-pur fl ml10">提交审核</button>
				<?php }elseif($smssignstatus==1){ ?>
				<span style="color: red;display:inline-block ;margin-left:10px ;">审核中</span>
				<?php }elseif($smssignstatus==2){ ?>
				<span style="color: green;display: inline-block;margin-left:10px">审核通过</span>
				<?php }?>
				
			</form>
		<?php }?>
		</div>	
				
	</div>
	<!--/widget-->
     
	<!--table-->
	<?php if($setting[1]==1){?>	
		
	<?php }?>

	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','doUpdateSms','',GP('')); ?>" method="post" id="myform" > 
		    <?php if($setting[1]==1){?>   
            <div class="configTab clearfix mt20">
              	
              	<h3  style="margin-left: 0;">短信配置</h3>
            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20">
	            <thead>
		            <tr>
	            	<th>开通状态</th>
	            	<th>模型</th>
	                <th class="alignCenter hLh40 pt0 pb0 fsize14">内容</th>  
	                <th style="width: 16%;">是否启用</th>
	                <th width="60">操作</th>  
		            </tr>
	            </thead>
	            <tbody>
  				<?php foreach($values as $k=>$v){ ?>
		            <tr>
		            	<td class="c-green" style="width: 120px;">已开通</td>
                        <td class="alignCenter"  style="width: 30%;"><?php echo $v['model'] ?></td>
		                <td style="text-align: left;"><?php echo $v['content'] ?><!--<input type="text" name="content[]" value="<?php echo $v['content'] ?>" style="width: 680px;"/>--></td>
		                <td class="alignLife hLh40 pt0 pb0 fsize14 c-92">
		                	<input type="hidden" name="id[]" value="<?php echo $v['id'] ?>">
                        	<span class="link-switch<?php if($v["status"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Index','modelwitch',$v['id'],GP('')); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','modelwitch',$v['id'],GP('')); ?>');" value="<?php echo $v['id'] ?>"><i></i></span>
                        </td>
		                <td><i class="iconfont icon-shanchu1" style="cursor: pointer;" onclick="Confirm('是否删除此短信模板？','<?php echo M_URL($this->AppName.'/Index','delcontent',$v['id'],GP('')); ?>');"></i></td>
		            </tr>
	             <?php } ?>   
	            </tbody>
		        </table>
		        <?php echo NoC($values);$b=0;?>
		        
		       <div id="unopenedmodule" style="display:none">
			       <h3 class="ks-type">以下为未开通短信配置</h3>
			       <table class="ks-table">
				       	<thead>
				       		<tr>
				       		<th>开通状态</th>
				       		<th style="width: 30%;">模型</th>
				       		<th>内容</th>
				       		<th style="text-align: left;">操作</th>
				       		</tr>
				       	</thead>
				       	<tbody id="conts">
				       		<?php foreach($smsmodel as $k=>$v){$biaoji = 0;foreach($values as $kt=>$vt){if($v['modelname']==$vt['modelname']){$biaoji=1;}}if($biaoji==0){$b=1;?>
				       		<tr>
			       			<td style="width: 120px;">未开通</td>
			       			<td><?php echo $v['model'];?></td>
			       			<td style="text-align: left;"><?php echo $v['content'];?></td>
			       			<td style="width: 20%;text-align: left;"><a href="<?php echo M_URL($this->AppName.'/Index','openmodel',$v['id'],GP('')); ?>">开通</a></td>		       			       			
				       		</tr>
				       		<?php }} ?> 
				       	</tbody>
			       </table>
		        	<?php if($b==1){?>
			       	    <script>
			       	    	document.getElementById('unopenedmodule').style.display = 'block';
			       	    </script>
		       		<?php }?>	
         		</div>
         	</div>
         	<input type="hidden" name="batch" id="batch1" /> 	 
         	<?php }else{?>
			<!--数据无的情况-->
			<div class="warning">您还没有启用短信功能</div>
			<?php }?>
		</form>
    <!--/table-->
            

</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){ 
		loadScorllJs()
		$('.link-switch').each(function(){
			setLinkSwitch(this)
		})
		var conts = $("#conts").html();
		console.log(conts);
		if(conts==""){
			 $("#conts").html('<div class="empty"> <a>您还没有启用短信功能</a> </div>');
		}
		
	});
	function Payswitch(smsstyle){
			var url = "<?php echo M_URL($this->AppName.'/Index','Smsswitch','',GP('')); ?>";
			$.ajax({
				type:"post",
				url:url,
				data:{'smsstyle':smsstyle},
				success:function(data){
				   if(data=='succeed'){
					   location.reload();		
				   }else if(data=='faild'){
				 	   Alert('开启失败');
				   }
				},
			    error:function(){
				    location.reload();
				}
			});
		}
		function modelwitch(url){
			$.ajax({
				type:"post",
				url:url,
				success:function(data){},
			    error:function(){
				    location.reload();
				}
			});
		}	
		function submitform(type){
			$('#batch1').val(type);
			$('#myform').submit();
		}
		function checkAffirm() {
			var contentValue='',
			e = window.event || event;
			contentValue ='<div class="popup-open">'+
						 '<div class="check-icon"><i class="icon-gantanhao iconfont"></i></div> '+
			 			 '<div class="check-empty">您还未进行实名认证</div>'	+
			 			 '<div class="app-footer clearfix">'
			 			 '<div class="check-btn clearfix"><button  class="ks-bt " onclick="closePopupBox()">取消</button>'+
			 			 '<a href="<?php echo M_URL('User','realName'); ?>" class="ks-bt bt-pue" style="float:right">去认证</a></div></div></div>'
							
				top.popup.open(false,{
				title:'实名认证',
				area:['440px','400px'],
				heightAuto:true,
				content:contentValue
			});		
		}
 
</script>
</body>
</html>

