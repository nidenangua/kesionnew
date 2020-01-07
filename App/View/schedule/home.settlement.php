<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>课时结算</title>
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
								<option value="0"<?php if(!$classid){ echo 'selected=selected'; }  ?>>选择班级</option>
		 						<?php foreach($class as $k=>$v){ ?>
									<option value="<?php echo $v['classid']; ?>" class="<?php echo 'classlevel'.$v['classlevel']; ?>"
									<?php if($classid== $v['classid']){ echo 'selected=selected'; }  ?>><?php  echo $v['title']; ?></option>
								<?php } ?>
		 				</select>	
					</div>

					<div class="fr">
						<ul class="ks-head-choice">

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
		  		<thead>
	                <tr>
	                	<th tyle="width: 30px;"><input type="checkbox" class="select-checks selectAll"></th>
	                    <th>上课时间</th>
	                    <th>主题名称</th>
	                    <th>签到时间</th>
	                    <th>班级</th>
	                    <th>主讲/费用(RMB)</th>
	                    <th>助教/费用(RMB)</th>
	                    <th>上课类型</th>
	                 
	                    <th>操作</th>
	                </tr>
            	</thead>
            	<form method="post" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','dobatch','',GP("")); ?>">
            	<tbody>
            		<?php foreach($values as $k=>$v){ ?>
            		<tr>
            			  <?php if($v['status']==2){ ?>
		            	  <td><input type="checkbox" class="select-checks form-in" name="scheduleid[]" value="<?php echo $v['id']; ?>"></td>
		            	  <?php  }else{ ?>
		            	  	<td><input type="checkbox" class="select-checks form-in"></td>
		            	  	<?php } ?>
		            	  <td><?php echo date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']); ?></td>
		            	    <td><?php  echo Field($v['title']);  ?></td>
		            	    <td><?php  echo date('Y-m-d H:i:s',$v['adddate']);  ?></td>
		            	  <td><?php echo  Field($v['classname']); ?></td>
		            	  <td><?php  echo Field($v['name']);  ?>/<?php if(isset($v['speakerMoney']))echo Field($v['speakerMoney']); ?></td>
		            	  <td><?php  echo Field($v['assisant']);  ?>/<?php if(isset($v['assistantcost']))echo Field($v['assistantcost']); ?></td>
		            	  <td><?php  echo Field($v['type']);  ?></td>
		            	  <?php if($v['status']==2){ ?>
		            	  <td><a href="javascript:void(0)" onClick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','scheduleSettlement',$v['scheduleid'],GP('')); ?>','750px','400px',{type:'top',title:'课时结算'})" >结算</a></td>
		            	  <?php }else{ ?>
		            	  	<td>已结算</td>
		            	  <?php } ?>	
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
					<button class="ks-heade-button ml10"  onclick="do_reg()">批量结算</button>
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
				setClassOptionShow('classlevel'+<?php echo $classlevel; ?>,'#classid');
			});
			
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
			
/*function getId(id){
  return document.getElementById(id)	
}
*/
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
