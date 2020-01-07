<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>用户个人资料</title>
<meta name="Keywords" content="用户个人资料"/>
<meta name="Description" content="用户个人资料" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	.form-row {padding-bottom: 0;}
	.word-all span{color: #ababab!important;line-height: 28px;}
	.Created-Content select {height: 36px;}
	.Created-ing>ul>div>li {
		margin-top: 20px;
		position: relative;
		padding-left: 130px;
		color: #A3A3A3;
	}
	.Created-ing>ul>div>li h4 {
	    width: 120px;
	    position: absolute;
	    left: 0px;
	    top: 50%;
	    margin-top: -12.5px;
	    text-align: right;
	    font-size: 14px;
	    color: #A3A3A3;
	}
	#nickname {
		height: 34px;
	    line-height: 34px;
	    text-align: center;
	    background: #fff;
	}
</style>
</head>
<body class="ks-wrap">
<form target="hidframe" action="<?php echo M_URL('Capital','savewithdrawmoney');  ?>" method="post" id="myform">
<div class="bRadius10 ks-wbox ">
	<div class="ks-head-nav">
		<!--标题-->
		<a href="javascript:history.go(-1);">结算中心</a><span> <em>/</em> 结算申请
		<!--标题-->
	</div>
	<div class="configTab" style="display: block;">
		<ul style="">	
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">  
						<span>结算中心</span>
						<span>操作者：<?php echo $this->userinfo['username'];?></span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
					<ul>
						<li>
						<h4>结算账户:</h4>
						<div class="Created-Content">
						<div class="form-row clearfix">
		              	<!--<label for="inlineRadio9" onclick="changePay(this)" data-type='0' class="type label-on"><input type="radio" id="inlineRadio9" value="0" class="radioInput" name="paytype" checked="">银行卡</label>
		              	<label for="inlineRadio8" onclick="changePay(this)" data-type='1' class="type "><input type="radio" id="inlineRadio8" value="1" class="radioInput" name="paytype">支付宝</label>-->
		              	<label for="inlineRadio7"  onclick="changePay(this)" data-type='2' class="type "><input type="radio" id="inlineRadio7" value="2" class="radioInput" name="paytype" checked="checked">微信</label>
						
						
		              	</div>						
						</div>
						</li>
						<div class="xztype" style="display: none;">
							<li>
								<h4>开户银行:</h4>
								<div class="Created-Content">
									<div class="form-row clearfix">
										<select class="form-textbox w300" name="bank">
											<option value="1">中国工商银行</option>
											<option value="2">中国农业银行</option>
											<option value="3">中国银行</option>
											<option value="4">中国建设银行</option>
											<option value="5">交通银行</option>
										</select>
									</div>						 	
								</div>
							</li>
							<li>
							    <h4>银行卡号:</h4>
								<div class="Created-Content">
									<div class="form-row clearfix"><input type="number" class="form-textbox w300" name="banknum[]" value="" ></div>						
								</div>
							</li>
							<li>
								<h4>姓名:</h4>
								<div class="Created-Content">
									<div class="form-row clearfix"><input type="text" class="form-textbox w300" name="name[]" value="" ></div>						
								</div>
							</li>
						</div>
						<div class="xztype" style="display: none;">
							<li>
							    <h4>支付宝号:</h4>
								<div class="Created-Content">
									<div class="form-row clearfix"><input type="number" class="form-textbox w300" name="banknum[]" value="" ></div>						
								</div>
							</li>
							<li>
								<h4>姓名:</h4>
								<div class="Created-Content">
									<div class="form-row clearfix"><input type="text" class="form-textbox w300" name="name[]" value="" ></div>						
								</div>
							</li>
						</div>
						<div class="xztype" style="display: block;">
							<li>
							    <h4>真实姓名:</h4>
								<div class="Created-Content">
									<div class="form-row clearfix"><input type="text" class="form-textbox w300" name="banknum[]" value="<?php echo(isset($name)?$name:''); ?>" ></div>						
								</div>
								注：请务必填写微信账号绑定银行卡时对应的真实姓名，否则微信打款将失败。<!--微信绑定银行卡-->
							</li>
							<li>
							    <h4></h4>
								<div class="Created-Content">
									<div class="form-row clearfix">
									<button type="button" class="ks-heade-button mr10"  style="border-color:#e5412c;background:transparent;color:#e5412c;display: block;" onClick="addTypeChange('<?php echo M_URL('Capital','weixinbind');  ?>','850px','600px',{title:'绑定微信号',type:'top'})" >绑定微信号</button>
									<textarea type="text" id="nickname" readonly="true" style="border:0px;display:none;height:34px;" disabled="false"></textarea>
                                    <input type="hidden" name="openid"/>  
									<input type="hidden" name="nickname"/>  
									</div>						
								</div>
							</li>
						</div>
					</ul>
					</div>
				</div>
			</li>
			<li>
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title">  
						<span>结算金额</span>
						<span>操作者：<?php echo $this->userinfo['username'];?></span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4 style="margin-top: -25.5px;">结算金额:</h4>
								<div class="Created-Content">
									<div class="form-row clearfix" >
										<input type="number" class="form-textbox w300" name="withdrawmoney" value="0.00" id="withdraw_money"/>元 
										<p style="margin-top: 5px;">未入账金额<i style="color:#e83423"><?php echo number_format(getWxPay($this->wxid),2);?></i>元&nbsp;&nbsp;可提现金额<i style="color:#e83423"><?php echo number_format(getWxinfo($this->wxid,'withdrawmoney')-getWxPay($this->wxid),2);?></i>元&nbsp;&nbsp;实际到账<i style="color:#e83423" id="actualmoney">0.00</i>元</p>
										<?php if(checkIsVipVersion($this->wxid)){?>
										<p style="margin-top: 5px;">注：提现手续费<i style="color:#e83423"><?php $base=$this->cache->GetACache('setting');echo number_format($base['poundage1'],2);?></i>%，最低提现额度<i style="color:#e83423"><?php echo number_format($base['withdrawmoney1'],2);?></i>元，每月最多可申请提现<i style="color:#e83423"><?php echo number_format($base['withdrawnum1']);?></i>次。</p>
										<?php }else{?>
										<p style="margin-top: 5px;">注：提现手续费<i style="color:#e83423"><?php $base=$this->cache->GetACache('setting');echo number_format($base['poundage'],2);?></i>%，最低提现额度<i style="color:#e83423"><?php echo number_format($base['withdrawmoney'],2);?></i>元，每月最多可申请提现<i style="color:#e83423"><?php echo number_format($base['withdrawnum']);?></i>次。</p>
										<?php }?>
									</div>						
								</div>
							</li>
							<li>
								<h4>备注说明:</h4>
								<div class="Created-Content clearfix">
									<textarea class="form-textbox" style="min-height: 120px;" name="usermark"></textarea>				
								</div>
							</li>
						</ul>
					</div>
			</li>
			</ul>
		</div>
		<div class="ks-bom clearfix form-footer" >
		<span class="d-inline-block">
			<input type="button" onClick="submitform();" class="ks-bt bt-pue" value="立即申请" name="save"><input type="button" class="ks-bt bt-white" onClick="javascript:history.go(-1);" value="取消申请" name="save">
		</span>
	</div>
