<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">

    <title>H+ 后台主题UI框架 - 选项卡 &amp; 面板</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>

<body class="gray-bg">
<div class="wrapper ">
    <div class="row">
        <div class="col-sm-2">
            新闻管理
        </div>
        <div class="col-sm-9">
            <div class="row">  
            <div class="col-md-4">
                <div class="row">
                    <label class="control-label txt-right pd-t10 col-sm-3">普通:</label>
                    <div class="col-sm-9">
                        <select class="form-control">
                            <option>标题1</option>
                            <option>标题2</option>
                        </select>
                    </div>
                </div>
            </div>
                <div class="col-md-4">
                    <div class="row">
                        <label class="control-label txt-right pd-t10 col-sm-3">普通:</label>
                        <div class="col-sm-9">
                            <select class="form-control">
                                <option>标题1</option>
                                <option>标题2</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">

                        <form target="hidframe"  action="index.html" method="get">
                            <div class="input-group">
                                <input type="text" placeholder="后台主题" name="search" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn  btn-primary" type="submit">
                                        搜索
                                    </button>
                                </div>
                            </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> 所有</a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">已审核</a>
                    </li>
                </ul>
                <div class="taps-button">
                    <div class="row">
                        <label class="control-label  pd-t10 ">排序:</label>
                        <button type="button" class="btn btn-primary btn-xs">浏览量</button>
                        <button type="button" class="btn btn-taps btn-xs">安装量</button>
                    </div>
                </div>
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
                                                    <th>序号</th>
                                                    <th>标题</th>
                                                    <th>是否推荐</th>
                                                    <th>状态</th>
                                                    <th>添加时间</th>
                                                    <th>录入员</th>
                                                    <th>评论数</th>
                                                    <th>安装量</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                 <?php
							$i=0;
							foreach($newsAll as $k=>$v)
							{  
							    if($v["recommend"]==1){
									$recommend="是";
									}else{$recommend="否";}
								if($v["status"]==1){
									 $status="已审";
									  $operate="<label class='   txt-top' >
									           <a href='".M_URL('News','editor',$v['newsid'])."'>查看</a></label>
											   <label class='  txt-top  '>
									           <a href='".M_URL('News','unaudited',$v['newsid'])."' >取消审核</a></label>
                                                <label class='  txt-top '>
												<a href='".M_URL('News','delect',$v['newsid']). 
												"'onclick='javascript:return del()''>删除</a></label>";
									}else{
									 $status="待审";
									 $operate="<label class='  txt-top  '>
									           <a href='".M_URL('News','editor',$v['newsid'])."' >查看</a></label>
									 			<label class='  txt-top'>
									           <a href='".M_URL('News','auditing',$v['newsid'])."'>审核</a></label>
                                                <label class=' txt-top '>
												<a href='".M_URL('News','delect',$v['newsid']).
												"'onclick='javascript:return del()''>删除</a></label>";
									 }	
								$data = date("Y/m/d",$v["adddate"]);	 
							   $i++;
								echo '
                                                <tbody>
                                                <tr>
                                                    <td>
													 <div class="checkbox  checkbox-info" >
                                                            <input id="C'.$i.'" type="checkbox" name="check " class="check0">
                                                            <label for="C'.$i.'">
                                                             '.$i.'
                                                            </label>
                                                        </div>
                                                    </td>   
                                                    <td>'.$v["title"].'</td>
                                                    <td>'.$recommend.'</td>
                                                    <td>'.$status.'</td>
                                                    <td>'.$data.'</td>
                                                    <td>'.$v["inputer"].'</td>
                                                    <td>'.$v["cmtnum"].'</td>
                                                    <td>'.$v["hits"].'</td>
                                                    <td style="width:200px">'.$operate.'</td>
                                                </tr>
												</tbody>';
									}
						                    
							?>			
                                               
                                              
                                            </table>
                                            <div class="row">
                                                
                                                <div class="col-sm-1">
                                                    <div class="checkbox checkbox-info">
                                                        <input id="checkboxAll" name="check" type="checkbox" class="check-all check0">
                                                        <label for="checkboxAll" >
                                                            全选
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7"></div>
                                <div class="col-sm-5">
                                    <button type="button" class="btn btn-w-m btn-primary">批量删除</button>
                                    <button type="button" class="btn btn-w-m btn-primary">批量审核</button>
                                    <button type="button" class="btn btn-w-m btn-primary">批量取消审核</button>
                                </div>
                            </div>
                        </div>
                        <?php echo $page->show(3); ?>  
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>    
<script>
 $(function(){
	 select2()
	 loadScorllJs()
	 })
function del() {
var msg = "是否删除此条新闻";
if (confirm(msg)==true){
return true;
}else{
return false;
}
}	
</script>

</body>
</html>