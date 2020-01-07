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
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style>
		.card-body, .card-left, .card-right {vertical-align: middle;}		
		.ks-operaRight{position: absolute; right: 20px; top: 30px;}
		.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
		.H5-gameList>li {position: relative;min-height: 90px;box-shadow: none;border-bottom: 1px solid #EEEEEE;}
		.school-online .gruid {width: 100%;}
	</style>
</head>

<body class="ks-wrap">
	
	<div class="ks-wbox bRadius10" style="background: #FFF;">
		<!--header-->
	   <div class="ks-head-box clearfix">
			
			<div class="ks-head-nav bd_e">
				<!--标题-->
				 <a href="<?php echo M_URL('Website');?>">网站设置</a> / <a href="<?php echo M_URL('Website','websitetemplate',2);?>">我的模板</a> / <span>背景音乐设置</span>
				<!--标题-->
			</div>
			
		</div>
	    <!--header-->
					     
			  
		<!--widget-->
		<div class="clearfix">
			
			
			<div class="fl ks-top-search mt10">
				<!--搜索-->
				<form target="hidframe" class="fr">
					<select class="inputText bRadius5 fl mr10" id="keytype" style="width: 150px;height: 33px;">
					     <option value="1">音乐名称</option>
			  	    </select>
					<input style="margin: 0px;" type="text" class="sc-text" name="searchText"  id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">		
					<button type="submit" class="ks-head-search" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Website','TempBgm',$id); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
	            </form>		
				<!--搜索-->
			</div>
			
			<div class="Tool-btnGroup fr">
			  	<a href="<?php echo M_URL('Website','tempbgmAdd',$id);?>"class="ks-bt bt-pue mr10" >添加音乐</a>
        		<a href="<?php echo M_URL('Website','tempBackground',$id);?>"class="ks-bt bt-pue mr10" >设置背景图片</a>
			</div>
			
			
		</div>
		<!--/widget-->
		<!--table-->

		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix" style="padding-left: 0px;">
			<li style="margin-right: 10px;"><input class="selectAll select-checks" name="check1" type="checkbox" id="sAll"></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li style="float: left;">
				<div class="shaixuan fl">
					<?php if($adddate == 2){?>
						<a class="desc" href="<?php echo M_URL('Website','tempBgm',$id,GP("adddate-1")); ?>"><i class="desc-i"></i>添加时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Website','tempBgm',$id,GP("adddate-2")); ?>"><i class="asc-i"></i>添加时间</a>
								
					<?php }?>
					<!--<a class="mr20">到期时间 <i class="desc-i"></i></a>
					<a class="mr20">总消费额 <i class="desc-i"></i></a>-->
				</div> 
			</li>
		</ul>	
	</div>
<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('Website','deletebgms',$id,GP('p-'.$page->now_page.'option-'.$option)); ?>" class="form-horizontal" enctype="multipart/form-data">
	<div class="H5-gameListConts">
		<ul class="H5-gameList">
			 <?php foreach($values as $k=>$v){?>
			<li>
				<div class="card school-online">
				  	<div class="card-left  card-top" style="width: 2%;">
				  		<?php if($v['wxid']!=0){?>
						  <input class="select-checks" type="checkbox" value="<?php echo $v['id']; ?>" name='check[]' />
						  <?php }?>
				  	</div>
				  	<div class="card-body">
					
						<div class="card">
						  	<div class="card-left card-middle">
								<audio src="<?php echo $v['fileurl'];?>" controls="controls">
									你的浏览器不兼容该控件，请使用谷歌或者谷歌内核浏览器
								</audio>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									<div class="fr" style="margin-top: -10px;">
										
										 &nbsp;&nbsp;
										
									</div>
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<ul>
											<li>ID：<?php echo $v['id'];?> &nbsp;&nbsp;&nbsp;&nbsp;音乐名称：<?php echo $v['filename'];?>
												
											</li>
											<li>上传时间：<span class="grayLing" style="margin: 0px;"><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></span></li>
										</ul>
										
										
										
										
									</div>
									
									<div class="ks-operaRight fr" style="margin-top: -10px;">
		        					<ul class="clearfix">
		        						<?php if($v['ism']==1){?> 
		        						<li>
											<a href="javascript:void(0);">
												<i class="iconfont icon">DET</i>
												<p class="class-name" style="color: green;">默认模版</p>
											</a>
										</li>
										<?php }else{?> 
		        						<li>
											<a href="<?php echo M_URL('Website','defaultBgm',$v['id'],GP('p-'.$page->now_page));?>">
												<i class="iconfont icon">DET</i>
												<p class="class-name">默认模版</p>
											</a>
										</li>
										<?php }?>
										<li>
											<?php if($v['wxid']!=0){?>
											<a href="<?php echo M_URL('Website','bgmEdit',$v['id'],GP('p-'.$page->now_page));?>">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">编辑</p>
											</a>
										<?php }?>
										</li>
										<li>
										<?php if($v['wxid']!=0){?>
										
										
										<a onclick="Confirm('是否删除此音乐','<?php echo M_URL('Website','deletebgm',$v['id'],GP('p-'.$page->now_page.',tempid-'.$v['tempid']));?>');">
												<i class="iconfont icon-lajitong"></i>
												<p class="class-name">删除</p>
											</a>
										<?php }?>
										</li>
		        					</ul>
		        				</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
			 <?php }?>
		</ul>
		<?php echo Noc($values);?>
		</div>

	    <!--/table-->
	            
		<!--footer-->
		<?php if(count($values)!=0){ ?>
			<div class="ks-bom clearfix">
				<div class="fl">
					<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
			         <button class="ks-heade-button" type="submit" name="batch" value="4"><i class="iconfont icon-shanchu1"></i></button>		      
				</div>
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



<!--<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
</style>
</head>
<body class="gray-bg">
<div class="wrapper mt0">
    <div id="manage_top" class="menu_top_fixed p15 height73">
        <h3 class="fl ml15">网站模板风格</h3>
        <div class="ibox-tools" >
            <a href="javascript:void(0);" onclick="history.go(0)" class="collapse-link mt0"><i class="reflash"></i></a>
        </div>
        <ul>
            <li><a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Temp','tempAdd');?>','850px','600px');"><i class="add2017"></i>新建模板风格</a></li>
            <li><a href="javascript:addTypeChange('<?php echo M_URL('Temp','templist','',GP('type-top,name-zip,temptype-'.$option.'',true));?>','930px','610px',{title:'选择ZIP压缩包',type:'top'})"><i class="one2017"></i>导入Zip模板风格</a></li>
        </ul>
    </div>
</div>
<div class="tabs-container mb40"><br /><br />
<ul class="nav nav-tabs">
    <li <?php if($option==0)echo "class='active'";?>><a href="<?php echo M_URL('Temp','index','',GP('option-0',true)); ?>">响应式门户模板</a></li>
  
    <li <?php if($option==2)echo "class='active'";?>><a href="<?php echo M_URL('Temp','index','',GP('option-2',true)); ?>">响应式学堂模板</a></li>
 
</ul>
<div class="tap-content">
   <div class="tab-pane active">
      <div class="panel-body">
      <?php foreach($values as $k=>$v){?>
          <div class="row border-solid pb15 mt7">
              <div class="col-sm-9">
                 <div class="template-box">
                     <div class="template-img">
                     <img src="<?php echo $v['defaultpic'];?>">
                     </div>
                     <div class="template-choice">
                         <h3 class="template-h3 f-f16 pt15"><?php echo $v['tempname'];?></h3>
                         <p class="template-p mt10 pb15">
                            <span class="template-span mr15">ID：<?php echo $v['tempid'];?></span>
                            <span class="template-span mr15">作者：<?php echo $v['author'];?></span>
                            <span class="template-span">模板目录：<?php echo $v['installdir'];?></span>
                         </p>
                         <div class="template-style">
                            <a class="template-a" href="<?php echo M_URL('Temp','tempDirlist',$v['tempid'],GP('option-'.$option.',p-'.$page->now_page));?>">
                                <i class="template-icon icon-file"></i>模板文件
                            </a>
                            <a class="template-a" href="<?php echo M_URL('Label','index','',GP('option-'.$option.',tempid-'.$v['tempid'].',p-'.$page->now_page));?>">
                                <i class="template-icon icon-label"></i>标签管理
                            </a>
                            <a class="template-a" href="">
                                <i class="template-icon icon-JS"></i>JS标签
                            </a>
                            <a class="template-a" href="<?php echo M_URL('Temp','zip',$v['tempid'],GP('option-'.$option.',tempid-'.$v['tempid'])); ?>">
                                <i class="template-icon icon-Zip"></i>导出Zip
                            </a>
                       </div>
                   </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="template-edit fr">
                    <a href="<?php
	                    switch($option){
							case  0:echo 'http://hcl.zuojy.com/&tp='.$v['tempid'].',6';break;
							case  1:echo 'http://hcl.zuojy.com/&tp='.$v['tempid'].',6';break;
							case  2:echo 'http://hcl.zuojy.com/users/class/&tp=4,'.$v['tempid'];break;
							case  3:echo 'http://hcl.zuojy.com/users/class/&tp=4,'.$v['tempid'];break;
						}				
					
					 ?>" target="_blank" class="T-edit-a">预览</a>
                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Temp','tempEdit',$v['tempid'],GP('p-'.$page->now_page));?>','850px','600px');" class="T-edit-a">编辑</a>
                    <?php if($v['isdefault']==1){?>
                    <a href="javascript:void(0);" class="T-edit-a" style="color:#F00;">默认模板</a>
                    <?php }else{?>
                    <a href="<?php echo M_URL('Temp','defaultTemp',$v['tempid'],GP('p-'.$page->now_page));?>" class="T-edit-a">设为默认</a>
                    <?php }?>
                    <a href="javascript:void(0);" onclick="Confirm('是否删除此应用','<?php echo M_URL('Temp','deleteTemp',$v['tempid'],GP('p-'.$page->now_page));?>');" class="T-edit-a">删除</a>
                </div>
            </div>
         </div>
      <?php }?> 
      <?php echo NoC($values);?> 
      </div>
   </div>
</div>
<div class="footer-page">
<div class="col-sm-7"></div>
<div class="col-sm-5">
<?php echo $page->show(3); ?>
</div>
</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
</body>
</html>-->