<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico">
	<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
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
	.mt0{margin-top: 0!important;}
</style>

<body class="gray-bg">
	<div class="wrapper" style="margin-top:35px">

		<div class="row">
			<div id="manage_top" class="menu_top_fixed  p15 height73">
				<div class="ibox-title">
					<div class="clearfix" style="float: left;">
						<h3 class="fl" style="float: left;">&nbsp;&nbsp;消息管理</h3>
						
					</div>
					
					<div class="fr">
						<div class="fl ks-top-search">
							<!--搜索-->


							<!--<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1">用户名</option>
	  	    </select>-->
							<select  class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" id="keytype" >
										<option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>网校名</option>
										<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>标题</option>
							</select>
                            <input type="hidden" value="1" id="keytype"  />
							<form target="hidframe" class="fr">
								<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
				           		<input type="button" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('News','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
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
									<a class="desc" href="<?php echo M_URL('News','index','',GP("byname-asc")); ?>"><i class="desc-i"></i>添加日期</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL('News','index','',GP("byname-desc")); ?>"><i class="asc-i"></i>添加日期</a>
								<?php }?>
							</div>
						</li>
						<li></li>
						<li class="fr gameScreen" style="margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
								<li>
									<span>消息状态：</span>
									<div>
										<a href="<?php echo M_URL('News','index','',GP('p-'.$page->now_page.',status-3'));?>" class='<?php if($type==3) echo " active" ;?>'>不限</a>
										<a href="<?php echo M_URL('News','index','',GP('p-'.$page->now_page.',status-1'));?>" class='<?php if($type==1) echo " active" ;?>'>已读</a>
										<a href="<?php echo M_URL('News','index','',GP('p-'.$page->now_page.',status-2'));?>" class='<?php if($type==2) echo " active" ;?>'>未读</a>
									</div>
								</li>
							</ul>

						</li>
					</ul>
				</div>


				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL('News','index','',GP('p-'.$page->now_page)); ?>"  method="post">
						<div class="Created-push" id="ksBoxContent" style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th class="form-in">
											<input type="checkbox" id="selectAll">
										</th>
										
										
										<th>网校名称</th>
										<th>消息标题</th>
										<th>消息状态</th>
										<th>发送日期</th>
										<th>编辑</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($infoary as $k=>$v){ ?>
									<tr>
										<td class="form-in">
											<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>">
										</td>
										<td>
											<?php echo Field($v['sitename']);?>
										</td>
										<td>
											<?php echo Field($v['title']);?>
										</td>
										<td>
											<?php if($v['type'] == 1){echo "<span style='color:green'>已读</span>";}else{echo "<span style='color:red'>未读</span>";} ?>
										</td>
										<td>
											<?php echo date('Y-m-d H:i:s',$v['addtime']);?>
										</td>
										<td><span onclick="addTypeChange('<?php echo M_URL('News','change','',GP('id-'.$v['id'].',p-'.$now_page)) ?>','930px','450px',{title:'查看详情',type:'top'});
"><i class='edit2017'></i></span></td>
										<td>
											<div class="operate">
												<a href="javascript:void(0);" onclick="Confirm('是否删除该消息','<?php echo M_URL('News','delete',$v['id'],GP('p-'.$page->now_page)); ?>')">
							<i class='delete2017'></i></a>
											</div>
										</td>
									</tr>
									<?php }?>
								</tbody>
							</table>
                         <?php echo NoC($infoary);?>

						</div>
					
							<div class=" footer-page clearfix">
								<div class="col-sm-5">
									<form action="<?php echo M_URL('News','flowTime','',GP("p- ".$now_page));  ?>" method="post">
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
										<button class="btn mt0  btn-default" type="submit">
											执行删除</button>
											<button class="btn mt10 btn-default mt0" type="submit" name="batch" value="1">
										<i class="iconfont icon-shanchu1"></i>批量删除</button>
											
									</div>
									
									</form>
								
										
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