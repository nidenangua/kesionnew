<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet" />

</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
			<div class="ks-head-box clearfix">
				<h3 class="ks-head-title"><?php echo getCourseTypeName($courseType);?> / <span style="font-size: 14px"><?php echo $courseType==5?''.$course_data['title'].'/签到':'报名';?>管理</span>
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
						<?php if ($courseType==5) {?>
						<!--搜索框组件-->
						<select class="w150 inputText bRadius5 fl mr10"  onchange="location.href='<?php echo M_URL($this->AppName.'/Index','signList',$this->courseid); ?>?chapterid-'+this.value;">
							<option value="0" <?php if($chapterid==0){echo 'selected="selected"';} ?>>全部</option>
							<?php foreach ($chapterList as $k=>$v) {?>
								<option value="<?php echo $v['chapterid']?>" <?php if($chapterid==$v['chapterid']) echo "selected"; ?>><?php echo $v['title'];?></option>
							<?php }?>
						</select>
						<?php }?>
						<div class="ks-top-search fl">
							<input type="text" class="sc-text" name="searchText" placeholder="姓名" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
							<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','signList',$this->courseid); ?>','<?php echo URL_MODEL;?>')">
								<i class="iconfont icon-sousuo"></i>
							</button>
						</div>
						<!--搜索框组件--></form>
				</div>
                <?php
                if ($courseType==5&&$course_data['coursehour']==0){
                   ?>
                    <div style="float: right;line-height: 3.5;border-radius: 7px;background-color: #488BFF;width: 85px;text-align: center;">
                    <a  style="color: #fff;font-size: 13px" href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share3',$this->courseid,GP(''));?>','700px','400px');">二维码签到</a>
                    </div>
                    <?php
                }
                ?>


                <?php if ($courseType==6) {?>
				<span>报名成功：<?php echo $all_count;?></span> <span>已签到：<?php echo $sign_count;?></span><span>未签到：<?php echo $nosign_count;?></span>
				<?php }?>
					<div class="fr">

						<ul class="ks-head-choice">
						<li>
							<?php if ($courseType==6) {?>
							<div class="ks-head-el">
								<button class="ks-heade-button ks-head-primary" type="button" onClick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
									<div class="ks-head-content ks-head-content-pr w300">
									<ul class="screen">
										<li>
											<span>审核状态：</span>
											<div>
												<a href="<?php echo M_URL($this->AppName.'/Index','signList',$courseid,GP("status-0,courseType-$courseType")); ?>" <?php if($status==0)echo 'class="choice-active"';?>>不限</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','signList',$courseid,GP("status-1,courseType-$courseType")); ?>" <?php if($status==1)echo 'class="choice-active"';?>>待审核</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','signList',$courseid,GP("status-2,courseType-$courseType")); ?>" <?php if($status==2)echo 'class="choice-active"';?>>已审核</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','signList',$courseid,GP("status-3,courseType-$courseType")); ?>" <?php if($status==3)echo 'class="choice-active"';?>>拒绝</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<?php }?>
						</li>
						</ul>
					</div>
				</div>

			<!--/widget-->
				
			<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batchSign','',GP('p-'.$page->now_page.',chapterid-'.$chapterid.',courseid-'.$this->courseid)) ?>" method="post">
	<!--table-->
		<?php if ($this->courseType==2&&($this->livetype==3||$this->livetype==4)) {?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
				<thead>
					<tr>
						<th>选择</th>
							<th style="text-align: left;">课时名称</th>
							<th>学生</th>
							<th>报名时间</th>
							<?php foreach ($values[0]['json'] as $k=>$v) {?>
							<th><?php echo $v['name'];?></th>
							<?php }?>


					</tr>
				</thead>
				<tbody>
				<?php foreach($values as $k=>$v){?>
				<tr>
				<td style="width: 30px;"> <input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'];?>"></td>

					<td style="text-align: left;"><?php echo Field($v['title']);?></td>
					<td><?php echo $v['username'];?></td>
					<td><?php echo KS_DATE($v['adddate']);?></td>
					<?php foreach ($v['json'] as $k1=>$v1) {?>
						<?php if ($v1['type']=='checkbox') {?>
							<td><?php echo implode('，',$v1['key_value']) ;?></td>
						<?php }else{ ?>
							<td><?php echo $v1['key_value'];?></td>
						<?php } ?>
					
					<?php }?>

				</tr>
				<?php }?>
				</tbody>
			</table>
		<?php }else{ ?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
				<thead>
				<tr>
					<th>选择</th>
					<?php if ($courseType==5) {?>
						<th style="text-align: left;">课时名称</th>
						<th>学生</th>
						<th>联系方式</th>
						<th>签到时间</th>
					<?php }else{ ?>
						<th>头像呢称</th>
						<th>姓名</th>
						<th>手机号码</th>
						<th>报名时间</th>
						<?php
                            if ($courseType==5){
                                ?>
                                <th>票种</th>
                                <th>价格</th>
                                <th>状态</th>
                                <th>签到</th>
                                <?php
                            }
                        ?>

					<?php }?>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($values as $k=>$v){?>
					<tr>
						<td style="width: 30px;"> <input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'];?>"></td>
						<?php if ($courseType==5) {?>
							<td style="text-align: left;"><?php echo Field($v['title']);?></td>
							<td><?php echo $v['username'];?></td>
                            <td><?php echo $v['mobile'];?></td>
							<td><?php echo KS_DATE($v['adddate']);?></td>
						<?php }else{ ?>
							<td><?php echo $v['username'];?></td>
							<td><?php echo $v['username'];?></td>
							<td><?php echo $v['mobile'];?></td>
							<td><?php echo KS_DATE($v['adddate']);?></td>
                            <?php
                            if ($courseType==5){
                                ?>
                                <td><?php echo $v['chargetype']==0?'免费票':'收费票';?></td>
                                <td><?php echo ChkFloat($v['price']);?></td>
                                <td><?php echo $v['status']==0?'<span style="color: red">待审核</span>':($v['status']==1?'已审核':'已拒绝');?></td>
                                <td><?php echo $v['is_sign']==0?'未签到':'已签到';?></td>
                                <?php
                            }
                            ?>

						<?php }?>
						<td class="ks-head-el">
							<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
							<div class="ks-head-content ks-head-content-pc w100">
								<ul class="opeart">
									<?php if ($v['status']==0&&$v['coursetype']!=5) {?>
										<li><a href="<?php echo M_URL($this->AppName.'/Index','batchSign',$v['id'],GP("batch-2"));?>" >通过</a></li>
										<li><a href="<?php echo M_URL($this->AppName.'/Index','batchSign',$v['id'],GP("batch-4"));?>" >拒绝</a></li>
									<?php }elseif($v['status']==1) {?>
										<?php if ($v['is_sign']==1) {?>
											<li><a href="<?php echo M_URL($this->AppName.'/Index','batchSign',$v['id'],GP("batch-5"));?>" >取消签到</a></li>
										<?php }?>
										<li><a href="<?php echo M_URL($this->AppName.'/Index','batchSign',$v['id'],GP("batch-3"));?>" >取消审核</a></li>
									<?php }elseif($v['status']==-1) {?>
										<li><a href="<?php echo M_URL($this->AppName.'/Index','batchSign',$v['id'],GP("batch-1"));?>" >删除</a></li>
									<?php }?>
                                    <?php
                                        if ($v['coursetype']==5){
                                            ?><li><a href="<?php echo M_URL($this->AppName.'/Index','batchSign',$v['id'],GP("batch-1"));?>" >删除</a></li><?php
                                        }
                                    ?>

								</ul>
							</div>
						</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
		<?php }?>


				<input type="hidden" name="batch" id="batch1" />

			</form>

	<!--/table-->
      <?php echo NoC($values);?>
      <?php if(!empty($values)){?>
		<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
				<button class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
				<button class="ks-heade-button mr10" onClick="submitform(2)">批量审核</button>
				<button class="ks-heade-button " onClick="submitform(3)">取消审核</button>
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
	$('select[name="chapterid"]').change(function () {
//		var chapterid = $(this).val();
//		window.location.href =
		$('#sousuo').submit();
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
function suosou() {
	$('#sousuo').submit();
}
function attributeSelect(url){    
	window.location.href=''+url;
}

</script>
</body>
</html>