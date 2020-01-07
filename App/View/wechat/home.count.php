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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/template.css?201903061049" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style type="text/css">
	body{
		background:#f9f9f9
	}
	.Count-ul{ margin-right: -30px;margin-top: 20px;}
	.Count-ul>li{float: left;height: 320px;;}
	.Count-ul>li>.Count-box{
		margin-right: 30px;
		border-radius: 10px;
	}
	#twice{float: right;position: relative;}
	#twice .atbox{width: 150px;height: 150px;position: absolute; left:-40px;top:0px; padding: 15px 15px;opacity: 0;}
	#twice .atbox2{background: #FFF;box-shadow: 0px 0px 5px #E5E5E5;margin-top:30px;padding: 10px;}
	#twice:hover .atbox{display:block;opacity: 1;transition: all 1s;}
	#twice .atbox img{width: 100%;height:  100%;}
</style>
</head>
<body class="ks-wrap">
	
	<div id="ctl00_KSContent_Panel1" style="overflow: hidden;">
		<ul class="clearfix  Count-ul" >
			<li class="w70b">
				<!--用户统计-->
				<div class="top_count Count-box">
					<div class="count_item_title">用户统计</div>
					<div>
						<div id="user" style="height: 250px;"></div>
					</div>
				</div>		
				<!--用户统计-->
			</li>
			
			<li class="clearfix w30b">		
			<!--第一个-->
				<div class="bottom_count_item Count-box bg-white">
					<div class="count_item_box">
   						<div class="count_item_title">素材统计</div>
   						<div style="padding:45px 0px ;">
   							<div class="" style=" height: 160px; background: #fff;" id="sucai"></div>
   						</div>
	                </div>
				</div>
			<!--第二个-->
			</li>
			
			
			
			<li class="w70b">
			<!--历史新关注人数-->
		
				<div class="count_item_box Count-box bg-white">
					<div class="count_item_title">历史新关注人数<!--<i class="iconfont icon-shezhi fr mr10" style="font-size: 1.4em; cursor: pointer;"></i>--></div>
					<div class="count_item_con clearfix">
						<div class="count_item_con_left"> 
							<div id="round">
								
							</div> 
																
						</div>
						<div class="count_item_con_right">
							<ul class="count-item-ul">
							   <li><i class="dis-c1"></i><div>昨日 &nbsp;&nbsp;&nbsp;<?php echo ($countdata['new_user']-$countdata['cancel_user'])?></div></li>
							   <li><i class="dis-c2"></i><div>本周 &nbsp;&nbsp;&nbsp;<?php echo $countweek?></div></li>
							   <li><i class="dis-c3"></i><div>本月 &nbsp;&nbsp;&nbsp;<?php echo $countMon?></div></li>
						    </ul>	   								
						</div>
					</div>
				</div>
			
		
			<!--历史新关注人数-->
			</li>
			<li class="w30b">
				<div class="bottom_count_item Count-box bg-white">
					<div class="count_item_box">
   						<div class="count_item_title">关键字管理</div>
   						<div style="padding:42px 0px ;">
   							<div class="" style=" height: 160px; background: #fff;" id="zishu"></div>
   						</div>
	                </div>
				</div>
			</li>
		</ul>
	
		<div class="fans_count  bg-white"  style="border-radius: 10px;">
			<div class="count_item_title">最新粉丝</div>
			<table width="100%" class="ks-table" >
				<tbody>
					<tr class="CTitle">
						<td>微信头像</td>
						<td>昵称（备注名）</td>
						<td>性别</td>
					  	<td>关注时间</td>
					  	<td>城市</td>
					</tr>
					<?php if(empty($userlist)){ ?>
	 				<tr width="100%">
						<td colspan="9">
					  		<div class="emptycss"></div>
						</td>
			  		</tr>
			  		<?php 
			  			}else{ 
			  				foreach ($userlist as $key => $value) {
                                echo '<tr class="CTitle">';
                                echo "<td><img whith='120' height='120' src='".Img($value['headimgurl'])."'></td>";
                                echo "<td>".$value['nickname']."</td>";
                                if($value['sex'] == 1){
                                    echo "<td>男</td>";
                                }else{
                                    echo "<td>女</td>";
                                }
                                echo "<td>".date("Y-m-d H:i:s",$value['subscribe_time'])."</td>";
                                echo "<td>".$value['country'].$value['province'].$value['city']."</td>";
                                echo '</tr>';
                            }
			  			}
			  		?>
			  </tbody>
	  		</table>
			</div>
		</div>
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll','echarts','round'],function(){
			loadScorllJs();
			var radialObj3 = $('#round').radialIndicator({
				radius: 95,
				minValue: 0,
				maxValue: 100,
				barColor: '#0FC9F7',
				percentage:'true',
				fontWeight:'500'
			}).data('radialIndicator');
			radialObj3.value(<?php echo ($countdata['new_user']-$countdata['cancel_user'])?>);
			
			
			
			
			echarts.init(document.getElementById('sucai')).setOption({	
            series: {
                type: 'pie',
                label : {
					normal : {
						formatter: '{b}:{c}: ({d}%)',
						textStyle : {
							fontWeight : 'normal',
							fontSize : 11
						}
					}
				}, 
                data: [
                    {name: '今日新增', value: <?php echo $now_countsucai?>},
                    {name: '前期累计', value: (<?php echo $countsucai?>-<?php echo $now_countsucai?>)}
                ],
                itemStyle: {
	                emphasis: {
	                    shadowBlur: 10,
	                    shadowOffsetX: 0,
	                    shadowColor: 'rgba(0, 0, 0, 0.5)'
	                }
	            }
            },
             color:['#FF7F24', '#188eee','yellow','blueviolet']
       });
 $('#sucai').append (`<div class='echarts-total-show ml20'>总素材数：${<?php echo $countsucai?>}</div>`);      
