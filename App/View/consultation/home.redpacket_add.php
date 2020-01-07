<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title><?php if(!empty($cardInfo)){echo "修改学习卡";}else{echo "添加学习卡";} ?></title>
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">	
   <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<!--开始-->
	<div id="ksBoxHead">
		<!--结束-->
		<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			<!--标题-->
			<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>优惠券</a><span>/</span>发送优惠券 </p>
			<!--标题-->
			</div>
			<!--操作范围-->
			<!--操作范围-->
		</div>
    </div>
	<div class="bRadius10 bg-white mt20">
		<form target="hidframe"  method="post" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','doAddVoucher','',GP("")); ?>"
		      enctype="multipart/form-data">
				<div id="ksBoxContent">
		              	<div class="form-box " >
                            <div class="form-row">
			              		<span class="name" ><i class="form-star">*</i>选择要发送的学员</span>
			              			<input type="button" class="form-textbox w150" name="redpacket" value="选择学员 " onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addStudent','',GP('')) ?>','850px','600px',{title:'选择学员发放',type:'top'})" />
		              	    </div>
	              	    	<div class="form-row">
			              		<span class="name" ><i class="form-star">*</i>发送的学员用户名(每个用户名之间用逗号隔开)</span>
			              		<input type="text" class="form-textbox w500" name="names" readonly="" value=" " />
		              	   </div>              	
			               <div class="form-row">
			              		<span class="name"><i class="form-star">*</i>现金优惠券金额</span>
			              	    <input type="number" class="form-textbox w150" name="money" value="10"  />元
		              	   </div>
			               <div class="form-row">
			              		<span class="name">使用结束时间</span>
		                        <input id="end" style="width: 240px;"  type="text"  name="endtime"  class=" laydate-icon"  value="<?php echo  date("Y-m-d 23:59:59",strtotime("+15 day"));?>" >	
			              	</div> 
			              	<div class="message">
								<div class="form-row clearfix">
									<?php 
										$Data006['wxid']      = $this->wxid;
										$Data006['modelname'] = 'Sendvoucher'; 
										$IndexModel = M('Application/IndexModel');
										echo $IndexModel->show_mail($Data006);
									?>
					          	</div>
						    </div>	
	              		    <input type="hidden" name="ids" id="ids"/>     
		              </div>      
		        </div>
        </form>
        
	</div>
		
    <div class="clearfix ks-popup-footer form-footer">
		<div class="ks-bom" >
			<span  class="d-inline-block">
				<button onClick="do_reg()" class="ks-bt bt-pue mr5">确认发送</button>
				<button onclick="javascript:history.go(-1);" class="ks-bt bt-white">取消</button>
			</span>
		</div>
	</div> 

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<!--<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>-->
<script>
	 datatime("#end")
top.dataCallBack = function(data){
	$('#ids').val(data.radioID);
	$('[name=names]').val(data.radioname);
//	console.log(data.radioID);
}
function do_reg(){
	$('#myform').submit();	
}
</script>
</body>
</html>

