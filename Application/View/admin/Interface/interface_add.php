<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
    input{
            width: 300px;
            height: 34px;
            line-height: 34px;
            border: 1px solid #d6dadf;
            padding: 0 10px;
            border-radius: 3px 0 0 3px;
            margin-left: 10px;
            color: #5e6062;
    }
    #select{
        width: 300px;
            height: 34px;
            line-height: 34px;
            border: 1px solid #d6dadf;
            padding: 0 10px;
            border-radius: 3px 0 0 3px;
            margin-left: 10px;
            color: #5e6062; 
    }
    .tab-content{
            line-height: 43px;
                float: right;
    }
    .fl{
        width: 84px;
        height: 40px;
        line-height: 18px;
        /*margin-right: -4px;*/
    }
  input[type="radio"]{
     width: 21px;
  }
</style>
<body class="gray-bg" style="background: #fff;">
<div class="wrapper mt10" id="scorll" style="    margin-left: 48px;">
   <div class="row" style="    padding-right: 60px;">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
<!--                 <div id="manage_top" class="menu_top_fixed">
                    <div class="ibox-title">
                    <h3 class="fl pl20">修改机构名称</h3>
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0"><i class="reflash"></i></a>
                    </div>
                    </div>
                </div> -->          
                <div class="ibox-content ">
<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php if($id){echo M_URL('home/Interface','doeditInterface',$id,GP('p-'.$now_page));}else{echo M_URL('home/Interface','doaddInterface','',GP('p-'.$now_page));}?>" enctype="multipart/form-data">
                <!-- <div class="tabs-container pt0"> -->
                    <div class="tab-content">
                    接口名:<input  value="<?php if($id){echo $info['name'];}?>" name="name" placeholder="例：新增互动课堂">    
                    </div>
                    <div class="tab-content">
                    接口前缀：<input  value="<?php if($id){echo $info['controller'];}?>" name="controller" placeholder="例：Api">    
                    </div>
                    <div class="tab-content">
                    对应英文名：<input  value="<?php if($id){echo $info['interfaceName'];}?>" name="interfaceName" placeholder="例：doaddcourse">    
                    </div>
                    <div class="tab-content">
                    接口分类： <select class="" id="select" name='parentid'>
                                    <option value="0">请选择接口分类</option>
                                    <?php foreach($values as $kt =>$vt){ ?>
                                        <option value="<?php echo $vt['id']; ?>" <?php if($id){if($info['parentid']==$vt['id']){echo 'selected';}}?>><?php echo $vt['name']; ?></option>
                                    <?php } ?>                                  
                                </select>    
                    </div>
                    <div class="tab-content">
                    <span style="float: left;">参数提交方式：</span>
                    <p class="fl"><input type="radio" <?php if($id){if($info['postway']==1){echo 'checked';}}?>  class="radio" name="postway" value="1"> 普通post</p> 
                    <p class="fl"><input type="radio" name="postway" class="radio" <?php if($id){if($info['postway']==2){echo 'checked';}}?> value="2">post对象</p>
                    <p class="fl"><input type="radio" name="postway" class="radio" <?php if($id){if($info['postway']==3){echo 'checked';}}?> value="3">GET</p>     
                    </div>
                    <div class="footer-page mt3">
                        <div style="    margin-left: 27%;margin-top: 10px;">
                            <button type="button" onclick="do_reg();" class="btn btn-primary btn-s-md" >确认</button>
                            <a class="btn btn-default btn-s-md" onclick="close1()" >取消</a>
                        </div>
                    </div>
                <!-- </div> -->
</form>
                </div>
            </div>
        </div>
   </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
</script>
<script>
function close1(){
    //parent.closePopup('all');
    top.closePopup('all');
}
function do_reg()
{
    // if($("#newname").val()!=''){
        $("#myform").submit(); 
    // }else{
    //    Alert('名称不能为空')
    // }
     
}
</script>
</body>
</html>


