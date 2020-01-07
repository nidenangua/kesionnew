<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title></title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>

<style>
	.selectImageBtn {display: block;}
	
</style>
<body class="ks-wrap">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">

</form>




<form target="hidframe" class="form-horizontal" action="<?php if(empty($value)){echo M_URL('Website','bgmdoAdd',$id);}else{echo M_URL('Website','bgmdoEdit',$value['id'],GP('p-'.$now_page.',tempid-'.$value['tempid']));} ?>" method="post" enctype="multipart/form-data">
	<div class="ks-wbox bg-white bRadius10">
		<div class="ks-head-nav">
				<!--标题-->
				<a href="javascript:history.go(-1);">网站设置</a><span> <em>/</em> 编辑背景音乐			<!--标题-->
			</span></div>
	
<div class="Created-push mt20" id="ksBoxContent" >
		<ul>
			
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>基本信息</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>音乐名称:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="filename" value="<?php if(!empty($value)){echo $value['filename'];} ?>">
							</div>
						</li>
						<li>
							<div class="">
				          		<div class="js_uploadBox">
					                <div class="btn-upload clearfix">
					                    <a href="javascript:addTypeChange('<?php echo M_URL('Index','musiclist','',GP('type-top,name-fileurl,type1-3',true));?>','930px','610px',{title:'选择音乐',type:'top'});" class="selectImageBtn">
					                    	<span class="js_uploadText">上传音乐</span></a>
					                    <p>限制：10MB,支持mp3</p> 
					                    <input type="hidden" name="fileurl" value="<?php if(!empty($value)){echo $value['fileurl'];} ?>">
					               </div>
							    </div>
				          	</div>
						</li>
					</ul>
					
				</div>
				
					
				</div>
				
				
			</li>
			</ul>
		
	</div>
	<div class="ks-bom form-footer" >
			<div class="d-inline-block">
					<button type="submit" class="ks-bt bt-pue mr10" >确定</button>
	           		<a href="javascript:history.go(-1);" class="ks-bt bt-def" style="background: #CCCCCC;">取消</a>
				</div>
	
</div>
</form>	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

</body>
<script >
		module.require(['$','backstage','nicescroll','laydate'],function(){
			loadScorllJs();
			$("#tablist li").click(function(){
			
			$("#tablist li").removeClass("active"); 
			$(this).addClass("active");
			
			var index = $(this).index();
			$(".Created-push").removeAttr("id")
			console.log(index);
			$(".Created-push").eq(index).attr("id","active");
		})
		radiotabs('temptype','.radio-tabs');
		})
	
</script>
</html>