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
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		
		<!--header-->
	    <div class="ks-head-box">
	     	<h3 class="ks-head-title2">消息设置
	     		<div class="fr">	
	     			
	     		<span class="fl name-nowrap">
	     			累计发送站内信：<i class="c-86A8F"><?php echo $numb;?></i>封
	     		</span>
	     		 <a class="ks-setting-icon ks-setting-icon1 fl ml10"  href="<?php echo M_URL('Massage','postmassage','',GP('appid-18,option-2,entrance-1'));?>">发送站内信</a>
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor38"><i class="iconfont icon-qm" ></i></a>											
			</div>
	     	
	     	</h3>
	    </div>
	    <!--header-->
		<!--tab-->
		<div class="ks-head-tab">
			<ul class="clearfix">
			<li><a href="<?php echo M_URL('sms/Index','','',GP('appid-17'));?>">短信设置</a></li>
			<li><a href="<?php echo M_URL('email/Index','','',GP('appid-18'));?>">邮箱设置</a></li>
			<li class="curr"><a href="<?php echo M_URL('Massage','config');?>">站内信设置</a></li>
			</ul>
		</div>
		 <!--/tab-->   
		
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="fl ks-txtLeft" style="width: 100%;">
				
				<p class="fsize14 c-999 mt10">
					<div class="fr">
				
					<a class=" ks-bt bt-pue ml10" href="<?php echo M_URL('Massage','postlist','',GP('appid-18,option-2,entrance-1'));?>">查看站内信发送记录</a>
					</div>
				</p>
			</div>					
		</div>
		<!--/widget-->
	     
		<!--table-->
		<form target="hidframe"  action="<?php echo M_URL('Index','batch','',GP(""));  ?>" method="post" id="myform">
		<div class="ks-cbox clearfix" ><h3 class="ks-first" style="margin-left: 0;">站内信配置</h3></div>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
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
		                    <a href="javascript:;" onclick="addTypeChange('<?php echo M_URL('Massage','edit',$v['id'],GP('')); ?>','900px','480px',{type:'top',title:'编辑模型'}); "><i class="iconfont icon-bianji4 mr10"></i> 
		                   </a>
		                 <a href="javascript:Confirm('是否删除此站内信模板？','<?php echo M_URL('Massage','delmassage',$v['id'],GP('')); ?>');"><i class="iconfont icon-shanchu1"></i></a> 
		                </td>
		                <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
                        	<span class="link-switch<?php if($v["status"]==1){ echo' open'; }?>" data-off="<?php echo M_URL('Massage','modelwitch',$v['id'],GP('')); ?>" data-open="<?php echo M_URL('Massage','modelwitch',$v['id'],GP('')); ?>" value="<?php echo $v['id'] ?>"><i></i></span>
		           		</td>
		            </tr>
	            <?php }?>
	            </tbody>
		        </table>
	       		<?php echo NoC($values);?>
	        	<h3 class="ks-type">以下为未开通站内信配置</h3>
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
			       		<?php foreach($massagemodel as $k=>$v){$biaoji = 0;foreach($values as $kt=>$vt){if($v['model']==$vt['model']){$biaoji=1;}}if($biaoji==0){?>
			       		<tr>
			       			<td style="width: 120px;">未开通</td>
			       			<td><?php echo $v['modelname']?></td>
			       			<td style="text-align: left;"><?php echo $v['content']?></td>
			       			<td style="width: 20%;text-align: left;"><a href="<?php echo M_URL('Massage','openmodel',$v['id'],GP('')); ?>">开通</a></td>		       			       			
			       		</tr>
			       		<?php $len = 0;}}?>
			       			
			       		<?php if(!isset($len)){
			       			echo '<tr><td colspan="4" style="border:none;"><div class="empty">您还没有启用站内信功能<div></td></tr>';
			       		}?>
			       			
			       	</tbody>
		       </table>
		</form>
	    <!--/table-->
	            
	
	</div>
	

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll','uploadView'],function(){
		loadScorllJs()
		$('.link-switch').each(function(){
			setLinkSwitch(this)
		})
		/*设置切换*/
		$(function(){	
			$('.titleTab li').click(function(){
				$(this).addClass('curr').siblings().removeClass('curr');
				$('.configTab:eq('+$(this).index()+')').show().siblings().hide();	
			})
		});
		$(function(){
		  $(".selectImageBtn").click(function(){
			    $("#upImg").click();  
			})	
		})
		$(function(){
			$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
		});
	});

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
	
	function do_reg()
	{   
		$("#myform").submit();	
	}
</script>
</body>
</html>
