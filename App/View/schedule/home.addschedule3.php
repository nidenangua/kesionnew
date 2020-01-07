<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>添加排课</title>

<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />

<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap" style="overflow: hidden;padding-top: 10px;">

<div id="ksBoxHead"></div>

<div >
<form  action=" <?php echo M_URL($this->AppName.'/Index','doaddschedule','',GP('chargettype-'.$chargetype.',weektype-'.$weektype.',time-'.$time)); ?>" method="post" id="myform">
    <?php   if($chargetype == 1){  ?>
 		<div class="myform-box clearfix">	
 			<div class="myform-left">
		 		<div class="form-row clearfix">
	              		<span class="name name-nowrap"><i class="form-star">*</i>班级课程分类</span>
	              		<select class="w150 inputText mr10" name="classlevel" id="classlevel" onchange="selectClassType()">
		 						<option value="2">一对一</option>
		 						<option value="1">小班</option>
		 						<option value="0">大班</option>
		 					</select>	
	              	</div>
			</div>
			<div class="myform-right">
		 		<div class="form-row clearfix">
	              		<span class="name name-nowrap"><i class="form-star">*</i>选择班级</span>
	              		<select class="w150 inputText mr10" id="classid" onchange="getStudentId()">
		 						<?php foreach($class as $k=>$v){ ?>
									<option value="<?php echo $v['classid']; ?>" class="<?php echo 'classlevel'.$v['classlevel']; ?>"><?php  echo $v['title']; ?></option>
								<?php } ?>
		 					</select>	
	              	</div>
			</div>
	 	</div>
	 		
 	
     
 		<div class="myform-box clearfix">
 			<div class="myform-left">
 				<div class="form-row fl"  id="student">
 					<div class="form-row">
 							<span class="name"><i class="form-star">*</i>选择学生</span>
		 					<select class="w150 inputText mr10" id="textstudent">
		 					
		 					</select>	
 							<!--<div class="schedule-warnning mt10">老师冲突</div>-->
 					</div>
 					
 				</div>
		
 			</div>
 		<div class="myform-right">	
 			<div class="form-row  fl class" id="zhujiao">
 					<div class="form-row  " > 
 							<span class="name"><i class="form-star">*</i>助教</span>
		 					<select class="w150 inputText mr10"  id="assistant1">
		 						<?php foreach($teacher as $k=>$v){ ?>	
								<option value="<?php echo $v['userid']; ?>"><?php echo !empty($v['name']) ? $v['name'] : $v['username'] ; ?></option>
								<?php } ?>	
 							</select>					 		
 					</div>
 					
 				</div>
 				
 		</div>
 		<?php  }else{ ?>
 		
               <?php if($classlevel == 2){ ?>
               	 
                 <div class="myform-box clearfix">	
		 			<div class="myform-left">
 				<div class="form-row fl"  id="student">
 					<div class="form-row">
 							<span class="name"><i class="form-star">*</i>选择学生</span>
		 					<select class="w150 inputText mr10" id="textstudent">
		 					     
		 					     <?php foreach($member as $k=>$v){ ?>	
								<option value="<?php echo $v['userid']; ?>"><?php echo $v['name']; ?></option>
								<?php } ?>
		 					     
		 					     
		 					     
		 					</select>	
 							
 					</div>
 					
 				</div>
		
 			</div>
		 		         	 
               	 
               	 
               	
               	
               	
               	
               	<?php }else{ ?> 		
		 		<div class="myform-box clearfix">	
		 			<div class="myform-left">
		 				<div class="form-row fl">
		 					<div class="form-row">
		 							<span class="name"><i class="form-star">*</i>选择老师</span>
				 					<select class="w150 inputText mr10" id="teacherid" >
				 					<?php foreach($teachers as $k=>$v){ ?>	
				 						<option value="<?php echo $v['userid']; ?>"><?php echo !empty($v['name']) ? $v['name'] : $v['username'] ; ?></option>
				 					<?php } ?>	
				 					</select>	
		 							<!--<div class="schedule-warnning mt10">老师冲突</div>-->
		 					</div>
		 					
		 				</div>
				
		 			</div>
		 		<div class="myform-right">	
		 			<div class="form-row ml40 fl">
		 					<div class="form-row">
		 							<span class="name"><i class="form-star">*</i>助教</span>
				 					<select class="w150 inputText mr10" id="assistant11">
									  <?php foreach($teachers as $k=>$v){ ?>	
				 						<option value="<?php echo $v['userid']; ?>"><?php echo !empty($v['name']) ? $v['name'] : $v['username'] ; ?></option>
				 					<?php } ?>	
		 							</select>					 		
		 					</div>
		 					
		 				</div>
		 		</div>
 		<?php }} ?>
 		</div>

 		<div class="myform-box clearfix">
 			
		 	
		 		<div class="form-row clearfix">
	              	<span class="name"><i class="form-star">*</i>上课时间段</span>
	              		
	              		 <div class="select-time" id="selectTime"></div>
	              		<input type="hidden" name="starttime" value=""/>
	              		<input type="hidden" name="endtime" value=""/>
	              	</div>
 			
 		</div>
 		<div class="myform-box clearfix">
 			
		 	
		 		<div class="form-row clearfix">
		 			<div class="fl">
		              	<span class="name"><i class="form-star">*</i>上课类型</span>
		              	<select class="w150 inputText mr10" name="type" id="classtype1"  onchange="onlineType1()" >
			 						<option value="2">线上</option>
			 						<option value="1">线下</option>
			 			</select>
		 			</div>
		 			<div class="online-up fl ml40"  >
			 			<span class="name"><i class="form-star">*</i>选择校区</span>
		              	<select class="w150 inputText mr10" id="classtype"   onchange="onlineType()">
		              		<?php foreach($school as $k=>$v){ ?>
			 						<option value="<?php echo $v['schoolid']; ?>"><?php echo $v['school']; ?></option>
			 				<?php  } ?>		
			 			</select>
		 			</div>
		 			<div class="online-down fl ml40">
			 			<span class="name"><i class="form-star">*</i>选择教室</span>
		              	<select class="w150 inputText mr10" name="classroomid" id="classroom">
		              		<option value="0" class="optionblock" style="display: block;!important" >请选择</option>
		              		<?php foreach($classroom as $k=>$v){ ?>
		              			
			 						<option value="<?php echo $v['id']; ?>"  class='abc<?php echo $v['schoolname']; ?>'; ><?php echo $v['classroomname']; ?></option>
			 				<?php } ?>		
			 			</select>
		 			</div>
	            </div>
 			
 		</div>
		 		<div class="myform-box clearfix">
		 			<div class="form-row">
			 			<span class="name">主题名称</span>
			 			<input type="text" class="form-textbox"  name="title" value="" />
		 			</div>
		 		</div>
 			
 	
 	</div>

