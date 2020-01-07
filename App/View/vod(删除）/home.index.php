<!DOCTYPE html>
<!-- saved from url=(0032)http://my.polyv.net/secure/union -->
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>教育云视频 视频托管 _ 保利威视云视频</title>  
  <link rel="icon" type="image/x-icon" href="http://my.polyv.net/assets/images/favicon.ico">
  <link rel="stylesheet" href="<?php echo UOOT;?>Public/common/css0/union.css">
  <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
  <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>



</head>
  <body class="ks-wrap" style="background: inherit !important;">

		<div id="ksBoxContent">
			<div class=" ks-wbox bRadius10 clearfix">
				
					<div class="ks-head-box">
			     		<h3 class="ks-head-title">点播管理</h3>
			     </div>
			     
			   
			     <div class="ks-head-widget clearfix">
			     <div class="fr">
			     		 	<ul class="ks-head-choice">
			     					<li>
			     							 <a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName.'/Index','listVod','',GP('')); ?>">视频列表</a>    
			     					</li>
			     					<li style="display: none;">
			     							<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName.'/Index','playSetting','',GP('')); ?>">视频播放器设置列表</a>     	 	 	 	
			     					</li>
			     			</ul>
			     </div>
			    
			     	
			     </div>
			<div class="ks-clist">
				<ul class="clearfix">
					<li>
	            	<div class="ks-cbox clearfix">
		    	
								<h3 class="ks-first mb20">点播详情</h3>
								  <div class="ks-txtLbox">	
		        				<div class="fl ks-txtLeft">
			        				<p>点播空间总量：<i class="c-86A8F"><?php echo (getLimitService(5,1))/1024; ?>G</i></p>
			        				<p>点播总流量：<i class="c-86A8F"><?php echo (getLimitService(3,1))/1024; ?>G</i></p>
			        		
			        				
		        				</div>
		        				<div class="ks-ctxt fl">
		        						<p>已使用点播空间：<i class="c-86A8F"><?php echo getSize($this->wxid); ?>G</i></p>
			        			  	<p>已使用点播总流量：<i class="c-86A8F"><?php echo getFlow($this->wxid); ?>G</i></p>
			        		
		        				</div>
		        					<div class="ks-ctxt fl">
		        						<p>剩余可使用点播空间：<i class="c-86A8F mr10"><?php echo (getLimitService(5,1))/1024-getSize($this->wxid); ?>G</i>
		        							<i class="c-86A8F">升级空间</i></p>
			        			  	<p>剩余可使用点播流量：<i class="c-86A8F mr10"><?php echo (getLimitService(3,1))/1024-getFlow($this->wxid); ?>G</i>
			        			  		<i class="c-86A8F">购买流量</i></p>
			        		
		        					</div>
		        					<div class="ks-ctxt fl">
		        						<p>视频总数：<i class="c-86A8F mr10"><?php echo vodcount($this->wxid); ?></i>个</i></p>
			        			 
			        		
		        					</div>

									
		        				</div>
		        				
		        			</div>
				
				
			        </li>
				</ul>
			</div>
</div>
			<div class="ks-wbox bRadius10 mt20">
				<div class="section-part part-2 clearfix">
					<div class="col-6 vod-line">
						<div id="container" style="min-width:300px;height:300px"></div>
					</div>	
						<div class="col-6">
						<div id="container1" style="min-width:300px;height:300px"></div>
					</div>	
				</div>
				<div class="section-part part-2 clearfix" style="margin: 100px auto 0 auto;width: 80%;">
						<div id="container3" style="min-width:400px;height:400px"></div>
					
				</div>
		</div>
</div>
    
     <div id="ksBoxFooter" ></div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script src="<?php echo UOOT;?>Public/common/js/highcharts.js"></script>

<script>

var countspace =<?php echo (getLimitService(5,1))/1024; ?>;
var userspace  =<?php echo getSize($this->wxid); ?>;
var countflow =<?php echo (getLimitService(3,1))/1024; ?>;
var userflow  =<?php  echo getFlow($this->wxid); ?>;




$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '空间使用情况'
        },
        tooltip: {
            headerFormat: '{series.name}<br>',
            pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>'
        },
        colors: ['#f44937', '#6EC7E5'] ,
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
       

        series: [{
            type: 'pie',
            name: '空间使用情况',
           
            data: [
                ['已用', userspace],
                ['剩余', countspace],
            ]
        }]
        
    });
    
  
  
  
  
  $.ajax({
		type:"post",
		url:"<?php echo M_URL($this->AppName.'/Index','flowdate','',GP(''));?>",
		success:function(data){
	        var a = JSON.parse(data);
			 x   = a.x;
			 y = a.y;
	console.log(y);
			 
	
//		       	 var x = x.length;
//		       	 for(var i= 1;i<=x ;i++ ){
//		       	 	dateHours[i]=i;
//		       	 }
//
	        var aa= Array();
	       	 for(var i= 0;i<= y.length-1;i++ ){
	       	 	aa[i]=parseInt(y[i]);
	       	 }
	     console.log(aa);
			
			
   $('#container1').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '流量使用情况'
        },
        tooltip: {
            headerFormat: '{series.name}<br>',
            pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>'
        },
        colors: ['#f44937', '#6EC7E5'] ,
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
       

        series: [{
            type: 'pie',
            name: '流量使用情况',
           
            data: [
                ['已用', userflow],
                ['剩余', countflow],
            ]
        }]
        
    });
    
   $('#container3').highcharts({
    title: {
        text: '最近7天的播放量'
    },


     legend: {
         align: 'left',
            verticalAlign: 'top',
            y: 0,
            floating: true,
            borderWidth: 0
    },
    xAxis: {
    	title: {
			            text: '日期',
			       },
    categories: x
},
yAxis: {
    	title: {
			            text: '流量',
			       },
   
},
   

    series: [{
        name: 'pc端播放量',
        data: aa
    }],
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }
});
			
			
			
			
			
			
			
			
		}
 })		
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    
    
     

});
</script>
