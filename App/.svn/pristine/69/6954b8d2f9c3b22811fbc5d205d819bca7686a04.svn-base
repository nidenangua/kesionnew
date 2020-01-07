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
				<h3 class="ks-head-title"><?= $team['title'];?> - 话题列表

				</h3>
			</div>
            <!--header-->

				<!--widget-->
			<div class="ks-head-widget clearfix">
				<div class="fl">
                    <form target="hidframe">
                        <div class="ks-search-box">

                            <select class="w150 inputText bRadius5 fl" id="keytype">
                                <option value="1" <?php if($keytype==1) echo "selected"; ?>>标题</option>
                                <option value="2" <?php if($keytype==2) echo "selected"; ?>>呢称</option>
                            </select>
                            <div class="ks-top-search fl" >
                                <input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 		<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','topicList',$id); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
                            </div>

                        </div>

                    </form>
					
							
					
				</div>
				
				
					<div class="fr">
						<ul class="ks-head-choice">
						

						</ul>
					</div>
				</div>
			
			<!--/widget-->
				
			<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('db-2,p-'.$page->now_page)) ?>" method="post">
	<!--table-->
		
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
            <thead>
                <tr>
                	<th>选择</th>
                    <th>标题</th>
                    <th>呢称</th>

                    <th>添加时间</th>
                    <th>是否开放</th>
                    <th>是否精选</th>
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($values as $k=>$v){?>
            <tr>
            <td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['id'];?>"></td>
            	 <td><?php echo Field($v['title']);?></td>
            	 <td><?php echo Field($v['realname']);?></td>

            	 <td><?php echo date('Y-m-d H:i:s',$v['create_time']);?></td>
            	 <td><span class="link-switch<?php if($v["status"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Ajax','updatestatus',$v['id'],GP('db-2')); ?>" data-open="<?php echo M_URL($this->AppName.'/Ajax','updatestatus',$v['id'],GP('db-2')); ?>"><i></i></span></td>
            	 <td><span class="link-switch<?php if($v["is_hot"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Ajax','updatehot',$v['id'],GP('db-1,hot-'.$v['is_hot'])); ?>" data-open="<?php echo M_URL($this->AppName.'/Ajax','updatehot',$v['id'],GP('db-1,hot-'.$v['is_hot'])); ?>"><i></i></span></td>
                 <td><?php echo $v['check']==0?'<span>未审核</span>':($v['check']==1?'<span style="color: #0a60d6">通过</span>':'<span style="color: red">拒绝</span>');?></td>
            	 <td class="ks-head-el">
				 	<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
                            <li>
                                <a href="<?php echo M_URL($this->AppName.'/Index','editTopic',$v['id'],GP('p-'.$page->now_page));?>">查看</a>
                            </li>
							<li>
								<a href="javascript:void(0);" onclick='Confirm("是否删该话题？该操作不可逆","<?php echo M_URL($this->AppName.'/Index','delete',$v['id'],GP('db-2'));?>")'>删除</a>
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
      <?php if(!empty($values)){?>
      	<input type="hidden" name="batch" id="batch1" />
		<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
				<button class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
				<button class="ks-heade-button mr10" onClick="submitform(2)">批量审核</button>
<!--				<button class="ks-heade-button " onClick="submitform(3)">取消审核</button>-->
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
			
		</div>
	<?php }?>

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
	inspectionCheckBox('check[]',function(){
		$('#batch1').val(type);
		if(type===1){
            <?php echo M_URL($this->AppName.'/Index','batch',$id,GP('p-'.$page->now_page)) ?>
            $('#myform').attr('action',url);
			top.popup.confirm('确认要删除所选项吗？',{
				determine:function(){
					$('#myform').submit();
				}
			})
		}else if(type===2){
		    url = "<?php echo M_URL($this->AppName.'/Ajax','check',$id,GP($page->now_page)) ?>";
            $('#myform').attr('action',url);
            top.popup.confirm('确认要批量审批？',{
                determine:function(){
                    $('#myform').submit();
                }
            })
		}
	})
};
function attributeSelect(url){    
	window.location.href=''+url;
}
</script>
</body>
</html>