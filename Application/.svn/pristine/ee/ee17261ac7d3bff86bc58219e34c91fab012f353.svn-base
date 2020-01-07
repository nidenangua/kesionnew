<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body> 
	<div class="intent-t">
		<div class="item active" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intention');?>'">
			我的咨询
		</div>
		<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','task');?>'">
			任务
		</div>
		<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intentcount');?>'">
			咨询统计
		</div>
		<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intentpound');?>'">
			咨询池
		</div>
		<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','channel');?>'">
			渠道
		</div>
	</div>
	<div class="height40">
		
	</div>
	
	<div class="intent-tab">
		<div class="searchbox">
			 <input type="search" name="" id="myconsult" value="" placeholder="请输入搜索内容" onkeyup="intention.myIntentSearch(this)"/>
			 <div class="screen">
			 	<img src="<?php echo UOOT ?>Public/wechat/images/screen.png"/>
			 	<span onclick = "intention.asidePopup()">筛选</span>
			 </div>
		</div>
		<div class="inner" id="consult">
			
		</div>
		<img src="<?php echo UOOT ?>Public/wechat/images/loading.gif"  class="loading"/>
	</div>
	
	
	<div class="add" onclick="intention.popup(this)">
		<img src="<?php echo UOOT ?>Public/wechat/images/add.png"/>
	</div> 
	<div class="mask">
		
	</div> 

	<div class="add-intent" id="showtoast">
		<div class="add-intent-t">
			<div class="title">
				快速新增咨询
			</div>
			<div class="name">
				学生姓名
			</div>
			<input type="" name="" id="studentname" value="" />
			<div class="name">
				联系电话
			</div>
			<input type="" name="" id="studenttel" value="" />
		</div>
		<div class="add-intent-b">
			<div class="item" onclick="intention.cancel()">取消</div>
			<div class="item active" onclick="intention.confirm(this)">确认</div>
		</div>
	</div>
	<div class="aside" id="aside">
		<div class="aside-title">
			筛选
		</div>
		<div class="aside-content">
			<div class="side-head" >
				筛选类别
			</div>
			<div class="aside-body" id="category">
				<div class="aside-item active" data-value="0">不限</div>
				<div class="aside-item" data-value="1">小班</div>
				<div class="aside-item" data-value="2">一对一</div>
				<div class="aside-item" data-value="3">大班</div>
				<div class="aside-item" data-value="4">课程</div>
			</div>
			<div class="side-head" >
				咨询校区
			</div>
			<div class="aside-body" id="campus">
			</div>
			<div class="side-head" >
				意向度
			</div>
			<div class="aside-body" id="intent">
				<div class="aside-item active" data-value="5">不限</div>
				<div class="aside-item" data-value="1">高</div>
				<div class="aside-item" data-value="2">中</div>
				<div class="aside-item" data-value="3">低</div>
				<div class="aside-item" data-value="0">无</div>
			</div>
			<div class="side-head" >
				渠道
			</div>
			<div class="aside-body" id="channel">
			</div>
			<div class="side-head" >
				跟进状态
			</div>
			<div class="aside-body" id="status">
				<div class="aside-item active" data-value="6">不限</div>
				<div class="aside-item" data-value="3">已成单</div>
				<div class="aside-item" data-value="1">跟进中</div>
				<div class="aside-item" data-value="0">未跟进</div>
				<div class="aside-item" data-value="5">已失效</div>
			</div>
			<div class="side-head" >
				回访结果
			</div>
			<div class="aside-body" id="result">
				<div class="aside-item active" data-value="6">不限</div>
				<div class="aside-item" data-value="2">无意向</div>
				<div class="aside-item" data-value="0">考虑中</div>
				<div class="aside-item" data-value="1">已成单</div>
				<div class="aside-item" data-value="3">想试听</div>
				<div class="aside-item" data-value="4">已加入学员档案</div>
				<div class="aside-item" data-value="5">无效</div>
			</div>
		</div>
		
		<div class="aside-btn">
			<div class="item" onclick="intention.asideBack()">
				返回
			</div>
			<div class="item active" onclick="intention.asideConfirm()">
				确定
			</div>
		</div>
	</div>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/intention.js?version=1.0"></script> 
	<script type="text/javascript">
		intention.getConsult()//获取我的咨询的数据接口	
		intention.getAside()//获取侧栏的校区还有渠道
	</script>
</body>
</html>