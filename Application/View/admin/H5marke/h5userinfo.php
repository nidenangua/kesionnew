
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="//store.kesion.com/Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="//store.kesion.com/Public/admin/css/html5.css" rel="stylesheet">
<link href="//store.kesion.com/Public/admin/css/general.css" rel="stylesheet">
<link href="//store.kesion.com/Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//store.kesion.com/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//store.kesion.com/Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//store.kesion.com/Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="//store.kesion.com/Public/common/js/jquery.js"></script>
</head>

<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<form target="hidframe"  method="post" target="hidframe"  action="//store.kesion.com/admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;网校管理
        	&nbsp;&nbsp;&nbsp;&nbsp;当前页机构个数&nbsp;&nbsp;<font color="#6094E8" size="5px">8</font>
        	&nbsp;&nbsp;&nbsp;&nbsp;当前页教师个数&nbsp;&nbsp;<font color="#6094E8"  size="5px">0</font>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			
					
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1">课程名称</option>
	  	    </select>
			   
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="">
            <input type="submit" class="sc-button" onclick="searchByClass('appid-6','//ks.kesion.com/home.html/course/Index/index','1')" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<div style="padding: 30px 0px;">
		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix">
			<li><input type="checkbox" id="selectAll"></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix">
					<a class="mr20">学生数 <i class="desc-i"></i></a>
					<a class="mr20">到期时间 <i class="desc-i"></i></a>
					<a class="mr20">总消费额 <i class="desc-i"></i></a>
				</div> 
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>网校模式：</span>
						<div>
							<a href="" class="active">不限</a>
							<a href="">机构</a>
							<a href="">教师</a>
						</div>
					</li>

					<li>
						<span>支付方式：</span>
						<div>
							<a href="" class="active">不限</a>
							<a href="">平台收取</a> 
							<a href="">机构收取</a>
						</div>
					</li> 

					<li>
						<span>营销模式：</span>
						<div>
							<a href="" class="active">不限</a>
							<a href="">已审核</a>
							<a href="">未审核</a>
						</div>
					</li>

					<li>
						<span>活动类型：</span>
						<div>
							<a href="" class="active">不限</a>
							<a href="">基础版</a>
							<a href="">入门版</a>
							<a href="">高级运营版</a>
							<a href="">高级版</a>
							<a href="">钻石版</a>
						</div>
					</li>					
 

				</ul>

			</li>				
		</ul>	
	</div>
	
	
	
	<style type="text/css">


