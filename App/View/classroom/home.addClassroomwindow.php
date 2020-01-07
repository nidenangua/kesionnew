<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>问答模块</title>
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
	.ks-wbox{padding-top: 15px; padding-bottom: 15px;}
	.upload-img{width: 150px;height: 120px;text-align: center;line-height:120px;float: left;border: 1px solid #eee;cursor: pointer;}
	.upload-img i{color:#666;font-size: 40px;}
 </style>
<body class="ks-wrap" style="padding: 0;">
	<div class="ks-wbox">
		<form target="hidframe"  method="post" action="<?php if(isset($value)){echo M_URL($this->AppName.'/Index','doedit',$value['id'],GP('')); }else{echo M_URL($this->AppName.'/Index','dodiscuss','',GP(''));} ?>"  id="myform">
  		
  		<div id="ksBoxContent">

    		<?php if(iscategory($this->wxid,$this->appid)){  ?>
    		<div class="form-row clearfix">
              		<span class="name name-nowrap"><?php echo categoryName($this->wxid) ?></span>
              		<?php echo $link->Linkage(1); ?>
            </div>
            <?php } ?>
            <div class="form-row">
              		<span class="name"><i class="required">*</i>小组名称</span>
              		<div class="form-limit" limit="50">
              			<input type="text" class="form-textbox" name="problem" value="<?php if(!empty($value)) echo $value['groupname'] ?>" />
              		</div>
            </div>
            <div class="form-row">
          		<span class="name"><i class="required">*</i>小组介绍</span> 
          		<div class="form-limit" limit="500"> 
          			<textarea style="padding-right: 50px;" name="describe" rows="3" cols="20" class="form-textarea" placeholder="请输入内容" ><?php if(!empty($value)) echo $value['describe'] ?></textarea>
          		</div>
            </div>
            <div class="form-row">
          		<span class="name"><i class="required">*</i>小组版规</span>
          		<div class="form-limit" limit="500"> 
          			<textarea style="padding-right: 50px;" name="rule" rows="3" cols="20" class="form-textarea" placeholder="请输入内容" ><?php if(!empty($value)) echo $value['rule'] ?></textarea>
          		</div>
            </div>
            <div class="form-row">
          		<span class="name"><i class="required">*</i>小组组长</span>
          		<div class="form-limit" limit="500"> 
          			<textarea style="padding-right: 50px;" name="headman" rows="3" cols="20" class="form-textarea" placeholder="请输入用户名,注意多个版主请用英文逗号隔开。" ><?php if(!empty($value)) echo $value['headman'] ?></textarea>
          		</div>
            </div>
    		<div class="form-row">
              		<span class="name"><i class="required">*</i>小组图片</span>
              		<div > 
              			<img  width='150px' height='125px' class="js_logoBox block defaultpic" src="<?php if(!empty($value)){echo Img($value['img']);}else{ echo nopic(1);} ?>" style="float:left">
              			<a href=javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'}); class="selectImageBtn">
              				<span class="js_uploadText ks-bt bt-pur" style="display: none;">上传图片</span>
              				<input type="hidden" name="defaultpic" value="<?php if(!empty($value)){echo $value['img'];}?>">
          				</a>
          			  <div class="upload-img" style="width: 150px;height: 120px;">
          			  	<i class="iconfont icon-jia"></i>
          			  	
          			  </div>
          			  
              		</div>
            </div>
		   
   	 	
		</div>
    

 	</form>   
	
	
 
	<div id="ksBoxFooter" class="ks-bom clearfix">
		<span class="d-inline-block">
			<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr10"><?php if(!empty($value)){echo "确认修改";}else{echo "确认添加";} ?></button>
		<a href="javascript:top.closePopup('all');" class="ks-bt bt-def"style="min-width: 60px;">取消</a>
		</span>
		
	</div>

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$('.upload-img').click(function(){
	$('.js_uploadText').click()
})	
	
    function do_reg()
{

	var problem = $("textarea[name='describe']").val();
	var categoryid = $("select[name='categoryid']").val();
    var reg  =/^([1-9]\d*|[0]{1,1})$/;
console.log(problem);
	if(problem==''){
		Alert('小组名不能为空');
		return false;	
    }
	
	
	$("#myform").submit();	
 }
 top.imgUploadBack = function(src,img){
	$('.defaultpic')[0].src = src;
	$('input[name="defaultpic"]')[0].value = img;
}; 
</script>
