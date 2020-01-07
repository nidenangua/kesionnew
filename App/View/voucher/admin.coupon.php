<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>kesion教育平台</title>
    <meta name="Keywords" content="kesion教育平台"/>
    <meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
	<style>
		.ml30{position: relative;top: 5px; margin-left: 20px!important;}
		.span-inline label{display: block;float: none!important;margin-bottom: 10px;}
		.laydate-icon, .laydate-icon-dahong, .laydate-icon-danlan, .laydate-icon-default, .laydate-icon-molv{height: 34px!important;}
		.control-label {text-align: right;margin-top: 7px;}
	</style>
</head>
<body class="ks-wrap"> 
	
	<div class="bRadius10 ">
	<div id="ksBoxHead">
		<!--结束-->
		<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			
	
			
			<!--标题-->
			<p><a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>优惠券编辑</a></p>
			<!--标题-->
			
			</div>
			
		</div>
	</div>
	<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">优惠券编辑 </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));?>" class="ks-bt bt-def"><i class="iconfont icon-fanhui"></i>返回</a>
			<!--搜索-->
			</div>  
              
               
        </div>
    </div>
</div>
</div>
	
	
 	<form target="hidframe" id="myform"  action="<?php if(isset($ary)){echo M_URL($this->AppName.'/Index','editcoupon','',GP(''));}else{ echo M_URL($this->AppName.'/Index','addcoupon','',GP(''));}  ?>"  method="post">
	<div  class="ks-wbox  bRadius10 mt20" >
		<div id="ksBoxContent" class="view-content">
			<!--公告-->
					  	<!--公告结束-->
			<!--消息-->
			<div class="news">
					<div class="form-row span-inline clearfix">
                          <div class="form-group clearfix">
                          	<span class="col-sm-2 control-label">优惠券名称：</span>
                          		<div class="col-sm-4"><input type="text" class="form-control" name="couponname" value="<?php if(isset($ary)) {echo $ary['voucher'];} ?>"/></div>
                          </div>
                          <div class="hr-line-dashed"></div>
                           <div class="form-group clearfix">
                          	<span class="col-sm-2 control-label">优惠券价格：</span>
                          	<div class="col-sm-4">
                          	<input id="recharge_money" name="price" value="<?php if(isset($ary)){echo $ary['facevalue'];}  ?>" class="form-control"> 
                          	</div>	
                          </div>
                            <div class="hr-line-dashed"></div>
                           <div class="form-group clearfix">
                          	<span class="col-sm-2 control-label">最大发放数量：</span>
                          	<div class="col-sm-4">
                          	<input onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="maxnum" value="<?php if(isset($ary)){ echo $ary['maxnum'];} ?>" class="form-control"> 
                          	</div>	
                          </div>
                             <div class="hr-line-dashed"></div>
                         <div class="form-group clearfix">
                          	<span class="col-sm-2 control-label">限制使用价格：</span>
                          	<div class="col-sm-4">
                          	<input id="recharge_money2" name="minamount" value="<?php if(isset($ary)){ echo $ary['minamount'];} ?>" class="form-control"> 
                          	</div>	
                          </div>
                            <div class="hr-line-dashed"></div>
                             <div class="form-group clearfix">
                          	<span class="col-sm-2 control-label">优惠券号前缀：</span>
                          	<div class="col-sm-4">
	                          	<input id="check_head" name="headnum" value="<?php if(isset($ary)){ echo $ary['headnum'];} ?>" class="form-control"> 
	                          </div>
                          </div>
                           <div class="hr-line-dashed"></div>
                          <div class="form-group clearfix">
                          	<span class="col-sm-2 control-label">开始日期：</span>
                          	<div class="col-sm-4">
                          	<input id="start" type="text" value="<?php if(isset($ary)){echo date('Y-m-d H:i:s',$ary['startime']);}  ?>" name="startime" required readonly class="w300 laydate-icon form-control" >
                          	</div>	
                          </div>
                           <div class="hr-line-dashed"></div>
                           <div class="form-group clearfix">
                          	<span class="col-sm-2 control-label">结束日期：</span>
                          	<div class="col-sm-4">
                          	<input id="end" type="text" value="<?php if(isset($ary)){ echo date('Y-m-d H:i:s',$ary['endtime']);} ?>"name="endtime" required readonly class="w300 laydate-icon form-control"> </div>

                          </div>
                            <div class="hr-line-dashed"></div>
                         <div class="form-group clearfix">
                          <span class="col-sm-2 control-label">优惠券描述：</span>
                          	<div class="col-sm-4">
                          	<input type="text" name="desc" value="<?php if(isset($ary)){ echo $ary['descript'];} ?>" class="form-control"> 
                          		
                          </div>
                         </div> 
                           <div class="hr-line-dashed"></div>
                         <div class="form-group clearfix">
                          	 <span class="col-sm-2 control-label">优惠券使用状态：</span>
                          	<label for="voucherstatus" >
							     <input type="radio" id="voucherstatus"  value="1" class="radioInput" name="status" <?php if(isset($ary)&&$ary['status']==1) {echo 'checked';} ?>><span class="fl">立即使用</span>
							     <input type="radio" class="radioInput" name="status" value="0"  <?php if(isset($ary)&&$ary['status']==0) {echo 'checked';} ?>><span >暂停使用</span>
						     </label>
                          </div>
                            <div class="hr-line-dashed"></div>
                          <div class="form-group clearfix">
                          	<span class="col-sm-2 control-label">优惠券类型：</span>
                          	<label for="coupontype" >
							     <input type="radio" id="coupontype" value="0" class="radioInput" name="coupontype" <?php if(isset($ary)&&$ary['scope']==0) {echo 'checked';} ?>><span class="fl">通用</span>
							     <input type="radio" class="radioInput" name="coupontype" value="1" onclick="$('#concrete').show()" <?php if(isset($ary)&&$ary['scope']==1) {echo 'checked';} ?>><span >指定范围</span>
						     </label>
                          </div>
                            <div class="hr-line-dashed"></div>
                          <div  class="form-group clearfix" id="concrete" style="display: none;">
                          	<span class="col-sm-2 control-label">具体可用范围：</span>
                                 <input type="checkbox"  value="0"  name="concretetype[]"><span >点播</span>
			          			 <input type="checkbox"  value="1"  name="concretetype[]"><span >直播</span>
			          			 <input type="checkbox"  value="2"  name="concretetype[]"><span >连麦音</span>
			          			 <input type="checkbox"  value="3"  name="concretetype[]"><span >视频</span>
			          			 <input type="checkbox"  value="4"  name="concretetype[]"><span >短信</span>
			          			 <input type="checkbox"  value="5"  name="concretetype[]"><span >邮件</span>
                          </div>
		           </div>
		  	</div>			    
	    </div>

