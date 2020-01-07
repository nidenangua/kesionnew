<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>招生秀</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body>
	
	<section class="admissions-page-wrap">
		<page class="admissions-page zui-none">
			<div class="zui-tab zui-line-bottom">
				<ul class="clearfix">
					<li class="zui-col-five active" onclick="admissionsShow.tools.filter(this)">全部</li>
					<li class="zui-col-five" onclick="admissionsShow.tools.filter(this)">节日类</li>
					<li class="zui-col-five" onclick="admissionsShow.tools.filter(this)">抽奖类</li>
					<li class="zui-col-five" onclick="admissionsShow.tools.filter(this)">助力类</li>
					<li class="zui-col-five" onclick="admissionsShow.tools.filter(this)">排行类</li>
					
				</ul>
			</div>
			<div class="admissions-tools">
				<ul id="admissionsTools">
					
				</ul>
				<div class="zui-load-tips">我是有底线的~</div>
			</div>
		</page>
		<page class="admissions-page zui-none">
			<div class="zui-tab zui-line-bottom">
				<ul class="clearfix" id="admissionsPrimaryClass"></ul>
			</div>
			<div class="admissions-primary">
				<ul id="admissionsPrimary"></ul>
			</div>
		</page>
		<page class="admissions-page zui-none">
			<div class="zui-tab zui-line-bottom">
				<ul class="clearfix">
					<li class="zui-col-five active" onclick="admissionsShow.myActivity.filter(this)">全部</li>
					<li class="zui-col-five" onclick="admissionsShow.myActivity.filter(this)">节日类</li>
					<li class="zui-col-five" onclick="admissionsShow.myActivity.filter(this)">抽奖类</li>
					<li class="zui-col-five" onclick="admissionsShow.myActivity.filter(this)">助力类</li>
					<li class="zui-col-five" onclick="admissionsShow.myActivity.filter(this)">排行类</li>
				</ul>
			</div>
			<div class="my-admissions-tools">
				<ul id="myAdmissionsTools">
					
					
				</ul>
				<div class="zui-load-tips">我是有底线的~</div>
			</div>
		</page>
	</section>

	<footer class="footer">
		<ul>
			<li class="zui-col-4" onclick="admissionsShow.slideFooterTab(this,0)" id="tools">
				<i class="icon icon-tools"></i>
				<p>招生营销工具</p>
			</li>
			<li class="zui-col-4" onclick="admissionsShow.slideFooterTab(this,1)" id="program">
				<i class="icon icon-program"></i>
				<p>营销方案</p>
			</li>
			<li class="zui-col-4" onclick="admissionsShow.slideFooterTab(this,2)" id="activity">
				<i class="icon icon-activity"></i>
				<p>我的活动</p>
			</li>
		</ul>
	</footer>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/main.js?version=1.0"></script>
	<script>
		var markName = location.href.match(/#\w+/);
		if(markName){
			markName = markName[0].split('#')[1];
			$_id(markName).click()
		}else{
			$_id('tools').click()
		};
		//获取招生营销工具
		admissionsShow.tools.getTools();
		//获取营销方案
		admissionsShow.program.getProgram();
		//获取我的活动
		admissionsShow.myActivity.getMyActivity()
	</script>
</body>
</html>