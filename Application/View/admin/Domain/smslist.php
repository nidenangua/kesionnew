<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.curr{
  border-image: none;
    border-style: solid;
    border-width: 1px;
    color: #555;
    cursor: default;
    border-top: 0;
    background-color: #fff!important;
}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;短信签名审核</h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected"; ?>>网校名称</option>
			     <option value="2" <?php if($keytype==2) echo "selected"; ?>>签名名称</option>
	  	    </select>
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
           <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Domain','smslist'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo M_URL('home/Domain','smsbatch','',GP('p-'.$page->now_page)) ?>" class="form-horizontal" enctype="multipart/form-data">
	<div style="padding: 40px 0px;">
	<div class="H5-gameListScreen">
		<ul class=" nav nav-tabs">
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==3) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('home/Domain','smslist','',GP("status-3")); ?>">不限</a>
	        </li>
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==2) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('home/Domain','smslist','',GP("status-2")); ?>" >已审核</a>
	        </li>
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==0) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('home/Domain','smslist','',GP("status-0")); ?>" >不通过</a>
	        </li>
	         <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==1) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('home/Domain','smslist','',GP("status-1")); ?>" >未审核</a>
	        </li>
	    </ul>
<!-- 		<ul class="H5-gameOpt clearfix"> 
			<li style="margin-right: 15px;margin-top: 5px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li> -->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
<!-- 			<li>
				<div class="shaixuan clearfix">
					<?php if($byname == 'wxid asc'){?>
						<a class="desc" href="<?php echo M_URL('home/Domain','smslist','',GP("byname-wxid desc")); ?>"><i class="desc-i"></i>创建时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('home/Domain','smslist','',GP("byname-wxid asc")); ?>"><i class="asc-i"></i>创建时间</a>
					<?php }?>
				</div> 
			</li> -->
<!-- 			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选
				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>结算状态：</span>
						<div>
							<a href="">不限</a>
							<a href="<?php echo M_URL('home/Domain','smslist','',GP("status-2")); ?>" class="<?php if($status ==2){ echo 'active';}?>"></a>
							<a href="<?php echo M_URL('home/Domain','smslist','',GP("status-0")); ?>" class="<?php if($status ==0){ echo 'active';}?>">不通过</a>
							<a href="<?php echo M_URL('home/Domain','smslist','',GP("status-1")); ?>" class="<?php if($status ==1){ echo 'active';}?>">未审核</a>
						</div>
					</li>
				</ul>
			</li>				
		</ul> -->	
	</div>
	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;margin-bottom: 150px;">
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
				<th><input type="checkbox" class="select-checks fl" /></th>
				<th>签名名称</th>
				<th>网校名称</th>
				<th>是否认证</th>
				<th class="shaixuan">
					<?php if($byname == 'wxid asc'){?>
						<a class="desc" href="<?php echo M_URL('home/Domain','smslist','',GP("byname-wxid desc")); ?>" style="    float: none;"><i class="desc-i" style="top: 5px;"></i>创建时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('home/Domain','smslist','',GP("byname-wxid asc")); ?>" style="    float: none;"><i class="asc-i" style="top: 5px;"></i>创建时间</a>
					<?php }?>
				</th>
				<th>审核状态</th>
				<th>操作</th> 
			</tr>
            <?php foreach($values as $k=>$v){?>
			<tr <?php if($k%2==0){?>class="gy"<?php }?>>
				<td><input type="checkbox" class="select-checks fl" name="check[]" value="<?php echo $v['id'] ?>" /></td>
				<td><?php echo Field($v['signsms']);?></td>
				<td><?php echo Field($v['sitename']);?></td>
				<td><?php if(getRealnameStatus($v['wxid'])==1){?>是<?php }else{?>否<?php }?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
				<td><?php if($v['status']==2){?><span style="color:#5AB22E;">通过</span><?php }else{?><span style="color:red;">不通过</span><?php }?></td>
				<td>
					<p>
						<a href="<?php echo M_URL('Users','Noreal',$v['wxid'],GP('')); ?>" class="form-bule mr20">查看认证</a>
						<?php if($v["status"]==2){ ?>
                         <a class="ok-icon ok-pe1" href="<?php echo M_URL('home/Domain','smsunaudited',$v['wxid'],GP('p-'.$page->now_page));?>" title="不通过"></a>
                        <?php }elseif($v["status"]==1){ ?>
                         <a class="ok-icon ok-pe2" href="<?php echo M_URL('home/Domain','smsaudited',$v['wxid'],GP('p-'.$page->now_page));?>" title="通过"></a>
                        <?php } ?>
					</p>
				</td>
			</tr>	
			<?php }?>
		</table>
		<?php echo NoC($values);?>	
		</div>
		<div class="footer-page h60">
		    <div class="col-sm-5">
				   <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
		            <input class="selectAll select-checks" name="check1" type="checkbox" id="checkboxAll" style="display: none;"> 
		            <label for="checkboxAll">全选</label>
		         </div>
		        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
		        <button class="btn mt10 btn-default" type="submit" name="batch" value="3">批量取消审核</button>
		    </div>
		    <div class="col-sm-7 " style="margin-top:7px">
		    <?php echo $page->show(3); ?>	
			</div>
		</div>
	</div>
	<div>
		
	</div>
	</div>
</div>

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>