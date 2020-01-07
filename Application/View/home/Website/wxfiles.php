<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>附件管理</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/imageslist.css" rel="stylesheet">
<style>
	.Aconts-ul li{height: auto;}
</style>
</head>
<body  class="ks-wrap" >

<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
			<h3 class="ks-head-title2">文件管理
				<div class="fr">	
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor41"><i class="iconfont icon-qm" ></i></a>											
			</div>
				
			</h3>
	    </div>
	    <!--header-->
		<!--tab-->
     	<div class="ks-head-tab">
     			<ul class="clearfix">
     				<li><a href="<?php echo M_URL('Website','attachment'); ?>">图片管理</a></li>
     				<li class="curr"><a href="<?php echo M_URL('Website','wxfilegl'); ?>">附件管理</a></li>
     				
     			</ul>
     	</div>
   	 	 <!--/tab-->

		<!--table-->

		<div class="Alert-selectarea" style="height: 100%;margin-top: 20px;">
			<div class="Alert-left">
				<ul class="Aleft-ul">
					<?php if($type1 == 2 ){ ?>
					<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Website','wxfilegl','',GP('chektype-'.$chektype.',type1-'.$type1,true));?>')">全部视频(<?php echo $sum;?>)</li>
					<?php }elseif($type1 == 3 ){ ?>
					<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Website','wxfilegl','',GP('chektype-'.$chektype.',type1-'.$type1,true));?>')">全部音频(<?php echo $sum;?>)</li>
					<?php }elseif($type1 == 4 ){ ?>
					<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Website','wxfilegl','',GP('chektype-'.$chektype.',type1-'.$type1,true));?>')">全部文档(<?php echo $sum;?>)</li>
					<?php }elseif($type1 == 5 ){ ?>
					<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Website','wxfilegl','',GP('chektype-'.$chektype.',type1-'.$type1,true));?>')">全部ppt(<?php echo $sum;?>)</li>
					<?php } ?>	
					
					<?php foreach($dirname as $k=>$v){?>
					<li <?php if($nowdir == $v['name']){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Website','wxfilegl','',GP('nowdir-'.$v['name'].',nowdirid-'.urlencode($v['id']).',type1-'.$type1.',type-'.$type.',chektype-'.$chektype,true));?>')"><?php echo $v['name']?></li>
					<?php }?>
					<li onclick="addtemp()"><i class="iconfont icon-jiahao"></i>新建分组</li>			
				</ul>
			</div>
	
			
			<div class="Alert-right bg-white">
				
				
					<div class="ks-head-widget clearfix">

						<div class="ks-top-search fl">
							<form target="hidframe">
								<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
					            <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Website','wxfilegl'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
				            </form>
						</div>
						
						
						<div class="fr">
							<ul class="ks-head-choice">
								<li>
									<div class="ks-head-el">
										
