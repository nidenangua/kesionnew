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
   	label {padding-top: 5px;text-align: right;}
   </style>
</head>
<body class="gray-bg"id="ksBoxContent" style="background-color: #f3f3f3;padding: 0;">
<div class="wrapper "style="margin-bottom: 0;"  >
    <div class="row">
       
    </div>
    <div class="row">
        <div class="tabs-container">
        	
            <div class="tab-content">
                <div class="tap-pane" style="display: block">
                    <div class="panel-body">
                        <form id="myform" target="hidframe"  class="form-horizontal" method="post" action="<?php if(isset($value)){ echo M_URL('Setting','doeditresolution',$id); }else{ echo M_URL('Setting','doaddresolution'); }  ?>">
                         	<div class="form-group-box">
                         		
                         		<div class="form-group">
	                                <label class="col-sm-3 ">类型：</label>
	                                <div class="col-sm-4">
	                                    <select class="form-control" name="type" onchange="block(this)">
	                                    	<option value="1" <?php if(isset($value))if($value['type']==1){echo 'selected=selected';} ?> >一对一</option>
	                                    	<option value="2" <?php if(isset($value))if($value['type']==2){echo 'selected=selected';} ?>>一对多</option>
	                                    </select>
	                                </div>
	                            </div>
	                            
                         		<div class="form-group" id="block-hide" style="display: none;">
	                                <label class="col-sm-3">人数：</label>
	                                <div class="col-sm-4">
	                                    <input type="text" class="form-control" name="num" value="<?php if(isset($value))echo $value['num'] ?>">
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
                         		<div class="form-group">
	                                <label class="col-sm-3 ">名称：</label>
	                                <div class="col-sm-4">
	                                    <input type="text" class="form-control" name="title" value="<?php if(isset($value))echo $value['title'] ?>">
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                            <div class="form-group">
	                                <label class="col-sm-3 ">白板分辨率：</label>
	                                <div class="col-sm-4">
	                                    <input type="text" class="form-control" name="blackboard" value="<?php if(isset($value))echo $value['blackboard'] ?>">
	                                </div>
	                                <div class="col-sm-3">
	                                    <input type="number" class="form-control" name="blackboardid" value="<?php if(isset($value))echo $value['blackboardid'] ?>">
	                                    	声网分辨率参数
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                            
	                             <div class="form-group">
	                                <label class="col-sm-3 ">老师头像：</label>
	                                <div class="col-sm-4">
	                                    <input type="text" class="form-control" name="teacherhead" value="<?php if(isset($value))echo $value['teacherhead'] ?>">
	                                </div>
	                                <div class="col-sm-3">
	                                    <input type="number" class="form-control" name="teacherheadid" value="<?php if(isset($value))echo $value['teacherheadid'] ?>">
	                                    	声网分辨率参数 
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                             
	                               <div class="form-group">
	                                <label class="col-sm-3 ">学生头像：</label>
	                                <div class="col-sm-4">
	                                    <input type="text" class="form-control" name="studenthead" value="<?php if(isset($value))echo $value['studenthead'] ?>">
	                                </div>
	                                <div class="col-sm-3">
	                                    <input type="number" class="form-control" name="studentheadid" value="<?php if(isset($value))echo $value['studentheadid'] ?>">
	                                    	声网分辨率参数
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                            
	                            
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                             
	                               <div class="form-group">
	                                <label class="col-sm-3 ">价格：</label>
	                                <div class="col-sm-4">
	                                    <input type="number" class="form-control" name="price" value="<?php if(isset($value))echo $value['price']; ?>">元/分钟
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                            
	                          
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否启用：</label>
                                <div class="col-sm-4">
                                    <div class="radio radio-info radio-inline">
                                        <input name="isenable" id="mbings3"  type="radio" value="1"  <?php if(isset($value)){if($value['isenable'] == 1)echo 'checked';} ?>><label for="mbings3"> 是 </label>
                                    </div>
                                    <div class="radio radio-info  radio-inline">
                                        <input name="isenable" id="mbings4" type="radio"  value="0" <?php if(isset($value)){if($value['isenable'] == 0)echo 'checked';}else{ echo 'checked';} ?>><label for="mbings4"> 否 </label>
                                    </div>
                                </div>
                            </div>
                           
                            
                              <div class="footer-page">
                                <div class="col-sm-4"></div>
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
 	loadScorllJs('.panel-body')
function do_reg()
{
	var title = $("input[name='title']").val();

    if(title==''){
		Alert('名称不能为空');
		return false;	
    }
   
	$("#myform").submit();
	
}


	function add(){
		
		var html='';
		html+='<div class="form-group">';
		html+='<label class="col-sm-3 "><input type="text" class="form-control" name="keytitle[]" value="appid"></label>';	
		html+='<div class="col-sm-4"> <input type="text" class="form-control" name="key[]" value=""></div>';
		html+='<div class="col-sm-3"><button class="btn btn-defalut mt7" onclick="del(this)">删除</button></div>';
		html+='</div>';
		html+='<div class="line line-dashed b-b line-lg pull-in"></div>';	 
		$('.form-group-box').append(html);  
                        
	}

	function del(obj){
		$obj =$(obj);
		$obj.parents('.form-group').next('.line-dashed').remove();
		$obj.parents('.form-group').remove();
		
	
	}
	function block(target){
		if (target.value == 1) {
			$('#block-hide').hide()
		}else{
			$('#block-hide').show()
		}
		
	}
</script>
</body>
</html>