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
<style>
	.Created-Content input[type='text'] {width: 360px;}
</style>
</head>

<body class="ks-wrap">  

<form target="hidframe"  action="<?php  echo $url ?>" method="post" id="myform" class=" bRadius10 ">
		
	<div class="ks-wbox bRadius10 ">  
		<div class="ks-head-nav">
			<!--标题-->
			<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP(''))?>">意向本</a><span> <em>/</em> 新增意向			<!--标题-->
			</span>
		</div>
		
	<div class="configTab" style="display: block;">
		<ul style="">
				
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">  
						<span>账号信息</span>
					</div>
				</div>
				
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>学生姓名:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="editusername" name="membername" value="<?php if($values){echo $values['membername'];}?>" > 
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>联系电话:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="editusername" name="mobile" value="<?php if($values){echo $values['mobile'];}?>"> 
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>学生紧急联系人:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="editusername" name="parentname" value="<?php if($values){echo $values['emergency'];}?>" > 
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>紧急联系人电话:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="editusername" name="parentmobile" value="<?php if($values){echo $values['emergencymobile'];}?>" > 
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>与学生关系:</h4>
								<div class="Created-Content">
									<div class="word-all">
										 <select class="new-form" name="relationship">
								        	<option value="1" <?php if($values){if($values['relationship']==1){echo 'selected';}}?>>本人</option>
								        	<option value="2" <?php if($values){if($values['relationship']==2){echo 'selected';}}?>>亲属</option>
								        </select>	
								        
									</div>								
								</div>
							</li>
							
							<li>
								<h4>性别:</h4>
								<div class="Created-Content">
									<div class="word-all clearfix">
									
										<label for="man"><input value="1" id='man' type="radio" name="Sex" <?php if($values){if($values['sex']==1){echo 'checked';}}?> />男</label>						
										<label for="woman"><input value="2" id='woman' type="radio" name="Sex" <?php if($values){if($values['sex']==2){echo 'checked';}}?>/>女</label>	
									</div>								
								</div>
							</li>
							
							<li>
								<h4>邮箱:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="editusername" name="email" value="<?php if($values){echo $values['email'];}?>" > 
								        
									</div>					
								</div>
							</li>
							
							<li>
								<h4>微信:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								         <input type="text" id="editusername" name="wxnumber" value="<?php if($values){echo $values['wxnumber'];}?>"> 
								        
									</div>					
								</div>
							</li>
							<li>
								<h4>所在地区:</h4>
								<div class="Created-Content">
									<div class="word-all" id="address">
										<?php echo $link->Linkage(1);?>  
