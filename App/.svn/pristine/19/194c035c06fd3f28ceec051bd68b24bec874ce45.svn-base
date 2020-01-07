<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title><?php if(!empty($cardInfo)){echo "修改学习卡";}else{echo "添加学习卡";} ?></title>
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">
	<!--开始-->
	<div id="ksBoxHead">
		<!--结束-->
 </div>   
	<div class="bRadius10 bg-white mt20">
		<form target="hidframe"  method="post" id="myform"  action="<?php if($id){echo M_URL($this->AppName.'/Index','doEditChannel',$id,GP(""));}else{echo M_URL($this->AppName.'/Index','doAddChannel','',GP(""));} ?>"
		      enctype="multipart/form-data">
				
		              	<div style="min-height: 120px;">
                            <div class="form-row">
			              		<span class="name" style="width:71px;float: left;"><i class="form-star">*</i>渠道名称</span>
			              			<input type="text" class="form-textbox w150" name="channel" value="<?php if($id){echo $values['channel']; }?>"  />
		              	    </div>   
		              </div>      
		        
		        
        </form>
        
	</div>
		
 
		<div class="ks-bom" style="text-align: center;">
			<span  style="display: inline-block;">
				<button onClick="do_reg()" class="ks-bt bt-pue mr5">确认保存</button>
				<button onclick="close1()" class="ks-bt bt-def">取消</button>
			</span>
		</div>
	

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.require(['$','backstage','nicescroll','laydate'],function(){
		loadScorllJs();
		  laydate.render({
		    elem: '#end'
		  });
	})
	
	top.dataCallBack = function(data){
		$('#ids').val(data.radioID);
		$('[name=names]').val(data.radioname);
	//	console.log(data.radioID);
	}

	function close1(){
		//parent.closePopup('all');
		top.closePopup('all');
	}
	function do_reg(){
		$('#myform').submit();	
	}
</script>
</body>
</html>

