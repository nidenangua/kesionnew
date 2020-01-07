<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php if(!isset($app)){echo '添加应用';}else{echo '修改应用';} ?></title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
.Created-title{margin-left: 15px;}
	.Created-title span:nth-of-type(2){margin-left: 1px;}
	.Created-Content .uploads{padding-left: 0;}
	.Created-Content .uploads img{ position: relative;height: inherit;}
	.Created-Content .Marks	{height: inherit;}
</style>
<body class="gray-bg">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title clearfix">
        <h3 class="fl">&nbsp;&nbsp;<?php if(empty($values)){ ?> 新增营销方案<?php }else{ ?> 修改营销方案 <?php } ?></h3>
        
        <div class="fr mt5">
			<div class="fl ks-top-search">
				<a href="<?php echo M_URL('H5market'); ?>" class="ks-bt bt-def"><i class="iconfont icon-fanhui"></i>返回</a>
			</div>  
		</div>
    </div>
   	
	
</div>	
	
<?php if(empty($values)){ ?> 
<form target="hidframe"  class="form-horizontal" action="<?php echo M_URL('H5market','doaddH5')?>" method="post" enctype="multipart/form-data">
<?php }else{?>
<form target="hidframe"  class="form-horizontal" action="<?php echo M_URL('H5market','doeditH5')?>" method="post" enctype="multipart/form-data">	
<?php }?>
	 <br />	
    <br />	
