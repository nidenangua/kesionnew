<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>添加课堂</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
.AddCou-Touitle{width:100%; height:50px; border-bottom:1px solid #EBEBEB; line-height:50px; font-size:22px;}
.AddCou-const{width:100%; overflow:hidden; margin-top:10px;}
.AddCou-cous{padding-left:50px; padding-right:50px;}
.AddCou-list{width:50%; height:230px; float:left;  cursor:pointer;color:#bfbfbf;}
.AddCou-list:hover{color:#a6bbe8;}
#AddCouList{color:#476dbe;}
.AddCou-icon{width:100%; height:180px; overflow:hidden; text-align:center;}
.AddCou-title{ height:30px; font-size:20px; line-height:30px; text-align:center;}
.AddCou-rad{display:none;}
.AddCou-input{width:100%; height:40px; border:1px solid #e6dfdf;border-radius: 3px;}
.icSize{font-size:10em!important;}
</style>
</head>
<body>
<form target="hidframe" id="myform"  action="<?php echo M_URL('course/Index','doaddcourse','',GP('')) ?>"  method="post" class="form-horizontal">
<div class="AddCou-cous">
    <div  class="AddCou-const">
        <!--<?php if($setting[4] == 1){ ?>
        <div class="AddCou-list" id="AddCouList">
		<input type="radio"  class="AddCou-rad" id="click0" value="1" name="courseType" checked="checked">
		<span for="click0">
        	<div class="AddCou-icon" ><span  class="xiani"><i class="iconfont icon-dianbo icSize"></i></span></div>
            <div class="AddCou-title">点播</div>
		</span>
        </div>
        <?php } ?>
        <?php if($setting[3] == 1){ ?>
		<div class="AddCou-list" <?php if($setting[4] == 0){echo 'id="AddCouList"';}?>>
		<input type="radio" value="2" class="AddCou-rad" id="live0" name="courseType" <?php if($setting[4] == 0){echo 'checked="checked"';}?>>
		  	<span for="live0">
        		<div class="AddCou-icon" ><span  class="xiani"><i class="iconfont icon-zhibo icSize"></i></span></div>
            	<div class="AddCou-title">直播</div>
			</span>
        </div>
        <?php } ?>	-->
        <!--
         <?php if($setting[7] == 1){ ?>	
        <div class="AddCou-list">
		<input type="radio"  class="AddCou-rad" id="mace0" value="3" name="courseType">
		<span for="mace0">
        	<div class="AddCou-icon" ><span  class="xiani"><i class="iconfont icon-shangke icSize" ></i></span></div>
            <div class="AddCou-title">面授</div>
		</span>
        </div>	
        <?php } ?>
        <?php if($setting[5] == 1){ ?>
        <div class="AddCou-list">
		<input type="radio"  class="AddCou-rad" id="zhuhe0" value="4" name="courseType" />
		<span for="zhuhe0">
        	<div class="AddCou-icon" ><span  class="xiani">
        		<i class="iconfont icon-zuhetubiao icSize"  value="4"></i></span>
        	</div>
            <div class="AddCou-title">组合</div>
		</span>	
        </div>
        <?php } ?>
        -->
    </div>
    <input type="hidden" value="<?php echo $courseType;?>" name="courseType">
    <div>
    	<?php $title='';if($courseType==1){$title= '点播';}elseif($courseType==2){$title= '直播';}elseif($courseType==3){$title= '音频';}elseif($courseType==4){$title= '图文';}?>
    	<div class="form-limit mt30" limit="50" style="max-width: inherit;">
    	<input type="text" class="AddCou-input" name="title" placeholder="请输入<?php echo $title;?>名称" >
    	</div>
    </div>
    <div style="text-align: center; " class="mt30">
		<span style="display: inline-block;"><input class="ks-bt bt-pue bt-big"  type="button" onClick="do_reg()" value="马上创建"></span>
	</div>
</div>
</form>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage'],function(){
	$(".AddCou-list").click(function(){
		$(".AddCou-list").attr("id","");
		$(this).attr("id","AddCouList");
		$(this).find("input").prop("checked",true);
	});
	$('.AddCou-const').find('.label-on').removeClass('label-on')
});
function do_reg(){
	var title = $("input[name='title']").val();
	var num =/^[0-9]*$/;
    if(title==''){
		Alert('课程题目');
		return false;	
    }
	$("#myform").submit();	
}
</script>
</body>
</html>