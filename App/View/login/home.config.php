<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>第三方登录</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">
	
	<!--header-->
    <div class="ks-head-box">
     	
		<h3 class="ks-head-title2">网站设置
		
		<div class="fr">	
			<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor31"><i class="iconfont icon-qm" ></i></a>											
		</div>
		</h3>
    </div>
    <!--header-->
	<!--tab-->
 	<div class="ks-head-tab">
 			<ul class="clearfix">
 				<li><a href="<?php echo M_URL('config/Index','','',GP('appid-1'));?>">基本配置</a></li>
 				<li><a href="<?php echo M_URL('Website','websitedomain'); ?>">域名设置</a></li>
 				<li class="curr"><a href="<?php echo M_URL('login/Index','','',GP('appid-20'));?>">第三方登录</a></li>
 				<li><a href="<?php echo M_URL('Website','websiteContact'); ?>">联系方式</a></li>
 				<li><a href="<?php echo M_URL('config/Index','wxinfo','',GP('appid-1'));?>">店铺介绍</a></li>
 			</ul>
 	</div>
	 <!--/tab-->
		     
		  
	<!--widget-->
	<div class="ks-head-widget clearfix">
		

			<div class="fr"><a href="<?php echo M_URL($this->AppName.'/Index','setting','',GP('')); ?>" class=" ks-bt bt-pue" style="float: right;">查看登录明细</a></div>
			<div class="fl">
				<?php if(wx_version_itemvalue('42',$this->wxid)==1){?>
				<div class="clearfix">
					<span class="fl fsize14 mr10 c-666">开启独立登录:</span>	
					<span class="fl">
						<div class="form-switch" open-value="1">
							<label for="isshow1"><input type="radio" value="0" onclick="Payswitch(0)" <?php  if(isset($setting[1])){if($setting[1]==0) echo "checked";}?> >不用展示</label>
							<label for="isshow0"><input type="radio" value="1" onclick="Payswitch(1)"  <?php  if(isset($setting[1])){if($setting[1]==1) echo "checked";}else{echo 'checked';}?> >前台展示</label>
						</div>
					</span> 
				</div>
				<?php }?>
				
			
				<h3 class="ks-first mt30">套餐第三方登录设置</h3>
				<p class="fsize14 c-999 mt10">
					<span >QQ、微信账号通：<?php if(wx_version_itemvalue('29',$this->wxid)==1){?>是<?php }else{?>否<?php }?></span>
					<span>可开启独立登录：<?php if(wx_version_itemvalue('42',$this->wxid)==1){?>是<?php }else{?>否<a href="<?php echo M_URL('Website','Packagelist'); ?>" class="c-86A8F ml50">升级套餐</a><?php }?></span>
					
				</p>
			</div>

	</div>
	<!--/widget-->
     
	<!--table-->
	<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP(''));  ?>" method="post">   
	<?php if(wx_version_itemvalue('41',$this->wxid)==1){?>	     
    <div class="configTab clearfix" style="display: block">
      	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
        <thead>
            <tr>
                <th class="alignCenter hLh40 pt0 pb0 fsize14">ID</th>
              	<th style="width: 120px;position: relative;"> 
              		<input type="checkbox" id="selectAll" class="select-checks selectAll "><span style="position: absolute;right: -10px;top:10px;">是否启用</span>
              	</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14">接口名称</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14">ApiID</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14">ApiKey</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14">申请</th>
            </tr>
        </thead>
        <tbody>
		<?php foreach($loginconf as $k=>$v){?> 
        <tr class="form-row ">
            <td class="alignCenter hLh40  fsize14 c-92"><?php echo $v['loginname']?></td>
            <input type="hidden" value="<?php echo $v['id'];?>" name="id[]">
            </td>
            <td class="alignCenter hLh40  fsize14 c-92">
            <div class="checkbox checkbox-info">
                 <input id="checkbox<?php echo $v['id'];?>" type="checkbox" name='status[]' <?php if($v["status"]==1){echo " checked ";} ?> value="<?php echo $v['id'];?>" class="select-check" >
                 <label for="checkbox<?php echo $v['id'];?>"></label>
            </div>
            </td>
            <td class="alignCenter hLh40  fsize14 c-92 "><input type="text" class="form-textbox" name="login[]" value="<?php echo $v['login'];?>" style="width:220px"></td>
            <td class="alignCenter hLh40  fsize14 c-92"><input type="text" class="form-textbox" name="apiID[]" value="<?php echo $v['apiID'];?>" style="width:220px"></td>
            <td class="alignCenter hLh40  fsize14 c-92"><input type="text" class="form-textbox" name="apiKey[]" value="<?php echo $v['apiKey'];?>" style="width:290px"></td>
            <td class="alignCenter hLh40  fsize14 c-92"><a class="apply2017" href="<?php echo $v['applyurl']?>" target="_blank">申请</a></td>
        </tr>
        <?php }?> 
        </tbody>
      </table>
    </div>
     <div style="text-align: center; padding-top: 50px;">
         		<button type="button" class="ks-bt bt-pue bt-medium" onclick="do_reg();" style="display: inline-block;float: none;">批量设置</button>
      </div>
    <?php }elseif(wx_version_itemvalue('41',$this->wxid)==1&&$setting[1]==0){?>	
    <!--数据无的情况-->
    <div class="warning">
     	您还没有启用独立登录
    </div>
    <?php }else{?>
    <!--数据无的情况-->
    <div class="unopened">
     	<a>当前套餐不支持独立支付</a><a class="ks-bt bt-pue" href="<?php echo M_URL('Website','Packagelist'); ?>">升级套餐</a>
    </div>
    <?php }?>
   	<div class="configTab clearfix">  </div>
	</form>
    <!--/table-->
            
	<!--footer-->
	<div class="ks-bom clearfix">
		<span class="fl">
					
		</span>
				
		<div class="fr">
					
		</div>
	</div>
	<!--/footer-->

</div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll','uploadView'],function(){
		loadScorllJs()
		$('.titleTab li').click(function(){
			$(this).addClass('curr').siblings().removeClass('curr');
			$('.configTab:eq('+$(this).index()+')').show().siblings().hide();	
		})
		$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});

	});

	function Payswitch(loginstyle){
		var url = "<?php echo M_URL($this->AppName.'/Index','Loginswitch','',GP('')); ?>";
		$.ajax({
			type:"post",
			url:url,
			data:{'loginstyle':loginstyle},
			success:function(data){
			   if(data=='succeed'){
				 
			   }else if(data=='faild'){
			 	   Alert('开启失败');
			   }
			}
		});
	}	
	function do_reg(){
		$("#myform").submit();	
	}
</script>
</body>
</html>
