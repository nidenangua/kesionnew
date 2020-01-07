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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/colpick.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/baidu/cyberplayer.js" type="text/javascript"></script>
<style>
.hibox{display: none;}
.form-row .name{display: block;font-size:14px; line-height: 34px;height: 34px; overflow: hidden;color:#ababab;}
.ks-table {margin: 15px 0;border-bottom: 1px solid #eee;}
 #colopic {border-right:30px solid green;}
</style>
</head>

<body class="ks-wrap">
	<!--开始-->

	<div id="ksBoxHead">
		<!--结束-->
		<div class="Header-tool clearfix"> 
			<div class="Tool-Title">
	
			
			
			<!--标题-->
			<p>
			<a href="<?php echo M_URL('Website'); ?>"><i class="iconfont icon-jiantou-copy"></i>网站设置</a><span>/</span>播放器设置
		</p>
			<!--标题-->
			
			</div>
			<!--操作范围-->
			
			<!--按钮组件-->
		
			<!--按钮组件-->
			
			<!--搜索框组件-->
			<div class="clearfix ">
			<div class="fl">
				<!--栏目块-->
				<!--<ul class="Tool-nav">
			      	<li class="fl">
				        <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>">主页</a>
				    </li>
				    <li class="fl  curr">
				        <a href="<?php echo M_URL($this->AppName.'/Index','listVod','',GP('')); ?>" >视频列表 </a>
				    </li>
				    <li class="fl">
				        <a href="<?php echo M_URL($this->AppName.'/Index','playSetting','',GP('')); ?>" >播放器设置 </a>
				    </li>
			    </ul>-->
			    <!--栏目块-->
		    </div>
			
		</div>	
			
			<!--搜索框组件-->
			
			<!--操作范围-->
		
		</div>
	</div>
	
	<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','doplaySetting','',GP('')); ?>" method="post" enctype="multipart/form-data">
	<div class="bg-white bRadius10 mt20 ks-wbox">
		<div id="ksBoxContent">
			<div class="Created-largetTitle pt20">
					<span>1</span>
					<div class="Created-title">  
						<span>基本设置</span>
						
					</div>
				</div>	
     	<table>
          	<tr>
             	<td class="hLh48">播放器名称：</td>
             	<td><input type="text" name="title" class="inputText bRadius5 w300" value="<?php if(count($setting)>1)echo $setting[0]  ?>"></td>
             	<td></td>
          	</tr>
           	<tr>
              	<td class="hLh48">宽度：</td>
             	<td><input type="text" name="weight" class="inputText bRadius5 w300" value="<?php if(count($setting)>1){echo $setting[1];}  ?>"></td>
               	<td></td>
          	</tr>
         	<tr>
            	<td class="hLh48">高度：</td>
              	<td><input type="text" name="hight" class="inputText bRadius5 w300" value="<?php if(count($setting)>1){echo $setting[2] ;} ?>"></td>
              	<td></td>
          	</tr>
          	<tr>
              	<td class="hLh48">皮肤：</td>
              	<td>
	              	<input type="radio" id="skin1" class="radioInput fl" name="skin" value="five" <?php if(count($setting)>1)if($setting[3] =="five") echo "checked"; ?>>
	              	<label class="fl mr20" for="skin1">皮肤一</label>
	              	<input type="radio" id="skin2"  class="radioInput" name="skin" value="beelden" <?php if(count($setting)>1)if($setting[3] =="beelden") echo "checked"; ?>>
	              	<label class="fl mr20"  for="skin2">皮肤二</label>
	                <input type="radio" id="skin3"  class="radioInput" name="skin" value="glow" <?php if(count($setting)>1)if($setting[3] =="glow") echo "checked"; ?>> 
	                <label class="fl mr20"  for="skin3">皮肤三</label>	
	                <input type="radio" id="skin4"  class="radioInput" name="skin" value="roundster" <?php if(count($setting)>1)if($setting[3] =="roundster") echo "checked"; ?>> 
	                <label class="fl mr20"  for="skin4">皮肤四</label>	
	                <input type="radio" id="skin5"  class="radioInput" name="skin" value="seven" <?php if(count($setting)>1)if($setting[3] =="seven") echo "checked"; ?>>
                	<label class="fl mr20"  for="skin5">皮肤五</label>
            	</td>
               	<td></td>
          	</tr>
          	<tr>
              	<td class="hLh48">logo：</td>
              	<td>
              		<div class="control-group js_uploadBox">
		                <div class="btn-upload clearfix">
		                    <a href="javascript:void(0);" id="picker" class="c-89 fsize14 fl mr10 bRadius5"></a>
		                    <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
		                    <input class="hide js_upFile" type="file" name="logo" id="upImg">
		                </div>
	                	<div id="filelist"><img onerror="this.src='<?php echo nopic(1);?>'" src="<?php if(count($setting)>1){echo XImg($setting[4]);}?>" width="90" ></div>
	                	<input type="hidden" name="logo" id="logo" />
            		</div>
              	</td>
              	<td></td>
          	</tr>
          	
          	<tr>
          		
              	<td class="hLh48">是否自动播放</td>
              	<td>
              		<input type="radio" id="mmd1" class="radioInput fl" name="autostart" value="1" <?php if(count($setting)>1)if($setting[6] == "1") echo "checked"; ?>>
              		<label for="mmd1" class="fl mr30">是</label>
                	<input type="radio" id="mmd2" class="radioInput fl" name="autostart" value="0" <?php if(count($setting)>1){if($setting[6] == "0") echo "checked";}else{echo "checked";} ?>>
                	<label for="mmd2" class="fl mr30">否</label>
              	</td>
          	</tr>
         	<tr>
          	<td colspan="3" style="padding: 25px  0   15px 0">
                 	<select name="logoPosition" class="w150 inputText bRadius5">
                      	<option value="0">不显示</option>
                      	<option value="top-right" <?php if(count($setting)>1)if($setting[5] =="top-right") echo "selected"; ?> >右上角</option>
                     	<option value="top-left"  <?php if(count($setting)>1)if($setting[5] =="top-left") echo "selected"; ?>>左上角</option>
                 	</select>
            	</td>
          	</tr>
          	<tr>
          		<!--暂停广告-->
          			
          		<table class="ks-table" >
					<div class="Created-largetTitle pt20">
						<span>2</span>
						<div class="Created-title">  
							<span>其他设置</span>
							
						</div>
					</div>	
						<div class="form-row "><span class="name">广告</span></div>
					
							<thead>
								<tr>
									<th>是否开启</th>
									<th>广告名称</th>
									<th>广告图片</th>
									<th>图片链接</th>
									<th>时间</th>
								</tr>
							</thead>
							<tbody>
							<!--片头广告-->
								<tr>
									<td>
										<input type="checkbox" class=" offbox" name="isStart" value="1" <?php if(count($setting)>1)if($setting[7] == "1") echo "checked"; ?>>
              							
									</td>
									<td>
										<label for="" class="fl">片头广告</label>
              						
									</td>
									<td>
										<div >
					                   		
					                   		<div id="picker2" class="fr" style="margin-top: 35px;"></div>
					                   		<div id="filelist2" class="fl"><img onerror="this.src='<?php echo nopic();?>'" src="<?php if(count($setting)>1) echo $setting[8];  ?>" width="100px" height="100px" alt="" /></div>
					                   		<input type="hidden" name="img1" id="img1"/>
					                   	</div>
									</td>
									<td>
											<div class="hLh48">
						                 
						                   	<input type="text" name="url1" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[9];  ?>">
	               							 </div>
									</td>
									<td>
											
						                   	
						                   	<input type="text" name="url1" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[9];  ?>">
	               							
									</td>
									
								</tr>
								
								 		
          					<!--片头广告end-->
          					<!--暂停广告-->
								<tr>
									<td>
										<input class=" offbox"  type="checkbox" name="isSuspend" value="1"  <?php if(count($setting)>1)if($setting[11] == "1") echo "checked"; ?>>
              							
									</td>
									<td>
										<label for="" class="fl">暂停广告</label>
              					
									</td>
									<td>
										<div >
					                   		
					                   		<div id="picker3" class="fr" style="margin-top: 35px;"></div>
					                   		<div id="filelist3" class="fl"><img onerror="this.src='<?php echo nopic();?>'" src="<?php if(count($setting)>1) echo $setting[12];  ?>" width="100px" height="100px" alt="" /></div>
					                   		<input type="hidden" name="img2" id="img2"/>
					                   	</div>
									</td>
									<td>
											 <input type="text" name="url2" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[13];  ?>"> 
									</td>
									<td>
											
						                   	
						                   <input type="text" name="url2" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[13];  ?>"> 
	               							
									</td>
									
								</tr>
								
								<!--暂停广告end-->
								<!--结尾广告-->
								<tr>
									<td>
									<input type="checkbox" class=" offbox" name="isEnding" value="1"  <?php if(count($setting)>1)if($setting[14] == "1") echo "checked"; ?>>
              							
									</td>
									<td>
										<label for="" class="fl">结尾广告</label>
              						
									</td>
									<td>
										<div >
					                   		<div id="picker4" class="fr" style="margin-top: 35px;"></div>
                   							<div id="filelist4" class="fl"><img onerror="this.src='<?php echo nopic();?>'" src="<?php if(count($setting)>1) echo $setting[15];  ?>" width="100px" height="100px" alt="" /></div>
                   							<input type="hidden" name="img3" id="img3"/>
					                   	</div>
									</td>
									<td>
											<div class="hLh48">
						                 
						                  <input type="text" name="url3" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[16];  ?>"> 
	               							 </div>
									</td>
									<td>
											
						                   	
						                  <input type="text" name="url3" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[16];  ?>"> 
	               							
									</td>
									
								</tr>
								
								<!--结尾广告end-->
								
							</tbody>
							
						
					</table>
            
          	</tr>
          	
          	<tr>
          		<div class="form-row "><span class="name">跑马灯</span></div>
          		<table class="ks-table" style="width: 85%;">
          			<thead>
          				<tr>
          					
          					<th>内容</th>
          					<th>字体颜色</th>	
          					<th>字体大小</th>
          				</tr>
          			</thead>
          			<tbody>
          				<tr>
          					<td><input type="text" class="inputText bRadius5 w300"  name="marqueeText" value="<?php if(count($setting)>1) echo $setting[18];  ?>"></td>
          					<td><input type="text" id="colopic" class="inputText bRadius5 w300"  name="marqueeText" value="<?php if(count($setting)>1) echo $setting[19];  ?>"></td>
          					<td>
          						<select class="form-textbox">
          							<option>1</option>
          							<option>2</option>
          							<option>3</option>
          							<option>4</option>
          							<option>5</option>
          							<option>6</option>
          							<option>7</option>
          							<option>8</option>
          							<option>9</option>
          							<option>10</option>
          							<option>11</option>
          							<option>12</option>
          							<option>13</option>
          							<option>14</option>
          							<option>15</option>
          						</select>
          					</td>
          				</tr>
          			</tbody>
          		</table>
          	</tr>
          
          	<tr>
          		<div class="form-row "><span class="name">自定义右键</span></div>
          		<table class="ks-table" style="width: 85%;">
          			<thead>
          				<tr>
          					
          					<th>是否开启</th>
          					<th>名称</th>	
          					<th>右键名</th>
          					<th>链接</th>
          				</tr>
          			</thead>
          			<tbody>
          				<tr>
          					<td><input type="checkbox" class=" offbox" name="isRightclick1" value="1" <?php if(count($setting)>1)if($setting[21] == "1") echo "checked"; ?>></td>
          					<td>自定义右键一</td>
          					<td><input type="text" class="inputText bRadius5 w300" name="title1" value="<?php if(count($setting)>1) echo $setting[22];  ?>"></td>
          					<td><input type="text" class="inputText bRadius5 w300" name="rightUrl1"  value="<?php if(count($setting)>1) echo $setting[23];  ?>"></td>
          				</tr>
          				<tr>
          					<td><input type="checkbox" class=" offbox" name="isRightclick2" value="1" <?php if(count($setting)>1)if($setting[24] == "1") echo "checked"; ?>></td>
          					<td>自定义右键二</td>
          					<td><input type="text" name="title2" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[25];  ?>"></td>
          					<td><input type="text" name="rightUrl2" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[26];  ?>"></td>
          				</tr>
          				<tr>
          					<td><input type="checkbox" class=" offbox" name="isRightclick3" value="1" <?php if(count($setting)>1)if($setting[27] == "1") echo "checked"; ?>></td>
          					<td>自定义右键三</td>
          					<td><input type="text" name="title3" class="inputText bRadius5 w300" value="<?php if(count($setting)>1) echo $setting[28];  ?>"></td>
          					<td><input type="text" name="rightUrl3" class="inputText bRadius5 w300"  value="<?php if(count($setting)>1) echo $setting[29];  ?>"></td>
          				</tr>
          			</tbody>
          		</table>
          		
         
    </table>
    </div>
    
	</div>
    <div class="ks-bom clearfix form-footer" id="ksBoxFooter" style="height: 140px;">	
    	<div class="d-inline-block" >
			<input class="ks-bt bt-pue" id="StartBtn" type="button" value="确认修改" >
			<button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-white">取消</button>
		</div>
    </div>
	</form>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/webuploader/webuploader.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>	
<script src="<?php echo UOOT;?>Public/common/js/colpick.js" type="text/javascript"></script>
<script>
function uploadView2(x,y,other){
	 var limitSize=512000; //限制大小 KB
	 var fileExt="*.jpg;*.gif;*.png;*.bmp" //限制扩展名
	 var $ = jQuery,uploader,
	    ratio = window.devicePixelRatio || 1,
		// 缩略图大小
		thumbnailWidth  = x * ratio,
		thumbnailHeight = y * ratio,
		// 可能有pedding, ready, uploading, confirm, done.
        state = 'ready',
		// 判断浏览器是否支持图片的base64
		isSupportBase64 = ( function() {
			var data = new Image();
			var support = true;
			data.onload = data.onerror = function() {
				if( this.width != 1 || this.height != 1 ) {support = false;}
			}
			data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
			return support;
	 } )();
	 uploader = WebUploader.create({
		//auto: true,
		// 不压缩image
		resize: false,
		duplicate :false,
		//duplicate :true,
		multiple: false,
		// swf文件路径
		swf:'/Public/webuploader/Uploader.swf',
		// 文件接收服务端。
		server: other.url,
		accept: { // 只允许选择图片文件格式
			 title: 'Images',
			 extensions: 'gif,jpg,jpeg,bmp,png',
			 mimeTypes: 'image/!*'
		},
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		fileSingleSizeLimit: limitSize*1024, //限制单个上传图片的大小
		pick: {
			  id:other.picker,
		      innerHTML: '<span class="js_uploadText">上传</span>图片'
		} //上传图片的按钮，start
	}); 
	// 当有文件添加进来的时候
	uploader.on('fileQueued', function (file) {
		uploader.makeThumb( file, function( error, src ) {
			var img;
			if( isSupportBase64 ) {img = $('<img src="'+src+'">');}
			$(other.filelist).empty().append( img );
		},thumbnailWidth,thumbnailHeight );
	});
	uploader.on('uploadSuccess', function (file,response) {
		if(response.result=='succeed'){
			console.log(response.state);
			switch(response.state){
				case 'playlogo' : $("#logo").val(response.info);break;
		    	case 'playstart': $("#img1").val(response.info);break;
		    	case 'playing'  : $("#img2").val(response.info);break;
		    	case 'playend'  : $("#img3").val(response.info);break;
			}
			$("#myform").submit();	
		}else{Alert('上传的logo有问题，请换张图片上传');}
	});
	uploader.on('error', function (code) {
		var err = '';
		switch (code) {
			case 'F_EXCEED_SIZE':err += '单个文件大小不得超过' +  uploader.options.fileSingleSizeLimit + 'kb！';break;
			case 'Q_EXCEED_NUM_LIMIT':err += '最多只能上传' +  uploader.options.fileNumLimit + '张！';break;
			case 'Q_EXCEED_SIZE_LIMIT':err += '上传总大小超出'+limitSize;break;
			case 'Q_TYPE_DENIED':err += '无效图片类型，请上传正确的图片格式！';break;
			case 'F_DUPLICATE':err+='不能重复上传相同文件！';break;
			default:err += '上传错误，请刷新重试！错误代码：'+code;break;
		}
		Alert(err);
		return false;
	});
	$('#StartBtn').on('click', function() {
		if ( state === 'ready'){uploader.upload();} 
		else if ( state === 'paused'){uploader.upload();}
		else if ( state === 'uploading'){uploader.stop();}
		else if ( state === 'done'){$("#myform").submit();}
		else if ( state === 'restart'){uploader.upload();}
	});
    uploader.on('all', function (type) {
		if (type === 'startUpload') {
			state = 'uploading';
		} else if (type === 'stopUpload') {
			state = 'paused';
		} else if (type === 'uploadFinished') {
			state = 'done';
		}else if(type === 'filesQueued'){
			state = 'restart';
		}
	});
}
</script>
<script>
	uploadView2(180,120,{picker:'#picker',filelist:'#filelist',url:'/Plus/Uploader.php?act=doplaySetting&state=playlogo&wxid=<?php echo $this->wxid;?>'});
	uploadView2(180,120,{picker:'#picker2',filelist:'#filelist2',url:'/Plus/Uploader.php?act=doplaySetting&state=playstart&wxid=<?php echo $this->wxid;?>'});
	uploadView2(180,120,{picker:'#picker3',filelist:'#filelist3',url:'/Plus/Uploader.php?act=doplaySetting&state=playing&wxid=<?php echo $this->wxid;?>'});
	uploadView2(180,120,{picker:'#picker4',filelist:'#filelist4',url:'/Plus/Uploader.php?act=doplaySetting&state=playend&wxid=<?php echo $this->wxid;?>'});
	$(".offbox").click(function(){
		if($(this).is(':checked')){
			$(this).parents("td").next().find(".hibox").show();
		}else{
			$(this).parents("td").next().find(".hibox").hide();
		}
	})
	
	/*颜色*/
	
	$('#colopic').colpick({

	layout:'hex',

	submit:0,

	colorScheme:'dark',

	onChange:function(hsb,hex,rgb,el,bySetColor) {

		$(el).css('border-color','#'+hex);

		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.

		if(!bySetColor) $(el).val(hex);

	}

}).keyup(function(){

	$(this).colpickSetColor(this.value);

});
</script>
</body>
</html>
<!--<div id="playercontainer"></div> 
<script type="text/javascript">
    var player = cyberplayer("playercontainer").setup({
        <?php echo $html ?>
       
        file: "http://gcqq450f71eywn6bv7u.exp.bcevod.com/mda-hbqagik5sfq1jsai/mda-hbqagik5sfq1jsai.mp4",
        autostart: true,
        repeat: false,
        volume: 100,
        controls: true,
        ak: "134e7d2d4c4e433880ec6b5053439f65" // 公有云平台注册即可获得accessKey
    });
</script>-->