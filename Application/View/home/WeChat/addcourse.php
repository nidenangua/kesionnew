<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>添加课程</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/setgate.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/lCalendar.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
<body>
	<div class="loadings" id="loadings"></div>
	<div class="set-wrap">
		<div class="edit-title">课程类型</div>
		<select class="edit-select" style="margin-bottom: 1rem;" onchange="course.changeChargeType(this)">
			<option data-type="1">点播课程</option>
			<option data-type="2">直播课程</option>
		</select>
		<div class="edit-title">简要介绍</div>
		<textarea id="s-intro" class="s-intro"></textarea>
		<div class="edit-title">课程名称</div>
			<input type="text" id="title" class="eding-title" >
			<div class="edit-title">收费方式</div> 
			<div class="edit-price-type ">
			   <div class="item free active" data-chargetype = "2">
			   		<div class="radio-inner"></div>
			   		<div class="item-con">免费</div>
			   		<div class="swoosh"></div>
			   </div>
			    <div class="item" data-chargetype = "1">
			   		<div class="radio-inner"></div>
			   		<div class="item-con">收费</div>
			   		<div class="swoosh"></div>
			   </div>
			   <div class="price-wrap" >
				   <div class="edit-title" style="font-size:14px">价格</div>
				   <div style="display:flex;align-items:center">
				   		<input type="number" class="eding-title" id="price" style="margin-bottom:0;margin-right:.5rem;flex:1;" >
				   		<span style="font-size:.7rem">元</span>
				   </div>
			   </div>
			</div>
			
			<div class="edit-title">课程封面</div>
			<div class="cover-wrap">
				<div class="cover-img"><img src="<?php echo UOOT ?>Public/wechat/images/nopic.png"/></div>
				<input type="file" style="display:none" onchange="course.changeCover(this)">
				<div class="cover-btn-wrap">
					<div class="cover-btn" id="cover-btn">修改封面</div>
				</div>
			</div>
			<div class="edit-title">课程介绍</div>
			<div class="intro-wrap" id="intro" contenteditable="true"></div>
			<div class="add-wrap">
				<div class="add-item" onclick="course.addImg()">添加图片</div>
				<input type="file" id="addImg" style="display:none" onchange="course.reciveImg(this)">
			</div>
			<div class="video">
				<div class="edit-title">课程视频</div>
				<div class="video-wrap">
					<div class="add-video" onclick="addVideo()">添加视频</div>
					
				</div>
				<input type="file" name="" id="file" onchange="videoUp(this)" style="display: none;"/>
			</div>
			<div class="time-wrap" style="display: none;">
				
				<div class="edit-title">开始时间</div>
				<input type="hidden"  id="hideTime1" value="" />
				<div class="item-time" id="stared">
					<div class="inner-time"></div>
					<div class="arrow-r"></div>
				</div>
				<div class="edit-title">结束时间</div>
				<input type="hidden"  id="hideTime2" value="" />
				<div class="item-time" id="end">
					<div class="inner-time"></div>
					<div class="arrow-r"></div>
				</div>
			</div>
			
		</div>
		<div class="bottomset">
			<div class="item bg-orange" style="color: #fff;" onclick="course.save()">确认</div>
		</div>
	</div>
