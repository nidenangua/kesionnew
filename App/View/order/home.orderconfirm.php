<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
	.mt50{margin-top: 20px;}
	.ks-borde td{border:0;text-align: left;}
	.ks-bborde {border-bottom: 1px solid #eee;}
</style>
</head>
<body class="ks-wrap"> 
		<div id="ksBoxHead" >
		<!--结束-->

		<!--操作范围-->
		</div>

		
	      
		   <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','orderconfirm','',GP('orderid-'.$orderid));?>" method="post" id="myform">        
		   		<div id="ksBoxContent">
            		
            	<div class="form-row clearfix">
	              	
	              		  <label for="inlineRadio9">
	              			 <input type="radio" id="inlineRadio9" value="0" class="radioInput" name="chargetype">银行账户支付</label>
					     
	              		
	              		<label for="inlineRadio7" class="label-on" style="float: right;">
					     	<input type="radio" id="inlineRadio7" value="1" class="radioInput" name="chargetype" checked="">现金支付</label>
	              	</div>
	              	
	              <div class="form-row mt10 clearfix">
	              		<span class="name name-nowrap "  style="display: inline-block;vertical-align: top;padding:10px 10px 0 0;">备注</span>
	              		
	              			<textarea class="form-textarea" name='mark' style="width:300px;min-height: 50px;border-radius: 10px;display: inline-block;"></textarea>
	              		
	              	</div>	
	              	
		    	</div>
				<div id="ksBoxFooter">
					<div class="ks-bom clearfix">
						<span class="" style="display: inline-block;">
							<button type="submit" class="ks-bt bt-pue mr10" >确定</button>
							<button type="button"  class="ks-bt bt-pue" onclick="close1();" >取消</button>
						</span>
						
					
				</div>
			</form>
	

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage'],function(){
		loadScorllJs();
	})

	
	
function updatesStatus(id){
  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
   })
}
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
function close1(){
	//parent.closePopup('all');
	top.closePopup('all');
}
</script>

</body>
</html>

