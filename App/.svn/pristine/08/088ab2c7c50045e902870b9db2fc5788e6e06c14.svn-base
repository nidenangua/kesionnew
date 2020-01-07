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
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="bg-gary p15">
<div >
 <ul class="nav nav-tabs">
    <li class="active fl"><a href="<?php echo M_URL($this->AppName.'/index','index','',GP('')); ?>">课程管理</a></li>
    <li class="fl"><a href="<?php echo M_URL('course/index','basics','',GP(''))  ?>">课程编辑</a></li>
 </ul>
<?php include CURR_VIEW_PATH.'head.php';?>
 </div>   
<div class="courseBox clearfix mt20" style="margin-top: <?php if(isset($course)){echo '140px';}else{echo '40px';} ?> ">
    <div class="lLightBox bg-white bRadius10 pt30 borderSo">
        <ul>
            <li>
                <em class="vLine "></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond pl20" style="display:block">
                    <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"   class="block  fsize14 ">基本资料</a>
                    <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"   class="block fsize14">详细资料</a>
                    <!-- <a href="<?php echo M_URL($this->AppName.'/index','seo',$courseid,GP('')) ?>"   class="block curr fsize14" >SEO设置</a> -->
                </div>
            </li>
             <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">上传文件</a>
            </li>
            <li >
                <em class="vLine "></em>
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学时</a>
            </li>
            <li >
                <em class="vLine "></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学员</a>

            </li>
             <li >
                <em class="vLine "></em>
                <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>"   class="firstN fsize14  c-92">评论管理</a>
            </li>
             <li >
                <em class="vLine "></em>
                <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>"   class="firstN fsize14  c-92">考试管理</a>
            </li>
            <!-- <li >
                <em class="vLine "></em>
                 <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">房间管理</a>
            </li> -->
             <li class="posRe pl50 mb20"> 
                <em class="vLine "></em>
                 <a href="<?php echo M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
    </div>
    <div class="lRightBox" id="lRightBox">
        <div class="sRightBox ml20 bg-white bRadius10 borderSo pt30">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable mt10">
                <?php if(isset($Article)){echo Admin_Field($Field,$Article,$Linkage);}else{echo Admin_Field($Field,'',$Linkage);}?>
            </table>
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
</script>
</body>
</html>
