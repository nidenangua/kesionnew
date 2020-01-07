<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>上课签到</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
   	<link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body class="sign-wrap">
	<div class="page-wrap">
		<page class="sign-page" id="page1">
			<header>
				<div class="sign-top">
					<div class="search-seaBox2 blue-box_shadow">
						<form action="" onsubmit="signin.toDay.search()">
						<input type="search" value="" id="todayinput" placeholder="请输入您要搜索的内容"> 
						<i class="ion-search" onclick="signin.toDay.search()"></i> 
						</form>
					</div>
					
					<div class="sign-screen blue-box_shadow"  onclick="signin.filterBt()">
						<i class="ion-screen"></i>筛选
					</div>
				</div>
			</header>
			
			<section class="sign-screenbox" id="filler">
				<div class="mask" style="display: block;z-index: 0;"></div>
				<div class="sign-screenlst">
					<div class="screelst-title">筛选</div>
					<div class="screelst-lstbox">
						<ul>
							<li>
								<p class="lstbox-title">班级类别</p>
								<div class="lstbtn clearfix" id="classkind">
									<button onclick="signin.toDay.slideBtn(this,'max',0)" class="active" >不限</button>
								</div>
							</li>
							
							<li>
								<p class="lstbox-title">上课类型</p>
								<div class="lstbtn clearfix" id="classtype">
									<button onclick="signin.toDay.slideBtn(this,'max',1)" class="active">不限</button>
								</div>
							</li>
						</ul>
						
						<div class="sign-operation">
							<div class="zui-col-6" >
								<button class="fb-white" onclick="signin.maskclose()">返回</button>
							</div>
							<div class="zui-col-6">
								<button class="fb-orag" onclick="signin.toDay.filter();">确定</button>
							</div>
						</div>
					</div>
				</div>
			</section>
			
			<section class="sign-showdate"><!--时间--></section>
			
			<section class="sign-classlst">
				<ul class="clearfix" id="signlst"></ul>
			</section>
			
		</page>
		<page class="sign-page" id="page2">
			<header>
				<div class="sign-topTab"> 
					<ul class="clearfix">
						<li class="active" onclick="signin.historys.slideTab(this,'')"><div>全部</div></li>
						<li onclick="signin.historys.slideTab(this,2)"><div>一对一</div></li>
						<li onclick="signin.historys.slideTab(this,1)"><div>小班课</div></li>
						<li onclick="signin.historys.slideTab(this,0)">大班课</li>
					</ul>
					<input id="histype" type="hidden" value="0" />
					
				</div>
				
			
			</header>
			
			<div style="padding: 0.5rem;">
				<div class="search-seaBox1 blue-box_shadow">
					<form action="" onsubmit="signin.historys.search()">
					<input type="search"id="historysinput" value="" placeholder="请输入您想要搜索的内容"/> 
					<i class="ion-search" onclick="signin.historys.search()"></i> 
					</form>
				</div>
				
			</div>
			<section class="sign-classlst">
				<ul class="clearfix" id="historylst"></ul>
			</section>
		</page>	 
	
	</div>
	<div id="loadings" class="loadings"></div>
	<footer class="footer">
		<ul>
			<li class="zui-col-6" onclick="signin.slideFooterTab(this,0)" id="toDay">
				<i class="icon icon-today"></i>
				<p>今日上课</p>
			</li>
			<li class="zui-col-6" onclick="signin.slideFooterTab(this,1)" id="historys">
				<i class="icon icon-history"></i>
				<p>历史签到</p>
			</li>
		</ul>
	</footer>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	

