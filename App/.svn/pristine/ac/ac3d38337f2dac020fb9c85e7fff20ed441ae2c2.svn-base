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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">  
	
	<div id="ksBoxHead" ></div>
	
	  
	
	    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','addreturnred',$id,GP('p-'.$now_page)) ?>" method="post" id="myform" class=" bRadius10 ">
		<div >
			<!--筛选-->
	 
	<div class="bg-white bRadius10 mt20">  
	<div class="configTab" style="display: block;">
		<ul style="">
				
			<li>
				
				
				<div class="form-box " style="padding: 0;padding-bottom: 20px;">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>学生:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="editusername" name="membername" value="<?php echo $res?>" readonly style='width: 200px;'> 
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>回访日期:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="start" name="lasttime" value="" style='width: 200px;'> 
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>回访结果:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <select class="new-form" name="restult" style='width: 200px;'>
								        	<option>请选择</option>
								        	<option value="0"  >考虑中</option>
								        	<option value="3"  >想试听</option>
								        	
								        	<option value="2" >无意向</option>
								        	<option value="5" >已听课</option>
								        	<option value="1" >已成单</option> 
								        	<option value="4" >已加入学员档案</option>
								        	<option value="7" >未听课</option>
								        	
								        </select>
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>下次回访时间:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="end" name="nexttime" value="" style='width: 200px;'> 
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>备注:</h4>
								<div class="Created-Content">
									<div class="word-all">
										<textarea class="form-textarea" name="mark"></textarea>	
								        
									</div>								
								</div>
							</li>
							
							
				</ul>
				</div>
				</div>	

				
			</li>
	
	

			</ul>
			
		</div>
		
		
			
		</div>
	</form>
</div>

<div class="clearfix ks-popup-footer form-footer">
	<span class="d-inline-block mt20">
			<input type="button" onclick="do_reg()" class="ks-bt bt-pue mr10" value="确认保存" name="save">
	       	<input type="button" onclick="close1()" class="ks-bt bt-white" value="取消">
		</span>
</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll','laydate'],function(){
		loadScorllJs();
		  laydate.render({
		    elem: '#start'
		  });
		  
		  laydate.render({
		    elem: '#end'
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
