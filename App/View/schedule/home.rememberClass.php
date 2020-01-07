<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>记上课</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

<style>
	.select-box {position: absolute;padding: 10px; box-shadow: 0  0  10px 1px rgba(0,0,0,.15) ;width: 200px;background: #fff;z-index: 99;top: 45px;left: 0;border-radius: 10px;}
	.select-month li{float: left;height: 50px;line-height: 50px;width: 25%;color: #333;text-align: center;border-radius: 5px;cursor: pointer;}
	.select-year {text-align: center;}
	.select-month .active{background: #476dbe; color: #fff;}
	.start-input{display: block;height: 100%;width: 100%;line-height: 36px;}
	.new-form {position: relative;}
	.schedule-time {overflow: hidden;border-bottom: 1px solid #eee;padding-bottom: 20px;}
	.schedule-time li {display: inline-block;height: 28px;line-height: 28px;width: 40px;text-align: center;border:1px solid #ccc;margin:10px 20px 0 20px;}
	.schedule-time .on {color: #476dbe;border:1px solid #476dbe}
	.job-mtb .active a{color: #fff;}
</style>
</head>
<body class="ks-wrap">

		<div class="ks-wbox bRadius10">
			
			 <!--header-->
		     <div class="ks-head-box">
		     		<h3 class="ks-head-title2">记上课</h3>
		     </div>
			 <!--header-->
			 <!--tab-->
		     	<div class="ks-head-tab">
	     			<ul class="clearfix">
	     					<?php include  CURR_VIEW_PATH . "top.php";?>
	     					 
	     			</ul>
		     	</div>
			<!--/tab-->     
			
			
			<!--widget-->
			<div class="ks-head-widget clearfix">
					<div class="fl mr20">
						<select class="w150 inputText" id="classid" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','rememberClass'); ?>','classid','<?php echo URL_MODEL;?>')">
								<option value="0">选择班级</option>
		 						<?php foreach($class as $k=>$v){ ?>
									<option value="<?php echo $v['classid']; ?>" class="<?php echo 'classlevel'.$v['classlevel']; ?>"
									<?php if($classid== $v['classid']){ echo 'selected=selected'; }  ?>><?php  echo $v['title']; ?></option>
								<?php } ?>
		 				</select>	
					</div>
					<div class="fl ks-head-tbox">
						<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','rememberClass','',GP('p-'.$page->now_page.',timetype-5'));  ?>" method="post" id="myform2">
<!--						
							<input id="start" type="hidden" value="<?php if($timetype==5){echo $start;} ?>" name="starttime"/>
							<input id="end" type="hidden" value="<?php if($timetype==5){echo $end;} ?>" name="endtime"/>
						    -->
							<input type="text" id="selectTime" class="ks-head-input sc-mini-pc ks-head-time w300" placeholder="<?php if(isset($Data001['starttime'])&&!empty($Data001['starttime'])){echo date('Y/m/d',$Data001['starttime']).'--'.date('Y/m/d',$Data001['endtime']);}else{echo '自定义时间段';}?>"/>
							<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
						</form>			
					</div>
					<div class="fr">
						<ul class="ks-head-choice">
							<li>
<div class="ks-head-el">
		<div class="ks-head-input ks-head-el  ks-head-click w180" onclick="choiceClick(this)">
			<?php if($timetype == 1){ ?>今日上课
			<?php }else if($timetype == 2){ ?>昨日上课
			<?php }else if($timetype == 4){ ?>全部															
			<?php }?>
			<span class="ks-head-search">
			<i class="icon-taitouxiangxiajiantou iconfont"></i></span>
		</div>
		<div class="ks-head-content ks-head-content-pr w100">	
			<ul class="status">															
				 <li class="<?php  if($timetype==4){echo 'active';} ?>"><a href="<?php echo M_URL($this->AppName.'/Index','rememberClass','',GP('timetype-4'));  ?>">全部</a></li>
 <li class="<?php  if($timetype==1){echo 'active';} ?>"><a href="<?php echo M_URL($this->AppName.'/Index','rememberClass','',GP('timetype-1'));  ?>">今天上课</a></li>
 <li class="<?php  if($timetype==2){echo 'active';} ?>"><a href="<?php echo M_URL($this->AppName.'/Index','rememberClass','',GP('timetype-2'));  ?>">昨日上课</a></li>
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
												<span>选择老师：</span>
												<div>
													<a href="javascript:filter(0,'teacherid')"<?php if(!$teacherid){echo ' class="choice-active"';} ?>>不限</a>
													
													<?php foreach($teachers as $k=>$v){ ?>
													<a href="javascript:filter(<?php echo $v['userid']; ?>,'teacherid')"<?php if($teacherid==$v['userid']){echo ' class="choice-active"';} ?>><?php echo !empty($v['name']) ?  $v['name'] : $v['username']; ?></a>
													
										 			<?php } ?>	
													
												</div>
											</li>	
											<li>
												<span>班级类型：</span>
												<div>
													<a<?php if($classlevel!=0&&$classlevel!=1&&$classlevel!=2){echo ' class="choice-active"';} ?> href="javascript:selectClassType(3);">不限</a>
													<a<?php if($classlevel == 2){echo ' class="choice-active"';} ?> href="javascript:selectClassType(2);">一对一</a>
													<a<?php if($classlevel == 1){echo ' class="choice-active"';} ?> href="javascript:selectClassType(1);">小班</a>
													<a<?php if($classlevel == 0){echo ' class="choice-active"';} ?> href="javascript:selectClassType(0);">大班</a>
													
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
		  	<table width="100%" class="ks-table mt20">
		  		<form method="post" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','dorememberbatch','',GP("")); ?>">
		  		<thead>
	                <tr>
	                	<th tyle="width: 30px;"><input type="checkbox" class="select-checks selectAll"></th>
	                    <th>上课时间</th>
	                    <th>主题名称</th>
	                    <th>签到时间</th>
	                    <th>班级</th>
	                    <th>教师</th>
	                    <th>助教</th>
	                    <th>状态</th>
	                    <th>上课类型</th>
	                    <th>操作</th>
	                </tr>
            	</thead>
            	<tbody>
            		<?php foreach($values as $k=>$v){ ?>
            		<tr>
		            	  <td><input type="checkbox" class="select-checks form-in" name="scheduleid[]" value="<?php echo $v['id']; ?>"></td>
		            	  <td><?php echo date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']); ?></td>
		            	    <td><?php  echo Field($v['title']);  ?></td>
		            	    <td><?php  if(!empty($v['adddate'])){echo date('Y-m-d H:i:s',$v['adddate']);}else{ echo '--';};  ?></td>
		            	  <td class="small-txt"><?php  echo  Field($v['classname']); ?></td>
		            	  <td><?php  echo Field($v['name']);  ?></td>
		            	  <td><?php  echo Field($v['assisant']);  ?></td>
		            	  
		            	  <td><?php if($v['status']==0){echo '未上课';}elseif($v['status']==1){ echo '已签到';} ?></td>
		            	  <td><?php  echo Field($v['type']);  ?></td>
		            	  <td><a href="<?php echo  M_URL($this->AppName.'/Index','dorememberClass',$v['scheduleid'],GP('')); ?>" >记上课</a></td>
		            	  
            		</tr>
            	   <?php } ?>		
            	</tbody>
            	</form>
		  	</table>
		<?php echo NoC($values);?>
		<?php if(!empty($values)){?>	
		<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
				<button class="fr ks-heade-button ml10"  onclick="do_reg()">批量结算</button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		  <?php } ?>	
		
		</div>
		
	</div>

		

	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll','laydate'],function(){
			loadScorllJs();
			/*time*/
			filterByTime();
			
			setClassOptionShow('classlevel'+<?php echo $classlevel; ?>,'#classid');
			
		})	
			var  _startFlag = true;
			var  _endFlag =true;
			//阻止向上冒泡
			function cancelBubble(){
			  var e = window.event || arguments[0];
			  if ( e && e.stopPropagation ) {   
			      e.stopPropagation();
			  } else {
			      window.event.cancelBubble = true;
			  }
			
			
			}
			
			//获取某一个年某一月的第一天的时间戳
			function firstDay(new_year,new_month){
				var date = new Date(new_year,new_month,1);
				return date.valueOf();
			}
			
			
			
			//时间框
			function selectTime (target){
				
				
				//判断前者有没有时间选择框 有的话 关闭前者
				$this = $(target);
				var _type = $this.attr('data-flag');
				if(_type=="start"){
					if(_startFlag){
					var sumorder = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
					var timeContent='';
					var nowTime = new Date();
					var nowMouth =nowTime.getMonth()+1;
					var nowYear =  nowTime.getFullYear();
					
					
					timeContent += '<div class="select-box" >';
					timeContent += '<div class="select-year"><i class="icon-weibiaoti40 fl iconfont prev-click" style="cursor:pointer;display:none;transform: rotate(180deg)" data-click="prev" onclick="changeYear(this)" ></i><span id="year">'+nowYear+'</span><i class="icon-weibiaoti40 fr iconfont" style="cursor:pointer" data-click="next" onclick="changeYear(this)"></i></div>';
					timeContent += '<div class="select-month"><ul>';
					//var len     = ;
					for(var i=0;i<sumorder.length;i++){
						timeContent += '<li onclick="checkedMonth(this)"  data-month="'+(i+1)+'">'+sumorder[i]+'</li>';
					}
					timeContent += '</ul></div>';
					timeContent += '</div>';
				
					$('.startime').html(timeContent);
					_startFlag= false;
					
					
				}
					
					
				} else {
					
					if(_endFlag){
					var sumorder = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
					var timeContent='';
					var nowTime = new Date();
					var nowYear =  nowTime.getFullYear();
					timeContent += '<div class="select-box">';
					timeContent += '<div class="select-year"><i class="icon-weibiaoti40 fl iconfont prev-click" style="cursor:pointer;display:none;transform: rotate(180deg);" data-click="prev" onclick="changeYear(this)" ></i><span id="year">'+nowYear+'</span><i class="icon-weibiaoti40 fr iconfont" style="cursor:pointer" data-click="next" onclick="changeYear(this)"></i></div>';
					timeContent += '<div class="select-month"><ul>';
					//var len     = ;
					for(var i=0;i<sumorder.length;i++){
						timeContent += '<li onclick="checkedMonth(this)"  data-month="'+(i+1)+'">'+sumorder[i]+'</li>';
					}
					timeContent += '</ul></div>';
					timeContent += '</div>';
				
					$('.timend').html(timeContent);
					_endFlag= false;
					
				}
				}
				
				
				
				
			}
			//左右切换年份
			function changeYear(target){
			
				var $this = $(target);
				var type = $this.attr('data-click');
				var YearNum = Number($this.parent().find('span').html());
				var nowTime = new Date();
				
				var nowYear =  nowTime.getFullYear();
				if(type=="next"){
					YearNum++;
					if($this.parent().find('.prev-click').css("display")=="none"){
						$('.prev-click').show();
					}
				}else if(type=="prev"){
					YearNum--;
					
					if(nowYear==YearNum){
						$('.prev-click').hide();
					}
				}
				$this.parent().find('span').html(YearNum)
				
			}
		
			function checkedMonth(target){
					
				cancelBubble()	
				var $this = $(target);
				$this.addClass('active').siblings().removeClass('active');
				var uploadYear = Number($this.parents('.select-box').find('span').html());
				var nowTime = new Date();
				var nowMouth =nowTime.getMonth()+1;
				var stamp = <?php echo time(); ?>;
				var endTime = <?php echo time(); ?>;
				//如果初始时间一样的话 
				var uploadMonth  = $this.attr('data-month');
				//请求
				
				var yearVal  =  $this.parents('.select-box').find('#year').html();
				var mouthVal =  $this.attr('data-month');	
			    var _type  =$this.parents('.new-form').attr('data-flag');
			  	var uploadMonth  = $this.attr('data-month');
					
					
			   
			   
				if(_type =='start'){
					
				  	$this.parents('.new-form').find('.start-input').html(yearVal+'-'+mouthVal);
				  	
				  	window.location.href='<?php echo M_URL($this->AppName.'/Index','schedulelist','',GP('')) ?>,date-'+yearVal+'-'+mouthVal+'';
//				  	stamp = firstDay(uploadYear,uploadMonth);
//					stamp =Number(stamp)/1000;
					
					
					
					
					_startFlag =true;
					
				}
				else{
					$this.parents('.new-form').find('.end-input').html(yearVal+'-'+mouthVal);
					var endTime = firstDay(uploadYear,uploadMonth);
					endTime =Number(endTime)/1000
					_endFlag =true;
					//差值
					if(stamp!=0&&endTime!=0){
						
							var startNumber =$('.start-input').html().split('-');//开始时间
							var endNumber =$('.end-input').html().split('-');//开始时间
							var startmouth=Number(startNumber[1]);
							var endmouth=Number(endNumber[1]) ;
							var starYear =Number(startNumber[0]);//开始年份
							var endYear =Number(endNumber[0]);//结束年份
						    var misting = (endmouth-startmouth);//差值
						    var misYear = endYear-starYear;//判断年份差值
						    
						    var 
						   	day=misting;
						   	/*
						   	 *@如果年份相等 时间不能选择往后的
						   	 *@跨年份时间 后面大于前面
						   	 * 3.跨年分时间  后面等于前面
						   	 * 4.跨年分时间 后面小于前面
						   	 * 5.跨n年份的话 后面小于前面
						   	 * 6.跨年份的话  计算跨了几年
						   	 * 7.选择月份不能小于当前月份 
						   	 * 
						   	 */
						    
						    if(starYear==endYear&&misting<0){
						    	$("#pay-submit").attr('disabled',true);
						    	Alert('请选择正确时间');
						    	return false;
						    
						    }else if(starYear==endYear&&misting==0){
						    	
						    	misting = 1
						    }else if(starYear==endYear&&misting>0){
						    	misting=misting+1
						    	
						    }else if(starYear<endYear&&misYear==1){
						    		//后面大于前面 存在跨年情况 且只跨了一年
						    		misting = misting+12;
						    		misting=misting+1
						    }else if(starYear<endYear&&misYear>1){
						    	   //后面大于前面 存在跨年情况 跨了不止一年
						    	    misting = misting+12*misYear;
						    	    misting=misting+1
						    }
						    $("#pay-submit").attr('disabled',false);
						    //赋值并发时间
						 	$this.parents('.concurrence-sub').find('.cound-type2').html(misting);
						
						  vodfaceprice2=price*misting*dataNumber; 
						  $('.vodface').html(vodfaceprice2)
						  $('input[name="startime"]').val(stamp);//初始时间
						  $('input[name="endtime"]').val(endTime);///结束时间
						  $('input[name="day"]').val(misting)//时差					
						  }
					
				}
				
					
					$this.parents('.new-form').find('.select-box').hide();
				}
				
				
		  
			  
			 function selectClassType(v){
				setClassOptionShow('classlevel'+v,'#classid');
				filter(v,'classlevel');
			
			};

			function setClassOptionShow(name,id){
				var _option = $(id).find('option');
				if(name === 'classlevel3'){
					_option.show();
					return false
				};
				var firstIndex = 0;
				for(var i=0;i<_option.length;i++){
					if(_option[i].className === name){
						firstIndex++;
						_option[i].style.display = 'block';
						
						
						if(firstIndex === 1){
							_option[i].selected = true
						}
						
					}else {
						_option[i].style.display = 'none'
						
					}
				}
			}


function getval(obj,param,url,valname,url_model){
	$(obj).find("option[value="+$(obj).val()+"]").attr("selected",true);
	var val = $(obj).val();
	var newurl = '';
	if (!param){
		if(val){
			if(url_model=='1'){
			newurl = url+'?'+valname+'-'+val;
			}else{
			newurl = url+'&arr='+valname+'-'+val;	
			}
		}
		location.href=newurl;
		return;
	}
	var newparam=getParams(param,val,valname);
	if(url_model=='1')
	{newurl = url+'?'+newparam;}else{newurl = url+'&arr='+newparam;}
	location.href=newurl;
	return;
}


function do_reg(){
	
	$('#myform').submit();
	
}






	</script>
</body>
</html>
