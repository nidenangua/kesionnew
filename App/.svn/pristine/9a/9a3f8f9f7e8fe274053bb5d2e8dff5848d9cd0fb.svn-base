<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion点播流量明细</title>
	<meta name="Keywords" content="kesion点播流量明细" />
	<meta name="Description" content="kesion点播流量明细" />

	<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

	<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
</head>
<style>
	.ks-wrap {
		background-color: #f2f4f8;
		padding: 0px;
	}

	.p15 {
		padding: 15px;
	}

	.height73 {
		height: 73px;
	}
	.gray-bg {
		padding: 15px;
	}



	.ibox-title {
		margin-bottom: 15px;
		min-height: 0;
		padding: 0;
		border: 0;
		background: none;
	}

	.ibox-title h3,
	.menu_top_fixed h3 {
		color: #788188;
		font-weight: 300;
		font-size: 16px;
		line-height: 43px;
	}

	.sc-button {
		position: relative;
		top: -3px;
	}

	.fr {
		margin-right: 15px;
	}
</style>

<body class="ks-wrap">
	<div class="gray-bg">
		<div class="row clearfix">
			<div id="manage_top" class="menu_top_fixed  p15 height73">
				<div class="ibox-title clearfix">
					<h3 class="fl">&nbsp;&nbsp;点播流量明细</h3>
					<a href="<?php echo  M_URL($this->AppName.'/Index','showSpace','',GP('')); ?>">点播空间管理</a>
					<a href="https://store.kesion.com/admin.php/home/App">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;返回</a>
					<div class="fr">
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
					<div class="fr" style="    width: 418px;">
						<form action="<?php echo  M_URL($this->AppName.'/Index','flowexcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',p-'.$page->now_page.',type-'.$type.',byname-'.$byname)); ?>" method="post">
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"/>本月</span>
							</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"/>本年</label>
							<!--<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="6" />6个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="7" />一年前</label>-->
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
						 <form action="<?php echo  M_URL($this->AppName.'/Index','flowexcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',p-'.$page->now_page.',type-'.$type.',byname-'.$byname)); ?>" method="post">
						<input type="hidden" name="outtime"  value="1"   />
						<input type="submit" id="ratiotime" class="sc-button btn  btn-default" name="" value="导出本页" /></label>
					</form>  
					</div>
					
				</div>

			</div>
		</div>
		
		<div id="ksBoxContent" style="margin-top: 28px; ">
			<div style="padding: 30px 0px;">
				<div class="H5-gameListScreen">
					<ul class="H5-gameOpt clearfix">
						<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
						<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
						<li>
							<div class="shaixuan clearfix">
								<?php if($byname == 'desc'){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("byname-asc")); ?>"><i class="desc-i"></i>使用日期</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("byname-desc")); ?>"><i class="asc-i"></i>使用日期</a>
								<?php }?>
							</div>
						</li>
						<li>
						</li>
						<li class="fr gameScreen" style="font-size: 16px;margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
								<li>
									<span>使用类型：</span>
									<div>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',type-1'));?>" class='<?php if($type==1) echo " active" ;?>'>点播</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',type-4'));?>" class='<?php if($type==4) echo " active" ;?>'>回收站</a>
									</div>
								</li>
							</ul>

						</li>
					</ul>
				</div>
				<div class="H5-gameListConts school-online">
					<form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','delsome','',GP(" p-$page->now_page")); ?>" method="post" id="myform" >
						<div class="bg-white mt20 " style="padding: 20px;border-radius: 10px;">
							<div id="ksBoxContent">
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table ">
									<thead>

										<tr>
											<th class="form-in" style="width: 30px;">
												<input type="checkbox" id="selectAll">
											</th>
											<th>网校id</th>
											<th>使用人</th>
											<th>使用流量</th>
											<th>播放次数</th>
											<th>使用日期</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($infoary as $k=>$v){?>
										<tr>
											<td class="form-in" style="width: 30px;">
												<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>">
											</td>
											<td>
												<?php echo Field($v['wxid']);?>
											</td>
											<!--<td><?php echo Field($v['memberip']);?></td>-->
											<td>
												<?php echo Field($v['username']);?>
											</td>
											<td>
												<?php echo Field($v['flow']);?>
											</td>
											<td>
												<?php echo Field($v['playcount']);?>
											</td>
											<td>
												<?php echo date('Y-m-d H:i:s',$v['adddate']);?>
											</td>
											
											<td>
												<div class="operate">
													<a href="javascript:void(0);" onclick="Confirm('是否删除该条记录？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delRec',$v['id'],GP('p-'.$page->now_page)); ?>')">
														<i class='delete2017'></i>
													</a>
												</div>
											</td>
										</tr>
										<?php }?>
									</tbody>
								</table>
								<?php echo NoC($infoary);?>
							</div>
						</div>
						<div class="footer-page">
							
							<div class="col-sm-8">
								
							<form action="<?php echo M_URL($this->AppName.'/Index','flowTime','',GP(" "));  ?>" method="post">
								<div class="fl mt15">
							<!--  			<label for="ratiotime" class="label-on"><input type="radio" id="inlineRadio8" value="0" class="radioInput" name="classlevel" checked="">大班</label>-->
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="10" />10天前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="1" />1个月前</span>
							</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="3" />3个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="6" />6个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="12" />一年前</label>
							<button class="btn  btn-default" type="submit">
								执行删除</button>
						</div>
					</form>
								
								
									<button class="btn mt15 btn-default" type="submit" name="batch" value="1">批量删除</button>
								   
								</span>
							</div>
								<div class="col-sm-4 mt10">
									<?php echo $page->show(3);?>
								</div>
							
						</div>
					</form>
				</div>
			</div>
		</div>




	</div>
	<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
	<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
<script>
	var start = {
	  elem: '#start',
	  format: 'YYYY/MM/DD hh:mm:ss',
	  //min: laydate.now(), //设定最小日期为当前日期
	  max: '2099-06-16 23:59:59', //最大日期
	  istime: true,
	  istoday: false,
	  choose: function(datas){
	     end.min = datas; //开始日选好后，重置结束日的最小日期
	     end.start = datas //将结束日的初始值设定为开始日
	  }
	};
	var end = {
	  elem: '#end',
	  format: 'YYYY/MM/DD hh:mm:ss',
	  min: laydate.now(),
	  max: '2099-06-16 23:59:59',
	  istime: true,
	  istoday: false,
	 
	};
	laydate(start);
	laydate(end);	
</script>
</body>

</html>