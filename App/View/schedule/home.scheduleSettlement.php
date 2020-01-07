<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title></title>
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
		
    </div>
	<div class="bRadius10 bg-white mt20">
		
				<div id="ksBoxContent">
					<form target="hidframe"  method="post" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','doSettlement','',GP("")); ?>">

		              <table class="ks-table">
		              			<tr>
		              				<td>老师</td>
		              				<td>结算金额</td>
		              				<td>备注</td>
		              			</tr>
		              			<tr>
		              				<td><?php echo !empty($teacher['name']) ? $teacher['name'] : $teacher['username']; ?></td>		              				
		              				<td><input type="number" class="form-textbox w150" name="money1" value="<?php echo $teacherMoney; ?>" /></td>
		              				<td><input type="text" class="form-textbox w300" name="remarks1" value="" /></td>
		              				<input type="hidden"  name="teacherid" value="<?php echo $schedule['teacherid']; ?>"/>
		              			</tr>
		              			<?php if($assisant){ ?>
		              			 <tr>
		              				<td><?php echo !empty($assisant['name']) ? $assisant['name'] : $assisant['username']; ?></td>		    
	              				    <td><input type="number" class="form-textbox w150" name="money2" value="<?php echo $assisantMoney ?>" /></td>
	              				    <td><input type="text" class="form-textbox w300" name="remarks2" value="" /></td>
		              			</tr>
		              			   <input type="hidden"  name="assisantid" value="<?php echo $schedule['assisantid']; ?>"/>
		              			<?php } ?>
		              		</table>
		          
		          		<input type="hidden" name="classid"  value="<?php echo $schedule['classid']; ?>"/>
						<input type="hidden" name="scheduleid"  value="<?php echo $schedule['id']; ?>"/>   
						<input type="hidden" name="isassisant"  value="<?php echo $isassisant; ?>"/>     
        </form>
        
	</div>
		
  <div class="clearfix ks-popup-footer form-footer">
		<div class="ks-bom" >
			<span class="d-inline-block" >
				<button onClick="do_reg()" class="ks-bt bt-pue mr5">确认发送</button>
				<button onclick="close()" class="ks-bt bt-white">取消</button>
			</span>
		</div>
	</div> 

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<!--<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>-->
<script>
function do_reg(){
	$('#myform').submit();
}
function close(){
	
}
</script>
</body>
</html>

