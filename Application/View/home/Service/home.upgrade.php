<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/font.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/package.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/serverprice.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<style>
.gouxuan{
	background:url(<?php echo UOOT;?>Public/app/images/hook-ico.png);
	width: 20px;
    height: 20px;
    background-size: 100% 100%;
    display: -webkit-inline-box;
}
</style>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10" style="position: relative;">
		<!--header-->
	    <div class="ks-head-box">
     		<h3 class="ks-head-title2">升级服务</h3>
   		</div>
	     <div class="ks-head-tab">
 			<ul class="clearfix">
 				<li><a href="<?php echo M_URL('Service','myapp'); ?>">我的应用</a> </li>
 				<li class="curr"><a href="<?php echo M_URL('Service','upgrade');?>">升级套餐</a></li>
				<li><a href="<?php echo M_URL('Shop','CapacityService'); ?>">扩容服务</a> </li>
				<li><a href="<?php echo M_URL('Service','orderList'); ?>">我的订单</a> </li>
				<li><a href="<?php echo M_URL('Service','Cart'); ?>">我的购物车</a> </li>
 			</ul>
     	</div>
	    <!--header-->
		<!--widget-->
        <!--
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
			<span class="gTitle fsize16 ml10" >当前套餐：<?php echo $versionname;?></span>
		    <span class="gTitle fsize16 ml10">到期时间：<?php if($package=='v1'){echo '永远';}else{echo date('Y-m-d H:i',$websiteinfo['packendtime']);}?></span>
		   	<a class="gTitle fsize16 ml20 c-86A8F" href="<?php echo M_URL('Capital','packagebill');?>">查看套餐明细</a>
		   	<span class="gTitle fsize16 ml20">我的余额:<i><?php echo number_format($wxmoney,2);?></i></span>
		   	<a class="gTitle fsize16 ml20 c-86A8F" href="<?php echo M_URL('Capital');?>">充值</a>
		   	<a class="gTitle fsize16 ml10">代金券：<i class="c-red"><?php echo count($voucher)+count($taskVoucher);?></i>个</a>
		   	<a class="gTitle fsize16 ml10 c-86A8F" href="<?php echo M_URL('Capital');?>">查看代金券</a>
			</div>					
		</div> -->
		<!--/widget-->

        <!--
		<div class="pg-nav">
			<h5>科汛V名师通用版</h5>
			<p>免费快速搭建知识付费微门户。基础功能全开放</p>
		</div>
      	<div class="pg-list">
      		<ul class="clearfix">
      			<li class="col-2">
      				<div class="pg-list-item">
      					<span><img src="<?php echo UOOT;?>Public/app/images/appicon/icon_knowledge.png"></span>
      					<h5>知识管理</h5>
      					<p>满足各种形式和变现需求</p>
      				</div>
      			</li>
      			<li class="col-2">
      				<div class="pg-list-item">
      					<span><img src="<?php echo UOOT;?>Public/app/images/appicon/icon_student.png"></span>
      					<h5>学员管理</h5>
      					<p>更好的管理网校学生</p>
      				</div>
      			</li>
				  <li class="col-2">
      				<div class="pg-list-item">
      					<span><img src="<?php echo UOOT;?>Public/app/images/appicon/icon_wechat.png"></span>
      					<h5>微门户</h5>
      					<p>微信一键分享，机构品牌快速传播</p>
      				</div>
      			</li>
				  <li class="col-2">
      				<div class="pg-list-item">
      					<span><img src="<?php echo UOOT;?>Public/app/images/appicon/icon_count.png"></span>
      					<h5>财务结算</h5>
      					<p>财务收入统计，一键提现等功能</p>
      				</div>
				  </li>
				  <li class="col-2" onclick="window.location.href='<?php echo M_URL('Shop','index','',GP('option-0')); ?>'">
					<div class="pg-list-item pg-list-mode">
      					<span><i class="iconfont icon-jiahao"></i></span>
      					<h5>添加模块</h5>
      				</div>	
				</li>
      		</ul>
      		<div class="pg-more" onclick="window.location.href='<?php echo M_URL('Shop','index','',GP('option-0')); ?>'">更多</div>
      	</div>
	-->
		<div class="add-version-content">
            
			<p>当前套餐：<?php echo wx_version($this->wxid); ?></p>
			<p>有 效 期:<span style="color:red;padding:0 5px"><?php echo(wx_version_tips($this->wxid,true));?></span></p>
            <button class="ks-heade-button ks-heade-code ks-head-primary" onclick="window.location.href='<?php echo M_URL('Shop','index','',GP('option-0')); ?>'">前往挑选开通应用</button>
            </p>
		</div>
	    <div class="add-version">
			<div class="add-version-"></div>
		</div>
		<div class="add-title">
			<h5>
				<div class="line-left"></div>
				<div class="line-right"></div>
				升级店铺套餐
			</h5>
		</div>
		<!-- 新报价 -->
		<div class="type-wrap mainContent">
        <div class="type">
            <div class="type-item type-item__normal">
                <div class="type-header type-header-one">
                    万人名师扶持计划
                </div>
                <div class="price-box">
                    <div class="type-price">
                        <span class="type-price-num">免费</span>
                        <span>/年</span>
                    </div>
                </div>
                <?php
                if (checkIsSpecialVersion($this->wxid)){
                    echo '<a href="#" class="type-btn type-btn-one">正在使用</a>';
                }else if ($version<1){

                    echo '<a href="/home.html/default/User/realName" class="type-btn type-btn-one">申请（限个体讲师）</a>';

                }else{ 
                    echo '<a href="#" class="type-btn type-btn-one"  style="cursor: not-allowed;">您已拥有更高版本</a>';

                }?>
               
                <div class="function-service-text">功能：</div>
                <ul class="type-list type-list-one">
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">专属电子名片，一键打造私域圈</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">图文、音视频、直播多种课程形式</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">微信自动登录，快速获取目标客户</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">专业财务管理，订单明细一目了然</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">一键发布活动，轻松打开流量渠道</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">O2O无缝衔接，线上下自由切换</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">师生答疑互动，教学互动无障碍</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">重要资料下载，灵活安排学习</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">课程分销市场，发掘明星代理学员</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">优惠券、VIP营销工具助力裂变</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">CRM管理，精准跟进学员线索</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">社群组交流，增强平台互动粘性</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">营销推广通知，一键送达目标学员</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">后台模块自定义，打造个性工作台</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">支持公众号+小程序快速展示</span>
                    </li>
                </ul>
                <div class="function-service-text">服务：</div>
                <ul class="type-list type-list-one">
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">客户服务：5*8小时专业指导</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">平台扶持：免平台使用费</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">流量扶持：音视频容量、流量免费</span>
                        <span style="padding-left: 25px;" class="type-li-text">扶持计划（空间100G，流量100G）超出部分按定价付费（见附件）</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">结算周期：T+7（名师有收益，提</span>
                        <span style="padding-left: 25px;" class="type-li-text">现仅收10%服务费）</span>
                    </li>
                </ul>
            </div>
            <!-- 基础运营版 -->
            <div class="type-item type-item__edu">
                <div class="type-header type-header-two">
                    基础运营版
                </div>
                <div class="price-box">
                    <div class="type-price">
                        <span>￥</span>
                        <span class="type-price-num">12888</span>
                        <span>/年</span>
                    </div>
