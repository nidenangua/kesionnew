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
					<form target="hidframe"  method="post" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','dobatchSettlement','',GP("")); ?>">

		              <table class="ks-table">
		              			<tr>
		              				<td>上课时间</td>
		              				<td>班级名称</td>
		              				<td>主讲老师</td>
		              				<td>主讲老师费用</td>
		              				<td>助教老师</td>
		              				<td>助教老师费用</td>
		              			</tr>
		              			<?php foreach($values as $k=>$v){ ?>
		              			<tr>
		              				<td><?php echo date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']); ?></td>		              			                         <td><?php  echo Field($v['title']);  ?></td>
		              				<td><?php  echo Field($v['teachername']);  ?></td>
		              				<td><input type="number" name="teacherMoney[]" value="<?php echo $v['teacherMoney'] ?>"></td>
		              				<td><?php  echo Field($v['assisantname']);  ?></td>
		              				<td><input type="number" name="assisantMoney[]" value="<?php echo $v['assisantMoney'] ?>"></td>
		              	             <input type="hidden" name="scheduleid[]" value="<?php echo $v['id'] ?>" />
		              	             <input type="hidden" name="teacherid[]" value="<?php echo $v['teacherid'] ?>" />
		              	             <input type="hidden" name="assisantid[]" value="<?php echo $v['assisantid'] ?>" />
		              			</tr>
		              			<?php } ?>
		              		</table>
		          
		          		
        </form>
        
	</div>
		
  <div class="clearfix ks-popup-footer form-footer">
		<div class="ks-bom" >
			<span class="d-inline-block" >
				<button onClick="do_reg()" class="ks-bt bt-pue mr5">确认保存</button>
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

