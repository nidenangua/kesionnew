<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>
<body class="ks-wrap">
	<!--开始-->

		<div id="ksBoxHead">

		<div class="Header-tool clearfix">
		<div class="Tool-Title">

		<!--标题-->
		<p>
		<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>网校分类</a><span>/</span>n级排序
		</p>
		<!--标题-->
		
		</div>
	
	</div>
		
		</div>
		<div class="bg-white mt20 bRadius10">
	    <div id="ksBoxContent">
		  <table class="ks-table ">
                        <thead>
                       <tr class="gray-bg">
                            <th >栏目ID</th>
                           <th >栏目名称</th>
                           <th>序号</th>
                           <th style="text-align: left;">一级栏目操作</th>
                       </tr>
                        </thead>
                        <tbody>
                       <?php
						 $html = '';
						 foreach($category as $k=>$v)
						 {
							  $UpMoveNum = $GLOBALS['db']->getOne("select count(*) from `$tablename` where wxid=$this->wxid and parentid=$v[parentid] and orderid<$v[orderid]");  
							  $DownMoveNum = $GLOBALS['db']->getOne("select count(*) from `$tablename` where wxid=$this->wxid and parentid=$v[parentid] and orderid>$v[orderid]");
							
							  $html .= "<tr>
										<td >$v[categoryid]</td>
										<td>".KS_INDENT($v['depth']);
							  if($v['child']<=0)
							  {$html .= "<i class='fa fa-minus'></i>&nbsp;&nbsp;";}else{$html .= "<i class='fa fa-plus'></i>&nbsp;&nbsp;";};
							  $html .= "$v[categoryname]</td>
										<td>$v[orderid]</td>
										<td>
											<div class='form-group clearfix'>";
												if($v['parentid']!=0&&$UpMoveNum>0)
												{				
												$html .= "<form target='hidframe'  method='post' action='".M_URL($this->AppName.'/Index','byAllUp',$v['categoryid'],GP('p-'.$page->now_page))."' class='form-horizontal clearfix'>
																	<div class='col-sm-4'>
																		  <select class='w150 inputText bRadius5' name='MoveNum'>
																					<option>向上移动</option>";
																		   for($i=1;$i<$UpMoveNum+1;$i++)
																		   {
																		   $html .= "<option value='$i'>$i</option>";
																		   }
																$html .= "</select>
														            </div>
																	<div class='col-sm-2'>
																		<button type='submit' class='ks-bt bt-pue'>修改</button>
																	</div>
														 </form>";
												}
												
												if($v['parentid']!=0&&$DownMoveNum>0)
												{
												$html .= "<form target='hidframe'  method='post' action='".M_URL($this->AppName.'/Index','byAllDown',$v['categoryid'],GP('p-'.$page->now_page))."' class='form-horizontal clearfix'>
																	<div class='col-sm-4'>
																		     <select class='w150 inputText bRadius5' name='MoveNum'>
																			            <option>向下移动</option>";
																			 for($i=1;$i<$DownMoveNum+1;$i++)
																			 {
																			  $html .= "<option value='$i'>$i</option>";
																			 }
															    $html .= "</select>
														            </div>
																	<div class='col-sm-2'>
																		<button type='submit' class='ks-bt bt-pue'>修改</button>
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
</div>
<div id="ksBoxFooter">
	<div class="ks-bom"><?php echo $page->show(3); ?></div>
</div> 
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

<script>

</body>
</html>