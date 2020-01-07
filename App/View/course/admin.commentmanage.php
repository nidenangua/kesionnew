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
<style>
.r-icon em {width: 40px;height: 22px;line-height: 22px;text-align: center;color: #fff;position: absolute;top: -30px;left: 50%;margin-left: -20px;background: #1a1a1a;border-radius: 3px;font-size: 12px;display: none;}
.r-icon em .arrow-down {width: 8px;height: 4px;position: absolute;left: 50%;margin-left: -4px;bottom: -4px;background: url(<?php echo UOOT;?>images/arrow-down.png) no-repeat;}
</style>
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
        <li class="posRe pl50 mb20">
            <em class="vLine bg-green posAb"></em>
            <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
            <div class="liveCsecond pl20" style="display:block">
                <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"    class="block  fsize14 ">基本资料</a>
                <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"  class="block  fsize14">详细资料</a>
                <!-- <a href="<?php echo M_URL($this->AppName.'/index','seo',$courseid,GP('')) ?>"   class="block fsize14" >SEO设置</a> -->
            </div>
        </li>
        <li class="posRe pl50 mb20  ">
            <em class="vLine bg-green posAb"></em>
            <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">上传文件</a>
        </li>
        <li class="posRe pl50 mb20">
            <em class="vLine bg-green posAb"></em>
            <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学时</a>
        </li>
         <li class="posRe pl50  mb20">
            <em class="vLine bg-green posAb"></em>
            <a href="<?php echo M_URL($this->AppName.'/index','teacher',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">教师管理</a>
        </li>
        <li class="posRe pl50 mb20">
            <em class="vLine bg-green posAb"></em>
            <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学员</a>

        </li>
        <li class="posRe pl50 mb20 curr ">
            <em class="vLine bg-green posAb"></em>
            <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">评论管理</a>
        </li>
         <li class="posRe pl50 mb20 ">
            <em class="vLine bg-green posAb"></em>
            <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">考试管理</a>
        </li>
        <!-- <li class="posRe pl50 mb20">
            <em class="vLine bg-green posAb"></em>
              <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>" class="firstN fsize14 c-92">房间管理</a>
        </li> -->
         <li class="posRe pl50 mb20"> 
            <em class="vLine "></em>
             <a href="<?php echo  M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
        </li>
    </ul>
   </div>
   <div class="lRightBox">
      <div class="sRightBox ml20 bg-white bRadius10 borderSo ">
	     <div class="generalTitle">
			 <span class="gTitle fsize18 c-79 verAlignMiddle">评价管理</span>
		 </div>
		 <div class="ml20 pb20 pt20 fr" style="    margin-right: 51px;">
		  <form target="hidframe" >
			<input type="text" class="inputText" name="searchText">
			<input type="button" class="searchBtn w93 fsize14 bg-gary c-92 verAlignMiddle" name="searchBtn" value="搜索">
		  </form>
		 </div>
		 <div class="p20 pt0">
			 <form target="hidframe"  action="" name="">
				   <div class="blank10"></div>
				   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo pb20" style="border-bottom:0;margin-bottom: 40px;">
					   <tr class="bg-gary">
						 <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p">学员</td>
						 <td class="alignCenter hLh40 pt0 pb0 fsize14">评论内容</td>
						 <td class="alignCenter hLh40 pt0 pb0 fsize14 w180">操作</td>
					   </tr>
             <?php if($values){foreach($values as $k => $v){?>
					   <tr>
						      <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 w100p"><?php echo $v['membername']?></td>
						      <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['interact']?></td>
						      <td class="alignCenter hLh40 pt0 pb0 fsize14 w180"><a href="javascript:void(0)" class="c-92 pr10 pl10 r-icon posRe" onClick="huiFu()"><em>回复<i class="arrow-down"></i></em><i class="iconfont icon-huifu"></i></a><a href="<?php echo  M_URL($this->AppName.'/index','delComment',$v['interactid'],GP('courseid-'.$courseid)) ?>" class="c-92 pr10 pl10 r-icon posRe"><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></a></td>
					   </tr>
           <?php }}?>
					</table>
          <?php echo NoC($values);?>
					<div class="blank30">
            <div class="footer-page">
            <?php if($values){ echo $page->show(3);} ?>
            </div>     
          </div>
			  </form>
		  </div>
	  </div>
   </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
checkbookM();
WebLeftSide();
loadScorllJs(); 
  /*$(".jq").click(function(){
    var status = $(this).val();
	$.ajax({
                type: "POST",
                url:"<?php echo M_URL('course/Ajax','audited',$courseid,GP('')) ?>",
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
	
	
  });*/
</script>	
</body>
</html>
