<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>考试系统</title>
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
  
</head>

<body class="ks-wrap">
	
	<div class="ks-wbox bRadius10">
		<div class="ks-head-box">
	     	<div class="fr">
	     		<a href="<?php echo M_URL('exam/Index','edittype','',GP(''))?>" class="ks-heade-button ks-head-primary" type="button"><i class="icon-jiahao iconfont "></i>添加试卷类型</a>

	     	</div>
			<div class="ks-head-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">教师管理</a><span><em>/</em>试卷类型配置</span>
			<!--标题-->
			</div>
		
	    </div>
	   
		
	    
	<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batchPapertype','',GP('p-'.$page->now_page)) ?>" method="post" id="myform">
			<table width="100%" cellpadding="0" cellspacing="0" border="0"   class="ks-table mt20">
			
			<thead>
				<tr>
					<th width="30">
						选择
					</th>
					<th>标题</th>
					<th>描述</th>
					<th>状态</th>
					<th>排序</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($paper as $k=>$v){ ?>
				<tr>
				<td> 
				<input type="checkbox" class="select-checks " name="id[]" value="<?php echo $v['id']; ?>">
				</td>
				<td class="ta-left"><?php  echo $v['typeName'] ?> </td>
				<td><?php  echo $v['intro'] ?> </td>
				<td><?php if($v['isdisplay']==1){echo '显示';}else{ echo '隐藏';} ?></td>
				<td>
				<?php if($k!=0){?>
                    <a href="<?php echo M_URL($this->AppName.'/Index','updatetype',$v['id'],GP('')); ?>"><i class="iconfont icon-top"></i></a>
				<?php }?> &nbsp; 
				<?php if($k!=count($paper)-1){?>
					<a href="<?php echo M_URL($this->AppName.'/Index','downtype',$v['id'],GP('')); ?>"><i class="iconfont icon-bottom"></i></a>
			    <?php }?>
				</td>
			
				
				<td class="ks-head-el">
				 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
									
							<li>
								 <a href="<?php echo M_URL($this->AppName.'/Index','edittype',$v['id'],GP('')); ?>" > 编辑</a>
							</li>
							<li>
								 <a href="javascript:void(0);" onclick="Confirm('是否删除此类型？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delPaperType',$v['id'],GP('')); ?>')">删除</a>
							</li>
							
							
							
						</ul>
						</div>
					</td>
				</tr>
				 <?php } ?>
			</tbody>
			</table>
			<?php echo NoC($paper);?>
			<input type="hidden" name="batch" id="batch1" />
			<?php if(!empty($paper)){?>
			<div  class="ks-bom clearfix">
				<div class="fl">
					<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
					<button type="button" class="ks-heade-button fl" onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i></button>
				</div>
				<div class="fr">
					<?php echo $page->show(3); ?>
				</div>
	
			</div>
	 <?php } ?>
			</form>





<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.require(['$','backstage','nicescroll'],function(){
		 	loadScorllJs();
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
	}	
	
</script>


</body>
</html>
