<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>科汛在线教育</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>

</head>
<body class="gray-bg">
<div class="wrapper mt55 ">
    <div class="row">
        <div id="manage_top " class="menu_top_fixed p15 height73 " >
            <div class="ibox-title">
                <h3 class="fl" ></h3>
                <a  href="<?php echo M_URL('WXmp','get_fans'); ?>" class="btn btn btn-info btn-rounded btn-s-md  ml15" style="color:#676a6c;margin-left:20px">从微信同步到本地</a>
                <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                        <i class="reflash"></i>
                    </a>
                </div>
                <div class="search-main fr">

                    <div class="search-box w240 fl">
                        <label class="fl control-label" >
                            按类别查看
                        </label>
                        <select onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Wxmp','fans_list'); ?>','sex','<?php echo URL_MODEL;?>');"  class="form-control fl mt7 input-sm w120  inline" id="keytype">
                            <option <?php if($sex==3){echo 'selected'; }?> value="">--按性别进行查看--</option>
                            <option <?php if($sex==1){echo 'selected' ;}?> value="1">---男性---</option>
                            <option  <?php if($sex==2){echo 'selected' ;}?> value="2">---女性---</option>
                            <option  <?php if($sex==0){echo 'selected'; }?> value="0">---未知---</option>
                        </select>

                    </div>
                    <div class="search-box w240 mt7 fl" >
                        <div class="input-group">
                            <input type="text" class=" form-control input-sm w180 fl"  placeholder="" >
                      <span class="input-group-btn ">
                        <button class="btn btn-sm btn-default   fl"  onClick="searchByClass()" type="button">Go!</button>
                      </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
                <form target="hidframe"  action="<?php echo M_URL('Admin','batch','',GP('p-'.$page->now_page)) ?>" method="post">
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
                                                        <th>选择</th>
                                                        <th>编号</th>
                                                        <th>微信头像</th>
                                                        <th>昵称</th>
                                                        <th>性别</th>
                                                        <th>关注时间</th>
                                                        <th>城市</th>
                                                        <th>所属分组</th>
                                                        <th>删除</th>
                                                    </tr>
                                                    </thead>

                                                    <?php  foreach($user as $k=>$v){ ?>
                                                        <tr class="gradeX">
                                                            <td>
                                                                <div class="checkbox  checkbox-info" >
                                                                    <input id="C<?php  echo $v['id']; ?>" type="checkbox" name="check[]" value="<?php  echo $v['id']; ?>" class="check0">
                                                                    <label for="C<?php  echo $v['id']; ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td><?php  echo $v['id']; ?></td>
                                                            <td ><img style="width: 50px;height: 50px" src="<?php echo $v['headimgurl'] ; ?>" alt="">  </td>
                                                            <td><?php echo $v['nickname']?></td>
                                                            <td><?php if($v['sex']==1){echo "男";}elseif($v['sex']==2){echo "女";}else{echo "性别未知";} ?></td>
                                                            <td><?php echo KS_DATE($v['subscribe_time']); ?></td>
                                                            <td><?php  echo $v['country'].' '.$v['province'].' '.$v['city'];?></td>
                                                            <td><p>尚未分组</p></td>
                                                            <td class='center'><a href="javascript:void(0);" onclick="Confirm('确定删除？,该操作不可逆','<?php echo M_URL('admin','deleteAdmin',$v['adminid'],GP('p-'.$page->now_page)); ?>');"><i class="delete2017"></i></a></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody></table>

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
                            <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                                <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                                <label for="checkboxAll">
                                    全选
                                </label>
                            </div>
                            <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="0">
                                 锁定
                             </button>
                             <button class="btn mt10 btn-default" type="submit" name="batch" value="1">
                                 解锁
                             </button>
                             <button class="btn mt10 btn-default" type="submit" name="batch" value="2">
                                 批量审核
                             </button>
                             <button class="btn mt10 btn-default" type="submit" name="batch" value="3">
                                 取消审核
                             </button>-->
                            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">
                                批量删除
                            </button>
                        </div>

                        <div class="col-sm-7 "  style="margin-top:7px">
                            <?php echo $page->show(3); ?>
                        </div>


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
</script>
</body>
</html>