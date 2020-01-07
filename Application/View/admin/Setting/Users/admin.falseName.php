<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>认证材料</title>
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
	.fn{float: none!important;}
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;} 
	.roundGreen{position: absolute;right:100px;top:140px;border-radius:50%;width: 150px;height: 150px;border: solid 1px green;text-align: center;line-height: 150px;font-size:3em;color: green;} 
	.Created-Content span { color: #000; margin-left: 20px;font-size:14px; }
	.Created-title{margin-left: 15px;}
	.Created-title span:nth-of-type(2){margin-left: 1px;}
	.Created-Content span{margin-left: 21px;}
	.idCard{margin-left: 20px;}
	.dizhi select{width: 100px;}
</style>
<body class="gray-bg">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	<ul id="tablist"><li>认证材料</li></ul>
        </h3>
        <div class="fr">
            <div class="fl ks-top-search">
			<!--搜索-->
			<a class="ks-bt bt-def" href="<?php echo M_URL('Domain','smslist');?>"><i class="iconfont icon-fanhui"></i>返回</a>
			<!--搜索-->
			</div>  
        </div>
    </div>
</div>
</div>
<br />
<br />
<br />
<form target="hidframe"  action="<?php echo UOOT;?>admin.php/home/Users/dorealName/2" method="post" enctype="multipart/form-data">
<div class="Created-push" >
	<div   id="ksBoxContent" style="position: relative;">
		<div class="Created-largetTitle">
			<span>1</span>
			<div class="Created-title">
				<span>基本信息</span>
				<span>(可修改部分)</span>
			</div>
		</div>
		<ul>
			<?php if($real['usertype'] == 1){ ?>
			<li>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>  
						<li>
							<h4>真实姓名:</h4>
							<div class="Created-Content">
								<span><?php if(isset($real["realName"]))echo $real["realName"];?></span>
							</div>
						</li>
						<li>
							<h4>身份证号:</h4>
							<div class="Created-Content">
								<span><?php if(isset($real["numberId"]))echo $real["numberId"];?></span>
							</div>
						</li>
						<li>
							<h4>电话号码:</h4>
							<div class="Created-Content">
								<span><?php if(isset($real["tel"]))echo $real["tel"];?></span>				
							</div>
						</li>
						<li>
							<h4>所在地区:</h4>
							<div class="Created-Content">
								<span class="dizhi"><?php echo $link->Linkage(2);?></span>
							</div>
						</li>
						<li>
							<h4>具体地址:</h4>
							<div class="Created-Content">
								<span><?php if(isset($real["address"]))echo $real["address"];?></span>				
							</div>
						</li>
						<li>
							<h4 style="top: 8px;">身份证正面:</h4>
							<div class="Created-Content idCard clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;height: 296px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto1']);?>" alt="" />
									<input type="file" name="realPhoto1" id="" value="/Public/uploads/school/35/201711/59f97daacedf7.jpg" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li>
						<li>
							<h4 style="top:10px;">身份证反面:</h4>
							<div class="Created-Content idCard clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;height: 296px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto2']);?>" alt="" />
									<input type="file" name="realPhoto2" id="" value="/Public/uploads/school/35/201711/59f97daabef54.jpg" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li> 
					</ul>
				</div>
				</div>
			</li>
			<?php }elseif($real['usertype'] == 2){?>
			<li>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>  
						<li>
							<h4>真实5555555姓名:</h4>
							<div class="Created-Content">
								<span>Carry</span>
							</div>
						</li>
						<li>
							<h4>身份证号:</h4>
							<div class="Created-Content">
								<span>3521545545554565454</span>
							</div>
						</li>
						<li>
							<h4>所在地区:</h4>
							<div class="Created-Content">
								<span>福建省是，的开发极乐空间镂空建档立卡记得</span>
							</div>
						</li>
						<li>
							<h4>具体地址:</h4>
							<div class="Created-Content">
								<span>观音山16号楼</span>				
							</div>
						</li>
						<li>
							<h4 style="top: 8px;">身份证正面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;height: 296px;">
									<img width="415" src="/Public/uploads/school/35/201711/59f97daacedf7.jpg" alt="" />
									<input type="file" name="realPhoto1" id="" value="/Public/uploads/school/35/201711/59f97daacedf7.jpg" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li>
						<li>
							<h4 style="top:10px;">身份证反面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;height: 296px;">
									<img width="415" src="/Public/uploads/school/35/201711/59f97daabef54.jpg" alt="" />
									<input type="file" name="realPhoto2" id="" value="/Public/uploads/school/35/201711/59f97daabef54.jpg" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li> 
					</ul>
				</div>
				</div>
			</li>
			<?php }?>
		</ul> 
		<div class="roundGreen"><?php if($real['status'] == 1){?>已认证<?php }else{?>未认证<?php }?></div>
	</div>
</div>	
<div id="ksBoxFooter" style="height:160px;"></div>
</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>

