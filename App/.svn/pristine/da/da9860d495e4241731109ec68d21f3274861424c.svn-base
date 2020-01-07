<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico">
	<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.gy {
		background: #F8F8F8;
	}
	.form-in input,.form-in input{margin: 0px !important;}
	.ks-table th, .ks-table td{width: 100px !important;}
	.addCoupon a{color: #FFFFFF !important;background-color: #fff;border: none;box-shadow: 0 1px 1px rgba(90,90,90,0.1);background: #FF5507;border-radius: 50px;height: 36px;padding: 8px 10px;line-height: 20px;margin-left: 15px;}
	.ibox-title .iconfont{font-size: 14px;padding: 0px 10px}
	.pagination-digg .previous-off, .pagination-digg .next-off, .pagination-digg .active, .pagination-digg a{font-size: 12px;}
	#ksBoxHead{
		position: fixed;
	    width: 100%;
	    top: 0;
	    left: 0;
	}
	/*.addCoupon a{}*/
</style>

<body class="gray-bg">
	<div class="wrapper" style="margin-top:35px">
	<div id="ksBoxHead" >
		<!--结束-->
		<div class="Header-tool clearfix">
			<div class="Tool-Title">
			<!--图像-->
			<span class="Tool-icon">
				<i class="iconfont icon-zaixianjiaoxue"></i>
			</span>
			<!--图像-->
			<!--标题-->
			<p>直播管理</p>
			
			<!--标题-->
			</div>
			
			<!--操作范围-->
		
			<!--按钮组件-->
			<!--按钮组件-->
			<!--搜索框组件-->
			<div class="fr" style="    width: 418px;">
						<!--<form action="<?php echo  M_URL($this->AppName.'/Index','flowexcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',p-'.$page->now_page.',stype-'.$type)); ?>" method="post">
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"/>本月</span>
							</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"/>本年</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="6" />6个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="7" />一年前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="4" onclick="$('#timebox').show()"/>自定义
								<div style="display: none;" id="timebox">
									<input id="start" type="text" value="" name="startime" required readonly class="w300 laydate-icon">
										-
									<input id="end" type="text" value=""name="endtime" required readonly class="w300 laydate-icon">
								</div>
								</label>
								<label for="ratiotime" class="label-on">
								<input type="submit" class="sc-button btn  btn-default" name="outexcel" value="导出Excel" /></label>
						</form>
						 <form action="<?php echo  M_URL($this->AppName.'/Index','flowexcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',p-'.$page->now_page.',stype-'.$type)); ?>" method="post">
						<input type="hidden" name="outtime"  value="1"   />
						<input type="submit" id="ratiotime" class="sc-button btn  btn-default" name="" value="导出本页" /></label>
					</form>  -->
					</div>
			<div class="clearfix ks-top-tab fr">
			
			<div class="fl ks-top-search">
                <form target="hidframe" >				
					<div class="ks-top-search" target="hidframe" action="<?php echo  M_URL($this->AppName.'/Index','index','',GP('')); ?>" method="post">
						<select  class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" id="keytype" >
							<option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户名</option>
							<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>按网校id</option>
						</select>
						<input type="text" class="sc-text" name="" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
						<input type="submit" class="sc-button" name="" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">
					</div>
				</form>
			</div>
			
			</div>
			
			<!--搜索框组件-->
			<!--操作范围-->
		</div>
	</div>


		<div >
			<div style="padding: 8px 0px;">

				<div class="H5-gameListScreen">
				</div>


				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL($this->AppName.'/Index','schoolPart','',GP('p-'.$page->now_page)); ?>"  method="post">
						<div class="Created-push"  style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr>
											<th class="form-in" style="width: 30px;">
												<input type="checkbox" id="selectAll">
											</th>
											<th class="shaixuan">
												<?php if($webid == 1){?>
													<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("webid-2")); ?>"><i class="desc-i" style="top: 2px;"></i>网校ID</a>		
												<?php }else{ ?>
													<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("webid-1")); ?>"><i class="asc-i" style="top: 2px;"></i>网校ID</a>
												<?php }?>
											</th>
											<th>网校名称</th>
											<th class="shaixuan">
												<?php if($sumlivemoney == 1){?>
													<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("sumlivemoney-2")); ?>"><i class="desc-i" style="top: 2px;"></i>连麦币</a>		
												<?php }else{ ?>
													<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("sumlivemoney-1")); ?>"><i class="asc-i" style="top: 2px;"></i>连麦币</a>
												<?php }?>
											</th>
											<th class="shaixuan">
												<?php if($sumconcurrent == 1){?>
													<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("sumconcurrent-2")); ?>"><i class="desc-i" style="top: 2px;"></i>并发数</a>		
												<?php }else{ ?>
													<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("sumconcurrent-1")); ?>"><i class="asc-i" style="top: 2px;"></i>并发数</a>
												<?php }?>
											</th>
										</tr>
								</thead>
								<tbody>
										<?php foreach($infoary as $k=>$v){?>
										<tr>
											<td class="form-in" style="width: 30px;">
												<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>">
											</td>
											<td style="text-align: left;">
												<?php echo Field($v['wxid']);?>
											</td>
											<!--<td><?php echo Field($v['memberip']);?></td>-->
											<td>
												<?php echo Field($v['sitename']);?>
											</td>
											<td style="text-align: left;">
												剩余可用：<?php echo getLimitService(6,'',$v['wxid']);?>|总计：<?php echo $v['sumlivemoney'];?> (<a href="<?php echo M_URL($this->AppName.'/Index','serviceRecord','',GP('wxid-'.$v['wxid'])); ?>" style="color: blue;">查看</a>)
											</td>
											<td style="text-align: left;">
												当月可用：<span><?php echo getLianmai($v['wxid']); ?>|总计：<?php echo $v['sumconcurrent'];?></span> (<a href="<?php echo M_URL($this->AppName.'/Index','showSupervene','',GP('p-'.$page->now_page.',wxid-'.$v['wxid'])); ?>" style="color: blue;">查看</a>)
											</td>
										</tr>
										<?php }?>
									</tbody>
							</table>
                         <?php echo NoC($infoary);?>

						</div>
					
							<div class=" footer-page clearfix">
								
								<div class="col-sm-7 " style="margin-top:7px"><?php echo $page->show(3); ?></div>
							</div>
						
					</form>
				</div>
				<div>
				</div>
			</div>

		</div>

	</div>
</body>

</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>



