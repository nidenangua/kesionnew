
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
<style>
	
</style>
<body class="ks-wrap">
	<!--开始-->
	<div class="bg-white bRadius10 ks-wbox">
	<div class="generalTitle clearfix">
	    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
        <span class="gTitle fsize18">微信公众号</span>
	    <div class="fr">
	    	<!--按钮块--->
			<?php include  CURR_VIEW_PATH . "left_menu.php";?>
			<!--按钮块--->
	    </div>
	</div>
	
	<div class="clearfix ks-top-tab">
		<div class="fl">
			<!--栏目块-->
			<ul>
		      	<li class="fl">
					<a href="<?php echo M_URL($this->AppName.'/Index','reply','',GP('')); ?>">关键词自动回复</a></li>
			<li class="fl">
					  <a href="<?php echo M_URL($this->AppName.'/Index','focusReplyNow','',GP('')); ?>">关注时回复</a></li>
		    </ul>
		    <!--栏目块-->
	    </div>
		<div class="fr ks-top-search">
			<!--搜索-->
							
			<!--搜索-->
		</div>
	</div>		
	    <!--内容-->

			    
				
			
      
			
		<form id="myform" action="<?php echo M_URL($this->AppName.'/Index','editReplyRule',$id,GP(""));?>" method="post" class="commentForm" enctype="multipart/form-data">
			<div id="ksBoxContent">

              	<div class="form-box form-upload-box">	
							
							
								<div style="padding-right: 60%;">
									<div class="form-row">
										<div class="name">规则名称</div> 
										<div class="form-limit" limit="50" id="focusReplySucai2">
											<input type="text" name="rule" class="form-textbox" value="<?php if(!empty($replyInfo))echo $replyInfo["rule"]; ?>" >
										</div>
									</div>
									
									
									<div class="form-row"> 
										<div class="name">关键字&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<span class="fsize12 c-red "></span>)</div>
										<div class="form-limit" limit="50" id="focusReplySucai2">
											<input type="text" name="keyword" class="form-textbox" value="<?php if(!empty($replyInfo))echo $replyInfo["keyword"]; ?>" >
										</div>
										
									</div>
													
									<!--单选-->
									<div class="form-row clearfix">
								   		
								   		<div class="name">回复类型</div>
									
									   <div class="rightTd alignLife">
										   <label class="radioLabel fl">
										<input type="radio" name="replyType" class="radioInput" value="0" <?php if($replyInfo['sucaiid']){echo 'checked="checked"';}?>/> 素材
										   </label>
										   <label class="radioLabel fl">
										<input type="radio" name="replyType" class="radioInput" value="1" <?php if($replyInfo['contents']){echo 'checked="checked"';}?>/>文字
										   </label>
										   <label class="radioLabel fl">
										<input type="radio" name="replyType" class="radioInput" value="2" <?php if($replyInfo['courseid']){echo 'checked="checked"';}?>/>课程
										   </label>
										     <label class="radioLabel fl">
										<input type="radio" name="replyType" class="radioInput" value="3" <?php if($replyInfo['courseid']){echo 'checked="checked"';}?>/>班级
										   </label>
									   </div>
								    </div>
								    
								    
								  
								  <!--单选-->
								    <!--111111111111-->
								    <div class="replyType form-row clearfix xulie" value="0" <?php if($replyInfo['sucaiid']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?> ></style>
									 
									   <div class="clearfix">
										   	<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replySucai','',GP("abc-focusReplySucai3"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从素材中选择</a>
									   </div>
									    <div class="form-row clearfix" >
											<div id="focusReplySucai3" style="width: 200px; margin-top: 15px;">
												
												<div class="Suin Suin1"  <?php if(!empty($replyInfo['sucaiid'])){echo 'style="display: block;margin-left: 2px"';}else{echo 'style="display: none;margin-left: 2px"';} ?>><div class="SuinImg">
												
												
	                          	              <img  onerror="this.src='<?php echo nopic();?>'"  src="<?php if(isset($replyInfo['pic']))echo Img($replyInfo['pic']);?>" style="width:100%;height:100%;">											
												</div><div class="SuinMark mt5"><div class="hLh30 SuinTitle"><?php echo '标题： '.$replyInfo['titles'];?></div>
												<div class="hLh30 SuinSt"><?php echo '作者： '.$replyInfo['author'];?>//<?php if(empty($replyInfo['media_id'])){echo "未上传";}else{echo "已经上传";}?></div>
												</div></div>
									  			<?php if($replyInfo['sucaiid']){echo '<input class="SuninRa" type="hidden" required name="sucaiid" value="'.$replyInfo['sucaiid'].'">';}?>
											<!--不存在为空-->
											</div>
									   </div>
								  	</div>
								  	<!--22222222222-->
								   	<div class="replyType form-row clearfix xulie" value="1" <?php if($replyInfo['contents']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?>>
									   
									    <div class="rightTd alignLife">
										   <textarea name="contents" rows="2" cols="20" class="inputText bRadius5" id="content" style="height:200px;width:600px;"><?php echo $replyInfo["contents"];?></textarea>
									   	</div>
									   	<div></div>
								    </div>
								    <!--333333333-->
								    <div class="replyType form-row clearfix xulie" value="2" <?php if($replyInfo['courseid']){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?>>
									  
									    <div class="clearfix" >
										   <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyCourse','',GP("ab-focusReplyCourse3"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从课程中选择</a>
									    </div>
									    <div class="form-row clearfix" >
											<div id="focusReplyCourse3" style="width: 200px; margin-top: 15px;">
											   
												<div class="Suin Suin2"  <?php if(!empty($replyInfo['courseid'])){echo 'style="display:block;margin-left: 2px"';}else{echo 'style="display:none;margin-left: 2px"';} ?>><div class="SuinImg">
												
												<img  onerror="this.src='<?php echo nopic();?>'"  src="<?php if(isset($replyInfo['defaultpic']))echo Img($replyInfo['defaultpic']);?>" style="width:100%;height:100%;">													
												</div><div class="SuinMark mt5"><div class="hLh30 SuinTitle"><?php echo '课程名称: '.$replyInfo['title'];?></div>
												<div class="hLh30 SuinTitle"><?php if(isset($teacherName))echo '老师: '.$teacherName;?></div>
											<!--	<div class="hLh30 SuinSt"><?php echo '课程介绍: '.$replyInfo['intro'];?></div>-->
												</div></div>
									  			<?php if($replyInfo['courseid']){echo '<input class="SuninRa" type="hidden" required name="courseid" value="'.$replyInfo['courseid'].'">';}?>
											<!--不存在为空-->											
											</div>
									    </div>
                                  </div>
                         </form>  

	                    </div>
			         </div>
			         
			          
			          <div id="ksBoxFooter">
        	<div class="form-footer">
        		<span class="d-inline-block">
        			<button type="button" onclick='do_submit()' class="ks-bt bt-pue">确定</button>
        			<button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-def">取消</button>
              	</span>
        	</div>
        </div>
 </div>	
			
	    
			    
			
		
		
	  	<!--内容-->
	

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>

uploadView(180,120);
/*设置切换*/



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

	});
});



function do_submit(){ 
	$('.xulie').each(function(){
		if($(this).css('display') == 'block' ){	
			console.log($(this).index());	
			switch($(this).index()){
				case 3:
					($(this).find('.Suin1').css('display') == 'none') ? Alert('请选择素材') : $('#myform').submit();
				
					return false;
					break;
				case 4:
					($(this).find('textarea').val() == "") ? Alert('请输入回复文字') : $('#myform').submit();
					return false;
					break;
				case 5:
					($(this).find('.Suin').css('display') == 'none') ? Alert('请选择课程') : $('#myform').submit();
					return false;
				
			}
		}
	});
}

 
 
</script>
</body>
</html>