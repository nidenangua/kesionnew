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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<style>
	.ks-table1 td{color:#888}
	.ks-table-th {padding: 10px 0;}
	.schedule-st {padding:15px 0 ;}
	.schedule-span{font-size: 30px;color:#476dbe;font-style: italic;padding-right: ;}
	.schedule-title{color: #333;font-size: 16px;}
	.inputText{font-size: 14px;border-radius: 5px;color:#333}
	.ks-table1 td{font-size: 14px;}
	.schedule-warnning{color:red;height: 20px;}
	
	/*time*/
	.select-time{ position: relative; }
    .select-time .start-time,
    .select-time .end-time{text-indent: 5px;height: 34px;line-height: 34px;border: 0px;border: 1px solid #e0e0e0;width: 150px;font-size: 14px; padding: 0px;
    background: inherit;padding: 0 10px;box-sizing: border-box;float: left;margin-top: 3px;border-radius: 5px;}
    .select-time .time-text{float:left; line-height: 40px;margin: 0 10px;}
    .select-time-box{width:150px;height:140px;top: 100px; position: absolute; background: #fff; display: none; box-shadow: 0 3px 12px rgba(0,0,0,0.1);z-index: 9;}
     .select-time-box .select-hour,
     .select-time-box .select-minute{float:left;width:50%; padding-top:20px;}
     .select-time-box .select-hour span,
     .select-time-box .select-minute span{display: block;height:64px; line-height: 64px; font-size:24px; text-align: center}
    .select-time-box .i-up,
    .select-time-box .i-down{width:30px;height:15px; cursor: pointer; display: block;margin:0 auto;text-align: center;}
    .select-time-box .i-up{transform: rotate(180deg);position: relative; }
    .select-time-box .i-down{}
    .ks-popup-title{text-align: center;border-bottom: 1px solid #ccc;color:#86A8F1}
    .form-star{top: 0;}
    .class-remind {display: block;position: absolute;}
    .myform-box {padding-left: 15px;}
</style>
</head>
<body class="ks-wrap" style="overflow: hidden;padding-top: 10px;">

<div id="ksBoxHead"></div>

<div id="ksBoxContent" >
    	<div class="schedule-title mb10" >
     	<span class="schedule-span">1.</span>选择上课时间段和上课类型
 	</div>

 		<div class="myform-box clearfix">	
 			<div class="myform-left">
		 		<div class="form-row">
					  <span class="name"><i class="form-star">*</i>上课时间段</span> 
					  <div class="select-time" id="selectTime"></div>
				</div>
			</div>
			<div class="myform-right ml40">	
			    <div class="form-row fl">
		      		<span class="name"><i class="form-star">*</i>上课类型</span>
		      		
		      		<select class="w150 inputText " id="type" onchange="typechange()">
 						<option value="2" >线上</option>
 						<option value="1"  >线下</option>
					</select>
				</div>
				
				<input type="hidden" id="type"  value="3" />
				<div class="form-row fl ml40" id="classrooms">
		      		<span class="name"><i class="form-star">*</i>选择教室</span>
		      		
		      		<select class="w150 inputText  " id="classroomid"  >
		      			<option value="">请选择</option>
 					   <?php foreach($classRoom as $k =>$v){?>
			  				<option value="<?php echo $v['id']?>"><?php echo $v['classroomname']?></option>
			  			<?php }?>
 					
					</select>	
				</div>
				<!--<div class="form-row fl ml40" id="classrooms">
					      		<span class="name"><i class="form-star">*</i>选择校区</span>
					      		
					      		<select class="w150 inputText  " id="classroomid"  >
			 					    <option value="">请选择</option>
			 						<?php foreach($values as $k =>$v){?>
						  				<option value="<?php echo $v['schoolid']?>"><?php echo $v['school']?></option>
						  			<?php }?>
			 					
		 						</select>	
				</div>-->
			
				
	 		</div>
	 	</div>
	 		
 		<div class="schedule-title mb10">
     	<span class="schedule-span">2.</span>选择老师
 	</div>
     
 		<div class="myform-box clearfix">
 			<div class="myform-left">
 		
 				<div class="form-row fl">
 					<div class="form-row">
 							<span class="name"><i class="form-star">*</i>上课教师</span>
		 					<input type="text" class="w150 inputText mr10" name="" id="" readonly value="<?php echo $teacherinfo ?>" />	
		 					<input type="hidden"  name="" id="teacherid" value="<?php echo $teacherid ?>" />	
 					</div>
 					
 				</div>
 					
 			
 				<div class="form-row  fl">
 					<div class="form-row">
 							<span class="name">学生</span>
		 					<input type="text" class="w150 inputText mr10" name="" id="" readonly value="<?php echo $setudeninfo ?>" />				 		
		 					<input type="hidden" class="w150 inputText mr10" name="userid" id="memberid" value="<?php echo $userid ?>" />				 		
 					</div>
 					
 				</div>
 					 
 					
 			
 			</div>
 		
 		</div>

 		<div class="myform-box clearfix">
 			<div class="form-row">
		 		<span class="name">主题名称</span>
		 		<input class="w300 inputText mr10" name="title" value=""/>
 			</div>
 	</div>
 
 	
 	</div>


<div class="clearfix ks-popup-footer form-footer" >
			<div class="d-inline-block mt20">
				
			
			
		
					<input type="button" class="ks-bt bt-white mr10" onclick="doAddschedule()" value="保存">
			
					<input type="button" class="ks-bt bt-white mr10" onclick="closess()" value="取消">		
			</div>
			
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/select-time.js" type="text/javascript"></script>
<script>
	
	  var type =  $('#type').val();
	  if(type == 2){
           $('#classrooms').hide();
	  }
	  
	  
	  
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
 
 

	var _range = currentTime(<?php echo $dayPm; ?>);
	var _rangeNow=  presentTime(<?php echo $dayPm; ?>)
	
	var mySelectTime = new selectTime({
        element:'#selectTime',
        time:_rangeNow,//当前时间
        range:_range 
    });
   
    

function closess(){
   	
   	 top.closePopup(window.name); 	
} 	
    
    
    
    
    
    
 //提交+保存时间   

var dates = <?php echo $dates; ?>;

$('.classroom').hide();

function typechange(){
     type =$('#type').val();//1线下2线上
    
    if(type == 1){
    	$('#classrooms').show();
    }else{
    	$('#classrooms').hide();
    }		
}



//添加
function doAddschedule(state){	
	
    var title  = $("input[name='title']").val();
    var teacherid =$('#teacherid').val();

     var memberid =$('#memberid').val();
    var type =$('#type').val();//1线下2线上
    var classroomid =$('#classroomid').val();//房间
    //获取时间段
     var time = mySelectTime.getSelectTime();
     var startTime =second(time[0]);
     var endTime =second(time[1]);
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','doAddschedule',$classid,GP('')) ?>",
        data:{teacherid:teacherid,memberid:memberid,title:title,type:type,classroomid:classroomid,startTime:startTime,endTime:endTime},
        success:function(text){
			   var dataStr = JSON.parse(text);//json转换成对象
			   var timeHtml= '';
			    
			  if(dataStr.result=='success'){
			  	
			   shortTime=time[0]+'~'+time[1];
//			  shortTime= shortTime.replace(',','-');
//			   alert(shortTime);
			   
			  $('#teacherid option').each(function(){
			  	var optionIndex = $(this).attr('value') 
			  	if(optionIndex == teacherid){
			  		var Option = $(this).text()//获取教师名称
	  			var htmlStr ='';//默认移入显示块
	 	 	   var htmlContent='';//移入详细内容 
	 	 	   htmlStr ='<div class="ks-course-list" id="i'+dataStr.id+'"><span id="q'+dataStr.id+'">'+ shortTime +'</span><span>'+Option +'</span></div>';
	 	 	   htmlContent+='<div class="ks-course-tb" style="display:none"> <div class="ks-course-ut clearfix"><div class="ks-course-uleft fl"> ';
	 	 	   htmlContent+='<p class="ks-course-time">上课时间</p><p class="ks-course-times">'+shortTime+'</p></div>';
	 	 	   htmlContent+='<div class="ks-course-uright fr"><p class="ks-course-time">授课类型</p><p class="ks-course-times">'+dataStr.type+'</p></div></div>';
	 	 	   htmlContent+= '<div class="ks-course-ut "><p class="ks-course-time">授课老师</p><p class="ks-course-times">'+Option+'</p></div>' ;
	 	 	   htmlContent+='<div class="ks-course-ut "><p class="ks-course-time">主题名称</p><p class="ks-course-times">'+title+'</p>	</div>';
	 	 	   htmlContent+='<div class="ks-course-ut "><div class="fl "><input  type="button" class="ks-bt bt-pue mr10"onclick="editSchdeule(this,'+dataStr.id+')" value="编辑">';
			   htmlContent+='<input type="button" class="ks-bt bt-pue mr10" value="删除" onclick="classDelete('+dataStr.id+')"></div></div>';			
			   htmlContent+='<div class="ks-course-ut "><input type="button" class="ks-bt bt-pue mr10 bt-pue-wp" value="增加时间段"'	;		 			htmlContent+='onclick="addClassSch(this)"></div>';		
	 	 	   htmlContent+= '</div>';
		 	 		$(parent.document).find('#main').contents().find('#'+lineHeight()).append(htmlStr)
		 	 		$(parent.document).find('#main').contents().find('#'+'i'+dataStr.id).append(htmlContent)
		 	 		
			  	}
			  
			  
			  });
         }else{
         	
      /*  alert(dataStr.msg)*/
    		 $('#type').next().remove()
        	$('#type').after('<span class="c-red class-remind" >'+dataStr.msg+'</sapn>')
        	return false;
         }
     
		if(state==1){
			 location.reload();
			
		}else{
		    	  top.closePopup(window.name); 	 			
		}         
              
     	},
     	
     });
	
	
}



function doeditschedule(scheduleid){
	    
	var title  = $("input[name='title']").val();
    var assisantid =$('#assisantid').val();
    var teacherid =$('#teacherid').val();
     var memberid =$('#memberid').val();
    var type =$('#type').val();//1线下2线上
    var classroomid =$('#classroomid').val();//房间
    //获取时间段
     var time = mySelectTime.getSelectTime();
     var startTime =second(time[0]);
     var endTime =second(time[1]);
     
     
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','doEditors',$classid,GP('')) ?>",
        data:{assisantid:assisantid,teacherid:teacherid,memberid:memberid,title:title,type:type,classroomid:classroomid,startTime:startTime,endTime:endTime,scheduleid:scheduleid},
        success:function(text){
        	
        		
			   var dataStr = JSON.parse(text);//json转换成对象
			   console.log(dataStr.result)
			   var timeHtml= '';
			  if(dataStr.result=='success'){
			  	 
				   shortTime=time[0]+'~'+time[1];
				   $(parent.document).find('#main').contents().find('#i'+dataStr.id).remove();
				  $('#teacherid option').each(function(){
				  	var optionIndex = $(this).attr('value') 
				  	if(optionIndex == teacherid){
				  		var Option = $(this).text()//获取教师名称
		  			var htmlStr ='';//默认移入显示块
		 	 	   var htmlContent='';//移入详细内容 
		 	 	   htmlStr ='<div class="ks-course-list" id="i'+dataStr.id+'"><span id="q'+dataStr.id+'">'+ shortTime +'</span><span>'+Option +'</span></div>';
		 	 	   htmlContent+='<div class="ks-course-tb" style="display:none"> <div class="ks-course-ut clearfix"><div class="ks-course-uleft fl"> ';
		 	 	   htmlContent+='<p class="ks-course-time">上课时间</p><p class="ks-course-times">'+shortTime+'</p></div>';
		 	 	   htmlContent+='<div class="ks-course-uright fr"><p class="ks-course-time">授课类型</p><p class="ks-course-times"></p></div></div>';
		 	 	   htmlContent+= '<div class="ks-course-ut "><p class="ks-course-time">授课老师</p><p class="ks-course-times">'+Option+'</p></div>' ;
		 	 	   htmlContent+='<div class="ks-course-ut "><p class="ks-course-time">课程名称</p><p class="ks-course-times">'+title+'</p>	</div>';
		 	 	   htmlContent+='<div class="ks-course-ut "><div class="fl "><input  type="button" class="ks-bt bt-pue mr10"onclick="editSchdeule(this,'+dataStr.id+')" value="编辑">';
				   htmlContent+='<input type="button" class="ks-bt bt-pue mr10" value="删除" onclick="classDelete('+dataStr.id+')"></div></div>';			
				   htmlContent+='<div class="ks-course-ut "><input type="button" class="ks-bt bt-pue mr10 bt-pue-wp" value="增加时间段"'	;		 			htmlContent+='onclick="addClassSch(this)"></div>';		
		 	 	   htmlContent+= '</div>';
			 	 		$(parent.document).find('#main').contents().find('#'+lineHeight()).append(htmlStr)
			 	 		$(parent.document).find('#main').contents().find('#'+'i'+dataStr.id).append(htmlContent)
			 	 	
				  	}
         	
         				
				  
				  
				  });
         }else{
         	
          $('#type').next().remove()
        	$('#type').after('<span class="c-red class-remind" >'+dataStr.msg+'</sapn>');
        	return false;
         }
	
		top.closePopup(window.name); 			       
              
     	},
     	
     });
	
	
}

	    









function second(times){
	var arr = times.split(':');
	$result = (parseInt(arr[0])*3600 + parseInt(arr[1])*60)+dates;
	return $result;
}    
    
    function lineHeight(){
    	
    	  line=<?php echo $line; ?>;
          heLine=<?php echo $heLine; ?>;
         
         if(heLine == 1){
         	return 'a'+line;;
         }else if(heLine==2){
         	return 'b'+line;
         }else if(heLine==3){
         	return 'c'+line;
         }
    	
    }

    
</script>
</body>
</html>
