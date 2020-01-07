<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>新建小程序</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
	.program-box {background: url('<?php echo UOOT;?>Public/app/images/classIcon/phone.png') left center no-repeat;	  
    height: 585px;background-position: left;max-width: 100%;width: 280px;
  }
.program-img {  position: relative; left: 15px;width: 243px;padding-top: 83px;height: 413px;overflow: hidden;}
.program-img img {width: 100%;height: 100%;}


</style>
</head>
<body class="ks-wrap">
  <div class="ks-wbox bRadius10">
	<div class="ks-head-box">
		<h3 class="ks-head-title">
			开始搭建——可选择模版套系一键生成您的小程序
		</h3>
	</div>
	
	<div class="smll-program">
    		<ul class="clearfix">
    			<?php foreach($values as $k=>$v){ ?>
	    		<li class="col-3 col-md-4">
					<div class="program-box">
						<div class="program-img">
							<img src="<?php echo $v['pic']; ?>">
						</div>					
					</div>
					<div class="program-btn"><button class="ks-bt ks-bt1" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','appiframe',$v['id'],GP('appid-'.$this->appid))?>','600px','800px',{title:'<?php echo $v['tempname'] ?>'})">使用</button></div>
    			</li>
    			<?php } ?>   
    		</ul>
    	</div>
    	
    <div class="ks-bom clearfix">
    	<div class="fr">
    			<?php echo $page->show(3); ?>
    	</div>
    </div>	
  </div>		
	
	</div>
</bod>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs()
		})
	</script>	
</html>