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
#datatime{-webkit-appearance:none;background-color:#fff;background-image:none;border-radius:4px;border:1px solid #dcdfe6;box-sizing:border-box;color:#606266;display:inline-block;font-size:inherit;height:35px;
line-height:35px;outline:none;padding:0 15px;transition:border-color .2s cubic-bezier(.645,.045,.355,1);width:100%}
.addCorrelationBtn{
    width: 138px;height: 34px;line-height: 34px;border-radius: 2px;border: 1px dashed #2a75ed;font-size: 14px;text-align: center;color: #2a75ed;margin-bottom: 20px;margin-left: 25px;cursor: pointer;display: -ms-flexbox;display: flex;-ms-flex-align: center;align-items: center;-ms-flex-pack: center;justify-content: center;
}
.pricebox{margin-top:20px;}
.pricebox .item{font-size:14px; color:#999; margin-top:10px;}
.pricebox input{background: #fff;margin:0 10px;}
.correlationItem {
    width: 707px;
    height: 80px;
    padding: 10px;
    position: relative;
}
.itemImageWrapper {
    width: 80px;
    height: 60px;
    border-radius: 2px;
    margin-right: 10px;
    float: left;
}
.itemImageWrapper {
    width: 80px;
    height: 60px;
    border-radius: 2px;
    margin-right: 10px;
    float: left;
}
.infoWrapper {
    width: 410px;
    height: 60px;
    float: left;
}
.infoTitle {
    height: 45px;
    line-height: 1.5;
    font-size: 14px;
    text-align: left;
    color: #353535;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
}
.infoPrice {
    font-size: 14px;
    line-height: 1.17;
    text-align: left;
    color: #fb6161;
}
.itemIconBtn {
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -29px;
    margin-right: 20px;
    width: 90px;
    height: 36px;
    line-height: 36px;
    cursor: pointer;
    text-align: center;
    border-radius: 2px;
    background-color: #fff;
    border: solid 1px #e5e7eb;
    color: #666;
    font-size: 14px;
}
.itemIconBtn {
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -27px;
    margin-right: 20px;
    width: 90px;
    height: 36px;
    line-height: 36px;
    cursor: pointer;
    text-align: center;
    border-radius: 2px;
    background-color: #fff;
    border: solid 1px #e5e7eb;
    color: #666;
    font-size: 14px;
}
.itemImageWrapper img {
    width: 80px;
    height: 60px;
}
.infoType {
    float: left;
    color: #666;
    height: 60px;
    line-height: 60px;
    font-size: 14px;
    margin-left: -59px;
    text-align: center;
    width: 32px;
}
</style>
</head>
<body class="ks-wrap">
<form target="hidframe" method="post" class="form-horizontal" action="<?php if(!empty($value)){echo M_URL($this->AppName.'/Index','doedit',$value['id'],GP('p-'.$now_page));}else{echo M_URL($this->AppName.'/Index','doadd','',GP(''));}?>" enctype="multipart/form-data" style="margin-left: 0;">
 
 	<div class="ks-wbox bRadius10">
 		<div class="ks-head-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">资料管理</a><em>/</em><?php if(empty($value)){?>添加资料<?php }else{?>编辑资料<?php }?>
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
                    <span class="name name-nowrap">资料标题<i class="form-star">*</i></span>
                    <input type="text" class="form-textbox"  name="title" value="<?php echo !empty($value)?$value['title']:'';?>"/>
                </div>
            </div>
<!--            <div class="form-row">-->
<!--                <span class="name">添加时间</span>-->
<!--                <input id="datatime" type="text" value="--><?php //if(!empty($value)){if($value["create_time"])echo date('Y-m-d H:i:s',$value["create_time"]); }?><!--" name="create_time" required readonly class="w200  laydate-icon">-->
<!--            </div>-->
            <div class="form-row" >
                <span class="name name-nowrap">资料封面<i class="form-star">*</i></span>
                <div class="form-upimg">

                    <div class="defaultpic images" style="background-image:url('<?php if(!empty($value["defaultpic"])){echo Img($value["defaultpic"]);}else{ echo nopic(0);} ?>');"></div>
                    <div class="clearfix">
                        <div class="ks-bt bt-pur" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic,type-other'));?>','1000px','640px',{title:'选择图片',type:'top'});">上传图片</div>
                    </div>
                    <input type="hidden" name="defaultpic" value="<?php if(!empty($value["defaultpic"])){echo Img($value["defaultpic"]);}else{ echo '';} ?>">
                    <div class="form-tips pt20">建议尺寸750*525px，JPG、PNG格式， 图片小于1M。</div>
                </div>
            </div>

            <div class="clearfix pt10" id="singleKeshi" >
                <div class="form-tips pt10">上传资料</div>

                <div class="ks-heade-button ks-head-primary" style="margin-top: 5px;" onclick="top.KTJ_UploadVideoFile(function(fileName,fileId){
												 vod(fileName,fileId)
											 })">本地上传</div>

                <div class="ks-bt bt-pur fn" style="margin:5px 0 0 5px" onclick="addTypeChange('/home.html#/getVodList?from=popup','850px','600px',{
												title:'选择视频',
												data:function(name,src){
													vod(name,src);
												}
											});">选择已有文件</div>
                <div class="item audiomodul">
                    <h4 class="info" id="file_Name"><?php if(isset($vdo)){echo $vdo['vdoName'];} ?><?php if(isset($vdo)){?><?php if(isset($chapter)&&!empty($chapter["videoId"])){?>__<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','viewplay',$this->courseid,GP("videoId-".$chapter["videoId"]))?>','800px','630px',{title:'预览',type:'top'});">点击预览</a><?php }}?></h4>
                </div>
            </div>
            <div class="form-row clearfix">
                <span class="name name-nowrap">资料价格</span>
                <label class="radioLabel fl">
                    <input onclick="isFree(this)" type="radio" class="label-on"  class="radioInput" value="0" name="chargetype" <?php if(!empty($value)){if($value["chargetype"]==0)echo "checked"; }else{echo 'checked';}?>>免费
                </label>
                <label class="radioLabel fl">
                    <input onclick="isFree(this)" type="radio" class="radioInput" value="1" name="chargetype" <?php if(!empty($value)){if($value["chargetype"]==1)echo "checked"; }?>>收费
                </label>
                <div class="clearfix"></div>
                <div class="pricebox" id="pricebox" style="<?php if(empty($value)||$value["chargetype"]!=1){echo 'display: none;';}?>margin-top: 7px;">
                    <div class="item">
                        <span>售卖价格</span><input type="text" name="price" class="form-textbox w180 price_box" placeholder="请输入价格" value="<?php if(isset($value["price"])){ echo $value["price"]; }?>"  /> 元
                    </div>
                </div>
            </div>
            <div class="form-row clearfix">
                <span class="name name-nowrap">发布状态</span>
                <div class="form-switch" open-value="1">
                    <label for="isshow0" class="<?php echo empty($value)||$value['isopen']==1?'label-on':'';?>"><input type="radio" value="1" name="isopen" <?php echo empty($value)||$value['isopen']==1?'checked':'';?>>开启</label>
                    <label for="isshow1" class="<?php echo !empty($value)&&$value['isopen']==0?'label-on':'';?>"><input type="radio" value="0" name="isopen" <?php echo !empty($value)&&$value['isopen']==0?'checked':'';?>>关闭</label>
                </div>
            </div>





        </div>
        <div class="form-footer clearfix">
			<span class="d-inline-block">
				<input type="submit" class="ks-bt bt-pue" value="<?php if(empty($value)){?>确认添加<?php }else{?>确认编辑<?php }?>" name="confirm">
		        <button onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>
	    	</span>
        </div>

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
//        laydate.render({
//            elem: '#datatime'
//            ,type:'datetime'
//        });
    })
    //接收图片返回值
    top.imgUploadBack = function(src,img){
        $('.defaultpic').css('background-image','url('+src+')');
        $('input[name="defaultpic"]')[0].value = img;
    };
    
    function groupCourse(target){
        var state = $(target).prop('checked')
        state == true ?   $('#gropu-shop').show() : $('#gropu-shop').hide() 
    }
        
   
    function selectZl(){

        addTypeChange('<?php echo M_URL('team/Index','getColumnList','',GP(''));?>,columnid-1','1000px','650px',{title:'添加商品',type:'top'});
    }
    function del(target) {
        $(target).closest('.form-row').remove();
    }
   
    function isFree(el){
        document.getElementById('pricebox').style.display = el.value == 1 ? 'block' : 'none'
//        document.getElementById('costlevel').style.display = el.value == 1 ? 'block' : 'none'
//        document.getElementById('discount').style.display = el.value == 1 ? 'block' : 'none'
//        document.getElementById('other').style.display = el.value == 1 ? 'block' : 'none'
    }

	</script>
</body>
</html>