<!--                    <div class="type-compare">-->
<!--                        <span class="type-compare-before">原价￥5999/年</span>-->
<!--                        <span class="type-compare-now">节省￥2000/年</span>-->
<!--                    </div>-->
                </div>
               
                <?php if ($version==1){
                        echo '<a href="javascript:;" onclick="addCart('.KS_C("V1_APPID").');doNone(event);" class="type-btn type-btn-two">正在使用，立即续费</a>';
                      }
                      else if ($version>1){
                          echo '<a href="javascript:;"  class="type-btn type-btn-two"  style="cursor: not-allowed;">您已拥有更高版本</a>';
                      }else{
                        echo '<a href="javascript:;" onclick="addCart('.KS_C("V1_APPID").');doNone(event);" class="type-btn type-btn-two">开通基础版</a>';
                      }
                ?>
                <div class="function-service-text">功能：</div>
                <ul class="type-list type-list-one">
                    <li class="type-list-title">
                        <span>包含</span>
                        <span class="blue-type-title">扶持计划</span>
                        <span>功能，以及:</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">支持子账号添加，实现多管理角色</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">支持自配收款账户，财务独立管理</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">独立公众号管理，构建微信生态圈</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">自定义门户装修，打造个性化平台</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">专属电子名片，一键打造私域圈</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">图文、音视频、直播多种课程形式</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">微信自动登录，快速获取目标客户</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">专业财务管理，订单明细一目了然</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">一键发布活动，轻松打开流量渠道</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">动态轻松分享，快速沉淀品牌内容</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">O2O无缝衔接，线上下自由切换</span>
                    </li>
                </ul>
                <div class="function-service-text">服务：</div>
                <ul class="type-list type-list-one">
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">客户服务：5*8小时专业指导</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">平台扶持：免平台使用费</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">流量扶持：音视频容量、流量免</span>
                        <span style="padding-left: 25px;" class="type-li-text">费扶持计划（见附件）</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">结算周期：T+7（名师有收益，提</span>
                        <span style="padding-left: 25px;" class="type-li-text">现仅收10%服务费）</span>
                    </li>
                </ul>
            </div>
            <!-- 高级运营版 -->
            <div class="type-item type-item__more">
                <div class="type-header type-header-three">
                    高级运营版
                </div>
                <div class="price-box">
                    <div class="type-price">
                        <span>￥</span>
                        <span class="type-price-num">28888</span>
                        <span>/年</span>
                    </div>
