<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
 <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head> 
<body class="gray-bg" style="background-color: #f3f3f3">
<form target="hidframe" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','paperbatch',GP('p-'.$page->now_page)) ?>" method="post">
<div class="wrapper"  style="margin-top: 75px">
    <div class="row">
        <div id="manage_top " class="menu_top_fixed height73 p15">
            <div class="ibox-title">
                <h3 class="fl">考试管理</h3>
                 <div class="col-sm-4">
                    <button  type="button" class="btn  btn-primary">导入试卷 </button>
                    <a href="<?php echo M_URL($this->AppName.'/Index','scoreRank','',GP('')); ?>">
                    <button  type="button" class="btn btn-primary">分数设置</button>
                    </a>
                    <a href="<?php echo M_URL($this->AppName.'/Index','paperType','',GP('')); ?>">
                    <button  type="button" class="btn  btn-primary"> 试卷类型 </button>
                    </a>
                </div>
                <div class="col-sm-7">
                    <div class="fl" style="margin-right: 100px;">
                        试卷总数：<span style="font-size: 20px;color: #0e33b7;"><?php echo $options['totalput'];?></span>
                    </div>
                    <div class="fl" style="margin-right: 100px;">
                        本月新增数量：<span style="font-size: 20px;color: #0e33b7;"><?php echo $montncount;?></span>
                    </div>
                    <div class="fl" style="margin-right: 100px;">
                        今日新增数量：<span style="font-size: 20px;color: #0e33b7;"><?php echo $daycount;?></span>
                    </div>
                </div>
                <!-- <a class="btn btn-info btn-rounded btn-s-md " href="<?php echo M_URL($this->AppName.'/Index','paperAdd','',GP('')); ?>"
                 style="margin-left:15px">试卷添加</a>
                <a class="btn btn-info btn-rounded btn-s-md " href="<?php echo M_URL($this->AppName.'/Index','addTk','',GP('')); ?>" 
                style="margin-left:15px">题库添加</a> -->
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
           
            <div class="col-sm-7">
            <ul class="nav-tabs0">
                <li <?php if($stat==3)echo "class='active'";?>>
                <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,status-3")); ?>"> 所有</a>
                </li>
                <li <?php if($stat==1)echo "class='active'";?>>
                <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,status-1")); ?>">已审核</a>
                </li>
                
                <li <?php if($stat==0)echo "class='active'";?>>
                <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,status-0")); ?>">待审核</a>
                </li>
                <?php if($distr==1){?>
                <li class='active'>
                   <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("distr-0")); ?>">分销</a>
                </li>
            <?php }else{?>
             <li >
                   <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("distr-1")); ?>">分销</a>
                </li>
            <?php }?>
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
            <table class="ks-table">
                    <thead>
                        <tr>
                            <th>选择</th>
                            <th style="text-align:left">试卷名称</th>                           
                            <th>所属网校</th>
                            <!-- <th style="text-align:left">对应课程</th> -->
                            <th>试卷类型</th>
                            <th>价格</th>
                            <th>添加者</th>
                            <th>考试时间</th>
                            <!-- <th>推广</th> -->
                            <th>题目类型</th>
                             <th >试卷总分</th>
                            <th>是否上架</th>
                            <th>删除</th>
                            <th>分销审核</th>
                        </tr>
                    </thead>
                    <tbody>
<?php foreach($paper as $k=>$v){$level='';if($v['paper_level'] == 1){ $level ='简单';}elseif($v['paper_level'] == 2){$level ='一般';}else{$level ='困难';}?> 
<tr>
    <td style="width:30px"><input type="checkbox" class="select-checks " name="paperid[]" value="<?php echo $v['paperid']; ?>"></td>
    <td style="text-align:left"><a href="<?php echo $v['jumpurl'];?>" target="_blank"><?php echo $v['Title'];?></a></td>
        <td><?php echo $v['sitename'];?></td>
    <!-- <td style="text-align: left;" class="pc-md-w"><?php echo $v['coursename'];?></td> -->
    <td><?php echo $v['paperTypename'];?></td>
    <td><?php if($v['chargetype']==0){echo '免费';}elseif($v['chargetype']==2){echo '打赏';}elseif($v['chargetype']==1){echo $v['price'];}?></td>
    <td><?php echo $v['inputer'];?></td>
    <td><?php echo $v['exam_time']?>分钟</td>
    <!-- <td><a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['paperid'],GP(''));?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a></td> -->
    <td><?php if($v['exam_type']==1){echo '随机添加';}elseif($v['exam_type']==2){echo '按题目添加';}?></td>
    <td><?php echo $v['sumscore'] ?></td>
    <td>
    <span class="link-switch<?php if($v["Status"]==2){ echo ' open' ?><?php }  ?>" data-off="<?php echo M_URL($this->AppName.'/Index','down',$v['paperid'],GP('p-'.$page->now_page));?>" data-open="<?php echo M_URL($this->AppName.'/Index','up',$v['paperid'],GP('p-'.$page->now_page)); ?>"><i></i></span>
    </td>
    <td class="ks-head-el">
        <span onclick="Confirm('是否删除班级？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delete',$v['classid'],GP('')); ?>')"><i class="iconfont icon-lajitong"></i></span>
    </td>
    <td>
                    <?php if($v["audit"]==1){ ?>
                       <span class="grayLing"></span><a class="deepBlue ok-icon ok-pe1 "  title="免费试用"></a>
                    <?php }else{ ?>
                       <span class="grayLing"></span><a class="deepBlue ok-icon ok-pe2"  title="正常缴费"></a>
                    <?php } ?>
                </td>
</tr>
<?php }?>
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
            <input id="checkboxAll" name="check1" type="checkbox" class="selectAll">
            <label for="checkboxAll">
                全选
            </label>
        </div>
        <input type="hidden" name="batch" id="batch1" />
         <button class="btn mt10 btn-default" type="button"   onclick="submitform(2)" value="4">批量审核</button>
        <button class="btn mt10 btn-default" type="button"   onclick="submitform(3)" value="4">取消审核</button>
        <button class="btn mt10 btn-default" type="button"   onclick="submitform(1)" value="4">批量删除</button>
        <button class="btn mt10 btn-default" type="button"   onclick="submitform(4)" value="4">分销审核</button>
    </div>
    <div class="col-7 mt15">
    	<?php echo $page->show(3); ?>
    </div>
  
</div>
</form>

<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script>
    $('.link-switch').each(function(){
        setLinkSwitch(this)
    })
taps();//选项卡
addclass();//添加课时
  var selectInputs = $('.verAlignMiddle'); // 所有勾选框
var checkAllInputs = $('.check-all') // 全选框
selectall(selectInputs,checkAllInputs);
 function submitform(type){
    $('#batch1').val(type);
    $('#myform').submit();
}
</script>
</body>
</html>