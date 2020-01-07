<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css" rel="stylesheet">	 
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>label {padding-top: 5px;}</style>
</head>
<body class="gray-bg" style="background-color: #f3f3f3">
<div class="wrapper " style="margin-top: 75px;">
<div class="row">
   <div id="manage_top" class="menu_top_fixed height73 p15">
        <div class="ibox-title">
            <h3 class="fl">云视频管理
            	 <ul id="tablist" class="ml15">
	        	 <li <?php if($type ==1)echo 'class="active"'; ?>><a href="<?php echo M_URL('ThirdInterface','index','',GP('type-1')); ?>">点播接口设置</a></li>
          		 <li <?php if($type ==3)echo 'class="active"'; ?>><a href="<?php echo M_URL('ThirdInterface','addInterface','',GP('type-3')); ?>">添加点播接口</a></li>
          		 <li <?php if($type ==2)echo 'class="active"'; ?>><a href="<?php echo M_URL('ThirdInterface','liveIndex','',GP('type-2')); ?>">直播接口设置</a></li>
	             <li <?php if($type ==4)echo 'class="active"'; ?>><a href="<?php echo M_URL('ThirdInterface','addlive','',GP('type-4')); ?>">直播类型添加</a></li>
        		</ul>
            </h3>
        </div>
    </div>
</div>
<div class="row">
<div class="tabs-container">
    <div class="tab-content">
        <div class="tap-pane pd0" style="display: block">
            <div class="panel-body " style="padding: 0 ;padding-top: 20px">
            <form action="<?php echo M_URL('ThirdInterface','batch','',GP('')); ?>" method="post" target="hidframe" id="myform">
                <table class="table table-striped table-bordered table-hover" id="editable">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>启用</th>
                        <th>名称</th>
                        <th>默认</th>
                        <th>编辑</th>
                        <th>删除</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($values as $k=>$v){ ?>
                    <tr>
                        <td style="width: 70px"><?php echo $v['id'] ?><input name=id[] type="hidden" value="<?php echo $v['id'] ?>" style="margin:0"></td>
                        <td >
                            <div class="checkbox  checkbox-info">
                            <input id="C59<?php echo $v['id'] ?>" type="checkbox" name="enable[]" class="check0" value="<?php echo $v['id'] ?>" <?php if($v['enable']==1) echo "checked"; ?>>
                            <label for="C59<?php echo $v['id'] ?>">
                            </label>
                        </div>
                        </td>
                        <td><input class="form-control w300" type="text" name="title[]"  value="<?php echo $v['title'] ?>"></td>
                        <td><input class="form-control w300" type="text" name="title[]"  value="<?php echo $v['title'] ?>"></td>
                        <td style="width: 90px">
                        <div class="radio radio-info radio-inline">
                            <input name="default" id="<?php echo $v['id'] ?>"  type="radio" <?php if($v['isdefault']==1)echo 'checked';  ?> value="<?php echo $v['id'] ?>"><label for="<?php echo $v['id'] ?>"></label>
                        </div>
                        </td>
                        <td style="width: 90px"> <a href="<?php echo M_URL('ThirdInterface','editlive',$v['id'],GP('type-4')); ?>"><i class="edit2017"></i></a></td>
                        <td style="width: 90px"><a onclick="Confirm('是否删除此应用','<?php echo M_URL('ThirdInterface','delInterface',$v['id'],GP('')); ?>');"><i class="delete2017"></i></a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="footer-page">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-7 mt3"> <button class="btn btn-primary mt7 btn-s-md" type="button" onClick="do_reg()">确定保存</button>
                    <a href="javascript:history.go(-1);" class="btn bt-gray mt7 btn-s-md">取消修改</a>
                    </div>  
               </div>
               </form>
               <?php echo NoC($values);?>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
loadScorllJs('.tap-pane')
$(function(){
    $('.nav-tabs li').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
    $('.tab-content>.tab-pane:eq('+$(this).index()+')').show().siblings().hide();
    })
});
function do_reg(){
	var title = $("input[name^='title']");
	for(var i=0;i<title.length;i++){
	     if(!title[i].value){
	    	Alert('名称不能为空');
	        return false;	
	     }
	}
	$("#myform").submit();
}	
</script>
</body>
</html>