</form>
<div class="clearfix ks-popup-footer form-footer mt10" >
			<div class="d-inline-block">
			
				<input type="button" class="ks-bt bt-pue mr10" onclick="doAddschedule(1)" value="确定">
				<input type="button" class="ks-bt bt-white mr10" onclick="closeAddschedule()" value="取消">
				
						
			</div>
			
</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	
	module.config.paths['selectTime'] = '<?php echo UOOT;?>Public/common/js/select-time.js';

	module.require(['$','backstage','nicescroll','cookie','selectTime'],function(){
		
		loadScorllJs();
		selectClassType(); //选择班级类型		
		onlineType1();//选择线上线下
		onlineType();
		getStudentId();//获取学员id
		var _range = currentTime(<?php echo $dayPm; ?>);
		var _rangeNow=  presentTime(<?php echo $dayPm; ?>)
			
	
	
		mySelectTime = new selectTime({
	        element:'#selectTime',
	        time:_rangeNow,//当前时间
	        range:_range 
	    });
	    
	    var timeval =  mySelectTime.getSelectTime();	
		var  starttimeArr= timeval[0].split(':');
		var  endtimeArr = timeval[1].split(':');
	 	var stimesecond = (parseInt(starttimeArr[0])*60 +parseInt(starttimeArr[1]))*60;
	 	var etimesecond = (parseInt(endtimeArr[0])*60 +parseInt(endtimeArr[1]))*60;
		$('input[name="starttime"]').val(stimesecond);
		$('input[name="endtime"]').val(etimesecond);
	
    
		
		})	
	
	
	function do_reg(){
		top.closePopup('all')
		top.main.location = '<?php echo M_URL($this->AppName.'/Index','addschedule2','',GP('')) ?>'
		
	}
	
	function selectClassType(){
	  var target =$('#classlevel').find('option:selected').val()
	switch (target){
		case "0":
			setClassOptionShow('classlevel'+0,'#classid');
			$('#zhujiao').show();
			$('#student').hide();
			getStudentId();
			break;
		case "1":
			$('#zhujiao').show();
			$('#student').hide();
			getStudentId()
			setClassOptionShow('classlevel'+1,'#classid');
			break;
		case "2":
			$('#zhujiao').hide();
			$('#student').show();
		
			setClassOptionShow('classlevel'+2,'#classid');
			getStudentId()
			break;
	}
	
	//target.value
	
}


