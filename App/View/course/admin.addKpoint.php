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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<link href="<?php echo UOOT;?>Public/app/font/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
</head>
<body>
<div class="ml20 pb20 mt-20 clearfix">
<form class="fr mr20" action="<?php echo M_URL($this->AppName.'/index','addCourseStudent',$courseid,GP('')) ?>">
	<input type="text" class="inputText" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
	<button type="button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/index','addCourseStudent'); ?>','<?php echo URL_MODEL;?>');" class="searchBtn w93 fsize14 c-92 verAlignMiddle" >搜索</button>
</form>
</div>
<div class="p20 pt0">
<form action="<?php echo M_URL($this->AppName.'/index','doaddKpoint',$courseid,GP('')) ?>"  method="post">
       <div class="blank10"></div>
       <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo" style="border-bottom:0;">
           <tr class="bg-gary">
             <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p">id</td>
             <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p">知识点</td>
             <td class="alignCenter hLh40 pt0 pb0 fsize14">介绍</td>
            
           </tr>
           <?php foreach($values as $k=>$v){ ?>
           <tr>
             <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p">
                <div class="order-product pd-b">
                <input type="checkbox" class="verAlignMiddle mr10" id="tk<?php echo $v['id'] ?>" name="kption" value=" <?php echo $v['id'] ?>" onClick="getKption(this)" >
                 <?php echo $v['id'] ?>
                </div>
            </td>
             <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 w100p name" id="name<?php echo $v['id'] ?>"><?php echo $v['title'] ?></td>
             <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
                <?php echo $v['intro'];  ?>
             </td>
            
           </tr>
           <?php } ?>
        </table>
        <?php echo $page->show(3); ?>
     <div class="fr clearfix mt30 mr30">
         <div class="rightTd alignLife">
             <input type="checkbox" name="" class="checkall chackInput verAlignMiddle check0 check-all ">全选
             <input type="button" type="button" class="generalBtn c-fff fsize16 bRadius5 ml20" value="确认" name="confirm" id="abc">
         </div>
     </div>
	 <div class="blank30"></div>
</form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function getKption(obj){
   	var a = $(obj).prop('checked');
	var b =$(obj).val();
	var addKption = $.cookie("addKption");
	if(!addKption){
		var ab = new Array(); 
		ab.push(b);
		var tk = ab.join(",");
		$.cookie('addKption',tk);
	}else{
        ab =addKption.split(",");
		if(a==false){
			ab.splice($.inArray(b,ab),1);
			var tk = ab.join(",");
		}else{
			ab.push(b);
			var tk = ab.join(",");
		}
	$.cookie('addKption',tk);
	}
}
$(function(){ 
	var addKption = $.cookie("addKption");
	if(addKption){
	   var ab =addKption.split(",");
	   for(var i=0;i<ab.length;i++)
	   {
		   $("#tk"+parseInt(ab[i])).attr('checked','checked');
		}
	}
});
</script>
<script>
 $("#abc").click(function(){
	var kption = $.cookie('addKption');
	parent.$('.chapterKption').remove();
	$.ajax({
			type:"POST",
			url:"<?php echo UOOT; ?>Plus/Kesion.ajax.php?act=kption",
			data:{kption:kption},
			success:function(text){
			   parent.$('#knowledge').append(text);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	}); 
	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
	parent.layer.close(index);
});
</script>
<script>
var selectInputs = document.getElementsByClassName('chackInput'); // 所有勾选框
var checkAllInputs = document.getElementsByClassName('check-all'); // 全选框
selectall(selectInputs,checkAllInputs);
loadScorllJs();
</script>
</body>
</html>
