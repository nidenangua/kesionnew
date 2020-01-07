<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>学员管理</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<style type="text/css">
	
</style>
<body class="stuClass-wrap">
	<div class="page-wrap">
		<ul class="stuClass-order clearfix">
			<li onclick="stuClass.tab(this)" class="active">订单记录</li> 
			<li onclick="stuClass.tab(this)">签到记录</li>
		</ul>
		
		<page class="stuClass-page" style="display: block;">
			<div class="stuClass-stuClass"> 
				<i class="ion-playonpne"></i>
				<ul class="stuClass-ul" id="order">
					<!--<li>
						<div class="stuClass-cont"><div class="stuClass-top clearfix">
							<p>订单编号：125515254209790285</p><p>下单时间：2018-05-04 16:02:59</p></div>
							<div class="stuClass-bot clearfix"><label>订单内容：</label><p>PS 电商设计特训/淘宝美工+网店装修+主图海报+详情页/平面设计</p><span>已支付</span></div>
							<div class="price"><span>￥100.00</span> (12课时x300.00元/课时)</div>
						</div>
					</li>-->
				</ul>
			</div>
		</page>

		<page class="stuClass-page">
			<ul id="signin">
				
			</ul>
			
		</page>
		
		
	</div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">

var stuClass = new Object({
	page1: 0,
	page2: 0,
	tab: function tab(target) {
		target.setClass('active', 'add').getSiblings().setClass('active', 'remove');
		var index = target.index();
		$_class("stuClass-page").map(function (val, key) {
			if (key == index) {
				val.style.display = 'block';
			} else {
				val.style.display = 'none';
			}
		});
	},
	getParam: function getParam(paramName) {
		paramValue = "", isFound = !1;
		if (location.search.indexOf("?") == 0 && location.search.indexOf("=") > 1) {
			arrSource = unescape(location.search).substring(1, location.search.length).split("&"), i = 0;
			while (i < arrSource.length && !isFound) {
				arrSource[i].indexOf("=") > 0 && arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase() && (paramValue = arrSource[i].split("=")[1], isFound = !0), i++;
			}
		}
		return paramValue == "" && (paramValue = null), paramValue;
	},
	order: {
		list: function list() {
			var userid = stuClass.getParam('userid');
			var classid = stuClass.getParam('classid');
			var ajax = {
				url: '/Json/index.php?act=Interact.order',
				data: {
					userid: userid,
					classid: classid,
					type: 1
				}
			};

			$_post(ajax.url, ajax.data, function (res) {
				console.log(res.order.values);
				if (res.order.values.length > 0) {
					getAll = res.order.values;
					var order = $_id('order');
					getAll.map(function (val) {
						var alldata = stuClass.order.creatCont(val);
						order.addChilds(alldata);
					});
				}
			}, 'json');
		},
		creatCont: function creatCont(data) {
			pushdata = '<li><div class="stuClass-cont"><div class="stuClass-top clearfix">';
			pushdata += '<p>下单时间：' + data.adddate + '</p></div>';
			pushdata += '<div class="stuClass-bot clearfix"><label>订单内容：</label><p>' + data.title + '</p><span>已支付</span></div>';
			pushdata += '<div class="price"><span>实付￥' + data.order_amount + '</span> (原价：' + data.numb + 'x' + data.price + '元)</div></div></li>';
			return pushdata;
		}
	},
	signin: {
		list: function list() {
			var userid = stuClass.getParam('userid');
			var classid = stuClass.getParam('classid');
			var ajax = {
				url: '/Json/index.php?act=WeChat.usersign',
				data: {
					userid: userid,
					classid: classid
				}
			};
			$_post(ajax.url, ajax.data, function (res) {
				console.log(res.usersign.list);
				if (res.usersign.list.length > 0) {
					getAll = res.usersign.list;
					var signin = $_id('signin');
					getAll.map(function (val) {
						var alldata = stuClass.signin.creatCont(val);
						signin.addChilds(alldata);
					});
				}
			}, 'json');
		},
		creatCont: function creatCont(data) {
			console.log(data.type);
			var act = ['大', '小', '一'];
			var gotype = ['', '线上', '线下'];
			var classcolor = ['blue', 'orange', 'red', 'purple'];
			var staus = ['', '上课', '请假', '旷课', '补课'];
			var icon = ['ion-playonline', 'ion-face'];

			var pushdata = '<li><div class="stuClass-lstbox"><div class="stuClass-title">';
			pushdata += '<span class="' + classcolor[data.classlevel] + '">' + act[data.classlevel] + '</span>' + data.title + '</div>';
			pushdata += '<div class="stuClass-boxCont clearfix"><div class="stuClass-col clearfix"><div><i class="ion-tearcher"></i>' + data.name + '</div>';
			pushdata += '<div><i class="' + icon[data.type - 1] + '"></i>' + gotype[data.type] + '</div></div><div class="stuClass-col">';
			pushdata += '<div><i class="ion-clock"></i>' + data.timeSlotStart + '-' + data.timeSlotEnd + '</div>';
			pushdata += '</div><em class="' + classcolor[data.status - 1] + '">' + staus[data.status] + '</em></div></div></li>';

			return pushdata;
		}
	}

});

stuClass.order.list();
stuClass.signin.list();
		
	</script>
</body>
</html>