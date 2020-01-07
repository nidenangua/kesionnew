<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>上课签到</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
<body>
	<div class="signinstaus-wrap">
	<?php if($staus == 0){ ?>
		<form action="<?php echo M_URL('WeChat','doaddsigninstaus'); ?>" method="post" accept-charset="utf-8" id='myform'>
	<?php }else{ ?>
		<form action="<?php echo M_URL('WeChat','doeditsigninstaus'); ?>" method="post" accept-charset="utf-8" id='myform'>
			<input type="hidden" name="signid" value="" id="signid" />
	<?php }?>
	<section class="signinstaus-classlst">
		<ul class="clearfix">
			<li>
				<div class="signinstaus-lstbox">
					<div class="signinstaus-title">
						<span class="blue">大</span><font id="info_title"></font>
						<p class="subonline">上课人数：<font id="info_stunum"></font>人</p>
					</div>
				</div>
			</li> 
			<li>
				<div class="signinstaus-lstbox">
					<div class="signinstaus-title clearfix">
						<div class="left">教师名称</div>
						<div class="right" id="info_teacher"></div>
						<input type="hidden" name="checkin" value="<?php echo $name; ?>" />
						<input type="hidden" name="classid" value="<?php echo $classinfo['classid']; ?>" /> 
					</div>
				</div>
			</li> 
			<li>
				<div class="signinstaus-lstbox">
					<div class="signinstaus-title clearfix">
						<div class="left">绑定课时</div>
						<select class="right" id="info_classtime" name="scheduleid"></select>
						<i class="iconfont icon-jiantou-copy2"></i>
					</div>
				</div>
			</li> 
			<li>
				<div class="signinstaus-lstbox">
					<div class="signinstaus-title clearfix">
						<div class="left">出勤状态(批量)</div>
						<div class="right">
							<div class="classkind">
								<div>
									<select class="blue" onchange="signinstaus.setAll(this)" style="margin-right: -4px;">
										<option value="1">上课</option>
										<option value="2">请假</option>
										<option value="3">旷课</option>
										<option value="4">补课</option>
									</select>
								</div>
								<i class="iconfont icon-jiantou-copy2"></i>
							</div>
						</div>
					</div>
				</div>
			</li> 
			
		</ul>
	</section>
	
	<section class="signinstaus-stulist">
		<ul class="clearfix" id="signinstauss">
			
		</ul>
	</section>
	
	<br />
	
	<footer class="footer">
		<div class="clearfix">
			<div class="zui-col-6">
				<div class="footer-foticon" onclick="signinstaus.discuss(this)" staus='false'>
					<label style="display: block;height: 100%;width: 100%;" for="diss"><input type="checkbox" id="diss"  value="0" /> 评价</label>
				</div>
			</div>
			<div class="zui-col-6" onclick="do_reg()">
				<div class="footer-foticon fb-orag">
					<?php if($staus == 0){ ?>
						保存
					<?php }else{ ?>
						修改
					<?php }?>
				</div>
			</div>
		</div>
	</footer>
	
	</form>
	</div>
	<?php if($staus == 0){ ?>
	<script>
		var ajaxurl = '/Json/index.php?act=WeChat.getsingstu';
		var stype = 0;
		var scheduleid = 0;
	</script>
	<?php }else{ ?>
	<script>
		var ajaxurl = '/Json/index.php?act=WeChat.signLook';
		var stype = 1;
		var scheduleid = <?php echo  KS_G('get.scheduleid'); ?>;
	</script>
	<?php }?>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
		function do_reg(){
			$_id('myform').submit();
		}
		var classid = <?php echo $classinfo['classid']; ?>;
		var signinstaus = new Object({
				pageUrl:location.href.replace(/#.+/,''),
				slideFooterTab:function(target,index){
					var name = target.id
					location.href = this.pageUrl+'#'+name
					target.setClass('active','add').getSiblings().setClass('active','remove')
					$_class('page-wrap').child().map(function(obj,i){
						(i === index) ? obj.style.display = 'block' : obj.style.display = 'none'
					})
				},
				discuss:function(eme){
					var bool = eme.getAttribute('staus');
					if(bool=='false'){
						$_class('dicuss').map(function(em){
							em.slideDown();
						})
						eme.setAttribute('staus','true');
					}else{
						$_class('dicuss').map(function(em){
							em.slideUp();
						})
						eme.setAttribute('staus','false');
					}
				},
				setColor:function(target){
					var set = target.value;
					var classcolor = ['blue','orange','red','purple'];
					target.setAttribute('class',classcolor[set-1]);
					
				},
				setAll:function(target){
					var set = target.value;
					console.log(set)
					var classcolor = ['blue','orange','red','purple'];
					target.setAttribute('class',classcolor[set-1]);
					$_id('signinstauss').findTag('select').map(function(em,index){
						em.value=set;
						em.setAttribute('class',classcolor[set-1]);
					})
					
				},
				list:function(){
					var act = ['大','小','一'];
					var classcolor = ['blue','orange','red'];
					var init={
						tip:"<?php echo $classinfo['classType']; ?>",
						title:'<?php echo $classinfo['title']; ?>',
						stunum:"<?php echo $classinfo['studentnum']; ?>",
						classtime:'<?php echo $str; ?>',
						teacher:'<?php echo $name; ?>',
					}
					$_id('info_tip').innerHTML = act[init.tip];
					$_id('info_tip').setClass(classcolor[init.tip],'add');
					
					$_id('info_title').innerHTML = init.title;
					$_id('info_stunum').innerHTML = init.stunum;
					$_id('info_classtime').innerHTML = init.classtime;
					$_id('info_teacher').innerHTML = init.teacher;
					$_id('info_pushteacher').innerHTML = init.pushteacher;
					
					var ajax={
						url:ajaxurl,
						data:{
							classid:classid,
							id:scheduleid,
						},
					}
					var signinstauss = $_id('signinstauss');
					if(stype ==0){
						$_post(ajax.url,ajax.data,res=>{
							if(res.getsingstu.students){
								if(res.getsingstu.students.length>0){
									getAll = res.getsingstu.students;
									getAll.map(function(val){
										var alldata = signinstaus.creatCont(val);
									signinstauss.addChilds(alldata);
									}) 
								}else{
									signinstauss.addChilds('<div class="novalue"></div>');
								}
							}else{
								alert('该班级没有设置学生，请先设置后在进行点名');
								history.go(-1);
							}
						},'json');
					}else{
						$_post(ajax.url,ajax.data,res=>{
							
						if(res.signLook.student){
							if(res.signLook.student.length>0){
								getAll = res.signLook.student;
								$_id('signid').value = res.signLook.signid;
								getAll.map(function(val){
									var alldata = signinstaus.creatCont(val);
								signinstauss.addChilds(alldata);
								}) 
							}else{
								signinstauss.addChilds('<div class="novalue"></div>');
							}
						}else{
							alert('该班级没有设置学生，请先设置后在进行点名');
							history.go(-1);
						}
						},'json');
					}
					
					
				},
				creatCont:function(data){
					var staus = ['','上课','请假','旷课','补课'];
					var classcolor = ['blue','orange','red','purple'];
					var pushdata = 	'<li><div class="stulist-cont"><p class="stulist-name">学生姓名：'+data.name+'</p>';
					pushdata 	+=	'<p class="stulist-moible">联系电话：'+data.mobile+'</p><div class="classkind"><div>';
					if(!data.status){
						data.status = 1; 
					}
					if(!data.remake){
						data.remake = '';  
					}
					pushdata 	+=	'<select class="'+classcolor[data.status-1]+'" name="staus[]" onchange="signinstaus.setColor(this)">';
					for(var i=1;i<5;i++){
					if(data.status == i){
						pushdata 	+=	'<option value="'+i+'" selected>'+staus[i]+'</option>';
					}else{
						pushdata 	+=	'<option value="'+i+'">'+staus[i]+'</option>';
					}}
					pushdata 	+=	'</select><input type="hidden" name="userid[]" value="'+data.userid+'"></div><i class="iconfont icon-jiantou-copy2"></i></div>';
					
					pushdata 	+=	'<div class="dicuss"><hr/><div class="form-limit"><textarea name="remake[]" rows="" cols="" placeholder="请输入评价内容~" onkeyup="signinstaus.limit(this)">'+data.remake+'</textarea>';
					
					pushdata 	+=	'<em><font class="limit">0</font>/300</em></div></div></div></li>';
					return pushdata;
				},
				limit:function($target){
					var limits = 300;
					/*****************************************/
					var getValueLength = $target.value.length;
					if(getValueLength<=limits){
						$target.parentNode.findClass('limit')[0].innerHTML = getValueLength+1;
				  	}else{
				  		var values = $target.value.substring(0,limits);
				  		$target.value = values;
				  	}

					/*****************************************/
				}
			}) 
		
			signinstaus.list();
//			var markName = location.href.match(/#\w+/);
//			if(markName){
//				markName = markName[0].split('#')[1];
//				$_id(markName).click()
//			}else{
//				$_id('toDay').click()
//			};
	</script>
</body>
</html>