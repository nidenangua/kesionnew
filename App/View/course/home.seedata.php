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
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />

<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<style>
.exercise-img {position: relative;}
.class-gray	{position: absolute;background: rgba(0, 0, 0,.45);position: absolute;width: 100%;height: 100%; top: 0;}
.port-play{background: url('<?php echo UOOT;?>/Public/app/css/buttonscut.png')no-repeat;width: 44px;height: 44px;display: block;margin: 0 auto;background-size: 100% 100%;margin-left: -22px;margin-top: -22px;position: absolute;left: 50%;top: 50%;}

.postExcerpt {
    width: 297px;
    height: 297px;
    display: inline-block;
    *display: inline;
    zoom: 1;
    position: relative;
    text-align: left;
    margin-bottom: 25px;
}
.postExcerpt h2 {
    font-size: .95em;
    text-align: left;
}
.postExcerptInner {
    width: 267px;
    height: 297px;
    float: left;
    -webkit-border-radius: 10px;
    -khtml-border-radius: 10px;
    -moz-border-radius: 10px;
    -ms-border-radius: 10px;
    -o-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow: 0 0 5px #d2d2d3;
    -khtml-box-shadow: 0 0 5px #d2d2d3;
    -moz-box-shadow: 0 0 5px #d2d2d3;
    -ms-box-shadow: 0 0 5px #d2d2d3;
    -o-box-shadow: 0 0 5px #d2d2d3;
    box-shadow: 0 0 5px #d2d2d3;
    -webkit-transition: background .1s ease-out;
    -khtml-transition: background .1s ease-out;
    -moz-transition: background .1s ease-out;
    -ms-transition: background .1s ease-out;
    -o-transition: background .1s ease-out;
    transition: background .1s ease-out;
}	
.audio .postExcerptInner {
    background-color: #464646;
}
.audio .titleAndCat {
    border-bottom: 1px solid white;
}
.audio .cat {
    color: #9b9b9b;
}
.audio h2 {
    color: white;
}

.audio .audioPlayer {
    position: relative;
    top: 55px;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
}
.audio .playAudio {
    background-position: 0 -257px;
    height: 43px;
    width: 43px;
    display: block;
    position: absolute;
    top: 20px;
    left: 15px;
    text-indent: -9999px;
}
.audio .playAudio:hover {
    background-position: -209px -257px;
}
.audio .playAudio:active {
    background-position: -102px -257px;
}
.audio .playAudio.playing {
    background-position: 0 -306px;
}
.audio .playAudio.playing:hover {
    background-position: -209px -306px;
}
.audio .playAudio.playing:active {
    background-position: -102px -306px;
}
.audio .progressBarWrap:hover, .audio .soundBarWrap:hover {
    cursor: hand;
    cursor: pointer;
}
.audio .progressBarWrap {
    width: 110px;
    height: 5px;
    padding: 5px 0;
    background: 
    position: absolute;
    top: 33px;
    left: 65px;
}
.audio .soundBarWrap {
    width: 30px;
    height: 5px;
    padding: 5px 0;
    background: 
    position: absolute;
    top: 33px;
    left: 220px;
}

.audio .progressBar, .audio .soundBar {
    background: 
    height: 5px;
    max-width: 100%;
}
.audio .progressBar {
    width: 0%;
}
.audio .mute {
    background-position: 0 -358px;
    width: 14px;
    height: 10px;
    display: block;
    position: absolute;
    top: 37px;
    left: 200px;
    text-indent: -9999px;
}
.logo, .playVideo, .view, .read, .playAudio, .mute {
    background: url('<?php echo UOOT;?>/Public/app/css/buttonsAndLogo.png') no-repeat;
}

.audio .progressBar, .audio .soundBar {
    background: url('<?php echo UOOT;?>/Public/app/images/classIcon/vedio-pro.png') repeat-x;
    height: 5px;
    max-width: 100%;
}
.audio .muted {
    background-position: -209px -358px;
}
.audio .halfVolume {
    background-position: -102px -358px;
}	
	
</style>
</head>
<body>
	<div class="ks-wrap" id="ksBoxContent">
