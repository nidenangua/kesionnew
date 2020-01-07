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
				<h3 class="ks-head-title">新闻资讯 
				<div class="fr">
					<a class="ks-setting-icon fl ml10"onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting" ></i></a>
					<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor110"><i class="iconfont icon-qm" ></i></a>
				</div>
				</h3>
			</div>
            <!--header-->
			<?php if(isset($setting[0])&&$setting[0]==1){?>		
				<!--widget-->
			<div class="ks-head-widget clearfix">
				<div class="fl">
					<form target="hidframe">
					<div class="ks-search-box">
						
						 <select class="w150 inputText bRadius5 fl" id="keytype">
					             <option value="1" <?php if($keytype==1) echo "selected"; ?>>标题</option>
								 <option value="2" <?php if($keytype==2) echo "selected"; ?>>作者</option>
						 </select>
						<div class="ks-top-search fl" >
							<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 		<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
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
											<span>新闻状态：</span>
											<div>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3,appid-$this->appid",true)); ?>" <?php if($status==3)echo 'class="choice-active"';?>>不限</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>" <?php if($status==1)echo 'class="choice-active"';?>>已审核</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>" <?php if($status==0)echo 'class="choice-active"';?>>待审核</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-2,appid-$this->appid",true)); ?>" <?php if($status==2)echo 'class="choice-active"';?>>草稿</a>
											</div>
										</li>
										<!--<li>
											<span>新闻属性：</span>
											<div>
												<a href="<?php if($hot==1){echo M_URL($this->AppName.'/Index','index','',GP('hot-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('hot-1'));} ?>" <?php if($hot==1){echo 'class="choice-active"';}?>>热门</a>
												<a href="<?php if($allowcomment==1){echo M_URL($this->AppName.'/Index','index','',GP('allowcomment-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('allowcomment-1'));} ?>" <?php if($allowcomment==1){echo 'class="choice-active"';}?>>评论</a>
												<a href="<?php if($recommend==1){echo M_URL($this->AppName.'/Index','index','',GP('recommend-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('recommend-1'));} ?>" <?php if($recommend==1){echo 'class="choice-active"';}?>>推荐</a>
												<a href="<?php if($roll==1){echo M_URL($this->AppName.'/Index','index','',GP('roll-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('roll-1'));} ?>" <?php if($roll==1){echo 'class="choice-active"';}?>>滚动</a>
												<a href="<?php if($slide==1){echo M_URL($this->AppName.'/Index','index','',GP('slide-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('slide-1'));} ?>" <?php if($slide==1){echo 'class="choice-active"';}?>>幻灯片</a>
											</div>
								</li>	
										-->
									</ul>
								</div>
							</div>
						</li>
						
						<li>
							<div class="ks-head-el">
										<a class="ks-heade-button ks-head-primary"  onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,101,false,true);?>'})"  href="<?php echo M_URL($this->AppName.'/Index','addArticle','',GP('')) ?>">	<i class="iconfont icon-jiahao"></i>添加新闻</a>
		
							</div>
						</li>
						<?php if(iscategory($this->wxid,$this->appid)){?>
						<li>
							<div class="ks-head-el">
<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL('category/Index','index2','',GP('appid-2'));?>">分类管理</a>
							</div>
						</li>
						<?php }?>	
						</ul>
					</div>
				</div>
			
			<!--/widget-->
				
			<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post">		
	<!--table-->
		
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
            <thead>
                <tr>
                	<th>选择</th>
                    <th style="text-align: left;">新闻标题</th>
                    <th>专业</th>
                    <th>作者</th>
                    <th>查看人数</th>
                    <!--<th>文章热度</th>-->
                    <th>添加时间</th>  
                    <th>分享</th>   
					
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($values as $k=>$v){
             
                      if ($this->userid==797){    //平台的账号ksbianji01
                          $viewurl="/home/articleDetail/".$v['id']."?f=pc";
                      }else{
                          $viewurl=wx_Url($this->wxid).'/?f=pc#/news/'.$v['id'];
                      }
            ?>
            <tr>
            <td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['id'];?>"></td>
            	 <td style="text-align: left;"><a href="<?php echo $viewurl; ?>" target="_blank"><?php echo Field($v['title']);?></a></td>
            	 <td><?php echo Field($v['categoryname']);?></td>
            	 <td><?php echo Field($v['inputer']);?></td>
            	 <td><?php echo $v['hits'];?></td>
            	 <!--<td>
            	  	<?php if($v["recommend"]==1){?><span style="color: green;">荐</span><?php }?>
					<?php if($v["roll"]==1){?><span style="color: blue;">滚</span><?php }?>
					<?php if($v["allowcomment"]==1){?><span style="color: pink;">评</span><?php }?>
					<?php if($v["hot"]==1){?><span style="color: red;">热</span><?php }?>
					<?php if($v["slide"]==1){?><span style="color: green;">幻</span><?php }?>
            	 </td>-->
            	 <td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
            	 <td>
					<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['id'],GP(''));?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a>
				 </td>
            	 <td>
            	 	<span class="link-switch<?php if($v["status"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['id'],GP('')); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['id'],GP('')); ?>"><i></i></span>
            	 </td> 	
            	 <td class="ks-head-el">
				 	<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">	
							<li >
								<a href="<?php echo $viewurl; ?>" class="user-listh" target="_blank">预览</a>
							</li>
							<li>
								<a href="<?php echo M_URL($this->AppName.'/Index','editArticle',$v['id'],GP('p-'.$page->now_page));?>">编辑</a>
							</li>
							<li>
								<a href="javascript:void(0);" onclick='Confirm("是否删除此新闻？该操作不可逆","<?php echo M_URL($this->AppName.'/Index','delete',$v['id'],GP(''));?>")'>删除</a>
							</li>
						</ul>
					</div>
				</td>
            </tr>
			<?php }?>
            </tbody>
		</table>
		<input type="hidden" name="batch" id="batch1" />
          </form> 
		
	<!--/table-->			
      <?php echo NoC($values);?>
      <?php if(!empty($values)){?>
      	
		<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
				<button type="button" class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
				<button type="button" class="ks-heade-button mr10" onClick="submitform(2)">批量审核</button>
				<button type="button" class="ks-heade-button " onClick="submitform(3)">取消审核</button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
			
		</div>
	<?php }?>
	<?php }else{?>
		<div class="unopened">
	 	您还没有启用新闻功能！
	 	<a class="ks-bt bt-pue" href="javascript:void(0);" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid;?>,wxid:<?php echo $this->wxid;?>})">立即开启</a>
	</div>	
	<?php }?>
</div>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage'],function(){

	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
})	
function submitform(type){
	inspectionCheckBox('check[]',function(){
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