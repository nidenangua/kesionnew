<?php

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<body>
<div><a href="<?php echo UOOT; ?>Public/题库模板.xls">下载模板</a></div>

<div>
<form action="<?php echo M_URL($this->AppName.'/Index','beathaddTk', $courseid,GP(""));  ?>" method="post" enctype="multipart/form-data">
<input type="file" name="execl">
	<input type="checkbox" name="type" value="1" checked="checked">添加时是否绑定该课程<br />
<input type="submit" value="提交">
</form>

</div>
</body>
</html>