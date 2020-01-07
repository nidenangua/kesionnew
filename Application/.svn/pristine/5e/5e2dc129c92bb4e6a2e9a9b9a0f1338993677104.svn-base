<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<title>字段管理</title>
</head>
<body class="gray-bg">
<div id="manage_top" class="menu_top_fixed height73 p15" >
  <div class="ibox-title fl mr15">
    <h3 class="fl" style="margin-top:-2px">
<?php 
	$html = $app['appname'].$appModel->prefix;
	if($app['isweb']==0){$html .= 'website_';}else{$html .= 'app_';}
	$html .= $app['tableename']; 
	echo $html;
?>
自定义字段&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-rounded btn-s-md mt7 "  href="<?php echo M_URL('App','fieldGroup',$appid); ?>" >字段分组</a></h3>
    <a onclick="fnClickAddRow();" href="<?php echo M_URL('App','addField',$appid); ?>" class="btn btn btn-info btn-rounded btn-s-md mt7 ml15">新增字段</a> </div>
  <div class="ibox-tools" > 
  
  <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def back"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
        </div>
  
  </div>
</div>


<form target="hidframe" method="post" action="<?php echo M_URL('App','fieldOrder',$appid,GP('p-'.$now_page.',groupid-'.$groupid)); ?>">
<script>
var arrId = new Array("<?php foreach($pagefields as $k=>$v){$orderidarr[] = 'orderid_'.$v['orderid'];}echo implode('","',$orderidarr);?>");
function Reorder(eSelect, iCurrentField, numSelects)
{
	var eForm = eSelect.form;
	var iNewOrder = eSelect.selectedIndex + 1;
	var iPrevOrder;
	var positions = new Array(numSelects);
	var ix;
	for (ix = 0; ix < numSelects; ix++)
	{
			positions[ix] = 0;
	}
	for (ix = 0; ix < numSelects; ix++)
	{
			positions[eSelect.form[arrId[ix].toString()].selectedIndex] = 1;
	}
	
	for (ix = 0; ix < numSelects; ix++)
	{
			if (positions[ix] == 0)
			{
					iPrevOrder = ix + 1;
					break;
			}
	}
	if (iNewOrder != iPrevOrder)
	{
			var iInc = iNewOrder > iPrevOrder? -1:1
			var iMin = Math.min(iNewOrder, iPrevOrder);
			var iMax = Math.max(iNewOrder, iPrevOrder);
			for (var iField = 0; iField < numSelects; iField++)
			{
					if (iField != iCurrentField)
					{
							if (eSelect.form[arrId[iField].toString()].selectedIndex + 1 >= iMin && eSelect.form[arrId[iField].toString()].selectedIndex + 1<= iMax)
							{
									eSelect.form[arrId[iField].toString()].selectedIndex += iInc;
							}
					}
			}
	}
}
</script>
<div class="wrapper mt400 ">
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-content">
          <div class=""></div>
          <br/>
          <div class="panel-heading">
<?php
	$html = '';
	foreach($fieldgroup as $k=>$v){
		$html .= "<a  href='".M_URL('App','Field',$appid,GP("groupid-$v[groupid],p-$page->now_page"))."'>$v[groupname]&nbsp;&nbsp;&nbsp;</a>";
	}
	echo $html;
?>
          </div>
<table class="table table-striped table-bordered table-hover" id="editable" style="margin-bottom:20px">
            <thead>
              <tr>
                <th>排序</th>
                <th>字段别名</th>
                <th>字段名称</th>
                <th>类型</th>
                <th>管理项</th>
                <th>录入项</th>
                <th>必填项</th>
                <th>状态</th>
                <th>小组</th>
                <th>编辑</th>
                <th>删除</th>
              </tr>
            </thead>
            <tbody>
