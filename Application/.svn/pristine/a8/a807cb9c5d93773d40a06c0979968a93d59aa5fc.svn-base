<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>图片管理</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">

<link href="<?php echo UOOT;?>Public/app/css/imageslist.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
	.Aconts-ul li{height: auto;}
</style>
</head>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
     	
		<h3 class="ks-head-title2">文件管理
			<div class="fr">	
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor40"><i class="iconfont icon-qm" ></i></a>											
			</div>
		</h3>
    </div>
    <!--header-->
	<!--tab-->
     	<div class="ks-head-tab">
     			<ul class="clearfix">
     				<li class="curr"><a href="<?php echo M_URL('Website','attachment'); ?>">图片管理</a></li>
     				<li><a href="<?php echo M_URL('Website','wxfilegl'); ?>">附件管理</a></li>
     				
     			</ul>
     	</div>
     <!--/tab-->

	<!--table-->
		<div class="Alert-box mt20"  >
			<div class="Alert-selectarea">
			
				<div class="Alert-left">
					<ul class="Aleft-ul">
						<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Website','attachment','',GP('chektype-'.$chektype,true));?>')">全部图片(<?php echo $sum; ?>)</li>
						<?php foreach($dirname as $k=>$v){?>
						<li <?php if($nowdir == $v['name']){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Website','attachment','',GP('nowdir-'.$v['name'].',nowdirid-'.urlencode($v['id']).',chektype-'.$chektype,true));?>')"><?php echo $v['name']?></li>
						<?php }?>
						<li onclick="addtemp();"><i class="iconfont icon-jiahao"></i>新建分组</li><!--onclick="addtemp()"-->
					</ul>
				</div>
				<div class="Alert-right ">
					<div class="H5-gameListScreen">
						<ul class="H5-gameOpt clearfix" style="padding-left: 0;">
						<li style="width: 97%;float: right;display: inline-block;box-sizing: border-box;">
						<div class="ks-top-search fl">
							<form target="hidframe">
								<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
				                <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Website','attachment'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
			                </form>
						</div>
						<div class="fr">
							
							<button  id="picker" class="ks-bt bt-green fn" style="height: 35px; overflow: hidden; line-height: 30px; border-radius: 5px;margin-top:7px;" >本地上传</button>
							<?php if(!empty($nowdir)){ if($nowdir != date('Ym')){?>
							<input id="deleteTemp" type="button" value="删除分组" class="ks-bt bt-green fn" data='<?php echo $nowdirid; ?>'/>
							<input id="nowTemp" onclick="edittemp()" type="button" value="重命名分组" class="ks-bt bt-green fn" data='<?php echo $nowdirid; ?>'/>
							<?php }} ?>
						</div>
						
						</li>
						
						
						<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
						</ul>	
					</div>
					<div class="ks-wbox bRadius10">
						
						<div class="Alert-conts clearfix">
							<ul class="Aconts-ul clearfix">
								<?php foreach($filename as $k=>$v){?>
								<li class="card-li"><div class="Aconts-box">								
									<div class="Alert-img"  autoimg="1,1">
										<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
										<img class="card-img" data= "<?php echo $v['id'];?>" src="<?php echo isset($v['baiduPath'])?$v['baiduPath']:$v['filePath']; ?>"/></div>
									<div class="Alert-mark"><?php  echo $v['filename']; ?></div> 
									<input type="checkbox" />
								</div>
								</li>	
								<?php }?>
								<?php echo NoC($filename);?>
							</ul>
						</div>
					</div>
					
					<?php if(!empty($filename)){ ?>
					<!--footer-->
					<div class="ks-bom clearfix">
							<span class="fl">
								<button class="fr ks-heade-button mr10" id="next">下一步</button>
							</span>
							<div class="fr">
								<?php echo $page->show(3); ?>
							</div>
					</div>
					<!--/footer-->
					<?php }?>
					
				</div>
				<!--<input type="hidden" id="saveImg" value="" />-->
				<!------------------------------------------------------------------------------------------------------------>
				
			</div>
		</div>
		<div style="display: none;" id="temp">
			<form action="<?php echo M_URL('Website','newdirname');?>" id="tempnameform" method = "post" style="border: #000000 1px solid;background: white; border-radius: 5px; position: absolute;z-index: 10001;">
				<div  class="p20">
					<div class="alignCenter"><h3>重命名分组名称</h3></div>
					<div class="alignCenter mt10">
						<input style="border: 1px solid #e5e5e5; height: 30px;width:100%" name="tempname" />
						<input type="hidden" value="<?php echo $nowdir; ?>" name="name" />
						<input type="hidden" value="<?php echo $type; ?>" name="type"/>
						<input type="hidden" value="1" name="dirtype"/>
						<input type="hidden" value="<?php echo $nowdirid; ?>" name="nowdirid"/>
					</div>
					<div class="alignCenter  mt10">
						<input type="button" onclick="submitform();" class="ks-bt bt-def fn" value="确   定"/>
						<input type="button" onclick= "off()" class="ks-bt bt-def fn" value="关   闭"/>
					</div>
					<script>
						function submitform(){
							var tempname    = $("input[name='tempname']").val();
							if(tempname==''){Alert('请输入重命名分组名称');return false;}	
							$('#tempnameform').submit();
						}

						function off(){
							$("#temp").css('display','none')
							$("#temp").removeClass('tempstyle');	
						}
					</script>
				</div>
			</form>
		</div>
		<div style="display: none;" id="temp1">
			<form action="<?php echo M_URL('Website','TempaddFile');?>" id="tempnameform1" method = "post" style="border: #000000 1px solid;background: white; border-radius: 5px; position: absolute;z-index: 10001;">
				<div  class="p20">
					<div class="alignCenter"><h3>请输入分组名称</h3></div>
					<div class="alignCenter mt10">
						<input style="border: 1px solid #e5e5e5; height: 30px;width:100%" name="tempname" id="tempname1"/>
						<input type="hidden" value="<?php echo $nowdir; ?>" name="name" />
						<input type="hidden" value="<?php echo $type; ?>" name = "type"/>
						<input type="hidden" value="1" name = 'dirtype'/>
						<input type="hidden" value="<?php echo $nowdirid; ?>" name = "nowdirid"/>
					</div>
					<div class="alignCenter  mt10">
						<input type="button" onclick="submitform1();" class="ks-bt bt-def fn" value="确   定"/>
						<input type="button" onclick= "off1()" class="ks-bt bt-def fn" value="关   闭"/>
					</div>
					<script>
						function submitform1(){
							var tempname    = $("#tempname1").val();
							if(tempname==''){Alert('请输入分组名称');return false;}	
							$('#tempnameform1').submit();
						}
						function off1(){
							$("#temp1").css('display','none')
							$("#temp1").removeClass('tempstyle');	
						}
					</script>
				</div>
			</form>
		</div>
    <!--/table-->
    

	
