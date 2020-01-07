 <?php if(isset($course)){ ?>
<div class="topCourseBox contentBox bRadius10 bg-white p20 clearfix borderSo">
    <div class="fl ml10 courseImg"><img  src="<?php if(isset($course["defaultpic"])){echo Img($course["defaultpic"]);}else{echo '/Public/uploads/common/nopic.gif';} ?>" width="100%"></div>
    <div class="fl ml20">
        <div class="clearfix"><span class="fl fsize16 c-333 hLh30"><?php echo $course['title']; ?></span><span class="fl bg-green w93    alignCenter fsize12 c-fff ml20 bRadius20 hLh30">已发布</span></div>
        <div class="mt10"><span class="fsize14 c-92">课时：12学时</span><span class="fsize14 c-92 ml20">学员：56个</span></div>
    </div>
</div>
<?php }?>