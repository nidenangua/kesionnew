
<!DOCTYPE html>
<html>
<head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>无标题文档</title>
</head>
 <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
 <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
 <link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">
 <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
 <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<body class="gray-bg">


<div id="manage_top" class="menu_top_fixed  p15 height73">
	<div class="ibox-title">
		[文章系统]模型字段分组管理
		<div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
	</div>
	
</div>
<div class="wrapper" style="margin-top:65px;">
<div class="col-sm-12">
            <div class="tabs-container">
                <form target="hidframe"  action="<?php echo M_URL('App','batchfieldGroup','',GP('appid-'.$appid)) ?>" method="post">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>分组名称</th>
                            <th>排序</th>
                            <th>删除</th>
                        </tr>
                        </thead>
                         <?php
                         $html = '';
                         foreach($fieldgroup as $k=>$v)
                         {
					     $html .= "<tbody>
							<tr>
								<td><input class='form-textbox w300' type='hidden' name='groupid[]' value='$v[groupid]' />$v[groupid]</td>
								<td><input class='form-textbox w300' value='$v[groupname]' name='groupname[]' /></td>
								<td><input class='form-textbox w300' value='$v[orderid]' name='orderid[]' /></td><td>";
						 if($v['issys']==0)
						 {		
						   $html .= "----";
						 }else{
							 $html .= "<a href='javascript:void(0);' onclick=\"Confirm('是否删除此分组','".M_URL('App','delfieldGroup',$v['groupid'],GP('appid-'.$appid))."')\" class='btn mr10 btn-taps'>删除</a>";
							   }
						 $html .= "</td>
							</tr>
							</tbody>";
						 }
						 echo $html;
						 ?>
                    </table>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                          <div class=" footer-page clearfix">
                              
                                <div class="col-sm-5">
                                    <button type="submit" class="btn btn-w-m btn-primary">批量保存字段分组</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
                    </form>
                 <div class="bg-white " style="padding: 20px;"> 
                    <form target="hidframe"  action="<?php echo M_URL('App','addfieldGroup',$appid); ?>" method="post">
			            <div class="tabs-container">
			            	<h3 style="font-size: 16px;color: #666;">新增字段分组</h3>
			            	<div class="form-row clearfix">
								<span class="name name-nowrap"> 分组名称</span>
								<input name="groupname" class="form-textbox w300" /><button type="submit" class=" btn btn-default"> 确认添加</button>
								   <br/>
			               		 TIPS:分组名称应该尽量简短，建议取四个汉字。
							</div>
			            	
			              
			            
			            </div>
	          		 </form>
	          	</div>  	 
            </div>
            <br/>
            
        </div>
      </div>  
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>        
</body>
</html>