<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>报班</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body class="stuorder-wrap">
	<div class="stuorder-list">
		<h3>订单信息</h3>		
		<ul class="order-list">
			<li>
				<font color="#888">学员姓名</font>
				
				<span><?php if(empty($userinfo2['name'])){ echo $userinfo['username'];}else{ echo $userinfo2['name'];}?></span>
			</li>
			
			<li>
				<font color="#888">选择班级/课程类别</font>
				<select name="classlevel" id="classlevel" onchange="stuinfoOrder.list()">
					<option value="0">大班</option>
					<option value="1">小班</option>
					<option value="2">一对一</option>
				</select>
				<i class="iconfont icon-jiantou-copy2" style="position: absolute; top: 0.2rem; right: 0.2rem;"></i>
			</li>
			
			<li style="position: relative;">
				<select name="classid" style="width: 100%;height: 30px;" id="classs" onchange="stuinfoOrder.price()"> 
					<option value="0">请选择班级</option>
				</select>
				<i class="iconfont icon-jiantou-copy2" style="position: absolute; top: 0.3rem; right: 0.2rem;"></i>
			</li>
		</ul>
	</div>
	
	
	<div class="stuorder-list">
		<h3>订单金额</h3>		
		<ul class="order-list">
			<li>
				价格 
				
				<span class="orange" id="showprice">￥0.00</span>
				<input type="hidden" name="price" id="prices" />
			</li>
			
			<li>
				数量
				<span class="kscont">
					<button class="ion-add" onclick="stuorder.add()" type="button"></button>
					<input  name="numb" class="kshi" id="kshi" onkeyup="stuorder.format(this)" type="number" value="1" />
					<button class="ion-redu"onclick="stuorder.redu()" type="button"></button>
				</span>
			</li>
			
			<li>
				订单总额
				<span class="orange" id="sumprice">￥0.00</span> 
				
			</li>
			
			<li>
				实收金额
				<span>￥<input type="number" name="order_amount" id="order_amount"/></span>
			</li>
		</ul>
	</div>
	
	<footer class="footer">
		<div class="clearfix">
			<div class="zui-col-6" onclick="history.go(-1);">
				<div class="footer-foticon fb-white">
					取消
				</div>
			</div>
			<div class="zui-col-6" onclick="stuinfoOrder.doreg()">
				<div class="footer-foticon fb-orag" >
					确认
				</div>
			</div>
		</div>
	</footer>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	
var stuorder = {
	format: function format(e) {
		var vals = e.value;
		if (vals < 0) {
			e.value = vals * -1;
		}
		stuinfoOrder.count();
	},
	add: function add() {
		var vals = $_id('kshi').value;
		vals++;
		$_id('kshi').value = vals;
		stuinfoOrder.count();
	},
	redu: function redu() {
		var vals = $_id('kshi').value;
		vals = vals - 1;
		if (vals < 0) {
			$_id('kshi').value = 0;
		} else {
			$_id('kshi').value = vals;
		}
		stuinfoOrder.count();
	}

};
var stuinfoOrder = new Object({
	list: function list() {
		var ajax = {
			url: '/Json/index.php?act=WeChat.ALLclasslist',
			data: {
				classlevel: $_id('classlevel').value
			}
		};
		$_post(ajax.url, ajax.data, function (res) {
			if (res.ALLclasslist.dt) {
				console.log(res.ALLclasslist.dt);
				getAll = res.ALLclasslist.dt;
				var signlst = $_id('classs');
				signlst.innerHTML = '';
				getAll.map(function (val) {
					var alldata = stuinfoOrder.creatCont(val);
					signlst.addChilds(alldata);
				});
				stuinfoOrder.price();
			}
		}, 'json');
	}, creatCont: function creatCont(data) {
		if (data.price == '免费') {
			var str = '';
		} else {
			if (data.chargeData == 1) {
				var str = '/月';
			} else if (data.chargeData == 2) {
				var str = '/季';
			} else if (data.chargeData == 3) {
				var str = '/年';
			} else if (data.chargeData == 4) {
				var str = '/' + data.hourunit + '课时';
			}
		}
		var pushdata = '<option value="' + data.classid + '" flag ="' + data.price + str + '">' + data.title + '</option>';
		return pushdata;
	}, price: function price() {
		var val = $_id('classs').value;
		$_id('classs').childNodes.map(function (vars, key) {
			if (vars.value == val) {
				var flag = vars.getAttribute('flag');
				$_id('showprice').innerHTML = flag;
				if (flag == '免费') {
					flag = 0;
				} else {
					flag = flag.split('/')[0];
					flag = flag.substr(1, flag.length) * 1;
				}
				$_id('prices').value = flag;
			}
		});
		stuinfoOrder.count();
	},
	count: function count() {
		var num = $_id('kshi').value;
		var price = $_id('prices').value;
		var sumprice = num * price;
		$_id('sumprice').innerHTML = "￥" + sumprice;
		$_id('order_amount').value = sumprice;
	},
	doreg: function doreg() {
		var ajax = {
			url: '/Json/index.php?act=WeChat.doenrolment',
			data: {
				classlevel: $_id('classlevel').value,
				courseid: $_id('classs').value,
				id: "<?php echo $id; ?>",
				order_amount: $_id('order_amount').value,
				numb: $_id('kshi').value
			}
		};
		$_post(ajax.url, ajax.data, function (res) {
			console.log(res);
			if (res.errcode == 404) {
				alert(res.msg);
			} else {
				alert(res.doenrolment.msg);
				history.go(-1);
			}
		}, 'json');
	}
});
stuinfoOrder.list();
	</script>
</body> 
</html>