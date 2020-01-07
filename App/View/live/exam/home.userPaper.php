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
	 a{    text-decoration: none;color: #898989;}
	.class-simg img {
	    width: 82%;
	    border-radius: 5px;
	}
	.class-simg {
	    width: 93px;
	    height: 83px;
	    border-radius: 5px;
	    overflow: hidden;
	}
	.choice-active {
	    color: #86A8F1;
	}
</style>
</head>
<body data-content="view">
<div style="padding: 25px;">
	<div class="courseBox clearfix mt20">
		<div class="">
			<div>  
				
			<!--START HEAD-->
				<div class="clearfix bRadius10 bg-white">
					<div class="form-tip  bRadius10 bg-white class-pd clearfix ks-wbox ">
					 <a href="javascript:history.go(-1)" style="cursor: pointer;">
					 	
						<span class="fl ks-ss"><i class="iconfont icon-jiantou-copy"></i></span>
						<div class="form-tip-word fl">试卷批改<i class="ks-back">/</i><?php echo $paper['Title']; ?></div>
					</a>
					
					<ul class="fr ml10" style="margin-top: 0;list-style: none;">
						<li style="position: relative;" class="fr gameScreen"><button onclick="choiceClick(this)" class="ks-bt bt-pue"><i style="color: #FFF;" class="iconfont icon-filter-2 fn"></i></button>
							<ul class="H5-gameScreen ks-head-content screen" style="top: 60px;width: 360px;margin-left: -310px;">
								<li style="    list-style: none;">
									<span>状态：</span>
									<div >
										<a href="<?php echo M_URL($this->AppName.'/Index','userPaper',$paperid,GP('status-3')); ?>" <?php if($status==3){echo 'class="choice-active"'; } ?>>不限</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','userPaper',$paperid,GP('status-0')); ?>" <?php if($status==0){echo 'class="choice-active"'; } ?>>未批阅</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','userPaper',$paperid,GP('status-1')); ?>" <?php if($status==1){echo 'class="choice-active"'; } ?>>已批阅</a>
									</div>
								</li>
								<li style="    list-style: none;">
									<span>排序：</span>
									<div >
										<a href="<?php echo M_URL($this->AppName.'/Index','userPaper',$paperid,GP('order-3')); ?>" <?php if($order==3){echo 'class="choice-active"'; } ?>>不限</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','userPaper',$paperid,GP('order-0')); ?>" <?php if($order==0){echo 'class="choice-active"'; } ?>>升序</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','userPaper',$paperid,GP('order-1')); ?>" <?php if($order==1){echo 'class="choice-active"'; } ?>>降序</a>
									</div>
								</li>
		
		
							</ul>
		
						</li>				
					</ul>
				
						<span class="fr">
							<div class="fr ks-top-search">
						<!--搜索-->
						
						<form target="hidframe"  class="fr">
							<div class="ks-top-search">
								<input type="text" class="sc-text"  name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
								<input type="submit" class="sc-button"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','userPaper',$paperid); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索" >
							</div>
						</form>
						
						<!--搜索-->
						
					</div>
						</span>
					</div> 
				</div>
				
				<!--END HEAD-->
				<div class=" bRadius10 borderSo" style="    margin-top: 35px;">
					<div class="infoBox">
						<div class="stuConBox">
							<div class="studentBox" style="display:block;">
								<div id="lisHeight" class="p20 bg-white bRadius10">
									<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','delMemberPaper',$paperid,GP('')) ?>" method="post" id="myform">
									 
									<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
										
				<?php  foreach($answer as $k=>$v){  ?>						
										<tr>
										<td style="width: 30px;"><div class="fl "><input type="checkbox" class="select-check" name="aid[]" value="<?php echo $v['id'] ?>" ></div> </td>
							<td class="alignLife" style="width: 35%;" >
								<div class="fl class-simg"><img src="<?php echo $this->upload->getHead($v['memberid'],4,0);?>"></div>
								<div class="class-stxt fl">
									<div class="class-sname"><?php echo $v['memberName']; ?> <?php if($v['memberInfo']==1){ ?><i class="iconfont icon-nan "></i> <?php }elseif($v['memberInfo']==2){ ?><i class="iconfont icon-nv class-cion"></i><?php } ?></div>
									<div class="class-sphone">提交时间：<?php echo date('Y-m-d H:i:s',$v['adddate']); ?></div>
									
								</div>				
												
								</td>
								<td class="alignLife">
									<div class="class-sname"></div>
									<div class="class-sname"></div>
								</td>
							  <td class="alignLife">
							  		<div class="class-sname"></div>
									<div class="class-sname">成绩：<span class="c-86A8F">  <?php  if($v['iscorrect'] == 0){ echo '批阅中';}else{ echo $v['score']; } ?></span></div>
								</td>
								<?php if($setting[5]==1){?>
								<td class="alignLife">
							  		<div class="class-sname"></div>
									<div class="class-sname">成绩等级：<span class="c-86A8F"> <?php if($v['gradelevel']){ echo $v['gradelevel'];}else{echo '暂无';}  ?></span></div>
								</td>
							   <?php }?>
								<td >
									
									<?php if($v['iscorrect'] == 0){?>
									<a  href="<?php echo M_URL($this->AppName.'/Index','batchPaper',$v['id'],GP('type-1')) ?>" class="c-86A8F">开始批阅</a>
									<?php }else{?>
									<a  href="<?php echo M_URL($this->AppName.'/Index','batchPaper',$v['id'],GP('type-2')) ?>" class="c-86A8F">查看</a>
									<?php }?>	
								</td>
										</tr>
					<?php } ?>					
									 
									</table>
								<?php echo NoC($answer);?>

							<input type="hidden" name="batch" id="batch1" />
							    <?php if(count($answer)!=0){ ?>
								<div class="ks-bom clearfix" style="    margin-top: 23px;">
									<label for="" class="fl"><input type="checkbox" id="selectAll">全选</label>
									<span class="fl ">
										<button type="button" class="ks-bt bt-pue" onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i></button>
										
									</span>
									<div class="fr">
										<?php echo $page->show(3); ?>
									</div>
						
								</div>
							<?php } ?>
								</form>
								</div>
								
							</div>
						
						</div>
					</div>
				</div>
			</div>
				
				
		</div>
		
		</div>
	</div>


		
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage'],function(){
	$('.add-serch-btn').click(function(){
	var $target = $('#keyword');
	($target.parent().css('display') == 'none') ? $target.parent().css({"display":"block"}) && $(this).css({"borderColor":"#476dbe","color":"#476dbe"}) : $target.parent().css({"display":"none"}) && $(this).css({"borderColor":"#dedede","color":"#5e6062"})
	});
	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
})
function submitform(type){
	inspectionCheckBox('aid[]',function(){
		$('#batch1').val(type);
		if(type===1){
			top.popup.confirm('确认要删除所选项吗？',{
				determine:function(){
					$('#myform').submit();
				}
			})
		}else{
			$('#myform').submit();
		}
	})
}
</script>
</body>
</html>
