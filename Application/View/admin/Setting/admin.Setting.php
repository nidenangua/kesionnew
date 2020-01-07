<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.titleTab li{width: 25%;float: left;}
	.titleTab .listbox{ min-width: 200px;text-align: center;height:180px;position: relative;cursor: pointer;box-shadow:0 2px 12px rgba(0,0,0,0.05); margin:0px 100px 50px 0px;background: #fff;}
	.titleTab .marks{font-size: 16px;line-height:40px;}
	.titleTab li p{position: absolute;bottom: 22px;margin: 0 auto; right: 0;left: 0;font-size: 17px;}
	.titleTab li span{position: absolute;bottom: 5px;margin: 0 auto; right: 0;left: 0;font-size: 13px;color: #188eee;display: none;}
	.titleTab li img{width: 65px; height: 65px; margin-top: 40px;transition: all 0.3s linear;}
	.titleTab li:hover .listbox{background: #f6f6f6;box-shadow: 0 0 10px #ccc;}
	.titleTab li:hover img{transform: scale(1.1);-webkit-transform: scale(1.1);-moz-transform: scale(1.1)}
	.page-animate{opacity: 0;filter:Alpha(opacity=0)}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo M_URL('Setting','savePlatSetting') ?>" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;平台配置</h3>
        <div class="ibox-tools">
            <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link"><i class="reflash"></i></a>
        </div>
    </div>
</div>


</div>

<div id="">
	<div style="padding: 40px 80px;">
	<ul class="titleTab clearfix" style="margin-right: -100px;">    
        <li class="fsize18 page-animate">
        	<div class="listbox">
                <a title="图片管理" target="main" href="<?php echo M_URL('Setting','platSetting'); ?>">
                    <img src="/Images/images/201711/icon-1.png" onerror="this.src='<?php echo nopic();?>'" />
                </a>
	            <div class="marks"><a title="平台配置"  target="main" href="<?php echo M_URL('Setting','platSetting'); ?>">平台配置</a></div>
           </div>
        </li>
        
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="图片管理"  target="main" href="<?php echo M_URL('Setting','areaIndex'); ?>">
	        		<img src="/Images/images/201711/icon-4.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="地区配置"  target="main" href="<?php echo M_URL('Setting','Area'); ?>">地区配置</a></div>
           </div>
        </li>
        
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="短信&邮件"  target="main" href="<?php echo M_URL('Setting','Smscontent'); ?>">
	        		<img src="/Images/images/201711/icon-5.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="短信&邮件"  target="main" href="<?php echo M_URL('Setting','Smscontent'); ?>">短信&邮件</a></div>
           </div>
        </li>
        
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="短信&邮件发送管理"  target="main" href="<?php echo M_URL('Setting','smsLog'); ?>">
	        		<img src="/Images/images/201711/icon-6.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="短信&邮件发送管理"  target="main" href="<?php echo M_URL('Setting','smsLog'); ?>">短信&邮件发送管理</a></div>
           </div>
        </li>
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="支付接口配置"  target="main" href="<?php echo M_URL('Setting','paySetting'); ?>">
	        		<img src="/Images/images/201711/icon-2.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="支付接口配置"  target="main" href="<?php echo M_URL('Setting','paySetting'); ?>">支付接口配置</a></div>
           </div>
        </li>
        
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="表字段扩展管理"  target="main" href="<?php echo M_URL('Setting','Fieldindex'); ?>">
	        		<img src="/Images/images/201711/icon-3.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="表字段扩展管理"  target="main" href="<?php echo M_URL('Setting','Fieldindex'); ?>">表字段扩展管理</a></div>
           </div>
        </li>
        
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="课程数据表管理"  target="main" href="<?php echo M_URL('Setting','extendIndex'); ?>">
	        		<img src="/Images/images/201711/5a002d1f57832.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="课程数据表管理"  target="main" href="<?php echo M_URL('Setting','extendIndex'); ?>">课程数据表管理</a></div>
           </div>
        </li>
        
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="登录接口"  target="main" href="<?php echo M_URL('Setting','loginConf'); ?>">
	        		<img src="/Images/images/201711/icon-7.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="登录接口"  target="main" href="<?php echo M_URL('Setting','loginConf'); ?>">登录接口</a></div>
           </div>
        </li>
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="实名认证管理"  target="main" href="<?php echo M_URL('Users','realName','',GP('')); ?>">
	        		<img src="/Images/images/201711/5a14e6aa7401b.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="实名认证管理"  target="main" href="<?php echo M_URL('Users','realName','',GP('')); ?>">实名认证管理</a></div>
           </div>
        </li>
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="视频服务配置"  target="main" href="<?php echo M_URL('Setting','livecloudmanage'); ?>">
	        		<img src="/Images/images/201711/5a14e66b35ee0.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="视频服务配置"  target="main" href="<?php echo M_URL('Setting','livecloudmanage'); ?>">视频服务配置</a></div>
           </div>
        </li> 
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="直播互动工具"  target="main" href="<?php echo M_URL('Setting','LiveTools'); ?>">
	        		<img src="/Images/images/201711/5a029d81a1c8f.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="视频服务配置"  target="main" href="<?php echo M_URL('Setting','LiveTools'); ?>">直播互动工具</a></div>
           </div>
        </li> 
         <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="直播pc客户端配置"  target="main" href="<?php echo M_URL('Setting','liveSetting'); ?>">
	        		<img src="/Images/images/201711/icon-4.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="直播pc客户端配置"  target="main" href="<?php echo M_URL('Setting','liveSetting'); ?>">直播pc客户端配置</a></div>
           </div>
        </li> 
         <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="直播pc客户端配置"  target="main" href="<?php echo M_URL('Setting','padsetting'); ?>">
	        		<img src="/Images/images/201711/icon-4.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="直播pc客户端配置"  target="main" href="<?php echo M_URL('Setting','padsetting'); ?>">Pad版本配置</a></div>
           </div>
        </li> 
        
          <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="直播分辨率配置"  target="main" href="<?php echo M_URL('Setting','resolution'); ?>">
	        		<img src="/Images/images/201711/icon-4.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="直播分辨率配置"  target="main" href="<?php echo M_URL('Setting','resolution'); ?>">直播分辨率配置</a></div>
           </div>
        </li> 
        
        
          <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="网校直播秘钥"  target="main" href="<?php echo M_URL('Setting','Secretkey'); ?>">
	        		<img src="/Images/images/201711/icon-4.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="直播分辨率配置"  target="main" href="<?php echo M_URL('Setting','Secretkey'); ?>">网校直播秘钥</a></div>
           </div>
        </li> 
        <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="分销任务配置"  target="main" href="<?php echo M_URL('Setting','tasks'); ?>">
	        		<img src="/Images/images/201711/icon-4.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="平台配置"  target="main" href="<?php echo M_URL('Setting','tasks'); ?>">分销任务配置</a></div>
           </div>
        </li>
         <li class="fsize18 page-animate">
        	<div class="listbox">
	        	<a title="客服微信号设置"  target="main" href="<?php echo M_URL('Setting','kfwecaht'); ?>">
	        		<img src="/Images/images/201711/icon-4.png" onerror="this.src='<?php echo nopic();?>'"/>
	        	</a>
	            <div class="marks"><a title="客服微信号设置"  target="main" href="<?php echo M_URL('Setting','kfwecaht'); ?>">客服微信号设置</a></div>
           </div>
        </li>
        
	</ul>
	</div>
</div>



</form>
</div>
</body>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
<script>
 pageAnimate('.page-animate');
 $('.titleTab').find('li').hover(function(){
 	$(this).find('span').fadeIn();
 },function(){
 		$(this).find('span').hide();
 })
</script>
</html>


<!--<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>
<body class="gray-bg">
<div id="manage_top" class="menu_top_fixed height73 p15 ">
	<div class="ibox-title">
		<h3 class="fl"></h3>
	  	<div class="ibox-tools">
			<a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0"><i class="reflash"></i></a>
	  	</div>
		<button type="button" onclick="addversion()" class="btn btn-info btn-rounded btn-s-md " style="color:#676a6c;margin-left:20px">增加收费类型</button>
		<button type="button" onclick="addfeature()" class="btn btn-info btn-rounded btn-s-md " style="color:#676a6c;margin-left:20px">增加收费功能</button>
	</div>
</div>
        
        
<div class="bRadius10  clearfix">


</div>



</body>
</html>-->








