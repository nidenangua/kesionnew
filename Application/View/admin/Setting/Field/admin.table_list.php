<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="//store.kesion.com/Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">	
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<title>模型列表</title>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content a" style="margin-top:65px">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" >
                <div id="manage_top" class="menu_top_fixed p15 height73">
                <div class="ibox-title fl mr15 ">
					<h3 class="">表字段扩展管理</h3>
                    </div>
                    <a onclick="fnClickAddRow();" href="<?php echo M_URL('Setting','addTable'); ?>" class=" btn btn-info btn-rounded btn-s-md mt5">新增模型</a>
                    <div class="ibox-tools">
                    	<button class="ks-bt" type="button" onclick="history.go(-1)" style="border: 1px solid #eee;"><i class="iconfont icon-fanhui"></i>返回</button>
                        <!--<a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                             <i class="reflash"></i>
                        </a>-->
                    </div>
                </div>    
                <div class="ibox-content mt10">
                    <div class="panel-heading">
                       表字段扩展管理列表
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="editable">
                        <thead>
                        <tr>
                            <th>排序</th>
                            <th>模型名称</th>
                            <th>数据表名</th>
                            <th>说明</th>
                            <th>字段管理</th>
                            <th>编辑</th>
                            <th>删除</th>
                            <th>预览</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
						$html = '';
						foreach($pagetables as $k=>$v)
                        {
                        $html .= "<tr class='gradeX'>
                            <td style='width:120px'><select class='sol-sm-6 form-control'>";
                                for($i=1;$i<=$page->totalput;$i++)
                                {
                                if($i==$v['orderid'])
                                {
                                $html .= "<option selected>$i</option>";
                                }else{
                                $html .= "<option >$i</option>";
                                }
                                }
                                $html .= "</select></td>
                            <td>$v[itemname]</td>
                            <td>".$GLOBALS['config']['DB_PREFIX']."$v[tablename]</td>
                            <td class='center'>$v[intro]</td>
                            <td class='center'><a href='".M_URL('Setting','indexField',$v['tableid'],GP('p-'.$page->now_page))."'>字段管理</a></td>
                            <td class='center'><a href='".M_URL('Setting','editTable',$v['tableid'],GP('p-'.$page->now_page))."'><i class='edit2017'>&#xe6ce</i></a></td>
                            <td class='center'><a href='javascript:void(0);' onclick=\"Confirm('确定删除？,该操作不可逆','".M_URL('Setting','deleteTable',$v['tableid'],GP('p-'.$page->now_page))."')\"><i class='delete2017'></i></a></td>
							<td class='center'><a class='form-bule' href='".M_URL('Setting','fieldPreview','',GP('tableid-'.$v['tableid'].',p-'.$page->now_page))."'>预览</a></td>
                        </tr>";
                        }
                        echo $html;
                        ?>
                        </tbody>
                    </table>
                  <?php echo NoC($pagetables);?>
                </div>
            </div>
            
        </div>
    </div>
</div>
 <div class="footer-page h60">
<div class="col-sm-5">
      <button type="submit" class="btn mt10 btn-default" name="batch" value="2" >批量保存</button>
</div> 

<div class="col-sm-7 mt10">
<?php echo $page->show(3); ?>
</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	loadScorllJs();//滚轮
	var selectInputs = $('.check0');
	var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)
</script>
</body>
</html>