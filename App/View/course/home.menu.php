<?php $title='';if($this->courseType==1){$title= '点播';}elseif($this->courseType==2){$title= '直播';}elseif($this->courseType==3){$title= '音频';}elseif($this->courseType==4){$title= '图文';}?>
<ul>
    <li class="posRe pl50 mb20 <?php  if(ACTION=='basics' || ACTION=='info' || ACTION=='seo' || ACTION=='period'){echo 'curr' ;};?> ">
        <em class="vLine bg-green posAb"></em>
        <span class="firstN fsize14 c-92"><?php echo $title;?>资料</span>
        <div class="liveCsecond pl20" style="display:block">
            <a href="<?php echo M_URL($this->AppName.'/Index','basics',$courseid,GP('')) ?>"    class="block  fsize14 <?php if(ACTION=='basics'){echo 'curr';} ?>">基本资料</a>
            <?php if($this->course['coursehour']){?>
            <a href="<?php echo M_URL($this->AppName.'/Index','period',$courseid,GP('')) ?>"  class="block  fsize14 <?php if(ACTION=='period'){echo 'curr';} ?>"><?php echo $title;?>学时</a>
            <?php }?>
            <?php $websiteinfo=$this->cache->GetHCache('website',$this->wxid);$module=explode('|',$websiteinfo['module']);if($module[0]){?>
            <a href="<?php echo M_URL($this->AppName.'/Index','seo',$courseid,GP('')) ?>"  class="block  fsize14 <?php if(ACTION=='seo'){echo 'curr';} ?>" >SEO设置</a>
            <?php }?>
        </div>
    </li>
    <li class="posRe pl50 mb20 <?php  if(ACTION=='teacher' || ACTION=='student' ){echo 'curr' ;};?> ">
        <em class="vLine bg-green posAb"></em>
        <span class="firstN fsize14 c-92">教师/学员</span>
        <div class="liveCsecond pl20" style="display:block">
            <a href="<?php echo M_URL($this->AppName.'/Index','teacher',$courseid,GP('')) ?>"    class="block  fsize14 <?php if(ACTION=='teacher'){echo 'curr';} ?>">教师管理</a>
            <a href="<?php echo M_URL($this->AppName.'/Index','student',$courseid,GP('')) ?>"  class="block  fsize14 <?php if(ACTION=='student'){echo 'curr';} ?>">学员管理</a>
        </div>
    </li>
    <!--<li class="posRe pl50 mb20 <?php  if(ACTION=='exam' || ACTION=='Tkindex' ){echo 'curr' ;};?> ">
        <em class="vLine bg-green posAb"></em>
        <span class="firstN fsize14 c-92">练习中心</span>
        <div class="liveCsecond pl20" style="display:block">
            <a href="<?php echo M_URL($this->AppName.'/Index','exam',$courseid,GP('')) ?>"    class="block  fsize14 <?php if(ACTION=='exam'){echo 'curr';} ?>">试卷管理</a>
            <a href="<?php echo M_URL($this->AppName.'/Index','Tkindex',$courseid,GP('')) ?>"  class="block  fsize14 <?php if(ACTION=='Tkindex'){echo 'curr';} ?>">题库管理</a>
        </div>
    </li>
    <li class="posRe pl50 mb20 <?php  if(ACTION=='task' || ACTION=='correctTask' ){echo 'curr' ;};?> ">
        <em class="vLine bg-green posAb"></em>
        <span class="firstN fsize14 c-92">作业管理</span>
        <div class="liveCsecond pl20" style="display:block">
            <a href="<?php echo M_URL($this->AppName.'/Index','task',$courseid,GP('')) ?>"    class="block  fsize14 <?php if(ACTION=='task'){echo 'curr';} ?>">作业管理</a>
            <a href="<?php echo M_URL($this->AppName.'/Index','correctTask','',GP('courseid-'.$courseid)) ?>"    class="block  fsize14  <?php if(ACTION=='correctTask'){echo 'curr';} ?>">作业批改</a>

        </div>
    </li>
    <li class="posRe pl50 mb20 <?php  if(ACTION=='comment' || ACTION=='room' || ACTION == 'information'){echo 'curr' ;};?> ">
        <em class="vLine bg-green posAb"></em>
        <span class="firstN fsize14 c-92">其他信息</span>
        <div class="liveCsecond pl20" style="display:block">
            <a href="<?php echo M_URL($this->AppName.'/Index','comment',$courseid,GP('')) ?>"    class="block  fsize14 <?php if(ACTION=='comment'){echo 'curr';} ?>">评论管理</a>
             <?php if($course['courseType'] != 1){ ?>
            <a href="<?php echo M_URL($this->AppName.'/Index','room',$courseid,GP('')) ?>"  class="block  fsize14 <?php if(ACTION=='room'){echo 'curr';} ?>">房间管理</a>
            <?php } ?>
            <a href="<?php echo  M_URL($this->AppName.'/Index','information',$courseid,GP('')) ?>"  class="block fsize14 <?php if(ACTION=='information'){echo 'curr';} ?>"><?php echo $title;?>资料</a>
        </div>
    </li>-->
</ul>