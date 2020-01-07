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
    background-color: #44B549!important;}
</style>
</head>
<body>
	<div class="Alert-box" style="width: 100%;">
			<div class="Alert-poress clearfix">
				<ul class="Aporess-ul">
					<li class="curr">1、从素材库选择封面</li>
					<li id="wan">2、裁切封面</li>
				</ul>
			</div>
			<div class="Alert-selectarea">
			
				<div class="Alert-left">
					<ul class="Aleft-ul">
						
						<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Index','imageslist','',GP('name-'.$name.',type-'.$type.',chektype-'.$chektype.',courseid-'.$courseid,true));?>')">全部图片(<?php echo $sum; ?>)</li>
						<?php foreach($dirname as $k=>$v){?>
						<li <?php if($nowdir == $v['name']){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Index','imageslist','',GP('nowdir-'.$v['name'].',nowdirid-'.urlencode($v['id']).',name-'.$name.',type-'.$type.',chektype-'.$chektype.',courseid-'.$courseid,true));?>')"><?php echo $v['name']?></li>
						<?php }?>
						<li <?php if($nowdir == 'Ico'){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Index','icolist','',GP('nowdir-Ico,name-'.$name.',type-'.$type.',chektype-'.$chektype.',courseid-'.$courseid,true));?>')"><i class="iconfont icon-jiahao" ></i>选择图标</li>
						<li onclick="addtemp()"><i class="iconfont icon-jiahao"></i>新建分组</li>
					</ul>
				</div>
				<div class="Alert-right">
					<div class="Alert-option">
		<!--				<span class="ks-bt bt-def mt5 ml10" onclick="addTypeChange('<?php echo M_URL('Index','Syncimages','',GP('tempdir-'.$tempdir,true));?>','450px','250px');"><i class="iconfont icon-f14"></i>同步到百度云盘(当前目录)</span>-->
						<span class="fl">建议尺寸：900像素*500像素，已开启图片水印!</span> <div  id="picker" style="height: 35px; overflow: hidden; line-height: 30px; margin-top: 5px; border-radius: 5px;" >本地上传</div>
					</div>
					
					<div class="Alert-conts clearfix">
						<ul class="Aconts-ul">
							<?php foreach($filename as $k=>$v){?>
							<li class="card-li"><div class="Aconts-box">								
								<div class="Alert-img"  autoimg="1,1">
									<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
									<img class="card-img" src="<?php echo isset($v['baiduPath'])?$v['baiduPath']:$v['filePath']; ?>"/></div>
								<!--<div class="Alert-mark"><?php  echo $v['filename']; ?></div>--> 
								<input type="checkbox" />
							</div>
							</li>	
							<?php }?>
							
					
						</ul>
						<?php echo NoC($filename);?>
					</div>
				
					<div class="Aleft-page clearfix">
						<label class="fl" <?php if(empty($isshuiyin) || $chektype == 1 || $isshuiyin == 0){echo 'style="display:none"';}else{echo 'style="display:block"';} ?>>
							<input type="checkbox" class="fl mt5 sy" value="" />
							<span class="fl">是否添加水印</span>
						</label>
						
						<div class="fr">
							
							<div class="fr">
							<?php echo $page->show(3); ?>
						</div></div>
						
						
					</div>
					<div class="alignCenter">
						<button class="ks-bt bt-green fn" id="next">&nbsp;&nbsp;下一步&nbsp;&nbsp;</button>
					</div>
					
				</div>
				<!--<input type="hidden" id="saveImg" value="" />-->
				<!------------------------------------------------------------------------------------------------------------>
				
				<style type="text/css">
					.Alert-imgText{ height: 50px;}
				</style>
				<div class="Alert-right" style="display: none;" id="cutImg">
					<div class="Alert-option"></div>
					<div class="Alert-conts clearfix">
						
						<div class="clearfix">
							<div class="fl Alert-width">
							<div class="Alert-imgText">
								<p class="fsize16 c-017">原图</p>
								<p class="fsize14"></p>
							</div>
							<div class="Alert-imgmain">
								<img  id="moban" width="100%" style="vertical-align: middle;"/>
							</div>
						</div>
						
						<div class="fl Alert-width">
							<div class="Alert-imgText">
								<p class="fsize16  c-017">图片裁剪区域</p>
								<p class="fsize12">请根据自己所需要裁剪图片</p>
							</div>
							<div class="Alert-imgmain">
								<div style="vertical-align: middle; width: 100%; height: auto;display: inline-block;">
									<img   id="target"  width="100%"/>
								</div>
							</div>
						</div>
							
						</div>

						<input type="hidden" id="x" name="x" value="0"/>
						<input type="hidden" id="y" name="y" value="0"/>
						<input type="hidden" id="w" name="w" value="0"/>
						<input type="hidden" id="h" name="h" value="0"/>
						<input type="hidden" value="" id="imghide" name="img"/>
						
						
					</div>
		
					<div class="Aleft-page clearfix">
						<div class="hLh30"></div>
						<!--<button class="ks-bt bt-pue " id="yesido">确  认</button>-->
					</div>
					<div class="alignCenter">
						<input type="submit" value="   确    认    " class="ks-bt bt-green fn" id="enter"/>
					</div>
				</div>
			</div>
		</div>
		<div style="display: none;" id="temp">
			<form action="<?php echo M_URL('Index','TempaddFile');?>"  Method = "POST" style="border: #000000 1px solid;background: white; border-radius: 5px; position: absolute;z-index: 10001;">
				<div  class="p20">
					<div class="alignCenter"><h3>请输入分组名称</h3></div>
					<div class="alignCenter mt10">
						<input style="border: 1px solid #e5e5e5; height: 30px;width:100%" name="tempname" />
						<input type="hidden" value="<?php echo $name; ?>" name ='name' />
						<input type="hidden" value="<?php echo $type; ?>" name ='type'/>
						<input type="hidden" value="<?php echo $courseid; ?>" name ='courseid'/>
						<input type="hidden" value="1" name = 'dirtype'/>
					</div>
					<div class="alignCenter  mt10">
						<input type="submit" class="ks-bt bt-def fn" value="创   建"/>
						<input type="button" id = 'off' class="ks-bt bt-def fn" value="关   闭"/>
					</div>
				</div>
			</form>
		</div>
		<div>
			
			
		</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.Jcrop.min.js"></script>
