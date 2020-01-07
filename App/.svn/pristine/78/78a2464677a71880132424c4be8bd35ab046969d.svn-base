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
    .liveTab {border-bottom:1px solid #dedede;height:86px;}
    .liveTab li{width:180px; border:1px solid #dedede; height:85px; border-bottom:0; background:#fbfbfb;}
    .liveTab li .hLh35{color:#929292;}
    .liveTab li.curr{background:#f5f5f5;height:86px; border-top:2px solid #34bd75;}
    .liveTab li.curr .hLh35{color:#333;}
    .leftdiv,.rightdiv {
        display: table-cell;
        padding: 20px 0;
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
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学时</a>
            </li>
            <li class="posRe pl50 mb20 curr ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">上传文件</a>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学员</a>

            </li>
             <li class="posRe pl50  mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','teacher',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">教师管理</a>

            </li>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">评论管理</a>
            </li>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">考试管理</a>
            </li>
<!--             <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                  <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">房间管理</a>
            </li>
 -->             <li class="posRe pl50 mb20"> 
                <em class="vLine "></em>
                 <a href="<?php M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
    </div>
    <div class="lRightBox">
        <div class="sRightBox ml20 bg-white  borderSo pt30">
            <form target="hidframe"  class="show-box" action="" name="">
                <div class="blank10"></div>
                <div class="gTable mt-20 mlr">
                    <div>
                        <div class="leftdiv alignRight fsize16 c-666 w180 pr20">播放类型</div>
                        <div class="rightdiv alignLife">
                            <label class="radioLabel fl">
                                <input type="radio" name="type"  checked="checked" class="radioInput" data="0">
                                <span class="radioName fsize16 c-92">视频</span>
                            </label>
                            <label class="radioLabel fl">
                                <input type="radio" name="type" class="radioInput" data="1">
                                <span class="radioName fsize16 c-92">音频</span>
                            </label>
                            <label class="radioLabel fl">
                                <input type="radio" name="type"  class="radioInput" data="2">
                                <span class="radioName fsize16 c-92">图文</span>
                            </label>
                            <label class="radioLabel fl">
                                <input type="radio" name="type" class="radioInput" data="3">
                                <span class="radioName fsize16 c-92">PPT</span>
                            </label>
                        </div>
                    </div>
<div class="show-content">
     <!-- 1-->
              <div class="show-item">
                    <div>
                        <div class="leftdiv alignRight fsize16 c-666 w180 pr20">播放时长：</div>
                        <div class="leftdiv alignLife fsize12 c-92 pr10">
                            <input type="text" class="inputText pl20 w400 bRadius5" name="Speakteacher">
                            <label class=" alignRight fsize16 c-666 w180 pr20">分钟</label>
                        </div>

                    </div>
                    <div>
                        <div class="leftdiv alignRight fsize16 c-666 w180 pr20">播放视频类型：</div>
                        <div class="leftdiv alignLife fsize12 c-92 pr10">
                          <select class="inputText pl20 w400 bRadius5">
                              <option></option>
                          </select>
                        </div>
                    </div>
                    <div>
                        <div class="leftdiv alignRight fsize16 c-666 w180 pr20">第三方云视频</div>
                        <div class="rightdiv alignLife">
                            <input type="text" class="inputText pl20 w400 bRadius5" name="Speakteacher">
                            <button class="generalBtn c-fff fsize16 bRadius5 bg-green" >上传视频</button>
                            <p class="mt10">乐视频UU丨VU用竖线隔离：exa879200la82201ac,其他视频填ID：XMTM5NzEOMTAzNg==</p>
                        </div>

                    </div>
              </div>
<!--end-->
<!--2-->
                    <div class="show-item" style="display: none">
                        <div>
                            <div class="leftdiv alignRight fsize16 c-666 w180 pr20">播放文件上传</div>
                            <div class="rightdiv alignLife">
                                <input type="text" class="inputText pl20 w400 bRadius5" name="Speakteacher">
                                <button class="generalBtn c-fff fsize16 bRadius5 bg-green" >选择播放文件</button>
                                <p class="mt10">限制：49MB，支持PPT丨PDF丨mp3丨pptx</p>
                            </div>

                        </div>
                    </div>
<!--end-->
<!--3-->
                    <div class="show-item" style="display: none">
                        <div>
                            <div class="leftdiv alignRight fsize16 c-666 w180 pr20">课程详细介绍</div>
                            <div class="rightdiv alignLife">
                                 <?php  $kindeditor = ks_editor('ctl00$KSContent$TxtIntro','');  echo $kindeditor;?>
                            </div>
                        </div>
                    </div>
 <!--end-->
<!--4-->
                    <div class="show-item" style="display: none">
                        <div>
                            <div class="leftdiv alignRight fsize16 c-666 w180 pr20">播放文件上传</div>
                            <div class="rightdiv alignLife">
                                <input type="text" class="inputText pl20 w400 bRadius5" name="Speakteacher">
                                <button class="generalBtn c-fff fsize16 bRadius5 bg-green" >选择播放文件</button>
                                <p class="mt10">限制：49MB，支持PPT丨PDF丨mp3丨pptx</p>
                            </div>

                        </div>
                    </div>
<!--end-->

</div>
                    <div>
                        <div class="leftdiv alignRight fsize16 c-79 w100p pr20"></div>
                        <div class="leftdiv alignLife fsize12 c-92 pr10"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm"><input type="submit" class="generalBtn c-92 fsize18 bRadius5 bg-d7 ml30" value="取消" name="cancel"></div>
                    </div>
                </div>
                <div class="blank30"></div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
IncreaseClass('140','.lLightBox ul>li','.liveCsecond>a','.liveCsecond');//二级栏目
checkbookM();//复选框优化；
tapsWeb3();//radio选项卡；
loadScorllJs();//滚轮；
    $(function(){

        $('.recordData').each(function() {
            var num = $(this).find('.recordBox').size();
            $(this).adiviv('data-id',num);

        });

        /*增加和删除数据*/
        $('.recordData').find('.delete:first').remove();
        $('.recordBox:first').removeClass("mt10");

        $(".gTable .addRecord").click(function(){
            var i = $(this).parents('.recordData').adiviv('data-id');
            i++;
            if(i<=3){
                var html = $(this).siblings(".recordBox:first").html();
                newHtml = '<div class="recordBox mt10">'+html+'<a href="javascript:void(0)" class="delete c-blue ml10">删除</a></div>';
                $(this).before(newHtml);
                a = i-1;
                $(this).siblings('.recordBox:eq('+a+')').find('.inputText').val('');

            }else{
                i=3;
                parent.layer.msg('最多只能加三条记录');


            };
            $(this).parents('.recordData').adiviv('data-id',i);

            $(".recordBox").on('click','.delete',function(){

                i--;

                $(this).parents('.recordData').adiviv('data-id',i);
                $(this).parents('.recordBox').remove();


            });

        });


        $(".recordBox").on('click','.delete',function(){
            var i = $(this).parents('.recordData').adiviv('data-id');
            i--;

            $(this).parents('.recordData').adiviv('data-id',i);
            $(this).parents('.recordBox').remove();


        });

    });


    
</script>

</body>
</html>
