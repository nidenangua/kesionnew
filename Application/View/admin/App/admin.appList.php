<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">

<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echo time();?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right:16px; top:40px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;padding-bottom:30px;}
	.ring{position: absolute;right: 20px;top:0px;width:200px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
	.school-online .grayLing{margin: 0px;}
	.operaRight li a {
	    display: block;
	    border: 1px solid #86A8F1;
	    text-align: center;
	    padding: 15px 0px 5px 0px;
	    color: #86A8F1;
	    border-radius: 5px;
	    width: 70px;
	    height: 70px;
	    box-sizing: border-box;
	    line-height: 24px;
	    cursor: pointer;
	}
	.operaRight li{
		list-style: none;
        float: right;
        margin-right: 10px;
	}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:3px">
<br />
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;应用管理
        	<a href="<?php echo M_URL('App','appManage'); ?>" class="btn btn-default btn-rounded btn-s-md  ml15">添加应用</a>
        	<a href="<?php echo M_URL('AppCategory',''); ?>" class="btn btn-default btn-rounded btn-s-md  ml15">分类管理</a>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
            <select id="inputText" class="inputText bRadius5 mr10 fl" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('App','index'); ?>','categoryid','<?php echo URL_MODEL;?>');" style="width: 150px;">
                <?php if(isset($appcategory)){ ?>
                <option value="0">请选择</option>
                <?php foreach($appcategory as $k=>$v){?>
                <option value="<?php echo $v['categoryid']; ?>" <?php if($v['categoryid']==$categoryid){ ?>selected = "selected"<?php }?>>
                <?php echo KS_INDENT($v['depth']).$v['categoryname'];?>
                </option>
                <?php }}else{ ?>
                <option value="0">请选择</option>
                <?php } ?>
            </select> 	
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected"; ?>>名称</option>
                 <option value="2" <?php if($keytype==2) echo "selected"; ?>>作者</option>
	  	    </select>
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('App','index'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
<form target="hidframe"  action="<?php echo M_URL('App','batch') ?>" method="post">
	<div style="margin-top: 31px;">
	<div class="H5-gameListScreen" style="    height: 42px;">
		<ul class="H5-gameOpt clearfix" style="padding-left: 10px;">
			<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix">
					<a class="mr20">最新上线 <i class="desc-i"></i></a>
				</div> 
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选
				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>应用状态：</span>
						<div>
							<a href="<?php echo M_URL('App','','',GP('status-2')); ?>" <?php if($status==2){?>class="active"<?php }?> >不限</a>
							<a href="<?php echo M_URL('App','','',GP('status-1')); ?>" <?php if($status==1){?>class="active"<?php }?>>已审核</a>
							<a href="<?php echo M_URL('App','','',GP('status-0')); ?>" <?php if($status==0){?>class="active"<?php }?>>未审核</a>
						</div>
					</li>
					<li>
						<span>应用类型：</span>
						<div>
							<a href="<?php echo M_URL('App','','',GP('isprice-2')); ?>" <?php if($isprice==2){?>class="active"<?php }?>>不限</a>
							<a href="<?php echo M_URL('App','','',GP('isprice-1')); ?>" <?php if($isprice==1){?>class="active"<?php }?>>不收费</a> 
							<a href="<?php echo M_URL('App','','',GP('isprice-0')); ?>" <?php if($isprice==0){?>class="active"<?php }?>>收费</a>
							<!--<a href="">必选应用</a>
							<a href="">网站应用</a>-->
						</div>
					</li> 
				</ul>
			</li>				
		</ul>	
	</div>
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
		<table class="ks-table">
			<thead>
				<tr>
					<!-- <th>选择</th> -->
					<th>应用ID</th>
					<th>图片</th>
					<th style="text-align: left;">应用名称</th>
					<th>基类型</th>
					<th>购买量</th>
					<th>售价</th>
					<th>使用权限</th>
					<th>所属分类</th>
					<th>浏览量</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pageapps as $k=>$v){ ?>
				<tr>
					<!-- <td></td> -->
					<td><?php echo $v['appid'];?></td>
					<td><img class="con-img" onerror="this.src='<?php echo nopic();?>'" src="<?php echo $v['defaultpic'];?>"></td>
					<td style="text-align: left;"><?php echo $v['appname'];?><span class="grayLing" style="font-size: 14px;margin: 0px;">(<?php echo $v['appename']; ?>)</span></td>
					<td><?php echo GCT($v['basictype']); ?></td>
					<td>1235家</td>
					<td>
						￥<?php echo $v['price'];?>/<?php if($v['appchargetype']==0){
							echo '月';
						}elseif($v['appchargetype']==1){
							echo '季';
						}elseif($v['appchargetype']==2){
							echo '年';
                                                         };?>
					</td>
                    <td style="text-align:center"> <?php
                          $showtips=wx_showappfree($v['allowversion']);
                          if (!empty($showtips)){
                              echo '<div style="color:green;">'.$showtips.'</div>';
                          }
                         ?></td>
					<td><?php echo $v['categoryname']; ?></td>
					<td><?php echo $v['hits']; ?></td>
					<td>
						<?php if($v['appid']!=19){if($v['status'] == 1){ ?>
							<a href="<?php echo M_URL('App','unAppstatus',$v['appid'],GP('p-'.$page->now_page));?>">
								<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;
								<span class="grayLing"></span>
							</a>
						<?php }else{?>
							<a href="<?php echo M_URL('App','Appstatus',$v['appid'],GP('p-'.$page->now_page));?>">
								<i class="ok-icon ok-pe2 "></i> &nbsp;&nbsp;
								<span class="grayLing"></span>
							</a>
						<?php }}?>
					</td>
					<td class="operaRight" style="position:none;">
						<?php $ary=array(103,102,101,31,30,29,28,25,26,24,23,22,19,18,17,16,13,12,11,10,9,8,7,6,5,4,3);if(in_array($v['appid'], $ary)){ if($v['appid']==103){?>
							<li>
							<a href="<?php echo M_URL('h5market/Index','collage','',GP("appid-$v[appid]",true));?>">
								<i class="iconfont icon-yulan"></i>
								<p class="class-name">数据管理</p>
							</a>
						</li>
						<?php }elseif($v['appid']==102){?>
						<li>
							<a href="<?php echo M_URL('microportal/Index','','',GP("appid-$v[appid]",true));?>">
								<i class="iconfont icon-yulan"></i>
								<p class="class-name">数据管理</p>
							</a>
						</li>
					<?php }else{?>
						<li>
							<a href="<?php echo M_URL(GC($v['basictype']).'/Index','','',GP("appid-$v[appid]",true));?>">
								<i class="iconfont icon-yulan"></i>
								<p class="class-name">数据管理</p>
							</a>
						</li>
					<?php }}else{?>
						<li>
							<a onclick="alert('正在开发中')">
								<i class="iconfont icon-yulan"></i>
								<p class="class-name">数据管理</p>
							</a>
						</li>
					<?php } ?>
						<li>
							<a href="<?php echo M_URL('App','appManage',$v['appid'],GP('p-'.$page->now_page));?>">
								<i class="iconfont icon-bianji"></i>
								<p class="class-name" >编辑</p>
							</a>
						</li>
						<?php if($v['issys']==0){ ?>
						<li>
							<a href="<?php echo M_URL('App','Field',$v['appid'],GP('p-'.$page->now_page)) ?>">
								<i class="iconfont icon-shouhuoziliao"></i>
								<p class="class-name">字段管理</p>
							</a>
						</li>	
						<!--<li>
							<a onclick="Confirm('是否删除此应用','<?php echo M_URL('App','deleteApp',$v['appid'],GP('p-'.$page->now_page));?>');">
								<i class="iconfont icon-lajitong"></i>
								<p class="class-name" >删除</p>
							</a>
						</li>-->
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div style="height: 140px;"></div>		
	</div>
	<div>
		<div class="footer-page h60">
	    <div class="col-sm-5">
	    <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
	            <!--<input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
	            <label for="checkboxAll">全选 </label>-->
	    </div>
	        <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button>
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>-->
	    </div>
	    <div class="col-sm-7 " style="margin-top:7px">
	    <?php echo $page->show(3); ?>    
	    </div>
</div>
	</div>
	</div>
</div>

</form>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>














