<!doctype html>
<html>
	<head>
	  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/dragxcx/css/kesion_bse.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/dragxcx/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/popup/css/kesion.popup.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/drag/css/drag.frame.css"/>
    <link rel="Stylesheet" href="//ks.zuojy.com/Public/drag/fonts/iconfont.css">
	<title>首页</title>
		
	<script type="text/javascript">
		var tpDir = '/Skin/2/XCX/'
	</script>
	</head>
	<body>
		<div id="readyRender" style="position: absolute;top:0;left: 0;width: 100%;height: 100%;z-index: 9999;background:#fff;">
			<img src="/Public/drag/images/page-loading.gif" style="display: block;margin: auto;position: absolute;top: 0;left: 0;bottom: 0;right: 0;"/>
		</div>
		<form action="<?php {echo M_URL($this->AppName.'/Index','Svaeformat','',GP(""));} ?>" method="post">
		<div class="main clearfix">
			<!--头部S-->
			<div class="clearfix frame-head">
				<div class="head-button f-r">
		    		<a href="javascript:;" onclick="savePage()">保存</a>
		        	<!--<a class="default" target="_blank" href="//ks.zuojy.com/">预览</a>-->
		    	</div>
				<span class="fl option"></span>
				<ul class="clearfix" style="display:none;">
					<li><i class="icon1"></i><span>网站111 基本配置</span></li>
					<li><i class="icon2"></i><span>风格管理</span></li>
					<li><i class="icon3"></i><span>颜色配置</span></li>
				</ul>
				<!--用户名头像相关信息-->
				<div class="userWrap fr" style="display:none;">
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
			
			<div class="top-sec" style="display:none;">
				
					<div class="top-sec-content fr">
						<div class="clearfix">
							<input type="button" name="saveall" onclick="savePage()" value="保存" class="save fr"  />
							<div class="bg-change fr">
								<span class="bg-change-btn">颜色切换</span>
								<div class="bg-change-color">
									<span data-color="#000">默认</span>
									<!--<span data-color="#626262">中灰色</span>-->
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
			
			<!--左侧导航栏-->
			<div class="menu-tab" id="menuTab">
		    	<ul>
		    		<li><i class="drag-font drag-i-add"></i>添加</li>
		    	</ul>
    		</div>
    		
    		<div class="menu-tab-box" id="menuTabBox">
    	<div class="tab-box">
    		<div class="module-menu" id="moduleMenu">
    			<ul>
    				<li class="active">基础组件</li>
    				<li>课程模块</li>
    				<li>讲师模块</li>
    				<li>新闻模块</li>
    				<!--<li>考试模块</li>
    				<li>互动模块</li>
    				<li>会员模块</li>-->
    			</ul>
    		</div>
    		<div class="module-box" id="moduleBox">
    			<div class="inner-box base-assembly">
    				<div class="box-title">
    					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
    					<h2>基础组件</h2>
    					<p>快速选择样式嵌入</p>
    				</div>
    				<div class="box-content scroll">
	    				<div class="small-title">通用</div>
	    				<ul class="clearfix">
	    					<li><div class="item" onClick="Drag.Select('header','/Public/drag/module/staticLabel.php?type=add&module=header&labelType=10','创建头部',[740,460])"><i class="drag-font drag-i-ai13"></i><p>头部状态栏</p></div></li>
	    					<li><div class="item" onClick="Drag.Select('footer','/Public/drag/module/staticLabel.php?type=add&module=footer&labelType=11','创建底部')"><i class="drag-font drag-i-ai13-copy"></i><p>底部导航栏</p></div></li>
	    				</ul>
	    				<div class="small-title">基础</div>
	    				<ul class="clearfix">
	    					<li><div class="item"><i class="drag-font drag-i-lunboxiaoguo"></i><p>轮播图</p></div></li>
	    				</ul>
	    				<div class="small-title">常用</div>
	    				<ul class="clearfix">
	    					<!--<li><div class="item" onClick="Drag.Select('label','/Public/drag/module/selectIconFont.php','modular')"><i class="drag-font drag-i-wenzi"></i><p>图标</p></div></li>-->
	    					<li><div class="item"><i class="drag-font drag-i-wenzi"></i><p>文本</p></div></li>
	    					<li><div class="item"><i class="drag-font drag-i-tupian2"></i><p>图片</p></div></li>
	    					<li><div class="item"><i class="drag-font drag-i-biaoti"></i><p>标题</p></div></li>
	    					<li><div class="item"><i class="drag-font drag-i-anniu1"></i><p>按钮</p></div></li>
	    				</ul>
    				</div>
    			</div>
    			<!--//inner box-->
    			
    			<div class="inner-box" style="display: none;">
    				<div class="box-title">
    					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
    					<h2>课程模块</h2>
    					<p>快速选择样式嵌入</p>
    				</div>
    				<div class="box-content scroll" style="overflow: auto;height: 634px;">
	    				<div class="label-style-list">
	    					<ul id="courseLabel">
	    						
	    					</ul>
	    				</div>
    				</div>
    				
    			</div>
    			
    			<div class="inner-box" style="display: none;">
    				<div class="box-title">
    					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
    					<h2>讲师模块</h2>
    					<p>快速选择样式嵌入</p>
    				</div>
    				<div class="box-content scroll" style="overflow: auto;">
	    				<div class="label-style-list">
	    					<ul id="teacherLabel">
	    						
	    					</ul>
	    				</div>
    				</div>
    				
    			</div>
    			<div class="inner-box" style="display: none;">
    				<div class="box-title">
    					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
    					<h2>新闻模块</h2>
    					<p>快速选择样式嵌入</p>
    				</div>
    				<div class="box-content scroll" style="overflow: auto;">
	    				<div class="label-style-list">
	    					<ul id="newsLabel">
	    						
	    					</ul>
	    				</div>
    				</div>
    			</div>
    			

    		</div>
    		
    	</div>

    	
    	
    </div>
			<!--头部E-->
			<!--主体S-->
			<div class="content-wrap" style="margin-top: 45px;">
				<!--左侧-->
				
				<div class="menu-aside" style="display:none;">
					
					<div class="clearfix menu-aside-top">
						<div class="fl particular"></div>
						<div class="close-aside fl"></div>
					</div>
					<div class="menu-aside-content">
						<ul class="firnav">
							<!--第一个标签选项-->
							<li>
								<span>
									
									标签
								</span>
								<ul class="subnav clearfix">
									<li onclick="Drag.Add('课程','<?php echo UOOT;?>Public/dragxcx/module/course.php')">
										<div class="inner">
											<i class="icon1" draggable="true"></i>
											<p>课程</p>
										</div>
									</li>
									<li onclick="Drag.Add('文章','<?php echo UOOT;?>Public/dragxcx/module/article.php')">
										<div class="inner">
											<i class="icon2"></i>
											<p>文章</p>
										</div>
									</li>
									<li onclick="Drag.Add('讲师','<?php echo UOOT;?>Public/dragxcx/module/teacher.php')">
										<div class="inner">
											<i class="icon3"></i>
											<p>讲师</p>
										</div>
									</li>
									
								</ul>
							</li>
							<!--第二个文章选项-->
							<li>
								<span>
									
									组件
								</span>
								<ul class="subnav clearfix">
									<li onclick="newBottomNav()">
										<div class="icon-zujian-nav">
											<em class="icon-bottom"></em>
											<p>底部导航</p>
										</div>
									</li>
									<li>
										<div class="icon-zujian-nav">
											<em class="icon-title"></em>
											<p>标题</p>
										</div>
									</li>
									<li onclick="Drag.Add('轮播图','<?php echo UOOT;?>Public/dragxcx/module/swiper.php')">
										<div class="icon-zujian-nav">
											<em class="icon-swiper"></em>
											<p>轮播图</p>
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
								<i class="fl close-p"></i>
							</div>
							<div class="content-show-content clearfix">
								<div class="content-show-contentl fl phoneScreen-change">
									<div class="list">
										<!--小程序窗口-->
										<iframe id="main" name="dragmain"></iframe>
									</div>
								</div>
								<div class="content-show-contentr fl">
									<span class="back" style="margin-top: 120px;">
										
									</span>
									<span class="next">
										
									</span>
									<span class="play"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--右边-->
				
				<div class="add-aside">
			        <div class="add-aside-content" id="selected-box">
			        	<!--<div class="list">
			        		<img src="" class="inner-img"/>
			        		
			        	</div>-->
			        	<!--添加按钮-->
			        	<div class="create-newpage" onclick="createNewPage()" >
			        		点击添加新页面
			        	</div>
			        		
			        </div>
					
				</div>
				<div class="add-aside-open">
						
				</div>
				<div class="edit-nav-bottom">
					
				</div>
			</div>
			</form>
			<!--主体E-->
		</div>
		
		<script src="<?php echo UOOT;?>Public/dragxcx/js/utils.js" type="text/javascript" charset="utf-8"></script>
		<script>utils.loadJs(['jquery','popup','frame','detailFrame','format'])</script>
		<script>
			//获取可视化界面

			$.ajax({
				type:"get",
				url:tpDir+'Skin01previews/preview.json',
				dataType:"json",
				success : function(e) {  
						console.log(e)
						
						//请求图片
			           	var index = e.preview.index,//小程序主页
			           		classif = e.preview.classif,//分类列表
			           	    courselist = e.preview.course.index,//课程列表
			           	    courseinfo = e.preview.course.info,//课程详情
			           	    techerlist = e.preview.teacher.index,//教师列表
			           	    teacherinfo = e.preview.teacher.info,//教师详情
			           	    newslist = e.preview.news.index,//新闻列表
			           	    newsinfo = e.preview.news.info,//新闻详情
			           	    userindex = e.preview.user,index//个人中心主页
			           	//请求内容
			           	var pagelist = '<div data-id="xcxid1" class="list"><img src="'+tpDir+'Skin01previews/'+index+'" onerror="nofind()" class="inner-img"><p>小程序首页<p></div>'+
			           					'<div data-id="xcxid2" class="list"><img src="'+tpDir+'Skin01previews/'+classif+'" onerror="nofind()" class="inner-img"><p>分类<p></div>';
			           	
			           	$('#selected-box').append(pagelist);
			           	
			           	    
			           	
			         },
			    error:function(e){
			    	console.log(e)
			    }
			});
			//请求课程版式
			getFormat('courseList','#courseLabel','course');
			//请求教师版式 
			getFormat('teacherList','#teacherLabel','teacher');
			//请求新闻版式
			getFormat('articleList','#newsLabel','news')
			//右侧添加按钮事件	
			function createNewPage(){
				
				
		    	var listcontent ='<div class="list">'+
		        		'<div class="inner-img">'+	
		        		'</div>'+
		        		'<p></p>'+
		        	'</div>'; 
		        	
		    	$('.list:last').after(listcontent);
			}; 
			
	
					//没有图片的情况，统一调用这个方
			function nofind(){
				let imgEvent = event.srcElement;
				imgEvent.src="../../../Public/dragxcx/images/noImg.png";
				imgEvent.onerror = null;
			}
				
			var frame = new utils.page({
				ready:function(){
					
					this.pageHeight();
					
					
					//弹窗版式选择
					$('.form-group').find('.inner-img').click(function(){
						$(this).addClass('active').siblings().removeClass('active');
						//获取第几个版式
						$(this).find('input').val();
						
					});
//					//左侧栏关闭
//					$('.menu-aside').find('.close-aside').click(function(){
//						$('.menu-aside ').animate({left:'-100%'});
//						
//
//						
//					//左侧展开	
//					});
//					$('.option').click(function(){
//						
//						$('.menu-aside ').animate({left:0});
//
//						
//						
//					});
					//右侧栏关闭
					$('.add-aside').find('.close-aside').click(function(){
						$('.add-aside ').animate({right:'-100%'})
						$('.add-aside-open').css({display:'block'})
						
				

						
					});
					//右侧栏开启
					$('.add-aside-open').click(function(){
						
						$('.add-aside ').animate({right:'0'});
						setTimeout(function(){
							$('.add-aside-open').css({display:'none'});
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
					  	
				},
					
				pageHeight:function(){
					console.log($(window).height())
					//底部高度撑起全屏
					var minH = $(window).height()-$('.frame-head').outerHeight();
					$('.menu-aside,.content,.add-aside,.edit-nav-bottom,.content-wrap').css({minHeight:minH});
					$('.add-aside-content').css({height:minH-40});
					
				},
				
				
				resize:function(){
					this.pageHeight();
					
				}
			})
		</script>
	</body>
</html>
