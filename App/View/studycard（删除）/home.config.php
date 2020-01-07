<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.uploadView.js" type="text/javascript"></script>
</head>
<body class="bg-gary">
<div class="contentBox bRadius10 bg-white w100">
    <div class="generalTitle mb0">
        <span class="roundBox mr10"><img src="<?php echo UOOT;?>Public/app/images/wzsz.png"></span>
	    <span class="gTitle fsize18 c-3e verAlignMiddle">互动配置</span>
    </div>
	<ul class="titleTab clearfix mt20 ml20 mb30 pl20 pb20">
	    <li class="fl hLh40 pl10 pr10 mr20 fsize18 curr"><a href="javascript:void(0)" class="c-92">基本配置</a></li>
	    <li class="fl hLh40 pl10 pr10 mr20 fsize18"><a href="javascript:void(0)" class="c-92">其他配置</a></li>
	</ul>
	<div class="infoBox">
       <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','doSetting','',GP('')) ?>" method="post" id="myform">
		   <div class="webConBox">
             <div class="configTab" style="display:block;">
                 <table>
                     <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">是否开启问答:</td>
					     <td class="rightTd alignLife">
                
					        <input type="radio" name="isquestion" value="1"  <?php if(isset($isquestion))if($isquestion ==1) echo 'checked'; ?> class="radioInput">
                            <span class="radioName fsize16 c-92">启用</span>
                            <input type="radio" name="isquestion" value="0"  <?php if(isset($isquestion)){if($isquestion ==0) echo 'checked';} ?> class="radioInput">
                            <span class="radioName fsize16 c-92">不启用</span>
					     </td>
                     </tr>
                      <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">提问题是否需要审核:</td>
					     <td class="rightTd alignLife">
					        <input type="radio" name="isaudit" value="1"  <?php if(isset($isaudit))if($isaudit ==1) echo 'checked'; ?> class="radioInput">
                            <span class="radioName fsize16 c-92">不需要审核直接发布</span>
                            <input type="radio" name="isaudit" value="0"  <?php if(isset($isaudit))if($isaudit ==0) {echo 'checked';}?> class="radioInput">
                            <span class="radioName fsize16 c-92">需要后台审核后,方可发布</span>
					     </td>
                     </tr>
                     
                     <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">提问者可以删除自己问题:</td>
					     <td class="rightTd alignLife">
                            <input type="radio" name="isDelQuestion" value="2"  <?php if(isset($isDelQuestion))if($isDelQuestion ==2) echo 'checked'; ?> class="radioInput">
                            <span class="radioName fsize16 c-92">仅允许删除未解决问题</span>
                            <input type="radio" name="isDelQuestion" value="1"  <?php if(isset($isDelQuestion))if($isDelQuestion ==1) echo 'checked'; ?> class="radioInput">
                            <span class="radioName fsize16 c-92">允许删除所有问题</span>
                            <input type="radio" name="isDelQuestion" value="0"  <?php if(isset($isDelQuestion))if($isDelQuestion ==0){ echo 'checked';} ?> class="radioInput">
                            <span class="radioName fsize16 c-92">不允许</span>
					     </td>
                     </tr>
                      <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">可以删除回答者的答案：</td>
					     <td class="rightTd alignLife">
                           <input type="radio" name="isDelAnswer" value="1"  <?php if(isset($isDelAnswer))if($isDelAnswer ==1) echo 'checked'; ?> class="radioInput">
                            <span class="radioName fsize16 c-92"> 回答者可以删除自己问题</span>
                           <input type="radio" name="isDelAnswer" value="0" <?php if(isset($isDelAnswer))if($isDelAnswer ==0){ echo 'checked';} ?>
                            class="radioInput">
                            <span class="radioName fsize16 c-92">不允许</span>
					     </td>
                     </tr>
                      <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">新增加用户积分默认：</td>
					     <td class="rightTd alignLife">
                            <input type="text" name="integral5"  value="<?php if(isset($integral5))echo $integral5; ?>" class="inputText bRadius5 w80" >
					     </td>
                      </tr>
                     
                      <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">用户发表一个问题所获的积分：</td>
					     <td class="rightTd alignLife">
                            <input type="text" name="integral1"  value="<?php if(isset($integral1))echo $integral1; ?>" class="inputText bRadius5 w80" >
					     </td>
                      </tr>
                      <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">用户回答一个问题所获的积分：</td>
					     <td class="rightTd alignLife">
                            <input type="text" name="integral2"  value="<?php if(isset($integral2))echo $integral2; ?>" class="inputText bRadius5 w80" >
					     </td>
                      </tr>
                      <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">删除问题减去提问者积分：</td>
					     <td class="rightTd alignLife">
                            <input type="text" name="integral3"  value="<?php if(isset($integral3))echo $integral3; ?>" class="inputText bRadius5 w80" >
					     </td>
                      </tr>
                      
                       <tr>
                         <td class="leftTd alignRight fsize16 c-92 w300">删除答案减去回答者积分：</td>
					     <td class="rightTd alignLife">
                            <input type="text" name="integral4"  value="<?php if(isset($integral4))echo $integral4; ?>" class="inputText bRadius5 w80" >
					     </td>
                      </tr>
                     
                  
                     <tr>
					     <td class="leftTd alignRight w300"></td>
					     <td class="rightTd alignLife"><input type="button" onClick="do_reg()" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm"></td>
				   </tr>
                 </table>
             </div>
			
		   </div>
	   </form>
	   <div class="hLh40"></div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
/*设置切换*/
$(function(){	
	$('.titleTab li').click(function(){
		$(this).addClass('curr').siblings().removeClass('curr');
		$('.infoBox .webConBox>.configTab:eq('+$(this).index()+')').show().siblings().hide();	
	})
});
$(function(){
  $(".selectImageBtn").click(function(){
	    $("#upImg").click();  
	})	
})
$(function(){
	$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
	$("input[type=file]").each(function(){
//	if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("");}
	});
});
</script>
<script>
function do_reg()
{
	var signsms = $("input[name='signsms']").val();
	if(signsms==''){
		Alert('签名不能为空');
		return false;	
    }	
	$("#myform").submit();	
}
</script>
</body>
</html>
