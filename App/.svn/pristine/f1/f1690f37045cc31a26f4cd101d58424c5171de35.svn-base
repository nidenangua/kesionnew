<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>排课管理</title>

<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.ks-table th, .ks-table td{padding: 10px 5px!important;}
.ks-table{border:0;margin-top: 10px;}
.ks-table th, .ks-table td{border:0;border-bottom: 1px solid #eee;position: relative;width: 12.5%;min-width: 12.5%;vertical-align: top;}
.ks-table td{height: 100px;}
.ks-table th{border-top:1px solid #eee}
.ks-table th{width: 12.5%;}
.ks-alert {padding:20px;text-align: center;}
.ks-alert button{float: none;}
.ks-course-list > span {width: auto;width: 120px;margin-bottom: 0;color: #333;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
.ks-course-list {padding: 15px 10px 15px 0;margin-bottom: 10px;}
.class_left{right: 100%!important;}
.class_top{top: -170px!important;}
.class-active{color:#476dbe!important}
.ks-course-content ul{padding-left: 135px;}
.ks-course-content li:first-child{border-left: 1px solid #eee;}
.ks-table th{min-width:auto ;}
.ks-course-cg {height: 40px;line-height: 40px;}
.ks-course-cg .ks-cg-span {float: left;margin-right: 60px;}
.ks-course-cg span {font-size: 14px;color: #ababab;}
.ks-course-cg li {float: left;margin-right: 20px;position: relative;padding-left: 30px;}
.ks-course-cg li .ks-course-c1 {width: 20px;height: 20px;position: absolute;left: 0;top: 10px;}
.ks-course-co2 {background: #d5e9f5;}
.ks-course-co1 {background: #f6d6d6;}
.ks-course-co0 {background: #f5f5d5;}
.ks-course-co4 {background: #d6f6d8;}
.H5-gameListScreen {height: 55px;}
</style>
</head>
<body class="ks-wrap">
	

	
		<div class="ks-wbox bRadius10">
			 <!--header-->
			     <div class="ks-head-box">
			     		<h3 class="ks-head-title2">排课管理
			     			<div class="fr">	
								<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor6"><i class="iconfont icon-qm" ></i></a>											
							</div>
			     		</h3>
			     </div>
			 <!--header-->
			 <!--tab-->
		     	<div class="ks-head-tab">
	     			<ul class="clearfix">
	     					<?php include  CURR_VIEW_PATH . "top.php";?>
	     					
	     			</ul>
		     	</div>
			<!--/tab-->     
			
			
			<!--widget-->
			<div class="ks-head-widget clearfix">
				<div class="fl">
					   <div class="ks-course-cg " style="width: 600px">
							<span class="ks-cg-span">课程列表</span>
							<ul >
								<li><span class="ks-course-c1 ks-course-co1"></span><span>一对一课堂</span></li>
								<li><span class="ks-course-c1 ks-course-co2"></span><span>小班课堂</span></li>
								<li><span class="ks-course-c1 ks-course-co0"></span><span>大班课堂</span></li>
								<!--<li><span class="ks-course-c1 ks-course-co4"></span><span>课程</span></li>-->
							</ul>
					   </div>
				</div>
					<div class="fr">
						<ul class="ks-head-choice">
							
						<li>
							<div class="ks-head-el">
							<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
								<div class="ks-head-content ks-head-content-pr w400">
																			
								<ul class="screen">															
									<li>
										<span>班级/课程：</span>
										<div>
											<a href="javascript:;" class="choice-active" onclick="classtype(3,this)" data-x="3">不限</a>
											<a href="javascript:;" onclick="classtype(2,this)" data-x="2">一对一课堂</a>
											<a href="javascript:;" onclick="classtype(1,this)" data-x="1">小班课堂</a>
											<a href="javascript:;" onclick="classtype(0,this)"data-x="0">大班课堂</a>
											
										</div>
									</li>
									
									<li>
										<span>上课类型：</span>
										<div >
											<a href="javascript:;" class="choice-active" onclick="classon(0,this)" data-y="0">不限</a>
											<a href="javascript:;" onclick="classon(2,this)" data-y="2">线上</a>
											<a href="javascript:;"onclick="classon(1,this)" data-y="1">线下</a>
											
										</div>
									</li>
										
									
								</ul>
														
								</div>
							</div>
						</li>	
														
						<li>
							<div class="ks-head-el">
								
								<a class="ks-heade-button ks-head-primary" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschedule','',GP(''));?>','650px','500px',{title:'新增排课',type:'top'});" ><i class="iconfont icon-jiahao"></i>新增排课</a>
							</div>
						</li>
						
						
						
						</ul>
					</div>
				
			</div>
		<!--/widget-->

			
			
			
			
			
	
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
		  		<td  class="weekactive" data-day="1" id="a1"></td>
		  		<td  class="weekactive"data-day="2" id="a2"></td>
		  		<td  class="weekactive" data-day="3" id="a3"></td>
		  		<td  class="weekactive" data-day="4" id="a4"></td>
		  		<td  class="weekactive" data-day="5" id="a5"></td>
		  		<td  class="weekactive" data-day="6" id="a6"></td>
		  		<td  class="weekactive" data-day="7" id="a7"></td>
		  	</tr>
		  	<tr class="weektime">
		  		<td data-time="2">下午</td>
		  		<td  class="weekactive" data-day="1" id="b1"></td>
		  		<td  class="weekactive"data-day="2" id="b2"></td>
		  		<td  class="weekactive"data-day="3" id="b3"></td>
		  		<td  class="weekactive" data-day="4" id="b4"></td>
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
		</table>
		
		</div>
		
	</div>

</body>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	
	var dayArray=new Array()
	
	 year = '<?php echo $year ?>';
	 week =	'<?php echo $week ?>';
	module.require(['$','backstage','laydate'],function(){
		timeLoad();
		//课程内容数据填充	
		classDetail();

		//改变ks-course-tb 定位
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
	})	

	//插入时间选项卡
	function timeLoad(){
		dayArray.length = 0;  
		$.ajax({
	        type: "POST",
	        url:"<?php echo M_URL($this->AppName.'/Ajax','getDate','',GP('')) ?>",
	        data:{year:year,week:week},
	        success:function(text){
	         var dataTime = JSON.parse(text);//json转换成对象
	      	 var dataLi ='';
	      	 
	         for(var i=0;i<=dataTime.length-1;i++){        
	         
	    		var dataContent = dataTime[i].time;
	    		var dataStatus =dataTime[i].status;
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

	
	//填充数据
	function classDetail(classlevel=3,type=0){
		 	
	 	$.ajax({
	 		type:"POST",
	 		url:"<?php echo M_URL($this->AppName.'/Ajax','getschedule','',GP('')) ?>",
	 		data:{year:year,week:week,classlevel:classlevel,type:type},
	 		success:function(text){
	 		
	 	     
	 	 	var dataClass = JSON.parse(text);//json转换成对象
	 	 	/*  console.log(dataClass) */
	 	     for(var i=0;i< dataClass.length;i++){
	 	 	   var classPosition= dataClass[i].element;
	 	 	   var teacherName= dataClass[i].name;//教师名称
	 	 	   var className= dataClass[i].classname;//教师名称
	 	 	   var classTime =dataClass[i].time;//课程时间
	 		   var classLevel =dataClass[i].classlevel;//
	 		   
	 	 	   var classNumber=dataClass[i].type;//授课类型 
	 	 	   var classTitle =dataClass[i].title;//课程名称
	 	 	   var objClass =$('#'+classPosition);
	 	 	  
	 	 /*	   console.log(objClass)*/
	 	 	   var htmlStr ='';//默认移入显示块
	 	 	   var htmlContent='';//移入详细内容 
	 	 	   htmlStr ='<div class="ks-course-list ks-course-co'+classLevel+'" id="i'+dataClass[i].id+'"><span id="q'+dataClass[i].id+'">'+ classTime +'</span><span>'+teacherName +'</span><span>'+className +'</span></div>';
	 	 	   htmlContent+='<div class="ks-course-tb" style="display:none"> <div class="ks-course-ut clearfix"><div class="ks-course-uleft fl"> ';
	 	 	   htmlContent+='<p class="ks-course-time">上课时间</p><p class="ks-course-times">'+classTime+'</p></div>';
	 	 	   htmlContent+='<div class="ks-course-uright fr"><p class="ks-course-time">授课类型</p><p class="ks-course-times">'+classNumber+'</p></div></div>';
	 	 	   htmlContent+= '<div class="ks-course-ut "><p class="ks-course-time">授课老师</p><p class="ks-course-times">'+teacherName+'</p></div>' ;
	 	 	   htmlContent+='<div class="ks-course-ut "><p class="ks-course-time">主题名称</p><p class="ks-course-times">'+classTitle+'</p></div>';
	 	 	   htmlContent+='<div class="ks-course-ut "><p class="ks-course-time">班级名称</p><p class="ks-course-times">'+className+'</p></div>';	
	 	 	   htmlContent+= '</div>';
	 	 	   $('#'+classPosition).append(htmlStr);
	 	 	   $('#i'+dataClass[i].id).append(htmlContent); 
	 	 		
	 		}
	 		}
	 	})
		 	
	
	 }
	 

	//左右切换
	  function prev(){
    		clearClasss()//换周课程信息
    	 	$('.ks-course-li').remove();
    	 	
	      	week =parseInt(week)-1;
	      
	      	timeLoad();//插入日期
	      	classDetail()//插入课程信息
    }
    
    
     function next(){
		clearClasss()//换周课程信息
      	 week =parseInt(week)+1;
       
      	timeLoad();//插入日期
      	classDetail()//插入课程信息
    }
    
    
    //清除填充信息
    function clearClasss(){
		$('.weekactive').find('.ks-course-list').remove()
	
	}

	//判断授课类型

	function classtype (online,target){		
		clearClasss()//
		$(target).addClass('choice-active').siblings().removeClass('choice-active')
	
		var num = $(target).attr('data-x');
		classDetail(online)	
	}
	
	function classon(online,target){
		clearClasss()
		$(target).addClass('choice-active').siblings().removeClass('choice-active')
		var num = $(target).attr('data-y');
		classDetail(num,online)

	}
	
</script>
</html>
