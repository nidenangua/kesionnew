<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>{=getConf(seotitle)}</title>
<meta name="Keywords" content="{=getConf(metadescription)}">
<meta name="Description" content="{=getConf(metadescription)}">
<!--Drag reset css-->
<link href="/Public/common/drag/css/reset.css" rel="stylesheet">
<!--//Drag reset css end-->
<!--Drag module style-->
<link href="/Public/common/drag/css/drag.modular.css" rel="stylesheet">
<!--//Drag module style end-->
<!--Website color config-->
<link href="{$install}Public/css/drag.setColor.css" rel="stylesheet">
<!--//Website color config end-->

<link href="/Skin/2/PC/Skin04/Public/css/skin.css" rel="stylesheet">
<link href="/Skin/2/PC/Skin04/Public/css/courseview.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="/Public/common/js/html5shiv.js"></script>
<script src="/Public/common/js/respond.min.js"></script>
<![endif]-->
<style type="text/css">
	.m-bg-color{
		background-color: #EA4E3F;
	}
	.m-tab0 .m-tab-list .m-color{
		border-bottom: 2px solid #EA4E3F;
	}
</style>
</head>
<body class="ks-bg-gray">
   	<div class="courseView ks-bg-gray" drag-inner="(main)">
   		<div class="container">
	    	<div class="box" drag-inner="(course)" drag-render="view">
	            <div class="courseInfo clearfix">
	                <div class="image" ratio="0.618">
	                	<span class="course-type<?php echo $value["courseType"];?>"></span>
	                    <img src="<?php echo Img($value["defaultpic"]);?>">
	                </div>
	                
	                <div class="courseInfo-right">
	                	<div class="name"><?php echo $value["title"];?></div>
	                    <div class="star"><span id="scoreImg"><div class="star-on" style="width: <?php echo $value["attribute0"];?>%;"><img src="{$install}Public/images/star-on.png"></div><img src="{$install}Public/images/star.png"></span><b>5.0</b>(<?php echo $value["studentcount"];?>人学习)</div>
	                    
	                    <div class="price">  
							<span class="price-info"><?php echo $value["price"];?></span>
	                        <span class="money">¥<?php echo $value["price_market"];?></span>
	                    </div>
						<?php if($value["status"]!=2){?>
                        <div class="button" id="courseState">课程已下架</div>
                        <?php }elseif($this->memberinfo==''){?>
                        <div class="button"><a href="javascript:void()" onclick="Alert('暂未登录');" class="m-bg-color" id="courseState">请先登录</a></div>
                        <?php }elseif($value["price"]=='免费'){?>
                        <div class="button"><a href="<?php echo M_URL('course','classPlay',$value["courseid"]);?>" class="m-bg-color" id="courseState" target="_top">开始学习</a></div>
                        <?php }elseif(isset($havecourses['paystatus'])&&$havecourses['paystatus']=="1"){?>
                        <div class="button"><a href="javascript:void(0);" onclick="frames(this)" data-url="<?php echo M_URL('course','classPlay',$value["courseid"]);?>" class="m-bg-color" target="_top">开始学习</a></div>
                        <?php }else{?>
                        <div class="button"><a <?php if($GLOBALS['_DoM']['tempPid']==15){?>href="javascript:void(0);" onclick="frames9(this)" data-url="<?php echo M_URL('course','buynow',$value["courseid"]);?>"<?php }else{?>href="<?php echo M_URL('course','buynow',$value["courseid"]);?>"<?php }?> class="m-bg-color" id="courseState">立刻购买</a></div>
                        <div class="button"><a href="javascript:void(0)" onclick="addCourseCart('<?php echo $value["courseid"];?>')"  class="cou-btn-cart mr_10" style="background:#FFA500;">加入购物车</a></div>
                        <?php }?>
	                </div>
	                <script>
                    function frames9(target){
						var thisUrl = $(target).attr('data-url')
						popup.open({
							title:'订单详情',
							url:thisUrl,
							area:[900,500]
						})
					}	
                    </script>
	                <div class="clear"></div>
	            </div>
	    		<!--//courseInfo end-->
			</div>	        
			<!-- //box end-->
        </div>
    </div>
	<div class="ks-bg-gray" drag-inner="(main)" style="padding-bottom: 30px;">
		<div class="container clearfix">
			<div drag-addmodule="true">
				<div class="m-tab0" drag-tab="click,m-color" drag-setdrag="inner,sub">
					<div class="m-tab-list">
						<ul>
							<li class="col-2 m-color">课程概览</li>
							<li class="col-2" onclick="ContentsAjax('<?php echo $value['courseid'];?>','<?php echo M_URL('course','ContentsAjax');?>');">课程目录</li>
						</ul>
					</div>
					<div class="m-tab-content">
						<div class="m-tab-box" style="display: block;" drag-render="view">
							<div class="detail-basic">
								<div class="basic-item" style="border-top:0;"><div class="learn_title">课程简介</div><?php echo $value["intro"];?></div>
								<div class="basic-item"><div class="learn_title">公告</div><?php echo $value["announce"];?></div>
							</div>
							<div class="detail-content">
								<?php echo $value["content"];?>
							</div>
						</div>
						<div class="m-tab-box">
							<div class="course-catalog" id="ContentsAjax"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <script src="/Public/common/js/jquery.js"></script>
	<script src="/Public/common/drag/js/ajax.render.js"></script>
	<script src="/Skin/2/PC/Skin04/Public/js/courseview.js"></script>
	<script src="/Public/Zpopup/js/Zpopup.js" type="text/javascript" charset="utf-8"></script>
<script>
//加入购课车
function addCourseCart(courseid){
	var url = "/Plus/Kesion.ajax.php?act=addCart";
	$.ajax({
		type:"post",
		url:url,
		data:{'courseid':courseid},
		dataType:"json",
		success:function(data){
			if(data==0){
				Alert('添加购物车成功');
				headLoadJs();
			}else if(data==-1){
				Alert('该商品已经在购物车了喔');
			}else if(data==2){
				 top.location.href='<?php echo M_URL('home','login');?>';
			}else if(data==3){
				 top.location.href="<?php echo M_URL('course','view',$value['courseid']);?>";
			}
		}
	 });
};
function frames(target,title){
	var thisUrl = $(target).attr('data-url')
	popup.open({
		title:'订单详情',
		url:thisUrl,
		area:[900,500]
	})
}
</script>
</body>
<script src="/Skin/2/PC/Skin04/Public/js/commons.js"></script>
</html>