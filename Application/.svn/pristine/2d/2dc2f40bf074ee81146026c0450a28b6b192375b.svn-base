

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css"> 
	.fn{float:none!important;}
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;}
	.Created-ing>ul li h4 {font-weight: normal;}
</style>
<body class="gray-bg">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	&nbsp;&nbsp;&nbsp;修改背景图片&nbsp;&nbsp;&nbsp;
        	
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def" type="button"  onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
    </div>
</div>
</div></form>

<br />
<br />
<br />

<div >

<form target="hidframe" class="form-horizontal" action="<?php if(empty($value)){echo M_URL('Temp','bgdoAdd',$id);}else{echo M_URL('Temp','bgdoEdit',$value['id'],GP('p-'.$now_page.',tempid-'.$value['tempid']));} ?>" method="post" enctype="multipart/form-data">
	
	
	
<div class="Created-push" id="ksBoxContent" style="position: relative;">
		<ul>
			
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>基本信息</span>
						<span>(可修改部分)</span>
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
							<div class="form-upload">
				          		<div class="js_uploadBox">
				          			<div class="js_showBox"><img class="js_logoBox block fileurl" onerror="this.src='//ks.kesion.com/Public/uploads/common/nopic.gif'" src="<?php if(!empty($value)){echo $value['fileurl'];} ?>"></div>
					                <div class="btn-upload clearfix">
					                    <a href="javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-fileurl',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
					                    	<span class="js_uploadText">上传图片</span></a>
					                    <p>限制：2MB,支持jpg|png|gif</p> 
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
			<div class="footer-page h60">
				<div style="text-align: center;margin-top: 10px;">
					<button type="submit" class="btn btn-tool btn-s-md bt-pue" >确定</button>
	           		<a href="javascript:history.go(-1);" class="btn  btn-s-md" style="background: #CCCCCC;">取消</a>
				</div>
			</div>
	</div>
	
</form>	
	


	<div id="ksBoxFooter" style="height: 150px;"></div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
<script type="text/javascript">
	$("#tablist li").click(function(){
		
		$("#tablist li").removeClass("active"); 
		$(this).addClass("active");
		
		var index = $(this).index();
		$(".Created-push").removeAttr("id")
		console.log(index);
		$(".Created-push").eq(index).attr("id","active");
	})
	radiotabs('temptype','.radio-tabs');
</script>
</html>