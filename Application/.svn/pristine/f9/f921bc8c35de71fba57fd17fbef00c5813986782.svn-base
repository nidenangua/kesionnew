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
<style type="text/css">
	.active{
		color: red;
	}

/*链接开关*/
.closebtn{position:relative;display: block;margin:0 auto;width:40px;height: 20px;background: #d2d2d2;border-radius: 30px; cursor: pointer;transition: .3s; -webkit-transition: .3s; -moz-transition: .3s; -o-transition: .3s; }
.closebtn i{position: absolute;left:2px;top:2px;width:16px;height: 16px; background: #fff;border-radius: 50%;transition: .3s; -webkit-transition: .3s; -moz-transition: .3s; -o-transition: .3s;}
</style>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
		     <div class="ks-head-box">
		     		<h3 class="ks-head-title2">分销管理
	     				<div class="fr">
						<!--<a class="ks-setting-icon fl ml10" target="_blank"   onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting" ></i></a>-->
						<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor66"><i class="iconfont icon-qm" ></i></a>
					</div>
		     		</h3>
		     </div>
		 <!--/header-->
		 <!--tab-->
		 <div class="ks-head-tab">
 			<ul class="clearfix">
 				<li class="fl <?php if(ACTION=='index'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL('Distribution','index',''); ?>" class="alignCenter">分销管理</a>
   			    </li>
   			    <li class="fl <?php if(ACTION=='distributioner'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL('Distribution','distributioner',''); ?>" class="alignCenter">分销订单</a>
   			    </li>
 				</ul>
         </div>
		<!--/tab-->
		 <!--widget-->
					<div class="ks-head-widget clearfix">
						<div class="fl">
							<div class="ks-search-box">
								<select class="w150 inputText bRadius5 fl" id="keytype" onChange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Distribution','index'); ?>','courseType','<?php echo URL_MODEL;?>');">
									<option <?php if($courseType==0){ echo 'selected="selected"';} ?> value="0">全部</option>
									<option <?php if($courseType==1){ echo 'selected="selected"';} ?> value="1">点播</option>
									<option <?php if($courseType==2){ echo 'selected="selected"';} ?> value="2">直播</option>
                                    <option <?php if($courseType==3){ echo 'selected="selected"';} ?> value="3">音频</option>
									<option <?php if($courseType==4){ echo 'selected="selected"';} ?> value="4">图文</option>
									<option value="6" <?php if($courseType==6){ echo 'selected="selected"';} ?>>专栏</option>
                                    <option value="8" <?php if($courseType==8){ echo 'selected="selected"';} ?>>教辅周边</option>
								  	</select>
								<div class="ks-top-search fl">
									<form target="hidframe">
									<input type="text" class="sc-text sc-mini-pc" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					                <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Distribution','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
					               </form>
								</div>
								<!--搜索框组件-->
							</div>	
						</div>
						<div class="fr" >
							<div class="fr">
								<ul class="ks-head-choice">
									<li>
										<div class="ks-head-el">
											<button class="ks-heade-button ks-head-primary" type="button" onClick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
											<div class="ks-head-content ks-head-content-pr w400">
												<ul class="screen">		
													<li>													
														<span>状态：</span>
														<div>
														<a href="<?php echo M_URL('Distribution','index','',GP('status-3'));  ?>" <?php if($status==3){ echo 'class="active"';} ?>>不限</a>
														<a href="<?php echo M_URL('Distribution','index','',GP('status-2'));  ?>" <?php if($status==2){ echo 'class="active"';} ?>>分销中</a>
														<a href="<?php echo M_URL('Distribution','index','',GP('status-1'));  ?>" <?php if($status==1){ echo 'class="active"';} ?>>未分销</a>
														<!--<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-0'));  ?>">未审核</a>-->
														</div>
													</li>
												</ul>
											</div>
										</div>
									</li>
									
									<li>
										<div class="ks-head-el">
											<button class="ks-heade-button ks-head-primary" type="button" onMouseDown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,105,false,true);?>'})" onClick="addTypeChange('<?php echo M_URL('Distribution','addDistribution','');  ?>','780px','650px',{title:'添加分销',type:'top'});"><i class="icon-jiahao iconfont "></i>添加分销</button>
										</div>
									</li>
								</ul>
							</div>
						</div>
				</div>
					<!--/widget-->	