<script src="<?php echo UOOT;?>Public/webuploader/webuploader.js"></script>
<script>
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
$('#off').click(function(){
	$("#temp").css('display','none');
	$('body').css('display','block');
})
var chektype = <?php echo $chektype;?>;
var ico = '<?php echo $nowdir;?>';
var courseid = <?php echo $courseid; ?>;
var classid = <?php echo $classid; ?>;

if(chektype ==1){
	$('.card-li').dblclick(function(){
		var xuanze = $('.ctrShaw');
		var flag = 0;
		var img= '';
		for(var i = 0;i<xuanze.length;i++){
			if($(xuanze[i]).css('display') == 'block'){
				flag++;
				img = $(xuanze[i]).next().attr('src');
			}
		}
		
		$.ajax({
			url:'<?php echo M_URL('Index','imgcut');?>',
			type:'post',
			data:{x:$('[name=x]').val(),y:$('[name=y]').val(),w:$('[name=w]').val(),h:$('[name=h]').val(),img:img,imgw:$('#target').css('width'),imgh:$('#target').css('height')},
			error:function(){
				alert('error');   
			},   
			success:function(data){
				var data = JSON.parse(data);
				var src  = data.src;
				var img  = data.img;   
				var type = '<?php echo $type;?>';
				if(type=='parent'){
					$(parent.document).find('input[name="<?php echo $name;?>"]')[0].value = img;
					$(parent.document).find(".<?php echo $name;?>").attr('src',src);
				    parent.closePopup(window.name);
				}else if(type=='top'){
					$(parent.document).find('#main').contents().find('input[name="<?php echo $name;?>"]')[0].value = img;
				    $(parent.document).find('#main').contents().find(".<?php echo $name;?>").attr('src',src);
				    top.closePopup(window.name);
				}else if(type=='other'){
					top.imgUploadBack(src,img);
				    top.closePopup(window.name);
				}
				 //课程头部图片
					if(courseid != 0){
		                   $.ajax({
						        type: "POST",
						        url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=courseImg",
						        data:{courseid:courseid,src:img},
						        success:function(text){
						        
						      }});    
					}
				//班级头部
				
				if(classid != 0){
					
		                   $.ajax({
						        type: "POST",
						        url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=classImg",
						        data:{classid:classid,src:img},
						        success:function(text){
						        
						      }});    
					}
							
			} 
			
		});
	})
}
$('#enter').click(function(){
	$.ajax({
		url:'<?php echo M_URL('Index','imgcut');?>',
		type:'post',
		data:{x:$('[name=x]').val(),y:$('[name=y]').val(),w:$('[name=w]').val(),h:$('[name=h]').val(),img:$('#imghide').val(),imgw:$('#target').css('width'),imgh:$('#target').css('height'),dirid:"<?php echo $nowdirid; ?>"},
		error:function(){
			alert('error');   
		},   
		success:function(data){
			var data = JSON.parse(data);
			var src  = data.src;
			var img  = data.img;   
			var type = '<?php echo $type;?>';
			if(type=='parent'){
				$(parent.document).find('input[name="<?php echo $name;?>"]')[0].value = img;
				$(parent.document).find(".<?php echo $name;?>").attr('src',src);
			    parent.closePopup(window.name);
			}else if(type=='top'){
				$(parent.document).find('#main').contents().find('input[name="<?php echo $name;?>"]')[0].value = img;
			    $(parent.document).find('#main').contents().find(".<?php echo $name;?>").attr('src',src);
			    top.closePopup(window.name);
			}else if(type=='other'){
				top.imgUploadBack(src,img);
			    top.closePopup(window.name);
			}
			     //课程头部图片
					if(courseid != 0){
		                   $.ajax({
						        type: "POST",
						        url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=courseImg",
						        data:{courseid:courseid,src:img},
						        success:function(text){
						        
						      }});    
					}
					if(classid != 0){
					
		                   $.ajax({
						        type: "POST",
						        url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=classImg",
						        data:{classid:classid,src:img},
						        success:function(text){
						        
						      }});    
					}	
		} 
	}); 
})
/*****初始化*****/	
/*选中类型1是单选，0是多选；*/

