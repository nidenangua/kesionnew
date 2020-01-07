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
        <h3 class="fl">&nbsp;&nbsp;对象存储</h3>
		<a href="<?php echo M_URL('Vdo','aliyun');?>"  style="font-size: 16px;margin-left: 20px;">阿里云列表</a>
		<a href=""  style="font-size: 16px;margin-left: 20px;">一键对比</a> 
        <div class="fr">
            <div class="fl ks-top-search">
			<!--搜索-->	
			<form target="hidframe" class="fr">
			<select class="inputText bRadius5 fl" style="width: 150px;" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('home/Vdo','Oss'); ?>','tableid','<?php echo URL_MODEL;?>');"> 
			     <?php foreach($extends_table as $k=>$v){?>
			     <option value="<?php echo $v['tableid'];?>" <?php if($v['tableid']==$tableid) echo "selected" ;?>><?php echo $v['itemname'];?></option>
				 <?php }?>
	  	    </select>


			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected" ;?>>文件名称</option>
			     <option value="2" <?php if($keytype==2) echo "selected" ;?>>网校id</option>
	  	    </select>
			
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="submit" class="sc-button fl" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('home/Vdo','Oss'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
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
						<a class="desc" href="<?php echo M_URL('home/Vdo','Oss','',GP("byname-asc")); ?>"><i class="desc-i"></i>上传日期</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('home/Vdo','Oss','',GP("byname-desc")); ?>"><i class="asc-i"></i>上传日期</a>
					<?php }?>
				</div> 
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选
				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>结算状态：</span>
						<div>
							<a href="<?php echo M_URL('home/Vdo','Oss','',GP('status-3'));?>" class='<?php if($status==3) echo " active" ;?>'>不限</a>
							<a href="<?php echo M_URL('home/Vdo','Oss','',GP('status-PUBLISHED'));?>" class='<?php if($status=='PUBLISHED') echo " active" ;?>'>正常</a>
							<a href="<?php echo M_URL('home/Vdo','Oss','',GP('status-PROCESSING'));?>" class='<?php if($status=='PROCESSING') echo " active" ;?>'>转码中</a>
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
				<th><input  class="selectAll select-checks" name="check1" type="checkbox"></th>
				<th>排序</th>
				<th style="text-align: left;">视频名称</th>
				<th>网校id</th>
				<th>封面</th>
				<th>上传时间</th>
				<th>总容量</th>
				<th>文件类型</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			<?php foreach($values as $k=>$v){ ?>	
			<tr>
				<td><input type="checkbox" name="vdoId[]" value="<?php echo $v['id']; ?>" class="select-checks" style="display: inline-block;vertical-align: middle;"/></td>
				<td><?php echo $k+1; ?></td>
				<td style="text-align: left;width: 500px;" class="vod-minpad"><?php echo $v['filename'];?></td>
				<td><?php echo $v['wxid'];?></td>
				<td class="pnone"><img class="smimg" src="<?php echo $v['baiduPath'];?>"></td>
				<td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
				<td><?php echo $v['size'];?>M</td>
				<td><?php if($v['type']==1){echo '图片';}elseif($v['type']==3){echo '音频';}?></td>
				<td><?php if($v['status'] == 'PUBLISHED'){echo '正常';}elseif($v['status'] == 'PROCESSING'){echo '转码中';}elseif($v['status']=='DISABLED' || $v['status']=='BANNED'){echo '视频被禁止'; } ?></td>
				<td><p>
					<a onclick="addTypeChange('<?php echo M_URL('home/Vdo','playVdo',$v['id'],GP('vdoId-'.$v['baiduname'])) ?>','1000px','800px',{title:'查看内容',type:'top'})" class="deepBlue mr20">查看</a>
					<?php if($v['status'] == 'PUBLISHED'){ ?>
						<span class="blueSing form-bule mr20" onclick="window.location.href='<?php echo M_URL('home/Vdo','closeVdo',$v['id'],GP('vdoId-'.$v['baiduname'].',p-'.$now_page)) ?>'">关闭</span>
					<?php }elseif($v['status']=='DISABLED'){ ?>
						<span class="blueSing form-bule mr20" onclick="window.location.href='<?php echo M_URL('home/Vdo','openVdo',$v['id'],GP('vdoId-'.$v['baiduname'])) ?>'">开启</span>
					<?php }?>
					<span class="form-bule" onclick="window.location.href='<?php echo M_URL('home/Vdo','delVdo',$v['id'],GP('vdoId-'.$v['baiduname'])) ?>'">删除</span>
				</p></td>
			</tr>
			<?php } ?>				
		</table>	
		<?php echo Noc($values); ?>
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
