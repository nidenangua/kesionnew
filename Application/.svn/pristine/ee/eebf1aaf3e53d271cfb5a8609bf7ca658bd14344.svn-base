<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>资讯管理</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
   	<link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<style type="text/css">
	.getNewEditEdit-title{font-size: .7rem;color: #888;line-height: 1.8rem;}
	.postTask { width: 100%; height: 100%; }
	#contList{margin:0.75rem;}
	#contList li{ margin-bottom: .2rem;position: relative;}
	.getNewEditEdit-input{border: 1px solid #dcdfe6;background: #FFF;padding: .2rem;}
	.getNewEditEdit-input>input{height:1.5rem;width: 100%;border: none;font-size:14px;}
	.getNewEditEdit-inputs{display: inherit;resize: none;background: #FFF;border: solid 1px #dcdfe6;padding: .2rem;overflow: auto;}
	.getNewEditEdit-input>textarea{height:3rem;display: inherit;resize: none;border:none;width: 100%;font-size: 14px;}
	.getNewEditEdit-inputs img{max-width: 100%;display: block;height: auto;margin: auto;}
	.getNewEditEdit-inputs p{ font-size: 14px!important; }
	.getNewEditEdit-inputs{line-height: 20px;}
	.getNewEditEdit-btn{margin: .5rem;}
	.getNewEditEdit-btn div{background: inherit;border-radius: 0px;width:100%;line-height: 2.1rem;height: 2.1rem;position: relative;}
	.getNewEditEdit-btn input{position: absolute;opacity: 0;top: 0px;left: 0px;height: 100%;width: 100%;}
	.getNewEditEdit-thum{padding-left:0;position: relative;height: 3.8rem;overflow: hidden;}
	.getNewEditEdit-thum>img{position: absolute;right: 0px;top: 0px;width: 3rem; height: 2rem;}
	.getNewEditEdit-thum>div{background: inherit;border-radius: 0px;width:100%;height: 100%;position: absolute;bottom: 0px;overflow: hidden;z-index: 99;border: 0;}
	.getNewEditEdit-thum>div>input{position: absolute;top: 0px;left: 0px;height: 100%; width: 100%;opacity: 0;}
	.x-btnOrag {border: solid 1px #37a7ed;background: #37a7ed;}
	.getNewEditEdit-inputs p {line-height: 1.5rem}
	.contlist-po {padding-left: 4rem;padding-bottom: 0.5rem;border-bottom: 1px solid #ddd;}
	.contlist-po .getNewEditEdit-title {position: absolute;left: 0;}
	.contlist-po .getNewEditEdit-input {border: 0;}
	.contlist-po .getNewEditEdit-input input {text-align: right!important;}
	.contlist-po .getNewEditEdit-thum {height: 2rem;}
	.getNewEditEdit-inputs:focus {border-color:#dcdfe6;outline: none;}
	.getNewEditEdit-input  input::-webkit-input-placeholder, textarea::-webkit-input-placeholder { color: #ddd; font-size: 0.7rem; } 
	.number-box { position: absolute; right: 0;top: 0.4rem; font-size: 0.7rem;color: #888;}
	 #mask{position: fixed;width: 100%;height: 100vh; background: rgba(0,0,0,.3);top: 0;left: 0;z-index: 55; display: none;}
	 #confirm { position: fixed; top: 20%;left: 7.5%;overflow: hidden; width: 85%;border-radius: 3px; box-shadow: 0 0px 6px rgba(25,25,25,.4);
    background: #fff;z-index: 150;display: none;height: 8rem;box-sizing: border-box;}
	.maskAdd {display: block!important;}
	.getNew-btn-box {position: absolute;bottom: 0;height:40px;line-height: 40px;text-align: center;width: 100%; }
	.getNew-btn-box .getNew-btn {display:inline-block;height: 40px;border: 0;background: none;border-top:1px solid #eee;width:100%}
	.getNew-content {min-height: 4rem;margin: 1rem;border: 1px solid #eee;width:87%;box-sizing: border-box;padding: 0.5rem;}
	
</style>
 
<body class="getNewEdit-wrap" style="background: #fff">
	<page class="getNewEdit-page" id="page2">
		<ul id="contList">
			<li class="contlist-po">
				<div class="getNewEditEdit-title">资讯封面</div>
				<div class="getNewEditEdit-thum" >
					<input type="hidden" name="defaultpic" id="defaultpic" value="<?php echo UOOT ?>Public/uploads/common/timg.jpg"/>
					<img id="fengmian" src="<?php echo UOOT ?>/Public/app/images/classIcon/cover_default.png" alt="" />
					<div class="r-btnBlue">
						<input type="file" onchange="getNewEdit.changefen(this)"  name="" id="imgss" value="" />
					</div>
				</div>
			</li> 
			
			<li class="contlist-po">
				<div class="getNewEditEdit-title">资讯标题</div>
				<div class="getNewEditEdit-input" style="padding-right:2rem ;">
					<input type="text"  id="title" placeholder="请输入资讯标题"  onkeyup="getNewEdit.limit()"/>
					<div class="number-box"><span id="number1">0</span>/30</div>
				</div>
				
			</li>
			
			<li>
				<div class="getNewEditEdit-title">资讯摘要</div>
				<div class="getNewEditEdit-input">
					<textarea id="abstract" placeholder="请输入资讯摘要"></textarea>
				</div>
				
			</li>
			
			<li>
				<div class="getNewEditEdit-title">资讯内容</div>
				<div class="getNewEditEdit-inputs" contenteditable="true" id="content" onfocus="getNewEdit.setFocus()" onblur="getNewEdit.loseFocus()"  ><span style="color:#ddd">请输入资讯内容</span></div>
			</li>
			
			<li>
				<div class="getNewEditEdit-btn clearfix">
					<div class="r-btnBlue">增加图片
					<input type="file" name=""  onchange="getNewEdit.addtimg(this)" id="" value="" />
					</div>
				</div> 	
			</li>

			
			<li>
				<div class="getNewEditEdit-btn clearfix">
					<div onclick="getNewEdit.newshow()"  class="r-btnBlue"> 增加内容</div>
					
				</div> 	
				
				
			</li>

			<!--<li>
				<div class="getNewEditEdit-title">增加内容</div>
				<div class="getNewEditEdit-inputs" contenteditable="true" id="contentInside"></div>
			</li>-->
		
			
		
			
		</ul>
		<div class="mask" id="mask" onclick="getNewEdit.hideshow()"></div>
		<div class="confirm"  id="confirm" onclick="">
			<textarea class="getNew-content" id="contentInside" placeholder="请输入添加的内容"></textarea>
			<div class="getNew-btn-box">
				<button class="getNew-btn" onclick="getNewEdit.addtxt(this)">添加</button>
			</div>
		</div>
		
		<footer class="footer">
			<button style="border-radius: 0rem;" class="x-btnOrag postTask" onclick="getNewEdit.postnew()">确认</button>
		</footer>
	</page>	 
	<div id="loadings" class="loadings"></div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	var getNewEdit = new Object({
	staus: '<?php echo $id;?>',
	imgchange: 0,
	list: function() {
		if (getNewEdit.staus == '0') {
			//添加状态


		} else {
			//编辑状态
			var ajax = {
				url: '/Json/index.php?act=Microportal.newsDetail',
				data: {
					id: getNewEdit.staus
				}
			};
			$_post(ajax.url, ajax.data, function (res) {
				console.log(res);
				$_id('fengmian').src = res.newsDetail.defaultpic;
				$_id('defaultpic').value = res.newsDetail.defaultpic;
				$_id('content').innerHTML = res.newsDetail.content;
				$_id('abstract').value = res.newsDetail.abstract;
				$_id('title').value = res.newsDetail.title;
			}, 'json');
		}
		
		
		
		
	},
	addtimg: function (target) {
	
		var url = '/Json/index.php?act=Microportal.MinUpload';
		var imgurl = target.files[0];
		if(target.files.length==0)return false;
		$_id('loadings').style.display = 'block';	
		var _form = new FormData();
		_form.append('file', imgurl);
		var ajax = new XMLHttpRequest();
		ajax.open('post', url);
		ajax.send(_form);
		ajax.onreadystatechange = function () {
			$_id('loadings').style.display = 'none';
			if (ajax.readyState == 4 && ajax.status == 200) {
			
				var src = ajax.responseText;
				src = JSON.parse(src);
				$_id('content').addChilds('<img src ="' + src.MinUpload.info + '" >');
				
			}
		};
	},
	addtxt: function (target) {
		
	 var  txtContent =	$_id('contentInside').value;
	console.log(txtContent)
	 $_id('content').addChilds('<p class="content-p">'+txtContent +'</p>');
	 $_id('mask').setAttribute("class",'')
	 $_id('confirm').setAttribute("class",'');

	},



	changefen: function (target) {
		$_id('loadings').style.display = 'block';
		getNewEdit.imgchange = 1;
		var url = '/Json/index.php?act=Microportal.MinUpload';
		var imgurl = target.files[0];
		var _form = new FormData();
		_form.append('file', imgurl);
		var ajax = new XMLHttpRequest();
		ajax.open('post', url);
		ajax.send(_form);
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				var src = ajax.responseText;
				src = JSON.parse(src);
				$_id('defaultpic').value = src.MinUpload.info;
				$_id('loadings').style.display = 'none';
				$_id('fengmian').src = src.MinUpload.info;
			}
		};
	},
	postnew: function () {
		var url = '/Json/index.php?act=Microportal.saveNews';
		var _form = new FormData();
		_form.append('fengmian', $_id('defaultpic').value);
		_form.append('content', $_id('content').innerHTML);
		_form.append('abstract', $_id('abstract').value);
		_form.append('title', $_id('title').value);
		_form.append('id', getNewEdit.staus);
		var ajax = new XMLHttpRequest();
		ajax.open('post', url);
		ajax.send(_form);
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				console.log(ajax.responseText);
				history.go(-1);
			}
		};
	},
	setFocus:function (){
		console.log($_id('content').innerHTML)
	if($_id('content').innerHTML =='<span style="color:#ddd">请输入资讯内容</span>') {
		
			$_id('content').innerHTML = '';
		}
	  
	},
	loseFocus:function (){
	if($_id('content').innerHTML == '') {
			$_id('content').innerHTML = '<span style="color:#ddd">请输入资讯内容</span>';
		}
	  
	},	 
	 limit:function(){
		 var _sum = 30;
		 
	    $_id('title').setAttribute("maxlength",_sum);
	  	$_id('number1').innerHTML= $_id('title').value.length
	
	},
	newshow:function(){
		
	
		$_id('mask').setAttribute("class",'maskAdd')
		$_id('confirm').setAttribute("class",'maskAdd');
		
	},
	hideshow:function(){
		
	
		$_id('mask').setAttribute("class",'')
		$_id('confirm').setAttribute("class",'');
		
	}	

});
getNewEdit.list();
	</script>
</body>
</html>