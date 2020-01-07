
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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title" style="border: none;">
     		微信公众号
		</h3>
	    </div>
	    <!--header-->
					     
			  
		<!--widget-->
		<?php include  CURR_VIEW_PATH . "left_menu.php";?>	
		<!--/widget-->
		<!--table-->
		 <form  target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','focusReply','',GP(''))  ?>" method="post" class="commentForm" enctype="multipart/form-data">
			
			<div class="ks-wbox mt20 bRadius10">
				 <div class="clearfix ks-top-tab"> 
								<div class="fl">
									<a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','reply','',GP('')); ?>">关键词自动回复</a>
								      
								        	<a class="ks-bt bt-pur" href="<?php echo M_URL($this->AppName.'/Index','focusReplyNow','',GP('')); ?>">关注时回复</a>
							   </div>
							   </div>	
							   <div class="pt20">
								   	<div class="form-row clearfix">
									   	<div class="name-nowrap fsize14 mr10">开启关注时回复</div>
									   
									   	<div class="form-switch" open-value="1" id="dakaiguan">
										   	<label class="radioLabel">
											   <input type="radio" name="isfocus" focusid ="<?php if(isset($showFocus['id']))echo $showFocus['id'];?>"     class="radioInput" <?php if(isset($showFocus)){if($showFocus['isfocus'] == 1) echo 'checked="checked"';} ?>  value="1"/>开启											 
										   	</label>
										   	<label class="radioLabel">
											   <input type="radio" name="isfocus" focusid ="<?php if(isset($showFocus['id']))echo $showFocus['id'];?>"  class="radioInput"<?php if(isset($showFocus)){if($showFocus['isfocus'] == 0) echo 'checked="checked"';} ?>  value="0" />关闭
										   	</label>
										   	<input type="hidden" name="" class="kaiguan" value="<?php if(isset($showFocus)){echo $showFocus['isfocus'];} ?>" />
									   	</div>
								   	</div>
								
								   
								   <!--kaikguan-->
								   <div class="suhow" id ="xiaolin">
								   
								   	<div class="form-row clearfix">
								   		
								   		<div class="name">回复类型</div>
									   <div class="rightTd alignLife" id="huifu">
										   <label class="radioLabel fl">
											   <input type="radio" name="replyType" class="radioInput" value="0" <?php if($showFocus['replyType'] == 0){echo 'checked="checked"';}?>/>素材</label>
										   <label class="radioLabel fl">
											   <input type="radio" name="replyType" class="radioInput" value="1" <?php if($showFocus['replyType'] == 1){echo 'checked="checked"';}?>/>文字</label>
										   <label class="radioLabel fl" >
											   <input type="radio" name="replyType" class="radioInput" value="2" <?php if($showFocus['replyType'] == 2){echo 'checked="checked"';}?>/>课程</label>
											    <label class="radioLabel fl" >
											   <input type="radio" name="replyType" class="radioInput" value="3" <?php if($showFocus['replyType'] == 3){echo 'checked="checked"';}?>/>班级</label>
									   </div>
								    </div>
								    
								    <!--单选-->
								    <!--111111111111-->
								    <div class="replyType form-row clearfix xulie" value="0" <?php if($showFocus['sucaiid']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?> ></style>
									 
									   <div class="clearfix">
										   	<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replySucai','',GP("abc-focusReplySucai1"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从素材中选择</a>
									   </div>
									    <div class="form-row clearfix" >
											<div id="focusReplySucai1" style="width: 200px; margin-top: 15px;">
												
												<div class="Suin Suin1"  <?php if(!empty($showFocus['sucaiid'])){echo 'style="display: block;margin-left: 2px"';}else{echo 'style="display: none;margin-left: 2px"';} ?>><div class="SuinImg">
												
												
												
												
												
											<img  onerror="this.src='<?php echo nopic();?>'"  src="<?php if(isset($showFocus['pic']))echo Img($showFocus['pic']);?>" style="width:100%;height:100%;">											
												</div><div class="SuinMark mt5"><div class="hLh30 SuinTitle"><?php echo '标题： '.$showFocus['titles'];?></div>
												<div class="hLh30 SuinSt"><?php echo '作者： '.$showFocus['author'];?>//<?php if(empty($showFocus['media_id'])){echo "未上传";}else{echo "已经上传";}?></div>
												</div></div>
									  			<?php if($showFocus['sucaiid']){echo '<input class="SuninRa" type="hidden" required name="courseid" value="'.$showFocus['sucaiid'].'">';}?>
											<!--不存在为空-->
											</div>
									   </div>
								  	</div>
								  	<!--22222222222-->
								   	<div class="replyType form-row clearfix xulie" value="1" <?php if($showFocus['contents']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?>>
									   
									    <div class="rightTd alignLife">
										   <textarea name="content" rows="2" cols="20" class="inputText bRadius5" id="content" style="height:200px;width:600px;"><?php echo $showFocus["contents"];?></textarea>
									   	</div>
									   	<div></div>
								    </div>
								    <!--333333333-->
								    <div class="replyType form-row clearfix xulie" value="2" <?php if($showFocus['courseid']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?>>
									  
									    <div class="clearfix" >
										   <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyCourse','',GP("ab-focusReplyCourse1"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从课程中选择</a>
									    </div>
									    <div class="form-row clearfix" >
											<div id="focusReplyCourse1" style="width: 200px; margin-top: 15px;">
											   
												<div class="Suin Suin2"  <?php if(!empty($showFocus['courseid'])){echo 'style="display:block;margin-left: 2px"';}else{echo 'style="display:none;margin-left: 2px"';} ?>><div class="SuinImg">
												
												<img  onerror="this.src='<?php echo nopic();?>'"  src="<?php if(isset($showFocus['defaultpic']))echo Img($showFocus['defaultpic']);?>" style="width:100%;height:100%;">													
												</div><div class="SuinMark mt5"><div class="hLh30 SuinTitle"><?php echo '课程名称: '.$showFocus['title'];?></div>
												<div class="hLh30 SuinTitle" ><?php if(isset($name))echo '老师: '.$name;?></div>
												<!--<div class="hLh30 SuinSt"><?php echo '课程介绍: '.$showFocus['intro'];?></div>-->
												</div></div>
									  			<?php if($showFocus['courseid']){echo '<input class="SuninRa" type="hidden" required name="courseid" value="'.$showFocus['courseid'].'">';}?>
											<!--不存在为空-->											
											</div>
									    </div>
                                  </div>
                                  <div class="replyType form-row clearfix xulie" value="3" <?php if($showFocus['classid']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?>>
									  
									    <div class="clearfix" >
										   <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyClass','',GP("ab-focusReplyCourse2"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从班级中选择</a>
									    </div>
									    <div class="form-row clearfix" >
											<div id="focusReplyCourse2" style="width: 200px; margin-top: 15px;">
											   
												<div class="Suin Suin3"  <?php if(!empty($showFocus['classid'])){echo 'style="display:block;margin-left: 2px"';}else{echo 'style="display:none;margin-left: 2px"';} ?>><div class="SuinImg">
												
												<img  onerror="this.src='<?php echo nopic();?>'"  src="<?php if(isset($showFocus['defaultpic']))echo Img($showFocus['defaultpic']);?>" style="width:100%;height:100%;">													
												</div><div class="SuinMark mt5"><div class="hLh30 SuinTitle"><?php echo '课程名称: '.$showFocus['title'];?></div>
												<div class="hLh30 SuinTitle" ><?php if(isset($name))echo '老师: '.$name;?></div>
												<!--<div class="hLh30 SuinSt"><?php echo '课程介绍: '.$showFocus['intro'];?></div>-->
												</div></div>
									  			<?php if($showFocus['classid']){echo '<input class="SuninRa" type="hidden" required name="classid" value="'.$showFocus['classid'].'">';}?>
											<!--不存在为空-->											
											</div>
									    </div>
                                  </div>
                                </div> 
                                </div>
                       
                         
                
	       </div>
		   </form>
	    <!--/table-->
	            
		<!--footer-->
		<div class="ks-bom clearfix">
			<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr10" >&nbsp;&nbsp;确&nbsp;&nbsp;认&nbsp;&nbsp;</button>
		</div>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs()
			uploadView(180,120);
			
			$("input[name='isfocus']:radio").click(function(){
			  	 var url="<?php echo M_URL($this->AppName.'/Index','switchFocus','',GP(''));?>";
			     var isfocus =  $(this).val();
			     var id = $(this).attr('focusid');
			    
			    
			    $.ajax({
						type:"post",
						url:url,
						data:{isfocus:isfocus,id:id},
						
						success:function(data,textStatus){
							Alert(data);
						},
						error:function(){
							Alert("发生了错误,请检查!");
						}
				})
			})
			 
			
			$('input[name="replyType"]').click(function(){
				var value = this.value;
			     $('.replyType').each(function(){
					if($(this).attr('value')==value){
						$(this).show();
					}else{
						$(this).hide();
					}
				})
			})
			
			$(function(){
				var aa = $('input[name="isfocus"]:checked').val();
			    var xiaolin = $('#xiaolin');
				if(aa ==0){
			      xiaolin.hide();
				}
				
				$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
				$("input[type=file]").each(function(){
			//	if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("");}
				});
				
			
			});
			
			
			$("#dakaiguan span").click(function(){
				var zhi=$(this).parent('#dakaiguan ').find("input[name='isfocus']:checked").val();
				$(".kaiguan").val(zhi);
				if(zhi==1){
					$(".suhow").show();
					kaiguan();
				}else{
					$(".suhow").hide();
				}
				console.log(zhi);
			})
		});
	
		function do_reg(){ 
		$('.xulie').each(function(){
			if($(this).css('display') == 'block' ){		
				switch($(this).index()){
					case 1:
						($(this).find('.Suin1').css('display') == 'none') ? Alert('值不能为空') : $('#myform').submit();
					
						return false;
						break;
					case 2:
						($(this).find('.SuninRa').val() == "") ? Alert('值不能为空') : $('#myform').submit();
						return false;
						break;
					case 3:
						($(this).find('.Suin2').css('display') == 'none') ? Alert('值不能为空') : $('#myform').submit();
						return false;
					case 4:
						($(this).find('.Suin3').css('display') == 'none') ? Alert('值不能为空') : $('#myform').submit();
							return false;
					}
				}
			});	
		}
</script>
</body>
</html>