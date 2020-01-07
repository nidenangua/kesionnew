<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>教师直播下载页</title>
	<link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
	
    <link href="<?php echo UOOT ?>Public/wechat/css/livee.css" rel="stylesheet">
   
</head>
<body style="background: #E64A3B">
	
	<div class="live-box">
		<div class="live-logo">
			<img src="<?php echo UOOT ?>Public/app/images/login/logo.png">
			
		</div>
		<div class="live-phone">
			<img src="<?php echo UOOT ?>Public/wechat/images/login/name.png">
		</div>
		<div class="live-name">
			科汛V名师教师直播端
		</div>
		<div class="live-btn-box">
			<div class="live-btn">
				<img src="<?php echo UOOT ?>Public/wechat/images/login/anz.png">Android版下载
			</div>
		</div>
		
		<div class="live-cirle">
			便捷
		</div>
		<div class="live-cirle live-cirle1">
			互动
		</div>
	</div>
	<div>
            <a id="J-call-app" href="javascript:;" class="label">立即打开&gt;&gt;</a>
            <input id="J-download-app" type="hidden" name="storeurl" value="http://m.chanyouji.cn/apk/chanyouji-2.2.0.apk">
    </div>
</body>
<script src="<?php echo UOOT ?>Public/common/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script>
    (function(){
        var ua = navigator.userAgent.toLowerCase();
        var t;
        var config = {
            /*scheme:必须*/
            scheme_IOS: 'IfInstalledCongMingTou://congmingtou',
            scheme_Adr: 'cmt://splash',
            download_url: document.getElementById('J-download-app').value,
            timeout: 600
        };

        function openclient() {
            var startTime = Date.now();

            var ifr = document.createElement('iframe');


            ifr.src = ua.indexOf('os') > 0 ? config.scheme_IOS : config.scheme_Adr;
            ifr.style.display = 'none';
            document.body.appendChild(ifr);

            var t = setTimeout(function() {
                var endTime = Date.now();

                if (!startTime || endTime - startTime < config.timeout + 200) {
                    window.location = config.download_url;
                } else {
                            
                }
            }, config.timeout);

            window.onblur = function() {
                clearTimeout(t);
            }
        }
        window.addEventListener("DOMContentLoaded", function(){
            document.getElementById("J-call-app").addEventListener('click',openclient,false);

        }, false);
    })()
</script>

</html>