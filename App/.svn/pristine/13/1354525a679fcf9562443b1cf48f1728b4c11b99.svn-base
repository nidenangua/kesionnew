<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>知识点管理</title>
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
		<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    

</head>

<body class="ks-wrap">
	
	<div id="ksBoxHead">
		<!--结束-->
		<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			
	
			
			<!--标题-->
			<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>我的应用</a><span>/</span>知识点管理 </p>
			<!--标题-->
			
			</div>
			<!--操作范围-->

			<div class="Tool-btnGroup">
			 <a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','addKpoint','',GP('')); ?>"><i class="iconfont icon-jiahao"></i>增加知识点</a>
			 <a class="ks-bt bt-def" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting"></i>知识点配置</a>
			</div>
	
			 
			<!--操作范围-->
				<div class="fr ks-top-search mt10">
				<label class=" fl" style="margin-right: -1px;">
			   	<select class="w150 inputText bRadius5" id="keytype">
					<option value="1">知识点名称</option>
			  	</select>
				</label>
	
				<form target="hidframe"  class="fr">
					
				<div class="ks-top-search">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	                <input type="submit" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
				</div>
				</form>
			</div>
			
		</div>

	
   </div>
   		
	<div class="bRadius10 bg-white mt20"> 
	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batch','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
	<div id="ksBoxContent">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
	            <thead>
		            <tr>
		            	<th><input name="" type="checkbox" value="" id="selectAll"></th>
		                <th class="ta-left">知识点</th>
		                <th class="ta-left">介绍</th>              
		                <th>操作</th>
		            </tr>
	            </thead>
	            <tbody>
	            
	            <?php foreach($values as $k=>$v){ ?> 
		            <tr>
		            	<td width="10%">
		            		<input type="checkbox" class="slect-check" name="id[]" value="<?php echo $v['id'] ?>"></td>
		                <td class="ta-left" width="35%">
		                <?php echo $v['title']?></td>
		                <td class="ta-left" width="35%"><?php echo $v['intro']?></td>
		                <td width="20%">
		                    
		                    <div class="operate">
		                    	
			                    <a href="<?php echo M_URL($this->AppName.'/Index','editKpoint',$v['id'],GP('userid-'.$v['userid'].',p-'.$page->now_page)); ?>"><em>编辑</em><i class="iconfont icon-bianji4"></i></a>
			                    <a href="javascript:Confirm('是否删除此试卷？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delKpoint',$v['id'],GP('p-'.$page->now_page)); ?>')"><em>删除</em><i class="iconfont icon-shanchu1"></i> </a>
		                    </div>
		                </td>
		            </tr>
	            <?php }?>
	            
	            </tbody>
	        </table>
	        <?php echo NoC($values);?>
	       	<input type="hidden" name="batch" id="batch1" />
	    </div>
	</form>
</div>
	
	<div id="ksBoxFooter" style="height: 80px;">
	<div class="ks-bom clearfix">
		<span class="fl">
			<button class="ks-bt bt-pue" type="button"  onclick="submitform(1);"><i class="iconfont icon-shanchu1"></i>批量删除</button>
		</span>
		<div class="fr"><?php echo $page->show(3); ?></div>
	</div>
</div>


<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>

function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
</script>
</body>
</html>

