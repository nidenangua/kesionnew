<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>

<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/content/content.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
</style>
<body class="gray-bg">

<div class="wrapper">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl other">
        		<span class="mr20">个人资料</span>
        	<ul id="tablist">
        	
        		<li class="active fl">
        			<a>基本资料</a>
    			</li>
        		<?php echo $this->Field->getTab($tableid,'table','useradd');?>
        	</ul>
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


<br />
<br />
<br />

<form target="hidframe"  method="post" id="myform" action="<?php if(!empty($userinfo)){echo M_URL('Users','doeditUsers',$userid,GP("usertype-$usertype,p-$now_page"));}else{echo M_URL('Users','doaddUsers','',GP(''));} ?>" class="form-horizontal" enctype="multipart/form-data">

	
	
	
	<div class="tab-pane" id="active">
			
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
				<h4>用户名:</h4> 
				<div class="Created-Content">
				<input type="text" class="long-text" name="username" flag='用户名' value="<?php if(!empty($userinfo)){echo $userinfo['username'];} ?>"  <?php if(!empty($userinfo)) echo " readonly " ?>/>
				</div>
			</li>
			
			
			<li>
				<input name="id" type="hidden" value=""/>
				<h4>密码:</h4> 
				<div class="Created-Content">
				<input class="long-text" style="width: 120px;height: 30px;" name="password"  type="password" flag='密码' value="" <?php if(empty($userinfo)) echo "required"; ?>/>
				</div>
			</li>
			<?php if($usertype!=2){?>
			<li>
				<h4>性别:</h4> 
				<div class="Created-Content clearfix">
					<label for=""><input type="radio" name="Sex" id="" value="1" <?php if(!empty($userinfo)){ if($userinfo['Sex']==1){echo "checked";}} ?>/>男</label>
					<label for=""><input type="radio" name="Sex" id="" value="2" <?php if(!empty($userinfo)){ if($userinfo['Sex']==2){echo "checked";}} ?>/>女</label>
				</div>
			</li>
			<?php }?>
			<li>
				<h4>手机号码:</h4>
				<div class="Created-Content">
				<input type="text" class="long-text" name="mobile" value="<?php if(!empty($userinfo)){echo $userinfo['mobile'];} ?>"  <?php if(!empty($userinfo)) echo " readonlyy " ?> >		
				<font class="need">*</font>				
				</div>
			</li>
			
			<li>
				<h4>个人邮箱:</h4>
				<div class="Created-Content">
				<input type="text" class="long-text" name="email" value="<?php if(!empty($userinfo)){echo $userinfo['email'];} ?>">
				<font class="need">*</font>							
				</div>
			</li>
			
			<li>
				<h4>所属分类:</h4>
				<div class="Created-Content">
				<?php echo $Linkage->Linkage(1);?>	
				
				</div>
			</li>
			
			
			<li>
				<h4><?php if($usertype == '1'){echo "教师名称";}elseif($usertype == '2'){echo "机构名称";}elseif($usertype == '0'){echo "学员名称";} ?></h4>
				<div class="Created-Content">
				<input type="text" class="long-text" name="name" value="<?php if(!empty($userinfo)){echo $userinfo['name'];} ?>">						
				</div>
			</li>
			
			<li>
				<h4><?php if($usertype == '1'){echo "教师英文名称";}elseif($usertype == '2'){echo "机构英文名称";}elseif($usertype == '0'){echo "学员英文名称";} ?></h4>
				<div class="Created-Content">
				<input type="text" class="long-text" name="ename" value="<?php if(!empty($userinfo)){echo $userinfo['ename'];} ?>">						
				</div>
			</li>
			
			
			<li>
				<h4>所在地区:</h4>
				<div class="Created-Content">
				<?php echo $link->Linkage(1);?>  				
				</div>
			</li>
			
			
			<li>
				<h4>会员状态:</h4>
				<div class="Created-Content">
					<div class="radio radio-info radio-inline">
						
						<label><input style="margin-top:1px;" type="radio" id="status1" value="1" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==1)echo "checked";}else{echo "checked";}?>>正常 </label>
					</div>
					
					<div class="radio radio-info radio-inline">
						
						<label><input style="margin-top:1px;"  type="radio" id="status3" value="0" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==0) echo "checked";}?>>待审核 </label>
					</div>
					
					<div class="radio radio-info radio-inline">
						
						<label><input style="margin-top:1px;"  type="radio" id="status2" value="2" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==2) echo "checked";}?>> 锁定 </label>
					</div>				
				</div>
			</li>
			</ul>
			</div>
			
			
			
			
			<div class="form-upload">
			<div class="js_uploadBox">
			<div class="js_showBox mt10 w180" style="height: 220px;"><img class="js_logoBox block" src="<?php echo Img($this->upload->getHead($userid));?>" width="180" onerror="this.src='<?php echo nopic(1);?>'"></div> 
			<div class="btn-upload clearfix">
			<a href="javascript:void(0);" class="selectImageBtn" style="color: #FF5507;border: solid 1px #FF5507;">
			<span class="js_uploadText">上传图片</span></a>
			<p>限制：2MB,支持jpg|png|gif</p> 
			<input class="hide js_upFile" type="file" name="file" id="upImg">
			</div>
			</div>
			</div>
		</div>
		
		
	
	</div>
	<?php echo $this->Field->getF($tableid,'table','useradd',$userinfo);?>
		

	<div class="footer-page">
        <div class="col-sm-5"></div>
        <div class="col-sm-6 mt10">
             <button class="btn btn-default btn-s-md ">确认</button>
        <a href="javascript:history.go(-1);" class="btn btn-s-md bt-gray">取消</a>
        </div>
    </div>
    

</div>  
<div style="height:40px;"></div>
</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
<script type="text/javascript">
	loadScorllJs();
	$("#tablist li").click(function(){
		
		$("#tablist li").removeClass("active"); 
		$(this).addClass("active");
		
		var index = $(this).index();
		$(".tab-pane").removeAttr("id")
		console.log(index);
		$(".tab-pane").eq(index).attr("id","active");
	})
	uploadView('100','100');//图片上传	
</script>
</html>
