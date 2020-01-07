<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico">
	<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>


<body class="gray-bg">
	<div class="wrapper" style="margin-top:35px">
	
	<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	校区教室
        	 <ul  id="tablist" >
				<li class="curr">
					<a   href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" target="main">教室管理</a>
				</li>	
				<li >
					<a   href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP('')); ?>" target="main">校区管理</a>
				</li>	
			<!--	<li>
					<a href="https://store.kesion.com/admin.php/home/App">返回</a>
				</li>	-->
			
		</ul>
        </h3>
        
       
        <div class="fr">
         	<div class="fl ks-top-search">
                <select  class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" id="keytype" >
					<option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>教室名称</option>
					<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>校区名称</option>
					<option  value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>网校id</option>
				</select>
                <input type="hidden" value="1" id="keytype"  />
				<form target="hidframe" class="fr">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
	           		<input type="button" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
				</form>
			</div>
              
              
        </div>
    </div>
</div>

		<div id="ksBoxContent">
			<div style="padding: 20px 0px;">

				<div class="H5-gameListScreen">
					<ul class="H5-gameOpt clearfix">
						<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
						<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
						<li>
							<div class="shaixuan clearfix">
								<?php if($byname == 'desc'){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP("byname-asc")); ?>"><i class="desc-i" style="top: 14px;"></i>升序</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP("byname-desc")); ?>"><i class="asc-i" style="top: 14px;"></i>降序</a>
								<?php }?>
							</div>
						</li>
						<li></li>
						<!--<li class="fr gameScreen" style="margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="<?php echo UOOT;?>Public/app/images/regup.png" alt="">
								<li>
									<span>消息状态：</span>
									<div>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-3'));?>" class='<?php if($type==3) echo " active" ;?>'>不限</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-1'));?>" class='<?php if($type==1) echo " active" ;?>'>通过</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-2'));?>" class='<?php if($type==2) echo " active" ;?>'>未通过</a>
									</div>
								</li>
							</ul>

						</li>-->
					</ul>
				</div>


				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL($this->AppName.'/Index','schoolPart','',GP('p-'.$page->now_page)); ?>"  method="post">
						<div class="Created-push" id="ksBoxContent" style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th class="form-in">
											<input type="checkbox" id="selectAll">
										</th>
										<th>校区名称</th>
										<th>所属学校</th>
										<th>联系人</th>
										<th>联系电话</th>
										<th>地址</th>
										<!--<th>是否通过</th>-->
										<th>编辑</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($value as $k=>$v){ ?>
									<tr>
										<td class="form-in">
											<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['schoolid'] ?>">
										</td>
										<td>
											<?php echo Field($v['school']);?>
										</td>
										<td>
											<?php echo Field($v['sitename']);?>
										</td>
										<td>
											<?php echo Field($v['name']); ?>
										</td>
										<td>
											<?php echo Field($v['tel']);?>
										</td>
										<td>
											<?php echo Field($v['address']) ;?>
										</td>
										<!--<td>
											<?php if($v['status'] == 1){echo "<span style='color:green'>通过</span>";}else{echo "<span style='color:red'>未通过</span>";} ?>
										</td>-->
										<td><span onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','editSchool','',GP('id-'.$v['schoolid'].',p-'.$page->now_page)) ?>','800px','600px',{type:'top',title:'编辑校区'});">编辑</span></td>
										<td>
											<div class="operate">
												<a href="javascript:void(0);" onclick="Confirm('是否删除','<?php echo M_URL($this->AppName.'/Index','delSchool','',GP('p-'.$page->now_page.',schoolid-'.$v['schoolid'])); ?>')">
							删除</a>
											</div>
										</td>
									</tr>
									<?php }?>
								</tbody>
							</table>
                         <?php echo NoC($value);?>

						</div>
					
							<div class=" footer-page clearfix">
								<div class="col-sm-5">
									<button class="btn mt10 btn-default" type="submit" name="batch" value="1">
										<i class="iconfont icon-shanchu1"></i>批量删除</button>
								</div>
								<div class="col-sm-7 " style="margin-top:7px"><?php echo $page->show(3); ?></div>
							</div>
						
					</form>
				</div>
				<div>
				</div>
			</div>

		</div>

	</div>
</body>

</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>



