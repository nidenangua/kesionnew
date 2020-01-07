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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body>

	  
	<div class="ks-wbox">
		
	
	<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','dochapterTemplate',$courseid,GP('')) ?>" method="post" id="myform">
	       <input type="radio"  name="chapterTemplate" value="1"/>章-节-课时<br />
	       <input type="radio"  name="chapterTemplate" value="2"/>章-课时<br />
	      <input type="radio"  name="chapterTemplate" value="3"/>课时<br />
	        
	    <input  type="button" onclick="do_reg();" class="generalBtn c-fff fsize16 bRadius5" value="确认">
    </form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>

<script>
	
function do_reg(){
    var val=$('input:radio[name="chapterTemplate"]:checked').val();
    if(val ==null){
    	Alert('请选择');return false;
    }  
	$('#myform').submit();
}


</script>
</body>
</html>