<!--									
								     <select class="new-form" style="width: 200px;" name="pid">
								        	<option>请选择</option>
								    </select>	
								     <select class="new-form" style="width: 200px;" name="cid">
								        	<option>请选择</option>
								    </select>	
								    <select class="new-form" style="width: 200px;" name="cunid">
								        	<option>请选择</option>
								    </select>	   -->
									</div>					
								</div>
							</li>
							
							<li>
								<h4>渠道:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								     <select class="new-form" name="channel">
								        	<option>请选择</option>
								        	<?php foreach($channelary as $k =>$v){?>
								        		<option value="<?php echo $v['id']?>" <?php if($values){if($values['channel']==$v['id']){echo 'selected';}}?>><?php echo $v['channel']?></option>
								        		<?php }?>
								        </select>	
								        
									</div>					
								</div>
							</li>
							
							<li>
								<h4>主动联系:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								     <select class="new-form" name="isactive">
								        	<option value="1" <?php if($values){if($values['active']==1){echo 'checked';}}?>>是</option>
								        	<option value="0" <?php if($values){if($values['active']==0){echo 'checked';}}?>>否</option>
								        </select>	
								        
									</div>					
								</div>
							</li>
							
						
				<li>
				</ul>
				</div>
				</div>	
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title">  
						<span>咨询信息</span>
						
					</div>
				</div>
				
				<div class="form-box form-upload-box">
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>咨询类别:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								      <select class="new-form" name="classify">
								        	<option>请选择</option>
								        	<option value="1" <?php if($values){if($values['classify']==1){echo 'selected';}}?> >小班</option>
								        	<option value="2" <?php if($values){if($values['classify']==2){echo 'selected';}}?> >一对一</option>
								        	<option value="3" <?php if($values){if($values['classify']==3){echo 'selected';}}?> >大班</option>
								        </select>	
									</div>					
								</div>
							</li>
							<li>
								<h4>咨询校区:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								      <select class="new-form" name="schoolroomid">
								        	<option>请选择</option>
								        	<?php foreach($school as $k =>$v){?>
								        		<option value="<?php echo $v['schoolid']?>"  <?php if($values){if($values['schoolroomid']==$v['schoolid']){echo 'selected';}}?> ><?php echo $v['school']?></option>
								        		<?php }?>
								        	
								        </select>	
									</div>					
								</div>
							</li>
							<li>
								<h4>咨询课程:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								      <select class="new-form" id="selectTktype" name="type" style="margin-bottom: 15px;">
								        	<option>请选择</option>
								        	<option value="1" <?php if($values){if($values['type']==1){echo 'selected';}}?>>课程</option>
								        	<option value="2" <?php if($values){if($values['type']==2){echo 'selected';}}?>>专栏</option>
								        </select>	
								        <select class="new-form" id="coursename" name="coursename">
								        	<option>请选择</option>
								        	<?php if($str){
								        		echo $str;
								        	}?>
								        </select>
									</div>	
													
								</div>
							</li>
							<li>
								<h4>跟进状态:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								      <select class="new-form" name="status">
								        	<option value="0" <?php if($values){if($values['status']==0){echo 'selected';}}?>>未跟进</option>
								        	<option value="1" <?php if($values){if($values['status']==1){echo 'selected';}}?>>跟进中</option>
								        	<option value="2" <?php if($values){if($values['status']==2){echo 'selected';}}?>>已放弃</option>
								        	<option value="3" <?php if($values){if($values['status']==3){echo 'selected';}}?>>已成单</option>
								        	
								        </select>	
									</div>					
								</div>
							</li>
							<li>
								<h4>意向度:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								      <select class="new-form" name="intentionality">
								        	<option value="0" <?php if($values){if($values['intentionality']==0){echo 'selected';}}?>>无</option>
								        	<option value="1" <?php if($values){if($values['intentionality']==1){echo 'selected';}}?>>高</option>
								        	<option value="2" <?php if($values){if($values['intentionality']==2){echo 'selected';}}?>>中</option>
								        	<option value="3" <?php if($values){if($values['intentionality']==3){echo 'selected';}}?>>低</option>
								        	
								        </select>	
									</div>					
								</div>
							</li>
							<li>
								<h4>咨询老师:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								       <input type="text" id="editusername" name="teachername" value="<?php if($values){echo $values['teachername'];}?>" style='width: 200px;'> 	
									</div>					
								</div>
							</li>
							
							<li>
								<h4>下次回访时间:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								       <input type="text" id="start" name="nexttime" value="<?php if($values){if($values['nexttime']){echo date('Y-m-d H:i:s',$values['nexttime']);}}?>" style='width: 200px;' required readonly class="w300 laydate-icon"> 	
									</div>					
								</div>
							</li>
							
							<li>
								<h4>备注:</h4>
								<div class="Created-Content">
									<div class="word-all">
									
								      <textarea class="form-textarea" style="height: 150px;" name="mark"><?php if($values){echo $values['mark'];}?></textarea>
									</div>					
								</div>
							</li>
							
														
							
							
							
						</ul>
						
					</div>
				
				
				
				
				
				
				
			</li>
	
	

			</ul>
			
		</div>
		
		
		<div class="ks-bom form-footer clearfix">
				<span class="d-inline-block">
					<input type="button" onclick="submitform()" class="ks-bt bt-pue mr10" value="<?php echo $text ;?>" name="save">
			       	<input type="button" onclick="history.go(-1);" class="ks-bt bt-white" value="取消">
				</span>
		</div>
		
		</div>
		



</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
		module.require(['$','backstage','nicescroll','laydate'],function(){
	
		  laydate.render({
		    elem: '#start',
		    type: 'datetime'
		  });
	
			
		loadScorllJs();
		$('.ks-view-tab li').click(function(){
		var index = $(this).index();
		$(this).addClass('curr').siblings().removeClass('curr');
		
		});
		
	
		
		$('.time-click').click(function(){
			$('.ks-time').slideToggle(300)
		});
	
	
		$(".liveTab li:first").css("border-right",0);
		
		tapsAction('.TcTab','.contentBox','.TcTabBox','.courseList');/*复用选项卡*/	
		
//		starttime("#start");
		
		$('#selectTktype').change(function(){
	        $("#coursename").empty();
	      	$.ajax({
      		type:"post",
      		dataType:"json",
      		url:"<?php echo M_URL($this->AppName.'/Index','search','',GP('')) ?>",
      		async:true,
      		data:{
      			'key':$("#selectTktype").val()
      		},
	      		success:function(data){
	      			var html='';
	      			
	      			if($("#selectTktype").val()==1){
	      				$(data).each(function(index, element)
						 { 
						 html +="<option value="+data[index].courseid+" >"+data[index].title+"</option>"
						 })
						$("#coursename").append(html);
	      			}else{
	      				$(data).each(function(index, element)
						 { 
						 html +="<option value="+data[index].columnid+">"+data[index].title+"</option>"
						 })
						$("#coursename").append(html);
	      			}
	      			
	      		}
	      	});
		})	;
	
		
		})




function submitform(type){
	$('#myform').submit();
}	

</script>
</body>
</html>
