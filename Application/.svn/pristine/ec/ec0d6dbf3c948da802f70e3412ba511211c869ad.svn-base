<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<title>帮助中心分类分类</title>
</head>
<body class="gray-bg">
<div class="wrapper mt55">
        <div class="row">
            <div id="manage_top" class="menu_top_fixed p15 height73">
             <h3 class="fl mr15">帮助中心分类分类</h3>
                <a href="<?php echo M_URL('Offweb','categoryManage'); ?>"class="btn btn-default btn-rounded btn-s-md mt5">添加分类</a>
                <div class="ibox-tools" >
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                        <i class="reflash"></i>
                    </a>
                </div>
                <ul>
                     <li><a href="<?php echo M_URL('Offweb','byOne'); ?>"><i class="one2017"></i>一级排序</a></li>
                     <li><a href="<?php echo M_URL('Offweb','byAll'); ?>"><i class="n2017"></i>N级排序</a></li>
                </ul>
            </div><br /><br />
                <div class="ibox-content">
                 <div class="panel-heading">
                 帮助中心分类分类列表
                 </div>
                    <table class="table table-striped table-bordered table-hover CTable " id="editable">
                        <thead>
                        <tr>
                           <th style="width:10%">分类ID</th>
                           <th style="width:20%">分类名称</th>
                           <th style="width:15%">序号</th>
                           <th style="width:15%">状态</th>
                           <th style="width:10%">编辑</th>
                           <th style="width:10%">删除</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $html = '';
						foreach($appcategory as $k=>$v){
                           $html .= "<tr class='gradeX' attr='$v[parentidpath]' id='sub$v[categoryid]'>
									<td>$v[categoryid]</td>
									<td class='Ctd' onclick=\"getC_Child('".M_URL('Ajax','getC_Child','',GP('p-'.$page->now_page))."','$v[categoryid]','Offweb');\">";
						   if($v['child']>0){		
						        $html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='0' at='$v[parentidpath]' attr=''><i class='close2017'></i></a>";
						   }else{
								$html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='1' at='$v[parentidpath]' attr=''><i class='open2017'></i></a>";
						   }
						   $html .= Field($v['categoryname'])."</td>
									<td class='center'>".Field($v['rootid'])."</td>";
							if($v['status']==2){
								$html.="<td class='center'><span class='link-switch open' style='margin: 0;'  data-off='".M_URL('Offweb','changeStatus',$v['categoryid'],GP('status-0,p-'.$page->now_page))."' data-open='".M_URL('Offweb','changeStatus',$v['categoryid'],GP('status-2,p-'.$page->now_page))."'><i></i></span></td>";
							}else{
								$html.="<td class='center'><span class='link-switch' style='margin: 0;' data-off='".M_URL('Offweb','changeStatus',$v['categoryid'],GP('status-0,p-'.$page->now_page))."' data-open='".M_URL('Offweb','changeStatus',$v['categoryid'],GP('status-2,p-'.$page->now_page))."'><i></i></span></td>";
							}
									
							$html.="<td class='center'><a href='".M_URL('Offweb','categoryManage',$v['categoryid'],GP('p-'.$page->now_page))."'><i class='edit2017'></i></a></td>
									<td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类？该操作不可逆！请确保该分类下无产品','".M_URL('Offweb','deleteCategory',$v['categoryid'],GP('p-'.$page->now_page))."')\"><i class='delete2017'></i></a></td>
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
            </div>
</div>
<br/>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
		$('.link-switch').each(function(){setLinkSwitch(this)})
		/*Ajax得到子分类*/
window.getC_Child = function(URL,ID,Controller){
	if($('#C'+ID).attr('ckdata')=="0"){
		$('#C'+ID).attr('ckdata','1');
		$('#C'+ID).html('<i class="open2017"></i>');
		if($(".CTable").find("tr[attr*='"+ID+",']").length>0){
			$(".Ctd").find("a[attr*='"+ID+",']").attr('ckdata','1');
			$(".Ctd").find("a[attr*='"+ID+",']").html('<i class="open2017"></i>');
			$(".CTable").find("tr[attr*='"+ID+",']").show();
		}else{
			$.ajax({
				type:"post",
				url:URL,
				data:{
					'Parentid':ID,
					'Controller':Controller
				},
				dataType:"json",
				success:function(data){
					$("#sub"+ID).after(data);
					$('#C'+ID).attr('ckdata','1');
					$('#C'+ID).html('<i class="open2017"></i>');
					var at=$('#C'+ID).attr('at');
					$('#C'+ID).attr('attr',at);
					$('.link-switch').each(function(){setLinkSwitch(this)})
				}
			});
		}
	}else{
		$('#C'+ID).attr('ckdata','0');
		$('#C'+ID).html('<i class="close2017"></i>');
		$(".CTable").find("tr[attr*='"+ID+",']").hide();
	}
	
}
	
	})
	

</script>
</body>
</html>