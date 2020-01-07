<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.Aconts-ul{ margin-right: 15px;}
.Aconts-ul li{float: left; width: 20%;}
.Aconts-ul li input{position: absolute;top: 0px;left: 0px;opacity: 0;}
.Aconts-ul .Alert-img{overflow: hidden; position: relative;}
.Alert-conts{ padding: 15px 10px; overflow: auto; height: 381px;}
.Alert-img img{width: 100%; height:  100%; min-height: auto;min-width: auto;}
.Alert-img i{ position: absolute; top: 50%; left: 50%;font-size: 60px; margin-top: -40px; margin-left: -30px; color:#44B549;}
.Alert-shadow{position: absolute; height: 100%; width: 100%; background: #000000; opacity: 0.6;}
.Aconts-box{margin: 15px 0px 0px 15px;border: solid 1px #e5e5e5;position: relative;}
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
div i.icon-tianjia1:hover{
	color:#476DBE;
}

</style>

    

</head>

<body class="ks-wrap" >

	<!--开始-->
	
	<div id="ksBoxHead">
		<div class="clearfix ks-top-tab">
			<div class="fl">
				<!--栏目块-->
				
			    <!--栏目块-->
		    </div>
			<div class="fr ks-top-search">
				<!--搜索-->
				<form target="hidframe" >
				<div class="fr ks-top-search">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
					<input type="button"  class="sc-button" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addDocent',$this->classid); ?>','<?php echo URL_MODEL;?>');"/>
				</div>	
				</form>
				<!--搜索-->
			</div>
		</div>	
	<!--结束-->
	</div>	
	
   
		<div class="Alert-conts clearfix" id="ksBoxContent">
		<ul class="Aconts-ul">
				 
			<?php  foreach($values as $key=>$v){; ?>
			<li class="card-li"><div class="Aconts-box">								
			<div class="Alert-img" autoimg="1,1" style="height: 123px;">
			<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
			<img class="card-img" src="<?php  echo $v['defaultpic']; ?>"></div>
			<div class="Alert-mark">  <?php  echo $v['tempname']; ?></div> 
				<input type="radio" class="select-check" id="radio<?php echo Field($v["id"])?>" name="docent[]" value="<?php echo Field($v["id"])  ?>">
			</div>
			</li>	
			 <?php } ?>
			 
		</ul>
    </div>
    <div id="ksBoxFooter" class="ks-bom clearfix" style="margin-top: -20px;">

		    <div class="fl">
		    	
		        <input type="button" class="ks-bt bt-pue" id="abc"  value="确认" name="confirm" />
		       
		       
		    </div>
		      <div class="fr">  <?php echo $page->show(3); ?></div>

	</div>
   
   </form>
    

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
radiotabs('temptype','.radio-tabs');
uploadView('180','140');


$('#abc').click(function(){
	
	var data = {
		radioID:$("input[type='radio']:checked").val(),
		imagesurl:$("input[type='radio']:checked").parents('.card-li').find('.card-img').attr('src')
	}
	
	top.dataCallBack(data);
	parent.closePopup(name);
	
	
})
 
$('.Aconts-ul li:nth-of-type(2)').find("input[type='radio']").prop('checked',true);
$('.Aconts-ul li:nth-of-type(2)').addClass("onYes");	
$('.Aconts-ul li:nth-of-type(2)').find(".ctrShaw").show();//显示打钩
/**图片选中***/
$(document).on('click','.Aconts-ul li',function(){
	$(this).find("input[type='radio']").prop('checked',true);
	$(this).addClass("onYes");		
	$(this).find(".ctrShaw").show().siblings();//显示打钩
	var index= $(this).siblings().find(".ctrShaw").hide();


})


/*$(document).on('click','.onYes',function(){
	$(this).find(".ctrShaw").hide();
	$(this).removeClass("onYes");
	$(this).find("input[type='radio']").prop('checked',false);
})*/
/*//全选一
$(document).on('click','#selectAll',function(){
	$(this).attr("id","cancelAll");
	$(this).find("input[type='radio']").prop('checked',true);
	$(".Aconts-ul li").find("input[type='radio']").prop('checked',true);
	$(".Aconts-ul li").find(".ctrShaw").show().siblings('.ctrShaw').hide();//显示打钩
})
//全选二
$(document).on('click','#cancelAll',function(){
	$(this).attr("id","selectAll");
	$(this).find("input[type='radio']").prop('checked',false);
	$(".Aconts-ul li").find("input[type='radio']").prop('checked',false);
	$(".Aconts-ul li").find(".ctrShaw").hide();//不显示打钩
})*/


</script>








