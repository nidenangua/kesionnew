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
	
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
 
		<!--结束-->
		<div class="Header-tool clearfix"> 
			<div class="Tool-Title">
			<!--标题-->
			<p>
				<a href="javascript:history.go(-1);">
					<i class="iconfont icon-jiantou-copy"></i>商家管理<span></span>
				</a>
			</p>
			<!--标题-->
			</div>
			<div class="Tool-btnGroup">
			   	<a href="<?php echo M_URL('Offweb','caseManage');?>" class="ks-bt bt-pur mr10" >添加商家</a>
			</div>
			<!--操作范围-->
			<!--按钮组件-->
			<!--按钮组件-->
			<!--搜索框组件-->
			<div class="clearfix ks-top-tab fr">
			<div class="fl ks-top-search">
			<!--搜索-->
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
       			<input type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Website','TempBackground',$recId); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
            </form>		
			<!--搜索-->
			</div>
			</div>
			<!--搜索框组件-->
			<!--操作范围-->
		</div>


	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix" style="padding-left: 10px;">
			<li style="margin-right: 10px;"><input class="selectAll select-checks" name="check1" type="checkbox" id="sAll"></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix">
					<!--<?php if($adddate == 2){?>
						<a class="desc" href="<?php echo M_URL('Offweb','Business',$recId,GP("adddate-1")); ?>"><i class="desc-i"></i>添加时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Offweb','Business',$recId,GP("adddate-2")); ?>"><i class="asc-i"></i>添加时间</a>
					<?php }?>-->
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
    <form target="hidframe" id="myform" method="post" target="hidframe" action="<?php echo M_URL('Offweb','delCase','',GP('p-'.$page->now_page)); ?>" class="form-horizontal" enctype="multipart/form-data">
        <div class="H5-gameListConts">
            <ul class="H5-gameList">
                <?php foreach($value as $k=>$v){?>
                <li>
                    <div class="card school-online">
                        <div class="card-left card-top">
                            <input class="select-checks" type="checkbox" value="<?php echo $v['id']; ?>" name='id[]' />
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-left card-middle">
                                    <a href="">
                                        <img class="showImg" src="<?php echo $v['picture']; ?>" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-heading">
                                        <div class="fr">
                                            <!--style="margin-top: -10px;"-->
                                            &nbsp;&nbsp;
                                            <a class="grayLing" onclick="Confirm('是否删除','<?php echo M_URL('Offweb','delCase',$v['id'],GP('p-'.$page->now_page));?>');">删除</a>

                                        </div>
                                    </h4>
                                    <div class="clearfix">
                                        <div class="gruid fl">
                                            <ul>
                                                <li>
                                                    ID：<?php echo $v['id'];?> &nbsp;&nbsp;&nbsp;&nbsp;商家名称：<?php echo $v['name'];?>
                                                </li>
                                                <li>
                                                    上传时间：
                                                    <span class="grayLing" style="margin: 0px;">
                                                        <?php echo date('Y-m-d H:i:s',$v['adddate']); ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ks-operaRight fr" style="margin-left: 1307px;">
                                            <ul class="clearfix">
                                                <li>
                                                    <a href="<?php echo M_URL('Offweb','caseManage',$v['id'],GP('p-'.$page->now_page));?>">
                                                        <i class="iconfont icon-bianji"></i>
                                                        <p class="class-name">编辑</p>
                                                    </a>
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
        </div>


        <div class="ks-bom clearfix">
            <div class="fl">
                <label class="mr20 fl">
                    <input type="checkbox" class="selectAll select-checks" />全选
                </label>
                <button class="ks-bt bt-pue" type="submit" name="batch" value="4">批量删除</button>


            </div>
            <div class="fr">
                <?php echo $page->show(3); ?>
            </div>

        </div>



    </form>
</body>

<script src="//ks.kesion.com//Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage']);
</script>
</html>

