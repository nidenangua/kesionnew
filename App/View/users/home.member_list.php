<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>学员管理</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">
	
	<!--new home-->
	<div class="ks-wbox bRadius10">
		<!--header-->
	     <div class="ks-head-box">
	     	<h3 class="ks-head-title2">学员管理(<?php echo $usernumb;?>)
	     	<div class="fr">
			
				<span class="fl name-nowrap">
				<font class="c-86A8F">微信学员初始密码为：123456</font><i class="iconfont icon-iconfontwenhao"><div class="ks-remind" style="min-width: 210px;"> 用账号和初始密码可以登录app学生端学习,浏览器学生端学习 </div></i>
				</span>			
				
	 			<a class="ks-setting-icon fl ml10"onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting"></i></a>	
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor62"><i class="iconfont icon-qm" ></i></a>											
			
											
			</div>	
			</h3>
     		
	     </div>
	     <!--header-->
	    
			
			<?php if(isset($setting[0])&&$setting[0]==1){?>		     
			  
					<!--widget-->
					<div class="ks-head-widget clearfix">
						
						
						<div class="ks-search-box fl">
							
							<form target="hidframe">
								<!--搜索框组件-->
								<?php if(ismoduleopen($this->wxid,5)){ ?>
								<select class="w150 inputText bRadius5 fl" id="groupid">
									<option value="0">用户分组</option>
									<?php foreach ($group_list as $k=>$v) {?>
									<option value="<?php echo $v['id'];?>" <?php if($groupid==$v['id']){echo 'selected="selected"';} ?>><?php echo $v['name'];?></option>
									<?php }?>
								</select>
								<?php }?>
								<select class="w150 inputText bRadius5 fl" id="keytype">
									<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>学员账号</option>
									<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>学员名字</option>
							  	</select>
								<div class="ks-top-search fl">
									<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					                <button type="submit" class="ks-head-search" onClick="searchByClass1('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
								</div>
								<script>
									function searchByClass1(param,url,url_model){
										var newurl = '';
										var keyword=$("#keyword").val();
										var groupid=$("#groupid").val();
										var keytype=$("#keytype").val();
										var newparam=getParams(param,keyword,'keyword');
										var newparam=getParams(newparam,keytype,'keytype');
										var newparam=getParams(newparam,groupid,'groupid');
										if(url_model=='1')
										{newurl=url+'?'+newparam;}else{newurl=url+'&arr='+newparam;}
										location.href=newurl;
										return;
									}
								</script>
								<!--搜索框组件-->
							</form>
						</div>					
					
							
						
						<div class="fr">
							<ul class="ks-head-choice">
								
								<li>
										<div class="ks-head-el">
										<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
					<div class="ks-head-content ks-head-content-pr" style="width: 360px;">																
<ul class="screen">				
	<li>
		<span>审核状态：</span>
		<div>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-3")); ?>" <?php if($status == 3){ echo 'class="choice-active"';}?>>不限</a>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-1")); ?>" <?php if($status == 1){ echo 'class="choice-active"';}?>>已审核</a>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-0")); ?>" <?php if($status == 0){ echo 'class="choice-active"';}?>>未审核</a>
		</div>
	</li>
	<li>
		<span>付费状态：</span>
		<div>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("enrollstatus-3")); ?>" <?php if($enrollstatus == 3){ echo 'class="choice-active"';}?>>不限</a>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("enrollstatus-1")); ?>" <?php if($enrollstatus == 1){ echo 'class="choice-active"';}?>>已付费</a>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("enrollstatus-0")); ?>" <?php if($enrollstatus == 0){ echo 'class="choice-active"';}?>>未付费</a>
		</div>
	</li>
	<li>
		<span>是否到期：</span>
		<div>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("is_period-3")); ?>" <?php if($is_period == 3){ echo 'class="choice-active"';}?>>不限</a>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("is_period-1")); ?>" <?php if($is_period == 1){ echo 'class="choice-active"';}?>>未到期</a>
			<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("is_period-2")); ?>" <?php if($is_period == 2){ echo 'class="choice-active"';}?>>已到期</a>
		</div>
	</li>
