<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.gy{background: #F8F8F8;}
	.smimg{height: 40px; width: 60px;border-radius: 5px;margin-top: 5px;}
	.pnone{padding:0px!important;}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;图库管理
        	<a href="javascript:;" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #188EEE;border: none;">新建文件夹</a>
        	<a href="javascript:;" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #188EEE;border: none;">上传ZIP导入</a>
        	<a href="javascript:;" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #188EEE;border: none;">同步百度云</a>
        </h3>
       
    </div>
</div>


</div>

<div id="ksBoxContent">
	<div style="padding: 30px 0px;">
		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix"> 
			<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix">
					<a class="mr20">最新上传 <i class="desc-i"></i></a>
				</div> 
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>结算状态：</span>
						<div>
							<a href="" class="active">不限</a>
							<a href="">正常</a>
							<a href="">关闭</a>
							
						</div>
					</li>
				</ul>

			</li>				
		</ul>	
	</div>
	

	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
				<th><input type="checkbox" class="select-checks" /></th>
				<th>图片目录</th>
				<th>修改时间</th>
				<th>类型</th>
				<th>大小</th>
				<th>操作</th>
			</tr>
					
			<tr>
				<td><input type="checkbox" class="select-checks" /></td>
				<td>H6</td>
				<td>2018-2-28</td>
				<td>目录</td>
				<td>45M</td>
				<td><p>
					<a href="<?php echo UOOT;?>admin.php/home/Capital/withdrawinfo" class="deepBlue mr20">编辑</a>
					<span>删除</span>
				</p></td>
			</tr>
			<tr class="gy">
				<td><input type="checkbox" class="select-checks" /></td>
				<td>H6</td>
				<td>2018-2-28</td>
				<td>目录</td>
				<td>45M</td>
				<td><p>
					<a href="<?php echo UOOT;?>admin.php/home/Capital/withdrawinfo" class="deepBlue mr20">编辑</a>
					<span>删除</span>
				</p></td>
			</tr>	
			
			
							
		</table>	
		
		</div>
		
	</div>
	
	
	<div>
		
		
		
	</div>
	</div>
	
	<br />	
	<br />	
	<br />	
	<br />	

</div>


<div class="footer-page h60">
    <div class="col-sm-5">
     <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input  class="selectAll select-checks" name="check1" type="checkbox">
            <label for="checkboxAll">全选 </label>
        </div>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
    </div>

    <div class="col-sm-7 " style="margin-top:7px">
    	<div class="page-box"><ul class="pagination-digg"><a href="/admin.php/home/Capital?p-1">首页</a>

<li class="previous-off">上一页</li>
<li class="active">1</li><li><a href="/admin.php/home/Capital?p-2">2</a></li><li><a href="/admin.php/home/Capital?p-3">3</a></li><li><a href="/admin.php/home/Capital?p-4">4</a></li><a href="/admin.php/home/Capital?p-2">下一页</a>

<a href="/admin.php/home/Capital?p-4">末页</a>

</ul><div class="page-left">总计 33 个记录分为 4 页, 当前第 1 页 ,每页 <input type="text" class="page-input" value="10" id="pageSize" size="3"> </div></div>	
    </div>
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>


<!--<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.w80 {width: 80px;}
</style>
</head>
<body class="gray-bg">
<div class="wrapper mt0">
    <div id="manage_top" class="menu_top_fixed p15 height73">
        <ul style=" float:left;">
        	<li><a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Domain','TempaddFile','',GP('tempdir-'.urlencode($tempdir),true));?>','650px','400px');"><i class="one2017"></i>上传文件</a></li>
            <li><a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Domain','TempaddFile','',GP('tempdir-'.urlencode($tempdir),true));?>','650px','400px');"><i class="one2017"></i>新建文件夹</a></li>
            <?php if(!empty($first)){?>
            <li><a href="<?php echo M_URL('Domain','imageslist');?>"><i class="one2017"></i>顶层目录</a></li>
            <?php }?>
            <li><a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Domain','Syncimages','',GP('tempdir-'.$tempdir,true));?>','450px','250px');"><i class="one2017"></i>同步到百度云（当前目录）</a></li>	
        </ul>
        <div class="ibox-tools" >
            <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                <i class="reflash"></i>
            </a>
        </div>
    </div>
</div>
<div class="ibox-content"><br /><br />
<div class="panel-heading">图库管理-----/<?php echo $tempdir;?></div>
<table class="table " >
    <thead>
    <tr>
        <th>图片目录</th><th>类型</th><th>大小</th><th>修改时间</th><th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($first)){?>
    <tr onClick="skip('<?php echo M_URL('Domain','imageslist');?>')">
        <td>(..顶层目录)</td><td></td><td></td><td></td><td></td>
    </tr>	
    <tr onClick="skip('<?php echo M_URL('Domain','imageslist','',GP('tempdir-'.$tempdir.',back-1',true));?>')">
        <td>(.上层目录)</td><td></td><td></td><td></td><td></td>
    </tr>
    <?php }?>
    <?php foreach($dirname as $k=>$v){?>
    <tr onClick="skip('<?php echo M_URL('Domain','imageslist','',GP('tempdir-'.$tempdir.',nowdir-'.urlencode($v),true));?>')">
        <td><i <?php if(is_dir($dir.$v)) {echo 'class="save"';}else{echo 'class="ie-icon"';}?>></i><?php echo iconv('gbk','utf-8',$v); ?></td>
        <td>目录</td>
        <td>3K</td>
        <td>2017/1/9 15:26:14</td>
        <td class="w80" onClick="doNone(event)"><i class="edit2017"></i></td>

    </tr>
    <?php }?>
    <?php foreach($filename as $k=>$v){?>
    <tr>
        <td><i <?php if(is_dir($dir.$v)) {echo 'class="save"';}else{echo 'class="ie-icon"';}?>></i><?php echo iconv('gbk','utf-8',$v); ?></td>
        <td>图片</td>
        <td>3K</td>
        <td>2017/1/9 15:26:14</td>
        <td class="w80"><a href="javascript:void(0);" onclick="Confirm('是否删除此文件？该操作不可逆！','<?php echo M_URL('Temp','deletetempDir',$tempid,GP('option-'.$option.',tempdir-'.$tempdir.',nowdir-'.urlencode($v),true));?>')"><i class="delete2017"></i></a></td>
    </tr>
    <?php }?>
    
    </tbody>
</table>
<?php if(empty($dirname)&&empty($filename)){?>
<div class="emptycss">没有发现任何内容</div>
<?php }?>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
</body>
</html>-->