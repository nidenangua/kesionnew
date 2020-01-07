<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

    <link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
    .curr{
        border-image: none;
        border-style: solid;
        border-width: 1px;
        color: #555;
        cursor: default;
        border-top: 0;
        background-color: #fff!important;
    }
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">

    <div class="row">
        <div id="manage_top" class="menu_top_fixed  p15 height73" >
            <div class="ibox-title">
                <h3 class="fl">&nbsp;&nbsp;名片用户管理</h3>&nbsp;&nbsp;
                总名片数&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $datasum;?></font>
                今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout;?></font>
                <div class="fr">
                    <div class="fl ks-top-search">
                        <!--搜索-->
                        <select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
                            <option value="1" <?php if($keytype==1) echo "selected"; ?>>用户名</option>
                            <option value="2" <?php if($keytype==2) echo "selected"; ?>>手机号</option>
                        </select>
                        <form target="hidframe" class="fr">
                            <input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
                            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Users','cardUser'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
                        </form>
                        <!--搜索-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ksBoxContent">
    <form target="hidframe"  method="post" target="hidframe"  action="<?php echo M_URL('home/Users','delall','',GP('p-'.$page->now_page)) ?>" class="form-horizontal" enctype="multipart/form-data">
            <div class="H5-gameListConts school-online">
                <div class="Created-push" id="ksBoxContent" style="padding:15px;margin-bottom: 150px;">
                    <table class="ks-table" id="tables">
                        <tr style="background: #EEEEEE;">
                            <th><input type="checkbox" class="select-checks fl" /></th>
                            <th>头像</th>
                            <th>用户名</th>
                            <th>姓名（昵称）</th>
                            <th>类型</th>
                            <th>手机号</th>
                            <th>删除</th>
                            <th>操作</th>
                        </tr>
                        <?php foreach($values as $k=>$v){?>
                            <tr>
                                <td><input type="checkbox" class="select-checks fl" name="check[]" value="<?php echo $v['userid'] ?>" /></td>
                                <td><img style="width: 30px;height: 30px;" src="<?php echo $v['head'] ?>"></td>
                                <td><?php echo $v['username']?></td>
                                <td><?php
                                        if (!empty($v['realname'])){
                                            echo $v['realname'];
                                        }elseif(!empty($v['nickname'])){
                                            echo $v['nickname'];
                                        }else{
                                            echo "---";
                                        }
                                    ?></td>
                                <td>
                                    <?php if ($v['usertype'] == 0){echo '学员';}elseif ($v['usertype']==1){echo '老师';}elseif ($v['usertype'] == 2){echo '机构';}?>
                                </td>
                                <td>
                                    <?php
                                        if (!empty($v['mobile'])){
                                            echo $v['mobile'];
                                        }else{
                                            echo "---";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <span onclick="Confirm('是否删除该用户名片？','<?php echo M_URL('Users','delCardUser',$v['userid'],GP('p-'.$page->now_page)); ?>')"><i class="iconfont icon-lajitong"></i></span>
                                </td>
                                <td>
                                    <a onclick="addTypeChange('<?php echo M_URL('Users','showCard',$v['userid'],GP('p-'.$page->now_page.',urltype-2'));?>','650px','550px')">
                                        <p class="class-name">查看</p>
                                    </a>
                                </td>
                            </tr>
                        <?php }?>
                    </table>
                    <?php echo NoC($values);?>
                </div>
                <div class="footer-page h60">
                    <div class="col-sm-5">
                        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                            <input class="selectAll select-checks" name="check1" type="checkbox" id="checkboxAll" style="display: none;">
                            <label for="checkboxAll">全选</label>
                        </div>
                        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量删除</button>
                    </div>
                    <div class="col-sm-7 " style="margin-top:7px">
                        <?php echo $page->show(3); ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>