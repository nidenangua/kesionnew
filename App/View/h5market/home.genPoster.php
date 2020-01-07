<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/dragposter/css/editposter.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/dragposter/css/font/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<title>海报编辑</title>
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<script>
		var jsonUrl = '<?php echo UOOT ?>';
		//获取字体信息
	     $.ajax({
			 type: "get",
			 url: jsonUrl+"/Json/index.php?act=Microportal.getFont",
			 dataType: "json",
			 success: function (response) {
				 console.log(response)
			 }
		 });
	</script>
</head>
	<body>
         <div class="container">
			<img src="<?php echo UOOT.$values[0]['img']?>" class="bg-img">
			<div class="con">
				<div class="inner-con">
                    <div class="top-inner">
						<img src="<?php echo $logo1;?>">
                        <span>科汛V名师网校</span>
                    </div>
                    <div class="course-img" data-drag data-type==2><img src="<?php echo $info['defaultpic']?>"></div>
					<div class="course-title" data-drag data-type="1"><?php echo $info['title']?></div>
					<div class="course-intro" data-drag data-type="1"><?php echo $info['intr']?></div>
					<div class="course-teacher" data-drag data-type="1">主讲老师：<?php echo $info['name']?></div>
					<div class="course-price" data-drag data-type="1">价格：<span style="color:#E5412C;font-size:14px;" drag-inner><?php echo $info['price']?></span></div>
					<div class="code-wrap">
						<div class="code-tips" data-drag data-type="1">长按识别查看课程详情</div>	
						<div class="course-code" data-drag data-type="2"><img src="<?php echo $codeImg;?>"></div>
					</div>
					<div class="course-copyright">
						<img src="<?php echo $logo;?>">
						<span>课堂+提供互动支持</span>
					</div>
				</div>
			</div>
		</div>
		<div class="template-list">
			<?php foreach($values as $k =>$v){?>
			<div class="item <?php if($k==0){echo "active";}?>" >
				
				<div class="inner">
					<div class="img-wrap">
						<img src="<?php echo UOOT.$v['img']?>" alt="" />
					</div>
					<div class="mask">
						<img src="<?php echo UOOT;?>Public/wechat/images/icon/red-swoosh2.png" class="swoosh"/>
					</div>
				</div>
				
			</div>
			<?php }?>
		</div>
		<div class="bottom-options">
			<div class="btn back" onclick="back()">返回</div>
			<div class="btn sure">确认生成</div>
		</div>
	</body>
	<script src="<?php echo UOOT;?>Public/dragposter/js/dragposter.js"></script>
</html>