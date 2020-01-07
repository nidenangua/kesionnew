<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
.configTab{display: none;}
#content{height: auto;}
.form-upload-box{padding-right: 200px;padding-left: 0;}
.form-textbox{width:40%}
.form-title{font-size: 14px;line-height: 28px;color: #ababab;}
input[type="checkbox"],input[type="radio"] {
	position: relative;top: -3px;
}
#datatime{-webkit-appearance:none;background-color:#fff;background-image:none;border-radius:4px;border:1px solid #dcdfe6;box-sizing:border-box;color:#606266;display:inline-block;font-size:inherit;height:35px;
line-height:35px;outline:none;padding:0 15px;transition:border-color .2s cubic-bezier(.645,.045,.355,1);width:100%}
</style>
</head>
<body class="ks-wrap">
<form target="hidframe" method="post" class="form-horizontal" action="<?php if(!empty($value)){echo M_URL($this->AppName.'/Index','doEditTeam',$value['id'],GP('p-'.$now_page));}else{echo M_URL($this->AppName.'/Index','doaddTeam','',GP(''));}?>" enctype="multipart/form-data" style="margin-left: 0;">
 
 	<div class="ks-wbox bRadius10">
 		<div class="ks-head-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">话题列表</a><em>/</em><?php if(empty($value)){?>添加小组<?php }else{?>话题详情<?php }?>
			<!--标题-->
		</div>
		
		<div class="ks-head-tab">
 			<ul class="clearfix">
<!--		       --><?php //echo $this->Field->getTab($this->appid,'app','home');?>
		    </ul>
     	</div>
		 <!----------------- 自定义字段添加后插入---------------->
		<div class="content">
            <div class="form-row clearfix" >
                <div class="form-limit" limit="50">
                    <span class="name name-nowrap">标题</span>
                    <input type="text" class="form-textbox"  name="title" value="<?php echo !empty($value)?$value['title']:'';?>"/>
                </div>
            </div>
            <div class="form-row">
                <span class="name">添加时间</span>
                <input id="datatime" type="text" value="<?php if(!empty($value)){if($value["create_time"])echo date('Y-m-d H:i:s',$value["create_time"]); }?>" name="create_time" required readonly class="w200  laydate-icon">
            </div>

            <div class="form-row clearfix" >
                <div class="form-limit" limit="225">
                    <span class="name name-nowrap">内容详情</span>
                    <textarea type="text" class="form-textarea" rows="3" name="description" ><?php if(!empty($value)){if($value["content"])echo $value["content"]; }?></textarea>
                </div>
            </div>

            <div class="myform-right">
                <div class="form-upload">
                    <div class="js_uploadBox">
                        <div class="js_showBox"><img class="js_logoBox block avatar" src="<?php  echo nopic(0); ?>" style="width: 200px; height: 150px;"></div>
                        <div class="btn-upload clearfix">
                            <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-avatar',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
                            <p>限制：2MB,支持jpg|png|gif</p>
                            <input type="hidden" name="avatar">
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!--
        <div class="form-footer clearfix">
			<span class="d-inline-block">
				<input type="submit" class="ks-bt bt-pue" value="<?php if(empty($value)){?>确认添加<?php }else{?>确认编辑<?php }?>" name="confirm">
		        <button onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>
	    	</span>
        </div>
        -->
	</div>



</form>



<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll','laydate','uploadView','validate'],function(){
		 loadScorllJs();
		 $('.form-textbox').parents('.form-limit').css('width','40%')
		 $('.form-textbox').css('width','100%')
		 $('.form-upload .name ').addClass('form-title');
		 // uploadView(270,180);//上传图片

        $('.ks-head-tab li').click(function(){
            $(this).addClass('curr').siblings().removeClass('curr');
            $('.configTab:eq('+$(this).index()+')').show().siblings().hide();
        });
        $(".configTab").each(function(){
            var i= 0;
            $(this).find(".form-upload").each(function(){
                var top = 320 * i+60;
                if(top==0){top=60;}
                $(this).css("top",top);
                i++;

            })
        });
        $('.bt-pue').click(function () {
            $('.form-horizontal').submit();
        });
        laydate.render({
            elem: '#datatime'
            ,type:'datetime'
        });
    })


	</script>
</body>
</html>
