<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<title>应用分类</title>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content mt55 animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
               
                <div id="manage_top" class="menu_top_fixed height73 p15">
                        <h3 class="fl mr15"><?php echo $this->title; ?></h3>
						<a class="btn btn-info btn-rounded btn-s-md mt5" href="<?php echo M_URL($this->AppName.'/Index','addCategory','',GP('')); ?>" class="btn-submit"> 添加应用分类</a>
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                           <i class="reflash"></i>
                        </a>
                    </div>
                    <ul>
                        <li id="p2"> 　<a href="<?php echo M_URL($this->AppName.'/Index','byOne','',GP('')); ?>"> <i class="one2017"></i>一级排序</a></li>
                        <li id="p3">　<a href="<?php echo M_URL($this->AppName.'/Index','byAll','',GP('')); ?>"> <i class="n2017"></i>N级排序</a></li>

                        </li>
                    </ul>
                </div>

                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover CTable " id="editable">
                        <thead>
                        <tr>
                            <th style="width:10%">栏目ID</th>
                            <th style="width:20%">分类名称</th>
                            <th style="width:15%">英文名</th>
                            <th style="width:20%">介绍</th>
                            <th style="width:15%">序号</th>
                            <th style="width:10%">编辑</th>
                            <th style="width:10%">删除</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
						$html = '';
						foreach($values as $k=>$v)
						{
							$html .= "<tr class='gradeX' attr='$v[parentidpath]' id='sub$v[categoryid]'>
											<td>$v[categoryid]</td>
											<td class='Ctd' onclick=\"getC_Child('".M_URL($this->AppName.'/Ajax','getC_Child','',GP('p-'.$page->now_page))."','$v[categoryid]');\">";
							if($v['child']>0)
							{		
							  $html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='0' at='$v[parentidpath]' attr=''><i class='close2017'></i></a>";
							}else{
								$html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='1' at='$v[parentidpath]' attr=''><i class='open2017'></i></a>";
							}
							$html .= "$v[categoryname]</td>
							<td>$v[categoryename]</td>
							<td>$v[intro]</td>
							<td>$v[rootid]</td>
							<td><a href='".M_URL($this->AppName.'/Index','editCategory',$v['categoryid'],GP('p-'.$page->now_page))."'><i class='edit2017'></i></a></td>
							<td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类？该操作不可逆！请确保该分类下无产品','".M_URL($this->AppName.'/Index','delCategory',$v['categoryid'],GP('p-'.$page->now_page))."')\"><i class='delete2017'></i></a></td>
							</tr>";
						}
						echo $html;
						?>
                        </tbody>
                    </table>
                    <?php echo NoC($values);?> 
                </div>
                <div class="footer-page">
                    <?php echo $page->show(3); ?>
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