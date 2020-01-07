<!doctype html>
<html>
<head>	
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">

<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echo time();?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top: 50px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;padding-bottom:30px;}
	.ring{position: absolute;right: 20px;top: 15px;width:200px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
		.operaRight li a {
	    display: block;
	    border: 1px solid #86A8F1;
	    text-align: center;
	    padding: 15px 0px 5px 0px;
	    color: #86A8F1;
	    border-radius: 5px;
	    width: 70px;
	    height: 70px;
	    box-sizing: border-box;
	    line-height: 24px;
	    cursor: pointer;
	}
	.operaRight li{
		list-style: none;
        float: right;
        margin-right: 10px;
	}
	.curr{
		  border-image: none;
		    border-style: solid;
		    border-width: 1px;
		    color: #555;
		    cursor: default;
		    border-top: 0;
		    background-color: #fff!important;
		}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:55px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;风格模板
        	<a href="<?php echo M_URL('Temp','tempAdd','',GP('typetype-'.$temptype));?>" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #FF5507;border: none;">添加模板风格</a>
        	<a href="javascript:addTypeChange('<?php echo M_URL('Temp','templist','',GP('type-top,name-zip,temptype-'.$temptype.'',true));?>','930px','610px',{title:'选择ZIP压缩包',type:'top'})" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #FF5507;border: none;">上传ZIP导入</a>
        	<a href="<?php echo M_URL('Temp','AppletTemp','',GP('')); ?>" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #FF5507;border: none;">小程序</a>		
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			
					
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1">风格名称</option>
	  	    </select>
			
			<form target="hidframe" class="fr">
				<input type="text" class=" sc-text" id="keyword" style="width:200px;" value="<?php if(isset($keyword)) echo $keyword; ?>">
            	<input type="submit" class="sc-button" onclick="searchByClass(searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Temp','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<div style="margin-top: 15px;">
		
	<div class="H5-gameListScreen" style="height: 44px;">
		<ul class=" nav nav-tabs">

	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($temptype==0) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('Temp','index','',GP('temptype-0',true)); ?>">PC模板</a>
	        </li>
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($temptype==1) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('Temp','index','',GP('temptype-1',true)); ?>">公众号模板</a>
	        </li>
<!--	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 --><?php //if($temptype==2) echo " curr" ;?><!--">-->
<!--	        	<a href="--><?php //echo M_URL('Temp','index','',GP('temptype-2',true)); ?><!--">学堂模板</a>-->
<!--	        </li>-->
			<li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($temptype==3) echo " curr" ;?>">
				<a href="<?php echo M_URL('Temp','index','',GP('temptype-3',true)); ?>">小程序模版</a>
			</li>
	    </ul>
		
	</div>
</div>
<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('Temp','deleteTemps','',GP('p-'.$page->now_page.'temptype-'.$temptype)) ?>" class="form-horizontal" enctype="multipart/form-data">
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
		<!-- <ul class="H5-gameList"> -->
			<table class="ks-table">
				<thead>
					<tr>
						<th>选择</th>
						<th>ID</th>
						<th>封面</th>
						<th>模板名称</th>
						<th>允许使用的版本</th>
						<th>作者</th>
						<th>适用</th>
						<th class="shaixuan">
							<?php if($adddate == 2){?>
								<a class="desc" href="<?php echo M_URL('Temp','index','',GP("adddate-1")); ?>" style="float: none;"><i class="desc-i" style="top: -1px;"></i>更新时间</a>		
							<?php }else{ ?>
								<a class="desc" href="<?php echo M_URL('Temp','index','',GP("adddate-2")); ?>" style="float: none;"><i class="asc-i" style="top: -1px;"></i>更新时间</a>
							<?php }?>
						</th> 
						<th>操作</th>
					</tr>
				</thead>
				<tbody>	
			 <?php foreach($values as $k=>$v){?>
			<tr>
				<td><input class="select-checks" type="checkbox" value="<?php echo $v['tempid']; ?>" name='id' /></td>
				<td><?php echo $v['tempid'];?></td>
				<td><img class="showImg" src="<?php echo $v['defaultpic'];?>" style="width: 107px;"></td>
				<td>
					<?php echo $v['tempname'];?>(<a href="<?php echo M_URL("Temp","setTempStatus",$v['tempid'],"ispub-".$v['ispub']);?>"><?php if($v['ispub'] == 0){ echo '<span style="color:red">未发布</span>'; }else { echo '<span style="color:green">已发布</span>'; } ?></a><?php if ($v["isoffc"]==1){ echo " <span style='color:brown'>官网</a>"; } ?>)
				</td>
                 <td style="text-align:center"> <?php
                       $showtips=wx_showappfree($v['package']);
                       if (!empty($showtips)){
                           echo '<div style="color:green;">'.$showtips.'</div>';
                       }
                                                ?></td>
				<td><?php echo $v['author'];?></td>
				<td><span class="deepBlue"><?php 
                                          if ($v['skintype']=='0'){
                                              echo '通用';
                                          }else if ($v['skintype']=='1'){
                                              echo '个人';
                                          }else if ($v['skintype']=='2'){
                                              echo '企业';
                                          }
                                          ?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
				<td class="operaRight">
					<li>
						<a onclick="Confirm('是否删除该模板','<?php echo M_URL('Temp','deleteTemps',$v['tempid'],GP('p-'.$page->now_page));?>');" >
							<i class="iconfont icon-bianji"></i>
							<p class="class-name">删除</p>
						</a>
					</li>

					<li>
						<a href="<?php echo M_URL('Temp','tempEdit',$v['tempid'],GP('p-'.$page->now_page));?>">
							<i class="iconfont icon-bianji"></i>
							<p class="class-name">编辑</p>
						</a>
					</li>
					<?php if($v['temptype']==2){?> 
					<li>
						<a href="<?php echo M_URL('Temp','tempBackground',$v['tempid'],GP('p-'.$page->now_page));?>">
							<i class="iconfont icon-bianji"></i>
							<p class="class-name">背景管理</p>
						</a>
					
					</li>
					<li>
						<a href="<?php echo M_URL('Temp','tempBgm',$v['tempid'],GP('p-'.$page->now_page));?>">
							<i class="iconfont icon-bianji"></i>
							<p class="class-name">音乐管理</p>
						</a>
					
					</li>
					<?php }?>
					<li>
						<a href="<?php echo M_URL('Label','index','',GP('temptype-'.$temptype.',tempid-'.$v['tempid'].',p-'.$page->now_page));?>">
							<i class="iconfont icon-zhanghuziliao"></i>
							<p class="class-name">标签管理</p>
						</a>
					
					</li>
					<li>
						<a href="<?php echo M_URL('Temp','tempDirlist',$v['tempid'],GP('temptype-'.$temptype.',p-'.$page->now_page));?>">
							<i class="iconfont icon-shouhuoziliao"></i>
							<p class="class-name">模板文件</p>
						</a>
					
					</li>
					<?php if($v['isdefault']==0){?> 
					<li>
						<a href="<?php echo M_URL('Temp','defaultTemp',$v['tempid'],GP('p-'.$page->now_page.',skintype-'.$v['skintype']));?>">
							<!--<i class="iconfont icon">DET</i>-->
							<p class="class-name">设为默认</p>
						</a>
					</li>
					<?php }else{?>
						<li>
						<a href="javascript:void(0);">
							<!--<i class="iconfont icon">DET</i>-->
							<p class="class-name" style="color:green;">默认模版</p>
						</a>
					</li>
                    <?php }?>
                    <!--
					<li>
						<a href="<?php echo M_URL('Temp','zip',$v['tempid'],GP('temptype-'.$temptype.',tempid-'.$v['tempid'])); ?>">
							<i class="iconfont icon-shouhuoziliao"></i>
							<p class="class-name">导出ZIP</p>
						</a>
					
					</li>
                   -->
				</td>
				
			</tr>
			 <?php }?>
		    </tbody>

		</table>
		
		<br />
		<br />
		<br />
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


