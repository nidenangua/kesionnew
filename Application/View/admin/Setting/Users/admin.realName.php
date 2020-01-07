
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

<body class="gray-bg">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
         
        	<ul id="tablist">
        		
        		<li>认证材料</li>
        		
        	</ul>
        </h3>
      
          <div class="ibox-tools">
                 <!-- <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                    <i class="reflash"></i>
                  </a>-->
                  <button class="ks-bt bt-def" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
                 
         </div>
    </div>
</div>
</div></form>

<br />
<br />
<br />
<form target="hidframe"  action="<?php echo M_URL('Setting','userDorealName',$real["id"]);  ?>" method="post" enctype="multipart/form-data">
<div id="ksBoxContent">
	<div class="Created-push" id="active">
		<ul>
			
			<li>
				
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						<?php    if($real['usertype'] == 1){ ?>  
						<li>
							<h4>真实姓名:</h4>
							<div class="Created-Content">
								<input type="text" name="realName" value="<?php if(isset($real["realName"]))echo $real["realName"];?>" class="new-form">	
							</div>
						</li>
						
						<li>
							<h4>身份证号:</h4>
							<div class="Created-Content">
								<input type="text" name="numberId" value="<?php if(isset($real["numberId"]))echo $real["numberId"];?>" class="new-form">	
							</div>
						</li>
						
						<li>
							<h4>所在地区:</h4>
						 	<?php 
								echo $link->Linkage(2);
						 	?>
						</li>
						
						<li>
							<h4>联系电话:</h4>
							<div class="Created-Content">
								<input type="text" name="tel" value="<?php if(isset($real["tel"]))echo $real["tel"];?>" class="new-from">					
							</div>
						</li>
						<li>
							<h4>详细地址:</h4>
							<div class="Created-Content">
								<input type="text" name="address" value="<?php if(isset($real["address"]))echo $real["address"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4 style="top: 8px;">身份证正面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto1']);?>" alt="" />
									<input type="file" name="realPhoto1" id="" value="<?php if(isset($real)) echo Img($real['realPhoto1']);?>" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li>

						<li>
							<h4 style="top:10px;">身份证反面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto2']);?>" alt="" />
									<input type="file" name="realPhoto2" id="" value="<?php if(isset($real)) echo Img($real['realPhoto2']);?>" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li> 
						
						<li>
							<h4 style="top:10px;">认证材料:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['teacherPhoto']);?>" alt="" />
									<input type="file" name="teacherPhoto" id="" value="<?php if(isset($real)) echo Img($real['teacherPhoto']);?>" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li>
						
						<?php }elseif($real['usertype'] == 2){?>
						<li>
							<h4>公司名称:</h4>
							<div class="Created-Content">
								<input type="text" name="realName" value="<?php if(isset($real["realName"]))echo $real["realName"];?>" class="new-form">	
							</div>
						</li>
						
						<li>
							<h4>营业证件号:</h4>
							<div class="Created-Content">
								<input type="text" name="numberId" value="<?php if(isset($real["numberId"]))echo $real["numberId"];?>" class="new-form">	
							</div>
						</li>
						
						<li>
							<h4>所在地区:</h4>
						 	<?php 
								echo $link->Linkage(2);
						 	?>
						</li>
						<li>
							<h4>详细地址:</h4>
							<div class="Created-Content">
								<input type="text" name="address" value="<?php if(isset($real["address"]))echo $real["address"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4>联系人:</h4>
							<div class="Created-Content">
								<input type="text" name="contacts" value="<?php if(isset($real["contacts"]))echo $real["contacts"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4>联系电话:</h4>
							<div class="Created-Content">
								<input type="text" name="tel" value="<?php if(isset($real["tel"]))echo $real["tel"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4>经营类别范围:</h4>
							<div class="Created-Content">
								<input type="text" name="range" value="<?php if(isset($real["range"]))echo $real["range"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4 style="top: 8px;">身份证正面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto1']);?>" alt="" />
									<input type="file" name="realPhoto1" id="" value="<?php if(isset($real)) echo Img($real['realPhoto1']);?>" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li>
						<li>
							<h4 style="top:10px;">身份证反面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto2']);?>" alt="" />
									<input type="file" name="realPhoto2" id="" value="<?php if(isset($real)) echo Img($real['realPhoto2']);?>" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li> 
						<li>
							<h4 style="top:10px;">认证材料:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['teacherPhoto']);?>" alt="" />
									<input type="file" name="teacherPhoto" id="" value="<?php if(isset($real)) echo Img($real['teacherPhoto']);?>" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>
								</a>
							</div>
						</li>
						<?php }?>
						<li>
						  	<input type="radio" class="fn" name="status"  value="1" <?php if($real['status'] == 1)echo "checked";  ?> >通过审核；
            				<input type="radio" class="fn" name="status"  value="2"  <?php if($real['status'] == 2)echo "checked";  ?>  >审核不通过；
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
            <button type="submit" class="btn btn-default btn-s-md " >确定修改</button>
            <a href="javascript:history.go(-1);" class="btn bt-gray btn-s-md">取消修改</a> 
        </div>
    </div>
