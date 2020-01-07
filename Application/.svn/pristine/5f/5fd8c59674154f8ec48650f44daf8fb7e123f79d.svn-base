<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/package.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style></style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10" style="position: relative;">
		<!--header-->
	    <div class="ks-head-box">
     		<h3 class="ks-head-title2"><?php echo $websiteinfo['sitename'];?></h3>
     		<div class="ks-head-widget clearfix">
				<div class="ks-search-box fl">
				<span class="gTitle fsize16 ml10" >当前套餐：<?php echo $versionname;?></span>
			    <span class="gTitle fsize16 ml10">到期时间：<?php if($package=='v1'){echo '永远';}else{echo date('Y-m-d H:i',$websiteinfo['packendtime']);}?></span>
			   	<span class="gTitle fsize16 ml20">他的余额:<i><?php echo number_format($wxmoney,2);?></i></span>
			   	<a class="gTitle fsize16 ml20 c-86A8F" href="<?php echo M_URL('Capital');?>">充值</a>
			   	<a class="gTitle fsize16 ml10">代金券：<i class="c-red"><?php echo count($voucher);?></i>个</a>
				</div>					
			</div>
   		</div>
		
		<div class="ks-head-tab"></div>
		
      	<div class="addsever">
      		<div class="add-title">
      			<div class="line"></div>
      			<h5>增值服务</h5>
      		</div>
      		<div class="add-list">
      			<ul class="clearfix">
      				<?php foreach($appinfo as $k=>$v){?>
      				<li>
      					<div class="add-list-item">
      						<div class="add-list-img" style="cursor:pointer" ><img src="<?php echo $v['defaultpic'];?>"></div>
  							<h5 style="cursor:pointer" ><?php echo $v['appname'];?></h5>
  							<p style="cursor:pointer"><?php echo $v['shortdesc'];?></p>
      						<div class="add-list-txt clearfix">
      							<span class="add-list-l"><font>￥<?php echo $v['price'];?></font>元/<?php if($v['appchargetype']==0){echo '月';}elseif($v['appchargetype']==1){echo '季';}elseif($v['appchargetype']==2){echo '年';};?></span>
      							<?php if($v['isopen']==1){?>	 
								<a class="add-list-btn add-list-default appids<?php echo $v['appid'];?>" style="cursor: not-allowed;">已选购</a>
								<?php }elseif($v['price']==0){?>
								<a class="add-list-btn add-list-default" onClick="oppenFast(this,'<?php echo $v['appname'];?>','<?php echo M_URL('Index','open',$v["appid"]); ?>','<?php echo M_URL(GC($v['basictype']).'/Index','','',GP('appid-'.$v['appid'])); ?>');doNone(event);" cate="<?php echo $v['categoryid']; ?>">立刻开通</a>	
								<?php }elseif($v['isopen']==0){?>		
								<a class="add-list-btn add-list-default appids<?php echo $v['appid'];?>" onClick="addCart(<?php echo $v['appid']; ?>);doNone(event);">选购</a>
								<?php }?>
      						</div>	
      					</div>
      				</li>
      				<?php }?>
      			</ul>
      		</div>
      	</div>
	</div>
	<!--footer-->
	<div class="add-footer">
		<form action="<?php echo M_URL('Domain','cartbatch',$this->wxid);?>" method="post" >
		<div class="choice-service" onclick="addCar()">
			已选择服务：<span id="haveservice"><?php $Data['wxid']=$this->wxid;$cartnum = M('Application/LogModel')->cartnum($Data);echo $cartnum;?></span><a class="triangle"><i class="iconfont icon-jiantou1"></i></a>
		</div>
		<div class="total-price">
			合计：<span id="cartmoney"><?php $cartmoney = M('Application/LogModel')->cartmoney($Data);echo number_format($cartmoney,2);?></span>
		</div>
		<button class="go-purchase" value="2" name="batch" onclick="checknum()" <?php if($cartnum<=0){?>type="button" style="cursor: not-allowed;"<?php }else{?>type="submit"<?php }?>>去结算</button>
		<!--购物车-->
		<input type="hidden" id="cartstatus" value="<?php if($cartnum>0){echo 1;}else{echo 0;}?>" /> 
		<div class="add-car">
      		<div class="add-title1">已选服务 <i class="iconfont close-icon icon-shanchu" onclick="addCar()"></i></div>
      		<div class="add-pd">
	      		<table class="ks-table">
				    <tbody class="ks-tables">
	      			<?php foreach($pagecarts as $k=>$v){ ?>
	      			<tr class="appid<?php echo $v['appid'];?>">
	      				<td><input type="hidden" value="<?php echo $v['appid'];?>" name='appid[]'>
	      					<img src="<?php echo $v['defaultpic'];?>" style="width: 50px;display: block;"></td>
	      				<td><?php echo $v['appname'];?></td>
	      				<td><?php echo $v['price'];?>元/年</td>
						<td>购买后有效期至：<?php echo date('Y-m-d',Checktime($this->wxid,$v['appid']));?></td>
						<td><i class="iconfont icon-shanchu1" onClick="delCart(<?php echo $v['appid']; ?>);doNone(event);"></i></td>
	      			</tr>
	      			<?php } ?>
					</tbody>
	      		</table>
	      	</div>		
      	</div>	
      	</form>		
	</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
		var $packageTarget = $('.package-list,.package-subtable');
		var $packageTitle = $packageTarget.find('.tr_title');
		var defalutIndex = $packageTarget.find('.label-on').index();
		$packageTarget.find('tr').each(function(){
			$packageTarget.find('tr').each(function(){
				$(this).find('td').eq(defalutIndex).addClass('td_active');
			});
		});
		$packageTarget.find('td').hover(function(){
			var tdIndex = $(this).index();
			if(tdIndex!=0){
				$packageTarget.find('tr').each(function(){
					$(this).find('td').eq(tdIndex).addClass('td_hover').siblings().removeClass('td_hover');
				});	
			}
		},function(){
			$packageTarget.find('td').removeClass('td_hover');
		}).click(function(){
			var tdIndex = $(this).index();
			if(tdIndex==0){return false;}
			$packageTitle.find('td').removeClass('label-on');
			$packageTarget.find('td').removeClass('td_active');
			var ratioTarget = $packageTitle.find('input[type="radio"]');
			for(var i=0;i<ratioTarget.length;i++){
				ratioTarget[i].checked = false;
			};
			$packageTitle.find('td').eq(tdIndex).find('input[type="radio"]')[0].checked = true;
			$packageTarget.find('tr').each(function(){
				$(this).find('td').eq(tdIndex).addClass('td_active').siblings().removeClass('td_active');
			});
			$packageTitle.find('td').eq(tdIndex).addClass('label-on');
			
			var packageLength = $packageTitle.find('td').length-1;
			var activePackageIndex = $packageTarget.find('.label-on').index();
			if(defalutIndex>activePackageIndex){
				$('#packbutton').html('请选择更高版本');
			}else if(defalutIndex<activePackageIndex){
				$('#packbutton').html('确定升级');
			}else if(defalutIndex=activePackageIndex){
				$('#packbutton').html('套餐续费');
			}
		});
		addCar();
	});
	function submitform(){
		var packageLength = $packageTitle.find('td').length-1;
		var activePackageIndex = $packageTarget.find('.label-on').index();
		if(defalutIndex>activePackageIndex){
			Alert('请选择比当前更高的版本');
			return false;
		}else if(activePackageIndex==1){
			Alert('请选择比当前更高的版本');
			return false;
		}; 
		$('#myform').submit();
	}
	function addCar() {
	    var cartstatus = $("#cartstatus").val();
		if(cartstatus==1){
		    open();
			$("#cartstatus").val(0);
		}else{
		    colse();
		    $("#cartstatus").val(1);
		}
	}
	function open(){
		$('.add-car').stop().css({
			display:'block',
			opacity:0
		}).animate({
			opacity:1,
			bottom:65
		},300)
	}
	function colse(){
		$('.add-car').animate({
			bottom:0,
			opacity:0
		},300,function(){
			$('.add-car').hide()
		})
	}
	function checknum(){
	   var cartstatus = $("#cartstatus").val();
	   if(cartstatus==1){
	   Alert('请先选择需要购买的服务');
	   }
	}
	function addCart(appid){
			var url = "<?php echo M_URL('Ajax','addCart2');?>";
			$.ajax({
				type:"post",
				url:url,
				data:{
					'appid':appid,
					'wxid':<?php echo $this->wxid;?>
				},
				dataType:"json",
				success:function(data){
					if(data.result=='ok'){
						$("#haveservice").html(data.cartnum);
						$("#cartmoney").html(data.cartmoney);
					    $('.appids'+appid).replaceWith('<a class="add-list-btn add-list-default appids'+appid+'" style="cursor: not-allowed;">已选购</a>');
					    $('.ks-tables').append('<tr class="appid'+appid+'">'+
	      					'<td><input type="hidden" value="'+appid+'" name="appid[]">'+
	      					'<img src="'+data.value.defaultpic+'" style="width: 50px;display: block;"></td>'+
	      					'<td>'+data.value.appname+'</td>'+
	      					'<td>'+data.value.price+'元/年</td>'+
							'<td>购买后有效期至：'+data.value.adddate+'</td>'+
							'<td><i class="iconfont icon-shanchu1" onClick="delCart('+appid+');doNone(event);"></i></td>'+
	      					'</tr>');
					    if(data.cartnum<=1){
					         open();
							 $("button[name='batch']").prop('style','');
							 $("button[name='batch']").prop('type','submit');
							 $("#cartstatus").val(0);
						}
						

						//var cartNum = $("#cartNum").html();
						//$("#cartNum").html(parseInt(cartNum)+1);
						//Alert('添加购物车成功',2);
					}else if(data.result=='err'){Alert('该商品已经在购物车了喔');}
				}
			});
	}
	function delCart(appid){
			var url = "<?php echo M_URL('Ajax','delCart');?>";
			$.ajax({
				type:"post",
				url:url,
				data:{
					'appid':appid,
					'wxid':<?php echo $this->wxid;?>
				},
				dataType:"json",
     			success:function(data){
					if(data.result=='ok'){
					    $("#haveservice").html(data.cartnum);
						$("#cartmoney").html(data.cartmoney);
						$('.appids'+appid).replaceWith('<a class="add-list-btn add-list-default appids'+appid+'" onClick="addCart('+appid+');doNone(event);">选购</a>');
	                    $('.appid'+appid).remove();
						if(data.cartnum<=0){
						     colse();
							 $("button[name='batch']").prop('style','cursor: not-allowed;');
							 $("button[name='batch']").prop('type','button');
							 $("#cartstatus").val(1);
						}
					}
				}
			});
	}
	function oppenFast(t,title,url,myurl){
		    var cate  = $(t).attr('cate');
	        $.ajax({
	            type:"get",
	            url:url,
	            success:function(data,textStatus){
	            	if(data.result=='succeed'){
	            		 $.cookie('indoor','/home.html/default/Shop/index?option-0',{expires:7,path:'/'});
				         parent.location.reload();
	            	}else{
	            		$('body').append(data);
	            	}
	           },
	           error:function(){
				   //location.reload();
	               //Alert("网络延迟,重新操作!");
	           }
	        })
		};
</script>
</body>
</html>