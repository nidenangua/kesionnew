<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>

<body class="bg-gary">
<div class="contentBox bRadius10 bg-white w100">
  <div class="generalTitle alignCenter">
     <a class="roundBox fl"  href="javascript:history.go(-1);"><img src="<?php echo UOOT;?>Public/app/images/return.png" class="mr10 verAlignMiddle" width="15"><em class="c-92 fsize16 verAlignMiddle">返回</em></a>
	 <span class="gTitle fsize18 c-3e verAlignMiddle">添加分类</span>
  </div>
  <div class="infoBox">
   <form target="hidframe"  action="<?php if(!isset($category_one["categoryname"])){echo M_URL($this->AppName.'/Index','doaddCategory','',GP(''));}else{echo M_URL($this->AppName.'/Index','doeditCategory',$category_one['categoryid'],GP('p-'.$now_page));} ?>" method="post" class="form-horizontal">
     <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
      <tr>
	     <td class="leftTd alignRight fsize16 c-92 w93">所属分类</td>
		 <td class="rightTd alignLife">
		 <select name="parentid" <?php if(isset($category_one)){echo 'disabled'; } ?> class="inputText bRadius5 w300">
              <?php
				  $html = '<option value="0">无--作为一级分类</option>';
			      foreach($category as $k=>$v)
				  {
					  if(!isset($category))
					  { 
					     $html .= '<option value="'.$v['categoryid'].'">'.KS_INDENT($v['depth']).$v['categoryname'].'</option>'; 
					  }else{
						  
						 $html .= '<option value="'.$v['categoryid'].'"';
						 if($categoryid==$v['categoryid'])
						 {
							 $html .= 'selected="selected"';
							 }
						 $html .= ' >'.KS_INDENT($v['depth']).$v['categoryname'].'</option>'; 
						  
				      }
			      }
				  echo $html;
               ?>
           </select>
		 </td>
	   </tr>
	   <tr>
	     <td class="leftTd alignRight fsize16 c-92 w93">分类名称</td>
		 <td class="rightTd alignLife">
			<div class="form-limit" limit="30">
				<input type="text" name="categoryname" value="<?php if(isset($category_one["categoryname"]))echo $category_one["categoryname"]  ?>" class="inputText bRadius5 w300" required>
			 </div>
		 </td>
	   </tr>
       <tr>
	     <td class="leftTd alignRight fsize16 c-92 w93">分类英文名</td>
		 <td class="rightTd alignLife">
		   <input type="text" name="categoryename" value="<?php if(isset($category_one["categoryename"]))echo $category_one["categoryename"]  ?>" class="inputText bRadius5 w300" required>
		 </td>
	   </tr>
	   <tr>
	     <td class="leftTd alignRight fsize16 c-92 w93 verAlignTop">分类介绍</td>
		 <td class="rightTd alignLife">
              <?php echo $kindeditor;?>
		 </td>
	   </tr>
	   <tr>
	     <td class="leftTd alignRight w93"></td>
		 <td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize14 bRadius5" value="确认" name="confirm"></td>
	   </tr>
	 </table>
   </form>
   <div class="hLh40"></div>
  </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage'],function(){
		
	});
</script>
</body>
</html>
