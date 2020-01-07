<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>/Public/app/css/laydate.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/popup/css/kesion.popup.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<script src="<?php echo UOOT;?>Public/popup/js/kesion.popup.js"></script>

</head>
<style>
	.Created-ing>ul>li{margin: 40px 0px;}
	.Created-title span:last-child { margin-left: 20px; }
	.defInput{width: 200px!important;}
	.win-info{}
	.win-info li{margin-bottom: 40px;}
	.addButton{background: #71B0EC;color:#FFFFFF;border: none;padding: 3px 20px!important;border-radius: 3px;}
	.thisInput{margin: 0px!important;}
	.thisSelect{margin: 0px!important;display: none;}
</style> 
<body class="ks-wrap">
	
	<div id="ksBoxHead"></div>
	
	<div class="clearfix">
		<div class="Created-push clearfix" id="ksBoxContent"> 
			<form target="hidframe" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','doedit','',GP("id-".$h5info['id'].',p-'.$now_page));?>"  method="post" enctype="multipart/form-data">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>活动名称:</h4>
								<div class="Created-Content">
									
									<input type="text" class="long-text" name="name" flag ='活动名称' value="<?php echo $h5info['name']; ?>">&nbsp;&nbsp;
									
									
								</div>
							</li>
							<li>
								<h4>活动介绍:</h4>
								<div class="Created-Content">
									
									<input type="text" class="long-text" name="introduction" flag ='活动介绍' value="<?php echo $h5info['introduction']; ?>">&nbsp;&nbsp;
									
									
								</div>
							</li>
							<li>
								<h4 >活动次数:</h4>
								<div class="Created-Content">
									<input type="text" class="long-text" name="number" flag ='活动介绍' value="<?php echo $h5info['number']; ?>">&nbsp;&nbsp;
										
								</div>
							</li>
							<li>
								<h4>活动时间:</h4>
								<div class="Created-Content">
									<input id="datatime1" type="text" value="<?php echo date('Y-m-d H:i:s',$h5info['startime']); ?>" name="startime" required readonly class="w200  laydate-icon"> 至
									<input id="datatime2" type="text" value="<?php echo date('Y-m-d H:i:s',$h5info['endtime']); ?>"name="endtime" required readonly class="w200  laydate-icon">
								</div>
							</li>
						</ul>
					</div>		
			</form>
			
		</div>	
		
		
	</div>

  	<div id="ksBoxFooter clearfix"  style="position: fixed;bottom: 0px;left: 0px; width: 100%;height:70px;z-index: 10000000;background: #FFFFFF;">
		<div class="form-footer" style="padding-top: 5px;">
			<span class="d-inline-block">
			<button type="button" onclick="do_reg()" class="ks-bt bt-pue">确认修改</button>
		    <a href="javascript:top.closePopup('all');" class="ks-bt bt-def">取消</a>
		    </span>
	    </div>
	</div>
	
      
 
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
<script>


datatime("#datatime1");
datatime("#datatime2"); 


 function do_reg()
{   
	var inputary = $('input'); 
	var falg = 0;
	for(var i = 0;i<inputary.length;i++){
		if($(inputary[i]).val()==''){
			if($(inputary[i]).attr('name') !='money'){
				Alert('请填写'+$(inputary[i]).attr('flag'));
				falg--;
				return;
			}
		}else{
			falg++;
		}
	}
	if(falg>0){
		$("#myform").submit();
	}
	
//  
 }
</script>
</body>
</html>
