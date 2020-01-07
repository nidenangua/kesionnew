<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.w80 {width: 80px;}
</style>
</head>
<body class="gray-bg">
<div class="wrapper mt0">
    <div id="manage_top" class="menu_top_fixed p15 height73">
        <ul style=" float:left;">
        	<li><a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Domain','TempaddFile','',GP('tempdir-'.urlencode($tempdir),true));?>','650px','400px');"><i class="one2017"></i>上传文件</a></li>
            <li><a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Domain','TempaddFile','',GP('tempdir-'.urlencode($tempdir),true));?>','650px','400px');"><i class="one2017"></i>新建文件夹</a></li>
            <?php if(!empty($first)){?>
            <li><a href="<?php echo M_URL('Domain','imageslist');?>"><i class="one2017"></i>顶层目录</a></li>
            <?php }?>
            <li><a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Domain','Syncimages','',GP('tempdir-'.$tempdir,true));?>','450px','250px');"><i class="one2017"></i>同步到百度云（当前目录）</a></li>	
        </ul>
        <div class="ibox-tools" >
            <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                <i class="reflash"></i>
            </a>
        </div>
    </div>
</div>
<div class="ibox-content"><br /><br />
<div class="panel-heading">图库管理-----/<?php echo $tempdir;?></div>
<table class="table " >
    <thead>
    <tr>
        <th>图片目录</th><th>类型</th><th>大小</th><th>修改时间</th><th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($first)){?>
    <tr onClick="skip('<?php echo M_URL('Domain','imageslist');?>')">
        <td>(..顶层目录)</td><td></td><td></td><td></td><td></td>
    </tr>	
    <tr onClick="skip('<?php echo M_URL('Domain','imageslist','',GP('tempdir-'.$tempdir.',back-1',true));?>')">
        <td>(.上层目录)</td><td></td><td></td><td></td><td></td>
    </tr>
    <?php }?>
    <?php foreach($dirname as $k=>$v){?>
    <tr onClick="skip('<?php echo M_URL('Domain','imageslist','',GP('tempdir-'.$tempdir.',nowdir-'.urlencode($v),true));?>')">
        <td><i <?php if(is_dir($dir.$v)) {echo 'class="save"';}else{echo 'class="ie-icon"';}?>></i><?php echo iconv('gbk','utf-8',$v); ?></td>
        <td>目录</td>
        <td>3K</td>
        <td>2017/1/9 15:26:14</td>
        <td class="w80" onClick="doNone(event)"><i class="edit2017"></i></td>
        <!--<td class="w80" onClick="doNone(event)"><i class="delete2017"></i></td>
        <td class="w80" onClick="doNone(event)"><i class="manage2017"></i></td>-->
    </tr>
    <?php }?>
    <?php foreach($filename as $k=>$v){?>
    <tr>
        <td><i <?php if(is_dir($dir.$v)) {echo 'class="save"';}else{echo 'class="ie-icon"';}?>></i><?php echo iconv('gbk','utf-8',$v); ?></td>
        <td>图片</td>
        <td>3K</td>
        <td>2017/1/9 15:26:14</td>
        <td class="w80"><a href="javascript:void(0);" onclick="Confirm('是否删除此文件？该操作不可逆！','<?php echo M_URL('Temp','deletetempDir',$tempid,GP('option-'.$option.',tempdir-'.$tempdir.',nowdir-'.urlencode($v),true));?>')"><i class="delete2017"></i></a></td>
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