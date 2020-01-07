<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title><?php if(!isset($users)){echo '添加分类';}else{echo '修改分类';} ?></title>
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	.Created-Content .uploads {width: auto;}
</style>
</head>
<body class="gray-bg"> 
<div class="wrapper wrapper-content mt40 animated fadeInRight">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">直播互动工具/添加直播工具</h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
            <button  class="bt-back  fr" type="button" onclick="history.back()">
            	<i class="iconfont icon-fanhui"></i>返回
            </button> 
			<!--搜索--> 
			</div> 
        </div>
    </div>
</div>

<br /><br />
    <div class="row bg-white p15">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form id="myform" action="<?php if(isset($values)){echo M_URL('Setting','doedit',$values['id'],GP('')); }else{echo M_URL('Setting','doAdd','',GP(''));} ?>" method="post" >

                        <div class="form-group clearfix">
                            <label class="col-sm-1 ">名称</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"  name="title" <?php if(isset($values))echo "value='$values[title]'";  ?>>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group clearfix">
                            <label class="col-sm-1 ">上传图片</label>

                            <div class="col-sm-4">
                               <div class="Created-Content clearfix">
								<button type="button" href="javascript:void(0);"  onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-ico',true));?>','930px','610px',{title:'选择图片',type:'top'})" class="ks-bt btn-tool">上传图片</button>
								<div class="uploads">
									<img src="<?php if(isset($values)){echo Img($values['pic']);} ?>" alt="" class="ico">
									<input type="hidden" name="ico" flag='封面' value="<?php if(isset($values)){echo $values['pic'];} ?>">
									<div class="Marks">
										<p>大小300*300以上</p>
									</div>
								</div>
							</div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                      <div class="form-group clearfix">
                                <label class="col-sm-1">是否开启：</label>
                                <div class="col-sm-4">
                                    <div class="radio radio-info radio-inline label-on">
                                        <input name="isenable" id="mbings3" type="radio" value="1" <?php if(isset($values))if($values['isenable']==1){echo 'checked';} ?>><label for="mbings3"> 是 </label>
                                    </div>
                                    <div class="radio radio-info  radio-inline">
                                        <input name="isenable" id="mbings4" type="radio" value="0" <?php if(isset($values)){if($values['isenable']==0){echo 'checked';}}else{echo 'checked'; } ?> ><label for="mbings4"> 否 </label>
                                    </div>
                                </div>
                            </div>
                        <div class="hr-line-dashed"></div>
                        <div class="footer-page">
                        <div class="col-sm-5"></div>
                            <div class="col-sm-3 mt3">
                                <button class="btn btn-default btn-s-md mt10" type="button" onClick="do_reg()"><?php if(!isset($values)){echo '确定添加';}else{echo '确定修改';} ?></button>
                                <a href="javascript:history.go(-1);" class="btn bt-gray btn-s-md mt10">取消修改</a>
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
loadScorllJs();

function do_reg(){
	
	var title = $("input[name='title']").val();

    if(title==''){
		Alert('名称不能为空');
		return false;	
    }
   
	$("#myform").submit();
}
</script>
</body>
</html>