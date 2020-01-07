<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
	
</head>


<body class="ks-wrap">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">

</form>


<div >

<form target="hidframe" class="form-horizontal" action="<?php if(empty($value)){echo M_URL('Website','bgdoAdd',$id);}else{echo M_URL('Website','bgdoEdit',$value['id'],GP('p-'.$now_page.',tempid-'.$value['tempid']));} ?>" method="post" enctype="multipart/form-data">
	
<div class="ks-wbox bg-white bRadius10">	
	
	<div class="ks-head-box">
     	<h3 class="ks-head-title2">
     		<div class="ks-head-nav" >
			<!--标题-->
			<a href="<?php echo M_URL('Website');?>">网站设置</a><em>/</em><a href="<?php echo M_URL('Website','websitetemplate',2);?>">我的模板</a><em>/</em>修改背景图片
			<!--标题-->
			</div>
		</h3>
    </div>
	
<div class="Created-push mt20"  style="position: relative;padding-top: 0;">
		<ul>
			
			<li>
				<div class="Created-largetTitle">
					<!--<span>1</span>-->
					<div class="Created-title">
						<!--<span>基本信息</span>
						<span>(可修改部分)</span>-->
					</div>
				</div>
				<div class="form-box form-upload-box" style="padding-top: 0;">
					<div class="Created-ing">
					<ul>
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>图片名称:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="filename" value="<?php if(!empty($value)){echo $value['filename'];} ?>">
							</div>
						</li>
						<li>
							<div class="form-upload" style="position: relative;">
				          		<div class="js_uploadBox">
				          			<div class="js_showBox" ><img class="js_logoBox block fileurl" onerror="this.src='//ks.kesion.com/Public/uploads/common/nopic.gif'" src="<?php if(!empty($value)){echo XImg($value['fileurl'],1);} ?>"></div>
					                <div class="btn-upload clearfix">
					                    <a href="javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-fileurl',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
					                    	<span class="js_uploadText">上传图片</span></a>
					                    <p>限制：2MB,支持jpg|png|gif</p> 
					                    <input type="hidden" name="fileurl" value="<?php if(!empty($value)){echo XImg($value['fileurl'],1);} ?>">
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
	

	


<div class="ks-bom form-footer">
			<div class="d-inline-block">
					<button type="submit" class="ks-bt bt-pue mr10" >确定</button>
	           		<a href="javascript:history.go(-1);" class="ks-bt bt-def">取消</a>
				</div>
	
</div>
</form>	

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

</body>
<script type="text/javascript">
	module.require(['$','backstage','nicescroll'],function(){
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