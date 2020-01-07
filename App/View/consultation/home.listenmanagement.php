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


</head>
<body class="ks-wrap">     
	
	
	
	
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
		<div class="fl">
		
			<div class="ks-search-box">
			 	<select class=" inputText bRadius5 mr10 fl" style="width: 100px;" id="keytype">
			     <option value="1">学员姓名</option>
	  	  		</select>   
	  	    <form target="hidframe"  class="fr">
			<div class="ks-top-search fl" >
			<input type="text" class="sc-text sc-mini-pc" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 	
			<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index',ACTION); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
			</div> 
			</form> 

			</div>  
			
		
		</div>
		<div class="fl ks-head-tbox">
			<input type="text" id="selectTime" class="ks-head-input sc-mini-pc ks-head-time w300 ml20" placeholder="<?php if(empty($start)) echo '自定义时间段' ?>"/>
			<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
		</div>
	
			<div class="fr">
				<ul class="ks-head-choice">
					<li>
						<div class="ks-head-el">
							<div class="ks-head-input ks-head-el  ks-head-click w180" onclick="choiceClick(this)">
								<?php if($timetype == 0){ echo '全部';}elseif ($timetype == 1){ echo '今日试听'; }elseif ($timetype == 2){ echo '明日试听'; }elseif ($timetype == 3){ echo '三天内试听'; }elseif ($timetype == 4){ echo '一周内试听'; } ?><?php ?>
								<span class="ks-head-search">
									<i class="icon-taitouxiangxiajiantou iconfont"></i>
								</span>
							</div>
							<div class="ks-head-content ks-head-content-pr w100">	
															
								<ul class="status">															
									<li><a <?php if($timetype==0){echo'class="active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('timetype-0')) ?>">全部</a></li>
			       			 <li><a  <?php if($timetype==1){echo'class="active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('timetype-1')) ?>">今日试听</a></li>
			       			 <li><a  <?php if($timetype==2){echo'class="active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('timetype-2')) ?>">明日试听</a></li>
			       			 <li><a <?php if($timetype==3){echo'class="active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('timetype-3')) ?>">三天内试听</a></li>
			       			 <li><a <?php if($timetype==4){echo'class="active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('timetype-4')) ?>">一周内试听</a></li>
								</ul>

							</div>
											
					</div>
					</li>
					<li>
					<div class="ks-head-el">
						<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
							<div class="ks-head-content ks-head-content-pr w400">
							<ul class="screen">
								<li>
									<span>试听类别：</span>
									<div>
										<a <?php if($classify==0){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('classify-0')) ?>" >不限</a>
										<a <?php if($classify==1){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('classify-1')) ?>" >小班</a>
										<a <?php if($classify==2){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('classify-2')) ?>">一对一</a>
										<a <?php if($classify==3){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('classify-3')) ?>">大班</a>
					
									</div>
								</li>	
							
					
								<li>
									<span>试听校区：</span>
									<div>
									<a href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('address-0')) ?>" <?php if($address==0){echo 'class="choice-active"';}?>>不限</a>
									<?php foreach($schoolary as $k =>$v){?>
									<a href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('address-'.$v['schoolid'])) ?>" <?php if($address==$v['schoolid']){echo 'class="choice-active"';}?> ><?php echo $v['school']?></a>
									<?php }?>
									
					
										
					
									</div>
								</li>	
					           
								
								<li>
									<span>试听状态：</span>
									<div>
										<a <?php if($status==4){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('status-4')) ?>">不限</a>
										<a <?php if($status==0){echo 'class="choice-active"';}?>  href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('status-0')) ?>">未安排</a>
										<a <?php if($status==1){echo 'class="choice-active"';}?>  href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('status-1')) ?>" >已安排</a>
										<a <?php if($status==2){echo 'class="choice-active"';}?>  href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('status-2')) ?>">未上课</a>
										<a <?php if($status==3){echo 'class="choice-active"';}?>  href="<?php  echo M_URL($this->AppName.'/Index','ListenManagement','',GP('status-3')) ?>">已上课</a>
										
									</div>
								</li>		
								
							</ul>
						</div>
					</div>
					</li>
					
				</ul>
			</div>
		
	</div>
	<!--/widget-->
		
	    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','delpart','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" class=" bRadius10 ">
	
	
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
			<thead>
                <tr>
                	<th>选择</th>
                	<th style="text-align: left;">试听课程</th>
                    <th style="text-align: left;">学生姓名</th>
                    <th>联系电话</th>                   
                    <th>试听时间</th>                                       
                    <th>上课地点</th>
                    <th>试听状态</th>                  
                    <th>试听效果</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            	<?php foreach($values as $k=> $v){?>
            	<tr>
            		<td><input type="checkbox" class="select-checks" style="position: relative;top: 4px;" name="id[]" value="<?php echo $v['id'] ?>"></td>
            		  <td style="text-align: left;" class="ks-head-intro2"><?php echo $v['coursename']; ?></td>
	            	 
	            	<td style="text-align: left;" class="ks-head-intro2"><?php echo $v['membername']; ?></td>
	            	  <td><?php echo $v['mobile']; ?></td>
	            	 
	            	
	            	  
	            	  <td><?php if($v['listentime']==0){echo '暂无';}else{ echo date('Y-m-d',$v['listentime']);} ?></td>	       
	            	 
	            	  <td><?php if($v['classroomid']){echo $v['classroomid'];}else{ echo '暂无';} ?></td>
	            	  <td class="c-86A8F"><?php if($v['status']==0){echo '等待安排';}elseif($v['status']==2){echo '未上课';}elseif($v['status']==1){echo '已安排';}elseif($v['status']==3){echo '已上课';} ?></td>
	            	 
	            	  <td><?php if($v['satisfaction']==0){echo '暂无';}elseif($v['satisfaction']==2){echo '一般';}elseif($v['satisfaction']==1){echo '不行';}elseif($v['satisfaction']==3){echo '好';}elseif($v['satisfaction']==4){echo '非常好';}  ?></td>
	            	 
	           
	           			<td class="ks-head-el"  >
							<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
							<div class="ks-head-content ks-head-content-pc">
								<ul class="opeart">
										<?php if($v['status']==0){?>
										<li>									
						 					<a onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','arrange',$v['memberid'],GP('listenid-'.$v['id'].',type-1')) ?>','650px','400px',{title:'安排试听',type:'top'})">安排试听</a>
										</li>
											<?php }else{?>
										<li>
											<a  onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','arrange',$v['memberid'],GP('listenid-'.$v['id'].',type-2')) ?>','850px','600px',{title:'修改试听信息',type:'top'})">编辑</a>
										</li>
										   	<?php }?>
										<li>
											<a  onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','returnvisit',$v['memberid'],GP('')) ?>','850px','600px',{title:'添加回访记录',type:'top'})">回访</a>
										</li>
										<li>
											<a onclick="watch('<?php echo $v["mark"]?>')">试听内容</a>
										</li>
									
										<li>
											<a onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addaudition',$v['id'],GP(''));?>','800px','500px',{title:'添加试听结果',type:'top'})">试听结果</a>
										</li>
										<li>
											<a onclick="Confirm('是否确定加入？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','deleteListen',$v['id'],GP('p-'.$page->now_page)); ?>')">删除</a>
										</li>
											<?php }?> 
								</ul>
							</div>
						</td>
	           
	           
	           
	            </tr>
            
            </tbody>
		</table>
			<?php echo Noc($values)?>
				
			<?php if(!empty($values)){?>
			<div  class="ks-bom clearfix">
				<div class="fl">
					<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
			        <button type="submit" class="ks-heade-button mr10" onclick="submitform()" >批量放弃</button>
				</div>
				<div class="fr">
					<?php echo $page->show(3); ?>
				</div>
			</div>
			<?php }?> 
		</div>
	</form>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
		module.require(['$','backstage','nicescroll','laydate'],function(){
			
			var start = '<?php if($timetype==5){echo date('Y/m/d',$stattime);} ?>';
			var end   = '<?php if($timetype==5){echo date('Y/m/d',$endtime);} ?>';
			if(start && end){
				document.getElementById('selectTime').value = start.match(/[^\s]+/) +' - '+ end.match(/[^\s]+/)
			};
		
			/*time*/
			laydate.render({
			  elem: '#selectTime',
			  format:'yyyy/MM/dd',
			  range: true,
			  done:function(value){
			  	var href = location.href.replace(/,timetype-\d+,starttime-\d+,endtime-\d+/g,'');
			  	if(value){
			  		value = value.split(' - ');
			  		var starttime = new Date(value[0]).getTime()/1000;
			  		var endtime = new Date(value[1]).getTime()/1000;
			  		
			  		location.href = href+',timetype-5,starttime-'+starttime+',endtime-'+endtime;
			  		
				
			  	}else{
			  		location.href = href;
			  	}
			  }
			});
			
			loadScorllJs();
			
		
	
			
		})



function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	



function watch(text){
	
	var contentval ='<div style="min-height:100px;line-height:32px;font-size:14px;text-align:center">'+text+'</div>'
	
	top.popup.open(false,{
		title:"查看试听内容",
		area:["500px","300px"],
	    content:contentval,
	    heightAuto:true
	});
}
	

</script>
</body>
</html>
