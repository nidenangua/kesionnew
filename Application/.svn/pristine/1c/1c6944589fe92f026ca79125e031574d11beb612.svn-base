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
	.Tool-nav li{ display: none;}
	.Tool-nav .curr{ display: block;}
</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title" style="border: none;">
			<!--标题-->
			基本信息
			<!--标题-->
		</h3>
		<div class="ks-head-tab clearfix">
 			<ul class="Tool-nav">
  				<li class="fl curr"><a>基本信息</a></li>
      			<?php echo $this->Field->getTab($tableid,'table','Huseradd');?>
  			</ul>
 		</div>
	    </div>
	    <!--header-->
						     
	
	     
		<!--table-->
		
<div class="bRadius10 bg-white">
<form target="hidframe" id="myform" action="<?php echo M_URL('User','doeditUsers',$status); ?>" method="post" enctype="multipart/form-data">
	<div class="configTab" style="display: block;">
		<div class="form-box">
		<ul>
				
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">  
						<span>账号信息</span>
					</div>
				</div>
				
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>用户名:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<?php if($this->userinfo['username']===$this->userinfo['mobile']){ ?>
								         <input type="text" id="editusername" name="username" value="<?php echo $this->userinfo['username']; ?>" style='width: 200px;'><a>认真修改,登录凭证</a>  
								         <?php }else{ ?>
								             <input type="hidden" name="username" value="<?php echo $this->userinfo['username']; ?>">
								             <span><?php echo $this->userinfo['username']; ?></span>
								             <a href="">已验证,登录凭证</a>
								         <?php } ?>	
									</div>								
								</div>
							</li>
							
							
							<li>
								<h4>会员类型:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php if($this->userinfo['usertype']==1){ echo '教师';}else { echo '机构';} ?></span>
									</div>								
								</div>
							</li>
							
							<li>
								<h4>手机号:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php if(isset($this->userinfo['mobile'])){ echo $this->userinfo['mobile'];} ?></span>
										<input type="hidden" style='width: 200px;' name="mobile" value="<?php if(isset($this->userinfo['mobile'])){ echo $this->userinfo['mobile'];} ?>" class="form-textbox" <?php if(isset($this->userinfo['mobile'])&&!empty($this->userinfo['mobile'])){ echo 'readonly';} ?>>
										<?php if($this->userinfo['mobilebing']=='1'){  ?>
								            <!--<a href="">已验证</a>-->
								        <?php }else{?>
<!--//								            <a href="<?php echo M_URL('Kjlogin','index'); ?>">未验证,验证前需改用户名</a>-->
								        <?php } ?>
									</div>								
								</div>
							</li>
							
							<li>
								<h4>个人邮箱:<i class="form-star" style="left: 50px;top: 3px;">*</i></h4>
								<div class="Created-Content">
									<div class="word-all">
										<input type="text" name="email" value="<?php if(isset($this->userinfo['email']))echo $this->userinfo['email'];  ?>" style='width: 200px;'> <!--<?php if($this->userinfo['emailbing']=='1'){  ?>readonly<?php } ?>-->
										 <?php if($this->userinfo['emailbing']=='1'){  ?>
								         	<!--<a  href="<?php echo M_URL('Kjlogin','index'); ?>">重新绑定邮箱</a>-->         
										 <?php }else{ if($status == '-1'){?>
								         	<!--<a >邮箱必填</a>-->
								         <?php }else{?>
								         	<!--<a  href="<?php echo M_URL('Kjlogin','index'); ?>">邮箱未绑定,点击去填写</a>-->
								         <?php }} ?>	
									</div>								
								</div>
							</li>
							
							<li>
								<h4>注册时间:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<span><?php echo date('Y-m-d H:i:s',$this->userinfo['regdate']); ?></span>
									</div>								
								</div>
							</li>
							<li>
								<div style="height: 60px;"></div>
							</li>
							
						</ul>
						
					</div>
				
					<div class="form-upload">
		          		<div class="js_uploadBox">
		          			<div class="js_showBox"><img class="js_logoBox block defaultpic" onerror="this.src='<?php echo nopic();?>'" src="<?php echo $this->upload->getHead($this->userid,10,$this->userinfo['usertype']).'?'.time();?>" ></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
			                    	<span class="js_uploadText" >上传图片</span></a>
			                    <p>限制：2MB,支持jpg|png|gif  建议上传120*40尺寸的png格式图片</p> 
			                    <input type="hidden" name="defaultpic">
			               </div>
					    </div>
		          	</div>
				</div>

			</li>
			<li>
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title">  
						<span><?php if($this->userinfo['usertype']==1){ echo '教师';}else { echo '机构';} ?>信息</span>
						<span></span>
					</div>
				</div>
				
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4><?php if($this->userinfo['usertype'] == '1'){echo "教师名称";} else{echo "机构名称";} ?></h4>
								<div class="Created-Content">
									<?php  $realModel = M('common_realname');
		 $real = $realModel->getRow(' where wxid =  '.$this->wxid.' and status=1 limit 1'); if($real){?>
		 	                        <?php echo !empty($this->userinfo['realname'])?$this->userinfo['realname']:$this->userinfo['nickname']; ?>
		 	                        <span style="color: red;">已实名认证,不允许修改</span>
									<input type="hidden" name="name"  class="long-text" value="<?php echo !empty($this->userinfo['realname'])?$this->userinfo['realname']:$this->userinfo['nickname']; ?>" />
									<?php }else{?>
									<input type="text" name="name"  class="long-text" value="<?php echo !empty($this->userinfo['nickname'])?$this->userinfo['nickname']:$this->userinfo['nickname']; ?>" />
									<?php }?>						
								</div>
							</li>
							<li>
								<h4><?php if($this->userinfo['usertype'] == '1'){echo "教师英文名";} else{echo "机构英文名";} ?></h4>
								<div class="Created-Content">
									<input type="text"  name="ename" class="long-text" value="<?php echo $this->userinfo['ename']; ?>"/>						
								</div>
							</li>
							<?php if($this->userinfo['usertype'] == '1'){?>
							<li>
								<h4>教师简介:</h4>
								<div class="Created-Content">
<!--									<input type="text"  name="shortIntro" class="long-text" value="--><?php //echo $this->userinfo['shortIntro']; ?><!--"/>-->
									<textarea rows="3" cols="20" name="shortIntro"><?php echo $this->userinfo['shortIntro']; ?></textarea>
								</div>
							</li>
							<li>
								<h4>性别:</h4>
								<div class="Created-Content clearfix">
									
									<label for="man"><input value="1" id='man' type="radio" name="Sex" <?php if(isset($this->userinfo['Sex'])&&$this->userinfo['Sex']==1){ echo 'checked';} ?>/>男</label>						
									<label for="woman"><input value="2" id='woman' type="radio" name="Sex" <?php if(isset($this->userinfo['Sex'])&&$this->userinfo['Sex']==2){ echo 'checked';} ?>/>女</label>						
								</div>
							</li>
							<?php } ?>
							<li>
								<h4>所属分类:</h4>
								<div class="Created-Content clearfix">
									<?php echo $Linkage->Linkage(2);?>						
								</div>
							</li>
							<li>
								<h4>所属地区：</h4>
								<div class="Created-Content Created-area clearfix">
									<?php echo $link->Linkage(2);?>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</li>
			</ul>
			</div>
		</div>
	<?php echo $this->Field->getF($tableid,'table','Huseradd',$this->userinfo);?>
		</div>	
		<div id="ksBoxFooter">
			<div class="form-footer clearfix" style="text-align: center;">
				<input type="button" id="StartBtn" class="ks-bt bt-pue fn" value="保存修改" name="save">
			</div>
		</div>
	</div>
<!--/table-->        
	</form>
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs()
			$('.Tool-nav li').click(function(){
				$(this).addClass('curr').siblings().removeClass('curr');
				$('.configTab:eq('+$(this).index()+')').show().siblings().hide();	
			});
			$('.configTab').each(function(){
				this.innerText && $('.Tool-nav').find('li').eq($(this).index()).show()
			});
			$('#StartBtn').on('click', function() {
				var email = $("input[name='email']").val();
				if(!email){Alert('邮箱不能为空');return false;}
				var isEmail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/; 
				isok =isEmail.test(email)
				if(!isok){alert('邮箱号格式不正确');return false;}
				$("#myform").submit();
			});
			var data = {
				imagesurl:$(".js_logoBox").attr('src')
			}
			top.dataCallBack(data);
		});
	</script>
</body>
</html>