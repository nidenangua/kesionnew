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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash()?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">  
<div class="ks-wbox bRadius10">
	<!--header-->
	<?php $title=CourseModel::$courseType[$this->courseType];?>
	<div class="ks-head-box clearfix">
		<h3 class="ks-head-title2">
			<?php echo $title;?>管理
			<div class="fr">
				<?php if($courseType==9){ ?>	
				<!--<span class="fl name-nowrap">
 				您当前允许最大并发数<font class="c-86A8F"><?php echo getLianmai($this->wxid); ?></font><i class="iconfont icon-iconfontwenhao">
				<div class="ks-remind"> 直播并发指直播<?php echo $title;?>时同一瞬间整个机构同时上课允许进入听课的学生最大总人数 </div></i>
 			    </span>			
				<a class="ks-setting-icon ks-setting-icon1 fl ml10"   href="<?php echo M_URL('Shop','coludmanage',6); ?>"> 购买并发数</a>
				<span class="fl name-nowrap">	
 					您当前还剩余<font class="c-86A8F"><?php echo number_format(getLimitService(6),2);?></font>连麦币 <i class="iconfont icon-iconfontwenhao" style="display: inline-block;height: 40px;"><div class="ks-remind" style="left: -150px;">连麦币指通过互动课堂老师和学生连麦学习时产生的费用，按连麦时长计费。具体计费规则：<a href="<?php echo M_URL('Shop','index','',GP('')); ?>" style="color: #e5412c;">点击查看</a>。	</div></i>
 				</span>	
 				<a class="ks-setting-icon ks-setting-icon1 fl ml10"   href="<?php echo M_URL('Shop','coludmanage',5); ?>"> 购买连麦币</a>	-->
				<?php } ?>
				<?php if($courseType==2){ ?>
					<span class="fl name-nowrap">
 						您当前还剩余<font class="c-86A8F"><?php echo number_format(getLimitService(6),2);?></font>直播币 <i class="iconfont icon-iconfontwenhao" style="display: inline-block;height: 40px;"><div class="ks-remind" style="left: -150px;">直播币指通过互动课堂老师和学生连麦学习时产生的费用，按连麦时长计费。具体计费规则：<a href="<?php echo M_URL('Shop','coludmanage','5',GP('')); ?>" style="color: #e5412c;">点击查看</a>。	</div></i>
 					</span>
					<a class="ks-setting-icon ks-setting-icon1 fl ml10"   href="<?php echo M_URL('Shop','coludmanage',5); ?>"> 购买直播币</a>
				<?php }else{ ?>
                    <?php if ($courseType!=6&&$courseType!=8){
                        ?>
                        <span class="fl name-nowrap">
     				剩余空间<font class="c-86A8F"><?php echo showAvailableSpace($this->wxid);?></font><?php if($courseType==1){ ?>，剩余流量<font class="c-86A8F"><?php echo format_gt(getVodAvailableTraffic($this->wxid));?></font>，剩余转码时长<font class="c-86A8F"><?php echo Sec2Time(getLimitService(7));?></font><?php } ?><i class="iconfont icon-iconfontwenhao"><div class="ks-remind" style="min-width: 200px;">空间详情：用于存储视频、图片等的空间。高级运营版空间无限时，建议及时升级。<?php if($courseType==1){ ?></br>流量：用于点播产生的视频流量</br>转码：用于视频上传后的转码费用，可对视频进行加密防盗，应用设置中开启，上传珍贵视频建议开启此功能。<?php } ?></div></i>
     		    </span>
                        <?php
                    }
                    ?>
					<!--
				<a class="ks-setting-icon ks-setting-icon1 fl ml10"   href="<?php echo M_URL('Shop','coludmanage',3); ?>">升级空间 </a>
                -->
					<?php if (checkIsVip($this->wxid)!="v1" &&$courseType!=6&&$courseType!=8) {?>
						<a class="ks-setting-icon ks-setting-icon1 fl ml10" href="<?php echo M_URL('Service','upgrade'); ?>">获空间扶持</a>
					<?php }?>
					<?php if($courseType==1){ ?>
						<a class="ks-setting-icon ks-setting-icon1 fl ml10"   href="<?php echo M_URL('Shop','coludmanage',4); ?>"> 购买流量</a>
						<a class="ks-setting-icon ks-setting-icon1 fl ml10"   href="<?php echo M_URL('Shop','coludmanage',7); ?>"> 购买转码时长</a>
					<?php } ?>
				<?php }?>



				<a class="ks-setting-icon fl ml10" type="button"  onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>,types:<?php echo $courseType; ?>})" ><i class="iconfont icon-setting"></i></a>
                <a class="ks-setting-icon fl ml10" target="_blank" href="https://www.kesion.com/store_help_course/<?php if($courseType==1){echo 47477;}elseif($courseType==2){echo 47480;}elseif($courseType==3){echo 47478;}elseif($courseType==4){echo 47479;}?>">
                    <i class="iconfont icon-qm"></i>
                </a>											
			</div>	
		</h3>
	</div>

	<?php if($courseType==2){ ?>
	<div class="ks-head-tab">
		<ul class="clearfix">
			<li <?php if($this->livetype==4){?>class="curr"<?php }?>><a href="<?php echo M_URL('course/Index','index','',GP('appid-6,livetype-4,courseType-2')); ?>" >语音直播</a></li>
			<li <?php if($this->livetype==1){?>class="curr"<?php }?>><a href="<?php echo M_URL('course/Index','index','',GP('appid-6,livetype-1,courseType-2')); ?>">一对一视频直播</a></li>
			<li <?php if($this->livetype==2){?>class="curr"<?php }?>><a href="<?php echo M_URL('course/Index','index','',GP('appid-6,livetype-2,courseType-2')); ?>">小班视频直播</a></li>
			<li <?php if($this->livetype==3){?>class="curr"<?php }?>><a href="<?php echo M_URL('course/Index','index','',GP('appid-6,livetype-3,courseType-2')); ?>">千人视频直播</a></li>
		</ul>
	</div>
	<?php }?>
	<!--header-->
	<?php 
    if(isset($setting[0])&&$setting[0]==1){?>
	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="fl">
			<div class="ks-search-box">
				<!--搜索框组件-->
				<form target="hidframe">
					<div class="ks-top-search fl">
					<input type="text" class="sc-text ml0" name="searchText" id="keyword" placeholder="请输入搜索标题" value="<?php if(isset($keyword)) echo $keyword; ?>">
					<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
					</div>
				</form>
				<!--搜索框组件-->
			</div>					
		</div>
		<div class="fl ks-head-tbox">
			<input type="text" id="selectTime" class="ks-head-input ks-head-time w300 ml20" placeholder="<?php if(empty($start)) echo '自定义时间段' ?>"/>
			<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
		</div>
		<div class="fr">
			<ul class="ks-head-choice">
			<li>
			<div class="ks-head-el">
				<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
				<div class="ks-head-content ks-head-content-pr w400">
				<ul class="screen">
					<li>													
						<span style="margin-left: -20px"><?php echo $title;?>状态：</span>
						<div>
						<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-3'));  ?>">不限</a>
						<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-2'));  ?>">已上架</a>
						<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-0'));  ?>">未上架</a>
						<!--<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-0'));  ?>">未审核</a>-->
						</div>
					</li>
					<?php if($setting[2]==1){ ?>
<!--					<li>-->
<!--						<span>--><?php //echo $title;?><!--类型：</span>-->
<!--						<div>-->
<!--							<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('classType-4'));  ?><!--">不限</a>-->
<!--							<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('classType-1'));  ?><!--">英语口语</a>-->
<!--							<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('classType-1'));  ?><!--">应用数学</a>-->
<!--							<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('classType-1'));  ?><!--">软件工程</a>-->
<!--							<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('classType-1'));  ?><!--">计算机</a>-->
<!--							<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('classType-1'));  ?><!--">艺术</a>-->
<!--						</div>-->
<!--					</li>-->
					<?php }?>
				</ul>
				</div>
			</div>
			</li>
			<li>
			<div class="ks-head-el">
				<?php if ($courseType == 6) {?>
				<?php if (check_power1($this->userinfo,$this->key,'1')) {?>

					<a href="javascript:;" class="ks-heade-button ks-head-primary" onclick="top.KTJ_RouteJump('/activityregist/addactivity')" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,6,false,true);?>'})">
                    <i class="icon-jiahao iconfont "></i>添加活动
					</a>
				<?php }?>
				<?php }elseif ($courseType == 8){ ?>
                        <a href="javascript:;" class="ks-heade-button ks-head-primary" onclick="top.KTJ_RouteJump('/goodsset')" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,6,false,true);?>'})">
                            <i class="icon-jiahao iconfont "></i>商品规格组设置
                        </a>
                        <a href="javascript:;" class="ks-heade-button ks-head-primary" onclick="top.KTJ_RouteJump('/addmerchandise')" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,6,false,true);?>'})">
                            <i class="icon-jiahao iconfont "></i>添加商品
                        </a>
                    <?php
                }else{ ?>
                <a <?php if($setting[3]==0){?> href="<?php echo M_URL($this->AppName.'/Index','basics',0,GP(""));?>" <?php }else{?> onclick="addTypeChange('<?php echo M_URL('course/Index','addcourse','',GP(''))?>','650px','280px',{type:'top',title:'添加<?php echo $title;?>'})" <?php }?> class="ks-heade-button ks-head-primary" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,6,false,true);?>'})">
                    <i class="icon-jiahao iconfont "></i>添加<?php if ($this->courseType==2){echo CourseModel::$liveType[$this->livetype];}else{echo $title;} ?>
                </a>
				<?php }?>
				

			</div>
			</li>
				<?php if($this->courseType==1){?>
				<li>
				<div class="ks-head-el">
                    <a href="javascript:" onclick="top.KTJ_RouteJump('/getVodList?action=list')" class="ks-heade-button ks-head-primary" type="button" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,6,false,true);?>'})">媒资库</a>
				</div>
			</li>
				<?php }?>
			<?php if(iscategory($this->wxid,$this->appid,$this->courseType)||$courseType ==8){?>
			<li>
			<div class="ks-head-el">
                <?php
                    if ($courseType==8){
                        ?><a class="ks-heade-button ks-head-primary" href="<?php echo M_URL('category/Index','index3','',GP('appid-2'));?>">分类管理</a><?php
                    }else{
                        ?><a href="<?php echo M_URL('category/Index','','',GP('appid-2'));?>" class="ks-heade-button ks-head-primary" type="button">分类管理</a><?php
                    }
                ?>
				<!--<?php echo M_URL('course/Index','doaddcourse','',GP('entry-2')) ?>-->
			</div>
			</li>
			<?php }?>
			<li>
			<div class="ks-head-el" style="display: none;">
				<a href="<?php echo M_URL('vod/Index','playSetting','',GP('appid-5'));?>" class="ks-heade-button ks-head-primary" type="button"><i class="iconfont icon-zhibo fl" style="font-size:18px"></i> 播放器</a>
			</div>
			</li>
			</ul>
		</div>
	</div>
	<!--/widget-->
	<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" >
	<!--table-->
	<table class="ks-table">
		<thead>
			<tr>
			<th style="min-width:60px;">选择</th>
			<th style="text-align: left;min-width:60px;"><?php echo $title;?>标题</th>
			<?php if($setting[3]==1){?><th>主讲老师</th><?php }?>
				<?php if($courseType!=6){ ?>
            <?php if ($courseType ==8){
                    ?><th>购买人数</th><?php
                    }else{
                        ?><th>学员数量</th><?php
                    }
            ?>
			<th style="width: 80px;">
			<?php if($commoncount == 0 ){ ?>
			<a  class="desc" href="<?php echo M_URL('course/Index','index','',GP('commoncount-1'))  ?>" >价格<i class="desc-i"></i></a>
			<?php }else{ ?>
			<a class="asc" href="<?php echo M_URL('course/Index','index','',GP('commoncount-0'))  ?>">价格<i class="asc-i"></i></a>
			<?php } ?>		
			</th>
				<?php }?>
				<?php if ($courseType==6) {?>
					<th style="min-width:60px;">活动时间</th>
					<th style="min-width:60px;">报名人数</th>
					<th style="min-width:60px;">报名成功</th>
					<th style="min-width:60px;">待审核</th>
					<th style="min-width:60px;">状态</th>
				<?php }?>
				<?php if($courseType!=6 && $courseType !=8){ ?>
			<th>连载</th>
				<?php }?>
			<?php if($courseType==2){ ?>
			<th>上课</th>
			<?php }?>
			<th style="min-width:60px;">添加时间</th>
            <?php
            if ($courseType==8){
                ?><th style="min-width:60px;">库存</th><?php
            }
            ?>
			<th style="min-width:60px;">推广</th>
			<?php if (check_power1($this->userinfo,$this->key,'up')) {?>
			<th style="min-width:60px;">是否上架</th>
			<?php } ?>
			<th style="min-width:60px;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($course as $v){ ?>
			<tr>
				<td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['courseid'];?>"></td>
				<td style="text-align: left;"><a href="<?php echo $v['jumpurl'];?>" target="_blank"><?php echo $v['title'];?></a> <?php if ($courseType==5&&$v['json']['is_dingjin']==1) {?> <span style="    border: 1px solid #e5412c;
    padding: 2px; color: #e5412c;font-size: 12px;">订金</span><?php }?></td>
				<?php if($setting[3]==1){?><td><?php echo $v['speakerteacher'];?></td><?php }?>
				<?php if ($courseType!=6) {?>
				<td><?php echo $v['studentcount'];?></td>
				<?php }?>
				<?php if ($courseType==6) {?>
					<td><?php echo $v['json']['date'];?></td>
					<td><?php echo $v['json']['all_num'];?></td>
					<td><?php echo $v['json']['success_num'];?></td>
					<td><?php echo $v['json']['nocheck_num'];?></td>
					<td><?php echo $v['json']['status'];?></td>
				<?php }?>
				<?php if ($courseType!=6) {?>
				<td><?php if($v['chargetype']==2){echo '打赏';}elseif($v['chargetype']==0){echo '免费';}else{echo $v['price'];} ?></td>
				<?php }?>
				<?php if ($courseType!=6 && $courseType !=8) {?>
				<td>
				<?php 
                if($v['coursehour']==1){?>
				<a title="连载课" href="<?php echo M_URL($this->AppName.'/Index','period',$v['courseid'],GP(''));?>" ><?php echo $v['keshicount'] ?></a>
				<?php }else{
                    echo '单'.$title;
                }?>
				</td>
				<?php }?>
				<?php if($courseType==2){ ?>
				<td>
<!--					<a href="javascript:addTypeChange('--><?php //echo M_URL($this->AppName.'/Index','shangke',$v['courseid'],GP(''));?><!--','700px','400px',{title:'开始上课'});" ><i class="iconfont icon-dashboard"></i></a>-->
					<a href="javascript:submitform1(<?php echo $v['courseid'];?>)"><i class="iconfont icon-dashboard"></i></a>

				</td>
				<?php } ?>
				<td><?php echo date('y/m/d H:i:s',$v['adddate']);?></td>
                <?php
                if ($courseType==8){
                    ?><td><?php echo $v['json']['stock'];?></td><?php
                }
                ?>
				<td>
					<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['courseid'],GP(''));?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a>
				</td>
				<?php if (check_power1($this->userinfo,$this->key,'up')) {?>
				<td>
				<span class="link-switch<?php if($v["status"]==2){ echo ' open' ?><?php }  ?>" data-off="<?php echo M_URL($this->AppName.'/Index','down',$v['courseid'],GP('p-'.$page->now_page));?>" data-open="<?php echo M_URL($this->AppName.'/Index','up',$v['courseid'],GP('p-'.$page->now_page)); ?>"><i></i></span>
				</td>
				<?php }?>
				<td class="ks-head-el">
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
							<?php if ($courseType==6) {?>
								<?php if (check_power1($this->userinfo,$this->key,'3')) {?>
								<li><a href="javascript:;" onclick="top.KTJ_RouteJump('/activityregist/signinmanage?id=<?php echo $v['courseid']; ?>')">报名/签到</a></li>
								<?php }?>
								<?php if (check_power1($this->userinfo,$this->key,'2')) {?>
								<li><a href="javascript:;" onclick="top.KTJ_RouteJump('/activityregist/addactivity?id=<?php echo $v['courseid']; ?>')">编辑</a></li>
								<?php }?>
							<?php }elseif ($courseType==8){
                                ?>
                                    <li><a href="javascript:;" onclick="top.KTJ_RouteJump('/addmerchandise?courseid=<?php echo $v['courseid']; ?>')">编辑</a></li>
                                <?php
                            }else{?>
							<li><a href="<?php echo M_URL($this->AppName.'/Index','basics',$v['courseid'],GP(''));?>">编辑</a></li>
							<?php }?>
							<?php if($v['coursehour']==1&&$this->livetype!=2){?>
							<li ><a href="<?php echo M_URL($this->AppName.'/Index','period',$v['courseid'],GP(''));?>"><?php echo $courseType==5?'课时':'连载';?></a> </li>
							<?php }?>
							<li><a href="<?php echo $v['jumpurl'];?>" target="_blank">预览</a></li>
							<?php if($courseType!=4&&$courseType!=3&&$setting[3]==1) {?>
							<li class="w20b"> <a href="<?php echo M_URL($this->AppName.'/Index','exam',$v['courseid'],GP(''));?>">试卷</a> </li>
							<?php }?>
							<?php if ($courseType!=5&&$courseType!=6&&$courseType!=8) {?>
                            <li>
                                <a href="javascript:;" onclick="top.KTJ_RouteJump('/course/<?php echo $v['courseid'];?>/data')">资料</a>
                            </li>
                            <li>
                                <a href="<?php echo M_URL($this->AppName.'/Index','teacher',$v['courseid'],GP(''));?>">老师</a>
                            </li>
                            <li>
                                <a href="<?php echo M_URL($this->AppName.'/Index','student',$v['courseid'],GP('')) ?>">学员</a>
                            </li>
							<?php }?>
							<?php if ($courseType==5) {?>
                            <li><a href="javascript:;" onclick="top.KTJ_RouteJump('/course/<?php echo $v['courseid'];?>/data')">资料</a></li>
                            <li><a href="<?php echo M_URL($this->AppName.'/Index','student',$v['courseid'],GP('')) ?>">学员</a></li>
							<li><a href="<?php echo M_URL($this->AppName.'/Index','signlist',$v['courseid'],GP('courseType-'.$courseType)) ?>">签到</a></li>
							<?php }?>
							<?php if ($courseType==2&&($this->livetype==3||$this->livetype==4)) {?>
								<li><a href="<?php echo M_URL($this->AppName.'/Index','signlist',$v['courseid'],GP('courseType-'.$courseType)) ?>">报名</a></li>
							<?php }?>
							<li > <a href="javascript:Confirm('是否删除此<?php echo $title;?>？该操作不可逆！','<?php echo M_URL($this->AppName.'/Index','delect',$v['courseid'],GP('p-'.$page->now_page)); ?>')"> 删除</a> </li>
						</ul>
					</div>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php echo NoC($course);?>
	<!--/table-->
	<?php if(!empty($course)) {?>
	<input type="hidden" name="batch" id="batch1" />
	<div class="ks-bom clearfix">
		<div class="fl">
			<label class="mr20 fl"><input type="checkbox" class="selectAll" >全选</label>
			<button type="button" class="ks-heade-button mr10" onclick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
			<button type="button" class="ks-heade-button mr10" onclick="submitform(2)" >批量上架</button>
			<button type="button" class="ks-heade-button" onclick="submitform(3)" >取消上架</button>
		</div>
		<div class="fr">
			<?php echo $page->show(3); ?>
		</div>
	</div>	
	<?php } ?>
	</form>
	<?php }else{?>
	<div class="unopened">
		您还没有启用<?php echo $title;?>功能！
		<a class="ks-bt bt-pue" href="javascript:void(0);" onclick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid;?>,wxid:<?php echo $this->wxid;?>,types:<?php echo $courseType; ?>})">立即开启</a>
	</div>	
	<?php }?>
