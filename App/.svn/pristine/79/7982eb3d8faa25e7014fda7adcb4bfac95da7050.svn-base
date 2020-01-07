<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台"/>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//www.ketangjie.cn/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.r-icon em {
width: 40px;
height: 22px;
line-height: 22px;
text-align: center;
color: #fff;
position: absolute;
top: -30px;
left: 50%;
margin-left: -20px;
background: #1a1a1a;
border-radius: 3px;
font-size: 12px;
display: none;
}
.order-product {
display: inline-block
}
.r-icon em .arrow-down {
width: 8px;
height: 4px;
position: absolute;
left: 50%;
margin-left: -4px;
bottom: -4px;
background: url(<?php echo UOOT;?>images/arrow-down.png) no-repeat;
}
.order-product {
float: left;
padding-left: 20px;
}
.blank60 {
height: 60px;}
.datatime0 .time-li, .datatime .time-li{
display: inline-block;
height: 32px;
line-height: 32px;
text-align: center;
font-size: 16px;
padding: 0 8px;
color: #666;
}
.datatime0 .time-li {
font-size: 14px;
}
.pr5{padding-right: 5px}
.page-box{
        float: right;
    margin-top: 28px;
}
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
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond pl20" style="display:block">
                    <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"    class="block  fsize14 ">基本资料</a>
                    <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"  class="block  fsize14">详细资料</a>
                    <!-- <a href="<?php echo M_URL($this->AppName.'/index','seo',$courseid,GP('')) ?>"  class="block  fsize14" >SEO设置</a> -->
                </div>
            </li>
            <li class="posRe pl50 mb20  ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>" class="firstN fsize14  c-92">上传文件</a>
            </li>
            
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">课程学时</a>
            </li>
             <li class="posRe pl50  mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','teacher',$courseid,GP('')) ?>" class="firstN fsize14 c-92">教师管理</a>

            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">课程学员</a>

            </li>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>" class="firstN fsize14  c-92">评论管理</a>
            </li>
             <li class="posRe pl50 mb20 curr">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>" class="firstN fsize14  c-92">考试管理</a>
            </li>
            <!-- <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                  <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>" class="firstN fsize14 c-92">房间管理</a>
            </li> -->
             <li class="posRe pl50 mb20"> 
                <em class="vLine "></em>
                 <a href="<?php echo M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
    </div>
    <div class="lRightBox">
        <div class="sRightBox ml20 bg-white bRadius10 borderSo pt30">
            <div class="generalTitle">
                <a href="<?php echo M_URL('exam/index','paperAdd','','',GP("courseid-$courseid,appid-10,bappid-$this->appid")); ?>" class="fr bg-green c-fff bRadius5 alignCenter hLh30 fsize14 w93 "id="addStudent">+试卷</a>
                <span class="gTitle fsize18 c-79 verAlignMiddle">试卷管理</span>
            </div>

            <div class="infoBox pt30 ml10 mr10">
                <div class="stuConBox">
                    <div class="studentBox" style="display:block;">
                        <div class="ml20 pb20 fr" style="    margin-right: 51px;">
                          <form target="hidframe" >
                            <input type="text" class="inputText" name="searchText">
                            <input type="button" class="searchBtn w93 fsize14 bg-gary c-92 verAlignMiddle" name="searchBtn" value="搜索">
                          </form>
                         </div>
                        <div class="p20 pt0">
                            <form target="hidframe"  action="" name="">
                                <div class="blank10"></div>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                       class="gTable borderTable borderSo" style="border-bottom:0;">

                                    <thead>
                                    <tr class="bg-gary">
                                        <th class="alignCenter hLh40 pt0 pb0 fsize14 w300">
                                            <div class="order-product pd-b">
                                                <input type="checkbox" class="verAlignMiddle mr10" name="check[]"value="21">
                                            </div>
                                            试卷名称
                                        </th>
                                        <th class="alignCenter hLh40 pt0 pb0 fsize14">所属章节</th>
                                        <th class="alignCenter hLh40 pt0 pb0 fsize14 ">试卷分值</th>
                                        <th class="alignCenter hLh40 pt0 pb0 fsize14 ">考试人数</th>
                                        <th class="alignCenter hLh40 pt0 pb0 fsize14">已批改</th>
                                        <th class="alignCenter hLh40 pt0 pb0 fsize14 ">未批改</th>
                                        <th class="alignCenter hLh40 pt0 pb0 fsize14 ">试卷状态</th>
                                        <th class="alignCenter hLh40 pt0 pb0 fsize14 w93">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($values as $k=>$v){ ?>
                                    <tr>
                                        <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
                                            <div class="order-product pd-b">
                                                <input type="checkbox" class="verAlignMiddle mr10" name="check[]" value="21">
                                            </div>
                                           <a href="<?php echo M_URL('exam/index','preview',$v['paperid'],'',GP("courseid-$courseid,appid-10,bappid-$this->appid")) ?>">
										   <?php echo $v['Title'] ?></a>
                                        </td>
                                        <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"></td>
                                        <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['ExamScore'] ?></td>
                                        <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">5人</td>
                                        <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">4人</td>
                                        <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"> 1人</td>
                                        <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"> 开发</td>
                                        <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
                                       <a href="<?php echo M_URL('exam/index','preview',$v['paperid'],'',GP("courseid-$courseid,appid-10,bappid-$this->appid")); ?>">
                                       <i class="icon pr10 iconfont">&#xe6d3</i> </a> 
                                       <a href="<?php echo M_URL('exam/index','editpaper',$v['paperid'],GP("courseid-$courseid,appid-10,bappid-$this->appid,p-$page->now_page")); ?>">
                                       <i class="icon pr10 iconfont">&#xe616</i> </a>
                                       <a href="javascript:void(0);" onclick="Confirm('是否删除此试卷？该操作不可逆!','<?php echo M_URL('exam/index','delPaper',$v['paperid'],'',GP("courseid-$courseid,appid-10,bappid-$this->appid")); ?>')"> <i class="icon pr10 iconfont">&#xe61d</i> </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                                <?php echo NoC($values);?>
                                <?php if($values){?>
                                <div class="footer-page">
                                     <?php echo $page->show(3); ?>
                                     <div class="fl mt20">
                                    <label style="margin-right: 15px"><input name="" type="checkbox" value="" class="check-all verAlignMiddle" id="selectAll"> 全选</label>
                                    <button class=" generalBtn c-fff fsize16 bRadius5">批量删除</button>
                                </div>
                                 </div>
                                <?php }?>
                                
                                <div class="blank60">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
var selectInputs = $('.verAlignMiddle') ;
var checkAllInputs = $('.check-all');
selectall(selectInputs,checkAllInputs);   
</script>
</body>
</html>
