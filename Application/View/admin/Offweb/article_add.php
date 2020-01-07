<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

<style>
.configTab{display: none;}
#content{height: auto;}
.form-upload-box{padding-right: 200px;}
.form-textbox{width:40%}
.form-title{font-size: 14px;line-height: 28px;color: #ababab;}
input[type="checkbox"],input[type="radio"] {
	position: relative;top: -3px;
}
</style>
</head>
<body class="ks-wrap">
	<body class="ks-wrap">
	<!--开始-->
	<div id="ksBoxHead" class="clearfix">
		<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			<!--标题-->
			<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>每日资讯</a><span>/</span>添加资讯</p>
			<!--标题-->
			</div>
		</div>
	</div>
</div>
<form target="hidframe" method="post" class="form-horizontal" action="<?php if(!empty($value)){echo M_URL('Offweb','doEditArticle',$value['id'],GP('p-'.$now_page));}else{echo M_URL('Offweb','doaddArticle','',GP(''));}?>" enctype="multipart/form-data" style="margin-left: 0;">
 	<div class="mt20 bg-white bRadius10">
		 <!----------------- 自定义字段添加后插入---------------->
		<div id="ksBoxContent"> 
			 <div class="configTab" style="display:block"><div class="form-box form-upload-box">
			 	<div class="form-row clearfix" >
			   	<div class="form-limit" limit="50">
							<span class="name name-nowrap">录入员</span>
							<input type="text" class="form-textbox" value="<?php if(!empty($value)){echo $value['inputer'];}else{echo '';}?>" name="inputer" />
				</div>
				</div>
			 	<!--<div class="form-row clearfix" >
			   	<div class="form-limit" limit="50">
							<span class="name name-nowrap">标题</span>
							<input type="text" class="form-textbox" value="<?php if(!empty($value)){echo $value['title'];}?>" name="title" />
				</div>
				</div>
				<div class="form-row"> 
					<span class="name">添加时间</span> 
					<input id="datatime" type="text" value="<?php if(!empty($value)){echo date('Y-m-d H:i:s',$value['adddate']);}else{echo date('Y-m-d H:i:s',time());}?>" name="adddate" required readonly class="w200  laydate-icon">
				</div>-->
				<!--<div class="form-row clearfix" >
			   	<div class="form-limit" limit="50">
							<span class="name name-nowrap">录入员</span>
							<input type="text" class="form-textbox" value="<?php if(!empty($value)){echo $value['inputer'];}?>" name="inputer" />
				</div>
				</div>
				<div class="form-row clearfix">
				<span class="name name-nowrap">特殊属性</span>
				<div class="clearfix">
				   <label class="mr30"><input value="1" type="checkbox" class="verAlignMiddle" name="hot">
				   <span class="ml0 verAlignMiddle fsize16 c-92">是否热门</span></label> <label class="mr30"><input value="1" type="checkbox" class="verAlignMiddle" name="allowcomment">
					<span class="ml0 verAlignMiddle fsize16 c-92">允许评论</span></label> <label class="mr30"><input value="1" type="checkbox" class="verAlignMiddle" name="roll">
					<span class="ml0 verAlignMiddle fsize16 c-92">是否滚动</span></label> <label class="mr30"><input value="1" type="checkbox" class="verAlignMiddle" name="recommend">
					<span class="ml0 verAlignMiddle fsize16 c-92">是否推荐</span></label> <label class="mr30"><input value="1" type="checkbox" class="verAlignMiddle" name="slide">
					<span class="ml0 verAlignMiddle fsize16 c-92">是否幻灯</span></label></div></div>-->
			 <!--<div class="form-upload"><span class="name">新闻封面</span>
			 <div class="rightTd alignLife uploader js_uploadBox">
			   <div class=" js_uploadBox">
		<div class="js_showBox bRadiusn "><img class="defaultpic js_logoBox block defaultpic" onerror="this.src='//store.kesion.com/Public/uploads/common/timg.jpg'" src="" width="270" height="180"></div> 
				<div class="btn-upload clearfix alignCenter">
					<a href="javascript:void(0);" onclick="addTypeChange('//store.kesion.com/home.html/default/Index/imageslist?name-defaultpic,type-top','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn c-89 fsize14  mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
					<span class="c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
					<input type="hidden" name="defaultpic">
				</div>
			   </div>
			 </div>
			 </div>-->
			 
			 <!--<div class="form-row clearfix" >
			   	<div class="form-limit" limit="225">
							<span class="name name-nowrap">摘要</span>
							<textarea type="text" class="form-textarea" rows="3" name="abstract" ><?php if(!empty($value)){echo $value['abstract'];}?></textarea>
						</div></div>-->
		    
		    
		    <div class="form-row clearfix"><span class="name name-nowrap">资讯内容</span><div><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
			<html><head><title></title><meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
			    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
			    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script></head>
			<body>
			<div><script id="content" name="content" type="text/plain"><?php if(!empty($value)){echo $value['content'];}?></script></div>
		<script type="text/javascript">
		    var content = UE.getEditor('content',{initialFrameHeight: "500",});content.commands['myinsertimage'] = { execCommand: function() { addTypeChange("//store.kesion.com/home.html/default/Index/imageslist?appid-101,name-content,type-top,chektype-0","930px","610px",{title:"选择图片",type:"top"}); return true; }, queryCommandState: function() { } };
		    content.commands['myinsertvideo'] = { execCommand: function() { addTypeChange("//store.kesion.com/home.html/default/Index/wxfile?appid-101,name-content,type1-2,type-top,chektype-0","930px","610px",{title:"选择视频",type:"top"}); return true; }, queryCommandState: function() { } };
		    content.commands['mymusic'] = { execCommand: function() { addTypeChange("//store.kesion.com/home.html/default/Index/wxfile?appid-101,name-content,type1-3,type-top,chektype-0","930px","610px",{title:"选择音频",type:"top"}); return true; }, queryCommandState: function() { } };
		    content.commands['myattachment'] = { execCommand: function() { addTypeChange("//store.kesion.com/home.html/default/Index/wxfile?appid-101,name-content,type1-4,type-top,chektype-0","930px","610px",{title:"选择文档",type:"top"}); return true; }, queryCommandState: function() { } };</script>
		</body>
		</html></div></div><div class="form-row clearfix"><span class="name name-nowrap">审核状态</span>
				 <div class="clearfix">
				   <label class="radioLabel fl">
					 <input type="radio" class="radioInput"  value="1" <?php if(!empty($value)){if($value['status']==1){echo 'checked="checked"';}}else{echo 'checked="checked"';}?> name="status">
					 <span class="radioName fsize16 c-92">已审核</span>
				   </label>
				   <label class="radioLabel fl">
					 <input type="radio" class="radioInput" value="0" <?php if(!empty($value)){if($value['status']==0){echo 'checked="checked"';}}?> name="status">
					 <span class="radioName fsize16 c-92">待审核</span>
				   </label>
				   <label class="radioLabel fl">
					 <input type="radio" class="radioInput" value="2" <?php if(!empty($value)){if($value['status']==2){echo 'checked="checked"';}}?> name="status">
					 <span class="radioName fsize16 c-92">草稿</span>
				   </label>
				 </div>
			   </div>
			   <div class="form-row"> 
					<span class="name">添加时间</span> 
					<input id="datatime" type="text" value="<?php if(!empty($value)){echo date('Y-m-d H:i:s',$value['adddate']);}else{echo date('Y-m-d H:i:s',time());}?>" name="adddate" required readonly class="w200  laydate-icon">
				</div>
			   
			   </div></div><div class="configTab" ><div class="form-box form-upload-box"></div></div>			 	
		</div>	 	
	</div>

		
		
		<div class="configTab" ><div class="form-box form-upload-box"></div></div>			 	
		</div>	 	
	</div>
    
	<div id="ksBoxFooter" style="height: 80px;">
		<div class="form-footer clearfix">
			<span class="d-inline-block">
				<input type="submit" class="ks-bt bt-pue" value="确认添加" name="confirm">
		        <button onclick="javascript:history.go(-1);" class="ks-bt bt-white">取消</button>
	    	</span>
		</div>

</form>

	
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage'],function(){
		$('.form-textbox').parents('.form-limit').css('width','40%')
		$('.form-textbox').css('width','100%');
		$('.form-upload .name ').addClass('form-title');
		uploadView(270,180);//上传图片
		datatime('#datatime');//时间
		$('.ks-view-tab li').click(function(){
	
			$(this).addClass('curr').siblings().removeClass('curr');
			$('.configTab:eq('+$(this).index()+')').show().siblings().hide();	
		})
		$(".configTab").each(function(){ 
			var i= 0;
			$(this).find(".form-upload").each(function(){
				var top = 320 * i+60;
				if(top==0){top=60;}
				$(this).css("top",top);
				i++;
		
			})	 
		})
	})

</script>


