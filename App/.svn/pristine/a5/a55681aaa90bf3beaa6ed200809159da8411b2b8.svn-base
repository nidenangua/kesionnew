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
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		
		
		<!--/widget-->
	     <div class="clearfix ks-top-tab mb20"> 
	     	<form target="hidframe">
	     	<div class="fl">
				<select class="w150 inputText bRadius5" id="keytype">
					<option value="1" <?php if(isset($keytype) and $keytype==1)echo 'selected';?>>关键字</option>
				</select>
				<div class="ks-top-search fr">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword))echo $keyword; ?>">
		            <button class="ks-head-search"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','reply'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></span>  
				</div>
			</div>
			<div class="fr">
				<a class="ks-bt bt-pue mr10" href="<?php echo M_URL($this->AppName.'/Index','focusReplyNow','',GP('')); ?>">关注时回复</a>
				<a class="ks-bt bt-pue  " href="<?php echo M_URL($this->AppName.'/Index','addKeyReply','',GP('')); ?>"><i class="iconfont icon-jiahao"></i>关键词添加规则</a>                   
			</div>
			</form>
			
		</div>	
		
		<!--table-->
		<!--第一块-->
		<div id= "keywordpage" class="configTab" style="display:block;">
		<div class="infoBox">
		<div class=" webConBox ">
		<div class=" clearfix" >
		<form target="hidframe" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','bathDelAutoReply','',GP("p-$page->now_page"));?>" method="post">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
		<thead>
		<tr>
		<th style="width:30px;">选择</th>
		<th>序号</th>
		<th>规则</th>
		<th>关键字</th>
		<th>回复内容</th>
		<th>回复课程/班级</th>
		<th class="alignCenter hLh40 pt0 pb0 fsize14 " >操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($values as $k=>$v){ ?>
			<tr>
			<td class="alignLeft hLh40 pt0 pb0 fsize14 c-92 ">
			<input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>" >			
			</td>
			<td><?php echo $k;?></td>
			<td><?php echo $v['rule'];?></td>
			<td><?php echo $v['keyword']?></td>
			<td><?php if(isset($v['contents'])){echo  Field(mb_substr($v['contents'],0,20,'utf-8'));}else{echo "----";}?></td>
			<td><?php if(isset($v['title'])){echo Field($v['title']);}else{echo "----";}?></td>
			<td class="ks-head-el">
				 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
									
							<li>
								<a class="btn-as" href="<?php echo M_URL($this->AppName.'/Index','editKeyReply',$v['id'],GP("p-$page->now_page")); ?>">编辑</a>
							
							</li>
							<li>
							<a href="javascript:void(0);"  onclick="Confirm('是否删除此粉丝？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delAutoReply',$v['id'],GP('p-'.$now_page)); ?>')">删除</a>
							
							</li>
							
							
							
						</ul>
					</div>
				</td>
			</tr>
		<?php }?>
		</tbody>
		</table>
		</form>
		<?php echo NoC($values);?>
		</div>
		</div>
		</div>
		</div>
		<!--第一块-->
	    <!--/table-->
	    <?php if(count($values)!=0){?>
		<!--footer-->
		<div class="ks-bom clearfix">
		<span class="form-pages">
			<label for=""><input name="allChecked" type="checkbox" value="allChecked" class="checkall check-all" id="selectAll">全选</label>
				<button class="ks-heade-button mr10" onclick="do_reg()"><i class="iconfont icon-shanchu1"></i></button>
			<span class="fr"><?php echo $page->show(3);?></span>
		</span>
		</div>
		<!--/footer-->
		<?php } ?>
	</div>
	
	
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
		$("input[name='isfocus']:radio").click(function(){

			 var url="<?php echo M_URL($this->AppName.'/Index','switchFocus','',GP(''));?>";
			 var isfocus =  $(this).val();
			 var id = $(this).attr('focusid');
			
			$.ajax({
					type:"post",
					url:url,
					data:{isfocus:isfocus,id:id},
					
					success:function(data,textStatus){
						Alert(data);
					},
					error:function(){
						Alert("发生了错误,请检查!");
						}
				})
			
			})
	});


function DoCheck() {
	var ch=document.getElementsByName("id[]");
	if(document.getElementsByName("allChecked")[0].checked==true)
	{
		for(var i=0;i<ch.length;i++)
		{
			ch[i].checked=true;
		}
	}else{
		for(var i=0;i<ch.length;i++)
		{
			ch[i].checked=false;
		}
	}
}


  
 
 
 function do_reg()
{   
	$('#myform').submit();
}
</script>
</body>
</html>