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
   <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
   <style>
   .col-sm-2 {width:16.6666667%}
   </style>
</head>
<body class="gray-bg">

<div class="wrapper mt40 wrapper-content animated fadeIn">

    <div class="row bg-white" style="padding-bottom:15px">
        <div class="col-sm-12">

            <div id="manage_top " class="menu_top_fixed">
				 <div class="ibox-title">
                 <h3 class="fl ml15">课程数据表增加</h3>
                 <a class="" href="javascript:history.go(-1);" style="margin-left:15px;color:#788188"><i class="up-level" ></i>上一级</a>
                <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                        <i class="reflash"></i>
                    </a>

                </div>
				</div>

            </div>
            <div class="ibox float-e-margins mt40">
                <div class="ibox-content">
                    <form id="myform" target="hidframe"  method="post" class="form-horizontal" action="<?php echo  M_URL('Setting','extendDoaddtable',$type) ?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">数据表别名</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="itemname">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">扩展表模型</label>

                            <div class="col-sm-4">
                                <?php echo  'ks_'.$table ?>
                              
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">数据表名称</label>

                            <div class="col-sm-10">
                                <label class="control-label fl"><?php echo  'ks_'.$table ?></label>
                                <input class="form-control fl" type="text" style="width:75px" name="tablename">
                                <label class="control-label fl"
                                       style="padding-left: 10px">提示：自定义表系统会自动加上<?php echo  'ks_'.$table ?>开头。</label>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">设置为默认</label>

                            <div class="col-sm-4 mt7">
                                <div class="radio radio-info radio-inline mr15">
                                    <input type="radio" id="radioInline1" name="Isdefault" value="1">
                                    <label for="radioInline1">是</label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="radioInline2" name="Isdefault" value="0" checked>
                                    <label for="radioInline2">否</label>
                                </div>
                            </div>
                        </div>
                        <div class="footer-page">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3 mt3" >
                                <button type="button" onClick="do_reg()" class="btn btn-primary btn-s-md">保存</button>
                                
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
function do_reg()
{
	var tablename = $("input[name='tablename']").val();

    if(tablename==''){
		Alert('表名不能为空');
		return false;	
    }
   
	$("#myform").submit();
	
}	
</script> 
</body>
</html>