<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<title>问题分类</title>
</head>
<body class="gray-bg">
<div class="wrapper mt55">
        <div class="row">
            <div id="manage_top" class="menu_top_fixed p15 height73">
             <h3 class="fl mr15">问题分类</h3>
                <a onclick="addTypeChange('<?php echo M_URL('Offweb','questionClassifyManage','',GP('')) ?>','850px','600px',{title:'新增分类',type:'top'})" class="btn btn-default btn-rounded btn-s-md mt5">添加问题分类</a>
                
                <div class="ibox-tools" >
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                        <i class="reflash"></i>
                    </a>
                </div>
            </div><br /><br />
                <div class="ibox-content">
                 <div class="panel-heading">
                 应用分类列表
                 </div>
                    <table class="table table-striped table-bordered table-hover CTable " id="editable">
                        <thead>
                        <tr>
                           <th style="width:10%">分类ID</th>
                           <th style="width:20%">分类名称</th>
                           <th style="width:15%">序号</th>
                           <th style="width:10%">编辑</th>
                           <th style="width:10%">删除</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
						foreach($appcategory as $k=>$v){?>
                          <tr>
                          	<td><?php echo $v['categoryid']?></td>
                          	<td><?php echo $v['categoryname']?></td>
                          	<td><?php echo $k+1 ?></td>
                          	<td>
                                  <a onclick="addTypeChange('<?php echo M_URL('Offweb','questionClassifyManage',$v['categoryid'],GP('')) ?>','850px','600px',{title:'新增渠道',type:'top'})">
                                      <i class="iconfont icon-bianji1"></i>
                                      <p class="class-name">编辑</p>
                                  </a>
                          	</td>
                          	<td>
                          		<a href="javascript:void(0);"  onclick="Confirm('是否删除此分类？该操作不可逆!','<?php echo M_URL('Offweb','deleteQuestionClassify',$v['categoryid'],GP('p-'.$now_page)); ?>')">
									<i class="iconfont icon-lajitong1"></i>
									<p class="class-name">删除</p>
								</a>
                          	</td>
                          </tr>
                         <?php  }?>
                        </tbody>
                    </table>
                <?php echo NoC($appcategory);?>     
                </div>
                <div class="footer-page">
                <?php echo $page->show(3); ?>
                </div>
            </div>
</div>
<br/>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
</body>
</html>