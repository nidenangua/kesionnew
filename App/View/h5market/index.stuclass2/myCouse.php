<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>我的课程</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
   	<link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>var uoot = '<?php echo UOOT ?>'; </script> 	
</head> 
<style type="text/css">
.myCouse-list{margin-top: .5rem;}
.myCouse-lstbox{background: #FFF;position: relative;padding:0.5rem 0.5rem 0rem 0.5rem;margin-bottom: 0.5rem;font-size: .7rem;}
.myCouse-title{font-size: 0.8rem;padding-right: 3.5rem;position: relative;}
.myCouse-title>span{display: block; width: 0.9rem; height: 0.9rem; text-align: center; line-height: 0.9rem; margin-top: 0.2rem; font-size: 0.55rem; float: left;margin-right:0.2rem;border-radius: .1rem;}
.myCouse-title>span.blue{background:#37A7ED;color: #fff;}
.myCouse-title>span.orange{background:#F28550;color: #fff;}
.myCouse-title>span.red{background:#E64A3B;color: #fff;}
.myCouse-title>button{position: absolute;top: 0rem;right: 0rem;min-width:3rem;}
.myCouse-title>button:last-child{top: 2.2rem;right: 0rem;}
.myCouse-col{}
.myCouse-bot{border-top:1px solid #EEEEEE;margin-top: 0.5rem;}
.myCouse-bot .tab{width: 50%;float: left; text-align: center;line-height: 2.5rem;font-size: .75rem;}
.add{ width: 2.5rem; height: 2.5rem; background: -webkit-linear-gradient(top,#007BED,#00AEEB); /* Safari 5.1 - 6.0 */ background: -o-linear-gradient(top,#007BED,#00AEEB); /* Opera 11.1 - 12.0 */ background: -moz-linear-gradient(top,#007BED,#00AEEB); /* Firefox 3.6 - 15 */ background: linear-gradient(top,#007BED,#00AEEB); position: fixed; bottom: 40px; left: 0; right:0; margin: auto; border-radius: 50%; line-height: 3.5rem; text-align: center; }
</style>

<body class="myCouse-wrap" style="background: #F6F5F0;">
	<page class="myCouse-page" id="page2">
		
		<section>
			<div class="myCouse-list">
				<ul id="myCouse-list">
					<!--<li>
						<div class="myCouse-lstbox">
							<div class="myCouse-title">
								<span class="orange">小</span>PS 电商设计特训/淘宝美工+网店装修+主图海报+详情页/平面设计
								<button class="x-btnYell" onclick = "myCouse.sheng(this,112,0)">续班</button>
							</div>
							<div class="myCouse-col">
								班主任：刘娜老师
							</div>
							<div class="myCouse-col">
								授课类型：线上+面授班级
								<i class="ion-playonline"></i> 
								<i class="ion-face"></i>
							</div>
							<div class="myCouse-col">
								已用课时：10
							</div>
							<div class="myCouse-col">
								剩余课时：<font class="orange">2</font>
							</div>
							<div class="myCouse-bot clearfix">
								<div class="tab">
									<div style="border-right: 1px solid #EEEEEE;">
										<a class="orange" href="">班级课表</a>
									</div>
								</div>
								
								<div class="tab">
									<div>
										<a class="orange" href="">签到</a>
									</div>
								</div>
							</div>
						</div>
					</li>-->
				</ul>
			</div>
			<div id="nodatas" style="text-align: center;display: none;">没数据了~</div>
		</section>
	</page>	 
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	var myCouse = new Object({
		page:0,
		total:1,
		classlevel:'max',
		isFather:0,
		loadings:function(){
			$_id('page2').addChilds('<div id="loadings" style="display: block;" class="loadings"></div>');
			var lad =$_id('loadings');
			setTimeout(function(){
				lad.parentNode.removeChild(lad);
				myCouse.list();
			},1500);  
			
			
		},
		slideTab:function(target,id){
			target.setClass('active','add').getSiblings().setClass('active','remove');
			$_id('myCouse-list').innerHTML='';
			myCouse.classlevel = id;
			myCouse.page = 0;
			myCouse.list();
		},
		list:function(){
			myCouse.page=myCouse.page+1;
			if(myCouse.page<=myCouse.total){
				var myCouses = $_id('myCouse-list');
				var ajax = {
					url:'/Json/index.php?act=Class.classlist&wxcode=1',
					data:{
						classlevel:myCouse.classlevel,
						p:myCouse.page
					}
				}
				
				$_post(ajax.url,ajax.data,res=>{
					console.log(myCouse);
					if(res.classlist.values.length>0){
						myCouse.total=res.classlist.page.total_pages;
						getAll = res.classlist.values; 
						getAll.map(function(val){
							var alldata = myCouse.creatCont(val);
							myCouses.addChilds(alldata);
						}) 
					}else{
						if(myCouse.page==1){
							if(myCouse.isFather=='0'){
								myCouses.addChilds('<div class="nodata2"></div>');
							}else{
								myCouses.addChilds('<div class="nodata1"></div>');
							}
							
						}
					}
				},'json');
				
				
			}else{
				$_id('nodatas').style.display = 'block';
			}
			
			
		},
		creatCont:function(data){
			var classtype = ['<i class="ion-playonline"></i> <i class="ion-face"></i>','<i class="ion-playonline"></i>',' <i class="ion-face"></i>'];
			var typeword = ['线上+面授班级','线上班级','面授班级'];
			var sheng = ['未审','已审'];
			var shenghe = ['o-btnOrag','o-btnBlue'];
			var fan = [1,0];
			var lv = ['月','季','年','课时'];
			var pushdata = '<li class="blue-box_shadow"><div class="myCouse-lstbox"><div class="myCouse-title">';
			pushdata 	+= data.title;
			pushdata 	+= '</div>';
			pushdata 	+= '<div class="myCouse-col"> 班主任：'+data.name+' </div> <div class="myCouse-col"> 授课类型：'+typeword[data.classType-1]+classtype[data.classType-1]+'</div> ';
			pushdata 	+= '<div class="myCouse-bot clearfix"><div class="tab"><div style="border-right: 1px solid #EEEEEE;">';
			if(myCouse.isFather=='0'){
				pushdata 	+= '<a class="orange" onclick="myCouse.kebiao('+data.classid+')">班级课表</a></div></div><div class="tab">	<div>';
				pushdata 	+= '<a class="orange" onclick="myCouse.sing('+data.classid+')">签到记录</a></div></div></div></div></li>';	
			}else{
				pushdata 	+= '<a class="blue" onclick="myCouse.kebiao('+data.classid+')">班级课表</a></div></div><div class="tab">	<div>';
				pushdata 	+= '<a class="blue" onclick="myCouse.sing('+data.classid+')">签到记录</a></div></div></div></div></li>';
			}
			
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
						target.setAttribute('onclick','myCouse.sheng(this,'+classid+',1)');
					}else if(status==1){
						target.innerHTML='已审';
						target.setAttribute('class','o-btnBlue');
						target.setAttribute('onclick','myCouse.sheng(this,'+classid+',0)');
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
			window.location.href="<?php echo M_URL('h5market','mySign'); ?>?classid="+classid;
		},
		kebiao:function(classid){
			window.location.href="<?php echo M_URL('h5market','myTable'); ?>?classid="+classid;
		},
		popup:function(){
			window.location.href="<?php echo M_URL('h5market','myCousecreat'); ?>";
		}
	})
	//操作
	myCouse.list();
	myCouse.isFather='<?php echo $this->isp;?>';
	
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
		myCouse.loadings();
		
	});


	</script>
</body>
</html>