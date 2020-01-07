<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title><?php echo $this->websiteInfo['wititle'];?></title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
   	<link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<style type="text/css">
.getNew-topTab{margin-bottom: .5rem;}
.getNew-topTab li{ float: left; width: 25%; text-align: center; height: 2.3rem; line-height: 2.3rem; background: #FFF; font-size: 0.75rem; }
.getNew-topTab li.active{ color:#37a7ed; }
.getNew-topTab li>div{  border-right:#EEEEEE solid 0.05rem; height: 2rem; line-height: 2rem; margin-top: 0.15rem;}
.getNew-list{padding: .5rem;}
.getNew-lstbox{background: #FFF;position: relative;padding:0.5rem 0.5rem 0rem 0.5rem;margin-bottom: 0.5rem;font-size: .7rem;}
.getNew-title{position: relative;padding-left:  6.5rem;min-height: 3rem;}
.getNew-title>img{position: absolute; width: 4.2rem; height: 3rem;left: 0px;top: 0px;border-radius:.2rem;}
.getNew-lgtitle{font-size: .75rem;line-height: .75rem;margin-bottom: 1rem;padding-top: 0.1rem;line-height:1.5}
.getNew-mark{color:#888;font-size: .5rem;overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;}
.getNew-bot{border-top:1px solid #EEEEEE;margin-top: 0.5rem;}
.getNew-bot .tab{width: 50%;float: left; text-align: center;line-height: 2rem;font-size: .75rem;}
.add{ width: 2.5rem; height: 2.5rem; background: -webkit-linear-gradient(top,#007BED,#00AEEB); /* Safari 5.1 - 6.0 */ background: -o-linear-gradient(top,#007BED,#00AEEB); /* Opera 11.1 - 12.0 */ background: -moz-linear-gradient(top,#007BED,#00AEEB); /* Firefox 3.6 - 15 */ background: linear-gradient(top,#007BED,#00AEEB); position: fixed; bottom: 40px; left: 0; right:0; margin: auto; border-radius: 50%; line-height: 3.5rem; text-align: center; }
#noword{text-align: center;line-height: 1rem;font-size: .7rem;}
.getNew-title>img {width: 6rem;height: 4rem;} 
.getNew-title {min-height: 4rem}
</style>
 
<body class="getNew-wrap">
	<page class="getNew-page" id="page2">
		<div class="loadings"></div>
		<section> 
			<div class="getNew-list">
				<ul id="getNew-list">
					<!--<li>
						<div class="getNew-lstbox blue-box_shadow">
							<div class="getNew-title">
								<img  src="<?php echo UOOT ?>/Public/app/images/201703251353.jpg" />
								<div class="getNew-lgtitle">打开就安分很深刻的龙卷风哈死绝了打开就安分很深刻的龙卷风哈死绝了</div>
								<div class="getNew-mark">打开就安分很深刻的龙卷风哈死绝了打开就安分很深刻的龙卷风哈死绝了 </div>
							</div>
				
							<div class="getNew-bot clearfix">
								<div class="tab">
									<div style="border-right: 1px solid #EEEEEE;">
										<a class="gray" href="">删除</a>
									</div>
								</div>
								
								<div class="tab">
									<div>
										<a class="blue" href="">编辑</a>
									</div>
								</div>
							</div>
						</div>
					</li>-->
				</ul>
				<div id="noword"></div>
			</div>
		</section>
		<div class="add" onclick="getNew.popup()">
			<img src="<?php echo UOOT ?>Public/wechat/images/add.png"/>
		</div>
	</page>	 
	<div id="loadings" class="loadings"></div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	

	var getNew = new Object({
		page: 0,
		total_pages: 0,
		classlevel: 'max',
		slideTab: function (target, id) {
			target.setClass('active', 'add').getSiblings().setClass('active', 'remove');
			$_id('getNew-list').innerHTML = '';
			getNew.classlevel = id;
			getNew.page = 0;
			getNew.list();
		},
		list: function () {
			getNew.page = getNew.page + 1;
			console.log(getNew.page);
			var getNews = $_id('getNew-list');
			var ajax = {
				url: '/Json/index.php?act=Microportal.getNews',
				data: {
					p: getNew.page,
					type: 'list'
				}
			};
			$_post(ajax.url, ajax.data, function (res) {
				if (res.getNews.newsList) {
					if (res.getNews.newsList.length > 0) {
						getNew.total_pages = res.getNews.page.total_pages;
						getAll = res.getNews.newsList;
						getAll.map(function (val) {
							var alldata = getNew.creatCont(val);
							getNews.addChilds(alldata);
						});
					} else {
						if (getNew.page == 1) {
							getNews.innerHTML = '<div class="novalue"></div>';
						}
					}
				} else {
					getNews.innerHTML = '<div class="novalue"></div>';
				}
			}, 'json');
		},
		creatCont: function (data) {
			var pushdata = '<li><div class="getNew-lstbox blue-box_shadow"><div class="getNew-title">';
			pushdata += '<img  src="' + data.defaultpic + '" />';
			pushdata += '<a href="' + data.url + '"><div class="getNew-lgtitle">' + data.title + '</div><div class="getNew-mark">' + data.abstract + '</div></a>';
			pushdata += '</div><div class="getNew-bot clearfix">';
			pushdata += '<div class="tab"><div style="border-right: 1px solid #EEEEEE;">';
			pushdata += '<a class="gray" onclick="getNew.del(' + data.id + ',this)">删除</a></div></div>';
			pushdata += '<div class="tab"><div><a class="blue" href="' + data.editurl + '">编辑</a></div></div></div></div></li>';
			return pushdata;
		},
		sheng: function (target, classid, status) {
			var ajax = {
				url: '/Json/index.php?act=WeChat.classeditstatus',
				data: {
					classid: classid,
					status: status
				}
			};
			if (status == -1) {
				var isdel = confirm('是否删除？');
			} else {
				var isdel = true;
			}
			if (isdel == true) {
				$_post(ajax.url, ajax.data, function (res) {
					if (status == 0) {
						target.innerHTML = '未审';
						target.setAttribute('class', 'o-btnOrag');
						target.setAttribute('onclick', 'getNew.sheng(this,' + classid + ',1)');
					} else if (status == 1) {
						target.innerHTML = '已审';
						target.setAttribute('class', 'o-btnBlue');
						target.setAttribute('onclick', 'getNew.sheng(this,' + classid + ',0)');
					} else {
						var pare = target.parentNode.parentNode.parentNode;
						pare.slideUp(400, function () {
							pare.remove();
						});
					}
				}, 'json');
			}
		},
		del: function (id, target) {
			console.log(id);
			var ajax = {
				url: '/Json/index.php?act=Microportal.deleteNews',
				data: {
					id: id
				}
			};

			$_post(ajax.url, ajax.data, function (res) {
				console.log(res);
				if (res.deleteNews) {
					if (res.deleteNews == true) {
						location.reload();
					}
				}
			}, 'json');
		},
		sing: function (classid) {
			window.location.href = "<?php echo M_URL('WeChat','signinlst'); ?>?classid=" + classid;
		},
		kebiao: function (classid) {
			window.location.href = "<?php echo M_URL('WeChat','myCourse'); ?>?classid=" + classid;
		},
		popup: function () {
			window.location.href = "<?php echo M_URL('WeChat','editNews'); ?>";
		}
	});
	getNew.list();

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
		if (getNew.page < getNew.total_pages) {
			getNew.list();
		} else if (getNew.page == getNew.total_pages) {
			$_id('noword').innerHTML = '没数据了，不信你看！';
		}
	});

	</script>
</body>
</html>