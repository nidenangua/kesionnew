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
        	教师管理
        	 <ul  id="tablist" >
				<!--<li class="curr">
					<a   href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" target="main">教室管理</a>
				</li>	
				<li >
					<a   href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP('')); ?>" target="main">校区管理</a>
				</li>	-->
			<!--	<li>
					<a href="https://store.kesion.com/admin.php/home/App">返回</a>
				</li>	-->
			
		</ul>
        </h3>
        
       
        <div class="fr">
         	<div class="fl ks-top-search">
                <select  class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" id="keytype" >
					<option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>教师账号</option>
					<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>所属网校</option>
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
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("byname-asc")); ?>"><i class="desc-i"></i>注册日期</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("byname-desc")); ?>"><i class="asc-i"></i>注册日期</a>
								<?php }?>
							</div>
						</li>
						<li></li>
						<li class="fr gameScreen" style="margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="<?php echo UOOT;?>Public/app/images/regup.png" alt="">
								<li>
									<span>账号状态：</span>
									<div>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-3'));?>" class='<?php if($status==3) echo " active" ;?>'>不限</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-1'));?>" class='<?php if($status==1) echo " active" ;?>'>通过</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-2'));?>" class='<?php if($status==2) echo " active" ;?>'>未通过</a>
									</div>
								</li>
							</ul>

						</li>
					</ul>
				</div>


				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL($this->AppName.'/Index','someDel','',GP('p-'.$page->now_page)); ?>"  method="post">
						<div class="Created-push" id="ksBoxContent" style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th class="form-in">
											<input type="checkbox" id="selectAll">
										</th>
										
										<th>教师id</th>
										<th>教师账号</th>
										<th>所属网校</th>
										<th>联系电话</th>
										<th>注册日期</th>
										<th>账号类型</th>
										<th>是否通过审核</th>
										<!--<th>编辑</th>-->
										<th>查看</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($infoary as $k=>$v){ ?>
									<tr>
										<td class="form-in">
											<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['userid'] ?>">
										</td>
										<td>
											<?php echo Field($v['userid']);?>
										</td>
										<td>
											<?php echo Field($v['username']);?>
										</td>
										<td>
											<?php echo Field($v['sitename']);?>
										</td>
										<td>
											<?php echo Field($v['mobile']) ?>
										</td>
										<td>
											<?php echo date('Y-m-d H:i:s',$v['regdate']);?>
										</td>
										<td>
											<?php if($v['powertype']==0){echo '不是管理员';}elseif($v['powertype']==1){echo '管理员权限';}elseif($v['powertype']==2){echo '普通管理员权限';}  ;?>
										</td>
										<td>
											<span onclick="Confirm('是否决定<?php if($v["status"] == 1){echo "停用";}else{echo "通过";} ?>','<?php echo M_URL($this->AppName.'/Index','changeStatus','',GP('p-'.$page->now_page.',userid-'.$v['userid'].',status-'.$v['status'])); ?>')"><?php if($v['status'] == 1){echo "<span style='color:green'>已通过</span>";}else{echo "<span style='color:red'>未通过</span>";} ?></span>
										</td>
										<!--<td><span onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showEdit','',GP('id-'.$v['id'].',p-'.$page->now_page)) ?>','930px','450px',{title:'查看详情',type:'top'});">
											<i class='edit2017'></i></span></td>-->
                                        <td><span onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showDetail','',GP('userid-'.$v['userid'].',p-'.$page->now_page)) ?>','930px','450px',{title:'查看详情',type:'top'});">
                                        	查看</span></td>
										<td>
											<div class="operate">
												<a href="javascript:void(0);" onclick="Confirm('是否删除','<?php echo M_URL($this->AppName.'/Index','delete',$v['userid'],GP('p-'.$page->now_page)); ?>')">
							                    <i class='delete2017'></i></a>
											</div>
										</td>
									</tr>
									<?php }?>
								</tbody>
							</table>
                         <?php echo NoC($infoary);?>

						</div>
					
							<div class=" footer-page clearfix">
								
								<div class="col-sm-5">
									<div class="checkbox fl checkbox-info" style="margin: 20px 10px 0 25px;">
							            <input class="selectAll select-checks" name="check1" type="checkbox">
							            <label for="checkboxAll">全选 </label>
      								 </div>
									<button class="btn mt10 btn-default" type="submit" name="batch" value="1">
										<i class="iconfont icon-shanchu1"></i>批量删除</button>
									<button class="btn mt10 btn-default" type="submit" name="batch" value="2">
										批量审核</button>
									<button class="btn mt10 btn-default" type="submit" name="batch" value="3">
										批量取消审核</button>
								</div>
								<div class="col-sm-7 " style="margin-top:7px"><?php echo $page->show(3); ?></div>
							</div>
						
					</form>
					<!--<form action="<?php echo M_URL('News','flowTime','',GP("p- ".$now_page));  ?>" method="post">
								<div class="fl mt15">
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="10" />10天前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="1" />1个月前</span>
							</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="3" />3个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="6" />6个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="12" />一年前</label>
							<button class="btn  btn-default" type="submit">
								执行删除</button>
						</div>
					</form>-->
				</div>
				<div>
				</div>
			</div>

		</div>

	</div>
</body>

</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>