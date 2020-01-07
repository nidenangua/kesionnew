<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>商品详情页</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

<style>
	.pc-header {
		padding-left: 120px;
		position: relative;
		overflow: hidden;
		background: #fff;
		min-height: 80px;
	}	
	.pc-left {
		position:absolute;
		left: 20px;
		width: 70px;
		height: 70px;
		overflow: hidden
	}
	.pc-left img {
		width:100%
	}
	.pc-right h5 {
		font-size: 20px;
		color: #353535;
		font-weight: 600;
	}
	.pc-right p {
		font-size:14px;
		color: #666
	}
	.pc-serice {
		height:50px;
		background:#fafafa;
	}
	.pc-serice li{
		float: left;
		height: 50px;
		width: 96px;
		line-height: 50px;
		text-align: center;
	}
	.pc-serice li.curr {
		background-color: #fff;
   		 color: #353535;
	}
	.pc-bar {
		margin-top:20px;
		background:#fff
	}
	.pc-content {
		margin:0 20px;

	}
	.pc-btn {
		margin-top: 15px;
	}
	.pc-serice li {
		font-size:14px
	}
	.pc-bar p {
		line-height:32px;
		font-size:14px
	}
	.pc-bar p img {
		max-width:100%;
	}
</style>
</head> 
<body class="ks-wrap" style="background:#f5f7fa">
	<div class="pc-header ks-wbox">
			<div class="pc-left">
				<img src="<?php echo $appinfo['defaultpic']; ?>">
			</div>
			<div class="pc-right">
				<h5><?php echo Field($appinfo['appname']); ?></h5>
				<p><?php echo $appinfo['shortdesc']; ?></p>
				<p class="pc-expire">
					开通权限：
					<?php if ($appinfo["price"]>0){
						//echo($appinfo["price"]."元/年");
					}else{
					    echo ("永久免费 ");
					}
					?>
				</p>

				<?php if($appinfo['isprice']==1){?>
                <?php if(!empty($appinfo2['enddate'])){?>
					<p class="pc-expire">
						功能已于  <?php echo date('Y-m-d H:i:s',$appinfo2['enddate']); ?> 到期
					</p>
					<?php }
                      }?>
                <?php
                $showtips=wx_showappfree($appinfo['allowversion']);
                if (!empty($showtips)){
                    echo '<div style="color:green;">'.$showtips.'</div>';
                }
                ?>
				<div class="pc-btn">
                    <button class="ks-heade-button ks-head-primary" onclick="history.back();">返回列表</button>
                    <?php if($appinfo['isprice']==1 && wx_checkappisallow($appinfo['appid'],$this->wxid)==false){

                    ?>
                   <!-- <button class="ks-heade-button ks-head-primary" onclick="location.href='<?php echo M_URL('Service','confirmService','',GP('numb-1,appids-'.$appid)); ?>'">立即订购</button>-->
				<?php
				}else{
				?>
					
				<?php }?>
				</div>
				
			</div>
		</div>
		<div class="pc-bar">
			<div class="pc-serice ">
				<ul class="clearfix"><li class="curr">功能服务</li></ul>
			</div>
			<div class="pc-content">
				<?php echo $appinfo['intro']; ?>
			</div>
		</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage'],function(){

		})

		
	</script>
</body>
</html>