<!--end-->
<!--结束-->
<form target="hidframe"  action="<?php  echo M_URL('Distribution','','',GP('')) ?>" method="post" id="myform" >
			    <!--table-->
				<table class="ks-table" >
					<thead>
						<tr>
						<!--<th>选择</th>-->
						<th style="text-align:left">标题</th>
						<th>分类</th>
						<th>分销数量</th>
						<th style="width: 80px;">价格</th>
						<th style="width: 80px;">实际到账</th>
						<th style="width: 80px;">佣金比例</th>
						<th style="width: 80px;">佣金</th>
						<th>分销状态</th>
						 <th>操作</th> 
						</tr>
					</thead>
					<tbody>
						<?php foreach($values as $k=>$v){?> 
						    <tr>
							<!--<td style="width:30px"><input type="checkbox" class="select-checks " name="id[]" value="<?php echo $v['courseid'];?>"></td>-->
							<td style="text-align:left"><?php echo $v['title'] ?></td>
							<td><?php if($v['courseType']==1){echo '点播';}elseif($v['courseType']==2){echo '直播';}elseif($v['courseType']==3){echo '音频';}elseif($v['courseType']==4){echo '图文';}elseif($v['courseType']==6){echo '专栏';}elseif ($v['courseType']==8){echo '教辅周边';}?></td>
							<td><?php echo $v['fxcount'];?></td>
							<td><?php if($v['price']==0||$v['chargetype']!=1){echo '免费';}else{echo $v['price'];} ?></td>
							<td><?php if($v['chargetype']==1){echo floor(getPoundage($this->wxid,$v['price'])*100)/100;}else{echo '--';}?></td>
							<td><?php if($v['chargetype']==1){echo $v['commission'].'%';}else{echo '--';}?></td>
							<td><?php if($v['chargetype']==1){echo floor($v['commission']*0.01*getPoundage($this->wxid,$v['price'])*100)/100;}else{echo '--';}?></td>
							
							<td>
								<?php if($v['chargetype']==1){?>
								  <span class="link-switch<?php if($v["isdistribution"]==2){ echo ' open' ;}?>" data-off="<?php echo M_URL('Distribution','down',$v['courseid'],GP('p-'.$page->now_page.',type-'.$v['courseType']));?>" data-open="<?php echo M_URL('Distribution','up',$v['courseid'],GP('p-'.$page->now_page.',type-'.$v['courseType'])); ?>"><i></i></span>
								  <?php }else{ ?>
								  	<span class="closebtn" disabled><i></i></span>
								  <?php }?>
			    			</td>
							<td class="ks-head-el">
								<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
								<div class="ks-head-content ks-head-content-pc w100">
									<ul class="opeart">
										<li ><a onClick="addTypeChange('<?php echo M_URL('Distribution','editdistribution',$v['courseid'],GP('courseType-'.$v['courseType']));  ?>','600px','530px',{title:'修改分销商品',type:'top'});">修改</a></li>
										<!--<li ><a href="<?php echo $v['url']?>" target='_blank'>预览</a></li>-->
										<li ><a href="javascript:Confirm('是否删除此订单？该操作不可逆!','<?php echo M_URL('Distribution','changedis',$v['courseid'],GP('type-'.$v['courseType']));?>');">删除</a></li>
									</ul>
								</div>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
		   <?php echo NoC($values);?>
			<input type="hidden" name="batch" id="batch1" />
	 </form>
		
		<!--footer-->
		<?php if(!empty($values)){?>
			<div class="ks-bom clearfix">
				<div class="fl">
				    <!--<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll" >全选</label>-->
					<!--<button type="button"  class="ks-heade-button mr10"  onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i></button>-->
				</div>
				<div class="fr">
					<?php echo $page->show(3); ?>
				</div>
			</div>
		<!-- /footer-->
		  <?php }?>
	</div>
<!--//ks-wbox-->
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll','laydate'],function(){
		loadScorllJs();
		$('.link-switch').each(function(){setLinkSwitch(this)})
	})
</script>
</body>
</html>


<!-- var conf  = {};
					conf.basicinfo = {};
					conf.appId = appId;
					conf.timestamp =timestamp ;
					conf.nonceStr = nonceStr;
					conf.signature =signature;
					conf.basicinfo.sharetitle = _this.goodsinfo.title;
					conf.basicinfo.shareintr = _this.goodsinfo.shareintr ||'点击查看';
					conf.basicinfo.defaultpic = _this.goodsinfo.sharepic;
					conf.url = shareurl+'&sharetype=1';
					onshare(conf);
					_this.renderFlag = true; -->