<div class="ks-head-input ks-head-el  ks-head-click w180" onclick="choiceClick(this)">
<?php if($type1==2){echo '视频';}elseif($type1==3){echo '音频';}elseif($type1==4){echo '文档';}elseif($type1==5){echo 'PPT';}?>
<span class="ks-head-search"><i class="icon-taitouxiangxiajiantou iconfont"></i></span></div>
											<div class="ks-head-content ks-head-content-pr w100">	
												
												<ul class="status">															
													<!--<li>
														<a href="<?php echo M_URL('Website','wxfilegl','',GP('chektype-'.$chektype.',type1-2',true));?>" <?php if($type1==2){echo 'class="choice-active"';}?>>视频</a>
													</li>-->
													<li><a href="<?php echo M_URL('Website','wxfilegl','',GP('chektype-'.$chektype.',type1-3',true));?>" <?php if($type1==3){echo 'class="choice-active"';}?>>音频</a></li>
													<li><a href="<?php echo M_URL('Website','wxfilegl','',GP('chektype-'.$chektype.',type1-4',true));?>" <?php if($type1==4){echo 'class="choice-active"';}?>>文档</a></li>
													<li><a href="<?php echo M_URL('Website','wxfilegl','',GP('chektype-'.$chektype.',type1-5',true));?>" <?php if($type1==5){echo 'class="choice-active"';}?>>PPT</a></li>
						
												</ul>
					
											</div>
									</div>
								</li>
								<li>
									<button  id="picker" class="ks-bt bt-green" style="height: 35px; overflow: hidden; line-height: 30px; border-radius: 4px;" >本地上传</button>

									
								</li>
							</ul>
					</div>
				</div>
				
				<div class="Alert-option">
					<span class="fl">&nbsp;&nbsp;&nbsp;&nbsp;视频上限30M，其他10M</span> 
					<?php if(!empty($nowdir)){if($nowdir != date('Ym')){?>	
					<input id="deleteTemp" type="button" value="删除分组" class="ks-bt bt-green fn" data='<?php echo $nowdirid; ?>'/>
					<input id="nowTemp" onclick="edittemp()" type="button" value="重命名分组" class="ks-bt bt-green fn" data='<?php echo $nowdirid; ?>'/>
					<?php }} ?>
					
				</div>
				<div class="Alert-conts  clearfix">
					<ul class="Aconts-ul">
						<?php foreach($filename as $k=>$v){?>
						<li class="card-li">
							<div class="Aconts-box">								
								<div class="Alert-img"  autoimg="1,1">
									<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
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
								<input type="checkbox" value="<?php echo $v['id'];?>" class="file"/>
							</div>
						</li>	
						<?php }?>
					</ul>
					
				</div>
				<?php echo NoC($filename);?>
				<?php if(!empty($filename)) {?>
				<!--footer-->
				<div class="ks-bom clearfix">
					<div class="Alert-right fl"  id="cutImg">
					<div class="alignCenter mt20">
					<input type="button" value="删除确认" class="ks-heade-button" id="yesido"/>
					</div>
					</div>
					<div class="fr"><?php echo $page->show(3); ?> </div>
				</div>
				<!--/footer-->	
				<?php }?>
			
		
			</div>		
		</div>		
		
				
		<div style="display: none;" id="temp">
		<form action="<?php echo M_URL('Website','TempaddFile');?>"  id="tempnameform" method = "post" style="border: #000000 1px solid;background: white; border-radius: 5px; position: absolute;z-index: 10001;">
		<div  class="p20">
		<div class="alignCenter"><h3>请输入分组名称</h3></div>
		<div class="alignCenter mt10">
		<input style="border: 1px solid #e5e5e5; height: 30px;width:100%" name="tempname" />
		<input type="hidden" value="<?php echo $name; ?>" name="name"/>
		<input type="hidden" value="<?php echo $type; ?>" name ="type"/>
		<input type="hidden" value="<?php echo $type1;?>" name ="dirtype"/>
		<input type="hidden" value="<?php echo $nowdirid;?>" name ="nowdirid"/>
		</div>
		<div class="alignCenter  mt10">
		<input type="button" onclick="submitform()" class="ks-bt bt-def fn" value="创   建"/>
		<input type="button" id = "off" class="ks-bt bt-def fn" value="关   闭"/>
		</div>
		<script>
		function submitform(){
			var tempname    = $("input[name='tempname']").val();
			if(tempname==''){Alert('请输入分组名称');return false;}	
			$('#tempnameform').submit();
		}
		</script>
		</div>
		</form>
		</div>
		<div style="display: none;" id="temp1">
		<form action="<?php echo M_URL('Website','newdirname');?>" id="tempnameform1" method = "post" style="border: #000000 1px solid;background: white; border-radius: 5px; position: absolute;z-index: 10001;">
		<div  class="p20">
		<div class="alignCenter"><h3>请输入重命名分组名称</h3></div>
		<div class="alignCenter mt10">
		<input style="border: 1px solid #e5e5e5; height: 30px;width:100%" name="tempname" id="tempname1"/>
		<input type="hidden" value="<?php echo $name; ?>" name="name"/>
		<input type="hidden" value="<?php echo $type; ?>" name ="type"/>
		<input type="hidden" value="<?php echo $type1;?>" name ="dirtype"/>
		<input type="hidden" value="<?php echo $nowdirid; ?>" name ="nowdirid"/>
		</div>
		<div class="alignCenter  mt10">
		<input type="button" onclick="submitform1()" class="ks-bt bt-def fn" value="确   定"/>
		<input type="button" id = "off1" class="ks-bt bt-def fn" value="关   闭"/>
		</div>
		<script>
		function submitform1(){
			var tempname    = $("#tempname1").val();
		if(tempname==''){Alert('请输入重命名分组名称');return false;}	
		$('#tempnameform1').submit();
		}
		</script>
		</div>
		</form>
		</div>
	    <!--/table-->
	            
		
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		var type = <?php echo $type1; ?>;
		var chektype = <?php echo $chektype;?>;
		module.require(['$','backstage','nicescroll','Jcrop','webuploader'],function(){

			loadScorllJs();
			
			/*****初始化*****/	
			/*选中类型1是单选，0是多选；*/
			/**初始化显示页面**/
			chektype == 0 && $(".Alert-poress").hide();

			$('#off1').click(function(){
				$("#temp1").css('display','none');
				$('body').css('display','block');
			})
			$('#off').click(function(){
				$("#temp").css('display','none');
				$('body').css('display','block');
			})
			
			$("#yesido").click(function(){
				/*开启水印*/	var data = "";
				var ary = [];
				$(".onYes").each(function(){
					ary.push($(this).find("input").attr("value"));
				})
				$.ajax({
					url:'<?php echo M_URL('Website','deleteimg');?>',
					type:'post',
					data:{imgary:ary},
					error:function(){
						alert('error');   
					},   
					success:function(imgdata){
						Alert(imgdata,2);
						setTimeout(function(){
							location.reload()
						},1000);
					} 
				}) 
			});
			$('#deleteTemp').click(function(){
				Confirm('仅删除分组，不删除文件，组内文件将自动归入未分组','<?php echo M_URL('Website','filedeletedir','',GP('nowdir-'.$nowdir.',nowdirid-'.urlencode($nowdirid),true));?>')
			});
			
			$(document).on('click','.Aconts-ul li',function(){
				if(chektype==0){
					$(this).find("input[type='checkbox']").prop('checked',true);
					$(this).addClass("onYes");		
					$(this).find(".ctrShaw").show();//显示打钩
				}else{
					$(".ctrShaw").hide();//不显示打钩
					$(this).find(".ctrShaw").show();//显示打钩
				}	
			}).on('click','.onYes',function(){
				
				var src = $(this).find(".card-img").attr("src");
				$(this).find(".ctrShaw").hide();
				$(this).removeClass("onYes");
				$(this).find("input[type='checkbox']").prop('checked',false);
				
			
			});
			
			uploadView2(180,120,{picker:'#picker',filelist:'#filelist',url:'/Plus/Uploader.php?act=coursefile&type='+type+'&wxid=<?php echo $this->wxid;?>&subName=<?php echo $subName; ?>&dirid=<?php echo $nowdirid; ?>'})
			
		});
	
	

		function addtemp(){
			$("#temp").css('display','flex')
			$("#temp").addClass('tempstyle')
			
		}
		function edittemp(){
			$("#temp1").css('display','flex')
			$("#temp1").addClass('tempstyle')
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

</script>
</body>
</html>	