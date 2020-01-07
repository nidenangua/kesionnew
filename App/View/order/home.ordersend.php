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

		   <form style="margin-top: -38px;" target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','ordersend','',GP('orderid-'.$orderid));?>" method="post" id="myform">
               <table class="ks-table ks-borde send" style="color: #ababab;">

                   <tr>
                       <td style="text-align: right;width: 74px">
                           收货人:
                       </td>
                       <td>
                           <?php echo $ordermsg['realname']; ?>
                       </td>
                   </tr>
                   <tr>
                       <td style="text-align: right;width: 74px">
                           收货手机号:
                       </td>
                       <td>
                           <?php echo $ordermsg['telphone']; ?>
                       </td>
                   </tr>
                   <tr>
                       <td style="text-align: right;width: 74px">
                           收货地址:
                       </td>
                       <td>
                           <?php echo $ordermsg['street']; ?>
                       </td>
                   </tr>
                   <tr>
                       <td style="text-align: right;width: 74px">
                           买家留言:
                       </td>
                       <td>
                           <?php echo $ordermsg['mark']; ?>
                       </td>
                   </tr>
               </table>
               <div id="ksBoxContent">
            		
            	<div class="form-row clearfix" style="margin-top: 4px;">
                        <label style="color: #ababab;margin-left: 21px;">物流名称:</label>
                    <select class="w300 inputText bRadius5 fl" id="abridge" name="abridge">
                        <option value="-1">请选择快递</option>
                        <?php
                            foreach ($this->abridge as $k=>$i){
                               ?> <option value="<?php echo $k?>"><?php echo $i?></option><?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-row clearfix">
                    <label style="color: #ababab;margin-left: 21px;">快递单号:</label><input style="width: 305px;height:30px;" type="type" name="expressNumber">
                </div>
	              	
		    	</div>
				<div id="ksBoxFooter">
					<div class="ks-bom clearfix">
						<span class="" style="display: inline-block;">
							<button type="submit" class="ks-bt bt-pue mr10" >确定并发货</button>&nbsp;&nbsp;&nbsp;
							<button type="button"  class="ks-bt bt-pue" onclick="close1();" >关闭</button>
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

