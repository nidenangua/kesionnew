<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico">

	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />


	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>


<body class="gray-bg">
	<div class="wrapper" style="margin-top:35px">

		<div class="row">
			<div id="manage_top" class="menu_top_fixed  p15 height73">
				<div class="ibox-title">
					<div class="clearfix" style="float: left;">
						<h3 class="fl" style="float: left;">&nbsp;&nbsp;优惠券管理</h3>
						<div style="float: left;" class="shaixuan addCoupon clearfix">
								<a class="desc btn btn-tool btn-rounded btn-s-md fl ml15" href="<?php echo M_URL('Coupon','couponadd','',GP('p-'.$page->now_page));?>">新增优惠券</a>
							</div>
					</div>
					
					<div class="fr">
						<div class="fl ks-top-search">
							<!--搜索-->


							<!--<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1">用户名</option>
	  	    </select>-->
							<span class="inputText bRadius5 fl" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;padding: 0;">
								优惠券名称
							</span>
                            <input type="hidden" value="1" id="keytype"  />
							<form target="hidframe" class="fr">
								<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
				           		<input type="button" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Coupon','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
							</form>

							<!--搜索-->
						</div>


					</div>
				</div>
			</div>


		</div>

		<div id="ksBoxContent">
			<div style="padding: 20px 0px;">

				<div class="H5-gameListScreen">
					<ul class="H5-gameOpt clearfix">
						<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
						<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
						<li>
							<div class="shaixuan clearfix">
								<?php if($byname == 'desc'){?>
									<a class="desc" href="<?php echo M_URL('Coupon','index','',GP("byname-asc")); ?>"><i class="desc-i"></i>添加日期</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL('Coupon','index','',GP("byname-desc")); ?>"><i class="asc-i"></i>添加日期</a>
								<?php }?>
							</div>
						</li>
						<li></li>
						<li class="fr gameScreen" style="margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
								<li>
									<span>优惠券状态：</span>
									<div>
										<a href="<?php echo M_URL('Coupon','index','',GP('p-'.$page->now_page.',status-3'));?>" class='<?php if($status==3) echo " active" ;?>'>不限</a>
										<a href="<?php echo M_URL('Coupon','index','',GP('p-'.$page->now_page.',status-1'));?>" class='<?php if($status==1) echo " active" ;?>'>可用</a>
										<a href="<?php echo M_URL('Coupon','index','',GP('p-'.$page->now_page.',status-2'));?>" class='<?php if($status==2) echo " active" ;?>'>停用</a>
									</div>
								</li>
							</ul>

						</li>
					</ul>
				</div>


				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL('Coupon','somedel','',GP('p-'.$page->now_page)); ?>"  method="post">
						<div class="Created-push" id="ksBoxContent" style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th  style="min-width: 30px;width: 30px;">
											<input class="selectAll select-checks" name="check1" type="checkbox">
										</th>
										
										
										<th>优惠券名称</th>
										<th>面值</th>
										<th>最大数量</th>
										<th>发放数量</th>
										<th>号前缀</th>
										<th>使用范围</th>
										<th>添加日期</th>
										<th>状态</th>
										<th>使用</th>
										<th>描述</th>
										<th>查看</th>
										<th>编辑</th>
										<th>删除</th>
										<th>发放</th>
										<th>生成</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($infoary as $k=>$v){ ?>
									<tr>
										<th  style="min-width: 30px;width: 30px;">
											<input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'] ?>">
										</td>
										<td>
											<?php echo Field($v['voucher']);?>
										</td>
										<td>
											<?php echo Field($v['facevalue']);?>
										</td>
										<td>
											<?php echo Field($v['maxnum']);?>
										</td>
										<td>
											<?php echo Field($v['grantnum'].'/'.$v['buildnum']);?>
										</td>
										<td>
											<?php echo Field($v['headnum']);?>
										</td>
										<td>
											<?php if($v['scope'] == 1){echo '部分可用';}else{echo '通用';} ?>
										</td>
										<td>
											<?php echo date('Y-m-d H:i:s',$v['adddate']);?>
										</td>
										<td>
											<?php if($v['endtime']>time()){echo date('Y-m-d H:i:s',$v['startime']).'-'.date('Y-m-d H:i:s',$v['endtime']);}else{echo '<span style="color:red">已过期</span>';}?>
										</td>
										<td>
											<span onclick="Confirm('是否决定<?php if($v["status"] == 1){echo "停用";}else{echo "启用";} ?>','<?php echo M_URL('Coupon','changeStatus',$v['id'],GP('p-'.$page->now_page.',status-'.$v['status'])); ?>')"><?php if($v['status'] == 1){echo "<span style='color:green'>可用</span>";}else{echo "<span style='color:red'>停用</span>";} ?></span>
										</td>
										<td>
											<?php echo Field($v['descript']);?>
										</td>
										<td>
											<a href="<?php echo M_URL('Coupon','showDetail','',GP('id-'.$v['id'])); ?>">查看</a>
										</td>
										<td>
											<a href="<?php echo M_URL('Coupon','couponadd',$v['id'],GP('p-'.$page->now_page)); ?>"><i class='edit2017'></i></a>
										</td>
										<td>
											<div class="operate">
												<a href="javascript:void(0);" onclick="Confirm('<?php if($v['endtime']>time()){echo "该优惠券不可删除";}else{echo "确定删除该优惠券？该操作不可逆";} ?>','<?php if($v['endtime']>time()){ echo ''; }else{ echo M_URL('Coupon','delete',$v['id'],GP('p-'.$page->now_page));} ?>')">
							<i class='delete2017'></i></a>
											</div>
										</td>
										<td>
											<a href="javascript:void(0);" onclick="Confirm('<?php if($v["status"] == 0||$v['endtime']<time()){echo "该优惠券不可用";}else{echo "是否发放该优惠券";} ?>','<?php if($v["status"] == 0||$v['endtime']<time()){ echo ''; }else{ echo M_URL('Coupon','showgrant','',GP('type-2,maxid-'.$v['id']));} ?>')">发放</a>
										</td>
										<td>
											<a href="javascript:void(0);" onclick="Confirm('<?php if($v["status"] == 0||$v['endtime']<time()){echo "该优惠券不可生成";}else{echo "是否生成该优惠券";} ?>','<?php if($v["status"] == 0||$v['endtime']<time()){ echo ''; }else{ echo M_URL('Coupon','build',$v['id'],GP('p-'.$page->now_page));} ?>')">生成</a>
										</td>
									</tr>
									<?php }?>
								</tbody>
							</table>
                            <?php echo NoC($infoary);?>

						</div>
					
							<div class=" footer-page clearfix">
								<div class="col-sm-5">
									<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
							            <input class="selectAll select-checks" name="check1" type="checkbox">
							            <label for="checkboxAll">全选 </label>
      								 </div>
									<button class="btn mt10 btn-default" type="submit" name="batch" value="1">
										<i class="iconfont icon-shanchu1"></i>批量删除</button>
								</div>
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