</style>
	<div class="H5-gameListConts">
		<ul class="H5-gameList">
						<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" />
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src="undefined"></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									6666 • <span class="orange mr20">机构</span> <span class="lingBlue" style="font-size: 12px;">已认证</span>
									<div class="fr">
										
										<!--<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;-->
										<a href="//store.kesion.com/admin.php/home/Domain/editwx" class="deepBlue">编辑</a>
										<span class="grayLing">已审核</span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<div class="col-3">
											<div class="inline-block">
												网校ID：1033											</div>
											<div class="inline-block"> 
												用户ID：323											</div>
										</div>
										 
										<div class="col-3">
											<div class="inline-block">
												手机号码：18750912761											</div>
											<div class="inline-block"> 
												账户余额：￥1.00											</div>
										</div>
										<div class="col-3">
											<div class="inline-block">
												套餐类型：
												<a class="deepBlue" href="//store.kesion.com/admin.php/home/Domain/packagelog/42">
													入门版	
												</a>
											</div>
					 						<div class="inline-block"> 
												域名：tulinbo.kesion.com &nbsp;&nbsp;
							<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxeditDomain/42','600px','300px',{title:'域名修改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										<div class="col-3"> 
											<div class="inline-block">
												到期时间：<span class="deepBlue">2019-02-26</span>
											</div>
											<div class="inline-block"> 
												支付方式：平台收取 &nbsp;&nbsp;
												<a  onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpayment/42','600px','300px',{title:'支付方式更改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										
									</div>
									
									<div class="ks-operaRight fr">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxrecharge/1033','600px','450px',{title:'账户充值',type:'top'});">
												<i class="iconfont icon-chongzhifanxian"></i>
												<p class="class-name">充值</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Ico/massage/1033','800px','650px',{title:'发通知',type:'top'})">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">发通知</p>
											</a>
										
										</li>
										<li>
											<a href="tulinbo.kesion.com">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name" >预览网校</p>
											</a>
										</li>
										<li>
											<a href="//store.kesion.com/admin.php/home/Users/doreal/42">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">认证材料</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpersonal','800px','650px',{title:'个人资料'});">
												<i class="iconfont icon-zhanghuziliao"></i>
												<p class="class-name">个人资料</p>
											</a>
										
										</li>
										<li>
											<a>
												<i class="iconfont">253</i>
												<p class="class-name">用户管理</p>
											</a>
										
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
						<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" />
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src="undefined"></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									北大青鸟 • <span class="orange mr20">机构</span> <span class="lingBlue" style="font-size: 12px;">已认证</span>
									<div class="fr">
										
										<!--<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;-->
										<a href="//store.kesion.com/admin.php/home/Domain/editwx" class="deepBlue">编辑</a>
										<span class="grayLing">未审核</span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<div class="col-3">
											<div class="inline-block">
												网校ID：1032											</div>
											<div class="inline-block"> 
												用户ID：317											</div>
										</div>
										 
										<div class="col-3">
											<div class="inline-block">
												手机号码：15060737337											</div>
											<div class="inline-block"> 
												账户余额：￥0.00											</div>
										</div>
										<div class="col-3">
											<div class="inline-block">
												套餐类型：
												<a class="deepBlue" href="//store.kesion.com/admin.php/home/Domain/packagelog/41">
													基础版	
												</a>
											</div>
					 						<div class="inline-block"> 
												域名：188606080.kesion.com &nbsp;&nbsp;
							<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxeditDomain/41','600px','300px',{title:'域名修改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										<div class="col-3"> 
											<div class="inline-block">
												到期时间：<span class="deepBlue">2019-02-23</span>
											</div>
											<div class="inline-block"> 
												支付方式：平台收取 &nbsp;&nbsp;
												<a  onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpayment/41','600px','300px',{title:'支付方式更改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										
									</div>
									
									<div class="ks-operaRight fr">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxrecharge/1032','600px','450px',{title:'账户充值',type:'top'});">
												<i class="iconfont icon-chongzhifanxian"></i>
												<p class="class-name">充值</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Ico/massage/1032','800px','650px',{title:'发通知',type:'top'})">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">发通知</p>
											</a>
										
										</li>
										<li>
											<a href="188606080.kesion.com">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name" >预览网校</p>
											</a>
										</li>
										<li>
											<a href="//store.kesion.com/admin.php/home/Users/doreal/41">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">认证材料</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpersonal','800px','650px',{title:'个人资料'});">
												<i class="iconfont icon-zhanghuziliao"></i>
												<p class="class-name">个人资料</p>
											</a>
										
										</li>
										<li>
											<a>
												<i class="iconfont">253</i>
												<p class="class-name">用户管理</p>
											</a>
										
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
						<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" />
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src="//forsola.zuojy.com/Images/school/1031/201802/5a7e5717a807d.png"></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									sola • <span class="orange mr20">机构</span> <span class="lingBlue" style="font-size: 12px;">已认证</span>
									<div class="fr">
										
										<!--<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;-->
										<a href="//store.kesion.com/admin.php/home/Domain/editwx" class="deepBlue">编辑</a>
										<span class="grayLing">未审核</span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<div class="col-3">
											<div class="inline-block">
												网校ID：1031											</div>
											<div class="inline-block"> 
												用户ID：300											</div>
										</div>
										 
										<div class="col-3">
											<div class="inline-block">
												手机号码：13799742080											</div>
											<div class="inline-block"> 
												账户余额：￥0.00											</div>
										</div>
										<div class="col-3">
											<div class="inline-block">
												套餐类型：
												<a class="deepBlue" href="//store.kesion.com/admin.php/home/Domain/packagelog/40">
													基础版	
												</a>
											</div>
					 						<div class="inline-block"> 
												域名：forsola.kesion.com &nbsp;&nbsp;
							<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxeditDomain/40','600px','300px',{title:'域名修改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										<div class="col-3"> 
											<div class="inline-block">
												到期时间：<span class="deepBlue">2019-02-10</span>
											</div>
											<div class="inline-block"> 
												支付方式：平台收取 &nbsp;&nbsp;
												<a  onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpayment/40','600px','300px',{title:'支付方式更改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										
									</div>
									
									<div class="ks-operaRight fr">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxrecharge/1031','600px','450px',{title:'账户充值',type:'top'});">
												<i class="iconfont icon-chongzhifanxian"></i>
												<p class="class-name">充值</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Ico/massage/1031','800px','650px',{title:'发通知',type:'top'})">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">发通知</p>
											</a>
										
										</li>
										<li>
											<a href="forsola.kesion.com">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name" >预览网校</p>
											</a>
										</li>
										<li>
											<a href="//store.kesion.com/admin.php/home/Users/doreal/40">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">认证材料</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpersonal','800px','650px',{title:'个人资料'});">
												<i class="iconfont icon-zhanghuziliao"></i>
												<p class="class-name">个人资料</p>
											</a>
										
										</li>
										<li>
											<a>
												<i class="iconfont">253</i>
												<p class="class-name">用户管理</p>
											</a>
										
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
						<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" />
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src=""></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									 • <span class="orange mr20">机构</span> <span class="lingBlue" style="font-size: 12px;">已认证</span>
									<div class="fr">
										
										<!--<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;-->
										<a href="//store.kesion.com/admin.php/home/Domain/editwx" class="deepBlue">编辑</a>
										<span class="grayLing">未审核</span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<div class="col-3">
											<div class="inline-block">
												网校ID：1029											</div>
											<div class="inline-block"> 
												用户ID：287											</div>
										</div>
										 
										<div class="col-3">
											<div class="inline-block">
												手机号码：											</div>
											<div class="inline-block"> 
												账户余额：￥0.00											</div>
										</div>
										<div class="col-3">
											<div class="inline-block">
												套餐类型：
												<a class="deepBlue" href="//store.kesion.com/admin.php/home/Domain/packagelog/38">
													基础版	
												</a>
											</div>
					 						<div class="inline-block"> 
												域名：james.kesion.com &nbsp;&nbsp;
							<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxeditDomain/38','600px','300px',{title:'域名修改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										<div class="col-3"> 
											<div class="inline-block">
												到期时间：<span class="deepBlue">2019-01-30</span>
											</div>
											<div class="inline-block"> 
												支付方式：平台收取 &nbsp;&nbsp;
												<a  onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpayment/38','600px','300px',{title:'支付方式更改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										
									</div>
									
									<div class="ks-operaRight fr">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxrecharge/1029','600px','450px',{title:'账户充值',type:'top'});">
												<i class="iconfont icon-chongzhifanxian"></i>
												<p class="class-name">充值</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Ico/massage/1029','800px','650px',{title:'发通知',type:'top'})">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">发通知</p>
											</a>
										
										</li>
										<li>
											<a href="james.kesion.com">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name" >预览网校</p>
											</a>
										</li>
										<li>
											<a href="//store.kesion.com/admin.php/home/Users/doreal/38">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">认证材料</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpersonal','800px','650px',{title:'个人资料'});">
												<i class="iconfont icon-zhanghuziliao"></i>
												<p class="class-name">个人资料</p>
											</a>
										
										</li>
										<li>
											<a>
												<i class="iconfont">253</i>
												<p class="class-name">用户管理</p>
											</a>
										
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
						<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" />
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src="//qfwxyzsnj.zuojy.com/Images/school/1028/201801/2018012521523210.jpg"></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									前方网校 • <span class="orange mr20">机构</span> <span class="lingBlue" style="font-size: 12px;">已认证</span>
									<div class="fr">
										
										<!--<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;-->
										<a href="//store.kesion.com/admin.php/home/Domain/editwx" class="deepBlue">编辑</a>
										<span class="grayLing">已审核</span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<div class="col-3">
											<div class="inline-block">
												网校ID：1028											</div>
											<div class="inline-block"> 
												用户ID：272											</div>
										</div>
										 
										<div class="col-3">
											<div class="inline-block">
												手机号码：13736796205											</div>
											<div class="inline-block"> 
												账户余额：￥0.00											</div>
										</div>
										<div class="col-3">
											<div class="inline-block">
												套餐类型：
												<a class="deepBlue" href="//store.kesion.com/admin.php/home/Domain/packagelog/37">
													钻石版	
												</a>
											</div>
					 						<div class="inline-block"> 
												域名：qfwxyzsnj.kesion.com &nbsp;&nbsp;
							<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxeditDomain/37','600px','300px',{title:'域名修改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										<div class="col-3"> 
											<div class="inline-block">
												到期时间：<span class="deepBlue">2019-01-25</span>
											</div>
											<div class="inline-block"> 
												支付方式：平台收取 &nbsp;&nbsp;
												<a  onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpayment/37','600px','300px',{title:'支付方式更改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										
									</div>
									
									<div class="ks-operaRight fr">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxrecharge/1028','600px','450px',{title:'账户充值',type:'top'});">
												<i class="iconfont icon-chongzhifanxian"></i>
												<p class="class-name">充值</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Ico/massage/1028','800px','650px',{title:'发通知',type:'top'})">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">发通知</p>
											</a>
										
										</li>
										<li>
											<a href="qfwxyzsnj.kesion.com">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name" >预览网校</p>
											</a>
										</li>
										<li>
											<a href="//store.kesion.com/admin.php/home/Users/doreal/37">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">认证材料</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpersonal','800px','650px',{title:'个人资料'});">
												<i class="iconfont icon-zhanghuziliao"></i>
												<p class="class-name">个人资料</p>
											</a>
										
										</li>
										<li>
											<a>
												<i class="iconfont">253</i>
												<p class="class-name">用户管理</p>
											</a>
										
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
						<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" />
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src="//zhengyu.zuojy.com/Images/school/1024/201801/5a61a483ad3c9.png"></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									分享 • <span class="orange mr20">机构</span> <span class="lingBlue" style="font-size: 12px;">已认证</span>
									<div class="fr">
										
										<!--<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;-->
										<a href="//store.kesion.com/admin.php/home/Domain/editwx" class="deepBlue">编辑</a>
										<span class="grayLing">未审核</span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<div class="col-3">
											<div class="inline-block">
												网校ID：1026											</div>
											<div class="inline-block"> 
												用户ID：269											</div>
										</div>
										 
										<div class="col-3">
											<div class="inline-block">
												手机号码：17689412095											</div>
											<div class="inline-block"> 
												账户余额：￥0.00											</div>
										</div>
										<div class="col-3">
											<div class="inline-block">
												套餐类型：
												<a class="deepBlue" href="//store.kesion.com/admin.php/home/Domain/packagelog/35">
													基础版	
												</a>
											</div>
					 						<div class="inline-block"> 
												域名：naomimm.kesion.com &nbsp;&nbsp;
							<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxeditDomain/35','600px','300px',{title:'域名修改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										<div class="col-3"> 
											<div class="inline-block">
												到期时间：<span class="deepBlue">2019-01-22</span>
											</div>
											<div class="inline-block"> 
												支付方式：平台收取 &nbsp;&nbsp;
												<a  onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpayment/35','600px','300px',{title:'支付方式更改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										
									</div>
									
									<div class="ks-operaRight fr">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxrecharge/1026','600px','450px',{title:'账户充值',type:'top'});">
												<i class="iconfont icon-chongzhifanxian"></i>
												<p class="class-name">充值</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Ico/massage/1026','800px','650px',{title:'发通知',type:'top'})">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">发通知</p>
											</a>
										
										</li>
										<li>
											<a href="naomimm.kesion.com">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name" >预览网校</p>
											</a>
										</li>
										<li>
											<a href="//store.kesion.com/admin.php/home/Users/doreal/35">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">认证材料</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpersonal','800px','650px',{title:'个人资料'});">
												<i class="iconfont icon-zhanghuziliao"></i>
												<p class="class-name">个人资料</p>
											</a>
										
										</li>
										<li>
											<a>
												<i class="iconfont">253</i>
												<p class="class-name">用户管理</p>
											</a>
										
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
						<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" />
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src="//zhengyu.zuojy.com/Images/school/1024/201801/5a61a483ad3c9.png"></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									郑宇发财宝 • <span class="orange mr20">机构</span> <span class="lingBlue" style="font-size: 12px;">已认证</span>
									<div class="fr">
										
										<!--<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;-->
										<a href="//store.kesion.com/admin.php/home/Domain/editwx" class="deepBlue">编辑</a>
										<span class="grayLing">未审核</span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<div class="col-3">
											<div class="inline-block">
												网校ID：1024											</div>
											<div class="inline-block"> 
												用户ID：265											</div>
										</div>
										 
										<div class="col-3">
											<div class="inline-block">
												手机号码：15906002950											</div>
											<div class="inline-block"> 
												账户余额：￥0.00											</div>
										</div>
										<div class="col-3">
											<div class="inline-block">
												套餐类型：
												<a class="deepBlue" href="//store.kesion.com/admin.php/home/Domain/packagelog/33">
													基础版	
												</a>
											</div>
					 						<div class="inline-block"> 
												域名：zhengyu.kesion.com &nbsp;&nbsp;
							<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxeditDomain/33','600px','300px',{title:'域名修改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										<div class="col-3"> 
											<div class="inline-block">
												到期时间：<span class="deepBlue">2019-01-22</span>
											</div>
											<div class="inline-block"> 
												支付方式：平台收取 &nbsp;&nbsp;
												<a  onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpayment/33','600px','300px',{title:'支付方式更改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										
									</div>
									
									<div class="ks-operaRight fr">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxrecharge/1024','600px','450px',{title:'账户充值',type:'top'});">
												<i class="iconfont icon-chongzhifanxian"></i>
												<p class="class-name">充值</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Ico/massage/1024','800px','650px',{title:'发通知',type:'top'})">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">发通知</p>
											</a>
										
										</li>
										<li>
											<a href="zhengyu.kesion.com">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name" >预览网校</p>
											</a>
										</li>
										<li>
											<a href="//store.kesion.com/admin.php/home/Users/doreal/33">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">认证材料</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpersonal','800px','650px',{title:'个人资料'});">
												<i class="iconfont icon-zhanghuziliao"></i>
												<p class="class-name">个人资料</p>
											</a>
										
										</li>
										<li>
											<a>
												<i class="iconfont">253</i>
												<p class="class-name">用户管理</p>
											</a>
										
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
						<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" />
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src="//fenxue.zuojy.com/Images/school/1023/201801/5a6189b38ac6a.jpg"></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									锋学 • <span class="orange mr20">机构</span> <span class="lingBlue" style="font-size: 12px;">已认证</span>
									<div class="fr">
										
										<!--<i class="ok-icon iconfont ok-pe1 "></i> &nbsp;&nbsp;-->
										<a href="//store.kesion.com/admin.php/home/Domain/editwx" class="deepBlue">编辑</a>
										<span class="grayLing">未审核</span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<div class="col-3">
											<div class="inline-block">
												网校ID：1023											</div>
											<div class="inline-block"> 
												用户ID：264											</div>
										</div>
										 
										<div class="col-3">
											<div class="inline-block">
												手机号码：15656598639											</div>
											<div class="inline-block"> 
												账户余额：￥0.00											</div>
										</div>
										<div class="col-3">
											<div class="inline-block">
												套餐类型：
												<a class="deepBlue" href="//store.kesion.com/admin.php/home/Domain/packagelog/32">
													基础版	
												</a>
											</div>
					 						<div class="inline-block"> 
												域名：fenxue.kesion.com &nbsp;&nbsp;
							<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxeditDomain/32','600px','300px',{title:'域名修改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										<div class="col-3"> 
											<div class="inline-block">
												到期时间：<span class="deepBlue">2019-01-22</span>
											</div>
											<div class="inline-block"> 
												支付方式：平台收取 &nbsp;&nbsp;
												<a  onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpayment/32','600px','300px',{title:'支付方式更改',type:'top'});">
													<i class="iconfont icon-bianji1 deepBlue"></i></a>
											</div>
										</div>
										
										
									</div>
									
									<div class="ks-operaRight fr">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxrecharge/1023','600px','450px',{title:'账户充值',type:'top'});">
												<i class="iconfont icon-chongzhifanxian"></i>
												<p class="class-name">充值</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Ico/massage/1023','800px','650px',{title:'发通知',type:'top'})">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">发通知</p>
											</a>
										
										</li>
										<li>
											<a href="fenxue.kesion.com">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name" >预览网校</p>
											</a>
										</li>
										<li>
											<a href="//store.kesion.com/admin.php/home/Users/doreal/32">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">认证材料</p>
											</a>
										
										</li>
										<li>
											<a onclick="addTypeChange('//store.kesion.com/admin.php/home/Domain/wxpersonal','800px','650px',{title:'个人资料'});">
												<i class="iconfont icon-zhanghuziliao"></i>
												<p class="class-name">个人资料</p>
											</a>
										
										</li>
										<li>
											<a>
												<i class="iconfont">253</i>
												<p class="class-name">用户管理</p>
											</a>
										
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
					</ul>
		</div>
	<div>
		
		
		
	</div>
	</div>
	
	<br />	
	<br />	
	<br />	
	<br />	

</div>


<div class="footer-page h60">
                        <div class="col-sm-5">
                         <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                                <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                                <label for="checkboxAll">全选 </label>
                            </div>
                         
                            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量审核</button>
                            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">取消审核</button>
                            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
                        </div>

                        <div class="col-sm-7 " style="margin-top:7px">
                        	<div class="page-box"><ul class="pagination-digg"><a href="/admin.php/home/Domain/wxlist?p-1">首页</a>

<li class="previous-off">上一页</li>
<li class="active">1</li><li><a href="/admin.php/home/Domain/wxlist?p-2">2</a></li><li><a href="/admin.php/home/Domain/wxlist?p-3">3</a></li><a href="/admin.php/home/Domain/wxlist?p-2">下一页</a>

<a href="/admin.php/home/Domain/wxlist?p-3">末页</a>

</ul><div class="page-left">总计 23 个记录分为 3 页, 当前第 1 页 ,每页 <input type="text" class="page-input" value="8" id="pageSize" size="3"> </div></div>                    	</div>
</body>

</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>


