<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>我要报班</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<style type="text/css">
.page-wrap{padding: 0.5rem;}
</style>
   
<body class="stubaoban-wrap">
	<div class="page-wrap">
		<page class="stubaoban-page">
			<header>
				<div class="search-seaBox2 blue-box_shadow">
					<form action="" onsubmit="stubaoban.search()">
						<input type="search" value="" id="todayinput" placeholder="用户名或姓名"> 
						<i class="ion-search" onclick="stubaoban.search()"></i> 
					</form> 
				</div>
			</header>
			
			<section class="stubaoban-classlst">
				<ul class="clearfix" id="stubaoban"></ul>
			</section>
			
		</page>
	</div>
	
	<footer class="footer">
		<button class="stubaoban-add" onclick="window.location.href='<?php echo M_URL('WeChat','stuinfoadd'); ?>'">添加新学员</button>
	</footer>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">

var stubaoban = new Object({
	page: 0,
	search: function search() {
		var signlst = $_id('stubaoban');
		signlst.innerHTML = "";
		stubaoban.page = 0;
		stubaoban.list($_id('todayinput').value);
	},
	list: function list(keyword) {
		stubaoban.page = stubaoban.page + 1;
		var ajax = {
			url: '/Json/index.php?act=WeChat.userslist',
			data: {
				appename: "student",
				keyword: keyword,
				p: stubaoban.page
			}
		};
		$_post(ajax.url, ajax.data, function (res) {
			console.log(res);
			var signinstauss = $_id('stubaoban');
			if (res.userslist.UsersAll.length > 0) {
				getAll = res.userslist.UsersAll;
				getAll.map(function (val) {
					var alldata = stubaoban.creatCont(val);
					signinstauss.addChilds(alldata);
					$_class('btnSwitch').map(function (swbtn, key) {});
				});
			} else {
				signinstauss.addChilds('<div class="novalue"></div>');
			}
		}, 'json');
	},
	creatCont: function creatCont(data) {
		console.log(data);
		var pushdata = '<li class="blue-box_shadow"><img src="' + data.defaultpic + '" class="headimg"/><div class="stubaoban-box"><ul class="stubaoban-info clearfix">';
		if (data.name == '' || data.name == null) {
			data.name = '----';
		}
		if (data.emergencyContact == '' || data.emergencyContact == null) {
			data.emergencyContact = '未填写';
		}
		if (data.emergencyContactTel == '' || data.emergencyContactTel == null) {
			data.emergencyContactTel = '未填写';
		}
		pushdata += '<li><span>' + data.name + '</span>&nbsp;';
		if (data.Sex == 1) {
			pushdata += '<i class="ion-boy"></i></li>';
		} else if (data.Sex == 2) {
			pushdata += '<i class="ion-girl"></i></li>';
		} else {
			pushdata += '</i></li>';
		}
		pushdata += '<input type="hidden" name="id" value="' + data.userid + '" class="userids">';
		pushdata += '<li>联系电话：' + data.mobile + '</li>';
		pushdata += '</li></ul><button class="o-btnBlue" onclick="stubaoban.herf(' + data.userid + ')" type="butoon">确认报班</button>';

		return pushdata;
	},
	editstatus: function editstatus(status, userid) {
		var ajax = {
			url: '/Json/index.php?act=WeChat.editstatus',
			data: {
				status: status,
				userid: userid
			}
		};
		$_post(ajax.url, ajax.data, function (res) {
			console.log('切换完成');
		}, 'json');
	},
	herf: function herf(userid) {
		window.location.href = "<?php echo M_URL('WeChat','stuinfoorder'); ?>?userid=" + userid;
	}
});
stubaoban.list();

$_monitor.scroll.bottom(window, function () {
	console.log('到底了');
});

	</script>
</body>
</html>