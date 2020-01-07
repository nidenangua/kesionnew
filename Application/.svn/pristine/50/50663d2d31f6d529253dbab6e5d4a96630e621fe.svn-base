<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<title>无标题文档</title>
</head>
<form target="hidframe"  action="<?php  echo M_URL('teacher','doaddteacher')?>" method="post">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
       <tr>
         <td class="leftTd alignRight fsize14 c-92 w93 pt0">所属分类<div class="fsize12"></div></td>
          <td class="rightTd alignLife pt0">
            <select class="bRadius5" name="categoryid">
              <option value="0">无--作为一级栏目</option>';
              <?php foreach($userscategory as $k=>$v){?>
              <option value=<?php $v["categoryid"]?>><?php echo KS_INDENT($v['depth']).$v["categoryname"]?></option>
              <?php }?>
            </select>
          </td>
      </tr>
       <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">姓名</td>
		 <td class="rightTd alignLife pt0">
		   <input type="text" name="teachername" value="" class="inputText bRadius5">
		 </td>
	   </tr>
        <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">登录密码</td>
		 <td class="rightTd alignLife pt0">
		   <input type="text" name="password" value="" class="inputText bRadius5">
		 </td>
	   </tr>
        <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">确认密码</td>
		 <td class="rightTd alignLife pt0">
		   <input type="text" name="repassword" value="" class="inputText bRadius5">
		 </td>
	   </tr>
        <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">手机</td>
		 <td class="rightTd alignLife pt0">
		   <input type="text" name="mobile" value="" class="inputText bRadius5">
		 </td>
	   </tr>
        <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">邮箱</td>
		 <td class="rightTd alignLife pt0">
		   <input type="text" name="mobile" value="" class="inputText bRadius5">
		 </td>
	   </tr>
        <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">性别</td>
		 <td class="rightTd alignLife pt0">
		   <label class="radioLabel fl">
               <input type="radio" name="customerstatus" id="customerstatus" class="radioInput" value="1">
                 <span class="radioName fsize16 c-92">男</span>
                </label>
              <label class="radioLabel fl">
                 <input type="radio" name="customerstatus" id="customerstatus" class="radioInput" value="0">
                 <span class="radioName fsize16 c-92">女</span>
               </label>
		 </td>
	   </tr>
  </table>
</form>
<body>
</body>
</html>