<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body>
<div class="p20">
	<form action="<?php echo M_URL('Distribution','saveData','',GP('courseType-'.$courseType,true));  ?>" id="myform" method="post" enctype="multipart/form-data">
	<div class="fsize16 hLh40 bg-green">
		<label>【选择类型】</label>
		<select class="inputText bRadius5 " name="courseType" id="coursetype-box" style="width: 242px;margin-left: 10px" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Distribution','adddistribution'); ?>','courseType','<?php echo URL_MODEL;?>');"> 
			<option value="0"<?php if($courseType==0){ echo 'selected="selected"';} ?>>课程</option>
				 <option value="7"<?php if($courseType==7){ echo 'selected="selected"';} ?>>专栏</option>
            <option value="8"<?php if($courseType==8){ echo 'selected="selected"';} ?>>教辅周边</option>
		</select>
          
	</div>
	<br />
	<div class="fsize16 hLh40 bg-green">
		<label>【选择课程】</label>
        

		<select class="inputText bRadius5 " name="id" id="course-box" style="width: 242px;margin-left: 10px">
			<option value="0">请选择<?php if($courseType==0){echo '课程';}elseif($courseType==7){echo '专栏';}?></option>
			<?php if(!empty($courseAry)){
            foreach($courseAry as $k =>$v){?>
			<option value="<?php if($courseType==1){echo $v['classid'];}elseif($courseType==7){echo $v['columnid'];}else{echo $v['courseid'];}?>" data-realprice='<?php echo $v['price']?>' data-price='<?php echo $v['price_market']?>'><?php echo $v['title']?></option>
			<?php } }?>
		</select>
	</div>
	<br />
	<div class="fsize16 hLh40 bg-gary ks-top-search" style="padding-top: 8px;">
		<label>【课程市场价】</label>
		<input type="text" class="sc-text sc-mini-pc" id="price" style="width: 242px" disabled>
	</div>
	<br />
	<div class="fsize16 hLh40 bg-gary ks-top-search" style="padding-top: 8px;">
		<label>【实际销售价】</label>
		<input type="text" class="sc-text sc-mini-pc" id="realprice" style="width: 242px" disabled>
	</div>
	<br />
	<div class="fsize16 hLh40 bg-gary ks-top-search" style="padding-top: 8px;">
		<label>【佣金比例】</label>
		<input type="number" class="sc-text sc-mini-pc" oninput="if(value>99)value=99;if(value.length>2)value=value.slice(0,2);if(value<1)value=''" name="commission" id="commission" style="width: 242px" onkeyup="do_price()">&nbsp;%
	</div>
	<br />
	<div class="fsize16 hLh40 bg-gary ks-top-search" style="padding-top: 8px;">
		<label>【佣金】</label>
		<input type="number" class="sc-text sc-mini-pc"  name="" id="number-v" style="width: 242px" disabled>
	</div>
	<br />
	<div class="fsize16 hLh40 ">
		<input type="button" value="确认提交" onclick="do_reg()" class="ks-bt bt-green" style="line-height: 20px;left: 37%;position: relative;">
	</div>
	</form>
	<br />
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript">
 
	$('#course-box').change(function(){
		var price = $("#course-box  option:selected").attr('data-price')
		var price2 = $("#course-box  option:selected").attr('data-realprice')
        // alert(price)
        $("#price").val(price)
        $("#realprice").val(price2)
	})
	
	function do_price(){
		var a = $('#commission').val();
		var b = $("#realprice").val();
		var c = Math.floor((b*(a/100))* 100)/100;
//		c     = c.toFixed(2)
		$("#number-v").val(c)
	}
	function do_reg(){
		if($("#course-box").val()==0){
			Alert('请选择课程')
			return false;
		}
		if($("#commission").val()==''||$("#commission").val()==0){
			Alert('请设置佣金')
		}else{
			$("#myform").submit()
		}
		
	}
</script>
</body>
</html>