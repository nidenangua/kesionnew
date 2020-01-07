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
      <li class="fl"><a href="<?php echo M_URL('course/index','basics','',GP(''))  ?>">课程编辑/a></li>
    </ul>
	<?php include CURR_VIEW_PATH.'head.php';?>
</div>   

<div class="courseBox clearfix mt20" style="margin-top: <?php if(isset($course)){echo '140px';}else{echo '40px';} ?> ">
    <div class="lLightBox bg-white  pt30 borderSo">
         <ul>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond pl20" style="display:block">
                    <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"    class="block  fsize14 ">基本资料</a>
                    <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"  class="block  fsize14">详细资料</a>
                    <!-- <a href="<?php echo M_URL($this->AppName.'/index','seo',$courseid,GP('')) ?>"  class="block fsize14" >SEO设置</a> -->
                </div>
            </li>
           
            <li class="posRe pl50 mb20 curr">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">课程学时</a>
            </li>
              <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">上传文件</a>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学员</a>

            </li>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>" class="firstN fsize14  c-92">评论管理</a>
            </li>
             <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">考试管理</a>
            </li>
          <!--   <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                  <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>" class="firstN fsize14 c-92">房间管理</a>
            </li> -->
             <li class="posRe pl50 mb20"> 
                <em class="vLine bg-green posAb"></em>
                 <a href="<?php echo  M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
    </div>


        <div class="sRightBox ml20  borderSo pt20" style="margin-left:220px">

            <div class="generalTitle  bg-white">
                <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','addchapter',$courseid,GP("chapterid-0")) ?>','850px','600px');" class="fr c-fff bRadius5 alignCenter hLh35 fsize14 w93 ml10 bg-34b">添加章<i class="iconfont icon-triangle-bottom ml10"></i></a>
                <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','addsection',$courseid,GP("chapterid-0")) ?>','700px','530px')" class="fr c-fff bRadius5 alignCenter hLh35 fsize14 w93 ml10 bg-34b">添加节<i class="iconfont icon-triangle-bottom ml10"></i></a>
                <a href="<?php echo M_URL($this->AppName.'/index','addkeshi',$courseid,GP("chapterid-0")) ?>" class="fr c-fff bRadius5 alignCenter hLh35 fsize14 w93 bg-2d">添加课时</a>
                <span class="gTitle fsize18 c-79 verAlignMiddle">课时管理</span>
                <!-- <label class="fsize14 c-79  pl30">该课程下共2章，2节，7课时</label> -->
            </div>            
            <div class="courseKeshi">
           <?php
            foreach($chapter as $k=>$v){?>
                <div class="chapter">
                    <div class="name">
                        <div class="r-icon">
                        <?php if($v["depth"]==1){?>
                        <span>
                            <em>添加<i class="arrow-down"></i></em><i class="iconfont icon-icontianjia01"></i>
                            <div class="addBox-style">
                     <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','editsection',$courseid,GP("chapterid-$v[chapterid]")) ?>','700px','530px')">
                                <div class="btn"><i class="iconfont icon-jiahao"></i>添加节</div></a>
                       <a href="<?php echo M_URL($this->AppName.'/index','addkeshi',$courseid,'',GP("chapterid-$v[chapterid]")) ?>">
                                <div class="btn"><i class="iconfont icon-jiahao"></i>添加课时</div></a>
                            </div>
                        </span>
                        <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','addchapter',$courseid,GP("chapterid-$v[chapterid],p-$page->now_page"))?>','700px','530px')" >
                            <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
                        <?php }elseif($v["depth"]==2){?>
                            <span>
                            <em>添加<i class="arrow-down"></i></em><i class="iconfont icon-icontianjia01"></i>
                            <div class="addBox-style">
                              <a href="<?php echo M_URL($this->AppName.'/index','addkeshi',$courseid,'',GP("chapterid-$v[chapterid]")) ?>">
                                <div class="btn"><i class="iconfont icon-jiahao"></i>添加课时</div></a>
                            </div>
                        </span>
                        <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','addsection',$courseid,GP("chapterid-$v[chapterid],p-$page->now_page")) ?>','700px','530px')" >
                            <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
                        <?php }elseif($v["depth"]==3){?>
                             <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','viewplay',$courseid,GP("chapterid-$v[chapterid],p-$page->now_page"))?>','800px','630px')" >
                            <span><em>预览<i class="arrow-down"></i></em><i class="icon iconfont icon-yulan"></i></span></a>
                             <a href="<?php echo M_URL($this->AppName.'/index','editkeshi',$courseid,GP("chapterid-$v[chapterid],p-$page->now_page")) ?>" >
                            <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
                            <?php }?>
                            <a href="javascript:void(0);"  onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/index','delchapter',$courseid,GP("chapterid-$v[chapterid],p-$page->now_page")) ?>')">
                            <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
                        </div>
                        <?php echo $v["title"]?> &nbsp;&nbsp;
						<?php if($v['chaptertype'] == 1){echo '点播';}elseif($v['chaptertype']==2){echo '直播';}elseif($v['chaptertype']==3){echo '面授';}?>
                    </div>
                    <?php if(isset($v["Section"]))foreach($v["Section"] as $kt=>$vt){?>
                    <div class="inner">
                        <div class="name section" id="ID_">
                            <div class="r-icon">
                             <?php if($vt["depth"]==2){?>
                            <span>
                                <em>添加<i class="arrow-down"></i></em><i class="iconfont icon-icontianjia01"></i>
                                <div class="addBox-style">
                              <a href="<?php echo M_URL($this->AppName.'/index','addkeshi',$courseid,'',GP("chapterid-$vt[chapterid]")) ?>">
                                <div class="btn"><i class="iconfont icon-jiahao"></i>添加课时</div></a>
                                 </div>
                            </span>
                            <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','addsection',$courseid,GP("chapterid-$vt[chapterid],p-$page->now_page")) ?>','700px','530px')" >
                            <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
                            <?php } elseif($vt["depth"]==3){?>
                             <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','viewplay',$courseid,GP("chapterid-$vt[chapterid],p-$page->now_page"))?>','800px','630px')" >
                            <span><em>预览<i class="arrow-down"></i></em><i class="icon iconfont icon-yulan"></i></span></a>
                            <a href="<?php echo M_URL($this->AppName.'/index','editkeshi',$courseid,GP("chapterid-$vt[chapterid],p-$page->now_page")) ?>" >
                            <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
                            <?php }?>
                               <a href="javascript:void(0);" onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/index','delchapter',$courseid,GP("chapterid-$vt[chapterid],p-$page->now_page")); ?>')">
                               <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
                            </div>
                            <?php echo $vt["title"] ?> &nbsp;&nbsp;
							<?php if($vt['chaptertype'] == 1){echo '点播';}elseif($vt['chaptertype']==2){echo '直播';}elseif($vt['chaptertype']==3){echo '面授';}?>
                        </div>
                        <div class="inner">
                            <?php if(isset($vt["keshi"]))foreach($vt["keshi"] as $ktt=>$vtt){?>
                                <div class="name keshi">
                                <div class="r-icon">
                                    <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','viewplay',$courseid,GP("chapterid-$v[chapterid],p-$page->now_page"))?>','800px','630px')" >
                                    <span><em>预览<i class="arrow-down"></i></em><i class="icon iconfont icon-yulan"></i></span></a>
                                   <a href="<?php echo M_URL($this->AppName.'/index','editkeshi',$courseid,GP("chapterid-$vtt[chapterid],p-$page->now_page")) ?>" >
                                   <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
                                   <a href="javascript:void(0);" onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/index','delchapter',GP("chapterid-$vtt[chapterid],p-$page->now_page")); ?>')">
                                    <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
                                </div>
                                <?php echo $vtt["title"]?>  &nbsp;&nbsp;
							<div > <?php if($vtt['chaptertype'] == 1){echo '点播';}elseif($vtt['chaptertype']==2){echo '直播';}else{echo '面授';} ?></div>
                            </div>
                            <?php }?>
                		</div>
                	</div>
                        <?php } ?>
            	</div>
                   <?php }?>
                   </div><!--courseKeshi-->
                    <?php echo NoC($chapter);?>
              <?php if($chapter){ echo $page->show(3);} ?>
        </div>
<!--lRightBox-->
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
IncreaseClass('140','.lLightBox ul>li','.liveCsecond>a','.liveCsecond');//二级栏目
periodAction(); //课时
loadScorllJs();//滚轮
</script>
</body>
</html>
