<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<style type="text/css">
	.Porel{ position: relative;}
	.Poabs{ position: absolute;}
	.Pofix{ position: fixed;}
	.ToPr1812{top: -17px; right: -12px;opacity: 0; transition: all 0.6s;color: black;}
	#knowledge li{ padding:10px 15px  2px 0px; float: left;}
	#knowledge li :hover .ToPr1812{ opacity: 1;}
	.topCourseBox { padding: 20px 320px 20px 220px;position: relative; background: #FFFFFF;}   
	.topCourseBox-right{position: absolute;height: 120px; top: 20px; right: 0px;}
	.topCourseBox-bottom{position: absolute;height: 30px; bottom: 20px; right: 0px; line-height: 30px; width: 420px;}
	.topCourseBox-img{width: 200px; height: 120px; position: absolute; left: 20px; top: 20px; cursor:pointer;}   
	.Tabcrow{ width: 600px;}  
	.topCourseCont{ position: relative; padding-left: 240px;}   
	.topCourseCont-left{position: absolute;  left: 20px; top: 0px; height:100%;}  
	.topCourseCont-right{ height:130px; overflow: auto; position:relative ; left:150px;} 
</style>
<div id="ksBoxHead">
<?php if(isset($classroominfo)){ ?> 
	<div class="topCourseBox  clearfix bRadius10">
		<div class="topCourseBox-img" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic,type-top,classroomid-'.$classroomid));?>','930px','610px',{title:'选择图片',type:'top'});">
			<img onerror="this.src='<?php echo nopic();?>'" src="<?php if($classroominfo["defaultpic"]!=''){echo Img($classroominfo["defaultpic"]);}else{echo '/Public/uploads/common/nopic.gif';} ?>" class="defaultpic" width="100%" height="100%">	
		</div>
		<?php if(ACTION !='editClassroom' ){ ?>
			<input type="hidden" name="defaultpic">
		<?php } ?>	
		
		<div  class="topCourseCont">
			<div class="topCourseCont-left">
				<div class="clearfix"><span class="fl fsize16 c-333 hLh30"><?php echo $classroominfo['classroomname']; ?></span></div>
				<div class="mt10"><span class="fsize14 c-92">老师人数：<?php echo $classroominfo['teachernum'] ?></span><span class="fsize14 c-92 ml20">学员人数：<?php echo $classroominfo['studentnum'] ?>个</span><span class="fsize14 c-92 ml20">公告数：<?php echo $classroominfo['noticenum'] ?>条</span></div>
				<div class="mt20">
				<span class="csrom-neckStaus">班级状态</span>
					<?php if($classroominfo['classroomstatus'] ==0){$classroomstatus = '<span style="color:red;">未审</span>';}else if($classroominfo['classroomstatus'] ==1){$classroomstatus = '已审';}else{$classroomstatus = '已过期';}?>
				    <?php echo $classroomstatus;?>
				</div>
			</div>
			
			<div  class="topCourseCont-right">    
				<div class="clearfix"><a href="<?php echo M_URL($this->AppName.'/Index','addNotice',$classroomid,GP('')) ?>')" class="ks-bt c-fff  bg-2d" id="addNotice"><i class="iconfont icon-jiahao"></i>班级公告</a></div>			
				<div class="clearfix"><ul  id="knowledge"></ul ></div>
			</div >
		</div>
	 
         
	<div class="topCourseBox-right">
		<div  class="form-row mr20 clearfix">
			
			<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="ks-bt bt-def ml20"><i class="iconfont icon-fanhui"></i>返回</a>
		</div>
		
		
	</div>
	  

	   
	   
	</div>

	
<?php }?>
	</div>

	
<script>

function addCourseKpoint(url){

	$.cookie('addKption<?php echo $courseid; ?>','',{ expires: -1 });
    addTypeChange(url,'800px','600px')

};
function delKption(id){

	var a = '<?php echo $course['kpoint'] ?>';
	  $.ajax({
			type:"POST",
			url:"<?php echo UOOT; ?>Plus/Kesion.ajax.php?act=delkption",
			data:{kption:a,courseid:<?php echo $courseid; ?>,kpointid:id},
			success:function(text){
				if(text == 'ok'){
				 $("#kption"+id).remove();
				}
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	 }); 
	
}	
<?php if($course['kpoint']!=''){ ?>
	  var kption = '<?php echo $course['kpoint']; ?>';
	
         $('.chapterKption').remove();
	  $.ajax({
			type:"POST",
			url:"<?php echo UOOT; ?>Plus/Kesion.ajax.php?act=getkption",
			data:{kption:kption},
			success:function(text){
				parent.closePopup('all');
		       	$('#knowledge').append(text);
		       	colorRadom();
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	 }); 
	 
	
<?php } ?>	
function colorRadom(){
	
console.log('ssss');

$("#knowledge li").each(function(){
	//颜色字符串  
	var colorStr="";  
	//字符串的每一字符的范围  
	var randomArr=['188eee','118fd1','FFA500','FF3E96','FF4040','44B549','FF4040','2db7f5','44B549','FF4040']; 
	//产生一个六位的字符串 
	var num = Math.ceil(Math.random()*9);
 	colorStr=randomArr[num];
 	console.log(num);
	
	$(this).find(".ks-bt").css({
		"background":"#"+colorStr,
		"border": "1px solid #"+colorStr,
		"color":"#ffffff" 
	})
	
	
})
}
  
</script>	
	<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script> 
