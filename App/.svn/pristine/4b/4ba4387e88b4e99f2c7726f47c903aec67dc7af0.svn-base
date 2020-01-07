<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>招生秀</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<script>
	

</script>
</head>
<body class="ks-wrap">
	

	<div class="ks-wbox bRadius10">
		<!--header-->
			<div class="ks-head-box clearfix">
				<h3 class="ks-head-title ">招生秀</h3>			
			</div>
		
		<!--header-->
		<!--tab-->
			<div class="ks-head-tab">
	 			<ul class="clearfix">
			       <li ><a href="<?php echo M_URL('h5market/Index','scheme','',GP('appid-26'));?>">营销方案</a></li>
					<li ><a href="<?php echo M_URL('h5market/Index','doAddyouxi','',GP('appid-26'));?>">营销工具</a> </li>
					<li class="curr"><a href="<?php echo M_URL('h5market/Index','','',GP('appid-26'));?>">我的活动</a></li>
					<li><a href="<?php echo M_URL('h5market/Index','marketinglist','',GP('appid-26'));?>">营销订单</a></li>
	     		</ul>
     		</div>	
			<!--/tab-->
			<!--widget-->
				<div class="ks-head-widget clearfix">
					
					<div class="fl">
						<div class="ks-search-box">
							
							<!--搜索框组件-->
							<select class="w150 inputText bRadius5 fl" id="keytype" name="type">
								<option value="1" selected="selected">活动名称</option>
								<!--<option value="2" >班主任名称</option>-->
							</select>
							<div class="ks-top-search fl">
								<form target="hidframe" class="fr">
								<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword;?>">
				                
				                <button type="submit" class="ks-head-search"onClick="searchByClass('<?php echo GP('p-'.$now_page); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
				             </form>   
							</div>
							



							<!--搜索框组件-->
	
						</div>					
					</div>
					<div class="fr">
						<ul class="ks-head-choice">
							
								<li>
										<div class="ks-head-el">
										<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
										<div class="ks-head-content ks-head-content-pr" style="width: 360px;">
																							
											<ul class="screen">															
												<li>
												<span>活动状态：</span>
												<div>
													<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('stype-3')); ?>" class="<?php if($stype == 3){ echo 'active';}?>">不限</a>
													<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('stype-1')); ?>" class="<?php if($stype == 1){ echo 'active';}?>">进行中</a>
													<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('stype-2')); ?>" class="<?php if($stype == 2){ echo 'active';}?>">已关闭</a>
												    <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('stype-0')); ?>" class="<?php if($stype == 0){ echo 'active';}?>">未发布</a>
												  
												</div>
												</li>

											</ul>
												
										</div>
									</div>
								</li>
								<li>
									<div class="ks-head-el">
										<a class="ks-heade-button ks-head-primary" type="button"  onclick="frames(this)"  data-url = '<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP("p-$page->now_page")); ?>'><i class="iconfont icon-jiahao"></i>增加活动</a>
									</div>	
								</li>
						</ul>
					</div>
					
					
				</div>
				<!--/widget-->
					
				<!--table-->
					 <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelYouxi','',GP("p-$page->now_page"));  ?>" method="post" id="myform">	
	 	
					<table class="ks-table">
						<thead>
							<tr>
								<th style="width: 30px;">选择</th>
								<th>游戏名称</th>
								<th>活动时间</th>
								<th>截止时间</th>
								<th>成交人数</th>
								<th>网址</th>
								<th>二维码</th>
								<th>获得奖数</th>
								<th>状态</th>								
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;foreach($values as $k=>$v){$i++?>
							<tr>
								<td>
									<?php
									$stat = $v['isstar'];
									if( $stat == 0){
								?>
								<input type="checkbox"  class="select-check fn" value="<?php echo $v['id']?>" name='id[]'>
								<?php } ?>
								</td>
								<td><?php echo $v['name'] ?></td>
								<td><?php echo date('Y-m-d H:i:s',$v['startime']);?></td>
								<td><?php echo date('Y-m-d H:i:s',$v['endtime']);?></td>
								<td><?php echo $v['turnover'] ?></td>
								<td><?php echo 'http://'.APP_DOMAIN.'/h5market/inh5game?h5id='.$v['id'].'&wxid='.$this->wxid; ?></td>
								<td class="ks-head-intro2">
									<div class="H5-infoMarks">
										<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://'.APP_DOMAIN.'/h5market/inh5game?h5id='.$v['id'].'&wxid='.$this->wxid,'L',4,'qrcode');?>" alt="">
										<div class="showcode">
											<img class="dom" src="<?php echo UOOT;?>Public/app/images/regdom.png" alt="" />
											<img  src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://'.APP_DOMAIN.'/h5market/inh5game?h5id='.$v['id'].'&wxid='.$this->wxid,'L',4,'qrcode');?>" alt="" />
										</div>	
									</div>			
								</td>
								<td>
									<a  href="<?php echo M_URL($this->AppName.'/Index','H5userinfo',$v['id'],GP('type-1'));?>">获得奖数：<i><?php echo $v['sign']; ?></i></a>
								</td>
								<td>
									<?php
									if($stat==0)echo "<span class='ks-unaudit'>未开启</span>";
                       	          	if($stat==1)echo "<span class='ks-audit'>开启</span>";
                       	          	if($stat==2)echo "关闭了";
									?>
								</td>
								<td class="ks-head-el">
										 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
											<div class="ks-head-content ks-head-content-pc w100">
												<ul class="opeart">
													<?php if($stat == 0){ ?>		
													<li >
												
									<a href="<?php echo M_URL($this->AppName.'/Index','editgame',$v['id'],GP("h5id-".$v['h5id'])); ?>" type="button">编辑</a>
											
													
													</li>
													<?php } ?>
													<?php if( $stat == 0){ ?>
													<li >
													
								<a onclick="Confirm('是否删除此该游戏？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delYouxi',$v['id'],GP('p-'.$now_page)); ?>')">删除</a>
								
													</li>
													<?php }?>
													<?php if($stat == 1){ ?>
													<li >
														
															<a type="button" class="close"  flag='<?php echo $v['id']; ?>'>关闭</a>
														
													</li>
													<?php }?>
													<?php if($stat == 2){?>
													<li >
												
													<?php if($v['isopen'] == 0 && $v['ismode'] == 3){ ?>
													
														<a type="button" class="open" flag='<?php echo $v['id']; ?>' onclick="">开奖</a>
													<?php }?>
													
													</li>
													<?php } ?>
													<li >
														<a type="button"   onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','Rewardlist',$v['id'],GP(''));?>','930px','610px',{title:'奖励列表',type:'top'});" >奖励</a>
													</li>
													<?php if($stat == 0){ ?>
													<li >
														
										<!--<button type="button" class="ks-bt bt-gray read"onclick="">预览</button>
										<div class="showcode">
											<img class="dom" src="<?php echo UOOT;?>Public/app/images/regdom.png" alt="" />
											<img  src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://'.APP_DOMAIN.'/h5market/ylh5game?h5id='.$v['id'].'&wxid='.$this->wxid,'L',4,'qrcode');?>" alt="" />
										</div>-->
										<a type="button" class=" star" flag='<?php echo $v['id']; ?>'>开启</a>
								
													</li>
														<?php }?>
												</ul>
											</div>
									</td>
							</tr>
							<?php } ?>
			
        		
						</tbody>
						
					</table>
					
					<?php echo Noc($values); ?>
					<!--/table-->	
						
	
	</form>	
					<div class="ks-bom clearfix">
						<span class="fl">
							<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
							<button class="ks-heade-button	" onclick="submitform(1);"><i class="iconfont icon-lajitong"></i></button>
						</span>
						<div class="fr"><?php echo $page->show(3); ?></div>
				</div>

			</div>
