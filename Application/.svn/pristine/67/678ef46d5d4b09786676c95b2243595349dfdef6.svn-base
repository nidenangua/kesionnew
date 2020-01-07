<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper" style="margin-top:55px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;独立域名管理&
        
        </h3>
        	
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			
		
			<!--<a href="javascript:history.go(-1);" style="padding: 5px 12px;margin-left: 20px;" class="btn  btn-default  fr" type="button" >
            	<i class="iconfont icon-fanhui"></i>返回
            </a>-->
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="">
           <input type="button" class="sc-button" onclick="searchByClass('','" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<form target="hidframe" id="myform" action="" method="post">
	<div> 
	
	<div class="H5-gameListConts">
		<ul class="H5-gameList">
			
			<li>
				<div class="card school-online">
				  	<div class="card-left card-middle">
						<input  class="select-checks" name="check[]" value="<?php echo $v["id"];?>" type="checkbox">
				  	</div>
				  	<div class="card-body">
						<div class="card">
						  	<div class="card-body">
								<h4 class="card-heading">
									
								</h4>
								<div class="clearfix">
									<div class="gruid fl">
										<ul>
											<li>
												<span class="mr20 inline-block">
													用户id：<?php echo $v["userid"];?>
												</span>
												<span class="mr20 inline-block">
													绑定域名：<span class="deepBlue"></span>
												</span>
											</li>
											<li>
												<span class="mr20 inline-block">
													暂存域名：<span class="deepBlue"><?php echo $v["predomain"];?></span>
												</span>
											</li>
											<li>
												<span class="mr20 inline-block">
													申请时间：<span class="deepBlue"></span>
												</span>
											</li>
										</ul>
									</div>
									<div class="gruid fl">
										<div class="col-4">
											<div class="inline-block"></div>
					 						<div class="inline-block"></div>
										</div>
									</div>
									<div class="ks-operaRight fr" style="margin-top: -10px;">
		        					<ul class="clearfix">
										<li>
											<a onclick="addTypeChange('<?php echo M_URL('home/Domain','wxeditDomain',$v['id'],GP('p-'.$page->now_page));?>','450px','250px')">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">编辑</p>
											</a>
										</li>
										<!--<li>
											<a onclick="Confirm('是否删除此信息？该操作不可逆！','<?php echo M_URL('home/Domain','delect',$v['id'],GP('p-'.$page->now_page));?>')" >
												<i class="iconfont icon-lajitong"></i>
												<p class="class-name">删除</p>
											</a>
										</li>-->
		        					</ul>
		        			</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</li>
			
		</ul>
		
		</div>
	<div>
	</div>
	</div>
	<br />	
	<br />	
	<br />	
	<br />	
</div>
<div class="footer-page h60">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
			<label for="sAll">全选 </label>
        </div>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button>
        <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="1">批量删除</button>-->
    </div>
    <div class="col-sm-7 " style="margin-top:7px">
    
    </div>
</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
