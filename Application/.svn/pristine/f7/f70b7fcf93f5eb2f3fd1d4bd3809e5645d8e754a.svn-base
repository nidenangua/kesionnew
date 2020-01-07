<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">

<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css//news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	.form-control {height: 24px;padding: 0;display: inline-block;width: 70px;margin-left: 10px;}
	.dataList .dataCont {height: 350px;}
	.dataCont text {font-weight: normal!important;}
</style>
</head>
 
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;数据统计 </h3>
        
         <a href="<?php echo M_URL('Vdo','countlive','',GP('')); ?>">&nbsp;&nbsp;直播统计</a>
    </div>
</div>


</div>



<div class="dataList" id="ksBoxContent">
	

	<div class="topContent">
		<div class="wrap">
			<!--网校统计-->
			<div class="left-topContent clearfix">
				<div class="tool-bt" id="tool1">
					<select class="form-control" onchange="wxcount(this.value)" >
		         		<option value="1" >按照周</option>
		         		<option value="2"  >按照月</option>
		         		<option value="3">按照季度</option>
		         		<option value="4">按照年</option>
		         	</select>
		         	<select class="form-control fl" >
		         		
		         		<option value="2" selected="selected">按地区</option>
		         		<option value="3">按照周</option>
		         		<option value="4">按照日</option>
		         	</select>
				</div>
				
				<div class="dataCont" id="netsum"></div>
			</div>
			<!--销售套餐收入统计-->
			<div class="right-topContent clearfix">
				<div class="tool-bt" id="tool2">
					
		         	<select class="form-control fl" onchange="packagecount(this.value)">
		         		<option value="1">按照周</option>
		         		<option value="2">按月</option>
		         		<option value="3">按照季度</option>
		         		<option value="4">按照年</option>
		         	</select>
				</div>
				<div class="dataCont" id="combosum"></div>
			</div>
			<!--押金统计-->
			<div class="left-topContent clearfix">
				<div class="tool-bt" id="tool1">
					
		         	<select class="form-control fl" onchange="depoit(this.value)">
		         		<option value="1">按照周</option>
		         		<option value="2">按月</option>
		         		<option value="3">按照季度</option>
		         		<option value="4">按照年</option>
		         	</select>
				</div>
				
				<div class="dataCont" id="deposit"></div>
			</div>
			<!--销售应用收入统计-->
				<div class="right-topContent clearfix">
				<div style="float: left;font-size: 16px;position: relative;top: 8px;left: 20px;">销售应用总收入：<span id="sumsey"></span></div>
				<div class="tool-bt" id="tool2">
					
		         	<select class="form-control fl" onchange="sales(this.value)">
		         		<option value="1">按照周</option>
		         		<option value="2">按月</option>
		         		<option value="3">按照季度</option>
		         		<option value="4">按照年</option>
		         	</select>
				</div>
				<div class="dataCont" id="salesapp"></div>
			</div>
			
		</div>		
	</div>
	
	


			

	<br />
	<br />
	</div>
<script type="text/javascript">
	
</script>