<!--结束-->

	



	
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>


<script>
	
	 
	
   module.require(['$','backstage','nicescroll','highcharts'],function(){
   			loadScorllJs();
		   	$('.star').click(function(){
			var key = $(this).attr('flag');
			$.ajax({
				type:"post",
				data:{id:key},
				url:"<?php echo M_URL($this->AppName.'/Index','starH5','',GP(''));?>",
				dataType:'json',
				success:function(data){
					if(data.errcode =='1000'){
						Alert(data.msg);
					}else if(data.errcode =='0'){
						Alert(data.msg,2);
						setTimeout(
							location.reload(),
						5000);
					}
				}
			});
		});
		
		$('.open').click(function(e){
	
			var key = $(this).attr('flag');
			var  contentValue = '正在开奖中....';
			popup.open(false,{
				title:'开奖提示',
				width:['500px','300px'],
				heightAuto:true,
			    content:contentValue
			})
		
		
		$.ajax({
			type:"post",
			data:{id:key},
			url:"<?php echo M_URL($this->AppName.'/Index','openH5','',GP(''));?>",
			dataType:'json',
			success:function(data){
				closePopupBox();
				if(data.errcode =='1000'){
					Alert(data.msg);
				}else if(data.errcode =='0'){
					Alert(data.msg,2);
					
				}
			}
		});
		
		});
   	
   })
   
/*  var chart = { plotBackgroundColor: null,plotBorderWidth: null,plotShadow: false};
	var title = {text: null};      
	var credits = {enabled:false}; 
	var colors = ['#49B3E7','#F5A52A'];
	var tooltip = {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'};
	var plotOptions = {pie: {allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
				enabled: false,
				format: '<b>{point.name}%</b>: {point.percentage:.1f} %',
				style: {
				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
				}
			}
		}
	};
	function creatCavs(contetns,baoban,canyu){
		var series= [{
			type: 'pie',
			name: '转化率占比',
			data: [
				['报班人数',baoban],
				['参与活动人数',canyu]
			]
		}];   
		var json = {};   
		json.chart = chart; 
		json.colors = colors;
		json.title = title;     
		json.tooltip = tooltip;  
		json.series = series;
		json.credits = credits;
		json.plotOptions = plotOptions;
		$("#"+contetns).highcharts(json);  
	}; 
   */
   
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}

function frames(target){
	var url = $(target).attr('data-url');
	location.href = url;
}
</script>
</body>
</html>






