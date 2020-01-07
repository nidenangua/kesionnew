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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.r-icon em{width:40px;height:22px;line-height:22px;text-align:center;color:#fff;position:absolute;top:-30px;left:50%;margin-left:-20px;background:#1a1a1a;border-radius:3px;font-size:12px;display:none}
.r-icon em .arrow-down{width:8px;height:4px;position:absolute;left:50%;margin-left:-4px;bottom:-4px;background:url(<?php echo UOOT;?>images/arrow-down.png) no-repeat}
.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;border:1px solid transparent;border-radius:4px}
.btn-w-m{min-width:120px}
.btn-primary{background-color:#18a689;border-color:#18a689;color:#FFF}
.pos7{position:relative;top:5px}
</style>
</head>
<body class="ks-wrap" data-content="view">
	<?php include  CURR_VIEW_PATH . "head.php";?> 
	<div class="courseBox clearfix mt20">
		<div class="lLightBox bg-white bRadius10  borderSo">
		<?php include  CURR_VIEW_PATH . "menu.php";?> 
		</div>   
		<div class="lRightBox ml20">
			<div class="bRadius10 bg-white ks-wbox ">  
		<form target="hidframe" method="post" id="myform" enctype="multipart/form-data" action="<?php if(!empty($noticeinfo)){echo M_URL($this->AppName.'/Index','doeditNotice',$classroomid,GP('$noticeid-'.$noticeid));}else{echo M_URL($this->AppName.'/Index','doaddNotice',$classroomid,GP(''));} ?>">
		<div id="ksBoxContent" class="view-content" >
			<div class="form-box form-upload-box tab-pane" style="display:block">
				<div class="form-row">        		             
					<div class="form-row">
						<span class="name"><i class="form-star">*</i>公告标题:</span>
						<input type="text" class="form-textbox"  name="noticetitle" style="width: 389px;" value="<?php if(!empty($noticeinfo)) echo $noticeinfo['noticetitle'] ?>" />
					</div>					         
                </div>
				<div class="form-row">
              		<label class="name"><i class="form-star">*</i>公告内容:</label></br></br>
              		<div  class="rightTd alignLife">
						<?php echo $kindeditor;?>
					</div>
                </div>
                <div class="form-row clearfix">
	                <span class="name"><i class="form-star">*</i>是否发布:</span>
                    <label for="powertype0"><input type="radio" id="powertype0" value="0" name="status" <?php  if(!empty($noticeinfo)){if($noticeinfo['status']==0) echo "checked";}?> >不发布</label>
                    <label for="powertype1"><input type="radio" id="powertype1" value="1" name="status" <?php  if(!empty($noticeinfo)){if($noticeinfo['status']==1) echo "checked";}?> >发布</label>
	            </div>
                <div  class="form-row clearfix">
			    <div  class="name"><i class="form-star">*</i>发布时间</div >
				<div  class="rightTd alignLife">
				 	<input id="start" type="text" name="adddate" value="<?php if(!empty($noticeinfo)){echo date("Y/m/d H:i:s",$noticeinfo["adddate"]+8*3600);} ?>" class=" start laydate-icon bRadius5 w300 c-79">
				</div >
		   	</div >
			</div>
    </div>
	<div id="ksBoxFooter">
		<div class="form-footer clearfix" style="border:0"> 
			<span class="d-inline-block">
		        <button type="submit" onclick="do_reg()" class="ks-bt bt-pue"><?php if(!empty($noticeinfo)){echo "确认修改";}else{echo "确认添加";} ?></button>
		        <button onclick="javascript:history.go(-1);" class="ks-bt bt-def">取消</button>
	    	</span>
		</div>
	</div>
</form>
			</div>
		

		</div>
	</div>
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
   starttime1('#start1');
function starttime1(idname){  
   laydate({
	elem:idname,
	format: 'YYYY/MM/DD hh:mm:ss',
	min: laydate.now(), 
	max: '2099-06-16 23:59:59', 
	istime: true,
	istoday: false,
	choose: function(datas){
		 end.min = datas; 
		 end.start = datas 
		}
	});
    
} 
</script>
</body>
</html>
