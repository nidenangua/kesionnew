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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//www.ketangjie.cn/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.liveTab {border-bottom:1px solid #dedede;height:86px;}
.liveTab li{width:180px; border:1px solid #dedede; height:85px; border-bottom:0; background:#fbfbfb;}
.liveTab li .hLh35{color:#929292;}
.liveTab li.curr{background:#f5f5f5;height:86px; border-top:2px solid #34bd75;}
.liveTab li.curr .hLh35{color:#333;}
</style>
</head>

<body class="bg-gary p15">
<div class="taps-fixed">
 <ul class="nav nav-tabs">
    <li class="active fl"><a href="<?php echo M_URL($this->AppName.'/index','index','',GP('')); ?>">课程管理</a></li>
    <li class="fl"><a href="<?php echo M_URL('course/index','basics','',GP(''))  ?>">课程添加</a></li>
 </ul>
 <?php 
 if(isset($course)){
 $html='
       <div class="topCourseBox contentBox bRadius10 bg-white p20 clearfix borderSo">
<div class="fl ml10 courseImg"><img src="'.Img($course["defaultpic"]).'" width="100%"></div>
<div class="fl ml20">
    <div class="clearfix"><span class="fl fsize16 c-333 hLh30">'.$course['title'].'</span><span class="fl bg-green w93    alignCenter fsize12 c-fff ml20 bRadius20 hLh30">已发布</span></div>
    <div class="mt10"><span class="fsize14 c-92">课时：12学时</span><span class="fsize14 c-92 ml20">学员：56个</span></div>
</div>
 <div>
        <label class="radioLabel fl">
		 <input type="radio" name="status" class="radioInput jq" value="2"';if($course["status"]==1||$course["status"]==2)$html .="checked";$html .='>
		  <span class="radioName fsize14 c-92">通过审核</span>
		   </label>
		  <label class="radioLabel fl">
	     <input type="radio" name="status" class="radioInput jq" value="0"';if($course["status"]==0)$html .= "checked";$html .='>
		  <span class="radioName fsize14 c-92">取消审核</span>
		  </label>
	  
	  
   </div>
</div>
';
echo $html;
}
?>
 </div>   
<div class="courseBox clearfix mt20" style="margin-top: <?php if(isset($course)){echo '140px';}else{echo '40px';} ?> ">
   <div class="lLightBox bg-white bRadius10 pt30 borderSo">
     <ul>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond pl20" >
                    <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"    class="block  fsize14 ">基本资料</a>
                    <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"   class="block curr fsize14">详细资料</a>
                    <a href="<?php echo M_URL('course/index','seo',$courseid,GP('')) ?>" class="block fsize14" >SEO设置</a>
                </div>
            </li>
             <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>" class="firstN fsize14  c-92">上传文件</a>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学时</a>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学员</a>

            </li>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>"   class="firstN fsize14  c-92">评论管理</a>
            </li>
             <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">评论管理</a>
            </li>
            <li class="posRe pl50 mb20 curr">
                <em class="vLine bg-green posAb"></em>
                 <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>"   class="firstN fsize14  c-92">房间管理</a>
            </li>
             <li class="posRe pl50 mb20"> 
                <em class="vLine "></em>
                 <a href="<?php echo  M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
   </div>
   <div class="lRightBox">
      <div class="sRightBox ml20 bg-white bRadius10 borderSo pt30">
	     <div class="generalTitle">
			 <span class="gTitle fsize18 c-79 verAlignMiddle">房间管理</span>
		 </div>
	     <ul class="blockBoxl clearfix">
			 <li>
			   <div class="blockBox">
				 <div class="imgBox">
					<img src="<?php echo UOOT;?>Public/app/images/course2.jpg">
				 </div>
				 <div class="infoBox p16 pt0 bg-gary">
					<h2 class="titleBox fsize20 c-32 pt22 alignCenter hLh20">炫酷模板</h2>
					<div class="psBox fsize14 c-92 pt18 alignCenter hLh14">您的使用期限剩下：<font class="c-Orange">22天</font></div>
					<div class="clearfix mt20">
						<a href="" class="btn-blue hLh35 fl alignCenter fsize14 w47">退出使用</a>
						<a href="" class="btnBlueBorder hLh35 fr alignCenter fsize14 w47">立即续费</a>
					</div>
				 </div>
			   </div>
			 </li>			 
		 </ul>
		 <div class="mt30 ml30 pb100 pl10"><a href="" class="btn-Orange c-fff fsize14 bRadius5 hLh40 w150 block alignCenter">前往商城</a></div>
	  </div>
   </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
IncreaseClass('257','.lLightBox ul>li','.liveCsecond>a','.liveCsecond')
loadScorllJs();
	$(function(){
  $(".jq").click(function(){
    var status = $(this).val();
	$.ajax({
                type: "POST",
                url:"<?php echo M_URL($this->AppName.'/Ajax','audited',$courseid,GP('')) ?>",
                data:{status:status},
                success:function(text){
                if(text == 0){
                    alert("取消审核成功");
                }else if(text == 2){
                    alert("审核成功");
                }},
             error:function(){
                 alert("发生了错误,请检查!");
             }
      });
	
	
  });
 });
 /*判断每行的课程数*/
	var w= $(".sRightBox").width();
	//alert(w)
	if((w==1330)||(w>1200)){
	  var w4=(w-40)/4;
	  $(".blockBoxl").find("li").css("width",w4);
	}
	else if((w==1200)||(w>920)){
	  var w3=(w-40)/3;
	  $(".blockBoxl").find("li").css("width",w3);
	}
	else if((w==920)||(w>600)){
	  var w2=(w-40)/2;
	  $(".blockBoxl").find("li").css("width",w2);	
	}
	else{
	  var w1=w-40;
	  $(".blockBoxl").find("li").css("width",w1);
	}

</script>

</body>
</html>
