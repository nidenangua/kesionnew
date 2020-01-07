<!DOCTYPE HTML>
<html>
	<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title><?php echo $this->websiteInfo['wititle'];?></title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/pupil.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT ?>Public/wechat/css/microportal/rely.css"/>
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/userindex.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 
    <style type="text/css">
    	html,body{background: #eceff361; }
		.codectr{display: none;}
		.codewrap{padding-top: 1rem;text-align: center; width: 10rem; height: 10rem; background: #FFF; top: 50%; left: 50%; margin-top: -5rem; margin-left: -5rem; position: absolute; z-index:100; }
  		.codewrap>img{ width: 8rem; height: 8rem; }
  		#shezhi{position: absolute;top: .5rem;right: .5rem;width:1.5rem;height: 1.5rem;}
  		#code{position: absolute;top: .5rem;right: 2.5rem;width: 1.5rem;height: 1.5rem;}
  		.student-menu li img {position: absolute; left:0.2rem;top: 0.5rem;width: 1.2rem;}
  		.user-top .code {width: 1rem;height: 1rem;}
  		.user-con {text-align: center;height: 1.5rem;line-height: 1.5rem;padding-top: 1.5rem;}
  		.user-con a {display: inline-block;text-decoration: underline;font-size: 0.7rem;color: #666;}
  		.msgcount{
  			background: red;
		    color: #fff;
		    float: right;
		    display: block;
		    min-width: 20px;
		    min-height: 20px;
		    line-height: 20px;
		    border-radius: 50%;
		    padding: 0;
		    text-align: center;
		    font-size: 10px;
		    margin-right: 35px;
		    margin-top: 16px;
  		}
    </style>
	</head>
	<body>
		<div class="p-top" style="position: relative;">
			<div class="user-img">
				<img src="<?php if($this->upload->getHead($this->memberid,4,0)){echo $this->upload->getHead($this->memberid,4,0);}else{echo UOOT.'Public/uploads/common/touxiang01.jpg';} ?>" alt="" />
			</div>
			<div class="user-info">
				<div class="user-name" ><?php echo Field($this->userinfo['name']); ?></div>
				<div class="user-infos">电话：<?php if($this->userinfo['mobile']){echo $this->userinfo['mobile'];}else{echo '暂无';} ?></div>
			</div>
			<img onclick="window.location.href='<?php echo M_URL('h5market','userindex'); ?>'" id="shezhi" src="<?php echo UOOT ?>Public/wechat/images/setting.png"/>
			<img id="code" src="<?php echo UOOT ?>Public/wechat/images/qrcode2.png"/>
		</div>
		<div style="overflow: hidden;" class="student-menu">
		<div class="item-wrap">
			<ul>
				<li style="box-shadow: none;" onclick="openFn('<?php echo M_URL('h5market','myCouse'); ?>')">
					<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_class.png">
					我的课程</li>
				<!--<li onclick="openFn('<?php echo M_URL('h5market','myWork'); ?>')"><img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_homework.png"> 我的作业</li>-->
				<li onclick="openFn('<?php echo M_URL('h5market','myPaper'); ?>')"><img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_homework.png"> 我的试卷</li>
				<li onclick="openFn('<?php echo M_URL('h5market','myCollect'); ?>')"><img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_homework.png"> 我的题集</li>
				<!--<li onclick="openFn('<?php echo M_URL('h5market','myTable'); ?>')">
					<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_timetable.png">
					我的课表</li>-->
			</ul>
			<ul>
				<!--<li style="box-shadow: none;" onclick="openFn('<?php echo M_URL('h5market','wechatpay'); ?>')">我的账户
				<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_account.png">
				</li>-->
				<li onclick="openFn('<?php echo M_URL('h5market','myList'); ?>')">
					<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_order.png">
					我的订单
				
				</li>
				<li onclick="openFn('<?php echo M_URL('h5market','MyVoucherlist'); ?>')">
					<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_discount.png">
					我的优惠券
				
				</li>
				<li onclick="openFn('<?php echo M_URL('h5market','myCard'); ?>')">
					<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_discount.png">
					我的会员卡
				
				</li>
				<li onclick="openFn('<?php echo M_URL('h5market','giftrecord'); ?>')">
						<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_gift.png">
					赠送记录</li>
					<?php if(ismoduleopen($this->wxid,105,0,1)){?>
				       <li onclick="openFn('<?php echo M_URL('h5market','myDistribute'); ?>')">
						<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_gift.png">
					我的分销</li>
					<?php }?>
			</ul>
			<ul>
				<li style="box-shadow: none;" onclick="openFn('<?php echo M_URL('h5market','myMsg'); ?>')">
					<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/me_student_icon_message.png">
					消息<?php if($countAll){?><a class="msgcount"><?php echo $countAll;?></a><?php }?></li>
			</ul>
		</div>
		</div> 
		<!--<div class="border-color-g exit" onclick="userindex.loginout()">
			退出登录
		</div>
		-->
		
		<div class="user-con">《<a href="<?php echo M_URL('h5market','usercontract'); ?>">科汛V名师平台用户须知</a>》</div>
		<div class="codectr" id="codectr">
			<div class="mask" id="mask" style="display: block;"></div>
			<div class="codewrap">
				<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://ks.kesion.com/h5market/binding?id='.$this->memberid.'&wxid='.$this->wxid,'L',4,'qrcode');?>">
				<p>家长可扫描二维码绑定学生账号</p>
			</div>
		</div>
		
			<div class="height60"></div>
			<?php include $this->dir.'footer.php';?>
			

	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js"></script>
	<script type="text/javascript">
		$_id('code').onclick = function(){
			$_id('codectr').style.display = 'block';
		}
		$_id('mask').onclick = function(){
			$_id('codectr').style.display = 'none';
		}
		function openFn(__url){
			__url ? location.href = __url : toast2({content:'该模块正在开发中'})
		};
		
	</script>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	</body>
</html>