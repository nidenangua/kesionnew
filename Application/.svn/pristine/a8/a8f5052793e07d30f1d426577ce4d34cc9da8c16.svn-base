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
<link href="<?php echo UOOT;?>Public/app/css/imageslist.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />


</head>
<body class="ks-wrap">
	
	<div class="clearfix">
	    <div class="ffl ks-top-search">
			<label class="mr0">
		   	<select class="w150 inputText bRadius5 fl" id="keytype">
				<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>学员账号</option>
				<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>学员名字</option>
		  	</select>
			</label>
			<div class="ks-top-search fl">
				<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
                <button type="button" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Massage','readerlist',$ids); ?>','<?php echo URL_MODEL;?>')" name="searchBtn"  ><i class="iconfont icon-sousuo"></i></button>
			</div>
	    </div>
	  
	</div>
	<form target="hidframe"  action="<?php  echo M_URL('/Index','doaddStudent',$this->classid,GP('p-'.$page->now_page)) ?>" method="post" id="myform">
	<div class="clearfix" >
		<div class="Alert-conts clearfix" >
			<ul class="Aconts-ul">
				<?php echo NoC($student);?>	 
				<?php  foreach($student as $key=>$v){; ?>
				<li class="card-li"><div class="Aconts-box">								
				<div class="Alert-img" autoimg="1,1" style="height: 123px;">
				<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
				<img class="card-img" src="<?php echo $this->upload->getHead($v['userid']);?>"></div>
				<div class="Alert-mark"><?php echo empty($v['name'])?$v['username']:$v['name'];?></div> 
					<input type="checkbox" class="select-check" id="radio<?php echo Field($v["userid"])?>" name="aid[]" value="<?php echo Field($v["userid"])  ?>" onClick="getTK(this)">
				</div>
				</li>	
				 <?php } ?>
			</ul>
		</div>
	</div>	
		 
		    <div class="clearfix ks-popup-footer form-footer">
			    <div class="d-inline-block ">
			    	<div class="fr"> <?php echo $page->show(3); ?></div>
			    </div>
		    </div>
	</div>
		
		
		
	

		<input type="hidden" name="batch" id="batch1" />

	</form>

</form>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll','cookie'],function(){
		$(function(){ 
	var student = $.cookie('student');
	if(student){
	   var ab =student.split(",");
	   for(var i=0;i<ab.length;i++){
		   $("#student"+parseInt(ab[i])).attr('checked','checked');
	   }
	}
})

//$(document).on('click','.Aconts-ul li',function(){
//	$(this).find("input[type='checkbox']").prop('checked',true);
//	$(this).addClass("onYes");
//	$(this).find(".ctrShaw").show();//显示打钩
//
//})
//$(document).on('click','.onYes',function(){
//	$(this).find(".ctrShaw").hide();
//	$(this).removeClass("onYes");
//	$(this).find("input[type='checkbox']").prop('checked',false);
//})
////全选一
//$(document).on('click','#selectAll',function(){
//	$(this).attr("id","cancelAll");
//	$(this).find("input[type='checkbox']").prop('checked',true);
//	$(".Aconts-ul li").find("input[type='checkbox']").prop('checked',true);
//	$(".Aconts-ul li").find(".ctrShaw").show();//显示打钩
//})
////全选二
//$(document).on('click','#cancelAll',function(){
//	$(this).attr("id","selectAll");
//	$(this).find("input[type='checkbox']").prop('checked',false);
//	$(".Aconts-ul li").find("input[type='checkbox']").prop('checked',false);
//	$(".Aconts-ul li").find(".ctrShaw").hide();//不显示打钩
//})
	})
	
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


</script>
</body>
</html>
