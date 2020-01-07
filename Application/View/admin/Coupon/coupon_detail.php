
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
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;<?php if(isset($detail)) echo $detail; ?>的使用情况
        	
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->	   
	       <div class="fr ks-top-search">
				<div class="ks-top-search fr ">
					<input type="text" class="sc-text" name="searchText" id="keyword" placeholder="输入对应的优惠券号"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	                <input type="submit" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Coupon','showDetail'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
				</div>
			</div>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<div style="padding: 0px 0px;">
		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix"> 
			<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix">
					<?php if($byname == 'desc'){?>
						<a class="desc" href="<?php echo M_URL('Coupon','showDetail','',GP("byname-asc")); ?>"><i class="desc-i"></i>发送日期</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Coupon','showDetail','',GP("byname-desc")); ?>"><i class="asc-i"></i>发送日期</a>
					<?php }?>
				</div> 
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>使用：</span>
						<div>
							<a href="<?php echo M_URL('Coupon','showDetail','',GP('status-3,id-'.$couId.',p-'.$page->now_page)); ?>" class='<?php if($status==3) echo " active" ;?>'>不限</a>
							<a href="<?php echo M_URL('Coupon','showDetail','',GP('status-1,id-'.$couId.',p-'.$page->now_page)); ?>" class='<?php if($status==1) echo " active" ;?>'>已使用</a>
							<a href="<?php echo M_URL('Coupon','showDetail','',GP('status-2,id-'.$couId.',p-'.$page->now_page)); ?>" class='<?php if($status==2) echo " active" ;?>'>未使用</a>
							<a href="<?php echo M_URL('Coupon','showDetail','',GP('status-4,id-'.$couId.',p-'.$page->now_page)); ?>" class='<?php if($status==4) echo " active" ;?>'>未发送</a>
							<a href="<?php echo M_URL('Coupon','showDetail','',GP('status-5,id-'.$couId.',p-'.$page->now_page)); ?>" class='<?php if($status==5) echo " active" ;?>'>已发送</a>
						</div>
					</li>
				</ul>

			</li>				
		</ul>	
	</div>
	

	<div class="H5-gameListConts school-online">
		<form action="<?php echo M_URL('Coupon','showgrant','',GP('p-'.$page->now_page.',type-2,maxid-'.$couId)); ?>" method="post">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table" id="tables">
			<thead>
			<tr style="background: #EEEEEE;">
				<th class="form-in">
					<input type="checkbox" id="selectAll">
				</th>
				<th>优惠券号</th>
				<th>发送时间</th>
				<th>优惠券金额</th>
				<th>剩余金额</th>
				<th>使用网校名称</th>
				<th>使用范围</th>
				<th>使用状态</th> 
				<th>发放状态</th> 
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
            <?php foreach($values as $k=>$v){ ?> 
	            <tr>
					<td class="form-in">
						<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>">
					</td>
	            	<td ><?php echo Field($v['vouchernum']);?></td>
	                <td><?php echo date('Y-m-d H:i:s',$v['addtime']);?></td>
	                <td ><?php echo Field($v['money']);?></td>
	                <td ><?php echo Field($v['balance']);?></td>
	                 <td><?php echo Field($v['sitename']);?></td>
	                <td><?php if($v['type'] == 1){echo '部分可用';}else{echo '通用';}?></td>
	                 <td><?php if($v['status'] == 1){echo '已使用';}else{echo '未使用';} ?></td>
	                 <td><?php if($v['grantstatus'] == 1){echo '已发送';}else{echo '未发送';} ?></td>
	                 <td><a href="javascript:void(0);" onclick="Confirm('<?php if($v["grantstatus"] == 1){echo "该优惠券已经有人使用";}else{echo "";} ?>','<?php if($v["grantstatus"] == 1){ echo ''; }else{ echo M_URL('Coupon','showgrant',$v['id'],GP('maxid-'.$couId.',type-1,j-'.$v['id']));} ?>')">发放</a></td>
	            </tr>
            <?php }?>
			</tbody>
        </table>	
		 <?php echo NoC($values);?>

		</div>
	
</form>
	</div>
	</div>
	
  </div>
	<div class="footer-page h60">
				<div class="col-sm-5">
						
							<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
				           		 <input class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
								<label for="sAll">全选 </label>
							</div>
				        
						<button class="btn btn-default mt10" type="submit" name="batch" value="1"><i class="iconfont icon-shanchu1"></i>批量发送</button>
						
					</div>
				
				<div class="col-sm-7 mt7" ><?php echo $page->show(3); ?></div>
			</div>
		</div>
</div>   
</body>

</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>