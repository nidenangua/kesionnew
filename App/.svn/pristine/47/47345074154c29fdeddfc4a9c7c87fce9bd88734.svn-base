<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<title>添加图文</title>
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style>
		.form-star{left:0;}		
		.pricebox{margin-top:20px;}
		.pricebox .item{font-size:14px; color:#999; margin-top:10px;}
		.pricebox input{background: #fff;margin:0 10px;}
		
		.audio-list .item{padding: 15px 0; border-bottom: 1px solid #eee; margin-bottom: 15px; position: relative;}
		.audio-list .icon-close{width:36px;height:36px; position: absolute;top:60px;left:650px; line-height: 36px; text-align: center; font-size:14px; cursor: pointer; color:#aaa; z-index: 9;}
		.audio-list .icon-close:hover{color:#e5412c}
		.audio-list .id{font-size: 18px;font-weight: bold;color:#ccc;}
		.audio-title{width:435px;padding-right: 120px;} 
		.audio-text{height: 36px; position: relative;margin-top:10px;}
		.audio-title .form-textbox{border-radius:4px 0 0 4px;}
		.audio-title .form-textbox:focus{ position: relative; z-index: 8;}
		.audio-title .sj-switch{ position: absolute;right:1px;top:0;height: 36px; line-height: 36px; padding:0 30px 0 15px;border:1px solid #e6e6e6; cursor: pointer; box-sizing: border-box;width:120px; border-radius: 0 4px 4px 0; overflow: hidden; color:#999}
		.audio-title .sj-switch i{margin-right: 5px;}
		.audio-title .sj-switch em{width:20px;height: 34px; line-height: 34px; position: absolute;right:0;top:0;border-left:1px solid #eee; text-align: center; color:#aaa; background: #fafcfd;}
		.audio-title .sj-switch .ok{color:#27d17e;} 
		.audio-title .sj-switch-option{ position: absolute;right:0;top:31px; width:120px; z-index: 9; background: #fff;border:1px solid #e6e6e6;border-radius: 4px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);padding: 5px 0; display: none;}
		.audio-title .sj-switch-option li{padding: 0 15px;height: 32px; line-height: 32px;font-size:12px;color:#666; cursor: pointer;}
		.audio-title .sj-switch-option li:hover{background: #fafcfd;}
		.audio-text span{line-height: 36px; position: absolute;left:10px;top:0;font-size:14px;color:#999;}
		.audio-text .form-textbox{padding-left: 55px;max-width: 555px;}
		.audio-text .ks-bt{margin-left:10px;}
		
	</style>
</head>
<body class="ks-wrap">

 	<div class="ks-wbox bRadius10">
 		<div class="ks-head-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">点播管理</a><em>/</em>添加点播			<!--标题-->
		</div>
		
		<div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，科汛V名师保有依据国家规定及平台规则进行处理的权利。</div>

		<form>
			<div class="form-title">基本信息</div>
			<div class="form-box">
					
				<div class="form-row" >
					<span class="name name-nowrap">视频名称<i class="form-star">*</i></span>
					<div class="form-limit" limit="50">
						
						<input type="text" class="form-textbox"  name="title" />
					</div>
				</div>
				
				<div class="form-row clearfix">
					<span class="name name-nowrap">视频上传<i class="form-star">*</i></span>
					<!--<div class="clearfix">
					    <label class="radioLabel fl">
							<input onclick="home_audio.selectAudioType(this)" type="radio" value="0" name="type" checked>单课时
					    </label>
					    <label class="radioLabel fl">
							<input onclick="home_audio.selectAudioType(this)" type="radio"  value="1" name="type">系列课
					 	</label>
					</div>-->
					<div class="form-tips pt10">格式支持MP4，大小不超过1G。</div>
					<div class="clearfix pt10" id="singleAudio">
						<div class="ks-bt bt-pur">选择文件</div> 
					</div> 

				</div>
 				<div class="form-row"> 
 					<span class="name name-nowrap">直播时间</span>
 				</div>
				<div class="form-row">
					<span class="name name-nowrap">视频封面<i class="form-star">*</i></span>
					<div class="form-upimg">
						<div class="images" style="background-image:url('http://edu-image.nosdn.127.net/4B56BFEB6B3B1A91E56C65525F81C5EF.png?imageView&quality=100&thumbnail=225y125&type=webp');"></div>
						<div class="clearfix">
							<div class="ks-bt bt-pur">上传图片</div>
						</div> 
						<div class="form-tips pt20">建议尺寸750*525px，JPG、PNG格式， 图片小于1M。</div>
					</div>
				</div>

				<div class="form-row">
					<span class="name name-nowrap">视频详情</span>
					<textarea class="form-textarea"></textarea>
				</div>
				
				
				
				<div class="form-row clearfix">
	                <span class="name name-nowrap">文字防复制</span>
	               	<div class="form-switch" open-value="1">
	                    <label for="isshow0"><input type="radio" value="1" name="iscopy" checked></label>
	                    <label for="isshow1"><input type="radio" value="0" name="iscopy"></label>
					</div>
					
					
	            </div>
				<div class="form-tips">商品的文字内容允许复制，图片点击放大和长按识别二维码功能则允许使用。</div>
				
				
			</div>
			
			<div class="form-title">商品信息</div>
			
			<div class="form-box" style="min-height: auto;">	
				<div class="form-gray">
					<div class="form-row">
						<span class="name name-nowrap">售卖价格<i class="form-star">*</i></span>
						<div class="clearfix">
						    <label class="radioLabel fl">
								<input onclick="isFree(this)" type="radio" class="radioInput" value="1" name="price" checked>收费
						    </label>
						    <label class="radioLabel fl">
								<input onclick="isFree(this)" type="radio" class="radioInput" value="0" name="price">免费
						 	</label>
						 	<label class="radioLabel fl">
								<input onclick="isFree(this)" type="radio" class="radioInput" value="2" name="price">打赏
						 	</label>
						</div>
						
						<div class="pricebox" id="pricebox">
							<div class="item">
								<span>商品价格</span><input type="text" class="form-textbox w180" placeholder="请输入价格" /> 元
							</div>
							<div class="item">
								<span>划线价格</span><input type="text" class="form-textbox w180" placeholder="请输入划线价格（选填）" /> 元
							</div>
						</div>
						
						
						
						 
					</div>
				</div>
			</div> 
			
			<div class="form-title">上架设置</div>
			<div class="form-box" style="min-height: auto;">	
				<div class="form-row clearfix">
	                <span class="name name-nowrap">是否上架</span>
	               	<div class="form-switch" open-value="1">
	                    <label for="isshow0"><input type="radio" value="1" name="shelf" checked></label>
	                    <label for="isshow1"><input type="radio" value="0" name="shelf"></label>
					</div>

	            </div>
			</div>
			
			<div class="form-footer clearfix">
				<span class="d-inline-block">
					<input type="submit" class="ks-bt bt-pue" value="确认添加" name="confirm">
			        <button onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>
		    	</span>
			</div>

		
		</form>		
	</div>
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		
		module.require(['$','backstage'],function(){
			
			module.import('home_audio',true)
		});
		
		function isFree(el){
			document.getElementById('pricebox').style.display = el.value == 1 ? 'block' : 'none'
		};
		
		
	</script>
	
</body>
</html>