<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>课程详情</title> 
    <?php if($result['vdoService']=='tencent'){?>
  <link href="//imgcache.qq.com/open/qcloud/video/tcplayer/tcplayer.css" rel="stylesheet">
  <!-- 如需在IE8、9浏览器中初始化播放器，浏览器需支持Flash并在页面中引入 -->
  <!--[if lt IE 9]>
  <script src="//imgcache.qq.com/open/qcloud/video/tcplayer/ie8/videojs-ie8.js"></script>
  <![endif]-->
  <!-- 如果需要在 Chrome Firefox 等现代浏览器中通过H5播放hls，需要引入 hls.js -->
  <script src="//imgcache.qq.com/open/qcloud/video/tcplayer/lib/hls.min.0.8.8.js"></script>
  <!-- 引入播放器 js 文件 -->
  <script src="//imgcache.qq.com/open/qcloud/video/tcplayer/tcplayer.min.js"></script>	
   <style>
    html,body{
      margin: 0;
      padding: 0;
    }
    .tcplayer {
      margin: 0 auto;
    }
    @media screen and (max-width: 640px) {
      #player-container-id {
        width: 100%;
        height: 270px;
      }
    }
    /* 设置logo在高分屏的显示样式 */
    @media only screen and (min-device-pixel-ratio: 2), only screen and (-webkit-min-device-pixel-ratio: 2) {
      .tcp-logo-img {
        width: 50%;
      }
    }
  </style>
    <?php }else{?>
	<script src="https://g.alicdn.com/de/prismplayer/2.7.1/aliplayer-min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.7.1/skins/default/aliplayer.css" />	
    <?php }?>		
</head>
<body>
<div id="video-wrap" class="video-wrap">
<?php if($result['vdoService']=='tencent'){?>
<video id="player-container-id" preload="auto" width="780" height="550" playsinline webkit-playsinline>
<?php }else{?>
<div class="prism-player" id="playercontainer"></div>
<?php }?>		
</div>
<?php if(isset($player)){?>
<script type="text/javascript">
   <?php echo $player;?>
</script>
<?php }?>
</body>
</html>
<!--<div id="playercontainer" ></div><script src="<?php echo UOOT;?>Public/common/js/baidu/cyberplayer.js" type="text/javascript"></script>-->
