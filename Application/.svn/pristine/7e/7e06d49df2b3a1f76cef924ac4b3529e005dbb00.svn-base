<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico"> 
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<title>字段管理</title>
</head>
<body class="gray-bg">
<div id="manage_top" class="menu_top_fixed height73 p15" st>
      <div class="ibox-title fl mr15 ml15">
        <h3 class="fl" style="margin-top:-2px"><?php echo $table['itemname'].$tableModel->prefix.$table['tablename'];?>自定义字段nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-rounded btn-s-md mt7" href="<?php echo M_URL('Setting','fieldGroup',$tableid); ?>" >字段分组</a></h3>
      <a onclick="fnClickAddRow();" href="<?php echo M_URL('Setting','addField',$tableid); ?>" class="btn btn btn-info btn-rounded btn-s-md mt7 ml15">新增字段</a>
        </div>
        </div><br/><br/><br/>
        <div class="ibox-tools" >
        	<button class="ks-bt" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
            <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                <i class="icon iconfont">&#xe6aa</i>
            </a>
        </div>
    </div>
 <div class="wrapper mt400" style="margin-top: 75px;">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                
                    <div class="ibox-content">
                        <div class="panel-heading">
                        <?php
						$html = '';
						foreach($fieldgroup as $k=>$v)
						{
							$html .= "<a href='".M_URL('Setting','indexField',$tableid,GP("groupid-$v[groupid],p-$page->now_page"))."'>$v[groupname]&nbsp;&nbsp;&nbsp;</a>";
						}
						echo $html;
						 ?>
                         </div>
                        <table class="table table-striped table-bordered table-hover" id="editable">
                            <thead>
                                <tr>
                                   <th>排序</th>
                                   <th>字段别名</th>
                                   <th>字段名称</th>
                                   <th>类型</th>
                                   <th>管理项</th>
                                   <th>录入项</th>
                                   <th>必填项</th>
                                   <th>状态</th>
                                   <th>小组</th>
                                   <th>编辑</th>
                                   <th>删除</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
							 $html = '';
							 foreach($pagefields as $k=>$v)
							{
								$html .= "<tr class='gradeX'>
                                           <td> <select class='sol-sm-6 form-control'>";
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
                                    <td>$v[title]</td>
                                    <td>$v[fieldname]</td>
                                    <td class='center'>".KS_FieldType($v['fieldtype'])."</td>";
									if($v['manageitem']==1)
									{
										$html .= "<td><a class='ok-icon ok-pe1' field=manageitem state=1 fieldid=$v[fieldid]></a></td>";
									}else{
										$html .= "<td><a class='ok-icon ok-pe1 ok-pe2' field=manageitem state=0 fieldid=$v[fieldid]></a></td>";
									}
									if($v['isentry']==1)
									{
										$html .= "<td><a class='ok-icon ok-pe1' field=isentry state=1 fieldid=$v[fieldid]></a></td>";
									}else{
										$html .= "<td><a class='ok-icon ok-pe1 ok-pe2' field=isentry state=0 fieldid=$v[fieldid]></a></td>";
									}
									if($v['mustinput']==1)
									{
										$html .= "<td><a class='ok-icon ok-pe1' field=mustinput state=1 fieldid=$v[fieldid]></a></td>";
									}else{
										$html .= "<td><a class='ok-icon ok-pe1 ok-pe2' field=mustinput state=0 fieldid=$v[fieldid]></a></td>";
									}
									if($v['status']==1)
									{
										$html .= "<td><a class='ok-icon ok-pe1' field=status state=1 fieldid=$v[fieldid]></a></td>";
									}else{
										$html .= "<td><a class='ok-icon ok-pe1 ok-pe2' field=status state=0 fieldid=$v[fieldid]></a></td>";
									}
								$html .= " <td>$v[showtitle]</td><td class='center'><a href='".M_URL('Setting','editField',$v['fieldid'],GP("tableid-$v[tableid],p-$page->now_page"))."'>修改</a></td>
									<td class='center'>";
							    if($v['fiesys']==0)
								{		
							    $html .= "-----";
								}else{
								$html .= "<a href='javascript:void(0);' onclick=\"Confirm('确定删除？,该操作不可逆','".M_URL('Setting','deleteField',$v['fieldid'],GP("tableid-$v[tableid],p-$page->now_page"))."')\">删除</a>";
									  }
								$html .= "</td>
                                </tr>";
							}
							echo $html;
							?>
                            </tbody>
                        </table>
                     <?php echo NoC($pagefields);?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<br/>

<div class="footer-page h60">
<div class="row">
<div class="col-sm-3">
<button class="btn mt10 btn-default">批量保存排序</button>
<a href="<?php echo M_URL('Setting','Preview','',GP('Fieldid-'.$v['Fieldid'].',p-'.$page->now_page)); ?>" class='btn mt10 btn-default'>预览</a>
</div>
<div class="col-sm-9 mt8" >
<?php echo $page->show(3); ?>
</div>
</div>

</div>
<script>

$(".ok-pe1").click(function(){
	 $(this).toggleClass("ok-pe2")
	 var fieldid = $(this).attr('fieldid');
	 var state = $(this).attr('state');
	 var field = $(this).attr('field');
	 if(state==0)
	 {
		 $(this).attr('state','1');
		 state=1;
		 }else{
			  $(this).attr('state','0');
			  state=0;
			  }
	 
	 var url = '/Plus/Kesion.ajax.php?act=fieldClick';
	 $.ajax({
				type:"post",
				url:url,
				data:{
					  'field':field,
					  'fieldid':fieldid,
					  'state':state
					 },
				dataType:"json",
				success:function(data){
					}
			 });
	})
</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script> 
<script>
loadScorllJs();//滚轮
</script>
</body>
</html>