<div class="Created-push">
		<ul>
			
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>活动内容编辑</span>
						<span>(编辑游戏规则)</span>
					</div>
				</div>
				<div class="Created-ing">
					<ul>
						<li>
							<input name="id" type="hidden" value="<?php if(!empty($values)){echo $values['id'];} ?>"/>
							<h4>活动名称:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="h5name" flag='活动名称' value="<?php if(!empty($values)){echo $values['h5name'];} ?>">
							</div>
						</li>
						<li>
							<h4>英文名称:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="enname" flag='英文名称' value="<?php if(!empty($values)){echo $values['enname'];} ?>">						
							</div>
						</li>
						
						<li>
							<h4>应用作者:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="author" flag='应用作者' value="<?php if(!empty($values)){echo $values['author'];} ?>">						
							</div>
						</li>
						
						<li>
							<h4>封面图片:</h4>
							<div class="Created-Content clearfix">
								<button type="button" href="javascript:void(0);"  onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-ico',true));?>','930px','610px',{title:'选择图片',type:'top'})"  class="ks-bt btn-tool" style="margin-top:70px">上传图片</button>
								<div class="uploads">
									<img src="<?php if(!empty($values)){echo Img($values['ico']);} ?>" alt="" class="ico">
									<input type="hidden" name="ico" flag='封面' value="<?php if(!empty($values)){echo $values['ico'];} ?>">
									<div class="Marks">
										<p>大小300*300以上</p>
									</div>
								</div>
							</div>
						</li>
						
						
						<!--<li>
							<h4>奖励类型:</h4>
							<div class="Created-Content clearfix">
								<label for="reward1"><input id="reward1" type="checkbox" name="reward" flag='奖励类型' checked>代金券</label>
							</div>
						</li>-->
						
						<li>
							<h4>是否收费:</h4>
							<div class="Created-Content clearfix" id="changeRaido">
								<label for="mianfree1"><input id="mianfree1" name="marketing" type="radio" value="0" flag='收费模式' <?php if(!empty($values)){if($values['marketing']==0){ echo "checked";}} ?>>免费</label>
								<!--<label for="mianfree2"><input id="mianfree2" name="marketing" type="radio" value="1" flag='收费模式' <?php if(!empty($values)){if($values['marketing']==1){ echo "checked";}} ?>>收费</label>-->
								<label for="mianfree3"><input id="mianfree3" name="marketing" type="radio" value="2" flag='收费模式' <?php if(!empty($values)){if($values['marketing']==2){ echo "checked";}} ?>>绑定版本</label>
							</div>
						</li>
						
						<span class="showBan" id="canuse">
						<li>
							<h4>可使用版本:</h4>
							<div class="Created-Content clearfix">
								<!--<label for="package1"><input id="package1" name="package" type="radio" flag='套餐版本' value="v1" <?php if(!empty($values)){if($values['package']=='v1'){ echo "checked";}} ?>>体验版</label>-->
								<label for="package2"><input id="package2" name="package" type="radio" flag='套餐版本' value="v2" <?php if(!empty($values)){if($values['package']=='v3'){ echo "checked";}} ?>><?php echo wx_version_itemvalue('','',3);?></label>
								<label for="package4"><input id="package4" name="package" type="radio" flag='套餐版本' value="v4" <?php if(!empty($values)){if($values['package']=='v4'){ echo "checked";}} ?>><?php echo wx_version_itemvalue('','',4);?></label>	
								<!--<label for="package3"><input id="package3" name="package" type="radio" flag='套餐版本' value="v3" <?php if(!empty($values)){if($values['package']=='v4'){ echo "checked";}} ?>>高级运营版</label>	
								<label for="package5"><input id="package5" name="package" type="radio" flag='套餐版本' value="v5" <?php if(!empty($values)){if($values['package']=='v5'){ echo "checked";}} ?>>钻石版</label>	-->
							</div>
						</li>
						</span>
						
						 
						<span class="showBan" id="timesuse"> 
						<li > 
							<h4>可使用次数:</h4>
							<div class="Created-Content">
								<input type="text" name="number"  class="long-text" flag='可使用次数' <?php if(!empty($values)){ echo $values['number'];} ?>>
							</div>
						</li>
						</span>
						
						
						<span class="showBan" id="priced">
						<li>
							<h4>价格:</h4>
							<div class="Created-Content">
								<input type="text" name="price"  class="long-text" flag='价格' <?php if(!empty($values)){ echo $values['price'];} ?>>
							</div>
						</li>
						</span>
						
						
						<li>
							<h4>活动类型:</h4>
							<div class="Created-Content clearfix" id="modeRadio" >
								<label for="ismode1"><input id='ismode1' type="radio" name="ismode" flag='活动类型' value="1" <?php if(!empty($values)){if($values['ismode']=='1'){ echo "checked";}} ?>>抽奖活动</label>
								<label for="ismode2"><input id='ismode2' type="radio" name="ismode" flag='活动类型' value="2"<?php if(!empty($values)){if($values['ismode']=='2'){ echo "checked";}} ?>>助力活动</label>
								<label for="ismode3"><input id='ismode3' type="radio" name="ismode" flag='活动类型' value="3"<?php if(!empty($values)){if($values['ismode']=='3'){ echo "checked";}} ?>>排行活动</label>
							</div>
						</li>
						<span class="mode2" id="mode2">
						<li>
							<h4>裂变类型:</h4>
							<div class="Created-Content clearfix">
								<label for="modetype1"><input id="modetype1" name="modetype" type="radio" flag='裂变' value="1" <?php if(!empty($values)){if($values['modetype']=='1'){ echo "checked";}} ?>>开团</label>
								<label for="modetype2"><input id="modetype2" name="modetype" type="radio" flag='裂变' value="2" <?php if(!empty($values)){if($values['modetype']=='2'){ echo "checked";}} ?>>砍价</label>
								<label for="modetype3"><input id="modetype3" name="modetype" type="radio" flag='裂变' value="3" <?php if(!empty($values)){if($values['modetype']=='3'){ echo "checked";}} ?>>钓鱼</label>
								<label for="modetype4"><input id="modetype4" name="modetype" type="radio" flag='裂变' value="4" <?php if(!empty($values)){if($values['modetype']=='4'){ echo "checked";}} ?>>优惠</label>
							</div>
						</li>
						</span>
						<li>
							<h4>是否为pad招生宝:</h4>
							<div class="Created-Content clearfix">
								<label for="ispad1"><input type="radio" name="ispad" id='ispad1'  value="1" <?php if(!empty($values)){if($values['ispad']=='1'){ echo "checked";}} ?>>是</label>
								<label for="ispad2"><input type="radio" name="ispad" id='ispad2'  value="0" <?php if(!empty($values)){if($values['ispad']=='0'){ echo "checked";}} ?>>否</label>
							</div>
						</li>  
						<li>
							<h4>是否为热门活动:</h4>
							<div class="Created-Content clearfix">
								<label for="ishot1"><input type="radio" name="ishot" id='ishot1'  value="1" <?php if(!empty($values)){if($values['ishot']=='1'){ echo "checked";}} ?>>是</label>
								<label for="ishot2"><input type="radio" name="ishot" id='ishot2'  value="0" <?php if(!empty($values)){if($values['ishot']=='0'){ echo "checked";}} ?>>否</label>
							</div>
						</li>  
						<li>
							<h4>活动时间:</h4>
							<div class="Created-Content">
								<select name="istime" id="istime" flag='活动时间' style="margin: 0px;">
									<option>不设置</option>
									<?php foreach($festivals as $k =>$v){?>
									<option value="<?php echo $v['id']; ?>" <?php if(!empty($values)){if($values['istime']==$v['id']){ echo "selected";}} ?>><?php echo $v['name'];?></option>
									<?php }?>
									
								</select>
							</div>
						</li>
					</ul>
					
				</div>
				
				
			</li>
			<!--<?php if(empty($values)){?>
			<li>
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title">
						<span>自定义内容编辑</span>
						<span></span>
						<span></span>
					</div>
				</div>
				<div class="Created-ing">
					<ul>
						<li>
							<h4>功能说明:</h4>
							<div class="Created-Content">
								<textarea name="intro"><?php if(!empty($values)){echo $intro['value'];} ?></textarea>
								 
							</div>
						</li>
						
						<li>
							<h4>功能介绍:</h4>
							<div class="Created-Content">
								<textarea name="instruction"><?php if(!empty($values)){echo $instruction['value'];} ?></textarea>
							
							</div>
						</li>
						
						<li>
							<h4>活动场景:</h4>
							<div class="Created-Content">
								<textarea name="scene"><?php if(!empty($values)){echo $scene['value'];} ?></textarea>
								
							</div>
						</li>			
					
					</ul>
					
				</div>
				
				
			</li>
			<?php }?>-->
		</ul>
		<br /><br /><br /><br /><br />
	</div>	

	
	<div class="footer-page">
        <div class="col-sm-5"></div>
        <div class="col-sm-6 mt3">
            <button type="submit" class="btn btn-tool btn-s-md" ><?php if(empty($values)){echo '确定添加';}else{echo '确定修改';} ?></button>
            <a href="javascript:history.go(-1);" class="btn  btn-s-md" style="background: #CCCCCC;">取消</a> 
        </div>
    </div>
</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function csh(){
	var values = $("#changeRaido input:checked").val();
	$(".showBan").hide(); 
	if(values==1){
		$("#timesuse").show();
		$("#priced").show();
	}else if(values==2){
		$("#canuse").show();
	}
}
csh();
function modecsh(){
	var values = $("#modeRadio input:checked").val();
	$('.mode2').hide();
	if(values==2){
		$('.mode2').show();
	}else{
		$('.mode2').hide();
	}
}
modecsh()
	//版本切换
	$("#modeRadio input").click(function(){
		var values = $(this).val();

		$(".showBan").hide(); 
		if(values==2){
		$('.mode2').show();
	}else{
		$('.mode2').hide();
	}

	})	
		
	
		$("#changeRaido input").click(function(){
		var values = $(this).val();

		$(".showBan").hide(); 
		if(values==1){
			$("#timesuse").show();
			$("#priced").show();
		}else if(values==2){
			$("#canuse").show();
		}

	})	
						
			
    $(function(){
        taps();//选项卡
        uploadView('100','100');//图片上传	
//      datatime('#test');//时间选择器
        radioTaps();
        loadScorllJs();
        //判断是否选中	
        //$("input[name='isweb']").reset();	
    });
</script>

</body>

</html>
