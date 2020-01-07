<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/app/css/style.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/imageslist.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/jquery.Jcrop.min.css" rel="stylesheet">

<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/popup/js/kesion.popup.js" type="text/javascript"></script>

</head>
<body>
	<div class="Alert-box" style="width: 100%;">
			<div class="Alert-poress clearfix">
				
				<ul class="Aporess-ul">
					<li class="curr">选择文件</li>
					
					
				</ul>
			</div>
			<div class="Alert-selectarea">
			视频上线30M，其他10M
				<div class="Alert-left">
					<ul class="Aleft-ul">
						
						<li <?php if($type==2){ echo 'class="active"' ;} ?>  onClick="skip('<?php echo M_URL('Index','coursefile','',GP('type-2'));?>')">全部视频</li>
						<li <?php if($type==3){ echo 'class="active"' ;} ?> onClick="skip('<?php echo M_URL('Index','coursefile','',GP('type-3'));?>')">全部音频</li>
						<li <?php if($type==4){ echo 'class="active"' ;} ?> onClick="skip('<?php echo M_URL('Index','coursefile','',GP('type-4'));?>')">全部文档</li>
						
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
									<?php }elseif($type = 1){ ?>
									<img class="card-img" src="<?php echo $v['filePath']; ?>"/></div>
									<?php } ?>			
								<div class="Alert-mark"><?php  echo $v['filename']; ?></div> 
								<div class="filePath" ><?php  echo $v['filePath']; ?> </div>  
								<input type="checkbox" value="<?php echo $v['id'] ?>" class="file"/>
							</div>
							</li>	
							<?php }?>
							
					
						</ul>
						<?php echo NoC($values);?>
					</div>
				
				
					
				</div>
				<!--<input type="hidden" id="saveImg" value="" />-->
				<!------------------------------------------------------------------------------------------------------------>
				
				<div class="Alert-right"  id="cutImg">
					<div class="alignCenter">
						
					</div>
				</div>
			</div>
		</div>
		
		<div>
				<div class="clearfix ks-popup-footer" style="padding: 0 15px;">
						<div class="clearfix">
							<div class="fl "><input type="submit" value="   确    认    " class="ks-bt bt-pue fn" id="enter"/>	</div>
							<div class="fr"><?php echo $page->show(3); ?></div>
						</div>
					</div>
					
			
		</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.Jcrop.min.js"></script>
<script src="<?php echo UOOT;?>Public/webuploader/webuploader.js"></script>
<script>
var chektype = 0;

var type = <?php echo $type; ?>;
$('.filePath').hide();
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
	if(chektype==0){
		$(this).find("input[type='checkbox']").prop('checked',true);
		$(this).addClass("onYes");		
		$(this).find(".ctrShaw").show();//显示打钩
	}else{
		$(".ctrShaw").hide();//不显示打钩
		$(this).find(".ctrShaw").show();//显示打钩
	}	
})





$(document).on('click','.onYes',function(){
	
	var src = $(this).find(".card-img").attr("src");
	$(this).find(".ctrShaw").hide();
	$(this).removeClass("onYes");
	alert(type);
	$(this).find("input[type='checkbox']").prop('checked',false);
	

})

$('#enter').click(function(){
	$('.onYes').each(function(){
		var a = $(this).find("input[type='checkbox']").val();
		 var filename = $(this).find('.Alert-mark').text(); 
		  var filepath = $(this).find('.filePath').text(); 
		var data='<div id="a'+a+'">';
		var ext = filename.split('.');
		
		 data+='<div class="fileImg">';
		   if(ext[1] == 'txt'){
				data+='<img src="/Public/uploads/common/TXT.png" style="height: 35px; width:50px">';
			}else if(ext[1] == 'mp4'){
				data+='<img src="/Public/uploads/common/MOV.png" style="height: 35px; width:50px">';
			
			}else if(ext[1] == 'mp3'){
				data+='<img src="/Public/uploads/common/MP3.png" style="height: 35px; width:50px">';
			
			}else if(ext[1] == 'doc' || ext[1] == 'docx' ){
				data+='<img src="/Public/uploads/common/DOC.png" style="height: 35px; width:50px">';

			}else if(ext[1] == 'pdf' ){
				data+='<img src="/Public/uploads/common/PDF.png" style="height: 35px; width:50px">';

			}else if(ext[1] == 'PPT' || ext[1] == 'pptx'){
				data+='<img src="/Public/uploads/common/PPT.png" style="height: 35px; width:50px">';

			}else{
				data+='<img src="'+filepath+'" style="height: 35px; width:50px">';
				
			}
        data+='</div>';
		data+='<div class="file-name">'+filename+'</div>';
        data+='<input type="hidden" name="coursefile[]" value="'+a+'"><button type="button" onclick="removefile('+a+');">删除</button></div>';
   top.DataCallBack(data);
//		if(parent.frames['main'].$('#a'+a).length==0){		
//		  parent.frames['main'].$('#coursefiles').append(data);
//		}
	})
	 
	
	top.closePopup(window.name);
	
})


function uploadView2(x,y,other){
	 var limitSize=31457280; //限制大小 KB
	 if(type==2){ 
	 var fileExt="mp4"; //限制扩展名
     }else if(type==3){
	 var fileExt="mp3"; //限制扩展名
	 }else if(type==4){
	 var fileExt="doc,txt,pdf"; //限制扩展名
     }else if(type==5){
	 var fileExt="ppt"; //限制扩展名
 	 }	
 	
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
uploadView2(180,120,{picker:'#picker',filelist:'#filelist',url:'/Plus/Uploader.php?act=coursefile&type='+type+'&wxid=<?php echo $this->wxid;?>'});
</script>
</body>
</html>