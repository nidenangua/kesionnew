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

<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
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
                    <form target="hidframe" id="myform" method="post" class="form-horizontal" action="<?php echo M_URL('home/Domain','dosaveFollow',$wxid,GP('p-'.$now_page));?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">跟进状态</label>
                            <div class="col-sm-8">
                                <select  name="customerstatus" style="width: 125px;height: 32px">
                                    <?php foreach ($this->customerstatus as $k=>$v) {?>
                                    <option value="<?php echo $k;?>" ><?php echo $v;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">跟进内容</label>
                            <div class="col-sm-8">
                                <textarea style="height: 100px;" class="form-control" name="content" value="" id="newname" rows="5"  ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">跟进时间</label>
                            <div class="col-sm-8">
                                <input id="start" type="text" value="<?php echo $end; ?>" name="followdate" required readonly class="laydate-icon">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">下次跟进时间</label>
                            <div class="col-sm-8">
                                <input id="end" type="text" value="<?php echo $end; ?>" name="nextdate" required readonly class="laydate-icon">
                            </div>
                        </div>
                        <div class="footer-page mt3">
                            <div style="    margin-left: 27%;margin-top: 10px;">
                                <button type="button" onclick="do_reg();" class="btn btn-primary btn-s-md">确认</button>
                                <a class="btn btn-default btn-s-md" onclick="close1()">取消</a>
                            </div>
                        </div>
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
       Alert('内容不能为空')
    }
     
}
    var start = {
        elem: '#start',
        format: 'YYYY/MM/DD hh:mm:ss',
        //min: laydate.now(), //设定最小日期为当前日期
        max: '2099-06-16 23:59:59', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#end',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: laydate.now(),
        max: '2099-06-16 23:59:59',
        istime: true,
        istoday: false,

    };
    laydate(start);
    laydate(end);
</script>
</body>
</html>


















