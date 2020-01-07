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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>

</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		
		 <!--header-->
		 <div class="ks-head-box">
	 		<h3 class="ks-head-title2">教师结算
	 		</h3>
		 </div>
		 <!--header-->

		
			<!--tab-->
     	<div class="ks-head-tab">
 			<ul class="clearfix">
 				<li class="<?php  if($type==1){echo 'curr';} ?>"><a href="<?php echo M_URL($this->AppName.'/Index','courseclosing',$teacherid,GP('type-1'));  ?>">主讲</a></li>
			       			 <li class="<?php  if($type==2){echo 'curr';} ?>"><a href="<?php echo M_URL($this->AppName.'/Index','courseclosing',$teacherid,GP('type-2'));  ?>">助教</a></li>
 			</ul>
     	</div>
     	<!--/tab-->
		
		<!--widget-->
					<div class="ks-head-widget clearfix">
						<h3 class="fl ks-head-h"><?php echo !empty($teacher['name']) ? $teacher['name'] : $teacher['username'] ?></h3>
						
						<div class="ks-search-box fl">
							
							<!--搜索框组件-->
								<select class="w150 inputText mr10" id="classid">
		              			  <option value="0">不限</option>
			 						<?php foreach($class as $k=>$v){ ?>
										<option value="<?php echo $v['classid']; ?>" class="<?php echo 'classlevel'.$v['classlevel']; ?>"><?php  echo $v['title']; ?></option>
									<?php } ?>
		 					</select>	
		
						</div>					
					
						<div class="col-3">
							<input type="text" id="test6" class="ks-head-input ml30" placeholder="时间"/>
						</div>	
						
					
						
					</div>
					<!--/widget-->

		  	<table width="100%" class="ks-table ">
		  		<thead>
	                <tr>
	                	<th style="width: 30px;"><input type="checkbox" class="select-checks selectAll"></th>
	                    <th>上课时间</th>
	                    <th style="text-align: left;">主题名称</th>
	                    <th style="text-align: left;">班级</th>
	                    <th>费用(RMB)</th>
	                    <th>上课类型</th>
	                    <th>操作</th>
	                </tr>
            	</thead>
            	<tbody>
                    	<?php foreach($values as $k=>$v){  ?>
            		<tr>
            			  <?php if($v['status']==2){ ?>
		            	  <td><input type="checkbox" class="select-checks form-in" name="scheduleid[]" value="<?php echo $v['id']; ?>"></td>
		            	  <?php  }else{ ?>
		            	  	<td><input type="checkbox" class="select-checks form-in"></td>
		            	  	<?php } ?>
		            	  <td><?php echo date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']); ?></td>
		            	  <td style="text-align: left;"><?php  echo Field($v['title']);  ?></td>
		            	  
		            	  <td style="text-align: left;"><?php echo  Field($v['classname']); ?></td>
		            	  <td><?php echo Field($v['Money']); ?></td>
		            	
		            	  <td><?php  echo Field($v['type']);  ?></td>
		            	  <?php if($v['isSettlement']==0){ ?>
		            	  <td>
		            	  	<a href="<?php echo M_URL($this->AppName.'/Index','teachersettlement',$v['scheduleid'],GP('teacherid-'.$teacherid.',money-'.$v['Money'])); ?>" class="c-86A8F">结算</a>
		            	  </td>
		            	  <?php }else{ ?>
		            	  	<td>已结算</td>
		            	  <?php } ?>	
            		</tr>
            	   <?php } ?>	
            		
         
            	</tbody>
            
		  	</table>
		<?php echo NoC($values);?>
	
		<?php if (!empty($values)) {;?>
		<div class="ks-bom clearfix">
				<span class="fl">
					<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
					<button class="fr ks-heade-button mr10" type="submit" name="batch" value="1">批量删除</button>
				
				</span>
	
			</div>
		 
		</div>
		<?php } ?>	
		
		
	</div>

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll','laydate'],function(){
	
		//time
		laydate.render({
		  elem: '#test6'
		  ,range: true
		});
		
		loadScorllJs()
		
	});
</script>
</body>
</html>
