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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.ks-cf07b40 {color: #f07b40!important;}
.ks-cbox{margin-top: 0;}
.ks-state{margin-top: 0;}
.class-tab li{background: #fff;height: 36px;line-height: 36px;font-size: 14px;text-align: center;margin-right: 10px;border-radius: 5px;padding:0 10px ;float: left;}
.class-tab .curr{color:#fff;background:#86a8f1 ;}
.class-tab .active{color:#fff;background:#476dbe ;}
.class-tab li:hover{cursor: pointer; }
</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title">
     		<div class="ks-head-nav" style="height: 16px;">
			<!--标题-->
			<a href="<?php echo M_URL('Capital'); ?>">我的财富</a><span><em>/</em>余额明细</span>
			<!--标题-->
			</div>
		</h3>
	    </div>
	    <!--header-->
					     
	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','paybatch','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box" style="font-size: 14px;">
				<span>我的余额：<span class="ks-cf07b40"><?php echo number_format($wxmoney,2);?>元</span></span>
				<span class="ml20">已充值：<?php echo number_format(getRecharge($this->wxid),2);?>元</span>
				<span class="ml20">已支出：<?php echo number_format(getExpend($this->wxid),2);?>元</span>
			</div>					
		</div>
		<div class="ks-head-widget clearfix">
			<div class="fr">
			<ul  class="ks-head-choice">
				
				<li>
				
				
				
				
				<div class="ks-head-el">
													
					<div class="ks-head-input ks-head-el  ks-head-click w180" onclick="choiceClick(this)">
	
						<?php if($option == 1){ ?>
						本月
						<?php }else if($option == 2){ ?>
						上月
						<?php }else if($option == 3){ ?>
						本季度
						<?php }else if($option == 4){ ?>
						上季度
						
						<?php }?>
						
						<span class="ks-head-search"><i class="icon-taitouxiangxiajiantou iconfont"></i></span>
						</div>
						<div class="ks-head-content ks-head-content-pr w100">	
										
							<ul class="status">															
								    <li <?php if($option==1)echo 'class="active"';?> onclick="window.location='<?php echo M_URL('Capital','capitalbill','',GP("option-1",true)); ?>'">本月</li>
					       			 <li <?php if($option==2)echo 'class="active"';?> onclick="window.location='//<?php echo M_URL('Capital','capitalbill','',GP("option-2",true)); ?>'">上月</li>
					       			 <li <?php if($option==3)echo 'class="active"';?> onclick="window.location='<?php echo M_URL('Capital','capitalbill','',GP("option-3",true)); ?>'">本季度</li>
					       			 <li <?php if($option==4)echo 'class="active"';?> onclick="window.location='<?php echo M_URL('Capital','capitalbill','',GP("option-4",true)); ?>'">上季度</li>
		
						    </ul>
			
							</div>
													
				</div>
				</li>
				<li>
					<div class="ks-head-el">
						<button class="ks-heade-button ks-head-primary" type="button"  onclick="choiceClick(this)"><i class="icon-filter-2 iconfont"></i></button>
						<div class="ks-head-content ks-head-content-pr w300" >
							<ul class="screen">
						
								<li>
									<span>充值/支出：</span>
									<div>
									<a href="<?php echo M_URL('Capital','capitalbill','',GP('type-3')); ?>" <?php if($type==3)echo 'class="choice-active"';?>>不限</a>
									<a href="<?php echo M_URL('Capital','capitalbill','',GP('type-1')); ?>" <?php if($type==1)echo 'class="choice-active"';?>>支出</a>
									<a href="<?php echo M_URL('Capital','capitalbill','',GP('type-0')); ?>" <?php if($type==0)echo 'class="choice-active"';?>>充值</a>
									</div>
								</li>
						</ul>
							
						</div>
						
					</div>
			</li>	
			</ul>	
			</div>
		</div>
		
		<div class="bg-white bRadius10">
 		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
            <thead>
                <tr>
                    <th class="shaixuan">时间
                    	<?php if($adddate == 0){ ?>
						<a class="desc" href="<?php echo M_URL('Capital','capitalbill','',GP('adddate-1'))  ?>"><i class="desc-i"></i>时间降序</a>	
						<?php }else{ ?>
						<a class="asc" href="<?php echo M_URL('Capital','capitalbill','',GP('adddate-0'))  ?>"><i class="asc-i"></i>时间升序</a>	
						<?php } ?>
                    </th>   
                    <th>支出/充值</th>
                    <th>余额（元）</th>
                    <th>支付方式</th>
                    <th>操作员</th>        
                    <th style="text-align: left;">备注</th>              
                </tr>
            </thead>
            <tbody>
			<?php foreach($values as $k=>$v){if($v['type'] ==0){$status = '未审核';}else{$status = '已审核';}?> 
            <tr>             
                <td><?php echo Field(date('Y-m-d H:i:s',$v['adddate']));?></td>          
                <td style="color: <?php if($v['type']==0){echo 'red';}else{echo 'green';}; ?>"><?php if($v['type']==0){echo '充值';}else{echo '支出';}; ?><?php echo Field($v['cmoney']);?></td>
                <td><?php echo Field($v['balance']);?></td>
                <td><?php switch($v['linepaytype']){
                	case 0:echo '现金';break;
                	case 1:echo '支付宝';break;
                	case 2:echo '微信';break;
                }?></td>
                <td><?php if($v['type']==0){echo 'admin';}else{echo 'system';}; ?></td>
                <td style="text-align: left;"><?php echo Field($v['mark']);?></td>
            </tr>
		<?php }?>
            </tbody>
        </table>
        <?php echo NoC($values);?>
	</div>
		<!--/widget-->
	     
		<!--table-->
		
	    <!--/table-->
	            
		<!--footer-->
		<?php if(!empty($values)){?>
		<div class="ks-bom clearfix">
			<span class="fl" style="display: none;">
				<button class="ks-bt bt-pue" type="submit" name="batch" value="1"><i class="iconfont icon-shanchu1"></i>批量删除</button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		<?php }?>
		<!--/footer-->
	</form>
	
	</div>
	
	



	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			
		});
	
	
	</script>
</body>
</html>