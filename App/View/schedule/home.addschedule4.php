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
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.ks-table th, .ks-table td{padding: 25px 10px!important;}
.ks-table{border:0;margin-top: 10px;}
.ks-table th, .ks-table td{border:0;border-bottom: 1px solid #eee;position: relative;width: 12.5%;min-width: 12.5%;}
.ks-table td{height: 100px;}
.ks-table th{border-top:1px solid #eee}
.ks-table th{width: 12.5%;}
.ks-alert {padding:20px;text-align: center;}
.ks-alert button{float: none;}
.class_left{right: 100%!important;}
.class_top{top: -170px!important;}
.class-active{color:#86A8F1!important}
.ks-course-content ul{padding-left: 135px;}
.ks-course-content li:first-child{border-left: 1px solid #eee;}
.ks-table th{min-width:auto ;}
.ks-course-list > span {width: auto;display: block;}
.ks-course-list {width: 150px;padding-bottom: 15px;}
</style>
</head>
<body class="ks-wrap">

<div id="ksBoxHead">
	<!--结束-->
	<div class="Header-tool clearfix">
		<div class="Tool-Title">
		<!--图像-->
		
		<!--图像-->
		<!--标题-->
		<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>排课管理</a><span>/</span>新增排课 </p>
		<!--标题-->
		</div>
		<!--操作范围-->
	
		<!--菜单-->
	   
			</div>
		<!--菜单-->
		<!--操作范围-->
	</div>
	

	<div >
		<div class="ks-clist  mt20">
				<ul class="clearfix">
			<?php if($chargetype==0){ ?>		
				<li>
            	<div class="ks-cbox clearfix">		
					<div class="fl ks-txtLeft" style="width: 100%;">
						<h3 class="ks-first"><?php echo $class['title']; ?></h3>
						<p>
							<span class="ml50">排课方式：<?php if($weektype==0){echo '按周循环';}else{ echo '按天排课';} ?></span>
							<span>排课时间：<?php foreach($times as $k=>$v){ echo date('Y-m-d',$v).' &nbsp'; } ?></span>
							
				
						</p>
					</div>
				</div>
		        </li>
		        <?php }else{ ?>
		        <li>
	            	<div class="ks-cbox clearfix">		
						<div class="fl ks-txtLeft" style="width: 100%;">
							<h3 class="ks-first"><?php echo !empty($teacher['name']) ? $teacher['name'] : $teacher['username'] ; ?></h3>
							<p>
								<span class="ml50">排课方式：<?php if($weektype==0){echo '按周循环';}else{ echo '按天排课';} ?></span>
								<span>排课时间： 
								         <?php foreach($times as $k=>$v){ echo date('Y-m-d',$v).' &nbsp '; } ?>
								         	  
								         		
								  </span>
								
					
							</p>
						</div>
					</div>
		        </li>
		        <?php } ?>	
				</ul>
			</div>
		<div class="ks-wbox mt20 bRadius10">
			<div class="  clearfix">
			
	</div>
	
		<table width="100%" border="1" cellpadding="2" cellspacing="2" class="ks-table"> 
		   <thead>
		   	<tr class="weekday"> 
		   		<th style="width:10% ;">时间</th>
		   		<?php foreach($times as $k=>$v){ ?>
		   		<th style="width:10% ;" class="weekactive" data-day="1"> <?php echo weekdays($v); ?> <br/>  <?php echo date('Y-m-d',$v); ?></th>
		   		<?php } ?>
		   		
		   	</tr>
		   	
		   </thead>
		  <tbody>
		  	<tr class="weektime">
		  		<td data-time="1">上午</td>
		  		<?php foreach($times as $k=>$v){ ?>
		  		<td  class="weekactive" data-day="<?php echo $k+1 ?>" id="a<?php echo $k+1 ?>"></td>
		  		<?php } ?>
		  	</tr>
		  	<tr class="weektime">
		  		<td data-time="2">下午</td>
		  		<?php foreach($times as $k=>$v){ ?>
		  		<td  class="weekactive" data-day="<?php echo $k+1 ?>" id="b<?php echo $k+1 ?>"></td>
		  		<?php } ?>
		  		
		  	</tr>
		  	<tr class="weektime">
		  		<td data-time="3">晚上</td>
		  		<?php foreach($times as $k=>$v){ ?>
		  		<td  class="weekactive" data-day="<?php echo $k+1 ?>" id="c<?php echo $k+1 ?>"></td>
		  		<?php } ?>
		  		
		  	</tr>
		
		  
		  </tbody>
		</table>
		
		</div>
		
		
	</div>
	<div id="ksBoxFooter">
		<div class="form-footer clearfix">
			<span class="d-inline-block">
		        <button type="button" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschedule','',GP(''));?>','850','600px',{title:'新增排课',type:'top'});" class="ks-bt bt-pue">继续排课</button>
		        <button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-white">返回</button>
	    	</span>
		</div>
</body>

<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>   
<script>
			$('.weektime').find('.weekactive').hover(function(){
		var courseLenght = $(this).find('.ks-course-list').length;
		/*console.log(courseLenght)*/
	        if(courseLenght==0){
        		var creaseStr= '';
				creaseStr +='<div class="ks-course-adc"><input type="button" class="ks-bt bt-pue mr10"';
				creaseStr +='value="添加课表" data-time="week" '+ 'onclick="increaseClass(this)"></div>';
				$(this).append(creaseStr)
				$(this).find(".ks-course-adc").fadeIn(); 
	        };
	    
	
	},function(){
		$(this).find(".ks-course-adc").fadeOut();
		$(this).find(".ks-course-adc").remove();
	});
	
	
function increaseClass(obj){
		
		var dayPm =$('.ks-course-adc').parent().siblings().attr('data-time');	//中午/上午/晚上
		var nowDay = $('.ks-course-adc').parent().attr('data-day');//当天;
		var parentTdIndex = $(obj).parents('td').index()-1;
		
	    <?php if($chargetype==0){ ?>
	     	addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschedule3','',GP('classid-'.$classid.',chargetype-'.$chargetype.',weektype-'.$weektype.',time-'.$time.',classlevel-'.$classlevel));?>,nowday-'+nowDay+',dayPm-'+dayPm,'800px','500px',{title:'增加课表',type:'top'})
	   <?php   }else{  ?>
	     	addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschedule3','',GP('teacherid-'.$teacherid.',chargetype-'.$chargetype.',weektype-'.$weektype.',time-'.$time));?>,nowday-'+nowDay+',dayPm-'+dayPm,'800px','500px',{title:'增加课表',type:'top'})
	    <?php  } ?>
		
	}

</script>
</html>