<?php $html = '';
 foreach($pagefields as $k=>$v)
 {
	$html .= "<tr class='gradeX'><td> <select name='orderarr[]' class='sol-sm-6 form-control' id='orderid_".$v['orderid']."' onchange='Reorder(this,".intval($v['orderid']-1).",".count($pagefields).")'>";
	for($i=1;$i<=$page->totalput;$i++)
	{		   
	   if($i==$v['orderid']){$html .= "<option selected value='".$i."'>$i</option>";}
	   else{$html .= "<option value='".$i."'>$i</option>";}
	} 
	$html .= "</select></td>
		<td>$v[title]</td>
		<td>$v[fieldname]</td>
		<td class='center'>".KS_FieldType($v['fieldtype'])."</td>";
	if($v['fieldtype']!=-1)
	{
		if($v['manageitem']==1)
		{
			$html .= "<td><a class='ok-icon ok-pe1' field=manageitem state=1 fieldid=$v[fieldid]></a></td>";
		}else{
			$html .= "<td><a class='ok-icon ok-pe1 ok-pe2' field=manageitem state=0 fieldid=$v[fieldid]></a></td>";
		}
		if($v['isentry']==1)
		{
			$html .= "<td><a class='ok-icon ok-pe1' field=isentry state=1 fieldid=$v[fieldid]></a></td>";
		}else{
			$html .= "<td><a class='ok-icon ok-pe1 ok-pe2' field=isentry state=0 fieldid=$v[fieldid]></a></td>";
		}
		if($v['mustinput']==1)
		{
			$html .= "<td><a class='ok-icon ok-pe1' field=mustinput state=1 fieldid=$v[fieldid]></a></td>";
		}else{
			$html .= "<td><a class='ok-icon ok-pe1 ok-pe2' field=mustinput state=0 fieldid=$v[fieldid]></a></td>";
		}
		if($v['status']==1)
		{
			$html .= "<td><a class='ok-icon ok-pe1' field=status state=1 fieldid=$v[fieldid]></a></td>";
		}else{
			$html .= "<td><a class='ok-icon ok-pe1 ok-pe2' field=status state=0 fieldid=$v[fieldid]></a></td>";
		}
		$html .= " <td>$v[showtitle]</td><td class='center'><a href='".M_URL('App','editField',$v['fieldid'],GP("appid-$v[appid],p-$page->now_page"))."'><i class='edit2017'></i></a></td>";
	}else{
		$html .= '<td>-----</td><td>-----</td><td>-----</td><td>-----</td><td></td><td>-----</td>';
	}
	$html .= "<td class='center'>";
	if($v['fiesys']==0)
	{		
	$html .= "-----";
	}else{
	$html .= "<a href='javascript:void(0);' onclick=\"Confirm('确定删除？,该操作不可逆','".M_URL('App','deleteField',$v['fieldid'],GP("appid-$v[appid],p-$page->now_page"))."')\"><i class='delete2017'></i></a>";
		  }
	$html .= "</td>
	</tr>";
}
echo $html;?>
            </tbody>
</table>
          <?php echo NoC($pagefields);?> 
        </div>
      </div>
    </div>
  </div>
</div>
<br/>
<div class="main-button" style="height:auto">
  <div class="row">
    <div class="col-sm-3" style="margin-top:6px">
      <button type="submit" class="btn btn-s-md btn-primary ">批量保存排序</button>
      <a href="<?php echo M_URL('App','Preview','',GP('appid-'.$v['appid'].',p-'.$page->now_page)); ?>" class='btn btn-s-md btn-primary'>预览</a> </div>
    <div class="col-sm-9"> <?php echo $page->show(3); ?> </div>
  </div>
</div>
</form>
<script>
$(".ok-pe1").click(function(){
	 $(this).toggleClass("ok-pe2")
	 var fieldid = $(this).attr('fieldid');
	 var state = $(this).attr('state');
	 var field = $(this).attr('field');
	 if(state==0)
	 {
		 $(this).attr('state','1');
		 state=1;
	 }else{
		 $(this).attr('state','0');
		 state=0;
	 }
	 var url = '/Plus/Kesion.ajax.php?act=fieldClick';
	 $.ajax({
			type:"post",
			url:url,
			data:{
				  'field':field,
				  'fieldid':fieldid,
				  'state':state
				 },
			dataType:"json",
			success:function(data){
				}
		 });
})
</script> 
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script> 
<script>
loadScorllJs();
</script>
</body>
</html>