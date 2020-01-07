<html>
	<head>
	  <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="renderer" content="webkit">
	    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/dragphone/css/kesion_bse.css"/>
	    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/dragphone/css/style.css"/>
	    <!--kesion popup-->
		<link rel="Stylesheet" href="<?php echo UOOT;?>Public/popup/css/kesion.popup.css">
		<!--//kesion popup end-->
		<title>首页1111111111111111111</title>
		<script>
			var dragForm = 'phone'; 
			var dragPageIndex = '/Plus/Ajaxlabel.php?tempid=<?php echo $tempid;?>&pathid=<?php echo $pathid;?>&form=m'
		    var tpDir   = "<?php echo $tpDir;?>";
		    var pathid  = "<?php echo $pathid;?>";
		    var tempid  = "<?php echo $tempid;?>";
		    var isDeBug = 0;   //调试状态 1 启用 0不启用
	</script>
	
	</head>
	<body>
		<div class="main clearfix">
			<!--头部S-->
			<div class="top clearfix">
				<span class="fl option"></span>
				<ul class="clearfix">
					<li><i class="icon1"></i><span>网站基本配置</span></li>
					<li><i class="icon2"></i><span>风格管理</span></li>
					<li><i class="icon3"></i><span>颜色配置</span></li>
				</ul>
				<!--用户名头像相关信息-->
				<div class="userWrap fr">
					<div class="clearfix">
						<div class="userImg fl">
							<img src="<?php echo $this->upload->getHead($this->userid);?>" class="m-avatar" />
						</div>
						<div class="userName fr">
							<!--用户名-->
							<span><?php echo $this->userinfo['username']; ?></span>
							<!--用户名下拉框-->
							<div class="userName-drop">
								<span>我的主页</span>
								<span>账户资金</span> 
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
			<div class="top-sec">
				
					<div class="top-sec-content fr">
						<div class="clearfix">
							<input type="button" name="saveall" id="saveall" onclick="saveThisPage()" value="保存" class="save fr" />
							<div class="bg-change fr">
								<span class="bg-change-btn">颜色切换</span>
								<div class="bg-change-color">
									<span data-color="#000">默认</span>
									<span data-color="#626262">中灰色</span>
									<span data-color="#333333">深灰色</span>
									<span data-color="#282828">极度灰</span>
								</div>
							</div>
							<input type="hidden" name="phoneScreen" id="phoneScreen" value="" />
							<select class="phone-change fr">
								<!--phone6/6S原始屏宽高375*667-->
								<option value="375" data-area="409,701">iphone6/6s</option>
								<!--iphone6p/7p原始屏宽高414*736-->
								<option value="414" data-area="448,770">iphone7Plus</option>
								<!--GalaxyS5原始屏幕宽高360*640-->
								<option value="360" data-area="394,674">Galaxy S5</option>
								<!--Nexus 5x原始屏幕宽高412*732-->
								<option value="412" data-area="446,766">Nexus 5x</option>
							</select>
							<i class="phone"></i>
					</div>					
				</div>
			</div>
			<!--头部E-->
			<!--主体S-->
			<div class="content-wrap">
				<!--左侧-->
				<div class="menu-aside">
					<div class="clearfix menu-aside-top">
						<div class="fl particular"></div>
						<div class="close-aside fl"></div>
					</div>
					<div class="menu-aside-content">
						<ul class="firnav">
							<!--第一个标签选项-->
							<li>
								<span class="span-hover">
									标签
								</span>
								<ul class="subnav clearfix" style="display: block;">
									<li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-3,form-m','modular')">
										<div class="inner">
											<i class="icon1" draggable="true"></i>
											<p>点播</p>
										</div>
									</li>
									<li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-1,form-m','modular')">
										<div class="inner">
											<i class="icon2"></i>
											<p>文章</p>
										</div>
									</li>
									<li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-5,form-m')">
										<div class="inner">
											<i class="icon3"></i>
											<p>讲师</p>
										</div>
									</li>
									<li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-5,form-m')">
										<div class="inner">
											<i class="icon4"></i>
											<p>学员</p>
										</div>
									</li>
									<li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-7,form-m')">
										<div class="inner">
											<i class="icon5"></i>
											<p>试卷</p>
										</div>
									</li>
									<li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-9,form-m')">
										<div class="inner">
											<i class="icon6"></i>
											<p>问答</p>
										</div>
									</li>
								</ul>
							</li>
							<!--第二个文章选项-->
							<li>
								<span>
									
									文章
								</span>
								<ul class="subnav clearfix">
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>课程</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>文章</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>讲师</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>学员</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>试卷</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>问答</p>
										</div>
									</li>
								</ul>
							</li>
							<!--第三个常用选项-->
							<li>
								<span>
									
									常用
								</span>
								<ul class="subnav clearfix">
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>课程</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>文章</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>讲师</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>学员</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>试卷</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>问答</p>
										</div>
									</li>
								</ul>
							</li>
							<!--第四个基础选项-->
							<li>
								<span>
									
									基础
								</span>
								<ul class="subnav clearfix">
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>课程</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>文章</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>讲师</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>学员</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>试卷</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>问答</p>
										</div>
									</li>
								</ul>
							</li>
							<!--第五个通用选项-->
							<li>
								<span>
									
									通用
								</span>
								<ul class="subnav clearfix">
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>课程</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>文章</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>讲师</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>学员</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>试卷</p>
										</div>
									</li>
									<li>
										<div class="inner">
											<i class="icon1"></i>
											<p>问答</p>
										</div>
									</li>
								</ul>
							</li>
							
						</ul>
					</div>
				</div>
				<!--中间-->
				<div class="content">
					<input type="hidden" value="" name="indexColor" />
					<div class="content-top" style="display: none;">
						<ul class="clearfix">
							<li>首页</li>
						</ul>
					</div>
					<div style="position: relative;">
						<div class="content-show">
							<div class="content-show-top clearfix">
								<p class="fl">背景扩大至虚线区域能避免作品边缘留白</p>
								<i class="fr close-p"></i>
							</div>
							<div class="content-show-content clearfix">
								<div class="content-show-contentl fl phoneScreen-change">
									<div class="list">
										<iframe id="dragmain" name="dragmain"></iframe>
									</div>
								</div>
								<div class="content-show-contentr fl">
									<span class="back" style="margin-top: 120px;">
										
									</span>
									<span class="next">
										
									</span>
									<!--背景切换-->
									<!--<span class="bg">
										
									</span>-->
									<!--PS按钮-->
									<!--<span class="PS">
										
									</span>-->
									<span class="play"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--右边-->
				<div class="add-aside">
						<div class="clearfix add-aside-top">
							<div class="fl particular"></div>
							<div class="close-aside fl"></div>
						</div>
				        <div class="add-aside-content">
				        	<div class="list listNum1">
				        		<div class="inner-img">
				        			
				        		</div>
				        		<p>第1页</p>
				        	</div>
				        	<!--添加按钮-->
				        	<div class="add-btn-wrap">
				        	</div>
				        		
				        </div>
					
				</div>
				<div class="add-aside-open">
						
				</div>
			</div>
			 <!--实时窗口-->
		   <div id="realTimeBox" class="realTimeBox d-none" style="display: none;">
				<div class="title"><span class="close" onClick="closeStyle()"><i class="drag-font drag-i-guanbi"></i></span><strong>修改样式</strong></div>
		        <iframe width="100%" height="100%" name="realTime" id="realTime"></iframe>
		   </div>
			<!--主体E-->
		</div>
		<script src="<?php echo UOOT;?>Public/drag/js/utils.js" type="text/javascript" charset="utf-8"></script> 
		<script>utils.loadJs(['jquery','popup','dragLoad'])</script>
		<script src="<?php echo UOOT;?>Public/dragphone/js/frame.js" type="text/javascript" charset="utf-8"></script> 
		<script>
			
			var frame = new utils.page({
				ready:function(){
					
					this.pageHeight();
					
				
					//左侧栏关闭
					$('.menu-aside').find('.close-aside').click(function(){
						$('.menu-aside ').animate({left:'-100%'});
						
//						if($('.add-aside').css("right")=="0px" ){
//							$('.content').animate({width:'90%',marginLeft:'0',});
//						}else{
//							$('.content').animate({width:'100%',margin:'0',});	
//						}
						
					//左侧展开	
					});
					$('.option').click(function(){
						
						$('.menu-aside ').animate({left:0});
//						setTimeout(function(){
//							$('.content').animate({width:'81%',marginLeft:'9%'});
//						},200);
						
						
					});
					//右侧栏关闭
					$('.add-aside').find('.close-aside').click(function(){
						$('.add-aside ').animate({right:'-100%'})
						$('.add-aside-open').css({display:'block'})
						
						console.log($('.menu-aside').css("left"));
//						if($('.menu-aside').css("left")=="0px"){
//						    
//							$('.content').animate({width:'91%',marginRight:'0'});
//							
//						}else{
//							
//							$('.content').animate({width:'100%',margin:'0',});
//							
//							
//						}
						
					});
					//右侧栏开启
					$('.add-aside-open').click(function(){
						
						$('.add-aside ').animate({right:'0'});
						setTimeout(function(){
							$('.add-aside-open').css({display:'none'});
//							if($('.menu-aside').css("left")=="0px"){
//								$('.content').animate({width:'81%',marginRight:'10%'});
//								
//							}else{
//								$('.content').animate({width:'91%',marginRight:'0'});
//							}
							
						},300);
						
						
					});
					//侧栏点击
					var $firli = $('.firnav').find('li')
					$firli.find('span').click(function(){
						if(this.className.indexOf('span-hover')!=-1){
							$(this).next().hide();
							$(this).removeClass('span-hover');
						}else{
							$(this).next().show();
							$(this).addClass('span-hover');
						}
					});
					//二级导航栏点击
					$('.subnav').find('li').click(function(){
						$(this).addClass('active').siblings().removeClass('active');
					});
					
					//文本栏关闭
					$('.content-show-top').find('.close-p').click(function(){
						$('.content-show-top').hide();
					});
					//小程序手机屏幕宽高
					$('.phone-change').change(function(){
						var phoneArea = $(this).find('option:selected').attr('data-area');
						$('input[name="phoneScreen"]').val(phoneArea);
						var phoneAreaSplit = phoneArea.split(',');
						$('.phoneScreen-change').css({"width":phoneAreaSplit[0]+'px',"height":phoneAreaSplit[1]+'px'});
					});
					//右侧添加按钮事件
					var num = $('listNum').length+1;
				    $('.add-btn-wrap').click(function(){
				    	//每次自增1；
				    	num++;
				    	var listcontent ='<div class="list listNum'+num+'">'+
				        		'<div class="inner-img">'+	
				        		'</div>'+
				        		'<p>第'+num+'页</p>'+
				        	'</div>'; 
				    	$('.list:last').after(listcontent);
				    })    	
				},
				pageHeight:function(){
					//底部高度撑起全屏
					var minH = $(window).height()-$('.top').outerHeight()-$('.top-sec').outerHeight();
					$('.menu-aside,.content,.add-aside').css({minHeight:minH});
					$('.add-aside-content').css({height:minH-40})
				},
				
				
				resize:function(){
					this.pageHeight();	
				}
			})
		</script>
	</body>
</html>