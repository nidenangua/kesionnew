<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>我的消息</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
   	<link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>var uoot = '<?php echo UOOT ?>'; </script> 	
</head> 
<style type="text/css">
.myMsg-list{padding: .5rem;}
.myMsg-time{font-size: .7rem;}
.myMsg-time>span{float: right;font-size: .6rem;color: #888;line-height: 1.3rem;}
.myMsg-lstbox{background: #FFF;position: relative;padding:0.1rem 0.5rem;margin-bottom: 0.5rem;font-size: .7rem;border-radius: .2rem;}
.myMsg-lstbox>.dics{position: absolute; top: .55rem; left: .1rem; display: block; height: .25rem; width: .25rem; background: #E64A3B; border-radius: 50%;}
.myMsg-col{position: relative;font-size: .6rem;color: #888;height: 1rem;overflow : hidden; text-overflow: ellipsis;margin-bottom: .2rem; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;transition: all .5s;}


/**********封装可删******《****/
.myList-t{display:flex;height:2.1rem;line-height:2rem;position:fixed;top:0;left:0;width:100%;background:#fff;}
.myList-t .item{flex:1;text-align:center;font-size:14px;color:#353535;position:relative}
.myList-t .item:after{content:'';position:absolute;height:70%;width:1px;background:#eaeaea;right:0;top:0;bottom:0;margin:auto}
.myList-t .item:last-child:after{display:none}
.myList-t .item.active div{color:#FFE57B;border-bottom: 2px solid #FFE57B;margin: 0rem 1.5rem;line-height:2rem}
<?php if(empty($this->isp)){ ?>
	.myList-t .item.active div{color:#FFE57B;border-bottom: 2px solid #FFE57B;margin: 0rem 1.5rem;line-height:2rem}
<?php }else{ ?>
	.myList-t .item.active div{color:#37A7ED;border-bottom: 2px solid #37A7ED;margin: 0rem 1.5rem;line-height:2rem}
<?php } ?>
/**********封装可删*******》***/
</style>
<body class="myMsg-wrap" style="background: #F6F5F0;">
	<page class="myMsg-page" id="page2">
		
		<div class="myList-t blue-box_shadow">
			<div class="item active" onclick="myMsg.slideTab(this,0)" id="all">
				<div>通知</div>
			</div>
			<div class="item" onclick="myMsg.slideTab(this,1)">
				<div>公告</div>
			</div>
		</div>
		<div style="height: 40px;"></div>
		<section>
			<div class="myMsg-list">
				<ul id="myMsg-list">
					
				</ul>
			</div>
		</section>
	</page>	 
	
	<div id="loadings" class="loadings"></div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	var myMsg = new Object({
		page:0,
		classlevel:0,
		isFather:0,
		slideTab:function(target,id){
			target.setClass('active','add').getSiblings().setClass('active','remove');
			$_id('myMsg-list').innerHTML='';
			myMsg.classlevel = id;
			myMsg.page = 0;
			myMsg.list();
		},
		slideDon:function(target){
			var flag = target.findClass('myMsg-col')[0].getAttribute('zIndex');
			console.log(typeof flag);
			if(flag=='false'){
				target.findClass('myMsg-col')[0].style.overflow ='auto';
				target.findClass('myMsg-col')[0].style['-webkit-line-clamp'] ='inherit';
				target.findClass('myMsg-col')[0].style.height ='5.5rem';
				target.findClass('myMsg-col')[0].setAttribute('zIndex','true');
				console.log(1)
			}else if(flag=='true'){
				console.log(2)
				target.findClass('myMsg-col')[0].style.overflow ='hidden';
				target.findClass('myMsg-col')[0].style['-webkit-line-clamp'] ='1';
				target.findClass('myMsg-col')[0].style.height ='1rem';
				target.findClass('myMsg-col')[0].setAttribute('zIndex','false');
			}
		},
		list:function(){
			myMsg.page=myMsg.page+1;
			var myMsgs = $_id('myMsg-list');
			if(myMsg.classlevel==0){
//				console.log("请求通知");
				var ajax = {
					url:'/Json/index.php?act=Users.notice&p='+myMsg.page,
					data:''
				}
				
			}else if(myMsg.classlevel==1){
//				console.log("请求公告");
				var ajax = {
					url:'/Json/index.php?act=Users.newNoticelist&p='+myMsg.page,
					data:''
				}
			}
			
			$_post(ajax.url,ajax.data,res=>{
				var datas;
				if(myMsg.classlevel==1){  
					datas = res.newNoticelist; 
				}else{
					datas = res.notice;
				}
				
				if(datas.values.length>0){
					getAll = datas.values; 
					getAll.map(function(val){
						var alldata = myMsg.creatCont(val);
						myMsgs.addChilds(alldata);
					}) 
				}else{
					if(myMsg.page==1){
						if(myMsg.isFather=='0'){
							myMsgs.addChilds('<div class="nodata2"></div>');
						}else{
							myMsgs.addChilds('<div class="nodata1"></div>');
						}
						
					}
				}
			},'json');
			
		},
		creatCont:function(data){
			var type = ['通知','公告'];
			var pushdata = '<div class="myMsg-lstbox blue-box_shadow" onclick="myMsg.slideDon(this)">';
			pushdata 	+= '</span><div class="myMsg-time clearfix">'+type[myMsg.classlevel]+'<span>'+data.adddate+'</span></div>';
			pushdata 	+= '<div class="myMsg-col" zIndex = "false" >'+data.content+'</div></div>';
			return pushdata;
		},
		
		
	})
	myMsg.list();
	myMsg.isFather='<?php echo $this->isp;?>';
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
		myMsg.list();
	});


	</script>
</body>
</html> 