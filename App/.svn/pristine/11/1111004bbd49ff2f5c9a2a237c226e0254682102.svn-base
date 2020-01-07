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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<style>
.r-icon em {width: 40px;height: 22px;line-height: 22px;text-align: center;color: #fff;position: absolute;top: -30px;left: 50%;margin-left: -20px;background: #1a1a1a;border-radius: 3px;font-size: 12px;display: none;}
.r-icon em .arrow-down {width: 8px;height: 4px;position: absolute;left: 50%;margin-left: -4px;bottom: -4px;background: url(<?php echo UOOT;?>images/arrow-down.png) no-repeat;}
.btn {
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
.btn-w-m {
    min-width: 120px;
}
.btn-primary {
    background-color: #18a689;
    border-color: #18a689;
    color: #FFF;
}
.pos7{position:relative;top:5px}
</style>
</head>
<body class="ks-wrap" >
<?php include  CURR_VIEW_PATH . "head.php";?> 
<div class="courseBox clearfix mt20">
   <div class="lLightBox bg-white bRadius10  borderSo">
       <?php include  CURR_VIEW_PATH . "menu.php";?> 
   </div>
   <div class="lRightBox ml20">
      <div class="sRightBox  bg-white bRadius10 borderSo ks-wbox">
		 <div class="infoBox">
		 	<div class="form-tip clearfix">
			    <div class="form-tip-blick"></div>
			    <div class="form-tip-word">知识点管理</div>
			</div>
		 	
		    <div class="stuConBox">
			     <div class="studentBox" style="display:block;">
					<div class="speed-search  clearfix" >
                     	<form target="hidframe"  class="fr">
                     		<div class="ks-top-search">
								<input type="text" class="sc-text" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
								<button type="button" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','student',$courseid); ?>','<?php echo URL_MODEL;?>');"  name="searchBtn">搜索</button>
                        	</div>
					  </form>
				     </div>
                 <div id="lisHeight">
						 <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','delStudent',$courseid,GP('')) ?>" method="post">
							   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
								   <tr>
								   	<th width="10%"><input name="" type="checkbox" value="" class="verAlignMiddle checkall check-all" id="selectAll"></th>
									 <th >序号</th>
									 <th>知识点</th>
									 <th>操作</th>
								   </tr>
								  
                                  <?php if(isset($kption)){foreach($kption as $k=>$v){ ?>
								   <tr>
								   	<td width="10%"><input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>"></td>
									 <td >
                                        <?php echo Field($k+1) ?></td>
									 <td >
									    <?php echo Field($v['title']) ?>
									 </td>
	<!--								 <td><a href="javascript:void(0);" class="c-92 pr10 pl10 r-icon posRe"  onclick="Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delCourseStudent',$v['id'],GP('')) ?>')"><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></a></td>-->
									<td></td>
								   </tr>
                                   <?php }}?>
                              
                                 
								</table>
								 <?php echo NoC($kption);?>
                                 </div>
                               
						  </form>
					 </div>
				 
						  </form>
						
					  </div>
				 </div>
			 </div>
			<div class="ks-bom clearfix">
				<span class="fl">
					<button class="ks-bt bt-pue mr10" onclick="submitform();"><i class="iconfont icon-lajitong"></i>批量删除</button>
				</span>
				<?php echo $page->show(3); ?>
			</div>
		 </div>
	  </div>
   </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
IncreaseClass(257,'.lLightBox','.liveCsecond','.liveCsecond');/*左侧高度+左侧二级栏目*/
tapsAction('.stuTitleTab','.infoBox','.stuConBox','.studentBox');/*选项卡*/
var selectInputs = $('.chackInput');
var checkAllInputs = $('.check-all');
selectall(selectInputs,checkAllInputs);
loadScorllJs();
</script>
</body>
</html>
