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
	<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
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
	<div class="wrapper" style="margin-top:35px">
	<div id="ksBoxHead" >
		<!--结束-->
		<div class="Header-tool clearfix">
			<div class="Tool-Title">
			<!--图像-->
			<!--图像-->
			<!--标题-->
			<p>
				<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('appid-7')); ?>">
					<i class="iconfont icon-jiantou-copy"></i>
					点播管理</a><span>/</span>空间管理
				
			</p>
			
			<!--标题-->
			</div>

			
			<!--操作范围-->
		
			<!--按钮组件-->
			<!--按钮组件-->
			<!--搜索框组件-->
			<div class="fr" style="    width: 418px;">
						<form action="<?php echo  M_URL($this->AppName.'/Index','spaceExcel','',GP('p-'.$page->now_page.',stype-'.$type.',wxid-'.$wxid.',adddate-'.$adddate.',numb-'.$numb)); ?>" method="post">
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
						 <form action="<?php echo  M_URL($this->AppName.'/Index','spaceExcel','',GP('p-'.$page->now_page.',stype-'.$stype.',wxid-'.$wxid.',adddate-'.$adddate.',numb-'.$numb)); ?>" method="post">
						<input type="hidden" name="outtime"  value="1"   />
						<input type="submit" id="ratiotime" class="sc-button btn  btn-default" name="" value="导出本页" /></label>
					</form>  
					</div>
			<!--<div class="clearfix ks-top-tab fr">
			
			<div class="fl ks-top-search">
                <select  class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" id="keytype" >
							<option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>订单号</option>
							<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>网校名称</option>
				</select>
                <input type="hidden" value="1" id="keytype"  />
				<form target="hidframe" class="fr">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
	           		<input type="button" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','showSpace'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
				</form
			</div>
			
			</div>-->
			
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
							<div class="shaixuan clearfix">
								<?php if($adddate == 1){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','showSpace','',GP("adddate-2")); ?>"><i class="desc-i"></i>购买时间</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','showSpace','',GP("adddate-1")); ?>"><i class="asc-i"></i>购买时间</a>
								<?php }?>
							</div>
							
						</li>
						<li >
							<div class="shaixuan clearfix">
								
								<?php if($numb == 1){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','showSpace','',GP("numb-2")); ?>"><i class="desc-i"></i>购买数量</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','showSpace','',GP("numb-1")); ?>"><i class="asc-i"></i>购买数量</a>
								<?php }?>
							</div>
						</li>
						<li></li>
						<li class="fr gameScreen" style="margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
								<li>
									<span>时限类型：</span>
									<div>
										<a href="<?php echo M_URL($this->AppName.'/Index','showSpace','',GP('p-'.$page->now_page.',stype-3'));?>" class="<?php if($type ==3){ echo 'active';}?>">不限</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','showSpace','',GP('p-'.$page->now_page.',stype-1'));?>" class="<?php if($type ==1){ echo 'active';}?>">过期</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','showSpace','',GP('p-'.$page->now_page.',stype-2'));?>" class="<?php if($type ==2){ echo 'active';}?>">未过期</a>
			
									</div>
								</li>
							</ul>

						</li>
					</ul>
				</div>


				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL($this->AppName.'/Index','deletepart','',GP('p-'.$page->now_page)); ?>"  method="post">
						<div class="Created-push"  style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th class="form-in">
											<input type="checkbox" id="selectAll">
										</th>
										<th>订单id</th>
										<th>购买内容</th>
										<th>原单价</th>
										<th>现单价</th>
										<th>购买数量</th>
										<th>实际支付总额</th>
										<th>有效时间</th>
										<th>下单时间</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($value as $k=>$v){ ?>
									<tr>
										<td class="form-in">
											<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>">
										</td>
										<td>
											<?php echo Field($v['ordersn']);?>
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
											<?php echo date('Y/m',$v['starttime']).'-'.date('Y/m',$v['endtime']) ;?>
										</td>
										<td>
											<?php echo date('Y/m/d',$v['adddate']) ;?>
										</td>
										<td>
											<!--<div class="operate">
												<a href="javascript:void(0);" onclick="Confirm('是否删除该条记录？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','singledelete',$v['id'],GP('p-'.$page->now_page)); ?>')">
													<i class='delete2017'></i>
												</a>
											</div>-->
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
</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>



