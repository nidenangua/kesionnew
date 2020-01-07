
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css"> 
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;}
	.Created-push{display: none;}
	#active{display: block!important;}
	.tab-pane{padding: 30px;
    background: #FFFFFF;
    border-radius: 10px;}
    .Created-title span:last-child{
    	margin-left: 0;
    }
    .upload-img{width: 150px;height: 125px;text-align: center;line-height:120px;float: left;border: 1px solid #eee;cursor: pointer;}
	.upload-img i{color:#666;font-size: 40px;}
	.selectImageBtn{background: none;border: 0;float: left;}
	.form-upload {position: relative;width: 300px;top: 30px;}
	.js_showBox {border-radius: 0;}
	.form-icon {position: relative;height: 125px;width: 150px;float: left;margin-right: 15px;}
	.form-bg {position: absolute;bottom: 0;width: 150px;z-index: 9;height: 40px;background: #000;opacity: 0.15;}
	.form-close {position: absolute;right: 0;top: 0;}
	.form-prev {position: absolute;bottom: 6px; left: 0; z-index: 999;}
	.form-next {position: absolute;bottom: 6px; right: 0; z-index: 999;}
	
	.imgList {width: 800px; position: absolute;}
	.imglist-box {height: 150px;position: relative;overflow: hidden;min-width: 800px;margin-left: 75px;display: inline-block;}
</style>
<body class="gray-bg">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	客服配置
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
    </div>
</div>
</div></form>


<br />

<div id="ksBoxContent" class="mt50">
<form target="hidframe"  method="post" id="myform" action="<?php echo M_URL('Setting','savekf');?>" class="form-horizontal" enctype="multipart/form-data">

	
	
	
<div class="Created-push tab-pane" id="active">
		<ul>
			
		<li>
			<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>基本配置</span>
						<span>(可修改部分)</span>
					</div>
				</div>
			
			
			
				
		<div class="Created-ing">
					<ul>
						<li>
							<h4>客服号:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="wechat" value="<?php if(!empty($res)){ echo $res['wechat'];} ?>">
							</div>
						</li>
				<div class="footer-page">
			        <div class="col-sm-5"></div>
			        <div class="col-sm-6 mt10">
			             <button class="btn btn-default btn-s-md " onclick="do_reg()">确认</button>
			       		 <a href="javascript:history.go(-1);" class="btn btn-s-md bt-gray">取消</a>
			        </div>
    			</div>
   			 </ul>
		</ul>

	
	
    	<div id="ksBoxFooter" style="height: 150px;"></div>

</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	function do_reg(){
		$('#myform').submit();
	}
</script>
</body>

</html>