</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','laydate'],function(){
	var start = '<?php if($timetype==5){echo $start;} ?>';
	var end   = '<?php if($timetype==5){echo $end;} ?>';
	if(start && end){
		document.getElementById('selectTime').value = start.match(/[^\s]+/) +' - '+ end.match(/[^\s]+/)
	};
	/*time*/
	laydate.render({
	  elem: '#selectTime',
	  format:'yyyy/MM/dd',
	  range: true,
	  done:function(value){
	  	var href = location.href.replace(/,timetype-\d+,starttime-\d+,endtime-\d+/g,'');
	  	if(value){
	  		value = value.split(' - ');
	  		var starttime = new Date(value[0]).getTime()/1000;
	  		var endtime = new Date(value[1]).getTime()/1000;
	  		location.href = href+',timetype-5,starttime-'+starttime+',endtime-'+endtime;
	  	}else{
	  		location.href = href;
	  	}
	  }
	});
	$('.link-switch').each(function(){
		<?php if ( check_power1($this->userinfo,$this->key,$this->key.'|up')){ ?>
			is_power = true;
		<?php }else {?>
			is_power = false;
		<?php }?>
		setLinkSwitch(this,is_power)
	})
});
function submitform1(courseid){
	url = '<?php echo wx_Url($this->wxid).'/Json/index.php?act=Home.getCourseStatus';?>';
	livetype = '<?php echo $this->livetype;?>';
	courseType = '<?php echo $this->courseType;?>';
	$.post(url,{courseid:courseid},function (res) {
		if (res.status==2){
			addTypeChange('/home.html/course/Index/shangke/'+courseid+'?appid-6,livetype-'+livetype+',courseType-'+courseType,'700px','400px',{title:'开始上课'})
		}else {
			Alert('课程未上架');
		}
	},'json');
}
function submitform(type){
	inspectionCheckBox('check[]',function(){
		$('#batch1').val(type);
		$('#myform').submit();

	})
};
</script>
</body>
</html>


