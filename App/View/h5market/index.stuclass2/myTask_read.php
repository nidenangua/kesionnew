
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>作业详情</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <script>var uoot = '<?php echo UOOT ?>';</script> 	
</head>
<style type="text/css">
/*********************外框**********************/
.myTask{display: none;}
.myTask-mypress em{font-style: normal;}
.myTask-mypress span{ float: left;color: #888;font-size: .6rem; }
.myTask-mypress span:last-child{ float: right; }
.myTask-list > li{display: none;}
.myTask-list > li.active{display: block;}
.myTask-page{padding: .5rem;} 
.myTask-type{font-size: .75rem;}
/*********************题型**********************/
.list-title{text-align: center;position: relative;padding: .5rem;background: #FFF;border-radius: .3rem;margin-bottom: .5rem;}
.list-title>img{width: 280px;}
.list-title>p{text-align: left;float: left;}
.list-title>span{text-align: left;float: left;}
.list-title>button{}
.nobt{margin: 0rem;}
.myTask-option>li{position: relative;padding: .6rem .5rem;background: #FFF;border-radius: .3rem;margin-bottom: .3rem;box-shadow: 0 2px 14px RGB(225, 242, 253);}
.myTask-option>li.active{background: #FFE57B;}
.lvinp{border-top: none;border-left: none;border-right: none;border-bottom: 1px solid #43B747;width:4rem;background: #FFF!important;}
.redinp{border-top: none;border-left: none;border-right: none;border-bottom: 1px solid #E64A3B;width:4rem;text-decoration: line-through;color:#E64A3B;}
.myTask-textarea{padding: .5rem;background: #FFF;border-radius: .3rem;margin-bottom: 1rem;}
.myTask-textarea>textarea{width: 100%;height: 6rem;border: none;resize: none;}
.myTask-textarea>.contens{width: 100%;height: 6rem;border: none;resize: none;}
.upload{width: 100%;height: 2.2rem;position: relative;line-height: 2.2rem;}
.upload>input{position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;}
.postTask{width:100%;height:100%;} 
.timu5{background:#FFF;margin-bottom:1rem;border-radius: .3rem;padding-bottom: .2rem;}
.timu5li{padding: 0rem .5rem;margin-bottom: .1rem;}
/*************************答题卡***************************/
.mTask{position: fixed;top: 0px;left: 0px;right: 0px;bottom: 0px;z-index: 10;display: none;}  
.mTask-sen{transition:all .5s;width:80%;position: absolute;top: 0px;right: 0px;bottom: 0px;z-index: 10;background: #FFF;margin-right: -80%;}
.mTask .screelst-title{line-height: 2.2rem;background: #fff;padding: 0rem 0.5rem;font-size:0.8rem ;border-bottom: 1px solid #EEEEEE;}
.mTask .screelst-lstbox{padding:0.5rem;} 
.mTask .screelst-lstbox>ul{position: absolute;bottom:2.7rem;overflow: auto;top: 2.5rem;width: 100%;} 
.mTask .lstbox-title{line-height: 2rem;font-size: 0.7rem;}
.mTask .lstbtn button{font-size: .7rem; border: #CCCCCC 1px solid;color:#CCCCCC;height: 1.4rem; width: 1.5rem; background: #FFF; margin-right: .5rem; margin-bottom: .5rem;}
.mTask .lstbtn button.active{color:#353535;border:#353535 1px solid;}
.mTask .lstbtn button.tip{color:#37A7ED!important;border:#37A7ED 1px solid!important;}
.mTask .lstbtn button.col{color:#f28550!important;border:#f28550 1px solid!important;}
.mTask .sign-operation{margin-top: 1rem; text-align: center; position: absolute; bottom: 0rem; right: 0rem;width: 100%;border-top: 1px solid #eeeeee;}
.mTask .sign-operation button{width: 100%;height: 2.45rem;border: none;font-size: .8rem;}
/*******************底部收藏等工具**********************/
.note{height: 1.5rem;line-height: 1.5rem;}
.note span{display: block;height: 1.1rem; width: 1.2rem;float: left;margin-left: .45rem;margin-top: .1rem;}
.note:last-child span{margin-top: .1rem;display: block;height: 1rem; width: 1.2rem;margin-left: .33rem;margin-right: .14rem;}
.note .icon-star{background: url(<?php echo UOOT ?>Public/wechat/images/star.png) no-repeat;background-size: auto 100%;}
.note .icon-map{background: url(<?php echo UOOT ?>Public/wechat/images/map.png) no-repeat;background-size: auto 100%;}
.note.active .icon-star{background: url(<?php echo UOOT ?>Public/wechat/images/star_active.png) no-repeat;background-size:auto 100%;}
.note.active .icon-map{background: url(<?php echo UOOT ?>Public/wechat/images/map_active.png) no-repeat;background-size:auto 100%;}
.note.active{color:#37A7ED;}
.note.active:last-child{color:#F28550;}
.myTask-fiex{position: fixed;bottom: 4rem;right: 1rem;} 
.myTask-tim{position: relative;height: 2.5rem;line-height: 2.5rem;width: 2.5rem;background: #FFF;font-size: 1rem;text-align: center;border-radius: .3rem;}
.myTask-tim>span{position: absolute;display: block;width:1rem;height: 1rem;line-height: 1rem;border-radius: 50%;background:#E64A3B;color: #FFF;text-align: center;font-size: .6rem;right: -.5rem;top: -.5rem}

.classmin-topTab{margin-bottom: .5rem;}
.classmin-topTab li{ float: left; width: 25%; text-align: center; height: 2.5rem;  background: #FFF; font-size: 0.75rem; }
.classmin-topTab li.active{ color:#37a7ed; }
.classmin-topTab li>div{  border-right:#EEEEEE solid 0.05rem; height: 2rem;  margin-top: 0.2rem;}
.classmin-topTab p{font-size: .6rem;color: #888;line-height: 1rem;}
.classmin-topTab span{font-size: .9rem;color: #000000;}
</style>
	<body style="background: #F6F5F0;">
	<div id="read" >
		<div class="myTask">
			<div class="myTask-page">
				<div class="myTask-type" >
					材料题：
				</div>
				
				<ul class="myTask-list">
	
					<li style="display: block;">
						<div class="list-title blue-box_shadow">
							<div class="clearfix" style="text-align: left;">
								<p id="caiTitle">数据库东方航空垃圾收到货副科级好可怜山东矿机安徽省大口径的合法卡斯加了 奥斯卡的积分拉斯科剪短发谁说的就</p>
							</div>
							<div id="caiContent">
								
								<img src="<?php echo UOOT ?>Public\app\images\course1.jpg" alt="" />
							</div>
						</div>
						<div>
							 <p>文字描述</p>
							 <p id="miaoshu"></p>
						</div>
						<br />
						<div>
							<p>附件</p> 
							<p id="fujian"></p> 
						</div>
						
					</li>
					
				</ul>
			</div>

		</div>
		
		
		
		<div class="myTask">
			
			<div class="myTask-page">
				
				<div class="myTask-type" id="now_type">
					判断题：
				</div>
				
				<ul class="myTask-list" id="Timulist"></ul>
				<div class="myTask-fiex">
					<div class="myTask-tim blue-box_shadow" id="tim" onClick="myTask.maskopen()">
						题
					</div>
				</div>
			</div>
			
			<div class="myTask-note">
				<div class="note" id="put" staus="false" onClick="myTask.put()">
					<span class="icon-map"></span>标记此题
				</div>
				
				<div class="note" id="collect" staus="false" onClick="myTask.collect()">
					<span class="icon-star"></span>收藏此题
				</div>
			</div>
			
  
			
			<section class="mTask" id="filler"> 
				<div class="mask" onClick="myTask.maskclose(this)" style="display: block; z-index: 0; opacity:0;"></div>
				<div class="mTask-sen" id="mTasksen" style="margin-right: -80%;">
					<div class="screelst-title">答题卡</div>
					<div class="screelst-lstbox">
						<ul id="dtimcard"></ul>
						<div class="sign-operation">
							<div>
								<button class="fb-white" onClick="myTask.maskclose(this)">返回</button>
							</div>
						</div>
					</div>
				</div>
			</section>
			
			<footer class="footer" id="footer">
				<div class="clearfix">
					<div class="zui-col-6">
						
						<div class="footer-foticon" id="prev">
							<a href="javascript:;" onClick="myTask.backlist()"> 返回作业列表 </a>
						</div>
						
					</div>
					<div class="zui-col-6">
						
						<div class="footer-foticon fb-Yell"  id="next">
							<a href="javascript:;" onClick="myTask.nextTim()">
							下一题
							</a>
						</div>
						
					</div>
				</div>
			</footer>
			<!--<footer class="footer">
				<button class="x-btnYell postTask">提交作业</button>
			</footer>-->
		</div> 
		 
		<div class="myTask">
			<div class="myTask-page">
				<div class="myTask-type" >
					材料题
				</div>
				
				<ul class="myTask-list">
	
					<li style="display: block;">
						<div class="list-title blue-box_shadow ">
							<div class="clearfix" style="text-align: left;">
								<b><p id="title"></p></b>
							</div>
							<div id="content" style="text-align: left;"></div>
						</div>
					</li>
					 
				</ul>
			</div>

			<footer class="footer">
				<button class="x-btnYell postTask" onClick="history.go(-1)">返回作业列表</button>
			</footer>
		</div>
		
		
	</div>
	
		
		
		<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
		<script type="text/javascript">
			var trueid = '<?php echo $id; ?>';
			var myTask = new Object({
				press:0,//启始
				page:0,//页面序列
				leatim:0,//剩余未做题目
				total:0,//总进度
				answer:[],//答案记录条
				putdata:'',//答案输出序列
				savedata:'',
				tkids:'<?php echo $id; ?>',
				parperid:'',
				isnull:false,
				arrOpt:['A','B','C','D','E','F','G','H','I'],
				slideTab:function(target,id){
					target.setClass('active','add').getSiblings().setClass('active','remove');
					$_id('myList-list').innerHTML='';
					myList.paystatus = id;
					myList.page = 0;
					myList.list();
				},
				upload:function(){
					$_id('fileid').click();
				}, 
				uploadinof:function(e){
					var exe=e.value.replace(/.+\./,"");   //正则表达式获取后缀
					var name=e.value.replace(/^.+?\\([^\\]+?)(\.[^\.\\]*?)?$/gi,"$1");//name
					$_id('filename').innerHTML = name+'.'+exe;
					console.log(); 
				},
				maskopen:function(){
					var alertbox = $_id('filler');
					alertbox.style.display = 'block';
					setTimeout(function(){
						$_class('mask')[0].style.opacity = 0.5;
						var screenlst = $_id('mTasksen'); 
						screenlst.style.marginRight='0rem'
					},100);
					
				}, 
				maskclose:function(target){
					var screenlst = $_id('mTasksen'); 
					screenlst.style.marginRight='-80%'
					$_class('mask')[0].style.opacity = 0;
					var alertbox = $_id('filler');
					setTimeout(function(){
						alertbox.style.display = 'none';
					},400);
				},
				showTim:function(){
					var timtype = ['','选择题','填空题','判断题','问答题','材料题','多选题'];
					var type_now = $_id('Timulist').child()[myTask.page].getAttribute('tktype');
					$_id('now_type').innerHTML = timtype[type_now];
					$_id('Timulist').child()[myTask.page].setClass('active','add').getSiblings().setClass('active','remove');
				
					if(myTask.page==0){
						if(myTask.page==myTask.total-1){
							$_id('footer').innerHTML = '<button class="x-btnYell postTask" onclick="history.go(-1)">返回作业列表</button>';
							
						}else{
							$_id('prev').innerHTML='<a  href="javascript:;" onclick="myTask.backlist()"> 返回作业列表 </a>';
							$_id('next').innerHTML='<a  href="javascript:;" onclick="myTask.nextTim()"> 下一题 </a>';	
						}
					}else{
						if(myTask.page!=myTask.total-1){ 
							$_id('prev').innerHTML='<a  href="javascript:;" onclick="myTask.prevTim()">上一页</a>';
							$_id('next').innerHTML='<a  href="javascript:;" onclick="myTask.nextTim()"> 下一题 </a>';
						}else if(myTask.page=myTask.total-1){
							$_id('prev').innerHTML='<a  href="javascript:;" onclick="myTask.prevTim()">上一页</a>';	
							$_id('next').innerHTML='<a  href="javascript:;" onclick="myTask.backlist()">返回作业列表</a>';
						}
						
						 
					}
					myTask.check_now_put();
					myTask.check_collect_put();
					myTask.check_collect_card();
				},
				gotos:function(id){
					myTask.page=id-1;
					myTask.showTim();
				},
				nextTim:function(){
					
					
					if(myTask.page<myTask.total-1){
						myTask.page=myTask.page+1;
						myTask.showTim();
					}else{
						myTask.page=myTask.total-1;
						myTask.showTim();
					}
					console.log('当前'+myTask.page);
					
				},
				prevTim:function(){
					if(myTask.page>0){
						myTask.page=myTask.page-1;
						myTask.showTim();
					}else{
						myTask.page=0;
						myTask.showTim();
					}
					console.log('当前'+myTask.page);
				},
				backlist:function(){
					history.go(-1); 
				},
				ajaxpost:function(data){
					 var ajax = new XMLHttpRequest();
			        // 使用post请求
			        ajax.open('post','/Json/index.php?act=Class.submitjob1');
			        // 如果 使用post发送数据 必须 设置 如下内容
			        // 修改了 发送给 服务器的 请求报文的 内容
			        // 如果需要像 HTML 表单那样 POST 数据，请使用 setRequestHeader() 来添加 HTTP 头。然后在 send() 方法中规定您希望发送的数据：
			        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			        // 发送
			        // post请求 发送的数据 写在 send方法中
			        // 格式 name=jack&age=18 字符串的格式
			        ajax.send(data);
			 
			        // 注册事件
			        ajax.onreadystatechange = function () {
			            if (ajax.readyState==4&&ajax.status==200) {
			                console.log(ajax.responseText);
			                alert('提交成功！');
			                window.location.href='https://ks.kesion.com/h5market/myWork';
			            }
			        }
				},
				put:function(){
					var pust = myTask.page+1;
					$_class('lstbtn').map(function($v,$i){
						$v.findTag('button').map(function($elem,$index){
							if($elem.innerHTML*1==pust){
								var gettip = $elem.getAttribute('tip');
								$elem.setClass('tip','remove');
								if(gettip=='false'){
									$elem.setClass('tip','add');
									$_id('put').setClass('active','add');
									$elem.setAttribute('tip','true');
								}else{
									$elem.setClass('tip','remove');
									$_id('put').setClass('active','remove');
									$elem.setAttribute('tip','false');
								}
							}
						})
					})
				},
				//检查当前题目是否标记
				check_now_put:function(){
					$_id('put').setClass('active','remove');
					var pust = myTask.page+1;
					$_class('lstbtn').map(function($v,$i){ 
						$v.findTag('button').map(function($elem,$index){
							if($elem.innerHTML*1==pust){
								var gettip = $elem.getAttribute('tip');
								$elem.setClass('tip','remove');
								if(gettip=='true'){
									$elem.setClass('tip','add');
									$_id('put').setClass('active','add');
								}else{
									$elem.setClass('tip','remove');
									$_id('put').setClass('active','remove');
								}
							}
						})
					})
				},
				collect:function(){
					var pust = myTask.page+1;
					$_class('lstbtn').map(function($v,$i){
						$v.findTag('button').map(function($elem,$index){
							if($elem.innerHTML*1==pust){
								var gettip = $elem.getAttribute('collect');
								if(gettip=='false'){
									$_id('collect').setClass('active','add');
									$elem.setAttribute('collect','true');
									myTask.postar(myTask.answer,'add');
								}else{
									$_id('collect').setClass('active','remove');
									$elem.setAttribute('collect','false');
									myTask.postar(myTask.answer,'del');
									
								}
							}
						})
					})
					myTask.check_collect_card();
				},
				//检查当前题目是否收藏
				check_collect_put:function(){
					$_id('collect').setClass('active','remove');
					var pust = myTask.page+1;
					$_class('lstbtn').map(function($v,$i){ 
						$v.findTag('button').map(function($elem,$index){
							var gettip = $elem.getAttribute('collect');
							if($elem.innerHTML*1==pust){
								var gettip = $elem.getAttribute('collect');
								if(gettip){
									if(gettip=='true'){
										$_id('collect').setClass('active','add');
										$elem.setClass('tip','add');
										
									}else{
										$_id('collect').setClass('active','remove');
										$elem.setClass('tip','remove');
									}
								}else{
									$elem.setAttribute('collect','false');
								}
							}
						})
					})
				},
				//检查当前题目是否收藏
				check_collect_card:function(){
					$_class('lstbtn').map(function($v,$i){ 
						$v.findTag('button').map(function($elem,$index){
							var gettip = $elem.getAttribute('collect');
							var gettip = $elem.getAttribute('collect');
							if(gettip){
								if(gettip=='true'){
									$elem.setClass('col','add');
									
								}else{
									$elem.setClass('col','remove');
								}
							}else{
								$elem.setAttribute('collect','false');
							}
						})
					})
				},
				postar:function(id,type){
					if(type=='add'){
						var ajax = {
							url:'/Json/index.php?act=Exam.addcollectionTk&tkid='+id,
							data:''
						}
					}else if(type=='del'){
						var ajax = {
							url:'/Json/index.php?act=Exam.delcollectionTk&tkid='+id,
							data:''
						} 
					}
					$_post(ajax.url,ajax.data,res=>{
						console.log(res);
					})
				},
				//检测答题卡
				checkcard:function() {
					var index = myTask.page;
					var datatype =  myTask.answer[index].answer;
					var impkey = true;
					if(typeof datatype == 'string'){
						if(datatype==''){
							impkey=false;
						}
					}else{
						var len = datatype.length;
						datatype.map(function($vs,$i){
							if($vs==''){
								impkey=false;
							}
						})
					}
					myTask.linght(index,impkey);
				},
				//点亮
				linght:function(num,flag){ 
					var less = 0;
					$_id('dtimcard').findTag('button').map(function($elem,$index){
						if($index==num){
							if(flag==true){
								$elem.setClass('active','add');
							}else if(flag==false){
								$elem.setClass('active','remove');
							}
						}
						
						var getact = $elem.getAttribute('class');
						if(getact!=null){
							if(getact.indexOf('active')!=-1){
								less+=1;
							}
						}
					})
					myTask.leatim = myTask.total-less;
					$_id('tim_leave').innerHTML=myTask.leatim;
					$_class('tim_now').map(function($index){
						$index.innerHTML=less;
					})
				},
				list:function(id){
					var myTasks = $_id('myTask-list');
					var ajax = {
						url:'/Json/index.php?act=Class.taskDetaile&id='+id,
						data:''
					}
					$_post(ajax.url,ajax.data,res=>{
						$_class('myTask')[res.taskDetaile.task.taskstyle-1].style.display = 'block';
						console.log(res);
						if(res.taskDetaile.task.taskstyle==1){
							console.log('这个页有听力有图片，有视频！')
							var thistitle = res.taskDetaile.task.title;
							if(res.taskDetaile.task.content!=''){
								thistitle+='<p/><p>【作业详情】：'+res.taskDetaile.task.content+'</p>';
							}
							$_id('caiTitle').innerHTML = thistitle;
							if(res.taskDetaile.answer.contents!=''){
								$_class('contens')[0].innerHTML = res.taskDetaile.answer.contents;
							}
							
							$_id('miaoshu').innerHTML = res.taskDetaile.answer.contents;
							$_id('fujian').innerHTML = res.taskDetaile.answer.file.filename;
							
							var filearr = res.taskDetaile.task.file;
							var filetype = filearr.filename.substr(filearr.filename.length-3,filearr.filename.length);
							if(filetype=="mp3"){
								var data = '<audio src="'+filearr.filepath+'" controls="controls"></audio>';
								$_id('caiContent').innerHTML = data;
							}else{
								var data = '<video style="width:100%;height:200px" src="'+filearr.filePath+'" controls="controls"></video>';
								$_id('caiContent').innerHTML = data;
							}
						}else if(res.taskDetaile.task.taskstyle==3){
							$_id('title').innerHTML = res.taskDetaile.task.title;
							$_id('content').innerHTML = res.taskDetaile.task.content;
							console.log('这个页只看不操作！')
							
						}else if(res.taskDetaile.task.taskstyle==2){
							console.log('正版！')
							if(res.taskDetaile.paper.tmtype.length>0){
								if(res.taskDetaile.answer){
									myTask.savedata = res.taskDetaile.answer.answer;
								}
								
								var tmtype = res.taskDetaile.paper.tmtype;
								myTask.parperid=res.taskDetaile.task.paperid;
								myTask.putdata = tmtype;
								var timnum = 1;
								tmtype.map(function(_data){
									var GetData1 = myTask.creatTim(_data,_data.tk,timnum); 
									$_id('dtimcard').addChilds(GetData1);
									myTask.creatTimu.choose(_data,_data.tk.length,timnum); 
									timnum +=_data.tk.length;
								})
								myTask.total = timnum-1; 
								console.log('总量'+(myTask.total-1));
							}
							$_class('tim_total').map(function(em){
								em.innerHTML = timnum-1;
							})
							myTask.showTim();
							console.log(myTask.answer);
							myTask.repush(); 
						}
						
					},'json');
					
				},
				//反向解析
				repush:function(){
					var data=myTask.savedata;
					var BmTim = data.split("↓◎↑").slice(0,-1);
					var timnull = 0;
					var Tanswer = myTask.answer;				
					
					BmTim.map(function($bv,$bi){
						var BmznSm1 = $bv.split("↓↑")[1].slice(0,-3);
						BmznSm1 = BmznSm1.split("§№§");
						BmznSm1.map(function($v,$i){
							
							//答案
							var tm = $v.split("〓")[1];
							var tktype = Tanswer[timnull].tktype;
							if(tktype==1){
								var vl = myTask.arrOpt.indexOf(tm);
								$_id('Timulist').child()[timnull].findTag('li')[vl].setClass('active','add');
							}else if(tktype==2){ 
								var tm2 = tm.split('※').slice(0,-1);
								tm2.map(function($vv,$ii){
									$_id('Timulist').child()[timnull].findTag('input')[$ii].value = $vv;
								})
								
							}else if(tktype==3){
								$_id('Timulist').child()[timnull].findTag('li')[tm].setClass('active','add');
								
							}else if(tktype==4){ 
								$_id('Timulist').child()[timnull].findTag('textarea')[0].value = tm;
							}else if(tktype==5){
								var tm2 = tm.split('※').slice(0,-1);
								tm2.map(function($vv,$ii){
									$_id('Timulist').child()[timnull].findTag('textarea')[$ii].value = $vv;
								})
							
							}else if(tktype==6){
								var tm2 = tm.split(',');
								tm2.map(function($vv,$ii){
									var vl = myTask.arrOpt.indexOf($vv);
									$_id('Timulist').child()[timnull].findTag('li')[vl].setClass('active','add');
								})
							
							}
							timnull+=1;
						})
					})
				},
				//创建答题卡
				creatTim:function(data,len,timnum){
					var pushdata = '<li><p class="lstbox-title">'+data.title+'</p><div class="lstbtn clearfix" id="classkind">';
					len.map(function(val,i){
						pushdata 	+='<button tip="'+val.tip+'" collect="'+val.collect+'"onclick="myTask.gotos('+(timnum+i)+')">'+(i+timnum)+'</button>';
					})
					pushdata 	+='</li>';
					return pushdata;
				},
				//创建试题
				creatTimu:{
					choose:function(data,len,timnum){
						var tk = data.tk;
						tk.map(function(_data,n){
							if(_data.tktype==1){
								//单选题
								myTask.answer.push({tktype:_data.tktype,tkid:_data.tkid,answer:""});
								var GetData2 = myTask.creatTimu.timu1(_data,len,timnum+n);
							}else if(_data.tktype==2){
								//填空题
								myTask.answer.push({tktype:_data.tktype,tkid:_data.tkid,answer:[]});
								var GetData2 = myTask.creatTimu.timu2(_data,len,timnum+n);
							}else if(_data.tktype==3){
								//判断题
								myTask.answer.push({tktype:_data.tktype,tkid:_data.tkid,answer:""});
								var GetData2 = myTask.creatTimu.timu3(_data,len,timnum+n);
							}else if(_data.tktype==4){
								//问答题
								myTask.answer.push({tktype:_data.tktype,tkid:_data.tkid,answer:""});
								var GetData2 = myTask.creatTimu.timu4(_data,len,timnum+n);
							}else if(_data.tktype==5){
								//材料题
								myTask.answer.push({tktype:_data.tktype,tkid:_data.tkid,answer:[]});
								var GetData2 = myTask.creatTimu.timu5(_data,len,timnum+n);
							}else if(_data.tktype==6){
								//多选题
								myTask.answer.push({tktype:_data.tktype,tkid:_data.tkid,answer:''});
								var GetData2 = myTask.creatTimu.timu6(_data,len,timnum+n);

							}
							$_id('Timulist').addChilds(GetData2);
							
						})
					},
					//创建材料题
					creatcai:function(){
						
					},
					//选择题
					timu1:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="list-title blue-box_shadow clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						pushdata 	+='<ul class="myTask-option">';
						data.select.map(function($v,$i){
							pushdata 	+='	<li>'+myTask.arrOpt[$i]+'、'+$v.xx+'<input name="" type="hidden" value=""/></li>';
						})
						pushdata 	+='</ul></li>';
						return pushdata;
					},
					//填空题
					timu2:function(data,len,timnum){
						var inputs = myTask.creatTimu.FnAns(data.option,timnum);
						var pushdata = '<li tktype="'+data.tktype+'"><div class="list-title blue-box_shadow clearfix">';
						pushdata 	+='<p><span>'+timnum+'、</span>';
						inputs.map(function($v){
							pushdata 	+=$v;
						})
						pushdata 	+='</p></div></li>';
						return pushdata;
					},
					//过滤填空题
					FnAns:function(mmc,timnum){
						var Len = mmc.split('{#answer}').length-1;
						mmc= mmc.replace(/{#answer}/g,",#answer,");
						mmc= mmc.split(',');
						if(mmc[mmc.length-1]==''){mmc=mmc.slice(0,[mmc.length-1]);}
						var op=0;
						for(var i=0;i<mmc.length;i++){
						 	if(mmc[i]=="#answer"){
						 		
						 		myTask.answer[timnum-1].answer.push('');
								mmc[i]='<input name="pro2"  class="lvinp" type="text" value=""disabled="disabled"/>';
								op+=1;
							}
						}
						return mmc; 
					},
					//判断题
					timu3:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="list-title blue-box_shadow clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						pushdata 	+='<ul class="myTask-option">';
						pushdata 	+='	<li>B、错误</li>';
						pushdata 	+='	<li>A、正确</li>';
						pushdata 	+='</ul></li>';
						return pushdata;
					},
					//问答题
					timu4:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="list-title blue-box_shadow clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						pushdata 	+='<div class="myTask-textarea blue-box_shadow">';
						pushdata 	+='<textarea name="" placeholder="请输入答题内容~" rows="" cols=""></textarea></div></li>';
						return pushdata;
					}, 
					//材料题
					timu5:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="blue-box_shadow timu5"><div class="list-title nobt clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						data.smallanser.map(function($v,$i){
							pushdata 	+='<div class="timu5li">'+($i+1)+'、'+$v+'</div>';
						})
						pushdata 	+='</div>';
						data.smallanser.map(function($v,$i){
							pushdata 	+='<div class="myTask-textarea blue-box_shadow"><textarea name="" placeholder="请输入答题内容~" rows="" cols=""></textarea></div>';
							myTask.answer[timnum-1].answer.push("")
						})
						pushdata 	+='</li>';
						return pushdata;
					},
					//多选题
					timu6:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="list-title blue-box_shadow clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						pushdata 	+='<ul class="myTask-option">';
						data.select.map(function($v,$i){
							pushdata 	+='	<li  act="false">'+myTask.arrOpt[$i]+'、'+$v.xx+'</li>';
						})
						pushdata 	+='</ul></li>';
						return pushdata;
					},
					//文件题
					timu7:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="list-title blue-box_shadow clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						pushdata 	+='<div class="myTask-textarea blue-box_shadow"><textarea name="" placeholder="请输入作业描述~" rows="" cols=""> 康和克里斯阿莎是 上岛咖啡哈克斯交电话费按时接电话阿是的划分来 </textarea>';
						pushdata 	+='</div><button class="x-btnBlueL upload">上传作业</button></li>';
						return pushdata;
					},
				},
			})
			
			myTask.list(trueid);
			
		</script>
	</body>

</html>
