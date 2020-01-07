<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<title>模型列表</title>
<style>
	.checkbox input[type=checkbox] {display: none;}
</style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content mt55">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" >
                <div id="manage_top" class="menu_top_fixed height73 p15">
                <h3 class="fl"> 支付接口配置</h3>
                    <div class="ibox-tools">
                    	<button class="ks-bt" type="button" onclick="history.go(-1)" style="border:1px solid #eee"><i class="iconfont icon-fanhui"></i>返回</button>
                    </div>
                </div>   
                <form target="hidframe"  action="<?php echo M_URL('Setting','saveBatchPay') ?>" method="post">
                <div class="ibox-content mt15">
                    <div class="panel-heading">
                       支付列表
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="editable">
                        <thead>
                        <tr>
                            <th>排列序号</th>
                            <th>启用</th>
                            <th>支付平台Logo</th>
                            <th>支付平台名称</th>
                            <th>简要介绍</th>
                            <th>账号</th>
                            <th>是否默认</th>
                            <th>编辑</th>
                            <th>申请</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($payconfig as $k=>$v){ ?>
                        <tr class="gradeX">
                            <td style="width:120px"><select class="sol-sm-6 form-control">
                               <?php  for($i=1;$i<=2;$i++){if($i==$v['id']){ ?>
                                  <option selected><?php echo $i;?></option>
                               <?php }else{ ?>
                                  <option ><?php echo $i;?></option>
                               <?php }} ?>
                            </select></td>
                            <input type="hidden" value="<?php echo $v['id'];?>" name="id[]">
                            <td>
                            <div class="checkbox checkbox-info">
                                        <input id="checkbox<?php echo $v['id'];?>" type="checkbox" name='status[]' <?php if($v["status"]==1){echo " checked ";} ?> value="<?php echo $v['id'];?>" class="check0" >
                                        <label for="checkbox<?php echo $v['id'];?>">
                                        </label>
                            </div>
                            </td>
                            <td><img src="<?php echo $v['defaultpic']; ?>" width="90" /></td>
                            <td><input type="text" class="form-control" name="payname[]" value="<?php echo $v['payname'];?>" style="width:250px"></td>
                            <td><?php echo $v['intro']; ?></td>
                            <td><?php $PArr = explode('$$$',$v['content']);$TArr = explode('|$|',$PArr[0]); echo $TArr[1]; ?></td>
                            <td>
                            <div class="radio radio-info radio-inline">
                            <input type="radio" id="radio<?php echo $k?>" name="Isdefault" <?php if($v["Isdefault"]==1){echo " checked ";} ?> value="<?php echo $v['id'];?>">
                            <label for="radio<?php echo $k?>"></label>
                            </div>
                            </td>
                            <td class="center"><a href="<?php echo M_URL('Setting','editPay',$v['id']); ?>"><i class="edit2017"></i></a></td>
                            <!--<td class="center"><?php if($v["issys"]==1){ ?>---<?php }else{ ?><a href="" onclick="return confirm('确定删除？,该操作不可逆');"><i class="icon iconfont">&#xe619</i></a><?php } ?></td>-->
                            <td><a class="apply2017" href="<?php echo $v['applyurl']?>" target="_blank"></a></td>
                       <?php } ?>
                        </tbody>
                    </table>
                    <?php echo NoC($payconfig);?>
                </div>
                <div class="footer-page h60">
                   <div class="col-sm-5">
                   <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                        <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                        <label for="checkboxAll">全选</label>
                   </div>
                   <button class="btn mt10 btn-default" type="submit" name="batch" value="0">批量修改</button>
                   </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br/>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
var selectInputs = $('.check0'); // 所有勾选框
var checkAllInputs = $('.check-all') // 全选框
selectall(selectInputs,checkAllInputs);
loadScorllJs();
</script>
</body>
</html>