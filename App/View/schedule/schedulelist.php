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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10  ">
	<div id="ksBoxHead">	
	<div class="Header-tool clearfix">
			<div class="Tool-Title">
			<!--图像-->
			<span class="Tool-icon">
				<i class="iconfont icon-jiaoshiguanli"></i>
			</span>
			<!--图像-->
			<!--标题-->
			<p>老师管理</p>
			<!--标题-->
			</div>
			<!--操作范围-->
			<!--按钮组件-->
			<div class="Tool-btnGroup">
				<a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','addUsers','',GP("appid-$this->appid,usertype-$usertype")); ?>'"><i class="iconfont icon-jiahao"></i>增加教师</button></a>
			</div>
			<!--按钮组件-->
			<!--搜索框组件-->
		 <div class="clearfix ks-top-tab" >
		    		<!--
					<div class="fl">
						<select class="w150 inputText bRadius5" onchange="location.href=this.value">
							<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3,appid-$this->appid",true)); ?>"<?php if($status==3) echo " selected" ;?>>所有用户</option>
							<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>"<?php if($status==1) echo " selected" ;?>>正常</option>
							<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>"<?php if($status==0) echo " selected" ;?>>待审</option>
						</select>
						<!--栏目块
				    </div>
				 -->   
			<div class="fr ks-top-search">
				<!--搜索--> 
			<label class="mr0">
			   	<select class="w150 inputText bRadius5" id="keytype">
			 		<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户账号</option>
			 		<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>教师名称</option>
			   	</select>
			</label>
			<form target="hidframe"  class="fr">
				<div class="fr ks-top-search">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					<input type="submit" class="sc-button" name="searchBtn" value="搜索"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">
				</div>
			</form>
				<!--搜索-->
			</div>
		</div>	
		  </div>
		
    </div>
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathdeluser','',GP("usertype-$usertype,p-$page->now_page"));  ?>" method="post" id="myform">

    <div id="ksBoxContent">
    		<div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
				<li style="margin-left: 0;"><input type="checkbox"  class="select-checks selectAll" style="position: relative;top: 4px;">全选</li>
				<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
				<li>
					<div class="shaixuan fl mr20 clearfix">
						<?php if($adddate == 2){?>
							<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("adddate-1")); ?>"><i class="desc-i"></i>注册时间降序</a>		
						<?php }else{ ?>
							<a class="asc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("adddate-2")); ?>"><i class="asc-i"></i>注册时间升序</a>		
						<?php }?>
					</div> 
					<div class="shaixuan fl mr20 clearfix">
						<?php if($lastlogintime == 2){?>
							<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("lastlogintime-1")); ?>"><i class="desc-i"></i>最后登录降序</a>		
						<?php }else{ ?>
							<a class="asc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("lastlogintime-2")); ?>"><i class="asc-i"></i>最后登录升序</a>		
						<?php }?>
					</div>
					<div class="shaixuan fl mr20 clearfix">
						<?php if($logintimes == 2){?>
							<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("logintimes-1")); ?>"><i class="desc-i"></i>登录次数降序</a>		
						<?php }else{ ?>
							<a class="asc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("logintimes-2")); ?>"><i class="asc-i"></i>登录次数升序</a>		
						<?php }?>
					</div> 
				</li>
			
				<li class="fr gameScreen" style="float: right;"><i class="iconfont icon-filter-2 fn"></i>&nbsp;&nbsp;筛选

					<ul class="H5-gameScreen">
						<img src="<?php echo UOOT;?>Public/app/images/regup.png" alt="">
						<li>
							<span>审核状态：</span>
							<div>
								<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-3")); ?>" class="<?php if($status == 3){ echo 'choice-active';}?>">不限</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-1")); ?>" class="<?php if($status == 1){ echo 'choice-active';}?>">已审核</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-0")); ?>" class="<?php if($status == 0){ echo 'choice-active';}?>">未审核</a>
							</div>
						</li>
						<li>
							<span>管理团队：</span>
							<div>
								<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("powertype-3")); ?>" class="<?php if($powertype == 3){ echo 'choice-active';}?>">不限</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("powertype-1")); ?>" class="<?php if($powertype == 1){ echo 'choice-active';}?>">是</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("powertype-0")); ?>" class="<?php if($powertype == 0){ echo 'choice-active';}?>">否</a>
							</div>
						</li>
							


					</ul>

				</li>	
				
					<li ><a class="ks-bt bt-def" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})" style="margin-top:8px ;border:0;"><i class="iconfont icon-setting" ></i>教师配置</a></li>			
			
			</ul>	
		</div>
    	
	
		<!--结束-->
		<!--<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
            <thead>
            <tr>
            	<th class="form-in"><input type="checkbox"   id="selectAll"></th>
                <th class="w200 pl20">教师账号</th>
                <th style="text-align: left;">教师名称</th>
                <th>联系电话</th>
                <th>电子邮箱</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14 w93">操作</th>
            </tr>
            </thead>
            <tbody>-->
            	<div class="ks-clist">
            	<?php if(isset($setting[0])&&$setting[0]==1){?>	
            		<ul class="clearfix">
              <?php foreach($UsersAll as $k=>$v){ ?> 
     <!--       <tr>
            	<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
            		<input type="checkbox" class="select-check form-in" name="userid[]" value="<?php echo $v['userid'] ?>"></td>
                <td class="w200 pl20"><?php echo $v['username']?></td>
                <td style="text-align: left;position: relative;padding-left: 70px;line-height: 50px;"><img src="<?php echo $v['defaultpic'];?>" style="width:50px;height: 50px;border-radius: 50%;position: absolute;left: 0;"><?php echo Field($v['name']);?></td>
                <td><?php echo Field($v['mobile']);?></td>
                <td><?php echo Field($v['email']);?></td>
                <td>
                	<div class="operate">
                		<a href="<?php echo M_URL($this->AppName.'/Index','editUsers',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>"><em>编辑</em><i class="iconfont icon-bianji4"></i></a>
                <a href="javascript:void(0);"  onclick="Confirm('是否删除此教师？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','deluser',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>')"><em>删除</em><i class="iconfont icon-shanchu1"></i> </a>
                	</div>
                
                </td>
            </tr>-->
            
            
     

<li>
    <div class="ks-input"><input type="checkbox" class="select-checks form-in" name="userid[]" value="<?php echo $v['userid'] ?>"></div>	
	<div class="ks-cbox clearfix">
		<div class="ks-cimg fl clearfix">
	   <img src="<?php echo $v['defaultpic'];?>">
	</div>
		<div class="fl ks-txtLeft">
			<p>姓名：<?php echo Field($v['name']); ?><?php if($v['powertype']==1){?><i class="icon-shimingrenzheng iconfont c-red ml10"></i><?php }elseif($v['powertype']==2){?><i class="icon-shimingrenzheng iconfont c-green ml10"></i><?php }?></p>
			<p>联系电话：<?php echo Field($v['mobile']); ?></p>
			<p>电子邮箱：<?php echo Field($v['email']); ?></p>
		</div>
		<div class="ks-ctxt fl">
			<p>教师等级：<span class="ks-level"><?php echo Field($v['teacherzc']); ?></span></p>
			<p>教学经验:<?php echo Field($v['shortIntro']); ?></p>
			<p class="small-txt">最后登录：<?php echo date('Y-m-d',$v['lastlogintime']); ?></p>
		</div>
		<div class="ks-ctxt fl">
			<p>账号：<span class="choice-active"><?php echo Field($v['username']); ?></span></p>
			<p>登录次数：<?php echo Field($v['logintimes']); ?></p>
			<p class="small-txt">注册时间：<?php echo date('Y-m-d',$v['regdate']); ?></p>
		</div>
		<div class="ks-operaRight fr">
			<div class="ks-state" style="cursor: pointer;" onClick="updatesStatus('<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['userid'],GP('')); ?>',<?php echo $v['userid']?>)" id="a<?php echo $v['userid']?>"><?php if($v['status'] == 0){?><span style="color: red;margin-right:0;">未审核</span><?php }else{?><span style="color: green;margin-right:0;">已审核</span><?php }?></div>
			<ul class="clearfix">
				<li>
					<a href="<?php echo M_URL($this->AppName.'/Index','enrolment',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>">
						<i class="iconfont icon-baoming"></i>
						<p class="class-name">排班</p>
					</a>
				
				</li>
				<li >
					<a href="<?php echo M_URL($this->AppName.'/Index','periodAccount','',GP('')) ?>">
						<i class="iconfont  icon-jiesuanzhongxin"></i>
						<p class="class-name">编辑</p>
					</a>
				</li>
				<li >
					<a href="<?php echo M_URL($this->AppName.'/Index','editUsers',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>">
						<i class="iconfont icon-bianji1"></i>
						<p class="class-name">编辑</p>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);"  onclick="Confirm('是否删除此教师？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','deluser',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>')">
						<i class="iconfont icon-lajitong1"></i>
						<p class="class-name">删除</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</li>
            
            	   <?php }?>
      <!--      </tbody>
        </table>-->
        
        		</ul>
        	<?php echo NoC($UsersAll);?>	
        	<?php }else{?>
        	<!--数据无的情况-->
			<div class="bg-white bRadius10" style="height: 100%;">
			<div class="empty">
			 	<a>您还没有启用老师管理功能</a><a class="c-86A8F ml30" href="javascript:void(0);" onclick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid;?>,wxid:<?php echo $this->wxid;?>})">开启</a>
			</div>	
			</div>		
        	<?php }?>		
        </div>	
    </div>
</div>
<?php if(isset($setting[0])&&$setting[0]==1){?>
<div id="ksBoxFooter">
<div class="ks-bom clearfix">
	<div class="fl">
		<label class="mr20 fl" style="margin-left: 8px;"><input type="checkbox"  class="select-checks selectAll" >全选</label>
		<button class="ks-bt bt-pue mr10" type="submit" name="batch" value="1">批量删除</button>
		<button class="ks-bt bt-pue mr10" type="submit" name="batch" value="2">批量审核</button>
		<button class="ks-bt bt-pue" type="submit" name="batch" value="3">批量取消审核</button>
	</div>
	<div class="fr">
		<?php echo $page->show(3); ?>	
	</div>
	
</div>
</div>
<?php }?>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

</body>
</html>
