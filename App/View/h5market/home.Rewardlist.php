
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<style>
	.mt50{margin-top: 20px;}
	.ks-borde td{border:0;text-align: center;}
	.ks-bborde {border-bottom: 1px solid #eee;}
	.ks-borde thead tr{background: #f6f6f6;}
	.ks-borde td img{width: 40px;height: 40px;}
	.ks-borde tbody tr:nth-of-type(even){background: #f9f9f9;}
</style>
</head>
<body class="ks-wrap"> 
	
		
	      
		   <form target="hidframe"  action="" method="post" id="myform" style="min-height: 450px;">        
		   		<div>
            		<table class="ks-table ks-borde">
            			<thead>
            				<tr>
            					<th>中奖人/微信名称</th>
            					<th>中奖手机号</th>
            					<th>头像</th>
            					<th>奖励名称</th>
            					<th>中奖码</th>
            			    </tr>
            			</thead>
	            		<tbody>
	            			<?php foreach($values as $k=>$v){?>
	            			<tr>
	            				<td><?php if(empty($v['membername']) && empty($v['nickname'])){ echo '未开奖/未填写';}else{ echo $v['membername'].'/'.$v['nickname'];} ?></td>
	            				<td><?php if(empty($v['phonenum'])){ echo '未开奖/未填写';}else{ echo $v['phonenum'];} ?></td>
	            				<td><img  src="<?php if(!empty($v['headimgurl'])){ echo $v['headimgurl'];}else{ echo Nopic(1);} ?>"  ></td>
	            				<td><?php echo $v['name'];?>:<?php echo $v['rewardname'] ?></td>
	            				<td><?php echo $v['code']; ?></td>
	            				
	            			</tr>
	            			<?php }?>
	 
	            		</tbody>
	            	</table>
	            	<?php echo Noc($values);?>
		    	</div>
		    	
		    	
			</form>
	
		<div id="ksBoxFooter">
			<div class="ks-bom clearfix">
				<span class="" style="display: inline-block;">
					<?php echo $page->show(3); ?>
				</span>
				
			
		</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
		module.require(['$','backstage','nicescroll'],function(){
				loadScorllJs();
		})
function updatesStatus(id){
  var url = '<?php echo UOOT;?>/Plus/Kesion.ajax.php?act=question';      
  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
   })
}
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
</script>
</body>
</html>

