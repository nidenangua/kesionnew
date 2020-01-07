<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>创建签到</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body>
	<div class="signinlst-wrap">

	
		<section class="signinlst-signinlst">
			<ul class="clearfix" id="signinlst"></ul>
		</section>
		
		
		<div style="background:#f7fcff;position: fixed; left: 0; bottom: 0; width: 100%; height: 2.45rem;">
			<a id="creat" href="<?php echo M_URL('WeChat','signinstaus'); ?>?classid=<?php echo KS_G('get.classid'); ?>"><div id="creatbtn" class="signinlst-foticon">创建签到</div></a>
		</div>
	
		<div class="loadings" id="loadings"></div>
	</div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	

var page = 0;
var classid = "<?php echo KS_G('get.classid'); ?>";
var signinlsts = new Object({
	pageUrl: location.href.replace(/#.+/, ''),
	slideFooterTab: function slideFooterTab(target, index) {
		var name = target.id;

		location.href = this.pageUrl + '#' + name;
		target.setClass('active', 'add').getSiblings().setClass('active', 'remove');
		$_class('page-wrap').child().map(function (obj, i) {
			i === index ? obj.style.display = 'block' : obj.style.display = 'none';
		});
	},
	list: function list() {
		page = page + 1;
		var ajax = {
			url: '/Json/index.php?act=WeChat.signinlst',
			data: {
				classid: classid,
				p: page
			}
		};

		$_post(ajax.url, ajax.data, function (res) {
			console.log(res);
			var signlst = $_id('signinlst');
			if (res.signinlst.sign.length > 0) {
				getAll = res.signinlst.sign;
				getAll.map(function (val) {
					var alldata = signinlsts.creatCont(val);
					signlst.addChilds(alldata);
				});
			} else {
				if (page == 1) {
					signlst.innerHTML = '<div class="novalue"></div>';
				}
			}
		}, 'json');
		$_id('loadings').style.display = 'none';
	},
	creatCont: function creatCont(data) {
		console.log(data.Tobe);
		var pushdata = '<li onclick="signinlsts.loadurl(' + data.scheduleid + ',' + classid + ')"><div class="signinlst-cont"><h3>' + data.adddate + '</h3>';
		pushdata += '<div class="clearfix"><div class="sign-col"><div>教师：' + data.teachername + '</div></div>';
		pushdata += '<div class="sign-col"><div>上课人数：' + data.Tobe + '人</div></div></div>';
		pushdata += '<div class="clearfix"><ul class="signinlst-ul">';
		pushdata += '<li><span>上</span>' + data.GoToClass + '</li><li><span>假</span>' + data.leave + '</li>';
		pushdata += '<li><span>旷</span>' + data.absenteeism + '</li><li><span>补</span>' + data.makeup + '</li>';
		pushdata += '</ul></div><span><i  class="iconfont icon-jiantou-copy2"></i></span></div></li>';
		return pushdata;
	},
	loadurl: function loadurl(id, id2) {
		var url = "<?php echo M_URL('WeChat','editsigninstaus'); ?>";
		window.location.href = url + '?classid=' + id2 + '&scheduleid=' + id;
	}

});

signinlsts.list();

$_monitor.scroll.bottom(window, function () {
	$_id('loadings').style.display = 'block';
	signinlsts.list();
});
			
	</script>
</body>
</html>