<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />


</head>
<body class="ks-wrap" >



<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','arrangedata',$listenid,GP('p-'.$now_page.'type-'.$type)) ?>" method="post" id="myform" class=" bRadius10 ">
    	
 		<div class="myform-box clearfix">	
 			<div class="myform-left">
			</div>
			<div class="myform-right ">	
			   
				
				<input type="hidden" id="type"  value="3" />
				<div class="form-row fl mr40" id="classrooms">
		      		<span class="name"><i class="form-star">*</i>选择教室</span>
		      		
		      		<select class="w150 inputText  "  name="classroomid"  >
		      			<option value="">请选择</option>
 					   <?php foreach($roomAry as $k =>$v){?>
			  				<option value="<?php echo $v['id']?>" <?php if($oldinfo){if($oldinfo['classroomid']==$v['id']){echo 'selected';}}?>><?php echo $v['classroomname']?></option>
			  			<?php }?>
 					
					</select>	
				</div>
				<div class="form-row fl " id="classrooms">
		      		<span class="name"><i class="form-star">*</i>选择时间</span>
		      		
		      		<input type="text" name="listentime" class="inputText w150" id="start" value="<?php if($oldinfo){echo date('Y-m-d H:i:s',$oldinfo['listentime']);}?>" />	
				</div>
			
				
	 		</div>
	 	</div>
	 		
 		
 		<div class="myform-box clearfix" style="min-height: 150px;">
 			<div class="myform-left">
 		
 				<div class="form-row fl">
 					<div class="form-row">
 							<span class="name"><i class="form-star">*</i>上课教师</span>
		 					<select class="w150 inputText  " name="teacherid"  >
				      			<option value="">请选择</option>
		 					   <?php foreach($teacher as $k =>$v){?>
					  				<option value="<?php echo $v['teacherid']?>" <?php if($oldinfo){if($oldinfo['teacherid']==$v['teacherid']){echo 'selected';}}?>><?php echo $v['name']?></option>
					  			<?php }?>
		 					
							</select>		
 					</div>
 					
 				</div>
 			
 			</div>
 		
 		</div>
 </form>	
 	</div>


<div class="clearfix ks-popup-footer form-footer" >
			<div class="d-inline-block mt20">
				
			
			
		
					<input type="button" class="ks-bt bt-pue mr10" onclick="do_reg()" value="保存">
			
					<input type="button" class="ks-bt bt-white mr10" onclick="close1()" value="取消">		
			</div>
			
</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script >
	module.require(['$','backstage','nicescroll','cookie','laydate'],function(){
		loadScorllJs();
		 laydate.render({
		    elem: '#start'
		  });
		  
	})

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
