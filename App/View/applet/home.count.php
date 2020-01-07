<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>小程序设置</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="https://basis.console.weimob.com/styles/app-2ac457ec.css" rel="stylesheet"> 
<link href="https://basis.console.weimob.com/styles/vendor-eff30d38.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap" style="background: #eef2f5;">
	<div class="col padder-l-xs main-content" style="background: #fff;border-radius: 10px;">
		<section class="vbox ng-scope">
			<section class="vbox ng-scope">
				<div class="wrapper-sm padder-l-xs h-full no-scroll ng-scope">
					<div class="r-3x  wrapper-sm padder-sm m-h-full m-b-md pos-rlt">
						<div class="clearfix">
							<div class="form-part" style="padding-bottom:23px;padding-top:13px;display: inline-block;float: left;">
							<span class="h5 font-bold">小程序设置</span> 
							</div>
							<div class="form-part" style="padding-bottom:23px;padding-top:13px;display: inline-block;float: right;">
								<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','AppletTemplist','',GP('',true)); ?> '">新建小程序</button>
							</div>
						</div>
						
						
						<!--循环开始-->
						<?php foreach($values as $k=>$v){ ?>
						<div class="r-3x bg-gray wrapper-sm pos-t-60 pos-b-50 pos-l-10 pos-r-10 ng-scope" style="margin-bottom: 40px;">
							<div class="h-full w-full pos-rlt scroll-y" >
								<div class="r-3x bg-white ng-scope"><div>
									<div class="hbox">
										<aside>
											
											<div class="pull-left w-full l-h-30 m-b-sm" style="padding-top: 10px;">
												<span class="inline pull-left w-90 text-right m-r-md">小程序名称</span> 
												<span class="inline pull-left w-200 ng-binding"><?php echo $v['weixinname']; ?></span>
												<span class="ng-scope">
													<?php if($v['issq']){ ?>
													<span class="inline pull-left text-muted ng-scope">账号信息更新时，可 
														<a  href="<?php echo M_URL($this->AppName.'/Index','wechatConfig','',GP("appletappid-".$v['appid'])); ?>" class="text-href ng-scope">重新授权</a>
													</span>
													<span class="inline pull-left m-l-sm">
														或者
													</span>
													<span class="pull-left inline m-l-sm ng-scope" >
														<a href="<?php echo M_URL($this->AppName.'/Index','unbindApplet','',GP("appletappid-".$v['appid'])); ?>" class="text-href ng-scope" >解除绑定</a>
													</span>
													<?php }else{ ?>
													<span class="inline pull-left text-muted ng-scope">
														<a  href="<?php echo M_URL($this->AppName.'/Index','wechatConfig','',GP("appletappid-".$v['appid'])); ?>" class="text-href ng-scope">授权</a>
													</span>
													<?php } ?>
												</span>
												<span class="clearfix"></span>
											</div>
											<?php if($v['issq']){ ?>
											<div class="pull-left w-full l-h-30 m-b-sm ng-scope">
												<span class="inline pull-left w-90 text-right m-r-md">微信认证</span> 
												<?php if($v['verify_type_info'] == '-1'){ ?>
												<span class="inline pull-left w-200 ng-binding">未认证 
												</span>
												<span class="inline pull-left">
													<a href="https://mp.weixin.qq.com/" class="text-href ng-scope">去认证</a>
												</span>
												<?php }else{ ?>
												<span class="inline pull-left w-200 ng-binding">已认证 
												</span>
												<?php } ?>
												<span class="clearfix"></span>
											</div>
											<div ng-if="MiniAppInfo.isAgentAccount==0" class="pull-left w-full l-h-30 m-b-sm ng-scope">
												<span class="inline pull-left w-90 text-right m-r-md">微信支付</span> 
												<span class="inline pull-left">
													<a  class="text-href" ><?php if($v['open_pay'] == 0){ echo '未开通';}else{ echo '已开通';} ?></a>
												</span> 
												<span class="clearfix"></span>
											</div>
											<div class="pull-left w-full l-h-30 m-b-sm">
												<span class="inline pull-left w-90 text-right m-r-md">体验者微信</span> 
												<?php if(empty($v['info'])){ ?>
													<span class="inline pull-left w-200 ng-scope">未绑定 </span>
												<?php }else{ ?>
													<span class="inline pull-left w-200 ng-scope">
														<span class="inline pull-left w-200 ng-binding ng-scope" >已有<?php echo count($v['info']); ?>个体验者 
															<a href="javascript:;" title="查看体验者微信"  class="m-r-xs">
																<span class="m-l-xs text-muted" onclick="look()">查看</span>
															</a>
															<div id="tyz" class="popover fade  ng-scope bottom in" style="top: 158px; left: 78.5781px; display: none; right: initial; max-height: 924px;">
																<div class="arrow" style="left: 160px;"></div>
																<div class="popover-inner">
																	<a class="close m-r-xs m-t-xs" onclick="tyzhide()">×</a>
																	<h3 class="popover-title">体验者微信</h3>
																	<div class="popover-content" style="min-width:320px">
																		<div class="row address-body">
																			<div class=" address-list ng-scope">
																				<?php foreach($v['info'] as $k=>$vt){ ?>
																					<div class="pointer" style="margin-left: 5px; width: 25%;display: inline-block;">
																						<span title="<?php echo $vt['wechatid']; ?>" class="text-ellipsis ng-binding ng-isolate-scope"><?php echo $v['wechatid']; ?></span>
																					</div>
																				<?php } ?>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</span>
													</span>
													<span class="inline pull-left">
														<span ng-if="MiniAppInfo.clearState != '2'" class="ng-scope">
															<a  title="绑定" class="text-href" onclick="opens1('<?php echo $v['appid'] ?>')">解除绑定</a> 
														</span>
													</span> 
												<?php } ?>
												<span class="inline pull-left" style="margin-left: 15px;">
													<span ng-if="MiniAppInfo.clearState != '2'" class="ng-scope">
														<a  title="绑定" class="text-href" onclick="opens('<?php echo $v['appid'] ?>')">绑定</a> 
													</span>
												</span> 
												<span class="clearfix"></span>
											</div>
											<div class="pull-left w-full l-h-30 m-b-sm ng-scope" >
												<span class="inline pull-left w-90 text-right m-r-md">
													<span ng-if="$index == 0" class="ng-scope">小程序类目</span>
												</span> 
												<?php if(empty($v['categories'])){ ?>
													<span class="inline pull-left ng-binding">未设置</span> 
												<?php }else{ ?>
													<span class="inline pull-left ng-binding">
														<?php if($v['categories']->first_class){ echo $v['categories']->first_class;} ?>
														<?php if(isset($v['categories']->second_class)){ ?>
															<span class="ng-binding ng-scope">&gt;<?php echo $v['categories']->second_class;?> </span>
														<?php } ?>
														<?php if(isset($v['categories']->third_class)){ ?>
															<span class="ng-binding ng-scope">&gt;<?php echo $v['categories']->third_class;?> </span>
														<?php } ?>
													</span> 
												<?php } ?>
												<span class="clearfix"></span>
											</div>
											<div class="pull-left w-full l-h-30 m-b-sm ng-scope" >
												<span class="inline pull-left w-90 text-right m-r-md">
													<span ng-if="$index == 0" class="ng-scope">安全域名设置</span>
												</span> 
												<a  title="一键设置" href="<?php echo M_URL($this->AppName.'/Index','modify_domain','',GP("appletappid-".$v['appid'])); ?>" class="text-href" >一键设置安全域名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ['注意必须设置该选项，否则会出现小程序异常等情况']</a> 
												<span class="clearfix"></span>
											</div>
											<div class="pull-left w-full l-h-30 m-b-sm ng-scope" >
												<span class="inline pull-left w-90 text-right m-r-md">
													<span ng-if="$index == 0" class="ng-scope">体验二维码</span>
												</span> 
												<a  title="体验二维码" target="_blank" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','get_qrcode','',GP("appletappid-".$v['appid']))?>','500px','510px',{title:'体验二维码'})" class="text-href" >体验二维码</a> 
												<span class="clearfix"></span>
											</div>
											<div class="clearfix"></div>
										</aside>
										<?php }else{ ?>
										<div class="empty">
											<p>请先授权后，在使用</p>
										</div>
										</aside>	
										<?php } ?>
										<aside class="w-lg">
											<div class="dis-table w-full h-300 b-l p-l-20 ng-scope" style="border-left-style:dashed;" >
												<div class="dis-table-cell w-full">
													<?php if($v['tempid'] && $v['issq'] && !$v['iscode']){?>
													<div class="w-full text-center m-b-md">
														<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','AppletTemplist','',GP("appletappid-".$v['appid'])); ?> '">重新选模版</button>
														<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','commit',$v['tempid'],GP("appletappid-".$v['appid'])); ?> '">上传审核</button>
													</div>
													<?php }elseif(!$v['tempid'] && $v['issq'] && !$v['iscode']){ ?>
													<div class="w-full text-center m-b-md">
														<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','AppletTemplist','',GP("appletappid-".$v['appid'])); ?> '">选择小程序模版</button>
													</div>
													<?php }elseif($v['tempid'] && !$v['issq'] && !$v['iscode']){ ?>
													<div class="w-full text-center m-b-md">
														<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','AppletTemplist','',GP("appletappid-".$v['appid'])); ?> '">重新选模版</button>
														<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','wechatConfig','',GP("appletappid-".$v['appid'])); ?> '">去授权绑定</button>
														<button type="button" style="width:240px; margin-top: 10px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','delectkong','',GP("appletappid-".$v['appid'])); ?> '">删除空模版</button>
													</div>	
													<?php }elseif($v['iscode']){ ?>
													<div class="w-full text-center m-b-md">
														<img src="<?php echo $v['qrcode_url']; ?>" style="width: 200px;height: 200px;">
														
														<?php if(!$v['isaudit']){ ?>
															<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','AppletTemplist','',GP("appletappid-".$v['appid'])); ?> '">重新选模版</button>
															<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','submit_audit','',GP("appletappid-".$v['appid'])); ?> '">提交审核</button>
														<?php }elseif($v['isaudit']==1){ ?>
															<button type="button" style="width:240px;" class="btn btn-sm w-sm">审核中...</button>
														<?php }else{ ?>
															<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','AppletTemplist','',GP("appletappid-".$v['appid'])); ?> '">重新选模版</button>
															<button type="button" style="width:120px;" class="btn btn-sm btn-primary w-sm">审核通过</button>
														<?php } ?>
													</div>
													<?php } ?>
													<div class="w-full text-gray-3">根据您的需要选择合适的小程序模版，选定后通过上传审核，即可生成小程序二维码。【二维码需要审核通过才可以扫描，如果上传后请先使用<a style="color: red;">体验版</a>进行体验】</div>
												</div>
											</div>
										</aside>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--循环结束-->
					<?php } ?>
				</div>
			</div>
		</section>
	</section>
