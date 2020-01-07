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

<div class="wrapper wrapper-content mt55 animated fadeIn"  >
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
              	<h3 class="fl mr20" >&nbsp;&nbsp;&nbsp;&nbsp;营销管理
				<a href="<?php echo M_URL('H5market\schemelist'); ?>" class="mr20" >营销方案</a> 
		        <a href="<?php echo M_URL('H5market'); ?>" class="mr20 act">营销工具</a> 
				</h3>
              	<div class="fr">
			        <div class="fl ks-top-search">
			   
					<!--搜索-->
					<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
					     <option value="1" <?php if($keytype==1) echo "selected"; ?>>工具名称</option>
			  	    </select>
					   
					<form target="hidframe" class="fr">
						<input type="text" style="width:150px" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
		            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('H5market','index'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
					</form>
					<!--搜索-->
					</div> 
			    </div>
             	<!--<div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                       <i class="reflash"></i>
                    </a>
              	</div>-->
			<a  href="<?php echo M_URL('H5market','H5add','',GP('option-3')); ?>" class="btn btn-tool btn-rounded btn-s-md "> 添加</a>
			<a  href="javascript:addTypeChange('<?php echo M_URL('Index','filelist','',GP('type-top,name-zip',true));?>','930px','610px',{title:'选择ZIP压缩包',type:'top'})" class="btn btn-tool btn-rounded btn-s-md "> 上传zip导入</a>
            </div>
        </div>
    </div>
    
    <div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
				<li style="margin-right: 15px;"><input type="checkbox" class="selectAll select-checks" id="selectAll"></li>
				<li>
					<div class="shaixuan clearfix">
						<?php if($byname == 'addtime asc'){?>
						<a class="desc" href="<?php echo M_URL('home/H5market','','',GP("byname-addtime desc")); ?>"><i class="desc-i"></i>最新上线</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('home/H5market','','',GP("byname-addtime asc")); ?>"><i class="asc-i"></i>最新上线</a>
								
					<?php }?>

					</div>
				</li>
				<li class="fr gameScreen">&nbsp;&nbsp;<i class="iconfont icon-filter-2 fn"></i>筛选

					<ul class="H5-gameScreen">
						<img src="<?php echo UOOT;?>Public/app/images/regup.png" alt="" />
						

						<li>
							<span>营销模式：</span>
							<div>
								<a href="<?php echo M_URL('home/H5market','','',GP("ismode-0")); ?>" class="<?php if($ismode ==0){ echo 'active';}?>">不限</a>
								<a href="<?php echo M_URL('home/H5market','','',GP("ismode-1")); ?>" class="<?php if($ismode ==1){ echo 'active';}?>">抽奖活动</a>
								<a href="<?php echo M_URL('home/H5market','','',GP("ismode-2")); ?>" class="<?php if($ismode ==2){ echo 'active';}?>">助力活动</a>	
								<a href="<?php echo M_URL('home/H5market','','',GP("ismode-3")); ?>" class="<?php if($ismode ==3){ echo 'active';}?>">排行活动</a>							
							</div>
						</li>

					</ul>

				</li>				
			</ul>	
		</div>
		
		<div class="H5-gameListConts">
			<ul class="H5-gameList">
			<?php foreach($values as $k =>$v){ ?>
			<li>
				<div class="H5-ListWrap school-online">
					<input type="checkbox"  class="select-checks">
					<div class="H5-ListContent clearfix">
						<div class="Left-Content col-6">
							<h4>
								<p><?php echo $v['h5name']; ?></p>
								<p><?php if($v['isuse']){ echo '启用';}else{ echo '关闭'; }?></p>
								<p><?php if($v['ismode'] == 1){ echo '抽奖活动';}elseif($v['ismode'] == 2){ echo '助力活动'; }elseif($v['ismode'] == 3){ echo '排行活动';}?></p>
								<!--<p>集体活动</p>-->
								<p><?php if($v['marketing'] == 0){ echo '免费';}elseif($v['marketing'] == 1){ echo '收费活动'; }elseif($v['marketing'] == 2){ echo '套餐活动';}?></p>
							</h4>
							
							<div class="H5-infoContent">
								<img src="<?php echo Img($v['ico'])?>" class="setImg" alt="">
								<div class="H5-infoMark">
									<h4>
										<p><a>使用人数  <?php echo $v['numberusers'] ;?></a></p>
										<p>创建时间  <?php echo date('Y-m-d H:i:s',$v['addtime']);?></p>
										<p>作者 <?php echo $v['author'];?></p>
									</h4>	
									<h4> 
										<p>网址：
											<?php if(!empty($v['h5id'])){?>
													<?php echo 'http://ks.kesion.com/h5market/inh5game?h5id='.$v['h5id'].'&wxid=2'; ?>
											<?php }else{
												echo '请用WXID为2的创建对应的活动';
											} ?>		
										</p>										
									</h4>	
									<div class="H5-infoMarks">
										
											<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://ks.kesion.com/h5market/inh5game?h5id='.$v['h5id'].'&wxid=2','L',4,'qrcode');?>?>" alt="">
										<div class="showcode">
											<img class="dom" src="<?php echo UOOT;?>Public/app/images/regdom.png" alt="" />
											<?php if(!empty($v['h5id'])){?>
												<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://ks.kesion.com/h5market/inh5game?h5id='.$v['h5id'].'&wxid=2','L',4,'qrcode');?>" alt="">
											<?php }else{
												echo '请用WXID为2的创建对应的活动';
											} ?>
										</div>	
									</div>												
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
									<li>使用次数:<em><?php echo $v['numberwx']; ?></em></li>
									
								</ul>
								
							</div>
							
							<div class="ks-operaRight">
		        					<ul class="clearfix">
		        						<li>
		        						<a href="javascript:void(0);" onclick="Confirm('是否删除此活动？该操作不可逆！','<?php echo M_URL('home/H5market','delect',$v['id'],GP('p-'.$page->now_page));?>')">
												<i class="iconfont icon-lajitong"></i>
												<p class="class-name">删除</p>
											</a>
										
										</li>
		        						<li>
		        							 <?php if(!empty($v["zipurl"])){?>
                                    <a title="导出zip" href="http://store.kesion.com/<?php echo $v["zipurl"]; ?>">
										<i class="iconfont icon-shouhuoziliao"></i>
										<p class="class-name">导出ZIP</p>
									</a>
                                    <?php }else{?>
                                    <a title="打包H5" href="<?php echo M_URL('H5market','H5zip',$v["id"],GP('')); ?>">
												<i class="iconfont icon-shouhuoziliao"></i>
												<p class="class-name">打包H5</p>
											</a>
                                    <?php } ?>
		        							
		        							
		        							
											
										
										</li>
		        						<li>
											<a title="打包H5" href="<?php echo M_URL('H5market','H5zdyAdd',$v["id"],GP('')); ?>">
												<i class="iconfont icon-yulan"></i>
												<p class="class-name">自定义</p>
											</a>
										</li>
		        						<li>
										<a type="button" href="<?php echo M_URL('H5market','H5edit',$v["id"],GP('option-2')); ?>">
												<i class="iconfont icon-bianji"></i>
												<p class="class-name">编辑</p>
											</a>
										
										</li>
										
									
		        						
										<!---->
										
										
										
										
										
										
		        					</ul>
		        					
		        				</div>
							
							<!--<div class="local-warp admin-wrap">								
								<span><p>
									使用次数：<em><?php echo $v['numberwx'] ;?></em>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<i class="ok-icon iconfont ok-pe1 "></i>已审核
									</p>
								</span>
								
								<div class="H5-btnGroup">								
									<a class="btn btn-primary " type="button" href="<?php echo M_URL('H5market','H5edit',$v["id"],GP('option-2')); ?>">编辑</a>									
									<a title="打包H5" href="<?php echo M_URL('H5market','H5zdyAdd',$v["id"],GP('')); ?>" class="btn btn-primary ">
                                    	自定义
                                    </a>
									 <?php if(!empty($v["zipurl"])){?>
                                    <a title="导出zip" href="http://store.kesion.com/<?php echo $v["zipurl"]; ?>" class="btn btn-primary ">
                                    	导出ZIP
                                    </a>
                                    <?php }else{?>
                                    <a title="打包H5" href="<?php echo M_URL('H5market','H5zip',$v["id"],GP('')); ?>" class="btn btn-primary ">
                                    	打包H5
                                    </a>	
                                    <?php } ?>
									
									<a class="btn bt-gray" href="javascript:void(0);" onclick="Confirm('是否删除此活动？该操作不可逆！','<?php echo M_URL('home/H5market','delect',$v['id'],GP('p-'.$page->now_page));?>')">
	                                	删除
	                               </a>								
								</div>
								
							</div>-->
							
						</div>
						
						
						
						
						
						
						
						
						
						
					</div>
					
				</div>
				
			</li> 
		<?php }?>
			<?php echo NoC($values);?> 

			
		</ul>
		
		<br />
		<br />
		</div>
		<!--底部分页S-->
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
		<!--底部分页E-->
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
