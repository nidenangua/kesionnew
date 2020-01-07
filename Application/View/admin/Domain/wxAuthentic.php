

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
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;}
	.Created-push{display: none;}
	#active{display: block!important;}
</style>
<body class="gray-bg">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	&nbsp;&nbsp;&nbsp;一心教育&nbsp;&nbsp;&nbsp;
        	<ul id="tablist">
        		
        		<li>认证材料</li>
        		
        	</ul>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
    </div>
</div>
</div></form>

<br />
<br />
<br />

<div id="ksBoxContent">

<form target="hidframe"  class="form-horizontal" action="<?php echo UOOT;?>admin.php/home/H5market/doaddH5" method="post" enctype="multipart/form-data">
	
	

	
	
	<div class="Created-push" id="active">
		<ul>
			
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>选填项</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						
						<li>
							<h4>真实姓名:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="enname" flag='会员类型' value="">						
							</div>
						</li>
						
						<li>
							<h4>身份证号:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="author" flag='手机号码' value="">						
							</div>
						</li>
						
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>联系地址:</h4>
							<div class="Created-Content">
								<select name="" id="" style="width: 150px;">
									<option value="">设计专业</option>
								</select>
								
								<select name="" id="" style="width: 150px;">
									<option value="">设计专业</option>
								</select>
								
								<select name="" id="" style="width: 150px;">
									<option value="">设计专业</option>
								</select>
							</div>
						</li>
						
						<li>
							<h4>联系电话:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="author" flag='手机号码' value="">						
							</div>
						</li>
						
						<li>
							<h4 style="top: 8px;">身份证正面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;height: 296px;">
									<img src="<?php echo UOOT;?>Public/admin/images/shenfenzheng1.png" alt="" />
									
								</a>
							</div>
						</li>

						<li>
							<h4 style="top:10px;">身份证反面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;height: 296px;">
									<img src="<?php echo UOOT;?>Public/admin/images/shenfenzheng2.png" alt="" />
									<input type="file" name="" id="" value="" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li>
						<li>
							<h4 style="top:10px;">认证材料:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;height: 296px;">
									<img src="<?php echo UOOT;?>Public/admin/images/shenfenzheng2.png" alt="" />
									<input type="file" name="" id="" value="" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li>
						<li>
							<br />
							<br />
						
						</li>
					</ul>
					
				</div>
			
				</div>
				
				
			</li>
		</ul> 
		<br /><br /><br /><br /><br />
	</div>
	
</div>	

	
	<div class="footer-page">
        <div class="col-sm-5"></div>
        <div class="col-sm-6 mt10">
            <button type="submit" class="btn btn-primary btn-s-md bt-pue" >确定修改</button>
            <a href="javascript:history.go(-1);" class="btn btn-default btn-s-md">取消修改</a> 
        </div>
    </div>
</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>
