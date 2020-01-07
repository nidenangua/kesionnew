
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
    <link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
	<style>
		.ml30{position: relative;top: 5px; margin-left: 20px!important;}
		.span-inline label{display: block;float: none!important;margin-bottom: 10px;}
	</style>
</head>
<body class="ks-wrap"> 
	
	<div class="bRadius10 ">
		<ul>
       <?php foreach($allAry as $k=>$v){ ?>		
	    <li style="    width: 132px;float: left;margin-left: 10px;text-align: center;">
	    	<div>
	    	<img src="<?php echo $this->upload->getHead($v['userid']);?>" style='width: 132px;height: 132px;'/>
	    	<span id="">
	    		<?php echo $v['username']  ?>
	    	</span>
	    	</div>
	    </li>
	   <?php } ?>
       </ul>
    </div>
    <button type="button" class="ks-bt bt-pue" onclick="close1();">关闭</button>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script> 
<script>
function close1(){
	//parent.closePopup('all');
	top.closePopup('all');
}
</script>
</body>
</html>
