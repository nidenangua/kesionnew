<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>增加教师</title>
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<style>
	.ks-wbox{padding-top: 15px; padding-bottom: 15px;}
	.upload-img{width: 150px;height: 120px;text-align: center;line-height:120px;float: left;border: 1px solid #eee;cursor: pointer;}
	.upload-img i{color:#666;font-size: 40px;}
	.up-circle{width: 60px;height: 60px;border-radius:50%;background: #999 ;display: inline-block;vertical-align: middle;line-height:60px;margin: 20px 0 10px 0;}
	.up-circle i{color:#fff}
</style>
<body class="ks-wrap" style="padding: 0;" >
	
	<div class="ks-wbox" >
		<form target="hidframe"  method="post" action="<?php if(isset($value)){echo M_URL($this->AppName.'/Index','doeditClassroom',$value['id'],GP('')); }else{echo M_URL($this->AppName.'/Index','doaddClassroom','',GP(''));} ?>"  id="myform">
  		<div  style="padding-left: 15px;">
    		<?php if(iscategory($this->wxid,$this->appid)){  ?>
    		<div class="form-row clearfix">
              		<span class="name name-nowrap"><?php echo categoryName($this->wxid) ?></span>
              		<?php echo $link->Linkage(1); ?>
            </div>
            <?php } ?>
            <div class="form-row">
              		<span class="name"><i class="form-star">*</i>教室名称</span>
              		
              			<input type="text" class="form-textbox" name="classroomname" value="<?php if(!empty($value)) echo $value['classroomname'] ?>" />
              	
            </div>
            <div class="form-row">
          		<span class="name"><i class="form-star">*</i>所在学校</span> 
          		
          				<select class="form-textbox" name="schoolname">
          					<?php  foreach($school as $k=>$v){ ?>
          						<option value="<?php echo $v['schoolid']; ?>" <?php  if(isset($value))if($value['schoolname']== $v['school']){ echo 'selected=selected';}  ?>><?php echo $v['school']; ?></option>
          						
          					<?php  }  ?>	
          				</select>
          				
          				
          	
            </div>
            
            	<div class="form-row">
	          		<span class="name"><i class="form-star">*</i>教室场景</span>
	          		<div > 
	          		      <img  id="tempImages" width='150px' height='125px' class="js_logoBox block " src="<?php if(!empty($value)){echo $value['tempsrc'];}else{ echo nopic(9);} ?>" style="float:left;margin-right: 20px;" >	
	              		  <a href=javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','classroomScene','',GP('')); ?>','930px','610px',{title:'选择图片',type:'top'}); class="selectImageBtn">
	          			  <div class="upload-img" style="width: 150px;height: 123px;">
	          			  	  <i class="iconfont icon-jia" style="color: #ccc;"></i>
	          			  </div>
	          			  </a>
	          			  <input type="hidden" name="tempid" id="tempid" value="<?php if(isset($value)){echo $value['tempid'];} ?>" />
	          		</div>
            </div>
            <div class="clear"></div>

            <div class="form-row">
          		<span class="name"><i class="form-star">*</i>地址</span>
          		
          			<input type="text" class="form-textbox" name="address" value="<?php if(!empty($value)) echo $value['address'] ?>" />
          		
            </div>
            <div class="form-row">
              		<span class="name"><i class="form-star">*</i>容纳人数</span>
              		<div>
              			<input type="number" name="galleryful" class="form-textbox " value="<?php if(!empty($value)){echo $value['galleryful'];}else{echo 0;} ?>"  style="width:80px;margin-right: 15px;"/>人
              		</div>
            </div>
    		<div class="form-row " style="padding-bottom: 200px;">
	          		<span class="name"><i class="form-star">*</i>教室图片</span>
	          		<div > 
	          		      <img  width='150px' height='125px' class="js_logoBox block defaultpic" src="<?php if(!empty($value)){echo Img($value['defaultpic']);}else{ echo nopic(9);} ?>" style="float:left; margin-right: 20px;">	
	              		  <a href=javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'}); class="selectImageBtn">
	          			  <div class="upload-img" style="width: 150px;height: 123px;">
	          			  	  <i class="iconfont icon-jia" style="color: #ccc;"></i>
	          			  	  <input type="hidden" name="defaultpic" value="<?php if(!empty($value)){echo Img($value['defaultpic']);}?>">
	          			  </div>
	          			  </a>
	          		</div>
            </div>
            <div class="clearfix"></div>
		</div>
 	</form>   
	<div class="ks-popup-footer form-footer clearfix" >
		<span style="display: inline-block;margin-top: 20px;">
			<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr10"><?php if(!empty($value)){echo "确认修改";}else{echo "确认添加";} ?></button>
		<a href="javascript:top.closePopup('all');" class="ks-bt bt-white"style="min-width: 60px;">取消</a>
		</span>
		
	</div>

</body>
</html>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs();
	$('.upload-img').click(function(){
	$('.js_uploadText').click()
	})	
})
top.dataCallBack = function(data){
	$('#tempImages').attr('src',data.imagesurl);
	$('#tempid').val(data.radioID);
}

function do_reg(){
	var problem = $("textarea[name='describe']").val();
	var categoryid = $("select[name='categoryid']").val();
    var reg  =/^([1-9]\d*|[0]{1,1})$/;
	if(problem==''){
		Alert('教室名不能为空');
		return false;	
    }
	$("#myform").submit();	
 }
 top.imgUploadBack = function(src,img){
	$('.defaultpic')[0].src = src;
	$('input[name="defaultpic"]')[0].value = img;
}; 
</script>
