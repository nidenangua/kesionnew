<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content mt55 animated fadeIn"  >
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
              <h3 class="fl" ></h3>
              <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                       <i class="reflash"></i>
                    </a>
              </div>
<a  href="" class="btn btn-info btn-rounded btn-s-md " style="color:#676a6c;margin-left:20px"> 添加</a>
            </div>
        </div>
    </div>
    <div class="row"><br />
        <div class="col-sm-12 ">
            <div class="tabs-container">
             <ul class="nav nav-tabs">
                <li <?php if($option==3)echo "class='active'";?>>
                <a href="<?php echo M_URL('home/Domain','index','',GP('option-3')); ?>"> 所有</a>
                </li>
                <li <?php if($option==2)echo "class='active'";?>>
                <a href="<?php echo M_URL('home/Domain','index','',GP('option-2')); ?>">已审核</a>
                </li>
                </li>
                <li <?php if($option==1)echo "class='active'";?>>
                <a href="<?php echo M_URL('home/Domain','index','',GP('option-1')); ?>">待审核</a>
                </li>
            </ul>
                <div class="taps-button">
                    <div class="row btn-choice">
              <a href="<?php if($hits==1){echo M_URL('home/Domain','index','',GP('hits-0'));}else{echo M_URL($this->AppName.'/index','index','',GP('hits-1'));} ?>"></a>
                    </div>
                </div>
                <form target="hidframe" id="myform" action="<?php echo M_URL('home/Domain','batch','',GP('p-'.$page->now_page)) ?>" method="post">
                    <div class="tab-content">
                      <div id="tab-1" class="tab-pane active" style="">
                        <div class="panel-body" style="padding:0">
                           <div class="row">
                              <div class="col-sm-12 ">
                                 <div class="ibox float-e-margins pt15">
                                    <div class="ibox-content">
                                     <table class="table table-bordered ">
                                        <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>网校id</th>
                                            <th>用户id</th>
                                            <th>绑定域名</th>
                                            <th>暂存域名</th>
                                            <th>审核状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                                      <?php foreach($values as $k=>$v){?>
                                        <tr>
                                            <td>
                                                <div class="checkbox  checkbox-info" >
                                            <input id="C<?php echo $v["id"];?>" type="checkbox" name="check[]" value="<?php echo $v["id"];?>" class="check0">
                                            <label for="C<?php echo $v["id"];?>"><?php echo $v["id"];?></label>
                                                </div>
                                            </td>
                                            <td><?php echo $v["wxid"];?></td>
                                            <td><?php echo $v["userid"];?></td>
                                            <td><?php echo $v["domain"];?></td>
                                            <td><?php echo $v["predomain"];?></td>
                                            <td style="width:200px">
                                            <?php if($v["status"]==2){ ?>
                                             <label class="txt-top"><a class="ok-icon ok-pe1" href="<?php echo M_URL('home/Domain','unaudited',$v['id'],GP('p-'.$page->now_page));?>" title="未审核"></a></label>
                                            <?php }elseif($v["status"]==1){ ?>
                                             <label class="txt-top"><a class="ok-icon ok-pe2" href="<?php echo M_URL('home/Domain','audited',$v['id'],GP('p-'.$page->now_page));?>" title="审核"></a></label>
                                            <?php } ?>
                                            </td>
                                            <td style="width:200px"><label class="txt-top">
                                                <a onclick="addTypeChange('<?php echo M_URL('home/Domain','editDomain',$v['id'],GP('p-'.$page->now_page));?>','450px','250px')"><i class='edit2017'></i></a></label>
                                                <label class="txt-top">
                                                <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo M_URL('home/Domain','delect',$v['id'],GP('p-'.$page->now_page));?>')"><i class="delete2017"></i></a></label>
                                            	<label class="txt-top">
                                            		<a onclick="addTypeChange('<?php echo M_URL('home/Ico','massage',$v['id'],GP('p-'.$page->now_page));?>','800px','650px')">
                                            			<i class="show2017"></i>
                                        			</a>
                                            	</label>
                                            </td>
                                        </tr>
                                     <?php } ?>
                                     </tbody>
                                    </table>
                                    <?php echo NoC($values);?> 
                                    </div>
                                 </div>
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
                                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="2">
                                        批量审核
                                    </button>
                                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="3">
                                        取消审核
                                    </button>
                                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="1">
                                       批量删除
                                    </button>
                                </div>
                                <div class="col-sm-7 "  style="margin-top:7px">
                                    <?php echo $page->show(3); ?>
                                </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                            </div>
                        </div>
                      </div>
                    </div>
                </form>
           </div>
       </div>
    </div>
</div>

</script>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	loadScorllJs();//滚轮
	var selectInputs = $('.check0');
	var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)
	buttonTap()//按钮样式切换
    function attributeSelect(url)
    {
        window.location.href=''+url;
    }

    function do_reg()
    {
	   $("#myform").submit();	
    }
</script>
</body>
</html>
