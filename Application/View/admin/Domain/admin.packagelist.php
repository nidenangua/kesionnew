
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="//store.kesion.com/Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="//store.kesion.com/Public/admin/css/html5.css" rel="stylesheet">
<link href="//store.kesion.com/Public/admin/css/general.css" rel="stylesheet">
<link href="//store.kesion.com/Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//store.kesion.com/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//store.kesion.com/Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//store.kesion.com/Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="//store.kesion.com/Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.gy{background: #F8F8F8;}
	.smimg{height: 40px; width: 60px;border-radius: 5px;margin-top: 5px;}
	.pnone{padding:0px!important;}
	.borderBt{padding: 5px 10px;border: solid 1px #D0D0D0; color: #333;font-size: 12px;}
	.borderBtL{padding: 5px 10px;border: solid 1px #6282C4; color: #6282C4;font-size: 12px;}
	.bottomGroup { bottom: 30px; left: 0px; width: 100%; text-align: center; position: absolute; }
	.footer-page .bt-gray{background: #DBDBDB;color: #333!important;}
	.ks-red {background-color:#d3dfef !important}
	/*.ks-red td{color: #fff;}*/
	.ks-green{background-color: antiquewhite !important}
	/*.ks-green td{color: #fff;}*/
	.ks-table tr:nth-child(odd){background: #eef0f2!important;}
	
	.ivon-down {position: relative;cursor: pointer;}
	.select-dropdown {position: absolute;box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 6px;background: #fff;padding: 10px 10px;z-index: 99;width: inherit;left: -350px;text-align: center;
	min-width: 400px;}

</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<form  id="myform"  method="post" class="form-horizontal" action="<?php echo M_URL('home/Domain','doEditPackage');?>">  
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;<span class="mr20">套餐配置</span>
        	<span class="btn btn-tool btn-rounded btn-s-md  mr20" onclick="addversion()">增加收费类型</span>
        	<span class="btn btn-tool btn-rounded btn-s-md  mr20" onclick="addfeature()">增加收费功能</span>
        </h3>
        <div class="fr">
            <div class="fl ks-top-search"><!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div>
	<div style="padding: 30px 0px;">
	<div class="H5-gameListConts school-online">
		<div class="Created-push" style="padding:15px;">
		<div  id="ksBoxContent">
		<table class="ks-table" id="tables">
			<tr>
				<th>功能序列号</th>
				<th style="display:none">应用绑定</th>
				<?php foreach($package_version as $k=>$v){ ?>
				<th><input name="version[]" type="text" class="borderBt" value="<?php echo $v['versionname'];?>" style="width: 90px;"/>(<?php echo $v['versionename'];?>版)</th>
			    <?php } ?>
			    <th style="display: none;">颜色</th>	
				<th>操作</th>
				<th >排序</th>
			</tr>
			<?php foreach($vesion[0] as $k=>$v){
            if($v['versionename']=='n0'){
                $i=$v['seriesid'];
                ?>	
			<!--	style="background-color:<?php echo $v['color'];?>; !important"-->
			<tr >
				<td><?php echo $i;?><input type="hidden" name="seriesid[]" value="<?php echo $i;?>" /></td>
				<td  style="display:none">
				<select name="appid[]" class="borderBt">
					<option value="0">应用绑定</option>
					<?php foreach($appinfo as $ktt=>$vtt){ ?>
					<option value="<?php echo $vtt['appid'];?>" <?php if($v['appid']==$vtt['appid']){?>selected="selected"<?php }?>><?php echo $vtt['appname'];?></option>
					<?php } ?>
				</select>
				</td>
				<?php foreach($vesion as $kt=>$vt){ ?>
				<td>
				   <input title="<?php echo isset($vt[$i]['featurename'])?$vt[$i]['featurename']:'-----';?>" name="feature<?php echo $i;?>[]" type="text" value="<?php echo isset($vt[$i]['featurename'])?$vt[$i]['featurename']:'-----';?>" class="borderBt" style="width:90px;text-align:center" /> 
                </td>
                <?php } ?>
				
	
				<td style="display: none;"> 
					<p><span class="mr20"><input name="color[]" onmouseover="this.title=this.value" type="text" value="<?php echo $v['color'];?>" class="borderBt" style="width:90px;text-align:center" /></span></p>
				</td>
				<td>
					<?php if($i>46){?>
					<p><span class="mr20"><a href="javascript:void(0);" onclick="delfeature('<?php echo $v['seriesid'];?>');">删除</a></span></p>
					<?php }?>
				</td>
				<td>
					
					<div class="ivon-down">
	            	  		
	            	  		<span>排序 <i class="icon-jiantou1 iconfont ivon-down"></i></span>
	            	  		<div class="select-dropdown" style="display: none;"> 
	            	  			<form method="post" action="<?php echo M_URL('Domain','featureup',$i);?>" class="fl">	
									<span class="mr20"><?php if($v['orderid']!=1){?>
										<select class="form-textbox fl" name="numb"  style="width: 80px;margin-right: 10px;">
												<?php for($j=1;$j<$v['orderid'];$j++){?>
												<option value="<?php echo $j;?>"><?php echo $j;?></option>
												<?php }?>
											</select>
											<button class="btn btn-default" type="submit">向上</button>
									<?php }?></span></form>
									<form method="post" action="<?php echo M_URL('Domain','featuredown',$i);?>" class="fr">
									<span><?php if($v['orderid']!=count($vesion[0])){?>
											<select class="form-textbox fl" name="numb"  style="width: 80px;margin-right: 10px;">
												<?php for($j=1;$j<count($vesion[0])-$v['orderid']+1;$j++){?>
												<option value="<?php echo $j;?>"><?php echo $j;?></option>
												<?php }?>
											</select>
											<button class="btn btn-default" type="submit">向下</button>
									<?php }?></span></form>
							</div>		
	            	  	</div>
					
					
					
					
					
					
					
			
				</td>
			</tr>
			<?php }} ?>
			<tr>
				<td></td><td></td>
				<?php foreach($package_version as $k=>$v){ ?>
                <td><?php if($v['versionid']>6){?><button type="button" onclick="delversion('<?php echo $v['versionid'];?>');">[删除]</button><?php }?></td>	
                <?php } ?>	
			</tr>
					
		</table>	
		
        </div>
		</div>
	</div>
	<div>
	</div>
	</div>
</div>
<div class="footer-page h60" style="text-align: center;">
        <button class="btn btn-default mt10" type="button" onClick="do_reg()" name="batch" value="4">确定修改</button>
        <!--<a href="javascript:history.go(-1);" class="btn bt-gray mt10 ">取消修改</a> -->
</div>
</form>
<div id="ksBoxFooter" style="height:180px;"></div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function do_reg(){
	$("#myform").submit();	
} 
//添加版本
function addversion(){
	var url = '<?php echo M_URL('Domain','addversion');?>';
	$.ajax({
		type:"post",
		url:url,
		success:function(data){
		   if(data=='ok'){location.reload();}
		},
	    error:function(){
			Alert("网络延迟,重新操作!");
		}
	});
}
//删除版本
function delversion(versionid){
	if(versionid<7){Alert('喂喂，是不是删错了');return false;}
	var url = '<?php echo M_URL('Domain','delversion');?>';
	$.ajax({
		type:"post",
		url:url,
		data:{'versionid':versionid},
		success:function(data){
		   if(data=='ok'){location.reload();}
		},
	    error:function(){
			Alert("网络延迟,重新操作!");
		}
	});
}
function addfeature(){
	var url = '<?php echo M_URL('Domain','addfeature');?>';
	$.ajax({
		type:"post",
		url:url,
		success:function(data){
		   if(data=='ok'){location.reload();}
		},
	    error:function(){
			Alert("网络延迟,重新操作!");
		}
	});
}
function delfeature(seriesid){
	if(seriesid<36){Alert('喂喂，是不是删错了');return false;}
	var url = '<?php echo M_URL('Domain','delfeature');?>';
	$.ajax({
		type:"post",
		url:url,
		data:{'seriesid':seriesid},
		success:function(data){
		   if(data=='ok'){location.reload();}
		},
	    error:function(){
			Alert("网络延迟,重新操作!");
		}
	});
}

	$('.ivon-down').hover(function(){
		$(this).find('.select-dropdown').slideDown()
	},function(){
		
		$(this).find('.select-dropdown').slideUp() 
	});
	


</script>
