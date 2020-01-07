<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php if(!isset($values)){echo '添加应用';}else{echo '修改应用';} ?></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="sss">
	<span></span>
    <ul><LI><DIV class="WWW"></DIV></LI></ul>
</div>
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title clearfix"> 
        <h3 class="fl other">&nbsp;&nbsp;<span class="mr20">新增应用</span>
        </h3>
        <div class="fr">
			<a href="javascript:history.go(-1);" class="bt-back fr" type="button">
            	<i class="iconfont icon-fanhui"></i>返回
            </a>
        </div>
    </div>
</div>

<div class="wrapper mt10"><br /><br />
    <div class="row">
            <div class="ibox float-e-margins">
                <form target="hidframe"  class="form-horizontal" action="<?php if(!isset($values)){echo M_URL('Setting','doaddtask');}else{echo M_URL('Setting','doedittask',$values['id']);} ?>" method="post" enctype="multipart/form-data">
                    <div class="tabs-container">
                      
                        <div class="tab-content">
                            <div  class="tab-pane active">
                                <div class="panel-body">
                                   
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">任务名称</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="title" <?php if(isset($values))echo "value='$values[title]'";  ?> >
                                            <em class="need">*</em>
                                        </div>
                                     
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">每日可获次数</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="num" <?php if(isset($values))echo "value='$values[num]'";  ?>>
                                            <em class="need">*</em>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">奖励(元)[最低0.01]</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="money" <?php if(isset($values))echo "value='$values[money]'";  ?>>
                                             <em class="need">*</em>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">任务完成需要达到多少进度</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="quantity" <?php if(isset($values))echo "value='$values[quantity]'";  ?>>
                                             <em class="need">*</em>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label">单位类型</label>
                                        <div class="col-sm-4">
                                            <select name="type" class="form-control">
                                                <option value="1" <?php if(isset($values) && $values['type'] ==1)echo "selected";  ?>>人</option>
                                                <option value="2" <?php if(isset($values) && $values['type'] ==2)echo "selected";  ?>>数量</option>
                                                <option value="3" <?php if(isset($values) && $values['type'] ==3)echo "selected";  ?>>元</option>
                                            </select>
                                            <em class="need">*</em>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">相关文档链接</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="url" <?php if(isset($values))echo "value='$values[url]'";  ?>>
                                             <!-- <em class="need">*</em> -->
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                   <!--  <div class="form-group">
                                        <label class="col-sm-2 control-label">分享的链接</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="qurl" <?php if(isset($values))echo "value='$values[qurl]'";  ?>>
                                             <em class="need">*</em>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div> -->
                                    
                                </div>
                            </div>
                        </div>
                        <div class="footer-page " style="height: 60px;">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3 mt10">
                                <button type="submit" class="btn btn-default btn-s-md" ><?php if(!isset($values)){echo '确定添加';}else{echo '确定修改';} ?></button>
                                <a href="javascript:history.go(-1);" class="btn bt-gray btn-s-md">取消修改</a>
                            </div>
                        </div>
                        </div>
                </form>
            </div>
      
    </div>
    
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    $(function(){
        taps();//选项卡
        uploadView('100','100');//图片上传	
        datatime('#test');//时间选择器
        radioTaps();
        loadScorllJs();
        showtable();
        //判断是否选中	
        //$("input[name='isweb']").reset();	
    });
    function showtable(){
    	 var v=$("input[name='istable']:checked").val();
    	if (v== "1") {
            jQuery("#showaddtable").show();
        } else {
            jQuery("#showaddtable").hide();
        }

    }
    function taps(){
    $('#tablist li').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        $('.tab-content>.tab-pane:eq('+$(this).index()+')').show().siblings().hide();
    })
}
</script>

</body>

</html>
