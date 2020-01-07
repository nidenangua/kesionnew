<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/app/css/style.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/jquery.Jcrop.min.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
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
.Alert-right{}
.Alert-option{ text-align: right; height: 50px;line-height: 50px;padding-right: 15px; border-bottom: 1px solid #e5e5e5; color: #7b7b7b;border-top: 1px solid #e5e5e5; color: #7b7b7b;font-size: 15px;}
.Aconts-ul{ margin-right: 15px;}
.Aconts-ul li{float: left; width: 20%;}
.Aconts-ul li input{position: absolute;top: 0px;left: 0px;opacity: 0;}
.Aconts-ul .Alert-img{overflow: hidden; position: relative;}
.Alert-conts{ padding: 15px 10px; overflow: auto; height: 400px;}
.Alert-img img{width: 100%; height:  100%; min-height: auto;min-width: auto;}
.Alert-img i{ position: absolute; top: 50%; left: 50%;font-size: 48px; height: 60px; line-height: 60px; margin-top: -30px; margin-left: -30px; color:#fff;}
.Alert-shadow{position: absolute; height: 100%; width: 100%; background: #000000; opacity: 0.6;}
.Aconts-box{margin: 15px 0px 0px 15px;border: solid 1px #e5e5e5;position: relative;}
.Alert-mark{padding: 0px 10px; border-top:1px solid #E5E5E5 ;height: 30px; line-height: 30px; text-align: center;font-size: 12px;overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;}
.Alert-imgmain{width:240px;overflow: hidden;text-align: center;height:240px; line-height:240px; border: #E7E7E9 solid 1px; background: #F4F5F9;}		
.Alert-width{width: 260px;margin-left: 60px; }
.Aleft-page{padding: 15px;font-size: 15px; text-align: center;}
.ctrShaw{display: none;}

.v-l{float: right;}
.v-r{float: left;}
.knowledge-right{padding-top: 30px;}
.audiomodul{
	display: inline-block;		
	width: 60%;
	margin-right: 20px;	
}
.state{
	display: none;
}

</style>
</head>
<body>
	<div class="Alert-box" style="width: 100%;">
			<div class="Alert-selectarea">
			视频上限1G，音频上限20，其他10M<?php echo $type;?>
				<div class="Alert-left">
					<ul class="Aleft-ul">
						<?php if($type1 == 2 ){ ?>
						<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Index','wxfile','',GP('name-'.$name.',type-'.$type.',chektype-'.$chektype.',type1-'.$type1,true));?>')">全部视频(<?php echo $sum; ?>)</li>
						<?php }elseif($type1 == 3 ){ ?>
						<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Index','wxfile','',GP('name-'.$name.',type-'.$type.',chektype-'.$chektype.',type1-'.$type1,true));?>')">全部音频(<?php echo $sum; ?>)</li>
						<?php }elseif($type1 == 4 ){ ?>
						<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Index','wxfile','',GP('name-'.$name.',type-'.$type.',chektype-'.$chektype.',type1-'.$type1,true));?>')">全部文档(<?php echo $sum; ?>)</li>
						<?php }elseif($type1 == 5 ){ ?>
						<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Index','wxfile','',GP('name-'.$name.',type-'.$type.',chektype-'.$chektype.',type1-'.$type1,true));?>')">全部ppt(<?php echo $sum; ?>)</li>
						<?php } ?>	
							
						<?php foreach($dirname as $k=>$v){?>
						<li <?php if($nowdir == $v['name']){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Index','wxfile','',GP('nowdir-'.$v['name'].',nowdirid-'.urlencode($v['id']).',type1-'.$type1.',name-'.$name.',type-'.$type.',chektype-'.$chektype,true));?>')"><?php echo $v['name']?></li>
						<?php }?>
						<li onclick="addtemp()"><i class="iconfont icon-jiahao"></i>新建分组</li>	
						<!--<br/>		
						<a href=""  target="main"><li>前往管理</li></a>-->
					</ul>
				</div>
				<div class="Alert-right">
					<div class="Alert-option" id="singleKeshi">
					    <!--<div id="selectfiles" class="ks-bt bt-pur">本地文件</div>-->
						<div id="container"><div  id="selectfiles" class="ks-bt bt-pur fn ml10" >本地上传</div></div>
					</div>
					<div class="Alert-conts clearfix">
						<ul class="Aconts-ul">
							<?php foreach($filename as $k=>$v){?>
							<li class="card-li"><div class="Aconts-box">								
								<div class="Alert-img"  autoimg="1,1">
									<div class="ctrShaw"><div class="Alert-shadow"><i class="iconfont icon-xuanze3"></i></div></div>
									<?php if($type1 == 2){ ?>
									<img class="card-img" src="/Public/uploads/common/vod.jpg"/>
									<?php }elseif($type1 == 3){  ?>
									<img class="card-img" src="/Public/uploads/common/audio.jpg"/>
									<?php }elseif($type1 == 4){ ?>
									<img class="card-img" src="/Public/uploads/common/doc.jpg"/>	
									<?php }elseif($type1 == 5){ ?>
									<img class="card-img" src="/Public/uploads/common/ppt.jpg"/>
									<?php } ?>		
								</div>	
								<div class="Alert-mark"><?php  echo $v['filename']; ?></div> 
								<input type="checkbox" value="<?php echo $v['baiduPath'] ?>" class="file"/>
								<input type="hidden" name="playurl1" value="<?php echo '{img:'.$v['wxid'].','.$v['id'].'}';?>">
							</div>
							</li>	
							<?php }?>
						</ul>
						<?php echo NoC($filename);?>
					</div>
				</div>
				<!--<input type="hidden" id="saveImg" value="" />-->
				<!------------------------------------------------------------------------------------------------------------>
				<div class="clearfix ks-popup-footer" >
						<div class="mt20 clearfix">
							<div class="fl"><input type="submit" value="删除" class="ks-bt bt-pue fn" id="enter1"/></div>
							<div class="fl"><input type="submit" style="margin-left: 10px;" value="确认选择" class="ks-bt bt-pue fn" id="enter"/></div>
							<div class="fr"><div class="fr"><?php echo $page->show(3,8); ?></div></div>
						</div>
				</div>
			</div>
		</div>
		<div style="display: none;" id="temp">
			<form action="<?php echo M_URL('Index','TempaddFile',$type1);?>" id='tempnameform'  method = "post" style="border: #000000 1px solid;background: white; border-radius: 5px; position: absolute;z-index: 10001;">
				<div  class="p20">
					<div class="alignCenter"><h3>请输入分组名称</h3></div>
					<div class="alignCenter mt10">
						<input style="border: 1px solid #e5e5e5; height: 30px;width:100%" name="tempname" />
						<input type="hidden" value="<?php echo $name; ?>" name="name" />
						<input type="hidden" value="<?php echo $type; ?>" name ="type" />
						<input type="hidden" value="<?php echo $type1 ?>" name ="dirtype"/>
					</div>
					<div class="alignCenter  mt10">
						<input type="button" onclick="submitform();" class="ks-bt bt-def fn" value="创   建"/>
						<input type="button" id = "off" class="ks-bt bt-def fn" value="关   闭"/>
					</div>
					<script>
						function submitform(){
							var tempname = $("input[name='tempname']").val();
							if(tempname==''){Alert('请输入分组名称');return false;}	
							$('#tempnameform').submit();
						}
					</script>
				</div>
			</form>
		</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
var type         = <?php echo $type1; ?>;
var chektype     = <?php echo $chektype;?>;
var callBackType = '<?php echo $type;?>';
module.require(['$','backstage','Jcrop','plupload'],function(){
    ossWebUpload(false,<?php echo $this->wxid;?>,'<?php echo $nowdirid;?>',{type:3,
				success:function(res){
					   getId('file_Name').innerHTML = res.name+'('+res.size+')';
					   getId('fileUrl').value = res.Jmimg;
					   location.reload()
				}
		    });
       
	$('#off').click(function(){
		$("#temp").css('display','none');
		$('body').css('display','block');
	});
	/*****初始化*****/	
	/*选中类型1是单选，0是多选；*/
	/**初始化显示页面**/
	if(chektype==0){
		$(".Alert-poress").hide();
		$("#next").text("确  认");
		$("#next").attr("id","yesido");
		$(".Alert-poress").hide();	
	}
	$(document).on('click','.Aconts-ul li',function(){
		if(chektype==0){
			$(this).find("input[type='checkbox']").prop('checked',true);
			$(this).addClass("onYes");		
			$(this).find(".ctrShaw").show();//显示打钩
		}else{
			$(this).addClass("onYes").siblings().removeClass('onYes');	
			$(".ctrShaw").hide();//不显示打钩
			$(this).find(".ctrShaw").show();//显示打钩
		}	
	}).on('click','.onYes',function(){
		var src = $(this).find(".card-img").attr("src");
		$(this).find(".ctrShaw").hide();
		$(this).removeClass("onYes");
		//alert(type);
		$(this).find("input[type='checkbox']").prop('checked',false);
	});
	$('#enter').click(function(){
		if(!$('.onYes').length){Alert('请先选择文件！');return false;};
		if(callBackType === 'target' || callBackType === 'fn'){
			var fileUrl = $('.onYes').find('input[name="playurl1"]').val();
			var fileName = $('.onYes').find(".Alert-mark").text();
			var popupData = top.popup.data(window.name);
			if(callBackType === 'target'){
				var fileNameTarget = popupData.fileNameTarget;
				var fileUrlTarget  = popupData.fileUrlTarget;
				fileNameTarget && (fileNameTarget.value = fileName);
				fileUrlTarget && (fileUrlTarget.value  = fileUrl)
			}else{
				var filePath = $('.onYes').find(".file").val();
						
				popupData(fileName,fileUrl,filePath)
			}
			top.closePopup(window.name);
		}else{
					
			$('.onYes').each(function(){
				var __src = $(this).find("input[type='checkbox']").val();
				var filename = $(this).find('.Alert-mark').text(); 
				var data = '';
				if(type == 2){
					data = '<iframe src="'+__src+'" width="420" height="280" frameborder="0" align=""></iframe>';
				}else if(type == 3){
				    data = '<embed height="100" width="100" src="'+__src+'" /><br />';
				}else if(type == 4){
				    data = '<a href="'+__src+'"><img src="/Public/uploads/common/doc.jpg" height="35px" width="50px">'+filename+'</a><br />';	
				}else if(type == 5){
				    data = '<a href="'+__src+'"><img src="/Public/uploads/common/ppt.jpg" height="35px" width="50px">'+filename+'</a><br />';		
				}		
				parent.frames['main'].UE.getEditor('<?php echo $name; ?>').execCommand('insertHtml',data);
			});
			top.closePopup(window.name)	
		}
	});
	$('#enter1').click(function(){
		if(!$('.onYes').length){Alert('请先选择文件！');return false;};
		if(callBackType === 'target' || callBackType === 'fn'){
			var fileUrl = $('.onYes').find('input[name="playurl1"]').val();
			$.ajax({
				type:"post",
				url:"<?php echo M_URL('home/Index','delwxfile'); ?>",
				data:{
					fileUrl:fileUrl
				},
				success : function(data) {
				    console.log(data);
				    if(data=="ok"){
					    Alert('删除成功！',2); 
						location.reload();  
	                }
				},
			});
		}
	});
	//uploadView2(180,120,{picker:'#picker',filelist:'#filelist',url:'/Plus/Uploader.php?act=coursefile&type='+type+'&wxid=<?php echo $this->wxid;?>&subName=<?php echo $subName; ?>&dirid=<?php echo $nowdirid; ?>'})
});
function addtemp(){
	$("#temp").css('display','flex');
	$("#temp").css('z-index','1000');
	$("#temp").css('position','fixed');
	$("#temp").css('flex-direction','column');
	$("#temp").css('align-items','center');
	$("#temp").css('justify-content','center');
	$("#temp").css('width','100%');
	$("#temp").css('height','100%');
	$('body').css('display','flex');
}
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
	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
			$percent = $li.find('.ui-progress-bar .ui-progress');
		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<div class="ui-progress-bar ui-container" style="width: 100%;">' +
			    '<div class="ui-progress charts" style="width: 0%">' +
			    '</div>' +
			'</div>').appendTo( $li ).find('.progress-bar');
		}
		$li.find('#progress').text('上传中'+parseInt(percentage * 100) + '%');
		$percent.css( 'width', percentage * 100 + '%' );
	});
	// 当有文件添加进来的时候
	uploader.on('fileQueued', function (file) {
		var $list = $("#singleKeshi");
			$( '.audiomodul').remove();
			$list.append( '<div id="' + file.id + '" class="item audiomodul">' +
			'<h4 class="info">' + file.name + '('+(file.size/1048576).toFixed(2)+'M)_<i id="progress">等待上传...</i></h4>' +
		'</div>' );
	});
	uploader.on('uploadSuccess', function (file,response) {
		if(response.result=='succeed'){
			$('#progress').html('完成');
			//$('#fileUrl').val(response.Jmimg);
			Alert('上传成功！',2); 
			location.reload();
		}else{Alert(response.info);$( '.audiomodul').remove();}
	});
	uploader.on( 'uploadError', function( file ) {
		$( '#'+file.id ).find('p.state').text('上传出错');
	});
	uploader.on('error', function (code) {
		var err = '';
		switch (code) {
			case 'F_EXCEED_SIZE':err += '单个文件大小不得超过' +  uploader.options.fileSingleSizeLimit + 'kb！';break;
			case 'Q_EXCEED_NUM_LIMIT':err += '最多只能上传' +  uploader.options.fileNumLimit + '张！';break;
			case 'Q_EXCEED_SIZE_LIMIT':err += '上传总大小超出'+limitSize;break;
			case 'Q_TYPE_DENIED':err += '无效文件类型，请上传正确文件类型！';break;
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
</script>
</body>
</html>