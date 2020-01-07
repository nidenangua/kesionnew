<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>首页</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/welcome.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
.emptycss {text-align: center;padding: 12px 0px 170px 0px;color: #ccc;font-size: 14px;background: url(/Public/app/images/empty.png) center 45px no-repeat;}
.ui-slide-item{	height: 200px;	width: 240px;}
.ui-slide{	overflow: hidden;	position: relative;	width: 240px;	margin:0 auto;height: 211px;}
.ui-slide-image{	display: none;	}
.ui-slide-image-focus{	display: block;}
.arrow{	width: 240px;	height: 40px;	position: absolute;	top: 100px;	margin-top: -20px;}
.arrow{		width: 240px;	height: 40px;	position: absolute;	top: 100px;	margin-top: -20px;display: inline-block;	width: 40px;	height: 40px;	font-size: 24px;	color:#fff;	line-height: 40px;	text-align: center;}
.arrow-right{	float:right;	background-position-x: -40px;    right: 0;}
.ui-slide-process{	position: absolute;	bottom: 10px;	right: 0;	left: 0;	margin:0 auto;	height: 18px;	line-height: 18px;	text-align: center;}
.ui-slide-process-item{	display: inline-block;	width: 9px;height: 9px; border: solid 1px gray;border-radius: 50px;}
.ui-slide-process-item:hover,
.ui-process-focus{	background: #fff;}
.ui-slide-process-item:hover{	cursor: pointer;}
.ui-silde-text{position: absolute;bottom: 30px;    padding-left: 10px;font-size: 15px;color: #fff;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;width: 225px;font-weight:bold}

.ks-index-code img{max-width: 50%;display: block;margin: 0 auto;}
.ks-index-code span {text-indent: 2em;}
.ks-index-code strong {font-weight: bold;text-align: center;display: block;font-size: 15px;}
.tips {font-size:12px;margin-left:10px}
.tips a{color:#E5412C;padding-left:15px}
</style>
</head>
<body class="ks-wrap">

   
	<div class="ks-index-wrap">
	<!--//模块管理-->
		<div class="ks-index-content">
			<!--课程管理-->
			<div class="ks-index-box">
				<!--头部-->
				<div class="ks-module ks-wbox clearfix" style="padding-bottom: 10px;">
					<h3 class="ks-index-title ks-index-title1"><?php echo $websiteinfo['sitename'];?><span class="v-type"><?php echo wx_version($this->wxid);?></span>	
                            <?php

                            echo (wx_version_tips($this->wxid));
                            ?>
                            <button class="ks-heade-button ks-head-bt1">
                                访问微门户
                                <div class="module-code">
                                    <p>微信扫一扫访问</p>
                                    <img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'?f=m','L',4,'weimenhu');?>" />
                                    <a href="javascript:void(0)" onclick="copyUrl2()">
                                        <p>复制页面链接</p>
                                    </a>
                                </div>
                            </button>
</h3>
				</div>
				<!--运营数据-->
					<div class="ks-module ks-wbox clearfix">
					<h3 class="ks-index-title">网校数据</h3>
					<div class="ks-index-yy">
						<ul class="clearfix">
							<li>
								<span><?php echo ChkClng($payorderuser);?></span>
								<p>总付费学员</p>
							</li>
							<li>
								<span><?php echo ChkClng($daypayuser);?></span>
								<p>今日付费学员</p>
							</li>
							<li>
								<span><?php echo $dhits;?></span>
								<p>昨日新增学员</p>
							</li>
							<li>
								<span><?php echo number_format($ordernum,2);?></span>
								<p>今日总销售额(元)</p>
							</li> 
							<li>
								<span><?php echo number_format($withdrawmoney,2);?></span>
								<p>可提现余额(元)</p>
							</li>
						</ul>
					</div>
				</div>
				<!--//运营数据-->
				<div class="ks-module ks-wbox clearfix" id="modulelist">
					<h3 class="ks-index-title">模块管理</h3>
					<ul class="clearfix ks-module-ul">
						<?php $moduleLength = 0; if($module[1]){ $moduleLength++; ?> 
						<li class="col-2 col-md-2">
							<div class="module-box">
								<div class="module-icon m-icon2"><i class="iconfont icon-phoint"></i></div>
								<h5>微门户</h5>
								<p>手机就能管理网校</p>
								<div class="module-btn module-btn-news">
									<a class="main-link" href="<?php if($module[1]){echo M_URL('microportal/Index','',$info['tempMid'],GP('appid-36'));}?>">前往管理</a>
									<span class="icon-code">
										<i class="iconfont icon-erweima"></i>
										<div class="module-code">
											<p>微信扫码访问微门户</p>
                                            <img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'?f=m','L',4,'weimenhu');?>" />
											<a href="javascript:void(0)" onClick="copyUrl2()">复制页面链接</a>
											<script>
											function copyUrl2(){
												 var Url2=document.getElementById("url2");
												 Url2.select(); // 选择对象
												 document.execCommand("Copy"); // 执行浏览器复制命令
												 Alert("复制成功！您可在微信或浏览器打开",2);
											}
											</script>
										</div> 
									</span>
								</div>
							</div> 
						</li>
						<?php }?>
						<?php if($module[0]){ $moduleLength++; ?>
						<li class="col-2 col-md-2">
							<div class="module-box">
								<div class="module-icon m-icon1"><i class="iconfont icon-wangzhan"></i></div>
								<h5>PC网校</h5>
								<p>轻松拥有网站</p>
								<div class="module-btn module-btn-news">
									<a class="main-link" href="<?php if($module[0]){echo M_URL('Website','websitetemplate',0);}else{echo M_URL('Index','moduleswitch',0);}?>"><?php if($module[0]){?>前往管理<?php }else{?>免费开通<?php }?></a>
									<a href="http://<?php echo $info['domain'];?>" target="_blank">预览</a>
									<a href="<?php echo M_URL('Index','moduleswitch2',0);?>">关闭</a>
								</div>
							</div>
						</li>
						<?php }?>
						<?php if($module[2]){ $moduleLength++; ?>
						<li class="col-2 col-md-2">
							<div class="module-box ">
								<div class="module-icon <?php if(!empty($weixinstatus)){?>m-icon3<?php }?>"><i class="iconfont icon-weixin1"></i></div>
								<h5>微信公众号</h5>
								<p>轻松管理网校公众号</p>
								<div class="module-btn <?php if($module[2]){?>module-btn-news<?php }?>">
									<a class="main-link" href="<?php if($module[2]){echo M_URL('wechat/Index','index','',GP('appid-23'));}else{if(!empty($weixinstatus)){echo M_URL('Index','moduleswitch',2);}else{echo M_URL('wechat/Index','index','',GP('appid-23'));}}?>"><?php if($module[2]){if(!empty($weixinstatus)){?>前往管理<?php }else{?>前往授权<?php }}else{?>免费开通<?php }?></a>
									<a href="<?php echo M_URL('Index','moduleswitch2',2);?>">关闭</a>
									<?php if(!empty($weixinstatus)){?>
									<span class="icon-code">
										<i class="iconfont icon-erweima"></i>
										<div class="module-code">
											<p>微信扫码访问公众号</p>
											<img src="<?php echo $QRcode; ?>">
										</div> 
									</span>
									<?php }?>
								</div>
							</div>
						</li>
						<?php }?>
						<!--<?php if($module[3]){?>
						<li class="col-2 col-md-2">
							<div class="module-box ">
								<div class="module-icon <?php if(!empty($appletstatus)){?>m-icon4<?php }?>"><i class="iconfont icon-xiaochengxu2"></i></div>
								<h5>小程序</h5>
								<p>方便快捷拥有自己的小程序</p>
								<div class="module-btn <?php if($module[3]){?>module-btn-news<?php }?>">
									<a class="main-link" href="<?php if($module[3]){echo M_URL('applet/Index','','',GP('appid-25'));}else{if(!empty($appletstatus)){echo M_URL('Index','moduleswitch',3);}else{echo M_URL('applet/Index','index','',GP('appid-25'));}}?>"><?php if($module[3]){if(!empty($appletstatus)){?>前往管理<?php }else{?>前往授权<?php }}else{?>免费开通<?php }?></a>
									<a href="<?php echo M_URL('Index','moduleswitch2',3);?>">关闭</a>
									<?php if(!empty($appletstatus)){?>	
									<span class="icon-code">
										<i class="iconfont icon-erweima"></i>
										<div class="module-code">
											<p>微信扫码访问小程序</p>
											<img src="//ks.kesion.com/Images/QRcode/qrcode5d14ce15ebf715b481161dd16b400af5.png?&gt;">
										</div> 
									</span>
									<?php }?>
								</div>
							</div>
						</li>
						<?php }?>-->
						<!--<?php if($module[4]){?>
						<li class="col-2 col-md-2">
							<div class="module-box">
								<div class="module-icon  <?php if($module[4]){?>m-icon5<?php }?>"><i class="iconfont icon-erp"></i></div>
								<h5>ERP管理</h5>
								<p>提供报名、排课、上课、结课等功能</p>
								<div class="module-btn <?php if($module[4]){?>module-btn-news<?php }?>">
									<a class="main-link" href="<?php if($module[4]){echo M_URL('schedule/Index','index','',GP('appid-32'));}else{echo M_URL('Index','moduleswitch',4);}?>"><?php if($module[4]){?>前往管理<?php }else{?>免费开通<?php }?></a>
									<a href="<?php echo M_URL('Index','moduleswitch2',4);?>">关闭</a>
								</div>
							</div>
						</li>
						<?php }?>-->
						<?php if($module[5]){ $moduleLength++;?>
						<li class="col-2 col-md-2">
							<div class="module-box">
								<div class="module-icon <?php if($module[5]){?>m-icon6<?php }?>"><i class="iconfont icon-zhaosheng-zhaoshengguanli"></i></div>
								<h5>营销工具</h5>
								<p>3分钟即可创建自己的营销活动</p>
								<div class="module-btn <?php if($module[5]){?>module-btn-news<?php }?>">
									<a href="<?php if($module[5]){echo M_URL('h5market/Index','scheme','',GP('appid-26'));}else{echo M_URL('Index','moduleswitch',5);}?>" class="main-link"><?php if($module[5]){?>前往管理<?php }else{?>免费开通<?php }?></a>
									<a href="<?php echo M_URL('Index','moduleswitch2',5);?>">关闭</a>
								</div>
								
							</div>
						</li>
						<?php }?>
						<?php if($moduleLength < 4){?>
						<li class="col-2">
							<div class="module-box" onClick="openModule()">
								<div class="add-icon">
									<i class="iconfont icon-jiahao"></i>
									添加模块
								</div>
							</div>
						</li>
						<?php }?>
					</ul>
				</div>
			<!--//头部-->
		    <?php if($module[5]){?>
				<!--营销中心-->
				<div class="ks-module ks-wbox clearfix">
					<h3 class="ks-index-title ">营销中心</h3>
					<div class="ks-index-markting">
						<ul class="cleafix">
						    <?php if(ismoduleopen($this->wxid,31)){?>
							<li>
								<div class="markting-box" onClick="window.location.href='<?php echo M_URL('voucher/Index','','',GP('appid-31'));?>'">								
									<div class="markting-icon markting-icon1">
										<i class="iconfont icon-youhuiquan1"></i>
									</div>
									<div class="markting-txt">
										<h5>优惠券</h5>
										<p>领劵抵扣部分费用</p>
									</div>
								</div>
							</li>
							<?php }?>
                            <?php if(ismoduleopen($this->wxid,103,1019,1)){
                                      $url=M_URL('h5market/Index','collage','',GP('appid-103'));
                             }else{
                                     $url=M_URL('Shop','appDetail',103);
                             }
                            ?>
							<li>
								<div class="markting-box" onClick="window.location.href='<?php echo $url;?>'">								
									<div class="markting-icon markting-icon1">
										<i class="iconfont icon-pintuanzhongicon-"></i>
									</div>
									<div class="markting-txt">
										<h5>拼团</h5>
										<p>多人单享受优惠</p>
									</div>
								</div>
							</li>
                            <?php if(ismoduleopen($this->wxid,105,0,1)){
                                      $url = M_URL('Distribution','index','');
                                  }else{
                                      $url = M_URL('Shop','appDetail',105);
                                  }
                            ?>
                            <li>
                                <div class="markting-box" onClick="window.location.href='<?php echo $url;?>'">
                                    <div class="markting-icon markting-icon2">
                                        <i class="iconfont icon-guaguale"></i>
                                    </div>
                                    <div class="markting-txt">
                                        <h5>课程分销</h5>
                                        <p>分享赚佣金</p>
                                    </div>
                                </div>
                            </li>

                            <?php if(ismoduleopen($this->wxid,3,0,1)){
                                      $url = M_URL('users/Index','showgroup','',GP('appid-3'));
                                  }else{
                                      $url = M_URL('Shop','appDetail',3);
                                  }
                            ?>
                            <li>
                                <div class="markting-box" onClick="window.location.href='<?php echo $url;?>'">
                                    <div class="markting-icon markting-icon3">
                                        <i class="iconfont icon-hongbao"></i>
                                    </div>
                                    <div class="markting-txt">
                                        <h5>学员分组（VIP))</h5>
                                        <p>VIP会员营销</p>
                                    </div>
                                </div>
                            </li>
						
							<!-- <li>
								<div class="markting-box" onclick="window.location.href='<?php echo M_URL('h5market/Index','cjgame',20,GP('appid-26'));?>'">								
									<div class="markting-icon markting-icon3">
										<i class="iconfont icon-kanjia"></i>
									</div>
									<div class="markting-txt">
										<h5>砍价</h5>
										<p>邀请好友帮忙砍价</p>
									</div>
								</div>
							</li> -->
							<!-- <li>
								<div class="markting-box" onclick="window.location.href='<?php echo M_URL('h5market/Index','cjgame',14,GP('appid-26'));?>'">								
									<div class="markting-icon markting-icon3">
										<i class="iconfont icon-hongbao"></i>
									</div>
									<div class="markting-txt">
										<h5>抢红包</h5>
										<p>一起来抢红包</p>
									</div>
								</div>
							</li> 
							<li>
								<div class="markting-box" onClick="window.location.href='<?php echo M_URL('h5market/Index','cjgame',15,GP('appid-26'));?>'">								
									<div class="markting-icon markting-icon6">
										<i class="iconfont icon-guaguale"></i>
									</div>
									<div class="markting-txt">
										<h5>刮刮乐</h5>
										<p>开心刮大奖</p>
									</div>
								</div>
							</li>
							<li>
								<div class="markting-box" onClick="window.location.href='<?php echo M_URL('h5market/Index','cjgame',13,GP('appid-26'));?>'">								
									<div class="markting-icon markting-icon1">
										<i class="iconfont icon-zhuanpan"></i>
									</div>
									<div class="markting-txt">
										<h5>大转盘</h5>
										<p>转出你的幸运</p>
									</div>
								</div>
							</li>-->
							<!-- <li>
								<div class="markting-box" onclick="window.location.href='<?php echo M_URL('h5market/Index','doAddyouxi','',GP('appid-26,tab-2,option-0'));?>
'">								
									<div class="markting-icon markting-icon1">
										<i class="iconfont icon-jieri"></i>
									</div>
									<div class="markting-txt">
										<h5>节日活动</h5>
										<p>针对节日进行营销</p>
									</div>
								</div>
							</li> 
							<li>
								<div class="markting-box" onClick="window.location.href='<?php echo M_URL('h5market/Index','doAddyouxi','',GP('appid-26'));?>
'">								
									<div class="markting-icon markting-icon3">
										<i class="iconfont icon-youxi"></i>
										
									</div>	
									<div class="markting-txt">
										<h5>营销活动</h5>
										<p>助力销售</p>
									</div>
								</div>
							</li>
							<li>
								<div class="markting-box" onClick="window.location.href='<?php echo M_URL('h5market/Index','scheme','',GP('appid-26'));?>'">								
									<div class="markting-icon markting-icon3">
										<i class="iconfont icon-jiejuefangan"></i>
									</div>
									<div class="markting-txt">
										<h5>营销方案</h5>
										<p>更多方案助力招生</p>
									</div>
								</div>
							</li>-->
						</ul>
					</div>
				</div>
				<?php }?>
			<!--//营销中心-->
			<!--数据统计-->
			<div class="ks-module ks-wbox clearfix" style="position: relative;" id="dataAnalysis">
				<div class="ks-index-title">	
					<div class="ks-index-tab fr">
						<ul class="status">															
							<li class="curr">
								<a href="javascript:getData(1)">上周</a>
							</li>
							<li><a href="javascript:getData(2)">本周</a></li>
							<li><a href="javascript:getData(3)">本月</a></li>
							<li><a href="javascript:getData(4)">本季度</a></li>
							<li><a href="javascript:getData(5)">本年</a></li>
						</ul>
					</div>			
					数据分析
				</div>
				<div id="container" style="height: 500px;"></div>
			</div>
			<!--//数据统计-->
		<div class="ks-index-list">
			<!--每日资讯-->
			<div class="ks-index-item">	
				<div class="news-everyday">
					<div class="everyday-title ks-index-lt">
						<span class="everday-t">每日资讯</span>
						<!-- <a href="javascript:void(0)" onclick="webnews('now')"><span class="every-back" style="cursor:pointer;">返回今天</span></a> -->
					</div>
					<div class="everyday-box">
						<div class="banner-slide ui-slide">	
							<div class="ui-slide-block">
							<?php foreach ($newAry as $k => $v) { if($k==0){?>
								<div class="ui-slide-image ui-slide-image-focus">
									<a href="//store.kesion.com/home/articleDetail/<?php echo $v['id']?>" target='_blank' title='<?php echo $v['title']?>'>
									  <p class="ui-silde-text"><?php echo $v['title']?></p>	
									  
										<img class="ui-slide-item "  src="<?php echo Img($v['defaultpic'])?>">
									  </a>
								</div>
								
							<?php }else{?>
									<div class="ui-slide-image">
										<a href="//store.kesion.com/home/articleDetail/<?php echo $v['id']?>" target='_blank' title='<?php echo $v['title']?>'>
									  <p class="ui-silde-text"><?php echo $v['title']?></p>	
										
										<img class="ui-slide-item "  src="<?php echo Img($v['defaultpic'])?>">
									  </a>
									</div>
							<?php }}?>
							</div>		
							<!--<div class="ui-slide-arrow">-->		
								<a href="#1" class="arrow arrow-left"><i class="iconfont icon-jiantou-copy1"></i></a>		
								<a href="#1" class="arrow arrow-right"><i class="icon-jiantou-copy2 iconfont"></i></a>	
							<!--</div>-->	
							<div class="ui-slide-process">	
							<?php foreach ($newAry as $k => $v) { if($k==0){?>
								<span class="ui-slide-process-item ui-process-focus">&nbsp;</span>		
							<?php }else{?>
								<span class="ui-slide-process-item">&nbsp;</span>
							<?php }}?>	
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
			<!--开发状态-->
			<div class="ks-index-item">
				<div class="ks-index-lt">开发状态
					<a href="<?php echo M_URL('Massage','development');?>" class="ks-index-more">更多</a>
				</div>
				<div class="ks-index-sl">
					<ul>
						<?php $dlopval  = M('common_massage')->getAll('where 1=1 order by adddate desc limit 10');foreach($dlopval as $k=>$v){?>
						<li><a href="https://store.kesion.com/home/developDetail/<?php echo $v['id'];?>" target="_blank"><?php echo $v['title'];?></a></li>
						<?php }?>
					</ul>
				</div>
			</div>
			<!--//每日资讯-->
			
			<!--//每日资讯-->
			   <!--关注公众号-->
			<div class="ks-index-item">	
				<div class="ks-index-code">
					<img src="<?php echo UOOT;?>Public/app/images/appicon/wx-code.jpg">
					<p>
						<strong>科汛V名师微信公众号</strong>  <span>扫码关注及时了解产品动态，优惠活动，获取门户大咖的在线教育运营经验</span>
					</p>	
				</div>
			</div>
			<!--//每日资讯-->
			<div class="ks-index-item">
				<div class="ks-index-lt">常见问题
					<a href="https://store.kesion.com/home/help" target="_blank" class="ks-index-more">更多</a>
				</div>
				<div class="ks-index-qu clearfix">
					<div class="ks-index-qi">
						<a href="https://store.kesion.com/home/help#anchor104" target="_blank">
						<div class="ks-index-qicon">
							<i class="iconfont icon-tuwen"></i>
							<p>添加图文</p>
						</div>
						</a>
					</div>
					<div class="ks-index-qi">
						<a href="https://store.kesion.com/home/help#anchor143" target="_blank">
						<div class="ks-index-qicon">
							<i class="iconfont icon-yinpinzhibox"></i>
							<p>添加音频</p>
						</div>
						</a>
					</div>
					<div class="ks-index-qi">
						<a href="https://store.kesion.com/home/help#anchor144" target="_blank">
						<div class="ks-index-qicon">
							<i class="iconfont icon-dianbo1"></i>
							<p>添加点播</p>
						</div>
						</a>
					</div>
					<div class="ks-index-qi">
						<a href="https://store.kesion.com/home/help#anchor58" target="_blank">
						<div class="ks-index-qicon">
							<i class="iconfont icon-zhibo1"></i>
							<p>添加直播</p>
						</div>
						</a>
					</div>
					<div class="ks-index-qi">
						<a href="https://store.kesion.com/home/help#anchor146" target="_blank">
						<div class="ks-index-qicon">
							<i class="iconfont icon-banji"></i>
							<p>添加班级</p>
						</div>
						</a>
					</div>
					<div class="ks-index-qi">
						<a href="https://store.kesion.com/home/help#anchor147" target="_blank">
						<div class="ks-index-qicon">
							<i class="iconfont icon-shijuan1"></i>
							<p>添加试卷</p>
						</div>
						</a>
					</div>
				</div>
				<ul>
					<?php foreach($ress as $k=>$v){?>
					<li><a href="https://store.kesion.com/home/questionDetail/<?php echo $v['id'];?>" target="_blank"><?php echo $v['title'];?></a></li>
					<?php }?>
				</ul>
			  </div>	
			  <div class="ks-index-item">	
				<div class="ks-index-lt">有问题找我们</div>
				<div class="ks-index-phone">
					<p>电话客服：400-101-1760</p>
					<p>客服邮箱：kesioncms@hotmail.com</p>
				
					<div class="ks-index-inline">
					   <button class="ks-heade-button ks-head-bt2" id="qqclick"><i class="iconfont icon-qq"></i>QQ客服</button>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<?php echo getSize($this->wxid);?>
                                 

	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.config.paths['indexCanvas'] = '<?php echo UOOT;?>Public/common/js/canvas.js';
		module.require(['$','backstage','highcharts','indexCanvas'],function(){
			$('.ks-index-tab li').click(function(){
				$(this).addClass('curr').siblings().removeClass('curr');
			});
			getData(2);
            $("#more").click(function(){
				var staus = $(this).attr("staus");
				if(staus=="false"){
					$("#morebox").css("height","100%");
					$('#more').html('向上收起');
					$(this).attr("staus",'true');
				}else{
					$("#morebox").css("height","200px");
					$('#more').html('向下展开');
					$(this).attr("staus",'false');
				}
			})	
			$('#qqclick').click(function(){
				var qdframe_id = 'qidian_wpa_2852156247_26';
				if(getId(qdframe_id)){
					$('#'+qdframe_id).contents().find('.btn-area').click()
				}else{
					var __qd = document.createElement('script');
					__qd.src = 'https://wp.qiye.qq.com/qidian/2852156247/870ef0e1cfd76ace1039a88b9b19b74e';
					__qd.id = 'qd2852156247870ef0e1cfd76ace1039a88b9b19b74e';
					document.getElementsByTagName('body')[0].appendChild(__qd);
					__qd.onload = function(){
						monitor();
						//监听客服加载情况
						function monitor(){
							var __iframe = document.getElementsByTagName('iframe');
							var qdframe;
							
							for(var i=0;i<__iframe.length;i++){
								__iframe[i].id === qdframe_id && (qdframe = __iframe[i])
							};
							if(qdframe){
								//
								$('#'+qdframe_id).contents().find('.btn-area').click()
							}else{
								
								setTimeout(function(){
									monitor()
								},100)
							}
						}
						
					}
				}
			});
			$.post('<?php echo M_URL('Interaction','getschedule'); ?>',{
				wxid:<?php echo $this->wxid  ?>
			},function(data){
				for(var i=0;i<data.values.length;i++){
					var item = data.values[i];
					var itemCode  = '<div class="ks-shcedule-info classlevel'+item.classlevel+'">'+
									'	<p>'+item.time+'</p>'+
									'	<p>'+item.classname+'</p>'+
									'	<p>'+item.name+'</p>'+
									'</div>';
					
					$('#'+item.element).append(itemCode)
				}
			},'json');
			webnews('now');
			getCourseList();
		});
		function webnews(type){
				if(type=='now'){
					var nowday = '<?php echo time();?>';
				}else if(type=='up'){
					var nowday = parseInt($('input[name="nowday"]').val())-86400;
				}else if(type=='down'){
					var nowday = parseInt($('input[name="nowday"]').val())+86400;
				}
			    $.post('<?php echo M_URL('Ajax','webnews'); ?>',{
					nowday:nowday
				},function(data){
					$('#nowday').html(data.nowday); 
					$('input[name="nowday"]').val(data.nowday1)
					if(data.value){
						$('#morebox').html(data.value.content);
						$('#more').show();
					}else{
						$('#morebox').html('<div class="emptycss">没有发现内容</div>');
						$('#more').hide();
					}
				},'json');			
		}	
		function openModule(){
			top.popup.open(false,{
				content:'<div class="select-module" id="selectModule">'+
						'	<ul class="clearfix">'+
						'		<?php if(!$module[0]){?><li><div class="module-icon iconfont icon-wangzhan"></div><h5>PC网校</h5><p>轻松拥有网站</p><a href="<?php echo M_URL('Index','moduleswitch',0); ?>" class="ks-bt bt-pur">免费开通</a></li><?php }?>'+
						'		<?php if(!$module[2]){?><li><div class="module-icon iconfont icon-weixin1"></div><h5>微信公众号</h5><p>轻松管理网校公众号</p><a href="<?php echo M_URL('Index','moduleswitch',2); ?>" class="ks-bt bt-pur">免费开通</a></li><?php }?>'+
						//'		<?php if(!$module[3]){?><li><div class="module-icon iconfont icon-xiaochengxu2"></div><h5>小程序</h5><p>方便快捷拥有自己的小程序</p><a href="<?php echo M_URL('Index','moduleswitch',3); ?>" class="ks-bt bt-pur">免费开通</a></li><?php }?>'+
						//'		<?php if(!$module[4]){?><li><div class="module-icon iconfont icon-erp"></div><h5>ERP管理</h5><p>提供报名、排课、上课、结课等功能</p><a href="<?php echo M_URL('Index','moduleswitch',4); ?>" class="ks-bt bt-pur">免费开通</a></li><?php }?>'+
						'		<?php if(!$module[5]){?><li><div class="module-icon iconfont icon-zhaosheng-zhaoshengguanli"></div><h5>营销工具</h5><p>3分钟即可创建自己的营销活动</p><a href="<?php echo M_URL('Index','moduleswitch',5); ?>" class="ks-bt bt-pur">免费开通</a></li><?php }?>'+
						'	</ul>'+
						'</div>',
				area:['auto','auto'],
				title:'添加模块'
			})
		}
		function slideCourseTab(ele,i){
			$(ele).addClass('curr').siblings().removeClass('curr');
			$('#courseTabBox').find('ul').hide().eq(i).show()
		}
		function getCourseList(__classlevel){
			$.post('<?php echo M_URL('Index','getClassList'); ?>',{
				classlevel:__classlevel
			},function(data){
				var __class    = data.class;
				var __course   = data.course;
				var classList  = '';
				var courseList = '';
				
				for(var i=0;i<__class.length;i++){
					classList += '<li><a href="'+__class[i].url+'">'+__class[i].title+'</a></li>'
				};
				for(var i=0;i<__course.length;i++){
					courseList += '<li><a href="'+__course[i].url+'">'+__course[i].title+'</a></li>'
				};
								
				$('#classList').html(classList);
				$('#courseList').html(courseList)
				
			},'json')
		}
      
		function getData(key){
			var dateHours  = ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"];
			if(key==1){
				dateHours  = ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"];
				$('#dataTabName').html('上周')
			}else if(key==2){	
				dateHours  = ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"];
				$('#dataTabName').html('本周')
			}else if(key==3){
				dateHours  = [];
				$('#dataTabName').html('本月')
			}else if(key==4){
				dateHours  = [];
				$('#dataTabName').html('本季度')
			}else if(key==5){
				dateHours  = ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"];
				$('#dataTabName').html('本年')
			}
                 
			var payorder   = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//成交订单数据
			var ordermoney = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//成交订单金额
			$.post('<?php echo M_URL('Index','orderdata');?>',{"type":key},function(data){
				payorder   = data.payorder;
				ordermoney = data.ordermoney;
		        if(key==3){
			       	 var len = payorder.length;
			       	 for(var i= 1;i<=len ;i++ ){
			       	 	dateHours[i-1]=i;
			       	 }
		        }else if(key==4){
		        	 var len = payorder.length;
			       	 for(var i= 1;i<=len ;i++ ){
			       	 	dateHours[i]=data.dateHours[i];
			       	 }
		        }
				Highcharts.chart('container', {
				    title: {
				        text: data.startday+'--'+data.endday,
				        align:'left'
				    },
				    subtitle: {
				        text: ''
				    },
					xAxis:{categories: dateHours},
				    yAxis: {
				        title: {text: '',}
				    },
				    legend: {
				        layout: 'vertical',
				        align: 'right',
				        verticalAlign: 'middle'
				    },
				    series: [{
				        name: '销售订单数',
				        data: payorder
				        },
				        {
				        name: '销售金额',
				        data: ordermoney,
				        color:"#FFD700",
				        }
				    ],
				    responsive: {
				        rules: [{
				            condition: {
				                maxWidth: 500
				            },
				            chartOptions: {
				                legend: {
				                    layout: 'horizontal',
				                    align: 'center',
				                    verticalAlign: 'bottom'
				                }
				            }
				        }]
				    }
				})
			},'json')	
		}
		function copyPortalUrl(txt) {
            var e = document.createElement("textarea");
            e.value = txt;
			e.select(); // 选择对象
			document.execCommand("Copy"); // 执行浏览器复制命令
			alert("复制链接成功！");
        }
		function getTodayCourse(){
			request('<?php echo M_URL('Index','getTodayClass'); ?>',function(data){
				if(!data.length){
					$('#todayCourse').show()[0].outerHTML = '<div class="nocourse">今日暂无课程</div>';
					return false
				};
				var itemList = '';
				for(var i=0;i<data.length;i++){
					var item = data[i];
					
					var type = (item.classlevel == 0 && '<span class="ks-index-big">大班课</span>') || (item.classlevel == 1 && '<span class="ks-index-mini">小班课</span>') || (item.classlevel == 2 && '<span class="ks-index-one">一对一</span>')
					itemList += '<tr>'+
								'	<td style="text-align: left;">'+item.title+'</td>'+
								'	<td class="ks-index-span">'+type+'</td>'+
								'	<td>'+item.teachername+'</td>'+
								'	<td><span class="ks-index-staus">'+item.time+'</span></td>'+
								'	<td><i onclick="addTypeChange(\''+item.startclass+'\',\'800px\',\'300px\',{title:\'上课\'})" class="iconfont icon-dashboard ks-index-staus"></i></td>'+					
								'</tr>'						
				};
				$('#todayCourse').show().find('tbody').html(itemList)
			},'json')
		}
	</script>
         
	<script type="text/javascript" src="<?php echo UOOT?>Public/common/js/jquery.js" ></script>
	<script type="text/javascript">
	$(function(){	
		$.fn.UiSearch=function(slideImage,slideProcessItem,arrowRight,arrowLeft,time){		
			var ui=$(this);
			var slideImage=$(slideImage);
			var processItem=$(slideProcessItem);		
			var len=slideImage.length;		
			var index3=0;		
			var timer;		//当点击右箭头的时候，下一张图片显示，当前图片隐藏，需要获得图片索引，		//当索引大于最后一张索引时，需返回到最开始那张		
			$(arrowRight,ui).on('click',function(){			forwardImage();		})		
			//当点击左箭头的时候，上一张图片显示，当前图片隐藏，需要获得图片索引，		
			// 当索引小于第一张索引时，返回到最后一张		
			$(arrowLeft,ui).on('click',function(){			backImage();		})		
			//当点击进度点时，切换图片		
			processItem.on('click',function(){		
				var currentCount=$(this).index();		
				changeImage(currentCount)
			})		
			function changeImage(index){			
			   slideImage.eq(index).show().siblings().hide().end();			
			   processItem.eq(index).addClass('ui-process-focus').siblings().removeClass('ui-process-focus').end();		
			}		//下一张图片显示，当前图片隐藏，需要获得图片索引，		//当索引大于最后一张索引时，需返回到最开始那张		
			function forwardImage(){		
				index3++;		
				changeImage(index3);		
				if (index3>=len) {			
					index3=0;				
					changeImage(index3);		
				}		
			}		//上一张图片显示，当前图片隐藏，需要获得图片索引，		// 当索引小于第一张索引时，返回到最后一张		
			function backImage(){			
			   index3--;			
			   changeImage(index3);			
			   if (index3<0) {			
			     	index3=len-1;			
			   	   changeImage(index3);			
			    }		
			}		//自动播放图片		
			function autoImage(){		 	
			   timer=setInterval(function(){			
			   	  forwardImage();			
			   	},time);		
            }	

            autoImage();		//当鼠标悬浮在图片时，停止自动播放	
			ui.on('mouseover',function(){			
				clearInterval(timer);			
			}) 		
			ui.on('mouseout',function(){		
				 autoImage();		
			})	
		}})
       $(function(){
			$(".ui-slide").UiSearch('.ui-slide-image','.ui-slide-process-item','.arrow-right','.arrow-left','5000');
		})
	</script>
<input type="text" style="height:0px;border:0px" id="url2" value="<?php echo shortchain(wx_Url($this->wxid).'?f=m');?>" />	
</body>
</html>