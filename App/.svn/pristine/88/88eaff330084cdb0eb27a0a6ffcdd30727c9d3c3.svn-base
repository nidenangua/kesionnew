
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
<link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		
		<!--header-->
	    <div class="ks-head-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">公众号店铺</a><em>/</em>关键词管理<em>/</em>添加关键词规则
			<!--标题-->
		</div>
	    <!--header-->
		<!--table-->
		<div  class="rightModel" style="overflow: hidden;"> 	
	    <!--内容-->

			<!--添加规则-->
			<div class="ks-wbox mt20" id ="addrulepage" class="configTab">
				<form id="myform" action="<?php echo M_URL($this->AppName.'/Index','addReplyRule','',GP(""));?>" method="post" class="commentForm" enctype="multipart/form-data">
					
				<div>
					<div class="clearfix ks-top-tab"> 
						<div class="fl">
			
							<a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','reply','',GP('')); ?>">关键词自动回复</a>
							<a class="ks-bt bt-pur" href="<?php echo M_URL($this->AppName.'/Index','focusReplyNow','',GP('')); ?>">关注时回复</a>
						</div>

					</div>
					<div style="padding-right: 60%;">
						<div class="form-row">
							<div class="name">规则名称</div> 
							<div class="form-limit" limit="50" id="focusReplySucai2">
								<input type="text" name="rule" class="form-textbox" value="" >
							</div>
						</div>
						
						
						<div class="form-row"> 
							<div class="name">关键字</div>
							<div class="form-limit" limit="50" id="focusReplySucai2">
								<input type="text" name="keyword" class="form-textbox" value="" >
							</div>
							
						</div>
															
						<!--单选-->
						<div class="form-row clearfix">
							
							<div class="name">回复类型</div>
						
							<div class="rightTd alignLife">
								<label class="radioLabel fl">
									<input type="radio" name="replyType" class="radioInput" value="0"/> 素材
								</label>
								<label class="radioLabel fl">
									<input type="radio" name="replyType" class="radioInput" value="1"/>文字
								</label>
								<label class="radioLabel fl">
									<input type="radio" name="replyType" class="radioInput" value="2"/>课程
								</label>
								<label class="radioLabel fl">
									<input type="radio" name="replyType" class="radioInput" value="3"/>班级
								</label>
							</div>
						</div>
							
							
						<div class="replyType form-row clearfix pd  xulie" value="0" style="display: none">
							
							<div class="clearfix">
								<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replySucai','',GP("abc-focusReplySucai3"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从素材中选择</a>
							</div>
							<div class="form-row clearfix" >
								<div id="focusReplySucai3" style="width: 200px; margin-top: 15px;">
									<div class="Suin Suin1" style="display: none;">
										
									</div>
								</div>
							</div>
							
						</div>
						
						
						<div class="replyType form-row clearfix pd  xulie" value="1" style="display: none">
							
							<div class="rightTd alignLife">
								<textarea name="contents" rows="20" cols="1000" class="inputText bRadius5" id="content" style="height:200px;width:600px;"></textarea>
								
							</div>
							<div></div>
						</div>
						
						
						<div class="replyType form-row clearfix pd  xulie" value="2" style="display: none">
							
							<div class="clearfix" >
								<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyCourse','',GP("ab-focusReplyCourse3"));  ?>','850px','600px');"
									class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从课程中选择</a>
									
							</div>
							<div class="form-row clearfix" >
								<div style="width: 200px; margin-top: 15px;" id="focusReplyCourse3" >
									<div class="Suin Suin3" style="display: none;">
										
									</div>
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
					</div>
					</div>	
				</form>
			</div>						
			<!--添加规则-->
			
			

		</div>
	    <!--/table-->
	            
		<!--footer-->
		<div class="ks-bom clearfix">
        	<div class="form-footer">
        	<span class="d-inline-block">
            	<button type="button" onClick="do_reg()" class="ks-bt bt-pue">确认</button>
           		<button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-white">取消</button>
           	</span>
        	</div>
		</div>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			
		});
	
	
	</script>
	



<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>

uploadView(180,120);
/*设置切换*/


$('input[name="replyType"]').click(function(){
	var value = this.value;
	//alert(value);
	$('.replyType').each(function(){
		if($(this).attr('value')==value){
			$(this).show();
		}else{
			$(this).hide();
		}
	})
})



function do_reg()
{   
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
				case 6:
					($(this).find('.Suin4').css('display') == 'none') ? Alert('请选择班级') : $('#myform').submit();
					return false;
			}
		}
	});

	
}
 
 
 
 
</script>
</body>
</html>