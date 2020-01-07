<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>选择图片</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/imageslist" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>

<body class="ks-wrap" >

	<!--开始-->
	
	<div id="ksBoxHead">
		<div class="clearfix ks-top-tab">
			<div class="fl">
				<!--栏目块-->
				
			    <!--栏目块-->
		    </div>
			<div class="fl ks-top-search">
				<!--搜索-->
				<form target="hidframe" >
				<div class="fl ks-top-search" style="position: relative;">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
					<button type="submit"  class="ks-head-search " name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addDocent',$this->classid); ?>','<?php echo URL_MODEL;?>');"/><i class="iconfont icon-sousuo"></i></button>
				</div>	
				</form>
				<!--搜索-->
			</div>
		</div>	
	<!--结束-->
	</div>	
	
   
		<div class="Alert-conts clearfix" >
		<ul class="Aconts-ul" style="min-height: 385px;">
				 
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
     <div class="clearfix ks-popup-footer" >

		    <div class="fl mt20">
		        <input type="button" class="ks-bt bt-pue" id="abc"  value="确认" name="confirm" />	       		       
		    </div>
		      <div class="fr">  <?php echo $page->show(3); ?></div>

	</div>
   
   </form>
    

</body>
</html>

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
 module.require(['$','backstage','nicescroll'],function(){
 		
	radiotabs('temptype','.radio-tabs');
	uploadView('180','140');
	$('#abc').click(function(){	
		var data = {
			radioID:$("input[type='radio']:checked").val(),
			imagesurl:$("input[type='radio']:checked").parents('.card-li').find('.card-img').attr('src')
		}
		
		top.dataCallBack(data);
		parent.closePopup(name);		
	});
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

	
 })	




 



</script>








