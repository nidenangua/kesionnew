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
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style> 
.deepRed{ color: red; cursor:pointer; }
.deepRed:hover{ color: red; cursor:pointer; }
.ks-operaRight{position: absolute; right: 20px; top:30px;}
.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
.H5-gameList>li {position: relative;padding: 15px;}
.ring{position: absolute;right: 20px;top: 15px;width:200px;height: 40px;text-align: right;line-height: 40px;}
.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
.shaixuan .asc-i { top: 3px;}
.shaixuan .desc-i { top: 3px;}
</style> 
<body class="gray-bg">
<div class="wrapper" style="margin-top:75px;">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;网校学员查询</h3>
        <div class="fr">
            <div class="fl ks-top-search">
			<!--搜索-->
			<!--<a href="javascript:history.go(-1);" style="padding: 5px 12px;margin-left: 20px;" class="btn  btn-default  fr" type="button" >
            	<i class="iconfont icon-fanhui"></i>返回
            </a>-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected"; ?>>用户账号</option>
			     <option value="2" <?php if($keytype==2) echo "selected"; ?>>用户昵称/option>
	  	    </select>
			<form target="hidframe" class="fr">
			<input type="text" style="width:150px" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Domain','userlist',$id); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>	
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
	<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('home/Domain','loginbatch','',GP('p-'.$page->now_page)) ?>" class="form-horizontal" enctype="multipart/form-data">
	<div> 
	<div class="H5-gameListConts" style="margin-bottom: 90px;">
        <table class="ks-table" style="background: #fff;">
            <thead style="background: #cccccc9c;">
                <tr>
                    <th>选择</th>
                    <th>机构ID</th>                           
                    <th>用户id</th>                           
                    <th >用户名</th>
                    <th>用户昵称</th>
                    <th>电话号码</th>
                    <th>性别</th>
                    <!-- <th>删除</th> -->
                </tr>
            </thead>
            <tbody>
            	<?php foreach($values as $k =>$v){ ?>
            		<tr>
            		<td><input  class="select-checks" name="check[]" value="<?php echo $v["id"];?>" type="checkbox"></td>
            		<td><?php echo $v['wxid']; ?></td>
            		<td><?php echo $v['userid']; ?></td>
            		<td><?php echo $v['username']; ?></td>
            		<td><?php echo $v['name'] ?></td>
            		<td><?php echo $v['mobile']; ?></td>
            		<td><?php if($v['sex']==0){ echo '男';}else{echo '女';} ?></td>
            		<!-- <td><a href='<?php echo M_URL('home/Domain','dellog',$v['id'],GP('p-'.$page->now_page));?>'><i class="iconfont icon-lajitong"></i><p class="class-name">删除</p></a></td> -->
            		</tr>
            	<?php }?>
            </tbody>
        </table>
		<?php echo Noc($values); ?>
		</div>
	<div>
	</div>
	</div>
	<br />	
	<br />	
	<br />	
	<br />	
	<div class="footer-page h60">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
			<label for="sAll">全选 </label>
        </div>
        <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>-->
        <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button>-->
        <!-- <button class="btn mt10 btn-default" type="submit" name="batch" value="1">批量删除</button> -->
    </div>
    <div class="col-sm-7 " style="margin-top:7px">
    	<?php echo $page->show(3); ?>
    </div>
</div>
</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
