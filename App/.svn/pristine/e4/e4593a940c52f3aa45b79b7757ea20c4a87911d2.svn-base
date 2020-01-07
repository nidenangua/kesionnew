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
.filedoc{height: 2rem; display: inline-block; margin: 1rem auto; padding: 0rem .6rem; border: 1px solid #e5e5e5; line-height: 2rem; border-radius: .2rem;}
.filedoc img{width: 1rem; margin-top: .5rem; float: left;}
.list-title>button{}
.nobt{margin: 0rem;}
.myTask-option>li{position: relative;padding: .6rem .5rem;background: #FFF;border-radius: .3rem;margin-bottom: .3rem;box-shadow: 0 2px 14px RGB(225, 242, 253);}
.myTask-option>li.active{background: #FFE57B;}
.lvinp{border-top: none;border-left: none;border-right: none;border-bottom: 1px solid #43B747;width:4rem;}
.redinp{border-top: none;border-left: none;border-right: none;border-bottom: 1px solid #E64A3B;width:4rem;text-decoration: line-through;color:#E64A3B;}
.myTask-textarea{padding: .5rem;background: #FFF;border-radius: .3rem;margin-bottom: 1rem;}
.myTask-textarea>.contens{width: 100%;height: 6rem;border: none;resize: none;}
.myTask-textarea>textarea{width: 100%;height: 6rem;border: none;resize: none;}
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
</style>
	<body style="background: #F6F5F0;">
		<div class="myTask">
			<form action=" " method="post" id="upwork" enctype="multipart/form-data">
				
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
							<!--<button class="r-btnPick" id="downsc"> <a href="" class="orange" id="uphref">下载作业材料</a></button>-->
							<div style="margin-top: .5rem;">请在电脑端下载材料</div>
						</div>
						<div class="myTask-textarea blue-box_shadow">
							<textarea class="contens" name="" placeholder="请输入作业描述~" id="miaoshu" rows="" cols=""></textarea>
						</div>		
						
						
						<div id="filename" style="text-align: center;"></div>
						<!--<div class="x-btnBlueL upload">
							上传作业
							<input type="file" name="fileid" id="fileid" value="" onchange="myTask.uploadinof(this)"  style="opacity: 0;"/>
						</div>-->
						<div style="text-align: center;">支持格式zip，建议在电脑端上传</div>
					</li>
					
				</ul>
			</div>

			<!--<footer class="footer">
				<button type="button" class="x-btnYell postTask" onclick="myTask.postwork()">提交作业</button>
			</footer>-->


			</form>
		</div>
		
		
		
		<div class="myTask">
			
			<div class="myTask-page">
				
				
				<div class="myTask-mypress clearfix">
					<span>进度：<em class="tim_now">0</em> / <em class="tim_total">0</em></span>
					<span>用时：<em id="tim_time">00:00:00</em></span>
				</div>
				
				
				<div class="myTask-type" id="now_type"></div>
				
				<ul class="myTask-list" id="Timulist"></ul>
				<div class="myTask-fiex">
					<div class="myTask-tim blue-box_shadow" id="tim" onClick="myTask.maskopen()">
						<span id="tim_leave">0</span>
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
				<div class="mTask-sen" id="mTasksen" style="margin-right: -80r%;">
					<div class="screelst-title">进度：<span class="red tim_now">0</span> / <span class="tim_total">0</span></div>
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
			
			<footer class="footer">
				<div class="clearfix">
					<div class="zui-col-6">
						
						<div class="footer-foticon" id="prev">
							<a href="javascript:;" onClick="myTask.backlist()">
							返回作业列表
							</a>
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
				tkids:'<?php echo $id; ?>',
				parperid:'',
				isFather:0,
				isnull:false,
				arrOpt:['A','B','C','D','E','F','G','H','I'],
				slideTab:function(target,id){
					target.setClass('active','add').getSiblings().setClass('active','remove');
					$_id('myList-list').innerHTML='';
					myList.paystatus = id;
					myList.page = 0;
					myList.list();
				},
				uploadinof:function(e){
					var exe=e.value.replace(/.+\./,"");   //正则表达式获取后缀
					var name=e.value.replace(/^.+?\\([^\\]+?)(\.[^\.\\]*?)?$/gi,"$1");//name
					$_id('filename').innerHTML = name+'.'+exe;
				},
				postwork:function(){
					var _form = new FormData();
                    _form.append('file', $_id('fileid').files[0]);
                    _form.append('taskid', myTask.tkids);
                    _form.append('contents',$_id('miaoshu').value);
                    
                    console.log(_form);
				 	var ajax = new XMLHttpRequest();
			        ajax.open('post','/Json/index.php?act=Class.submitjob2');
			        ajax.send(_form);
			        ajax.onreadystatechange = function () {
			            if (ajax.readyState==4&&ajax.status==200) {
			                if(ajax.responseText.submitjob2.result=="success"){
			                	alert('提交成功！');
			                	window.location.href='https://ks.kesion.com/h5market/myWork';
			                	
			                }
			              
			            }
			        }
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
							$_id('prev').innerHTML='<a  href="javascript:;" onclick="myTask.backlist()"> 返回作业列表 </a>';
							$_id('next').innerHTML='<a  href="javascript:;" onclick="myTask.postform()">提交作业</a>';
							
						}else{
							$_id('prev').innerHTML='<a  href="javascript:;" onclick="myTask.backlist()"> 返回作业列表 </a>';
							$_id('next').innerHTML='<a  href="javascript:;" onclick="myTask.nextTim()"> 下一题 </a>';	
						}
					}else{
						if(myTask.page!=myTask.total-1){ 
							$_id('prev').innerHTML='<a  href="javascript:;" onclick="myTask.prevTim()">上一题</a>';
							$_id('next').innerHTML='<a  href="javascript:;" onclick="myTask.nextTim()"> 下一题 </a>';
						}else if(myTask.page=myTask.total-1){
							$_id('prev').innerHTML='<a  href="javascript:;" onclick="myTask.prevTim()">上一题</a>';	
							$_id('next').innerHTML='<a  href="javascript:;" onclick="myTask.postform()">提交作业</a>';
						}
						
						 
					}
					myTask.check_now_put();
					myTask.check_collect_put();
					
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
					if(myTask.isnull==false){
						var isnull = confirm('是否放弃本次练习？');
						if(isnull==true){
							history.go(-1); 
						}
					}
				},
				postform:function(){
					var Equal='';
					var index = 0;
					for(var m=0;m<myTask.putdata.length;m++){
						var AnswerAll = myTask.answer;//提交数据
						var Emio = myTask.putdata;//原始数据
						var len = myTask.putdata[m].tk.length;//每个节点长度
						var typeId =Emio[m].typeId;//每个小题id
						Equal+=typeId+"↓↑";
						for(var i = 0; i<len;i++){
							var tktype = AnswerAll[index+i].tktype;
							var tkid= AnswerAll[index+i].tkid;
							Equal+=tkid+"〓";
							if(tktype==1){
								Equal+=AnswerAll[index+i].answer;		
							}else if(tktype==2||tktype==5){
								var Alen = AnswerAll[index+i].answer;
								for(var y=0;y<Alen.length;y++){
									Equal+=Alen[y]+"※";
								}
							}else if(tktype==3){
								Equal+=AnswerAll[index+i].answer;		 
							}else if(tktype==4){
								Equal+=AnswerAll[index+i].answer;	
							}else if(tktype==6){
								Equal+=AnswerAll[index+i].answer;	
							}
							Equal+="§№§";
						}
						index+=len;
						
						Equal+="↓◎↑";
					
					}
					var ajax={
						url:'&taskid='+myTask.tkids+'&answer='+Equal+'&tkids='+myTask.parperid+'&time='+$_id('tim_time').innerHTML,
					}
					
					if($_id('tim_leave').innerHTML*1==0){
						myTask.ajaxpost(ajax.url);
					}else{
						var smtip = confirm('您还有题目未完成，是否提交？');
						if(smtip==true){
							myTask.ajaxpost(ajax.url);
						}
					}
					
					
					
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
									}else{
										$_id('collect').setClass('active','remove');
									}
								}else{
									$elem.setAttribute('collect','false');
								}
							}
						})
					})
				},
				//检查当前题目是否收藏
				check_collect_put:function(){
					$_id('collect').setClass('active','remove');
					var pust = myTask.press;
					$_class('lstbtn').map(function($v,$i){ 
						$v.findTag('button').map(function($elem,$index){
							var gettip = $elem.getAttribute('collect');
							if($elem.innerHTML*1==pust){
								var gettip = $elem.getAttribute('collect');
								if(gettip){
									if(gettip=='true'){
										$_id('collect').setClass('active','add');
									}else{
										$_id('collect').setClass('active','remove');
									}
								}else{
									$elem.setAttribute('collect','false');
								}
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
				//单选题
				opt1:function(target){
					target.setClass('active','add').getSiblings().setClass('active','remove');
					myTask.answer[(myTask.page)].answer = myTask.arrOpt[target.index()]; 
					myTask.checkcard();
				},
				//填空题
				opt2:function(target,num){
					myTask.answer[(myTask.page)].answer[num]=target.value;
					myTask.checkcard();
				},
				//问答题
				opt3:function(target){
					myTask.answer[(myTask.page)].answer=target.value;
					myTask.checkcard();
				},
				//多选题
				opt4:function(target,num){
					var act = target.getAttribute('act');
					var anlen = myTask.answer[(myTask.page)].answer.length;
					//myTask.answer[(myTask.press-1)].answer.splice(0,anlen);
					if(act=='false'){
						target.setClass('active','add');
						target.setAttribute('act','true');
					}else{
						target.setClass('active','remove');
						target.setAttribute('act','false');
					}
					var father = target.parentNode;
					var vl = ''
					father.findTag('li').map(function($v,$i){
						var getact = $v.getAttribute('class');
						if(getact=="active"){
							vl+=myTask.arrOpt[$i]+',';
						}
					})  
					myTask.answer[(myTask.page)].answer = vl.substring(0,vl.length-1);
					myTask.checkcard();
				},
					//单选题
				opt5:function(target){
					target.setClass('active','add').getSiblings().setClass('active','remove');
					myTask.answer[(myTask.page)].answer =""+target.index()+""; 
					console.log(myTask.answer);
					myTask.checkcard();
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
						
						if(res.taskDetaile.task.taskstyle==1){
							console.log('这个页有听力有图片，有视频！')
							var thistitle = res.taskDetaile.task.title;
							if(res.taskDetaile.task.content!=''){
								thistitle+='<p/><p>【作业详情】：'+res.taskDetaile.task.content+'</p>';
							}
							$_id('caiTitle').innerHTML = thistitle;
							var filearr = res.taskDetaile.file;
							filearr.map(function($v,$i){
								var filetype = $v.filename.substr($v.filename.length-3,$v.filename.length);
								if(filetype=="mp3"){
									data = '<audio src="'+$v.filepath+'" controls="controls"></audio>';
									$_id('caiContent').innerHTML = data;
								}else if(filetype=='mp4||wmv||avi||flv||mkv'){
									data = '<video style="width:100%;height:200px" src="'+$v.filepath+'" controls="controls"></video>';
									$_id('caiContent').innerHTML = data;
								}else{
									data = '<div class="filedoc"><img src="/Public/uploads/common/DOC.png"/>'+$v.filename+'</div>';
									$_id('caiContent').innerHTML = data;
								}
								$_id('uphref').setAttribute('href',$v.filepath);
							})
						}else if(res.taskDetaile.task.taskstyle==3){
							$_id('title').innerHTML = res.taskDetaile.task.title;
							$_id('content').innerHTML = res.taskDetaile.task.content;
							console.log('这个页只看不操作！');
							
						}else if(res.taskDetaile.task.taskstyle==2){
							if(res.taskDetaile.paper.tmtype.length>0){
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
								var now = $_class('tim_now')[0].innerHTML*1;
								$_id('tim_leave').innerHTML = (timnum-1)-now;
								myTask.total = timnum-1; 
								console.log('总量'+(myTask.total-1));
								myTask.showTim();
								$_class('tim_total').map(function(em){
									em.innerHTML = timnum-1;
								})
								countdown(0,'tim_time')
							}else{
								$_class('myTask').map(function($this){
									
									$_id('Timulist').innerHTML = '<div class="nodata"></div>';
									$_class('myTask-note')[0].style.display = 'none';
								})
								$_class('footer').map(function($this){
									$this.innerHTML = '<button class="x-btnYell postTask" onclick="history.go(-1)">返回作业列表</button>';
								})
								
							}
							
							
							console.log("对照"+myTask.answer);
						}
						
					},'json');
					
				},
				//创建答题卡
				creatTim:function(data,len,timnum){
					var pushdata = '<li><p class="lstbox-title">'+data.title+'</p><div class="lstbtn clearfix" id="classkind">';
					len.map(function(val,i){
						pushdata 	+='<button tip="'+val.tip+'" collect="'+val.collect+'" onclick="myTask.gotos('+(i+timnum)+')">'+(i+timnum)+'</button>';
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
							pushdata 	+='	<li onclick="myTask.opt1(this)">'+myTask.arrOpt[$i]+'、'+$v.xx+'<input name="" type="hidden" value=""/></li>';
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
								mmc[i]='<input name="pro2" placeholder=" 点击填写" onkeyup="myTask.opt2(this,'+op+')" class="lvinp" type="text" value=""/>';
								op+=1;
							}
						}
						return mmc; 
					},
					//判断题
					timu3:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="list-title blue-box_shadow clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						pushdata 	+='<ul class="myTask-option">';
						pushdata 	+='<li onclick="myTask.opt5(this)">A、错误</li>';
						pushdata 	+='<li onclick="myTask.opt5(this)">B、正确</li>';
						pushdata 	+='</ul></li>';
						return pushdata;
					},
					//问答题
					timu4:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="list-title blue-box_shadow clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						pushdata 	+='<div class="myTask-textarea blue-box_shadow">';
						pushdata 	+='<textarea name="" onkeyup="myTask.opt3(this)" placeholder="请输入答题内容~" rows="" cols=""></textarea></div></li>';
						return pushdata;
					}, 
					//材料题
					timu5:function(data,len,timnum){
						var pushdata = '<li tktype="'+data.tktype+'"><div class="blue-box_shadow timu5"><div class="list-title nobt clearfix"><span>'+(timnum)+'、</span>'+data.option+'</div>';
						data.smalloption.map(function($v,$i){
							pushdata 	+='<div class="timu5li">'+($i+1)+'、'+$v+'</div>';
						})
						pushdata 	+='</div>';
						data.smallanser.map(function($v,$i){
							pushdata 	+='<div class="myTask-textarea blue-box_shadow"><textarea name="" onkeyup="myTask.opt2(this,'+$i+')" placeholder="请输入答题内容~" rows="" cols=""></textarea></div>';
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
							pushdata 	+='	<li onclick="myTask.opt4(this,'+$i+')" act="false">'+myTask.arrOpt[$i]+'、'+$v.xx+'</li>';
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
			myTask.isFather='<?php echo $this->isp;?>';
			var intDiff='';
			function countdown(intDiff,div) {
				window.setInterval(function () {
					intDiff = parseInt(intDiff)
					var day = 0,
					  hour = 0,
					  minute = 0,
					  second = 0; //时间默认值
					if (intDiff > 0) {
					 // day = Math.floor(intDiff / (60 * 60 * 24));
					  hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
					  minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
					  second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
					}
					if (minute <= 9) minute = '0' + minute;
					if (second <= 9) second = '0' + second;
					$_id(div).innerHTML=hour+ ':'+minute + ':'+second;
					if(intDiff<0){
					/*answer();*/
					}   
					TsTime =intDiff++;
				
				}, 1000);
			}
			
		</script>
	</body>

</html>