var qdurl = "https:" + "<?php echo M_URL('WeChat','signinstaus'); ?>";
var xgurl = "https:" + "<?php echo M_URL('WeChat','editsigninstaus'); ?>";
var liurl = "https:" + "<?php echo M_URL('WeChat','signinlst'); ?>";
var signin = new Object({
	page1: 0,
	page2: 0,
	now: 0,
	pageUrl: location.href.replace(/#.+/, ''),
	slideFooterTab: function slideFooterTab(target, index) {
		var name = target.id;
		signin.now = index;
		location.href = this.pageUrl + '#' + name;
		target.setClass('active', 'add').getSiblings().setClass('active', 'remove');
		$_class('page-wrap').child().map(function (obj, i) {
			i === index ? obj.style.display = 'block' : obj.style.display = 'none';
		});
		$_id('signlst').innerHTML = '';
		$_id('historylst').innerHTML = '';
		signin.page1 = 0;
		signin.page2 = 0;
		index == 0 ? signin.toDay.list() : signin.historys.list();
	},
	filterBt: function filterBt(target) {
		var alertbox = $_id('filler');
		alertbox.style.display = 'block';
		setTimeout(function () {
			$_class('mask')[0].style.opacity = 0.5;
			var screenlst = $_class('sign-screenlst')[0];
			screenlst.style.marginRight = '0rem';
		}, 100);
	},
	maskclose: function maskclose(target) {
		var screenlst = $_class('sign-screenlst')[0];
		screenlst.style.marginRight = '-80%';
		$_class('mask')[0].style.opacity = 0;
		var alertbox = $_id('filler');
		setTimeout(function () {
			alertbox.style.display = 'none';
		}, 400);
	},
	toDay: {
		page: 0,
		classType: 'max',
		classlevel: 'max',
		datetime: function datetime() {
			var date = new Date();
			var year = date.getFullYear();
			var month = date.getMonth() + 1;
			var day = date.getDay();
			var days = date.getDate();
			var weekday = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
			var thisTime = year + "-" + month + "-" + days + "   " + weekday[day];
			$_class('sign-showdate')[0].innerHTML = thisTime;
		},
		search: function search() {
			var signlst = $_id('signlst');
			signlst.innerHTML = "";
			signin.page1 = 0;
			signin.toDay.list($_id('todayinput').value);
		},
		filter: function filter() {
			var ajax = {
				url: '/Json/index.php?act=WeChat.classlist',
				data: {
					classType: signin.toDay.classType,
					classlevel: signin.toDay.classlevel
				}
			};

			$_post(ajax.url, ajax.data, function (res) {
				$_id('signlst').innerHTML = "";
				signin.page1 = 0;
				if (res.classlist.list) {
					getAll = res.classlist.list;
					var signlst = $_id('signlst');
					getAll.map(function (val) {
						var alldata = signin.toDay.creatCont(val);
						signlst.addChilds(alldata);
					});
				}
			}, 'json');
			signin.maskclose();
		},
		filist: function filist() {

			var filters = {
				classkind: ["大班", "小班", "一对一"],
				classtype: ["网授班级", "面授班级"]
			};
			var classkind = $_id('classkind');
			var classtype = $_id('classtype');
			signin.toDay.filbtg(classkind, filters.classkind, 0);
			signin.toDay.filbtg(classtype, filters.classtype, 1);
		},
		filbtg: function filbtg(target, datapack, start) {
			datapack.map(function (val, i) {
				var str = '<button onclick="signin.toDay.slideBtn(this,' + (i + start) + ',' + start + ')">' + val + '</button>';
				target.addChilds(str);
			});
		},
		list: function list(str) {

			signin.page1 = signin.page1 + 1;
			if (str) {
				var ajax = {
					url: '/Json/index.php?act=WeChat.classlist',
					data: {
						type: 1,
						p: signin.page1,
						title: str
					}
				};
			} else {
				var ajax = {
					url: '/Json/index.php?act=WeChat.classlist',
					data: {
						type: 1,
						p: signin.page1
					}
				};
			}

			$_id('loadings').style.display = 'block';
			$_post(ajax.url, ajax.data, function (res) {
				var signlst = $_id('signlst');
				if (res.classlist.list.length > 0) {
					getAll = res.classlist.list;
					getAll.map(function (val) {
						var alldata = signin.toDay.creatCont(val);
						signlst.addChilds(alldata);
					});
				} else {
					if (signin.page1 == 1) {
						signlst.addChilds('<li class="novalue"></li>');
					}
				}
			}, 'json');
			$_id('loadings').style.display = 'none';
		},
		creatCont: function creatCont(data) {
			console.log(data);
			var gotype = ['组合', '网授', '面授'];
			var act = ['大', '小', '一'];
			var classtype = ['<i class="ion-playonline"></i> <i class="ion-face"></i>', '<i class="ion-playonline"></i>', ' <i class="ion-face"></i>'];
			var classcolor = ['blue', 'orange', 'red'];
			var pushdata = '<li class="blue-box_shadow"><div class="sign-lstbox"><div class="sign-title">';
			pushdata += '<span class="' + classcolor[data.classlevel] + '">' + act[data.classlevel] + '</span>' + data.title + '</div>';
			pushdata += '<div class="sign-boxCont clearfix"><div class="sign-col">';
			pushdata += '<div><i class="ion-tearcher"></i> ' + data.name + '老师';
			pushdata += '</div><div><i class="ion-map"></i> ' + data.timeSlotStart + '-' + data.timeSlotEnd + '</div>';
			pushdata += '</div><div class="sign-col"><div>' + classtype[data.classType - 1] + ' ' + gotype[data.classType - 1] + '</div></div>';
			if (data.status == 0) {
				pushdata += '<span class="sign" onclick="signin.toDay.sign(this,' + data.classid + ',' + data.scheduleid + ')">签到</span></div></div></li>';
			} else {
				pushdata += '<span class="edit" onclick="signin.toDay.edit(' + data.classid + ',' + data.scheduleid + ')">编辑</span></div></div></li>';
			}

			return pushdata;
		},
		slideBtn: function slideBtn(target, id, type) {
			var index = target.index();
			target.setClass('active', 'add').getSiblings().setClass('active', 'remove');
			if (type == 0) {
				signin.toDay.classlevel = id;
			} else {
				signin.toDay.classType = id;
			}
		},
		sign: function sign(target, id, id2) {
			/*target.setClass('sign','remove').setClass('edit','add');
   target.innerHTML='编辑签到';
   target.setAttribute("onclick","signin.toDay.edit(912)");*/
			window.location.href = qdurl + '?classid=' + id + '&scheduleid=' + id2;
			console.log("正在发送签到...！");
			console.log("签到成功！");
		},
		edit: function edit(id, id2) {
			window.location.href = xgurl + '?classid=' + id + '&scheduleid=' + id2;
			console.log("正在发送签到...！");
			console.log("签到成功！");
		}

	},
	historys: {
		classlevel: '',
		title: '',
		search: function search() {
			$_id('historylst').innerHTML = "";
			signin.page2 = 0;
			signin.historys.title = $_id('historysinput').value;
			signin.historys.list();
		},
		slideTab: function slideTab(target, id) {
			var histype = $_id('histype').value = id;
			$_id('historysinput').value = '';
			target.setClass('active', 'add').getSiblings().setClass('active', 'remove');
			$_id('historylst').innerHTML = '';
			signin.page2 = 0;
			signin.historys.classlevel = id;
			signin.historys.list();
		},
		list: function list() {
			signin.page2 = signin.page2 + 1;
			var ajax = {
				url: '/Json/index.php?act=WeChat.signin',
				data: {
					type: 1,
					p: signin.page2,
					classlevel: signin.historys.classlevel,
					title: signin.historys.title,
					timetype: 4
				}
			};

			$_post(ajax.url, ajax.data, function (res) {
				console.log(res);
				console.log(signin.page2);
				var historylst = $_id('historylst');
				if (res.signin.list.length > 0) {
					getAll = res.signin.list;
					getAll.map(function (val) {
						var alldata = signin.historys.creatCont(val);
						historylst.addChilds(alldata);
					});
				} else {
					if (signin.page2 == 1) {
						historylst.addChilds('<li class="novalue"></li>');
					}
				}
			}, 'json');
		},
		creatCont: function creatCont(data) {
			var act = ['大', '小', '一'];
			var classcolor = ['blue', 'orange', 'red'];
			var pushdata = '<li class="blue-box_shadow"><div class="sign-lstbox"><div class="sign-title">';
			pushdata += '<span class="' + classcolor[data.classlevel] + '">' + act[data.classlevel] + '</span>' + data.title + '</div>';
			pushdata += '<div class="sign-boxCont clearfix"><div class="sign-col">';
			pushdata += '<div>班主任：' + data.name + '</div><div>上课人数：' + data.studentnum + '人</div></div>';
			//					pushdata 	+= 	'<div class="sign-col"><div>&nbsp;</div><div>出勤率：'+data.proportion+'</div></div>';
			pushdata += '<em class="record" onclick="signin.historys.getout(\'' + data.classid + '\')">签到记录</em></div></div></li>';

			return pushdata;
		},
		getout: function getout(id) {
			window.location.href = liurl + '?classid=' + id;
			console.log("正在发送签到...！");
			console.log("签到成功！");
		}
	}
});

var markName = location.href.match(/#\w+/);

if (markName) {
	markName = markName[0].split('#')[1];
	$_id(markName).click();
} else {
	$_id('toDay').click();
};

signin.toDay.datetime();
signin.toDay.filist();

$_monitor.scroll.bottom(window, function () {
	if (signin.now == 0) {
		signin.toDay.list();
	} else {
		signin.historys.list();
	}
});

	</script>
</body>
</html>