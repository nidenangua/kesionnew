<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	    <meta name="renderer" content="webkit"> 
	</head>
	<body>
		
		<div style="width：40px;height:40px" onclick="a()">点击</div>
		
	</body>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
	<script type="text/javascript">
		function a(){
			toast2({
				content:'222222222',
				icon:'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1526560655393&di=10e5c56d14aa0cd584498d0a7d42158f&imgtype=0&src=http%3A%2F%2Fh.hiphotos.baidu.com%2Fzhidao%2Fwh%253D450%252C600%2Fsign%3D7d1ef340ebc4b74534c1bf12facc3221%2F4034970a304e251fe2819191a786c9177f3e5360.jpg',
				callback:function(){
					console.log(1)
				}
			})
		}
		/**
		 * 提示框
		 * @param {String} content 对应提示的内容
		 * @param {String} 
		 * @param {Number} duration 延迟
		 * @param {Function} callback回调函数
		 */
		function toast2(params){
			
			var data = {
				content:params.content,
				icon:params.icon,
				duration:params.duration || 1000,
				success:params.callback,
			}
			iconUrl = ''
			if(typeof data.icon!=="undefined"){
				iconUrl = '<img style="width:40px;height:40px;display:block;margin:auto" src="'+data.icon+'"/>';
			}
			var a = '<toast style="position:fixed;top:0;left:0;max-width:60%;border:0;background:rgba(0,0,0,.3);padding:12px;border-radius:5px;font-size:14px;color:#fff;z-index:9999;">'+iconUrl+'<span style="text-align:center;">'+data.content+'</span></toast>';
			document.body.addChilds(a);
			var thisTarget = document.body.findTag('toast')[document.body.findTag('toast').length-1];
			var thisHalfWidth = thisTarget.offsetWidth/2;
			var thisHalfHeight = thisTarget.offsetHeight/2;
			thisTarget.style.left = "50%";
			thisTarget.style.top = "50%";
			thisTarget.style.marginLeft = -thisHalfWidth+'px';
			thisTarget.style.marginTop = -thisHalfHeight+'px';
			setTimeout(function(){
				thisTarget.remove();
				if(typeof fn==="function"){
					fn()
				}
					
			},time)
			
			
		}
	</script>
</html>