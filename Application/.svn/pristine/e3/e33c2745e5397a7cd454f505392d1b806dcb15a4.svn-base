<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>科汛在线教育</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
 
</head>
<body class="gray-bg">
<div class="wrapper" >

    <div class="row">
        <button class="sc-button btn  btn-default fl mt7" onClick="addTypeChange('<?php echo M_URL('Domain','Follow',$wxid,GP('p-'.$now_page.',type=2')) ?>','700px','400px',{title:'添加客户',type:'top'});" >添加记录</button>
    </div>
</div>
         
<form target="hidframe"  action="<?php echo M_URL('Setting','realnamebatch','',GP('p-'.$page->now_page)) ?>" method="post">
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <div class="panel-body" style="padding:0">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="ibox float-e-margins pt15">
                            <div class="ibox-content">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>网校ID</th>
                                        <th>跟进人</th>
                                        <th>跟进内容</th>
                                        <th>跟进状态</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
									<?php  foreach($values as $k=>$v){ ?>
									<tr class="gradeX">
									    <td>
									    <div class="checkbox  checkbox-info" >
									        <input id="C<?php  echo $v['id']; ?>" type="checkbox" name="id[]" value="<?php  echo $v['id']; ?>" class="check0">
									        <label for="C<?php  echo $v['id']; ?>">
									        <?php  echo $v['id']; ?>
									        </label>
									    </div></td>

									    <td><?php echo $v['wxid'];?></td>
									    <td><?php echo $v['salesman'];?></td>
									    <td><?php echo $v['content'];?></td>
									    <td><?php echo $this->customerstatus[$v['customerstatus']];?></td>
									    <td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
									    <td><a class="form-bule" href="<?php echo M_URL('Domain','delFollow',$v['id'],GP('p-'.$now_page.',wxid-'.$wxid));?>">删除</a></td>
									    <td></td>
									</tr>
									<?php } ?>
                                    </tbody>
                                   </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-page">
                <?php echo $page->show(3); ?>
            </div>
        </div>
        <div id="tab-2" class="tab-pane">
            <div class="panel-body">
            </div>
        </div>
    </div>
    <div class="footer-page h60">
        <div class="col-sm-5">
         <!--<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
            <label for="checkboxAll">全选</label>
         </div>-->
            <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
            <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button>
            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">删除</button>-->
         </div>
        <div class="col-sm-7 "  style="margin-top:7px"><?php echo $page->show(3); ?></div>
    </div>
</form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
var selectInputs = $('.check0');
var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)

    $().ready(function(){
        $(" #choice1 button").click(function(){

            $(this).toggleClass("btn-primary");
        });
    });
    function attributeSelect(url)
    {
        window.location.href=''+url;
    }
</script>
</body>
</html>