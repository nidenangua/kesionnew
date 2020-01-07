<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
</head>
<body>


<style>
	.drag-box-content{
		padding-top:0;
	}
	font[color=red]{
		font-weight:bold;
	}
	.warm-text{
		color:#5e6062;
		font-size:15px;
	}
	
	input.ks-bt{
		background:#476DBE;
		border:none;
		color:white;
		transition:all 0.2s linear;		
	}
	.drag-download-str-mod a{
		text-decoration:none;
		color:#476DBE;
	}
	#drag-submit-prev{
		display:none;
	}
	.for-drag-submit-prev{
		display:inline-block;
		background:#476DBE;
		color:white;
		border-radius:4px;
		font-size:13px;
		padding:0 5px;
		transition:all 0.2s linear;
	}
	.drag-add-margin{
		margin-top:6px;
	}
	.drag-model-submit{
		position:relative;
		top:55px;
		left:20px;
		margin-top:10px;
	}
	.drag-head-label{
		color:#5e6062;
		font-size:15px;
	}
	input.ks-bt:hover,.for-drag-submit-prev:hover{
		background:#0043B5;
	}

	.hLh40 label,
	.hLh40 span{height: 40px!important ; line-height: 40px!important;overflow: hidden;margin-top: 0;}
</style>
<div class="drag-box-content" style="padding:0px 20px 20px 20px;">
	<?php if($type == 1){ ?>
		<label class='drag-head-label drag-add-margin'><input type="radio" name="outin" id="" value="1" checked="true" onclick="chose(1)" />导入</label>
		<label class='drag-head-label drag-add-margin'><input type="radio" name="outin" id="" value="2" onclick="chose(2)" />导出</label><br />
	<?php }?>
	<div class="hLh40 drag-download-str-mod clearfix" id="muban" <?php if($type == 1){ echo 'style="margin-top: 20px;"' ;}?>>
		<?php if($type == 1){ ?>
		<label class='drag-head-label drag-add-margin'>【下载学员列表模板】</label>
		<label class='drag-head-label drag-add-margin'>点击<a href="<?php echo UOOT; ?>Public/学员导入模板.xls">此处</a>下载模板</label>
		<?php }elseif($type == 2){ ?>
		<label class='drag-head-label drag-add-margin'>【下载题库列表模板】</label>
		<label class='drag-head-label drag-add-margin'>点击<a href="<?php echo UOOT; ?>Public/题库模板.xls">此处</a>下载模板</label>	
		<?php } ?>	
	</div>
	<form action="<?php echo M_URL('Index','doExcel','',GP('type-'.$type.',courseid-'.$courseid.',classid-'.$classid));  ?>" method="post" enctype="multipart/form-data" id='form1'>
		<div style="height:130px">
			<div class="hLh40 clearfix">
				
				<label class='drag-head-label drag-add-margin'><?php if($type == 1){ echo '【导入学员】';}else{echo '【导入题目】' ;} ?></label>
				
				<input size="100" type="file" name="execl" id="file" style="display: none;">
				
				<button type="button" class="ks-heade-button mr10" onclick="document.getElementById('file').click()">选择文件</button>
				
				<div class="showFileName1"></div>
				
				
			</div>
		
			<div style=" background-color: #fef0f0; color: #f56c6c; padding: 0px 10px; line-height:34px;margin-top:15px;">
			上传格式请严格参照模板，再进行提交，否则无效！
			</div>
		</div>
		<div class="clearfix ks-popup-footer form-footer">
			<div class="d-inline-block" ><input type="submit" value="提交模板" class="ks-bt  bt-pue"></div>
		
		</div>
	</form>
	<?php if($type == 1){ ?>
	<div class="hLh40 drag-download-str-mod clearfix" id="muban2" style='display: none;margin-top: 17px;'>
	   <label class='drag-head-label drag-add-margin'>请选择需要导出的时间段：</label><br />
	</div>
	<form action="<?php echo M_URL('users/Index','doExceluser','',GP(''));  ?>" method="post" enctype="multipart/form-data" id='form2' style='display: none;margin-top: 20px;'>
		<div style="height:130px">
			<label>
				<input type="radio" id="ratiotime" name="outtime" value="1" onclick="$('#timebox').hide()"/>本周</span>
			</label>
			<label>
				<input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"/>本月</span>
			</label>
			<label>
				<input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"/>本年</label>
			<label>
				<input type="radio" id="ratiotime" name="outtime" value="4" onclick="$('#timebox').show()"/>自定义
			</label><br />
			<span style="display: none;    float: left;    margin-top: 17px;" id="timebox">
				<input id="start" type="text" value="" name="startime" required readonly class="laydate-icon">
					-
				<input id="end" type="text" value=""name="endtime" required readonly class="laydate-icon">
			</span>
		</div>
		<div class="clearfix ks-popup-footer form-footer">
			<div class="d-inline-block" ><input type="button" onclick="do_reg()" value="确认导出" class="ks-bt  bt-pue"></div>
		
		</div>
	</form>
	<?php } ?>
</div>

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script src="<?php echo UOOT;?>/Public/common/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		$(".file").on("change","input[type='file']",function(){
		    var filePath=$(this).val();
		  
		    var arr=filePath.split('\\');
		    var fileName=arr[arr.length-1];
		    $(".showFileName1").html(fileName);
		   
		})

	})	
		function chose(type){
			if(type==1){
				$('#form2').hide();
				$('#muban2').hide();
				$('#form1').show();
				$('#muban').show();
			}else{
				$('#form2').show();
				$('#muban2').show();
				$('#form1').hide();
				$('#muban').hide();
			}
		}	
		var radionum = document.getElementsByName("outin");
		for(i=0;i<radionum.length;i++){
			if(radionum[i].checked){
				if(radionum[i].value==1){
					chose(1)
				}else if(radionum[i].value==2){
					chose(2)
				}
			}
		}
		function do_reg(){
			$("#form2").submit()
			 top.closePopup('all');
		}
//		chose();
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

</body>
</html>