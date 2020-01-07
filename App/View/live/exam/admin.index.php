<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
 <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
    .panel-body {
        padding: 20px !important;
    }
    .table > tbody > tr:nth-child(even) > td, .table tr th{
        background-color: #f7fafa;
    }
    .table > tbody > tr:nth-child(odd) > td, .table tr th{
        background-color: #fff;
    }
    .panel-heading {
        background-color: #f7fafa;
        color: #333;
        border-radius: 2px 2px 0 0;
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
    }
    .nav-tabs0 {
        position: relative;
        display: inline-block;
        vertical-align: middle;
    }
    .nav-tabs0 li.active {
        color: #788188 !important;
        background-color: #f2f2f2;
        border-color: #c2ced6;
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
    }
    .nav-tabs0 li {
        ont-weight: 500;
        border-radius: 2px;
        width: 58px;
        height: 28px;
        line-height: 28px;
        padding: 0;
        font-size: 12px;
        display: inline-block;
        vertical-align: middle;
        border: 1px solid transparent;
        color: #788188 !important;
        background-color: #fff;
        border-color: #dbe2e7;
        border-bottom-color: #d5dde3;
        -webkit-box-shadow: 0 1px 1px rgba(90,90,90,0.1);
        box-shadow: 0 1px 1px rgba(90,90,90,0.1);
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        margin-left: -4px;
        border-color: #dbe2e7;
        border-bottom-color: #d5dde3;
    }
    .bg-white {
        background: white;
    }
    .tabs-container .panel-body {padding: 0!important;}
    .mt7{margin-top: 7px}
    .w160{width: 160px}
    #icon-name a {position:relative}
    .table {border:0;border-top:1px solid #eee}
            .tabs-container {border: 1px solid #eaeef1;}
</style>
</head>
<body class="gray-bg" style="background-color: #f3f3f3">
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','paperbatch',GP('p-'.$page->now_page)) ?>" method="post">
<div class="wrapper"  style="margin-top: 75px">
    <div class="row">
        <div id="manage_top " class="menu_top_fixed height73 p15">
            <div class="ibox-title">
                <h3 class="fl">考试管理</h3>
                <a class="btn btn-info btn-rounded btn-s-md " href="<?php echo M_URL($this->AppName.'/Index','paperAdd','',GP('')); ?>"
                 style="margin-left:15px">试卷添加</a>
                <a class="btn btn-info btn-rounded btn-s-md " href="<?php echo M_URL($this->AppName.'/Index','addTk','',GP('')); ?>" 
                style="margin-left:15px">题库添加</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>">试卷管理</a></li>
                <li><a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('')); ?>">题库管理</a></li>
            </ul>
        <div class="p15 bg-white row" style="margin: 0">
            <div class="col-sm-4">
                <button  type="button" class="btn  btn-primary">导入试卷 </button>
                <a href="<?php echo M_URL($this->AppName.'/Index','scoreRank','',GP('')); ?>">
                <button  type="button" class="btn btn-primary">分数设置</button>
                </a>
                <a href="<?php echo M_URL($this->AppName.'/Index','paperType','',GP('')); ?>">
                <button  type="button" class="btn  btn-primary"> 试卷类型 </button>
                </a>
            </div>
            <div class="col-sm-3">
            <ul class="nav-tabs0">
                <li <?php if($stat==3)echo "class='active'";?>>
                <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,isweb-$this->isweb,userid-$this->userid,status-3",true)); ?>"> 所有</a>
                </li>
                <li <?php if($stat==1)echo "class='active'";?>>
                <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,isweb-$this->isweb,userid-$this->userid,status-1",true)); ?>">已审核</a>
                </li>
                
                <li <?php if($stat==0)echo "class='active'";?>>
                <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,isweb-$this->isweb,userid-$this->userid,status-0",true)); ?>">待审核</a>
                </li>
            </ul>
            </div>
            <div class="col-sm-5">
                <div class="search-main fr">
                    <div class="search-box w180 fl">
                        <label class="fl mt7 control-label">
                            搜索试卷
                        </label>
                        <select class="form-control  input-sm w90  inline" id="keytype">
                            <option value="0" <?php if($keytype==0){echo 'selected="selected"';} ?>>请选择</option>
                            <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>试卷名称</option>
                            <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>试卷类型</option>
                            <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>试卷录入员</option>
                        </select>

                    </div>
                    <div class="search-box w240 fl" >
                        <div class="input-group">
                            <input type="text" class=" form-control input-sm w180 fl" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
                      <span class="input-group-btn ">
                        <button class="btn btn-sm btn-default  fl" type="button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">Go!</button>
                      </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="tab-content">
    <div class="tap-pane" style="display: block">
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                <tr>
                    <th> ID</th>
                    <th> 考卷名称</th>
                    <th>专业分类</th>
                    <th>试卷类型</th>
                    <th>难度</th>
                    <th>状态</th>
                    <th>考试人数</th>
                    <th>考试情况</th>
                    <th>录入人员</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                        <?php foreach($paper as $k=>$v){ $level='';if($v['paper_level'] == 1){ $level ='简单';}
                        elseif($v['paper_level'] == 2){$level ='一般';}else{$level ='困难';} $stat='';if($v['Status']==0){$stat='未审核';}else{ $stat='已审核';} ?>
                <tr>
                    <td>
                        <div class="checkbox checkbox-info checkbox-inline">
                            <input id="paper<?php echo $v['paperid'] ?>" type="checkbox" value="<?php echo $v['paperid'] ?>"  class="verAlignMiddle" name="id[]">
                            <label for="paper<?php echo $v['paperid'] ?>"> <?php echo $v['paperid'] ?></label>
                        </div>
                       
                    </td>
                    <td> <a href="<?php echo M_URL($this->AppName.'/Index','paperAddTk',$v['paperid'],GP('')); ?>" >
                              <p class="clearfix hLh20 mt5"><?php echo $v['Title'] ?></p></a>
                              <p class="clearfix hLh20 mt5">
                                 <span class="fl hlh20 ">试题总数：20</span>
                                 <span class="fl hlh20 ">试卷总分：<?php echo $v['ExamScore'] ?></span>
                                 <span class="fl hlh20 ">考卷时间:<?php echo $v['exam_time'] ?></span>
                             </p>
                    </td>
                    <td><?php echo $v['categoryname'] ?></td>
                    <td><?php echo $v['typeName'] ?></td>
                    <td><?php echo $level ?></td>
                    <td><?php echo $stat ?></td>
                    <td>1</td>
                    <td>查看</td>
                    <td><?php echo $v['inputer'] ?></td>
                    <td id="icon-name">
                      <a href="<?php echo M_URL($this->AppName.'/Index','preview',$v['paperid'],GP('p-'.$page->now_page)); ?>">
                        <em class="editor">预览<i class="arrow-down"></i></em><i class="show2017 iconfont"></i> </a> 
                      <a href="<?php echo M_URL($this->AppName.'/Index','editpaper',$v['paperid'],GP("userid-$v[userid],p-$page->now_page")); ?>">
                        <em class="editor">编辑<i class="arrow-down"></i></em><i class="edit2017 iconfont"></i> </a>
                      <a href="javascript:void(0);" onclick="Confirm('是否删除此试卷？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delPaper',$v['paperid'],GP('p-'.$page->now_page)); ?>')"> <em class="editor">删除<i class=" arrow-down"></i></em><i class=" iconfont delete2017"></i> </a>
                   </td>
                </tr>
                   <?php } ?>          
                </tbody>
            </table>
             <?php echo NoC($paper);?> 
        </div>
    </div>
</div>
     </div>
</div>


</div>
<div class="footer-page" style="height: 60px">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input id="checkboxAll" name="check1" type="checkbox" class="check-all verAlignMiddle">
            <label for="checkboxAll">
                全选
            </label>
        </div>
        <button class="btn mt10 btn-default" type="submit" value="1" name="type">删除</button>
        <button class="btn mt10 btn-default" type="submit" value="2" name="type">通过审核</button>
        <button class="btn mt10 btn-default" type="submit" value="3" name="type">取消审核</button>
    </div>
    <div class="col-7 mt15">
    	<?php echo $page->show(3); ?>
    </div>
  
</div>
</form>

<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
   
taps();//选项卡
addclass();//添加课时
  var selectInputs = $('.verAlignMiddle'); // 所有勾选框
var checkAllInputs = $('.check-all') // 全选框
selectall(selectInputs,checkAllInputs);

</script>
</body>
</html>