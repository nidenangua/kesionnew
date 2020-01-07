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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title">
     		<div class="ks-head-nav" style="height: 16px;">
			<!--标题-->
			<a href="<?php echo M_URL('Capital'); ?>">我的财富</a><span><em>/</em>代金券使用明细</span>
			<!--标题-->
			</div>
		</h3>
	    </div>
	    <!--header-->
					     
    	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','paybatch','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
	
			</div>					
					
			<div class="fr">
						
			</div>
					
		</div>
		<!--/widget-->
	     
		<!--table-->
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
            <thead>
                <tr>
                    <th>时间</th>
                    <th>代金券名称</th>
                    <th>充值/支出</th>
                    <th>余额</th>
                    <th>操作员</th>
                    <th>备注</th>
                </tr>
            </thead>
            <tbody>
			<?php foreach($values as $k=>$v){if($v['type'] ==0){$status = '未审核';}else{$status = '已审核';}?> 
            <tr>
            	  <td><?php echo Field(date('Y-m-d H:i:s',$v['adddate']));?></td>
            	  <td><?php echo Field($v['vouchername']);?></td>
                  <td style="color: <?php if($v['type']==0){echo 'red';}else{echo 'green';}; ?>"><?php if($v['type']==0){echo '充值';}else{echo '支出';}; ?><?php echo Field($v['cmoney']);?></td>
           		  <td><?php echo Field($v['balance']);?></td>	
            	  <td><?php if($v['type']==0){echo 'admin';}else{echo 'system';}; ?></td>
          		  <td style="text-align: left;"><?php echo Field($v['mark']);?></td>
            </tr>
			<?php }?>
            </tbody>
        </table>
        <?php echo NoC($values);?>
	    <!--/table-->
	            
		<!--footer-->
		<?php if(!empty($UsersAll)){?>
		<div class="ks-bom clearfix">
			<span class="fl">
				<button class="ks-heade-button mr10" type="submit" name="batch" value="1"><i class="iconfont icon-shanchu1"></i>批量删除</button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		<?php }?>
		<!--/footer-->
    	</form>
	
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			
		});
	</script>
</body>
</html>