</ul>
					</div>
													</div>
								</li>
							
								<li>
									<div class="ks-head-el">
										<a class="ks-heade-button ks-head-primary" type="button" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,3,false,true);?>'})"  href="<?php echo M_URL($this->AppName.'/Index','addUsers','',GP("appid-$this->appid,usertype-$usertype")); ?>"><i class="icon-jiahao iconfont "></i>添加学员</a>

									</div>
								</li>
								
								
								<li>
									<div class="ks-head-el">
								<button class="ks-heade-button ks-head-primary" type="button" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,3,false,true);?>'})"  onclick="addTypeChange('<?php echo M_URL('Index','Import','',GP('type-1'));  ?>','600px','350px',{title:'学员批量导入/导出',type:'top'});"><i class="icon-jiahao iconfont "></i>导入/导出</button>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!--/widget-->
				    <form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','bathdeluser','',GP("usertype-$usertype,p-$page->now_page"));  ?>" method="post" id="myform">	
     				<!--table-->
					<table class="ks-table">
							<tr>
									<thead>
										<tr>
											<td style="width: 30px;">选择</td>
											<td>账号</td>
											<td>是否过期</td>
											<td>姓名</td>
											<td>分组</td>
											<td>联系电话</td>
											<td>电子邮箱</td>
                                            <td>注册来源</td>
											<td class="shaixuan">
		
												<?php if($lastlogintime == 2){?>
												<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("lastlogintime-1")); ?>"><i class="desc-i"></i>最后登录时间</a>		
											<?php }else{ ?>
												<a class="asc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("lastlogintime-2")); ?>"><i class="asc-i"></i>最后登录时间</a>		
											<?php }?>
											</div>
											</td>
											
											<!--<td class="shaixuan">
												<?php if($money == 2){?>
												<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("money-1")); ?>"><i class="desc-i"></i>账号余额</a>		
												<?php }else{ ?>
													<a class="asc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("money-2")); ?>"><i class="asc-i"></i>账号余额</a>
												<?php }?>
												
											</td>-->
											<td class="shaixuan">
												<?php if($adddate == 2){?>
													<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("adddate-1")); ?>"><i class="desc-i"></i>注册时间</a>		
												<?php }else{ ?>
													<a class="asc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("adddate-2")); ?>"><i class="asc-i"></i>注册时间</a>		
												<?php }?>
							
											</td>
											<td>审核状态</td>
											
											<td>操作</td>
										</tr>    											
									</thead>
									<tbody>
											<?php foreach($UsersAll as $k=>$v){ ?> 
											<tr>
												
												<td><input type="checkbox" class="select-checks form-in" name="userid[]" value="<?php echo $v['userid'] ?>"></td>
												<td ><?php echo Field($v['username']); ?></td>
												<td ><?php echo $v['indate_text']; ?></td>
												<td><?php echo Field($v['name']); ?></td>
												<td><?php echo $v['group_name']; ?></td>
												<td>
													<?php echo Field($v['mobile']); ?>
								          		</td>
												<td><?php echo Field($v['email']); ?></td>
                                                <td><?php if($v['befrom']==1){echo '公众号';}elseif ($v['befrom']==2){echo '后台添加';}elseif ($v['befrom']==3){echo '小程序';}elseif ($v['befrom']==3){echo 'PC';}else{echo '公众号';} ?></td>
												<td><?php if($v['lastlogintime']){echo date('Y-m-d',$v['lastlogintime']);}else{echo Field($v['lastlogintime']);} ?></td>
												
												<!--<td><?php echo Field($v['money']); ?></td>-->
												<td><?php echo date('Y-m-d',$v['regdate']); ?></td>
												
								            	<td>
								            		<span class="link-switch<?php if($v['status'] ==1){ echo ' open'; } ?>" data-off="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['userid'],GP('')); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['userid'],GP('')); ?>"><i></i></span>

								            	</td>
								            
<td class="ks-head-el">
	 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
		<div class="ks-head-content ks-head-content-pc w100">
			<ul class="opeart">
				<li>
					<a href="<?php echo M_URL($this->AppName.'/Index','editUsers',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>">编辑</a>
				</li>		
				<!--<li>
					<a href="<?php echo M_URL($this->AppName.'/Index','enrolment',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>">报名</a>
				</li>
				<li>
					<a  onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','recharge',$v['userid'],GP('skip-0')); ?>','430px','610px ',{title:'学员充值'})">充值</a>
				</li>-->
				<li>
					<a href="<?php echo M_URL($this->AppName.'/Index','details',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>">详情</a>
				</li>
                <?php
                    $setting_vip   = $this->cache->GetH('apprelate','appid',21,'setting',$this->wxid);
                    if (empty($setting_vip)){
                        $is_vip = 0;
                    }else{
                        $setting_vip = explode('※',$setting_vip);
                        $is_vip = $setting_vip[0];
                    }
                    if ($is_vip==1){
                        ?><li>
                            <a href="javascript:;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showvip',$v['userid'],GP('userid-'.$v['userid']));?>','370px','370px',{title:'设置VIP',type:'top'});">设置VIP</a>
                        </li>
                        <?php
                    }

                ?>
				<li>
					<a href="javascript:Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','deluser',$v['userid'],GP("usertype-$usertype")); ?>')">删除</a>
				</li>
			</ul>
		</div>
</td>
											</tr>
										<?php }?>
									</tbody>
							</tr>
					</table>
                    <?php echo NoC($UsersAll);?>
     				<!--/table-->
     				
     				<?php if(!empty($UsersAll)){?>
     					<input type="hidden" name="batch" id="batch1" />
     				<!--footer-->
     					<div class="ks-bom clearfix">
								<span class="fl">
									<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
									<button type="button" class="ks-heade-button mr10" onclick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
					    
							        <button type="button" class="ks-heade-button mr10" onclick="submitform(2)" >批量审核</button>
							        <button type="button" class="ks-heade-button" onclick="submitform(3)" >取消审核</button>
									
								</span>
							<div class="fr"><?php echo $page->show(3); ?></div>
						</div>
					<?php }?>
     				<!--/footer-->
	 		  </form>
	   		
	   		<?php }else{?>
				<div class="unopened">
		 	您还没有启用学员管理功能！
		 	<a class="ks-bt bt-pue" href="javascript:void(0);" onclick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid;?>,wxid:<?php echo $this->wxid;?>})">立即开启</a>
		</div>	
				
			<?php }?>
	   		
	</div>
	  


<!--news -->



<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll','laydate'],function(){
		
		//time
		laydate.render({
		  elem: '#test6'
		  ,range: true
		});
		
		loadScorllJs();
		$('.link-switch').each(function(){
			setLinkSwitch(this)
		})

		
	});
	function updatesStatus(url,userid){
		  
		  request(url,function(data){
		  		data==0 ? $("#a"+userid).html('<span style="color: red;margin-right:0;cursor: pointer;">未审核</span>') : $("#a"+userid).html('<span style="color: green;margin-right:0;cursor: pointer;">已审核</span>')
		  })
		 
	};
	function submitform(type){
		inspectionCheckBox('userid[]',function(){
			$('#batch1').val(type);
			if(type===1){
				top.popup.confirm('确认要删除所选项吗？',{
					determine:function(){
						$('#myform').submit();
					}
				})
			}else{
				$('#myform').submit();
			}
		})
		
	}
</script>
</body>
</html>
