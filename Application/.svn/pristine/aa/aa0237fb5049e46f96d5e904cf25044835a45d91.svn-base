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

<style>
	::-webkit-scrollbar{width:5px;height:10px;background-color:#CCC}
	::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px #fff;border-radius:10px;background-color:#CCC}
	::-webkit-scrollbar-thumb{border-radius:10px;-webkit-box-shadow:inset 0 0 6px #CCC;background-color:#CCC}
  	#cropbox{background-color: #ccc;width: 500px;height: 330px;font-size: 24px;display: block;}
	.Alert-box{ height: auto;}
	.Alert-poress{height: 44px;line-height: 44px }
	.Alert-selectarea{ padding-left: 180px; position: relative;}
	.Alert-left{ position: absolute; width: 179px; height: 100%;left: 0px;top: 0px;overflow: auto;}
	
	.Alert-option{ text-align: right; height: 50px;line-height: 50px;padding-right: 15px; border-bottom: 1px solid #e5e5e5; color: #7b7b7b; color: #7b7b7b;font-size: 15px;}
	.Aconts-ul{ overflow-y:auto;height: 340px; padding-right: 20px; margin-left: -20px; display: flex;flex-wrap: wrap;}
	.Aconts-ul li{float: left; width: 20%;}
	.Aconts-ul .file-name{ height: 34px; line-height: 34px; text-align: center; overflow: hidden; white-space: nowrap; margin: 20px 10px 0 10px; text-overflow: ellipsis;}
	.Aconts-ul .progress{height: 10px; background: #e1e5e6; border-radius: 10px;margin: 0 10px; position: relative; overflow: hidden;}
	.Aconts-ul .progress .progress-bar{height: 100%; position: absolute;left:0; background: #e64a3b;border-radius: 10px;}
	.Aconts-ul .state{ line-height: 32px; text-align: left; color:#7b7b7b;margin-top:5px; padding: 0 10px;}
	.Aconts-ul .Alert-img{overflow: hidden; position: relative; background-repeat: no-repeat; background-size:contain; background-position: 50% 50%;}
	.Aconts-ul .def-img{background-image: url(/Public/app/images/defimg.png);background-position: 50% 100%}
	.Alert-conts{ padding: 15px 10px; overflow: auto; min-height: 320px;}
	.Alert-img img{width: 100%; height:  100%; min-height: auto;min-width: auto;}
	.Alert-img i{ position: absolute; top: 50%; left: 50%;font-size: 60px; margin-top: -40px; margin-left: -30px; color:#476dbe;}
	.Alert-shadow{position: absolute; height: 100%; width: 100%; background: #000000; opacity: 0.6;}
	.Aconts-box{margin: 15px 0px 0px 15px;border: solid 1px #e5e5e5;position: relative;}
	.Alert-mark{padding: 0px 10px; border-top:1px solid #E5E5E5 ;height: 30px; line-height: 30px; text-align: center;font-size: 12px;overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;}
	.Aleft-page{padding: 15px;font-size: 15px; text-align: center;}
	.ctrShaw{display: none;}
	.webuploader-pick{ background:#fff; color:#e5412c !important;border:1px solid #e5412c;height:32px; line-height:32px;padding: 0px 15px;}
	
</style>
</head>
<body>
	<div class="Alert-box" style="width: 100%;">
		    <?php if($chektype!=0){?>
			<div class="Alert-poress clearfix">
				<ul class="Aporess-ul">
					<li class="curr">1、从素材库选择封面</li>
					<li id="wan">2、裁切封面</li>
				</ul>
			</div>
			<?php }?>
			<div class="Alert-selectarea">
			
				<div class="Alert-left">
					<ul class="Aleft-ul">
						<li <?php if(empty($nowdir)){ echo 'class="active"'; }?> onClick="skip('<?php echo M_URL('Index','imageslist','',GP('name-'.$name.',type-'.$type.',chektype-'.$chektype.',courseid-'.$courseid,true));?>')">全部图片(<?php echo $sum; ?>)</li>
						<?php foreach($dirname as $k=>$v){?>
						<li <?php if($nowdir == $v['name']){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Index','imageslist','',GP('nowdir-'.$v['name'].',nowdirid-'.urlencode($v['id']).',name-'.$name.',type-'.$type.',chektype-'.$chektype.',courseid-'.$courseid,true));?>')"><?php echo $v['name']?>
						<?php if(!empty($v['name'])){ if($v['name'] != date('Ym')){?>
						<a href="<?php echo M_URL('Index','deletedir','',GP('nowdir-'.$v['name'].',nowdirid-'.urlencode($v['id']).',name-'.$name.',type-'.$type.',chektype-'.$chektype.',courseid-'.$courseid,true));?>"><i class="iconfont icon-icon27" title="删除分组" style="color: #e5412c;"></i></a>
						<?php }}?>
						</li>
						<?php }?>
						<li <?php if($nowdir == 'Ico'){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Index','icolist','',GP('nowdir-Ico,name-'.$name.',type-'.$type.',chektype-'.$chektype.',courseid-'.$courseid,true));?>')"><i class="iconfont icon-jiahao" ></i>选择图标</li>
						<li <?php if($nowdir == 'Cover'){ echo 'class ="active"';}?> onClick="skip('<?php echo M_URL('Index','icolist','',GP('nowdir-Cover,name-'.$name.',type-'.$type.',chektype-'.$chektype.',courseid-'.$courseid,true));?>')"><i class="iconfont icon-jiahao" ></i>系统图片</li>
						<li onclick="addtemp()"><i class="iconfont icon-jiahao"></i>新建分组</li>
					</ul>
				</div>
				<div class="Alert-right" id="selectImg">
					<div class="Alert-option">
						<div class="fr">
							<?php if(empty($ico)){?>
							<div id="selectfiles" class="ks-bt bt-pur">本地文件</div>
							
							<?php }?>
						</div>
						<div id="container" style="display: none;"></div>
					</div>
					<div class="Alert-conts clearfix">
						<?php if(!empty($filename)){?>
						<ul class="Aconts-ul" id="AcontsUl">
							<?php foreach($filename as $k=>$v){?>
							<li class="card-li">
								<div class="Aconts-box">
									<div class="Alert-img" autoimg="1,1" style="background-image: url('<?php echo isset($v['baiduPath'])?$v['baiduPath']:$v['filePath']; ?>');">
										<div class="ctrShaw" data-imgurl="<?php echo isset($v['baiduPath'])?$v['baiduPath']:$v['filePath']; ?>" data-imgkey="<?php echo isset($v['wxid'])?'{img:'.$v['wxid'].','.$v['id'].'}':$v['filePath']; ?>"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
										
									</div>
								</div>
							</li>	
							<?php }?>
						</ul>
						<?php }?>
						<?php echo NoC($filename);?>
					</div>
				 <div class="clearfix ks-popup-footer" >
						<div class="mt20 clearfix">
							<label class="fl" <?php if(empty($isshuiyin) || $chektype == 1 || $isshuiyin == 0){echo 'style="display:none"';}else{echo 'style="display:block"';} ?>>
								<input type="checkbox" class="fl mt5 sy" value="" />
								<span class="fl">是否添加水印</span>
							</label>
							<?php if($chektype!=0){?>
							<div class="fl"><button class="ks-bt bt-pue ml10" onclick="imgSelected();">确定</button></div>
							<?php }?>
							<?php if($nowdir!='Cover'&&$nowdir!='Ico'&&$chektype!=0){?>	
							<div class="fl"><button class="ks-bt bt-pue ml10" onclick="deleteImg();">删除</button></div>
							<div class="fl"><button class="ks-bt bt-pue ml10" id="next">下一步，裁剪封面</button></div>	
							<?php }elseif($chektype==0){?>
							<div class="fl"><button class="ks-bt bt-pue ml10" id="yesido">确  认</button></div>		
							<?php }?>	
							<div class="fr"><div class="fr"><?php echo $page->show(3,4); ?></div></div>
						</div>
					</div>
				</div>
				<!--<input type="hidden" id="saveImg" value="" />-->
				<!------------------------------------------------------------------------------------------------------------>
				
				<style type="text/css">
					.Alert-imgText{ height: 50px;}
				</style>
				<div class="Alert-right" style="display: none;" id="cutImg">
					<div class="Alert-option">
						<div class="Alert-imgText" style="width: 75px; float: left;">
							<p class="fsize16 c-017">原图</p>
							<p class="fsize14"></p>
						</div>
						<div class="Alert-imgText" style="float: left;width: 389px;display: inline-block;">
							<p class="fsize16  c-017">图片裁剪区域</p>
							<!--<span class="fsize12">请根据自己所需要裁剪图片，不调整 默认原图大小</sapn>-->
							<!--<p class="fsize12">请根据自己所需要裁剪图片</p>-->
						</div>
					</div>
					<div class="Alert-conts clearfix">
						
						<div class="clearfix">
							<div class="fl Alert-width">
								<div class="Alert-imgText" style="height: 25px;">
									<!--<p class="fsize16 c-017">原图</p>-->
									<p class="fsize12">原图大小：<span id='mobanwh' style="color: red;font-weight: 900;"></span></p>
								</div>
								<div class="Alert-imgmain">
									<img id="moban" width="100%" style="vertical-align: middle;"/>
								</div>
							</div>
							<div class="fl Alert-width">
								<div class="Alert-imgText" style="height: 25px;">
									<!--<p class="fsize16  c-017">图片裁剪区域</p>-->
									<p class="fsize12">裁剪后的图片大小:<span id='tagwh' style="color: red;font-weight: 900;"></span></p>
								</div>
								<div class="Alert-imgmain">
									<div id="imgtarget" style="vertical-align: middle; width: 100%; height: auto;display: inline-block;"></div>	
								</div>
								<label for="keepOriginalImage"><input type="checkbox" name="keepOriginalImage" id="keepOriginalImage" value="1" checked />是否保留原图</label>
							</div>
						</div>
						<input type="hidden" id="x" name="x" value="0"/>
						<input type="hidden" id="y" name="y" value="0"/>
						<input type="hidden" id="w" name="w" value="0"/>
						<input type="hidden" id="h" name="h" value="0"/>
						<input type="hidden" value="" id="imghide" name="img"/>
					</div>
					
				 	<div class="clearfix ks-popup-footer form-footer">
				 		<span class="d-inline-block mt20">
				 			<input type="button" value="返回 " class="ks-bt fn" onclick="$('#cutImg').hide();$('#selectImg').show()" />
							<input type="submit" value="确 认 " class="ks-bt ml10 bt-pue fn" id="enter" />
						</span>
					</div>
				</div>
			</div>
		</div>
		<div style="display: none;" id="temp">
			<form action="<?php echo M_URL('Index','TempaddFile');?>" id="tempnameform" method = "post" style="border: #000000 1px solid;background: white; border-radius: 5px; position: absolute;z-index: 10001;">
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
						<input type="button" onclick="submitform();" class="ks-bt bt-def fn" value="创   建"/>
						<input type="button" id = 'off' class="ks-bt bt-def fn" onclick="getId('temp').style.display = 'none';" value="关   闭"/>
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
	
	var chektype = <?php echo $chektype;?>;
	var ico = '<?php echo $nowdir;?>';
	var courseid = <?php echo $courseid; ?>;
	var classid = <?php echo $classid; ?>;
	module.require(['$','backstage','Jcrop','plupload'],function(){
		
		ossWebUpload(true,<?php echo $this->wxid;?>,'<?php echo $nowdirid;?>');
		
		$(document).on('click','.card-li',function(){
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
			
		}).on('click','.onYes',function(){
			var src = $(this).find(".card-img").attr("src");
			$(this).find(".ctrShaw").hide();
			$(this).removeClass("onYes");
			$(this).find("input[type='checkbox']").prop('checked',false);
			
		
		});
		$('.card-li').first().click();
		if(chektype ==1){
			$('.card-li').dblclick(function(){
				imgSelected()
			})
		};
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
					}else if(type=='piclist'){
						$(parent.document).find('#main').contents().find('#<?php echo $name; ?>')[0].value = img;
					    $(parent.document).find('#main').contents().find(".<?php echo $name;?>").attr('src',src);
					    top.closePopup(window.name);
					}else if(type=='other'){
						top.imgUploadBack(src,img);
					    top.closePopup(window.name);
					}else if(type=='fn'){
						top.popup.data(window.name)(data.src);
					    top.closePopup(window.name);
					}
			    	 //课程头部图片
					if(courseid != 0){
		                $.ajax({
					        type: "POST",
					        url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=courseImg",
					        data:{courseid:courseid,src:img},
					        success:function(text){
					        
					      	}
					    })    
					}
					if(classid != 0){
	                    $.ajax({
					        type: "POST",
					        url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=classImg",
					        data:{
					        	classid:classid,
					        	src:img
					        },
					        success:function(text){
					        
					      	}
					    })  
					}	
				} 
			}) 
		});
		/*****初始化*****/	
		/*选中类型1是单选，0是多选；*/
		
		/**初始化显示页面**/
//		if(chektype==0){
//			$(".Alert-poress").hide();
//			$("#next").text("确  认");
//			$("#next").attr("id","yesido");
//			$(".Alert-poress").hide();
//		}
//		if(ico =='Ico'||ico =='Cover'){
//			$("#next").hide();
//			//$("#next").text("确  认");
//			//$("#next").attr("id","yesidoIco");
//		}
		$("#next").click(function(){
			var xuanze = $('.ctrShaw');
			var flag = 0;
			var img= '';
			for(var i = 0;i<xuanze.length;i++){
				if($(xuanze[i]).css('display') == 'block'){
					flag++;
					img = $(xuanze[i]).attr('data-imgurl');
				}
			}
			if(flag >0){
				$(".Aporess-ul li").attr("class","curr1");  
				$("#wan").attr("class","curr2"); 
				$(".Alert-right").hide();
				$("#cutImg").show();
				$('#imgtarget').html('<img src="'+img+'" width="100%" id="target" />');
				$('#moban').attr('src',img);
				var theImage = new Image(); 
				var aspectRatio = 0;
				theImage.src = $('#moban').attr("src"); 
				$("#mobanwh").html(theImage.width+'*'+theImage.height);
				$("#tagwh").html(theImage.width+'*'+theImage.height);
				$('#imghide').val(img);
				$pcnt = $('#preview-pane .preview-container');
				var xsize = $pcnt.width();
		        var ysize = $pcnt.height();
		       	var phpxsize = "<?php echo $limitx; ?>";
		       	var phpysize = "<?php echo $limity; ?>";
		       	if(phpxsize !=0 && phpysize !=0){
		       		aspectRatio = phpxsize/phpysize
		       	}else{
		       		aspectRatio = xsize/ysize
		       	}
		       	
				$('#target').Jcrop({
					aspectRatio: aspectRatio,
		      		onSelect: updateCoords,
		      		bgFade:     true,
		      		bgOpacity: .2,
		      		setSelect: [ 310, 310, 0, 0 ]
				});
			}else{
				 parent.popup.tips({
		 			title:'至少需要一张图片'
				});
			}
		});
		var type = '<?php echo $type;?>';
		$('#yesidoIco').click(function(){
			imgSelected()
		});
		$("#yesido").click(function(){
			var data = "";
			var ary = [];
			//开启水印
			if($('.sy').prop('checked')){
				$(".onYes").each(function(){
					ary.push($(this).find(".ctrShaw").attr("data-imgurl"))
				});
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
							data+='<img class="card-img" src="'+src+'"/>'
						};
						var type = '<?php echo $type;?>';
						if(type=='parent'){
							$(parent.document).find('input[name="<?php echo $name;?>"]')[0].value = img;
							$(parent.document).find(".<?php echo $name;?>").attr('src',src);
						    parent.closePopup(window.name);
						}else if(type=='top'){
							parent.frames['main'].UE.getEditor('<?php echo $name;?>').execCommand('insertHtml',data);
							//parent.frames['main'].editor.insertHtml(data);
							top.closePopup(window.name);
						}else if(type=='piclist'){
							$(parent.document).find('#main').contents().find('#<?php echo $name; ?>')[0].value = img;
						    $(parent.document).find('#main').contents().find(".<?php echo $name;?>").attr('src',src);
						    top.closePopup(window.name);
						}else if(type=='other'){
							top.imgUploadBack('<?php echo $name;?>',data);
					        top.closePopup(window.name);
						}
					} 
				}); 
			}else{
				$(".onYes").each(function(){
					var src = $(this).find(".ctrShaw").attr("data-imgurl");
					data += '<img class="card-img" src="'+src+'"/>'
				});
				var type = '<?php echo $type;?>';
				if(type=='parent'){
					$(parent.document).find('input[name="<?php echo $name;?>"]')[0].value = img;
					$(parent.document).find(".<?php echo $name;?>").attr('src',src);
				    parent.closePopup(window.name);
				}else if(type=='top'){
					top.frames['main'].UE.getEditor('<?php echo $name;?>').execCommand('insertHtml',data);
					top.closePopup(window.name);
				}else if(type=='piclist'){
					$(parent.document).find('#main').contents().find('#<?php echo $name; ?>')[0].value = img;
				    $(parent.document).find('#main').contents().find(".<?php echo $name;?>").attr('src',src);
				    top.closePopup(window.name)
				}else if(type=='other'){
					top.imgUploadBack('<?php echo $name;?>',data);
				    top.closePopup(window.name)
				}
			}
		});
		imgSelected = function(){
			var xuanze = $('.ctrShaw');
			var flag   = 0;
			var img    = '';
			var imgkey = '';
			for(var i = 0;i<xuanze.length;i++){
				if($(xuanze[i]).css('display') == 'block'){
					flag++;
					img = $(xuanze[i]).attr('data-imgurl');
					imgkey = $(xuanze[i]).attr('data-imgkey');
				}
			}
			if(flag >0){
				if(type=='parent'){
					$(parent.document).find('input[name="<?php echo $name;?>"]')[0].value = imgkey;
					$(parent.document).find(".<?php echo $name;?>").attr('src',img);
				    parent.closePopup(window.name);
				}else if(type=='top'){
					$(parent.document).find('#main').contents().find('input[name="<?php echo $name;?>"]')[0].value = imgkey;
				    $(parent.document).find('#main').contents().find(".<?php echo $name;?>").attr('src',img);
				    top.closePopup(window.name);
				}else if(type=='piclist'){
					$(parent.document).find('#main').contents().find('#<?php echo $name; ?>')[0].value = imgkey;
					$(parent.document).find('#main').contents().find(".<?php echo $name;?>").attr('src',img);
					top.closePopup(window.name);
				}else if(type=='other'){
					top.imgUploadBack(img,imgkey);
				    top.closePopup(window.name);
				}else if(type=='fn'){
					top.popup.data(window.name)(img);
					top.closePopup(window.name);
				}
				 //课程头部图片
				if(courseid != 0){
	                $.ajax({
				        type: "POST",
				        url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=courseImg",
				        data:{courseid:courseid,src:img},
				        success:function(text){}
					});    
				}	
			}else{
				Alert('至少需要一张图片')
			}			
		}
	});
	function addtemp(){
		$("#temp").css({
			display:'flex',
			zIndex:1000,
			position:'fixed',
			flexDirection:'column',
			alignItems:'center',
			justifyContent:'center',
			width:'100%',
			height:'100%'
		});
		$('body').css('display','flex');
	}
	function updateCoords(c){
	    $('#x').val(c.x);
	    $('#y').val(c.y);
	    $('#w').val(c.w);
	    $('#h').val(c.h);
	    if(c.h<310){
	    	$('#tagwh').html(c.w+'*'+c.h);
	    }else if(c.w<310){
	    	$('#tagwh').html(c.w+'*'+c.h);
	    }else{
	    	var theImage = new Image(); 
	    	theImage.src = $('#moban').attr("src"); 
	    	$("#tagwh").html(theImage.width+'*'+theImage.height);
	    }
	};
	function deleteImg(){
	    var xuanze = $('.ctrShaw');
		var flag   = 0;
		var img    = '';
		var imgkey = '';
		for(var i = 0;i<xuanze.length;i++){
			if($(xuanze[i]).css('display') == 'block'){
				flag++;
				img = $(xuanze[i]).attr('data-imgurl');
				imgkey = $(xuanze[i]).attr('data-imgkey');
			}
		}
		if(flag >0){
		   //if(callBackType === 'target' || callBackType === 'fn'){
				var fileUrl = imgkey;
				$.ajax({
					type:"post",
					url:"<?php echo M_URL('home/Index','delwxfile'); ?>",
					data:{fileUrl:fileUrl},
					success : function(data) {
						console.log(data);
						if(data=="ok"){
							Alert('删除成功！',2); 
							location.reload();  
						}
					},
				});
			//}
		}else{
			Alert('至少需要一张图片')
		}	
	}
</script>
</body>
</html>