<!--                    <div class="type-compare">-->
<!--                        <span class="type-compare-before">原价￥9888/年</span>-->
<!--                        <span class="type-compare-now">节省￥3000/年</span>-->
<!--                    </div>-->
                </div>
                <?php if ($version==2){
                          echo '<a href="javascript:;" onclick="addCart('.KS_C("V2_APPID").');doNone(event);" class="type-btn type-btn-three">正在使用，立即续费</a>';
                      }
                      else if ($version>2){
                          echo '<a href="javascript:;"  class="type-btn type-btn-three"  style="cursor: not-allowed;">您已拥有更高版本</a>';
                      }else{
                          echo '<a href="javascript:;" onclick="addCart('.KS_C("V2_APPID").');doNone(event);" class="type-btn type-btn-three">开通高级版</a>';
                      }
                ?>
                <div class="function-service-text">功能：</div>
                <ul class="type-list type-list-one">
                    <li class="type-list-title">
                        <span>包含</span>
                        <span class="blue-type-title">基础版</span>
                        <span>功能，以及:</span>
                    </li>
                   
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">开通PC版网校，更完善学习体验</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">去科汛版权信息，独立展示品牌</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">专属电子名片，一键打造私域圈</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">图文、音视频、直播多种课程形式</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">微信自动登录，快速获取目标客户</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">专业财务管理，订单明细一目了然</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">CRM管理，精准跟进学员线索</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">营销推广通知，一键送达目标学员</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">后台模块自定义，打造个性工作台</span>
                    </li>
                </ul>
                <div class="function-service-text">服务：</div>
                <ul class="type-list type-list-one">
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">流量赠送：音视频容量、流量免费扶持计划（空间500G，流量 20G/月），超出部分按定价付费（见附件）</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">客户服务：7*12小时专业售后指</span>
                        <span  style="padding-left: 25px;"  class="type-li-text">导咨询</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">结算周期：T+7（未配置独立收</span>
                        <span style="padding-left: 25px;"  class="type-li-text">款时免服务费，配置独立收款后</span>
                        <span style="padding-left: 25px;"  class="type-li-text">财务自主管理）</span>
                    </li>
                </ul>
            </div>
            <div class="type-item type-item__more">
                <div class="type-header type-header-four">
                    钻石服务版
                </div>
                <div class="price-box">
                    <div class="type-price">
                        <span>￥</span>
                        <span class="type-price-num">52888</span>
                        <span>/年</span>
                    </div>
