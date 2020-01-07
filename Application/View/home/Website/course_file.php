<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/app/css/style.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/jquery.Jcrop.min.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/popup/js/kesion.popup.js" type="text/javascript"></script>
<style>
	::-webkit-scrollbar{width:5px;height:10px;background-color:#CCC}
	::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px #fff;border-radius:10px;background-color:#CCC}
	::-webkit-scrollbar-thumb{border-radius:10px;-webkit-box-shadow:inset 0 0 6px #CCC;background-color:#CCC}
  	#cropbox{background-color: #ccc;width: 500px;height: 330px;font-size: 24px;display: block;}
	.Alert-box{ height: auto;}
	.Alert-poress{height: 50px;}
	.Alert-selectarea{ padding-left: 180px; position: relative;}
	.Alert-left{ position: absolute; width: 179px; height: 100%;left: 0px;top: 0px;overflow: auto;}
	.Aleft-ul{ border-right: 1px solid #EAEAEA; height: 100%;}
	.Aleft-ul li{ padding: 10px 30px;font-size: 15px;cursor: pointer;}
	.Aleft-ul li.active{ background: #e4e5e6; }
	.Aleft-ul li:hover{ background: #e4e5e6; }
	.Aporess-ul{ width: 100%;}
	.Aporess-ul li{width: 50%; float: left; height: 50px; background: #fff; text-align: center; font-size: 15px; line-height: 50px; color: #7b7b7b;}
	.Aporess-ul li.curr{background: #44B549 url(<?php echo UOOT;?>Public/app/images/curr.png) no-repeat 100% 50%;color: #fff;}
	.Aporess-ul li.curr1{background: #44B549 url(<?php echo UOOT;?>Public/app/images/curr1.png) no-repeat 100% 50%;color: #fff;}
	.Aporess-ul li.curr2{background: #44B549;color: #fff;}
	.Alert-right{}
	.Alert-option{ text-align: right; height: 50px;line-height: 50px;padding-right: 15px; border-bottom: 1px solid #e5e5e5; color: #7b7b7b;border-top: 1px solid #e5e5e5; color: #7b7b7b;font-size: 15px;}
	.Aconts-ul{ margin-right: 15px;}
	.Aconts-ul li{float: left; width: 20%;}
	.Aconts-ul li input{position: absolute;top: 0px;left: 0px;opacity: 0;}
	.Aconts-ul .Alert-img{overflow: hidden; position: relative;}
	.Alert-conts{ padding: 15px 10px; overflow: auto; height: 300px;}
	.Alert-img img{width: 100%; height:  100%; min-height: auto;min-width: auto;}
	.Alert-img i{ position: absolute; top: 50%; left: 50%;font-size: 60px; margin-top: -40px; margin-left: -30px; color:#44B549;}
	.Alert-shadow{position: absolute; height: 100%; width: 100%; background: #000000; opacity: 0.6;}
	.Aconts-box{margin: 15px 0px 0px 15px;border: solid 1px #e5e5e5;position: relative;}
	.Alert-mark{padding: 0px 10px; border-top:1px solid #E5E5E5 ;height: 30px; line-height: 30px; text-align: center;font-size: 12px;overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;}
	.Alert-imgmain{width:240px;overflow: hidden;text-align: center;height:240px; line-height:240px; border: #E7E7E9 solid 1px; background: #F4F5F9;}		
	.Alert-width{width: 260px;margin-left: 60px; }
	.Aleft-page{padding: 15px;font-size: 15px; text-align: center;}
	.ctrShaw{display: none;}
	/**更正***/
	.webuploader-pick{ background:#44B549;}
  	.pagination-digg .active{color: #fff!important;
  	.Alert-imgText{ height: 50px;}
    background-color: #44B549!important;}
</style>
</head>
<body>
	<div class="Alert-box" style="width: 100%;">
			<div class="Alert-poress clearfix">
				<ul class="Aporess-ul">
					<li class="curr">选择文件</li>
					
				</ul>
			</div>
			<div class="Alert-selectarea">
			
				<div class="Alert-left">
					<ul class="Aleft-ul">
						<?php if($type == 2){ ?>
						<li  onClick="skip('<?php echo M_URL('Index','coursefile','',GP('type-'.$type));?>')">全部视频</li>
						<?php }elseif($type == 3){ ?>
						<li  onClick="skip('<?php echo M_URL('Index','coursefile','',GP('type-'.$type));?>')">全部音频</li>
						<?php }elseif($type == 4){ ?>
						<li  onClick="skip('<?php echo M_URL('Index','coursefile','',GP('type-'.$type));?>')">全部文档</li>
						<?php }elseif($type == 5){ ?>
						<li  onClick="skip('<?php echo M_URL('Index','coursefile','',GP('type-'.$type));?>')">全部ppt</li>
						<?php } ?>		
						
					</ul>
				</div>
				<div class="Alert-right">
					<div class="Alert-option">
		<!--				<span class="ks-bt bt-def mt5 ml10" onclick="addTypeChange('<?php echo M_URL('Index','Syncimages','',GP('tempdir-'.$tempdir,true));?>','450px','250px');"><i class="iconfont icon-f14"></i>同步到百度云盘(当前目录)</span>-->
						<div  id="picker" style="height: 35px; overflow: hidden; line-height: 30px; margin-top: 5px; border-radius: 5px;" >本地上传</div>
					</div>
					
					<div class="Alert-conts clearfix">
						<ul class="Aconts-ul">
							<?php foreach($values as $k=>$v){?>
							<li class="card-li"><div class="Aconts-box">								
								<div class="Alert-img"  autoimg="1,1">
									<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
									<?php if($type == 2){ ?>
									<img class="card-img" src="/Public/uploads/common/vod.jpg"/></div>
									<?php }elseif($type == 3){  ?>
									<img class="card-img" src="/Public/uploads/common/audio.jpg"/></div>
									<?php }elseif($type == 4){ ?>
									<img class="card-img" src="/Public/uploads/common/doc.jpg"/></div>	
									<?php }elseif($type == 5){ ?>
									<img class="card-img" src="/Public/uploads/common/ppt.jpg"/></div>	
									<?php } ?>		
								<div class="Alert-mark"><?php  echo $v['filename']; ?></div> 
								<input type="checkbox" />
							</div>
							</li>	
							<?php }?>
							
					
						</ul>
						<?php echo NoC($values);?>
					</div>
				
					<div class="Aleft-page clearfix">
							<?php echo $page->show(3); ?>
					</div>
					
					
				</div>
				<!--<input type="hidden" id="saveImg" value="" />-->
				<!------------------------------------------------------------------------------------------------------------>
				
				<div class="Alert-right"  id="cutImg">
					
		

					<div class="alignCenter">
						<input type="submit" value="   确    认    " class="ks-bt bt-green fn" id="enter"/>
					</div>
				</div>
			</div>
		</div>
		
		<div>
			
			
		</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.Jcrop.min.js"></script>
<script src="<?php echo UOOT;?>Public/webuploader/webuploader.js"></script>
<script>
var chektype = 0;


/*****初始化*****/	
/*选中类型1是单选，0是多选；*/

/**初始化显示页面**/
if(chektype==0){
	$(".Alert-poress").hide();
	$("#next").text("确  认");
	$("#next").attr("id","yesido");
	$(".Alert-poress").hide();
	
}

</script>
<script>

$(document).on('click','.Aconts-ul li',function(){
	var src = $(this).find(".card-img").attr("src");
	$(this).find("input").val(src);//将值传给input
	if(chektype==0){
		$(this).find("input[type='checkbox']").prop('checked',true);
		$(this).addClass("onYes");		
		$(this).find(".ctrShaw").show();//显示打钩
	}else{
		$(".ctrShaw").hide();//不显示打钩
		$(this).find(".ctrShaw").show();//显示打钩
		$("#saveImg").val(src);
	}
	
})
$(document).on('click','.onYes',function(){
	var src = $(this).find(".card-img").attr("src");
	$(this).find(".ctrShaw").hide();
	$(this).removeClass("onYes");
	$(this).find("input[type='checkbox']").prop('checked',false);
	

})
function uploadView2(x,y,other){
	 var limitSize=512000; //限制大小 KB
	 <?php if($type == 2){ ?>
	 var fileExt="mp4" //限制扩展名
	 <?php }elseif($type == 3){ ?>
	 	 var fileExt="mp3" //限制扩展名
	 <?php }elseif($type == 4){ ?>	
	  var fileExt="doc,txt,pdf" //限制扩展名
	  <?php }elseif($type == 5){ ?>	
	  var fileExt="ppt" //限制扩展名
	  <?php } ?>	 		
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
		auto: true,
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
			 title: 'file',
			 extensions: '*',
			 mimeTypes: 'image/!*'
		},
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		fileSingleSizeLimit: limitSize*1024, //限制单个上传图片的大小
		pick: {
			  id:other.picker,
		      innerHTML: '本地文件'
		} //上传图片的按钮，start
	}); 
	// 当有文件添加进来的时候
	uploader.on('fileQueued', function (file) {
		uploader.makeThumb( file, function( error, src ) {
			var img;
			if( isSupportBase64 ) {img = $('<img src="'+src+'">');}
			$(other.filelist).empty().append(img);
		},thumbnailWidth,thumbnailHeight );
	});
	uploader.on('uploadSuccess', function (file,response) {
		if(response.result=='succeed'){
			location.reload();
		}else{Alert('出现重复文件名称，或者压缩包没有config文件，请检查后重新上传');}
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
uploadView2(180,120,{picker:'#picker',filelist:'#filelist',url:'/Plus/Uploader.php?act=coursefile&wxid=<?php echo $this->wxid;?>'});
</script>
</body>
</html>