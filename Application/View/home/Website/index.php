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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
	.titleTab li{width: 20%;float: left;}
	.titleTab .listbox{text-align: center;height:180px;position: relative;cursor: pointer;border-radius: 10px; box-shadow: none;border: 1px solid #EEEEEE; margin:0px 40px 15px 0px;background: #fff;}
	.titleTab li p{position: absolute;bottom: 22px;margin: 0 auto; right: 0;left: 0;font-size: 17px;}
	.titleTab li span{position: absolute;bottom: 5px;margin: 0 auto; right: 0;left: 0;font-size: 13px;color: #188eee;display: none;}
	.titleTab li img{width: 65px; height: 65px; margin-top: 40px;transition: all 0.3s linear;}
	.titleTab li:hover .listbox{background: #ffffff;box-shadow: 0 2px 6px #eee}
	
</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	<h3 class="ks-head-title">网站配置</h3>
	    </div>
	    <!--header-->
					     
		<form target="hidframe" action="//ks.kesion.com/home.html/users/Index/bathdeluser?appid-3,usertype-0,p-1" method="post" id="myform">		  
			<!--table-->
			<div>
		    	<ul class="titleTab clearfix" style="margin:35px 0px 15px 0;">    
		    		<?php foreach($nustchooseapp as $k=>$v){ ?>   
		    				
			        <?php } ?>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="系统设置"  target="main" href="<?php echo M_URL('config/Index','','',GP('appid-1'));?>"><img src="/Images/images/201711/5a14e62f25490.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="系统设置"  target="main" href="<?php echo M_URL('config/Index','','',GP('appid-1'));?>">系统设置</a></div>
			           </div>
			        </li>  
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="网校分类"  target="main" href="<?php echo M_URL('category/Index','','',GP('appid-2'));?>"><img src="/Images/images/201707/14994809540395.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="网校分类"  target="main" href="<?php echo M_URL('category/Index','','',GP('appid-2'));?>">网校分类</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="域名设置"  target="main" href="<?php echo M_URL('Website','websitedomain'); ?>"><img src="/Images/images/201711/5a14e62f25490.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="域名设置"  target="main" href="<?php echo M_URL('Website','websitedomain'); ?>">域名设置</a></div>
			           </div>
			        </li>	
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="模板设置"  target="main" href="<?php echo M_URL('Website','websitetemplate',0); ?>"><img src="/Images/images/201711/5a14e5d781885.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="模板设置"  target="main" href="<?php echo M_URL('Website','websitetemplate',0); ?>">模板设置</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="短信设置"  target="main" href="<?php echo M_URL('sms/Index','','',GP('appid-17'));?>"><img src="/Images/images/201711/5a14e5e860105.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="短信设置"  target="main" href="<?php echo M_URL('sms/Index','','',GP('appid-17'));?>">短信设置</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="邮箱设置"  target="main" href="<?php echo M_URL('email/Index','','',GP('appid-18'));?>"><img src="/Images/images/201711/5a14e5d781885.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="邮箱设置"  target="main" href="<?php echo M_URL('email/Index','','',GP('appid-18'));?>">邮箱设置</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="站内信模板"  target="main" href="<?php echo M_URL('Massage','config');?>"><img src="/Images/images/201711/5a14e5d781885.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="站内信设置"  target="main" href="<?php echo M_URL('Massage','config');?>">站内信设置</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="收款设置"  target="main" href="<?php echo M_URL('pay/Index','','',GP('appid-19'));?>"><img src="/Images/images/201711/5a14e5c8e0fe8.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="收款设置"  target="main" href="<?php echo M_URL('pay/Index','','',GP('appid-19'));?>">收款设置</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="第三方登录"  target="main" href="<?php echo M_URL('login/Index','','',GP('appid-20'));?>"><img src="/Images/images/201711/5a14e5b8bb8ff.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="第三方登录"  target="main" href="<?php echo M_URL('login/Index','','',GP('appid-20'));?>">第三方登录</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="数据统计"  target="main" href="<?php echo M_URL('statistics/Index','','',GP('appid-27'));?>"><img src="/Images/images/201711/5a002d1f57832.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="数据统计"  target="main" href="<?php echo M_URL('statistics/Index','','',GP('appid-27'));?>">数据统计</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="图片管理"  target="main" href="<?php echo M_URL('Website','attachment'); ?>"><img src="/Images/images/201711/5a14e78d75887.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="图片管理"  target="main" href="<?php echo M_URL('Website','attachment'); ?>">图片管理</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="附件管理"  target="main" href="<?php echo M_URL('Website','wxfilegl'); ?>"><img src="/Images/images/201711/5a00304c019b2.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="附件管理"  target="main" href="<?php echo M_URL('Website','wxfilegl'); ?>">附件管理</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="联系方式"  target="main" href="<?php echo M_URL('Website','websiteContact'); ?>"><img src="/Images/images/201711/5a053fc402cbd.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="联系方式"  target="main" href="<?php echo M_URL('Website','websiteContact'); ?>">联系方式</a></div>
			           </div>
			        </li>
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="播放器设置"  target="main" href="<?php echo M_URL('vod/Index','playSetting','',GP('appid-5'));?>"><img src="/Images/images/201711/play.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="播放器设置"  target="main" href="<?php echo M_URL('vod/Index','playSetting','',GP('appid-5'));?>">播放器设置</a></div>
			           </div>
			        </li>	
			        <li class="fl fsize18 page-animate">
			        	<div class="listbox">
				        	<a title="网校介绍"  target="main" href="<?php echo M_URL('config/Index','wxinfo','',GP('appid-1'));?>"><img src="/Images/images/201711/intro.png" onerror="this.src='<?php echo nopic();?>'"/></a>
				            <div class="fsize16 hLh25"><a title="网校介绍"  target="main" href="<?php echo M_URL('config/Index','wxinfo','',GP('appid-1'));?>">网校介绍</a></div>
			           </div>
			        </li>
			        
			        
		    	</ul>
		    </div>
	        <!--/table-->
		</form>
	</div>
	


<script src="//ks.kesion.com//Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll','animate'],function(){
		loadScorllJs();
		pageAnimate('.page-animate');
		$('.titleTab').find('li').hover(function(){
		 	$(this).find('span').fadeIn();
		},function(){
		 	$(this).find('span').hide();
		})

	});
 
</script>
</body>
</html>








