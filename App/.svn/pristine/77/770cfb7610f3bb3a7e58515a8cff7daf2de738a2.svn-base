<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>问答模块</title>
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
	.ks-wbox{padding-top: 15px; padding-bottom: 15px;}
	.upload-img{width: 150px;height: 125px!important;text-align: center;line-height:125px;float: left;border: 1px solid #eee;cursor: pointer;}
	.upload-img i{color:#666;font-size: 40px;}
	.up-circle{width: 60px;height: 60px;border-radius:50%;background: #999 ;display: inline-block;vertical-align: middle;line-height:60px;margin: 20px 0 10px 0;}
	.up-circle i{color:#fff}
	.selectImageBtn {background: none;border:0 ;}
</style>
<body class="ks-wrap" style="padding: 0;">
	<div id="ksBoxHead"> </div>
	<div class="ks-wbox">
		<form target="hidframe"  method="post" action="<?php if(isset($value)){echo M_URL($this->AppName.'/Index','changeMsg',$value['id'],GP('')); }else{echo M_URL($this->AppName.'/Index','doaddClassroom','',GP(''));} ?>"  id="myform">
  		<div id="ksBoxContent" style="padding-left: 15px;">
            <div class="form-row">
              		<span class="name"><i class="form-star">*</i>教室名称</span>
              		
              			<input type="text" class="form-textbox" name="classroomname" value="<?php if(!empty($value)) echo $value['classroomname'] ?>" />
              	
            </div>
            <div class="form-row">
          		<span class="name"><i class="form-star">*</i>所在学校</span> 
          		
          				<select class="form-textbox" name="schoolname">
          					<?php  foreach($school as $k=>$v){ ?>
          						<option value="<?php echo $v['schoolid']; ?>" <?php  if(isset($value))if($value['schoolname']== $v['schoolid']){ echo 'selected=selected';}  ?>><?php echo $v['school']; ?></option>
          						
          					<?php  }  ?>	
          				</select>
          				
          				
          	
            </div>
            
            	<div class="form-row">
	          		<span class="name"><i class="form-star">*</i>教师场景</span>
	          		<div > 
	          		      <img  id="tempImages" width='150px' height='125px' class="js_logoBox block " src="<?php if(!empty($value)){echo $value['tempsrc'];}else{ echo nopic(1);} ?>" style="float:left;" >	
	              		  <a href=javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','classroomScene','',GP('wxid-'.$value['wxid'])); ?>','930px','610px',{title:'选择图片',type:'top'}); class="selectImageBtn">
	          			  <div class="upload-img" style="width: 150px;height: 120px;">
	          			  	  <i class="iconfont icon-jia"></i>
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
    		<div class="form-row">
	          		<span class="name"><i class="form-star">*</i>教室图片</span>
	          		<div > 
	          		      <img  width='150px' height='125px' class="js_logoBox block defaultpic" src="<?php if(!empty($value)){echo Img($value['defaultpic']);}else{ echo nopic(1);} ?>" style="float:left;">	
	              		  <a href=javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'}); class="selectImageBtn">
	          			  <div class="upload-img" style="width: 150px;height: 120px;">
	          			  	  <i class="iconfont icon-jia"></i>
	          			  	  <input type="hidden" name="defaultpic" value="<?php if(!empty($value)){echo Img($value['defaultpic']);}?>">
	          			  </div>
	          			  </a>
	          		</div>
            </div>
            <div class="clearfix"></div>
		</div>
 	</form>   
	<div id="ksBoxFooter" >
		<div class="ks-bom clearfix" style="height: 60px;margin-top: -20px; box-shadow: none;">	
			<div class="col-sm-5"></div>
			<div class="col-sm-6 mt10">
					<button type="button" onClick="do_reg()" class="ks-bt btn-default mr10">确认修改</button>
					<button type="button" class="ks-bt bt-gray mr10" onclick="close1();">取消</button>
			</div>	
		</div>	
	</div>

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>

top.dataCallBack = function(data){
	$('#tempImages').attr('src',data.imagesurl);
	$('#tempid').val(data.radioID);
}
$('.upload-img').click(function(){
	$('.js_uploadText').click()
})	
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
<script>
function close1(){
	//parent.closePopup('all');
	top.closePopup('all');
}
	
</script>