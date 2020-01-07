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
    .page-box {margin-top:15px}
    #icon-name a {position:relative}
    .table {border:0;border-top:1px solid #eee}
            .tabs-container {border: 1px solid #eaeef1;}
</style>
</head>
<body class="gray-bg" style="background-color: #f3f3f3">
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batchDelTk','',GP('')) ?>" method="post">
<div class="wrapper"  style="margin-top: 55px">
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
                <li ><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>">试卷管理</a></li>
                <li class="active"><a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('')); ?>">题库管理</a></li>
            </ul>
        <div class="p15 bg-white row" style="margin: 0">
            <div class="col-sm-7"></div>
            <div class="col-sm-5">
                <div class="search-main fr">
                    
                    <div class="search-box w180 fl">
                        <label class="fl mt7 control-label">
                            搜索试卷
                        </label>
                        <select class="form-control  input-sm w90  inline" id="keytype">
                            <option value="1">试题标题</option>
                        </select>

                    </div>
                    <div class="search-box w240 fl" >
                        <div class="input-group">
                            <input type="text" class=" form-control input-sm w180 fl" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
                      <span class="input-group-btn ">
                        <button class="btn btn-sm btn-default  fl" type="button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','TkIndex'); ?>','<?php echo URL_MODEL;?>')">Go!</button>
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
                     <th style="width:100px"> 序号</th>
                     <th > 题目类型</th>
                     <th >专业分类</th>
                     <th >对应课程</th>
                     <th >标题</th>
                     <th >参考答案</th>
                     <th >录入人员</th>
                     <th >操作</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($tk as $k=>$v){
                      
                             if($v['tktype'] == 1){
                                $tktype = '选择题';
                                $option=explode("$$$",$v['options']);
                                $v['options']=$option[0];
                            }elseif($v['tktype'] == 2){
                                $tktype = '填空题';
                            }elseif($v['tktype'] == 3){
                                $tktype = '判断题';
                            }elseif($v['tktype'] == 4){
                               $tktype = '问答题';
                               $anser = explode("$$$",$v['anser']);
                               $v['anser']=$anser[0];
                            }elseif($v['tktype'] == 5){
                               $tktype = '材料题';
                               $option=explode("$$$",$v['options']);
                               $v['options']=$option[0];
                               $anser = explode("|$|",$v['anser']);
                               $v['anser']=$anser[0];
                            }elseif($v['tktype'] == 6){
								$tktype = '选择题';
                                $option=explode("$$$",$v['options']);
                                $v['options']=$option[0];
							}
                    ?>
                    <tr>
                       <td><input type="checkbox" class=" verAlignMiddle mr10 " value="<?php echo $v['tkid'] ?>" name="id[]">
                       <label class="control-label"><?php echo $v['tkid'] ?></label></td>
                       <td><?php echo $tktype ?></td>
                       <td><?php echo $v['categoryname'] ?></td>
                       <td><?php echo $v['coursename'] ?></td>
                       <td><?php echo trim($v['options'])?></td>
                       <td><?php echo $v['anser'] ?></td>
                       <td ><?php echo $v['inputer'] ?></td>
                       <td id="icon-name"> 
                           <a href="<?php echo M_URL($this->AppName.'/Index','editTk',$v['tkid'],GP('userid-'.$v['userid'].',p-'.$page->now_page)); ?>" >
                           <em class="editor">编辑<i class="arrow-down"></i></em><i class="iconfont edit2017"></i> </a>
                           <a href="javascript:void(0);" onclick="Confirm('是否删除此试题？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delTk',$v['tkid'],GP('p-'.$page->now_page)); ?>')"><em class="editor">删除<i class="arrow-down"></i></em><i class="iconfont delete2017"></i> </a>
                           </td>
                       </tr>
                   <?php } ?>
                </tbody>
            </table>
            <?php echo NoC($tk);?> 
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
    </div>
    <div class="col-sm-7"><?php echo $page->show(3); ?></div>
</div>
</form>
<script>
    $(function(){
        $('.nav-tabs li').click(function(){
            $(this).addClass('active').siblings().removeClass('active');
            $(' .tab-content>.tab-pane:eq('+$(this).index()+')').show().siblings().hide();
        })
    });
</script>
<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
var selectInputs = $('.verAlignMiddle'); // 所有勾选框
var checkAllInputs = $('.check-all') // 全选框
selectall(selectInputs,checkAllInputs);

    //添加课时
function selectUser(url){	
layer.open({
        type: 2,
        area: ['850px', '600px'],
        fixed: false, //不固定
        maxmin: true,
		 title: ['选择用户', 'font-size:18px;'],
        content:url
    });
};
$('#icon-name a').find('.iconfont').hover(function(){
			$(this).siblings('em').fadeIn(300)
		},function(){
			$(this).siblings('em').stop().fadeOut(300);
		});
		$('.r-icon').on('click','.iconfont',function(){
			event.stopPropagation();
		});
</script>
</body>
</html>