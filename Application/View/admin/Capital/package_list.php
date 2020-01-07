<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
<style>
.footer-page {
    height: 44px;
    bottom: 0;
    left: 0;
    background: #fff;
    border-top: #e8eced solid 1px;
    position: fixed;
    width: 100%;
}	
</style>
</head>
<body class="gray-bg" style="overflow：auto;height:100%;">
<div class="wrapper wrapper-content mt55 animated fadeIn"  >
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
              <h3 class="fl" ></h3>
              <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0"><i class="reflash"></i></a>
              </div>
<button  type="button" onclick="addversion()" class="btn btn-info btn-rounded btn-s-md " style="color:#676a6c;margin-left:20px">增加收费类型</button>
<button  type="button" onclick="addfeature()" class="btn btn-info btn-rounded btn-s-md " style="color:#676a6c;margin-left:20px">增加收费功能</button>
            </div>
        </div>
    </div>
    <div class="row"><br />
    	<div class="tab-page" id="tab6">
        <h2 class="tab">VIP等级分配</h2>
<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php echo M_URL('home/Domain','doEditPackage');?>">  
		<table cellspacing="0" align="Center" border="0">
			<tr>
			<td>功能序列号----</td>		
			<td>appid----</td>	
			<?php foreach($package_version as $k=>$v){ ?>
				<td><input name="version[]" type="text" value="<?php echo $v['versionname'];?>" class="textbox" style="width:120px;text-align:center" />(<?php echo $v['versionename'];?>版)</td>
			<?php } ?>	
		    </tr>
		    <?php foreach($package_feature as $k=>$v){if($v['versionename']=='v0'){$i=$v['seriesid']; ?>
			<tr >
				<td><?php echo $i;?><input type="hidden" name="seriesid[]" value="<?php echo $i;?>" /> </td>
				<td>
					<select name="appid[]" class="textbox" style="width:120px;text-align:center">
				   	 	   <option value="0">请绑定应用</option>
				   	 	   <?php foreach($appinfo as $ktt=>$vtt){ ?>
				   	 	   <option value="<?php echo $vtt['appid'];?>" <?php if($v['appid']==$vtt['appid']){?>selected="selected"<?php }?>><?php echo $vtt['appname'];?></option>
				   	 	   <?php } ?>
				   	 </select>
				</td>
				<?php foreach($vesion as $kt=>$vt){ ?>
				<td>
				   <?php if(isset($vt[$i]['versionename'])&&$vt[$i]['versionename']=='v0'){?> 
				   	   <input name="feature<?php echo $i;?>[]" type="text" value="<?php echo isset($vt[$i]['featurename'])?$vt[$i]['featurename']:'-----';?>" class="textbox" style="width:120px;text-align:center" /> 
				   <?php }elseif(isset($vt[$i]['featurename'])&&$vt[$i]['featurename']=='0'){?> 	
				   	   <input type="checkbox" value="1" onclick="a<?php echo $i.$kt;?>.value=this.checked?1:0"/>
				   	   <input name="feature<?php echo $i;?>[]" type="hidden" id="a<?php echo $i.$kt;?>" value="0" > 
				   <?php }elseif(isset($vt[$i]['featurename'])&&$vt[$i]['featurename']=='1'){?> 	
				   	   <input type="checkbox" value="1" onclick="a<?php echo $i.$kt;?>.value=this.checked?1:0" checked="checked"/>
				   	   <input name="feature<?php echo $i;?>[]" type="hidden" id="a<?php echo $i.$kt;?>" value="1" >
				   <?php }else{?>
                   	   <input name="feature<?php echo $i;?>[]" type="text" value="<?php echo isset($vt[$i]['featurename'])?$vt[$i]['featurename']:'-----';?>" class="textbox" style="width:120px;text-align:center" /> 
                   <?php } ?>                          
                </td>
                <?php } ?>
                <td><?php if($i>39){?><button type="button" onclick="delfeature('<?php echo $v['seriesid'];?>');">[删除]</button><?php }?>
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
        <div class="footer-page">
            <div class="col-sm-5"></div>
	        <div class="col-sm-3 mt3"><button class="btn btn-primary btn-s-md" type="submit">保存</button></div>
        </div>
</form>   
        </div>
    </div>
</div>
</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	loadScorllJs();//滚轮
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
</script>
</body>
</html>
