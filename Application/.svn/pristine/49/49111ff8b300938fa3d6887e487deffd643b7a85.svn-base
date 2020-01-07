<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	label {padding-top: 5px;}
</style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content mb40" style="margin-top:70px;" >
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
                <h3 class="fl mr15" >短信管理</h3>
                 <a  href="" class="btn btn-info btn-rounded  btn-default btn-s-md" > 添加</a>
                <div class="ibox-tools">
                	<button class="ks-bt" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
                   <!-- <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link fr ml15 mt0">
                        <i class="reflash"></i>
                    </a>-->
                </div>
            </div>
        </div>
        <div class="ibox-content" >
                <div class="">
                    <div class="panel-heading">手机短信发送管理列表</div>
                    <div class="p15 border2017 bg-white ">
                        <div class="pd-txt" >搜索记录：</div>
                        <div class="col-sm-3">
                            <input class="form-control" type="text" value="">
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio1">所有 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio2" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio2">成功 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio3" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio3">失败 </label>
                        </div>
                        <button class="btn-primary btn-w-m  btn-default btn">搜索</button>
                    </div>
                </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        <div class="checkbox checkbox-info">
                            <input id="checkbox4" type="checkbox">
                            <label for="checkbox4"></label>
                        </div>
                    </th>
                    <th>用户ID</th>
                    <th>操作IP</th>
                    <th>发送时间</th>
                    <th>接收手机</th>
                    <th>状态</th>
                    <th>发送内容</th>
                    <th>返回信息</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($pagelogs as $k=>$v){ ?>
                <tr>
                    <td style="">
                        <div class="checkbox checkbox-info">
                            <input id="checkbox<?php echo $v['id']; ?>" type="checkbox">
                            <label for="checkbox<?php echo $v['id']; ?>"></label>
                        </div>
                    </td>
                    <td><?php if($v['userid']==0){echo '注册用户';}else{echo $v['userid'];} ?></td>
                    <td><?php echo $v['userip']; ?></td>
                    <td><?php echo KS_DATE($v['adddate']); ?></td>
                    <td><?php echo $v['mobile']; ?></td>
                    <td style="color: red"><?php if($v['issuccess']==1){echo '成功';}else{echo '失败';}; ?></td>
                    <td style="width:30%"><span class="tips" ><?php echo $v['content']; ?></span></td>
                    <td><span class="tips"><?php echo $v['mark']; ?></span></span></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="row bg-waring" >
                <div class="col-sm-12">
                    <label class="control-label mb10" style="padding-right:10px; float: left; "> <strong>特别提醒:</strong></label>
                    <label class="col-sm-10 control-label">
                        如果短信记录太多，影响了系统性能，可以删除一定时间段前的记录以加快速度。
                    </label>
                </div>
                <div class="col-sm-12">


                    <label class="control-label" style="padding-right:10px; float: left;padding-top: 7px "> <strong>特别提醒:</strong></label>
                    <div class="col-sm-7">
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r2" value="option1" name="radioInline"
                                   checked="">
                            <label for="r2">10天前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r3" value="option1" name="radioInline"
                                   checked="">
                            <label for="r3">1个月前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r4" value="option1" name="radioInline"
                                   checked="">
                            <label for="r4">2个月前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r5" value="option1" name="radioInline"
                                   checked="">
                            <label for="r5">3个月前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r6" value="option1" name="radioInline"
                                   checked="">
                            <label for="r6">6个月前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r7" value="option1" name="radioInline"
                                   checked="">
                            <label for="r7">1年前 </label>
                            <button class="btn-primary btn-w-m  btn-default btn">执行删除</button>
                        </div>

                    </div>


                </div>

            </div>
            <div class="footer-page h60">
            <div class="col-sm-5">
            	<label style="padding-top: 0; margin-top: 15px;"><input id="checkboxALL" type="checkbox" class="check-all check0" style="position: relative;top: 4px;">全选</label>
            	<button class="btn btn-default" type="submit" name="batch" value="0">导出到Excel</button>
            </div>
            <div class="col-sm-7 mt7">
			<?php echo $page->show(3); ?></div>
            </div>
            
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script> 
<script>
loadScorllJs();//滚轮
</script>
</body>
</html>