<?php include  CURR_VIEW_PATH . "head.php";?> 
<div class="courseBox clearfix mt20">
   <div class="lLightBox bg-white bRadius10  borderSo">
       <?php include  CURR_VIEW_PATH . "menu.php";?> 
   </div>
   <div class="lRightBox ml20">
      <div class="sRightBox   ">
		 <div class="infoBox">
		 	<div class="form-tip bg-white class-pd bRadius10 ks-wbox mb20 clearfix">
			  <a href="javascript:history.go(-1)" style="cursor: pointer;">
						<span class="fl ks-ss"><i class="iconfont icon-jiantou-copy"></i></span>
						<div class="form-tip-word fl">作业批改<i class="ks-back">/查看学生作业情况 </i></div>
					</a>
			   <div >
			
			
				</div>					
			</div>
			<!--end-->

		 	
		    <div class="stuConBox  ">
			     <div class="studentBox" style="display:block;">
					
                 <div id="lisHeight" class="ks-wbox bRadius10" style="text-align: center;">
                 	
                 	
						 <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','currect1', $taskanswer['id'],GP('classid-'.$this->classid)); ?>" method="post" id="myform">
						 	
				<!--	作业题目	-->
						    <div class="course-box mt20">
							  	<div class="course-title">题目：<?php echo $task['title']; ?></div>
							  	<div class="course-title">内容：<?php echo $task['content']; ?></div>
							  	附件：
							  
							  <?php  if(isset($files))foreach($files as $k=>$v){ 
			   
			   if($v['type']==2){?>
								 <div class="exercise-box" style="text-align: center;">
							    	 <video src="<?php echo $v['filePath']; ?>" controls="controls"  style="height: 350px;width: 350px; display: inline-block;">
													<div class="exercise-title"></div>
													<div class="exercise-img">
														<div class="class-gray">
															<div class="port-play"></div>
														</div>
														<img src="<?php echo $v['src']; ?>">
													</div>
										 </video>			
								</div>
								  <?php }else{ ?>
								 <div class="ks-listbox">
									<a class="ks-list" href="<?php echo UROOT.$v['filePath']; ?>">
									<div>
										<img src="<?php echo $v['src']; ?>" />
									</div>
									<div>
										<?php  echo $v['filename'];  ?>
									</div>
									</a>
							
								</div> 
				<?php  } }  ?>	
					  		 
					  	</div>
            
						 
						 	
						 	
						 	
						 	
					<!--	学生回答	 --> 
							  <div class="course-box mt20">
							  	<div class="course-title">学生回答：<?php echo $taskanswer['contents']; ?></div>
							  	附件：
							  	<?php if(!empty($taskanswer['file'])){ ?>
							  	<a href="/Images/<?php echo $taskanswer['file']; ?>">
							  	<div class="course-pirtrue"><img src="<?php echo UOOT;?>Public/app/images/classIcon/zip.png"></div></a>
							  	<?php }else{echo '无'; } ?>
							  	<div class="course-input mt20">评分：<input type="text" name="score" class="form-textbox w150" value="<?php echo $taskanswer['score']; ?>">
							  		<div>教师评价：
							  	<textarea name="evaluate" class="form-textbox"><?php echo $taskanswer['evaluate']; ?></textarea></div>	
							  		<button class="ks-bt bt-pue ml20" style="display: inline-block;float: none;">确定</button> 
							  	</div>
                            </div>
                            
                            
						  </form>
					 </div>
				 
						  </form>
						
					  </div>
				 </div>
			 </div>
			

		 </div>
	  </div>
   </div>
</div>
</div>


<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
function submitform(){
	$('#myform').submit();
}	
	
$('.class-sp,.class-choice').hover(function(){
	$('.class-choice').show()
},function(){
	$('.class-choice').hide();
});
		
IncreaseClass(257,'.lLightBox','.liveCsecond','.liveCsecond');/*左侧高度+左侧二级栏目*/
tapsAction('.stuTitleTab','.infoBox','.stuConBox','.studentBox');/*选项卡*/
var selectInputs = $('.chackInput');
var checkAllInputs = $('.check-all');
selectall(selectInputs,checkAllInputs);



function Release(id){
	var url = '<?php  echo  M_URL($this->AppName.'/Ajax','Release','',GP('')); ?>';
	$.ajax({
		type:"post",
		url:url,
		data:{
			'id':id,
		},
		success:function(data){
            if(data='success'){
            	
            	$('#b'+id).remove();
            	$('#c'+id).text('状态:发布');
            }
		},
	   
	 });
}


</script>
</body>
</html>