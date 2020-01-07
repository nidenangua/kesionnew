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
.ks-course-list {width: 150px;}
</style>
</head>
<body class="ks-wrap">
	


	<div>
		<div class="bRadius10 ks-wbox ">
			<div class="ks-head-nav ks-head-only-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">排课管理</a><span> <em>/</em> 新增排课
			<!--标题-->
		</span></div>
			
				<ul class="clearfix">
			<?php if($chargetype==0){ ?>		
				<li>
            	<div class="ks-cbox clearfix">		
					<div class="fl ks-txtLeft" style="width: 100%;">
						<h3 class="ks-first"><?php echo $class['title']; ?></h3>
						<p>
							<span class="ml50">排课方式：<?php if($weektype==0){echo '按周循环';}else{ echo '按天排课';} ?></span>
							<span>排课周期：<?php echo date('Y-m-d',$starttime); ?>~<?php echo date('Y-m-d',$endtime); ?></span>
							<a class="c-86A8F" href="">累计<?php echo max($week); ?>周</a>
				
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
								<span>排课周期：<?php echo date('Y-m-d',$starttime); ?>~<?php echo date('Y-m-d',$endtime); ?></span>
								<a class="c-86A8F" href="">累计<?php echo max($week); ?>周</a>
					
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
		   		<th style="width:10% ;" class="weekactive" data-day="1">星期一</th>
		   		<th style="width:10% ;" class="weekactive" data-day="2">星期二</th>
		   		<th style="width:10% ;" class="weekactive" data-day="3">星期三</th>
		   		<th style="width:10% ;" class="weekactive" data-day="4">星期四</th>
		   		<th style="width:10% ;" class="weekactive" data-day="5">星期五</th>
		   		<th style="width:10% ;"class="weekactive " data-day="6">星期六</th>
		   		<th style="width:10% ;" class="weekactive " data-day="7">星期日</th>
		   	</tr>
		   	
		   </thead>
		  <tbody>
		  	<tr class="weektime">
		  		<td data-time="1">上午</td>
		  		<td  class="weekactive" data-day="1" id="a1">
		  			  	
		  			
		  		</td>
		  		<td  class="weekactive" data-day="2" id="a2">
		  			  	
		  			
		  		</td>
		  		<td  class="weekactive" data-day="3" id="a3"></td>
		  		<td  class="weekactive" data-day="4" id="a4"></td>
		  		<td  class="weekactive" data-day="5" id="a5"></td>
		  		<td  class="weekactive" data-day="6" id="a6"></td>
		  		<td  class="weekactive" data-day="7" id="a7"></td>
		  	</tr>
		  	<tr class="weektime">
		  		<td data-time="2">下午</td>
		  		<td  class="weekactive" data-day="1" id="b1"></td>
		  		<td  class="weekactive"data-day="2" id="b2"></td>
		  		<td  class="weekactive"data-day="3" id="b3">
		  			
		  		</td>
		  		<td  class="weekactive" data-day="4" id="b4"></td>
		  		<td  class="weekactive" data-day="5" id="b5"></td>
		  		<td  class="weekactive" data-day="6" id="b6"></td>
		  		<td  class="weekactive" data-day="7" id="b7"></td>
		  			
		  		</td>
		  	</tr>
		  	<tr class="weektime">
		  		<td data-time="3">晚上</td>
		  		<td  class="weekactive" data-day="1" id="c1"></td>
		  		<td  class="weekactive" data-day="2" id="c2"></td>
		  		<td  class="weekactive" data-day="3" id="c3"></td>
		  		<td  class="weekactive" data-day="4" id="c4"></td>
		  		<td  class="weekactive" data-day="5" id="c5"></td>
		  		<td  class="weekactive" data-day="6" id="c6"></td>
		  		<td  class="weekactive" data-day="7" id="c7"></td>
		  	</tr>
		
		  
		  </tbody>
		</table>
		<div class="form-footer clearfix">
			<span class="d-inline-block">
		        <button type="button" onclick="addTypeChange('<?php echo M_URL('Setting','addresolution');?>','850','600px',{title:'新增排课',type:'top'});" class="ks-bt bt-pue">继续排课</button>
		        <button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-white">返回</button>
	    	</span>
		</div>
		</div>
		
		
	</div>
	
		
</body>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
		$('.weektime').find('.weekactive').hover(function(){
			var courseLenght = $(this).find('.ks-course-list').length;
			
		        if(courseLenght==0){
	        		var creaseStr= '';
					creaseStr +='<div class="ks-course-adc"><input type="button" class="ks-bt bt-pue mr10"';
					creaseStr +='value="添加课表" data-time="week" '+ 'onclick="increaseClass(this)"></div>';
					$(this).append(creaseStr)
					$(this).find(".ks-course-adc").fadeIn(); 
		        }
		},function(){
			$(this).find(".ks-course-adc").fadeOut();
			$(this).find(".ks-course-adc").remove();
		});
	})	
	
	
	
	function increaseClass(obj){
		
		var dayPm =$('.ks-course-adc').parent().siblings().attr('data-time');	//中午/上午/晚上
		
		var nowDay = $('.ks-course-adc').parent().attr('data-day');//当天;
	
		var parentTdIndex = $(obj).parents('td').index()-1;
		
		 <?php if($chargetype==0){   ?>
	     	addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschedule3','',GP('classid-'.$classid.',chargetype-'.$chargetype.',weektype-'.$weektype.',time-'.$time.',classlevel-'.$classlevel));?>,nowday-'+nowDay+',dayPm-'+dayPm,'800px','500px',{title:'增加课表',type:'top'})
	   <?php   }else{  ?>
	     	addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschedule3','',GP('teacherid-'.$teacherid.',chargetype-'.$chargetype.',weektype-'.$weektype.',time-'.$time));?>,nowday-'+nowDay+',dayPm-'+dayPm,'800px','500px',{title:'增加课表',type:'top'})
	    <?php  } ?>
		
		//插入内容 显示；
		/*$.ajax({
			type:'POST';
			ur;"<?php echo M_URL($this->AppName.'/Ajax','getschedule',$this->classid,GP('')) ?>";
		
			success:function(text){
				var content = JSON.parse(text)
				for(var i=0; i<content.length;i++){
				   var htmlStr ='';//默认移入显示块
		 	 	   var htmlContent='';//移入详细内容 
		 	 	  
		 	 	   htmlStr ='<div class="ks-course-list" id="i'+dataClass[i].id+'"><span id="q'+dataClass[i].id+'">'+ classTime +'</span><span>'+className +'</span></div>';
		 	 	   htmlContent+='<div class="ks-course-tb" style="display:none"> <div class="ks-course-ut clearfix"><div class="ks-course-uleft fl"> ';
		 	 	   htmlContent+='<p class="ks-course-time">上课时间</p><p class="ks-course-times">'+classTime+'</p></div>';
		 	 	   htmlContent+='<div class="ks-course-uright fr"><p class="ks-course-time">授课类型</p><p class="ks-course-times">'+classNumber+'</p></div></div>';
		 	 	   		 	 	    htmlContent+= '<div class="ks-course-ut "><p class="ks-course-time">学生</p><p class="ks-course-times">'+className+'</p></div>' ;	
		 	 	   		 	 	   htmlContent+='<div class="ks-course-ut "><p class="ks-course-time">主题名称</p><p class="ks-course-times">'+classTitle+'</p>	</div>';
		 	 	   htmlContent+='<div class="ks-course-ut "><div class="fl "><input  type="button" class="ks-bt bt-pue mr10"onclick="editSchdeule(this,'+dataClass[i].id+')" value="编辑">';
				   htmlContent+='<input type="button" class="ks-bt bt-pue mr10" value="删除" onclick="classDelete('+dataClass[i].id+')"></div></div>';			
				   htmlContent+='<div class="ks-course-ut "><input type="button" class="ks-bt bt-pue mr10 bt-pue-wp" value="增加时间段" onclick="addClassSch(this)"></div>';		
		 	 	   htmlContent+= '</div>';


					
				}
				
			}
		})*/
	   	
		
	}

	