</div>
<div class="modal fade ng-isolate-scope dialogs-default in" id="mtk" >
    <div class="modal-dialog modal-sm"  style="">
    	<div class="modal-content" modal-transclude="">
    		<form class="form-horizontal ng-scope ng-isolate-scope ng-pristine ng-valid" id="myform"  method="post" novalidate="novalidate" action="<?php echo M_URL($this->AppName.'/Index','bind_tester','',GP("")); ?>">
    			<div class="modal-header">
    				<button type="button" class="close" onclick="cancel()">×</button>
    				<h4 id="h4" class="modal-title ng-binding">绑定体验者</h4>
    			</div>
    			<div class="modal-body">
    				<div class="form-group"> 
    					<label class="col-sm-8 control-label m-l-md">请输入要<span class="ng-binding" id="wzts">绑定</span>的微信号</label>
    					<div class="col-sm-10 col-sm-offset-1">
    						<input type="hidden" name="appid" value="" />
    						<input type="text" class="form-control inline w200 mr10 m-t-sm ng-pristine ng-valid" name="name" data-rule-required="true" ng-model="entity.wechatid" style="" aria-required="true"> 
    							<label class="help-block error" for="title"></label>
    					</div>
    				</div>
    			</div>
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-primary ng-isolate-scope" btn-loading="saveloading" loading-text="保存中...">保存</button> 
    				<button type="button" class="btn btn-default" onclick="cancel()">取消</button>
    			</div>
    		</form>
    	</div>
    </div>
</div>






<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
</body>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs()
	})
	
	function cancel(){
		$('#mtk').css('z-index','-1');
		$('#mtk').css('display','none');
		$('#mtk').css('background','#595961');
	}
	function opens(appid){
		$('[name=appid]').val(appid);
		$('#mtk').css('z-index','1050');
		$('#mtk').css('display','block');
		$('#mtk').css('background','#595961');
		$('#h4').html('绑定体验者');
		$('#wzts').html('绑定');
		$('#myform').attr('action','<?php echo M_URL($this->AppName.'/Index','bind_tester','',GP("")); ?>,appletappid-'+appid);
	}
	function opens1(appid){
		$('[name=appid]').val(appid);
		$('#mtk').css('z-index','1050');
		$('#mtk').css('display','block');
		$('#mtk').css('background','#595961');
		$('#h4').html('解除体验者');
		$('#wzts').html('解除');
		$('#myform').attr('action','<?php echo M_URL($this->AppName.'/Index','unbind_tester','',GP("")); ?>,appletappid-'+appid);
	}
	function look(){
		$('#tyz').show();
	}
	function tyzhide(){
		$('#tyz').hide();
	}
</script>
</html>