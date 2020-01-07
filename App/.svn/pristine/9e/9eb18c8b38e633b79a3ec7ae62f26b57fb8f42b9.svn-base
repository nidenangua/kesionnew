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
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.courseList li{ position:relative; padding-left:260px;min-height:189px;padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom:1px solid #eee;}
.courseList li .tface{width:189px;height:189px; position:absolute;left:40px;top:20px; text-align:center;}
.teacherInfo{ padding-top:6px; padding-bottom:6px; margin-top:5px;}
.TcTab{ height:35px; border-bottom:1px solid #128fd1;}
.TcTab li{ width:72px;text-align:center;line-height:35px; margin-left:20px; font-size:16px; cursor:pointer;}
.TcTab li.curr{ background:#128fd1; color:#fff;}
.TcTab li a {display:block;width:72px;}
.TcTab li.curr a {color:#fff}
.cbtn{ float:left; width:60px; height:25px; line-height:25px; color:#1ab394; border:1px solid #1ab394; text-align:center; font-size:14px; border-radius:3px;}
.addcbtn{ float:left; width:60px; height:25px; line-height:25px; color:#fff;border:1px solid #1ab394; background:#1ab394; text-align:center; font-size:14px; border-radius:3px;}
.bg-1a{ background:#1ab394;}
.TcTabBox .courseList{ display:none;}
.btn-primary{
background-color: #18a689;
border-color: #18a689;
color: #FFF;
}
.btn-w-m {
min-width: 120px;
}
.btn{
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
@media screen and (max-width: 1180px){
.w100 {width:60px}
}
</style>
</head>
<body class="bg-gary">
<ul class="liveTab clearfix mb30" style="padding-top:25px">
    <li class="fl curr">
        <a href="<?php echo M_URL('course/index','replyCourse','',GP(''))  ?>" class="alignCenter">
            <span class="block cmIcon hLh40"></span>
            <span class="block hLh35 fsize14">课程管理</span>
        </a>
    </li>
</ul>
<label class="mr5">
				   <span class="c-92 mr10 fsize14">分类</span>
				   <select class="w150 inputText bRadius5 selectd"  onchange="getval(this,'<?php echo GP('p-'.$page->now_page); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','categoryid','<?php echo URL_MODEL;?>')">
					<?php
					  if(isset($category)){ 
						echo "<option value='0'>请选择</option>";
						foreach($category as $k=>$v){
						   $html = "<option value='$v[categoryid]' ";if($v['categoryid']==$categoryid){$html=$html."selected = 'selected'";}$html=$html.">".KS_INDENT($v['depth'])."$v[categoryname]</option>" ;
						   echo $html;
						}
					  }else{echo "<option value='0'>请选择</option>";}
					?>
				   </select>
				</label>
				<label class="mr5">
				   <select class="w150 inputText bRadius5">
			            <option value="0">请选择</option>
					    <option value="1">课程名</option>
					    <option value="2">老师</option>
					    <option value="3">机构</option>
			            <option value="4">学生</option>
				   </select>
				   
				</label>
				<form target="hidframe"  class="fr">
					<input type="text" class="inputText mr5 fl" name="searchText">
					<input type="button" class="ks-bt bt-def" name="searchBtn" value="搜索">
				</form>
</div>
<div class="clear"></div>
<form>
<div class="topCourseBox contentBox mt30 clearfix">
	<div class="TcTabBox bg-white">
	   <ul class="courseList" style="display:block;"> 
     <?php foreach($course as $v){ ?>
		  <li class="clearfix posRe">
		  
			  <em class="posAb fsize16 c-92" style="left:20px;top:20px;">
				  <div class="order-product pd-b"><input type="checkbox" class="verAlignMiddle mr10" name="coursebox"  tt ="<?php echo $v['defaultpic'];?>" value="<?php echo $v['courseid'];?>"></div>
              </em>
			  <div class="tface">
				  <input type="hidden"  value="<?php echo $v['courseid'];?>">
				<img onerror="this.src='<?php echo nopic();?>'" src="<?php if($v["defaultpic"]!=''){echo $v["defaultpic"];}else{echo '/Public/uploads/common/nopic.gif';}?>"  style="width:100%;height:100%;"  >
			  </div>
			   <div>
				  <div class="hLh40">
                   <span class="fsize16 c-red"><?php echo $v['title'];?></span>
				  </div>
			  <div>
				  <div class="hLh40">
				  
				   <span class="fsize14 c-red"><?php echo $v['price'];?></span>
				   <span class="ml50 fsize14 c-92">进度：<font class="c-green">50%</font></span>
				</div>
			  </div>
			  <div>
			       <span class="block hLh30 fsize14 c-92">主讲老师：Carrie</span>
				   <span class="block hLh30 fsize14 c-92">评论数1：50条</span>
			  </div>
			   <a href="<?php echo M_URL($this->AppName.'/index','period',$v['courseid'],GP(''));?>">		
			  <div class="clearfix posRe">
				<div class="fl borderSo w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">课程</span>
					 <span class="block">1门</span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe673;</div>
				</div>
				</a>
				<div class="fl borderSo ml30 w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">资料</span>
					 <span class="block">1份</span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe604;</div>
				</div>
				<a href="<?php echo M_URL($this->AppName.'/index','exam',$v['courseid'],GP(''));?>">	
				<div class="fl borderSo ml30 w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">考卷</span>
					 <span class="block">2个</span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe612;</div>
				</div>
				</a>
				 <a href="<?php echo M_URL($this->AppName.'/index','teacher',$v['courseid'],GP(''));?>">		
				<div class="fl borderSo ml30 w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">老师</span>
					 <span class="block">1个</span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe603;</div>
				</div>
				<div class="fl borderSo ml30 w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">课程</span>
					 <span class="block"><?php if(empty($v['media_id'])){echo "未上传";}else{echo "已经上传";}?></span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe603;</div>
				</div>
			  </div>
			  </a>
		  </li>
		<?php } ?>
	</ul>
       <div class="footer-page"><?php echo $page->show(3); ?></div>
	<input type="button" class="generalBtn c-fff fsize16 bRadius5" id="abc"  value="确认" name="confirm" />
	</div>
    </form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
$(function(){
	$(".liveTab li:first").css("border-right",0);
})
tapsAction('.TcTab','.contentBox','.TcTabBox','.courseList');/*复用选项卡*/
loadScorllJs()//滚轮；
var selectInputs = $('.verAlignMiddle'); 
	var checkAllInputs = $('.check-all');
	selectall(selectInputs,checkAllInputs);/*全选*/

$("#abc").click(function(){
	
		var checkVal = '';
		var checkIndex = 0;
		$('input[name="coursebox"]:checked').each(function(){
			if(checkIndex==0){
				checkVal += $(this).val();
		
			
			}else{
				checkVal += ','+$(this).val();
			};
			checkIndex++;
		
	});
		
				
        var topId = '<?php echo $ab ?>';
		
  	    top.frames["main"].$("#"+topId+"").val(checkVal);
		
		top.closePopup('all');

	});
</script>
</body>
</html>
