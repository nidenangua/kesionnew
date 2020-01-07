<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<title>我的购物车</title>
	<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/style.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/mystyle.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style>
		.taps-row {position:relative;padding-left:80px;height:60px;line-height:60px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
		.taps-img {width:60px;overflow:hidden;position:absolute;left:15px}
		.taps-img img {max-width:100%;}
		.ks-table .chosebox {top:0px!important;margin-right:10px!important}
	</style>

</head>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">
	<!--header-->
     <div class="ks-head-box">
     		<h3 class="ks-head-title2">购物车</h3>
     </div>
     <!--header-->
	 <div class="ks-head-tab">
 			<ul class="clearfix">
 				<li><a href="<?php echo M_URL('Service','myapp'); ?>">我的应用</a> </li>
 				<li><a href="<?php echo M_URL('Service','upgrade');?>">升级套餐</a></li>
				<li><a href="<?php echo M_URL('Shop','CapacityService'); ?>">扩容服务</a> </li>
				<li><a href="<?php echo M_URL('Service','orderList'); ?>">我的订单</a> </li>
				<li class="curr"><a href="<?php echo M_URL('Service','Cart'); ?>">我的购物车</a> </li>
			
 			</ul>
    </div>
	<!--widget-->
	<!--/widget-->
	<!--table-->
	<div class="taps-content">
        <form action="<?php echo M_URL('Service','doBatch');?>" method="post">
            <table class="ks-table">
                <thead>
                    <tr>
                        <th class="ta-left pl20">产品</th>
                        <th>金额</th>
                        <th>订单状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="order-content">
                    <?php foreach($pagecarts as $k=>$v){ ?>
                    <tr class="level-content bg-eaf fsize14 borderSoea">
                        <td class="pl20 alignLife w400" nowrap>

                            <label>
                                <input type="checkbox" class="select-checks mt5 mr10 fl chosebox" value="<?php echo $v['appid']; ?>" name='appid[]' /><?php echo KS_DATE($v['adddate']); ?>
                            </label>
                            <span class="ml20 c-92" style="display:none">
                                <label>订单号:</label>
                                <label>4421216654464646465</label>
                            </span>
                        </td>
                        <td class="order-count"></td>
                        <td class="order-count"></td>
                        <td colspan="2" class="alignRight">
                            <a href="javascript:void(0);" onClick="Confirm('是否删除此应用？该操作不可逆!','<?php echo M_URL('Service','delCart',$v['appid']);?>')">
                                <span class="r-icon posRe mr20 c-999">
                                    <em>
                                        <i class="arrow-down"></i>
                                    </em>
                                    <i class="iconfont icon-shanchu1"></i>
                                </span>
                            </a>
                        </td>
                    </tr>
                    <tr class="level-content fsize14 borderSoea">
                        <td class="order-product">

                            <div class="taps-row">
                                <div class="taps-img">
                                    <img src="<?php echo $v['defaultpic']; ?>" style="vertical-align: middle" width="80" />
                                </div>

                                <div class="taps-txt">
                                    <span class="order-int fsize14 c-92">
                                        <?php echo $v['appname']; ?>
                                    </span>
                                    <span class="mt10 c-92">
                                        规格：
                                        <i>2年</i>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="order-count fsize14">
                            ￥<?php echo $v['price']; ?>
                        </td>
                        <td class="order-count fsize14">待付款</td>
                        <td class="order-count">
                            <a href="<?php echo M_URL('Service','confirmService','',GP('appids-'.$v['appid'])); ?>" class="ks-bt fn bt-pue">立即购买</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="hLh40"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php echo NoC($pagecarts);?>
</div>
    <!--/table-->
    <?php if(!empty($pagecarts)){ ?>
	<!--footer-->
	<div class="ks-bom clearfix">
		<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
		<button type="submit" class="ks-heade-button mr10"  value="1" name="batch" onClick="return(check())"><i class="iconfont icon-shanchu1"></i></button>
		 <div class="all-buy fr">
			<div class="taps-content">
				<div class="taps-row alignRight" style="padding-left:0">
					<div class="taps-col-2 cell-ver hLh40 ">合计:</div>
					<div class="taps-col-3 cell-ver hLh40 fsize16 " style="color: #fd8b42;">￥<?php $cartmoney = M('Application/LogModel')->cartmoney();echo $cartmoney;?></div>
					<button type="submit" class="ks-bt bt-pue ml20" value="2" name="batch" onClick="return(check())" style="background-color: #fd8b42;border-color:#fd8b42;min-width:88px">去结算</button>
				</div>
				<div class="clear"></div>
			</div>
		</div> 
	</div>
	<!--/footer-->
	<?php } ?>
	</form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
		$('.r-icon').find('.iconfont').hover(function(){
			$(this).siblings('em').fadeIn(300)
		},function(){
				$(this).siblings('em').stop().fadeOut(300);
		});
		/*全选*/	
		$(".checkall").click( 
		  function(){ 
		    if(this.checked){ 
		        $("input[name='appid[]']").attr('checked', true)
		    }else{ 
		        $("input[name='appid[]']").attr('checked', false)
		    } 
		  } 
		);
		
		$(function(){
			var inp = $('#inp');
			inp.focus(function(){
			  $(this).attr('placeholder','请输入企业名')
			})
		})
	});
	function check() {
		var idArr = new Array();
		var dest = document.getElementsByClassName('chosebox');
		if($(".chosebox").length==0){
			Alert("你的购物车是空的!");
		    return false;
		}
		for (var i = 0; i < $(".chosebox").length; i++) {
			if( $(".chosebox")[i].checked == true){
				idArr.push($(".chosebox")[i].value);
			}
		}
		if (idArr.length <= 0) {
		    Alert("你没有选择订单!");
		            return false;
       	}else {
            return true;
        }
		
	}

</script>

</form>

</body>
</html>