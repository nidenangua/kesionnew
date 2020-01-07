<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>无标题文档</title>
</head>

<body>
<a href="<?php echo M_URL('Setting','indexField',$tableid); ?>" >返回字段管理</a>[文章系统]模型字段分组管理
<div class="col-sm-12">
            <div class="tabs-container">
                <form target="hidframe"  action="<?php echo M_URL('Setting','batchfieldGroup','',GP('tableid-'.$tableid)) ?>" method="post">
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
								<td><input type='hidden' name='groupid[]' value='$v[groupid]' />$v[groupid]</td>
								<td><input value='$v[groupname]' name='groupname[]' /></td>
								<td><input value='$v[orderid]' name='orderid[]' /></td><td>";
						 if($v['issys']==0)
						 {		
						   $html .= "----";
						 }else{
							 $html .= "<a href='javascript:void(0);' onclick=\"Confirm('是否删除此分组','".M_URL('Setting','delfieldGroup',$v['groupid'],GP('tableid-'.$tableid))."')\" class='btn mr10 btn-taps'>删除</a>";
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
                            <div class="row">
                                <div class="col-sm-7"></div>
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
            </div>
            <br/>
            <form target="hidframe"  action="<?php echo M_URL('Setting','addfieldGroup',$tableid); ?>" method="post">
            <div class="tabs-container">
                新增字段分组<br/>
                分组名称：<input name="groupname" /><button type="submit">确认添加</button><br/>
                TIPS:分组名称应该尽量简短，建议取四个汉字。
            </div>
            </form>
        </div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>        
</body>
</html>