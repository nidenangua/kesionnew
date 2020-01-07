

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>套餐情况</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css"> 
	.Created-largetTitle{padding: 0px;}
	.Created-title span:last-child { margin-left:0px; }
	.Created-title span{ color: #000000;}
	.Created-push .contents{padding-top: 20px;}
	.Created-push #tables td,th{border-bottom: 1px dashed #eee;}
</style> 
<body class="gray-bg">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row" id="ksBoxHead">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	套餐情况
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button type="button" class="ks-bt bt-def" onclick="history.go(-1);"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
    </div>
</div>
</div></form>

<br />
<br />
<br />


<div class="Created-push" id="ksBoxContent">
	<ul>
		
		<li>
			<div class="Created-largetTitle">
				<div class="Created-title">
					<span>基本信息</span>
					<span class="fr">目前拥有的套餐：<?php echo $this->cache->GetA('commonpackageversion','versionename',$package,'versionname');?></span>
				</div>
			</div>
			<div class="contents">
				<table  class="ks-table" id="tables">
					<tr style="background: #EEEEEE;">
						<th>更改时间</th>
						<th>更改套餐</th>
						<th>到期时间</th>
						<th>支付费用</th>
					</tr>
					<?php foreach($value as $k =>$v){ ?>
					<tr>
						<td><?php echo date('Y-m-d',$v['packstartime']) ?></td>
						<td><?php echo $this->cache->GetA('commonpackageversion','versionename',$v['package'],'versionname');?></td>
						<td><?php echo date('Y-m-d',$v['packendtime']) ?></td>
						<td><?php echo $v['money']==0?'系统充值':$v['money']; ?></td>
					</tr>
					<?php }?>
				</table>
				
				
			</div>
			
			
		</li>
		
	</ul>
	<div id="ksBoxFooter" style="height: 200px;"></div>
</div>
	


	
<div class="footer-page">
    <div class="col-sm-5"></div>
    <div class="col-sm-6 mt10">
        <a href="javascript:history.go(-1);" class="btn btn-default btn-s-md">返回</a> 
    </div>
</div>
</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>

</html>