</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/highcharts.js"></script>
<script type="text/javascript">
	var root='<?php echo UOOT;?>'
	  var dateHours = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
	  var sumorder = [2,1,4,3,2,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//网校总数数据
	  var payorder = [1,2,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//成交订单数据
	  var students = [2,3,4,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//新增学生数
	  var fans     = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//新增公众号粉丝数
	 //网校总数
wxcount(1);
function wxcount(k){
	$.ajax({
      		type:"post",
      		dataType:"json",
      		url:root+"admin.php/home/Order/wxcount",
      		async:true,
      		data:{
      			'option':k,
      		},
      		success:function(data){
      			console.log(data)
      			var chart = new Highcharts.Chart('netsum', {
				  "xAxis": [{
					  "type": "datetime",
					  "categories": data.day4,
					  "title": {
						"text": ""
					  },
					  "opposite": false,
					  "minorTickPosition": "outside",
					  "offset": 0,
					  "tickLength": 10,
					  "tickmarkPlacement": "on",
					  "tickPosition": "outside",
					  "index": 0,
					  "isX": true
					}],
				  "series": [{
					  "name": "网校总数",
					  "data":data.day,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 0,
					  "_symbolIndex": 0
					},
					{
					  "name": "VIP版网校总数",
					  "data":data.day3,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 2,
				  	  "_symbolIndex": 2
					},
					{
					  "name": "普通版网校总数",
					  "data":data.day2,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 1,
				  	  "_symbolIndex": 1
					},
					],
				  "yAxis": [{
					  "title": {
						"text": ""
					  },
					  "index": 0
					}],
				  "chart": {
					"style": {
					  "fontFamily": "\"微软雅黑\", Arial, Helvetica, sans-serif",
					  "color": "#e4d354",
					  "fontSize": "12px",
					  "fontWeight": "normal",
					  "fontStyle": "normal"
					},
					"alignTicks": true,
					"polar": false,
					"type": "spline",
					"typeDescription": "",
					"inverted": false
				  },
				  "title": {
					"text": "网校统计",
					 "verticalAlign": 'bottom',
					
				  },
				  "subtitle": {
					"text": ""
				  },
				  "plotOptions": {
					"line": {
					  "animation": false,
					  "allowPointSelect": false
					},
					"series": {
					  "dataLabels": {
						"allowOverlap": false,
						"enabled": true
					  }
					}
				  },
				  "colors": [
					"#8085e9",
					"#f15c80",
					"#e4d354",
				
				  ],
				  "legend": {
					"enabled": true,
					"align": "left",
				 	"layout": 'horizontal',
				 	 "verticalAlign": 'top',
				 	 "y":-20
				  },
				  "credits": {
					"text": "",
					"href": "",
					"enabled": false
				  },
				  "lang": {
					"downloadSVG": "导出 SVG 图片",
					"downloadPDF": "导出 PDF 文档",
					"downloadPNG": "导出 PNG 图片",
					"downloadJPEG": "导出 JPEG 图片",
					"printChart": "打印图表",
					"contextButtonTitle": "图表导出"
				  },
				  "tooltip": {
					"useHTML": false,
					"split": false,
					"enabled": true
				  },
				   "exporting": {
					"enabled": false
				  }
		    });
      		}
      })
}

 //套餐总收入
packagecount(1)
function packagecount(k){
	$.ajax({
      		type:"post",
      		dataType:"json",
      		url:root+"admin.php/home/Order/wxpackage",
      		async:true,
      		data:{
      			'option':k,
      		},
      		success:function(data){
		      var chart = new Highcharts.Chart('combosum', {
				  "xAxis": [{
					  "type": "datetime",
					  "categories": data.day4,
					  "title": {
						"text": ""
					  },
					  "opposite": false,
					  "minorTickPosition": "outside",
					  "offset": 0,
					  "tickLength": 10,
					  "tickmarkPlacement": "on",
					  "tickPosition": "outside",
					  "index": 0,
					  "isX": true
					}],
				  "series": [{
					  "name": "套餐总数",
					  "data":data.day,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 0,
					  "_symbolIndex": 0
					},
					{
					  "name": "VIP版套餐收入",
					  "data":data.day3,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 2,
				  	  "_symbolIndex": 1
					},
					{
					  "name": "普通版套餐收入",
					  "data":data.day2,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 1,
				  	  "_symbolIndex": 1
					},
					],
				  "yAxis": [{
					  "title": {
						"text": ""
					  },
					  "index": 0
					}],
				  "chart": {
					"style": {
					  "fontFamily": "\"微软雅黑\", Arial, Helvetica, sans-serif",
					  "color": "#e4d354",
					  "fontSize": "12px",
					  "fontWeight": "normal",
					  "fontStyle": "normal"
					},
					"alignTicks": true,
					"polar": false,
					"type": "spline",
					"typeDescription": "",
					"inverted": false
				  },
				  "title": {
					"text": "销售套餐收入统计",
					 "verticalAlign": 'bottom',
				  },
				  "subtitle": {
					"text": ""
				  },
				  "plotOptions": {
					"line": {
					  "animation": false,
					  "allowPointSelect": false
					},
					"series": {
					  "dataLabels": {
						"allowOverlap": false,
						"enabled": true
					  }
					}
				  },
				  "colors": [
					"#f6fb1f",
					"#1df525",
					"#14e7b8",
				
				  ],
				  "legend": {
					"enabled": true,
					"align": "left",
				 	"layout": 'horizontal',
				 	 "verticalAlign": 'top',
				 	 "y":-20
				  },
				  "credits": {
					"text": "",
					"href": "",
					"enabled": false
				  },
				  "lang": {
					"downloadSVG": "导出 SVG 图片",
					"downloadPDF": "导出 PDF 文档",
					"downloadPNG": "导出 PNG 图片",
					"downloadJPEG": "导出 JPEG 图片",
					"printChart": "打印图表",
					"contextButtonTitle": "图表导出"
				  },
				  "tooltip": {
					"useHTML": false,
					"split": false,
					"enabled": true
				  },
				   "exporting": {
					"enabled": false
				  }
		    });
      		}
      })
}
		   



			//押金
depoit(1)
function depoit(k){
	$.ajax({
      		type:"post",
      		dataType:"json",
      		url:root+"admin.php/home/Order/deposit",
      		async:true,
      		data:{
      			'option':k,
      		},
      		success:function(data){
		      var chart = new Highcharts.Chart('deposit', {
				  "xAxis": [{
					  "type": "datetime",
					  "categories": data.day4,
					  "title": {
						"text": ""
					  },
					  "opposite": false,
					  "minorTickPosition": "outside",
					  "offset": 0,
					  "tickLength": 10,
					  "tickmarkPlacement": "on",
					  "tickPosition": "outside",
					  "index": 0,
					  "isX": true
					}],
				  "series": [{
					  "name": "累计总押金",
					  "data":data.day,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 0,
					  "_symbolIndex": 0
					},
					{
					  "name": "已转换消费押金",
					  "data":data.day3,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 2,
				  	  "_symbolIndex": 2
					},
					{
					  "name": "已退款押金",
					  "data":data.day2,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 1,
				  	  "_symbolIndex": 1
					},
					],
				  "yAxis": [{
					  "title": {
						"text": ""
					  },
					  "index": 0
					}],
				  "chart": {
					"style": {
					  "fontFamily": "\"微软雅黑\", Arial, Helvetica, sans-serif",
					  "color": "#e4d354",
					  "fontSize": "12px",
					  "fontWeight": "normal",
					  "fontStyle": "normal"
					},
					"alignTicks": true,
					"polar": false,
					"type": "spline",
					"typeDescription": "",
					"inverted": false
				  },
				  "title": {
					"text": "押金统计",
					 "verticalAlign": 'bottom',
				  },
				  "subtitle": {
					"text": ""
				  },
				  "plotOptions": {
					"line": {
					  "animation": false,
					  "allowPointSelect": false
					},
					"series": {
					  "dataLabels": {
						"allowOverlap": false,
						"enabled": true
					  }
					}
				  },
				  "colors": [
					"#f6fb1f",
					"#1df525",
					"#14e7b8",
				
				  ],
				  "legend": {
					"enabled": true,
					"align": "left",
				 	"layout": 'horizontal',
				 	 "verticalAlign": 'top',
				 	 "y":-20
				  },
				  "credits": {
					"text": "",
					"href": "",
					"enabled": false
				  },
				  "lang": {
					"downloadSVG": "导出 SVG 图片",
					"downloadPDF": "导出 PDF 文档",
					"downloadPNG": "导出 PNG 图片",
					"downloadJPEG": "导出 JPEG 图片",
					"printChart": "打印图表",
					"contextButtonTitle": "图表导出"
				  },
				  "tooltip": {
					"useHTML": false,
					"split": false,
					"enabled": true
				  },
				   "exporting": {
					"enabled": false
				  }
		    });
		}
	})
}
//销售应用总收入统计
sales(1)
function sales(k){
	$.ajax({
      		type:"post",
      		dataType:"json",
      		url:root+"admin.php/home/Order/sales",
      		async:true,
      		data:{
      			'option':k,
      		},
      		success:function(data){
      			$('#sumsey').text(data.summoney)
			  var chart = new Highcharts.Chart('salesapp', {
					"xAxis": [{
					      "type": "category",
						  "categories": ["购买并发","购买连麦币","购买空间","购买流量","购买短信","购买邮件"],
					      "index": 0,
					      "isX": true
					   }],
					  "series": [{
					      "data": [data.day6,data.day5,data.day3,data.day4,data.day,data.day2],
					      "_colorIndex": 0
					   }],
					  "yAxis": [{
					      "title": {
					        "text": ""
					      },
					      "index": 0
					   }],
					  "chart": {
						    "style": {
						      "fontFamily": "\"微软雅黑\", Arial, Helvetica, sans-serif",
						      "color": "#333",
						      "fontSize": "12px",
						      "fontWeight": "normal",
						      "fontStyle": "normal"
						    },
						    "type": "column"
					  },
					  "title": {
					     "text": "销售应用收入统计",
					     "x": -20
					  },
					  "subtitle": {
					    "text": "",
					    "x": -20
					  },
					  "tooltip": {
					    "valueSuffix": ""
					  },
					  "legend": {
					    "layout": "vertical",
					    "align": "right",
					    "verticalAlign": "middle",
					    "enabled": false
					  },
					  "plotOptions": {
					    "series": {
					      "animation": false,
					      "colorByPoint": true
					    }
					  },
					  "credits": {
					    "href": "",
					    "text": ""
					  },
				});
      		}
      })
}
</script>