<!--<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>商品详情页</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/mystyle.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.shopTab {display:none}
.shopTabBox {background:#fff;overflow-x:hidden;}
.posconntent{position:absolute;left:0;font-size:24px;}
.container-tap {position:relative;width:100%}
.ks-top-tab {overflow: hidden;}

</style>
  
</head> 
<body class="ks-wrap">
<div id="ksBoxHead">
	
<div class=" clearfix">
	<div class="" style="width: 75%; float: left;">
		<div class="taps-content bg-white  bRadius10 ks-wbox" style=" margin-right:30px;">
			<div class="taps-row" >
				<form action="<?php echo M_URL('Shop','buyNow',$appid); ?>" method="post">
					<div class="fl mt20">
						<div class="cloud-image">
							<img src="<?php echo $appinfo['defaultpic']; ?>" style="vertical-align: middle" >
							<div class="fsize14">
								<a class="det-p mt20 c-666">
									<label><i class="det-icon iconfont verAlignMiddle" style="font-size:18px !important;">&#xe605;</i> 收藏宝贝(256人)</label>
								</a>
								
								<a class="det-p mt10 c-666">
									<span class="det-icon iconfont verAlignMiddle">&#xe654;</span> 分享
								</a>
							</div>
						</div>
					</div>
					
					
					<div class="taps-col-8" >
						<div class="det-content">
							<h4 class="fsize30 pt20"><?php echo Field($appinfo['appname']); ?></h4>
							<p class="mt10 c-666 fsize14 pt20">开发工程师：<span><?php echo Field($appinfo['author']); ?></span></p>
							<div class="mt30 clearfix">
								<div class="int-price alignRight fl fsize14 mt5">
								<p class="c-666">原&nbsp;&nbsp;&nbsp;价：<span class="c-666">￥<?php echo $appinfo['price']; ?>元/<?php if($appinfo['appchargetype']==0){echo '月';}elseif($appinfo['appchargetype']==1){echo '季';}elseif($appinfo['appchargetype']==2){echo '年';}; ?></span></p>
								<p class="mt10 c-666">促销价：<span class="c-fd">￥<?php echo $appinfo['price']; ?>元/<?php if($appinfo['appchargetype']==0){echo '月';}elseif($appinfo['appchargetype']==1){echo '季';}elseif($appinfo['appchargetype']==2){echo '年';}; ?></span></p>
								</div>
								
								<div class="int-price fr fsize16">
								<p>用户评分：<span class="c-18">4.9<i class="iconfont">&#xe610;</i></span></p>
								<p class="mt10">使用人数：<span class="c-18">688人</span></p>
								</div>
							</div>
							
							
							<div class="limit mt30 fsize16 clearfix" >
							   
							<input type="radio" class="verAlignMiddle radioclass mr10" value="1" id="radioSt1" name="numb" checked> 
								<label for="radioSt1" class="radioBox0">
								一<?php if($appinfo['appchargetype']==0){echo '月';}elseif($appinfo['appchargetype']==1){echo '季';}elseif($appinfo['appchargetype']==2){echo '年';}; ?>
								</label>
								<input type="radio" class="verAlignMiddle radioclass mr10" value="2" id="radioSt2" name="numb">
								<label for="radioSt2" class="radioBox0">两<?php if($appinfo['appchargetype']==0){echo '月';}elseif($appinfo['appchargetype']==1){echo '季';}elseif($appinfo['appchargetype']==2){echo '年';}; ?></label>
								
							</div>
							
							<div class="cloud-buy mt30 clearfix">
								<input type="submit" class="generalBtn bRadius5   c-fff fsize16" value="立即购买" name="edit">
								<button type="button" class="generalBtn1  c-2c fsize16  ml10" onClick="addCart(<?php echo $appid; ?>);" name="edit"><i class="iconfont icon-gouwuche2"></i> 加入购物车</button>
							</div>
						</div>
					</div>
				</form>   
			</div>
			<div class="clear"></div> 
		</div>
	
	</div>
	<style>

	</style>
	<div class="fr" style="width: 25%; height: 427px;">
		<div class="p20 bg-white  bRadius10">
			<div class="fsize18">销售排行榜</div>
			<ul class="PaiHang clearfix">
				<?php for($i=1;$i<5;$i++){?>
				<li>
					<div  class="PaiHang-box">
						<em class="PaiHang-em1"><?php echo $i;?></em>
						<div class="PaiHang-cont" >
							<div class="PaiHang-head" >
								<div class="PaiHang-head-cont">
									<img src="<?php echo $appinfo['defaultpic']; ?>"/>
								</div>
								<span class="PaiHang-tip" src="<?php echo UOOT;?>Public/app/css/huangguan.png"></span>
							</div>
							<div class="PaiHang-conts">
								<div class="hLh20 fsize16">微信小程序</div>
								<div class="hLh20 c-18 mt10">已售5566</div>
							</div>
							<div class="PaiHang-prce">￥99.99</div>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		
	</div>
	</div>
		
</div>

<div class=" bRadius10 bg-white clearfix mt30">
	
<div class="p40">
	<div id="ksBoxFooter">
		<div class="clearfix ks-top-tab" >
			<div class="fl">
				<ul class="titleTab">
			      	<li class="fl curr"><a href="javascript::">宝贝详情</a></li>
		        	<li class="fl"><a href="javascript::">用户评论</a></li>
			   </ul>
		   </div>
		</div>	
	</div>	
		<div class="contentBox"> 
			<div class="shopTabBox">
				<div id="ksBoxContent">
					<div class="shopTab"><?php echo $appinfo['intro']; ?></div>
					<div class="shopTab"></div>
				</div>
			</div>
		</div>
</div>
		
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
//选项卡
$(function(){	
	$('.titleTab li').click(function(){
		$(this).addClass('curr').siblings().removeClass('curr');
		$('.shopTab:eq('+$(this).index()+')').show().siblings().hide();	
	})
});	
function addCart(appid)
{
	var url = "<?php echo M_URL('Ajax','addCart');?>";
	$.ajax({
		type:"post",
		url:url,
		data:{
			'appid':appid
		},
		dataType:"json",
		success:function(data){
			if(data==0)
			{
				var cartNum = $("#cartNum").html();
				$("#cartNum").html(parseInt(cartNum)+1);
				alert('添加购物车成功');
			}else if(data==-1)
			{
				alert('该商品已经在购物车了喔');
				}
		}
	 });
}
</script>
</body>
</html>-->