<div class="footer-page">
	<div class="col-sm-5"></div>
	<div class="col-sm-3 mt10">
			<button class="btn btn-default btn-s-md" type="submit" name="couponId" value="<?php if(isset($ary)) {echo $ary['id'];} ?>" onclick='do_reg()'>确定提交</button>
				<button class="btn btn-default btn-s-md" type="submit" name="couponId" value="<?php if(isset($ary)) {echo $ary['id'];} ?>" onclick='do_reg()'>取消</button>
		</div>
	
	</div>
		
</div>
</form>
</div>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script> 
<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
<script>
	var start = {
	  elem: '#start',
	  format: 'YYYY/MM/DD hh:mm:ss',
	  //min: laydate.now(), //设定最小日期为当前日期
	  max: '2099-06-16 23:59:59', //最大日期
	  istime: true,
	  istoday: false,
	  choose: function(datas){
	     end.min = datas; //开始日选好后，重置结束日的最小日期
	     end.start = datas //将结束日的初始值设定为开始日
	  }
	};
	var end = {
	  elem: '#end',
	  format: 'YYYY/MM/DD hh:mm:ss',
	  min: laydate.now(),
	  max: '2099-06-16 23:59:59',
	  istime: true,
	  istoday: false,
	 
	};
	laydate(start);
	laydate(end);	
</script>

<script>
		
function do_reg(){
	$('#myform').submit();
}

$('#coupontype').on('click',function(){
	    var cks = document.getElementsByName("concretetype");
	    for(i=0;i<cks.length;i++){
	        cks[i].checked = false;//当点击通用时取消所有选中的
	    }
	$('#concrete').hide()
})
</script>
<script>
$("#recharge_money").keyup(function () {
    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
    var txt = '';
    if (reg != null) {txt = reg[0];}
    $(this).val(txt);
}).change(function () {
    $(this).keyup();
});	
$("#recharge_money2").keyup(function () {
    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
    var txt = '';
    if (reg != null) {txt = reg[0];}
    $(this).val(txt);
}).change(function () {
    $(this).keyup();
});	
$("#check_head").keyup(function () {
    var reg = $(this).val().match(/^[A-Za-z0-9]+$/);
    var txt = '';
    if (reg != null) {txt = reg[0];}
    $(this).val(txt);
}).change(function () {
    $(this).keyup();
});	
</script>
</body>
</html>