</div>	
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs()
})
top.dataCallBack = function(data){
	$('[name=openid]').val(data.openid);
	$('[name=nickname]').val(data.nickname);
	$('#nickname').show().val(data.nickname);
}	
$("#withdraw_money").keyup(function () {
    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
    var txt = '';
    if (reg != null) {txt = reg[0];}
	var poundage    = '<?php echo $base['poundage'];?>';
	var actualmoney = toMoney(txt-txt*poundage*0.01);
	$("#actualmoney").html(actualmoney);
    $(this).val(txt);
}).change(function () {
    $(this).keyup();
});
//将数字转换成金额显示
function toMoney(num){
    num = num.toFixed(2);
    num = parseFloat(num)
    num = num.toLocaleString();
	if(num==0)num='0.00';
    return num;//返回的是字符串23,245.12保留2位小数
}
function submitform(){
	var withdraw_money = $('#withdraw_money').val();
	if(withdraw_money<=0){Alert('提现金额不能为零');return false;}
	$('#myform').submit();
}	
function changePay(that){
	$('type').removeClass('label-on');
	$(that).addClass('label-on');
	$('[name=paytype]').removeAttr('checked')
	$(that).find($('[name=paytype]')).attr("checked","checked");
	$('.xztype').hide();
	$('.xztype').eq($(that).attr('data-type')).show();
}
</script>
</body>
</html>