</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>

<!--<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.selectImageBtn1 {
    width: 90px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    background: #f5f8f9;
    cursor: pointer;
    border: 1px solid #e6e9ea;
}
.selectImageBtn2 {
    width: 90px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    background: #f5f8f9;
    cursor: pointer;
    border: 1px solid #e6e9ea;
}
</style> 
</head>


<body class="bg-gary">
<div class="contentBox bRadius10 bg-white w100">
    <div class="generalTitle">
        <span class="roundBox mr10"><img src="<?php echo UOOT;?>Public/app/images/wzsz.png"></span>
        <span class="gTitle fsize18 c-3e verAlignMiddle">实名认证</span>
    </div>
    <div class="infoBox">
        <form target="hidframe"  action="<?php echo M_URL('Setting','userDorealName',$real["id"]);  ?>" method="post" enctype="multipart/form-data">
       
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
 <?php    if($real['usertype'] == 1){ ?>  
  <tr class="bg-gary">
        <td class="leftTd alignRight fsize16 c-92 w120 pt0 pb0 hLh40">真实姓名</td>
        <td class="rightTd alignLife pt0 pb0 hLh40">
         <input type="text" name="realName" value="<?php if(isset($real["realName"]))echo $real["realName"];?>" class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
    <tr class="bg-gary">
        <td class="leftTd alignRight fsize16 c-92 w120 pt0 pb0 hLh40">
        身份证号:
        </td>
        <td class="rightTd alignLife pt0 pb0 hLh40">
         <input type="text" name="numberId" value="<?php if(isset($real["numberId"]))echo $real["numberId"];?>" class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
     <tr class="bg-gary">
        <td class="leftTd alignRight fsize16 c-92 w120 pt0 pb0 hLh40">
        电话:
        </td>
        <td class="rightTd alignLife pt0 pb0 hLh40">
         <input type="text" name="tel" value="<?php if(isset($real["tel"]))echo $real["tel"];?>" class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
    <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">身份证照正面</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <div class="control-group js_uploadBox">
                <div class="btn-upload clearfix">
                    <a href="javascript:void(0);" class="selectImageBtn c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
                    <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                    <input class="hide js_upFile" type="file" name="realPhoto1" id="upImg">
                </div>
                <div class="js_showBox mt10 w180"><img class="js_logoBox block" src="<?php if(isset($real)) echo Img($real['realPhoto1']);?>" width="180" onerror="this.src='<?php echo nopic(1);?>'"></div>
            </div>
        </td>
    </tr>
    
    <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">身份证照反面</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <div class="control-group js_uploadBox2">
                <div class="btn-upload clearfix">
                    <a href="javascript:void(0);" class="selectImageBtn2 c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
                    <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                    <input class="hide js_upFile2" type="file" name="teacherPhoto" id="upImg2">
                </div>
                <div class="js_showBoxw mt10 w180"><img class="js_logoBox block" src="<?php if(isset($real)) echo Img($real['realPhoto2']);?>" width="180" onerror="this.src='<?php echo nopic(1);?>'"></div>
            </div>
        </td>
    </tr>
    
      <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">办学许可证照片</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <div class="control-group js_uploadBox1">
                <div class="btn-upload clearfix">
                    <a href="javascript:void(0);" class="selectImageBtn1 c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
                    <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                    <input class="hide js_upFile" type="file" name="teacherPhoto" id="upImg1">
                </div>
                <div class="js_showBox1 mt10 w180"><img class="js_logoBox block" src="<?php if(isset($real)) echo Img($real['teacherPhoto']);?>" width="180" onerror="this.src='<?php echo nopic(1);?>'"></div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">所在省市</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <?php 
				echo $link->Linkage(2);
		 ?>
        </td>
    </tr>
    <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">具体地址</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <input type="text" name="address" value="<?php if(isset($real)) echo $real['address'] ?>"   class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
   <?php }elseif($real['usertype']== 2){ ?>
   
     <tr class="bg-gary">
        <td class="leftTd alignRight fsize16 c-92 w120 pt0 pb0 hLh40">公司名称</td>
        <td class="rightTd alignLife pt0 pb0 hLh40">
         <input type="text" name="realName" value="<?php if(isset($real["realName"]))echo $real["realName"];?>" class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
    <tr class="bg-gary">
        <td class="leftTd alignRight fsize16 c-92 w120 pt0 pb0 hLh40">
        营业证件号:
        </td>
        <td class="rightTd alignLife pt0 pb0 hLh40">
         <input type="text" name="numberId" value="<?php if(isset($real["numberId"]))echo $real["numberId"];?>" class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
     <tr class="bg-gary">
        <td class="leftTd alignRight fsize16 c-92 w120 pt0 pb0 hLh40">
        联系人:
        </td>
        <td class="rightTd alignLife pt0 pb0 hLh40">
         <input type="text" name="contacts" value="<?php if(isset($real["contacts"]))echo $real["contacts"];?>" class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
     <tr class="bg-gary">
        <td class="leftTd alignRight fsize16 c-92 w120 pt0 pb0 hLh40">
        经营类别范围:
        </td>
        <td class="rightTd alignLife pt0 pb0 hLh40">
         <input type="text" name="range" value="<?php if(isset($real["range"]))echo $real["range"];?>" class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
     <tr class="bg-gary">
        <td class="leftTd alignRight fsize16 c-92 w120 pt0 pb0 hLh40">
        联系电话:
        </td>
        <td class="rightTd alignLife pt0 pb0 hLh40">
         <input type="text" name="tel" value="<?php if(isset($real["tel"]))echo $real["tel"];?>" class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
    <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">营业执照照片</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <div class="control-group js_uploadBox">
                <div class="btn-upload clearfix">
                    <a href="javascript:void(0);" class="selectImageBtn c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
                    <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                    <input class="hide js_upFile" type="file" name="realPhoto1" id="upImg">
                </div>
                <div class="js_showBox mt10 w180"><img class="js_logoBox block" src="<?php if(isset($real)) echo $real['realPhoto1'];  ?>" width="180" ></div>
            </div>
        </td>
    </tr>
   
     <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">办学许可证照片</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <div class="control-group js_uploadBox1">
                <div class="btn-upload clearfix">
                    <a href="javascript:void(0);" class="selectImageBtn1 c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
                    <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                    <input class="hide js_upFile" type="file" name="teacherPhoto" id="upImg1">
                </div>
                <div class="js_showBox1 mt10 w180"><img class="js_logoBox block" src="<?php if(isset($real)) echo Img($real['teacherPhoto']);?>" width="180" onerror="this.src='<?php echo nopic(1);?>'"></div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">所在省市</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <?php 
				echo $link->Linkage(2);
		 ?>
        </td>
    </tr>
    <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">具体地址</td>
        <td class="rightTd alignLife uploader js_uploadBox">
            <input type="text" name="address" value="<?php if(isset($real['address']))echo $real['address']; ?>"   class="inputText bRadius5 w400 c-92">
        </td>
    </tr>
 
   <?php  } ?>
    <tr>
        <td class="leftTd alignRight fsize16 c-92 w120">是否通过审核</td>
        <td class="rightTd ">
            <input type="radio" name="status"  value="1" <?php if($real['status'] == 1)echo "checked";  ?> >通过审核；
            <input type="radio" name="status"  value="2"  <?php if($real['status'] == 2)echo "checked";  ?>  >审核不通过；
        </td>
   
   </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="leftTd alignRight w120"></td>
        <td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm"></td>
       
    </tr>
</table>
</div>
</form>
<div class="hLh40"></div>
</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
 loadScorllJs();//滚轮
	
uploadView(180,120,'upImg',);
uploadView(180,120,'upImg1','js_uploadBox1','js_showBox1','selectImageBtn1');
uploadView(180,120,'upImg2','js_uploadBox2','js_showBox2','selectImageBtn2');
</script>

</body>
</html>-->

