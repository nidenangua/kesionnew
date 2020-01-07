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
<div class="wrapper mt10 wrapper-content animated fadeInRight">
     <div id="manage_top" class="menu_top_fixed height73 p15">
					  <div class="ibox-title fl mr15 ml15">
                        <h3 class="fl"><?php if(!isset($table)){echo '添加模型';}else{echo '修改模型';} ?></h3>
                       
                    </div>
                    <div class="ibox-tools" >
                        <button class="ks-bt bt-def" type="button" onclick="history.go(-1)" ><i class="iconfont icon-fanhui"></i>返回</button>
                    </div>
					
                </div><br/><br/><br/>
    <div class="row bg-white p15">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
               
              
                <div class="ibox-content">
                    <form target="hidframe"  action="<?php if(!isset($table)){echo M_URL('Setting','doaddTable');}else{echo M_URL('Setting','doeditTable');} ?>" method="post" class="form-horizontal">
                        <?php if(isset($table)){echo "<input type='hidden' name='tableid' value='$table[tableid]' />";} ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">模型名称</label>

                            <div class="col-sm-4">
                                <input type="text"  name="itemname" <?php if(isset($table))echo "value='$table[itemname]'";  ?> class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">数据表名</label>
                            <div class="col-sm-4">
                                 <select name="tablename"  <?php if(isset($table))echo 'disabled'; ?> class="form-control">
                                    <?php 
									if(!isset($table))
									{
									  $xx = 'Tables_in_'.$GLOBALS['config']['DB_NAME'];
									  foreach($tables as $Tk=>$Tv)
									  {echo "<option value='".str_replace($GLOBALS['config']['DB_PREFIX'],'',$Tv[$xx])."'>".$GLOBALS['config']['DB_PREFIX'].str_replace($GLOBALS['config']['DB_PREFIX'],'',$Tv[$xx])."</option>";}
									}else{
										echo "<option value='$table[tablename]'>".$GLOBALS['config']['DB_PREFIX']."$table[tablename]</option>";
										  }
									?> 
                                    </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">说明</label>

                            <div class="col-sm-4">
                             <textarea class="form-control" style="min-height: 150px"  name="intro">
                             <?php if(isset($table))echo $table['intro'];  ?>
                             </textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="footer-page">
                          
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3 mt3"> 
                                <button class="btn btn-s-md btn-primary" type="submit"><?php if(!isset($table)){echo '确定添加';}else{echo '确定修改';} ?></button>
                                <a href="javascript:history.go(-1);" class="btn btn-s-md bt-gray">取消</a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/validate/jquery.validate.min.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/validate/messages_zh.min.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    $.validator.setDefaults({
        submitHandler: function() {
             $(".form-horizontal").ajaxsubmit();
        }
    });
	
    $().ready(function() {
// 在键盘按下并释放及提交后验证提交表单
        $(".form-horizontal").validate({
            rules: {
                itemname: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                itemname: {
                    required: "请输入模型名称",
                    minlength: "模型名称必需大于两位"
                }
            }	
        });
    });
</script>
</body>
</html>