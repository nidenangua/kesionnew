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
<link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
	.class-simg{padding-right: 20px;}
	.class-cion{color:#E63BC8;padding-left: 5px;}
	.ks-head-content:before{left: 325px!important;}
</style>
</head>
<body data-content="view">
<div style="padding: 25px;">
	<?php include  CURR_VIEW_PATH . "head.php";?> 
	<div class="courseBox clearfix mt20">
		<div class="lLightBox bg-white bRadius10  borderSo">
		<?php include  CURR_VIEW_PATH . "menu.php";?> 
		</div>   
		<div class="lRightBox ml20">
			<div>  
				
			<!--START HEAD-->
				<div class="clearfix bRadius10 bg-white">
					<div class="form-tip  bRadius10 bg-white class-pd clearfix ks-wbox ">
					 <a href="javascript:history.go(-1)" style="cursor: pointer;">
					 	
						<span class="fl ks-ss"><i class="iconfont icon-jiantou-copy"></i></span>
						<div class="form-tip-word fl">作业批改<i class="ks-back">/</i><?php echo $task['title']; ?></div>
					</a>
					
					<ul class="fr ml10">
						<li></li>
						<li style="position: relative;" class="fr gameScreen"><button onclick="choiceClick(this)" class="ks-bt bt-pue"><i style="color: #FFF;" class="iconfont icon-filter-2 fn"></i></button>
							<ul class="H5-gameScreen ks-head-content"style="top: 60px;width: 360px;margin-left: -310px;">
								<li>
									<span>作业类型：</span>
									<div>
										<a >所有类型</a>
										<a >在线做题</a>
										<a >材料作业</a>
										<a >线下作业</a>
		
									</div>
								</li>
		
								<li>
									<span>批改方式：</span>
									<div>
										<a >不限</a>
										<a >教师批改</a>
										<a >自动批改</a>
									
									</div>
								</li>
								<li>
									<span>状态：</span>
									<div>
										<a >不限</a>
										<a >未批阅</a>
										<a >批阅中</a>
										<a >已批阅</a>
									</div>
								</li>
								<li>
									<span>老师：</span>
									<div>
										<a>所有老师</a>
										<a >刘娜老师</a>
									</div>
								</li>	
		
		
							</ul>
		
						</li>				
					</ul>
				
						<span class="fr">
							<a href="javascript:void(0)" class="ks-bt bt-def mr10" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addCourseStudent',$this->classid,GP('')) ?>','850px','600px',{title:'选择学员',type:'top'})" id="addStudent">
							<i class="iconfont icon-jiahao"></i>学员</a>
							<div class="fr ks-top-search">
						<!--搜索-->
						
						<form target="hidframe"  class="fr">
							<div class="ks-top-search">
								<input type="text" class="sc-text"  name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
								<input type="submit" class="sc-button"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','student',$this->classid); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索" >
							</div>
						</form>
						
						<!--搜索-->
						
					</div>
						</span>
					</div> 
				</div>
				
				<!--END HEAD-->
				<div class=" bRadius10 borderSo">
					<div class="infoBox">
						<div class="stuConBox">
							<div class="studentBox" style="display:block;">
								<div id="lisHeight" class="p20 bg-white bRadius10">
									<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','delMemberTask',$task['id'],GP('classid-'.$this->classid)) ?>" method="post" id="myform">
									 
									<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
										
				<?php  foreach($answer as $k=>$v){  ?>						
										<tr>
										<td style="width: 30px;"><div class="fl "><input type="checkbox" class="select-check" name="aid[]" value="<?php echo $v['id'] ?>" ></div> </td>
							<td class="alignLife" style="width: 35%;" >
								<div class="fl class-simg"><img src="<?php echo $this->upload->getHead($v['memberid']);?>"></div>
								<div class="class-stxt fl">
									<div class="class-sname"><?php echo $v['memberInfo']['name']; ?> <?php if($v['memberInfo']['Sex']==1){ ?><i class="iconfont icon-nan "></i> <?php }elseif($v['memberInfo']['Sex']==2){ ?><i class="iconfont icon-nv class-cion"></i><?php } ?></div>
									<div class="class-sphone">提交时间：<?php echo date('Y-m-d h:i:s',$v['adddate']); ?></div>
									<div class="class-small">添加老师：<?php echo $task['inputer']; ?></div>
									
								</div>				
												
								</td>
								<td class="alignLife">
									<div class="class-sname"></div>
									<div class="class-sname">作业类型：<?php if($task['taskstyle']==1){echo '材料作业';}elseif($task['taskstyle']==2){echo '在线做题';}else{ echo '其他';} ?></div>
									<div class="class-sphone">批改方式：教师批改</div>
								</td>
							  <td class="alignLife">
							  		<div class="class-sname"></div>
									<div class="class-sname">成绩：<span class="c-86A8F">  <?php  if($v['score'] == 0){ echo '批阅中';}else{ echo $v['score']; } ?></span></div>
									<div class="class-sphone">截止时间：<?php echo date('Y-m-d h:i:s',$task['enddate']); ?></div>
								</td>
							
								<td >
									
									<a  href="<?php echo M_URL($this->AppName.'/Index','seeTask',$v['id'],GP('')) ?>" class="c-86A8F">开始批阅</a>	
								</td>
										</tr>
					<?php } ?>					
									 
									</table>
								<?php echo NoC($answer);?>
							<input type="hidden" name="batch" id="batch1" />
							
								</form>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
			<?php if(count($answer)!=0){ ?>
				<div class="ks-bom ks-fixed-bom clearfix" >
					<label for="" class="fl"><input type="checkbox" id="selectAll">全选</label>
					<span class="fl ">
						<button type="button" class="ks-bt bt-pue" onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i>批量删除</button>
						
					</span>
					<div class="fr"></div>
		
				</div>
			<?php } ?>
				
				
		</div>
		
		</div>
	</div>


		
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script>

tapsAction('.stuTitleTab','.infoBox','.stuConBox','.studentBox');/*选项卡*/
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}
$.cookie('student','',{ expires: -1, path: '/'}); 
var student = $.cookie('student');

//  addrecord
$('.ks-table').find('.class-addnote').click(function(){
	$(this).parents('td').find('.form-row').show();
	$(this).parents('td').find('.class-ncon').hide();
	$(this).parents('td').find('.class-addnote').hide()
})
	$('.ks-table').find('.ks-cancle').click(function(){	
	$(this).parents('td').find('.class-ncon').show();
	$(this).parents('td').find('.class-addnote').show()	
	$(this).parents('td').find('.form-row').hide();
	
})
function addrecord(studentid,id){
 var studentVal =  $('#cord'+studentid).val(); //添加备注内容

	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','Remarks',$this->classid,GP('')) ?>",
        data:{studentid:studentid,id:id,content:studentVal},
      	
        success:function(text){
        	
          $('#txt'+studentid).html(studentVal)
           $('#txt'+studentid).show();
           $('#txt'+studentid).siblings('.class-addnote').show();
      	 $('#cord'+studentid).parent().hide()
         
        },
      
      });
    
	


	
}



</script>
</body>
</html>
