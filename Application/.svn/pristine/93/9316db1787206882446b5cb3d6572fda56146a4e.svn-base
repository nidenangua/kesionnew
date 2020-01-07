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
	/*.addCoupon a{}*/
</style>

<body class="gray-bg">
<div id="manage_top" class="menu_top_fixed p15 height73">
		<!--结束-->
		<div class="ibox-title clearfix"> 
			<h3 class="fl">&nbsp;&nbsp;<span class="mr20">点播管理</span
				
				
			
						<a   href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" target="main">流量管理</a>
				
				
						<a   href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP('')); ?>" target="main">空间管理</a>
			
			</h3 >
		<div>
			
			
			<!--操作范围-->
		
			<!--按钮组件-->
			<!--按钮组件-->
			<!--搜索框组件-->
			<div class="fr" style="    width: 418px;">
						<form action="<?php echo  M_URL('Flow','spaceExcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',p-'.$page->now_page.',stype-'.$type.',status-'.$status)); ?>" method="post">
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
						 <form action="<?php echo  M_URL('Flow','spaceExcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',p-'.$page->now_page.',stype-'.$type.',status-'.$status)); ?>" method="post">
						<input type="hidden" name="outtime"  value="1"   />
						<input type="submit" id="ratiotime" class="sc-button btn  btn-default" name="" value="导出本页" /></label>
					</form>  
					</div>
			<div class="clearfix ks-top-tab fr">
			
			<div class="fl ks-top-search">
                <select  class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" id="keytype" >
							<option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>订单号</option>
							<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>网校名称</option>
				</select>
                <input type="hidden" value="1" id="keytype"  />
				<form target="hidframe" class="fr">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
	           		<input type="button" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Flow','showSpace'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
				</form
			</div>
					
			
			<!--搜索框组件-->
			<!--操作范围-->
		</div>
	</div>


		<div >
			<div style="padding: 8px 0px;">

				<div class="H5-gameListScreen">
					<ul class="H5-gameOpt clearfix">
						<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
						<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
						<li>
							<!--<div class="shaixuan clearfix">
								<?php if($byname == 'desc'){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP("byname-asc")); ?>"><i class="desc-i"></i>升序</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP("byname-desc")); ?>"><i class="asc-i"></i>降序</a>
								<?php }?>
							</div>-->
						</li>
						<li></li>
						<li class="fr gameScreen" style="margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
								<li>
									<span>支付状态：</span>
									<div>
										<a href="<?php echo M_URL('Flow','showSpace','',GP('p-'.$page->now_page.',status-3'));?>" class='<?php if($status==3) echo " active" ;?>'>不限</a>
										<a href="<?php echo M_URL('Flow','showSpace','',GP('p-'.$page->now_page.',status-1'));?>" class='<?php if($status==1) echo " active" ;?>'>已支付</a>
										<a href="<?php echo M_URL('Flow','showSpace','',GP('p-'.$page->now_page.',status-2'));?>" class='<?php if($status==2) echo " active" ;?>'>未支付</a>
									</div>
								</li>
								<li>
									<span>时限类型：</span>
									<div>
										<a href="<?php echo M_URL('Flow','showSpace','',GP('p-'.$page->now_page.',stype-3'));?>" class="<?php if($type ==3){ echo 'active';}?>">不限</a>
										<a href="<?php echo M_URL('Flow','showSpace','',GP('p-'.$page->now_page.',stype-1'));?>" class="<?php if($type ==1){ echo 'active';}?>">过期</a>
										<a href="<?php echo M_URL('Flow','showSpace','',GP('p-'.$page->now_page.',stype-2'));?>" class="<?php if($type ==2){ echo 'active';}?>">未过期</a>
			
									</div>
								</li>
							</ul>

						</li>
					</ul>
				</div>


				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL($this->AppName.'/Index','schoolPart','',GP('p-'.$page->now_page)); ?>"  method="post">
						<div class="Created-push"  style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th class="form-in">
											<input type="checkbox" id="selectAll">
										</th>
										<th>订单id</th>
										<th>网校名称</th>
										<th>购买内容</th>
										<th>原单价</th>
										<th>现单价</th>
										<th>购买数量</th>
										<th>实际支付总额</th>
										<th>付款情况</th>
										<th>有效时间</th>
										<th>下单时间</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($value as $k=>$v){ ?>
									<tr>
										<td class="form-in">
											<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['schoolid'] ?>">
										</td>
										<td>
											<?php echo Field($v['ordersn']);?>
										</td>
										<td>
											<?php echo Field($v['sitename']);?>
										</td>
										<td>
											<?php echo Field($v['appname']); ?>
										</td>
										<td>
											<?php echo Field($v['market_price']);?>
										</td>
										<td>
											<?php echo Field($v['price']) ;?>
										</td>
										<td>
											<?php echo Field($v['numb']).'G' ;?>
										</td>
										<td>
											<?php echo Field($v['sumprice']) ;?>
										</td>
										<td>
											<?php if($v['paystatus']==1){echo '已付款';}else{echo '未付款';}?>
										</td>
										<td>
											<?php echo date('Y/m',$v['starttime']).'-'.date('Y/m',$v['endtime']) ;?>
										</td>
										<td>
											<?php echo date('Y/m/d',$v['adddate']) ;?>
										</td>
									</tr>
									<?php }?>
								</tbody>
							</table>
                         <?php echo NoC($value);?>

						</div>
					
							<div class=" footer-page clearfix">
								<div class="col-sm-5">
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



