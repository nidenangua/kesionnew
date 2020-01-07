<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">	
    <link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css" rel="stylesheet">		
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <style>
    	label{padding-top: 5px;}
    </style>
</head>
<body class="gray-bg" style="background-color: #f3f3f3">
<div class="wrapper" style="margin-top: 75px;">
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15">
            <div class="ibox-title">
                <h3 class="fl">云视频管理
	                <ul id="tablist" class="ml15">
	        	 <li <?php if($type ==1)echo 'class="active"'; ?>><a href="<?php echo M_URL('ThirdInterface','index','',GP('type-1')); ?>">点播接口设置</a></li>
          		 <li <?php if($type ==3)echo 'class="active"'; ?>><a href="<?php echo M_URL('ThirdInterface','addInterface','',GP('type-3')); ?>">添加点播接口</a></li>
          		 <li <?php if($type ==2)echo 'class="active"'; ?>><a href="<?php echo M_URL('ThirdInterface','liveIndex','',GP('type-2')); ?>">直播接口设置</a></li>
          		 <li <?php if($type ==4)echo 'class="active"'; ?>><a href="<?php echo M_URL('ThirdInterface','addlive','',GP('type-4')); ?>">直播类型添加</a></li>
	        		</ul>
                </h3>
                <div class="ibox-tools">
					<button class="ks-bt bt-def" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>	
				</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
             
            </ul>
            <div class="tab-content" id="ksBoxContent">
                <div class="tap-pane" style="display: block;margin-bottom: 200px;">
                    <div class="panel-body">
                        <form id="myform" target="hidframe"  class="form-horizontal" method="post" action="<?php if(isset($value)){echo M_URL('ThirdInterface','doeditInterface',$id,GP(''));}else{echo M_URL('ThirdInterface','doaddInterface','',GP(''));} ?>">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">云视频名称：</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="title" value="<?php if(isset($value))echo $value['title'] ?>">
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">pc版的调用视频播放器的脚本：</label>
                                <div class="col-sm-4">
                                   <textarea class="form-control" style="min-height: 120px" name="pcScript"><?php if(isset($value)) echo $value['pcScript'] ?></textarea>
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">手机版的调用视频播放器的脚本：</label>
                                <div class="col-sm-4">
                                   <textarea class="form-control" style="min-height: 120px" name="mobileScript"><?php if(isset($value)) echo $value['mobileScript'] ?></textarea>
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group">
                                <label class="col-sm-9 control-label  c-red txt-left">引用第三方视频;PC版的调用视频的脚本和手机版的调用视频的填写方式：如果参数是多个，用{KS：PLAY1},{KS:PLAY2},按顺序下去，从1开始算起</label>
                            </div>                            <div class="line line-dashed b-b line-lg pull-in"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">账号(APPID)：</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="appid" value="<?php if(isset($value))echo $value['appid'] ?>">
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">密钥(APPSecret)：</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="appsecret" value="<?php if(isset($value))echo $value['appsecret'] ?>" />
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">是否启用：</label>
                                <div class="col-sm-4">
                                    <div class="radio radio-info radio-inline">
                                        <input name="enable" id="mbings1"  type="radio" value="1" <?php if(isset($value)){if($value['enable'] == 1)echo 'checked';} ?>><label for="mbings1"> 是 </label>
                                    </div>
                                    <div class="radio radio-info  radio-inline">
                                        <input name="enable" id="mbings2" type="radio" value="0" <?php if(isset($value)){if($value['enable'] == 0)echo 'checked';}else{ echo 'checked';} ?>><label for="mbings2"> 否 </label>
                                    </div>
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">是否默认：</label>
                                <div class="col-sm-4">
                                    <div class="radio radio-info radio-inline">
                                        <input name="default" id="mbings3"  type="radio" value="1"  <?php if(isset($value)){if($value['isdefault'] == 1)echo 'checked';} ?>><label for="mbings3"> 是 </label>
                                    </div>
                                    <div class="radio radio-info  radio-inline">
                                        <input name="default" id="mbings4" type="radio"  value="0" <?php if(isset($value)){if($value['isdefault'] == 0)echo 'checked';}else{ echo 'checked';} ?>><label for="mbings4"> 否 </label>
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label">推流地址：</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="pushflow" value="<?php if(isset($value))echo $value['pushflow'] ?>">
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group" style="margin-bottom: 80px;">
                                <label class="col-sm-2 control-label">播放地址：</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="playaddress" value="<?php if(isset($value))echo $value['playaddress'] ?>">
                                </div>
                            </div>
                           -->
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                             <div class="footer-page">
                                <div class="col-sm-5"></div>
                                <div class="col-sm-7 mt3"> <button class="btn btn-primary mt7 btn-s-md"  type="button" onClick="do_reg()">确定保存</button>
                                	 <a href="javascript:history.go(-1);" class="btn bt-gray mt7 btn-s-md">取消修改</a>
                                </div>
                             </div>  
                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
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