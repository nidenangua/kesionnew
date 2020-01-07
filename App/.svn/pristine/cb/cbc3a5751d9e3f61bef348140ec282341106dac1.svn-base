<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	.form-horizontal .control-label {text-align: right;margin-right: 0;padding-top: 7px;}
	.col-sm-2{width:8%}
	.js_showBox{margin-left: 0;border-radius: 0;}
</style>
</head>
<body class="ks-wrap" style="background: none;">

<div id="ksBoxHead" class="clearfix">
		<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			<!--标题-->
			<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>网站设置</a><span>/</span><a href="<?php echo M_URL('pay/Index','','',GP('appid-19'));?>">收款设置</a><span>/</span>编辑支付平台</p>
			<!--标题-->
			</div>
		</div>
</div>
<div class="mt20 bRadius10" id="ksBoxContent">
    <div class="row">
        <div class="tabs-container ">
            <div class="tab-content">
                <div class="tap-pane" style="display: block">
                  <div class="panel-body pt20">
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','doeditPay',$id,GP('')) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                       <div class="Created-largetTitle">
							<span>1</span>
							<div class="Created-title">  
								<span>平台信息</span>
							</div>
						</div>
                        <div class="form-group">
	                        <label class="col-sm-2 control-label">支付平台名称：</label>
	                        <div class="col-sm-3">
	                            <input type="text" class="form-control" readonly="readonly" name="payname" value="<?php if(isset($payconf)){echo $payconf['payname'];} ?>">
	                        </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
						<label class="col-sm-2 control-label">支付平台Logo：</label>
						<div class="col-sm-4">
						  <div class="control-group js_uploadBox">
								<div class="btn-upload clearfix">
									<!--<a href="javascript:void(0);" class="selectImageBtn c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>-->
									<span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
									<input class="hide js_upFile" type="file" name="file" id="upImg">
								</div>
								<div class="js_showBox mt10 w180"><img class="js_logoBox block" onerror="this.src='<?php echo nopic(1);?>'" src="<?php if(isset($payconf)){echo Img($payconf['defaultpic']);}else{echo UOOT.'Public/uploads/common/timg.jpg';} ?>" width="180" >
								</div>
						 </div>
								</div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">备注说明：</label>
                            <div class="col-sm-3">
                               <textarea rows="3" cols="20" readonly="readonly" name="intro" style="width: 374px;height: 86px;"><?php if(isset($payconf)){echo $payconf['intro'];} ?></textarea>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="Created-largetTitle">
							<span>2</span>
							<div class="Created-title">  
								<span>支付参数配置</span>
							</div>
						</div>
                        <div class="form-group">
                        <div class="col-sm-6">
                        <?php $PArr = explode('$$$',$payconf['content']);foreach($PArr as $k=>$v){ ?>
                         <div class="form-group">
                            <label class="col-sm-3 control-label"><?php $TArr = explode('|$|',$v);if(isset($payconf)){echo $TArr[0];} ?>：</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="contents[]" value="<?php if(isset($payconf)){echo $TArr[1];} ?>">
                                <?php if(isset($payconf)){echo $TArr[2];} ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">同步回调路径(return_back)：</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="contents[]" value="http://store.kesion.com/Plus/KsPay/alipay/return_url.php" readonly="readonly">
                                如：http://www.kesion.com/Plus/KsPay/alipay/return_url.php                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">异步回调路径(notify_back)：</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="contents[]" value="http://store.kesion.com/Plus/KsPay/alipay/notify_url.php" readonly="readonly">
                                如：http://www.kesion.com/Plus/KsPay/alipay/notify_url.php                            </div>
                        </div>	
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
                        <div class="Created-largetTitle">
							<span>3</span>
							<div class="Created-title"><span>其他设置</span></div>
						</div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手续费率：</label>
                            <div class="col-sm-1" style="width: 12%;">
                                <input type="text" class="form-control" name="counter" value="<?php if(isset($payconf)){echo $payconf['counter'];} ?>">
                                手续费由付款人额外支付
                            </div>%
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否启用：</label>
                            <div class="col-sm-4 mt7">
                                <div class="radio radio-info mr20 radio-inline">
                                    <input type="radio" id="status1" value="1" name="status" <?php if(isset($payconf)){if($payconf['status']==1){echo 'checked';}}else{echo 'checked';} ?>>
                                    <label for="status1">启用</label>
                                </div>
                                <div class="radio radio-info mr20 radio-inline">
                                    <input type="radio" id="status2" value="0" name="status" <?php if(isset($payconf)){if($payconf['status']==0){echo 'checked';}} ?>>
                                    <label for="status2">不启用</label>
                                </div>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">显示平台:</label>
                            <div class="col-sm-6 mt7">
                                <div class="checkbox checkbox-info checkbox-inline">
                                    <input id="shortcut" type="checkbox" value="1"  <?php if(isset($app)){if($app['shortcut']==1){echo "checked";} } ?> name="shortcut">
                                    <label for="shortcut">
                                       PC端
                                    </label>
                                </div>
                                <div class="checkbox checkbox-info checkbox-inline">
                                    <input id="isweb" type="checkbox" value="1" <?php if(isset($app)){if($app['isweb']==1){echo "checked";} } ?> name="isweb">
                                    <label for="isweb">
                                       手机端
                                    </label>
                                </div>
                                <div class="checkbox checkbox-info checkbox-inline">
                                    <input id="isrec" type="checkbox" value="1"  <?php if(isset($app)){if($app['isrec']==1){echo "checked";} } ?> name="isrec">
                                    <label for="isrec">
                                       微信端
                                    </label>
                                </div>
                                <div class="checkbox checkbox-info checkbox-inline">
                                    <input id="MustChoose" type="checkbox" value="1" <?php if(isset($app)){if($app['MustChoose']==1){echo "checked";} } ?> name="MustChoose">
                                    <label for="MustChoose">
                                       APP端
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                     
                </div>
            </div>

        </div>
    </div>


</div>
</div>


	
	<div id="ksBoxFooter" class="ks-bom clearfix" style="height: 80px;">
	
	<div class="fl">
	    <label class="mr20 fl" style="text-align: center;">
	    	<button class="ks-bt bt-pue mr20"  type="submit">确定添加</button>
			<button href="<?php echo M_URL($this->AppName.'/Index','setting','',GP('')); ?>" class="ks-bt bt-pue">取消</button>
	</div>
	
</div>
    </form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
 $(function(){

	 uploadView('100','100');
	 })
</script>
</body>
</html>