
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
       <h3 class="fl ">&nbsp;&nbsp;<a class="mr20 " href="<?php echo M_URL('Interface','index','',GP('',true)); ?>">接口管理</a>
        	<!-- <a href="<?php echo M_URL('Interface','index','',GP('')); ?>" class="mr20 act" style="color: blue"></a>  -->
        	<a href="<?php echo M_URL('Interface','classifyIndex','',GP('',true)); ?>" class="mr20 act" >分类管理</a> 
            <a class="btn btn-default btn-rounded " onclick="addTypeChange('<?php echo M_URL('home/Interface','showAddC','',GP('p-'.$now_page)) ?>','530px','300px',{title:'添加接口分类',type:'top'});" >添加分类</a>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			    <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>名称</option>
	  	    </select>
	
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" style="width: 200px;" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input style="position: relative;" type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Interface','classifyIndex'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
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
 <form  id="myform" target="hidframe" action="<?php echo M_URL('Interface','batch','',GP('')); ?>" method="post">	
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
         <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            <th>选择</th>
                            <th class="shaixuan">
                                <?php if($classifyid == 1){?>
                                <a class="desc" href="<?php echo M_URL('Interface','classifyIndex','',GP("classifyid-2")); ?>"><i class="desc-i"></i>ID</a>     
                                <?php }else{ ?>
                                    <a class="desc" href="<?php echo M_URL('Interface','classifyIndex','',GP("classifyid-1")); ?>"><i class="asc-i"></i>ID</a>
                                            
                                <?php }?>
                           </th>                           
                            <th >名称</th>
                            <th class="shaixuan">
                                <?php if($orderid == 1){?>
                                <a class="desc" href="<?php echo M_URL('Interface','classifyIndex','',GP("orderid-2")); ?>"><i class="desc-i"></i>排序</a>     
                                <?php }else{ ?>
                                    <a class="desc" href="<?php echo M_URL('Interface','classifyIndex','',GP("orderid-1")); ?>"><i class="asc-i"></i>排序</a>
                                            
                                <?php }?>
                           </th>
                            <th>删除</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php foreach($values as $k=>$v){ ?>
                    	<tr>
                    		<td><input type="checkbox" class="select-checks " name="id[]" value="<?php echo $v['id']; ?>"></td>
                            <td><?php echo $v['id']; ?></td>
                            <td><?php echo $v['name']; ?></td>
                            <td><?php echo $v['orderid']; ?></td>
                    		<td>
                    			 <span onclick="Confirm('是否删除？该操作不可逆!','<?php echo M_URL('Interface','delete',$v['id'],GP('')); ?>')"><i class="iconfont icon-lajitong"></i></span>
                    		</td>
                    		<td class="ks-head-el">
                                <i onclick="choiceClick(this)" class="iconfont icon-more"></i>
                                <div class="ks-head-content ks-head-content-pc">
                                    <ul class="opeart">
                                        <li>
                                            <a onclick="addTypeChange('<?php echo M_URL('home/Interface','showAddC',$v['id'],GP('p-'.$now_page)) ?>','530px','300px',{title:'修改',type:'top'});">编辑</a>
                                        </li>
                                        <!-- <li>
                                            <a href="<?php echo M_URL('Interface','details',$v['id'],GP('p-'.$page->now_page)); ?>">查看详情</a>
                                        </li> -->
                                    </ul>
                                </div>
                    			
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
            <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
                <label for="sAll">全选 </label>
            </div>
            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">删除</button>
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
