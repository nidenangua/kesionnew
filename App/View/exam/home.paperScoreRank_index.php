<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>kesion教育平台</title>
    <meta name="Keywords" content="kesion教育平台"/>
    <meta name="Description" content="kesion教育平台" />
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">
	


<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" >
  <div class="ks-wbox bRadius10">
  	<!--header-->
	     <div class="ks-head-box">
	     	<div class="fr">
	     		<a href="<?php echo M_URL('exam/Index','addScoreRank','',GP(''))?>" class="ks-heade-button ks-head-primary" type="button"><i class="icon-jiahao iconfont "></i>添加成绩等级</a>

	     	</div>
     		<div class="ks-head-nav">
				<!--标题-->
				<a href="<?php echo M_URL('exam/Index','','',GP(''))?>">试卷管理</a><span><em>/</em>成绩等级设置</span>
				<!--标题-->
			</div>
	     </div>
		 <!--/header-->
		 

	    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20">
	        <thead>
	        <tr>
	            <th>序号</th>
	            <th class="ta-left">成绩段项目名称</th>
	            <th>是否默认</th>
	            <th>操作</th>
	        </tr>
	        </thead>
	        <tbody>
	        <?php foreach($ScoreRank as $k=>$v){ ?>
	        <tr>
	            <td><?php echo $v['rankid']?>
	            </td>
	            <td width="40%" class="ta-left">
	              <?php echo $v['title']?>
	            </td>
	            <td><?php if($v['isDefault']==1){echo '显示';}else{echo '隐藏';}?></td>
	
	            
	            <td class="ks-head-el">
				 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
									
							<li><a href="<?php echo M_URL($this->AppName.'/Index','editScoreRank',$v['rankid'],GP('')); ?>">编辑</a></li>
							<li><a href="<?php echo M_URL($this->AppName.'/Index','delScoreRankRank',$v['rankid'],GP('')); ?>">删除</a></li>

						</ul>
					</div>
				</td>
	        </tr>
	        <?php }?>
	        </tbody>
	    </table>

	</div>
	



	


<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll'],function(){
loadScorllJs()

})
 </script>
	        
</body>
</html>
