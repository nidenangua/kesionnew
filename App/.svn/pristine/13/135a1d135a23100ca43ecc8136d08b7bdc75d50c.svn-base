
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">

	
		
		<div class="ks-wbox bg-white bRadius10">
			
			<div class="ks-head-nav ks-head-only-nav" style="margin-bottom: 20px;">
				<!--标题-->
				<a href="javascript:history.go(-1);">意向本</a><span> <em>/</em> 沟通记录</span>
			</div>
			
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
            <thead>
                <tr>
                    <th>沟通人</th>
                    <th>回访日期</th>
                    <th>回访结果</th>
                    <th>备注</th>
                </tr>
            </thead>
            
            <tbody>
            	<?php  foreach($values as $k =>$v){?>
             <tr>
             	
            	<td><?php echo $v['name']; ?></td>
            	  <td style="color: green"><?php echo date('Y-m-d',$v['startime']); ?></td>
            	  <td class="c-86A8F"><?php if($v['restult']==0){echo '考虑中';}elseif($v['restult']==1){echo '已成单';}elseif($v['restult']==2){echo '无意向';}elseif($v['restult']==3){echo '想试听';}elseif($v['restult']==4){echo '已加入学生档案';}elseif($v['restult']==5){echo '无效';}  ?></td>
            	  <td style="text-align: left;"><?php echo $v['mark'] ?></td>
            </tr>
            <?php  }?>
            </tbody>
            </table>
            <?php echo Noc($values)?>
            	 <div  class="clearfix ks-popup-footer form-footer">
		 
					<div class="fr">
						<?php echo $page->show(3); ?>
					</div>
			
			
				</div>  
		</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll','laydate'],function(){
			loadScorllJs();
		})
	</script>
</body>