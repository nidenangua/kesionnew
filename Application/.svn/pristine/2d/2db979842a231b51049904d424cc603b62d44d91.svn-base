<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>选择门户风格</title>
    <link href="<?php echo UOOT ?>Public/common/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//store.kesion.com/Skin/1/PC/Skin03/Public/css/swiper-3.4.2.min.css"/>
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com/">
	<style>
		.phone{position: relative;}
		.phone .isedit{width:60px;height:20px; text-align: center;color:#fff; position: absolute;right:0;top:4.25rem; font-size: 12px; background: #f98879}
	</style>
</head> 
<body style="background: #eef6ff;">
	<div class="loadings" style="display: block;"></div>
	<div id="page" style="display: none;">
		<div class="select-style">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					
				</div>
			</div>
		</div>
		<div class="select-button" onclick="save()">确认保存</div>
	</div>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>
	<script>
		
		location.href.split('Choose')[1] && location.href.split('Choose')[1].match(/\d+/)[0] === '2' && $('.select-button').html('ok，下一步');
		var TempId = 0;
		//门户风格列表
		$.post('/Json/index.php?act=Drag.GetTemplist',{
			wxid:'<?php echo $this->wxid; ?>'
		},function(res){
			var __values = res.GetTemplist.values;
			TempId = res.GetTemplist.mydiyid;
			
			var swiperSlideList;
			$(__values).map(function(i){
				var curr = i === 0 ? ' curr' : '';
				var isEdit = this.isedit == 1 ? '<div class="isedit">已修改</div>' : ''
				var swiperSlide = '<div class="swiper-slide'+curr+'" data-tempid="'+this.tempid+'"><div class="phone"><img src="'+this.defaultpic+'" />'+isEdit+'</div></div>';
				i === 0 ? swiperSlideList = swiperSlide : swiperSlideList += swiperSlide
			});
			
			var __px = 15/375;
			var newPx = window.innerWidth * __px;
			$('.swiper-container').css({fontSize:newPx+'px'});
			$('.swiper-wrapper').html(swiperSlideList);
			$('#page').show();
			$('.loadings').hide();
			new Swiper('.swiper-container',{
				slidesPerView: 1.4,
			    spaceBetween: 0,
			    pagination: {
			       el: '.swiper-pagination',
			       clickable: true,
			    },
			    onTransitionEnd:function(swiper){

			    	$('.swiper-slide').eq(swiper.snapIndex).addClass('curr').siblings().removeClass('curr')
			    }
			})
		},'json');

		function save(){
			var tempid = $('.swiper-wrapper').find('.curr').attr('data-tempid');
			$.get('/home.html/microportal/Index/gateset/'+tempid+'?appid-36,cx-1',function(){
				location.href = (location.href.split('Choose')[1] && location.href.split('Choose')[1].match(/\d+/)[0] === '2') ? "<?php echo M_URL('WeChat','gateset')?>" : "<?php echo 'https://'.APP_DOMAIN.'/home.html/default/WeChat/login' ?>"
			})
			
		}
		
		
	</script>
</body>
</html>