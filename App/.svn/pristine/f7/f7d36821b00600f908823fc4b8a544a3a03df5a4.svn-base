<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title>修改背景或图片</title>
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="/Public/drag/color/colorpicker.css" />

	<style>
		body{ font-family: 'hiragino sans gb'; }
		.setImage{padding:0 20px 20px 20px;color:#666;}
		.setImage li{position: relative; font-size:14px;margin-top:10px; line-height: 30px; padding-left: 80px;min-height: 24px;}
		.setImage .name{width:80px; position: absolute;top:0;left:0;}
		.setImage label{float:left; padding: 0 20px; cursor: pointer; background: url(<?php echo UOOT;?>Public/dragh5/images/check.png) no-repeat 0 50%;}
		.setImage .on{background: url(<?php echo UOOT;?>Public/dragh5/images/checked.png) no-repeat 0 50%;}
		#bgColor{width:28px;height:28px;float:left;border:1px solid #ddd;background-color:#fff; display: none;}
		#bgImage{ position: relative;margin-top:15px; display: none;}
		#bgImage .image{width:80px;height:80px;border:1px dashed #ddd; background: #f3f3f3;overflow: hidden;line-height: 80px;}
		#bgImage .image img{width:100%; display: inline-block; vertical-align: middle;}
		#bgImage .button,
		#bgImage .default-button{width:100px;height:34px; line-height: 34px;background:#476DBE; text-align: center;color:#fff;border-radius:4px; position: absolute;left:97px;top:50%;margin-top:-17px; cursor: pointer;}
		#bgImage .default-button{background:#aaa; left:207px; display: none;}
	</style>
</head>  
<body style="background: #fff;">
	
	<div class="setImage">
		<ul>
			<li>
				<div class="name">编辑背景：</div>
				<div class="clearfix"><label onclick="EGIExternalFunction.labelClick(this,-1,'bgColor')">隐藏</label><label class="on" onclick="EGIExternalFunction.labelClick(this,0,'bgColor')">默认</label><label onclick="EGIExternalFunction.labelClick(this,1,'bgColor')">自定义</label><div id="bgColor"></div></div>
				
			</li>
			<li>
				<div class="name">背景图片：</div>
				<div class="clearfix"><label class="on" onclick="EGIExternalFunction.labelClick(this,0,'bgImage')">隐藏</label><label onclick="EGIExternalFunction.labelClick(this,1,'bgImage')" id="showBg">显示</label></div>
				<div id="bgImage">
					<div class="image"></div>
					<div class="button" onclick="EGIExternalFunction.selectImg()">选择替换</div>
					<div class="default-button" onclick="EGIExternalFunction.defaultImg()">恢复默认</div>
				</div>
			</li>
		</ul>
	</div>
	
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo UOOT;?>Public/drag/js/colorpicker.js"></script>
	<script>
		
		(function(){
			var setTarget = top.popup.data(window.name).target;
			var defaultBgInfo = $(setTarget).attr('default-bg') || 'inherit,none';
			defaultBgInfo = defaultBgInfo.split('|');
			var defaultBgColor = defaultBgInfo[0]; //默认背景色
			var defaultBgImage = defaultBgInfo[1]; //默认背景图片
			var bgColor = $(setTarget).css('background-color');
			var bgImage = $(setTarget).css('background-image').replace(/url/i,'');
			if(bgImage === 'none'){
				bgImage = defaultBgImage;
			}else if(bgImage.match(/[^"'()]+/)){
				bgImage = bgImage.match(/[^"'()]+/)[0];
			}

			top.imgUploadBack = function(src){
				setBgImage(src);
			}
		
			//外部引用函数
			EGIExternalFunction = {
				labelClick:function(target,index,id){
					$(target).addClass('on').siblings().removeClass('on');
					if(index === -1){
						document.getElementById(id).style.display = 'none';
						if(id === 'bgColor'){
							setTarget.style.backgroundColor = 'inherit';
						}
					}else if(index === 0){
						document.getElementById(id).style.display = 'none';
						//取消背景图片
						if(id === 'bgImage'){
							setTarget.style.backgroundImage = 'none';
						}else if(id === 'bgColor'){
							setTarget.style.backgroundColor = defaultBgColor;
						}
					}else if(index === 1){
						document.getElementById(id).style.display = 'block';
						if(id === 'bgImage'){
							setBgImage(bgImage);
						}else if(id === 'bgColor'){
							setTarget.style.backgroundColor = $bgColor.css('background-color');
						}
					}
				},
				selectImg:function(){
					//选择图片
					top.popup.open({
						url:'<?php echo M_URL('Index','imageslist','',GP('type-other',true));?>',
						area:['900','600']
					}); 
				},
				defaultImg:function(){
					//默认图片
					setBgImage(defaultBgImage);
				}
			}
		
			
			document.getElementById('showBg').click();
			setBgImage(bgImage);
			
			var $bgColor = $('#bgColor');
			
			$bgColor.css('background-color',defaultBgColor).val(defaultBgColor);
			
			
			//颜色配置 
          	$bgColor.ColorPicker({ 
              onBeforeShow: function () {
                  $(this).ColorPickerSetColor(this.value);
              },
              onChange: function (hsb, hex, rgb) {
                $bgColor.val('#'+hex);
                $bgColor.css('background-color','#'+hex);
                //改变对象背景值
                $(setTarget).css('background-color','#'+hex);
              }
	        }).bind('keyup', function(){
	            $(this).ColorPickerSetColor(this.value);
	        });
            
            //设置图片
            function setBgImage(src){
            	bgImage = src;
            	if(src == ''){
            		$('#bgImage').find('.image').html('');
            		setTarget.style.backgroundImage = 'none';
            	}else{
					$('#bgImage').find('.image').html('<img src="'+src+'" />');
					setTarget.style.backgroundImage = 'url('+src+')';
				}
				
				if(src != defaultBgImage){
					$('.default-button').show();
				}else{
					$('.default-button').hide();
				}
			}

		})();
				

	</script>
</body>
</html>