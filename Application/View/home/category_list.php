
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>kesion教育平台</title>
</head>
<body>
<p>课程分类信息</p>
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td>栏目ID</td><td>分类名称</td><td>英文名</td><td>介绍</td><td>序号</td><td>编辑</td><td>删除</td>
  </tr>
  <?php if(!empty($category)){foreach($category as $k=>$v){ ?>
		<tr>
					<td><?php echo $v['categoryid'];?></td>
					<td><?php echo KS_INDENT($v['depth']).$v['categoryname'];?></td>
					<td><?php echo $v['categoryename'];?></td>
					<td><?php echo $v['intro'];?></td>
					<td><?php echo $v['orderid'];?></td>
					<td><a href="<?php echo M_URL('category','editCategory',$v['categoryid']);?>">修改</a></td>
					<td><a href="<?php echo M_URL('category','deleteCategory',$v['categoryid']);?>">删除</a></td>
		</tr>
		<?php }}else{ ?>
		    	<tr><td>暂无分类</td></tr>
	  <?php }?>
</table>
<div><a href="<?php echo M_URL('category','addcategory')?>">添加分类</a></div>
</body>
</html>