/**初始化显示页面**/
if(chektype==0){
	$(".Alert-poress").hide();
	$("#next").text("确  认");
	$("#next").attr("id","yesido");
	$(".Alert-poress").hide();
	
}

if(ico =='Ico'){
	$("#next").text("确  认");
	$("#next").attr("id","yesidoIco");
}

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
			var picData='<li class="card-li"><div class="Aconts-box"><div class="Alert-img" autoimg="1,1" style="height: 123px;">';
			picData+='<div class="ctrShaw" style="display:block"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>';
			picData+='<img class="card-img" src="'+response.info+'"></div>';
			//picData+='<div class="Alert-mark">'+response.name+'</div></div></li>';
			$(".Aconts-ul").prepend(picData);

			
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
$("#next").click(function(){
	var xuanze = $('.ctrShaw');
	var flag = 0;
	var img= '';
	for(var i = 0;i<xuanze.length;i++){
		if($(xuanze[i]).css('display') == 'block'){
			flag++;
			img = $(xuanze[i]).next().attr('src');
		}
	}
	if(flag >0){
		$(".Aporess-ul li").attr("class","curr1");  
		$("#wan").attr("class","curr2"); 
		$(".Alert-right").hide();
		$("#cutImg").show();
		$('#target').attr('src',img);
		$('#moban').attr('src',img);
		$('#imghide').val(img);
		$pcnt = $('#preview-pane .preview-container');
		var xsize = $pcnt.width();
        var ysize = $pcnt.height();
		$('#target').Jcrop({
			aspectRatio: xsize / ysize ,
      		onSelect: updateCoords,
      		bgFade:     true,
      		bgOpacity: .2,
      		setSelect: [ 240, 240, 0, 0 ]
		});
	}else{
		 parent.popup.tips({
 			title:'至少需要一张图片'
		});
	}
	
	
})
 function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };
</script>
<script>
	console.log(ico);
if(ico !='Ico'){
	uploadView2(180,120,{picker:'#picker',filelist:'#filelist',url:'/Plus/Uploader.php?act=imageslist&wxid=<?php echo $this->wxid;?>&subName=<?php echo $subName; ?>&dirid=<?php echo $nowdirid; ?> '});
}
var type = '<?php echo $type;?>';
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
$('#yesidoIco').click(function(){
	var xuanze = $('.ctrShaw');
	var flag = 0;
	var img= '';
	for(var i = 0;i<xuanze.length;i++){
		if($(xuanze[i]).css('display') == 'block'){
			flag++;
			img = $(xuanze[i]).next().attr('src');
		}
	}
	if(flag >0){
		var type = '<?php echo $type;?>';
		if(type=='parent'){
			$(parent.document).find('input[name="<?php echo $name;?>"]')[0].value = img;
			$(parent.document).find(".<?php echo $name;?>").attr('src',img);
		    parent.closePopup(window.name);
		}else if(type=='top'){
			$(parent.document).find('#main').contents().find('input[name="<?php echo $name;?>"]')[0].value = img;
		    $(parent.document).find('#main').contents().find(".<?php echo $name;?>").attr('src',img);
		    top.closePopup(window.name);
		}else if(type=='other'){
			top.imgUploadBack(img);
		    top.closePopup(window.name);
		}
		//课程头部图片
		if(courseid != 0){
               $.ajax({
			        type: "POST",
			        url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=courseImg",
			        data:{courseid:courseid,src:img},
			        success:function(text){
			        
			      }});    
		}	
	}else{
		 parent.popup.tips({
 			title:'至少需要一张图片'
		});
	}
})
$("#yesido").click(function(){
	/*开启水印*/
	var data = "";
	var ary = [];
	if($('.sy').prop('checked')){
		$(".onYes").each(function(){
			ary.push($(this).find("img").attr("src"));
		})
		$.ajax({
		url:'<?php echo M_URL('Index','imgwater');?>',
		type:'post',
		data:{imgary:ary,dirid:"<?php echo $nowdirid; ?>"},
		error:function(){
			alert('error');   
		},   
		success:function(imgdata){
			var Jimgdata = JSON.parse(imgdata);
			for(var i=0;i<Jimgdata.length;i++){
				var src= Jimgdata[i].src;
				data+='<img class="card-img" src="'+src+'"/>';
			}
			parent.frames['main'].UE.getEditor('<?php echo $name;?>').execCommand('insertHtml',data);
			//parent.frames['main'].editor.insertHtml(data);
			top.closePopup(window.name);
		} 
	}); 
	}else{
		$(".onYes").each(function(){
			var src= $(this).find("img").attr("src");
			data+='<img class="card-img" src="'+src+'"/>';
		})
		parent.frames['main'].UE.getEditor('<?php echo $name;?>').execCommand('insertHtml',data);
		//parent.frames['main'].editor.insertHtml(data);
		top.closePopup(window.name);
	}
})
</script>
</body>
</html>