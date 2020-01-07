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
			<p>聊天管理</p>
			
			<!--标题-->
			</div>
			<ul class="Tool-nav">
				<li >
					<a   href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" target="main">返回问题管理</a>
				</li>	
				<li>
					<a href="https://store.kesion.com/admin.php/home/App">返回</a>
				</li>	
			
			</ul>
			
			<!--操作范围-->
		
			<!--按钮组件-->
			<!--按钮组件-->
			<!--搜索框组件-->
			<div class="clearfix ks-top-tab fr">
			
			<div class="fl ks-top-search">
                <input  class="inputText bRadius5 fl" disabled="disabled" value="提问者" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" />
                <input type="hidden" value="1" id="keytype"  />
				<form target="hidframe" class="fr">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
	           		<input type="button" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','showreply'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
				</form>
			</div>
			</div>
			<!--搜索框组件-->
			<!--操作范围-->
		</div>
	</div>


		<div id="ksBoxContent">
			<div style="padding: 30px 0px;">

				<div class="H5-gameListScreen">
					<ul class="H5-gameOpt clearfix">
						<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
						<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
						<li>
							<div class="shaixuan clearfix">
								<?php if($byname == 'desc'){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','showreply','',GP("byname-asc")); ?>"><i class="desc-i"></i>添加日期</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','showreply','',GP("byname-desc")); ?>"><i class="asc-i"></i>添加日期</a>
								<?php }?>
							</div>
						</li>
						<li></li>
						<li class="fr gameScreen" style="margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="<?php echo UOOT;?>Public/app/images/regup.png" alt="">
								<li>
									<span>问题状态：</span>
									<div>
										<a href="<?php echo M_URL($this->AppName.'/Index','showreply','',GP('p-'.$page->now_page.',anonymous-3'));?>" class='<?php if($stype==3) echo " active" ;?>'>不限</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','showreply','',GP('p-'.$page->now_page.',anonymous-1'));?>" class='<?php if($stype==1) echo " active" ;?>'>匿名</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','showreply','',GP('p-'.$page->now_page.',anonymous-2'));?>" class='<?php if($stype==2) echo " active" ;?>'>不匿名</a>
									</div>
								</li>
							</ul>

						</li>
					</ul>
				</div>
				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL($this->AppName.'/Index','delsomeReply','',GP('p-'.$page->now_page.',questionid-'.$interactid)); ?>"  method="post">
						<div class="Created-push" id="ksBoxContent" style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th class="form-in">
											<input type="checkbox" id="selectAll">
										</th>
										<th>问题id</th>
										<th>回复人</th>
										<th>回复内容</th>
										<th>是否匿名</th>
									
										<th>回复日期</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($values as $k=>$v){ ?>
									<tr>
										<td class="form-in">
											<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['replyid'] ?>">
										</td>
										<td>
											<?php echo Field($v['interactid']);?>
										</td>
										<td>
											<?php echo Field($v['membername']);?>
										</td>
										<td>
											<?php echo Field($v['reply']);?>
										</td>
										<td>
										    <?php if($v['anonymous'] == 0){echo "<span style='color:green'>否</span>";}else{echo "<span style='color:red'>是</span>";} ?>
										</td>
										<td>
											<?php echo date('Y-m-d H:i:s',$v['adddate']);?>
										</td>
										<td>
											<div class="operate">
												<a href="javascript:void(0);" onclick="Confirm('是否删除','<?php echo M_URL($this->AppName.'/Index','deleterep','',GP('p-'.$page->now_page.',id-'.$v['replyid'].',questionid-'.$interactid)); ?>')">
							<i class='delete2017'></i></a>
											</div>
										</td>
									</tr>
									<?php }?>
								</tbody>
							</table>
                         <?php echo NoC($values);?>

						</div>
					
							<div class=" footer-page clearfix">
								<div class="col-sm-5">
									<button class="btn mt10 btn-default" type="submit" name="batch" value="1">
										<i class="iconfont icon-shanchu1"></i>批量删除</button>
								</div>
								<div class="col-sm-7 " style="margin-top:7px"><?php echo $page->show(3); ?></div>
							</div>
						
					</form>
					<form action="<?php echo M_URL($this->AppName.'/Index','delbefore','',GP("p- ".$now_page.',questionid-'.$interactid));  ?>" method="post">
								<div class="fl mt15">
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
				</div>
				<div>
				</div>
			</div>

		</div>

	</div>
</body>

</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>