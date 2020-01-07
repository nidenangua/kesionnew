<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td>栏目ID</td>
    <td>分类名称</td>
    <td>英文名</td>
    <td>介绍</td>
    <td>序号</td>
    <td>编辑</td>
    <td>删除</td>
  </tr>
   <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td class='center'></td>
			<td class='center'><a href='".M_URL('category','editCategory',$v['categoryid'])."'>修改</a></td>
			<td class='center'><a href='".M_URL('category','deleteCategory',$v['categoryid'])."'>删除</a></td></tr>

	<tr><td>暂无分类</td></tr>

  
</table>
<div><a href="<?php echo M_URL('teacher','addteacher')?>">添加教师</a></div>
<body>
</body>
</html>