<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>短信使用明细</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<style type="text/css"> .H5-gameList>li{margin-bottom: 20px;padding-bottom:20px;border-bottom: solid 1px #EEEEEE;} </style>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
     	<h3 class="ks-head-title">
     		<div class="ks-head-nav" style="height: 16px;">
			<!--标题-->
			<a href="<?php echo M_URL('sms/Index','','',GP('appid-17'));?>">短信设置</a><span> / </span>查看短信使用明细</span>
			<!--标题-->
			</div>
		</h3>
    </div>
    <!--header-->
				     
		  
	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="ks-search-box">
			<div class="ks-top-search fl">
				
				<form target="hidframe"  class="fr" action="<?php echo  M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)); ?>" method="post">
				
			   		<select class="w150 inputText fl" id="keytype">
						<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户ID</option>
						<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户名</option>
						<option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>手机号</option>
						<option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>操作IP</option>
			   		</select>
					
					<input type="text"  class="sc-text"  name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','config'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
					
				
				</form>
			</div>
			
			<div class="fr">
				<ul class="ks-head-choice">

					<li>
						<div class="ks-head-el">
							
								<div class="ks-head-input ks-head-el  ks-head-click w180" onclick="choiceClick(this)">
									<?php if($issuccess==3){ echo "所有短信"; }elseif($issuccess==1){echo "成功短信"; }elseif($issuccess==0){echo "失败短信";}; ?><span class="ks-head-search"><i class="icon-taitouxiangxiajiantou iconfont"></i></span></div>
								<div class="ks-head-content ks-head-content-pr w100">	
									
								<ul class="status">															
									<li>
										<a href="<?php echo M_URL($this->AppName.'/Index','config','',GP("issuccess-3,appid-$this->appid",true)); ?>">所有短信</a>
									</li>
									<li><a href="<?php echo M_URL($this->AppName.'/Index','config','',GP("issuccess-1,appid-$this->appid",true)); ?>">成功短信</a></li>
									<li><a href="<?php echo M_URL($this->AppName.'/Index','config','',GP("issuccess-0,appid-$this->appid",true)); ?>">失败短信</a></li>
									
								</ul>
						</div>
					</li>

				</ul>
			</div>
			
		</div>					
	</div>
	<!--/widget-->
    
	<!--table-->
	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batch','',GP(''));  ?>" method="post" id="myform" >        
	<table class="ks-table">
							
			<thead>
				<tr>
					<td style="width: 30px;">选择</td>
					<td>用户ID</td>
					<td>用户名</td>
					<td>操作IP</td>
					<td>接收手机</td>
					<td>时间</td>
					<td style="text-align: left;">描述</td>
					<td>状态</td>
					<td>操作</td>
				</tr>    											
			</thead>
			<tbody>
				<?php foreach($values as $k=>$v){?> 
				<tr>
					<td><input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'];?>"></td>
					<td><?php echo Field($v['memberid']);?></td>
					<td><?php echo Field($v['username']);?></td>
					<td><?php echo Field($v['memberip']);?></td>
					<td><?php echo Field($v['mobile']);?></td>
					<td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
					<td style="text-align: left;"><?php echo Field($v['content']);?></td>
					<td><?php if($v['issuccess']==0){?><i class="ks-unaudit">失败</i><?php }else{?><i class="ks-audit">成功</i><?php }?></td>
					<td><a href="javascript:void(0);" onclick="Confirm('是否删除此短信？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delSms',$v['id'],GP('p-'.$page->now_page)); ?>')"><i class="iconfont icon-shanchu2"></i></a>	</td>
				</tr>
				<?php }?> 
			</tbody>
	</table>

    <input type="hidden" name="batch" id="batch1" />
	
	<?php echo NoC($values);?>
	
	</form>
   
   
    <!--/table-->
    
    <?php if(!empty($values)){;?>
	<!--footer-->
	<div class="ks-bom clearfix">
		<span class="fl">
			<label class="fl" style="margin: 0px 10px 0px 0px;"><input type="checkbox" class="select-checks selectAll" >全选</label>
			<button type="button" class="ks-bt ks-heade-button" onclick="submitform(1)" >批量删除</button>
		</span>
		<div class="fr"><?php echo $page->show(3); ?></div>
	</div>
	<!--/footer-->
	<?php }?> 
</div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
	
		 
		loadScorllJs()
		
		
	});
	function updatesStatus(id){
		var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
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
			inspectionCheckBox('id[]',function(){
				$('#batch1').val(type);
				if(type===1){
					top.popup.confirm('确认要删除所选项吗？',{
						determine:function(){
							$('#myform').submit();
						}
					})
				}else{
					$('#myform').submit();
				}
			})

		}
</script>
</body>
</html>

