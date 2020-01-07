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
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />

<style>
.ks-table td,.ks-table th{padding:10px 5px!important}
.ks-table{border:0;margin-top:10px}
.ks-table td,.ks-table th{border:0;border-bottom:1px solid #eee;position:relative;width:12.5%;min-width:12.5%;vertical-align:top}
.ks-table td{height:100px}
.ks-table th{border-top:1px solid #eee}
.ks-table th{width:12.5%}
.ks-alert{padding:20px;text-align:center}
.ks-alert button{float:none}
.ks-course-list>span{width:auto;width:120px;margin-bottom:0;color:#333;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.ks-course-list{padding:15px 10px 15px 0}
.class_left{right:100%!important}
.class_top{top:-170px!important}
.class-active{color:#476dbe!important}
.ks-count-box{position:relative;padding-left:30px}
.ks-count-box i{position:absolute;left:0;top:0}
.ks-count-box .icon1{font-size:20px;color:#43d643;top:-5px}
.ks-count-box .icon2{font-size:20px;color:#d643d0;top:-5px}
.ks-count-box .icon3{font-size:20px;color:#43ced6;top:-5px}
.ks-count-box .icon4{font-size:20px;color:#e89e10;top:-5px}
.ks-count-txt span{display:block;color:#aaa}
.ks-count-txt .del{font-size:32px;color:#333;line-height:32px}
.ks-count li{float:left;width:50%;height:100px}
.ivon-down{position:relative;cursor:pointer}
.select-dropdown{position:absolute;box-shadow:rgba(0,0,0,.2) 0 1px 6px;background:#fff;padding:10px 10px;z-index:99;width:inherit;left:-50px;text-align:center}
.progress-out{position:relative;border:1px solid #d2edff;background-color:#fff;border-radius:10px}
.progress-in{position:absolute;height:100%;width:0;border:none;background-color:#d2edff;background-image:linear-gradient(top,#d2edff 0,#d2edff 40%,#d2edff 100%);background-image:-webkit-linear-gradient(top,#d2edff 0,#d2edff 40%,#d2edff 100%);background-image:-moz-linear-gradient(top,#d2edff 0,#d2edff 40%,#d2edff 100%);background-image:-o-linear-gradient(top,#d2edff 0,#d2edff 40%,#d2edff 100%);background-image:-ms-linear-gradient(top,#d2edff 0,#d2edff 40%,#d2edff 100%);text-align:center;color:#fff;z-index:1}
.direction-left{left:0;border-top-right-radius:2px;border-bottom-right-radius:2px}
.direction-right{right:0;border-top-left-radius:2px;border-bottom-left-radius:2px}
.percent-show{position:absolute;width:100%;height:100%;top:0;left:0;color:#000;text-align:center;z-index:2}
.btn{color:#476dbe!important;padding:0 12px;height:34px;line-height:34px;font-size:14px;background:#fff;border-radius:4px;background:0 0;display:inline-block;border:1px solid #eee}
.choice-active{color:#86A8F1!important;background:#f0f8ff}
.data-active{background-color:#f0f8ff;color:#6d83d0}
.highcharts-credits {display: none;}
</style>

</head>
<body class="ks-wrap">  
	
	
	
	    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','forgivesome','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" class=" bRadius10 ">
	    <div class="ks-wbox bRadius10">
	    	<!--header-->
		<div class="ks-head-box clearfix">
			<h3 class="ks-head-title2 ">意向通</h3>
		</div>
		
		<!--header-->
	
	
		<!--tab-->
     	<div class="ks-head-tab">
 			<ul class="clearfix">
 				<li <?php if(ACTION=='index'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('appid-33',true));  ?>">我的意向本</a></li>
					<li <?php if(ACTION=='manageindex'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','manageindex','',GP('appid-33',true)); ?>">意向记录</a> </li>
					<li <?php if(ACTION=='consultingPool'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','consultingPool','',GP('appid-33',true)); ?>">意向池</a> </li>
					<li <?php if(ACTION=='invalidpool'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','invalidpool','',GP('appid-33',true)); ?>">无效池</a> </li>
		<!--			<li ><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('htmltype-2'));  ?>">我的咨询本</a> </li>-->
					<li <?php if(ACTION=='listenmanagement'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','listenmanagement','',GP('appid-33',true));  ?>">试听管理</a></li>
					<li <?php if(ACTION=='showchannel'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','showchannel','',GP('appid-33',true));  ?>">渠道管理</a></li>
 			</ul>
     	</div>
    <!--/tab-->
    
    
    <!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="fl ks-head-tbox">
			<input type="text" id="selectTime" class="ks-head-input sc-mini-pc ks-head-time w300 " placeholder="<?php if(empty($start)) echo '自定义时间段' ?>"/>
			<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
		</div>
			<div class="fr">
				<ul class="ks-head-choice">

					<li>
						<div class="ks-head-el">
							<a class="ks-heade-button ks-head-primary" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,33,false,true);?>'})" type="button" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showchanneladd','',GP('')) ?>','500px','300px',{title:'新增渠道',type:'top'})" ><i class="icon-jiahao iconfont "></i>新增渠道</a>
						</div>
						
					</li>
					<li>
						<div class="ks-head-el">
							<a class="ks-heade-button ks-head-primary" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,33,false,true);?>'})" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','Import','',GP('')) ?>','477px','300px',{title:'批量导入',type:'top'})" class="alignCenter">
							批量导入 </a>
						</div>
						
					</li>
					
				</ul>
			</div>
		
	</div>
	<!--/widget-->
	    	
	    </div>	
	    	
		<div class="mt20">
			<!--筛选-->
			
	
	<!--end-->
			<div class="">
				<div class="row clearfix">
					<div class="col-9">
						<div class="ks-wbox bRadius10" style="margin-right: 30px;"> 
						<div class="ks-course-data">
							<div class="ks-course-prev" onclick="prev()"><i class="iconfont icon-jiantou-copy1"></i></div>
							<div class="ks-course-next" onclick="next()"><i class="iconfont icon-jiantou-copy2"></i></div>
							<div class="ks-course-content">
								<ul class="clearfix"><li class="ks-course-li ">04-30</li><li class="ks-course-li ">05-01</li><li class="ks-course-li active">05-02</li><li class="ks-course-li ">05-03</li><li class="ks-course-li ">05-04</li><li class="ks-course-li ">05-05</li><li class="ks-course-li ">05-06</li></ul>
							</div>
						</div>
						<table width="100%" border="1" cellpadding="2" cellspacing="2" class="ks-table"> 
						   <thead>
						   	<tr class="weekday"> 
						   		<!--<th style="width:10% ;">时间</th>-->
						   		<th style="width:10% ;" class="weekactive weekdaytime" data-day="1">星期一</th>
						   		<th style="width:10% ;" class="weekactive weekdaytime" data-day="2">星期二</th>
						   		<th style="width:10% ;" class="weekactive weekdaytime " data-day="3">星期三</th>
						   		<th style="width:10% ;" class="weekactive weekdaytime" data-day="4">星期四</th>
						   		<th style="width:10% ;" class="weekactive weekdaytime" data-day="5">星期五</th>
						   		<th style="width:10% ;"class="weekactive  weekdaytime" data-day="6">星期六</th>
						   		<th style="width:10% ;" class="weekactive  weekdaytime" data-day="7">星期日</th>
						   	</tr>
						   	
						   </thead>
						  <tbody class="text_mon">
						
						  </tbody>
						</table>
						</div>
					</div>
					<div class="col-3">
						<div class="ks-wbox bRadius10" style="padding-left: 50px;">
							<div class="" style="margin-bottom: 40px;">
								<ul class="ks-view-tab" style="margin-left:0px; width: 206px;border: 1px solid #d1d5de;">  
										<li  <?php if($timetypes==1){echo'class="data-active"';}?> ><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('timetypes-1'));  ?>">今日</a></li>
										<li style="border-left: 1px solid #bbc0ca;" <?php if($timetypes==2){echo'class="data-active"';}?> ><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('timetypes-2'));  ?>">本周</a> </li>
										<li style="border-left: 1px solid #bbc0ca;" <?php if($timetypes==3){echo'class="data-active"';}?> ><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('timetypes-3'));  ?>">本月</a> </li>
									
								</ul>
							</div>
							<div class="ks-count ">
								<ul class="clearfix">
									<li >
										<div class="ks-count-box">
											<i class="icon-biji iconfont icon3" ></i>
											<div class="ks-count-txt">
												<span>成交(人)</span>
												<span class="del"><?php echo $todaysucceCount;?></span>
											</div>
										</div>
									</li>
									<li >
										<div class="ks-count-box">
											<i class="icon-jibenxinxi iconfont icon1" ></i>
											<div class="ks-count-txt">
												<span>待办数量(人)</span>
												<span class="del"><?php echo $waitCount;?></span>
											</div>
										</div>
									</li>
									<li>
										<div class="ks-count-box">
											<i class="icon-shifoulingquhongbao iconfont icon2" ></i>
											<div class="ks-count-txt">
												<span>新增(人)</span>
												<span class="del"><?php echo $todayaddCount;?></span>
											</div>
										</div>
									</li>
									
									
								</ul>
							</div>
						</div>
						
						
						
							<div class="ks-wbox bRadius10" style="padding-left: 25px;margin-top: 30px;">
						
							
							<div>
								<div id="container"></div>
								<div class="progress-out" id="div2">
								    <div class="percent-show"><span>0</span>%</div>
								    <div class="progress-in"></div>
								</div>
									<div class="progress-out mt20" id="div3">
								    <div class="percent-show"><span>0</span>%</div>
								    <div class="progress-in"></div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
		
			</div>
		
			
			
		</div>
	</form>
</div>


<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script src="<?php echo UOOT;?>Public/common/js/Progress.js" ></script>
<script src="https://img.hcharts.cn/highcharts/highcharts.js"></script>
<script src="https://img.hcharts.cn/highcharts/modules/funnel.js"></script>
<script>
//金字塔统计图
module.require(['backstage','nicescroll','laydate'],function(){
			loadScorllJs();
			
			laydate.render({
			  elem: '#selectTime',
			  format:'yyyy/MM/dd',
			  range: true,
			  done:function(value){
			 
			  	
			  		value = value.split(' - ');
			  		var starttime = new Date(value[0]).getTime()/1000;
			  		var endtime = new Date(value[1]).getTime()/1000;
			  		 getAlldata(starttime,endtime);
	
			  
			  }
			});
	})
function getAlldata(end=0,start=0){
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','getAlldata','',GP('')) ?>",
        data:{start:start,end:end},
        success:function(text){
        	 var dataTime = JSON.parse(text);//json转换成对象
    $('#container').highcharts({
        chart: {
            type: 'pyramid',
            marginRight: 100
        },
        title: {
            text: '我的漏斗',
            x: -50
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                    softConnector: true
                }
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            name: '用户',
            data: [
                ['全部', parseInt(dataTime.sum) ],
                ['待跟进', parseInt(dataTime.wait)],
                ['跟进中',parseInt(dataTime.move)],
                ['已试听',parseInt(dataTime.listen)],
                ['已成交', parseInt(dataTime.succes)]
            ]
        }]
    });
        }
      })
}
 getAlldata();
 

	
//插入排序时间	+详细信息
var dayArray=new Array()
 year = '<?php echo $year ?>';
 week =	'<?php echo $week ?>';
function timeLoad(w=8){
	dayArray.length = 0;  
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','getDate','',GP('')) ?>",
        data:{year:year,week:week,num:w},
        success:function(text){
         var dataTime = JSON.parse(text);//json转换成对象
      	 var dataLi ='';
      	 
         for(var i=0;i<=dataTime.length-1;i++){        
         
    		var dataContent = dataTime[i].time;
    		var dataStatus =dataTime[i].status;
    	
   		
  			
  			  dayArray.push(dataContent);
  			  if(dataStatus==1){
  			  		var parentTdIndex = i;

  			  		 dataLi +='<li  class="choice-active ks-course-li" datt-type='+(i)+' nowtime="'+dataTime[i].nowtime+'">'+dataContent+'</li>'
          			 $('.ks-course-content ul').html(dataLi);
          			 $('.weekactive').eq(parentTdIndex).addClass('choice-active')	 
  			  }else{
  			  	 dataLi +='<li  class="ks-course-li " datt-type='+(i)+' nowtime="'+dataTime[i].nowtime+'">'+dataContent+'</li>'
          			 $('.ks-course-content ul').html(dataLi);
  			  }      	
        }
        classDetail();
     	},
     	
      });
}

	timeLoad();
	
    function prev(){
    	var w = $('.choice-active')[1].dataset.day
    		clearClasss()//换周课程信息
    	 	$('.ks-course-li').remove();
    	 	
	      	week =parseInt(week)-1;
	        
	      	timeLoad(w);//插入日期
	      	
	      	classDetail()//插入课程信息
    }
    
    $('.ks-course-li').remove();
     function next(){
     	var w = $('.choice-active')[1].dataset.day
    		clearClasss()//换周课程信息
	      	 week =parseInt(week)+1;
	      	timeLoad(w);//插入日期
	      	classDetail()//插入课程信息
    }
    
function clearClasss(){
	$('.weekactive').find('.ks-course-list').remove()
}

$('.ivon-down').hover(function(){
	$(this).find('.select-dropdown').slideDown()
},function(){
	
	$(this).find('.select-dropdown').slideUp()
});


    $(document).on('click',".ks-course-li",function(){
        $(this).addClass("choice-active");
        $(this).siblings().removeClass("choice-active");
        $(".weekdaytime").siblings().removeClass("choice-active");
        $(".weekdaytime")[$(this).attr('datt-type')].className='weekactive weekdaytime choice-active';
        classDetail()
    });



/*
 * 获取指定日期咨询信息
 */	
function classDetail(){
	$.ajax({
	 		type:"POST",
	 		url:"<?php echo M_URL($this->AppName.'/Ajax','getdetail','',GP('')) ?>",
	 		data:{year:year,time:$('.choice-active').attr('nowtime')}, 
	 		success:function(data){
	 			var data = JSON.parse(data);
	 		 clearClasss()
	 		$('.text_mon td').remove()
	 		var htmltext=''
			if(data.length>0){
			     for(var i=0; i<data.length;i++){
			    	htmltext+="<tr><td>"+data[i]['membername']+"</td><td>"+data[i]['mobile']+"</td><td>"+data[i]['coursename']+"</td><td>"+data[i]['schoolroomid']+"</td><td>"+data[i]['mark']+"</td><td></td><td><a class='c-86A8F mr10' href='"+data[i]['href']+"'>查看</a></td></tr>"
			    }
			     $('.text_mon').html(htmltext);	
			}else{
				htmltext = '<tr><td colspan="7"><div class="emptycss" style="text-indent: 0;line-height: 532px;"><a style="color:#86A8F1;" href="<?php echo M_URL($this->AppName.'/Index','manageindex','',GP('')); ?>">今日没有待办的任务，去意向记录看看吧</a></div></td></tr>';
				$('.text_mon').html(htmltext);	
			}
				 	    
	 	 }
	 })
}
//进度条

 $("#div2").myProgress({speed: 1000, percent: 50});
 $("#div3").myProgress({speed: 1000, percent: 70});

</script>
</body>
</html>
