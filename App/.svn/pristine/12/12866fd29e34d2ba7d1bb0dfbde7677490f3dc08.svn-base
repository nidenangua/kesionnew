<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="https://basis.console.weimob.com/styles/app-b14d59b9.css" rel="stylesheet"> 
<link href="https://basis.console.weimob.com/styles/vendor-eff30d38.css" rel="stylesheet"> 
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<div class="col padder-l-xs main-fcontent"><!-- uiView:  -->
		<section class="vbox ng-scope" ui-view="" ng-class="{'scroll-y':$root.conScrollY}"><!-- uiView:  -->
			<section class="vbox ng-scope" ui-view="">
				<div class="wrapper-sm padder-l-xs h-full scroll-y ng-scope">
					<div class="r-3x box-shadow-2 bg-white wrapper-sm padder-sm m-h-full m-b-md pos-rlt">
						<div class="form-part" style="padding:0 10px;padding-bottom:23px;padding-top:13px">
							<span class="h5 font-bold">小程序设置</span> 
							<a class="pull-right pointer" href="" titlt="使用指南">使用指南</a>
						</div>
						<div class="pos-rlt load-height-120 ng-hide" ng-show="pageLoading">
							
						</div>
						<!-- ngIf: !pageLoading -->
						<div class="r-3x bg-gray wrapper padder-sm ng-scope" ng-if="!pageLoading">
							<!-- ngRepeat: MiniAppInfo in MiniAppInfoList --><!-- ngIf: !entity.isEmpower -->
							<div class="r-3x bg-white wrapper-xs padder-sm no-scroll ng-scope" ng-if="!entity.isEmpower">
								<div class="form-group m-t">
									<div class="m-t-md m-l clearrfix">
										<label class="control-label m-l-sm pull-left">授权说明</label>
										<label class="control-label m-l l-h-20">1、一个微信小程序仅可授权给一个科汛V名师网校；<br>2、为保证所有功能的正常使用，授权时请保持默认选择，把权限统一授权给科汛V名师；<br>3、新授权的小程序需与已授权的小程序及公众号主体一致；<br>4、您在该入口授权的公众账号类型为小程序，请在授权页面正确选择。</label>
									</div>
								</div>
								<div class="form-group">
									<div class="m-t-md m-l-md clearrfix">
										<label class="control-label pull-left">小程序类型</label> 
										<label class="control-label m-l">1、企业类型帐号，可以根据需要确定是否申请微信认证（认证入口：登录小程序—设置—基本设置—微信认证—详情）；<br>2、已认证帐号可使用微信支付权限，个人类型帐号暂不支持微信认证。</label>
									</div>
								</div>
							</div>
							<!-- end ngIf: !entity.isEmpower --><!-- ngIf: !entity.isEmpower -->
							<div class="r-3x bg-white wrapper-xs padder-sm m-t no-scroll w-full dis-table clearfix ng-scope" ng-if="!entity.isEmpower">
								<!-- ngIf: empowerbind -->
								<div ng-if="empowerbind" class="w-full w180 vertical-center ng-scope" style="vertical-align:middle;text-align:center;height:150px;display:table-cell"><!-- ngIf: pay_status!=1 -->
									<div ng-if="pay_status!=1" class="ng-scope"><br>
										<a href="<?php echo M_URL($this->AppName.'/Index','wechatConfig','',GP("")); ?>"  class="ks-bt bt-pue fn w100" >立即授权</a><br>
									</div>
									<!-- end ngIf: pay_status!=1 -->
									<!-- ngIf: register_status==0 -->
									<span ng-if="register_status==0" style="color:#9797A1;" class="ng-scope">未注册小程序，<a href="https://mp.weixin.qq.com/cgi-bin/wx" class="text-href" >立即申请</a></span>
									<!-- end ngIf: register_status==0 --><!-- ngIf: register_status==1 --> 
									<!-- ngIf: register_status==2 -->
								</div>
								<!-- end ngIf: empowerbind -->
							<!-- ngIf: pidbindchannel -->
							</div>
							<!-- end ngIf: !entity.isEmpower -->
						</div>
						<!-- end ngIf: !pageLoading -->
					</div>
				</div>
			</section>
		</section>
	</div> 
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>