function onlineType1(){
	 var target =$('#classtype1').find('option:selected').val()
		switch (target){
		
		case "1":
			$('.online-up').show();
			$('.online-down').show();
			break;
		case "2":
			$('.online-up').hide();
			$('.online-down').hide();
			break;
	}
}

 
function onlineType(){
	 
	var target =$('#classtype').find('option:selected').val()
	setClassOptionShow('abc'+target,'#classroom'); 
	
}

function setClassOptionShow(name,id){
	var _option = $(id).find('option');
	var firstIndex = 0;
	for(var i=0;i<_option.length;i++){
		if(_option[i].className === name){
			firstIndex++;
			_option[i].style.display = 'block';
			
			
			if(firstIndex === 1){
				_option[i].selected = true
			}
			
		}else {
			_option[i].style.display = 'none'
			
		}
	};
	
	if(firstIndex === 0){
		_option[0].selected = true
	}
		
}


   function getStudentId(){
   		var  classlevel = $('#classlevel').find('option:selected').val();
   		var tarval = $('#classid').find('option:selected').val()//选择班级
		var selectcontent="";
		
		if(classlevel == 2){//一对一获取学员
			
				$.ajax({
	   			 type: "POST",
		        url:"<?php echo M_URL($this->AppName.'/Ajax','getstudent','',GP('')) ?>",
		        data:{classid:tarval},
		        
		        success:function(text){
		        	
		        	 var dataText = JSON.parse(text);
		        	 var datacontent='';
		        	for(var i=0 ;i<=dataText.length-1;i++){
		        		datacontent+='<option value="'+dataText[i].userid+'">'+dataText[i].name+'</option>'
		        	
		        	}
		        		$('#textstudent').html(datacontent)
		        	
		        }
	
	   			
	   		})
			
			
			//获取助教
		}else{
			
				$.ajax({
	   			 type: "POST",
		        url:"<?php echo M_URL($this->AppName.'/Ajax','getAssistant','',GP('')) ?>",
		        data:{classid:tarval},
		        
		        success:function(text){
		        	
		        	 var dataText = JSON.parse(text);
		        	 var datacontent='';
		        	for(var i=0 ;i<=dataText.length-1;i++){
		        		datacontent+='<option value="'+dataText[i].userid+'">'+dataText[i].name+'</option>'
		        	
		        	}
		        		$('#assistant1').html(datacontent)
		        	
		        }
	
	   			
	   		})
			
			
		}
   	

   }
   
   //时间选择
	
	 function currentTime(currentTime){
	 	
	 	 if(currentTime == 1){
	          return [0,12]; //时间范围商 上午0-12	
	        }else if(currentTime==2){
	        return [12,18]; //时间范围商 中午	
	        }
	        else if(currentTime==3){
             return [18,24]; //时间范围商 晚上
	        }

 	}//时间范围
 
 	 function  presentTime(presentTime){
 	 	   
	 	
	        <?php if(isset($value)){ ?>
	           return ['<?php echo $times[0] ?>','<?php echo $times[1] ?>'];
	        <?php  }else{ ?>
	        	    if(presentTime == 1){
	                  return ['6:30','6:35']; //时间范围商 上午0-12	
			        }else if(presentTime==2){
			          return ['12:00','12:05']; //时间范围商 中午	
			        } else if(presentTime==3){
			         return ['18:00','23:59']; //时间范围商 中午	
			        }
	        <?php } ?>		

 	}//当前时间
 
 


	
	
	