//增加时间段
	function addClassSch(obj){
	 
		
		var nowDay = $(obj).parents('td').attr('data-day');
		var dayPm = $(obj).parents('tr').children("td").eq(0).attr("data-time");
	    var parentTdIndex = $(obj).parents('td').index()-1;
	
		
		 <?php if($chargetype==0){   ?>
	     	addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschedule3','',GP('classid-'.$classid.',chargetype-'.$chargetype.',weektype-'.$weektype.',time-'.$time.',classlevel-'.$classlevel));?>,nowday-'+nowDay+',dayPm-'+dayPm,'800px','500px',{title:'增加课表',type:'top'})
	   <?php   }else{  ?>
	     	addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschedule3','',GP('teacherid-'.$teacherid.',chargetype-'.$chargetype.',weektype-'.$weektype.',time-'.$time));?>,nowday-'+nowDay+',dayPm-'+dayPm,'800px','500px',{title:'增加课表',type:'top'})
	    <?php  } ?>
		
		

	}	
	



	
//是否删除课表
function classDelete(id){
	top.popup.confirm('是否删除当前课表',{
		determine:function(){
			$.post('<?php echo M_URL($this->AppName.'/Ajax','delschedule','',GP('')) ?>',{scheduleid:id},function(text){
				var result = JSON.parse(text);//json转换成对象
	 	        if(result.result == 'success'){
	 	       	  Alert('删除成功','success');
	 	       	  $('#i'+id).remove();
	 	       	 
	 	       }
			})
		}
	})
}

	
	
	

</script>

</html>
