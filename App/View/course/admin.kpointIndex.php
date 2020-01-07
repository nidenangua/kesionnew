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
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    border: 1px solid transparent;
    border-radius: 4px;
}
.btn-w-m {
    min-width: 120px;
}
.btn-primary {
    background-color: #18a689;
    border-color: #18a689;
    color: #FFF;
}
.pos7{position:relative;top:5px}

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
   <div class="lLightBox bg-white  pt30 borderSo">
     <ul>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond pl20" style="display:block">
                    <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"   class="block  fsize14 ">基本资料</a>
                    <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"  class="block  fsize14">详细资料</a>
                    <!-- <a href="<?php echo M_URL($this->AppName.'/index','seo',$courseid,GP('')) ?>"  class="block fsize14" >SEO设置</a> -->
                </div>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学时</a>
            </li>
            <li class="posRe pl50 mb20  ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>" class="firstN fsize14  c-92">上传文件</a>
            </li>
            <li class="posRe pl50  mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','teacher',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">教师管理</a>

            </li>
            <li class="posRe pl50  mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">课程学员</a>

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
             <li class="posRe pl50 curr mb20"> 
                <em class="vLine "></em>
                 <a href="<?php echo  M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
   </div>
   <div class="lRightBox">
      <div class="sRightBox ml20 bg-white  borderSo pt30">
	     <div class="generalTitle">
		     <A href="javascript:void(0)" onclick="addCourseKpoint('<?php echo M_URL($this->AppName.'/index','addCourseKpoint',$courseid,GP('')) ?>')" class="fr btn-blue c-fff bRadius5 alignCenter hLh30 fsize14 w93 bg-2d" id="addStudent">+知识点</A>
			 <span class="gTitle fsize18 c-79 verAlignMiddle">课程知识点管理</span>
		 </div>
		 <div class="infoBox pt30 ml10 mr10">
		     <div class="stuConBox">
			     <div class="studentBox" style="display:block;">
					 <div class="ml20 fr pb20 mt-20">
                     <div class="speed-search fl clearfix" >
					 <div class="leftTd alignRight fsize16 c-666 w180 pr20  fl" style="padding-top:7px">快速搜索</div>
					 
                     <div class="leftTd alignLife fsize12 c-92 pr10  fl">
					    <select class="inputText pl20 w180 bRadius5" name="courseIntor"  id="keytype">
                        <option value="1">知识点</option>
                        </select>
					 </div>
				     </div>
					  <form target="hidframe"  class="fl clearfix">
						<input type="text" class="inputText" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
						<button type="button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/index','student',$courseid); ?>','<?php echo URL_MODEL;?>');" class="searchBtn w93 fsize14 bg-gary c-92 verAlignMiddle" name="searchBtn" >
                        搜索</button>
					  </form>
					 </div>     
                     
					 <div class="p20 pt0">
						 <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/index','delStudent',$courseid,GP('')) ?>" method="post">
							   <div class="blank10"></div>
							   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo" style="border-bottom:0;">
								   <tr class="bg-gary">
									 <td class="alignCenter hLh40 pt0 pb0 fsize14 ">id</td>
									 <td class="alignCenter hLh40 pt0 pb0 fsize14">知识要点</td>
                                     <td class="alignCenter hLh40 pt0 pb0 fsize14">所属章节</td>
									 <td class="alignCenter hLh40 pt0 pb0 fsize14 ">简介</td>
								   </tr>
								  
                               
               
								</table>
                                
                                <div class="row mt10 fr">
						<label class="mr20 ">
                        <input type="checkbox" class=" verAlignMiddle mr10 checkall chackInput check-all"><span class="verAlignMiddle  chackInput fsize14 c-92">全选</span></label>

					   <button type="submit" class="btn btn-w-m btn-primary" name="batch" value="1">批量删除</button>
					  

			   </div>
								<div class="blank30"></div>
						  </form>
					  </div>
                       <div class="footer-page">
       
        </div>
				 </div>
				 
			 </div>
		 </div>
	  </div>
   </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
IncreaseClass('257','.lLightBox ul>li','.liveCsecond>a','.liveCsecond')
var selectInputs = $('.chackInput'); // 所有勾选框
var checkAllInputs = $('.check-all') // 全选框
selectall(selectInputs,checkAllInputs);
</script>
</body>
</html>
