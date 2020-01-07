<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<title>可视化编辑</title>
	<link rel="Stylesheet" href="<?php echo UOOT;?>Public/drag/css/drag.frame.css">
	<link rel="Stylesheet" href="<?php echo UOOT;?>Public/drag/fonts/iconfont.css">
	<!--kesion popup-->
	<link rel="Stylesheet" href="<?php echo UOOT;?>Public/popup/css/kesion.popup.css">
	<!--//kesion popup end-->
	<script>
		var isCustomPage = false; //是否是自定义页面
		var tpDir   = "<?php echo $tpDir;?>";
	    var pathid  = <?php echo $pathid;?>;
	    var mypathid = <?php echo $mypathid;?>;
	    var tempid  = <?php echo $tempid;?>;
		var dragPageIndex = '/Plus/Ajaxlabel.php?tempid='+tempid+'&pathid='+pathid;
		if(location.href.indexOf('mypathid')!=-1){
			isCustomPage = true;
			dragPageIndex = '/Plus/Ajaxlabel.php?act=MyHtml&mypathid='+mypathid+'&tempid='+tempid;
		}
	</script>
</head>
<body style="overflow:hidden;">
	
    <div id="pageHead" class="frame-head">
    	<div class="logo f-l"></div>
    	<div class="select f-l" id="selectPage"><i class="drag-font drag-i-xia"></i><span id="dragPageName">网站首页</span></div>
    	<div class="select-box" id="select-box" style="display: none;">
        	<!--<div class="create-page" onclick="createPage()">添加新页面</div>-->
        	<ul>
            </ul>
        </div>
    	<!--<div class="icon f-l">
    		<span onclick="pageSlide('prev')"><i class="drag-font drag-i-left"></i></span>
    		<span onclick="pageSlide('next')"><i class="drag-font drag-i-right"></i></span>
    		<span><i class="drag-font drag-i-add"></i></span>
    		<span onclick="frameReload()"><i class="drag-font drag-i-shuaxin"></i></span>
    	</div>-->
    	
    	<div class="view-type">
    		<span class="active" onclick="setViewWidth(this,0)"><i class="drag-font drag-i-diannao"></i></span>
    		<span onclick="setViewWidth(this,1)"><i class="drag-font drag-i-pingbandiannao"></i></span>
    		<span onclick="setViewWidth(this,2)"><i class="drag-font drag-i-mobile"></i></span>
    	</div>

    	<div class="head-button f-r">
    		<a href="javascript:saveThisPage()">保存</a>
        	<a class="default" target="_blank" href="<?php if($mypathid==0){echo Preview($pathid,'path');}else{echo Preview($mypathid,'mypath');}?>">预览</a>
    	</div>
    	
    	<div class="head-nav f-r">
    		<!--<div class="item">设置</div>
    		<div class="item">模板</div>
    		<div class="item"><i class="style-color"></i>颜色</div>-->
    		<div class="item item-recovery">
    			<span>恢复</span>
    			<div class="recovery-box">
		    		<ul>
		    			<li onclick="location.reload()">恢复至打开状态</li>
		    			<li onclick="recoveryPage(1)">云端恢复</li>
		    		</ul>
		    	</div>
    		</div>
    	</div>
    	
    </div>
    
    <div class="menu-tab" id="menuTab">
    	<ul>
    		<li><i class="drag-font drag-i-add"></i>添加</li>
    		<!--<li><i class="drag-font drag-i-buju"></i>版式</li>-->
    		<li onclick="getPageElement()"><i class="drag-font drag-i-uiyuansu"></i>元素</li>
    	</div>
    </div>
    
    <div class="menu-tab-box" id="menuTabBox">
    	<div class="tab-box">
    		<div class="module-menu" id="moduleMenu">
    			<ul>
    				<!--<li class="active">基础组件</li>-->
    				<li class="active">课程模块</li>
    				<li>讲师模块</li>
    				<li>新闻模块</li>
    			
    			</ul>
    		</div>
    		<div class="module-box" id="moduleBox">
    			<!--<div class="inner-box base-assembly">
    				<div class="box-title">
    					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
    					<h2>基础组件</h2>
    					<p>快速选择样式嵌入</p>
    				</div>
    				<div class="box-content">
	    				<div class="small-title">当前页可用</div>
	    				<ul class="clearfix">
	    					<li><div class="item" onClick="Drag.Select('filter','/Public/drag/module/filter.php?type=add','筛选项配置',[800,550])"><i class="drag-font drag-i-ai13"></i><p>筛选项</p></div></li>
	    					<li><div class="item" onClick="Drag.Select('filter','/Public/drag/module/filter.php?type=add','筛选项配置',[800,550])"><i class="drag-font drag-i-ai13-copy"></i><p>排序项</p></div></li>
	    				</ul>
	    				<div class="small-title">常用</div>
	    				<ul class="clearfix">
	    					
	    					<li><div class="item"><i class="drag-font drag-i-wenzi"></i><p>文本</p></div></li>
	    					<li><div class="item"><i class="drag-font drag-i-tupian2"></i><p>图片</p></div></li>
	    					<li><div class="item"><i class="drag-font drag-i-biaoti"></i><p>标题</p></div></li>
	    					<li><div class="item"><i class="drag-font drag-i-anniu1"></i><p>按钮</p></div></li>
	    				</ul>
	    				<div class="small-title">通用</div>
	    				<ul class="clearfix">
	    					<li><div class="item" onClick="Drag.Select('header','/Public/drag/module/staticLabel.php?type=add&module=header&labelType=10','创建头部',[740,460])"><i class="drag-font drag-i-ai13"></i><p>头部标签</p></div></li>
	    					<li><div class="item" onClick="Drag.Select('footer','/Public/drag/module/staticLabel.php?type=add&module=footer&labelType=11','创建底部')"><i class="drag-font drag-i-ai13-copy"></i><p>底部标签</p></div></li>
	    					<li><div class="item" onClick="Drag.Select('footer','/Public/drag/module/staticLabel.php?type=add&module=footer&labelType=11','创建底部')"><i class="drag-font drag-i-ai13-copy"></i><p>位置导航</p></div></li>
	    					<li><div class="item" onClick="Drag.Select('footer','/Public/drag/module/carousel.php?type=add','创建轮播图',[980,600])"><i class="drag-font drag-i-lunboxiaoguo"></i><p>轮播图</p></div></li>
	    				</ul>
	    				<div class="small-title">基础</div>
	    				<ul class="clearfix">
	    					<li><div class="item" onClick="Drag.Select('html','/Public/drag/module/set-html.php?type=add','创建html内容',[740,460])"><i class="drag-font drag-i-fileshtml"></i><p>html元素</p></div></li>
	    					<li><div class="item"><i class="drag-font drag-i-fenxiang"></i><p>分享</p></div></li>
	    					<li><div class="item" onClick="Drag.Select('label','/Public/drag/module/service.php?type=add','modular')"><i class="drag-font drag-i-fuwu"></i><p>在线客服</p></div></li>
	    				</ul>
	    				
    				</div>
    			</div>-->
    			<!--//inner box-->
    			
    			<div class="inner-box">
    				<div class="box-title">
    					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
    					<h2>课程模块</h2>
    					<p>快速选择样式嵌入</p>
    				</div>
    				<div class="box-content">
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
    				<div class="box-content">
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
    				<div class="box-content">
	    				<div class="label-style-list">
	    					<ul id="newsLabel">
	    						
	    					</ul>
	    				</div>
    				</div>
    			</div>
    			
    			<!--
    			<div class="inner-box" style="display: none;">
    				<div class="box-title">
    					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
    					<h2>小组话题</h2>
    					<p>快速选择样式嵌入</p>
    				</div>
    				<div class="box-content">
	    				<div class="label-style-list">
	    					<ul id="askLabel">
	    						
	    					</ul>
	    				</div>
    				</div>
    				
    			</div>
    			-->
    			

    		</div>
    		
    	</div>
    	<!--//tab-box-->
    	
    	<!--<div class="tab-box">
    		<div class="format-box">
	    		<div class="box-title">
					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
					<h2>插入版式</h2>
					<p>快速选择版式插入</p>
				</div>
				<div id="formatSpacing">
					<div class="tit">间距</div>
					<div class="clickMove" id="formatClickMove"></div>
				</div>
				<div class="label-style-list">
					<ul>
						<li onclick="insertFormat(1)"><img src="/Public/drag/images/format1.jpg" /></li>
						<li onclick="insertFormat(2)"><img src="/Public/drag/images/format2.jpg" /></li>
						<li onclick="insertFormat(3)"><img src="/Public/drag/images/format3.jpg" /></li>
					</ul>
				</div>
			</div>
    	</div>-->
    	<!--//tab-box-->
    	
    	<div class="tab-box">
    		<div class="element-list">
    			<div class="box-title">
					<span class="btn-close" onclick="closeMenuTabBox()"><i class="drag-font drag-i-guanbi"></i></span>
					<h2>界面元素</h2>
					<p>在此管理页面元素的显示隐藏</p>
				</div>
    			<ul id="elementList"></ul>
    		</div>
    	</div>
    	<!--//tab-box-->
    	
    </div>
    
    
    	<!--
   	   <div class="f-r">
        	<div class="button" onClick="saveThisPage()">保存</div>
        	<a class="button default" target="_blank" href="<?php if($mypathid==0){echo Preview($pathid,'path');}else{echo Preview($mypathid,'mypath');}?>">预览</a>
        	<div class="button default" onClick="pagePreview()">恢复</div>
            <div class="head-preview">
            	<div class="p-box">
                    <div class="tips">请先选择要预览的栏目</div>
                    <ul id="previewItem"></ul>
                </div>
            </div>
            <div class="select" id="selectPage"><i class="drag-font drag-i-xia"></i><i class="drag-font drag-i-list2"></i><span id="dragPageName"></span></div>
            
       		
       </div>
   	   <div class="f-l" id="headSetTab">
        	<span onClick="openSetWindow(this,'/Public/drag/module/set-website.php')"><i class="drag-font drag-i-config"></i>网站基本配置</span>
        	<span onClick="openSetWindow(this,'/Public/drag/module/set-page.php')"><i class="drag-font drag-i-page"></i>当前模板配置</span>
        	<span onClick="openSetWindow(this,'/Public/drag/module/style-list.php')"><i class="drag-font drag-i-style2"></i>风格管理</span>
        	
        	<span onClick="openSetWindow(this,'/Public/drag/module/colorConfig.php')"><i class="icon-color"></i>颜色配置</span>
        </div>
       -->
    <div id="pageLoad"><span><img src="/Public/drag/images/timg.gif" />正在为您加载框架...</span></div>  
    <div id="pageCont">
        <iframe height="100%" width="100%" id="dragmain" name="dragmain" style="border:0px;"></iframe>
    </div>
    
    <div class="wraper" style="display: none;">
        <div id="pageLeft" class="pageLeft">
        	<div class="btn-close" onClick="closeLeft(this)"><i class="drag-font drag-i-left"></i></div>
        	
        	<div class="left-inner">
	            <div class="tab" id="leftTab">
	            	<i class="line"></i>
	            	<ul>
	                	<li class="active"><i class="drag-font drag-i-xuanzezujian"></i>模块</li>
	                	<li><i class="drag-font drag-i-mobantongji"></i>版式</li>
	                </ul>
	            </div>
	            <div class="tabbox" id="leftTabCont">
	            	<div class="tab-tips-bg"></div>
	            	<div class="box"> 
	                    <div class="small-tit"><i class="drag-font drag-i-xiangxia"></i>标签</div>
	                    <ul class="clearfix">
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-2','modular')"><span><i class="drag-font drag-i-kecheng1"></i><?php echo BCT(2);?></span></li><!--点播课程-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-3','modular')"><span><i class="drag-font drag-i-live"></i><?php echo BCT(3);?></span></li><!--直播课程-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-4','modular')"><span><i class="drag-font drag-i-zuheshouyishuai"></i><?php echo BCT(4);?></span></li><!--组合课程-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-5','modular')"><span><i class="drag-font drag-i-live"></i><?php echo BCT(5);?></span></li><!--直播回放-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-6','modular')" title="自定义文档列表"><span><i class="drag-font drag-i-wenzhangicon"></i><?php echo BCT(6);?></span></li><!--考试动态-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-7','modular')"><span><i class="drag-font drag-i-shijuan"></i><?php echo BCT(7);?></span></li><!--试卷列表-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-8','modular')"><span><i class="drag-font drag-i-wenti1 fz19"></i><?php echo BCT(8);?></span></li><!--小组动态-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-9','modular')"><span><i class="drag-font drag-i-wenti1 fz19"></i><?php echo BCT(9);?></span></li><!--兴趣小组-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-12','modular')"><span><i class="drag-font drag-i-huiyuan1"></i><?php echo BCT(12);?></span></li><!--学员列表-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-13','modular')"><span><i class="drag-font drag-i-mo"></i></span><?php echo BCT(13);?></li><!--品牌讲师-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-14','modular')" title="自定义文档列表"><span><i class="drag-font drag-i-wenzhangicon"></i><?php echo BCT(14);?></span></li><!--新闻列表-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-15','modular')" title="自定义文档列表"><span><i class="drag-font drag-i-wenzhangicon"></i><?php echo BCT(15);?></span></li><!--新闻评论-->
	                        <li onClick="Drag.Select('label','/home.html/default/Label/NavigationAdd?tempid-'+tempid+',labeltype-24','modular')" title="自定义文档列表"><span><i class="drag-font drag-i-wenzhangicon"></i><?php echo BCT(24);?></span></li><!--位置导航-->
						</ul>
	                    <div class="small-tit"><i class="drag-font drag-i-xiangxia"></i>普通</div>
	                    <ul class="clearfix d-none">
	                    	<li onClick="Drag.Select('html','/Public/Drag/module/set-html.php','modular')"><span><i class="drag-font drag-i-fileshtml"></i>html元素</span></li>
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-25','modular')"><span><i class="drag-font drag-i-lunbotuzujian"></i>轮播图</span></li>
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-25','modular')"><span><i class="drag-font drag-i-lunbotuzujian"></i>分享</span></li>
	                        <li onClick="Drag.Select('label','/Public/drag/module/service.php?type=add','modular')"><span><i class="drag-font drag-i-lunbotuzujian"></i>在线客服</span></li>
	                    </ul>
	                    <div class="small-tit"><i class="drag-font drag-i-xiangxia"></i>小组件</div>
	                    <ul class="clearfix d-none">
	                    	<li onClick="Drag.Select('html','/Public/Drag/module/set-html.php','modular')"><span><i class="drag-font drag-i-fileshtml"></i>按钮</span></li>
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-25','modular')"><span><i class="drag-font drag-i-lunbotuzujian"></i>图片</span></li>
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-25','modular')"><span><i class="drag-font drag-i-lunbotuzujian"></i>文字</span></li>
	                        <li onClick="Drag.Select('label','/home.html/default/Label/LabelAdd?tempid-'+tempid+',labeltype-25','modular')"><span><i class="drag-font drag-i-lunbotuzujian"></i>天气</span></li>
	                    </ul>
	                    
	               </div>
	               <div class="box" style="display: none;">
	                    <div class="small-tit"><i class="drag-font drag-i-xiangxia"></i>头部/底部</div>
	                    <ul class="clearfix">
	                        <li onClick="Drag.Select('header','/Public/drag/module/staticLabel.php?type=add&module=header&labelType=10','format')"><i class="drag-font drag-i-config"></i>插入头部</li>
	                        <li onClick="Drag.Select('footer','/Public/drag/module/staticLabel.php?type=add&module=footer&labelType=11','format')"><i class="drag-font drag-i-config"></i>插入底部</li>
	                    </ul>
	                    <div class="small-tit"><i class="drag-font drag-i-xiangxia"></i>内容</div>
                    
	                    <ul class="clearfix">
	                        <li onClick="Drag.Select('format','/Public/drag/module/format.php?formatID=1','format')"><span><i class="icon-format icon-format1"></i>版式一</span></li>
	                        <li onClick="Drag.Select('format','/Public/drag/module/format.php?formatID=2','format')"><span><i class="icon-format icon-format2"></i>版式二</span></li>
	                        <li onClick="Drag.Select('format','/Public/drag/module/format.php?formatID=3','format')"><span><i class="icon-format icon-format3"></i>版式三</span></li>
	                        <li onClick="Drag.Select('format','/Public/drag/module/format.php?formatID=4','format')"><span><i class="icon-format icon-format4"></i>版式四</span></li>
	                    </ul>
	                </div>
	            </div>
        	</div>
        </div>
      
        
   </div>
   <!--实时窗口-->
   <div id="realTimeBox" class="realTimeBox d-none">
		<div class="title"><span class="close" onClick="closeStyle()"><i class="drag-font drag-i-guanbi"></i></span><strong>修改样式</strong></div>
        <iframe width="100%" height="100%" name="realTime" id="realTime"></iframe>
   </div>

   <script src="/Public/drag/js/utils.js"></script>
   <script>utils.loadJs(['jquery','popup','judge','nicescroll','dragLoad','frame'])</script>
   <script>

   		//获取可视化界面
   		$.ajax({
   			type:"get",
   			dataType:"json",
   			url:tpDir+"preview/preview.json",
   			success:function(data){
   				//获取封面图配置信息
   				var index = data.preview.index, //网站主页
   					courseList = data.preview.course.index, //课程列表
   					courseView = data.preview.course.view, //课程内容
   					teacherList = data.preview.teacher.index, //教师列表
   					teacherView = data.preview.teacher.view, //教师内容
   					newsList = data.preview.news.index, //新闻列表
   					newsView = data.preview.news.view,//新闻内容
   					courseCart = data.preview.courseCart,//购课车
   					order = data.preview.order,//确认订单
   					login = data.preview.login,//登录
   					search = data.preview.search,//搜索页
   					about = data.preview.about,//关于我们
   					notFound = data.preview.notFound;
   				var pageList = '<li data-id="1"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-1',true)); ?>"><img src="'+tpDir+'preview/'+index+'" onerror="noimg(this)" /><span>网站首页</span></a></li>'+
   							   '<li data-id="2"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-2',true)); ?>"><img src="'+tpDir+'preview/'+courseList+'" onerror="noimg(this)" /><span>课程列表</span></a></li>'+
   							   '<li data-id="3"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-3',true)); ?>"><img src="'+tpDir+'preview/'+courseView+'" onerror="noimg(this)" /><span>课程内容</span></a></li>'+
   							   '<li data-id="4"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-4',true)); ?>"><img src="'+tpDir+'preview/'+teacherList+'" onerror="noimg(this)" /><span>教师列表</span></a></li>'+
   							   '<li data-id="5"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-5',true)); ?>"><img src="'+tpDir+'preview/'+teacherView+'" onerror="noimg(this)" /><span>教师内容</span></a></li>'+
   							   '<li data-id="6"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-6',true)); ?>"><img src="'+tpDir+'preview/'+newsList+'" onerror="noimg(this)" /><span>新闻列表</span></a></li>'+
   							   '<li data-id="7"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-7',true)); ?>"><img src="'+tpDir+'preview/'+newsView+'" onerror="noimg(this)" /><span>新闻内容</span></a></li>'+
   							   '<li data-id="8"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-8',true)); ?>"><img src="'+tpDir+'preview/'+courseCart+'" onerror="noimg(this)" /><span>购课车</span></a></li>'+
   							   '<li data-id="9"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-9',true)); ?>"><img src="'+tpDir+'preview/'+order+'" onerror="noimg(this)" /><span>确认订单</span></a></li>'+
   							   '<li data-id="10"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-10',true)); ?>"><img src="'+tpDir+'preview/'+login+'" onerror="noimg(this)" /><span>用户登录</span></a></li>'+
   							   '<li data-id="11"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-11',true)); ?>"><img src="'+tpDir+'preview/'+search+'" onerror="noimg(this)" /><span>搜索页</span></a></li>'+
   							   '<li data-id="12"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-12',true)); ?>"><img src="'+tpDir+'preview/'+notFound+'" onerror="noimg(this)" /><span>404</span></a></li>'+
   							   '<li data-id="13"><a href="<?php echo M_URL('Website','Drag',$tempid,GP('pathid-13',true)); ?>"><img src="'+tpDir+'preview/'+about+'" onerror="noimg(this)" /><span>关于我们</span></a></li>';
   				
   				$('#select-box').find('ul').append(pageList);
   				if(!isCustomPage){		  
					var dragPathName = $('#select-box').find('[data-id="'+pathid+'"] span').text();
					$('#dragPageName').html(dragPathName);
				};
   			}
   		});   		
   		
   		//获取自定义界面列表
   		$.ajax({
   			type:"get",
   			dataType:"json",
   			url:"/Plus/Ajaxlabel.php?act=GetHtml&pathid="+pathid+"&tempid="+tempid,
   			success:function(data){
   				for(var i=0;i<data.length;i++){
   					$('#select-box').find('ul').append('<li data-mypathid="'+data[i].mypathid+'"><div class="page-delete" onclick="deleteCustomPage(this)" deleteid="'+data[i].id+','+data[i].mypathid+'"><i class="drag-font drag-i-del"></i></div><a href="'+data[i].htmlurl+'"><div class="page-type">自定义</div><img src="/Public/drag/images/default.jpg"/><span>'+data[i].htmlname+'</span></a></li>');
   				};
   				
   				if(isCustomPage){
   					var dragPathName = $('#select-box').find('[data-mypathid="'+mypathid+'"] span').text();
					$('#dragPageName').html(dragPathName);
   				};

   			}
   		});
   		
   		//错误图片判断
   		function noimg(target){
   			var defaultImg = '/Public/drag/images/default.jpg';
   			target.src = defaultImg;
   		};
   		
   		//加载框架
        var frame = new utils.page({
            ready:function(){
                this.frameHeight();
               // this.axis();
                this.nicescroll('#select-box','#cacaca'); 
                this.nicescroll('#selectCont','#cacaca');
                var that = this;
              	$('#moduleBox').find('.box-content').each(function(){
              		that.nicescroll(this,'#cacaca');
              	});
              	
            },
            axis:function(){
                for(var i=0;i<30;i++){
                    var num = i*100;
                    $('#x-axis').append('<span><em>'+num+'</em></span>');
                    
                };
            },
            nicescroll:function(obj,color){
                $(obj).niceScroll({  
                    cursorcolor:color,  
                    cursoropacitymax:1,  
                    touchbehavior:false,  
                    cursorwidth:"6px",
                    cursorborder:"0", 
                    cursorborderradius:"10px"  
                });
            },
            resize:function(){
            	this.frameHeight();
            },
			//框架整体高度设置
   			frameHeight:function(){
		    	
				$('.pageLeft-set,#pageCont,#select-box').height($(window).height()-$('#pageHead').outerHeight());
				$realTime.height($(window).height()-$realTime.prev('.title').outerHeight());
				
				$('#moduleBox').find('.box-content').height($('#menuTabBox').height()-120);
				
		    }
    
        });
        

    </script>
</body>
</html>