<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>创建班级</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script> 
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>   
<style type="text/css">
	.classcreat-list{padding:1rem;}
	.classcreat-list li{padding-bottom: .5rem;}
	.classcreat-list li h4{font-weight: normal;font-size: .7rem;}
	.classcreat-list li div{position: relative;}
	.classcreat-list li div>button{margin-right: .5rem;border: solid 1px #EEEEEE; line-height: 1.8rem; text-align: center; color: #888; font-size: 0.75rem; min-width: 4rem; height: 1.8rem; background: #FFF; border-radius: 0.2rem;}
	.classcreat-list li div>button.active{background: #37A7ED;color: #FFF;}
	.classcreat-list li div>i{position: absolute;top: 0.2rem;right: 0.3rem;}
	.classcreat-list li input{border: 0.05rem solid #E5E5E5;width: 100%;height:1.8rem;text-indent:.3rem;}
	.classcreat-list li select{border: 0.05rem solid #E5E5E5;width: 100%;height:1.8rem;text-indent:.3rem;}
	.prices input{float: left;}
	.prices select{float: left;height: 1.9rem!important;margin: 0rem .5rem;}
	.prices span{float: left;line-height: 2rem;margin: 0rem 0.3rem;}
	#keshi{display: none;}
	#classcreat{text-align: center;position: relative;}
	#classcreat img{height: 5rem;width: 5rem;}
	#classcreat button{min-width: 7rem;}
	#classcreat .imgbox{height: 5rem;width: 5rem;margin: .5rem auto;overflow: hidden;}
	#classcreat input[type='file']{height:1.8rem;width:7rem;position: absolute;bottom: 0rem;left:50%;margin-left: -3.5rem;opacity: 0;}
	
</style>
<body class="stuinfo-wrap">
	<form action="<?php echo M_URL('WeChat','doclassadd','',GP('usertype-0')) ?>" method="post" id='myform' enctype="multipart/form-data">
	<div class="classcreat-list">
		<ul>
			<li>
				<h4>选择班级类型：</h4>
				<div>
					<select name="classlevel">
						<option value="0">大班</option>
						<option value="1">小班</option>
						<option value="2">1对1</option>
					</select>
					<i class="iconfont icon-jiantou-copy2"></i>
				</div>
			</li>
			<li>
				<h4>选择授课类型：</h4>
				<div>
					<select name="classType">
						<option value="1">面授+线上</option>
						<option value="2">线上</option>
						<option value="3">面授</option> 
					</select>
					<i class="iconfont icon-jiantou-copy2"></i>
				</div>
			</li>
			<li>
				<h4>班级名称：</h4>
				<div>
					<input type="text" name="title" id="" value="" />
				</div>
			</li>
			<li>
				<h4>计划招生：</h4>
				<div>
					<input type="text" style="width:90% ;" name="studentcount" id="" value="" /> 人
				</div>
			</li>
			<li>
				<h4>价格：</h4>
				<div class="prices clearfix">
					<input type="text" name="price" id="" value="" style="width:4rem" />
					<span>元 /</span>
					<input type="number" name="hourunit" id="keshi" value="" style="width:4rem" />
					<select name="chargeData"style="width: 4rem" onchange="chose(this)">
						<option value="0">月</option>
						<option value="1">季</option>
						<option value="2">年</option>
						<option value="4">课时</option>
					</select>
				</div>
			</li>
			<li>
				<h4>选择老师：</h4>
				<div>
					<select name="teacherid" id="teacherid">
						
					</select>
					<i class="iconfont icon-jiantou-copy2"></i>
				</div>
			</li>
		</ul>
	</div>
	</form>
	<footer class="footer">
		<div class="clearfix" onclick="do_reg()">
			
			<div class="footer-foticon fb-orag">
				确认创建 
			</div>
			
		</div>
	</footer>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
		function do_reg() {
			$_id('myform').submit();
		}
		function chose(target) {
			if (target.value == 4) {
				$_id('keshi').style.display = 'inherit';
			} else {
				$_id('keshi').style.display = 'none';
			}
		}
		var classmin = new Object({
			list: function list() {
				var teacherid = $_id('teacherid');
				var ajax = {
					url: '/Json/index.php?act=WeChat.teacherlist',
					data: {}
				};

				$_post(ajax.url, ajax.data, function (res) {
					if (res.teacherlist) {
						getAll = res.teacherlist;
						getAll.map(function (val) {
							var alldata = classmin.creatCont(val);
							teacherid.addChilds(alldata);
						});
					}
				}, 'json');
			},
			creatCont: function creatCont(data) {
				if (data.name == '' || data.name == null) {
					data.name = data.username;
				}
				var pushdata = '<option value="' + data.userid + '">' + data.name + '</option>';
				return pushdata;
			}
		});
		classmin.list();
	</script>
</body>
</html>