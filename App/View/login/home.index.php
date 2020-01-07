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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<style type="text/css">
	.ks-clist li{padding-left: 40px;border-radius: 1px;}
</style>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
     	<h3 class="ks-head-title">
     		<div class="ks-head-nav" style="height: 16px;">
			<!--标题-->
			<a href="<?php echo M_URL('Website'); ?>">网站配置</a><span><em>/</em><a href="<?php echo M_URL('login/Index','','',GP('appid-20'));?>">登录设置</a><span> / </span>登录明细</span>
			<!--标题-->
			</div>
		</h3>
    </div>
    <!--header-->
	<div class="mt10 ks-top-search clearfix">
		<div class="fl">
			<label>
			    <select class="w150 inputText bRadius5" id="keytype">
		             <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户ID</option>
		             <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户名</option>
		             <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>手机号</option>
		             <option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>操作IP</option>
			    </select>
			</label>
			<div class="ks-top-search fl">
				<form target="hidframe">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
	                <button type="submit" class="ks-head-search"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
                </form>
			</div>
		</div>
		
		<ul class="H5-gameOpt clearfix">
			<li></li>
			<li class="fr gameScreen" style="float: right;margin: 0px;"><button class="ks-bt bt-pue fr"><i style="color: #FFF;" class="iconfont icon-filter-2 fn"></i></button>
			<ul class="H5-gameScreen">
				<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
				<li>
				<span>状态：</span>
				<div>
				<a href="<?php echo M_URL($this->AppName.'/Index','setting','',GP("type-3,appid-$this->appid",true)); ?>" <?php if($type==3) echo 'class="choice-active"';?>>所有记录</a>
				<a href="<?php echo M_URL($this->AppName.'/Index','setting','',GP("type-1,appid-$this->appid",true)); ?>"
				<?php if($type==1) echo 'class="choice-active"';?>>登录记录</a>
				<a href="<?php echo M_URL($this->AppName.'/Index','setting','',GP("type-0,appid-$this->appid",true)); ?>"
				<?php if($type==0) echo 'class="choice-active"';?>>退出记录</a>
				</div>
				</li>
			</ul>
		</li>	
		</ul>	
	</div>	     
		   
	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="ks-search-box fl">

		</div>					
				
		<div class="fr">
					
		</div>
				
	</div>
	<!--/widget-->
     
	<!--table-->
	<div>
		<div class="ks-clist">
			<ul class="clearfix">
				<?php foreach($values as $k=>$v){if($v['type'] ==0){$status = '未审核';}else{$status = '已审核';}?> 
				<li style="border-bottom: 1px solid #EEEEEE;">
					<div class="ks-check">	<input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'] ?>"></div>
					<div class="ks-cbox clearfix">
						<div class="fl ks-txtLeft">
							<p>用户ID:<?php echo Field($v['memberid']);?></p>
							<p>操作时间:<?php echo Field(date('Y-m-d H:i:s',$v['adddate']));?></p>
							
						</div>
						<div class="fl ks-txtLeft">
							<p>用户名:<?php echo Field($v['username']);?></p>
							<p>操作IP:<?php echo Field($v['memberip']);?></p>
							
						</div>
						<div class="fl ks-txtLeft">
							<p>手机号:<?php echo Field($v['mobile']);?></p>
							<p>操作方式:<?php if($v['type']==0){echo '账号登录';}else{echo '账号退出';}; ?></p>
							
						</div>
						<div class="fl ks-txtLeft">
							<p>登录设备:<?php if($v['logintype']==0){echo '电脑';}else{echo '手机';}; ?></p>
							<p>备注:<?php echo Field($v['mark']);?></p>
							
						</div>
						<div class="ks-operaRight fr">
							<a class="c-86A8F" href="javascript:void(0);" onclick="Confirm('是否删除此短信？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delLogin',$v['id'],GP('p-'.$page->now_page)); ?>')">
							<em>删除</em></a>
						</div>
					</div>
				</li>
				<?php }?>
			</ul>
		</div>
		<?php echo NoC($values);?>
	</div>
    <!--/table-->
            
	<!--footer-->
	<div class="ks-bom clearfix">
		<label style="margin-left: 12px;" class="fl"><input type="checkbox" class="select-checks selectAll">全选</label>
		<span class="fl">
			<button class="ks-heade-button" type="submit" name="batch" value="1"><i class="iconfont icon-shanchu1"></i></button>
		</span>
		<div class="fr"><?php if(count($values)!=0){echo $page->show(3);}?></div>
	</div>
	<!--/footer-->

</div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
	
		
		loadScorllJs()
		
	});


</script>





   <div id="ksBoxHead" >

		
</div>	 
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','loginbatch','',GP(''));  ?>" method="post" id="myform">
	<div  class="">
	  
	  </div>  
<div id="ksBoxFooter" >
	
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function Payswitch(loginstyle){
	var url = "<?php echo M_URL($this->AppName.'/Index','Loginswitch','',GP('p-'.$page->now_page)); ?>";
	$.ajax({
		type:"post",
		url:url,
		data:{'loginstyle':loginstyle},
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
function updatesStatus(id){
  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
   })
}
</script>
</body>
</html>