//添加
function doAddschedule(state){	
	
    var title  = $("input[name='title']").val();
    var assisantid =$('#assistant1').val();
    var teacherid =$('#teacherid').val();
	var teachername =$('#teacherid').find('option:selected').text();
    var classid =$('#classid').val();
    var classlevel =$('#classlevel').val();
    var memberid =$('#textstudent').val();
    var type =$('#classtype1').val();//1线下2线上
    var classroomid =$('#classroom').val();//房间
    //获取时间段
    var timeval =  mySelectTime.getSelectTime();
	 var  starttimeArr= timeval[0].split(':')
	 var  endtimeArr = timeval[1].split(':')
 	var startTime = (parseInt(starttimeArr[0])*60 +parseInt(starttimeArr[1]))*60;
 
 	var endTime = (parseInt(endtimeArr[0])*60 +parseInt(endtimeArr[1]))*60;
  
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','doAddschedule','',GP('')) ?>",
        data:{assisantid:assisantid,teacherid:teacherid,classid:classid,title:title,type:type,classroomid:classroomid,startTime:startTime,endTime:endTime,memberid:memberid,classlevel:classlevel},
        success:function(text){
			   var dataStr = JSON.parse(text);//json转换成对象
			     
			   //console.log(dataStr)
			   var timeHtml= '';
			   var htmlContent='';//移入详细内容 
			  if(dataStr.result=='success'){
			htmlStr ='<div class="ks-course-list" id="i'+dataStr.id+'"><span id="q'+dataStr.id+'">'+ timeval[0] +'-'+timeval[1]+ '</span><span>'+dataStr.name +'</span></div>';
	 	 	   htmlContent+='<div class="ks-course-tb" style="display:none"> <div class="ks-course-ut clearfix"><div class="ks-course-uleft fl"> ';
	 	 	   htmlContent+='<p class="ks-course-time">上课时间</p><p class="ks-course-times">'+ timeval[0] +'-'+timeval[1]+ '</p></div>';
	 	 	   htmlContent+='<div class="ks-course-uright fr"><p class="ks-course-time">授课类型</p><p class="ks-course-times"></p></div></div>';
	 	 	   
	 	 	   htmlContent+= '<div class="ks-course-ut "><p class="ks-course-time">授课老师</p><p class="ks-course-times">'+teachername+'</p></div>' ;
	 	 	   
	 	 	   htmlContent+='<div class="ks-course-ut "><p class="ks-course-time">课程名称</p><p class="ks-course-times">'+title+'</p>	</div>';
	 	 	   htmlContent+='<div class="ks-course-ut "><div class="fl "><input  type="button" class="ks-bt bt-pue mr10"onclick="editSchdeule(this,'+dataStr.id+')" value="编辑" style="display:none">';
			   htmlContent+='<input type="button" class="ks-bt bt-pue mr10" value="删除" onclick="classDelete('+dataStr.id+')"></div></div>';			
			   htmlContent+='<div class="ks-course-ut "><input type="button" class="ks-bt bt-pue mr10 bt-pue-wp" value="增加时间段"'	;		 						  						 			   htmlContent+='onclick="addClassSch(this)"></div>';		
 	           htmlContent+= '</div>';
				$(parent.document).find('#main').contents().find('#'+dataStr.zone).append(htmlStr);
	 	 		$(parent.document).find('#main').contents().find('#'+'i'+dataStr.id).append(htmlContent)
			  top.closePopup(window.name); 	

         }else{
     		Alert(dataStr.msg);
     		return false
     	}
 		 	
  	          
     	}
     	
     });
	
	
}	
	
function closeAddschedule(){
	 top.closePopup(window.name); 	
}	
	

	
</script>

</body>
</html>
