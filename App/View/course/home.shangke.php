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
<style>
	html,
	body{
		position:relative;
		height:100%;
	}
	.share-box,
	.share-box .link{
		position:relative;
		height:100%;
		box-sizing:border-box;
	}
	.share-box .link{
		overflow-y:auto;
		overflow-x:hidden;
	}
	.link-item{
		text-align:left ;
		min-height:34px;
		line-height:34px;
		padding:10px;
		margin:0 15px;
	}
	.link-item + .link-item{
		border-top:1px solid #eee;
	}
	.link-item__name{
		font-size:14px;
		font-weight:bold;
	}
	.link-item__name span{
		color:#999;
		margin-left:10px;
		font-weight:normal;
	}
	.link-item .ks-bt{
		float:right;
	}
	.link-item__url{
		color:#5272a9;
	}
	.student-link::after{
		display:none;
	}
	.link-item .ks-bt{
		height:30px;
		line-height:30px;
		font-size:13px;
	}
	.share-box .link strong, .share-box .code strong{
		line-height:44px;
		font-size:16px;
		font-weight:normal;
	}
	.link-live-info{
		text-align:left;
		padding:0 20px;
		line-height:22px;
	}
	.link-live-info div{
		padding:10px 0;
	}
	.link-live-info a{
		color:#5085e0;
	}
</style>
</head>
<?php 
	$role = [1=>'主讲',2=>'助教',3=>'主持人'];
	$liveRoute = $this->livetype==4 ? 'audiolive' : 'videolive';
?>
<body>  
	
	<div class="share-box">
		<div class="link fl" style="<?php if ($this->livetype==3 || $this->livetype==4) { echo 'width:55%';}?>">
			<strong>老师上课</strong>
			<?php if ($this->livetype==3) {?>
				<div class="link-live-info">
					<div>直播客户端下载地址</div>
					<?php if ($channel['live_service']=='polyv') {?>
					<div><a target="_blank" href="https://live.polyv.net/start-client.html?channelId=<?php echo $channel['channelid']?>">https://live.polyv.net/start-client.html?channelId=<?php echo $channel['channelid']?></a></div>
					<div class="ks-bt bt-pue fn" onclick="window.open('https://live.polyv.net/start-client.html?channelId=<?php echo $channel['channelid']?>')" style="padding:0 15px;">去上课</div>
					<?php } ?>
					<div>房间频道：<?php echo $channel['channelid']?></div>
					<div>房间密码：<?php echo $channel['password']?></div>
				</div>
			<?php }else{ ?>
				<?php if (!$isspeaker) {?>
					<div class="mt20"><b>您还没有设置主讲老师</b></div>
					<div class="ks-bt bt-pue fn mt20" onClick="top.closePopup('all');top.frames['main'].location.href='<?php echo wx_Url($this->wxid).'/home.html/course/Index/teacher/'.$this->courseid.'?appid-6,livetype-2,courseType-2';?>';">去设置</div>
					<?php if ($this->course['userid']==$this->userid) {?>
						<div class="ks-bt ml10 fn bt-pue" onClick="window.open('<?php echo shortchain(wx_Url($this->wxid).'/course/live?courseid='.$this->courseid.'#/'.$liveRoute.'?id='.$this->courseid.'&chapterid=0');?>')">用当前账号直播</div>
					<?php }?>
				<?php }?>
				<?php foreach ($list as $k=>$v) {?>
					<div class="link-item">
						<div class="link__head">
							<div class="link-item__name"><?php echo $v['name'];?><span><?php echo $role[$v['role']];?></span></div>
						</div>
						<div class="link-item__url">
							<?php if ($v['teacherid']==$this->userid) {?>
								<div class="ks-bt bt-pue" onClick="window.open('<?php echo shortchain(wx_Url($this->wxid).'/course/live?courseid='.$this->courseid.'&type=1&token='.$v['token'].'#/'.$liveRoute.'?id='.$this->courseid.'&chapterid=0');?>')">去上课</div>
							<?php }else{ ?>
								<div class="ks-bt bt-pur" onClick="copyLink('url<?php echo $k; ?>')">复制链接</div>
								<div style="height:0px;">
									<input type="text" style="height:0px;border:0px;" id="url<?php echo $k; ?>" value="<?php echo shortchain(wx_Url($this->wxid).'/course/live?courseid='.$this->courseid.'&type=1&token='.$v['token'].'#/'.$liveRoute.'?id='.$this->courseid.'&chapterid=0');?>" />
								</div>
							<?php }?>
							<?php echo shortchain(wx_Url($this->wxid).'/course/live?courseid='.$this->courseid.'&type=1&token='.$v['token'].'#/'.$liveRoute.'?id='.$this->courseid.'&chapterid=0');?>
						</div>
					</div>
				<?php }?>
			<?php }?>
		</div>
		<?php if ($this->livetype==3 || $this->livetype == 4) { ?>
		<div class="code fl" style="width:45%;">
			<strong>学生上课</strong>
			<div>
				<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#course/'.$this->courseid,'L',4,'weimenhu');?>" />
			</div>
			<div style="padding-left:15px; text-align:left; color:#5085e0">
				<?php echo shortchain(wx_Url($this->wxid).'/course/live?courseid='.$this->courseid.'#/'.$liveRoute.'?id='.$this->courseid.'&chapterid=0');?>
				<div class="ks-bt bt-pur" style="float:right;" onClick="copyLink('skurl')">复制链接</div>
				<div style="height:0px;">
					<input type="text" style="height:0px;border:0px;" id="skurl" value="<?php echo shortchain(wx_Url($this->wxid).'/course/live?courseid='.$this->courseid.'#/'.$liveRoute.'?id='.$this->courseid.'&chapterid=0');?>" />
				</div>
			</div>
		</div>
		<?php }else { ?>
		<div class="link student-link fl">
			<strong>学生听课</strong>
				<?php if(count($student_list)){ ?>
					<?php foreach ($student_list as $k=>$v) {?>
					<div class="link-item">
						<div class="link__head">
							<div class="link-item__name"><?php echo $v['name'];?></div>
						</div>
						<div class="ks-bt bt-pur" onClick="copyLink('surl<?php echo $k; ?>')">复制链接</div>
						<div class="link-item__url">
							<?php echo shortchain(wx_Url($this->wxid).'/course/live?courseid='.$this->courseid.'&type=2&token='.$v['token'].'#/videolive?id='.$this->courseid.'&chapterid=0');?>
							<div style="height:0px;">
								<input type="text" style="height:0px;border:0px;" id="surl<?php echo $k; ?>" value="<?php echo shortchain(wx_Url($this->wxid).'/course/live?courseid='.$this->courseid.'&type=2&token='.$v['token'].'#/'.$liveRoute.'?id='.$this->courseid.'&chapterid=0');?>" />
							</div>
						</div>
					</div>
					<?php }?>
				<?php }else{?>
					<div class="mt20">该课程还没有学生报名</div>
					<div class="ks-bt bt-pue fn mt20" onClick="top.closePopup('all');top.frames['main'].location.href='<?php echo wx_Url($this->wxid).'/home.html/course/Index/student/'.$this->courseid.'?appid-6,livetype-'.$this->livetype.',courseType-2';?>';">去添加</div>
				<?php }?>
				
			
		</div>
		<?php }?>
	
	</div>
    
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage'])
		/**复制链接 */
		function copyLink(id){
			 var Url2=document.getElementById(id);
			 Url2.select(); // 选择对象
			 document.execCommand("Copy"); // 执行浏览器复制命令
			 Alert("复制成功！您可在微信或浏览器打开",2);
		}
	</script>
</body>
</html>