</div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	var type = '<?php echo $type;?>';
	var chektype = <?php echo $chektype;?>;
	/*****初始化*****/	
	/*选中类型1是单选，0是多选；*/
	module.require(['$','backstage','nicescroll','Jcrop','webuploader'],function(){
	
		
		loadScorllJs()
		$('#off').click(function(){
			$("#temp").css('display','none');
			$('body').css('display','block');
		});
		/**初始化显示页面**/
		chektype == 0 && (
			$(".Alert-poress").hide(),
			$("#next").text("删除确认").attr("id","yesido")
		);
		
		uploadView2(180,120,{picker:'#picker',filelist:'#filelist',url:'/Plus/Uploader.php?act=imageslist&wxid=<?php echo $this->wxid;?>&subName=<?php echo $subName; ?>&dirid=<?php echo $nowdirid; ?> '});
		
		$(document).on('click','.Aconts-ul li',function(){
			var src = $(this).find(".card-img").attr("src");
			$(this).find("input").val(src);//将值传给input
			chektype == 0 ? (
				$(this).addClass("onYes").find("input[type='checkbox']").prop('checked',true),	
				$(this).find(".ctrShaw").show()
			) : (
				$(".ctrShaw").hide(),
				$(this).find(".ctrShaw").show(),
				$("#saveImg").val(src)
			)
			
		}).on('click','.onYes',function(){
			var src = $(this).find(".card-img").attr("src");
			$(this).find(".ctrShaw").hide();
			$(this).removeClass("onYes");
			$(this).find("input[type='checkbox']").prop('checked',false);
		
		})
		$("#yesido").click(function(){
			/*开启水印*/
			var data = "";
			var ary = [];
			$(".onYes").each(function(){
				ary.push($(this).find("img").attr("data"));
			})
			$.ajax({
				url:'<?php echo M_URL('Website','deleteimg');?>',
				type:'post',
				data:{imgary:ary},
				error:function(){
					alert('error');   
				},   
				success:function(imgdata){
					imgdata ? top.popup.tips('删除成功',{icon:'success'}) : Alert('请选择图片');
					
					setTimeout(function(){
						location.reload()
					},1000);
				} 
			}); 
		})
		$('#deleteTemp').click(function(){
			Confirm('仅删除分组，不删除图片，组内图片将自动归入未分组','<?php echo M_URL('Website','deletedir','',GP('nowdir-'.$nowdir.',nowdirid-'.urlencode($nowdirid),true));?>');
		})
		
		
	});

	function addtemp(){
		$("#temp1").css('display','flex')
		$("#temp1").addClass('tempstyle')	
	}
	
	function edittemp(){
	    $("#temp").css('display','flex')
		$("#temp").addClass('tempstyle')	
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
				picData+='<div class="ctrShaw" style="display:block"><div class=""></div><i class="iconfont"></i></div>';
				picData+='<img class="card-img" src="'+response.info+'"></div>';
				picData+='<div class="Alert-mark">'+response.name+'</div></div></li>';
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

</script>
</body>
</html>