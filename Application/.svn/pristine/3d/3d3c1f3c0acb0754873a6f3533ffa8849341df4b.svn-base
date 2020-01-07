<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>云市场</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/shop.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>

<body class=" ks-wrap">
	<div class="ks-wbox bRadius10">
	<!--header-->
     <div class="ks-head-box">
     	<h3 class="ks-head-title2">扩容服务</h3>
     </div>
     <!--header-->

			
		 <div class="ks-head-tab">
 			<ul class="clearfix">
 				<li><a href="<?php echo M_URL('Service','myapp'); ?>">我的应用</a> </li>
 				<li><a href="<?php echo M_URL('Service','upgrade');?>">升级套餐</a></li>
				<li class="curr"><a href="<?php echo M_URL('Shop','CapacityService'); ?>">扩容服务</a> </li>
				<li><a href="<?php echo M_URL('Service','orderList'); ?>">我的订单</a> </li>
				<li><a href="<?php echo M_URL('Service','Cart'); ?>">我的购物车</a> </li>
 			</ul>
     	</div>
		

		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
				<ul class="class-tab clearfix job-mtb">
	       			
			    </ul>
			</div>					
					
			<div class="fr">
						
			</div>	
		</div>
		<!--/widget-->
	     
		<!--table-->
		<div class="bRadius10">	
	
		<!--选项卡end-->

	<div class="cloud-container clearfix">


	<div class="cloud-sub clearfix"  >
		
	<div class="clound-item">
		<div class="shop-list-box " style="box-shadow: 0px 1px 5px #ccc; padding: 15px;border-radius: 10px;margin: 15px 20px;">
			<div class="shop-left fl">
				<img src="<?php echo UOOT;?>Public/app/images/classIcon/index-1.png">
					<span>点播服务</span>
			</div>
			<div class="shop-right fr">
				<ul>
					<li>
						<span>存储：<i class="c-86A8F"><?php  echo format_gt(getSize($this->wxid));?></i>/<?php echo showAvailableSpace($this->wxid); ?></span>
						<?php if (checkIsVip($this->wxid)!=3) {?>
							<span><a href="<?php echo M_URL('Shop','serviceRecord',3); ?>">空间详情</a></span>
						<?php }?>
						<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">空间详情：用于存储视频、图片、课件等的空间，升级高级运营版，获得空间扶持。 	</div></i></span>
					</li>
					<li>
						<span>流量：<i class="c-86A8F"><?php echo format_gt(getData($this->wxid)); ?></i>/<?php echo format_gt((getLimitService(3,1))/1024) ?></span>
						<span><a href="<?php echo M_URL('Shop','serviceRecord',4); ?>">流量详情</a></span>
				 		<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">流量：用于点播产生的视频流量，当点播流量不足您的学员将停止播放，建议及时充值。 	</div></i></span>
					</li>
					<li>
						<span>转码：<i class="c-86A8F"><?php echo Sec2Time(getLimitService(7,1)-getLimitService(7)); ?></i>/<?php echo Sec2Time((getLimitService(7,1))) ?></span>
						<span><a href="<?php echo M_URL('Shop','serviceRecord',7); ?>">转码详情</a></span>
						<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">流量：用于上传视频产生转码费用，当转码时长不足您的视频仅支持PC端上传MP4格式，且无法得到加密保护，建议及时充值。 	</div></i></span>
					</li>


				</ul>
			</div>
			<div class="clear"></div>
			<div class="shop-btn clearfix">
				<!--<button class="ks-bt bt-def mr10 " onClick="window.location='<?php echo M_URL('Shop','coludmanage',3); ?>'">升级空间</button>-->
				<button class="ks-bt bt-def mr10 "  onclick="window.location='<?php echo M_URL('Shop','coludmanage',4); ?>'">购买流量</button>
				<button class="ks-bt bt-def mr10 "  onclick="window.location='<?php echo M_URL('Shop','coludmanage',7); ?>'">购买转码时长</button>
			</div>
		</div>
	</div>
     <div class="clound-item">
			<div class="shop-list-box " >
				<div class="shop-left fl">
					<img src="<?php echo UOOT;?>Public/app/images/classIcon/index-5.png">
						<span>直播服务</span>
				</div>
				<div class="shop-right fr">
					<ul>
						<!--<li>
							<span><?php echo getLianmai($this->wxid); ?></span>
							<span><a href="<?php echo M_URL('Shop','serviceRecord',6); ?>">并发详情</a>  <a href="<?php echo M_URL('Shop','MonthConcurrent'); ?>">查看每月并发</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">直播并发指大班课及直播课程同一瞬间整个机构同时开班时允许进入听课的学生最大总人数。	</div></i></span>
						</li>-->
						<li>
							<span><i class="c-86A8F"></i>
							<a href="<?php echo M_URL('Shop','serviceRecord',5); ?>">
							<?php echo getLimitService(6); ?></span>
							<span>连麦币</span>
							</a>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">连麦币是用于1对1，小班课连麦互动时的消费货币。</div></i></span>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="shop-btn clearfix">
					<!--<button class="ks-bt bt-def mr10 " onclick="window.location='<?php echo M_URL('Shop','coludmanage',6); ?>'">购买并发数</button>-->
					<button class="ks-bt bt-def mr10 " onClick="window.location='<?php echo M_URL('Shop','coludmanage',5); ?>'">购买连麦币</button>
				</div>
			</div>
	</div>
	<div class="clound-item">
			<div class="shop-list-box " >
				<div class="shop-left fl">
					<img src="<?php echo UOOT;?>Public/app/images/classIcon/index-2.png">
						<span><a href="<?php echo M_URL('Shop','serviceRecord',1); ?>">短信服务</a></span>
				</div>
				<div class="shop-right fr">
					<ul>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(1,1);?></i></span>
							<span><a href="<?php echo M_URL('Shop','serviceRecord',1); ?>">短信总量</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">短信总量：该机构下的累计充值的短信总量 	</div></i></span>
						</li>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(1,1)-getLimitService(1);?></i></span>
							<span><a href="<?php echo M_URL('Shop','serviceRecord',1); ?>">已使用量</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">剩余量：该机构下的已发送的短信量 	</div></i></span>
						</li>
						<li>
							<span><a class="c-86A8F"><?php echo getLimitService(1);?></span>
							<span><a style="font-size: 14px;" href="<?php echo M_URL('Shop','serviceRecord',1); ?>">条剩余</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">剩余量：该机构下剩余短信数量 	</div></i></span>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="shop-btn clearfix">
					<button class="ks-bt bt-def mr10 "  onclick="window.location='<?php echo M_URL('Shop','coludmanage',1); ?>'">购买短信</button>
				</div>
			</div>
	</div>
	<div class="clound-item">
			<div class="shop-list-box " >
				<div class="shop-left fl">
					<img src="<?php echo UOOT;?>Public/app/images/classIcon/index-3.png">
						<span>邮件服务</span>
				</div>
				<div class="shop-right fr">
					<ul>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(2,1);?></i></span>
							<span><a href="<?php echo M_URL('Shop','serviceRecord',2); ?>">邮件总量</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">邮件总量：该机构下的所能发送的邮件总量 </div></i></span>
						</li>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(2,1)-getLimitService(2);?></i></span>
							<span><a href="<?php echo M_URL('Shop','serviceRecord',2); ?>">已使用量</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">剩余量：该机构下的已发送的邮件量</div></i></span>
						</li>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(2);?></i></span>
							<span><a href="<?php echo M_URL('Shop','serviceRecord',2); ?>">封剩余</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">剩余量：该机构下剩余邮件数量</div></i></span>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="shop-btn clearfix">					
					<button class="ks-bt bt-def mr10 "  onclick="window.location='<?php echo M_URL('Shop','coludmanage',2); ?>'">购买邮件</button>
				</div>
			</div>
	</div>
	</div>
	

	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll','cookie'],function(){
			loadScorllJs()
			$('#ks-content').height(window.innerHeight - $('.title-head').outerHeight()-$('#cloud-taps').outerHeight()-$('.footer-page').outerHeight());
			window.onresize = function(){
				$('#ks-content').height(window.innerHeight - $('.title-head').outerHeight()-$('#cloud-taps').outerHeight()-$('.footer-page').outerHeight());
			};loadScorllJs('#ks-content');
			$('.h5-tab li').click(function(){
				var index = $(this).index();
				$(this).addClass('active').siblings().removeClass('active');
			})
		});
	    /*授权认证*/
		function empower1(modulename){
		   // window.open('/home.html');
			var _html = '<div class="modal-box"><div class="modal-box-txt" style="height:150px;text-align:center;line-height:120px;font-size:14px;cursor:pointer" onClick="window.open(\'https://store.kesion.com/home/questionDetail/37\')">请在新窗口中完成主模块【'+modulename+'】的开通！<a style="color:#2a75ed">查看开通教程</a></div>'+
						'<div class="modal-btn" style="text-align:center;padding:10px;border-bottom:1px solid #eee"><button class="ks-bt bt-pue" style="float:none;display:inline-block;min-width:150px;height:40px;line-height:40px" onclick="frames[\'main\'].closepower(this)">确认</button>'+
						'</div>  </div>'	
					
			top.popup.open(false,{
				title:'提示',
				area:['550px','auto'],
				content:_html
			});
		}
		function addCart(appid){
			var url = "<?php echo M_URL('Ajax','addCart');?>";
			$.ajax({
				type:"post",
				url:url,
				data:{'appid':appid},
				dataType:"json",
				success:function(data){
					if(data==0){
						var cartNum = $("#cartNum").html();
						$("#cartNum").html(parseInt(cartNum)+1);
						Alert('添加购物车成功');
					}else if(data==-1){Alert('该商品已经在购物车了喔');}
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
	            		 $.cookie('indoor','/home.html/default/Shop/index?<?php echo GP('option-0');?>',{expires:7,path:'/'});
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





