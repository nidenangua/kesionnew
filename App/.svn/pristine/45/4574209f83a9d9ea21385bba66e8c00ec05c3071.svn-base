
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
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echo time();?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top: 50px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;}
	.ring{position: absolute;right: 20px;top: 15px;width:200px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: -2px;}
	.shaixuan .desc-i { top: 3px;}
	.defColor{color: #ec600e;}
    .gameScreen:hover ul{display: block;}
    .curr{
  border-image: none;
    border-style: solid;
    border-width: 1px;
    color: #555;
    cursor: default;
    border-top: 0;
    background-color: #fff!important;
}
.other a{
    padding: 10px;
    background: #e44d08;
    color: white!important;
    border-radius: 10px;
}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title clearfix">
       <h3 class="fl ">&nbsp;&nbsp;<span class="mr20"><?php echo $info['sitename']?></span>
            &nbsp;&nbsp;&nbsp;&nbsp;总人数&nbsp;&nbsp;<font class="defColor" size="5px"><?php echo $page->totalput; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			    <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>名称</option>
	  	    </select>
	
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" style="width: 200px;" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input style="position: relative;" type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','userlist',$id); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>

<br />	
	
</div>

<div id="ksBoxContent">
	<div style="margin-top:10px;">	
	<div class="H5-gameListScreen" style="height: 45px;">
		<ul class=" nav nav-tabs">
			<!-- <li><input class="selectAll select-checks" name="check1" type="checkbox"></li> -->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->		
		</ul>	



</style>
 <form  id="myform" target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('')); ?>" method="post">	
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
         <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            <th>选择</th>
                            <th>昵称</th>
                            <th>性别</th>
                            <th>关注时间</th>
                            <th>地区</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php foreach($values as $k=>$v){ ?>
                    	<tr>
                    		<td><input type="checkbox" class="select-checks " name="id[]" value="<?php echo $v['id']; ?>"></td>
                            <td><?php echo $v['nickname']?></td>
                            <td><?php if($v['sex']==1){echo '男';}elseif($v['sex']==2){echo '女';}else{echo '未知';}?></td>
                            <td><?php echo date('Y-m-d H:i:s',$v['subscribe_time'])?></td>
                            <td><?php echo $v['country']?><?php echo $v['province']?><?php echo $v['city']?></td>
                    	</tr>
                    
                <?php }?>
                </tbody>
                </table>
		<?php echo Noc($values); ?>
		</div>
		<div style="height: 120px;"></div>
	<div>
	<div class="footer-page h60">
		<div class="col-sm-5">
			<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
	            <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
                <label for="sAll">全选 </label>
	    </div><!-- 
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button> -->
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
		</div>
	    <div class="col-sm-7" style="margin-top: 7px;">
			<?php echo $page->show(3); ?>
		</div>

    </div>
</form>
	</div>
	</div>

</div>
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script type="text/javascript">
	$('.link-switch').each(function(){
        setLinkSwitch(this)
    })
</script>
</body>

</html>