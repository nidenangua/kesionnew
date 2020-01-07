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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	label{padding-top: 5px;}
</style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content mb40 mt55">
<form target="hidframe"  action="<?php echo M_URL('Setting','saveLoginConf') ?>" method="post" class="form-horizontal">
    <div class="row">
      <div id="manage_top" class="menu_top_fixed height73 p15">
        <div class="ibox-title">
            <h3 class="fl mr15">账号通API
            
           <ul id="tablist" class="ml15">
                <li class="active"><a href="<?php echo M_URL('Setting','Loginconf'); ?>">账号通API</a></li>
                <li class=""><a href="<?php echo M_URL('Setting','Loginconf'); ?>">社交营销配置</a></li>
            </ul>
            </h3>
          
              <div class="ibox-tools">
                 <!-- <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                    <i class="reflash"></i>
                  </a>-->
                  <button class="ks-bt bt-def" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
                 
              </div>
             
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tabs-container mt20">
           
            <div class="tab-content ">
                <div class="tab-pane" style="display: block">
                    <div class="panel-body" style="padding:20px;padding-bottom:10px;">
                   
                    	<div class="form-group clearfix" style="margin-bottom:10px">
                        <label class="control-label fl ">首次登入自动创建</label>
                        <div class="col-sm-4">
                                    <div class="radio radio-info radio-inline">
                                        <input name="loginState" id="inlineRadio1" value="1" <?php if($site["loginState"] == 1)echo  'checked="checked"' ?>  type="radio" ><label for="inlineRadio1"> 启用 </label>
                                    </div>
                                    <div class="radio radio-info  radio-inline">
                                        <input name="loginState" id="inlineRadio2" value="0" <?php if($site["loginState"] == 0)echo  'checked="checked"' ?>  type="radio" ><label for="inlineRadio2"> 不启用 </label>
                                    </div>
                        </div>
                        </div>
                       <div class="clearfix" style="margin-bottom:10px">
                       <label class=" fl control-label " style="padding-top:0">创建账户并登入</label>
                       <div class="col-sm-8">如果启用首次登录自动创建账号，将省去让用户绑定的环节，但会导致无法和会员原有的账号绑定通用，请慎用。（在部署时使用，后不能更改）</div>
                       </div><br/><br/>
                        <div class="form-group">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th >是否启用</th>
                                <th >接口名称</th>
                                <th >ApiID</th>
                                <th >ApiKey</th>
                                <th >登录成功返回的URL</th>
                                <th >申请</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($loginconf as $k=>$v){ ?>
							<tr>
                                   <input type="hidden" name="id[]" value="<?php echo $v['id'];?>"> 
							       <td><?php echo $v['loginname']?></td>
                                   <td>
                                        <div class="checkbox checkbox-info">
                                        <input id="checkbox<?php echo $v['id'];?>" type="checkbox" name="status[]" <?php if($v["status"]==1){echo " checked ";} ?> value="<?php echo $v['id'];?>" class="check0" >
                                        <label for="checkbox<?php echo $v['id'];?>">
                                        </label>
                                      </div>
                                   </td>
								   <td style="width:15%"><input class="form-control" name="login[]" value="<?php echo $v['login']?>" type="text" ></td>
                                   <td style="width:15%"><input class="form-control" name="apiID[]" value="<?php echo $v['apiID']?>" type="text" ></td>
								   <td><input class="form-control" name="apiKey[]" value="<?php echo $v['apiKey']?>" type="text" ></td>
                                   <td><input class="form-control" name="backurl[]" value="<?php echo $v['backurl']?>" type="text" ></td>
                                  <td><a class="apply2017" href="<?php echo $v['applyurl']?>" target="_blank"></td>
                                </tr>
							<?php } ?>
                            </tbody>
                        </table>
                      </div>
                     </div>
                     <div class="footer-page">
                       <div class="col-sm-5">
                        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                          <input id="checkboxALL" type="checkbox" class="check-all check0">
                          <label for="checkboxALL">
                            全选
                          </label>
                     </div> 
                      <button type="submit" class="btn mt10 btn-default" name="batch" value="2" >批量保存</button>
                       </div>
                     </div>
                </div>
            </div>
        </div> 
    </div>
</form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>      
<script> 
	 loadScorllJs();
taps();	 
</script>
</body>
</html>