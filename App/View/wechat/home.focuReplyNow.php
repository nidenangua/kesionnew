
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
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
<div class="contentBox bRadius10  w100 clearfix">


	    <div  class="rightModel bg-white bRadius10 ks-wbox" style="overflow: hidden;"> 	
	    <!--内容-->

			    
			<div id="ksBoxHead">
				<div class="generalTitle clearfix">
				    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
			        <span class="gTitle fsize18">微信公众号</span>
				    <div class="fr">
				    	<?php include  CURR_VIEW_PATH . "left_menu.php";?> 	
				    </div>
				</div>
				
			    <div class="clearfix ks-top-tab"> 
					<div class="fl">
						<ul class="titleTab clearfix fl">
							<li class="fl">
								<a href="<?php echo M_URL($this->AppName.'/Index','reply','',GP('')); ?>">关键词自动回复</a></li>
					        <li class="fl">
					        	<a href="<?php echo M_URL($this->AppName.'/Index','focusReplyNow','',GP('')); ?>">关注时回复</a></li>
                        </ul>
				   </div>
				   <div class="fr">
				    	<button type="button"  class="ks-bt bt-def  mr10" onclick="addGuize()"><i class="iconfont icon-jiahao"></i>关键词添加规则</button> 
				   		<select class="w150 inputText bRadius5" id="keytype">
							<option value="1" <?php if(isset($keytype) and $keytype==1)echo 'selected';?>>关键字</option>
						</select>
						
						<div class="fr ks-top-search">
							<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword; ?>">
							<input type="submit" class="sc-button" id ="searchRule" name="searchBtn" value="搜索"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','reply'); ?>','<?php echo URL_MODEL;?>')">
						</div>
				   </div>
			
				</div>
			</div>
				
				
			
				<div class="infoBox">		
					<div id="ksBoxContent">
						
					
						
						
						<!--第二块-->
						<div id="focusreplypage" class="configTab" style="display:none;">
							   <form  target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','focusReply','',GP(''))  ?>" method="post" class="commentForm" enctype="multipart/form-data">
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
								   <div class="suhow">
								   
								   	<div class="form-row clearfix">
								   		
								   		<div class="name">回复类型</div>
									
									   <div class="rightTd alignLife" id="huifu">
										   <label class="radioLabel fl">
											   <input type="radio" name="replyType" class="radioInput" value="0" <?php if($showFocus['sucaiid']){echo 'checked="checked"';}else{echo 'checked="checked"';}?>/>素材</label>
										   <label class="radioLabel fl">
											   <input type="radio" name="replyType" class="radioInput" value="1" <?php if($showFocus['contents']){echo 'checked="checked"';}?>/>文字</label>
										   <label class="radioLabel fl">
											   <input type="radio" name="replyType" class="radioInput" value="2" <?php if($showFocus['courseid']){echo 'checked="checked"';}?>/>课程</label>
									   </div>
								    </div>
								    
								    <!--单选-->
								    <!--111111111111-->
								    <div class="replyType form-row clearfix xulie" value="0" <?php if($showFocus['sucaiid']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?> ></style>
									   <div class="name"  id ="ddd">素材</div>
									   <div class="clearfix">
										   	<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replySucai','',GP("abc-focusReplySucai1"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从素材中选择</a>
									   </div>
									    <div class="form-row clearfix" >
											<div id="focusReplySucai1" style="width: 200px; margin-top: 15px;">
												
												<div class="Suin" style="margin-left: 2px;"><div class="SuinImg">
												
											<img  onerror="this.src='<?php echo nopic();?>'"  src="<?php if(isset($showFocus['url']))echo $showFocus['url'];?>" style="width:100%;height:100%;">											
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
									    <div class="name">文字</div>
									    <div class="rightTd alignLife">
										   <textarea name="content" rows="2" cols="20" class="inputText bRadius5" id="content" style="height:200px;width:40%;"><?php echo $showFocus["contents"];?></textarea>
									   	</div>
									   	<div></div>
								    </div>
								    <!--333333333-->
								    <div class="replyType form-row clearfix xulie" value="2" <?php if($showFocus['courseid']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?>>
									    <div class="name">课程</div>
									    <div class="clearfix" >
										   <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyCourse','',GP("ab-focusReplyCourse1"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从课程中选择</a>
									    </div>
									    <div class="form-row clearfix" >
											<div id="focusReplyCourse1" style="width: 200px; margin-top: 15px;">
											   
												<div class="Suin" style="margin-left: 2px;"><div class="SuinImg">
												
												<img  onerror="this.src='<?php echo nopic();?>'"  src="<?php if(isset($showFocus['defaultpic']))echo $showFocus['defaultpic'];?>" style="width:100%;height:100%;">													
												</div><div class="SuinMark mt5"><div class="hLh30 SuinTitle"><?php echo '课程名称: '.$showFocus['title'];?></div>
												<div class="hLh30 SuinTitle"><?php if(isset($name))echo '老师: '.$name;?></div>
												<div class="hLh30 SuinSt"><?php echo '课程介绍: '.$showFocus['intro'];?></div></div></div>
									  			<?php if($showFocus['courseid']){echo '<input class="SuninRa" type="hidden" required name="courseid" value="'.$showFocus['courseid'].'">';}?>
											<!--不存在为空-->
											
											</div>
									    </div>
								    </div>
								    <div class="replyType form-row clearfix pd  xulie" value="3" style="display: none">
									   	
										<div class="clearfix" >
											<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyClass','',GP("ab-focusReplyCourse4"));  ?>','850px','600px');"
											   class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从班级中选择</a>
											    
										</div>
										<div class="form-row clearfix" >
											<div style="width: 200px; margin-top: 15px;" id="focusReplyCourse4" >
											    <div class="Suin Suin4" style="display: none;">
													
										        </div>
											</div>
										</div>

									</div>
								    <!--单选-->
								   
								   	</div>
							   		
								   	<!--kaikguan-->
								   	
								   	
								   	
								   </div>
								  
								    
							   </form>
							   
							  
						   	</div>
						   	 <?php echo NoC($showFocus);?>
							<!--第二块-->
							
						
						
						
			
					</div>
			    </div>
			    
			    
			<div class="ksBoxLine" id="onekey" style="display: none;">
				<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr10" >&nbsp;&nbsp;确&nbsp;&nbsp;认&nbsp;&nbsp;</button>
				<a href="javascript:history.go(-1);" class="ks-bt bt-def">取消返回</a>
			</div>
			<div class="ksBoxLine" id="seckey" style="display: none;">
				<button type="button" onClick="pos_addRule()" class="ks-bt bt-pue mr10" >&nbsp;&nbsp;确&nbsp;&nbsp;认&nbsp;&nbsp;</button>
				<a href="javascript:history.go(-1);" class="ks-bt bt-def">取消返回</a>
			</div>
	  	<!--内容-->
	  	</div>
	   
<div id="ksBoxFooter">
	<div class="ks-bom clearfix">
		<span class="form-pages">
			<span class="fl">
				<button class="ks-bt bt-pue mr10" onclick="GoForm('RuleForm')"><i class="iconfont icon-lajitong"></i>批量删除</button>
			</span>
			<?php echo $page->show(3); ?>
		</span>
	</div>
</div> 
</div>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function GoForm(e){
	//alert("ewafe");
	$("#"+e).submit();	
}
uploadView(180,120);
/*设置切换*/

$('.titleTab li').click(function(){
	$(this).addClass('curr').siblings().removeClass('curr');
	if($(this).index()!=0){$(".form-pages").hide();}else{$(".form-pages").show();} 
	$('.configTab:eq('+$(this).index()+')').show().siblings().hide();	
	$(".ksBoxLine").hide();
	var index = $(this).index();
	if(index==1){$("#onekey").show();}
	
})

function addGuize(){
	$(".configTab").hide(); 
	$("#addrulepage").show();
	$(".ksBoxLine").hide();
	$("#seckey").show();
}

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
	$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
	$("input[type=file]").each(function(){
//	if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("");}
	});
	<?php if($staus ==1){ echo '$(".configTab").hide();$("#addrulepage").show();'; }?>
	
//	$(".configTab").hide();
	

});
function cleckSitename(){
    var sitename = document.getElementById("sitename").value;
	if(sitename!= ""){
	  var url = "<?php echo M_URL('website','cleckSitename'); ?>";
	  var data ={
	   sitename:sitename,
	  };
	  $.ajax({
			type:"post",
			url:url,
			data:data,
			success:function(text){

				  $("#un_ck").html(result.result_desc);
			   if(result.result_code == "OK"){
				  $("#un_ck").css("color","green");
			   }else{
				   alert("ss");
				  $("#un_ck").css("color","red");
			   }
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	  })
	}
}
function DoCheck() {
	var ch=document.getElementsByName("id[]");
	if(document.getElementsByName("allChecked")[0].checked==true)
	{
		for(var i=0;i<ch.length;i++)
		{
			ch[i].checked=true;
		}
	}else{
		for(var i=0;i<ch.length;i++)
		{
			ch[i].checked=false;
		}
	}
}


$(".btn-es").click(function () {
	$("#addrulepage").show();
	$("#keywordpage").hide();
	$("#addrulepage form input,#addrulepage #content").each(function(){
		$(this).val('');
	});

})

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

function do_reg()
{   
	
	var kaiguan=$(".kaiguan").val();
	console.log(kaiguan);
	if(kaiguan==1){
	$("#huifu label").each(function(){
		if($(this).find("input[type='radio']")[0].checked == true){
			var xulie = $(this).index();
			if(xulie!=1){
				var zhiyu = $(".xulie").eq(xulie).find(".SuninRa").val();
				if(typeof(zhiyu) == 'undefined'){
					 parent.popup.tips({
						 title:'添加内容不能为空'
					 });
				}else{$('#myform').submit();}
				
			}else{
				var zhiyu = $(".xulie").eq(xulie).find("#content").val();
				if(typeof(zhiyu) == 'undefined'){
					 parent.popup.tips({
						 title:'添加内容不能为空'
					 });
				}else{
					$('#myform').submit();
				}
			}
		
			
			
			
		}
		
		
	})
	}else if(kaiguan==0){
		$('#myform').submit();
	} 
}
 
function pos_addRule()
{   

		$('#addRule').submit();
 }

function kaiguan(){
	
	var kaiguan=$(".kaiguan").val();
	if(kaiguan==1){
		$("#huifu label").each(function(){
			if($(this).find("input[type='radio']")[0].checked == true){
				var xulie = $(this).index();
				$(".xulie").eq(xulie).show();
			
			}
			
			
		})
	}else{
		$(".suhow").hide();
	}
	
}

 
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
 
 
 
 
</script>
</body>
</html>