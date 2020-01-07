<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>收款设置</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
	<div id="ksBoxHead" >
		<div class="Header-tool clearfix">
			<div class="Tool-Title">
				<!--标题-->
				<p><a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>网站设置</a><span>/</span><?php echo $this->app['appname'];?></p>
				<!--标题-->
			</div>		
		<!--操作范围-->
		<div class="fr mt10 ml10 ks-top-search">
			<!--搜索-->
			<span class="fl fsize14 mr10 hLh30">开启独立支付:
			<?php if(wx_version_itemvalue('41',$this->wxid)==0){?>	
		    (<a style="color: red;line-height: 30px;" href="<?php echo M_URL('Website','Packagelist'); ?>">先升级套餐</a>)
		    <?php }?>
		    </span>
		    <?php if(wx_version_itemvalue('41',$this->wxid)==1){?>	
            <span class="fl">
            	<div class="form-switch" open-value="1">
	<label for="isshow1"><input type="radio" value="0" onclick="Payswitch(0)" <?php  if(isset($setting[1])){if($setting[1]==0) echo "checked";}?> >不用展示</label>
	<label for="isshow0"><input type="radio" value="1" onclick="Payswitch(1)"  <?php  if(isset($setting[1])){if($setting[1]==1) echo "checked";}else{echo 'checked';}?> >前台展示</label>
				</div>
            </span> 
            <?php }?>
			<!--搜索-->
		</div>
		<!--按钮-->
		 <?php if(wx_version_itemvalue('41',$this->wxid)==1&&$setting[1]==1){?>
	    <div class="fr mt10 ml10">
		    <ul>
		        <li class="fl">
		       	  <a class="ks-bt bt-def" href="<?php echo M_URL($this->AppName.'/Index','setting','',GP('')); ?>"><i class="iconfont icon-jiahao"></i>支付配置</a>
		        </li>
		    </ul>
	    </div>
	    <?php }?>
		<!--按钮-->
		<div class="clearfix ks-top-tab fr">
			<div class="fl">
	      	  <select class="w150 inputText bRadius5 mr20" onchange="location.href=this.value">
				<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("type-3,appid-$this->appid",true)); ?>"<?php if($type==3) echo " selected" ;?>>所有记录</option>
				<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("type-1,appid-$this->appid",true)); ?>"<?php if($type==1) echo " selected" ;?>>收入记录</option>
				<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("type-0,appid-$this->appid",true)); ?>"<?php if($type==0) echo " selected" ;?>>支出记录</option>
			  </select>	
			</div>
			<div class="fr">
				<div class=" ks-top-search" style="min-width: 560px;">
					<label class="mr20">
					    <select class="w150 inputText bRadius5" id="keytype">
				             <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户ID</option>
				             <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户名</option>
				             <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>手机号</option>
				             <option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>操作IP</option>
					    </select>
					</label>
					<form target="hidframe"  class="fr">	
						<div class="ks-top-search"  target="hidframe"  action="<?php echo  M_URL($this->AppName.'/Index','batcSSSSSh','',GP('')); ?>" method="post" >
							<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
			                <input type="submit" class="sc-button" name="searchBtn" value="搜索"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')" >
						</div>
					</form>
				</div>
			</div>  
		</div>   
		<!--操作范围-->
	</div>
</div>	 
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','paybatch','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
   <div class="bg-white mt20 bRadius10"> 	
	<div id="ksBoxContent">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table " >
            <thead>
                <tr>
                	<th class="form-in" style="width: 30px;"><input type="checkbox" id="selectAll"></th>
                    <th>用户ID</th>
                    <th style="text-align: left;">用户信息</th>
                    <th>操作IP</th>
                    <th>收入（元）</th>
                    <th>支出（元）</th>
                    <th>摘要</th>
                    <th>支付方式</th>
                    <th>操作员</th>
                    <th>余额（元）</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
<?php foreach($values as $k=>$v){if($v['type'] ==0){$status = '未审核';}else{$status = '已审核';}?> 
            <tr>
            	<td class="form-in" style="width: 30px;"><input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>"></td>
                <td><?php echo Field($v['memberid']);?></td>
                <td style="text-align: left;">
                	<div class="ks-name" style="color: #333;"><?php echo Field($v['username']);?></div>
                	<div class="ks-moblie" style="color:#1279e3"><i class="iconfont icon-lianxifangshi"></i><?php echo Field($v['mobile']);?></div>
                	<div class="ks-mark" style="color: #999;"><?php echo Field($v['mark']);?></div>
                	<div class="ks-adddate" style="color: #666;"><?php echo Field(date('Y-m-d H:i:s',$v['adddate']));?></div>
                </td>
                <td><?php echo Field($v['memberip']);?></td>
                <td><?php if($v['type']==0){echo Field($v['cmoney']);}else{echo '--';}; ?></td>
                <td><?php if($v['type']==1){echo Field($v['cmoney']);}else{echo '--';}; ?></td>
                <td style="color: <?php if($v['type']==0){echo 'red';}else{echo 'green';}; ?>"><?php if($v['type']==0){echo '收入';}else{echo '支出';}; ?></td>
                <td><?php echo Field($v['paytype']);?></td>
                <td><?php if($v['type']==0){echo 'admin';}else{echo 'system';}; ?></td>
                <td><?php echo Field($v['balance']);?></td>
                <td>
		           <div class="operate">
			           <a href="javascript:void(0);" onclick="Confirm('是否删支付记录？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delPay',$v['id'],GP('p-'.$page->now_page)); ?>')">
<em>删除</em><i class="icon-shanchu1 iconfont"></i></a>
		           </div>
				</td>
            </tr>
<?php }?>
            </tbody>
        </table>
        <?php echo NoC($values);?>
	    </div>
</div>
</div>
<div id="ksBoxFooter" style="height: 80px;">
	<div class="ks-bom clearfix">
		<span class="fl">
			<button class="ks-bt bt-pue" type="submit" name="batch" value="1"><i class="iconfont icon-shanchu1"></i>批量删除</button>
		</span>
  		<span class="fr"><?php echo $page->show(3);?></sapn>
	</div>
</div>
</form>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();	
	});
	function Payswitch(paystyle){
		var url = "<?php echo M_URL($this->AppName.'/Index','Payswitch','',GP('p-'.$page->now_page)); ?>";
		$.ajax({
			type:"post",
			url:url,
			data:{'paystyle':paystyle},
			success:function(data){
			   if(data=='succeed'){
				   location.reload();		
			   }else if(data=='faild'){
			 	   Alert('开启失败');
			   }
			},
		    error:function(){
			    location.reload();
			}
		});
	}	
</script>
</body>
</html>