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

         
            <div class="ibox float-e-margins mt40">
                <div class="ibox-content">
                    <form id="myform" target="hidframe"  method="post" class="form-horizontal" action="">
                    	<input type="hidden" value="<?php echo $id ;?>"  name='id'/>
                    	<input type="hidden" value="<?php echo $info[0]['name'] ;?>"  name='xmlname'/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">字段名称【中文】</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="title" value="<?php if(!empty($info)){ echo $info[0]['title'];} ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">数据名称【英文】</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" value="<?php if(!empty($info)){ echo $info[0]['name'];} ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">默认内容</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="value" value="<?php if(!empty($info)){ echo $info[0]['value'];} ?>">
                               	多选项值用|隔开
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文本类型</label>
                            <div class="col-sm-10">
                               	<select name="type" class="form-control"> 
                               		<option value="1" <?php if(!empty($info)){ if($info[0]['type'] == 1){ echo 'checked';} } ?>" >文本</option>
                               		<option value="3" <?php if(!empty($info)){ if($info[0]['type'] == 2){ echo 'checked';} } ?>" >图片</option>
                               	</select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="footer-page">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3 mt3" >
                                <button type="button" onClick="do_reg()" class="btn btn-primary btn-s-md">修改</button>
                                
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
	var name = $("input[name='name']").val();

    if(name==''){
		Alert('表名不能为空');
		return false;	
    }
   
	$("#myform").submit();
	
}
</script> 
</body>
</html>