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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/font/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>

<body>
 <div class="ml20 pb20 mt-20 clearfix">
	 <a class="fl generalBtn c-fff fsize16 bRadius5 ml20" style="line-height: 42px;background-color: #fff;border: 1px solid #00c665;color: #666;text-align: center"> 外部导入 </a>
  <form target="hidframe"  class="fr mr20" action="<?php echo M_URL($this->AppName.'/index','addCourseStudent',$courseid,GP('')) ?>">

	<input type="text" class="inputText" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
	<button type="button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/index','addCourseStudent'); ?>','<?php echo URL_MODEL;?>');" class="searchBtn w93 fsize14 c-92 verAlignMiddle" >搜索</button>
  </form>
 </div>
 <div class="p20 pt0">
	 <form  action="<?php echo M_URL($this->AppName.'/index','doaddStudent',$courseid,GP('')) ?>"  method="post">
		   <div class="blank10"></div>
		   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo" style="border-bottom:0;">
			   <tr class="bg-gary">
			     <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p"></td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p">会员名称</td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14">注册日期</td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 w93">操作</td>
			   </tr>
               <?php foreach($student as $k=>$v){ ?>
			   <tr>
			     <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p"><input type="checkbox" class="chackInput check0" name="aid[]" value="<?php echo $v['userid'] ?>"></td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 w100p"><?php echo $v['name'] ?></td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
					<?php echo date('Y/m/d',$v['regdate']);  ?>
				 </td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 w150">
                 <a href="<?php echo M_URL($this->AppName.'/index','doaddCourseStudent',$courseid,'',GP("studentid-$v[userid]")) ?>" class="c-green pr10 pl10" title="加入课程">加入课程</a></td>
			   </tr>
               <?php } ?>
			  
			</table>
            <?php echo $page->show(3); ?>
		 <div class="fr clearfix mt30 mr30">

			 <div class="rightTd alignLife">
				 <input type="checkbox" name="" class="checkall chackInput verAlignMiddle check0 check-all ">全选
				 <input type="submit" class="generalBtn c-fff fsize16 bRadius5 ml20" value="确认" name="confirm">
			 </div>
		 </div>
			<div class="blank30"></div>
	  </form>
  </div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>

<script>
$(function(){
var selectInputs = $('.check0'); // 所有勾选框
var checkAllInputs = $('.check-all')	
selectall(selectInputs,checkAllInputs);
loadScorllJs();//滚轮
})
</script>
</body>
</html>
