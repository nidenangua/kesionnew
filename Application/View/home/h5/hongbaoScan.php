<?php
include "jssdk.php";
$jssdk = new JSSDK($appid,$appSecret,$access_token,$getwxid);
$signPackage = $jssdk->GetSignPackage();
?>
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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
<div id="ksBoxFooter" style="font-size: 50px;">
	功能研发ing。。。。。
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
</script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
   	var title='<?php echo $title;?>'; 
   	var desc="<?php echo $desc;?>";
   	var imgUrl="http://"+"<?php echo APP_DOMAIN;?>"+"/Images/school/2/201712/5a45dc39df395.jpg";
	var linkurl="http://"+"<?php echo APP_DOMAIN;?>"+"/h5market/inh5game?h5id="+<?php echo $H5id; ?>;//图片必须在300*300以上
	wx.config({
	    debug: true,
	    appId: '<?php echo $signPackage["appId"];?>', 
    	timestamp: <?php echo $signPackage["timestamp"];?>,
    	nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    	signature: '<?php echo $signPackage["signature"];?>',
	    jsApiList: [
	      // 所有要调用的 API 都要加到这个列表中
		  'onMenuShareAppMessage','onMenuShareTimeline','onMenuShareQQ'
	    ]
	});
  	wx.ready(function () {
    // 在这里调用 API
		wx.onMenuShareAppMessage({//分享给微信朋友
			title:title , // 分享标题
			desc: desc, // 分享描述
			link: linkurl, // 分享链接
			imgUrl: imgUrl, // 分享图标
			type: 'link', // 分享类型,music、video或link，不填默认为link
			dataUrl: '', // 如果type是music或video，则	要提供数据链接，默认为空
			success: function () { 
				// 用户确认分享后执行的回调函数
				alert('分享成功');
			},
			cancel: function () { 
				alert('取消分享');
				// 用户取消分享后执行的回调函数
			}
		});
		wx.onMenuShareQQ({//分享给微信朋友
			title:title , // 分享标题
			desc: desc, // 分享描述
			link: linkurl, // 分享链接
			imgUrl: imgUrl, // 分享图标
			type: 'link', // 分享类型,music、video或link，不填默认为link
			dataUrl: '', // 如果type是music或video，则	要提供数据链接，默认为空
			success: function () { 
				// 用户确认分享后执行的回调函数
				alert('分享成功');
			},
			cancel: function () { 
				alert('取消分享');
				// 用户取消分享后执行的回调函数
			}
		});
		wx.onMenuShareTimeline({//分享给微信朋友圈
			title: title, // 分享标题
			desc: desc, // 分享描述
			link: linkurl, // 分享链接
			imgUrl: imgUrl, // 分享图标
			success: function () { 
				// 用户确认分享后执行的回调函数
				alert('分享成功');
			},
			cancel: function () { 
				// 用户取消分享后执行的回调函数
				alert('取消分享');
			}
		});
  	});
  	wx.checkJsApi({
    	jsApiList: ['onMenuShareAppMessage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
    	success: function(res) {
    		
        // 以键值对的形式返回，可用的api值true，不可用为false
        // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
    	}
	});
</script>
</body>
</html>





<!--

<?php

for($i=0;$i<$num['hongbaonum'];$i++){
			echo '这个红包需要积分'.$score[$i].',奖励金额为：'.$money[$i].'<br/>';
		}
		
		
		

?>-->