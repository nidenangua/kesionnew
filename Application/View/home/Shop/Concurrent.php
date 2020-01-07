<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>云市场</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap" >


<div class="ks-wbox  bRadius10">
		
		   	<div class="ks-head-nav">
		   		 <a  href="javascript:history.go(-1);">应用市场</a><span><em>/</em>每月并发</span>
				<!--标题-->
			</div>
		  
			<table class="ks-table pay-border">
   						<tr style="background-color: #f9f9f9;">
   							<th>年</th>
   							<th>月</th>
   							<th>允许最高并发</th>
   							<th>实际最高并发</th>
   						</tr>
   						<?php foreach($values as $k=>$v){ ?>
   						<tr>
   							<td><?php echo $v['year']; ?></td>
   							<td><?php echo $v['month']; ?></td>
   							<td><?php echo $v['amount']; ?></td>	
   							<td>0</td>
   						</tr>
   						<?php } ?>
   					</table>
   					
   					
   					<?php if(!empty($values)){?>
   					<div class="ks-bom form-footer clearfix mt20" style="border-top: 0;">
						<?php echo $page->show(3); ?>
					</div>
					<?php } ?>
				</div>
			</div>

			


</body>
</html>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
	})
</script>
