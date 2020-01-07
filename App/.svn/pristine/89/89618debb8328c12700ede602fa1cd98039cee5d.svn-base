<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>我的签到</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
   	<link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>var uoot = '<?php echo UOOT ?>'; </script> 	
</head> 
<style type="text/css">
.mySign-list{margin-top: .5rem;}
.mySign-time{font-size: .7rem;}
.mySign-time>span{float: right;}
.mySign-lstbox{background: #FFF;position: relative;padding:0.5rem;margin-bottom: 0.5rem;font-size: .7rem;}
.mySign-col{position: relative;}
.mySign-co2{position: relative;padding-left:2rem;}
.mySign-co2>span{position: absolute;left: 0rem;top: 0rem;}
.mySign-co2>p{color: #888;}
</style>
<body class="mySign-wrap" style="background: #F6F5F0;">
	<page class="mySign-page" id="page2">
		<section>
			<div class="mySign-list">
				<ul id="mySign-list">
					<!--<li>
						<div class="mySign-lstbox blue-box_shadow">
							<div class="mySign-time">
								2018-5-21 15:06:13
								<span class="blue">上课</span>
							</div>
							<div class="mySign-col">
								老师：刘娜老师
							</div>
							<div class="mySign-co2">
								<span>评价：</span>
								<p> 晨曦今天学习很认真，课上问题基本能解决，棒棒哒~继续加油！</p>
							</div>
						</div>
					</li>-->
				</ul>
			</div>
		</section>
	</page>	 
	
	<div id="loadings" class="loadings"></div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
var classid = "<?php echo $classid ?>";
var mySign = new Object({
	page: 0,
	classlevel: 'max',
	isFather: 0,
	slideTab: function slideTab(target, id) {
		target.setClass('active', 'add').getSiblings().setClass('active', 'remove');
		$_id('mySign-list').innerHTML = '';
		mySign.classlevel = id;
		mySign.page = 0;
		mySign.list();
	},
	list: function list() {
		mySign.page = mySign.page + 1;
		var mySigns = $_id('mySign-list');
		var ajax = {
			url: '/Json/index.php?act=Users.classsign&p=' + mySign.page + '&classid=' + classid,
			data: ''
		};

		$_post(ajax.url, ajax.data, function (res) {
			console.log(res);
			if (res.classsign.values) {
				if (res.classsign.values.length > 0) {
					getAll = res.classsign.values;
					getAll.map(function (val) {
						var alldata = mySign.creatCont(val);
						mySigns.addChilds(alldata);
					});
				} else {
					if (mySign.page == 1) {
						if (mySign.isFather == '0') {
							mySigns.addChilds('<div class="nodata2"></div>');
						} else {
							mySigns.addChilds('<div class="nodata1"></div>');
						}
					}
				}
			} else {
				if (mySign.isFather == '0') {
					mySigns.addChilds('<div class="nodata2"></div>');
				} else {
					mySigns.addChilds('<div class="nodata1"></div>');
				}
			}
		}, 'json');
	},
	creatCont: function creatCont(data) {
		console.log(data);
		if (data.remake == '') {
			data.remake = '暂无评价';
		}
		var Couse = ['', '上课', '请假', '旷课', '补课'];
		var setCouse = ['blue', 'orange', 'red', 'purple'];
		var pushdata = '<li><div class="mySign-lstbox blue-box_shadow"><div class="mySign-time">2018-5-21 15:06:13<span class="' + setCouse[data.status - 1] + '">' + Couse[data.status] + '</span></div>';
		pushdata += '<div class="mySign-col">老师：' + data.checkin + '</div><div class="mySign-co2"><span>评价：</span>';
		pushdata += '<p> ' + data.remake + '</p></div></div></li>';
		return pushdata;
	}
});
mySign.list();
mySign.isFather = '<?php echo $this->isp;?>';
/**
 * 
 * 参数classid 班级id
 *	status 0未审核 1已审核 -1删除
 *	classeditstatus
 * 
 * 
 * 
 * */
$_monitor.scroll.bottom(window, function () {
	//$_id('loadings').style.display = 'block';
	mySign.list();
});
	</script>
</body>
</html> 