<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>一级分类排序</title>
<link rel="shortcut icon" href="favicon.ico"> 
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.col-sm-2 {width:16.6666667%}
</style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div id="manage_top " class="menu_top_fixed  ">
        <div class="ibox-title fl mr15">
            <h3 class="fl ml15">N级分类排序</h3>
            <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>"style="margin-left:15px;color:#788188"><i class="up-level"></i>上一级</a></div>
        <div class="ibox-tools" >
            <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                <i class="reflash"></i>
            </a>
        </div>
        </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                       <tr class="gray-bg">
                           <th style="width:10%" >栏目ID</th>
                           <th style="width:40%" >栏目名称</th>
                           <th style="width:10%">序号</th>
                           <th style="width:40%" >一级栏目操作</th>
                       </tr>
                        </thead>
                        <tbody>
                       <?php
						 $html = '';
						 foreach($appcategory as $k=>$v)
						 {
							  $UpMoveNum = $GLOBALS['db']->getOne("select count(*) from `$CategoryModel->table` where parentid=$v[parentid] and orderid<$v[orderid]");  
							  $DownMoveNum = $GLOBALS['db']->getOne("select count(*) from `$CategoryModel->table` where parentid=$v[parentid] and orderid>$v[orderid]");
							
							  $html .= "<tr>
										<td >$v[categoryid]</td>
										<td>".KS_INDENT($v['depth']);
							  if($v['child']<=0)
							  {$html .= "<i class='fa fa-minus'></i>&nbsp;&nbsp;";}else{$html .= "<i class='fa fa-plus'></i>&nbsp;&nbsp;";};
							  $html .= "$v[categoryname]</td>
										<td>$v[orderid]</td>
										<td>
											<div class='form-group'>";
												if($v['parentid']!=0&&$UpMoveNum>0)
												{				
												$html .= "<form target='hidframe'  method='post' action='".M_URL($this->AppName.'/Index','byAllUp',$v['categoryid'],GP('p-'.$page->now_page))."' class='form-horizontal'>
																	<div class='col-sm-2'>
																		  <select class='form-control' name='MoveNum'>
																					<option>向上移动</option>";
																		   for($i=1;$i<$UpMoveNum+1;$i++)
																		   {
																		   $html .= "<option value='$i'>$i</option>";
																		   }
																$html .= "</select>
														            </div>
																	<div class='col-sm-2'>
																		<button type='submit' class='btn btn-primary'>修改</button>
																	</div>
														 </form>";
												}
												if($v['parentid']!=0&&$DownMoveNum>0)
												{
												$html .= "<form target='hidframe'  method='post' action='".M_URL($this->AppName.'/Index','byAllDown',$v['categoryid'],GP('p-'.$page->now_page))."' class='form-horizontal'>
																	<div class='col-sm-2'>
																		     <select class='form-control' name='MoveNum'>
																			            <option>向下移动</option>";
																			 for($i=1;$i<$DownMoveNum+1;$i++)
																			 {
																			  $html .= "<option value='$i'>$i</option>";
																			 }
															    $html .= "</select>
														            </div>
																	<div class='col-sm-2'>
																		<button type='submit' class='btn btn-primary'>修改</button>
																	</div>
														</form>";
												}
							$html .= "</div>
								   </td>
									</tr>";
							 }
						 echo $html;
						?>
                        </tbody>
                    </table>
                </div>
                <div class="footer-page">  <?php echo $page->show(3); ?></div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
</body>
</html>