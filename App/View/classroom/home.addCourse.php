<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10 ks-wbox">
	
	<div id="ksBoxHead">
		<div class="generalTitle clearfix">
		    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
	        <span class="gTitle fsize18"><?php if(!empty($noticeinfo)){echo "修改课程信息";}else{echo "添加课程信息";} ?></span>
		    <div class="fr">
		    	<!--按钮块--->
				<a class="ks-bt bt-def " href="javascript:history.go(-1);"><i class="iconfont icon-fanhui"></i>返回</a>
				<!--按钮块--->
		    </div>
		</div>
		<!--结束-->

	</div>
	<form target="hidframe" method="post" id="myform" enctype="multipart/form-data" action="<?php if(!empty($courseinfo)){echo M_URL($this->AppName.'/Index','doeditCourse',$classroomid,GP(''));}else{echo M_URL($this->AppName.'/Index','doaddCourse',$classroomid,GP(''));} ?>">
		<div>
			<div class="form-box form-upload-box tab-pane" style="display:block">
				<div class="form-row">        		             
					<div class="form-row">
						<span class="name"><i class="form-star">*</i>课程名称:</span>
						<input type="text" class="form-textbox"  name="coursename" style="width: 389px;" value="<?php if(!empty($courseinfo)) echo $courseinfo['coursename'] ?>" />
					</div>					         
                </div>
                <div class="form-row">
              		<label class="name"><i class="form-star">*</i>选择上课老师:</label></br></br>           		
              		<select class="w150 inputText bRadius5" name="teacherid">
              			<?php foreach($teacher as $k => $v){?>
              			<option value="<?php echo $v['userid'];?>" <?php if(!empty($courseinfo)){if( $courseinfo['teacherid']==$v['userid']){?>selected="selected"<?php }}?>><?php echo $v['name'];?></option>
              			<?php };?>
              		</select>         
                </div>
                <div class="form-row">        		             
					<div class="form-row">
						<span class="name"><i class="form-star">*</i>上课地点:</span>
						<input type="text" class="form-textbox"  name="classplace" style="width: 389px;" value="<?php if(!empty($courseinfo)) echo $courseinfo['classplace'] ?>" />
					</div>					         
                </div>
				 <div  class="form-row clearfix">
				    <div  class="name">上课时间</div >
					<div  class="rightTd alignLife">
					 	<input id="start" type="text" name="starttime" value="<?php if(!empty($courseinfo)){echo date("Y/m/d H:i:s",$courseinfo["starttime"]+8*3600);} ?>" class=" start laydate-icon bRadius5 w300 c-79">
					</div >
		   		</div >
		   		<div  class="form-row clearfix">
				    <div  class="name">下课时间</div >
					<div  class="rightTd alignLife">
					 	<input id="end" type="text" name="endtime" value="<?php if(!empty($courseinfo)){echo date("Y/m/d H:i:s",$courseinfo["endtime"]+8*3600);} ?>" class=" start laydate-icon bRadius5 w300 c-79">
					</div >
		   		</div >
                <div class="form-row clearfix">
	                <span class="name"><i class="form-star">*</i>是否上架:</span>
                    <label for="powertype0"><input type="radio" id="powertype0" value="0" name="status" <?php  if(!empty($courseinfo)){if($courseinfo['status']==0) echo "checked";}?> >不上架</label>
                    <label for="powertype1"><input type="radio" id="powertype1" value="1" name="status" <?php  if(!empty($courseinfo)){if($courseinfo['status']==1) echo "checked";}?> >上架</label>
	            </div>
	            <div class="form-row clearfix">
	                <span class="name"><i class="form-star">*</i>上课形式:</span>
                    <label for="powertype0"><input type="radio" id="powertype0" value="0" name="coursetype" <?php  if(!empty($courseinfo)){if($courseinfo['status']==0) echo "checked";}?> >面授</label>
                    <label for="powertype1"><input type="radio" id="powertype1" value="1" name="coursetype" <?php  if(!empty($courseinfo)){if($courseinfo['status']==1) echo "checked";}?> >直播</label>
	            </div>
			</div>
    </div>
	<div id="ksBoxFooter">
		<div class="form-footer clearfix">
			<span class="d-inline-block">
		        <button type="submit" onclick="do_reg()" class="ks-bt bt-pue"><?php if(!empty($courseinfo)){echo "确认修改";}else{echo "确认添加";} ?></button>
		        <button onclick="javascript:history.go(-1);" class="ks-bt bt-def">取消</button>
	    	</span>
		</div>
	</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript">
	$(".nav-ul li").click(function(){
	$(".nav-ul li").removeClass("curr");
	$(this).addClass("curr");
	var index= $(this).index();
	$(".tab-pane").hide();
	$(".tab-pane").eq(index).show();
	
});	
</script>

<script>
function do_reg(){
	
	$("#myform").submit();
	
};

   IncreaseClass();
   starttime('#start');
   endtime('#end');
 
</script>
</body>
</html> 