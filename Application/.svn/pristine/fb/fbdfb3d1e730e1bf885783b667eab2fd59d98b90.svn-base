<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/index/index.css?t=<?php echo rand(100000,100000000);?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>

</head>
<body class="gray-bg" style="background-color:#f3f3f3;">
<?php if (!checkrule($array)){ ?>
	<div class="data-floor">

		<div class="data-Title">数据统计</div>
		<div class="ul_box">
			<ul class="data-ul clearfix">
				<a href="<?php echo M_URL('Domain','clientList','',GP(''));?>">
					<li>
						<div class="data-box">
							<div class="data-wrap">
								<h4>客户总数</h4>
								<h1>
									<?php echo $clientCount ;?>
								</h1>
								<img src="<?php echo UOOT;?>Public/admin/images/jioashi.png" />
							</div>
						</div>
					</li>
				</a>
				<a href="<?php echo M_URL('Domain','clientList','',GP('outtime-2'));?>">
					<li>
						<div class="data-box" style="background-color:#5bb2ee;">
							<div class="data-wrap">
								<h4>今日跟进数</h4>
								<h1>
									<?php echo $todayfollowCount ;?>
								</h1>
								<img src="<?php echo UOOT;?>Public/admin/images/jioashi.png" />
							</div>
						</div>
					</li>
				</a>
				<a href="<?php echo M_URL('Domain','clientList','',GP('outtime-3'));?>">
					<li><div  class="data-box" style="background-color:#5f91e3;">
							<div class="data-wrap">
								<h4>待跟进数</h4>
								<h1><?php echo $notfollowCount ;?></h1>
								<img src="<?php echo UOOT;?>Public/admin/images/kecheng.png">
							</div>
						</div></li>
				</a>
			</ul>
		</div>
	</div>
<?php }else {?>
	<div class="data-floor">
		<div class="timeType">
			<div class="timeShow">
				<?php if($option==0){echo '今日';}elseif($option==1){echo '本月';}elseif($option==2){echo '本季';}elseif($option==3){echo '本年';}elseif($option==4){echo '全部';}?>
				<img src="<?php echo UOOT;?>Public/app/images/arrow.png">

			</div>
			<ul class="tool-timeType">
				<a href="<?php echo M_URL('Index','mainfirst','',GP('option-0'));?>"><li>今日</li></a>
				<a href="<?php echo M_URL('Index','mainfirst','',GP('option-1'));?>"><li>本月</li></a>
				<a href="<?php echo M_URL('Index','mainfirst','',GP('option-2'));?>"><li>本季</li></a>
				<a href="<?php echo M_URL('Index','mainfirst','',GP('option-3'));?>"><li>本年</li></a>
				<a href="<?php echo M_URL('Index','mainfirst','',GP('option-4'));?>"><li>全部</li></a>
			</ul>

		</div>

		<div class="data-Title">数据统计</div>

		<div class="ul_box">
			<ul class="data-ul clearfix">
				<a href="<?php echo M_URL('Users','','',GP('usertype-3'));?>">
					<li>
						<div class="data-box">
							<div class="data-wrap">
								<h4>学员总数</h4>
								<h1>
									<?php echo $usernum[0]['sum'] ;?>
								</h1>
								<img src="<?php echo UOOT;?>Public/admin/images/jioashi.png" />
							</div>
						</div>
					</li>
				</a>
				<a href="<?php echo M_URL('Users','','',GP('usertype-1'));?>">
					<li>
						<div class="data-box" style="background-color:#5bb2ee;">
							<div class="data-wrap">
								<h4>教师总数</h4>
								<h1>
									<?php echo $teachernum[0]['sum'] ;?>
								</h1>
								<img src="<?php echo UOOT;?>Public/admin/images/jioashi.png" />
							</div>
						</div>
					</li>
				</a>
				<a href="<?php echo M_URL('course/Index','index','',GP('appid-6'));?>">
					<li><div  class="data-box" style="background-color:#5f91e3;">
							<div class="data-wrap">
								<h4>课程总数</h4>
								<h1><?php echo $coursenum[0]['sum'] ;?></h1>
								<img src="<?php echo UOOT;?>Public/admin/images/kecheng.png">
							</div>
						</div></li></a>


				<!--              <a href="<?php echo M_URL('Domain','wxlist','',GP(''));?>">
            <li><div  class="data-box" style="background-color:#81d0aa;">
           		<div class="data-wrap">
                	<h4>机构总数</h4>
                    <h1><?php echo $wxidnum[0]['sum'] ;?></h1>
                    <img src="<?php echo UOOT;?>Public/admin/images/jigou.png">
                </div>
            </div></li></a> -->

				<a href="<?php echo M_URL('order/Index','index','',GP('appid-4'));?>">
					<li><div  class="data-box" style="background-color:#57d2c2;">
							<div class="data-wrap">
								<h4>订单总数</h4>
								<h1><?php echo $ordernum[0]['sum'] ;?></h1>
								<img src="<?php echo UOOT;?>Public/admin/images/dingdan.png">
							</div>
						</div></li></a>
				<a href="<?php echo M_URL('article/Index','index','',GP(''));?>">
					<li><div  class="data-box" style="background-color:#5faee3;">
							<div class="data-wrap">
								<h4>新闻总数</h4>
								<h1><?php echo $newsnum[0]['sum'] ;?></h1>
								<img src="<?php echo UOOT;?>Public/admin/images/xinwen.png">
							</div>
						</div></li></a>

			</ul>
		</div>
	</div>

	<div class="data-floor" style=" background-color:white; padding:20px;">
		<!--<div class="timeType">
		<div class="timeShow">
			本月
			<img src="<?php echo UOOT;?>Public/app/images/arrow.png">

		</div>
		<ul class="tool-timeType">
			<li>本月</li>
		    <li>本季</li>
		    <li>本年</li>
		</ul>
    </div>-->

		<div class="data-Title">机构详情</div>
		<div class="ul_box">
			<ul class="data-ul clearfix">
				<a href="<?php echo M_URL('Domain','wxlist','',GP(''));?>">
					<li>
						<div  class="data-box data-box2">
							<div class="data-wrap">
								<h4>机构总数</h4>
								<h1><?php echo $wxidnum[0]['sum'] ;?></h1>
								<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
							</div>
						</div>
					</li>
				</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP(''));?>">
					<li>
						<div  class="data-box data-box2">
							<div class="data-wrap">
								<h4>网校数量</h4>
								<h1><?php if($wxidnum1[0]['sum']){ echo $wxidnum1[0]['sum'] ;}else{ echo 0;}?></h1>
								<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
							</div>
						</div>
					</li>
				</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP(''));?>">
					<li>
						<div  class="data-box data-box2">
							<div class="data-wrap">
								<h4>机构数量</h4>
								<h1><?php if($wxidnum2[0]['sum']){ echo $wxidnum2[0]['sum'] ;}else{ echo 0;}?></h1>
								<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
							</div>
						</div>
					</li>
				</a>
			</ul>
		</div>
	</div>
	<div class="data-floor" style=" background-color:white; padding:20px;">
		<div class="data-Title">平台收入情况</div>
		<div class="ul_box">
			<ul class="data-ul data-special clearfix">
				<li><div  class="data-box data-box2">
						<div class="data-wrap">

							<h4>付费机构总数 <span class="fr"><?php echo $allcount1 ;?></span></h4>
							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
				<li><div  class="data-box data-box2">
						<div class="data-wrap">

							<h4>交易总额 <span class="fr"><?php echo $lastflag1 ;?></span></h4>
							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
				<li><div  class="data-box data-box2">
						<div class="data-wrap">
							<h4>本月交易额<span class="fr"><?php echo $monthflag1 ;?></h4>

							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
				<li><div  class="data-box data-box2">
						<div class="data-wrap">
							<h4>本周交易额<span class="fr"><?php echo $weekflag1 ;?></h4>
							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
				<li><div  class="data-box data-box2">
						<div class="data-wrap">
							<h4>本日交易额<span class="fr"><?php echo $dayflag1;?></h4>

							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
			</ul>
		</div>
	</div>
	<div class="data-floor" style=" background-color:white; padding:20px;">
		<div class="data-Title">机构交易情况</div>
		<div class="ul_box">
			<ul class="data-ul data-special clearfix">
				<li><div  class="data-box data-box2">
						<div class="data-wrap">

							<h4>付费会员总数 <span class="fr"><?php echo $allcount ;?></span></h4>
							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
				<li><div  class="data-box data-box2">
						<div class="data-wrap">

							<h4>交易总额 <span class="fr"><?php echo $lastflag ;?></span></h4>
							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
				<li><div  class="data-box data-box2">
						<div class="data-wrap">
							<h4>本月交易额<span class="fr"><?php echo $monthflag ;?></h4>

							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
				<li><div  class="data-box data-box2">
						<div class="data-wrap">
							<h4>本周交易额<span class="fr"><?php echo $weekflag ;?></h4>
							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
				<li><div  class="data-box data-box2">
						<div class="data-wrap">
							<h4>本日交易额<span class="fr"><?php echo $dayflag;?></h4>

							<div class="warp-img" ><img src="<?php echo UOOT;?>Public/admin/images/jioashi.png"></div>
						</div>



					</div></li>
			</ul>
		</div>
	</div>


	<div class="data-floor">
		<div class="ctr-top">
			<div class="timeType">
				<div class="timeShow">
					<?php if($option==1){echo '本月';}elseif($option==2){echo '本季';}elseif($option==3){echo '本年';}elseif($option==4){echo '全部';}?>
					<img src="<?php echo UOOT;?>Public/app/images/arrow.png">

				</div>
				<ul class="tool-timeType">
					<a onclick="searchUser(1)"><li>本月</li></a>
					<a onclick="searchUser(2)"><li>本季</li></a>
					<a onclick="searchUser(3)"><li>本年</li></a>
				</ul>
			</div>
			<div class="data-Title" style="float:left;">订单情况</div>
		</div>

		<div style="width:100%; ">
			<div id="main" style=" width:100%;"></div>
		</div>
	</div>

	<div class="data-floor">
		<div class="data-Title">热门应用</div>
		<div class="ul2_box">
			<ul class="flex-container clearfix" id="app-showList">
				<?php foreach($appary as $k =>$v){ ?>
					<li>
						<div class="app-box">
							<img src="<?php echo UOOT.$v['defaultpic'];?>">
						</div>
						<h4><?php echo $v['appname']?></h4>
						<p>（安装总量<?php echo $v['sum']?>）</p>
					</li>
				<?php  }?>
			</ul>

		</div>
	</div>
