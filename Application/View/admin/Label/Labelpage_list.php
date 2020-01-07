<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
.tavd{background-color:white; width:300px; overflow:auto; position: relative; z-index:1200; margin-top:50px; margin-left:15px; border:solid 1px #CCCCCC;; display:none; padding:0px;}
.tavd_tab{width:100%; height:30px; line-height:30px; margin:0px; padding:0px;}
.tavd_tab a{ float:left; display:block; width:120px; margin-left:15px;  text-align:center;}
</style>
<script>
$(function(){
	$("#xinjian").hover(function(){
		$(".tavd").show();	
	})	
	$("body").hover(function(){
		$(".tavd").hide();	
	})	
})
</script>
<body class="gray-bg">
<div class="wrapper mt0">
    <div id="manage_top" class="menu_top_fixed p15 height73" >
    	<h3 class="fl other">
        	<span class="mr20">分页样式管理</span>
              
	       
	   		<ul id="tablist" class="fl">
				<li><a href="<?php echo M_URL('Label','PageAdd','',GP('')); ?>">添加新样式</a></li>
	        </ul>
       </h3>
       <a  href="//store.kesion.com/admin.php/home/Temp/index?option-1,p-1" class="ks-bt bt-def " style="float: right;"><i class="iconfont icon-fanhui"></i>返回</a>
    </div>
</div>
<form target="hidframe"  action="<?php echo M_URL('Label','PagedoEdit','',GP('')) ?>" method="post" class="form-horizontal">
<div class="ibox-content" style="padding-bottom: 60px;padding-top: 30px;">
    <div class="panel-heading">分页样式管理</div>
    <table class="table " >
        <thead>
        <tr>
        	<th>ID</th>
            <th>标签名称</th>
            <th>样式名称</th>
            <th>样式模板</th>
            <th>删除</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($values as $k=>$v){ ?>
        <tr> 
            <td width="5%"><input type="hidden" name="pageid[]" value="<?php echo $v['pageid'];?>"><?php echo $v['pageid'];?></td>
            <td width="10%"><i class="label-2"></i><?php echo $v['labelename'];?></td>
            <td width="10%"><input type="text" class="form-control w200" name="labelname[]" value="<?php echo $v['labelname'];?>" style="height:32px;"></td>
            <td width="60%"><textarea class="form-control" name="labelcontent[]" style="min-height:200px"><?php echo EncodeHtml($v['labelcontent']);?></textarea></td>
            <td class="w80">
            <?php if($v['issys']==1){ ?>
            ------
            <?php }else{?>
            <a href="javascript:void(0);" onclick="Confirm('是否删除此分页样式？该操作不可逆！','<?php echo M_URL('Label','deletePage',$v['pageid'],GP(''));?>')"><i class="delete2017"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo NOC($values);?>
</div>
<div class="footer-page ">
    <div class="col-sm-5"></div>
    <div class="col-sm-3 mt3">
        <button type="submit" class="btn btn-primary btn-s-md">批量保存</button>
        <a class="btn btn-default btn-s-md" href="<?php echo M_URL('Label','index','',GP('')); ?>">取消返回</a>
    </div>
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    var selectInputs = $('.check0');
	var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)
	loadScorllJs()
</script>
</body>
</html>