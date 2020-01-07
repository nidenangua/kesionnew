<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>

</head>

<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;图标管理
        <div  id="picker" class="btn btn-tool btn-rounded btn-s-md  ml15"  ></div>	
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
<br />
</div>

	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix"> 
			<li style="margin-right: 15px;"><input class="selectAll select-checks" name="check1" type="checkbox"></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<!--<div class="shaixuan clearfix">
					<a class="mr20">最新上传 <i class="desc-i"></i></a>
				</div> -->
			</li>
			<li class="fr gameScreen">
				

			</li>				
		</ul>	
	</div>
	
	<div class="bg-white" style="border-radius: 10px;padding: 30px;">
		<div  id="ksBoxContent">
			<div class="tabCont clearfix">
				<span class="prev"><i class="iconfont icon-left"></i></span>
				<div class="hideCont">
					<ul class="tab-date">
						<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Ico','index','',GP('chektype-'.$chektype,true));?>')"><div>全部</div></li>
						<?php foreach($dirname as $k=>$v){?>
						<li <?php if($nowdir == $v){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Ico','index','',GP('nowdir-'.$v.',chektype-'.$chektype,true));?>')"><div><?php echo $v?></div></li>
						<?php }?>
					</ul>
				</div>
				<span class="next"><i class="iconfont icon-right"></i></span>
			</div>
			 
			<div id="imgContent">
				<div class="hideConts">
					<ul class="flex-container">
						<?php foreach($filename as $k=>$v){?>
						<li>
							<div class="imgWraps">
								<div class="imgBoxe">
									<input name="imgs" type="checkbox" class="select-checks img" flag='<?php echo $v['filePath'];?>' />
									<span></span>
									<img width="140" style="border-radius: 10px;" height="140" src='<?php echo $v['filePath'];?>'>
								</div>
								<p><?php  echo $v['filename']; ?></p>
							</div>
						</li>
						<?php }?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div id="ksBoxFooter" style="height:250px;"></div>
	
<div class="footer-page h60">
    <div class="col-sm-5">
     <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input class="selectAll select-checks" name="check1" type="checkbox">
            <label for="checkboxAll">全选 </label>
        </div>
        <button class="btn mt10 btn-default" type="button" id="yesido">批量删除</button>
    </div>

    <div class="col-sm-7 " style="margin-top:7px">
    	<?php echo $page->show(3); ?>
    </div>
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.Jcrop.min.js"></script>
<script src="<?php echo UOOT;?>Public/webuploader/webuploader.js"></script>
<script>
	var couttab = 0;
	
	//设置个数
	var tabNum = 8;
	//获取宽度
	var width = ($(window).width()-170);
	width = width/tabNum;
	//设置宽度 
	$(".tab-date li").css("width",width);
	//获取个数
	var tabliNum = $(".tab-date li").length
	//获取限制下一个点击数
	var limitNext = tabliNum-tabNum;
	
	console.log(width);
	$(".next").click(function(){
		couttab+=1;
		if(couttab>limitNext){couttab=limitNext;}
		if(couttab<=limitNext){
			var where = couttab*width*(-1);
			console.log(11);
			$(".tab-date").css("margin-left",where);
		}
		
	})
	
	$(".prev").click(function(){
		couttab-=1;
		if(couttab<=0){couttab=0;}
		if(couttab>=0){
			var where = couttab*width*(-1);
			$(".tab-date").css("margin-left",where);
		}
	})
	
	$(".tab-date li").click(function(){
		$(".tab-date li").removeClass("active");
		$(this).addClass("active");
	})
	function tabNext(){
		width = ($(window).width()-170);
		width = width/tabNum;
		//设置宽度 
		$(".tab-date li").css("width",width);
	};
	window.onresize=function(){tabNext();}

	
	</script>
<script>
	$("#yesido").click(function(){
	/*开启水印*/
	var data = "";
	var ary = [];
	
	$(":input[name='imgs']:checked").each(function(){
		ary.push($(this).attr("flag"));
	})
	$.ajax({
		url:'<?php echo M_URL('Ico','deleteico');?>',
		type:'post',
		data:{imgary:ary},
		error:function(){
			alert('error');   
		},   
		success:function(imgdata){
			Alert(imgdata);
			setTimeout(function(){
				location.reload()
			},1000);
		} 
	}); 
})
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
			 title: 'Images',
			 extensions: 'gif,jpg,jpeg,bmp,png',
			 mimeTypes: 'image/!*'
		},
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		fileSingleSizeLimit: limitSize*1024, //限制单个上传图片的大小
		pick: {
			  id:other.picker,
		      innerHTML: '本地图片'
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
			window.location.reload();
			
			/*console.log(response.info);
			console.log(response.name);
			/**在这里**/
			

			
		}else{Alert(response.info);}
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
uploadView2(180,120,{picker:'#picker',filelist:'#filelist',url:'/Plus/Uploader.php?act=Icolist'});
</script>