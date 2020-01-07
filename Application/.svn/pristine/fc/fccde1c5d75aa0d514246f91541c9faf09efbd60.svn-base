
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
       <h3 class="fl ">&nbsp;&nbsp;<span class="mr20 act">wiki管理</span>
        	<a href="<?php echo M_URL('Interface','classifyIndex','',GP('')); ?>" class="mr20 " >Api管理</a>
            <a class="btn btn-default btn-rounded " onclick="addTypeChange('<?php echo M_URL('home/Apiwiki','editwiki',-1,GP('p-'.$now_page)) ?>','70%','70%',{title:'编辑Api说明文档',type:'top'});">wiki首页编辑</a>
            <a class="btn btn-default btn-rounded " onclick="addTypeChange('<?php echo M_URL('home/Apiwiki','editwiki',-3,GP('p-'.$now_page)) ?>','70%','70%',{title:'编辑Api说明文档',type:'top'});">wiki开发者规范编辑</a>
             <a class="btn btn-default btn-rounded " onclick="addTypeChange('<?php echo M_URL('home/Apiwiki','editwiki',-2,GP('p-'.$now_page)) ?>','70%','70%',{title:'编辑Api说明文档',type:'top'});">更新日志编辑</a>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			    <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>接口名称</option>
              	<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>分类名称</option>
	  	    </select>
	
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" style="width: 200px;" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input style="position: relative;" type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Apiwiki','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
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



</style>
 <form  id="myform" target="hidframe" action="<?php echo M_URL('Interface','batchInter','',GP('')); ?>" method="post">	
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
         <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            
                            <th >接口ID</th>                           
                            <th >接口名称</th>                           
                            <th >所属分类名称</th>                           
                            <th >接口名</th>
                            <th >所属控制器</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php foreach($values as $k=>$v){ ?>
                    	<tr>
                    		
                            <td><?php echo $v['id']; ?></td>
                            <td><?php echo $v['name']; ?></td>
                    		<td><?php echo $v['classifyname']; ?></td>
                            <td><?php echo Field($v['interfaceName']); ?></td>
                            <td><?php echo Field($v['controller']); ?></td>
                    		<td class="ks-head-el">
                                <a onclick="addTypeChange('<?php echo M_URL('home/Apiwiki','editwiki',$v['id'],GP('p-'.$now_page)) ?>','70%','70%',{title:'编辑Api说明文档',type:'top'});">编辑文档</a>
                    		</td>
                    	</tr>
                    
                <?php }?>
                </tbody>
                </table>
		<?php echo Noc($values); ?>
		</div>
		<div style="height: 120px;"></div>
	<div>
    <?php if($values){?>
	<div class="footer-page h60">
        <div class="col-sm-5">
        </div>
        <div class="col-sm-7" style="margin-top: 7px;">
            <?php echo $page->show(3); ?>
        </div>

    </div>
    <?php }?>


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
