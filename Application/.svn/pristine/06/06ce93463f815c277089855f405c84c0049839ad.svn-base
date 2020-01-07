<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title><?php if(!isset($admin)){echo '添加管理员';}else{echo '修改管理员';} ?></title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
     <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/font.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    <style>
    .box {
	    position: relative;
	    border: 1px solid #ccc;
	    border-top: 2px solid #000;
	    width: 525px;
	    height: 933.8px;
	    background: url(<?php if(isset($admin)){echo $admin['defaultpic'];}else{echo '/Images/images/201812/5c1071411ac76.jpg';} ?>) no-repeat;
	    background-size:525px 933.8px;
	}	
	.mo {
	    display: block;
	    border: 1px solid #ff6600;
	    padding: 0px;
	    height: 22px;
	    font-size: 14px;
	    line-height: 22px;
	    position: absolute;
	}
    </style>
</head>
<body class="gray-bg">
<div class="row">
	<div id="manage_top" class="menu_top_fixed  p15 height73">
	    <div class="ibox-title">
	        <h3 class="fl">海报模板设置</h3>
	        <div class="fr">
	             <div class="fl ks-top-search">
				<!--搜索-->
					<button type="button" class="ks-bt bt-def" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
				<!--搜索-->
				</div>  
	        </div>
	    </div>
	</div>
</div>
<div class="wrapper mt0" style="margin-top: 75px;">
    <div class="row bg-white p15 " style="border-radius: 10px;">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                </div>
                <div class="ibox-content">
<form target="hidframe" id="myform" action="<?php if(!isset($admin)){echo M_URL('Setting','dosetPoster');}else{echo M_URL('Setting','dosetPoster',$admin['posterid'],GP('p-'.$now_page));} ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="noprint">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="ctable">
    <tbody>
<tr class="tdbg">
      <td height="26" class="clefttitle" style="text-align:left">
		  <strong>插入标签：</strong><select name="mylabel" id="mylabel">
		   <option value="">请选择标签...</option>
		   <optgroup label="寄件人标签"> 
		   <option value="{$寄件人_姓名}">{$寄件人_姓名}</option>
		   <option value="{$寄件人_地址}">{$寄件人_地址}</option>
		   <option value="{$寄件人_电话}">{$寄件人_电话}</option>
		   <option value="{$寄件人_手机}">{$寄件人_手机}</option>
		   <option value="{$寄件人_邮编}">{$寄件人_邮编}</option>
		   <option value="{$寄件人_单位}">{$寄件人_单位}</option>
		   <option value="{$寄件人_其它说明1}">{$寄件人_其它说明1}</option>
		   <option value="{$寄件人_其它说明2}">{$寄件人_其它说明2}</option>
		   <option value="{$寄件人_其它说明3}">{$寄件人_其它说明3}</option>
		   <option value="{$寄件人_其它说明4}">{$寄件人_其它说明4}</option>
		   <option value="{$寄件人_其它说明5}">{$寄件人_其它说明5}</option>
          </optgroup><optgroup label="收件人标签"> 
		   <option value="{$收件人_姓名}">{$收件人_姓名}</option>
		   <option value="{$收件人_地址}">{$收件人_地址}</option>
		   <option value="{$收件人_电话}">{$收件人_电话}</option>
		   <option value="{$收件人_手机}">{$收件人_手机}</option>
		   <option value="{$收件人_邮编}">{$收件人_邮编}</option>
		   <option value="{$收件人_目的地}">{$收件人_目地的}</option>
		   <option value="{$收件人_目的地(省市县)}">{$收件人_目的地(省市县)}</option>
		  </optgroup><optgroup label="其它标签">  
		   <option value="{$年}">{$当前日期_年}</option>
		   <option value="{$月}">{$当前日期_月}</option>
		   <option value="{$日}">{$当前日期_日}</option>
		   <option value="{$时}">{$当前日期_时}</option>
		   <option value="{$分}">{$当前日期_分}</option>
		   <option value="{$秒}">{$当前日期_秒}</option>
		   <option value="{$订单_备注留言}">{$订单_备注留言}</option>
		   <option value="{$订单_总金额}">{$订单_总金额}</option>
		   <option value="{$订单_送货日期}">{$订单_送货日期}</option>
		   <option value="{$订单_送货时间}">{$订单_送货时间}</option>
		   
		   <option value="√">{$打勾_√}</option>
		  </optgroup></select>
		  <textarea name="template" style="display:none" id="template"></textarea>
		  <input type="button" class="button" value=" 插入标签 " onclick="add_div();">
		  
		 <input type="submit" name="ctl00$KSContent$BtnSubmit" value="保存模板" onclick="return(CheckForm());WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$KSContent$BtnSubmit&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="ctl00_KSContent_BtnSubmit" class="button">
   </td>
  </tr>
