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
	<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>/Public/app/css/laydate.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/popup/css/kesion.popup.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<script src="<?php echo UOOT;?>Public/popup/js/kesion.popup.js"></script>

</head>
<style>
	.Created-ing>ul>li{margin: 40px 0px;}
	.Created-title span:last-child { margin-left: 20px; }
	.defInput{width: 200px!important;}
	.win-info{}
	.win-info li{margin-bottom: 40px;}
	.addButton{background: #71B0EC;color:#FFFFFF;border: none;padding: 3px 20px!important;border-radius: 3px;}
	.thisInput{margin: 0px!important;}
	.thisSelect{margin: 0px!important;display: none;}
</style> 
<body class="ks-wrap">
	
	<div id="ksBoxHead"></div>
	
	<div class="bRadius10 ks-wbox clearfix">
		<div class="Created-push clearfix" id="ksBoxContent"> 
			<div style="font-size:16px;color: #888;margin-bottom: 30px;">
				<a href="javascript:history.go(-1);">
					<i class="iconfont icon-jiantou-copy"></i>
				活动模板</a>
				<span> / </span>创建活动
			</div>
			<form target="hidframe" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','doedittGame','',GP(""));?>"  method="post" enctype="multipart/form-data">
				
			<ul>
				
				<li>
					<div class="Created-largetTitle">
						<span>1</span>
						<div class="Created-title">  
							<span><?php $h5['h5name']; ?>活动内容编辑</span>
						</div>
					</div>
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>活动名称:</h4>
								<div class="Created-Content">
									<input type="hidden" name="id" value="<?php echo $h5info['id']; ?>" />
									<input type="text" class="long-text" name="name" flag ='活动名称' value="<?php echo $h5info['name']; ?>">&nbsp;&nbsp;
									<label for="" class="fn"><?php echo $str; ?></label>
									
								</div>
							</li>
							
							<li>
								<h4>活动时间:</h4>
								<div class="Created-Content">
									<input id="datatime1" type="text" value="<?php echo date('Y-m-d H:i:s',$h5info['startime']); ?>" name="startime" required readonly class="w200  laydate-icon"> 至
									<input id="datatime2" type="text" value="<?php echo date('Y-m-d H:i:s',$h5info['endtime']); ?>"name="endtime" required readonly class="w200  laydate-icon">
								</div>
							</li>
							
								<li>
								<h4 style="position: absolute;top: 15px;">活动次数:</h4>
								<div class="Created-Content">
									<input type="text" name="number" value="<?php echo $h5info['number']; ?>" flag='活动次数'>&nbsp;&nbsp;次 
										
								</div>
							</li>
				
							
						</ul>
						
					</div>
					
					
				</li>
				
				
				<li>
					<div class="Created-largetTitle">
						<span>2</span>
						<div class="Created-title">  
							<span><?php $h5['h5name']; ?>奖励规则</span>
						</div>
					</div>
					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4 style="position: absolute;top: 15px;">奖励信息:</h4>
								<div class="Created-Content">
									
									<ul class="win-info" id="winInfo">
										<?php foreach($setting['rewardType'] as $k =>$v){ ?>
										<li>
											<input type="text" class="defInput mr20" flag='奖励设置' name="reward[]" value="<?php echo $setting['reward'][$k]; ?>"/>
											<select class="defInput mr20 bind" name="rewardType[]">
												<option value="0" <?php if($v == 0){ echo 'selected';} ?>>现金抵用券</option>
												<option value="1" <?php if($v == 1){ echo 'selected';} ?>>免费课程</option>
												<option value="2" <?php if($v == 2){ echo 'selected';} ?>>免费班级</option>
											</select>
											<span class="thisInput" <?php if($v == 0){ echo  'style="display:inline-block"';}else{ echo  'style="display:none"';} ?>>
												<input  type="text" name="money[]" flag='奖励设置' value="<?php echo $setting['money'][$k]; ?>"/>&nbsp;&nbsp;元 &nbsp;&nbsp;
											</span>
											
											<span class="thisSelect" <?php if($v != 0){ echo  'style="display:inline-block"';}else{ echo  'style="display:none"';} ?>>
											<input type="hidden" value="<?php echo $setting['infoid'][$k] ?>" class='selectedid'>
											<select class="defInput mr20" flag='奖励设置' name="infoid[]">
												<option value="现金抵用券" selected="">现金抵用券</option>
											</select>
											</span>	
												
											<input type="text" class=""  flag='奖励设置' name="rewardnum[]" value="<?php echo $setting['rewardnum'][$k]; ?>">&nbsp;个 &nbsp;(最多100个)
											<p>填入奖励名称；例如：一等奖</p>
										</li> 
										<?php }?>
									</ul>
									<button type="button" class="addButton">添加奖项</button>
								</div>
							</li>
							
							
						</ul>
						
					</div>
					
					
				</li>

				<!--暂停-->
				<li>
					<div class="Created-largetTitle">
						<span>2</span>
						<div class="Created-title">
							<span>转发内容编辑</span>
							<span>(编辑的内容将在转发页面可见)</span>
						</div>
					</div>
					<div class="Created-ing">
						<ul>
							<?php foreach($gy->item as $k =>$v){?>
								<li>
								  
										<h4 class="name"><?php echo $v['title'] ;?></h4>
										<div class="Created-Content">
											<?php 
												$str = $v['name'];
												echo ks_editor($v['name'], $setting[''.$str.''],1,editorNum2());
											?>
										</div>
									
								</li> 
						  	<?php }?>
						  	<?php foreach($zd->item as $k =>$v){?>
						    <li>
								<h4><?php echo $v['title'] ;?></h4></span>
								<div class="Created-Content clearfix">
									
									<?php $str = $v['name']; echo inputType($v['type'],$setting[''.$str.''],$v['name'],$v['title']); ?>
								</div>
							</li>
							<?php }?>
							
							
						
							
						</ul>
						
					</div>
					
					
				</li>
				
				
			</ul>
			
			</form>
			
		</div>	
		
		
	</div>

  	<div id="ksBoxFooter clearfix"  style="position: fixed;bottom: 0px;left: 0px; width: 100%;height:70px;z-index: 10000000;background: #FFFFFF;">
		<div class="form-footer" style="padding-top: 5px;">
			<span class="d-inline-block">
			<button type="button" onclick="do_reg()" class="ks-bt bt-pue">确认修改</button>
		    <button onclick="javascript:history.go(-1);" class="ks-bt bt-def">取消</button>
		    </span>
	    </div>
	</div>
	
      
 
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
<script type="text/javascript">
	var limit = 10;
	var liStr='<li><input type="text" class="defInput mr20" flag="奖励设置" name="reward[]" />';
	liStr+='<select class="defInput mr20 bind" flag="奖励设置" name="rewardType[]" >';
	liStr+='<option value="0">现金抵用券</option>';
	liStr+='<option value="1" >免费课程</option>';
	liStr+='<option value="2" >免费班级</option>';
	liStr+='</select><span class="thisInput">';
	liStr+='<input type="text" flag="奖励设置" name="money[]" value="0" />&nbsp;&nbsp;元 &nbsp;&nbsp;';
	liStr+='</span><span class="thisSelect"><select class="defInput mr20" flag="奖励设置" name="infoid[]">';
	liStr+='<option value="现金抵用券" selected="">现金抵用券</option></select></span>	';
	liStr+='<input type="text" class="" value="6" flag="奖励设置" name="rewardnum[]">&nbsp;个 &nbsp;(最多100个)';
	liStr+='<p>填入奖励名称；例如：一等奖</p></li>';
	
	$(".addButton").click(function(){
		var len =$("#winInfo li").length;
		if(len<limit){
			$("#winInfo").append(liStr);
		}else{
			popup.tips({
			    title:'已超过最大限制',
			});
		}
	})
	

	$(document).on('change','.bind',function(){
		var index = $(this).parents("li").index();
		//console.log(index);
		
		$(this).siblings(".thisInput").hide();
		$(this).siblings(".thisInput").hide();
		var vals = $(this).val();
		
		if(vals==0){
			$(this).siblings(".thisSelect").hide();
			$(this).siblings(".thisInput").show();
		}else if(vals==1){
			$(this).siblings(".thisInput").hide();
			$(this).siblings(".thisSelect").show();
			getOption(index,vals);
			
		}else if(vals==2){
			$(this).siblings(".thisInput").hide();
			$(this).siblings(".thisSelect").show();
			getOption(index,vals);
		}
	}) 
	 
	
</script>
<script>


datatime("#datatime1");
datatime("#datatime2"); 


 function do_reg()
{   
	var inputary = $('input'); 
	var falg = 0;
	for(var i = 0;i<inputary.length;i++){
		if($(inputary[i]).val()==''){
			if($(inputary[i]).attr('name') !='money'){
				Alert('请填写'+$(inputary[i]).attr('flag'));
				falg--;
				return;
			}
		}else{
			falg++;
		}
	}
	if(falg>0){
		$("#myform").submit();
	}
	
//  
 }
 




$(".Qet").click(function(){
	var src=$(this).siblings("img").attr("src")	;
	show(src);
})
function show(src){  //显示隐藏层和弹出层
	$("#hidebox img").attr("src",src)
	var hideobj=document.getElementById("hidebg");
	hidebg.style.display="block";  //显示隐藏层
	hidebg.style.height=document.body.clientHeight+"px";//设置隐藏层的高度为当前页面高度
	document.getElementById("hidebox").style.display="block";  //显示弹出层
}
function hide(){//去除隐藏层和弹出层
   document.getElementById("hidebg").style.display="none";
   document.getElementById("hidebox").style.display="none";
}



//Ajax请求获取列表
function getOption(index,key,selectedid=0){
	console.log(index,key);
	$.ajax({
		type:"post",
		data:{key:key},
		url:"<?php echo M_URL($this->AppName.'/Index','reward','',GP(''));?>",
		dataType:'json',
		success:function(data){
			var str = '';
			for(var i =0;i<data.length;i++){
				if(key == 1){
					if(selectedid == data[i].classid){
						str += '<option value="'+data[i].classid+'" selected>'+data[i].title+'</option>';
					}else{
						str += '<option value="'+data[i].classid+'">'+data[i].title+'</option>';
					}
				}else{
					if(selectedid == data[i].courseid){
						str += '<option value="'+data[i].courseid+'" selected>'+data[i].title+'</option>';
					}else{
						str += '<option value="'+data[i].courseid+'">'+data[i].title+'</option>';
					}
				}
				
			}
		//	console.log(str);
			$('#winInfo li').eq(index-1).find(".thisSelect select").html(str); 
		}
	});
}
$('#winInfo li').each(function(){
		var bindVal = $(this).find(".bind").val();
		var index = $(this).index()+1;
		var selectedid = $(this).find(".selectedid").val();
		
		getOption(index,bindVal,selectedid);
	})
</script>
</body>
</html>
