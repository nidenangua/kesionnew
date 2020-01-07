<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>添加学生</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/imageslist.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
	<div class="clearfix">
		<div class="fl">
			<div class="ks-search-box">
			<form target="hidframe">
				<!--搜索-->
				<select class="w150 inputText bRadius5 fl mr10" id="keytype" onchange="location.href = '<?php  echo M_URL($this->AppName.'/Index','addshop',$columnid); ?>?keytype-'+this.value;">
					<option value="0" <?php if($keytype==0){echo 'selected="selected"';} ?>>全部</option>
					<?php if(ismoduleopen($this->wxid,6,4)){?><option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>图文</option><?php }?>
					<?php if(ismoduleopen($this->wxid,6,3)){?><option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>音频</option><?php }?>
					<?php if(ismoduleopen($this->wxid,6,1)){?><option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>点播</option><?php }?>
					<?php if(ismoduleopen($this->wxid,6,2)){?><option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>直播</option><?php }?>
				</select> 
				<div class="fl ks-top-search">
					<input type="text" class="sc-text " name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>" >
					<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addshop',$columnid); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
				</div>
			</form>
		</div>			
	</div>		
	<div class="fr">
		<ul class="ks-head-choice">
			<li>
				<!-- <div class="ks-head-el">
					<a class="ks-heade-button ks-head-primary" href="javascript:void(0)" onclick="excelUser();" id="addStudent"><i class="iconfont icon-jiahao"></i>excel导入学员</a></a>
				</div> -->
			</li>
		</ul>
	</div>						
</div>
	<form action="<?php  echo M_URL($this->AppName.'/Index','doaddshop',$columnid) ?>" method="post" id="myform">
	<div class="clearfix">
		<div class="Alert-conts Aconts-user-conts clearfix" >
			<ul class="Aconts-ul clearfix">
				<?php  foreach($dt as $key=>$v){; ?>
				<li class="card-li check0" style="width: 24.5%;" id="stuli<?php echo Field($v["id"])?>"><div class="Aconts-box">								
				<div class="Alert-img" autoimg="1,1" >
				<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
				<img class="card-img" src="<?php echo Img($v['defaultpic'])?>"></div>
				<div class="Alert-mark"><?php echo $v['title'];?></div> 
					<input type="checkbox" class="select-check" id="student<?php echo Field($v["id"])?>" name="aid[]" flagname="<?php echo $v['title'];?>" value="<?php echo Field($v["id"])  ?>" onClick="getTK(this)">
				</div>
				</li>	
				<?php } ?>
			</ul>
		</div>
	</div>	
 	<div class="clearfix " >
		    <div class="rightTd alignLife fl">
		         <span class=" mr10 check0" id="selectAll" style="cursor: pointer;" id="selectAll">
		        	<input type="checkbox" class="fl select-check check-all" style="margin-top: 6px;" />全选
		        </span>
		        <input type="button" class="ks-heade-button"  onclick="submitform(1)"   value="确定" name="confirm" />
		    </div>
		    <div class="fr"> <?php echo $page->show(3,4); ?></div>
		</div>
		<input type="hidden" name="batch" id="batch1" />
	</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll','cookie'],function(){
		loadScorllJs();
		$(function(){ 
			var StuCheck = $.cookie('StuCheck');
			if(StuCheck){
				var Stuarr = StuCheck.split(",");
				for(var i=0;i<Stuarr.length;i++){
					$("#student"+parseInt(Stuarr[i])).attr('checked','checked');
					$("#stuli"+parseInt(Stuarr[i])).addClass("onYes");		
					$("#stuli"+parseInt(Stuarr[i])).find(".ctrShaw").show();//显示打钩
				}
			}
			var selectInputs   = $('.select-check');
			var checkAllInputs = $('.check-all');
			var checkednum = 0;
			for(var i = 0; i < selectInputs.length; i++ ){
				if(selectInputs[i].checked==true){checkednum++;}
				$('.check0')[i].onclick = function () {
					if ($(this).find("input[type='checkbox']")[0].className.indexOf('check-all')>= 0) { //如果是全选，则吧所有的选择框选中
						//$.cookie('StuCheck','',{ expires: -1, path: '/'}); 
						for (var j = 0; j < selectInputs.length; j++) {
							selectInputs[j].checked = this.checked;
							if(selectInputs[j].className.indexOf('check-all')<0){
								var StuCheck = $.cookie('StuCheck');
								var StuName  = $.cookie('StuName');

								var a = $(selectInputs[j]).val();
								var b = $(selectInputs[j]).attr('flagname');

								if(!StuCheck){
									var Stuarr = new Array(); 
									Stuarr.push(a);

									var StuNarr = new Array(); 
									StuNarr.push(b);

								}else{
									Stuarr  = StuCheck.split(",");
									StuNarr = StuName.split(",");

									if($(this).find("input[type='checkbox']")[0].checked==true){
										Stuarr.splice($.inArray(a,Stuarr),1);
										StuNarr.splice($.inArray(b,StuNarr),1);
									}else{
										if($.inArray(a,Stuarr) == -1){
											Stuarr.push(a);
											StuNarr.push(b);
										}
									}
								}
								var checkname = StuNarr.join(",");
								var checkid = Stuarr.join(",");
								$.cookie('StuName',checkname,{expires:7,path:'/'});
								$.cookie('StuCheck',checkid,{expires:7,path:'/'});
							}
						}
					}else{
						var StuCheck = $.cookie('StuCheck');
						var StuName  = $.cookie('StuName');
						var a = $(this).find("input[type='checkbox']").attr('flagname');
						var b = $(this).find("input[type='checkbox']").val();
						if(!StuCheck){
							var StuNarr = new Array(); 
							StuNarr.push(a);
							var Stuarr = new Array(); 
							Stuarr.push(b);
						}else{
							Stuarr  = StuCheck.split(",");
							StuNarr = StuName.split(",");
							if($(this).find("input[type='checkbox']")[0].checked==true){
								StuNarr.splice($.inArray(a,StuNarr),1);
								Stuarr.splice($.inArray(b,Stuarr),1);
							}else{
								StuNarr.push(a);
								Stuarr.push(b);
							}
						}
						var checkname = StuNarr.join(",");
						var checkid   = Stuarr.join(",");
						$.cookie('StuName',checkname,{expires:7,path:'/'});
						$.cookie('StuCheck',checkid,{expires:7,path:'/'});
						//var StuCheck = $.cookie('StuCheck');
					}
					if (!this.checked) { //只要有一个未勾选，则取消全选框的选中状态
						for (var i = 0; i < checkAllInputs.length; i++) {
							checkAllInputs[i].checked = false;
						}
					}
				}
			}
			if(parseInt(checkednum+1)==selectInputs.length){
				$('#selectAll').prop("id","cancelAll");
				selectInputs[14].checked=true;
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
})
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}
</script>
</body>
</html>
