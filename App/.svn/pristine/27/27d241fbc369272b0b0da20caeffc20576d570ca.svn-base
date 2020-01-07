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
<style>
	.Created-ing-span span{padding: 0 10px;display: inline-block;min-width: 240px;}
</style>
</head>
<body class="ks-wrap">

<div class="bRadius10 bg-white ks-wbox">
	<h3 class="ks-head-title2">
     		<div class="ks-head-nav" >
			<!--标题-->
			<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP(''));?>">办理中心</a><em>/</em> 报名/续费
			<!--标题-->
			</div>
	</h3>
	
<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','doaddEnrol','',GP(''));?>" method="post">

	<div class="configTab" style="display: block;">
		<ul style="">
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title" style="padding-bottom: 10px;">
						<span>学员信息</span>
						<div class="Tool-btnGroup ks-head-el" >
							
						<a class="ks-heade-button ks-head-primary " onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addstudent','',GP('appid-34'));?>','850px','600px',{title:'选择学员报班',type:'top'});">
							<i class="iconfont icon-jiahao"></i>选择已有学生 </a>
						</div>
					</div>
				</div>
				<div class="form-box " style="min-height: inherit;">
					<div class="Created-ing clearfix">
						<ul>
							<?php foreach($students as $k=>$v){?>
							<li class="Created-ing-span">
								<span>学生:<?php echo empty($v['name'])?'账号':'姓名';?>:<?php echo empty($v['name'])?$v['username']:$v['name'];?> </span>
							     <span>联系电话:<?php echo Field($v['mobile']);?></span>
							     <span> 紧急联系人:<?php echo Field($v['emergencyContact']);?> </span>
							    <span>紧急联系人电话:<?php echo Field($v['emergencyContactTel']);?> </span>
							</li>
							<?php }?>
							<?php if(empty($students)){?>	
							<li>
								<div class="bg-white bRadius10" style="height:128px;"><div class="emptycss" style="height: 180px;">没有发现任何内容</div></div>              </li>
							<?php }?>	
						</ul>
					</div>
				</div>
			</li>
			<li>
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title"><span>课程/班级</span></div>
				</div>
				<div class="form-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h1 style="width: 200px;">所有分类</h1>
						    </li>
							<li  class="clearfix">
								<div style="width: 50%;float: left">
									<h4>选择班级/课程</h4>
								    <input type="hidden" name="choicetype" value="<?php echo $choicetype;?>" />
									<div class="Created-Content">
										<select class="form-textbox" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addEnrol'); ?>','choicetype','<?php echo URL_MODEL;?>')">
											<option value="0" <?php if($choicetype==0){echo 'selected="selected"';}?>>请选择</option>
											<option value="1" <?php if($choicetype==1){echo 'selected="selected"';}?>>一对一</option>
											<option value="3" <?php if($choicetype==3){echo 'selected="selected"';}?>>小班课</option>
											<option value="4" <?php if($choicetype==4){echo 'selected="selected"';}?>>大班课</option>
											<option value="2" <?php if($choicetype==2){echo 'selected="selected"';}?>>在线课程</option>
										</select>			
									</div>
								</div>
								<div style="width: 50%;float: left;position: relative;">
									<div style="padding-left: 130px;">
										<h4>报名班级/课程</h4>
										<div class="Created-Content clearfix">
										<select class="form-textbox" onchange="getPrice(this)" name="classinfo">	
											<!--<select class="form-textbox" onchange="getPrice(this);" name="courseid">-->
												<?php if(empty($allclass)){ ?><option value="0.00" price="0">无</option><?php } ?>
												<?php foreach($allclass as $k=>$v){?>
												<option <?php if($classid==$v['courseid']){echo 'selected="selected"';}?> value="<?php echo $v['courseid'];?>" price="<?php echo $v['price'];?>"><?php echo $v['title'];?></option>
												<?php }?>
											</select>				
										</div>
									</div>
								</div>
							</li>
							<li>
								<h4>课程分类:</h4>
								<div class="Created-Content">
									<select class="form-textbox" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addEnrol'); ?>','categoryid','<?php echo URL_MODEL;?>')">
									    <?php if(isset($category)){ ?>
											<option value="0">请选择</option>
										    <?php foreach($category as $k=>$v){ ?>
											<option value="<?php echo $v['categoryid']; ?>" <?php if($v['categoryid']==$categoryid){ ?>selected = "selected"<?php } ?>>
											<?php echo KS_INDENT($v['depth']).$v['categoryname'];?>
									        </option>
									    <?php }}else{ ?>
											<option value="0">请选择</option>
										<?php } ?>
									</select>					
								</div>
						    </li>
							<li>
								<h4>授课类型</h4>
								<div class="Created-Content clearfix">
									<select class="form-textbox" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addEnrol');?>','classtype','<?php echo URL_MODEL;?>')">
									<option value="0" <?php if($classtype==0){echo 'selected="selected"';}?>>请选择</option>	
									<?php if($choicetype==1||$choicetype==3||$choicetype==4){?><!--班级-->
										    <option value="1" <?php if($classtype==1){echo 'selected="selected"';}?>>线上线下组合</option>
											<option value="2" <?php if($classtype==2){echo 'selected="selected"';}?>>线上班级</option>
											<option value="3" <?php if($classtype==3){echo 'selected="selected"';}?>>面授班级</option>
									<?php }elseif($choicetype==2){?><!--课程-->
										    <option value="1" <?php if($classtype==1){echo 'selected="selected"';}?>>点播</option>
											<option value="2" <?php if($classtype==2){echo 'selected="selected"';}?>>直播</option>
									<?php }?>		
									</select>					
								</div>
							</li>
							
						</ul>
					</div>
					
			</li>
			<li>
				<div class="Created-largetTitle">
					<span>3</span>
					<div class="Created-title">  
						<span>订单缴费信息</span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>订单总额</h4>
								<div class="Created-Content" id="pay_amount">￥0.00</div>
							</li>
							<li>
								<h4>实收金额:</h4>
								<div class="Created-Content">
									<input class="form-textbox" name="order_amount" id="order_amount" value="0.00" type="text"/>				
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
								<div class="Created-Content">
									<textarea class="form-textarea w300" name="comments" style="min-height: 80px;"></textarea>			
								</div>
							</li>
						</ul>
					</div>
			</li>
			</ul>
		</div>
		<div class="ks-bom form-footer clearfix">
		<span style="display: inline-block;">
			<input type="submit"  class="ks-bt bt-pue w120" value="确认" name="save">
			<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP(''));?>" class="ks-bt w120 bt-white ml10" style="box-sizing: border-box;" >取消</a>
		</span>
	</div>
	</div>	
</div>
	

</div>


</form>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['backstage','nicescroll'],function(){
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
		var classValue  = $("select[name='classinfo']")[0].value,
			classOption = $("select[name='classinfo']").find('option'),
			price;
		for(var i=0;i<classOption.length;i++){
			price = classOption[i].value === classValue && classOption[i].getAttribute('price')
		};
		
		$("#pay_amount").html('￥'+price); 
		$("#order_amount").val(price); 
	
	})
	function getPrice(obj){
		
		var price = $(obj).find("option[value="+$(obj).val()+"]").attr("price");
		var stnum = '<?php echo count($students) ?>';
		alert(stnum); 
		$("#pay_amount").html('￥'+(price*stnum)); 
		$("#order_amount").val(price*stnum); 
	}	
</script>
</body>
</html>

