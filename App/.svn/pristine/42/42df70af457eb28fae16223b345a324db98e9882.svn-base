<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>专栏管理</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>

<style type="text/css">
.Porel{ position: relative;}
.Poabs{ position: absolute;}
.Pofix{ position: fixed;}
.ToPr1812{top: -17px; right: -12px;opacity: 0; transition: all 0.6s;color: black;}
#knowledge li{ padding:10px 15px  2px 0px; float: left;}
#knowledge li :hover .ToPr1812{ opacity: 1;}
.topCourseBox { padding: 20px 420px 0px 200px;position: relative; background: #FFFFFF;border-top:1px solid #eee}   
.topCourseBox-right{position: absolute;height: 120px; top: 0px; right: 0px;}
.topCourseBox-bottom{position: absolute;height: 30px; bottom: 20px; right: 0px; line-height: 30px; width: 420px;}
.topCourseBox-img{width: 190px; height: 130px; position: absolute; left: 0px; top: 20px; cursor:pointer;}   
.Tabcrow{ width: 600px;}  
.topCourseCont{ position: relative; padding-left: 240px;}   
.topCourseCont-left{position: absolute;  left: 20px; top: 0px; height:100%;}  
.topCourseCont-right{ height:130px; overflow: auto; position:relative ; left:150px;} 
.choice-active {
    color: #e5412c;
}
</style>
<body class="ks-wrap">  
<div class="ks-wbox bRadius10">
	<!--header-->
	
	<div class="ks-head-box clearfix">
		<h3 class="ks-head-title2">
               专栏管理  
               <div class="fr">
               <a class="ks-setting-icon fl ml10" type="button" onClick="appSetUp({title:'应用设置',type:'app',appid:6,wxid:2,types:1})"><i class="iconfont icon-setting"></i></a>
               <a class="ks-setting-icon fl ml10" target="_blank" href="https://www.kesion.com/store_help_course/47481"><i class="iconfont icon-qm"></i></a>
               </div>
		</h3>
	</div>
	<!--header-->

	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="fl">
			<div class="ks-search-box">
				<!--搜索框组件-->
				<form target="hidframe">
					<div class="ks-top-search fl" >
						<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
						<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
					</div>
				</form>
				<!--搜索框组件-->
			</div>					
		</div>
		<!-- <div class="fl ks-head-tbox">
			<input type="text" id="selectTime" class="ks-head-input ks-head-time w300 ml20" placeholder="自定义时间段"/>
			<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
		</div> -->
		<div class="fr">
			<ul class="ks-head-choice">
			<li>
				<div class="ks-head-el">
					<button class="ks-heade-button ks-head-primary" type="button" onClick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
					<div class="ks-head-content ks-head-content-pr w400">
						<ul class="screen">		
							<li>													
								<span>状态：</span>
								<div>
									<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-3')); ?>" class="<?php if($status==3){echo 'choice-active';}?>">不限</a>
									<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-2')); ?>" class="<?php if($status==2){echo 'choice-active';}?>">已上架</a>
									<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-0')); ?>" class="<?php if($status==0){echo 'choice-active';}?>">未上架</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</li>
			<li>
				<div class="ks-head-el">
                    <a href="<?php echo M_URL($this->AppName.'/Index','addcolumn','',GP('')); ?>" class="ks-heade-button ks-head-primary" type="button" onClick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,106,false,true);?>'})">
                        <i class="icon-jiahao iconfont "></i>添加专栏
                    </a>   
				</div>
			</li>
		
		
			</ul>
		</div>
	</div>
	<!--/widget-->
	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','change','',GP('p-'.$page->now_page));  ?>" method="post" id="myform" >
	<!--table-->
	<table class="ks-table">
		<thead>
			<tr>
			<th>选择</th>
			<th style="text-align:left">选择名称</th>
			<th>价格</th>
			<th>销售量</th>
			<th>更新期数</th>		
			<th>推广</th>
				<?php if (check_power1($this->userinfo,'column','audited')) {?>
				<th>是否上架</th>
				<?php }?>
			<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($values as $k => $v) { ?>
			<tr>
				<td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['columnid']; ?>"></td>
				<td style="text-align: left;"><a href="/?f=pc#/column/<?php echo $v['columnid'];?>" target="_blank"><?php echo $v['title']; ?></a></td>
				<td><?php if($v['chargetype']==2){echo '打赏';}elseif($v['price']==0){echo '免费';}else{echo '￥'.$v['price'];} ?></td>
				<td><?php echo $v['soldnum']; ?></td>
				<td><?php echo $v['nper']; ?></td>
				<td>
					<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['columnid'],GP(''));?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a>
				</td>
				<?php if (check_power1($this->userinfo,'column','audited')) {?>
				<td>
				   <span class="link-switch<?php if($v['status'] == 2){ echo ' open'; } ?>" data-off="<?php echo M_URL($this->AppName.'/Index','audited',$v['columnid'],GP('status-0,p-'.$now_page));?>" data-open="<?php echo M_URL($this->AppName.'/Index','audited',$v['columnid'],GP('status-2,p-'.$now_page)); ?>"><i></i></span>
				</td>
				<?php }?>
				<td class="ks-head-el">
					<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
							<li ><a href="<?php echo M_URL($this->AppName.'/Index','serialization',$v['columnid'],GP('')); ?> ">连载内容</a></li>
						
							<li ><a href="<?php echo M_URL($this->AppName.'/Index','addcolumn',$v['columnid'])?>">编辑专栏</a> </li>

                            <li ><a href="<?php echo M_URL('course'.'/Index','student',$v['columnid'],GP('courseType-11'))?>">学员</a> </li>
						
							<li > <a href="javascript:Confirm('是否删除此专栏？该操作不可逆！','<?php echo M_URL($this->AppName.'/Index','audited',$v['columnid'],GP('p-'.$page->now_page.',status-3')); ?>')"> 删除</a> </li>
						</ul>
					</div>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<?php echo Noc($values); ?>
	<!--/table-->

	<input type="hidden" name="statusType" id="batch1" />
	<div class="ks-bom clearfix">
		<div class="fl">
			<label class="mr20 fl"><input type="checkbox" class="selectAll" >全选</label>
			<button type="button" class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
			<button type="button" class="ks-heade-button mr10" onClick="submitform(2)" >批量上架</button>
			<button type="button" class="ks-heade-button" onClick="submitform(3)" >取消上架</button>
		</div>
		<div class="fr">
		    <?php echo $page->show(3); ?>
		</div>
	</div>	
	
	</form>

</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','laydate'],function(){

	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
});
function submitform(type){
	inspectionCheckBox('check[]',function(){
		$('#batch1').val(type);
		$('#myform').submit();

	})
};
</script>
</body>
</html>


