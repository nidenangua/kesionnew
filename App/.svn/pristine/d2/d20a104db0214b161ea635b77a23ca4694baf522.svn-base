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
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="//www.ketangjie.cn/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
* {
    box-sizing: inherit;
}
.teacherList li{ position:relative; padding-left:140px;height:120px; margin-left:20px; margin-right:20px; padding-top:20px; padding-bottom:20px; border-bottom:1px solid #eee;}
.teacherList li .tface{width:120px;height:120px; position:absolute;left:0;top:20px;}
.teacherInfo{ padding-top:6px; padding-bottom:6px; margin-top:5px;}
.fsize30{ font-size:30px;}
</style>
</head>

<body class="bg-gary p15">
<div class="">
 <ul class="nav nav-tabs">
    <li class="active fl"><a href="<?php echo M_URL($this->AppName.'/index','index','',GP('')); ?>">课程管理</a></li>
    <li class="fl"><a href="<?php echo M_URL('course/index','basics','',GP(''))  ?>">课程编辑</a></li>
 </ul>
<?php include CURR_VIEW_PATH.'head.php';?>

 </div>   
<div class="courseBox clearfix mt20" style="margin-top: <?php if(isset($course)){echo '140px';}else{echo '40px';} ?> ">
   <div class="lLightBox bg-white  pt30 borderSo">
    <ul>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond pl20" style="display:block">
                    <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"    class="block  fsize14 ">基本资料</a>
                    <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"  class="block  fsize14">详细资料</a>
                    <!-- <a href="<?php echo M_URL($this->AppName.'/index','seo',$courseid,GP('')) ?>"   class="block fsize14" >SEO设置</a> -->
                </div>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">课程学时</a>
            </li>
            <li class="posRe pl50 mb20  ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">上传文件</a>
            </li>
            
             <li class="posRe pl50 curr mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','teacher',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">教师管理</a>
            </li>
            
            <li class="posRe pl50  mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学员</a>

            </li>
           
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">评论管理</a>
            </li>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">考试管理</a>
            </li>
           <!--  <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                  <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">房间管理</a>
            </li> -->
             <li class="posRe pl50 mb20"> 
                <em class="vLine "></em>
                 <a href="<?php echo  M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
   </div>
   <div class="lRightBox">
      <div class="sRightBox ml20 bg-white  borderSo pt30">
	     <div class="generalTitle" style="margin-bottom: 20px">
			 <span class="gTitle fsize18 c-79 verAlignMiddle">该课程下的老师</span>
		 </div>
		 <div class="p20 pt0 teacherList">
			 <ul>
             <?php  foreach($teachers as $key=>$v){  ?>
			    <li class="clearfix">
				  <div class="tface">
				    <img src="<?php echo UOOT;?>public/uploads/timg.jpg" width="100%" height="100%">
				  </div>
				  <div>
				    <div class="clearfix">
					   <div class="fl"><span class="fsize18 c-79"><?php echo $v['name'] ?></span><span class="ml50 c-79 fsize14"></span></div>
					   <div class="fr">
					     <a class="mr10 fsize12 c-2c" href="" title="预览">预览</a>
						 <a class="mr10 fsize12 c-2c" href="<?php echo M_URL('users') ?>" title="编辑">编辑</a>
						 <a class="mr10 fsize12 c-2c" href="" title="评价">评价</a>
                         <?php if($v['isspeaker']==0){ ?>
						 <a class="mr10 fsize12 c-2c" href="javascript:void(0);" title="删除"
                         onclick="Confirm('是否删除此教师？该操作不可逆!','<?php echo M_URL($this->AppName.'/index','delspeaker',$v['id'],GP('')) ?>')">删除</a>
                         <?php  }?>
					   </div>
					</div>
					<div class="hLh30 fsize14 c-79">
                    <?php if($v["isspeaker"]==1){ ?>
					   <span class="mr10">主讲老师</span>
                    <?php }else{?>
                       <span class="mr10">讲师</span>
                    <?php }?>
					   <span class="mr10">性别:<?php if($v['Sex'] == 0){ echo "男";}else{ echo "女";} ?></span>
					</div>
				  </div>	
				  <div class="clearfix">
				    <div class="fl borderSo w100p pl10 pr10 teacherInfo bRadius5">
					   <div class="fl fsize14 c-92">
					     <span class="block">课程</span>
						 <span class="block">1门</span>
					   </div>
					   <div class="fr iconfont c-92 fsize30" style="line-height:40px;">
					     &#xe673;
					   </div>
					</div>
					<div class="fl borderSo ml30 w100p pl10 pr10 teacherInfo bRadius5">
					   <div class="fl fsize14 c-92">
					     <span class="block">点赞</span>
						 <span class="block">12个</span>
					   </div>
					   <div class="fr iconfont c-92 fsize30" style="line-height:40px;">
					     &#xe633;
					   </div>
					</div>
				  </div>
				</li>
               <?php }?>
               <?php echo NoC($teachers);?>
			 </ul>
            <div class="footer-page">
            <?php echo $page->show(3); ?>
            </div>
		 </div>
	  </div>
   </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
   loadScorllJs();
</script>
</body>
</html>
