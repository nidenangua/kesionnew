<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>用户个人资料</title>
<meta name="Keywords" content="用户个人资料"/>
<meta name="Description" content="用户个人资料" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
<div class="">
<div class="bRadius10 bg-white ks-wbox">
<form  id="myform" action="<?php echo M_URL($this->AppName.'/Index','studentOpenCourseDoSave',$this->courseid,GP(''));?>" method="post" enctype="multipart/form-data">
<div >  
	<div class="configTab" style="display: block;padding-bottom: 60px;">
		<ul style="">
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title"><span>学员信息</span></div>
				</div>
				<div class="form-box " style="min-height: auto;">
					<div class="Created-ing clearfix">
						<ul>
							<?php foreach($students as $k=>$v){?>
							<input type="hidden" name="aid[]" value="<?php echo $v['userid'];?>"/>
							<li>
								<h4>学生<?php echo empty($v['name'])?'账号':'姓名';?>:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo empty($v['name'])?$v['username']:$v['name'];?></span>
									</div>								
								</div>
							</li>
							<li>
								<h4>联系电话:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo Field($v['mobile']);?></span>
									</div>								
								</div>
							</li>
							<!--<li>
								<h4>紧急联系人:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo Field($v['emergencyContact']);?></span>
									</div>								
								</div>
							</li>
							<li>
								<h4>紧急联系人电话:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo Field($v['emergencyContactTel']);?></span>
									</div>								
								</div>
							</li>-->
							<?php }?>
						</ul>
					</div>
				</div>
			</li>
			<li>
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title">  
						<span>订单缴费信息</span>
					</div>
				</div>
				<div class="form-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
									<h4>课程名称:</h4>
									<div class="Created-Content">
										<?php echo $this->course['title'];?>		
									</div>
							</li>
							<li>
								<h4>课程金额</h4>
								<div class="Created-Content">￥<?php echo $this->course['price'];?></div>
							</li>
							<li>
								<h4>实收金额:</h4>
								<div class="Created-Content">
									<input class="form-textbox" name="order_amount" id="order_amount" value="<?php echo $this->course['price'];?>" type="text"/>				
								   说明：这里指的是线下收款的金额。
                                </div>
								<script>
								$("#order_amount").keyup(function () {
								    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
								    var txt = '';
								    if (reg != null) {txt = reg[0];}
								    $(this).val(txt);
								}).change(function () {
								    $(this).keyup();
								});
								function submitform(){
									var recharge_money = $('#order_amount').val();
									if(recharge_money<=0){Alert('充值金额不能为零');return false;}
									$('#myform').submit();
								}	
								</script>
							</li>
							<li>
								<h4>备注:</h4>
								<div class="Created-Content form-limit" limit="45" style="width: 315px;">
									<textarea class="form-textarea w300" name="comments" style="min-height: 80px;"></textarea>			
								</div>
							</li>
						</ul>
					</div>
			</li>
			</ul>
		</div>
	</div>	
</div>
</div>
	<div class="clearfix ks-popup-footer" >
	<div class="form-footer clearfix">
		<span style="text-align: center;">
			<a href="<?php echo M_URL($this->AppName.'/Index','addCourseStudent',$this->courseid,GP(''));?>" class="ks-bt bt-defalut ml10" style="display: inline-block;float: none;margin-right:10px;">上一步</a>
			<input type="submit"  class="ks-bt bt-pue" value="确认" name="save" style="display: inline-block;float: none;">
		</span>
	</div>
</div>
</form>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
			$('.top-menu li').click(function(){
				$(this).addClass('curr').siblings().removeClass('curr');
				$('.configTab:eq('+$(this).index()+')').show().siblings().hide();	
			});
			$('#StartBtn').on('click', function() {
					var email = $("input[name='email']").val();
					if(!email){Alert('邮箱不能为空');return false;}
					var isEmail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/; 
					isok =isEmail.test(email)
					if(!isok){alert('邮箱号格式不正确');return false;}
					$("#myform").submit();
			});
		})

</script>
</body>
</html>
