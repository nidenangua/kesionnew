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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/baidu/cyberplayer.js" type="text/javascript"></script>

</head>

<body class="bg-gary">
<ul class="liveTab clearfix mb30">
     <li class="fl">
        <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="alignCenter">
            <span class="block hLh40">
<i class="icon iconfont">&#xe748;</i>
            </span>
            <span class="block hLh35 fsize14">主页</span>
        </a>
    </li>
    <li class="fl  curr">
        <a href="<?php echo M_URL($this->AppName.'/Index','listVod','',GP('')); ?>" class="alignCenter">
            <span class="block  hLh40">
                 <i class="icon iconfont">&#xe609;</i>
            </span>
            <span class="block hLh35 fsize14">视频列表</span>
        </a>
    </li>

    <li class="fl">
        <a href="<?php echo M_URL($this->AppName.'/Index','playSetting','',GP('')); ?>" class="alignCenter">
            <span class="block hLh40">
<i class="icon iconfont">&#xe748;</i>
            </span>
            <span class="block hLh35 fsize14">播放器设置</span>
        </a>
    </li>
</ul>
<div class="clear"></div>
<div class=" contentBox bRadius10 bg-white editPerson" style="padding: 20px">
<form action="<?php echo M_URL($this->AppName.'/Index','doplaySetting','',GP('')); ?>" method="post" enctype="multipart/form-data">
      <table>
          <tr>
              <td>播放器名称：</td>
              <td><input type="text" name="title" value="<?php if(isset($setting))echo $setting[0]  ?>"></td>
              <td></td>
          </tr>
           <tr>
              <td>宽度：</td>
              <td><input type="text" name="weight" value="<?php if(isset($setting))echo $setting[1]  ?>"></td>
               <td></td>
          </tr>
          <tr>
              <td>高度：</td>
              <td><input type="text" name="hight" value="<?php if(isset($setting))echo $setting[2]  ?>"></td>
               <td></td>
          </tr>
           <tr>
              <td>皮肤：</td>
              <td><input type="radio" name="skin" value="five" <?php if(isset($setting))if($setting[3] =="five") echo "checked"; ?>>皮肤一 &nbsp;&nbsp;
                  <input type="radio" name="skin" value="beelden" <?php if(isset($setting))if($setting[3] =="beelden") echo "checked"; ?>>皮肤二 &nbsp;&nbsp;
                  <input type="radio" name="skin" value="glow" <?php if(isset($setting))if($setting[3] =="glow") echo "checked"; ?>>皮肤三 &nbsp;&nbsp;
                  <input type="radio" name="skin" value="roundster" <?php if(isset($setting))if($setting[3] =="roundster") echo "checked"; ?>>皮肤四 &nbsp;&nbsp;
                  <input type="radio" name="skin" value="seven" <?php if(isset($setting))if($setting[3] =="seven") echo "checked"; ?>>皮肤五 &nbsp;&nbsp;
              </td>
               <td></td>
          </tr>
          <tr>
              <td>logo：</td>
              <td>
              <div class="control-group js_uploadBox">
                <div class="btn-upload clearfix">
                    <a href="javascript:void(0);" class="selectImageBtn c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
                    <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                    <input class="hide js_upFile" type="file" name="logo" id="upImg">
                </div>
                <div class="js_showBox mt10 w180"><img class="js_logoBox block" src="<?php if(isset($setting)) echo Img($setting[4]);?>" width="90" onerror="this.src='<?php echo nopic();?>'"></div>
            </div>
              </td>
              <td>
              
                  <select name="logoPosition">
                      <option value="0">不显示</option>
                      <option value="top-right" <?php if(isset($setting))if($setting[5] =="top-right") echo "selected"; ?> >右上角</option>
                      <option value="top-left"  <?php if(isset($setting))if($setting[5] =="top-left") echo "selected"; ?>>左上角</option>
                  </select>
             </td>
          </tr>
           <tr>
              <td>是否自动播放</td>
              <td><input type="radio" name="autostart" value="1" <?php if(isset($setting))if($setting[6] == "1") echo "checked"; ?>>是
                  <input type="radio" name="autostart" value="0" <?php if(isset($setting)){if($setting[6] == "0") echo "checked";}else{echo "checked";} ?>>否
              </td>
          </tr>
          <tr>
              <td><input type="checkbox" name="isStart" value="1" <?php if(isset($setting))if($setting[7] == "1") echo "checked"; ?>>片头广告</td>
              <td>
                   广告图片<input type="text" name="img1" value="<?php if(isset($setting)) echo $setting[8];  ?>"><br /> 
                   图片链接<input type="text" name="url1"  value="<?php if(isset($setting)) echo $setting[9];  ?>"><br /> 
                   时间<input type="text" name="time1"  value="<?php if(isset($setting)) echo $setting[10];  ?>">
              </td>
          </tr>
          <tr>
              <td><input type="checkbox" name="isSuspend" value="1"  <?php if(isset($setting))if($setting[11] == "1") echo "checked"; ?>>暂停广告</td>
              <td>
                   广告图片<input type="text" name="img2"  value="<?php if(isset($setting)) echo $setting[12];  ?>"><br />  
                   图片链接<input type="text" name="url2"  value="<?php if(isset($setting)) echo $setting[13];  ?>"> 
              </td>
          </tr>
          <tr>
              <td><input type="checkbox" name="isEnding" value="1"  <?php if(isset($setting))if($setting[14] == "1") echo "checked"; ?>>结尾广告</td>
              <td>
                  广告图片<input type="text" name="img3"  value="<?php if(isset($setting)) echo $setting[15];  ?>"> <br /> 
                  图片链接<input type="text" name="url3"  value="<?php if(isset($setting)) echo $setting[16];  ?>"> 
              </td>
          </tr>
         <tr>
             <td><input type="checkbox" name="isMarquee" value="1"  <?php if(isset($setting))if($setting[17] == "1") echo "checked"; ?>>是否启用跑马灯</td>
             <td>
                   内容<input type="text" name="marqueeText" value="<?php if(isset($setting)) echo $setting[18];  ?>">
                   字体大小<input type="number" name="marqueeSize" value="<?php if(isset($setting)) echo $setting[19];  ?>">
                   字体颜色<input type="text" name="marqueeColcr" value="<?php if(isset($setting)) echo $setting[20];  ?>">
             </td>
         </tr>
         <tr>
              <td><input type="checkbox" name="isRightclick1" value="1" <?php if(isset($setting))if($setting[21] == "1") echo "checked"; ?>>自定义右键一</td>
              <td>
                   右键名<input type="text" name="title1" value="<?php if(isset($setting)) echo $setting[22];  ?>"><br /> 
                   链接<input type="text" name="rightUrl1"  value="<?php if(isset($setting)) echo $setting[23];  ?>"><br /> 
              </td>
          </tr>
          <tr>
              <td><input type="checkbox" name="isRightclick2" value="1" <?php if(isset($setting))if($setting[24] == "1") echo "checked"; ?>>自定义右键二</td>
              <td>
                   右键名<input type="text" name="title2" value="<?php if(isset($setting)) echo $setting[25];  ?>"><br /> 
                   链接<input type="text" name="rightUrl2"  value="<?php if(isset($setting)) echo $setting[26];  ?>"><br /> 
              </td>
          </tr>
          <tr>
               <td><input type="checkbox" name="isRightclick3" value="1" <?php if(isset($setting))if($setting[27] == "1") echo "checked"; ?>>自定义右键三</td>
              <td>
                   右键名<input type="text" name="title3" value="<?php if(isset($setting)) echo $setting[28];  ?>"><br /> 
                   链接<input type="text" name="rightUrl3"  value="<?php if(isset($setting)) echo $setting[29];  ?>"><br /> 
              </td>
          </tr>
          <tr>
              <td><input type="submit" value="提交"></td>
              <td></td>
              <td></td>
              
          </tr>
     </table>
<!--<div id="playercontainer"></div> 
<script type="text/javascript">
    var player = cyberplayer("playercontainer").setup({
  
       
        file: "http://gcqq450f71eywn6bv7u.exp.bcevod.com/mda-hbqagik5sfq1jsai/mda-hbqagik5sfq1jsai.mp4",
        autostart: true,
        repeat: false,
        volume: 100,
        controls: true,
		
        
	
        ak: "134e7d2d4c4e433880ec6b5053439f65" // 公有云平台注册即可获得accessKey
    });
</script>    -->
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
uploadView(180,120);
</script>



</body>

</html>
