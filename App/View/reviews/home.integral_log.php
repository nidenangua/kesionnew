<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">

    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
 
</head>
<body class="gray-bg">
<div class="wrapper  mt55 mb40">
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
                <h3 class="fl mr15" >短信管理</h3>
<a  href="" class="btn btn-info btn-rounded btn-s-md " style="color:#676a6c;"> 添加</a>
                <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                        <i class="reflash"></i>
                    </a>
                </div>
               

            </div>
        </div>
        <div class="ibox-content">

                <div >
                    <div class="panel-heading">
                        资金明细记录管理
                    </div>         
                    <div class="p15 border2017 bg-white">
                      
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
                            <label for="inlineRadio2">增加 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio3" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio3">减少 </label>
                        </div>
                        <button class="btn-primary btn-w-m btn">搜索</button>
                    </div>


                </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                   
                    <th>用户名</th>
                    <th>时间</th>
                    <th>明细</th>
                    <th>剩余积分</th>
                    <th>备注</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach($values as $k=>$v){?>
                <tr>
                    <td><?php echo $v['username'] ?></td>
                    <td><?php echo date("Y-m-d H:i:s",$v['adddate']); ?></td>
                    <td>
					<?php 
					if($v['type']==0){echo '-'.$v['changeIntegral']; }
					  else{echo '+'.$v['changeIntegral'];}
					?>
                    </td>
                    <td><?php echo $v['integral']; ?></td>
                    <td><?php echo $v['mark']; ?></td>
                </tr>
               <?php } ?>
                </tbody>
            </table>
            <div class="row bg-waring" >
                <div class="col-sm-12">
                    <label class="control-label" style="padding-right:10px; float: left "> <strong>特别提醒:</strong></label>
                    <label class="col-sm-10 mb10 control-label">
                        如果明细记录太多，影响了系统性能，可以删除一定时间段前的记录以加快速度。
                    </label>
                </div>
                <div class="col-sm-12">


                    <label class="control-label " style="padding-right:10px; float: left;padding-top: 7px "> <strong>特别提醒:</strong></label>
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
                            <button class="btn-primary btn-w-m btn">执行删除</button>
                        </div>

                    </div>


                </div>

            </div>
            <div class="footer-page height60"> 
            <div class="col-sm-5">
            <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
            <label for="checkboxAll">
                全选
            </label>
           
        </div>
         <button class="btn mt10 btn-default" type="button"  >
            导出到Excel
           </button>
            </div>
             <?php echo $page->show(3); ?>
             
             </div>
          

        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$(function(){
	loadScorllJs();
})
</script>
</body>
</html>