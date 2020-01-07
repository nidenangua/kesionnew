<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
	.fn{float: none!important;}
	.tab{display: none;}
	.info-ul{}
	.info-ul ul{ padding: 30px 60px;}
	.info-ul li span:first-child{margin-right:20px;}
	.info-ul li{font-size: 16px;margin-bottom: 10px;}
	.info-ul li input[type=text]{border: #E5E5E5 1px solid;border-radius: 3px;height:35px; width: 300px;margin-left:10px;}
	.wlen{width: 300px;text-align: left!important;}
	.wlen a{border-radius: 20px;border: solid 1px #34B5EE;font-size: 12px;height: 20px;padding: 0px 10px;color:#34B5EE;}
	.tab tr:first-child{background: #CCCCCC;}
	.tab tr{border-bottom: 1px dashed #E5E5E5;}
</style>
<body>
	
	<div class="tab" style="display: block;">
		<div class="info-ul">
			<ul>
				<li>
					<span class="fl">支付方式</span>
					<label for="isshow1"><input type="radio" value="0" onclick="Payswitch(0)" name="payment" <?php  if(isset($setting[1])){if($setting[1]==0) echo "checked";}?> >平台收取</label>
					<label for="isshow0"><input type="radio" value="1" onclick="Payswitch(1)"  name="payment"  <?php  if(isset($setting[1])){if($setting[1]==1) echo "checked";}else{echo 'checked';}?> >用户收取</label>
					
				</li>
			</ul>
			
		</div>
		<div style="width: 100%;height: 40px; position: absolute;text-align: center;bottom: 15px;left: 0px;;">
			<!--<button class="ks-bt bt-pue fn">&nbsp;&nbsp;确认&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="ks-bt bt-gray fn" onclick="closed()">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>-->
		</div>
		<div style="position: absolute;text-align: center;bottom: 15px;right: 20px;font-size: 14px;">
			<a href="javascript:;" id="getmore">更改记录</a>
		</div>
	

	</div>
	
	
	<div class="tab" id="more">
		
		<div style="padding: 15px;">
			<table class="ks-table">
				<tr>
					<th>更改者</th>
					<th>更时间</th>
					<th style="width: 200px;text-align: left;">更凭证</th>
				</tr>
				
				<tr>
					<td>CARY</td>
					<td>2018-2-26</td>
					<td class="wlen">
						哈哈就是个凭证有意见吗哈哈就是个凭证有意见吗哈哈就是个凭证有意见吗
						<a href="">下载</a>
					</td>
				</tr>
				
				<tr>
					<td>CARY</td>
					<td>2018-2-26</td>
					<td class="wlen">
						哈哈就是个凭证有意见吗哈哈就是个凭证有意见吗哈哈就是个凭证有意见吗
						<a href="">下载</a>
					</td>
				</tr>
				
				<tr>
					<td>CARY</td>
					<td>2018-2-26</td>
					<td class="wlen">
						哈哈就是个凭证有意见吗哈哈就是个凭证有意见吗哈哈就是个凭证有意见吗
						<a href="">下载</a>
					</td>
				</tr>
				
				
				
				
			</table>	
		</div>
		<br />	
		<div style="text-align: right;height: 40px;font-size: 16px;">
			<a href="javascript:;" id="backthis">返回&nbsp;&nbsp;&nbsp;&nbsp;</a>
		</div>

		
	</div>


</body>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript">
	$("#getmore").click(function(){
		$(".tab").hide();
		$("#more").show();
		
	})
	$("#backthis").click(function(){
		$(".tab").show();
		$("#more").hide();
	})

	function closed(){
		top.$(".ks-popup-close").click();
	}
	function Payswitch(paystyle){
	var url = "<?php echo M_URL('home/Domain','Payswitch',$wxid,GP('')); ?>";
	$.ajax({
		type:"post",
		url:url,
		data:{'paystyle':paystyle},
		success:function(data){
		   if(data=='succeed'){
			   location.reload();		
		   }else if(data=='faild'){
		 	   Alert('开启失败');
		   }
		},
	    error:function(){
		    location.reload();
		}
	});
}	
</script>
</html>



