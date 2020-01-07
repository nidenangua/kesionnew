<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>

<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;权限等级列表</h3>
         <div class="fl"><a href="<?php echo M_URL('Admin','adminLevel'); ?>" class="btn btn-tool btn-rounded btn-s-md  ml15">添加权限</a></div>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected"; ?>>名称</option>
	  	    </select>
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
           <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Admin','AdminLevelList'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
	<div style="padding: 20px 0px;">
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix"> 
						
		</ul>	
	</div>
	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
				<th>id</th>
				<th>权限名</th>
				<th>创建时间</th>
				<th>操作</th> 
			</tr>
            <?php foreach($values as $k=>$v){?>
			<tr <?php if($k%2==0){?>class="gy"<?php }?>>
				<td><?php echo $v['id'] ?></td>
				<td><?php echo Field($v['rulename']);?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
				<td>
					<p>
						<!--<a href="<?php echo M_URL('Admin','checkAdminLevel',$v['id'],GP('')); ?>" class="orange mr20">查看权限</a>-->
					<?php if ($v['id']!=1){?>
                        <a href="<?php echo M_URL('Admin','adminLevel',$v['id'],GP('')); ?>" class="form-bule mr20">修改权限</a>
						<a href="<?php echo M_URL('Admin','delAdminLevel',$v['id'],GP('')); ?>" class="form-bule mr20">删除</a>
					<?php
                          }else{
                              echo '---';
                          }?>
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
		          
		        </div>
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