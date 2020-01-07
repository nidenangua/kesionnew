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
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">

	<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl other">
        		<span class="mr20">应用市场</span>
        	
        </h3>
      
    </div>
</div>

	
	

	
<div id="ksBoxContent" style="margin-top: 20px;">
<div class="ks-wbox  bRadius10">	
	<!--选项卡-->
    <!--选项卡end-->
	<div class="cloud-container clearfix">

	<!--网校计费服务-->	
	<div class="cloud-sub clearfix"  >
	
		<div class="clound-item">
			<div class="shop-list-box " >
				<div class="shop-left fl">
					<img src="<?php echo UOOT;?>Public/app/images/classIcon/index-1.png">
						<span>点播服务</span>
				</div>
				<div class="shop-right fr">
					<ul>
						<li>
							<span><i class="c-86A8F"><?php echo getSize($this->wxid); ?><G</i>/<?php echo (getLimitService(5,1,$this->wxid))/1024; ?>G</span>
							<span><a href="<?php echo M_URL('home/Domain','serviceRecord',3,GP('wxid-'.$this->wxid)); ?>">空间详情</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">空间详情：用于存储的空间 	</div></i></span>
						</li>
						<li>
							<span><i class="c-86A8F"><?php echo getVodAvailableTraffic($this->wxid); ?>G</i>/<?php echo (getLimitService(3,1,$this->wxid))/1024 ?>G</span>
							<span><a href="<?php echo M_URL('home/Domain','serviceRecord',4,GP('wxid-'.$this->wxid)); ?>">流量详情</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">流量：用于点播产生的视频流量 	</div></i></span>
						</li>
						
					</ul>
				</div>
				<div class="clear"></div>
				<div class="shop-btn clearfix">
					<button class="ks-bt bt-def mr10 " onClick="window.location='<?php echo M_URL('home/Domain','coludmanage',3,GP('wxid-'.$this->wxid)); ?>'">升级空间</button>
					<button class="ks-bt bt-def mr10 "  onclick="window.location='<?php echo M_URL('home/Domain','coludmanage',4,GP('wxid-'.$this->wxid)); ?>'">购买流量</button>
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
						<li>
							<span><?php echo getLianmai($this->wxid); ?></span>
							<span><a href="<?php echo M_URL('home/Domain','serviceRecord',6,GP('wxid-'.$this->wxid)); ?>">并发详情</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">并发详情：同时在线参与直播的人数 	</div></i></span>
						</li>
						<li>
							<span><i class="c-86A8F"></i>
								<a href="<?php echo M_URL('home/Domain','serviceRecord',5,GP('wxid-'.$this->wxid)); ?>">
								<?php echo getLimitService(6,'',$this->wxid); ?></span>
							    <span>连麦币</span>
							    </a>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">可抵用连麦所产生的费用</div></i></span>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="shop-btn clearfix">
					<button class="ks-bt bt-def mr10 " onClick="window.location='<?php echo M_URL('home/Domain','coludmanage',6,GP('wxid-'.$this->wxid)); ?>'">购买并发数</button>
			        <button class="ks-bt bt-def mr10 " onClick="window.location='<?php echo M_URL('home/Domain','MonthConcurrent','',GP('wxid-'.$this->wxid)); ?>'">查看每月并发</button>
					<button class="ks-bt bt-def mr10 " onClick="window.location='<?php echo M_URL('home/Domain','coludmanage',5,GP('wxid-'.$this->wxid)); ?>'">连麦币</button>
				</div>
			</div>
	</div>

	<div class="clound-item">
			<div class="shop-list-box " >
				<div class="shop-left fl">
					<img src="<?php echo UOOT;?>Public/app/images/classIcon/index-2.png">
						<span><a href="<?php echo M_URL('home/Domain','serviceRecord',1,GP('wxid-'.$this->wxid)); ?>">短信服务</a></span>
				</div>
				<div class="shop-right fr">
					<ul>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(1,1,$this->wxid);?></i></span>
							<span><a href="<?php echo M_URL('home/Domain','serviceRecord',1,GP('wxid-'.$this->wxid)); ?>">短信总量</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">短信总量：该机构下的所能发送的短信总量 	</div></i></span>
						</li>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(1,1,$this->wxid)-getLimitService(1,'',$this->wxid);?></i></span>
							<span><a href="<?php echo M_URL('home/Domain','serviceRecord',1,GP('wxid-'.$this->wxid)); ?>">已使用量</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">剩余量：该机构下的已发送的短信量 	</div></i></span>
						</li>
						<li>
							<span><a class="c-86A8F"><?php echo getLimitService(1,'',$this->wxid);?></span>
							<span><a style="font-size: 14px;" href="<?php echo M_URL('home/Domain','serviceRecord',1,GP('wxid-'.$this->wxid)); ?>">条剩余</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">剩余量：该机构下剩余短信数量 	</div></i></span>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="shop-btn clearfix">
					<button class="ks-bt bt-def mr10 "  onclick="window.location='<?php echo M_URL('home/Domain','coludmanage',1,GP('wxid-'.$this->wxid)); ?>'">购买短信</button>
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
							<span><i class="c-86A8F"><?php echo getLimitService(2,1,$this->wxid);?></i></span>
							<span><a href="<?php echo M_URL('home/Domain','serviceRecord',2,GP('wxid-'.$this->wxid)); ?>">邮件总量</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">邮件总量：该机构下的所能发送的邮件总量 </div></i></span>
						</li>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(2,1,$this->wxid)-getLimitService(2,'',$this->wxid);?></i></span>
							<span><a href="<?php echo M_URL('home/Domain','serviceRecord',2,GP('wxid-'.$this->wxid)); ?>">已使用量</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">剩余量：该机构下的已发送的邮件量</div></i></span>
						</li>
						<li>
							<span><i class="c-86A8F"><?php echo getLimitService(2,'',$this->wxid);?></i></span>
							<span><a href="<?php echo M_URL('home/Domain','serviceRecord',2,GP('wxid-'.$this->wxid)); ?>">封剩余</a></span>
							<span class="name-nowrap"><i class="iconfont icon-iconfontwenhao"><div class="ks-remind">剩余量：该机构下剩余邮件数量</div></i></span>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="shop-btn clearfix">					
					<button class="ks-bt bt-def mr10 "  onclick="window.location='<?php echo M_URL('home/Domain','coludmanage',2,GP('wxid-'.$this->wxid)); ?>'">购买邮件</button>
				</div>
			</div>
	</div>
	</div>
	<!--网校计费服务end-->
	
	</div>
	</div>
	</div>

		<div id="ksBoxFooter">
	
	</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>

	$('#ks-content').height(window.innerHeight - $('.title-head').outerHeight()-$('#cloud-taps').outerHeight()-$('.footer-page').outerHeight());
	window.onresize = function(){
		$('#ks-content').height(window.innerHeight - $('.title-head').outerHeight()-$('#cloud-taps').outerHeight()-$('.footer-page').outerHeight());
	};loadScorllJs('#ks-content');
	
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
					alert('添加购物车成功');
				}else if(data==-1){alert('该商品已经在购物车了喔');}
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
            		location.reload();
            	}else{
            		$('body').append(data);
            	}
            		 
