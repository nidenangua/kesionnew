<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>添加排课</title>

<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />


<style>
	.ks-table1 td{color:#888}
	.ks-table-th {padding: 10px 0;}
	.schedule-st {padding:15px 0 ;}
	.schedule-span{font-size: 30px;color:#476dbe;font-style: italic;padding-right: ;}
	.schedule-title{color: #333;font-size: 16px;}
	.inputText{font-size: 14px;border-radius: 5px;color:#333}
	.ks-table1 td{font-size: 14px;}
	.schedule-warnning{color:red;height: 20px;}
	
	/*time*/
	.select-time{ position: relative; }
    .select-time .start-time,
    .select-time .end-time{text-indent: 5px;height: 34px;line-height: 34px;border: 0px;border: 1px solid #e0e0e0;width: 150px;font-size: 14px; padding: 0px;
    background: inherit;padding: 0 10px;box-sizing: border-box;float: left;margin-top: 3px;border-radius: 5px;}
    .select-time .time-text{float:left; line-height: 40px;margin: 0 10px;}
    .select-time-box{width:150px;height:140px;top: 100px; position: absolute; background: #fff; display: none; box-shadow: 0 3px 12px rgba(0,0,0,0.1);z-index: 9;}
     .select-time-box .select-hour,
     .select-time-box .select-minute{float:left;width:50%; padding-top:20px;}
     .select-time-box .select-hour span,
     .select-time-box .select-minute span{display: block;height:64px; line-height: 64px; font-size:24px; text-align: center}
    .select-time-box .i-up,
    .select-time-box .i-down{width:30px;height:15px; cursor: pointer; display: block;margin:0 auto;text-align: center;}
    .select-time-box .i-up{transform: rotate(180deg);position: relative; }
    .select-time-box .i-down{}
    .ks-popup-title{text-align: center;border-bottom: 1px solid #ccc;color:#86A8F1}
    .form-star{top: 0;}
    .class-remind {display: block;position: absolute;}
    .new-form{position: relative;}
    .myform-box {padding-left: 15px;}
    .select-box {position: absolute;padding: 10px; box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);width: 285px;background: #fff;z-index: 99;top: 45px;left: 0;border-radius: 10px;}
	.select-month li{float: left;height: 40px;line-height: 40px;width: 14.2%;color: #333;text-align: center;border-radius: 5px;cursor: pointer;}
	.select-year {text-align: center;}
	.select-month .active{background: #476dbe; color: #fff;}
	.select-year>i{cursor: pointer;}
	.start-input {display: block;width: 100%;height: 100%;line-height: 32px;}
	.new-form{vertical-align: top;}
	.new-span {display: inline-block;margin-right:10px;line-height: 32px;}
	#memberid option{display: none;}
	#memberid .on{display: block;}
</style>
</head>
<body class="ks-wrap" >


  <form  action=" <?php echo M_URL($this->AppName.'/Index','addschedule2','',GP('')); ?>" method="post" id="myform" target="main">
 		<div class="myform-box clearfix">	
 			<div class="myform-left">
		 		<div class="form-row clearfix">
	              		<span class="name"><i class="form-star">*</i>选择排课方式</span>
	              		  <label for="inlineRadio9">
	              			 <input type="radio" id="inlineRadio9" value="0" class="radioInput" name="chargetype" checked="checked">按班级</label>
					     
	              		
	              		<label for="inlineRadio7" class="label-on">
					     	<input type="radio" id="inlineRadio7" value="1" class="radioInput" name="chargetype" checked="">按老师</label>
	              	</div>
			</div>

	 	</div>
	 		
 	
     
 		<div class="myform-box clearfix class" >
 			<div class="myform-left">
 				<div class="form-row fl">
 					<div class="form-row" >
 							<span class="name"><i class="form-star">*</i>班级分类</span>
		 					<select class="w150 inputText mr10"  id="classlevel"  name="classlevel" onchange="selectClassType(this)">
		 						<option value="2">一对一</option>
		 						<option value="1">小班</option>
		 						<option value="0">大班</option>
		 					</select>	
 							<!--<div class="schedule-warnning mt10">老师冲突</div>-->
 					</div>
 					
 				</div>
		
 			</div>
 		<div class="myform-right">	
 			<div class="form-row ml40 fl">
 					<div class="form-row">
 							<span class="name"><i class="form-star">*</i>选择班级</span>
		 					<select class="w150 inputText mr10" id="memberid" name="classid">
		 						<?php foreach($class as $k=>$v){ ?>
								<option value="<?php echo $v['classid'] ?>" class="<?php echo 'classlevel'.$v['classlevel'] ?>"><?php  echo $v['title']; ?></option>
								<?php } ?>
 							</select>					 		
 					</div>
 					
 				</div>
 				
 		</div>
 		
 		
 		</div>
 		
 		<div class="myform-box clearfix teacher" >			
		 		<div class="form-row clearfix">
	              	<span class="name"><i class="form-star">*</i>选择老师</span>
	              	<select class="w150 inputText mr10"  name="teacherid">
	              		<?php foreach($teacher as $k=>$v){ ?>
		 						<option value="<?php echo $v['userid'] ?>"><?php echo  !empty($v['name']) ? $v['name'] : $v['username']; ?></option>
		 				<?php  } ?>		
		 			</select>
		 		
	            </div>
 			
 		</div>
 
 		

 		<div class="myform-box clearfix">
 			
		 	
		 		<div class="form-row clearfix">
	              	<span class="name"><i class="form-star">*</i>排课方式</span>
	              		  <label for="inlineRadio10" class="label-on">
	              			 <input type="radio" id="inlineRadio10" value="0" class="radioInput" name="weektype" checked="checked">按周循环</label>
					     
	              		
	              		<label for="inlineRadio11" >
					     	<input type="radio" id="inlineRadio11" value="1" class="radioInput" name="weektype" >按天排课</label>
	              	</div>
 			
 		</div>
 		<div class="myform-box clearfix week" >
 			
		 	
		 		<div class="form-row clearfix">
	              	<span class="name"><i class="form-star">*</i>排课周期</span>
	              	<div class="new-form w150" onclick="getDate(this)" data-start data-flag="start" ><span class="start-input"><?php echo date('Y-m-d',time()); ?></span>
	              		<div class="startime " ><input type="hidden" name="starttime" value="<?php echo time(); ?>"/></div>
	              	</div>
	              	<span class="new-span">至</span>
	              	<div class="new-form w150" onclick="getDate(this)" data-start data-flag="start" ><span class="start-input"><?php echo date('Y-m-d',time()+(3600*24*7)); ?></span>
	              		<div class="startime " ><input type="hidden" name="endtime" value="<?php echo time()+(3600*24*7); ?>"/></div>
	              	</div>
	              	
		 				
		 				
		 				
	            </div>
 			
 		</div>
 		<div class="myform-box clearfix day" >
 			
		 	
		 		<div class="form-row clearfix ">
	              	<span class="name"><i class="form-star">*</i>排课周期</span>
	              	<div class="new-form class-week fl w150" onclick="getDate(this)" data-start data-flag="start" >
	              		<span class="start-input"><?php echo date('Y-m-d',time()); ?></span>
	              		<div class="startime" ><input type="hidden" name="time[]" id="name3" value="<?php echo time(); ?>"></div>
	              	</div>
	           		
	            </div>
 			
 		</div>
 
 	
 	</div>

</form>
<div class="clearfix ks-popup-footer form-footer" >
			<div class="d-inline-block mt20">
			
				<input type="button" class="ks-bt bt-pue mr10" onclick="do_reg()"  value="确定">
				<input type="button" class="ks-bt bt-white mr10" onclick="closes()" value="取消">
				
						
			</div>
			
</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.config.paths['timePicker'] = '<?php echo UOOT;?>Public/common/js/timePicker.js';
	module.require(['$','backstage','nicescroll','timePicker'],function(){
		
		loadScorllJs();
		//radio tab
		radioTab('.class','.teacher','chargetype');//班级与教师的切换
		radioTab('.week','.day','weektype');
		
		$('input[name="chargetype"]').click(function(){
		radioTab('.class','.teacher','chargetype')
		});
		$('input[name="weektype"]').click(function(){
		radioTab('.week','.day','weektype');
		});
		$('.class-week li').on(function(){
		$(this).after(weekContent)
		});
		//班级分类
		var classSelect = $("#classlevel option:selected").val();
		setClassOptionShow('classlevel'+2)		
	})
		
	
	
	
	
	
	
	var  _startFlag = true;
	var timeStampArr = new Array()
	function do_reg(){
		top.closePopup('all');
		$('#myform').submit();
	
		
	}
	function closes(){

		top.closePopup('all');
	}
	function cancelBubble(){
	  var e = window.event || arguments[0];
	  if ( e && e.stopPropagation ) {   
	      e.stopPropagation();
	  } else {
	      window.event.cancelBubble = true;
	  }
	
	
	}
	
	
	//获取某一个年某一月的第一天的时间戳
	function getStamp(new_year,new_month,new_day){
		var date = new Date(new_year,new_month-1,new_day);
		return date.getTime();
	}
	
	

	function radioTab(classid,teacherid,inputName){
		var radioState =$('input[name='+inputName+']:checked').val();
		
	
		if(radioState == 0) {
			$(classid).show();
			$(teacherid).hide();
		}else if(radioState == 1){
			$(classid).hide();
			$(teacherid).show();
		}
		
	}
	

	
	
	
	function getDate(target){
		
		var radioState =$('input[name=weektype]:checked').val();
		
		if(_startFlag ==true){
		_startFlag = false
		var date = new Date();
		var year = date.getFullYear();
		var month = date.getMonth()+1;
		var day = '';
		date.setMonth(month)
		date.setDate(0)
		var dayNumber = date.getDate();
		for(var i = 1;i<dayNumber+1;i++){
			day+='<li onclick="confirmDay(this)">'+i+'</li>'
		}
		
		var dateWrap = '<div class="select-box">'+
	              				'<div class="select-year">'+
	              					'<i class="fl" style="cursor:pointer;" data-flag = "yearPrev" onclick = "changeDate(this)"><<</i>'+
	              					'<i class="fl ml10" style="cursor:pointer;" data-flag = "monthPrev" onclick = "changeDate(this)"><</i>	'+
	              					'<span id="date-wrap"><em class="year">'+year+'</em>年<em class="month">'+month+'</em>月</span>'+
	              				    '<i class="fr " data-flag = "yearNext" onclick = "changeDate(this)">>></i>'+
	              					'<i class="fr mr10" data-flag = "monthNext" onclick = "changeDate(this)">></i>'+
	              				'</div>'+
	              				'<div class="select-month">'+
	              					'<ul>'+
	   									''+day+''+
	              					'</ul>'+
	              				'</div>'+
	              		'</div>';
	    if(radioState==1){
	    	$(target).find('.startime').html(dateWrap);
	    }else{
	    	$(target).find('.startime').append(dateWrap);
	    }          		
	    
	   }
	}

//	getDate();

	//选中日期
	
	var  _startFlag = true;
	var  _endFlag =true;
	
	
	function confirmDay(target){
		cancelBubble()
		$this = $(target);
		var day =Number($this.html());
		var year = Number($this.parents('.select-box').find('.year').html());
		var month =  Number($this.parents('.select-box').find('.month').html());
		var timeStamp = getStamp(year,month,day);
		timeStamp = timeStamp/1000;
		var i  = $(target).parents('.new-form').index('.new-form');
		var weekContent ='';
		timeStampArr[i] = timeStamp;
		if(timeStampArr.length>=2){
			
			if(timeStampArr[i]<=timeStampArr[i-1]){
			
				Alert('请选择正确时间');
				return false;
			}
			
		}
		
		//每当添加一个时间就添加一个选择时间段
		weekContent +='<div class="new-form class-week fl w150" onclick="getDate(this)" data-start data-flag="start" ><span class="start-input"></span>'
		weekContent +='<div class="startime" ></div>'
		weekContent +=' <input type="hidden" name="time[]" id="name'+i+'" value="'+timeStamp+'"></div>'
		$this.parents('.new-form').find('.select-box').hide();
		$this.parents('.new-form').find('.start-input').html(year+'-'+month+'-'+day);
		$this.parents('.class-week').after(weekContent);
		$this.parents('.new-form').find('input[name="starttime"]').val(timeStamp);
		$this.parents('.new-form').find('input[name="endtime"]').val(timeStamp)
		//判断时间如果超过 7个就增加选择左右切换；
		if(i>=7) {
			
		}	
	
		_startFlag=true;
	}
	//如果有切换月份或者是年份的话 重置天数；
	function resetDay(target){
		let months = $(target).parent().find('.month').html();
		let time = new Date();
		time.setMonth(months);
		time.setDate(0);
		let timeDay = time.getDate();
		var day = '';
		for(var i = 1;i<timeDay+1;i++){
			day+='<li onclick="confirmDay(this)">'+i+'</li>'
		}
		$(target).parent().parent().find('ul').html(day);
	}
	//改变日期
	function changeDate(target){
		cancelBubble()
		var type = $(target).attr('data-flag');
		if(type=="yearPrev"){
			var year = $(target).parent().find('.year').html();
			year--;
			$(target).parent().find('.year').html(year)
			resetDay(target)
		}else if(type =="yearNext"){
			var year = $(target).parent().find('.year').html()
			year++;
			$(target).parent().find('.year').html(year);
			resetDay(target)
		}else if(type =="monthNext"){
			var month = $(target).parent().find('.month').html();
			month++;
			if(month>12){
				var year = $(target).parent().find('.year').html();
				year++;
				$(target).parent().find('.year').html(year);
				month = month-12
			}
			$(target).parent().find('.month').html(month)
			resetDay(target)
		}else if(type =="monthPrev"){
			var month = $(target).parent().find('.month').html();
			month--;
			if(month<=0){
				var year = $(target).parent().find('.year').html();
				year--;
				$(target).parent().find('.year').html(year);
				month = month+12
			}
			$(target).parent().find('.month').html(month)
			resetDay(target)
		}
	}
	



function selectClassType(target){
	
	switch (target.value){
		case "0":
			setClassOptionShow('classlevel'+0);
			break;
		case "1":
			setClassOptionShow('classlevel'+1);
			break;
		case "2":
			setClassOptionShow('classlevel'+2);
			break;
	}
}

function setClassOptionShow(name){
	var _option = $('#memberid').find('option');
	var firstIndex = 0;
	for(var i=0;i<_option.length;i++){
		if(_option[i].className === name){
			firstIndex++;
			_option[i].style.display = 'block';
			if(firstIndex === 1){
				_option[i].selected = true
			}
			
		}else{
			_option[i].style.display = 'none'
		}
	}
}
function close(){
	
	top.closePopup(window.name); 
	
}

</script>

</body>
</html>