</body>
	<script src="<?php echo UOOT;?>Public/common/js/aliyun/es6-promise.min.js" type="text/javascript"></script>
    <script src="<?php echo UOOT;?>Public/common/js/aliyun/aliyun-oss-sdk4.13.2.min.js" type="text/javascript"></script>
    <script src="<?php echo UOOT;?>Public/common/js/aliyun/aliyun-upload-sdk1.3.1.min.js" type="text/javascript"></script>
    <script src="<?php echo UOOT ?>Public/wechat/js/lCalendar.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/addcourse.js?version=1.0"></script>
	<script type="text/javascript">
		$('.edit-price-type').find('.item').click(function(){
			$(this).addClass('active').siblings('.item').removeClass('active');
			if($(this).hasClass('free')){
				$('.price-wrap').removeClass('active')
			}else{
				$('.price-wrap').addClass('active')
			}
		});
		new lCalendar().init({
			'trigger': '#hideTime1',
			'type': 'datetime',
			'callBack':function(){
				var a = $_id('hideTime1').value;
				var b = timeStamp(a);
				if(typeof $('#end').find('.inner-time').attr('data-time')!=="undefined"){
					//如果有结束时间的
					var c = Number($('#end').find('.inner-time').attr('data-time'));
					if(b>c){
						//如果开始时间大于结束时间
						toast2({
							content:'开始时间不能大于结束时间'
						});
						return false;
					}else{
						$('#stared').find('.inner-time').attr('data-time',b)
						$('#stared').find('.inner-time').html(a);
					}
				}else{
					$('#stared').find('.inner-time').attr('data-time',b)
					$('#stared').find('.inner-time').html(a);
				}
				
				
				
			}
		})
		new lCalendar().init({
			'trigger': '#hideTime2',
			'type': 'datetime',
			'callBack':function(){
				var a = $_id('hideTime2').value;
				var b = timeStamp(a);
				if(typeof $('#stared').find('.inner-time').attr('data-time')!=="undefined"){
					console.log(111)

					//如果有结束时间的
					var c = Number($('#stared').find('.inner-time').attr('data-time'));
					console.log(b,c)
					if(b<c){
						//如果结束时间小于开始时间
						toast2({
							content:'结束时间不能小于开始时间'
						});
						return false;
					}else{
						$('#end').find('.inner-time').attr('data-time',b)
						$('#end').find('.inner-time').html(a);
					}
				}else{
					$('#end').find('.inner-time').attr('data-time',b)
					$('#end').find('.inner-time').html(a);
				}
			}
		})
		$('#stared').click(function(){
			$('#hideTime1').click()
		})
		$('#end').click(function(){
			$('#hideTime2').click()
		})
		
		function timeStamp(time){
			var ys = time.split(' ')[0];
			var ts = time.split(' ')[1];
			var y = ys.split('-')[0];
			var m = ys.split('-')[1];
			var d = ys.split('-')[2];
			var m = ts.split('-')[0];
			var ms = ts.split('-')[1];
			var dateStr = y + '/' + m + '/' + d+m+ms;
		   	var date = new Date(time);
		   	return date.valueOf()
		}
		function addVideo(){
			$('#file').click();
			uploader.cleanList();
		}
		var userData = '';
		var uploadAddress = '';
		var uploadAuth = '';
		var videoId = '';
		function videoUp(target){
			if(target.files[0].name.indexOf('mp4')==-1&&target.files[0].name.indexOf('rmvb')==-1&&target.files[0].name.indexOf('avi')==-1&&target.files[0].name.indexOf('ts')==-1&&target.files[0].name.indexOf('MOV')==-1){
				toast2({
					content:'不是指定视频格式,重新选择'
				})
				return false;
			}
			$('#loadings').show();
			uploader.addFile(target.files[0], null, null, null, userData);
			uploadss();
			
		}
		
		
		var uploader = new AliyunUpload.Vod({
		     //分片大小默认1M，不能小于100K
		     partSize: 1048576,
		     //并行上传分片个数，默认5
		     parallel: 5,
		     //网络原因失败时，重新上传次数，默认为3
		     retryCount: 3,
		     //网络原因失败时，重新上传间隔时间，默认为2秒
		     retryDuration: 2,
		    // 开始上传
		    'onUploadstarted': function (uploadInfo) {
		    	
		     console.log("onUploadStarted:" + uploadInfo.file.name + ", endpoint:" + uploadInfo.endpoint + ", bucket:" + uploadInfo.bucket + ", object:" + uploadInfo.object);
		      //上传方式1, 需要根据uploadInfo.videoId是否有值，调用点播的不同接口获取uploadauth和uploadAddress，如果videoId有值，调用刷新视频上传凭证接口，否则调用创建视频上传凭证接口
		    	uploader.setUploadAuthAndAddress(uploadInfo, uploadAuth, uploadAddress,videoId);
		    },
		    // 文件上传成功
		    'onUploadSucceed': function (uploadInfo) {
		      console.log("onUploadSucceed: " + uploadInfo.file.name + ", endpoint:" + uploadInfo.endpoint + ", bucket:" + uploadInfo.bucket + ", object:" + uploadInfo.object);
		      $('#loadings').hide()
		      var videoCode = '<div class="video-title">'+ uploadInfo.file.name + '</div><div class="video-btn" onclick="addVideo()">修改视频</div>'
		      $('.video-wrap').html(videoCode)
		      addvodlist(videoId,uploadInfo.file.name);
		    },
		    // 文件上传失败
		    'onUploadFailed': function (uploadInfo, code, message) {
		      $('#loadings').hide()
		      alert("onUploadFailed: file:" + uploadInfo.file.name + ",code:" + code + ", message:" + message);
		    },
		    // 文件上传进度，单位：字节
		    'onUploadProgress': function (uploadInfo, totalSize, loadedPercent) {
		        console.log("onUploadProgress:file:" + uploadInfo.file.name + ", fileSize:" + totalSize + ", percent:" + Math.ceil(loadedPercent * 100) + "%");
		    },
		    // 上传凭证超时
		    'onUploadTokenExpired': function (uploadInfo) {
		        console.log("onUploadTokenExpired");
		        //上传方式1  实现时，根据uploadInfo.videoId调用刷新视频上传凭证接口重新获取UploadAuth
		        // uploader.resumeUploadWithAuth(uploadAuth);
		        // 上传方式2 实现时，从新获取STS临时账号用于恢复上传
		        // uploader.resumeUploadWithSTSToken(accessKeyId, accessKeySecret, secretToken, expireTime);
		    },
		    //全部文件上传结束
		    'onUploadEnd':function(uploadInfo){
		              console.log("onUploadEnd: uploaded all the files");
		     }
		});
		
		function uploadss(){
			var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=isVodUpload';
			$.ajax({
					
					url:url,
					type:"post",
					data:{
						'wxid' : <?php echo $this->wxid ?>,
					},
					success:function(data){
					   console.log(data)
			           var result = JSON.parse(data);
			           if(result.result=='error'){
			           	  Alert(result.errmsg);
			           }else if(result.result=='ok'){
			           	   $.ajax({
								type:"post",
								url:'<?php echo UOOT;?>Plus/Kesion.ajax.php?act=uploadAlli',
								data:{
									'wxid' : <?php echo $this->wxid ?>,
								},
								success:function(data){
							        var obj = JSON.parse(data);
									uploadAddress = obj.UploadAddress;
								    uploadAuth = obj.UploadAuth;
									videoId = obj.VideoId;
									uploader.startUpload()
								}
						});
			       
			           } 
			
					},
			});	
		}
        function addvodlist(mediaId,name){
			var  interfaceid = <?php echo $interfaceid; ?>;
			var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=addvodlist';
			$.ajax({
				type:"post",
				url:url,
				data:{
					'name':name,
					'mediaId':mediaId,
					'wxid' : <?php echo $this->wxid ?>,
					'interfaceid':interfaceid,
				},
				success:function(data){
		              toast2({
							content:'视频上传成功'
						})
		              
				},
			   
			 });
			
		} 
		 
	</script>
</html>