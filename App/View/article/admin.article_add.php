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
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	.new-form{width: 65%;}
	.form-group .col-sm-4{
        
         
    }
    .col-sm-6{
        width: 74%;
    }
    #edui1_iframeholder{
        height: 533px!important;
    }
</style>
	

</head>
<body class="gray-bg">
<div class="wrapper " id="scorll" style="margin-top: 70px;">
   <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div id="manage_top" class="menu_top_fixed height73 p15">
                    <div class="ibox-title">
                    <h3 class="fl pl20 ">添加新闻
                    <ul id="tablist" class="ml15">
                    		  <?php echo $this->Field->getTab($this->appid,'app','admin');?>
                    	</ul>
                  
                    </h3>
                
                
              
			        <div class="fr mt7 mr20">
						<a href="javascript:history.go(-1);" class="bt-back fr" type="button">
			            	<i class="iconfont icon-fanhui"></i>返回
			            </a>
			        </div>
                    </div>
                </div>          
                <div class="ibox-content ">
<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php if(!empty($value))
{echo M_URL($this->AppName.'/Index','doEditArticle',$value['id'],GP('p-'.$now_page));}
else{echo M_URL($this->AppName.'/Index','doaddArticle','',GP(''));}?>" enctype="multipart/form-data">
                <div class="tabs-container pt0">
                    <ul class="nav nav-tabs">
                        <!----------------- 自定义字段添加后插入选项卡---------------->
                     
                    </ul>
                    <div class="tab-content">
                        <!----------------- 自定义字段添加后插入---------------->
                        <?php echo $this->Field->getF($this->appid,'app','admin',$value,'');?>
                    </div>
                    <div class="footer-page mt3">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-3">
                            <button type="button" onClick="do_reg();" class="btn mt10 btn-default" >确认</button>
                            <a class="btn mt10  bt-gray" href="javascript:history.go(-1);" >取消</a>
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
$(".form-group .col-sm-4").eq(4).css('width','74%');//修改新闻内容的富文本样式

$(function(){
	datatime('#test');//时间
	loadScorllJs();//滚轮
	uploadView(100,100);//上传图片
	taps();
})
</script>
<script>
function do_reg(){
	<?php echo $this->Field->getJS($this->appid,'app');?>
	$("#myform").submit();	
}
</script>
</body>
</html>


















