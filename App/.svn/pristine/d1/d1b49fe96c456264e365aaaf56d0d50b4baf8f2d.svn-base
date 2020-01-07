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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.Aconts-ul{ margin-right: -15px;}
.Aconts-ul li{float: left; width: 20%;}
.Aconts-ul li input{position: absolute;top: 0px;left: 0px;opacity: 0;}
.Aconts-ul .Alert-img{overflow: hidden; position: relative;}
.Alert-conts{ padding: 15px 0; overflow: hidden; height: 381px;}
.Alert-img img{width: 100%; height:  100%; min-height: auto;min-width: auto;}
.Alert-img i{ position: absolute; top: 50%; left: 50%;font-size: 60px; margin-top: -40px; margin-left: -30px; color:#44B549;}
.Alert-shadow{position: absolute; height: 100%; width: 100%; background: #000000; opacity: 0.6;}
.Aconts-box{margin: 15px 15px 0px 0px;border: solid 1px #e5e5e5;position: relative;}
.Alert-mark{padding: 0px 10px; border-top:1px solid #E5E5E5 ;height: 30px; line-height: 30px; text-align: center;font-size: 12px;overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;}
.ctrShaw{display: none;}
div i.icon-tianjia1{
	color:#ccc;
	margin-top:-60px;
	cursor:pointer;
	transition:all 0.2s linear;
}
.add-add{
	cursor:pointer;
	background:#eee;
}
.icon-tianjia1:hover{
	color:#476DBE;
}

</style>
</head>
<body class="ks-wrap">

	  
	
		
	<div id="ksBoxHead">
			<div class="clearfix">
	  <div class="fr ks-top-search">
				<label class="mr0">
			   	<select class="w150 inputText bRadius5" id="keytype">
					<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>学员账号</option>
					<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>学员名字</option>
			  	</select>
				</label>
				<div class="ks-top-search fr">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	                <input type="button" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addStudent'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
				</div>
			</div>
		</div>   
		  
		  
	</div>
	<div class="clearfix" id="ksBoxContent">
		<div class="Alert-conts clearfix" >
			<ul class="Aconts-ul">
				<?php echo NoC($student);?>	 
				<?php  foreach($student as $key=>$v){; ?>
				<li class="card-li"><div class="Aconts-box">								
				<div class="Alert-img" autoimg="1,1" style="height: 123px;">
				<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
				<img class="card-img" src="<?php echo $this->upload->getHead($v['userid']);?>"></div>
				<div class="Alert-mark"><?php echo empty($v['name'])?$v['username']:$v['name'];?></div> 
					<input type="checkbox" class="select-check" id="radio<?php echo Field($v["userid"])?>" name="aid[]" flagname="<?php echo $v['username']; ?>" value="<?php echo Field($v["userid"])  ?>" onClick="getTK(this)">
				</div>
				</li>	
				 <?php } ?>

			</ul>
		</div>
	</div>	
		
		
		<div class="clearfix" id="ksBoxFooter">
		    <div class="rightTd alignLife fl">
		         <span class="ks-bt bt-def mr10" id="selectAll">
		        	<input type="checkbox" class="fl" style="margin-top: 8px;" />全选
		        </span>
		        <input type="button" class="ks-bt bt-pue" onclick="reg()"  value="确定" name="confirm" />
		      
		     
		    </div>
		      
		    <div class="fr"> <?php echo $page->show(3); ?></div>
		</div>
		
		
		
		
		

		<input type="hidden" name="batch" id="batch1" />

	
	
	
	
	
	
	
	
	
	
	
	
	


<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script>
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}
function getTK(obj){
	var a = $(obj).prop('checked');
	var b = $(obj).val();
	var student = $.cookie('student');
	if(!student){
		var ab = new Array(); 
		ab.push(b);
		var tk = ab.join(",");
		$.cookie('student',tk,{ expires: 7, path: '/' });
	}else{
		ab = student.split(",");
		if(a==false){
			ab.splice($.inArray(b,ab),1);
			var tk = ab.join(",");
		}else{
			ab.push(b);
			var tk = ab.join(",");
		}
		$.cookie('student',tk,{ expires: 7, path: '/' });
		var student = $.cookie('student');
		
	}
}	

$(function(){ 
	var student = $.cookie('student');
	if(student){
	   var ab =student.split(",");
	   for(var i=0;i<ab.length;i++){
		   $("#student"+parseInt(ab[i])).attr('checked','checked');
	   }
	}
})

$(document).on('click','.Aconts-ul li',function(){
	$(this).find("input[type='checkbox']").prop('checked',true);
	$(this).addClass("onYes");		
	$(this).find(".ctrShaw").show();//显示打钩

})
$(document).on('click','.onYes',function(){
	$(this).find(".ctrShaw").hide();
	$(this).removeClass("onYes");
	$(this).find("input[type='checkbox']").prop('checked',false);
})
//全选一
$(document).on('click','#selectAll',function(){
	$(this).attr("id","cancelAll");
	$(this).find("input[type='checkbox']").prop('checked',true);
	$(".Aconts-ul li").find("input[type='checkbox']").prop('checked',true);
	$(".Aconts-ul li").find(".ctrShaw").show();//显示打钩
})
//全选二
$(document).on('click','#cancelAll',function(){
	$(this).attr("id","selectAll");
	$(this).find("input[type='checkbox']").prop('checked',false);
	$(".Aconts-ul li").find("input[type='checkbox']").prop('checked',false);
	$(".Aconts-ul li").find(".ctrShaw").hide();//不显示打钩
})

function reg(){
	
	/*top.main.$("#ids").val("");*/
		var ary = $(".select-check:checked");
		var ids = [];
		var names= [];
		if(ary.length<=0){
			Alert('请选择学员');
		}else{
			for(var i=0;i<ary.length;i++){
				ids.push($(ary[i]).val());
				names.push($(ary[i]).attr('flagname'));
			}
	//		console.log(ids);
			var data = {
				radioID:ids,
				radioname:names
			}
	
	
			top.dataCallBack(data);
			parent.closePopup(name);
		}
		
}



//返回id

</script>
</body>
</html>
