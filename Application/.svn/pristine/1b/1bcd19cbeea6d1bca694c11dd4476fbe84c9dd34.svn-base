<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.w80 {
    width: 80px;
}
</style>
</head>
<body class="gray-bg">
<div class="wrapper mt0">
    <div id="manage_top" class="menu_top_fixed p15 height73">
    	<h3 class="fl">&nbsp;&nbsp;模板文件
        	<a onclick="addTypeChange('<?php echo M_URL('Temp','TempaddFile',$tempid,GP('temptype-'.$temptype.',tempdir-'.urlencode($tempdir),true));?>','650px','400px');" class="btn btn-default btn-rounded btn-s-md  ml15" >新建模板</a>
        	<a  href="<?php echo M_URL('Temp','index',GP('temptype-'.$temptype,true));?>" class="btn btn-default btn-rounded btn-s-md  ml15" >上传模板</a>
        	<a  class="btn btn-default btn-rounded btn-s-md  ml15">标签参数说明</a>
        </h3>
       	<div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<a href="<?php echo M_URL('Temp','index','',GP(''));?>" class="ks-bt bt-def"><i class="iconfont icon-fanhui"></i>返回</a>
			<!--搜索-->
			</div>  
              
               
        </div>
        
    </div>
</div>
<div class="ibox-content"><br /><br />
<div class="panel-heading">模板文件管理-----/<?php echo $tempdir;?></div>
<table class="table " >
    <thead>
    <tr>
        <th>模板名称</th>
        <th>类型</th>
        <th>大小</th>
        <th>修改时间</th>
        <th>编辑</th>
        <th>删除</th>
        <th>重命名</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($first)){?>
    <tr onClick="skip('<?php echo M_URL('Temp','tempDirlist',$tempid,GP('temptype-'.$temptype,true));?>')">
        <td></i>(..顶层目录)</td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>	
    <tr onClick="skip('<?php echo M_URL('Temp','tempDirlist',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdir.',back-1',true));?>')">
        <td></i>(.上层目录)</td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <?php }else{?>
    <tr onClick="skip('<?php echo M_URL('Temp','index',GP('temptype-'.$temptype,true));?>')">
        <td></i>(..模板风格列表)</td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <?php }?>
    <?php foreach($dirname as $k=>$v){?>
    <tr onClick="skip('<?php echo M_URL('Temp','tempDirlist',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdir.',nowdir-'.urlencode($v),true));?>')">
        <td><i <?php if(is_dir($dir.$v)) {echo 'class="save"';}else{echo 'class="ie-icon"';}?>></i><?php echo iconv('gbk','utf-8',$v); ?></td>
        <td>目录</td>
        <td>
			<?php echo(KS_Byte($this->File->dir_size($dir.$v)));?>

		</td>
        <td><?php echo(KS_DATE(filectime($dir.$v)));?></td>
        <td class="w80" onClick="doNone(event)">-<!--<i class="edit2017"></i>--></td>
        <td class="w80" onClick="doNone(event)">-<!--<i class="delete2017"></i>--></td>
        <td class="w80" onClick="doNone(event)">-<!--<i class="manage2017"></i>--></td>
    </tr>
    <?php }?>
    <?php foreach($filename as $k=>$v){?>
    <tr>
        <td><i <?php if(is_dir($dir.$v)) {echo 'class="save"';}else{echo 'class="ie-icon"';}?>></i><?php echo iconv('gbk','utf-8',$v); ?></td>
        <td>文件</td>
        <td><?php echo(KS_Byte(filesize($dir.$v)));?></td>
        <td><?php echo(KS_DATE(filectime($dir.$v)));?></td>
        <td class="w80"><a href="<?php echo M_URL('Temp','tempDirAdd',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdir.',nowdir-'.urlencode($v),true));?>"><i class="edit2017"></i></a></td>
        <td class="w80"><a href="javascript:void(0);" onclick="Confirm('是否删除此文件？该操作不可逆！','<?php echo M_URL('Temp','deletetempDir',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdir.',nowdir-'.urlencode($v),true));?>')"><i class="delete2017"></i></a></td>
        <td class="w80"><a href="<?php echo M_URL('Temp','tempDirAdd',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdir.',nowdir-'.urlencode($v),true));?>"><i class="manage2017"></i></a></td>
    </tr>
    <?php }?>
    <!--<tr>
        <td><i class="ie-icon"></i>APzone</td>
        <td>目录</td>
        <td>3K</td>
        <td>2017/1/9 15:26:14</td>
        <td class="w80"><i class="edit2017"></i></td>
        <td class="w80"><i class="delete2017"></i></td>
        <td class="w80"><i class="manage2017"></i></td>
    </tr>-->
    </tbody>
</table>
<?php if(empty($dirname)&&empty($filename)){?>
<div class="emptycss">没有发现任何内容</div>
<?php }?>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
</body>
</html>