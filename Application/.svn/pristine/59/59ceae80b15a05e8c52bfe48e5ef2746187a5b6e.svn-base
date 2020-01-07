<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<title>应用分类</title> 
</head>
<body class="gray-bg">
<div class="wrapper mt55">
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div id="manage_top" class="menu_top_fixed height73 p15">
          <h3 class="fl mr15">用户分类</h3>
          <div class="ibox-tools">
             
          </div>
          <a href="<?php echo M_URL('UsersCategory','addCategory'); ?>" class="btn btn-default btn-rounded btn-s-md mt5">添加用户分类</a>
          <a href="<?php echo M_URL('UsersCategory','byOne'); ?>" class="btn btn-default btn-rounded btn-s-md mt5">一级排序</a>
          <a href="<?php echo M_URL('UsersCategory','byAll'); ?>" class="btn btn-default btn-rounded btn-s-md mt5">N级排序</a> 
          <ul>
            <li id="p2">　</li>
            <li id="p3"> </li>
          </ul>
        </div></br></br>
        <div class="panel-heading">
             用户分类
        </div>
        <table class="table table-striped table-bordered table-hover CTable " id="editable">
            <thead>
            <tr>
              <th style="width:10%">分类ID</th>
              <th style="width:20%">分类名称</th>
              <th style="width:15%">英文名称</th>
              <th style="width:20%">介绍</th>
              <th style="width:15%">序号</th>
              <th style="width:10%">编辑</th>
              <th style="width:10%">删除</th>
            </tr>
            </thead>
            <tbody>
            <?php
			$html = '';
			foreach($userscategory as $k=>$v)
            {
  $html .= "<tr class='gradeX' attr='$v[parentidpath]' id='sub$v[categoryid]'>
              <td>$v[categoryid]</td>
              <td class='Ctd' onclick=\"getC_Child('".M_URL('Ajax','getC_Child','',GP('p-'.$page->now_page))."','$v[categoryid]','UsersCategory');\">";
                if($v['child']>0)
                {
                $html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='0' at='$v[parentidpath]' attr=''><i class='close2017'></i></a>";
                }else{
                $html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='1' at='$v[parentidpath]' attr=''><i class='open2017'></i></a>";
                }
                $html .= "$v[categoryname]</td>
              <td>$v[categoryename]</td>
              <td>$v[intro]</td>
              <td class='center'>$v[rootid]</td>
              <td class='center'><a href='".M_URL('UsersCategory','editCategory',$v['categoryid'],GP('p-'.$page->now_page))."'><i class='edit2017'></i></a></td>
              <td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类？该操作不可逆！请确保该分类下无产品','".M_URL('UsersCategory','deleteCategory',$v['categoryid'],GP('p-'.$page->now_page))."')\"> <i class='delete2017'></i></a></td>
            </tr>";
            }
            echo $html;
            ?>
            </tbody>
          </table>
          <?php echo NoC($userscategory);?> 
          <div class="footer-page">
     	 <div class="mt15">  <?php echo $page->show(3); ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<br/>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$(function(){
loadScorllJs();
})
</script>
</body>
</html>