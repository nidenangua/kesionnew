<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
</head>
<style type="text/css">
.deepRed{color: red; cursor:pointer; }
.deepRed:hover{color: red; cursor:pointer; }
.ks-operaRight{position: absolute; right: 20px; top:30px;}
.ks-operaRight li{float: right; margin-left:0px; padding: 2px; }
.H5-gameList>li {position: relative;padding-bottom:30px;}
.ring{position: absolute;right: 20px;top: 15px;width:200px;height: 40px;text-align: right;line-height: 40px;}
.H5-gameOpt>li {float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
.shaixuan .asc-i{top: 3px;}
.shaixuan .desc-i{top: 3px;}
</style>
<body class="gray-bg"> 
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;海报管理</h3>
        <div class="fl"><a href="<?php echo M_URL('Setting','addPoster'); ?>" class="btn btn-tool btn-rounded btn-s-md  ml15">添加</a></div>
        <div class="fr">
            <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" selected>管理员名称</option>
	  	    </select>
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Setting',''); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
 <form target="hidframe"  action="<?php echo M_URL('Setting','batch','',GP('p-'.$page->now_page)) ?>" method="post">
	<div style="margin-top: 15px;">
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix" style="padding-left: 10px;height: 35px;">
			<li style="margin-right: 10px;">
			</li>
			<li style="margin-right: 10px;">
				<div class="shaixuan clearfix">
					<?php if($adddate == 2){?>
						<a class="desc" href="<?php echo M_URL('Setting','poster','',GP("adddate-1")); ?>"><i class="desc-i"></i>添加时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Setting','poster','',GP("adddate-2")); ?>"><i class="asc-i"></i>添加时间</a>
					<?php }?>
				</div> 
			</li>			
			<li></li>
		</ul>	
	</div>
	<div class="H5-gameListConts">
        <table class="ks-table" style="background: #fff;">
            <thead style="background: #cccccc9c;">
                <tr>
                    <th>选择</th>
                    <th>ID</th>                        
                    <th>海报名称</th>  
                    <th>海报背景图</th> 
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach($pageadmins as $k=>$v){ ?>
                <tr>
                    <td>
                        <?php if($v['isdel'] == 0){ ?>
                        <input type="checkbox" class="select-checks" name="check[]" value="<?php  echo $v['posterid']; ?>" class="check0"/>
                        <?php }?>
                   </td>
                    <td><?php echo $v['posterid']?></td>
                    <td><?php echo $v['realname']?></td>
                    <td><img class="con-img"  src="<?php echo $v['defaultpic'] ?>"></td>
                    <td style="width: 13%;">
<?php if($v['isdel'] == 0){ ?>
<a onclick="Confirm('确定选为默认？','<?php echo M_URL('Setting','defaultPoster',$v['posterid'],GP('p-'.$page->now_page)); ?>');" style="float: left;">
<i class="iconfont icon-xuanze1"></i>
<p class="class-name">选为默认</p>
<a onclick="Confirm('确定删除？,该操作不可逆','<?php echo M_URL('Setting','deletePoster',$v['posterid'],GP('p-'.$page->now_page)); ?>');" style="float: left;    margin-left: 15px;">
<i class="iconfont icon-lajitong"></i>
<p class="class-name">删除</p>
</a>
<?php }else{?>
<a onclick="Confirm('确定删除？,该操作不可逆','<?php echo M_URL('Setting','deletePoster',$v['posterid'],GP('p-'.$page->now_page)); ?>');" style="float: left;    margin-left: 15px;">
<i class="iconfont icon-zhengque"></i>
<p class="class-name">默认</p>
</a>                        	
<?php }?>	
                    <a href="<?php echo M_URL('Setting','editPoster',$v['posterid'],GP('p-'.$page->now_page)); ?>" style="float: left;margin-left: 15px;">
                        <i class="iconfont icon-bianji"></i>
                        <p class="class-name">编辑</p>
                    </a> 
                    <a href="<?php echo M_URL('Setting','setPoster',$v['posterid'],GP('p-'.$page->now_page)); ?>" style="float: left;margin-left: 15px;    line-height: 51px;">
                        <p class="class-name">设置</p>
                    </a> 
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
		<?php echo Noc($pageadmins); ?>
		<!-- </ul> -->
		<div style="height: 140px;"></div>		
		</div>
	<div>
	</div>
	</div>
</div>
<div class="footer-page h60">
    <div class="col-sm-5">
    <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input id="checkboxAll" name="check1" type="checkbox" class="selectAll select-checks">
            <label for="checkboxAll">全选 </label>
    </div>
    <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
    </div>
    <div class="col-sm-7 " style="margin-top:7px">
    <?php echo $page->show(3); ?>
    </div>
</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>