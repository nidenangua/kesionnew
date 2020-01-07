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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
	.ks-popup-footer {width:100%;position: fixed;bottom: 0;left: 0;height: 75px;background:#EBF0F2;padding: 0 15px;box-sizing: border-box;}
	.ks-popup-footer .rightTd {margin-top: 20px;}
</style>
</head>
<body class="ks-wrap">
	<div id="ksBoxHead">
	  <div class="clearfix">
	  <div class="fr ks-top-search">
				<label class="mr0">
			   	<select class="w150 inputText bRadius5" id="keytype">
					<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>学员昵称</option>
					<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>学员账号</option>
			  	</select>
				</label>
				<div class="ks-top-search fr">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	                <input type="button" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addStudent'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
				</div>
			</div>
		</div>   
	</div>
	<div class="clearfix" >
		<div class="Alert-conts clearfix" >
			<ul class="Aconts-ul">
				<?php echo NoC($student);?>	 
				<?php  foreach($student as $key=>$v){; ?>
				<li class="card-li check0" id="stuli<?php echo Field($v["userid"])?>"><div class="Aconts-box">								
				<div class="Alert-img" autoimg="1,1" style="height: 123px;">
				<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
				<img class="card-img" src="<?php echo $this->upload->getHead($v['userid'],4,0);?>"></div>
				<div class="Alert-mark"><?php echo empty($v['name'])?$v['username']:$v['name'];?></div> 
					<input type="checkbox" class="select-check" id="student<?php echo Field($v["userid"])?>" name="aid[]" flagname="<?php echo empty($v['name'])?$v['username']:$v['name']; ?>" value="<?php echo Field($v["userid"])  ?>">
				</div>
				</li>	
				<?php } ?>
			</ul>
		</div>
	</div>	
	<div class="clearfix ks-popup-footer" >
		<div class="rightTd alignLife fl">
		    <span class="ks-bt bt-def mr10 check0" id="selectAll">
		        <input type="checkbox" class="fl select-check check-all" style="margin-top: 8px;" />全选
		    </span>
		    <input type="button" class="ks-bt bt-pue" onclick="reg()"  value="确定" name="confirm" />
		</div>
		<div class="fr mt20"> <?php echo $page->show(3,4); ?></div>
	</div>
	<input type="hidden" name="batch" id="batch1" />
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script>
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
$(document).on('click','.Aconts-ul li',function(){
	if($(this).hasClass('onYes')==false){
		$(this).find("input[type='checkbox']").prop('checked',true);
		$(this).addClass("onYes");		
		$(this).find(".ctrShaw").show();//显示打钩
	}else{
	    $(this).find(".ctrShaw").hide();
		$(this).removeClass("onYes");
		$(this).find("input[type='checkbox']").prop('checked',false);
	}
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
	var checkAllInputs = $('.check-all')
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
function reg(){
	/*top.main.$("#ids").val("");*/
		//var ary   = $(".select-check:checked");
		var StuCheck = $.cookie('StuCheck');
		var StuName  = $.cookie('StuName');
		var ids   = [];
		var names = [];
		if(!StuCheck){
			Alert('请选择学员');
		}else{
			//for(var i=0;i<ary.length;i++){
			//	ids.push($(ary[i]).val());
			//	names.push($(ary[i]).attr('flagname'));
			//}
			ids  = StuCheck.split(",");
		    names = StuName.split(",");
			var data = {
				radioID:ids,
				radioname:names
			}
			$.cookie('StuName','',{expires:7,path:'/'});
			$.cookie('StuCheck','',{expires:7,path:'/'});
			top.dataCallBack(data);
			parent.closePopup(name);
		}
}
//返回id
</script>
</body>
</html>
