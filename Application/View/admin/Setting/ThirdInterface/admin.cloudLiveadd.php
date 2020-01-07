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
<style>
label {padding-top: 5px;}
</style>
</head>
<body class="gray-bg" style="background-color: #f3f3f3">
<div class="wrapper " style="margin-top: 75px;">
<div class="row">
   <div id="manage_top" class="menu_top_fixed height73 p15">
        <div class="ibox-title">
            <h3 class="fl">云视频管理
            	 <ul id="tablist" class="ml15">
	        	 <li <?php if($type ==1)echo 'class="active"'; ?>><a href="<?php echo M_URL('Setting','livecloudmanage','',GP('type-1')); ?>">点播接口设置</a></li>
          		 <li <?php if($type ==3)echo 'class="active"'; ?>><a href="<?php echo M_URL('Setting','addInterface','',GP('type-3')); ?>">添加点播接口</a></li>
          		 <li <?php if($type ==2)echo 'class="active"'; ?>><a href="<?php echo M_URL('Setting','liveIndex','',GP('type-2')); ?>">直播接口设置</a></li>
	             <li <?php if($type ==4)echo 'class="active"'; ?>><a href="<?php echo M_URL('Setting','addlive','',GP('type-4')); ?>">直播类型添加</a></li>
        		</ul>
            </h3>
        </div>
    </div>
</div>
<div class="row">
<div class="tabs-container">
    <div class="tab-content">
        <div class="tap-pane" style="display: block">
            <div class="panel-body">
                <form id="myform" target="hidframe"  class="form-horizontal" method="post" action="<?php if(isset($live)){echo M_URL('Setting','doeditlive',$id,GP(''));}else{echo M_URL('Setting','doaddlive','',GP(''));} ?>">
                 	<div class="form-group-box">
                 		<div class="form-group">
                            <label class="col-sm-2 ">名称：</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="title" value="<?php if(isset($live))echo $live['title'] ?>">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                   		 声网配置：<div class="line line-dashed b-b line-lg pull-in"></div> 
                        <div class="form-group">
                            <label class="col-sm-2 ">key</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="Agorakey" value="<?php if(isset($Agora))echo $Agora[0] ?>">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 ">AppCertificate</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="AppCertificate" value="<?php if(isset($Agora))echo $Agora[1] ?>">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                                                        第三方配置：<div class="line line-dashed b-b line-lg pull-in"></div>
                 		<?php if(isset($live)){
                         foreach($key as $k=>$v){ ?>
                        <div class="form-group">
                            <label class="col-sm-2 "><input class="form-control" type="text" name="keytitle[]" value="<?php echo  $keytitle[$k] ?>"  /></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="key[]" value="<?php echo  $v ?>">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <?php  }}else{?>
                       	<div class="form-group">
                            <label class="col-sm-2 "><input class="form-control" type="text" name="keytitle[]" value="appid"  /></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="key[]" value="">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                       	<?php } ?>
                    </div>  
                    <div  class="form-add" onclick="add()">添加</div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否默认：</label>
                        <div class="col-sm-4">
                            <div class="radio radio-info radio-inline">
                                <input name="default" id="mbings3"  type="radio" value="1"  <?php if(isset($live)){if($live['isdefault'] == 1)echo 'checked';} ?>><label for="mbings3"> 是 </label>
                            </div>
                            <div class="radio radio-info  radio-inline">
                                <input name="default" id="mbings4" type="radio"  value="0" <?php if(isset($live)){if($live['isdefault'] == 0)echo 'checked';}else{ echo 'checked';} ?>><label for="mbings4"> 否 </label>
                            </div>
                        </div>
                    </div>
                    <div class="footer-page">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-7 mt3"> <button class="btn btn-primary mt7 btn-s-md"  type="button" onClick="do_reg()">确定保存</button> 
                        <a href="javascript:history.go(-1);" class="btn bt-gray mt7 btn-s-md">取消修改</a>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
loadScorllJs('.panel-body')
function do_reg(){
	var title = $("input[name='title']").val();
    if(title==''){
		Alert('名称不能为空');
		return false;	
    }
	$("#myform").submit();
}
function add(){
	var html='';
	html+='<div class="form-group">';
	html+='<label class="col-sm-2 "><input type="text" class="form-control" name="keytitle[]" value="appid"></label>';	
	html+='<div class="col-sm-4"> <input type="text" class="form-control" name="key[]" value=""></div>';
	html+='<div class="col-sm-2"><button class="btn btn-defalut mt7" onclick="del(this)">删除</button></div>';
	html+='</div>';
	html+='<div class="line line-dashed b-b line-lg pull-in"></div>';	 
	$('.form-group-box').append(html);  
}
function del(obj){
	$obj =$(obj);
	$obj.parents('.form-group').next('.line-dashed').remove();
	$obj.parents('.form-group').remove();
}
</script>
</body>
</html>