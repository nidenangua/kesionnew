<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<style type="text/css">
		.url-box{
			height: 130px;
			border: 1px solid #d6dadf;
			padding: 20px 100px 20px 100px;

		}
        .ks-top-search .sc-text{
        	float: none;
        }
        .button-box{
        	border-top: 1px solid #d6dadf;
            margin-top: 50px;
            height: 70px;
        }
        .res-box{
        	font-size: 17px;
		    padding: 10px;
		    height: 200px;
		    border-top: 1px solid #b4b4b4;
		    background: #cccccc42;
        }
	</style>
</head>
<body>
	<div style="padding: 99px;">
		<div class="ibox-title">
			<div class="clearfix" style="text-align: center;">
				<h3 class="" style="">&nbsp;&nbsp;接口测试工具</h3>
			</div>
		</div>
		<div class="url-box" id="url" style="width: 60%;margin-left: 20%;font-size: 20px;" contenteditable>
			
		</div>
		<div style="width: 60%;margin-left: 20%;margin-top: 48px;border: 1px solid #d6dadf;">
			<table class="ks-table">
				<thead>
					<tr>
						<th>参数</th>
					    <th>值</th>
					    <th></th>
					</tr>
				</thead>
				<tbody id="table-body" >
					<tr class="ks-top-search">
						<td><input type="text" class="sc-text parameter" name=""></td>
						<td><input type="text" class="sc-text number" name=""></td>
						<td><a class="deepBlue ok-icon ok-pe2" onclick="delElement(this)" title="删除"></a></td>
					</tr>
				</tbody>
			</table>
			<div class="button-box">
				<button class="btn mt10 btn-default fr" onclick="test()">保存</button>
				<button class="btn mt10 btn-default fr" onclick="addelement()">增加参数</button>
				
			</div>
			<div class="res-box" id="content">
				
			</div>
		</div>
	</div>
