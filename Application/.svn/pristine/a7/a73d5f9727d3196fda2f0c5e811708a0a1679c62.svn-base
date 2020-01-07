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
  	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
  	<style>
  		.col-sm-7 {line-height: 30px;}
  	</style>
</head>
<body class="gray-bg" >
<div class="wrapper"  style="margin-top: 85px;">
    <div class="row">
     <div id="manage_top" class="menu_top_fixed height73 p15">
            <div class="ibox-title">
                <h3 class="fl ml15">修改支付平台</h3>
               <div class="ibox-tools" > 
                       	<button class="ks-bt" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
                </div>
              
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tabs-container ">
        
            <div class="tab-content">
                <div class="tap-pane" style="display: block">
                  <div class="panel-body pt20">
                      <form target="hidframe" action="<?php echo M_URL('Setting','saveEditPay',$id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">支付平台名称：</label>
                              <div class="col-sm-3">
                                  <input type="text" class="form-control" name="payname" value="<?php if(isset($payconf)){echo $payconf['payname'];} ?>" />
                              </div>
                          </div>
                          <div class="line line-dashed b-b line-lg pull-in"></div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">支付平台Logo：</label>
                              <div class="col-sm-4">
                                  <div class="control-group js_uploadBox">
                                      <div class="btn-upload clearfix">
                                          <a href="javascript:void(0);" class="selectImageBtn c-89 fsize14 fl mr10 bRadius5">
                                              <span class="js_uploadText">上传</span>图片
                                          </a>
                                          <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                                          <input class="hide js_upFile" type="file" name="file" id="upImg" />
                                      </div>

                                      <div class="js_showBox mt10 w180" style="height: auto;">
                                          <img class="js_logoBox block" src="<?php if(isset($payconf)){echo Img($payconf['defaultpic']);}else{echo nopic(1);} ?>" width="180" style="width: auto!important;height: auto!important;" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="line line-dashed b-b line-lg pull-in"></div>
                          <div class="form-group">

                              <label class="col-sm-2 control-label">备注说明：</label>
                              <div class="col-sm-3">
                                  <textarea class="form-control" rows="3" cols="20" name="intro" style="width: 374px;height: 86px;">
                                      <?php if(isset($payconf)){echo $payconf['intro'];} ?>
                                  </textarea>
                              </div>
                          </div>
                          <div class="line line-dashed b-b line-lg pull-in"></div>
                          <div class="form-group">
                              <div class="col-sm-2">支付参数配置：</div>
                          </div>
                          <div class="form-group">

                              <div class="col-sm-6">
                                  <?php
                                  $PArr = explode('$$$',$payconf['content']);
                                  foreach($PArr as $k=>$v){ ?>
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">
                                          <?php $TArr = explode('|$|',$v);if(isset($payconf)){echo $TArr[0];} ?>：
                                      </label>
                                      <div class="col-sm-7">
                                          <input type="text" class="form-control" name="contents[]" value="<?php if(isset($payconf)){echo $TArr[1];} ?>" />
                                          <?php if(isset($payconf)){echo $TArr[2];} ?>
                                      </div>
                                  </div>
                                  <?php } ?>
                              </div>
                          </div>
                          <!--<div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商户RSA私钥：</label>
                            <div class="col-sm-4">
                               <textarea rows="3" cols="20" style="width: 374px;height: 86px;"></textarea>
                                <br/>说明：<br/>
                                1、启用APP支付功能时必须填写；<br/> 
                                2、PKCS8格式（参数需转换为一行，不能包含空格），<a href="https://cshall.alipay.com/enterprise/help_detail.htm?help_id=474010&amp;keyword=%C8%E7%BA%CE%C9%FA%B3%C9RSA%C3%DC%D4%BF&amp;sToken=&amp;from=search" target="_blank">如何生成RSA密钥</a>
                            </div>
                        </div>-->
                          <div class="line line-dashed b-b line-lg pull-in"></div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">手续费率：</label>
                              <div class="col-sm-2">
                                  <input type="text" class="form-control" name="counter" value="<?php if(isset($payconf)){echo $payconf['counter'];} ?>" />
                                  手续费由付款人额外支付
                              </div>%
                          </div>
                          <div class="line line-dashed b-b line-lg pull-in"></div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">是否启用：</label>
                              <div class="col-sm-4 mt7">
                                  <div class="radio radio-info mr20 radio-inline">
                                      <input type="radio" id="status1" value="1" name="status" <?php if(isset($payconf)){if($payconf['status']==1){echo 'checked';}}else{echo 'checked';} ?> />
                                      <label for="status1">启用</label>
                                  </div>
                                  <div class="radio radio-info mr20 radio-inline">
                                      <input type="radio" id="status2" value="0" name="status" <?php if(isset($payconf)){if($payconf['status']==0){echo 'checked';}} ?> />
                                      <label for="status2">不启用</label>
                                  </div>
                              </div>
                          </div>
                          <div class="line line-dashed b-b line-lg pull-in"></div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">显示平台:</label>
                              <div class="col-sm-6 mt7">
                                  <div class="checkbox checkbox-info checkbox-inline">
                                      <input id="shortcut" type="checkbox" value="1" <?php if(isset($app)){if($app['shortcut']==1){echo "checked";} } ?> name="shortcut" />
                                      <label for="shortcut">
                                          PC端
                                      </label>
                                  </div>
                                  <div class="checkbox checkbox-info checkbox-inline">
                                      <input id="isweb" type="checkbox" value="1" <?php if(isset($app)){if($app['isweb']==1){echo "checked";} } ?> name="isweb" />
                                      <label for="isweb">
                                          手机端
                                      </label>
                                  </div>
                                  <div class="checkbox checkbox-info checkbox-inline">
                                      <input id="isrec" type="checkbox" value="1" <?php if(isset($app)){if($app['isrec']==1){echo "checked";} } ?> name="isrec" />
                                      <label for="isrec">
                                          微信端
                                      </label>
                                  </div>
                                  <div class="checkbox checkbox-info checkbox-inline">
                                      <input id="MustChoose" type="checkbox" value="1" <?php if(isset($app)){if($app['MustChoose']==1){echo "checked";} } ?> name="MustChoose" />
                                      <label for="MustChoose">
                                          APP端
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="line line-dashed b-b line-lg pull-in"></div>
                          <div class="footer-page">
                              <div class="col-sm-5"></div>
                              <div class="col-sm-3 mt10">
                                  <button class="btn btn-primary btn-s-md" type="submit">确定添加</button>
                                  <a href="<?php echo M_URL('Setting','paySetting'); ?>" class="btn bt-gray btn-s-md">取消</a>
                              </div>
                          </div>
                      </form>
                </div>
            </div>

        </div>
    </div>


</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
 $(function(){
	 loadScorllJs();
	 uploadView('100','100');
	 })
</script>
</body>
</html>