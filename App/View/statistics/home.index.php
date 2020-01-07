<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<style>
.chart-num{ margin-bottom:40px;}
.chart-d-table{ border:1px solid #eee; border-bottom:0; border-right:0; margin-bottom:20px;}
.chart-d-table td,.chart-d-table th{ border-bottom:1px solid #eee; padding:10px 5px; border-right:1px solid #eee; text-align:center; font-size:14px;}
.chart-d-table .chart-t-title{ font-size:16px;}
.chart-w49{ width:49%; border:1px solid #eee;padding-top: 10px;margin-right: 10px;margin-bottom: 10px;position: relative;}
.rightTip{position: absolute; top: 15px; right: 15px; height: 25px; width: 80px; z-index: 50;}
</style>

<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
		<h3 class="ks-head-title">
     		<div class="ks-head-nav" style="height: 16px;">
			<!--标题-->
			<a href="<?php echo M_URL('Website'); ?>">网站设置</a><span><em>/</em>数据统计</span>
			<!--标题-->
			</div>
		</h3>
	    </div>
	    <!--header-->
					     
			  
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
	
			</div>					
					
			<div class="fr">
						
			</div>
					
		</div>
		<!--/widget-->
	     
		<!--table-->
		<form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP(''));  ?>" method="post" id="myform">   
			<div class="clearfix">
				<div class="chart-w49 fl">
		         	<select class="rightTip" id="canvas1">
		         		<option value="1">按照年</option>
		         		<option value="2" selected="selected">按照月</option>
		         		<option value="3">按照周</option>
		         		<option value="4">按照日</option>
		         	</select>
		            <div id="num1chart-img1"></div>
		        </div>
		        <div class="chart-w49 fr">
		        	<select class="rightTip" id="canvas2">
		         		<option value="1">按照年</option>
		         		<option value="2" selected="selected">按照月</option>
		         		<option value="3">按照周</option>
		         		<option value="4">按照日</option>
		         	</select>
		            <div id="num1chart-img2"></div>
		        </div>  
			</div>    
	        <div class="clearfix">
				<div class="chart-w49 fl">
					<select class="rightTip" id="canvas3">
		         		<option value="1" selected="">按照年</option>
		         		<option value="2">按照月</option>
		         		<option value="3">按照周</option>
		         		<option value="4">按照日</option>
		         	</select>
		            <div id="num3chart-img1"></div>
		        </div>
		        <div class="chart-w49 fr">
		        	<!--<select class="rightTip" id="canvas4">
		         		<option value="1" selected="">按照年</option>
		         		<option value="2">按照月</option>
		         		<option value="3">按照周</option>
		         		<option value="4">按照日</option>
		         	</select>-->
		            <div id="num3chart-img2"></div>
		        </div>  
	        </div>  
		</form>
	    <!--/table-->
	            
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
						
			</span>
					
			<div class="fr">
						
			</div>
		</div>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll','highcharts'],function(){
		
			//订单
			$("#canvas1").change(function(){
				var vals = $(this).val();
				getCoutOrder(vals)
			});
			$("#canvas2").change(function(){
				var vals = $(this).val();
				coutUser(vals)
			});
			$("#canvas3").change(function(){
				var vals = $(this).val();
				coutCapital(vals)
			});
			$("#canvas4").change(function(){
				var vals = $(this).val();
				getcourse(vals)
			});
			loadScorllJs();
			getCoutOrder(2);
			coutUser(2);
			coutCapital(1);
			coutData(1)
		});
	
	

	
	
	function getCoutOrder(key){
		var dateHours = (key==1 && ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"]) || (key==2 && []) || (key==3 && ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"]) || (key==4 && ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"]);	
		var sumorder = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//总订单数据
		var payorder = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//成交订单数据
		//订单统计
		$.ajax({
		    type: 'post',
		    url:'<?php echo M_URL('statistics/Index','coutOrder','',GP('')); ?>',
		    data:{"type":key},
		    dataType:'json',
		    success: function (data) { //返回json结果
		       sumorder = data.sumorder;
			   payorder = data.payorder;
			   
		       if(key==2){
		       	 var len = sumorder.length;
		       	 for(var i= 1;i<=len ;i++ ){
		       	 	dateHours[i-1]=i;
		       	 }
		       }
		        var chart = new Highcharts.Chart('num1chart-img1', {
	  			
					  "xAxis": [
						{
						  "type": "datetime",
						  "categories": dateHours,
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
						}
					  ],
					 
					  "series": [
						{
						  "name": "订单总数",
						  "data":sumorder,
						  "animation": true,
						  "connectEnds": true,
						  "enableMouseTracking": true,
						  "_colorIndex": 0,
						  "_symbolIndex": 0,
						  "showInLegend": true
						},
						{
						  "name": "成交订单",
						  "data":payorder,
						  "enableMouseTracking": true,
						  "_colorIndex": 1,
						  "_symbolIndex": 1
						}
					  ],
					  "yAxis": [
						{
						  "title": {
							"text": ""
						  },
						  "index": 0
						}
					  ],
					  "chart": {
						"style": {
						  "fontFamily": "\"微软雅黑\", Arial, Helvetica, sans-serif",
						  "color": "#333",
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
						"text": "订单统计"
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
						"#90ed7d",
						"#f7a35c",
						"#8085e9",
						"#f15c80",
						"#e4d354",
						"#2b908f",
						"#f45b5b",
						"#91e8e1"
					  ],
					  "legend": {
						
						"enabled": true,
						"align": "left",
					 	"layout": 'horizontal',
					 	 "verticalAlign": 'top',
					 	 "y":-45
					
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
				
			    })
	   		}
		})
	}
	
	//新增学生/粉丝统计
	function coutUser(key){
		if(key==1){
			var dateHours = ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"];
		}else if(key==2){	
			var dateHours = [];
		}else if(key==3){
			var dateHours = ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"];
		}else if(key==4){
			var dateHours = ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"];
		}
		var students = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//新增学生数
		var fans     = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//新增公众号粉丝数
		$.ajax({
		    type: 'post',
		    url:'<?php echo M_URL('statistics/Index','coutUser','',GP('')); ?>',
		    data:{"type":key},
		    dataType:'json',
		    success: function (data) { //返回json结果
		       students = data.students;
		       fans     = data.fans;
		       if(key==2){
		       	 var len = students.length;
		       	 for(var i= 1;i<=len ;i++ ){
		       	 	dateHours[i-1]=i;
		       	 }
		       }
		       var chart = new Highcharts.Chart('num1chart-img2', {
				  "xAxis": [{
					  "type": "datetime",
					  "categories": dateHours,
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
					  "name": "新增学生数",
					  "data":students,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 0,
					  "_symbolIndex": 0
					},
					{
					  "name": "新增公众号粉丝数",
					  "data":fans,
					  "animation": true,
					  "connectEnds": true,
					  "enableMouseTracking": true,
					  "_colorIndex": 1,
				  	  "_symbolIndex": 1
					},],
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
					"text": "新增学生/粉丝统计"
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
					"#2b908f",
					"#f45b5b",
					"#91e8e1"
				  ],
				  "legend": {
					"enabled": true,
					"align": "left",
				 	"layout": 'horizontal',
				 	 "verticalAlign": 'top',
				 	 "y":-45
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
		});
	}
	
	//资金统计
	function coutCapital(key){
		if(key==1){
			var dateHours = ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"];
		}else if(key==2){	
			var dateHours = [];
		}else if(key==3){
			var dateHours = ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"];
		}else if(key==4){
			var dateHours = ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"];
		}
		var incomeinfo = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//收入数据
		var expendinfo = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];//支出数据
		$.ajax({
		    type: 'post',
		    url:'<?php echo M_URL('statistics/Index','coutCapital','',GP('')); ?>',
		    data:{"type":key},
		    dataType:'json',
		    success: function (data) { //返回json结果
		    	incomeinfo = data.incomeinfo;
		       	expendinfo = data.expendinfo;
		       	if(key==2){
			       	 var len = incomeinfo.length;
			       	 for(var i= 1;i<=len ;i++ ){
			       	 	dateHours[i-1]=i;
			       	 }
		        }
		  		var chart = new Highcharts.Chart('num3chart-img1', {
		  		 	"xAxis": [{
				      "type": "category",
				      "categories":dateHours,
				      "index": 0,
				      "isX": true
				    }],
				  "series": [{
				      "name": "网校收入",
				      "data":incomeinfo,
				      "animation": true,
				      "connectEnds": true,
				      "enableMouseTracking": false,
				      "_colorIndex": 0,
				    },
				    {
				      "name": "网校成本支出",
				      "data":expendinfo,
				      "enableMouseTracking": false,
				      "_colorIndex": 1
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
				      "text": "资金统计"
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
				        "enabled": true
				      },
				      "animation": false
				    }
				  },
				  "colors": [
				    "#4caf50",
				    "#ff5252",
				    "#e4d354",
				    "#f45b5b",
				    "#91e8e1"
				  ],"legend": {
					"enabled": true,
					"align": "left",
				 	"layout": 'horizontal',
				 	 "verticalAlign": 'top',
				 	 "y":-45
				  },
				  "exporting": {
				    "enabled": false
				  }
		  		});
		  	}
	   	});
	}
	
	//统计数据
	function coutData(key){
		$.ajax({
		    type: 'post',
		    url:'<?php echo M_URL('statistics/Index','coutData','',GP('')); ?>',
		    data:{"type":key},
		    dataType:'json',
		    success: function (data) { //返回json结果
		    	datainfo = data.datainfo;
		    	Highcharts.chart('num3chart-img2', {
					"xAxis": [{
					      "type": "category",
						  "categories": ["学生数","教师数","公众号粉丝数","班级数","课程数","试卷数","作业数","剩余短信","剩余邮件","剩余点播流量","剩余点播空间","剩余连麦分钟数"],
					      "index": 0,
					      "isX": true
					   }],
					  "series": [{
					      "data": datainfo,
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
					     "text": "数据统计",
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
		});    
	}
	

</script>

</body>
</html>

