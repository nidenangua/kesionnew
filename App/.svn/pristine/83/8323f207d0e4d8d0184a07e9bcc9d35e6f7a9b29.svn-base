<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit"> 
<title>学员笔记管理</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<style>
	.content_bleft_t1{font-size: 18px;font-weight: 700;line-height: 25px; text-align:center;}
	.content_bix_wrp{padding: 40px 34px 30px;}
	.ke-container-default{ width:600px !important;}
	li { width: 100%; padding: 20px 0px; position: relative;cursor: pointer; }
	.bsoild{border-radius:3px; border:1px solid #C5C5C5; outline: none !important; font-size: 15px;padding:5px 10px; overflow: auto !important;}
</style>
<body>
<div>
<form target="hidframe"  method="post" action="<?php if(isset($value)){echo M_URL($this->AppName.'/Index','doedit',$value['id'],GP('')); }else{echo M_URL($this->AppName.'/Index','dodiscuss','',GP(''));} ?>"  id="myform">

    	<div style="background-color:white; width: 100%; border-radius: 10px;">
    		
        	<div class="content_bix_wrp" >
        		<div class="form-tip clearfix">
				    <div class="form-tip-blick"></div>
				    <div class="form-tip-word">创建笔记</div>
				</div>
        		<?php if(iscategory($this->wxid,$this->appid)){  ?>
        		<div class="form-row">
	              		<span class="name">所属<?php echo categoryName($this->wxid) ?></span>
	              			<?php echo $link->Linkage(1); ?>
	            </div>
	            <?php } ?>
	            <div class="form-row">
	              		<span class="name"><i class="required">*</i>笔记名称</span>
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
	              		<div class="form-limit" limit="500"> 
	              			<img  width='150px' height='125px' class="js_logoBox block defaultpic" src="<?php if(!empty($value)){echo Img($value['img']);}else{ echo nopic(1);} ?>">
	              			<a href=javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'}); class="selectImageBtn">
	              				<span class="js_uploadText">上传图片</span>
	              				<input type="hidden" name="defaultpic" value="<?php if(!empty($value)){echo $value['img'];}?>">
              				</a>
	              		</div>
	            </div>
			    <div id="ksBoxFooter clearfix" style="position: absolute;left: 50%; bottom: 30px; margin-left: -80px;">
					<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr30"><?php if(!empty($value)){echo "确认修改";}else{echo "确认添加";} ?></button>
				    <a href="javascript:top.closePopup('all');" class="ks-bt bt-def">取消</a>
				</div>
       	 	</div>
    	</div>
    

 </form>   
	
	

<div class="footer"></div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    function do_reg()
{

	var problem = $("textarea[name='describe']").val();
	var categoryid = $("select[name='categoryid']").val();
    var reg  =/^([1-9]\d*|[0]{1,1})$/;

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