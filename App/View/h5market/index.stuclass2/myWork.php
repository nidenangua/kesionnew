
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>作业列表</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <script>var uoot = '<?php echo UOOT ?>';</script> 	
</head>
<style type="text/css">
.myList-t{display:flex;height:2.1rem;line-height:2rem;position:fixed;top:0;left:0;width:100%;background:#fff;}
.myList-t .item{flex:1;text-align:center;font-size:14px;color:#353535;position:relative}
.myList-t .item:after{content:'';position:absolute;height:70%;width:1px;background:#eaeaea;right:0;top:0;bottom:0;margin:auto}
.myList-t .item:last-child:after{display:none}
<?php if(empty($this->isp)){ ?>
.myList-t .item.active div{color:#FFE57B;border-bottom: 2px solid #FFE57B;margin: 0rem 1.5rem;line-height:2rem}
<?php }else{ ?> 
.myList-t .item.active div{color:#37A7ED;border-bottom: 2px solid #37A7ED;margin: 0rem 1.5rem;line-height:2rem}
<?php } ?>
.item-b button{height:1.5rem;line-height: 1.45rem;min-width: 3.5rem;} 
.myList-order{background:#fff;width:100%;box-sizing:border-box;padding: 5px 10px;box-shadow:0 3px 14px rgba(55,167,237,.25);margin-bottom:10px;position: relative;}
.myList-order .item{display:flex;align-items:center;width:100%;font-size:14px;color:#353535;margin-top:.5rem;line-height:14px}
.myList-order .item:last-child{margin-bottom:.5rem}
.myList-order .item .i-head{flex:1;overflow:hidden}
.myList-order .item .i-body{margin-left:.5rem}
.myList-order .item .teacher{font-size:16px;color:#353535}
.myList-order .item-t{display:flex;border-bottom:1px solid #eaeaea;align-items:center;padding-bottom:.5rem}
.myList-order .item-t .i-head{flex:1;overflow:hidden;color:#353535;font-size:14px;line-height:14px}
.myList-order .item-t .i-body{font-size:15px;line-height:15px}
.myList-order .item-b{position: absolute;top: 2rem;right:.5rem;}
.myList-order .item-b>span{display: block;width:2.2rem;height: 2.2rem;background: #F28550;text-align: center;line-height:2.2rem;height: 2.2rem;color: #FFF;border-radius: 50%;margin-top: -.7rem;}
.myList-title{font-size: .8rem;line-height: 1.2rem;padding-right:3rem;}
.myList-title>span{font-size: .5rem;float: right;}
.myList-gray{color: #888;} 


</style>
	<body style="background: #F6F5F0;">
		<div class="change-wrap">
			<div class="myList-t blue-box_shadow">
				<div class="item active" onclick = "myList.slideTab(this,1,0)" id="all">
					<div>未做</div>
				</div>
				<div class="item" onclick = "myList.slideTab(this,3,1)">
					<div>待批阅</div>
				</div>
				<div class="item" onclick = "myList.slideTab(this,4,2)">
					<div>已批阅</div>
				</div>
					
			</div>
			<div style="height: 50px;"></div>
			<div class="cs-container" id="myList-list">
				<!--<div class="myList-order">
					<div>
						<div class="myList-title">精装修班级通</div>
						<div class="myList-gray">作业类型：在线做题</div>
						<div class="myList-gray">截止时间：2018-5-23</div>
						<div class="myList-gray">班级/课程：班级</div>
						<div class="myList-gray">所属班级/课程名称：英语加强班</div>
					</div>
					<div class="item-b">
						<button class="x-btnYell" onclick="order.chakan(381)">做作业</button>
					</div>
				</div> -->
				
			
			<div class="loadings" id="loadings"></div>
			</div>
			<div style="text-align: center;font-size:.7rem;display: none;" id="bottom">到底了~</div>

		<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
		<script type="text/javascript">
			var myList = new Object({
				page:0,
				tab:0,
				allpage:0,
				isFather:0,
				memberid:0,
				paystatus:0,//当前激活标签 type 1未作业 3待批阅 4 已批阅
				slideTab:function(target,id,tab){
					target.setClass('active','add').getSiblings().setClass('active','remove');
					$_id('myList-list').innerHTML='';
					myList.paystatus = id;
					myList.tab = tab;
					myList.page = 0;
					myList.list();
				},
				list:function(){
					myList.page=myList.page+1;
					var myLists = $_id('myList-list');
					var ajax = {
						url:'/Json/index.php?act=Class.classTask&tasktype=0&classid=0&memberid='+myList.memberid+'&type='+myList.paystatus+'&p='+myList.page+'&maxnum=10&timetype=0',
						data:''
					}
					$_post(ajax.url,ajax.data,res=>{
						console.log(res);
						if(res.classTask.task){
							if(res.classTask.task.length>0){
								myList.allpage = res.classTask.page.total_pages;
								getAll = res.classTask.task; 
								getAll.map(function(val){ 
									var alldata = myList.creatCont(val);
									myLists.addChilds(alldata);
								}) 
							}else{
								if(myList.page==1){
									if(myList.isFather == '0'){
										myLists.addChilds('<div class="nodata2"></div>');
										
									}else{ 
										myLists.addChilds('<div class="nodata1"></div>');
										
									}
									
								}
							}
						}else{
							if(myList.isFather == '0'){
								myLists.addChilds('<div class="nodata2"></div>');
								
							}else{ 
								myLists.addChilds('<div class="nodata1"></div>');
								
							}
						}
						
					},'json');
					
				},
				creatCont:function(data){
					var tasktype = ['班级的作业' ,'课程的作业'];//0'班级的作业'1'课程的作业'
				 	var checkstyle = ['','上传作业材料','在线做题','其他线下'];//作业类型 1上传作业材料 2在线做题3其他线下
					var pushdata='<div class="myList-order">';
					pushdata +='<div><div class="myList-title">'+data.title+'</div>';
					pushdata +='<div class="myList-gray">作业类型：'+checkstyle[data.taskstyle]+'</div>';
					if(myList.tab==2){
						if(myList.isFather == '0'){
							pushdata +='<div class="orange">得分：'+data.score+'</div>';
						}
						
					}else{
						pushdata +='<div class="myList-gray">截止时间：'+data.enddate+'</div>';
					}
					pushdata +='<div class="myList-gray">班级/课程：'+tasktype[data.tasktype]+'</div>';
					pushdata +='<div class="myList-gray">所属班级/课程名称：'+data.title+'</div>';
					pushdata +='</div><div class="item-b">';
					if(myList.tab==0){
						if(myList.isFather == '0'){
							pushdata +='<button class="x-btnYell" onclick="myList.dowork('+data.id+')">做作业</button></div></div>';
						}else{
							pushdata +='<button class="x-btnBlue" onclick="myList.chakans('+data.id+')">查看</button></div></div>';
						}

						
					}else if(myList.tab == 2){
						if(myList.isFather == '0'){
						pushdata +='<button class="x-btnYell" onclick="myList.chakan('+data.ids+')">查看</button></div></div>';
						}else{ 
						pushdata +='<span onclick="myList.chakan('+data.ids+')">'+data.score+'分</span></div></div>';
						}
						
					}else if(myList.tab == 1){
						if(myList.isFather == '0'){
							pushdata +='<button class="x-btnYell" onclick="myList.chakans('+data.id+')">查看</button></div></div>';
						}else{
							pushdata +='<button class="x-btnBlue" onclick="myList.chakans('+data.id+')">查看</button></div></div>';
						}
						
					}
					
					return pushdata;
				},
				dowork:function(id){ 
					window.location.href="<?php echo M_URL('h5market','myTask'); ?>?id="+id;
				},
				chakan:function(id){
					window.location.href="<?php echo M_URL('h5market','myTaskreads'); ?>/"+id;
				},
				chakans:function(id){
					window.location.href="<?php echo M_URL('h5market','myTaskread'); ?>/"+id;
				}
			})
			
			myList.list();
			myList.memberid ='<?php echo $memberid; ?>';
			myList.isFather='<?php echo $this->isp;?>';

			$_monitor.scroll.bottom(window,()=>{
				if(myList.page<myList.allpage){
					myList.list();
				}else{
					var len = 0;
					if(myList.isFather == '0'){
						$_class('nodata2').map(function(e,index){
							len++;
						})
						
					}else{ 
						$_class('nodata1').map(function(e,index){
							len++;
						})
						
					}
					
					if(len==0){
						$_id('bottom').style.display = 'block';
					}
					console.log(len);
				}
				
			});
		</script>
	</body>

</html>
