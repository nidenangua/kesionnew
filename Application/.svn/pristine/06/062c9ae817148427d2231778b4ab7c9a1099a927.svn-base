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
      		<a href="<?php echo M_URL("Setting",'addtasks'); ?>" class="btn btn btn-info btn-rounded btn-s-md mt7 ml15">新加任务</a>
      </div>
	</div> 
    </div>
 <div class="wrapper mt400" style="margin-top: 75px;">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                
                    <div class="ibox-content">
                        <div class="panel-heading">
                         </div>
                        <table class="table table-striped table-bordered table-hover" id="editable">
                            <thead>
                                <tr>
                                   <th>id</th>
                                   <th>任务名称</th>
                                  
                                   <th>每日可获次数</th>
                                   <th>奖励</th>
                                   <th>任务完成需要的数量</th>
                                    <th>单位类型</th>
                                   <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($values as $k => $v) { ?>
                              <tr>
                            	<td><?php echo $v['id']; ?></td>
                            	<td><?php echo $v['title']; ?></td>
                            	
                            	<td><?php echo $v['num']; ?></td>
                            	<td><?php echo $v['money']; ?></td>
                            	<td><?php echo $v['quantity']; ?></td>
                              <td><?php if($v['type']==1){ echo '人';}elseif($v['type']==2){ echo '数量';}elseif($v['type']==3){ echo '元';} ?></td>
                            	<td>
                                <a href="<?php echo M_URL('Setting','edittask',$v['id']); ?>">编辑</a>
                                <?php if($v['status'] ==0){ ?>
                                |<a href="<?php echo M_URL('Setting','opentask',$v['id']); ?>">启用</a>
                                <?php }else{ ?>
                                  <a href="<?php echo M_URL('Setting','deltask',$v['id']); ?>">关闭</a>
                                <?php } ?>
                              </td>

                              </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                     <?php echo NoC($values);?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<br/>

<div class="footer-page h60">
<div class="row">
<div class="col-sm-3">
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