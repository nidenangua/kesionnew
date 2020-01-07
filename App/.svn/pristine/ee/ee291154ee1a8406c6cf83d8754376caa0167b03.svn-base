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
				
			<!--START HEAD-->
				<div class="clearfix">
					<div class="form-tip clearfix">
						<span class="form-tip-blick fl"></span>
						<span class="form-tip-word fl">班级教师</span>
						<span class="fr">
							<a href="javascript:void(0)" class="ks-bt bt-def mr10" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addTeacher',$classroomid,GP('')) ?>','850px','600px',{title:'选择学员',type:'top'})" id="addTeacher">
							<i class="iconfont icon-jiahao"></i>教师</a>
							<div class="fr ks-top-search">
						<!--搜索-->
						<div class="speed-search fl clearfix" >					
							<div class="leftTd alignLife fsize12 c-92   fl">
								<select class="w150 inputText bRadius5 selectd" name="courseIntor"  id="keytype">
									<option value="1">教师名称</option>
								</select>
							</div>
						</div>
						<form target="hidframe"  class="fr">
							<div class="ks-top-search">
								<input type="text" class="sc-text"  name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
								<input type="submit" class="sc-button"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','showTeacher',$classroomid); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索" >
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
								<div id="lisHeight" class="p20">
									<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batchTeacher',$classroomid,GP('classroomid-'.$classroomid)) ?>" method="post" id="myform">
									 
									<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
										<tr>
											<th><input name="" type="checkbox" value="" class="verAlignMiddle checkall check-all" id="selectAll"></th>
											<th>老师姓名</th>
											<th>性别</th>
											<th >加入时间</th>
											<th >操作</th>
										</tr>
										  
										<?php foreach($values as $k=>$v){ ?>
										<tr>
											<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
            									<input type="checkbox" class="select-check" name="check[]" value="<?php echo Field($v['id']);?>">
            								</td>
											<td><?php echo Field($v['name'])?></td>
											<td><?php echo Field($v['Sex'])?></td>
											<td><?php echo Field(date("Y-m-d H:i",$v['adddate']))?></td>
											<td>
												<a href="javascript:void(0);" class="c-92 pr10 pl10 r-icon posRe"  onclick="Confirm('是否删除此教师？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delTeacher',$v['id'],GP('classroomid-'.$classroomid)) ?>')">
												<em>删除<i class="arrow-down"></i></em><i class="iconfont icon-shanchu1"></i></a>
											</td>
										</tr>
										<?php } ?>
									 
									</table>
								
								<?php echo NoC($values);?> 
								<input type="hidden" name="batch" id="batch1" />
								</form>
								</div>
							</div>
							
							<div class="studentBox">
								<div class="ml20 pb20 fr mt-20">
									<div class="speed-search fl clearfix" > 
										<div class="leftTd alignRight fsize16 c-666 w180 pr20  fl" style="padding-top:7px">快速搜索</div>
										<div class="leftTd alignLife fsize12 c-92 pr10  fl">
											<select class="inputText pl20 w180 bRadius5" name="courseIntor">
												<option >教师名称</option>
											</select>
										</div>
									</div>  
								</div>	 
							</div>
						</div>
					</div>
				</div>
			</div>
		
			<div id="ksBoxFooter">
				<div class="ks-bom clearfix">
					<span class="fl">
						<button type="button" class="ks-bt bt-pue" onclick="submitform()" ><i class="iconfont icon-shanchu1"></i>批量删除</button>
					</span>
					<?php echo $page->show(3); ?>
				</div>
			</div>
		</div>
	</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script>

tapsAction('.stuTitleTab','.infoBox','.stuConBox','.studentBox');/*选项卡*/
function submitform(){
	$('#myform').submit();
}
$.cookie('student','',{ expires: -1, path: '/'}); 
var student = $.cookie('student');

</script>
</body>
</html>
