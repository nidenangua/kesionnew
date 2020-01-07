<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.pl15{padding-left: 15px}
.field{ height: 22px; line-height: 22px; float: left; border: 1px solid #FFccCC; margin: 5px;  padding-left: 15px; padding-right:15px; background: #FFFFEC; font-weight: bold; }
.w200 {width:200px !important}
</style>
</head>
<body class="gray-bg">
<div class="wrapper">

<div class="row bg-white p15">
<form target="hidframe" id="myform" class="form-horizontal" action="<?php if(empty($value)){echo M_URL('Label','LabeldoAdd','',GP('labeltype-'.$labeltype));}else{echo M_URL('Label','LabeldoEdit',$labelid,GP('p-'.$now_page));} ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="col-sm-2 control-label">标签类型：</div>
            <div class="col-sm-2 w200"> 
            -<?php echo BCT($labeltype);?>-
            <input type="hidden" value="<?php echo $labeltype;?>" id="basictype">  
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <div class="col-sm-2 control-label">标签名称：</div>
            <div class="col-sm-3">
                <input class="form-control" type="text" value="<?php if(!empty($value)){echo $value['labelname'];} ?>" <?php if(!empty($value)){?>readonly="readonly"<?php }?> name="labelname"/>
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">开始标志：</label>
            <div class="col-sm-4">
                   <input class="form-control" type="text" value="<?php if(!empty($value)){echo $this->Label->GetParam($value['labelcontent'],'StartNav');}else{echo '您现在位置：';} ?>" id="StartNav" />
            </div>
            <label class="control-label fl">如：您现在位置，当前位置 等等</label>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">导航分隔符：</label>
            <div class="col-sm-4">
                   <input class="form-control" type="text" value="<?php if(!empty($value)){echo $this->Label->GetParam($value['labelcontent'],'NavTag');}else{echo '>>';} ?>" id="NavTag" />
            </div>
            <label class="control-label fl">如 / - > 等等</label>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">网站名称：</label>
            <div class="col-sm-4">
                <div class="checkbox checkbox-info checkbox-inline">
                <input id="showsitename" value="1" type="checkbox" <?php if(!empty($value)){if($this->Label->GetParam($value['labelcontent'],'showsitename')==1){?>checked="checked"<?php }}?> >
                <label for="showsitename">显示</label>
                </div>
            </div>
        </div>
       
        <input type="hidden" name="labelcontent" id="KSContent_LabelContent" />
        <div class="footer-page">
            <div class="footer-btn">
                <button type="button" class="btn btn-primary btn-s-md" onClick="return(do_reg());"><?php if(!empty($value)){?>确定修改<?php }else{ ?>确定添加<?php } ?></button>

                <button type="button" class="btn btn-default btn-s-md" onClick="parent.closePopup(window.name)">取消</button>
            </div>
        </div>
        
    </form>

    </div>
</div>
<script src="/Public/common/drag/js/drag.assembly.js"></script>

<script src="/Public/drag/js/frame.format.js"></script>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

<script>


var pos=null;
function setPos()
{	
	if (document.all){
		$("#KSContent_LoopBody").focus();
		pos = document.selection.createRange();
	}else{
		pos = $("#KSContent_LoopBody")[0].selectionStart;
	}
}
var getIframeTimer;

function do_reg(){
	var showsitename=0;
	if ($('#showsitename')[0].checked) showsitename = 1;
	var str='{KS:Label Type="IList"'
	      + ' Basictype="'+$("#basictype").val()+'"'
	      + ' StartNav="'+$("#StartNav").val()+'"'
	      + ' NavTag="'+$("#NavTag").val()+'"'
		  + ' showsitename="'+showsitename+'"'
		  + '}' + $('#KSContent_LoopBody').val() + '{/KS:Label}';
		  
	$("#KSContent_LabelContent").val('<div class="m-posnav1">'+str+'</div>');
	
	if($("#basictype").val()==0){
		Alert('请选择应用的基类型!');return false;
	};
	
	if($.trim($('input[name="labelname"]').val())==''&&location.href.indexOf('NavigationAdd')!=-1){
		parent.popup.tips({
			title:'请输入标签名称'
		});
		return false;
	}
	$("#myform").submit();
}

function labelSuccessBack(data){
	if(location.href.indexOf('NavigationAdd')!=-1){
		data.flag = 'add';
	}else{
		data.flag = 'edit';
	}
	
	if(data.state=='succeed'){
		data.windowName = window.name;
    	parent.LabelBack(data);
	}else{
		parent.popup.tips({
			title:data
		});
		$('input[name="labelname"]').val('').focus();
	};
	
}


function InsertLabel(fieldname,fieldtype)
{
	var appid=$("#appid").val();
    if(pos==null) {Alert('请先定位插入位置!');return false;}
    var url_model = '<?php echo URL_MODEL; ?>';

	if(url_model == '1')
	{
      addTypeChange('<?php echo M_URL('Label','LoopAdd');?>?fieldname-'+fieldname+',fieldtype-'+fieldtype+',appid-'+appid,'480px','420px');
	}else{
	  addTypeChange('<?php echo M_URL('Label','LoopAdd');?>&fieldname='+fieldname+'&fieldtype='+fieldtype+'&appid='+appid,'480px','420px');
	}
}
//插入到循环体
function InsertValue(Val) {
	if (pos == null) { Alert('请先定位插入位置!', null); return false; }
	if (document.all){
	   pos.text=Val;
	}else{
	   var obj=jQuery("#KSContent_LoopBody");
	   var lstr=obj.val().substring(0,pos);
	   var rstr=obj.val().substring(pos);
	   obj.val(lstr+Val+rstr);
    }
}
     

$(function(){
	var i =1;
	var h = $('#KSContent_LoopBody').height();
	//#click1 和#click2适用于增加textarea的高度
	$('#click1').click(function(){
		if(i<10)
		{
			h = h+50;
			$('#KSContent_LoopBody').height(h);
			i++;
	    }
	})
	//#click1 和#click2适用于增加textarea的高度 
	$('#click2').click(function(){
		if(i>1)
		{
			h = h-50;
			$('#KSContent_LoopBody').height(h);
			i--;
		}
	})
})
</script>
</body>
</html>