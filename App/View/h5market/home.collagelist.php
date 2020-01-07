<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>专栏管理</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">  
<div class="ks-wbox bRadius10">
	<!--header-->
	<div class="ks-head-box clearfix">
		<h3 class="ks-head-title2">
               拼团
               <div class="fr">  
               <a class="ks-setting-icon fl ml10" target="_blank" href="https://store.kesion.com/home/help#anchor57"><i class="iconfont icon-qm"></i></a>
               </div>
		</h3>
	</div>
	<!--header-->
	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="fl">
			<div class="ks-search-box">
				<!--搜索框组件-->
				<form target="hidframe">
                    <select class="w150 inputText bRadius5  fl" id="keytype">
                            <option value="1" selected="">全部</option>
                    </select>
					<div class="ks-top-search ml15 fl">
					<input type="text" class="sc-text ml0" name="searchText" id="keyword" >
					<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('h5market/Index','collage'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
					</div>
				</form>
				<!--搜索框组件-->
			</div>					
		</div>
		<!-- <div class="fl ks-head-tbox">
			<input type="text" id="selectTime" class="ks-head-input ks-head-time w300 ml20" placeholder="自定义时间段"/>
			<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
		</div> -->
		<div class="fr">
			<ul class="ks-head-choice">
			<li>
			<div class="ks-head-el">
				<!-- <button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
				<div class="ks-head-content ks-head-content-pr w400">
				</div> -->
			</div>
			</li>
			<li>
			<div class="ks-head-el">
            <a href="<?php echo M_URL('h5market/Index','addcollage','',GP('appid-26')); ?>" class="ks-heade-button ks-head-primary" type="button"><i class="icon-jiahao iconfont "></i>创建拼团</a>   
			</div>
			</li>
			</ul>
		</div>
	</div>
	<!--/widget-->
	<form target="hidframe"  action="" method="post" id="myform" >
	<!--table-->
	<table class="ks-table">
		<thead>
			<tr>
                <th>拼团课程</th>
                <th style="text-align:left">成团人数</th>
                <th>拼团价(元)</th>
                <th>团长价格(元)</th>
                <th>拼团活动时间</th>		
                <th>总团数</th>
                <th>已成团</th>
                <th>未成团</th>
                <th>推广</th>
                <th>状态</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($values as $k => $v) { ?>
             <tr> 
                <td><img src="<?php echo $v['defaultpic']; ?>" class="defaultpic" style="width:120px;float:left"><span style="margin-top:20px;display:block;float:left;padding-left:20px"><?php echo $v['title']; ?></span></td>
                <td> <?php echo $v['setting']['rewardpeple']; ?>人团</td>
                <td> <?php echo $v['setting']['teammoney'] ?></td>
                <td><?php echo $v['setting']['leadmoney'] ?></td>
                <td>
                    <p>起：<?php echo date('Y-m-d H:i:s',$v['startime']); ?></p>
                    <p>止：<?php echo date('Y-m-d H:i:s',$v['endtime']); ?></p>
                </td>
                <td> <?php echo $v['groupnum']; ?></td>
                <td> <a style="color: blue" href="<?php echo M_URL('h5market/Index','uncollage',$v['id'],GP('appid-26,s-1')); ?>"><?php echo $v['groupnum1']; ?></a></td>
                <td> <a style="color: blue" href="<?php echo M_URL('h5market/Index','uncollage',$v['id'],GP('appid-26,s-0')); ?>"><?php echo $v['groupnum2']; ?></a></td>
                <td><a href="javascript:addTypeChange('<?php echo M_URL('h5market/Index','share',$v['id'],GP('appid-26')); ?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a>
                </td>
                <td>
                	<?php if($v['isstar'] == 0){
                		echo '未开启';
                	}elseif($v['isstar'] == 1){
                		echo '进行中';
                	}else{
                		echo '关闭了';
                	} ?>
                </td>
                <td class="ks-head-el">
                	<?php if($v['isstar']==0||$v['isstar']==1){ ?>
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<?php }else{?>
					  <a href="javascript:Confirm('是否删除此该拼团？该操作不可逆！','<?php echo M_URL('h5market/Index','delect',$v['id'],GP('appid-26,p-'.$page->now_page)); ?>')"><i class="iconfont icon-shanchu1"></i></a>	
					<?php } ?>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
							<!-- <li ><a href=" ">详情</a></li> -->
							<?php if($v['isstar'] == 0){ ?>
								 <li> <a href="<?php echo M_URL('h5market/Index','addcollage',$v['id'],GP('appid-26,edit-1')); ?>">编辑</a> </li>
                				<li ><a onclick="satr(0,<?php echo $v['id']; ?>)">开启拼团</a> </li>
                			<?php }elseif($v['isstar'] == 1){ ?>
                				<li> <a href="<?php echo M_URL('h5market/Index','addcollage',$v['id'],GP('appid-26,edit-2')); ?>">详情</a> </li>
                				<li ><a onclick="satr(1,<?php echo $v['id']; ?>)">停止拼团</a> </li>
                			<?php } ?>
							                         										
						</ul>
					</div>
				</td>
            <tr>
            <?php } ?>
		</tbody>
	</table>
	<!--/table-->
	<?php echo Noc($values); ?>
	<input type="hidden" name="batch" id="batch1" />
	<div class="ks-bom clearfix">
		<div class="fl">
			<!-- <label class="mr20 fl"><input type="checkbox" class="selectAll" >全选</label>
			<button type="button" class="ks-heade-button mr10" onclick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
			<button type="button" class="ks-heade-button mr10" onclick="submitform(2)" >批量上架</button>
			<button type="button" class="ks-heade-button" onclick="submitform(3)" >取消上架</button> -->
		</div>
		<div class="fr">
			<?php echo $page->show(3); ?>
		</div>
	</div>	
	
	</form>

</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
		module.require(['$','webuploader','backstage'],function(){			
			
		});
		function satr(i,id){
			if(i==0){
				var url = "<?php echo M_URL($this->AppName.'/Index','starH5','',GP("")); ?>";
			}else{
				var url = "<?php echo M_URL($this->AppName.'/Index','closeH5','',GP("")); ?>";
			}
			$.ajax({
	        type: "POST",
	        url:url,
	        data:{id:id},
	        success:function(text){
	        	var res =JSON.parse(text);
	        	if(res.errcode=='1000'){
	        		Alert(res.msg)
	        	}else{
	        		location.reload();
	        	}
	        },
	     	error:function(){
	         } 
	     });     


		}
</script>
</body>
</html>


