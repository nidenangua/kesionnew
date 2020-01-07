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
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style>
	 .showImg{ border-radius: 10px;height:90px; width: 120px;}
	</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10" style="background: #FFF;">
		<!--header-->
		<div class="ks-head-box clearfix">
			
			<div class="ks-head-nav bd_e">
				<!--标题-->
				 <a href="<?php echo M_URL('Website');?>">网站设置</a> / <a href="<?php echo M_URL('Website','websitetemplate',2);?>">我的模板</a> / <span>背景设置</span>
				<!--标题-->
			</div>
			
		</div>
		

	    <!--header-->
					     
			  
		<!--widget-->
		<div class="clearfix ks-head-widget">
			
			
			<div class="fl ks-top-search mt10">
				<!--搜索-->
				<form target="hidframe" class="fr">
					<input style="margin: 0px;" type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>"> 		
					<button type="submit" class="ks-head-search" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Website','TempBackground',$recId); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
	            </form>		
				<!--搜索-->
			</div>
			
			<div class="Tool-btnGroup fr">
			   	<a href="<?php echo M_URL('Website','tempbgAdd',$recId);?>" class="ks-bt bt-pue mr10" >添加背景</a>
	    		<a href="<?php echo M_URL('Website','tempbgm',$recId);?>" class="ks-bt bt-pue mr10" >设置背景音乐</a>	
			</div>
			
			
		</div>
		
		
		
		<!--/widget-->
		<!--table-->

<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('Website','deletebgs',$recId,GP('p-'.$page->now_page.'option-'.$option)); ?>" class="form-horizontal" enctype="multipart/form-data">
	
	
	
	
	
	    <!--/table-->
	    
	    <table class="ks-table">
	    	<thead>
	    		<tr>
	    			<th>选择</th>
	    			<th>背景图片</th>
	    			<th>ID</th>
	    			<th>背景名称</th>
	    			<th >
	    			<div class="shaixuan clearfix">
					<?php if($adddate == 2){?>
						<a class="desc" href="<?php echo M_URL('Website','tempBackground',$recId,GP("adddate-1")); ?>"><i class="desc-i"></i>添加时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Website','tempBackground',$recId,GP("adddate-2")); ?>"><i class="asc-i"></i>添加时间</a>	
					<?php }?>
					<!--<a class="mr20">到期时间 <i class="desc-i"></i></a>
					<a class="mr20">总消费额 <i class="desc-i"></i></a>-->
				</div> 
	    			
	    			</th>
	    			<th>操作</th>
	    		</tr>
	    		
	    	</thead>
	    	<tbody>
	    		 <?php foreach($values as $k=>$v){?>
	    		<tr>
	    			<td style="width: 30px;">
	    				<?php if($v['wxid']!=0){?>
						<input class="select-checks" type="checkbox" value="<?php echo $v['id']; ?>" name='check[]' />
						<?php }?>
	    			</td>
	    			<td>
	    				<img class="showImg" src="<?php echo $v['fileurl'];?>">
	    			</td>
	    			<td>
	    				<?php echo $v['id'];?>
	    			</td>
	    			<td>
	    				<?php echo $v['filename'];?>
	    			</td>
	    			<td>
	    				<?php echo date('Y-m-d H:i:s',$v['adddate']); ?>
	    			</td>
	    			
	    			<td class="ks-head-el">
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
							<?php if($v['ism']==1){?>
							<li> <a href="javascript:void(0);">默认模版</a> </li>
							<?php }else{?>
							<li> <a href="<?php echo M_URL('Website','defaultBack',$v['id'],GP('p-'.$page->now_page));?>">默认模版</a> </li>
							<?php }?>
							<?php if($v['wxid']!=0){?>		
							<li > <a href="<?php echo M_URL('Website','bgEdit',$v['id'],GP('p-'.$page->now_page));?>">编辑</a> </li>
							
							<li> <a  onclick="Confirm('是否删除此背景','<?php echo M_URL('Website','deletebg',$v['id'],GP('p-'.$page->now_page.',tempid-'.$v['tempid']));?>');"> 删除</a> </li>
							<?php }?>
						</ul>
					</div>
				</td>
	    		</tr>
	    		 <?php }?>
	    	</tbody>
	    </table>
	            
		<!--footer-->
		<?php if(count($values)!=0){ ?>
		<div class="ks-bom clearfix">
			<div class="fl"> <label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label> <button class="ks-heade-button" type="submit" name="batch" value="4">	<i class="iconfont icon-shanchu1"></i></button> </div>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		<?php } ?>
		
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs();
			
		});
	
	
	</script>
	
</form>
</body>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</html>
