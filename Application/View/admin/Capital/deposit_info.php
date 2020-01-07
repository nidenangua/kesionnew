<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css"> 
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;}
	.Created-push{display: none;}
	#active{display: block!important;}
	.bt-pue{background: #FF5507;border: 1px solid #FF5507;}
	.btn-default{background:#CCCCCC;#333!important}
</style>
<body class="gray-bg">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	&nbsp;&nbsp;&nbsp;提现查看
        	
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
    </div>
</div>
</div></form>

<br />
<br />
<br />

<div id="ksBoxContent">

<form target="hidframe"  class="form-horizontal" action="<?php echo UOOT;?>admin.php/home/H5market/doaddH5" method="post" enctype="multipart/form-data">
	
	
	
<div class="Created-push" id="active">
		<ul>
			
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>基本查看</span>
					</div>
				</div>
				<div class="">
					<div class="Created-ing">
					<ul>
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>结算状态:</h4>
							<div class="Created-Content clearfix">
								<label for=""><input type="radio" />已打款</label>
								<label for=""><input type="radio" />未打款</label>
								<label for=""><input type="radio" />已退款</label>
							</div>
						</li>
						<li>
							<h4>审核状态:</h4>
							<div class="Created-Content clearfix">
								<label for=""><input type="radio" />已审核</label>
								<label for=""><input type="radio" />未审核</label>
							</div>
						</li>
						
						<li>
							<h4>结算用户:</h4>
							<div class="Created-Content">
								Cariie					
							</div>
						</li>
						<li>
							<h4>结算方式:</h4>
							<div class="Created-Content">
								转入银行					
							</div>
						</li>

						<li>
							<h4>提现金额:</h4>
							<div class="Created-Content">
								10.00元				
							</div>
						</li>
						<li>
							<h4>联系电话:</h4>
							<div class="Created-Content">
								15260158253				
							</div>
						</li>
						<li>
							<h4>机构开户银行:</h4>
							<div class="Created-Content">
								中国建设银行				
							</div>
						</li>
						<li>
							<h4>申请备注:</h4>
							<div class="Created-Content">
								CARRY				
							</div>
						</li>
						<li>
							<h4 style="top: 10px;">回复:</h4>
							<div class="Created-Content">
								<textarea name="" rows="" cols="" style="width:80%;"></textarea>			
							</div>
						</li>
						<li>
							<br />
							<br />
						
						</li>
					</ul>
					
				</div>
				
					
				</div>
				
				
			</li>
			
					</ul>
		
		<div style="text-align: center;">
            <button type="submit" class="btn btn-primary btn-s-md bt-pue mr20" >确定修改</button>
            <a href="javascript:history.go(-1);" class="btn btn-primary btn-s-md bt-pue mr20">取消修改</a> 
        </div>
	</div>
	

</div>	

	

</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
<script type="text/javascript">
	$("#tablist li").click(function(){
		
		$("#tablist li").removeClass("active"); 
		$(this).addClass("active");
		
		var index = $(this).index();
		$(".Created-push").removeAttr("id")
		console.log(index);
		$(".Created-push").eq(index).attr("id","active");
	})
</script>
</html>
