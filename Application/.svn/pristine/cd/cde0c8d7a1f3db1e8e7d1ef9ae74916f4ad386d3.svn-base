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
.page-wrap{padding: 0.5rem;}
</style>
   
<body class="stuadmin-wrap">
	<div class="page-wrap">
		<page class="stuadmin-page">
			<header>
				<div class="search-seaBox1 blue-box_shadow">
					<form action="" onsubmit="stuadmin.search()">
						<input type="search" value="" id="todayinput" placeholder="用户名或姓名"> 
						<i class="ion-search" onclick="stuadmin.search()"></i> 
					</form> 
				</div>
			</header>
			
			<section class="stuadmin-classlst">
				<ul class="clearfix" id="stuadminlst"></ul>
			</section>
			
		</page>
	</div>
	
	<footer class="footer">
		<button class="stuadmin-add" onclick="window.location.href='<?php echo M_URL('WeChat','stuinfoadd'); ?>'">添加新学员</button>
	</footer>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js?a9d817b319b7d9fee23f"></script>
	<script type="text/javascript">
	

var stuadmin = new Object({
	page: 0,
	search: function search() {
		var signlst = $_id('stuadminlst');
		signlst.innerHTML = "";
		stuadmin.page = 0;
		stuadmin.list($_id('todayinput').value);
	},
	list: function list(keyword) {
		stuadmin.page = stuadmin.page + 1;
		console.log(stuadmin.page);

		var ajax = {
			url: '/Json/index.php?act=WeChat.userslist',
			data: {
				appename: "student",
				keyword: keyword,
				p: stuadmin.page
			}
		};
		$_post(ajax.url, ajax.data, function (res) {
			var signinstauss = $_id('stuadminlst');
			if (res.userslist.UsersAll.length > 0) {
				getAll = res.userslist.UsersAll;
				getAll.map(function (val) {
					var alldata = stuadmin.creatCont(val);
					signinstauss.addChilds(alldata);
					$_class('btnSwitch').map(function (swbtn, key) {
						var staus = swbtn.getAttribute("staus");
						if (staus == 'true') {
							swbtn.style.background = '#37A7ED';
							swbtn.findClass('sonSwitch')[0].style.left = '';
							swbtn.findClass('sonSwitch')[0].style.left = '1.15rem';
						} else {
							swbtn.style.background = '';
							swbtn.findClass('sonSwitch')[0].style.right = '';
							swbtn.findClass('sonSwitch')[0].style.left = '0rem';
						}

						if (swbtn.findTag('input')[0]) {
							swbtn.findTag('input')[0].value = staus;
						}
						swbtn.onclick = function (callback) {
							var staus = this.getAttribute("staus");
							$userid = $_class('userids');
							if (staus == 'true') {
								stuadmin.editstatus(1, $userid[key].value);
								this.setAttribute("staus", 'false');
								staus = 'false';
								this.style.background = '#FFF';
								this.findClass('sonSwitch')[0].style.left = '0rem';
							} else {
								stuadmin.editstatus(0, $userid[key].value);
								this.setAttribute("staus", 'true');
								staus = 'true';
								this.style.background = '#37A7ED';
								this.findClass('sonSwitch')[0].style.left = '1.15rem';
							}

							if (this.findTag('input')[0]) {
								this.findTag('input')[0].value = staus;
							}
						};
					});
				});
			} else {
				if (stuadmin.page == 1) {
					signinstauss.addChilds('<div class="novalue"></div>');
				}
			}
		}, 'json');
	},
	creatCont: function creatCont(data) {
		var pushdata = '<li class="blue-box_shadow"><div class="stuadminlst-box"><ul class="stuadminlst-info clearfix">';
		if (data.name == '' || data.name == null) {
			data.name = '----';
		}
		if (data.emergencyContact == '' || data.emergencyContact == null) {
			data.emergencyContact = '未填写';
		}
		if (data.emergencyContactTel == '' || data.emergencyContactTel == null) {
			data.emergencyContactTel = '未填写';
		}
		pushdata += '<li><span>学生姓名：' + data.name + '</span>';
		if (data.Sex == 1) {
			pushdata += '<i class="ion-boy"></i></li>';
		} else if (data.Sex == 2) {
			pushdata += '<i class="ion-girl"></i></li>';
		} else {
			pushdata += '</i></li>';
		}
		pushdata += '<input type="hidden" name="id" value="' + data.userid + '" class="userids">';
		pushdata += '<li>联系电话：' + data.mobile + '</li>';
		pushdata += '<li>紧急联系人：' + data.emergencyContact + '</li>';
		pushdata += '<li>紧急联系人电话：' + data.emergencyContactTel + '</li>';
		pushdata += '<li>账户是否锁定 ：';
		if (data.status == 1) {
			pushdata += '<div class="btnSwitch" staus="false"> <div class="sonSwitch"></div><input type="hidden" name="SwitchVal" id="SwitchVal" value="false"></div>';
		} else {
			pushdata += '<div class="btnSwitch" staus="true"> <div class="sonSwitch"></div><input type="hidden" name="SwitchVal" id="SwitchVal" value="true"></div>';
		}
		pushdata += '</li></ul><button class="o-btnBlue" onclick="stuadmin.herf(' + data.userid + ')" type="butoon">查看详情</button><button onclick="stuadmin.delectuser(' + data.userid + ')" class="o-btnOrag" type="butoon">删除</button>';

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
		window.location.href = "<?php echo M_URL('WeChat','stuinfo'); ?>?userid=" + userid;
	},
	delectuser: function delectuser(userid) {
		var ajax = {
			url: '/Json/index.php?act=WeChat.deluser',
			data: {
				userid: userid
			}
		};
		reConfirm({
			title: '确认删除吗',
			success: function success() {
				$_post(ajax.url, ajax.data, function (res) {
					toast2({
						content: '删除完成',
						callback: function callback() {
							window.location.reload();
						}
					});
				}, 'json');
			}
		});
	}
});
stuadmin.list();

$_monitor.scroll.bottom(window, function () {
	stuadmin.list();
	console.log('到底了');
});

	</script>
</body>
</html>