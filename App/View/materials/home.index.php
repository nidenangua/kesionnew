<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">

	<div class="ks-wbox bRadius10">
		<!--header-->
			<div class="ks-head-box clearfix">
				<h3 class="ks-head-title">资料下载
				<div class="fr">
				
					<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor110"><i class="iconfont icon-qm" ></i></a>
				</div>
				</h3>
			</div>
            <!--header-->
				<!--widget-->
			<div class="ks-head-widget clearfix">
				<div class="fl">
					<form target="hidframe">
					<div class="ks-search-box">
						
						 <select class="w150 inputText bRadius5 fl" id="keytype">
					             <option value="1" <?php if($keytype==1) echo "selected"; ?>>资料名称</option>
<!--								 <option value="2" --><?php //if($keytype==2) echo "selected"; ?><!-->建立者</option>-->
						 </select>
						<div class="ks-top-search fl" >
							<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
							<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
						</div>
						
					</div>  
					
					</form>
				</div>				
					<div class="fr">
						<ul class="ks-head-choice">
						<li>
							<div class="ks-head-el">
									<button class="ks-heade-button ks-head-primary" type="button" onClick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
									<div class="ks-head-content ks-head-content-pr w300">
									<ul class="screen">
										<li>
											<span>发布状态：</span>
											<div>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("isopen-3,appid-$this->appid",true)); ?>" <?php if($isopen==3)echo 'class="choice-active"';?>>不限</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("isopen-1,appid-$this->appid",true)); ?>" <?php if($isopen==1)echo 'class="choice-active"';?>>开放</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						
						<li>
							<div class="ks-head-el">
								<a class="ks-heade-button ks-head-primary" href="javascript:;"   onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,14,false,true);?>'})" onclick="top.KTJ_RouteJump('/dataLibrary')">资料库</a>
							</div>
						</li>
						<li>
							<div class="ks-head-el">
								<a class="ks-heade-button ks-head-primary" href="javascript:;"  onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,14,false,true);?>'})"  onclick="top.KTJ_RouteJump('/data/0')">	<i class="iconfont icon-jiahao"></i>添加资料</a>

							</div>
						</li>

						</ul>
					</div>
				</div>
			
			<!--/widget-->
				
			<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','del','',GP('p-'.$page->now_page)) ?>" method="post">
	<!--table-->
		
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
            <thead>
                <tr>
                	<th>选择</th>
                    <th style="text-align:left">资料名称</th>
                    <th>大小</th>
                    <th>下载次数</th>
					<th>价格</th>
                    <th>分享</th>                
                    <th>发布状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($values as $k=>$v){?>
            <tr>
            <td style="width: 30px;"> <input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'];?>"></td>
            	 <td style="text-align:left"><?php echo Field($v['title']);?></td>
            	 <td><?php echo $v['size']?KS_Byte($v['size']):'--';?></td>
            	 <td><?php echo $v['down_num'];?></td>
				 <td><?php if ($v['chargetype']==0){echo '免费';}else{echo $v['price'];}?></td>
            	 <td>
					<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['id'],GP(''));?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a>
				 </td>
            	 <td>
            	 	<span class="link-switch<?php if($v["isopen"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['id'],GP('db-1')); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['id'],GP('db-1')); ?>"><i></i></span>
            	 </td>
            	 <td class="ks-head-el">
				 	<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
							<li>
								<a href="javascript:;" onclick="top.KTJ_RouteJump('/data/<?php echo $v['id'];?>')">编辑</a>
							</li>
							<li>
								<a href="javascript:void(0);" onclick='Confirm("是否删除该组？该操作不可逆","<?php echo M_URL($this->AppName.'/Index','del',$v['id'],GP('db-1'));?>")'>删除</a>
							</li>
						</ul>
					</div>
				</td>
            </tr>
			<?php }?>
            </tbody>
        </table>
          </form> 
		
	<!--/table-->			
      <?php echo NoC($values);?>
      <?php if(!empty($values)){?>
      	<input type="hidden" name="batch" id="batch1" />
		<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
				<button class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
<!--				<button class="ks-heade-button mr10" onClick="submitform(2)">批量审核</button>-->
<!--				<button class="ks-heade-button " onClick="submitform(3)">取消审核</button>-->
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
			
		</div>
	<?php }?>
<!--	--><?php //}else{?>
        <!--
		<div class="unopened">
	 	您还没有启用新闻功能！
	 	<a class="ks-bt bt-pue" href="javascript:void(0);" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid;?>,wxid:<?php echo $this->wxid;?>})">立即开启</a>
	</div>-->
<!--	--><?php //}?>
</div>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs();
	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
})	
function submitform(type){
	inspectionCheckBox('id[]',function(){
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
};
function attributeSelect(url){    
	window.location.href=''+url;
}
</script>
</body>
</html>