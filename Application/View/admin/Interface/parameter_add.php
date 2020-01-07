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
    .radio{
        width: 53px;
        /*float: right;*/
        height: 20px;
    }
    .tab-content{
            line-height: 53px;
                float: right;
    }
    p{
        width: 84px;
        height: 40px;
        line-height: 18px;
        float: left;
        /*margin-right: -4px;*/
    }
  input[type="radio"]{
     width: 21px;
         position: relative;
    /* display: contents; */
    min-height: 20px;
    /*margin-bottom: 0;*/
    top: 13px;
    font-weight: 400;
    cursor: pointer;

  }
</style>
<body class="gray-bg" style="background: #fff;">
<div class="wrapper mt10" id="scorll" style="    margin-left: 48px;">
   <div class="row" style="    padding-right: 48px;">
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
<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php if($id){echo M_URL('home/Interface','doeditParameter',$id,GP('p-'.$now_page.',interfaceid-'.$interfaceid));}else{echo M_URL('home/Interface','saveParameter','',GP('p-'.$now_page.',interfaceid-'.$interfaceid));}?>" enctype="multipart/form-data">
                <!-- <div class="tabs-container pt0"> -->
                    <div class="tab-content">
                    参数名:<input  value="<?php if($id){echo $info['name'];}?>" name="name">    
                    </div>
                    <div class="tab-content">
                    对应英文名：<input  value="<?php if($id){echo $info['parameter'];}?>" name="parameter">    
                    </div>
                    <div class="tab-content"  style="    width: 370px;">
                   <span style="float: left;"> 是否必须：</span>
                   <p><input type="radio" name="isnecessary"  <?php if($id){if($info['isnecessary']==1){echo 'checked';}}?> value="1">是</p>
                   <p ><input type="radio" <?php if($id){if($info['isnecessary']==0){echo 'checked';}}?>   name="isnecessary" value="0"> 否</p>      
                    </div>
                    <div class="tab-content" style="    width: 370px;">
                    <span style="float: left;">参数类型：</span><p ><input type="radio" <?php if($id){if($info['pramType']==0){echo 'checked';}}?>   name="pramType" value="0"> 字符串</p> 
                    <p ><input type="radio" name="pramType"  <?php if($id){if($info['pramType']==2){echo 'checked';}}?> value="2">数字</p>
                    <p ><input type="radio" name="pramType"  <?php if($id){if($info['pramType']==1){echo 'checked';}}?> value="1">文件</p>     
                    </div>
                    <div class="tab-content">
                    备注：<input  value="<?php if($id){echo $info['mark'];}?>" name="mark">    
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


