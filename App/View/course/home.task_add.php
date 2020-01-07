<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 

<title>修改会员</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">


</head>
<body class="ks-wrap">

 <form target="hidframe"  method="post" id="myform" action="<?php if(isset($task)){ echo M_URL($this->AppName.'/Index','doeditTask',$id,GP('p-'.$now_page));}else{echo M_URL($this->AppName.'/Index','doAddTask',$this->courseid,GP(''));} ?>"  >
       <div >	
		<!--新版内容-->
		<div class="myform-box clearfix"  >
			<div class="myform-left">
				  <div class="form-row">
			      		<span class="name"><i class="form-star">*</i>作业类型</span>
			      		
			      		<select class="new-form w300" id="class-type" name="taskstyle" >
			      			<option value="1"  <?php if(isset($task))if($task['taskstyle']==1)echo 'selected'; ?>>上传作业材料</option>
			      			<option value="2" <?php if(isset($task))if($task['taskstyle']==2)echo 'selected'; ?>>在线做题</option>
			      			<option value="3" <?php if(isset($task))if($task['taskstyle']==3)echo 'selected'; ?>>线下作业/其他</option>
			      		</select>		
			      		
			     </div>
			    
			    
			
			</div>
			<div class="myform-right ml40">
				  <div class="form-row">
			      		<span class="name"><i class="form-star">*</i>截止时间</span>
			      	
			      		<input id="datatime" type="text" value="<?php  echo date('Y-m-d h:s:i',$date); ?>" name="enddate" required="" readonly="" class="  new-form laydate-icon"
			      			>			
			     </div>
				
			</div>
		 	
    </div>  
	<div class="myform-box clearfix" >
			<div class="myform-left">
				  <div class="form-row">
			      		<span class="name"><i class="form-star">*</i>作业名称</span>
			      		<input type="text" name="title" class="new-form w300"  value="<?php if(isset($task)) {echo $task['title'];}else{echo $this->userinfo['name'].date('Y-m-d',time()).'布置的作业';}; ?>">	
			     </div>
			     <div class="form-row">
			      		<span class="name"><i class="form-star">*</i>批改方式</span>
			      		<select class="new-form w300" name="checkstyle">
			      			<option value="2" <?php if(isset($task))if($task['checkstyle']==2)echo 'selected'; ?>>手动批改</option>
			      			<option value="1" <?php if(isset($task))if($task['checkstyle']==1)echo 'selected'; ?>>自动批改</option>
			      		</select>
			     </div>
			    
			    
			
			</div>
			<div class="myform-right ml40">
				  <div class="form-row" id="form-class1">
			      		<span class="name"><i class="form-star">*</i>课程资料</span>
			      		
                        
                        <a href="javascript:void(0)"  onclick="addTypeChange('<?php echo M_URL('Index','coursefile','',GP('name-file2',true));?>','930px','610px',{title:'选择文件',type:'top'});"><div class="btn_addPic"><span>课程资料</span></div></a>
                        <div id="classfile">
                        <?php if(isset($files))foreach($files as $k=>$v){ ?>
                        
                        	<div id="a<?php echo $v['id']; ?>"><div class="fileImg">
                        		<img src="<?php echo $v['src']; ?>" style="height: 35px; width:50px"></div><div class="file-name">
                        			<?php echo $v['filename']; ?></div>
                        			<input type="hidden" name="coursefile[]" value="<?php echo $v['id']; ?>"><button type="button" onclick="removefile(<?php echo $v['id']; ?>);">删除</button></div>
                     
                        <?php } ?>
                           </div>
                        
			     </div>
			       <div class="form-row" id="form-class2" style="display: none;">
			      		<span class="name"><i class="form-star">*</i>试卷选择</span>
			      		<select class="new-form w300" name="paperid">
			      			<?php if(isset($paper))foreach($paper as $k=>$v){ ?>
			      			<option value="<?php echo $v['paperid'] ?>"  <?php  if(isset($task))if($task['paperid']==$v['paperid']) echo "selected";  ?>  ><?php echo $v['Title']; ?></option>
			      			<?php  } ?>
			      		</select>
                     
                        
			     </div>
				
			</div>
		 	
    </div>  	
		<div class="myform-box clearfix" >
			
			   <div class="form-row">
			      		<span class="name">作业内容</span>
			      		<textarea class="new-form" style="min-height: 120px;width: 90%;" name="content"><?php if(isset($task))echo $task['content']; ?></textarea>
			     </div>
		</div>
		
		<!--新版内容end-->
		
	  </div>	
		<input type="hidden" name="status" value="1" id="status" />

	  <div class="clearfix ks-popup-footer" >
			<div class="form-footer clearfix">
				<span class="d-inline-block">
						<input type="button" onclick="do_reg(1)" class="ks-bt bt-pue mr10" value="保存并发布" name="confirm">
					   <input type="button" onclick="do_reg(2)" class="ks-bt bt-white mr10" value="保存" name="confirm">
				       <input type="button" onclick="do_reg(3)" class="ks-bt bt-white mr10" value="取消" name="confirm">
			 	</span>
			</div>
		</div>
	 </div>
</form>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
module.config.paths['uploader'] = '<?php echo UOOT;?>Public/common/js/webuploader.js';
		module.require(['$','backstage','nicescroll','uploader','laydate'],function(){
			loadScorllJs();
			
		  
	  		onchange();
	  		$('#class-type').change(function(){
				 onchange()
			});

	  		$('#datatime').click(function(){
	  			datatime('#datatime')	
	  		});
	  		
	  		
	  		uploaderTwo('<?php echo M_URL($this->AppName.'/Index','','',GP(''));?>');
	  		$('#classfile').each(function(){
	  			console.log($(this).find('button'))
	  			$(this).find('button').html('<i class="icon-close iconfont"></i>')
	  		})
	
	});
	
	
	
function onchange(){
	var classVal = $('#class-type option:selected').val();
	console.log(classVal)
	if(classVal ==1){
		$('#form-class1').show();
		$('#form-class2').hide();
	}else if(classVal ==2){
		$('#form-class2').show();
		$('#form-class1').hide();
	}else if(classVal ==3){
		$('#form-class2').hide();
		$('#form-class1').hide();
	}

}	
 





top.DataCallBack = function(data){

			$('#classfile').append(data);
		}

function do_reg(type){
	
	if(type == 3){
		top.closePopup(window.name);
		return false;	
	}else if(type == 1){
		$('#status').val(1);
	}else if(type == 2){
		$('#status').val(0);
	}
	var title = $("input[name='title']").val();
		if(title==''){
			Alert('作业题目不能为空');
			return false;	
		}	
		$("#myform").submit();
}

function removefile(id){
	$("#a"+id).remove();
}
</script>
</body>
</html>
