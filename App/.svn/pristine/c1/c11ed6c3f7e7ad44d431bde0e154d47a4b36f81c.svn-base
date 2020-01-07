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

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','doteacheraddclass',$id,GP(''));?>" method="post" enctype="multipart/form-data">

	<div class="bRadius10 bg-white ks-wbox">
		<div class="ks-head-nav">
			<!--标题-->
			<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP(''));?>">教师管理</a><span> <em>/</em> 报班
			<!--标题-->
		</div>
		
	<div class="configTab" style="display: block;">
		<ul style="">
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title"><span>学员信息</span></div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>教师<?php echo empty($userinfo2['name'])?'账号':'姓名';?>:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo empty($userinfo2['name'])?$userinfo['username']:$userinfo2['name'];?></span>
									</div>								
								</div>
							</li>
							<li>
								<h4>联系电话:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo Field($userinfo['mobile']);?></span>
									</div>								
								</div>
							</li>
							<li>
								<h4>职称:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo Field($userinfo2['teacherzc']);?></span>
									</div>								
								</div>
							</li>
							<li>
								<h4>教师简介:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo Field($userinfo2['shortIntro']);?></span>
									</div>								
								</div>
							</li>
						</ul>
					</div>
				</div>
			</li>
			<li>
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title"><span>课程/班级</span></div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>选择班级/课程</h4>
							    <input type="hidden" name="choicetype" value="<?php echo $choicetype;?>" />
								<div class="Created-Content">
									<select class="form-textbox" onchange="getval(this,'<?php echo GP('p-'.$now_page.',usertype-'.$usertype.',appid-'.$this->appid,true); ?>','<?php echo M_URL($this->AppName.'/Index','enrolment',$id); ?>','choicetype','<?php echo URL_MODEL;?>')">
										<option value="0" <?php if($choicetype==0){echo 'selected="selected"';}?>>请选择</option>
										<option value="1" <?php if($choicetype==1){echo 'selected="selected"';}?>>一对一</option>
										<option value="3" <?php if($choicetype==3){echo 'selected="selected"';}?>>小班课</option>
										<option value="4" <?php if($choicetype==4){echo 'selected="selected"';}?>>大班课</option>
										<!--<option value="2" <?php if($choicetype==2){echo 'selected="selected"';}?>>在线课程</option>-->
									</select>			
								</div>
							</li>
							<li>
								<h4>选择分类:</h4>
								<div class="Created-Content">
			<select class="form-textbox" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','enrolment',$id); ?>','categoryid','<?php echo URL_MODEL;?>')">
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
									<select class="form-textbox" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','enrolment',$id);?>','classtype','<?php echo URL_MODEL;?>')">
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
							<li>
								<h4>报名班级/课程</h4>
								<div class="Created-Content clearfix">
									<select class="form-textbox" onchange="getPrice(this);" name="courseid">
										<option>请选择</option>
										<?php foreach($allclass as $k=>$v){?>
										<option value="<?php echo $v['courseid'];?>" price="<?php echo $v['price'];?>"><?php echo $v['title'];?></option>
										<?php }?>
									</select>	
								</div>
							</li>
							<li>
								<h4>是否设置为班主任</h4>
								<div class="Created-Content clearfix">
									<span class="fl" style="line-height: 30px;"><input type="radio" name="isspacker" id="isspacker" value="0" checked="checked" />否	</span>
									<span class="fl" style="line-height: 30px;" ><input type="radio" name="isspacker" id="isspacker" value="1" />是	</span>
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
			<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP(''));?>" class="ks-bt w120 bt-white ml10" style="box-sizing: border-box">取消</a>
		</span>
	</div>
	</div>	
	
</div>


</form>

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
		
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


//var username = $("input[name='username']").val();
//parent.$("#homeusername").html(username);
//var srcurl = $("#edithead").attr('src');
//parent.$("#homehead").attr('src',srcurl);
</script>
</body>
</html>