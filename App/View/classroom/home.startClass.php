<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
 <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
 <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>   
<title>无标题文档</title>
</head>

<body>
              
                 <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">                     
                                                    
                        <tr>   
	                       	 <td>教师名称</td>
	                         <td><?php echo $classroom['classroomname'] ?></td>
						</tr>
						 <tr>   
	                       	<td>班主任</td>
	                        <td><?php if(isset($teacherName)){echo  $teacherName;}else{ echo '请添加课程主讲老师，否则将无法直播';} ?></td>
						</tr>
                        <tr>
                        	<td>房间账号</td>
                        	<td><?php echo $live['channlName']; ?></td>
                        </tr>  
                         <tr>
                        	<td>密码</td>
                        	<td><?php echo $live['password']; ?></td>
                        </tr>
                         
                        
                        </table>
                </form>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
function copyUrl2()
{
	 var Url2=document.getElementById("url");
	 Url2.select(); // 选择对象
	 document.execCommand("Copy"); // 执行浏览器复制命令
	 Alert("助教登录地址 已复制好");
 }
 </script>
