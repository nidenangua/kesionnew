<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

<style>
.ks-table th, .ks-table td{padding: 25px 10px!important;}
.ks-table{border:0;margin-top: 10px;}
.ks-table th, .ks-table td{border:0;border-bottom: 1px solid #eee;position: relative;width: 12.5%;min-width: 12.5%;}
.ks-table td{height: 100px;}
.ks-table th{border-top:1px solid #eee}
.ks-table th{width: 12.5%;}
.ks-alert {padding:20px;text-align: center;}
.ks-alert button{float: none;}
.class_left{right: 100%!important;}
.class_top{top: -170px!important;} 
.class-active{color:#86A8F1!important}
.ks-course-content ul{padding-left: 135px;}
.ks-course-content li:first-child{border-left: 1px solid #eee;}
.ks-table th{min-width:auto ;}

</style>
<body>
<div class="ks-course-teacher">
			<ul class="clearfix">
				<!--<li class="curr"><a>刘娜老师</a></li>
				<li><a>张峰老师</a></li>
				<li><a>刘丹老师</a></li>
				<li><a>徐俊老师</a></li>-->
				<?php  foreach($teachers as $k=>$v){ ?>
					<li onclick="classDetail(<?php echo $v['userid']?>)"><a><?php echo  $v['name']; ?></a>
				<?php } ?>	

			</ul>
		</div>	
<div class="ks-course-data">
			<div class="ks-course-prev" onclick="prev()"><i class="iconfont icon-jiantou-copy1"></i></div>
			<div class="ks-course-next" onclick="next()"><i class="iconfont icon-jiantou-copy2"></i></div>
			<div class="ks-course-content">
				<ul class="clearfix">
					
				</ul>
			</div>
		</div>
<table width="100%" border="1" cellpadding="2" cellspacing="2" class="ks-table"> 
		   <thead>
		   	<tr class="weekday"> 
		   		<th style="width:10% ;">时间</th>
		   		<th style="width:10% ;" class="weekactive" data-day="1">星期一</th>
		   		<th style="width:10% ;" class="weekactive" data-day="2">星期二</th>
		   		<th style="width:10% ;" class="weekactive" data-day="3">星期三</th>
		   		<th style="width:10% ;" class="weekactive" data-day="4">星期四</th>
		   		<th style="width:10% ;" class="weekactive" data-day="5">星期五</th>
		   		<th style="width:10% ;"class="weekactive " data-day="6">星期六</th>
		   		<th style="width:10% ;" class="weekactive " data-day="7">星期日</th>
		   	</tr>
		   	
		   </thead>
		  <tbody>
		  	<tr class="weektime">
		  		<td data-time="1">上午</td>
		  		<td  class="weekactive" data-day="1" id="a1">		
		  		</td>
		  		<td  class="weekactive" data-day="2" id="a2"></td>
		  		<td  class="weekactive" data-day="3" id="a3"></td>
		  		<td  class="weekactive" data-day="4" id="a4"></td>
		  		<td  class="weekactive" data-day="5" id="a5"></td>
		  		<td  class="weekactive" data-day="6" id="a6"></td>
		  		<td  class="weekactive" data-day="7" id="a7"></td>
		  	</tr>
		  	<tr class="weektime">
		  		<td data-time="2">下午</td>
		  		<td  class="weekactive" data-day="1" id="b1"></td>
		  		<td  class="weekactive" data-day="2" id="b2"></td>
		  		<td  class="weekactive" data-day="3" id="b3"></td>
		  		<td  class="weekactive" data-day="4" id="b4">
		  			<!--<div class="ks-course-list" id="i555">
		  				<span id="q555">06:30~06:35</span>
		  				<span>ksadmin</span>
		  				
						  <div class="ks-course-tb" style="display:none"> 
						   <div class="ks-course-ut clearfix">
						    <div class="ks-course-uleft fl"> 
						     <p class="ks-course-time">上课时间</p>
						     <p class="ks-course-times">06:30~06:35</p>
						    </div>
						    <div class="ks-course-uright fr">
						     <p class="ks-course-time">授课类型</p>
						     <p class="ks-course-times">线上 体验教室</p>
						    </div>
						   </div>
						   <div class="ks-course-ut ">
						    <p class="ks-course-time">授课老师</p>
						    <p class="ks-course-times">ksadmin</p>
						   </div>
						   <div class="ks-course-ut ">
						    <p class="ks-course-time">课程名称</p>
						    <p class="ks-course-times"></p> 
						   </div>
						   <div class="ks-course-ut ">
						    <div class="fl ">
						     <input type="button" class="ks-bt bt-pue mr10"  value="编辑" />
						     <input type="button" class="ks-bt bt-pue mr10" value="删除" />
						    </div>
						   </div>
						   <div class="ks-course-ut ">
						    <input type="button" class="ks-bt bt-pue mr10 bt-pue-wp" value="增加时间段"  />
						   </div>
						  </div>
		  			</div>	-->
		  			
		  		</td>
		  		<td  class="weekactive" data-day="5" id="b5"></td>
		  		<td  class="weekactive" data-day="6" id="b6"></td>
		  		<td  class="weekactive" data-day="7" id="b7"></td>
		  			
		  		</td>
		  	</tr>
		  	<tr class="weektime">
		  		<td data-time="3">晚上</td>
		  		<td  class="weekactive" data-day="1" id="c1"></td>
		  		<td  class="weekactive" data-day="2" id="c2"></td>
		  		<td  class="weekactive" data-day="3" id="c3"></td>
		  		<td  class="weekactive" data-day="4" id="c4"></td>
		  		<td  class="weekactive" data-day="5" id="c5"></td>
		  		<td  class="weekactive" data-day="6" id="c6"></td>
		  		<td  class="weekactive" data-day="7" id="c7"></td>
		  	</tr>		  
		  </tbody>
		  
		  
		  <script>
		  	
		  	//插入日期 选项卡；
		  	var dayArray=new Array()
			 classid='<?php echo $classid; ?>';//
			 year = '<?php echo $year ?>';//当前年
			 week =	'<?php echo $week ?>';//当前周
			function timeLoad(){
				dayArray.length = 0;  
				$.ajax({
			        type: "POST",
			        url:"<?php echo M_URL('Interaction','getDate'); ?>",
			        data:{year:year,week:week},
			        success:function(text){
			         var dataTime = JSON.parse(text);//json转换成对象
			      	 var dataLi ='';
			      	 
			         for(var i=0;i<=dataTime.length-1;i++){        
			         
			    		var dataContent = dataTime[i].time;//当前时间
			    		var dataStatus =dataTime[i].status;//当前选中 状态
			    	
			   		
			  			
			  			  dayArray.push(dataContent);
			  			  if(dataStatus==1){
			  			  		var parentTdIndex = i;
			  			  			console.log(parentTdIndex)
			
			  			  		 dataLi +='<li  class="ks-course-li class-active">'+dataContent+'</li>'
			          			 $('.ks-course-content ul').html(dataLi);
			          			 $('.weekactive').eq(parentTdIndex).addClass('class-active')
			          			 
			          			
			          			 
			  			  }else{
			  			  	 dataLi +='<li  class="ks-course-li ">'+dataContent+'</li>'
			          			 $('.ks-course-content ul').html(dataLi);
			          			
			  			  }
					
					     }
					    
					 	},
					 	
					  });
    
	
					}
timeLoad();
					
 function prev(){
    		clearClasss()//换周课程信息
    	 	$('.ks-course-li').remove();
    	 	
	      	week =parseInt(week)-1;
	      classDetail();
	      	timeLoad();//插入日期
	      
    }
    
    $('.ks-course-li').remove();
     function next(){
    		clearClasss()//换周课程信息
	      	 week =parseInt(week)+1;
	       classDetail();
	      	timeLoad();//插入日期
	      	
    }
    function clearClasss(){
	$('.weekactive').find('.ks-course-list').remove()
}
	

function classDetail(teacherid=0){
	 	
	 	$.ajax({
	 		type:"POST",
	 		url:"<?php echo M_URL('Interaction','getschedule',$classid); ?>",
	 		data:{year:year,week:week,classid:classid,teacherid:teacherid},
	 		success:function(text){
	 		 clearClasss()
	 	     
	 	 	var dataClass = JSON.parse(text);//json转换成对象
	 	 	/*  console.log(dataClass) */
	 	     for(var i=0;i< dataClass.length;i++){
	 	 	   var classPosition= dataClass[i].element;
	 	 	   var className= dataClass[i].name;//教师名称
	 	 	   var classTime =dataClass[i].time;//课程时间
	 		   var classId =classid;//班级id	
	 	 	   var classNumber=dataClass[i].type;//授课类型 
	 	 	   var classTitle =dataClass[i].title;//课程名称
	 	 	   var objClass =$('#'+classPosition);
	 	 /*	   console.log(objClass)*/
	 	 	   var htmlStr ='';//默认移入显示块
	 	 	   var htmlContent='';//移入详细内容 
	 	 	   htmlStr ='<div class="ks-course-list" id="i'+dataClass[i].id+'"><span id="q'+dataClass[i].id+'">'+ classTime +'</span><span>'+className +'</span></div>';
	 	 	   htmlContent+='<div class="ks-course-tb" style="display:none"> <div class="ks-course-ut clearfix"><div class="ks-course-uleft fl"> ';
	 	 	   htmlContent+='<p class="ks-course-time">上课时间</p><p class="ks-course-times">'+classTime+'</p></div>';
	 	 	   htmlContent+='<div class="ks-course-uright fr"><p class="ks-course-time">授课类型</p><p class="ks-course-times">'+classNumber+'</p></div></div>';
	 	 	   htmlContent+= '<div class="ks-course-ut "><p class="ks-course-time">授课老师</p><p class="ks-course-times">'+className+'</p></div>' ;
	 	 	   htmlContent+='<div class="ks-course-ut "><p class="ks-course-time">课程名称</p><p class="ks-course-times">'+classTitle+'</p>	</div>';
	 	 	   htmlContent+='<div class="ks-course-ut "><div class="fl "><input  type="button" class="ks-bt bt-pue mr10"onclick="editSchdeule(this,'+dataClass[i].id+')" value="编辑" style="display:none">';
			   htmlContent+='<input type="button" class="ks-bt bt-pue mr10" value="删除" onclick="classDelete('+dataClass[i].id+')" style="display:none"></div></div>';			
			   htmlContent+='<div class="ks-course-ut "><input type="button" class="ks-bt bt-pue mr10 bt-pue-wp" value="增加时间段" onclick="addClassSch(this)" style="display:none"></div>';		
	 	 	   htmlContent+= '</div>';
	 	 	   $('#'+classPosition).append(htmlStr);
	 	 	   $('#i'+dataClass[i].id).append(htmlContent); 
	 	 		
	 		}
	 		}
	 	})
	 	
	
	 }
	 
	classDetail()//课程内容数据填充	
	//是否删除课表
	function classDelete(id){
		var contentValue ='' ,
		e = window.event || event;
		contentValue ='<div class="clearfix ks-alert" >'+
						'<button  class="ks-bt bt-pue mr10" onclick="confirmDelete('+id+')"> 确定</button>'+
		 				'<button  class="ks-bt bt-pue mr10" onclick="closePopupBox()"> 取消</button></div>' 
	
		 			popup.box({
					title:'是否删除',
					width:300,
				    content:contentValue,
				    event:e
		});
	
	}
	
	//当宽度超出屏幕一半课表信息 向左边
	$('.weekactive').hover(function(){
	var weekNumber =$(this).attr('data-day');	
	var weekSubNumebr =$(this).siblings().attr('data-time');	
			
				if(weekNumber>=5){
				
					$(this).find('.ks-course-tb').addClass('class_left').siblings().removeClass('class_left');
				}
				 if(weekSubNumebr==3){
						$(this).find('.ks-course-tb').addClass('class_top').siblings().removeClass('class_top');
				}
	
})

			 
		  </script>
</body>
</html>