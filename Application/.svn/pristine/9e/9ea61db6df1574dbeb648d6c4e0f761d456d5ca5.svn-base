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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.ks-cf07b40 {color: #f07b40!important;}
.ks-cbox{margin-top: 0;}
.ks-state{margin-top: 0;}
.c-2878FF{color:#476dbe}
.c-6EC7E5 {color: #476dbe !important;}
.c-86A8F{color: #86A8F1;}
.ks-txtLeft h3{height: 20px;line-height: 20px;margin-bottom: 10px;}
.ks-first {margin-left: -15px;padding-left: 10px;border-left:3px solid #476dbe}
.ks-clist li{border-bottom: 1px solid #EEEEEE;border-radius: 0px;}
</style>
</head>
<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	<h3 class="ks-head-title">
	     		<div class="ks-head-nav" style="height: 16px;">
				<!--标题-->
				<a href="javascript:;">网站设置</a><span><em> / </em><a href="javascript:history.go(-1);">升级套餐</a><span> / </span>套餐明细</span>
				<!--标题-->
				</div>
			</h3>
	    </div>
	    <!--header-->
					     
			  
		<!--widget-->
		<div class="clearfix mt10  mb20">
			<div class="fl">
				<span style="font-weight: bold;font-size: 14px;line-height: 40px; margin-right: 20px;">当前套餐：<?php echo $versionname;?></span><a class="ks-bt bt-pue fn" href="<?php echo M_URL('Website','Packagelist'); ?>">升级</a>
			</div>
		</div>
		<!--/widget-->
		<!--table-->
		<div>
           <div class="ks-clist">
              <ul class="clearfix">
                <li>
            	<div class="ks-cbox clearfix">
					<div class="fl ks-txtLeft">
						<h3 class="ks-first">点播/直播服务</h3>
						<p>赠送点播空间(G)：<?php if(empty(wx_version_itemvalue('38',$this->wxid))){?>-----<?php }else{echo wx_version_itemvalue('38',$this->wxid);}?></p>
						<p>直播连麦服务(人/月)：<?php echo getLimitService(4);?>  <a href="<?php echo M_URL('Shop','coludmanage',6);?>" class="c-6EC7E5 ml10">购买</a></p>
					</div>
					<div class="fl ks-txtLeft">
						<h3></h3>
						<p>点播空间扩容(M)：<i class="c-2878FF"><?php echo round(getLimitService(5),2);?></i>/<?php echo round(getLimitService(5,1),2);?>  <a href="<?php echo M_URL('Shop','coludmanage',3);?>" class="c-6EC7E5 ml10">扩容</a></p>
						<p>视频加密：<?php if(wx_version_itemvalue('30',$this->wxid)==1){?>是<?php }else{?>否<?php }?></span></p>
					</div>
					<div class="fl ks-txtLeft">
						<h3></h3>
						<p>点播服务流量(元/G/月)：<?php echo round(getLimitService(3)/1024,2);?>/<?php echo round(getLimitService(3,1)/1024,2);?>  <a href="<?php echo M_URL('Shop','coludmanage',4);?>" class="c-6EC7E5 ml10">购买</a></p>
						<p>视频防盗链：<?php if(wx_version_itemvalue('31',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
					</div>
					<!--<div class="fl ks-txtLeft">
						<h3></h3><p></p>
					</div>-->
				</div>
		        </li>
			    <li>
	            	<div class="ks-cbox clearfix">
						<div class="fl ks-txtLeft">
							<h3 class="ks-first">短信/邮件服务</h3>
							<p>赠送短信(条)：<?php if(empty(wx_version_itemvalue('36',$this->wxid))){?>-----<?php }else{echo wx_version_itemvalue('36',$this->wxid);}?></p>
							<p>赠送邮件(封)：<?php if(empty(wx_version_itemvalue('37',$this->wxid))){?>-----<?php }else{echo wx_version_itemvalue('37',$this->wxid);}?></p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>短信服务(条) ：<i class="c-2878FF"><?php echo getLimitService(1);?></i>/<?php echo getLimitService(1,1);?>   <a href="<?php echo M_URL('Shop','coludmanage',1);?>" class="c-6EC7E5 ml10">购买</a></p>
							<p>邮件服务(封)：<i class="c-2878FF"><?php echo getLimitService(2);?></i>/<?php echo getLimitService(2,1);?>   <a href="<?php echo M_URL('Shop','coludmanage',2);?>" class="c-6EC7E5 ml10">购买</a></p>
						</div>
					</div>
		   		 </li>
		   		 <li>
	            	<div class="ks-cbox clearfix">
						<div class="fl ks-txtLeft">
							<h3 class="ks-first">资金服务</h3>
							<p>赠送代金券(元)：<?php if(empty(wx_version_itemvalue('1',$this->wxid))){?>-----<?php }else{echo wx_version_itemvalue('1',$this->wxid);}?></p>
							<p>学习卡：<?php if(wx_version_itemvalue('22',$this->wxid)==1){?>是<?php }else{?>否<?php }?> </p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>结算方式：<?php if(empty(wx_version_itemvalue('33',$this->wxid))){?>-----<?php }else{echo wx_version_itemvalue('33',$this->wxid);}?></p>
							<p>课程红包：<?php if(wx_version_itemvalue('21',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>可开启独立支付：<?php if(wx_version_itemvalue('41',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p></p>
						</div>
					</div>
		   		 </li>
		   		 <li>
	            	<div class="ks-cbox clearfix">
						<div class="fl ks-txtLeft">
							<h3 class="ks-first">营销服务</h3>
							<p>H5营销：<?php if(wx_version_itemvalue('6',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>课堂APP(通用)：<?php if(wx_version_itemvalue('7',$this->wxid)==1){?>是<?php }else{?>否<?php }?> </p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>微信公众号：<?php if(wx_version_itemvalue('4',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>学生端APP(通用)：<?php if(wx_version_itemvalue('8',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>微信小程序：<?php if(wx_version_itemvalue('5',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p></p>
						</div>
					</div>
		   		 </li>
		   		 <li>
	            	<div class="ks-cbox clearfix">
						<div class="fl ks-txtLeft">
							<h3 class="ks-first">网校服务</h3>
							<p>使用机构自己域名：<?php if(wx_version_itemvalue('3',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>附件对象存储：<?php if(empty(wx_version_itemvalue('10',$this->wxid))){?>-----<?php }else{echo wx_version_itemvalue('10',$this->wxid);}?></p>
							<p>考试系统(在线人数)：<?php if(wx_version_itemvalue('24',$this->wxid)==1){?>无限制<?php }else{echo wx_version_itemvalue('24',$this->wxid);}?></p>
							<p>考咨询系统：<?php if(wx_version_itemvalue('29',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>平台免费二级域名：<?php if(wx_version_itemvalue('2',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>APP应用市场(VIP应用)：<?php if(wx_version_itemvalue('20',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>课程系统：<?php if(wx_version_itemvalue('23',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>数据导入导出支持：<?php if(wx_version_itemvalue('28',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>学堂中心VIP风格：<?php if(wx_version_itemvalue('18',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>收费风格免费使用：<?php if(wx_version_itemvalue('19',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>课程系统：<?php if(wx_version_itemvalue('23',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>作业系统：<?php if(wx_version_itemvalue('25',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>拖拽风格：<?php if(wx_version_itemvalue('16',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>自定义网校页面：<?php if(wx_version_itemvalue('17',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>课程系统：<?php if(wx_version_itemvalue('23',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>名师系统：<?php if(wx_version_itemvalue('26',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
						</div>
					</div>
		   		 </li>
		   		 <li>
	            	<div class="ks-cbox clearfix">
						<div class="fl ks-txtLeft">
							<h3 class="ks-first">其他服务</h3>
							<p>QQ、微信账号通：<?php if(wx_version_itemvalue('29',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p>个性开发服务：<?php if(empty(wx_version_itemvalue('35',$this->wxid))){?>-----<?php }else{echo wx_version_itemvalue('35',$this->wxid);}?></p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>可开启独立登录：是</p>
							<p>免费电话技术咨询：<?php if(empty(wx_version_itemvalue('34',$this->wxid))){?>-----<?php }else{echo wx_version_itemvalue('34',$this->wxid);}?></p>
						</div>
						<div class="fl ks-txtLeft">
							<h3></h3>
							<p>web负载均衡：<?php if(wx_version_itemvalue('32',$this->wxid)==1){?>是<?php }else{?>否<?php }?></p>
							<p></p>
						</div>
					</div>
		   		 </li>
			</ul>
          </div>
	</div>
	    <!--/table-->
	            
		<form target="hidframe"  action="" method="post" id="myform">
		<div class="ks-bom clearfix">
			<span class="fl">
				<!--<button class="ks-bt bt-pue" type="submit" name="batch" value="1"><i class="iconfont icon-shanchu1"></i>批量删除</button>-->
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		</form>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			
		});
	
	
	</script>
<body class="ks-wrap">

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>