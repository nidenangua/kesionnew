<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<title><?php echo $websiteinfo['sitename']==null?"欢迎进入科汛V名师":'传播知识，用科汛V名师-'.$websiteinfo['sitename'];?></title>
	<meta name="Keywords" content="在线教育平台"/>
	<meta name="Description" content="在线教育平台" />
	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<!--reset page style-->
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<!--//reset page style end-->
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/frame.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?ajf2hs2y4do1p2f" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	
</head>
<body style=" overflow-x:auto; overflow-y:hidden;min-width: 1280px;">
	<div class="header">
		<div class="logo"><a href="<?php echo M_URL('Index','mainfirst'); ?>" target="main"><img src="/Public/admin/images/logo.png" /></a></div>
		<div class="fl" style="margin-left: 191px;">
			
		 
		</div>
		<div class="header-right"> 
			<div class="user-base parentsInfo">
				<ul class="user-baseUl">
					<!--<li><a href="<?php echo M_URL('Service','upgrade');?>" target="main">当前套餐：<?php echo $versionname;?></a></li>-->
					<?php if($module[0]==1){?>	
					<li><div class="listDown"><a href="http://<?php echo $info['domain'];?>?f=pc" class="user-listh" target="_blank">网校首页</a></div></li>
					 <?php }?>
					<li>
						<div class="listDown">
							<a href="<?php echo M_URL('Service','myapp'); ?>" target="main" class="user-listh user-list-a" href="javascript:void(0)"><i class="iconfont icon-arrow-down"></i>订购服务</a>
							<div class="user-box" style="left:-66px">
								<a href="<?php echo M_URL('Service','myapp'); ?>" target="main">我的应用</a>
								<a href="<?php echo M_URL('Service','upgrade'); ?>" target="main">升级套餐</a>
								<a href="<?php echo M_URL('Shop','CapacityService'); ?>"  target="main">扩容服务</a>
								<a href="<?php echo M_URL('Service','orderList'); ?>" target="main">我的订单</a>
				  			    <a href="<?php echo M_URL('Service','Cart'); ?>" target="main">购&nbsp;&nbsp;物&nbsp;&nbsp;车</a>
							</div>
						</div>
					</li>
					<li><a href="javascript:;" onClick="addTypeChange('<?php echo M_URL('Website','problem');?>','850px','700px')" target="main">问题反馈</a></li>
				</ul>
			</div>
			<div class="user-info">
				<a href="<?php echo M_URL('Massage','index');?>" target="main" class="user-messg"><i class="iconfont icon-xitongxiaoxitubiao"></i><i class="user-number"></i></a>
				<div class="user-name listDown" id="username">
					<a target="main" href="<?php echo M_URL('User','editUsers'); ?>"><img src="<?php echo $this->upload->getHead($this->userid,10,$this->userinfo['usertype']).'?'.time();?>" class="m-avatar index-src" /></a>
					<a style="position: relative;"  target="main" href="<?php echo M_URL('User','editUsers'); ?>"><?php echo $this->userinfo['username']; ?></a>
					<div class="user-box">
						<a href="<?php echo M_URL('User','editUsers'); ?>" target="main"><?php if($this->userinfo['usertype']==1){ echo '教师信息';}else{ echo '机构信息';} ?></a>
						<a href="<?php echo M_URL('Taskhome','index'); ?>" target="main">任务中心</a>
						<a href="<?php echo M_URL('Website','websitetemplate',0); ?>" target="main">风格管理</a>
	                    <a href="<?php echo M_URL('User','realName'); ?>" target="main">实名认证</a>
						<a href="<?php echo M_URL('Kjlogin'); ?>" target="main" style="display:none">便捷登陆</a>
						<a href="<?php echo M_URL('Changepwd','editPwd'); ?>" target="main">修改密码</a>
						<a href="<?php echo M_URL('Capital'); ?>" target="main">我的财富</a>
						<a href="<?php echo M_URL('config/Index','liveSecret','',GP('appid-1'));?>" target="main">开发密钥</a>
						<a href="<?php echo M_URL('User','logout'); ?>" class='user-listh' target="main"><div>退出</div></a>
					</div>
				</div>
			</div>
		</div>
  </div>

  <div class="frame-main clearfix" id="frame-main">
    <!--<li class="on"><a href="<?php echo M_URL('Index','mainfirst'); ?>" target="main">平台主页</a></li>-->
    <div class="frame-left">
	   <div class="firstNav">
		   <ul class="leftBoxUl">
		   		<li>
		   			<ul class="second">
						<li class="on" style="font-size:14px;"><a style="padding-left: 20px;" href="<?php echo M_URL('Index','mainfirst'); ?>" target="main"><i class="menuicon iconfont icon-houtaifuwu"></i>主页</a></li>	
					</ul>			
				</li>
				<li>
					<span onClick="leftMenuToggle(this)" ><i class="iconfont icon-arrow-down"></i><i class="menuicon iconfont icon-course"></i>店铺管理</span>	
					
					<ul class="second">
						<li>
							<a target="main" href="/home.html/default/Index/home#/store">公众号店铺</a>
						</li>
                        <!--
						<li>
							<a target="main" href="<?php echo M_URL('applet/Index','','',GP('appid-25'));?>">小程序店铺</a>
						</li>
						<li>
							<a target="main" href="<?php echo M_URL('config/Index','','',GP('appid-1'));?>">电脑店铺</a>
						</li>
                            -->
						 <li>
							<a target="main" href="/home.html/default/Index/home#/store/setup">店铺设置</a>
						</li>
                        <li>
							<a target="main" href="<?php echo M_URL('category/Index','','',GP('appid-2'));?>">店铺分类</a>
						</li>
						<!--<li><a href="<?php echo M_URL('Website','attachment'); ?>" target="main">文件管理</a></li> -->
					</ul>
				</li>
				
			    <li>
			   		 <span onClick="leftMenuToggle(this)" ><i class="iconfont icon-arrow-down"></i><i class="menuicon iconfont icon-course"></i>课程管理</span>	
					<ul class="second" >
	                 	
						<ul class="knodge-list clearfix">  
							<?php if(ismoduleopen($this->wxid,6,1)){?><li><a href="<?php echo M_URL('course/Index','index','',GP('appid-6')); ?>" target="main" title="视频点播">视频</a></li><?php }?>
							<?php if(ismoduleopen($this->wxid,6,3)){?><li><a href="<?php echo M_URL('course/Index','index','',GP('appid-6,courseType-3')); ?>" target="main" title="音频管理">音频</a></li><?php }?>
							<?php if(ismoduleopen($this->wxid,6,4)){?><li><a href="<?php echo M_URL('course/Index','index','',GP('appid-6,courseType-4')); ?>" target="main" title="图文管理">图文</a><?php }?>
							<?php if(ismoduleopen($this->wxid,30)){?><li><a href="<?php echo M_URL('class/Index','index','',GP('classlevel-2,appid-30')); ?>" target="main" title="视频互动直播">直播</a></li><?php }?>
							

							<?php if(ismoduleopen($this->wxid,106,0))//有开启 
                                  {?>
                              <li><a href="<?php echo M_URL('column/Index','','',GP('appid-104'));?>" onClick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,106,false,true);?>'})" target="main" title="专栏管理">专栏</a></li>
                            <?php
                             }?>

						</ul>
					
					</ul>
				</li>
				<li>
					<span onClick="leftMenuToggle(this)" ><i class="iconfont icon-arrow-down"></i><i class="menuicon iconfont icon-course"></i>教学工具</span>	
					
					<ul class="second">
						<?php if(ismoduleopen($this->wxid,10)){?>
						<li>
							<a href="<?php echo M_URL('exam/Index','','',GP('appid-10'));?>" target="main">考试系统</a>
						</li>
						<?php }?>
						<?php if(ismoduleopen($this->wxid,35,0)){?>
						<li>
							<a href="<?php echo M_URL('team/Index','','',GP('appid-35')); ?>" onClick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,35,false,true);?>'})"  target="main">社群管理</a>
						</li>
						<?php }?>
						<li>
							<a target="main" href="<?php echo M_URL('users/Index','','',GP('appid-11'));?>">讲师管理</a>
						</li>
					
						<?php if(ismoduleopen($this->wxid,101)){?>
						<li>
							<a target="main" href="<?php echo M_URL('article/Index','','',GP('appid-101')); ?>">新闻资讯</a>
						</li>
						<?php }?>
					</ul>
				</li>

				<li>
					<span class="checked" onClick="leftMenuToggle(this)"><i class="iconfont 	icon-arrow-down"></i><i class="menuicon iconfont icon-course"></i>用户管理</span>	
					<ul class="second" style="display:none">
						<li>
							<a href="<?php echo M_URL('users/Index','','',GP('appid-3'));?>" target="main">学员管理</a>
						</li>
                            <?php if(ismoduleopen($this->wxid,3,0)){?>
                            <li>
                              <a href="<?php echo M_URL('users/Index','showgroup','',GP('appid-3'));?>"  onclick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,3,false,true);?>'})"target="main">分组(VIP)</a>
                            </li>
                            <?php }?>
							
						<li>
							<a target="main" href="<?php echo M_URL('interact/Index','','',GP('appid-8'));?>">评论管理</a>
						</li>
					</ul>
					
				</li>
				<li>
					<span class="checked" onClick="leftMenuToggle(this)" ><i class="iconfont icon-arrow-down"></i><i class="menuicon iconfont icon-course"></i>运营管理</span>	
					<ul class="second" style="display:none">
						<?php if($module[2]){?>
						<li>
							<a href="<?php echo M_URL('wechat/Index','','',GP('appid-23'));?>" target="main">公众号管理</a>
						</li>
						<?php }?>	
								
						<li>
							<a href="<?php echo M_URL('default/Massage','postlist','',GP('appid-8,option-2'));?>" target="main">站内消息</a>
						</li>
						<li>
							<a target="main" href="<?php echo M_URL('default/Massage','postlist','',GP('appid-8'));?>">公告管理</a>
						</li>
					</ul>
				</li>
				<li>
					<span class="checked" onClick="leftMenuToggle(this)" ><i class="iconfont icon-arrow-down"></i><i class="menuicon iconfont icon-course"></i>财务管理</span>	
					<ul class="second" style="display:none">
						<li>
							<a href="<?php echo M_URL('order/Index','','',GP('appid-4')); ?>" target="main">订单管理</a>
						</li>
						<li>
							<a href="<?php echo M_URL('Capital','withdrawbill');?>" target="main">结算中心</a>
						</li>
                            <li>
                              <a href="/home.html/default/Index/home#/receipt"  target="main">收款设置</a>
                            </li>
					</ul>
				</li>
               <?php if ($module[5]){ ?>
				<li>
					<span class="checked" onClick="leftMenuToggle(this)" ><i class="iconfont icon-arrow-down"></i><i class="menuicon iconfont icon-course"></i>营销工具</span>	
					<ul class="second" style="display:none">
						
                          <?php if(ismoduleopen($this->wxid,105,0)){?>
                          <li>
                            <a href="<?php echo M_URL('Distribution','index','');?>"  target="main">分销管理</a>
                           </li>
                        <?php }?>
						
						 <?php if(ismoduleopen($this->wxid,26,0)){?>
                          <li>
                            <a href="<?php echo M_URL('h5market/Index','collage','',GP('appid-26'));?>"  onclick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,26,false,true);?>'})"  target="main">拼团管理</a>
                          </li>
                        <?php }?>
						
						 <?php if(ismoduleopen($this->wxid,31,0)){?>
						<li>
							<a href="<?php echo M_URL('voucher/Index','','',GP('appid-31'));?>" onClick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,31,false,true);?>'})" target="main">优惠券</a>
						</li>
                        <?php }?>
						
					</ul>
				</li>
               <?php } ?>
				<!--<li>
					<a href="<?php echo M_URL('order/Index','','',GP('appid-4')); ?>" target="main"><span onclick="leftMenuToggle(this)"><i class="menuicon iconfont icon-zijinguanli"></i>订单中心</span></a>
				</li>-->
				
			   </ul>  

		  	</ul>
	   	</div>
	</div>
	<div class="frame-right" id="frame-right" style="background: #eef2f5;">
	   <iframe src="<?php echo $indoorurl; ?>" id="main" name="main" frameborder="0" scrolling="auto" width="100%"></iframe> 
	</div>
	
	<?php $wxsetting=explode('|',$websiteinfo['setting']);if(empty($wxsetting[8])&&$websiteinfo['initial']==1){ ?>
		<div class="guide-bg"></div>
		<div class="guide-step guide-step1">
			<div class="button">
				<div class="next-btn" onClick="nextStep(1)"></div>
				<div class="jump-over" onClick="jumpOver()">跳过</div>
			</div>
		</div>
		<div class="guide-step guide-step2">
			<div class="button">
				<div class="next-btn" onClick="nextStep(2)"></div>
				<div class="jump-over" onClick="jumpOver()">跳过</div>
			</div>
		</div>
		<!-- <div class="guide-step guide-step3">
			<div class="button">
				<div class="next-btn" onclick="nextStep(3)"></div>
				<div class="jump-over" onclick="jumpOver()">跳过</div>
			</div>
		</div>
		<div class="guide-step guide-step4">
			<div class="button">
				<div class="next-btn" onclick="nextStep(4)"></div>
				<div class="jump-over" onclick="jumpOver()">跳过</div>
			</div>
		</div> -->
		<div class="guide-step guide-step3">
			<div class="button">
				<div class="carry-out" onClick="nextStep(3)"></div>
			</div>
		</div>
	<?php }?>

