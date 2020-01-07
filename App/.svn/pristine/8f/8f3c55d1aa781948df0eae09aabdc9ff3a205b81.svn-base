<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	    <meta name="renderer" content="webkit"> 
	    <title>好友赠送-<?php echo $info['title']; ?></title>
	    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
	    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
	    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/index.css" rel="stylesheet">
	    <link rel="stylesheet" type="text/css" href="<?php echo UOOT ?>Public/wechat/css/togift.css"/>
	    <script>
	    	var uoot = '<?php echo UOOT ?>';
	    </script> 	
	    <style type="text/css">
	    	body{
	    		background:#F7FCFF; 
	    	}
	    	.togiftuser{width:40px;height:40px;margin: 0 auto 10px;top:10px;right:10px; border-radius: 50%;display: block;}
	    	.togift-wrap{
	    		margin-top: 15px
	    	}
	    	.togift-wrap .topgift-con{
	    		padding-top:95px 
	    	}
	    	.togiftusername{
	    		font-size: 14px;
    			text-align: center;
	    	}
	    </style>
	</head>
	<body>
		<!-- <p class="head-title">点击右上角的分享,将课程分享给你的好友</p> -->
		<div class="togift-wrap">
			<img src="<?php echo UOOT ?>Public/wechat/images/gift/bg_gift.png" alt="" class="top-img"/>

			<div class="topgift-con">
				<div class="item" style="display:block;">
					<img src="<?php echo $this->upload->getHead($ordersninfo['giftuser'],4,0); ?>"  class="togiftuser">
					<p class="togiftusername">赠送人:<?php echo $giftname; ?></p>
				</div>
				<div class="item">
					<div class="body"><?php echo $info['title']; ?></div>
				</div>
				<div class="item">
					<div class="head">知识类型:</div>
					<div class="body">
						<?php
							if($type==1){
								echo '互动班级';
							}elseif($type==0){
								if($info['courseType']==1){
									echo '点播课程';
								}elseif($info['courseType']==2){
									echo '直播课程';
								}elseif($info['courseType']==3){
									echo '音频课程';
								}elseif($info['courseType']==4){
									echo '图文课程';
								}
							}elseif($type==7){
								echo '专栏类型';
							}else{
								echo '试卷类型';
							}
						 ?>
					</div>
				</div>
				<div class="item" style="border-bottom: none">
					<div class="head">价格：</div>
					<div class="body"><?php echo $info['price']; ?></div>
				</div>
				
				
				<!--已经领完-->
				<?php if($numb<=0){ ?><img class="ling" src="<?php echo UOOT ?>Public/wechat/images/gift/gift_icon_full.png"/><?php } ?>
				<!---->
				<!--已经领取-->
				<?php if($islq ==1){ ?><img class="ling" src="<?php echo UOOT ?>Public/wechat/images/gift/gift_icon_get.png"/><?php } ?>
				<!---->
			</div>
		</div>
		
		<div <?php if($islq !=1 && $numb>0){ echo 'onclick="issubmit()"'; }else{ echo 'onclick="goto()"';} ?>  class="gift-btn"><?php if($numb<=0){ echo '我也要学'; }elseif($islq ==1){ echo  '进入课程'; }else{ echo '领取赠礼';} ?></div>
	</body>
	<script src="<?php echo UOOT; ?>/Public/common/js/jquery.js"></script>
	
	<script>
		function toast2(params){
				var data = {
					content:params.content,
					icon:params.icon,
					duration:params.duration || 1000,
					success:params.callback,
				}
				iconUrl = ''
				var bodys = document.getElementsByTagName('body')[0];
				var toast = document.createElement('toast');
				toast.setAttribute("class","toast");
				toast.setAttribute("id","toast");
				
				var spans = document.createElement('span');
				spans.innerHTML = data.content;
				
				toast.appendChild(spans);
				
				if(typeof data.icon!=="undefined"){
					var imgs = document.createElement('img');
					imgs.setAttribute("class","toast-img");
					imgs.src = data.icon;
					toast.appendChild(imgs);
				}
				bodys.appendChild(toast);
				
			
				
				var thisHalfWidth = toast.offsetWidth/2;
				var thisHalfHeight = toast.offsetHeight/2;
				toast.style.left = "50%";
				toast.style.top = "50%";
				toast.style.marginLeft = -thisHalfWidth+'px';
				toast.style.marginTop = -thisHalfHeight+'px';
				setTimeout(function(){
					document.getElementsByTagName('body')[0].removeChild(toast) 
					if(typeof data.success==="function"){
							params.callback()
					}
							
				},data.duration)
				
			}
		function goto(){
			window.location.href='<?php echo $url; ?>';
		}
		function issubmit(){
			
			$.ajax({
	            url: "<?php echo M_URL('h5market','getgift'); ?>",
	            type: "POST",
	            data:{ordersn:'<?php echo $ordersn; ?>',id:<?php echo $id; ?>},
	            success: function (data) {
	            	var data  = JSON.parse(data);
	            	if(data.errcode == '404'){
	            		toast2({
	            			content:data.msg,
	            			duration:2000,
	            			callback:function(){
	            				window.location.reload()	
	            			}
	            		});
	            	}else if(data.errcode == '200'){
	            		toast2({
	            			content:data.msg,
	            			duration:2000,
	            			callback:function(){
	            				window.location.reload();	
	            			}
	            		});
	            	}
	            },
	            error: function () {
	               
	            }
	        });
		};
		
	</script>
</html>