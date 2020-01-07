<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper mt40" id="scorll">
   <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div id="manage_top" class="menu_top_fixed">
                    <div class="ibox-title">
                  
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0"><i class="reflash"></i></a>
                    </div>
                    </div>
                </div>          
                <div class="ibox-content ">
<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php if(!empty($value))
{echo M_URL('home/Capital','doWithdraw',$value['id'],GP('p-'.$now_page));}?>" enctype="multipart/form-data">
                <div class="tabs-container pt0" style="text-align: center;">
          			<div class="js_showBox"><a href="<?php if(!empty($value["defaultpic"])){echo $value["defaultpic"];}?>" target="_blank"><img class="js_logoBox block defaultpic" onerror="this.src='<?php echo nopic();?>'" src="<?php if(!empty($value["defaultpic"])){echo $value["defaultpic"];}?>" ></a></div>
	                <div class="btn-upload mt20 clearfix">
	                    <a href="javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn c-89 fsize14  mr10 bRadius5"><span class="js_uploadText" >上传凭证</span></a>
	                    <p>限制：2MB,支持jpg|png|gif</p> 
	                     <input type="hidden" name="defaultpic">
	               </div>
                   <div class="footer-page ">
                       
                     <div class="mt10">
                            <button type="button" onClick="do_reg();" class="btn btn-default btn-s-md" >确认</button>
                            <a class="btn bt-gray  btn-s-md" onclick="top.closePopup('all');" >取消</a>
                     </div>
                    </div>
                </div>
</form>
                </div>
            </div>
        </div>
   </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
top.imgUploadBack = function(src){
	$('.defaultpic')[0].src = src;
	$('input[name="defaultpic"]')[0].value = src;
};
</script>
<script>
function do_reg(){
	$("#myform").submit();	
}
</script>
</body>
</html>


















