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
	@media (max-width:1600px ) {
		.vod-minpad {width: 300px!important;}
	}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;阿里云列表</h3>
        <a href="<?php echo M_URL('Vdo','Oss');?>" style="font-size: 16px;margin-left: 20px;">对象存储</a>
        <a href=""  style="font-size: 16px;margin-left: 20px;">一键对比</a> 
        <div class="fr">
            <div class="fl ks-top-search">
			<!--搜索-->	
			<form target="hidframe" class="fr">
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected" ;?>>视频名称</option>
			     <option value="2" <?php if($keytype==2) echo "selected" ;?>>网校id</option>
	  	    </select>
			
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="submit" class="sc-button fl" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('home/Vdo','index'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>	
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo M_URL('home/Vdo','batch','',GP('')) ?>" class="form-horizontal" enctype="multipart/form-data">
	<div style="padding: 20px 0px;">
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix"> 
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li></li>
			<li>
				<div class="shaixuan clearfix">
					<?php if($byname == 'desc'){?>
						<a class="desc" href="<?php echo M_URL('home/Vdo','index','',GP("byname-asc")); ?>"><i class="desc-i"></i>上传日期</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('home/Vdo','index','',GP("byname-desc")); ?>"><i class="asc-i"></i>上传日期</a>
					<?php }?>
				</div> 
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选
				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>结算状态：</span>
						<div>
							<a href="<?php echo M_URL('home/Vdo','index','',GP('status-3'));?>" class='<?php if($status==3) echo " active" ;?>'>不限</a>
							<a href="<?php echo M_URL('home/Vdo','index','',GP('status-PUBLISHED'));?>" class='<?php if($status=='PUBLISHED') echo " active" ;?>'>正常</a>
							<a href="<?php echo M_URL('home/Vdo','index','',GP('status-PROCESSING'));?>" class='<?php if($status=='PROCESSING') echo " active" ;?>'>转码中</a>
						</div>
					</li>
				</ul>
			</li>				
		</ul>	
	</div>
	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<?php echo $Data001['prefix'];?>
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
				<th><input  class="selectAll select-checks" name="check1" type="checkbox"></th>
				<th style="text-align: left;">文件名（Object Name）</th>
				<th>文件大小</th>
				<th>存储类型</th> 
				<th>更新时间</th>
				<th>操作</th>
			</tr>
			<?php foreach($values as $k=>$v){ ?>	
			<tr>
				<td><input type="checkbox" name="vdoId[]" value="" class="select-checks" style="display: inline-block;vertical-align: middle;"/></td>
				<td style="text-align: left;"><a href="<?php echo M_URL('home/Vdo','aliyun','',GP('path-'.$v->getPrefix())); ?>"><?php echo $v->getPrefix();?></a></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php } ?>	
			<?php foreach($ObjectList as $kt=>$vt){ ?>	
			<tr>
				<td><input type="checkbox" name="vdoId[]" value="" class="select-checks" style="display: inline-block;vertical-align: middle;"/></td>
				<td style="text-align: left;"><?php echo $vt->getKey();?></td>
				<td><?php echo $vt->getSize();?></td>
				<td><?php echo $vt->getType();?></td>
				<td><?php echo $vt->getLastModified();?></td>
				<td></td>
			</tr>
			<?php } ?>
		</table>	
		<?php if(empty($values)&&empty($ObjectList)){?>
		<div class="bg-white bRadius10"><div class="emptycss">没有发现任何内容</div></div>
		<?php }?>
		</div>
	</div>
	<div>
	</div>
	</div>
	<div class="footer-page h60">
    <div class="col-sm-5">
	    <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                <input class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
                <label for="sAll">全选 </label>
            </div>
        <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量审核</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">取消审核</button>-->
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
	</div>
    <div class="col-sm-7 " style="margin-top:7px">
    	<?php echo $page->show(3); ?>
    </div>
	<br />	
	<br />	
	<br />	
	<br />	
</div>

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<!--<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="<?php echo UOOT; ?>Public/admin/css/general.css" rel="stylesheet">
    <link href="<?php echo UOOT; ?>Public/admin/fonts/iconfont.css" rel="stylesheet">
    <link href="<?php echo UOOT; ?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    <style>
        .down {
            display: none;
        }
        .pos3{
            position: relative;
            top: 3px;
        }
        .mrl{
            line-height: 36px;
            margin-right: 10px;
        }

        .nav.nav-tabs li {width:95px}
        .con-img {border-radius: 0}
        .con-count li {display: inline-block;margin-left: 15px;}
        .console-right {
            position: absolute;
            right: 0;
            bottom:20px;;
        }
        .mr15{margin-left: 15px}
        .console-box:hover {background-color: #eef9fe;}
    </style>
</head>
<body class="gray-bg" style="background-color: #f3f3f3">
<div class="wrapper">
       <a href="<?php echo  M_URL('Vdo','storageSettlement') ?>">存储结算</a>
       <a href="<?php echo  M_URL('Vdo','flowSettlement') ?>">流量结算</a>
       <a href="<?php echo  M_URL('Vdo','playVdo') ?>">播放测试</a>  
    <div class="row">
        <div class="tabs-container">
            <div class="tab-content">
                <div class="tap-pane" style="display: block">
                    <div class="panel-body">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
					    <tr>
					    	<td class="form-in">序号</td>
						 	<td class="form-in">封面</td>
						 	<td class="w50 alignCenter">名称</td>
						 	<td class="form-in">时长</td>
						 	<td class="form-in">总容量</td>
						 	<td class="form-in">状态</td>
						 	<td class="w50">操作</td>
					    </tr>
					</table>
					<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
				        <?php foreach($values as $k=>$v){ ?>
					    <tr>
					    	<td class="form-in"><?php echo $k+1; ?></td>
						 	<td class="form-in"><img src="<?php echo $v['vdoImg']; ?>" width="30px" height="30px"></td>
						 	<td class="w50 alignCenter">
								<?php echo $v['vdoName'];?>
							</td>
							
							<td class="form-in"><?php echo date('H:i:s',$v['playtime']); ?></td>
						 	<td class="form-in"><?php echo $v['vdoSize']; ?>M</td>
							<td class="form-in"><?php if($v['status'] == 'PUBLISHED'){echo '正常';}elseif($v['status'] == 'PROCESSING'){echo '转码中';}elseif($v['status']=='DISABLED' || $v['status']=='BANNED'){echo '视频被禁止'; } ?></td>
				         	<td class="w50">
				         	</td>
					   </tr>
				       <?php } ?>
					</table>
                    <?php echo $page->show(3); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
$(function(){
loadScorllJs();//滚轮
})
</script>
</body>
</html>-->