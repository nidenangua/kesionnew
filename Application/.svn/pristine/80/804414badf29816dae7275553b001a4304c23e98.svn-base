<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
	.ks-overflow{overflow: hidden;text-overflow:ellipsis;white-space: nowrap;}
	.ks-clist>ul> li{margin-bottom: 20px;padding-bottom:20px;border-bottom: solid 1px #EEEEEE;padding-left:35px;border-radius: 0px;} 
	.ks-check{left: 0px;}
</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		
		<!--header-->
	     <div class="ks-head-box">
	     		<h3 class="ks-head-title2"><?php if($option==1){ echo '公告管理';}else{echo '站内消息';} ?></h3>
	     </div>
	     <!--header-->
	    
				        
			  
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="fl ks-search-box">
				<form target="hidframe">
					<input type="text" class="sc-text ks-head-input w300" name="searchText" id="keyword" value="<?php if(isset($keyword))echo $keyword;?>" placeholder="公告标题">
					<input type="hidden" value="1" id="keytype" />
					<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP('p-'.$now_page); ?>','<?php echo M_URL('home/Massage','postlist'); ?>','<?php echo URL_MODEL;?>')" ><i class="iconfont icon-sousuo"></i></button>
				</form>
			</div>	
			<div class="fr">
				<ul class="ks-head-choice">
					<li>
						<div class="ks-head-el">
                            <a class="ks-heade-button ks-head-primary" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,8,false,true);?>'})" href="<?php echo M_URL('Massage','postmassage','',GP('option-'.$option)); ?>">
                                <i class="iconfont icon-jiahao"></i><?php if($option==1){echo '发送公告';}else{echo '发送消息';}?>
                            </a>	
						</div>
					</li>	
				</ul>
					
			</div>
					
		</div>
		<!--/widget-->
	    <form target="hidframe" id="myform"  action="<?php echo M_URL('Massage','delpost','',GP("option-".$option));?>"  method="post" enctype="multipart/form-data">
		<!--table-->
		<div class="news">	
    	<!--站内信列表-->
    <?php if($option == 2){ ?>
   		<table class="ks-table">
   			<thead>
   				<tr>
   					<td>选择</td>
   					<td style="text-align: left;">消息标题</td>
   					<td>发件人</td>
   					
   					<td>发送人数</td>
   					<td>已阅人数</td>
   					<td>发送时间</td>
   					<td>消息状态</td>
   					<td>操作</td>
   				</tr>
   			</thead>
   			
    <?php foreach($Massages as $k=>$v){ ?>
    	<tr  id="<?php echo $v['id'] ?>">
    		<td style="width: 30px;"><input type="checkbox" class="select-checks form-in" name="check[]" value="<?php echo $v['id'] ?>"></td>
    		<td style="text-align: left;"><?php echo $v['title'];?></td>
    		<td><?php echo $v['inputer']; ?></td>
    		<td><?php echo Field($v['sendnum']);?><span style="margin-left: 15px;"><a class="c-86A8F" href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Massage','readerlist',$v['id'],GP('stytype-1'));?>','800px','600px',{type:'top',title:'发送学员'});" >查看</a></span></td>
    		<td><?php echo Field($v['readnum']);?><?php echo Field($v['readnum']);?><span style="margin-left: 15px;"><a class="c-86A8F" href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Massage','readerlist',$v['id'],GP('stytype-2'));?>','800px','600px',{type:'top',title:'已阅学员'});" >查看</a></span></td>
    		<td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
    		<td>
    				<?php if($v['status'] == 1){ echo '<span class="ks-audit">草稿</span>';}else{ echo '<span class="ks-unaudit">已发送</span>';}?>
    		</td>
    		
    		<td class="ks-head-el"  >
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc">
						<ul class="opeart">
								<li>
   				 			<a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Massage','editnotice',$v['id'],GP(''));?>','800px','600px',{type:'top',title:'编辑站内信'});">编辑</a>
								</li>
								
							
								<li >
										<a href="javascript:void(0);" onclick="Confirm('是否删除此站内信？该操作不可逆!','<?php echo M_URL('Massage','delnotice',$v['id'],GP(''));?>');">删除</a>
								</li>
								
						</ul>
					</div>
				</td>
    	</tr>
    	
    	
    	
    <?php } ?>
   </table>
    <?php echo NoC($Massages);?>
    </div>
     <!--消息列表结束-->
    <?php }elseif($option == 1){ ?>
    <!--公告列表-->

    <table class="ks-table">
   
    	<thead>
    		<tr>
    			<th>选择</th>
    			<th style="text-align: left;">消息标题</th>
    			<th>发件人</th>
    			<th>已阅人数</th>
    			<th>发送时间 </th>
    			<th>消息状态</th>
    			<th>操作</th>
    		</tr>
    	</thead>
    <?php foreach($Massages as $k=>$v){ ?>
    
    		<tr id="<?php echo $v['id'] ?>">
    			<td  ><input type="checkbox" class="select-checks form-in" name="check[]" value="<?php echo $v['id'] ?>"></td>
    			<td style="text-align: left;"><?php echo $v['title'];?></td>
    			<td><?php echo $v['inputer']; ?></td>   			    			
    			<td><?php echo Field($v['readnum']);?> <span style="margin-left: 15px;"><a href="javascript:void(0);" class="c-86A8F"  onclick="addTypeChange('<?php echo M_URL('Massage','readerlist',$v['id'],GP('stytype-2'));?>','800px','600px',{type:'top',title:'已阅学员'});" >查看</a></span></td>
    			<td><?php echo $v['adddate'];?></td>
    			<td>
    				<?php if($v['status'] == 1){ echo '<span class="ks-audit">草稿</span>';}else{ echo '<span class="ks-unaudit">已发送</span>';}?>
    			</td>
    			<td class="ks-head-el"  >
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc">
						<ul class="opeart">
								<li>
   				 			<a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Massage','editnotice',$v['id'],GP(''));?>','800px','600px',{type:'top',title:'编辑公告'});">编辑</a>
								</li>
								
								<li>
									<a href="javascript:void(0);"  onclick="addTypeChange('<?php echo M_URL('Massage','readerlist',$v['id'],GP('stytype-2'));?>','800px','600px',{type:'top',title:'已阅学员'});" >查看</a>
								</li>
								<li >
										<a href="javascript:void(0);" onclick="Confirm('是否删除此站内信？该操作不可逆!','<?php echo M_URL('Massage','delnotice',$v['id'],GP(''));?>');">删除</a>
								</li>
								
						</ul>
					</div>
				</td>
    		</tr>
    	
    	
    	
    	
    <?php }?>
    </table>	
    <?php echo NoC($Massages);?>
 
    <!--消息列表结束-->
    <?php } ?>
    	<?php if(!empty($Massages)){?>
	<div class="ks-bom clearfix">
		<div class="fl">
		    <label class="mr20 fl"><input type="checkbox" class="select-checks selectAll"  id="selectAll">全选</label>
			<button class="ks-heade-button mr10" onclick="submitform(1);"><i class="iconfont icon-shanchu1"></i></button>
		</div>
		<div class="fr"><?php echo $page->show(3); ?></div>
	</div>
	 <?php } ?>
    </div>
	    <!--/table-->
	    </form>       
		
	
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			
		});
	  	function submitform(type){
			$('#batch1').val(type);
			$('#myform').submit();
		}
	
	</script>

</body>
</html>
