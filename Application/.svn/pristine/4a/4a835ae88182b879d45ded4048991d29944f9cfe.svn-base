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
</style>
<body class="gray-bg" style="background: #fff;">
<div class="wrapper mt40" id="scorll" style="    margin-left: 48px;">
   <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content ">
                    <form target="hidframe" id="myform" method="post" class="form-horizontal" action="<?php echo M_URL('home/Domain','saveSetExpireTime',$wxid,GP('p-'.$now_page));?>" enctype="multipart/form-data">
                       

                        <div class="tab-content">
                            店铺名称：<?php echo $info['sitename'];?>
                        </div>
                        <div class="tab-content">
                            版本号：
                            <input name="package" value="<?php echo $info['package'];?>" />
                        </div>
                        <br />
                        <div class="tab-content">
                            到期时间：
                            <input name="packendtime" value="<?php echo KS_DATE($info['packendtime']);?>" id="newname" />
                        </div>
                        <div class="footer-page mt3">
                            <div style="    margin-left: 27%;margin-top: 10px;">
                                <button type="button" onclick="do_reg();" class="btn btn-primary btn-s-md">确认</button>
                                <a class="btn btn-default btn-s-md" onclick="close1()">取消</a>
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
    if($("#newname").val()!=''){
        $("#myform").submit(); 
    }else{
       Alert('名称不能为空')
    }
     
}
</script>
</body>
</html>


















