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
<!-- <link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" /> -->
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<link href="//www.ketangjie.cn/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
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
            <li class="posRe pl50 curr mb20">
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
            <!-- <li class="posRe pl50 mb20">
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
      <div class="sRightBox ml20 bg-white  borderSo ">
	     <div class="generalTitle">
		     <!-- <A href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','addCourseStudent',$courseid,GP('p-'.$page->now_page)) ?>','850px','600px')" class="fr btn-blue c-fff bRadius5 alignCenter hLh30 fsize14 w93 bg-2d" id="addStudent">+学员</A> -->
			 <span class="gTitle fsize18 c-79 verAlignMiddle">学员管理</span>
		 </div>
		 <ul class="stuTitleTab clearfix ml20 mb30 hLh40 mr20">
			 <li class="fl hLh40 pl10 pr10 mr20 fsize14 curr"><a href="javascript:void(0)" class="c-92">正式学员</a></li>
			 <li class="fl hLh40 pl10 pr10 mr20 fsize14"><a href="javascript:void(0)" class="c-92">退出记录</a></li>
		 </ul>
		 <div class="infoBox pt30 ml10 mr10">
		     <div class="stuConBox">
			     <div class="studentBox" style="display:block;">
					 <div class="ml20 fr pb20 mt-20">
                     <div class="speed-search fl clearfix" >
					 <!-- <div class="leftTd alignRight fsize16 c-666 w180 pr20  fl" style="padding-top:7px">快速搜索</div> -->
					 
                     <div class="leftTd alignLife fsize12 c-92 pr10  fl">
					    <select class="inputText pl20 w180 bRadius5" name="courseIntor"  id="keytype">
                        <option value="1">学员名称</option>
                        </select>
					 </div>
				     </div>
					  <form target="hidframe"  class="fl clearfix">
						<input type="text" class="inputText" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
						<button type="button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/index','student',$courseid); ?>','<?php echo URL_MODEL;?>');" class="searchBtn w93 fsize14 bg-gary c-92 verAlignMiddle" name="searchBtn">
                        搜索</button>
					  </form>
					 </div>
					 <div class="p20 pt0">
						 <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/index','delStudent',$courseid,GP('courseid-'.$courseid.',p-'.$page->now_page)) ?>" method="post">
							   <div class="blank10"></div>
							   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="table">
								   <tr class="">
									 <td class="">学员</td>
									 <td class="">学习进度</td>
									 <td class="">操作</td>
								   </tr>
								  
                                  <?php foreach($student as $k=>$v){ ?>
								   <tr>
									 <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 w100p">
                                        <input type="checkbox" class="chackInput pos7" name="id[]" value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></td>
									 <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
									    <div class="w180 clearfix mlr">
											<div class="fl w120 posRe learnPrg">
											   <div class="posAb bg-green inLearnPrg" style="width:50%"></div>
											</div>
											<span class="fl c-92 ml10">50%</span>
										</div>
									 </td>
									 <td class="alignCenter hLh40 pt0 pb0 fsize14 w93"><a href="javascript:void(0);" class="c-92 pr10 pl10 r-icon posRe"  onclick="Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/index','delCourseStudent',$v['id'],GP('courseid-'.$courseid.',p-'.$page->now_page)); ?>')"><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></a></td>
								   </tr>
                                   <?php } ?>
                                   
								</table>
                                <?php echo NoC($student);?>
                                <?php if(!empty($student)) {?>
                                    <input type="hidden" name="batch" id="batch1" />
                                    <div class="ks-bom clearfix">
                                        <div class="fl">
                                            <label class="mr20 fl"><input type="checkbox" class="selectAll" >全选</label>
                                            <button type="button" class="ks-heade-button mr10" onclick=""><i class="iconfont icon-shanchu1"></i></button>
                                        </div>
                                        <div class="fr">
                                            <?php echo $page->show(3); ?>
                                        </div>
                                    </div>  
                                <?php } ?>
						  </form>
					  </div>
				 </div>
				 
		 </div>
	  </div>
   </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();//滚轮
var selectInputs = $('.chackInput');
var checkAllInputs = $('.check-all');
selectall(selectInputs,checkAllInputs);//全选
IncreaseClass('140','.lLightBox ul>li','.liveCsecond>a','.liveCsecond');//左边高度+二级栏目
tapsWeb();//选项卡；
$(function(){
	$(".liveTab li:first").css("border-right",0);
})
</script>

</body>
</html>
