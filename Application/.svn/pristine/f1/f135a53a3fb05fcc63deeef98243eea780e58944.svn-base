
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css"> 
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;}
	.Created-push{display: none;}
	#active{display: block!important;}
	.tab-pane{padding: 30px;
    background: #FFFFFF;
    border-radius: 10px;}
    .Created-title span:last-child{
    	margin-left: 0;
    }
    .upload-img{width: 150px;height: 125px;text-align: center;line-height:120px;float: left;border: 1px solid #eee;cursor: pointer;}
	.upload-img i{color:#666;font-size: 40px;}
	.selectImageBtn{background: none;border: 0;float: left;}
	.form-upload {position: relative;width: 300px;top: 30px;}
	.js_showBox {border-radius: 0;}
	.form-icon {position: relative;height: 125px;width: 150px;float: left;margin-right: 15px;}
	.form-bg {position: absolute;bottom: 0;width: 150px;z-index: 9;height: 40px;background: #000;opacity: 0.15;}
	.form-close {position: absolute;right: 0;top: 0;}
	.form-prev {position: absolute;bottom: 6px; left: 0; z-index: 999;}
	.form-next {position: absolute;bottom: 6px; right: 0; z-index: 999;}
	
	.imgList {width: 800px; position: absolute;}
	.imglist-box {height: 150px;position: relative;overflow: hidden;min-width: 800px;margin-left: 75px;display: inline-block;}
</style>
<body class="gray-bg">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	 直播分辨率配置
        		 <button type="button" class="btn btn-default btn-rounded btn-s-md ml15 " onclick="addTypeChange('<?php echo M_URL('Setting','addresolution');?>','850','600px',{title:'新增分辨率',type:'top'});">添加分辨率</button>
        </h3>
        <div class="fr">
        
             <div class="fl ks-top-search">
				<button class="ks-bt bt-def" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>

			</div>  
              
               
        </div>
    </div>
</div>
</div></form>


<br />

<div id="ksBoxContent" class="mt50">
<form target="hidframe"  method="post" id="myform" action="<?php echo M_URL('Setting','saveEdition','',GP('id-'.$res['id']));?>" class="form-horizontal" enctype="multipart/form-data">

	
	
	
<div class="Created-push tab-pane" id="active">
		<ul>
			
		<li>
			<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>一对一</span>
						<span>(可修改部分)</span>
					</div>
				</div>
			
			
			
				
		<div class="Created-ing">
			<table class="ks-table">
				<tr>
				   <th>名称</th>
				   <th>白板分辨率</th>
				   <th>老师头像分辨率</th>
				   <th>学生头像分辨率</th>
				   <th>是否启用</th>
				   <th>编辑</th>
				</tr>
				<?php foreach($value as $k=>$v){ ?>
					<tr>
						<td><?php echo  $v['title'] ?></td>
						<td><?php echo  $v['blackboard'] ?></td>
						<td><?php echo  $v['teacherhead'] ?></td>
						<td><?php echo  $v['studenthead'] ?></td>
						<td><?php if($v['isenable']==1){ echo '是';}else{echo '否';} ?></td>
						<td><a class="form-bule" href="javascript:;" onclick="addTypeChange('<?php echo M_URL('Setting','editresolution',$v['id']);?>','850px','600px',{title:'新增分辨率',type:'top'});">编辑</a></td>
					</tr>
				<?php } ?>	
			</table>		
       </div>
      </li>
      <li>
      	<li>
			<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title">
						<span>一对多</span>
						<span>(可修改部分)</span>
					</div>
				</div>
			
			
			
				
		<div class="Created-ing">
				
				<table class="ks-table">
				<tr>
				   <th>名称</th>
				   <th>白板分辨率</th>
				   <th>老师头像分辨率</th>
				   <th>学生头像分辨率</th>
				   <th>是否启用</th>
				   <th>编辑</th>
				</tr>
				<?php foreach($values as $k=>$v){ ?>
					<tr>
						<td><?php echo  $v['title'] ?></td>
						<td><?php echo  $v['blackboard'] ?></td>
						<td><?php echo  $v['teacherhead'] ?></td>
						<td><?php echo  $v['studenthead'] ?></td>
						<td><?php if($v['isenable']==1){ echo '是';}else{echo '否';} ?></td>
						<td><a class="form-bule" href="javascript:;" onclick="addTypeChange('<?php echo M_URL('Setting','editresolution',$v['id']);?>','850px','600px',{title:'新增分辨率',type:'top'});">编辑</a></td>
					</tr>
				<?php } ?>	
			</table>		
				
				
       </div>
      </li>
      </li>
	
	
    	<div id="ksBoxFooter" style="height: 150px;"></div>

</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	function do_reg(){
		$('#myform').submit();
	}
</script>
</body>

</html>
