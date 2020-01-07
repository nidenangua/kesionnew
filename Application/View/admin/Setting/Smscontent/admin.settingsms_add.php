<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="renderer" content="webkit">
  <title></title>
  <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
   <div id="manage_top" class="menu_top_fixed height73 p15">
					  <div class="ibox-title fl mr15 ml15">
                        <h3 class="fl">增加模块</h3>
                       
                    </div>
                    <div class="ibox-tools" >
                          	<button class="ks-bt" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
                    </div>
				
                </div><br /><br /><br /><br />
    <div class="row bg-white p15">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
               
                <div class="ibox-content">
                    <form target="hidframe"  action="<?php echo M_URL('Setting','doaddModel') ?>" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">模块名称（英文）：</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"   name="model" id="model" required >
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                             <label class="col-sm-2 control-label">模块名称：</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"   name="modelname" id="ModelName" required >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">内容：</label>

                            <div class="col-sm-4">
                                <textarea class="form-control" name="content"></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">每天最多发送数量：</label>

                            <div class="col-sm-1">
                                <input type="number" class="form-control"   name="smsnum" id="model0" required  >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                      <div class="footer-page">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-3 mt3">
                            <button class="btn btn-primary mt10 btn-s-md fl" type="submit">提交</button>
                            <button href="javascript:history.go(-1);" class="btn mt10 bt-gray btn-s-md fl">取消修改</button>
                        </div>
                        </div>
                </div>
                    </form>
                      
            </div>
        </div>
    </div>
</div>



<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>

</body>
</html>