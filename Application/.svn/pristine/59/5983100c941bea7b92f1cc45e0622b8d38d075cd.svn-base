<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>班级首页</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
   	<link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<style type="text/css">
.classmin-topTab{margin-bottom: .5rem;}
.classmin-topTab li{ float: left; width: 25%; text-align: center; height: 2.3rem; line-height: 2.3rem; background: #FFF; font-size: 0.75rem; }
.classmin-topTab li.active{ color:#37a7ed; }
.classmin-topTab li>div{  border-right:#EEEEEE solid 0.05rem; height: 2rem; line-height: 2rem; margin-top: 0.15rem;}
.classmin-lstbox{background: #FFF;position: relative;padding:0.5rem 0.5rem 0rem 0.5rem;margin-bottom: 0.5rem;font-size: .7rem;}
.classmin-title{font-size: 0.8rem;padding-right: 3.5rem;position: relative;}
.classmin-title>span{display: block; width: 0.9rem; height: 0.9rem; text-align: center; line-height: 0.9rem; margin-top: 0.2rem; font-size: 0.55rem; float: left;margin-right:0.2rem;border-radius: .1rem;}
.classmin-title>span.blue{background:#37A7ED;color: #fff;}
.classmin-title>span.orange{background:#F28550;color: #fff;}
.classmin-title>span.red{background:#E64A3B;color: #fff;}
.classmin-title>button{position: absolute;top: 0rem;right: 0rem;min-width:3rem;}
.classmin-title>button:last-child{top: 2.2rem;right: 0rem;}
.classmin-col{}
.classmin-bot{border-top:1px solid #EEEEEE;margin-top: 0.5rem;}
.classmin-bot .tab{width: 50%;float: left; text-align: center;line-height: 2.5rem;font-size: .75rem;}
.add{ width: 2.5rem; height: 2.5rem; background: -webkit-linear-gradient(top,#007BED,#00AEEB); /* Safari 5.1 - 6.0 */ background: -o-linear-gradient(top,#007BED,#00AEEB); /* Opera 11.1 - 12.0 */ background: -moz-linear-gradient(top,#007BED,#00AEEB); /* Firefox 3.6 - 15 */ background: linear-gradient(top,#007BED,#00AEEB); position: fixed; bottom: 40px; left: 0; right:0; margin: auto; border-radius: 50%; line-height: 3.5rem; text-align: center; }

</style>

<body class="classmin-wrap">
	<page class="classmin-page" id="page2">
		<header>
			<div class="classmin-topTab blue-box_shadow"> 
				<ul class="clearfix">
					<li class="active" onclick="classmin.slideTab(this,'max')"><div>全部</div></li>
					<li onclick="classmin.slideTab(this,2)"><div>一对一</div></li>
					<li onclick="classmin.slideTab(this,1)"><div>小班课</div></li>
					<li onclick="classmin.slideTab(this,0)">大班课</li>
				</ul>
				<input id="histype" type="hidden" value="0" />
			</div>
		</header>
		
		<section>
			<div class="classmin-list">
				<ul id="classmin-list">
					<!--<li>
						<div class="classmin-lstbox">
							<div class="classmin-title">
								<span class="orange">小</span>PS 电商设计特训/淘宝美工+网店装修+主图海报+详情页/平面设计
								<i class="ion-playonline"></i> 
								<i class="ion-face"></i>
								<button class="o-btnBlue" onclick = "classmin.sheng(this,112,0)">已审</button>
								<button class="o-btnGray" onclick = "classmin.sheng(this,112,-1)">删除</button>
							</div>
							<div class="classmin-col">
								刘娜老师
							</div>
							<div class="classmin-col">
								学生人数：10人
							</div>
							<div class="classmin-col orange">
								￥300元/课时
							</div>
							<div class="classmin-bot clearfix">
								<div class="tab">
									<div style="border-right: 1px solid #EEEEEE;">
										<a class="blue" href="">班级课表</a>
									</div>
								</div>
								
								<div class="tab">
									<div>
										<a class="blue" href="">签到</a>
									</div>
								</div>
							</div>
						</div>
					</li>-->
				</ul>
			</div>
		</section>
		<div class="add" onclick="classmin.popup()">
			<img src="<?php echo UOOT ?>Public/wechat/images/add.png"/>
		</div> 
	</page>	 
	
	<div id="loadings" class="loadings"></div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	var classmin = new Object({
		page:0,
		classlevel:'max',
		slideTab:function(target,id){
			target.setClass('active','add').getSiblings().setClass('active','remove');
			$_id('classmin-list').innerHTML='';
			classmin.classlevel = id;
			classmin.page = 0;
			classmin.list();
		},
		list:function(){
			classmin.page=classmin.page+1;
			var classmins = $_id('classmin-list');
			var ajax = {
				url:'/Json/index.php?act=WeChat.ALLclasslist',
				data:{
					classlevel:classmin.classlevel,
					p:classmin.page
				}
			}
			
			$_post(ajax.url,ajax.data,res=>{
				if(res.ALLclasslist.dt.length>0){
					getAll = res.ALLclasslist.dt;
					getAll.map(function(val){
						var alldata = classmin.creatCont(val);
						classmins.addChilds(alldata);
					}) 
				}else{
					if(classmin.page==1){
						classmins.addChilds('<div class="novalue"></div>');
					}
				}
			},'json');
			
			//$_id('classmin-list').addChilds(alldata);
		},
		creatCont:function(data){
			console.log(data);
			var act = ['大','小','一'];
			var classcolor = ['blue','orange','red'];
			var classtype = ['<i class="ion-playonline"></i> <i class="ion-face"></i>','<i class="ion-playonline"></i>',' <i class="ion-face"></i>'];
			var sheng = ['未审','已审'];
			var shenghe = ['o-btnOrag','o-btnBlue'];
			var fan = [1,0];
			var lv = ['月','季','年','课时'];
			var pushdata = '<li class="blue-box_shadow"><div class="classmin-lstbox"><div class="classmin-title">';
			pushdata 	+= '<span class="'+classcolor[data.classlevel]+'">'+act[data.classlevel*1]+'</span>'+data.title;
			pushdata 	+= classtype[data.classType-1];
			pushdata 	+= '<button class="'+shenghe[data.status]+'" onclick = "classmin.sheng(this,'+data.classid+','+fan[data.status]+')">'+sheng[data.status]+'</button><button class="o-btnGray" onclick = "classmin.sheng(this,'+data.classid+',-1)">删除</button>';
			pushdata 	+= '</div><div class="classmin-col">'+data.name+'</div><div class="classmin-col">学生人数：'+data.studentnum+'人</div>';
			if(data.price == '免费'){
				pushdata 	+= '<div class="classmin-col orange">'+data.price+'	</div>';
			}else{
				if(data.chargeData == 4){
					pushdata 	+= '<div class="classmin-col orange">'+data.price+'元/'+data.hourunit+lv[data.chargeData-1]+'	</div>';
				}else{
					pushdata 	+= '<div class="classmin-col orange">'+data.price+'元/'+lv[data.chargeData]+'	</div>';	
				}
				
			}
			pushdata 	+= '<div class="classmin-bot clearfix"><div class="tab"><div style="border-right: 1px solid #EEEEEE;">';
			pushdata 	+= '<a class="blue" onclick="classmin.kebiao('+data.classid+')">班级课表</a></div></div><div class="tab">	<div>';
			pushdata 	+= '<a class="blue" onclick="classmin.sing('+data.classid+')">签到</a></div></div></div></div></li>';
			return pushdata;
		},
		sheng:function(target,classid,status){
			var ajax = {
				url:'/Json/index.php?act=WeChat.classeditstatus',
				data:{
					classid:classid, 
					status:status
				}
			}
			if(status==-1){
				var isdel = confirm('是否删除？');
			}else{
				var isdel = true;
			}
			
			
			
				
			if(isdel==true){
				$_post(ajax.url,ajax.data,res=>{
						if(status==0){
							target.innerHTML='未审';
							target.setAttribute('class','o-btnOrag');
							target.setAttribute('onclick','classmin.sheng(this,'+classid+',1)');
						}else if(status==1){
							target.innerHTML='已审';
							target.setAttribute('class','o-btnBlue');
							target.setAttribute('onclick','classmin.sheng(this,'+classid+',0)');
						}else{
							var pare = target.parentNode.parentNode.parentNode;
							pare.slideUp(400,function(){
								pare.remove();
							});
							
						}
				},'json');
			}
		 
		},
		sing:function(classid){
			window.location.href="<?php echo M_URL('WeChat','signinlst'); ?>?classid="+classid;
		},
		kebiao:function(classid){
			window.location.href="<?php echo M_URL('WeChat','myCourse'); ?>?classid="+classid;
		},
		popup:function(){
			window.location.href="<?php echo M_URL('WeChat','classmincreat'); ?>";
		}
	})
	classmin.list();
	
/**
 * 
 * 参数classid 班级id
 *	status 0未审核 1已审核 -1删除
 *	classeditstatus
 * 
 * 
 * 
 * */
	$_monitor.scroll.bottom(window,()=>{
		//$_id('loadings').style.display = 'block';
		classmin.list();
	});


	</script>
</body>
</html>