<?php }?>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/highcharts.js"></script>
<script>
$(".timeType").click(function(){
	console.log(11)
	$(this).find("ul").fadeToggle();	
})
loadScorllJs();//滚轮
</script>
<script type="text/javascript">
	  searchUser(1)
	  function searchUser(k){
      	$.ajax({
      		type:"post",
      		dataType:"json",
      		url:"<?php echo M_URL('Index', 'courseOrder'); ?>"",
      		async:true,
      		data:{
      			'option':k,
      		},
      		success:function(data){
      			var options = {
				  "xAxis": [
				    {
				      "type": "category",
				      "categories":data.time,
				      "index": 0,
				      "isX": true
				    }
				  ],
				  "series": [
				    {
				      "name": "直播课程",
				      "data":data.face,
				      "_colorIndex": 0,
				      "_symbolIndex": 0
				    },
				    {
				      "name": "面授课程",
				      "data":data.live,
				      "_colorIndex": 1,
				      "_symbolIndex": 1
				    },
				    {
				      "name": "点播课程",
				      "data":data.vod,
				      "_colorIndex": 2,
				      "_symbolIndex": 2
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
				    "type": "spline",
				    "width": null
				  },
				  "title": {
				    "text": "",
				    "x": -20
				  },
				  "subtitle": {
				    "text": "",
				    "x": -20
				  },
				  "tooltip": {
				    "valueSuffix": "°C",
				    "enabled": true
				  },
				  "legend": {
				    "layout": "horizontal",
				    "align": "center",
				    "verticalAlign": "top",
				    "y": -30,
				    "enabled": true
				  },
				  "plotOptions": {
				    "series": {
				      "animation": false
				    }
				  },
				   "colors": [
				    "#e91e63",
				    "#76ff03",
				    "#3d5afe",
				    "#f7a35c",
				    "#8085e9",
				    "#f15c80",
				    "#e4d354",
				    "#2b908f",
				    "#f45b5b",
				  ],
				  "zAxis": {
				    "allowDecimals": true
				  },
				  "credits": {
				    "enabled": false
				  },
				  "exporting": {
				    "enabled": false
				  }
				}
				
				var chart = Highcharts.chart('main', options);
				
      		}
      	});
      }

        </script>

</body>
</html>
