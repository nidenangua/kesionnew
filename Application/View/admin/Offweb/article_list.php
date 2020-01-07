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
     	<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName,'batch','',GP('p-'.$page->now_page)) ?>" method="post">
     		<div class="ks-wbox bRadius10">
				<!--header-->
					<div class="ks-head-box clearfix">
						<h3 class="ks-head-title ">每日资讯</h3>
					</div>
				<!--header-->
				<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="fl">
			<div class="ks-search-box">
				 <select class="w150 inputText bRadius5 fl" id="keytype">
			             <option value="1" <?php if($keytype==1) echo "selected"; ?>>标题</option>
						 <option value="2" <?php if($keytype==2) echo "selected"; ?>>录入员</option>
				 </select>
				<div class="ks-top-search fl" >
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 		<span class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName,'Dailyinfo'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></span>
				</div>  
			</div>  
		</div>
		<div class="fr" >
			<div class="fr">
				<ul class="ks-head-choice">
				<li>
					<select class="w150 inputText bRadius5 fr" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName,'Dailyinfo'); ?>','categoryid','<?php echo URL_MODEL;?>')">
						<?php if(isset($category)){ ?>
							  <option value="0">选择分类</option>
								<?php foreach($category as $k=>$v){ ?>
									 <option value="<?php echo $v['categoryid']; ?>" <?php if($v['categoryid']==$categoryid){ ?>selected = "selected"<?php } ?>>
										<?php echo KS_INDENT($v['depth']).$v['categoryname'];?>
									 </option>
						<?php }}else{ ?>
									 <option value="0">请选择</option>
						<?php } ?>
			</select>
				</li>	
				<li>
					<div class="ks-head-el">
								<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName,'addArticle','',GP('')) ?>">	<i class="iconfont icon-jiahao"></i>添加资讯</a>

					</div>
				</li>
				
					
				</ul>
			</div>
		</div>
	</div>
	<!--/widget-->
	<!--table-->
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
            <thead>
                <tr>
                	<th>选择</th>
                    <!--<th>新闻标题</th>
                    <th>专业</th>
                    <th>作者</th>-->
                    <th>资讯内容</th>
                    <!--<th>文章热度</th>-->
                    <th>作者</th>
                    <th>添加时间</th>                  
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($values as $k=>$v){?>
            <tr>
            	<td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['id'];?>"></td>
            	
            	  <td style="text-align: left;"><?php echo Field($v['content']);?></td>
            	  <td><?php echo Field($v['inputer']);?></td>
            	  <!--<td><?php echo Field($v['categoryname']);?></td>
            	  <td><?php echo Field($v['inputer']);?></td>
            	  <td><?php echo $v['hits'];?></td>-->
            	  <!--<td>
            	  	<?php if($v["recommend"]==1){?><span style="color: green;">荐</span><?php }?>
					<?php if($v["roll"]==1){?><span style="color: blue;">滚</span><?php }?>
					<?php if($v["allowcomment"]==1){?><span style="color: pink;">评</span><?php }?>
					<?php if($v["hot"]==1){?><span style="color: red;">热</span><?php }?>
					<?php if($v["slide"]==1){?><span style="color: green;">幻</span><?php }?>
            	  </td>-->
            	  <td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
            	  <td><?php if($v["status"]==1){?><span class="ks-audit" >已审核</span><?php }else{?><span class="ks-unaudit">待审核</span><?php }?></td>
            	 <td class="ks-head-el">
				 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pr w100">
						<ul class="opeart">
									
							
							<li>
								<a href="<?php echo M_URL($this->AppName,'editArticle',$v['id'],GP('p-'.$page->now_page));?>">
									
									编辑
								</a>
							
							</li>
							<li>
								<a href="javascript:void(0);" onclick='Confirm("是否删除此新闻？该操作不可逆","<?php echo M_URL($this->AppName,'delete',$v['id'],GP(''));?>")'>
									
									删除
								</a>
							
							</li>
							
							
						</ul>
					</div>
				</td>
            </tr>
			<?php }?>
            </tbody>
        </table>
        
		
	<!--/table-->			
				
				

      <?php echo NoC($values);?>
   
	<div class="ks-bom clearfix">
		<span class="fl">
			<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
			<button class="fr ks-bt bt-pue" onclick="do_reg(1)">批量删除</button>
			<!--<button class="fr ks-bt bt-pue ml10" onclick="do_reg(2)">批量审核</button>
			<button class="fr ks-bt bt-pue ml10" onclick="do_reg(3)">取消审核</button>-->
		</span>
		<div class="fr"><?php echo $page->show(3); ?></div>
		
	</div>
	</div>
	  </form> 
		
		
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
module.require(['$','backstage','nicescroll'],function(){
loadScorllJs()

})	
	
function do_reg(){    
	$('#myform').submit();
}

function attributeSelect(url){    
	window.location.href=''+url;
}
</script>
</body>
</html>