<!--                    <div class="type-compare">-->
<!--                        <span class="type-compare-before">原价￥19888/年</span>-->
<!--                        <span class="type-compare-now">节省￥3000/年</span>-->
<!--                    </div>-->
                </div>
                <?php if ($version==3){
                          echo '<a href="javascript:;" onclick="addCart('.KS_C("V3_APPID").');doNone(event);" class="type-btn type-btn-four">正在使用，立即续费</a>';
                      }
                      else if ($version>3){
                          echo '<a href="javascript:;"  class="type-btn type-btn-four">您已拥有更高版本</a>';
                      }else{
                          echo '<a href="javascript:;" onclick="addCart('.KS_C("V3_APPID").');doNone(event);" class="type-btn type-btn-four">开通钻石版</a>';
                      }
                ?>
                <div class="function-service-text">功能：</div>
                <ul class="type-list type-list-one">
                    <li class="type-list-title">
                        <span>包含</span>
                        <span class="blue-type-title">高级版</span>
                        <span>功能，以及:</span>
                    </li>
                     <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">支持自定义域名，品牌展示更多元</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">增加推广中心功能，发展代理店铺</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">同步免费享受微门户新开发的功能</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">支持独立小程序应用</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">专业财务管理，订单明细一目了然</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">一键发布活动，轻松打开流量渠道</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">优惠券、VIP营销工具助力裂变</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">CRM管理，精准跟进学员线索</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">社群组交流，增强平台互动粘性</span>
                    </li>
                </ul>
                <div class="function-service-text">服务：</div>
                <ul class="type-list type-list-one">
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">流量赠送：扶持补贴流量（空间不限量）、第三</span>
                        <span style="padding-left: 25px;"  class="type-li-text">方存储等其他费用</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">客户服务：7*12小时专业售后指</span>
                        <span style="padding-left: 25px;"  class="type-li-text">导咨询，1对1专属售后顾问对接</span>
                    </li>
                    <li class="type-li">
                        <i class="gouxuan"></i>
                        <span class="type-li-text">结算周期：T+7（未配置独立收</span>
                        <span style="padding-left: 25px;"  class="type-li-text">款时免服务费，配置独立收款后</span>
                        <span style="padding-left: 25px;"  class="type-li-text">财务自主管理）</span>
                    </li>
                </ul>
            </div>              
        </div>
    </div>

 

		<!-- 
      	<div class="addsever">
      		<div class="add-title">
      			<h5>
					<div class="line-left"></div>
					<div class="line-right"></div>
						增值服务
				</h5>
      		</div>
      		
      		<div class="add-list">
      			<ul class="clearfix">
      				<?php foreach($appinfo as $k=>$v){?>
      				<li style="height:180px;">
      					<div class="add-list-item">
                             
                              <div>
                                  <div class="add-list-img" style="cursor:pointer" onclick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']); ?>'">
                                      <img src="<?php echo $v['defaultpic'];?>" />
                                  </div>
                                  <h5 style="cursor:pointer" onclick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']); ?>'">
                                      <?php echo $v['appname'];?>
                                  </h5>
                                  <p style="cursor:pointer" onclick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']); ?>'">
                                      <?php echo $v['shortdesc'];?>
                                  </p>
                                  <div class="add-list-txt clearfix">
                                      <span class="add-list-l">
                                          <font>
                                              ￥<?php echo $v['price'];?>
                                          </font>元/<?php if($v['appchargetype']==0){echo '月';}elseif($v['appchargetype']==1){echo '季';}elseif($v['appchargetype']==2){echo '年';};?>
                                      </span>
                                      <?php 
                                      if (wx_checkappisallow($v['appid'],$this->wxid)){
                                          if(appisopen($this->wxid,$v['appid'])==1){
                                              echo '<a class="add-list-btn add-list-default" style="cursor: not-allowed;">已开通</a>';
                                          }else{
                                              echo ' <a href="'. M_URL('Shop','index','',GP('option-0,appid-'.$v['appid'])).'" class="add-list-btn add-list-default">去开通</a>';
                                          }
                                      
                                     }else{
                                       ?>
                                      <?php if($v['isopen']==1){?>
                                      <a class="add-list-btn add-list-default appids<?php echo $v['appid'];?>" style="cursor: not-allowed;">已选购</a>
                                      <?php }elseif($v['price']==0){?>
                                      <a class="add-list-btn add-list-default" onclick="oppenFast(this,'<?php echo $v['appname'];?>','<?php echo M_URL('Index','open',$v["appid"]); ?>','<?php echo M_URL(GC($v['basictype']).'/Index','','',GP('appid-'.$v['appid'])); ?>');doNone(event);" cate="<?php echo $v['categoryid']; ?>">立刻开通</a>
                                      <?php }elseif($v['isopen']==0){?>
                                      <a class="add-list-btn add-list-default appids<?php echo $v['appid'];?>" onclick="addCart(<?php echo $v['appid']; ?>);doNone(event);">选购</a>
                                      <?php }
                                            }?>
                                  </div>
                              </div>
                              <?php
                                $showtips=wx_showappfree($v['allowversion']);
                               if (!empty($showtips)){
                                   echo '<div style="margin-top:5px;color:green;margin-left:-100px;text-align:center;margin-bottom:-20px;width:308px;padding:5px;">'.$showtips.'</div>';
                               }
                              ?>
      					</div>

      				</li>
      				<?php }?>
      			</ul>
      		</div>
		  </div>

 -->

		  <div class="addsever add-pay-style">
				<div class="add-title">	
					<h5>
						<div class="line-left"></div>
						<div class="line-right"></div>
						如果您对如何选择最合适版本不了解，请通过以下方式和我们取得联系
					</h5>
				</div>
				<div class="add-connect clearfix">
					<div class="add-items fl">
						<p>电话联系</p>
						<p class="add-items-phone">400-008-0263</p>
					</div>
					<div class="add-items fr">
						<p>在线咨询</p>
						<button class="ks-heade-button ks-head-bt2" id="qqclick"><i class="iconfont icon-qq"></i>QQ客服</button>
					</div>
				</div>								
			</div>
	</div>

	<!--footer-->
	<div class="add-footer">
		<form action="<?php echo M_URL('Service','doBatch');?>" method="post" >
		<div class="choice-service" onClick="addCar()">
			已选择服务：<span id="haveservice"><?php $cartnum = M('Application/LogModel')->cartnum();echo $cartnum;?></span><a class="triangle"><i class="iconfont icon-jiantou1"></i></a>
		</div>
		<div class="total-price">
			合计：<span id="cartmoney"><?php $cartmoney = M('Application/LogModel')->cartmoney();echo number_format($cartmoney,2);?></span>
		</div>
		<button class="go-purchase" value="2" name="batch" onClick="checknum()" <?php if($cartnum<=0){?>type="button" style="cursor: not-allowed;"<?php }else{?>type="submit"<?php }?>>去结算</button>
		<!--购物车-->
		<input type="hidden" id="cartstatus" value="<?php if($cartnum>0){echo 1;}else{echo 0;}?>" /> 
		<div class="add-car">
      		<div class="add-title1">已选服务 <i class="iconfont close-icon icon-shanchu" onClick="addCar()"></i></div>
      		<div class="add-pd">
	      		<table class="ks-table">
				    <tbody class="ks-tables">
	      			<?php foreach($pagecarts as $k=>$v){ 
                                $enddate=date('Y-m-d',Checktime($this->wxid,$v['appid']));
                                if ($v['appid']==KS_C("V1_APPID") || $v['appid']==KS_C("V2_APPID") || $v['appid']==KS_C("V3_APPID")){
                                    $wx_version_info = wx_version_info($this->wxid,$v['appid']);
                                    if ($wx_version_info!=null){
                                        $enddate=date('Y-m-d',strtotime("+1 year +".$wx_version_info['trans_days']." day")). "<div style='text-align:center;color:green'> (TIPS:升级后原套餐折算增加了：".$wx_version_info['trans_days']."天）</div>";
                                    }
                                }
                      ?>
	      			<tr class="appid<?php echo $v['appid'];?>">
	      				<td><input type="hidden" value="<?php echo $v['appid'];?>" name='appid[]'>
	      					<img src="<?php echo $v['defaultpic'];?>" style="width: 50px;display: block;"></td>
	      				<td><?php echo $v['appname'];?></td>
	      				<td><?php echo $v['price'];?>元/年</td>
						<td>购买后有效期至：<?php echo  $enddate;?></td>
						<td><i class="iconfont icon-shanchu1" onClick="delCart(<?php echo $v['appid']; ?>);doNone(event);"></i></td>
	      			</tr>
	      			<?php } ?>
					</tbody>
	      		</table>
	      	</div>		
      	</div>	
      	</form>		
	</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
		var $packageTarget = $('.package-list,.package-subtable');
		var $packageTitle = $packageTarget.find('.tr_title');
		var defalutIndex = $packageTarget.find('.label-on').index();
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
		$packageTarget.find('tr').each(function(){
			$packageTarget.find('tr').each(function(){
				$(this).find('td').eq(defalutIndex).addClass('td_active');
			});
		});
		$packageTarget.find('td').hover(function(){
			var tdIndex = $(this).index();
			if(tdIndex!=0){
				$packageTarget.find('tr').each(function(){
					$(this).find('td').eq(tdIndex).addClass('td_hover').siblings().removeClass('td_hover');
				});	
			}
		},function(){
			$packageTarget.find('td').removeClass('td_hover');
		}).click(function(){
			var tdIndex = $(this).index();
			if(tdIndex==0){return false;}
			$packageTitle.find('td').removeClass('label-on');
			$packageTarget.find('td').removeClass('td_active');
			var ratioTarget = $packageTitle.find('input[type="radio"]');
			for(var i=0;i<ratioTarget.length;i++){
				ratioTarget[i].checked = false;
			};
			$packageTitle.find('td').eq(tdIndex).find('input[type="radio"]')[0].checked = true;
			$packageTarget.find('tr').each(function(){
				$(this).find('td').eq(tdIndex).addClass('td_active').siblings().removeClass('td_active');
			});
			$packageTitle.find('td').eq(tdIndex).addClass('label-on');
			
			var packageLength = $packageTitle.find('td').length-1;
			var activePackageIndex = $packageTarget.find('.label-on').index();
			if(defalutIndex>activePackageIndex){
				$('#packbutton').html('请选择更高版本');
			}else if(defalutIndex<activePackageIndex){
				$('#packbutton').html('确定升级');
			}else if(defalutIndex=activePackageIndex){
				$('#packbutton').html('套餐续费');
			}
		});
		addCar();
	});
	function submitform(){
		var packageLength = $packageTitle.find('td').length-1;
		var activePackageIndex = $packageTarget.find('.label-on').index();
		if(defalutIndex>activePackageIndex){
			Alert('请选择比当前更高的版本');
			return false;
		}else if(activePackageIndex==1){
			Alert('请选择比当前更高的版本');
			return false;
		}; 
		$('#myform').submit();
	}
	function addCar() {
	    var cartstatus = $("#cartstatus").val();
		if(cartstatus==1){
		    open();
			$("#cartstatus").val(0);
		}else{
		    colse();
		    $("#cartstatus").val(1);
		}
	}
	function open(){
		$('.add-car').stop().css({
			display:'block',
			opacity:0
		}).animate({
			opacity:1,
			bottom:65
		},300)
	}
	function colse(){
		$('.add-car').animate({
			bottom:0,
			opacity:0
		},300,function(){
			$('.add-car').hide()
		})
	}
	function checknum(){
	   var cartstatus = $("#cartstatus").val();
	   if(cartstatus==1){
	   Alert('请先选择需要购买的服务');
	   }
	}
	function addCart(appid){
			var url = "<?php echo M_URL('Ajax','addCart2');?>";
			$.ajax({
				type:"post",
				url:url,
				data:{'appid':appid},
				dataType:"json",
				success:function(data){
					if(data.result=='ok'){
                       if (appid==<?php echo KS_C("V1_APPID")?> || appid==<?php echo KS_C("V2_APPID")?> || appid==<?php echo KS_C("V3_APPID")?>){ 
                                 $('.appid<?php echo KS_C("V1_APPID");?>').remove();
                                 $('.appid<?php echo KS_C("V2_APPID");?>').remove();
                                 $('.appid<?php echo KS_C("V3_APPID");?>').remove();
                        }

						$("#haveservice").html(data.cartnum);
						$("#cartmoney").html(data.cartmoney);
					    $('.appids'+appid).replaceWith('<a class="add-list-btn add-list-default appids'+appid+'" style="cursor: not-allowed;">已选购</a>');
					    $('.ks-tables').append('<tr class="appid'+appid+'">'+
	      					'<td><input type="hidden" value="'+appid+'" name="appid[]">'+
	      					'<img src="'+data.value.defaultpic+'" style="width: 50px;display: block;"></td>'+
	      					'<td>'+data.value.appname+'</td>'+
	      					'<td>'+data.value.price+'元/年</td>'+
							'<td>购买后有效期至：'+data.value.adddate+'</td>'+
							'<td><i class="iconfont icon-shanchu1" onClick="delCart('+appid+');doNone(event);"></i></td>'+
	      					'</tr>');
					    if(data.cartnum<=1){
					         open();
							 $("button[name='batch']").prop('style','');
							 $("button[name='batch']").prop('type','submit');
							 $("#cartstatus").val(0);
						}
						

						//var cartNum = $("#cartNum").html();
						//$("#cartNum").html(parseInt(cartNum)+1);
						//Alert('添加购物车成功',2);
					}else if(data.result=='err'){Alert('该商品已经在购物车了喔');}
				}
			});
	}
	function delCart(appid){
			var url = "<?php echo M_URL('Ajax','delCart');?>";
			$.ajax({
				type:"post",
				url:url,
				data:{'appid':appid},
				dataType:"json",
     			success:function(data){
					if(data.result=='ok'){
					    $("#haveservice").html(data.cartnum);
						$("#cartmoney").html(data.cartmoney);
						$('.appids'+appid).replaceWith('<a class="add-list-btn add-list-default appids'+appid+'" onClick="addCart('+appid+');doNone(event);">选购</a>');
	                    $('.appid'+appid).remove();
						if(data.cartnum<=0){
						     colse();
							 $("button[name='batch']").prop('style','cursor: not-allowed;');
							 $("button[name='batch']").prop('type','button');
							 $("#cartstatus").val(1);
						}
					}
				}
			});
	}
	function oppenFast(t,title,url,myurl){
		    var cate  = $(t).attr('cate');
	        $.ajax({
	            type:"get",
	            url:url,
	            success:function(data,textStatus){
	            	if(data.result=='succeed'){
	            		 $.cookie('indoor','/home.html/default/Shop/index?option-0',{expires:7,path:'/'});
				         parent.location.reload();
	            	}else{
	            		$('body').append(data);
	            	}
	           },
	           error:function(){
				   //location.reload();
	               //Alert("网络延迟,重新操作!");
	           }
	        })
		};
</script>
</body>
</html>