<script type="text/javascript">
	function $post(_url,data,fn,type){
		var xhr = new XMLHttpRequest();
		/**
		 * @method open
		 * @for xhr
		 * @param {String}  [请求类型，get or post]
		 * @param {String}  [请求url]
		 * @param {Boolean} [是否异步请求] 
		 */
		xhr.open("POST", _url, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // 添加http头，发送信息至服务器时内容编码类型
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {
				switch (type){
					case "json":
						typeof fn === 'function' && fn.call(this, $json(xhr.responseText,'parse'))
						break;
					default:
						typeof fn === 'function' &&  fn.call(this, xhr.responseText)
						break;
				}
			}
		};
		
		if(typeof data === 'object'){
			data = $json(data,'stringify') 
		};
		xhr.send(data)

	};

	function $json(data,type){
		
		switch (type){
			case "parse":
				return JSON.parse(data)
				break;
			case "stringify":
				return JSON.stringify(data)
				break;
		}
		
	};
	function addelement(){
        var eltment = '<tr class="ks-top-search">\
						<td><input type="text" class="sc-text parameter" name=""></td>\
						<td><input type="text" class="sc-text number" name=""></td>\
						<td><a class="deepBlue ok-icon ok-pe2" onclick="delElement(this)" title="删除"></a></td>\
					</tr>';
		$("#table-body").append(eltment);
	};
	function delElement(target){
		$(target).parent().parent().remove();
	}
	function test(){
		var url = $("#url").text();
		// console.log(url)
        var newdata ={};
        var _arr =  document.querySelector('#table-body').querySelectorAll('tr');
        var str='{';
        for(var i=0;i<_arr.length;i++){
        	var par = $(_arr[i]).find('td .parameter').val()
        	var num =$(_arr[i]).find('td .number').val();
        	if(_arr.length==(i+1)){
        		str += '"'+par + '":'+num;
        	}else{
                str += '"'+par + '":'+num+',';
        	}
        	
        }
        str =str+'}';
        // var obj =eval ("("+str+")");

        // console.log(obj);
        $post(url,str,function(data){
             $("#content").text(data)
        },'json')
	}
	function test3(){
		var newdata ={};
		//测试注册
		// newdata.sitename='袋鼠测试';
		// newdata.usertype='2';
		// newdata.username='15260780292';
		// newdata.password='123456';
		// newdata.logo='https://bj.bcebos.com/kesion/school/2/201801/5a55901dc7088.png?authorization=bce-auth-v1%2F134e7d2d4c4e433880ec6b5053439f65%2F2018-01-10T04%3A01%3A34Z%2F-1%2F%2F7354ea53e2bbde4ed44b15af5aa72bcb9392daf3ceae7ffd834210f458a5c127';
		// newdata.descript='得更快了电脑观看了电视剧管理会计洛凯股份估计快了的数据管理开始对接';
		
		//测试获取token
		newdata.appid ="1c8ac1f3011e514c";
		// newdata.secret='fa9cf2ac3a83a9785506bf5238f3cc3a';
         newdata.token = "065d94eaabbb14fd";
		// 测试添加互动课堂
		// newdata.classlevel =1;
		// newdata.title ='请求示例';
		// newdata.chargetype =1;
		// newdata.price ='23';
		// newdata.intro ='这是简介部分';
		// newdata.defaultpic ='https://bj.bcebos.com/kesion/school/2/201801/5a55901dc7088.png?authorization=bce-auth-v1%2F134e7d2d4c4e433880ec6b5053439f65%2F2018-01-10T04%3A01%3A34Z%2F-1%2F%2F7354ea53e2bbde4ed44b15af5aa72bcb9392daf3ceae7ffd834210f458a5c127';
		// newdata.studentcount =10;
		// newdata.name ='测试老师';
		// newdata.username ='123456';
		// newdata.headpic ='https://bj.bcebos.com/kesion/school/2/201801/5a55901dc7088.png?authorization=bce-auth-v1%2F134e7d2d4c4e433880ec6b5053439f65%2F2018-01-10T04%3A01%3A34Z%2F-1%2F%2F7354ea53e2bbde4ed44b15af5aa72bcb9392daf3ceae7ffd834210f458a5c127';
		// newdata.teacherid =524;
		
		//获取班级列表
		// newdata.wxid=1404;
		// newdata.maxperpage=10;
		// newdata.p=1;
		// newdata.keyword='';
        
        // newdata.title = '测试课程添加';
        // newdata.price = '0.01';
        // newdata.chargetype = '1';
        // newdata.defaultpic = '';
        // newdata.intro = '这是间接';
        // newdata.price_market = '21';
        // newdata.begindate = '2018-01-02 12:54:45';
        // newdata.livehours = 2;
        // newdata.teacherid = '5';
        // newdata.livetype = 1;
        // 修改密码
        // newdata.username = 15260780292;
        // newdata.passWord = '123456';
        // newdata.newPassword = '123456';
        // 找回密码系列
        // newdata.phone = 15260780292;
        // newdata.code = 351889;
        // newdata.passWord = '123456';
        // 
        // 添加课程系列
        // 
  //       newdata.title = 'api测试修改';
  //       newdata.begindate = '2018-09-10 15:46:45';
  //       newdata.chargetype =1 ;
  //       newdata.defaultpic =''; 
  //       newdata.price = 0.01;
  //       newdata.livehours = 1.5;
		// newdata.intro ='这是简介456456啊' ;
  //       newdata.price_market =20;
           newdata.wxid =1404;
        // newdata.classid = 12293;
  //       newdata.teacherid =1578;
  //       newdata.id =7854;
           newdata.courseid = 7854;
           newdata.maxperpage=10;
           newdata.p=1;

        console.log(newdata);
        $post("http://ks.ketangjie.cn/Json/index.php?act=Api.courseLive",newdata,function(data){
        	console.log(data)
        },'json')
	}
</script>
</body>
</html>