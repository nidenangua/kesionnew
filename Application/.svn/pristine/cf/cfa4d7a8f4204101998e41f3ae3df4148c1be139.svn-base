<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<titie>签到编辑</titie>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/common/css/mobileSelect.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
<style type="text/css">
	.blue{color:#37A7ED;}
	.orange{color:#F28550;}
	.red{color:#E64A3B;}
	.purple{color:#D05DF4;}
	.mask{position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;background: #000000;opacity:.4;}
	.signinedit-alert{position:fixed;top: 0px;left: 0px;right: 0px;bottom: 0px;}
	.signinedit-classlst{background: #FFF;}
	.signinedit-classlst li:first-child{border-bottom: solid 1px #EEEEEE;margin:0rem;padding:0rem 0.5rem;}
	.signinedit-classlst li{border-bottom: solid 1px #EEEEEE;margin:0rem 0.5rem;}
	
	.signinedit-lstbox{position: relative;padding:0.5rem 0rem;}
	.signinedit-title{font-size: 0.8rem;}
	.signinedit-title .subonline{float: right; font-size: 0.8rem;color: #888;}
	.signinedit-title>span{display: block; width: 0.9rem; height: 0.9rem; text-align: center; line-height: 0.9rem; margin-top: 0.2rem; font-size: 0.6rem; float: left;margin-right:0.2rem;}
	.signinedit-title>span.blue{background:#37A7ED;color: #FFF;}
	.signinedit-title .left{float: left;font-size: .7rem;color: #888888;}
	.signinedit-title .right{float: right;font-size: .7rem}
	.signinedit-title .right .classkind{line-height: 2.2rem;right:.3rem;}
	.classkind{position: absolute; line-height:2.35rem; right: .5rem; top: 0rem;}
	.classkind div{display: inline;}
	.classkind i { float: right; margin-left: .3rem; }
	.classkind select{border:none;appearance:none; -moz-appearance:none; -webkit-appearance:none;background: #FFF;}
	.classkind select option{color: #000;}
	.classkind select::-ms-expand { display: none; }
	.signinedit-stulist li{margin:.3rem;}
	.signinedit-stulist .stulist-cont{border-radius: .2rem;background: #FFF;padding: .5rem;position: relative;}
	.signinedit-stulist .stulist-moible{color: #888;}
	.signinedit-stulist .stulist-name{color:#353535;}
	.signinedit-stulist .stulist-cont2{border-radius: .2rem;background: #FFF;padding: .5rem;position: relative;}
	.stulist-cont2>p>span{top: 0.5rem;line-height:inherit;}
	.form-limit{position: relative;border:solid 0.05rem #EEEEEE;padding: 0.2rem 0.2rem 0.5rem 0.2rem;}
	.form-limit>em{position: absolute; bottom: -0.25rem; right: 0.2rem;}
	.stulist-cont2 textarea{width:100%;resize: none;font-size: 0.7rem;height:3rem;border: none;}
	.signinedit-stulist span{position: absolute;line-height:3rem;right: .5rem;top: 0rem;}
	.signinedit-stulist span>i{float: right;margin-left:.3rem;}
	.signinedit-foticon{text-align: center;background:#37A7ED;color: #FFF;height: 100%;line-height: 2.45rem;font-size:.8rem;border-right:0.01rem solid #FFF;}
	.signinedit-foticon:first-child i{color:#37A7ED;}
	.signinedit-foticon:first-child p{color:#37A7ED;}
	.signinedit-foticon>div{height: 1.8rem; line-height: 2rem;}
	.signinedit-foticon>div>i{font-size:1.5rem;}
</style>
<body>
	<div class="signinedit-wrap">
	<section class="signinedit-classlst">
		<ul class="clearfix">
			<li>
				<div class="signinedit-lstbox">
					<div class="signinedit-title">
						<span class="blue">大</span>英语提高大班
						<p class="subonline">上课人数：20人</p>
					</div>
				</div>
			</li> 
			<li>
				<div class="signinedit-lstbox">
					<div class="signinedit-title clearfix">
						<div class="left">绑定课时</div>
						<div class="right">2018年5月7日17:49:11</div>
						
					</div>
				</div>
			</li> 
			
			<li>
				<div class="signinedit-lstbox">
					<div class="signinedit-title clearfix">
						<div class="left">绑定课时</div>
						<div class="right">刘娜老师</div>
					</div>
				</div>
			</li> 
			<li>
				<div class="signinedit-lstbox">
					<div class="signinedit-title clearfix">
						<div class="left">助教老师</div>
						<div class="right">张军老师</div>
					</div>
				</div>
			</li> 
			<li>
				<div class="signinedit-lstbox">
					<div class="signinedit-title clearfix">
						<div class="left">出勤状态(批量)</div>
						<div class="right"><div class="classkind">
								<div>
									<select class="blue" onchange="signinedit.setColor(this)">
										<option value="0">上课</option>
										<option value="1">请假</option>
										<option value="2">旷课</option>
										<option value="3">补课</option>
									</select>
								</div>
								<i class="iconfont icon-jiantou-copy2"></i>
							</div></div>
					</div>
				</div>
			</li> 
			
		</ul>
	</section>
	
	<section class="signinedit-stulist">
		<ul class="clearfix" id="signinedits">
			<!--<li>
				<div class="stulist-cont2">
					<p class="stulist-name">学生姓名：晨曦<span class="blue">上课</span></p>
					<p class="stulist-name">评价：</p>
					<div class="form-limit" limit="300">
						<textarea name="" rows="" cols="" placeholder="请输入评价内容~"></textarea>
					</div>
				</div>
			</li> 
			<li>
				<div class="stulist-cont2">
					<p class="stulist-name">学生姓名：晨曦<span class="blue">上课</span></p>
					<p class="stulist-name">评价：</p>
					<div class="form-limit" limit="300">
						<textarea name="" rows="" cols="" placeholder="请输入评价内容~"></textarea>
					</div>
					
				</div>
			</li> -->
		</ul>
	</section>
	
	<br />
	
	
	
	
	<div class="footer">
		<div class="clearfix" style="display: none;">
			<div class="zui-col-6">
				<div class="signinedit-foticon">
					保存并评价
				</div>
	
			</div>
			<div class="zui-col-6">
				<div class="signinedit-foticon">
					仅保存
				</div>
				
			</div>
		</div>
		<div class="clearfix" style="display: none;">
			<div class="zui-col-6">
				<div class="signinedit-foticon">
					修改出勤状态
				</div>
	
			</div>
			<div class="zui-col-6">
				<div class="signinedit-foticon">
					保存
				</div>
				
			</div>
		</div>
		<div class="clearfix">
			<div class="zui-col-6">
				<div class="signinedit-foticon">
					编辑学生评价
				</div>
	
			</div>
			<div class="zui-col-6">
				<div class="signinedit-foticon">
					修改出勤状态
				</div>
				
			</div>
		</div>
	</div>
	
	
	</div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
		var signinedit = new Object({
				pageUrl:location.href.replace(/#.+/,''),
				slideFooterTab:function(target,index){
					var name = target.id
					location.href = this.pageUrl+'#'+name
					target.setClass('active','add').getSiblings().setClass('active','remove')
					$_class('page-wrap').child().map(function(obj,i){
						(i === index) ? obj.style.display = 'block' : obj.style.display = 'none'
					})
				},
				setColor:function(target){
					var set = target.value;
					var classcolor = ['blue','orange','red','purple'];
					target.setAttribute('class',classcolor[set]);
					
				},
				list:function(){
					var act = ['大','小','一'];
					var classcolor = ['blue','orange','red'];
					var init={
						tip:1,
						title:'英语提高大班',
						stunum:20,
						classtime:'2018-5-10 14:43',
						teacher:'刘娜老师',
						pushteacher:'张军老师'
					}
					$_id('info_tip').innerHTML = act[init.tip];
					$_id('info_tip').setClass(classcolor[init.tip],'add');
					
					$_id('info_title').innerHTML = init.title;
					$_id('info_stunum').innerHTML = init.stunum;
					$_id('info_classtime').innerHTML = init.classtime;
					$_id('info_teacher').innerHTML = init.teacher;
					$_id('info_pushteacher').innerHTML = init.pushteacher;
					
					
					var getAll =[
						{name:'鹏鹏1',phone:15260158253,staus:0},
						{name:'鹏鹏2',phone:1919710930,staus:1},
						{name:'鹏鹏3',phone:1919710929,staus:2},
						{name:'鹏鹏4',phone:1919710928,staus:3},
						{name:'鹏鹏5',phone:1919710927,staus:0},
						{name:'鹏鹏6',phone:1919710926,staus:1},
						{name:'鹏鹏7',phone:1919710925,staus:2},
						{name:'鹏鹏8',phone:1919710924,staus:3},
						{name:'鹏鹏9',phone:1919710923,staus:1},
						{name:'鹏鹏10',phone:1919710922,staus:2},
						{name:'鹏鹏11',phone:1919710921,staus:3}
					]
					var signineditss = $_id('signinedits');
					getAll.map(function(val){
						var alldata = signinedit.creatCont(val);
						signineditss.addChilds(alldata);
					})
				},
				creatCont:function(data){
					var staus = ['上课','请假','旷课','补课'];
					var classcolor = ['blue','orange','red','purple'];
					var pushdata = 	'<li><div class="stulist-cont2">';
					pushdata 	+=	'<p class="stulist-name">学生姓名：'+data.name+'<span class="'+classcolor[data.staus]+'">'+staus[data.staus]+'</span></p>';
					pushdata 	+=	'<p class="stulist-name">评价：</p><div class="form-limit">';
					pushdata 	+=	'<textarea name="" rows="" cols="" placeholder="请输入评价内容~" onkeyup="signinedit.limit(this)"></textarea>';
					pushdata 	+=	'<em><font class="limit">0</font>/300</em></div></div></li>';
					return pushdata;
				},
				limit:function($target){
					var limits = 300;
					/*****************************************/
					var getValueLength = $target.value.length;
					if(getValueLength<=limits){
						$target.parentNode.findClass('limit')[0].innerHTML = getValueLength;
				  	}else{
				  		var values = $target.value.substring(0,limits);
				  		$target.value = values;
				  	}

					/*****************************************/
				}
			}) 
		
			signinedit.list();


</script>
</body>
</html>