echarts.init(document.getElementById('zishu')).setOption({
            series: {
                type: 'pie',
                label : {
					normal : {
						formatter: '{b}:{c}: ({d}%)',
						textStyle : {
							fontWeight : 'normal',
							fontSize : 11
						}
					}
				}, 
                data: [                 
                 {name: '今日新增', value: <?php echo $now_countreply?>},
                 {name: '前期累计', value: (<?php echo $countreply?>-<?php echo $now_countreply?>)}              
                ],
                itemStyle: {
	                emphasis: {
	                    shadowBlur: 10,
	                    shadowOffsetX: 0,
	                    shadowColor: 'rgba(0, 0, 0, 0.5)'
	                }
	            }
            },
             color:['#FF7F24', '#188eee','yellow','blueviolet']  
        });
		        
		$('#zishu').append (`<div class='echarts-total-show ml20'>总关键字数：${<?php echo $countreply?>}</div>`);            
		echarts.init(document.getElementById('user')).setOption({
		   
		   	tooltip : {
		        trigger: 'axis',
		        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
		            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
		        }
		    },
		    legend: {
		        data:['用户总数','新增人数'],
		       orient:'vertical',
		       right:10,
		       top:'45%'
		    },
		    toolbox: {
		        show : true,
		        orient: 'vertical',
		        x: 'right',
		        y: 'center',
		    },
		    calculable : true,
		    xAxis : [
		        {
		            type : 'category',
		            data : ['周一','周二','周三','周四','周五','周六','周日']
		        }
		    ],
		    yAxis : [
		        {
		            type : 'value'
		        }
		    ],
		    series : [
		
		        {
		            name:'用户总数',
		            type:'bar',
		            barWidth : 30,
		            stack: '搜索引擎',
		            data:[<?php echo $days[1] ?>, <?php echo $days[2] ?>,<?php echo $days[3] ?>,<?php echo $days[4] ?>,<?php echo $days[5] ?>,<?php echo $days[6] ?>,<?php echo $days[7] ?>]
		        },
		        {
		            name:'新增人数',
		            type:'bar',
		            stack: '搜索引擎',
		            data:[<?php echo $day[1] ?>, <?php echo $day[2] ?>,<?php echo $day[3] ?>,<?php echo $day[4] ?>,<?php echo $day[5] ?>,<?php echo $day[6] ?>,<?php echo $day[7] ?>]
		        }
		      
		    ],color:['#188eee','#FF7F24', 'yellow','blueviolet']          
		});
		             

		});
	
	
	</script>
</body>
</html>