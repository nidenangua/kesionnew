<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit">
    	<title>签到详情</title> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
<style type="text/css">
	.signininfo-wrap .signininfo-alert{position:fixed;top: 0px;left: 0px;right: 0px;bottom: 0px;}
	.signininfo-wrap .signininfo-classlst{background: #FFF;}
	.signininfo-wrap .signininfo-classlst li:first-child{border-bottom: solid 1px #EEEEEE;margin:0rem;padding:0rem 0.5rem;}
	.signininfo-wrap .signininfo-classlst li{border-bottom: solid 1px #EEEEEE;margin:0rem 0.5rem;}
	
	.signininfo-wrap .signininfo-lstbox{position: relative;padding:0.5rem 0rem;}
	.signininfo-wrap .signininfo-title{font-size: 0.8rem;}
	.signininfo-wrap .signininfo-title .subonline{float: right; font-size: 0.8rem;color: #888;}
	.signininfo-wrap .signininfo-title>span{display: block; width: 0.9rem; height: 0.9rem; text-align: center; line-height: 0.9rem; margin-top: 0.2rem; font-size: 0.6rem; float: left;margin-right:0.2rem;}
	.signininfo-wrap .signininfo-title>span.blue{background:#37A7ED;color: #FFF;}
	.signininfo-wrap .signininfo-title>span.orange{background:#F28550;color: #FFF;}
	.signininfo-wrap .signininfo-title>span.red{background:#E64A3B;color: #FFF;}
	.signininfo-wrap .signininfo-title .left{float: left;font-size: .7rem;color: #888888;}
	.signininfo-wrap .signininfo-title .right{float: right;font-size: .7rem}
	
	.signininfo-wrap .signininfo-stulist li{margin:.3rem;}
	.signininfo-wrap .signininfo-stulist .stulist-cont{border-radius: .2rem;background: #FFF;padding: .5rem;position: relative;}
	.signininfo-wrap .signininfo-stulist .stulist-moible{color: #888;}
	.signininfo-wrap .signininfo-stulist .stulist-name{color:#353535;}
	.signininfo-wrap .signininfo-stulist .stulist-article{position: relative;padding-left:2rem;color: #888888;}
	.signininfo-wrap .stulist-article>p{position: absolute;left: 0rem;top: 0rem;color: #353535;}
	.signininfo-wrap .signininfo-stulist .stulist-cont2{border-radius: .2rem;background: #FFF;padding: .5rem;position: relative;}
	.signininfo-wrap .stulist-cont2>p>span{top: 0.5rem;line-height:inherit;}
	.signininfo-wrap .signininfo-stulist span{position: absolute;line-height:3rem;right: .5rem;top: 0rem;}
	.signininfo-wrap .signininfo-stulist span>i{float: right;margin-left:.3rem;}
	
	.signininfo-wrap .signininfo-foticon{text-align: center;background:#37A7ED;color: #FFF;height: 100%;line-height: 3rem;font-size:.8rem;border-right:0.01rem solid #FFF;}
	.signininfo-wrap .signininfo-foticon:first-child i{color:#37A7ED;}
	.signininfo-wrap .signininfo-foticon:first-child p{color:#37A7ED;}
	.signininfo-wrap .signininfo-foticon>div{height: 1.8rem; line-height: 2rem;}
	.signininfo-wrap .signininfo-foticon>div>i{font-size:1.5rem;}
	.signininfo-wrap .footer {height: 3rem;margin-right:-0.1rem;}

</style>
<body>
	<div class="signininfo-wrap">
	<section class="signininfo-classlst">
		<ul class="clearfix">
			<li>
				<div class="signininfo-lstbox">
					<div class="signininfo-title clearfix">
						<span id="info_tip"></span><font id="info_title"></font>
						<p  class="subonline">上课人数：<font id="info_stunum"></font>人</p>
					</div>
				</div>
			</li> 
			<li>
				<div class="signininfo-lstbox">
					<div class="signininfo-title clearfix">
						<div class="left">绑定课时</div>
						<select class="right" id="info_classtime" name="scheduleid"></select>
					</div>
				</div>
			</li> 
			<li>
				<div class="signininfo-lstbox">
					<div class="signininfo-title clearfix">
						<div class="left">上课老师</div>
						<div class="right"id="info_teacher"></div>
					</div>
				</div>
			</li> 
			
			
		</ul>
	</section>

	<section class="signininfo-stulist">
		<ul class="clearfix" id="signininfos">
		
		</ul>
		
		
	</section>
	<br />
	<div class="footer">
		<div class="clearfix">
			<div class="zui-col-6">
				<div class="signininfo-foticon">
					编辑学生评价
				</div>
	
			</div>
			<div class="zui-col-6">
				<div class="signininfo-foticon">
					修改出勤状态
				</div>
				
			</div>
		</div>
	</div>
	
	
	</div> 
	
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
		var signininfo = new Object({
				pageUrl:location.href.replace(/#.+/,''),
				slideFooterTab:function(target,index){
					var name = target.id
					location.href = this.pageUrl+'#'+name
					target.setClass('active','add').getSiblings().setClass('active','remove')
					$_class('page-wrap').child().map(function(obj,i){
						(i === index) ? obj.style.display = 'block' : obj.style.display = 'none'
					})
				},
				list:function(){
					var act = ['大','小','一'];
					var classcolor = ['blue','orange','red'];
					var init={
						tip:"<?php echo $classinfo['classType']; ?>",
						title:'"<?php echo $classinfo['title']; ?>"',
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
					
					
					var getAll =[
						{name:'英语提高大班6',staus:0,classroom:'206教室', type:0, gotype:1, time:'08:00-10:00', staus:1,cont:'今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！'},
						{name:'英语提高大班6',staus:0,classroom:'206教室', type:0, gotype:1, time:'08:00-10:00', staus:2,cont:'今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！'},
						{name:'英语提高大班6',staus:0,classroom:'206教室', type:0, gotype:1, time:'08:00-10:00', staus:3,cont:'今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！'},
						{name:'英语提高大班6',staus:0,classroom:'206教室', type:0, gotype:1, time:'08:00-10:00', staus:0,cont:'今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！'},
						{name:'英语提高大班6',staus:0,classroom:'206教室', type:0, gotype:1, time:'08:00-10:00', staus:1,cont:'今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！'},
						{name:'英语提高大班6',staus:0,classroom:'206教室', type:0, gotype:1, time:'08:00-10:00', staus:2,cont:'今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！今天学习很认真，课上问题基本都能解决，棒棒哒~继续加油！'},
					]
					var signininfos = $_id('signininfos');
					getAll.map(function(val){
						var alldata = signininfo.creatCont(val);
						signininfos.addChilds(alldata);
					})
				},
				creatCont:function(data){
					var pushdata = 	'<li><div class="stulist-cont2"><p class="stulist-name">学生姓名：'+data.name;
					if(data.staus==0){
						pushdata	+= 	'<span class="blue">上课</span></p><div class="stulist-article">';
					}else if(data.staus==1){
						pushdata	+= 	'<span class="red">请假</span></p><div class="stulist-article">';
					}else if(data.staus==2){
						pushdata	+= 	'<span class="orange">旷课</span></p><div class="stulist-article">';
					}else if(data.staus==3){
						pushdata	+= 	'<span class="purple">迟到</span></p><div class="stulist-article">';
					}
					pushdata	+= 	'<p>评价：</p>'+data.cont+'</div></div></li>';
				
					return pushdata;
				}
			}) 
		
			signininfo.list();
			
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