//					var $yCate = $("body",parent.document).find(".leftBoxUl").find(".yyyy_"+cate);
//	            	$yCate.show();
//		            $yCate.children(".second").append("<li id='id_"+data.id+"'><a href='"+myurl+"' title='"+title+"' target='main'>"+title+"</a></li>");
//	                if($yCate[0].className.indexOf('curr')==-1){
//		                $yCate.click();
//		                setTimeout(function(){
//		                	location.reload(); 
//		                },300);
//	                }else{
//	                	location.reload(); 
//	                };
				
           },
           error:function(){
			   location.reload();
               Alert("网络延迟,重新操作!");
           }
        })
};

/*h5-tabs*/
$('.h5-tab li').click(function(){
		var index = $(this).index();
		$(this).addClass('active').siblings().removeClass('active');
	  /*  $('.h5-tablist').eq(index).fadeIn().siblings().stop().hide();*/
	})

</script>
</body>
</html>





<!--<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">	
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/dialog/dialog.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>

<body>
	
	<div class="tab" style="display: block;">
		<div class="info-ul">
			<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php echo M_URL('home/Domain','adminrecharge',$wxid,GP(''));?>" enctype="multipart/form-data">
			<ul>
				<li>
					<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;账户：</span>
					 <?php echo "username";?>
				</li>
				<li>
					<span>充值项目：</span>
					<select name="type" id="" style="height: 35px;border: solid 1px #E5E5E5;margin-left: -5px; width: 200px;">
						<option value="1">账户充值</option>
						<option value="2">邮箱充值</option>
						<option value="3">短信充值</option>
						<option value="4">空间充值</option>
						<option value="5">直播流量</option>
						<option value="6">点播流量</option>
					</select>
					
				</li>
				
				<li>
					操作金额：&nbsp;&nbsp;<input type="number" name="money" id="" value="" style="height: 35px;border: solid 1px #E5E5E5;margin-left: 10px; width: 200px;"/> 元
					
				</li>
				
				<li>
					<div style="position: relative;padding-left: 100px;">
						<span style="position: absolute;left: 0px;top: 0px;width: 100px;text-align: right;">备注：&nbsp;&nbsp;&nbsp;&nbsp;</span>
						<textarea name="mark" rows="" cols=""></textarea>
						
						
					</div>
				</li>
				
				
				
			</ul>
			</form>
		</div>
		<div style="width: 100%;height: 40px; position: absolute;text-align: center;bottom: 15px;left: 0px;;">
			<button class="ks-bt bt-pue fn" onclick="do_reg()" style="padding: 0 45px;margin-left: 10px;background: #da4f0c;border-color: #DA4F0C;">&nbsp;&nbsp;确认&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="ks-bt bt-gray fn" onclick="top.closePopup('all');" style="padding: 0 45px;">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
		</div>
	
	

	</div>
	



</body>
<script type="text/javascript">
	function closed(){
		top.main.$(".ks-popup-close").click();
	}
	function do_reg(){
		$('#myform').submit();
	}
</script>
</html>-->



