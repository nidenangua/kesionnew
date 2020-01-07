<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>会员列表</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content" id="ksBoxContent" style="margin-top:60px"> 
	
	<div id="manage_top" class="menu_top_fixed p15 height73">
		<div class="ibox-title fl mr15">
			<h3 class="fl mr15">地区管理</h3>
			<a onclick="fnClickAddRow();" href="<?php echo M_URL('Setting','addArea',$parentid); ?>" class="btn btn-default btn-rounded btn-s-md mt5" data-index="25">添加地区</a>
		</div>
		
		<div class="ibox-tools" >
			<button class="ks-bt" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>	
		<!--<a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
		<i class="reflash"></i>
		</a>-->
		
		</div>
		
	</div>
	
	
	
	<div >
		<form target="hidframe"  method="post" action="<?php echo M_URL('Setting','updateArea') ?>" class="form-horizontal">
			<div class="panel-heading">地区管理列表</div>
			<table class="table table-striped table-bordered table-hover " id="editable">
			<thead>
				<tr><th><input class="selectAll select-checks" name="check1" type="checkbox" id="sAll"></th><th>序号</th><th>地区名称</th><th>首字母</th><th>排序</th><th>删除</th></tr>
			</thead>
			<tbody>
                <?php
			foreach($pageapps as $k=>$v){
				$html = "<tr class='gradeX'><td><input type='checkbox' class='select-checks' name='emo[]' id='emo[]' value='' /></td><td>$v[id]</td>
			<td><div class='row'><div class='col-sm-4'><input type='text' name='city[]' class='form-control' value='$v[city]'></div>";
			if($v["depth"]!=3){
			$html = $html."<label class='col-sm-3 control-label'><a href='".M_URL('Setting','addArea',$v['id'])."'>添加子地区</a></label>
			<label class='col-sm-3 control-label'>	<a href='".M_URL('Setting','areaIndex',$v['id'])."'>进入子地区</a></label></div></td>";
			}
			$html = $html."<td><input type='text' class= 'form-control' name='letter[]' value='$v[letter]'</td>
												<td><input class='form-control' type='number' name='orderid[]' value='$v[orderid]'</td>
			<td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此地区及子地区','".M_URL('Setting','delArea',$v['id'],GP('p-'.$page->now_page.',parentid-'.$parentid))."')\" > <i class='delete2017'></i></a><input style='opacity' class='form-control' type='hidden' name='id[]' value='$v[id]'></td>
			</tr>";
				echo $html;
			}?>
			</tbody>
			</table> 
			<?php echo NoC($pageapps);?>
				<br/><br/><br/><br/><br/><br/><br/><br/>
			
			<div class="footer-page h60">
			  	<div class="col-sm-5">
					<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
						<input class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
						<label for="sAll">全选 </label>
					</div>
				   	<button class="btn mt10 btn-default" type="submit"> <?php echo '批量修改' ?></button> 
				   	<button type="submit" class="btn mt10 btn-default" name="batch" value="1" onclick="return(confirm('是否删除此新闻？该操作不可逆！'))"> 批量删除</button>
			  	</div>
			  <div class="mt15"><?php echo $page->show(3); ?></div>	
			</div>
		</form> 
	</div>
	
	<div style="height: 50px;"></div>
</div>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script> 
<script>
loadScorllJs();//滚轮
</script>
</body>
</html>