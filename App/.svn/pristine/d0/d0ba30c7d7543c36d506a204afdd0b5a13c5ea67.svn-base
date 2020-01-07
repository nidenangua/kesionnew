<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.uploadView.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		
		<!--header-->
	    <div class="ks-head-box">
	     	<h3 class="ks-head-title2">消息设置
				<div class="fr">	
				<?php if($setting[1]==1){?>
				<span class="fl name-nowrap">
 					累计充值邮件<font class="c-86A8F"><?php echo getLimitService(2,1);?></font>封 ，
 					剩余邮件<font class="c-86A8F"><?php echo getLimitService(2);?></font>封
				 </span>
	
				<a class="ks-setting-icon ks-setting-icon1 fl ml10" style="display: block;"   href="<?php echo M_URL('Shop','coludmanage',2);?>">购买邮件</a>			
				<?php }?>
					
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor37"><i class="iconfont icon-qm" ></i></a>									
				</div>
	     	
	     	</h3>
	    </div>
	    <!--header-->
		<!--tab-->
		<div class="ks-head-tab">
			<ul class="clearfix">
				<li><a href="<?php echo M_URL('sms/Index','','',GP('appid-17'));?>">短信设置</a></li>
				<li class="curr"><a href="<?php echo M_URL('email/Index','','',GP('appid-18'));?>">邮箱设置</a></li>
				<li><a href="<?php echo M_URL('Massage','config');?>">站内信设置</a></li>
			</ul>
		</div>
		 <!--/tab-->   
		   
			  
		<!--widget-->
		<div class="clearfix mt20">
			<div class="clearfix">
				<div class="fl">
					<span class="fl fsize14 mr10 c-666">是否开启邮箱</span>
					<span class="fl">
						<div class="form-switch" open-value="1">
							<label for="isshow1"><input type="radio" value="0" onclick="Payswitch(0)" <?php  if(isset($setting[1])){if($setting[1]==0) echo "checked";}?> >不用展示</label>
							<label for="isshow0"><input type="radio" value="1" onclick="Payswitch(1)"  <?php  if(isset($setting[1])){if($setting[1]==1) echo "checked";}else{echo 'checked';}?> >前台展示</label>
						</div>
					</span>
				</div>
				
				<div class="fr">
					<a class=" ks-bt bt-pue" href="<?php echo M_URL($this->AppName.'/Index','config','',GP(''));?>">查看邮件使用明细</a>
				</div>

			</div>
			
			
		
			
					
		</div>
		<!--/widget-->
	     
		<!--table-->
		<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batch','',GP(""));  ?>" method="post" id="myform">
			<div class="configTab mt20" style="display:block;">
				
				<?php if($setting[1]==1){?>
				
				<div class="ks-cbox clearfix"><h3 class="ks-first">邮箱配置</h3></div>
				<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20">
					<thead>
					<tr>
					 <th class="">开通状态</th>
					
					<th class="">模型</th>
					<!--<th class="alignCenter hLh40 pt0 pb0 fsize14">模型名称</th>-->
					<th class="alignCenter">内容</th>               
					<th class="">操作</th>
					<th style="width: 15%;"> <!--<input type="checkbox" class="select-checks selectAll "><span style="position: absolute;right: -10px;top:10px;">是否启用</span>--> 是否启用</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($values as $k=>$v){ ?> 
					<tr>
					<td class="c-green">已开通</td>
					<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 "><?php echo $v['modelname']?></td>
					  <!--  <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['modelname']?></td>-->
					<td class="alignLife hLh40 pt0 pb0 fsize14 c-92" style="text-align: left;"><?php echo $v['content']?></td>
					<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
					<a href="javascript:;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','edit',$v['id'],GP("appid-$this->appid")); ?>','900px','560px',{type:'top',title:'编辑模型'}); "><i class="iconfont icon-bianji4"></i> 
					   </a>
					 <a href="javascript:Confirm('是否删除此邮箱模板？','<?php echo M_URL($this->AppName.'/Index','delcontent',$v['id'],GP('')); ?>');"><i class="iconfont icon-shanchu11"></i></a> 
					</td>
					<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
                        <span class="link-switch<?php if($v["status"]==1){ echo' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Index','modelwitch',$v['id'],GP('')); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','modelwitch',$v['id'],GP('')); ?>');" value="<?php echo $v['id'] ?>"><i></i></span>
					</td>
					</tr>
					<?php }?>
					</tbody>
					</table>
					<?php echo NoC($values); $b=0?>
					<div id="unopenedmodule" style="display:none">
						<h3 class="ks-type">以下为未开通邮箱配置</h3>
						<table class="ks-table">
							<thead>
							<tr>
								<th>开通状态</th>
								<th>模型</th>
								<th>内容</th>
								<th style="text-align: left;">操作</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach($emailmodel as $k=>$v){$biaoji = 0;foreach($values as $kt=>$vt){if($v['model']==$vt['model']){$biaoji=1;}}if($biaoji==0){$b=1;?>
							<tr>
								<td style="width: 120px;">未开通</td>
								<td><?php echo $v['modelname']?></td>
								<td style="text-align: left;"><?php echo $v['content']?></td>
								<td style="width: 20%;text-align: left;"><a href="<?php echo M_URL($this->AppName.'/Index','openmodel',$v['id'],GP('')); ?>">开通</a></td>		       			       			
							</tr>
							<?php }} ?> 
							</tbody>
						</table>
					</div>
					
					<?php if($b==1){?>
			       	    <script>
			       	    	document.getElementById('unopenedmodule').style.display = 'block';
			       	    </script>
		       		<?php }?>	
					
				<?php }else{?>
				<!--数据无的情况-->
				<div class="warning">您还没有启用邮件功能</div>	
				<?php }?>
				
			</div>
		</form>
	    <!--/table-->
	            
		
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
			$('.link-switch').each(function(){
				setLinkSwitch(this)
			})
				
		});
		function Payswitch(emailstyle){
			var url = "<?php echo M_URL($this->AppName.'/Index','Emailswitch','',GP('')); ?>";
			$.ajax({
				type:"post",
				url:url,
				data:{'emailstyle':emailstyle},
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
		
		
		$(function(){	
			$('.titleTab li').click(function(){
				$(this).addClass('curr').siblings().removeClass('curr');
				$('.configTab:eq('+$(this).index()+')').show().siblings().hide();	
			})

		  $(".selectImageBtn").click(function(){
			    $("#upImg").click();  
			})	

			$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
	
		});
		
		function do_reg() { $("#myform").submit(); }
	
	
	</script>
</body>
</html>
