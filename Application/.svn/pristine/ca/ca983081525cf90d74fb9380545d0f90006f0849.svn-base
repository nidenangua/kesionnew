<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>学员管理</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body class="stuinfo-wrap">
	<div class="page-wrap">
		<page class="stuinfo-page">
			<div class="stuinfo-header blue-box_shadow">
				<ul class="stuinfo-form" id="inform">
					<li>
						<div class="stuinfo-headimg">
							<img src="<?php if(!empty($userinfo)){echo Img($this->upload->getHead($userid)).'?'.rand(0,9999);}else{ echo nopic(6);} ?>" alt="" />
							<div style="font-weight: bold;font-size: 16px;">
								<?php echo $userinfo['name'] ?> <?php if($userinfo['Sex'] == 1){ ?> <i class="ion-boy"></i> <?php }else{ ?><i class="ion-girl"></i><?php } ?>
							</div>
						</div>
					</li>
					<li>
						
					</li>
					<li>
						学生手机号：<?php echo $userinfo['mobile'] ?>
					</li>
					<li>
						紧急联系人：<?php echo $userinfo['emergencyContactTel'] ?>
					</li>
					<li>
						账户是否锁定：
						<?php if($userinfo['status'] == 1) {?>
							<div class="btnSwitch" staus="false">
						        <div class="sonSwitch"></div>
						        <input type="hidden" name="SwitchVal" id="SwitchVal" value="false">
						    </div>
					    <?php }else{ ?>
					    	<div class="btnSwitch" staus="true">
					        	<div class="sonSwitch"></div>
					        	<input type="hidden" name="SwitchVal" id="SwitchVal" value="true">
					    	</div>
					    <?php } ?>
					</li>
					<li>
						注册时间：<?php echo date('Y-m-d',$userinfo['regdate']); ?>
					</li>
					<li>
						性别：<?php if($userinfo['Sex'] == 1){ ?> 男 <?php }elseif($userinfo['Sex'] == 2){ ?>女<?php } ?>
					</li>
					<li>
						出生年月：<?php echo date('Y-m-d',$userinfo['birthday']); ?>
					</li>
					<li>
						电子邮箱：<?php echo $userinfo['email'];?>
					</li>
					<li>
						所在地区：<?php echo $userinfo['taddress'];  ?>
					</li>
					<li>
						账户余额：<?php echo $userinfo['money'];?>
					</li>
					<li>
						学员账户：<?php echo $userinfo['username'];?>
					</li>
					<li>
						登录次数:<?php echo $userinfo['logintimes'];?>
					</li>
					<li>
						最近登录时间：<?php echo date('Y-m-d H:i:s',$userinfo['lastlogintime'])	;?>
					</li>
				</ul>
				<div class="more">
					<div class="more1" onclick="stuinfo.inform()">
						<button class="o-btnBlue">更多信息</button>
					</div>
					<div class="more2">
						<button class="o-btnOrag" onclick="stuinfo.delectuser('<?php echo $userid; ?>')">删除</button>
					</div>
				</div>
			</div>
			<div class="stuinfo-tip">报班信息</div>
			<div class="stuinfo-classlist">
				<ul class="stuinfo-ul" id="stuinfo-ul"></ul>
			</div>
		</page>
	</div>
	
	<footer class="footer">
		<div class="clearfix">
			<div class="zui-col-6" onclick="window.location.href='<?php echo M_URL('WeChat','stuinfoedit') ?>?userid=<?php echo $userid; ?>'">
				<div class="footer-foticon">
					编辑学员信息
				</div>
			</div>
			<div class="zui-col-6" onclick="window.location.href='<?php echo M_URL('WeChat','stuinfoorder') ?>?userid=<?php echo $userid; ?>'">
				<div class="footer-foticon fb-blue">
					报班
				</div>
			</div>
			
		</div>
	</footer>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js?a9d817b319b7d9fee23f"></script>
	<script type="text/javascript">
	
	var stuinfo = new Object({
		inform:function(){
			$_id('inform').style.height = '470px';
			$_class('more1')[0].style.display = 'none'
			$_class('more2')[0].style.display = 'block'
		},
		list:function(){
			var ajax={
				url:'/Json/index.php?act=WeChat.details',
				data:{
					userid:"<?php echo $userid; ?>",
				},
			}
			$_post(ajax.url,ajax.data,res=>{
				if(res.details.orders){
					getAll = res.details.orders;
					var signlst = $_id('stuinfo-ul');
					getAll.map(function(val){
						var alldata = stuinfo.creatCont(val);
						signlst.addChilds(alldata);
					}) 
				}
			},'json');
		},
		creatCont:function(data){ 
			var gotype = ['','组合','网授','面授'];
			var act = ['大','小','一'];
			var classcolor = ['blue','orange','red'];
			
			var pushdata = '<li class="blue-box_shadow"><div class="classlist-cont">';
			pushdata 	+= '<h4>'+data.title+'</h4><div class="classlist-top clearfix">';
			pushdata 	+= '<p>学费：￥'+data.sumprice+'</p><p>剩余课时: <font class="orange">'+data.sparehour+'</font> 课时</p>';
			pushdata 	+= '</div></div><div class="classlist-bot">';
			pushdata 	+= '<button class="o-btnBlue" onclick="stuinfo.lookmore('+data.courseid+','+data.memberid+')">查看更多</button></div></li>';
			
			return pushdata;
		},
		editstatus:function(status,userid){
			var ajax={
				url:'/Json/index.php?act=WeChat.editstatus',
				data:{
					status:status,
					userid:userid
				},
			}
			$_post(ajax.url,ajax.data,res=>{
				console.log('切换完成');
			},'json');
		},
		lookmore:function(id,userid){
			window.location.href="<?php echo M_URL('WeChat','stuinfoclass'); ?>?classid="+id+'&userid='+userid;
		},
		delectuser:function(userid){
			var ajax={
				url:'/Json/index.php?act=WeChat.deluser',
				data:{
					userid:userid
				},
			}
			reConfirm({
				title:'确认删除吗',
				success:function(){
					$_post(ajax.url,ajax.data,res=>{
						toast2({
							content:'删除完成',
							callback:function(){
								history.go(-1);
							}
						})
						
					},'json');
				}
			})
		}
	
	
	})
	

	$_class('btnSwitch').map(function(swbtn){
		var staus = swbtn.getAttribute("staus");
		if(staus=='true'){
			swbtn.style.background = '#37A7ED';
			swbtn.findClass('sonSwitch')[0].style.left='';
			swbtn.findClass('sonSwitch')[0].style.left='1.45rem';
		}else{
			swbtn.style.background = '';
			swbtn.findClass('sonSwitch')[0].style.right='';
			swbtn.findClass('sonSwitch')[0].style.left='0rem';
		}
	
		if(swbtn.findTag('input')[0]){
			swbtn.findTag('input')[0].value = staus;
		}
		swbtn.onclick=function(callback){
			var staus = this.getAttribute("staus");
			if(staus=='true'){
				stuinfo.editstatus(1,'<?php echo $userid; ?>');
				this.setAttribute("staus",'false');
				staus = 'false';
				this.style.background = '#FFF';
				this.findClass('sonSwitch')[0].style.left='0rem';
			}else{
				stuinfo.editstatus(0,'<?php echo $userid; ?>');
				this.setAttribute("staus",'true');
				staus = 'true';
				this.style.background = '#37A7ED';
				this.findClass('sonSwitch')[0].style.left='1.45rem';
			}
			
			if(this.findTag('input')[0]){
				this.findTag('input')[0].value = staus;
			}
			
		}
		
		
	})
		
	stuinfo.list();
	


	</script>
</body>
</html>