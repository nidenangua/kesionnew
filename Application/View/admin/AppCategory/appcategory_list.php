<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<title>应用分类</title>
</head>
<body class="gray-bg">
<div class="wrapper mt55">
        <div class="row">
            <div id="manage_top" class="menu_top_fixed p15 height73">
             <h3 class="fl mr15">应用分类</h3>
                <a href="<?php echo M_URL('AppCategory','addCategory'); ?>"class="btn btn-default btn-rounded btn-s-md mt5">添加应用分类</a>
                <a href="<?php echo M_URL('AppCategory','byOne'); ?>" class="btn btn-default btn-rounded btn-s-md mt5">一级排序</a>
                <a href="<?php echo M_URL('AppCategory','byAll'); ?>" class="btn btn-default btn-rounded btn-s-md mt5">N级排序</a>
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
                           <th style="width:15%">套餐名称</th>
                           <th style="width:15%">原来价格</th>
                           <th style="width:15%">实际价格</th>
                           <th style="width:20%">图标</th>
                           <th style="width:15%">序号</th>
                           <th style="width:10%">编辑</th>
                           <th style="width:10%">删除</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $html = '';
						foreach($appcategory as $k=>$v){
                           $html .= "<tr class='gradeX' attr='$v[parentidpath]' id='sub$v[categoryid]'>
									<td>$v[categoryid]</td>
									<td class='Ctd' onclick=\"getC_Child('".M_URL('Ajax','getC_Child','',GP('p-'.$page->now_page))."','$v[categoryid]','AppCategory');\">";
						   if($v['child']>0){		
						        $html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='0' at='$v[parentidpath]' attr=''><i class='close2017'></i></a>";
						   }else{
								$html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='1' at='$v[parentidpath]' attr=''><i class='open2017'></i></a>";
						   }
						   $html .= Field($v['categoryname'])."</td>
									<td>".Field($v['packagename'])."</td>
									<td>".Field($v['market_price'])."</td>
									<td>".Field($v['price'])."</td>
									<td>".Field($v['fonts'])."</td>
									<td class='center'>".Field($v['rootid'])."</td>
									<td class='center'><a href='".M_URL('AppCategory','editCategory',$v['categoryid'],GP('p-'.$page->now_page))."'><i class='edit2017'></i></a></td>
									<td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类？该操作不可逆！请确保该分类下无产品','".M_URL('AppCategory','deleteCategory',$v['categoryid'],GP('p-'.$page->now_page))."')\"><i class='delete2017'></i></a></td>
                                </tr>";
                        }
						echo $html;?>
                        </tbody>
                    </table>
                <?php echo NoC($appcategory);?>     
                </div>
                <div class="footer-page">
                <?php echo $page->show(3); ?>
                </div>
                
                
                
                <div class="footer-page h60">
            

		            <div class="clearfix" style="margin-top:7px">
		            	 <?php echo $page->show(3); ?>
		           	</div>
			
			
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