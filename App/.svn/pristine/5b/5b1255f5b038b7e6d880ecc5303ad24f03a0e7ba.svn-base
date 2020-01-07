<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="initial-scale=1, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0, width=device-width">
	<meta name="screen-orientation" content="portrait">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/page.css?t=<?php echo rand(100000,100000000);?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<script src="<?php echo UOOT;?>Public/popup/js/kesion.popup.js"></script>

</head>
<style type="text/css">
	body{background: #F7FCFF;}

</style>
<body>
	<div class="page-listG">
		<div class="more" id="passd">
			<br />
			<a href="<?php echo M_URL('h5market','Mywinlist'); ?>" style="display: block; margin: 0 auto; width: 80px;">查看中奖记录</a>
		</div>
		<ul>
			<?php foreach($values as $k =>$v){ ?>
			<li>
				<div class="listG-wrap">
					<p>参与活动时间：<?php echo date('Y-m-d H:i:s',$v['addtime']); ?></p>
					<p>活动名称：<?php echo $v['h5name']; ?></p>
					<p class="pz"><span>获奖情况：</span>
						<?php 
						if($v['iswin'] ==0){
							echo '未获奖';
						}else{
							echo '已获奖';
						}
						?>
						
					</p>
					
					<!--<button class="off">未领取</button>-->
					<!--<span class="tip-blue">已使用</span>-->
					<!--<span class="tip-red">未使用</span>-->
				</div>
			</li>
			<?php }?>
			<?php echo Noc($values); ?>
			
		
			
		</ul>
		
	</div>

	
	<div class="alertbox">
		<div class="alertShadow"></div>
		
			<div class="alertBox">
				<!--<div class="BoxTop">-->
					<!--<p>兑奖校区：思明校区</p>
					<p>兑奖地址：厦门市思明区观音山国际运营中心16号楼806</p>
					<p>联系人：刘娜老师</p>
					<p>联系电话：15698566523</p>-->
				<!--</div>-->
					
			</div>
	</div>
</body>

<script type="text/javascript">
	
	$('.on').click(function(){
		var key = $(this).attr('flag');
		$.ajax( {  
			type : "POST",  
			url : "<?php echo M_URL('h5market','receive');?>",  
			data : {key:key},  
		 	timeout : 20000,  
		 	cache : false,  
		 	dataType : 'json',
		 	beforeSend : function(XMLHttpRequest) {  
	 		},  
		 	success : function(data, textStatus) {  
		 		console.log(data.err);
		    	if(data.err==404){
		    		alert(data.msg);
		    	}else if(data.err==200){
		    		alert(data.msg);
		    		window.location.reload();
		    	}else if(data.err==500){
		    		var str = '';
	    			str +='<div class="BoxTop">';
		    		str +='<p>请到以下校区兑换<p>';
		    		str +="<hr>"; 
		    		var data = data.msg;
		    		for(var i=0;i<data.length;i++){
		    		
		    			str +="<p>兑奖校区："+data[i].school+"</p>"; 
		    			str +="<p>兑奖地址："+data[i].address+"</p>"; 
		    			str +="<p>联系人："+data[i].name+"</p>"; 
		    			str +="<p>联系电话："+data[i].tel+"</p>"; 
		    			str +="<hr>"; 
		    		
		    		}
		    			str +='</div>';
		    		str +='<div class="BoxBot" onclick="gb()">确定</div>';
		    		$(".alertBox").html(str);
		    		$(".alertbox").show();
		    	}
     		},  
         	complete : function(XMLHttpRequest, textStatus) {  
			  
        	},  
	        error : function() {  
	           alert("404，服务器异常请稍后重试");  
			}  
       });  
	})
	function gb(){
		$(".alertbox").hide();
	}
</script>

</html>
