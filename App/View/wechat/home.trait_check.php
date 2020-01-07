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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-nav">
				<!--标题-->
				 <a href="javascript:history.go(-1);">群发功能</a><span><em>/</em>群发记录</span>
				<!--标题-->
			</div>
	    <!--header-->
					     
			  
		<!--widget-->
		<!--/widget-->
		<!--table-->
		<div id="ksBoxContent">
		<form target="hidframe"  id ="myform" action="<?php echo M_URL($this->AppName.'/Index','bathDelQunfa','',GP(""))  ?>" method="post">
		<table class="ks-table">
			<thead>
				<tr>
					<th>
						全选
					</th>
					<th>序号</th>
					<th>类型</th>
					<th>标题</th>
					<th>群发对象</th>
					<th>状态</th>
					<th>群发日期</th>
					<th>删除</th>   
				</tr>
			</thead>
			<tbody>
					<?php foreach($values as $k=>$v){ ?>
				<tr>
					<td>
						<?php if($v['timemonth']<date("Ym")){?>
						<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>" >
						<?php }?>	
					</td>
					<td><?php echo $k;?></td>
					<td><?php echo $v['type']?></td>
					<td><?php echo $v['title']?></td>
					<td><?php echo $v['groupname']?></td>
					<td><?php echo $v['status']?></td>
					<td><?php echo date("Y-m-d h:i:s",$v['time']);?></td>
					
					
					<td>
						<?php if($v['timemonth']<date("Ym")){?>
						<div class="operate">
							
							<a href="javascript:void(0);"  onclick="Confirm('是否删除此记录？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delQunfa',$v['id'],GP('')); ?>')">
								
					  		<em>删除</em><i class="iconfont icon-shanchu1"></i></a>
						</div>
						<?php }?>
					</td>				
				</tr>
				<?php }?>
			</tbody>
		</table>							
		</form>
		  <?php echo NoC($values);?>
		</div>
	    <!--/table-->
	            
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
				<label for=""><input name="" type="checkbox" value="" class="checkall check-all" id="selectAll">全选</label>
				<button class="ks-heade-button mr10" onclick="submitform();"><i class="iconfont icon-shanchu1"></i></button>
			</span>
			<span class="fr"><?php echo $page->show(3); ?></span>
		</div>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll','animate'],function(){
		
			
			loadScorllJs()
			
		});
	
		function DoCheck() {
			var ch=document.getElementsByName("id[]");
			if(document.getElementsByName("allChecked")[0].checked==true)
			{
				for(var i=0;i<ch.length;i++)
				{
					ch[i].checked=true;
				}
			}else{
				for(var i=0;i<ch.length;i++)
				{
					ch[i].checked=false;
				}
			}
		}
		
		
		function submitform(){
			$('#myform').submit();
		}	

	</script>

</body>
</html>