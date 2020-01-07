<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.H5-gameList>li{padding: 10px;}
	.school-online .nv{color:#E777C4;}
	.gruid ul li{font-size: 14px;}
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top: 30px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;padding-bottom:20px;}
	.ring{position: absolute;right: 20px;top:0px;width:200px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:65px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;模板背景
        	<a href="<?php echo M_URL('Temp','tempbgAdd',$id);?>" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #FF5507;border: none;">添加背景</a>
        	<!--<a href="javascript:addTypeChange('<?php echo M_URL('Temp','templist','',GP('type-top,name-zip,temptype-'.$option.'',true));?>','930px','610px',{title:'选择ZIP压缩包',type:'top'})" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #FF5507;border: none;">上传ZIP导入</a>-->
        </h3>
        <div class="ks-top-search">
				<a class="ks-bt" href="<?php echo M_URL('Temp','index','',GP(''));?>"><i class="iconfont icon-fanhui"></i>返回</a>
		</div>	   
        <div class="fr">
            <div class="fl ks-top-search">
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Temp','TempBackground',$id); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
            </form>	
			</div> 
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<div>
		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix" style="padding-left: 10px;">
			<li style="margin-right: 10px;"><input class="selectAll select-checks" name="check1" type="checkbox" id="sAll"></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix">
					<?php if($adddate == 2){?>
						<a class="desc" href="<?php echo M_URL('home/Temp','tempBackground',$id,GP("adddate-1")); ?>"><i class="desc-i"></i>添加时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('home/Temp','tempBackground',$id,GP("adddate-2")); ?>"><i class="asc-i"></i>添加时间</a>
								
					<?php }?>
					<!--<a class="mr20">到期时间 <i class="desc-i"></i></a>
					<a class="mr20">总消费额 <i class="desc-i"></i></a>-->
				</div> 
			</li>
			<li class="fr gameScreen"><!--<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选-->
				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<!--<li>
						<span>模板类型：</span>
						<div>
							<a href="<?php echo M_URL('Temp','index','',GP('option-0',true)); ?>" <?php if($option==0)echo "class='active'";?>>不限</a>
							<a href="<?php echo M_URL('Temp','index','',GP('option-1',true)); ?>" <?php if($option==1)echo "class='active'";?> >门户模板</a>
							<a href="<?php echo M_URL('Temp','index','',GP('option-2',true)); ?>" <?php if($option==2)echo "class='active'";?>>学堂模板</a>
						</div>
					</li>-->

					<!--<li>
						<span>营销模式：</span>
						<div>
							<a href="" class="active">不限</a>
							<a href="">已审核</a>
							<a href="">未审核</a>
						</div>
					</li>-->
				</ul>

			</li>				
		</ul>	
	</div>
<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('home/Temp','deletebgs',$id,GP('p-'.$page->now_page.'option-'.$option)); ?>" class="form-horizontal" enctype="multipart/form-data">
	<div class="H5-gameListConts">
		<ul class="H5-gameList">
			 <?php foreach($values as $k=>$v){?>
			<li>
				<div class="card school-online">
				  	<div class="card-left card-top">
						<input class="select-checks" type="checkbox" value="<?php echo $v['id']; ?>" name='check[]' />
				  	</div>
				  	<div class="card-body">
						<div class="card">
						  	<div class="card-left card-middle">
								<a href=""><img class="showImg" src="<?php echo XImg($v['fileurl'],1);?>"></a>
						  	</div>
						  	<div class="card-body">
								<h4 class="card-heading">
									
								</h4>
								<div class="clearfix">
									<div class="new-goup fl">
											<div class="new-cuo">
												<div>
													ID：<?php echo $v['id'];?> &nbsp;&nbsp;&nbsp;&nbsp;背景名称：<?php echo $v['filename'];?>
												</div>
												<div>
													上传时间：<span class="grayLing" style="margin: 0px;"><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></span>
												</div>
												
												
											</div>

									</div>
								</div>
							</div>
							
							
						</div>
					</div>
					
					<div class="ring">
						 &nbsp;&nbsp;
						<a class="grayLing" onclick="Confirm('是否删除此背景','<?php echo M_URL('Temp','deletebg',$v['id'],GP('p-'.$page->now_page.',tempid-'.$v['tempid']));?>');">删除</a>
					</div>
					<div class="ks-operaRight fr" >
        					<ul class="clearfix">
        						<?php if($v['ism']==0){?> 
								<li>
									<a href="<?php echo M_URL('Temp','defaultBack',$v['id'],GP('option-'.$option.',p-'.$page->now_page));?>">
										<i class="iconfont icon">DET</i>
										<p class="class-name">设为默认</p>
									</a>
								</li>
								<?php }else{?>
									<li>
									<a href="javascript:void(0);">
										<i class="iconfont icon">DET</i>
										<p class="class-name" style="color:green;">默认模版</p>
									</a>
								</li>
			                    <?php }?>
								<li>
									<a href="<?php echo M_URL('Temp','bgEdit',$v['id'],GP('p-'.$page->now_page));?>">
										<i class="iconfont icon-bianji"></i>
										<p class="class-name">编辑</p>
									</a>
								</li>
        					</ul>
        			</div>
					
				</div>
			</li>
			 <?php }?>
		</ul>
		</div>
	<div>
		<div class="footer-page h60">
                        <div class="col-sm-5">
                         <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                                <input class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
                                <label for="sAll">全选 </label>
                            </div>
                            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
                        </div>

                        <div class="col-sm-7 " style="margin-top:7px">
                        	<?php echo $page->show(3); ?>
                        </div>
		
		
	</div>
	</div>
	
	<br />	
	<br />	
	<br />	
	<br />	

</div>



</form>
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>



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