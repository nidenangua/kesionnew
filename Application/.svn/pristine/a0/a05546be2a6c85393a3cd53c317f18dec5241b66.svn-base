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
                <h3 class="fl">&nbsp;&nbsp;名片组管理</h3>&nbsp;&nbsp;
                总名片组&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $datasum;?></font>
                今日新增名片组&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout;?></font>
                <div class="fr">
                    <div class="fl ks-top-search">
                        <!--搜索-->
                        <select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
                            <option value="1" <?php if($keytype==1) echo "selected"; ?>>组名称</option>
                        </select>
                        <form target="hidframe" class="fr">
                            <input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
                            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Users','cardGroup'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
                        </form>
                        <!--搜索-->
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
    <form target="hidframe"  method="post" target="hidframe"  action="<?php echo M_URL('home/Users','delGroupAll','',GP('p-'.$page->now_page)) ?>" class="form-horizontal" enctype="multipart/form-data">
            <div class="H5-gameListConts school-online">
                <div class="Created-push" id="ksBoxContent" style="padding:15px;margin-bottom: 150px;">
                    <table class="ks-table" id="tables">
                        <tr style="background: #EEEEEE;">
                            <th>选择</th>
                            <th>创建用户</th>
                            <th>组名称</th>
                            <th>创建时间</th>
                            <th>交换码</th>
                            <th>操作</th>
                        </tr>
                        <?php foreach($values as $k=>$v){?>
                           <tr>
                               <td><input type="checkbox" class="select-checks fl" name="check[]" value="<?php echo $v['id'] ?>" /></td>
                               <td><?php echo $v['username']?></td>
                               <td><?php echo $v['title']?></td>
                               <td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
                               <td><?php echo $v['switch_code']?></td>
                               <td>
                                   <span onclick="Confirm('是否删除该组？','<?php echo M_URL('Users','groupdel',$v['id'],GP('p-'.$page->now_page)); ?>')"><i class="iconfont icon-lajitong"></i></span>
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
                        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量删除组</button>
                    </div>
                    <div class="col-sm-7 " style="margin-top:7px">
                        <?php echo $page->show(3); ?>
                    </div>
                </div>
            </div>
            <div>

            </div>
        </div>
</div>

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>