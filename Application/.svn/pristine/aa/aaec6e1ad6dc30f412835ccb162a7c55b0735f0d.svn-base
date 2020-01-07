<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top: 50px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;padding-bottom:30px;}
	.ring{position: absolute;right: 20px;top: 15px;width:200px;height: 40px;text-align: right;line-height: 30px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title clearfix"> 
        <h3 class="fl">&nbsp;&nbsp;<span class="mr20">其他用户</span></h3>
        	<!--<?php if($usertype==1){echo '教师管理';}else{echo '机构会员';}; ?> -->
        		
        <a href="<?php echo M_URL('Setting','addTool'); ?>" class="btn btn-default btn-rounded btn-s-md  ml15">添加直播</a>
        
	    <div class="fr">
	           <div class="fl ks-top-search">
				<!--搜索-->
					<button class="ks-bt" type="button" onclick="history.go(-1)" style="border:1px solid #eee"><i class="iconfont icon-fanhui"></i>返回</button>
				<!--搜索-->
				</div> 
	              
	               
	        </div>
    </div>
</div>
<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix" style="padding-left: 10px;">
			<li style="margin-right: 15px;"><input class="selectAll select-checks" name="check1" type="checkbox"></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<!--<li>
				<div class="shaixuan clearfix">
					<a class="mr20">最新上线 <i class="desc-i"></i></a>
				</div> 
			</li>-->
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选
				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>应用状态：</span>
						<div>
							<a href="" class="active">不限</a>
							<a href="">已审核</a>
							<a href="">未审核</a>
						</div>
					</li>
					
				</ul>
			</li>				
		</ul>	
	</div>

</div>

<div id="ksBoxContent">


 <form  id="myform" target="hidframe" action="" method="post">
	<div class="H5-gameListConts">
	   
		<ul class="H5-gameList">
		<?php foreach($list as $k=>$v){ ?>
			<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input type="checkbox" class="select-checks" value="410" name="id[]">
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" onerror="this.src=''" src="<?php echo $v['pic']; ?>"></a>
						  	</div>
						  	<div class="card-body ">
								<h4 class="card-heading ring">
									<?php echo $v['title']; ?>
									<div class="fr">
										
										 &nbsp;&nbsp;
										<i class="ok-icon iconfont ok-pe1 "></i>
										<span class="grayLing"><?php if($v['isenable']==1){ echo '已启用';}else{echo '未启用';} ?></span>
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										
										
								
									</div>
									
									<div class="ks-operaRight fr" >
		        					<ul class="clearfix">
										<li>
											<a href='<?php echo M_URL('Setting','edit',$v['id'],GP(''));?>'>
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">编辑</p>
											</a>
										
										</li>
										<li>
											<a onclick="Confirm('是否删除此应用','<?php echo M_URL('Setting','del',$v['id'],GP(''));?>');">
												<i class="iconfont icon-lajitong"></i>
												<p class="class-name">删除</p>
											</a>
										</li>
									
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
		<?php } ?>
		</ul>
		</div>
	<div>
		 <div class="footer-page h60">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
            <label for="sAll">全选 </label>
         </div>
    </div>
 

 </div>
		
		
	</div>
	</div>


</div>



</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
    </div>
    <div class="footer-page h60">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input class="selectAll select-checks" name="check1" type="checkbox">
            <label for="checkboxAll">全选</label>
         </div>
      
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">删除</button>
    </div>
    </div>
    </form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
remind();
var selectInputs = $('.check0'); // 所有勾选框
var checkAllInputs = $('.check-all') // 全选框
selectall(selectInputs,checkAllInputs);
function des(obj,ID){
	$(obj).addClass('active').siblings().removeClass('active');
	$('.tabpane'+ID+':eq('+$(obj).index()+')').show().siblings().hide();
}
</script>
<script>
function getHide(ID)
{
	//var url = '/Plus/Kesion.ajax.php?act=getHide';
	var url = "<?php echo M_URL('Ajax','getHide');?>";
	if($('#User_'+ID).attr('data')=="0")
	{
		$.ajax({
				type:"post",
				url:url,
				data:{
					'userid':ID,
					'usertype':'<?php echo $usertype; ?>'
				},
				dataType:"json",
				success:function(data){
					$("#User_"+ID).after(data);
					$('#User_'+ID).attr('data','1')
				}
			 });
	}else if($('#User_'+ID).attr('data')=="1"){
		  $("#Hide_"+ID).hide();
		  $('#User_'+ID).attr('data','2')
	}else if($('#User_'+ID).attr('data')=="2"){
		  $("#Hide_"+ID).show();
		  $('#User_'+ID).attr('data','1')
	}
}
function do_reg()
    {
	   $("#myform").submit();	
    }
</script>
</body>
</html>-->