</tbody></table>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label">海报名称</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="realname" <?php if(isset($admin)){echo "value='$admin[realname]'";} ?>>
        </div>
    </div>
    <div class="form-upload" style="position: inherit;margin-left: 152px;">
           <div id="mybody" class="box"><label style="left: 300px; top: 102px;" id="m2" class="mo">{$寄件人_电话}</label><label style="left: 151px; top: 225px;" id="m3" class="mo">{$寄件人_邮编}</label><label style="left: 147px; top: 193px;" id="m4" class="mo">{$寄件人_其它说明1}</label><label style="left: 149px; top: 132px;" id="m5" class="mo">{$寄件人_姓名}</label></div>
	</div>
    <div class="hr-line-dashed"></div>
    <div class="footer-page mt3">
        <div class="col-sm-5"></div>
        <div class="col-sm-4 ">
          
        </div>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$(function(){
    loadScorllJs();//滚轮
    taps();//选项卡
    uploadView('100','100');//图片上传	
})
function CheckForm(){
   jQuery("#template").val(jQuery("#mybody").html());
   if(jQuery("#template").val()==''){
	  KesionJS.Alert('模板内容必须放入标签!','jQuery("#template").focus();');
	  return false;
   }
   return true;
}
var rDrag = {
    o:null,
    init:function(o){
    o.onmousedown = this.start;
    },
    start:function(e){
    var o;
    e = rDrag.fixEvent(e);
    e.preventDefault && e.preventDefault();
    rDrag.o = o = this;
    o.x = e.clientX - rDrag.o.offsetLeft;
    o.y = e.clientY - rDrag.o.offsetTop;
    document.onmousemove = rDrag.move;
    document.onmouseup = rDrag.end;
    },
    move:function(e){
	    e = rDrag.fixEvent(e);
	    var oLeft,oTop;
	    oLeft = e.clientX - rDrag.o.x;
	    oTop = e.clientY - rDrag.o.y;
	    rDrag.o.style.left = oLeft + 'px';
	    rDrag.o.style.top = oTop + 'px';
    },
    end:function(e){
	    e = rDrag.fixEvent(e);
	    rDrag.o = document.onmousemove = document.onmouseup = null;
    },
    fixEvent: function(e){
    if (!e) {
    e = window.event;
    e.target = e.srcElement;
    e.layerX = e.offsetX;
    e.layerY = e.offsetY;
    }
    return e;
    }
    }

var domid=1;	
function add_div()
{   var label=jQuery("#mylabel").val();
   if (label==''){KesionJS.Alert('请选择选标签!',null);return;}
    var o=document.createElement("label");
    o.className="mo";
    o.id="m"+domid;
    jQuery("#mybody").append(o);
    o.innerHTML=label;
    domid++;
	rDrag.init(o);
	
	jQuery("#mybody").find(".mo").each(function(){ //双击删除标签
	   jQuery(this).dblclick(function(){
	    if (confirm('确定删除该标签吗？')){
		 jQuery(this).remove();
		 }
	   });
    });
	
}

jQuery(function(){
 jQuery("#mybody").find("label").each(function(){
   rDrag.init(jQuery(this)[0]);
   jQuery(this).dblclick(function(){
	    if (confirm('确定删除该标签吗？')){
		 jQuery(this).remove();
		 }
   });
 });
});


function changebg(v){
 if (v=='') return;
 jQuery("#mybody").attr("style","background:url(../../ks_inc/mall/express/"+v+")");
}
    

</script>
<script>
top.imgUploadBack = function(src){
	$('.defaultpic')[0].src = src;
	$('input[name="defaultpic"]')[0].value = src;
};
function do_reg(){
    var password = $("input[name='password']").val();
    var passwordchk=$("input[name='assertpassword']").val();
	var oldpassword=$("input[name='oldpassword']").val();
    if(password!=passwordchk){
        Alert('两次密码不一致');
    }
    else{
        $("#myform").submit();
    }
}
</script>
</body>
</html>
