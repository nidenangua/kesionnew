<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>学习卡管理</title>
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />	
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
	<!--开始-->
	 
		<div id="ksBoxHead">
		<!--结束-->
			<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			
	
			
			<!--标题-->
			<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>我的应用</a><span>/</span>学习卡管理 </p>
			<!--标题-->
			
			</div>
			
			<!--按钮组件-->
			<div class="Tool-btnGroup">
				 <a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','addStudycard','',GP("")); ?>"><i class="iconfont icon-jiahao"></i>增加学习卡</a>
				
			</div>
				
			<!--按钮组件-->
			<!--操作范围-->


			
		
			<div class="clearfix ks-top-tab">
			
				<div class="fr ks-top-search">
					<!--搜索-->
					
				        <select class="w150 inputText fl" id="keytype">
				            <option value="1" <?php if($keytype==1)echo 'selected';?>>学习卡名称</option>
				            <option value="3" <?php if($keytype==3)echo 'selected';?>>面值</option>
				       </select>
		       		
				    <input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword; ?>">
				    <input type="button" class="sc-button" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">
		
					<!--搜索-->
				</div>
			</div>	
	
			
			<!--操作范围-->
		
		</div>
		<div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
			
			
				<li class="fr gameScreen" style="float: right;"><i class="iconfont icon-filter-2 fn"></i>&nbsp;&nbsp;筛选

					<ul class="H5-gameScreen">
						<img src="//ks.zuojy.com/Public/app/images/regup.png" alt="">
						<li>
							<span>新闻状态：</span>
							<div>
								<ul>
				      	<li class="fl  <?php if($stat==3) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("stat-3,appid-$this->appid",true)); ?>">营销卡</a></li>
				        <li class="fl  <?php if($stat==1) echo " curr" ;?>"><a href="<?php echo  M_URL($this->AppName.'/Index','index','',GP("stat-1,appid-$this->appid",true)); ?>">线下营销卡</a></li>
				        <li class="fl  <?php if($stat==0) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("stat-0,appid-$this->appid",true)); ?>">线上营销卡</a></li>
				    </ul>
							</div>
						</li>	
						
					</ul>
				</li>	
				<li style="float: right;"> <span class="ks-bt bt-def" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})" style="margin-top:8px;border: 0;"><i class="iconfont icon-setting"></i>学习卡配置</span></li>			
			</ul>	
		</div>
	
  		 </div>
  		
  		<!--结束-->
   		<div class="bRadius10 bg-white">
  		  <div id="ksBoxContent">
			<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelStudycard','',GP("p-$page->now_page"));?>" method="post" id="myform">
				<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo ks-table" style="border-bottom:0;">
					<thead>
				<tr>
					<th><input name="allChecked" type="checkbox" value="allChecked" id="selectAll"></th>
					<th>学习卡名称</th>
					<th>面值</th>
					<th>发放方式</th>
					<th>可使用截止时间</th>
					<th>有效天数</th>
					<th>操作</th>
				</tr>
				</thead>
					<tbody>
					<?php foreach($values as $k=>$v){ ?>
						<tr>
							<td width="20">
								<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>">
							</td>
							<td width="40%" class="ta-left">
								<div class="td-img-info">
									<div class="images"><img src="<?php echo $v['pic']?>" class="m-img"></div>
									<div class="name"><?php echo $v['cardname']?></div>
									<div class="info"><?php echo $v['intro']?></div>
									<div class="btn-box">
										<a class="ks-bt bt-def mr10" href="<?php echo M_URL($this->AppName.'/Index','viewStudycardNum',$v['id'],GP("appid-$this->appid",true)); ?>">查看</a>
										<a class="ks-bt bt-def mr10" href="<?php echo M_URL($this->AppName.'/Index','createExcel',$v['id'],GP("appid-$this->appid",true)); ?>">生成excel</a>
										<a class="ks-bt bt-def" href="<?php echo M_URL($this->AppName.'/Index','createCardsNum',$v['id'],GP("appid-$this->appid",true));?>">生成营销卡</a>
									</div>
								</div>
							</td>

							<td class="sub-color"><?php echo $v['facevalue']?>元</td>
							<td><?php if($v['putway'] == 0){echo "线下发放";}else{echo "线上发放";}?></td>
							<td><?php echo  date("Y-m-d",$v['deadline'])?></td>
							<td><?php echo $v['validity']?></td>
							<td>
								<div class="operate">
									<a href="<?php echo M_URL($this->AppName.'/Index','editStudycard',$v['id'],GP("p-$page->now_page")); ?>"><em>编辑</em><i class="iconfont">&#xe63d;</i> </a>
									<a href="javascript:Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delStudycard',$v['id'],GP('p-'.$now_page)); ?>')"><em>删除</em><i class="iconfont">&#xe638;</i></a>
								</div>
							</td>
						</tr>
					<?php }?>
					</tbody>


			</table>
			<?php echo NoC($values);?>

			</form>
 
   		 </div>
    
		</div>
		<div id="ksBoxFooter" >
			<div class="ks-bom clearfix">
				<span class="fl">
					<button class="ks-bt bt-pue" onclick="submitform();"><i class="iconfont icon-lajitong"></i>批量删除</button>
				</span></form>
			<div class="fr"><?php echo $page->show(3); ?></div>	
			</div>
</div>

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	
    function submitform(){
		$('#myform').submit();
	}	
</script>
</body>
</html>
