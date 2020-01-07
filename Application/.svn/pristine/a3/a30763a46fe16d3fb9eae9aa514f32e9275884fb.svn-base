<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
</head>
<style>
	.H5-stat {display: none;}
	.Left-Content h4 p{
		cursor: default !important;
	}
	.Left-Content h4 p{height: 14px;line-height: 14px;border-right: 1px solid #8E8E8E;}
	.pagination-digg a{margin-left: 2px;}
	@media  (max-width:1336px ) {
		.col-6 {width: 65%;}
	}
	
</style>
<body class="gray-bg">

<div class="wrapper wrapper-content mt55 animated fadeIn"   style="margin-bottom: 85px;">
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
              	<h3 class="fl mr20" >&nbsp;&nbsp;&nbsp;&nbsp;营销管理
				<a href="<?php echo M_URL('H5market\schemelist'); ?>" class="mr20 act" >营销方案</a> 
				<a href="<?php echo M_URL('H5market'); ?>" class="mr20">营销工具</a> 
				</h3>
              	<div class="fr">
			        <div class="fl ks-top-search">
			   		<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;margin-right: 15px;" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('H5market','schemelist'); ?>','schemeid','<?php echo URL_MODEL;?>');">
					     <option value="0" selected="">方案类型</option>
					     <?php foreach($scheme as $k =>$v){ ?>
					     	 <option value="<?php echo $v['id']; ?>" <?php if($schemeid == $v['id']){ ?>selected="" <?php } ?>><?php echo $v['name']; ?></option>
					     <?php } ?>
			  	    </select>
			  	    
					<!--搜索-->
					<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
					     <option value="1" selected="">方案名称</option>
			  	    </select>
					<form target="hidframe" class="fr">
						<input type="text" style="width:150px" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
		            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('H5market','schemelist'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
					</form>
					<!--搜索-->
					</div> 
			    </div>
             	<!--<div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                       <i class="reflash"></i>
                    </a>
              	</div>-->
			<a  href="<?php echo M_URL('H5market','schemeadd','',GP('option-3')); ?>" class="btn btn-tool btn-rounded btn-s-md "> 添加</a>
			<!--<a  href="javascript:addTypeChange('<?php echo M_URL('Index','filelist','',GP('type-top,name-zip',true));?>','930px','610px',{title:'选择ZIP压缩包',type:'top'})" class="btn btn-tool btn-rounded btn-s-md "> 上传zip导入</a>-->
            </div>
        </div>
    </div>
    
    <div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
				<li style="margin-right: 15px;"><input type="checkbox" class="selectAll select-checks" id="selectAll"></li>
				<li>
					<div class="shaixuan clearfix">
						<?php if($byname == 'addtime asc'){?>
						<a class="desc" href="<?php echo M_URL('home/H5market','schemelist','',GP("byname-addtime desc")); ?>"><i class="desc-i"></i>最新上线</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('home/H5market','schemelist','',GP("byname-addtime asc")); ?>"><i class="asc-i"></i>最新上线</a>
								
					<?php }?>

					</div>
				</li>
				<li class="fr gameScreen">&nbsp;&nbsp;
					

				</li>				
			</ul>	
		</div>
		
		<div class="H5-gameListConts">
			<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('home/H5market','batchscheme','',GP('p-'.$page->now_page)) ?>" class="form-horizontal" enctype="multipart/form-data">
			<ul class="H5-gameList">
			<?php foreach($values as $k =>$v){ ?>
			<li>
				<div class="H5-ListWrap school-online">
					<input type="checkbox"  class="select-checks" name="id[]" value="<?php echo $v['id']; ?>">
					<div class="H5-ListContent clearfix">
						<div class="Left-Content col-6">
							<h4>
								<p><?php echo $v['name']; ?></p>
								<p><?php if($v['isuse']){ echo '启用';}else{ echo '关闭'; }?></p>
								<p><?php echo $v['modename']; ?></p>
								<p><?php if($v['marketing'] == 0){ echo '免费方案';}elseif($v['marketing'] == 1){ echo '收费活动'; }elseif($v['marketing'] == 2){ echo '套餐方案';}?></p>
							</h4>
							
							<div class="H5-infoContent">
								
								<div class="H5-infoMark">
									<h4>
										<p>创建时间  <?php echo date('Y-m-d H:i:s',$v['addtime']);?></p>
										<p>作者 <?php echo $v['author'];?></p>
									</h4>	
																		
								</div>		
							</div>
							
						</div>
						<style>
							.grayLing{
								margin-left: 0px !important;
							}
							.H5-stat ul{
								height: 40px;overflow: hidden;
								line-height: 40px;
								text-align: right;
								margin-bottom: 30px;
							}
							
							.H5-stat li{
								display: inline;
								margin-left: 20px;
								font-size: 14px;
								
							}
							.ks-operaRight li{float: right;}
							.H5-stat li em{font-style: normal;font-size:40px;color:#FF5507;font-weight: normal;}
	
							
						</style>
						<div class="Right-Content  clearfix">
							
							<div class="H5-stat">
								<ul>
									
									
								</ul>
								
							</div>
							
							<div class="ks-operaRight">
		        					<ul class="clearfix">
		        						<li>
		        						<a href="javascript:void(0);" onclick="Confirm('是否删除此方案？该操作不可逆！','<?php echo M_URL('home/H5market','delectscheme',$v['id'],GP('p-'.$page->now_page));?>')">
												<i class="iconfont icon-lajitong"></i>
												<p class="class-name">删除</p>
											</a>
										
										</li>
		        						<li>
										<a type="button" href="<?php echo M_URL('H5market','schemeedit',$v["id"],GP('option-2')); ?>">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">编辑</p>
											</a>
										
										</li>
		        					</ul>
		        					
		        				</div>
						</div>
					</div>
					
				</div>
				
			</li> 
		<?php }?>
			<?php echo NoC($values);?> 

			
		</ul>
		<!--底部分页S-->
		<div class="footer-page h60">
            <div class="col-sm-8">
             <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                    <input class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
                    <label for="sAll">全选 </label>
                </div>
                <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
                <button class="btn mt10 btn-default" type="submit" name="batch" value="0">批量设置成免费</button>
                <button class="btn mt10 btn-default" type="submit" name="batch" value="1">批量设置成<?php echo wx_version_itemvalue('','',3);?></button>
             	<button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量设置成<?php echo wx_version_itemvalue('','',4);?></button>
            </div>

            <div class="col-sm-4" style="margin-top:7px">
            	<?php echo $page->show(3); ?>
            </div>
		</div>
		</div> 
		<!--底部分页E-->
		</form>
</div>

</script>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	loadScorllJs();//滚轮
	var selectInputs = $('.check0');
	var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)
	buttonTap()//按钮样式切换
    function attributeSelect(url)
    {
        window.location.href=''+url;
    }

    function do_reg()
    {
	   $("#myform").submit();	
    }
   	function fn(a){   
		console.log(a);
		var a=2;
		function a(){}
		console.log(a);
	}
	fn(1);
</script>
</body>
</html>