</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','Zpopup','nicescroll'],function(){
		<?php if($base['registerinfo']==1&&$websiteinfo['initial']==0){ //第一次注册，提示关注公众号
        ?>
		addTypeChange('<?php echo M_URL('Index','initial'); ?>','470px','490px',{title:''});
		<?php } ?>	
		
		$('.frame-left').niceScroll({
	        cursorcolor:"#c1c4cb",
	        cursoropacitymax:1,
	        touchbehavior:false,
	        cursorwidth:"8px",
	        cursorborder:"0",
	        cursorborderradius:"30px"
	   })
		$(".second").on('click','li',function(){
			this.className.indexOf('child') === -1 ? (
				$(".leftBoxUl").find('li').removeClass('on'),
				$(".leftBoxUl").find('.active').removeClass('active'),
			   	$(this).addClass("on").parents('.second').prev('span').addClass('active'),
			   	$(this).parents('.sun').prev('.child').addClass('active')
		   ) : (
		   		$(this).find('span').toggleClass('checked2'),
		   		$(this).next('.sun').slideToggle(400)
		   )
		});
		$('.listDown').hover(function(){
			$(this).find('.user-box').stop().css({
				display:'block',
				opacity:0
			}).animate({
				opacity:1,
				top:44
			},300)
		},function(){
			$(this).find('.user-box').animate({
				opacity:0,
				top:34
			},300,function(){
				$(this).hide()
			})
		});
		$('#frame-main,#frame-right').height( window.innerHeight - $('.header').height())
		$(window).resize(function(){
			$('#frame-main,#frame-right').height( window.innerHeight - $('.header').height())
		});
		function getNew(){
			$.ajax({  
			    type : "POST",  
			    url : "<?php echo M_URL('Index','noread') ?>",  
			    data : {},  
			    timeout : 20000,  
			    cache : false,  
			    beforeSend : function(XMLHttpRequest) {  
			    },  
			    success : function(data, textStatus) {  
			    	data == 0 ? $('.user-number').hide() : $('.user-number').show().html(data);
			    },  
			});
		}
		getNew();
		
		nextStep(0)
	});
	
	function dataCallBack(data){	
		$('.index-src').attr('src',data.imagesurl);
	};
	function leftMenuToggle(target){
		$(target).toggleClass('checked').next('ul').slideToggle(400)
	};
	
	function nextStep(index){
		var $main = $(frames['main'].document).find('body')
		
		$('.guide-step').hide();
		$('.guide-step'+(index+1)).show();
		switch (index){
			case 0:
				$('.guide-bg').fadeIn(300);
				$('#username').addClass('guide-user')
				break;
			case 1:
				$('#username').removeClass('guide-user');
				
				frames['main'].scrollTo(0,240)
				$main.css('overflow','hidden');
				$main.append('<div class="guide-bg"></div>').find('#modulelist').addClass('guide-show')
				$('#frame-right').addClass('guide-show')
				break;
			case 2:
				frames['main'].scrollTo(0,280)
				$main.find('.guide-show').removeClass('guide-show')
				$main.find('#dataAnalysis').addClass('guide-show');
				break;
			case 3:
				jumpOver(true)
			
		}
	}
	function jumpOver(flag){
		var $main = $('#main').contents().find('body');
		if(flag){
			$main.css('overflow','').find('.guide-show').removeClass('guide-show');
			$main.find('.guide-bg').fadeOut(300);
			$('.guide-bg').fadeOut(300);
			$('.guide-show').removeClass('guide-show');
			$('.guide-step').hide()
			guideAjax();
		}else{
			
			popup.confirm('您确定跳过引导吗？',{
				determine:function(){
					$('.guide-bg').fadeOut(300);
					$('.guide-step').hide()
					guideAjax();
				}
			})
		}
	}
	function guideAjax(){
		 $.post("<?php echo M_URL('Ajax','guideAjax') ?>",{},function(data){});
	}
</script>
</body>
</html>