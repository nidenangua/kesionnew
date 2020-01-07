<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<?php $title='视频';if($this->courseType==1){$title= '视频';}elseif($this->courseType==2){$title= '直播';}elseif($this->courseType==3){$title= '音频';}elseif($this->courseType==4){$title= '图文';}elseif($this->courseType==5){$title= '面授';}elseif($this->courseType==6){$title= '活动';}elseif($this->courseType==7){$title= '训练营';}elseif ($this->courseType==11){$title= '专栏';}?>
	<title><?php if(empty($this->courseid)){ echo '添加'; }else{echo '编辑'; }?><?php echo $title;?></title>
	
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">	
	<style>
		.form-star{left:0;}		
		.pricebox{margin-top:20px;}
		.pricebox .item{font-size:14px; color:#999; margin-top:10px;}
		.pricebox input{background: #fff;margin:0 10px;}
		.audio-list .item{padding: 15px 0; border-bottom: 1px solid #eee; margin-bottom: 15px; position: relative;}
		.audio-list .icon-close{width:36px;height:36px; position: absolute;top:60px;left:650px; line-height: 36px; text-align: center; font-size:14px; cursor: pointer; color:#aaa; z-index: 9;}
		.audio-list .icon-close:hover{color:#e5412c}
		.audio-list .id{font-size: 18px;font-weight: bold;color:#ccc;}
		.audio-title{width:435px;padding-right: 120px;} 
		.audio-text{height: 36px; position: relative;margin-top:10px;}
		.audio-title .form-textbox{border-radius:4px 0 0 4px;}
		.audio-title .form-textbox:focus{ position: relative; z-index: 8;}
		.audio-title .sj-switch{ position: absolute;right:1px;top:0;height: 36px; line-height: 36px; padding:0 30px 0 15px;border:1px solid #e6e6e6; cursor: pointer; box-sizing: border-box;width:120px; border-radius: 0 4px 4px 0; overflow: hidden; color:#999}
		.audio-title .sj-switch i{margin-right: 5px;}
		.audio-title .sj-switch em{width:20px;height: 34px; line-height: 34px; position: absolute;right:0;top:0;border-left:1px solid #eee; text-align: center; color:#aaa; background: #fafcfd;}
		.audio-title .sj-switch .ok{color:#27d17e;} 
		.audio-title .sj-switch-option{ position: absolute;right:0;top:31px; width:120px; z-index: 9; background: #fff;border:1px solid #e6e6e6;border-radius: 4px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);padding: 5px 0; display: none;}
		.audio-title .sj-switch-option li{padding: 0 15px;height: 32px; line-height: 32px;font-size:12px;color:#666; cursor: pointer;}
		.audio-title .sj-switch-option li:hover{background: #fafcfd;}
		.audio-text span{line-height: 36px; position: absolute;left:10px;top:0;font-size:14px;color:#999;}
		.audio-text .form-textbox{padding-left: 55px;max-width: 555px;}
		.audio-text .ks-bt{margin-left:10px;}
		
		.audiomodul .info{font-size:14px; color:#666;margin-top:10px;}

		.knowledge-right{padding-top: 30px;}
		
	
<!--		--><?php //if($this->setting[3]==1){?>
/*		.knowledge{ position: relative;padding-left: 240px; min-height: 650px;}*/
/*		.knowledge-left{width:199px; position: absolute;left:0;top:30px;border-right:1px solid #eee;height: 100%;}*/
/*		.knowledge-left .curr{color:#e5412c}*/
/*		*/
/*		.liveCsecond a{display: block; line-height: 34px;}*/
/*		*/
/*		*/<?php //}?>
.addCorrelationBtn{
			width: 138px;height: 34px;line-height: 34px;border-radius: 2px;border: 1px dashed #2a75ed;font-size: 14px;text-align: center;color: #2a75ed;margin-bottom: 20px;margin-left: 25px;cursor: pointer;display: -ms-flexbox;display: flex;-ms-flex-align: center;align-items: center;-ms-flex-pack: center;justify-content: center;
		}
.add-text-icon {
    margin-right: 5px;
    font-size: 16px;
    font-weight: 700;
    text-align: center;
    color: #2a75ed;
}
.correlationItem {
    width: 707px;
    height: 80px;
    padding: 10px;
    position: relative;
}
.itemImageWrapper {
    width: 80px;
    height: 60px;
    border-radius: 2px;
    margin-right: 10px;
    float: left;
}
.infoWrapper {
    width: 410px;
    height: 60px;
    float: left;
}
.infoTitle {
    height: 45px;
    line-height: 1.5;
    font-size: 14px;
    text-align: left;
    color: #353535;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
}
.infoPrice {
    font-size: 14px;
    line-height: 1.17;
    text-align: left;
    color: #fb6161;
}
.itemIconBtn {
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -29px;
    margin-right: 20px;
    width: 90px;
    height: 36px;
    line-height: 36px;
    cursor: pointer;
    text-align: center;
    border-radius: 2px;
    background-color: #fff;
    border: solid 1px #e5e7eb;
    color: #666;
    font-size: 14px;
}
.itemIconBtn {
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -27px;
    margin-right: 20px;
    width: 90px;
    height: 36px;
    line-height: 36px;
    cursor: pointer;
    text-align: center;
    border-radius: 2px;
    background-color: #fff;
    border: solid 1px #e5e7eb;
    color: #666;
    font-size: 14px;
}
.itemImageWrapper img {
    width: 80px;
    height: 60px;
}
.infoType {
    float: left;
    color: #666;
    height: 60px;
    line-height: 60px;
    font-size: 14px;
    margin-left: -59px;
    text-align: center;
    width: 32px;
}

/* 填写报名表单部分 */
.contact-info_operat{
	height:40px;
}
.contact-info_operat:after{
	display:block;clear:both;content:"";visibility:hidden;height:0
}
.param-label{
	float: left;
    margin-right: 15px;
    line-height: 28px;
    cursor: pointer;
    color: #666;
    font-size: 14px;
}
.param-label input[type="checkbox"]{
	float:left;
}
.contact-info_param_info{
	display:flex;
	flex-wrap:wrap;
	align-items:center;
	margin-bottom:20px;
}
.contact-info_param_info input:not([type="checkbox"]){
	width:100px;
	height: 36px;
    line-height: 36px;
	border: 1px solid #e6e6e6;
	border-radius: 4px;
}
.contact-info_param_info input.param-value{
	width:400px;
}
.contact-info_param_info .icon-shanchu1{
	margin-left: 10px;
	cursor: pointer;
}
.contact-info_param_info .param-option{
	text-align: left;
}
.contact-info_param_info .add-option{
	color: #A4C5FF;
}
.param-option_item{
	border: 1px solid #e6e6e6;
	color: #e6e6e6;
	display:none;
	line-height:31px;
	padding:0 4px;
}
.form-textbox:disabled{
	background: #f6f6f6;
}
.fl[type="checkbox"],
.reqired[type="checkbox"]{
	position: relative;
    top: 6px;
    margin-right: 10px !important;
}
.contact-way{
	margin-top:10px;
}
.contact-way-input{
	float:left;
	width:400px;
}
.contact-info_param{
	width:100px;
}
</style>
</head>
<body class="ks-wrap">
	
		<div class="ks-wbox bRadius10">
			<div class="ks-head-nav">
				<a href="javascript:history.go(-1);"><?php echo $title;?>管理</a><em>/</em><?php if(empty($this->courseid)){ echo '添加'; }else{echo '编辑'; }?><?php if ($this->courseType==2){ echo CourseModel::$liveType[$this->livetype];}else{echo $title;}?>
			</div>
			<div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，科汛V名师保有依据国家规定及平台规则进行处理的权利。</div>
			<div class="knowledge">
				<div class="knowledge-right">
					<?php if(ACTION=='basics'){ ?>
					<!--基本资料-->
					<form target="hidframe"  id="myform" class="form-horizontal" action="<?php if(isset($course)){echo M_URL($this->AppName.'/Index','doedit',$courseid,GP(''));}else{echo M_URL('course/Index','doaddcourse','',GP('entry-2'));} ?>" method="post" enctype="multipart/form-data">
						<div class="form-title2">基本信息</div>
						<div class="form-box">
							<div class="form-row">
								<span class="name name-nowrap"><?php if ($this->courseType==2){ echo CourseModel::$liveType[$this->livetype];}else{echo $title;}?>名称<i class="form-star">*</i></span>
								<div class="form-limit" limit="50">
									<input type="text" class="form-textbox" name="title" value="<?php if(isset($course["title"])) echo $course["title"] ?>" />
								</div>
							</div>
							<div class="form-row form-po" >
								<span class="name name-nowrap">简短描述(用于微信分享)</span>
								<div class="form-limit" limit="45">
									<input type="text" class="form-textbox" name="shortdesc" value="<?php if(isset($course["shortdesc"])) echo $course["shortdesc"] ?>" />
								</div>
								<div style="position: absolute;left: 635px;top: -30px;">
									<span class="name" style="position: absolute;margin-top: 72px;">例：</span><img style=" margin-left: 31px;height: 100px;width: 320px;" src="<?php echo UOOT;?>Images/images/201806/566.png"/>
								</div>
							</div>

							<!--<div class="form-row" class="" style="float: right;margin-right: <?php if($this->setting[3]==1){echo '360px';}else{echo '553px';}?>; margin-top: -112px;">

							</div>-->
							<div class="form-row clearfix">
									<?php if($this->courseType==4||$this->courseType==1 || $this->courseType==3){?>
										<span class="name name-nowrap"><?php echo $title;?>上传<i class="form-star">*</i></span>
									<?php }elseif($this->courseType==2){?>
										<span class="name name-nowrap">直播连载<i class="form-star">*</i></span>
									<?php }?>
									<?php if ($this->courseType!=6&&$this->courseType!=7) {?>
									<div class="clearfix">
										<label class="radioLabel fl">
											<input type="radio" value="0" name="coursehour" <?php if(!empty($course)){if($course["coursehour"]==0)echo "checked"; }else{echo 'checked';}?>>单<?php echo $title;?>
										</label>
										<label class="radioLabel fl">
											<input type="radio"  value="1" name="coursehour" <?php if(!empty($course)){if($course["coursehour"]==1)echo "checked"; }?>>连载课
										</label>
									</div>
									<?php }?>
										<?php if($this->courseType==1 || $this->courseType==3){
                                                  if($this->courseType==1){?>
										<div class="clearfix pt10" id="singleKeshi" style="display: none;">
											<div class="form-tips pt10">格式支持mp4、mov、avi，建议大小不超过1G。</div>
											
<!--			     			                <div class="ks-heade-button ks-head-primary" style="margin-top: 5px;" onclick="top.KTJ_UploadVideoFile(function(fileName,fileId){-->
<!--												 vod(fileName,fileId)-->
<!--											 })">本地上传</div> 		-->
											
											<div class="ks-bt bt-pur fn" style="margin:5px 0 0 5px" onclick="addTypeChange('/home.html#/getVodList?from=popup','850px','600px',{
												title:'选择视频',
												data:function(name,src){
													vod(name,src);
												}
											});">选择已有文件</div>
											<div class="item audiomodul">
												<h4 class="info" id="file_Name"><?php if(isset($vdo)){echo $vdo['vdoName'];} ?><?php if(isset($vdo)){?><?php if(isset($chapter)&&!empty($chapter["videoId"])){?>__<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','viewplay',$this->courseid,GP("videoId-".$chapter["videoId"]))?>','800px','630px',{title:'预览',type:'top'});">点击预览</a><?php }}?></h4>
											</div>
										</div>
										
										<input id="fileUrl" type="hidden" name="fileurl" value="<?php if(isset($chapter)) echo $chapter["videoId"]; ?>"/>
										<input id="fileName" type="hidden" name="filename" />


										<?php }else{ ?>
										<div class="clearfix pt10" id="singleKeshi" style="display: none;">
											<div class="form-tips pt10">格式支持mp3、m4a，为保证音频加载与播放的流畅性，建议上传大小不超过50M</div>
											<div class="pt10">
<!--												<div id="selectfiles" class="ks-heade-button ks-head-primary">本地上传</div>-->
												<div id="container" style="display: none;"></div>
												<div class="ks-bt bt-pur fn ml10" onclick="addTypeChange('<?php echo M_URL('Index','wxfile','',GP('name-555,type1-3,type-fn,chektype-1'));?>','1000px','620px',{title:'选择音频',data:function(__name,__src){vod(__name,__src);}});">选择文件</div>
												<input type="hidden" id="fileUrl" name="fileurl" value="<?php if(isset($chapter['videoId'])) echo $chapter['videoId']; ?>"/>
											</div>
											<div class="item audiomodul">
										        <h4 class="info" id="file_Name">
										        <?php if(isset($chapter['videoId'])&&!empty(Img($chapter['videoId'],0,'filename'))){?><?php echo Img($chapter['videoId'],0,'filename');?>(<?php echo Img($chapter['videoId'],0,'size');?>M)__<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','audioplay',$this->courseid,GP("chapterid-".$chapter["chapterid"]))?>','600px','130px',{title:'<?php echo Img($chapter['videoId'],0,'filename');?>(<?php echo Img($chapter['videoId'],0,'size');?>M)',type:'top'});">点击试听</a>
											    <?php }?>
												</h4>
										    </div>
										</div>

										<?php }}elseif($this->courseType==2){?>
										<div class="clearfix pt10" id="singleKeshi" style="display: none;">
											<div class="form-row">
												<span class="name name-nowrap">直播时间<i class="form-star">*</i></span>
												<div class="mt10 clearfix">
					
													<div class="ks-head-tbox fl"><font class="mr10 fsize14">开始时间</font><span class="ks-head-ticon"><i class="iconfont icon-date"></i></span><input type="text" name="begindate" class="form-textbox w200 selectLiveTime" value="<?php if(isset($chapter['begindate']))echo date('Y-m-d H:i:s',$chapter['begindate']); ?>"/></div>
													<div class="fl">
														<font class="ml20 mr10 fsize14">直播时长</font><select class="form-textbox w120" name="livehours"><option value="1" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==1))echo 'selected="selected"'; ?>>1小时</option><option value="1.5" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==1.5))echo 'selected="selected"'; ?>>1.5小时</option><option value="2" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==2))echo 'selected="selected"'; ?>>2小时</option><option value="2.5" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==2.5))echo 'selected="selected"'; ?>>2.5小时</option><option value="3" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==3))echo 'selected="selected"'; ?>>3小时</option><option value="5" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==5))echo 'selected="selected"'; ?>>5个小时</option><option value="24" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==24))echo 'selected="selected"'; ?>>1天</option></select>
													</div>
												</div>
											</div>
										</div>
										
										<?php }?>
							</div>
							<?php if ($this->courseType!=6&&$this->courseType!=7) {?>
							<div class="form-row form-po" id="expecthour">
								<span class="name name-nowrap">预计课时</span>
								<input type="text" class="form-textbox" name="expecthour" value="<?php if(isset($course["expecthour"])) echo $course["expecthour"] ?>" />
							</div>
							<?php }?>
							<div class="form-row" >
								<span class="name name-nowrap"><?php echo $title;?>封面<i class="form-star">*</i></span>
								<div class="form-upimg">
									
									<div class="defaultpic images" style="background-image:url('<?php if(!empty($course["defaultpic"])){echo Img($course["defaultpic"]);}else{ echo nopic(0);} ?>');"></div>
									<div class="clearfix">
										<div class="ks-bt bt-pur" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic,type-other'));?>','1100px','640px',{title:'选择图片',type:'top'});">上传图片</div>
									</div>
									<input type="hidden" name="defaultpic">
									<div class="form-tips pt20">建议尺寸比例16:9，JPG、PNG格式， 图片小于1M。</div>
								</div>
							</div>
							<?php if(iscategory($this->wxid,$this->appid,$this->courseType)){ ?>
								<div class="form-row clearfix">
								<span class="name name-nowrap"><?php echo categoryName($this->wxid) ?></span>
							<?php echo $Linkage->Linkage(1);?>
								</div>
							<?php } ?>
							<?php if($this->courseType==2){?> 
							<div class="form-row">
								<span class="name name-nowrap"><?php echo $title;?>简介<i class="form-star">*</i></span>
								<div  class="rightTd alignLife">
									<textarea class="form-textarea" name="intro"><?php if(!empty($this->course["intro"])){echo $this->course["intro"];}?></textarea>
								</div>
							</div>
							
							<?php }?>
							
							<?php if($this->courseType==4){?>
							<div class="clearfix pt10" id="singleKeshi">
								<div class="form-row">
									<span class="name name-nowrap">试看内容</span>
									<div  class="rightTd alignLife" style="max-width:750px;width:100%;margin-bottom: 20px;" >
									<?php  $value=!empty($course["announce"])?Img($course['announce']):'';$kindeditor1 = ks_editor('announce',$value,'1',editorNum4(),'100%');  echo $kindeditor1;?>
									</div>
								</div>
							</div>
							<?php }?>
							<?php if($this->courseType==3){?>
							<div class="form-row" >
									<span class="name name-nowrap">详情设置</span>
									<div class="clearfix">
									    <label class="radioLabel">
											<input type="radio" class="radioInput" value="0" name="ispart" <?php if(!empty($course)){if($course['ispart']==0){echo 'checked="checked"';}}else{echo 'checked="checked"';}?>>购买前查看完整商品详情
									    </label>
										<div class="clear blank10"></div>
									    <label class="radioLabel">
											<input type="radio" class="radioInput" value="1" name="ispart" <?php if(!empty($course)&&$course['ispart']==1){ echo 'checked="checked"';}?>>购买前仅查看介绍内容
									 	</label>
									</div>
									<div class="form-tips" style="font-size:12px;margin:10px 0 0 28px">购买后即可查看完整详情，不再显示介绍内容，付费音频可见</div>
							</div>
							<div class="form-row" id="audio-intro" style="display: none;">
								<span class="name name-nowrap">介绍内容</span>
								<div  class="form-editor">
									<?php  $value=!empty($course["announce"])?Img($course['announce']):'';$kindeditor1 = ks_editor('announce',$value,'1',editorNum4(),'100%','80px');  echo $kindeditor1;?>
								</div>
							</div>
							<?php }?>
							
							
							<div class="form-row">
								<span class="name name-nowrap"><?php echo $title;?>详情<i class="form-star">*</i></span>
								<div  class="form-editor">
								<?php  $value=!empty($course["content"])?urldecode(Img($course['content'])):'';$kindeditor = ks_editor('content',$value,'1',editorNum4(),'100%'); echo $kindeditor;?>
								</div>	
							</div>
		                    <?php if($this->setting[4] == 1){?>
							<div class="form-row">
								<span class="name name-nowrap">销量设置(作弊使用，请谨慎使用)</span>
								<div class="form-limit" limit="6" style="max-width: 100px;">
									<input type="number" class="form-textbox" name="studentcount" value="<?php if(isset($course["studentcount"])) echo $course["studentcount"] ?>" />
                                </div>
                                
							</div>
                            
							<?php }?>
							<?php if ($this->courseType==1||$this->courseType==3) {?>
							<div class="form-row clearfix">
								<span class="name name-nowrap">自动播放</span>
								<div class="form-switch" open-value="1">
									<label for="isshow0"><input type="radio" value="1" name="slide" <?php if(!empty($course["slide"])&&$course['slide']==1){ echo 'checked="checked"';}?>></label>
									<label for="isshow1"><input type="radio" value="0" name="slide" <?php if(!empty($course["slide"])){if($course['slide']==0){echo 'checked="checked"';}}else{echo 'checked="checked"';}?>></label>
								</div>
							</div>
							<div class="form-tips">部分手机机型不支持自动播放。</div>
							<div class="form-row clearfix" id="is_audition">
								<input type="checkbox" name="is_audition" onclick="audition(this)"  <?php if(!empty($course)){if($course['json']["is_audition"]==1)echo "checked"; }?> value="1" >
								<label for="associated1" class="associated" style="float: none;">是否可以试听</label>
							</div>
							<div class="form-row" id="audition_time">
								<span class="name name-nowrap">试看时间<i class="form-star">*</i><span style="color: red">(秒单位)</span></span>
								<div class="form-limit" limit="3" style="max-width: 100px;">
									<input type="text" class="form-textbox" name="audition_time" value="<?php if(isset($course["json"]['audition_time'])) echo $course["json"]['audition_time'] ?>" />
								</div>
							</div>
							<?php }?>
							<div class="form-row clearfix">
				                <span class="name name-nowrap">文字防复制</span>
				               	<div class="form-switch" open-value="1">
				                    <label for="isshow0"><input type="radio" value="1" name="iscopy" <?php if(!empty($course["iscopy"])&&$course['iscopy']==1){ echo 'checked="checked"';}?>></label>
				                    <label for="isshow1"><input type="radio" value="0" name="iscopy" <?php if(!empty($course["iscopy"])){if($course['iscopy']==0){echo 'checked="checked"';}}else{echo 'checked="checked"';}?>></label>
								</div>
				            </div>
							<div class="form-tips">商品的文字内容允许复制，图片点击放大和长按识别二维码功能则允许使用。</div>

						</div>
						<?php if ($this->courseType==5) {?>
						<div class="form-title">开课信息</div>
							<div class="clearfix pt10">
								<div class="form-row">
									<div class="mt10 clearfix">
										<span class="name name-nowrap">报名时间<i class="form-star">*</i></span>
										<div class="ks-head-tbox fl"><span class="ks-head-ticon"><i class="iconfont icon-date"></i></span><input type="text" placeholder="开始时间" name="date1" class="form-textbox w200 selectLiveTime" value="<?php if(!empty($course['json']['date1']))echo KS_DATE($course['json']['date1']); ?>"/></div>
										<div class="ks-head-tbox fl"  style="font-size: 14px;padding:0 10px;margin-top: 5px">至</div>
										<div class="ks-head-tbox fl"><span class="ks-head-ticon"><i class="iconfont icon-date"></i></span><input type="text" placeholder="结束时间" name="date2" class="form-textbox w200 selectLiveTime" value="<?php if(!empty($course['json']['date2']))echo KS_DATE($course['json']['date2']); ?>"/></div>
									</div>
									<div class="form-row">
										<span class="name name-nowrap">开课时间<i class="form-star">*</i></span>
										<div class="mt10 clearfix">
											<div class="ks-head-tbox fl"><span class="ks-head-ticon"><i class="iconfont icon-date"></i></span><input type="text" placeholder="开始时间" name="date3" class="form-textbox w200 selectLiveTime" value="<?php if(!empty($course['json']['date3']))echo KS_DATE($course['json']['date3']); ?>"/></div>
											<div class="ks-head-tbox fl"  style="font-size: 14px;padding:0 10px;margin-top: 5px">至</div>
											<div class="ks-head-tbox fl"><span class="ks-head-ticon"><i class="iconfont icon-date"></i></span><input type="text" placeholder="结束时间" name="date4" class="form-textbox w200 selectLiveTime" value="<?php if(!empty($course['json']['date4']))echo KS_DATE($course['json']['date4']); ?>"/></div>
										</div>
									</div>
									<div class="form-row">
										<span class="name name-nowrap">上课地址<i class="form-star">*</i></span>
										<div class="form-limit" limit="30">
											<input type="text" class="form-textbox" name="address" value="<?php if(isset($course['json']["address"])) echo $course['json']["address"] ?>" />
										</div>
									</div>
									<div class="form-row">
										<span class="name name-nowrap">上课人数<i class="form-star">*</i></span>
										<div  style="max-width: 100px;">
											<input type="text" class="form-textbox" name="people_num" value="<?php if(isset($course['json']["people_num"])) echo $course['json']["people_num"] ?>" />
										</div>
									</div>
								</div>
							</div>
						<?php }?>
						
						<div class="form-title">商品信息</div>
						<div class="form-box" style="min-height: auto;">
							<?php if ($this->courseType==2&&($this->livetype==3||$this->livetype==4)) {?>
							<div class="clearfix" style="padding-bottom: 20px;">
								<input type="checkbox" name="is_form" class="filled-in" id="is_join" value="1" <?php if(!empty($course['json']['setting']["is_form"])){echo "checked";}?>/>
								<label for="is_join" class="separate" style="float: none;">开启报名才可进入</label>
							</div>
							<table cellpadding="0" cellspacing="0" class="ks-table" style="max-width:750px;padding-bottom:20px;">
								<tr>
									<td align="right" style="min-width:85px;"><strong>联系方式：</strong></td>
									<td class="righttd">
										<div class="contact-info">
											<div class="contact-way clearfix">
												<label><input type="checkbox" class="fl" disabled="disabled" checked="checked"/>必选</label>
												<label class="contact-info_param">用户姓名</label><input type="text" name="realname" class="form-textbox contact-way-input" value="报名用户的姓名"  disabled="disabled"/>
											</div>
										</div>
										<div class="contact-info">
											<div class="contact-way clearfix">
												<label><input  class="fl"  type="checkbox" disabled="disabled" checked="checked"/>必选</label>
												<label class="contact-info_param">手机号码</label><input type="text" name="mobile" value="报名用户的手机号码"  class="form-textbox contact-way-input" disabled="disabled"/>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td align="right" style="min-width:85px;"><strong>自定义表单：</strong></td>
									<td class="righttd">
										<div class="contact-info_more-param" id="contact-info_more-param"></div>
										<div class="contact-info_operat">
											<a class="ks-bt mr20" onclick="addParam('text',param_empty)">添加单行文本框</a>
											<a class="ks-bt mr20" onclick="addParam('textarea',param_empty)">添加多行文本框</a>
											<a class="ks-bt mr20" onclick="addParam('radio',param_empty)">添加单选</a>
											<a class="ks-bt" onclick="addParam('checkbox',param_empty)">添加多选</a>
										</div>
									</td>
								</tr>
							</table>
							<textarea id="json" name="json" style="display:none" ><?php if (!empty($course['json']['form'])){echo json_encode($course['json']['form'],JSON_UNESCAPED_UNICODE);}?> </textarea>

							<?php }?>
							<?php if(ismoduleopen($this->wxid,106,0,1) || checkIsVipVersion($this->wxid)){ ?>
							<div class="clearfix" style="margin-bottom: 20px;">
								<input type="checkbox" name="separate" class="filled-in" id="separate" value="1" <?php if(!empty($course)){if($course["isseparate"])echo "checked"; }else{echo 'checked';}?> onclick="changebox(this,1)">
								<label for="separate" class="separate" style="float: none;">支持单独售卖</label>
                	         </div>	
							<?php }?>
							<div class="form-gray">
								<div class="form-row">
									<div class="clearfix">
										<label class="radioLabel fl" style="margin-right: 14px;">
											<span class="name name-nowrap">售卖价格</span>
										</label>
									    <label class="radioLabel fl">
											<input onclick="isFree(this)" type="radio" class="radioInput" value="1" name="chargetype" <?php if(!empty($course)){if($course["chargetype"]==1)echo "checked"; }else{echo 'checked';}?>>收费
									    </label>
									 	<label class="radioLabel fl">
											<input onclick="isFree(this)" type="radio" class="radioInput" value="2" name="chargetype" <?php if(!empty($course)){if($course["chargetype"]==2)echo "checked"; }?>>打赏
										</label>
									    <label class="radioLabel fl">
											<input onclick="isFree(this)" type="radio" class="radioInput" value="0" name="chargetype" <?php if(!empty($course)){if($course["chargetype"]==0)echo "checked"; }?>>免费
									 	</label>
									</div>
									
									<div class="pricebox" id="pricebox" style="margin-top: 7px;">
										<div class="item">
											<span>商品价格</span><input type="text" name="price" class="form-textbox w180" placeholder="请输入价格" value="<?php if(isset($course["price"]))echo $course["price"];?>" ktj-price /> 元
										</div>
										<div class="item">
											<span>划线价格</span><input type="text" name="price_market" class="form-textbox w180" placeholder="请输入划线价格（选填）" value="<?php if(isset($course["price_market"]))echo $course["price_market"];?>" ktj-price/> 元
										</div>
                                        <?php
                                        $setting_vip   = $this->cache->GetH('apprelate','appid',21,'setting',$this->wxid);
                                        if (empty($setting_vip)){
                                            $is_vip = 0;
                                        }else{
                                            $setting_vip = explode('※',$setting_vip);
                                            $is_vip = $setting_vip[0];
                                        }
                                        if (($this->courseType==4||$this->courseType==1||$this->courseType==2||$this->courseType==3)&&$is_vip==1){
                                            ?>
                                            <div class="clearfix" style="margin-top: 17px;">
                                                <label class="radioLabel fl" style="margin-right: 14px;">
                                                    <span class="name name-nowrap">是否开启特权</span>
                                                </label>
                                                <label class="radioLabel fl">
                                                    <input style="margin-top: 5px;border-radius: 50%;" type="radio" class="radioInput" value="0" name="isvip" <?php if(!empty($course)){if($course["isvip"]==0)echo "checked"; }else{echo 'checked';}?>>无
                                                </label>
                                                <label class="radioLabel fl">
                                                    <input style="margin-top: 5px;border-radius: 50%;" type="radio" class="radioInput" value="1" name="isvip" <?php if(!empty($course)){if($course["isvip"]==1)echo "checked"; }?>>VIP
                                                </label>
                                                <label class="radioLabel fl">
                                                    <input style="margin-top: 5px;border-radius: 50%;" type="radio" class="radioInput" value="2" name="isvip" <?php if(!empty($course)){if($course["isvip"]==2)echo "checked"; }?>>SVIP
                                                </label><a style="color: red">(VIP和SVIP可以享受该课程免费，SVIP包含所有VIP的权益)</a>
                                            </div>
                                            <?php
                                        }
                                        ?>

										<?php if ($this->courseType==5) {?>
										<div class="form-row  clearfix" style="margin-top: 10px;">
											<span class="name name-nowrap fl" >是否开启定金模式</span>
											<div class="form-switch fl" open-value="1" style="margin-top: 5px;margin-left:10px">
												<label for="isshow0"><input type="radio" value="1" name="is_dingjin" <?php if(!empty($course['json']["is_dingjin"])&&$course['json']['is_dingjin']==1){ echo 'checked="checked"';}?>></label>
												<label for="isshow1"><input type="radio" value="0" name="is_dingjin" <?php if(!empty($course['json']["is_dingjin"])){if($course['json']['is_dingjin']==0){echo 'checked="checked"';}}else{echo 'checked="checked"';}?>></label>
											</div>
										</div>
										<div class="item" id="dingjin" style="display: <?php echo !empty($course['json']["is_dingjin"])&&$course['json']['is_dingjin']==1?'block':'none';?>">
											<span>定金</span><input type="text" name="dingjin" class="form-textbox w180" placeholder="请输入定金价格" value="<?php if(isset($course['json']["dingjin"]))echo $course['json']["dingjin"];?>" ktj-price/> 元
										</div>
										<?php }?>
									</div>
								</div>
							</div>
							<?php if ($this->courseType==7) {?>
								<!-- 售卖方式-->
								<div class="form-row clearfix">
									<span class="name name-nowrap">售卖方式</span>
									<label class="radioLabel fl">
										<input type="radio" class="label-on"  class="radioInput" value="0" name="sell" <?php if(!empty($course)){if($course['json']["sell"]==0)echo "checked"; }else{echo 'checked';}?>>按期购买
									</label>
									<label class="radioLabel fl">
										<input type="radio" class="radioInput" value="1" name="sell" <?php if(!empty($course)){if($course['json']["sell"]==1)echo "checked"; }?>>一次性购买整个训练营
									</label>
								</div>
								<!--  售卖方式-->
							<?php }?>
							<?php if ($this->courseType!=5&&$this->courseType!=7) {?>
							<?php if(ismoduleopen($this->wxid,106,0,1) || checkIsVipVersion($this->wxid)){?>
							<div class="clearfix" style="margin-top: 20px;margin-bottom: 20px;">
								<input type="checkbox" name="associated" class="filled-in" id="associated" <?php if(!empty($course)){if($course["isassociated"])echo "checked"; }else{echo 'checked';}?> value="1" onclick="changebox(this,2)">
								<input type="text"  id='columnidbox' style="display: none;" name="columnid" value="<?php if(!empty($course)){ echo $columnid;}?>">
								<label for="associated" class="associated" style="float: none;">支持关联售卖</label>
                	         </div>
                	         <div class="addCorrelationBtn"  onclick="selectZl()"><span class="add-text-icon">+</span>选择专栏</div>
                	         
                	         <div class="form-gray" id="appendhtml">
                	         	<?php if(isset($columAry)){?>
                	         	<?php foreach($columAry as $k=>$v){?>
								<div class="form-row">
                                   <div id="p_5bf91bca503da_CRc3831v" class="correlationItem"><div class="itemImageWrapper"><img src="<?php echo $v['defaultpic']?>"></div><div class="infoWrapper"><div class="infoTitle"><?php echo $v['title']?></div><div class="infoPrice"><?php if($v['chargetype']==1){echo $v['price'];}else{echo '免费';}?></div></div><div class="infoType">专栏</div><div class="itemIconBtn" onclick="cel(this,<?php echo $v['columnid']?>)">取消关联</div></div>
								</div>
								<?php }?>
								<?php }?>
							 </div>
							 <?php }?>
							<?php }?>
						</div>
						<div class="form-title">上架设置</div>
						<div class="form-box" style="min-height: auto;">	
							<div class="form-row clearfix">
				                <span class="name name-nowrap">是否上架</span>
				               	<div class="form-switch" open-value="2">
				               		<?php if(!empty($course)){?>
				                    <label for="isshow0"><input type="radio" value="2" name="status" <?php if(!empty($course)){if($course['status']==2){echo 'checked="checked"';}}?>></label>
				                    <label for="isshow1"><input type="radio" value="0" name="status" <?php if(!empty($course)&&$course['status']==0){ echo 'checked="checked"';}?>></label>
				                <?php }elseif(!empty($setting)){?>
                                   <label for="isshow0"><input type="radio" value="2" name="status" <?php if($setting[1]==1){echo 'checked="checked"';}?>></label>
                                   <label for="isshow1"><input type="radio" value="0" name="status" <?php if($setting[1]==0){echo 'checked="checked"';}?>></label>
				                <?php }else{?>
				                	 <label for="isshow1"><input type="radio" value="2" name="status"></label>
				                	 <label for="isshow1"><input type="radio" value="0" name="status" checked="checked"></label>
				                <?php }?>
								</div>
				
				            </div>
						</div>
						<div class="form-footer clearfix">
							<span class="d-inline-block">
								<input type="hidden" name="typea" id="typea"  />
								<?php if ($this->courseType==7) {?>
									<input type="button" class="ks-bt bt-pue" onclick="do_reg(3);" value="保存进入下一步" id="determine">
								<?php }else{ ?>
									<input type="button" class="ks-bt bt-pue" onclick="do_reg(2);" value="保存进入下一步" id="determine">
								<?php }?>
								<input type="button" class="ks-bt bt-pue" onclick="do_reg(1);" value="保存返回" id="saveBack">
								
						        <button onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>
					    	</span>
						</div>
					</form>
					
					<?php }elseif(ACTION=='seo'){?>
						
						<?php include  CURR_VIEW_PATH . "courseseo.php"; ?>
					
					<?php }elseif(ACTION=='teacher'){?>
						
						<?php include  CURR_VIEW_PATH . "courseteacher.php"; ?>
					
					<?php }elseif(ACTION=='student'){?>
						
						<?php include  CURR_VIEW_PATH . "student/home.studentList.php"; ?>
					
					<?php }elseif(ACTION=='period'){?>
						
						<?php include  CURR_VIEW_PATH . "period.php"; ?>
					
					<?php }elseif(ACTION=='exam'){?>
						
						<?php include  CURR_VIEW_PATH . "exam.php"; ?>
					
					<?php }elseif(ACTION=='Tkindex'){?>
						
						<?php include  CURR_VIEW_PATH . "tk_index.php"; ?>
					
					<?php }elseif(ACTION=='task'){?>
						
						<?php include  CURR_VIEW_PATH . "taskIndex.php"; ?>
					
					<?php }elseif(ACTION=='correctTask'){?>
						
						<?php include  CURR_VIEW_PATH . "task_correct.php"; ?>
					
					<?php }elseif(ACTION=='comment'){?>
						
						<?php include  CURR_VIEW_PATH . "commentmanage.php"; ?>
					
					
					<?php }elseif(ACTION=='room'){?>
						
						<?php include  CURR_VIEW_PATH . "roommanage.php"; ?>
					
					<?php }elseif(ACTION=='information'){?>
						
						<?php include  CURR_VIEW_PATH . "course_file.php"; ?>
						
								
					<?php }?>
				</div>
				
			</div>
	</div>
	
	<?php if(ACTION!='period'){ ?>
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echoHash(); ?>"></script>
	<script>
		module.require(['backstage','Jcrop','ugcUploader','plupload','cookie','laydate'],function(){	
			<?php if ($this->courseType==5) {?>
			//选项切换
			 $('#pricebox').find('input[name="is_dingjin"]').click(function(){
				 var _val = $(this).val()
				 if(_val == 1) {
					 $('#dingjin').show()
				 }else {
					 $('#dingjin').hide()
				 }
			 })
			<?php }?>
			<?php //if ($this->courseType==1) {?>
			function audition(target){
				var state = $(target).prop('checked')
				state == true ?   $('#audition').show() : $('#audition').hide()
			}
			<?php// }?>
			<?php if($this->courseType==3){?>
			ossWebUpload(true,<?php echo $this->wxid;?>,'0',{
				type:3,
				success:function(res){
					getId('file_Name').innerHTML = res.name+'('+res.size+')';
					getId('fileUrl').value = res.Jmimg
				}
			});
			<?php }?>	
			
			
			$('.knowledge-right').css('min-height',(window.innerHeight-240)+'px');
			var chargetype = $('input:radio[name="chargetype"]:checked').val();
			(chargetype == 0 || chargetype == 2) && $('#pricebox').hide();
			
			<?php if(ismoduleopen($this->wxid,106,0,1)){?>
			if(!$('input:checkbox[name="separate"]').attr('checked')){
	            $(".radioInput").attr("disabled","disabled");
		        $(".price_box").attr("disabled","disabled")
			}
			<?php }?>
			if(!$('input:checkbox[name="associated"]').attr('checked')){
			   $(".addCorrelationBtn").removeAttr("onclick")	
			}
			<?php if($this->courseType==2||$this->courseType==5){?>
			//选择时间
			lay('.selectLiveTime').each(function(){
				laydate.render({
					elem: this,
					trigger: 'click',
					type:'datetime'
				});
			});
			<?php }?>
			<?php if(ACTION=='period' && $course['chapterTemplate']==1){?>
			periodAction();
			<?php }?>


			selectAudioType();

			$('input[name="coursehour"]').change(function(){

				selectAudioType()
			});
			function selectAudioType(){
				var el = $('input[name="coursehour"]:checked')[0];
				if(getId('singleKeshi')){
					getId('singleKeshi').style.display = el.value == 1 ? 'none' : 'block';
				}
				getId('determine').style.display = el.value == 1 ? 'block' : 'none';
				getId('expecthour').style.display = el.value == 1 ? 'block' : 'none';
				if(getId('is_audition')){
					getId('is_audition').style.display = el.value == 1 ? 'none' : 'block';
				}
				if(getId('audition_time')){
					getId('audition_time').style.display = el.value == 1 ? 'none' : 'block';
				}

			};

			<?php if($this->courseType==3){?>
			//音频
			viewIntro();
			function viewIntro(){
				var ispart = $('input:radio[name="ispart"]:checked').val();
				getId('audio-intro').style.display = ispart == 1 ? 'block' : 'none'
			};
			$('input[name="ispart"]').change(function(){
				viewIntro()
			})
			<?php }?>
		});
		//接收图片返回值
		top.imgUploadBack = function(src,img){
			$('.defaultpic').css('background-image','url('+src+')');
			$('input[name="defaultpic"]')[0].value = img;
		};
		function vod(fileName,fileId){
	        getId('file_Name').innerHTML = fileName;
			getId('fileName').value = fileName;
			getId('fileUrl').value = fileId
		}
		function do_reg(type){
			getId('typea').value = type;
			var title = $("input[name='title']").val();
			if(title==''){Alert('<?php echo $title;?>名称不能为空');$("input[name='title']").focus();return false}
	        if($('#separate').attr('checked')){
                var price = $('input[name="price"]').val();
		        var price2 = $('input[name="price_market"]').val();
		        for(i=0;i<$('input[name="chargetype"]').length;i++){
		        	if($('input[name="chargetype"]')[i].value==1&&$('input[name="chargetype"]')[i].checked==true){
			        	if(price<=0){
				        	Alert('价格需要大于0');$('input[name="price"]').focus();return false
				        } 
				        var reg = /(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/;
				        if(reg.test(price)) {}else{
				        	Alert('价格输入有误');$('input[name="price"]').focus();return false;
				        }
			        }
		        }
			}
			<?php if (ACTION=='basics' && $this->courseType==2&&($this->livetype==3||$this->livetype==4)) {?>
			/**自定义表单JSON */
			var form = new Array()
			form = [
				{
					field:'realname',
					name:'用户姓名',
					type:'text',
					required:true,
					placeholder:'报名用户的姓名',
					content:[]
				},
				{
					field:'mobile',
					name:'手机号码',
					type:'text',
					required:true,
					placeholder:'报名用户的手机号码',
					content:[]
				},
			]
			//构造字段Json
			$('#contact-info_more-param .contact-info_param_info').each(function() {
					var fieldObj = new Object()
					fieldObj.content = new Array()
					var dataType = $(this).attr('data-type')
					fieldObj.type = dataType
					if($(this).find('.param-label').children('input[type="checkbox"]').is(':checked')){
						fieldObj.required = true
					}else{
						fieldObj.required = false
					}
					if(dataType=='text'||dataType=='textarea'){
						fieldObj.field = $(this).find('.contact-info_param').children('input[type="text"]').attr('name')
						fieldObj.name = $(this).find('.contact-info_param').children('input[type="text"]').val()
						fieldObj.placeholder = $(this).find('.param-value').val()
						fieldObj.content=[]
					}else{
						fieldObj.field = $(this).find('.contact-info_param').children('input[type="text"]').attr('name')
						fieldObj.name = $(this).find('.contact-info_param').children('input[type="text"]').val()
						fieldObj.placeholder = ''
						$(this).find('.option-box').each(function() { 
							var childObj = $(this).find('.option-text').text()
							fieldObj.content.push(childObj)
						});
					}
					form.push(fieldObj)
			})
			$('#json').html(JSON.stringify(form));
			<?php }?>
			$("#myform").submit()
		};
		function isFree(el){
			document.getElementById('pricebox').style.display = el.value == 1 ? 'block' : 'none'
		}

		function selectZl(){
			$.cookie('columnlist', '', { expires: -1, path: '/' });
			$.cookie('columnAry', '', { expires: -1, path: '/' });
			
			var columnlist =$('#columnidbox').val();
			if(!columnlist){
				columnlist=0;
			}
			
			addTypeChange('<?php echo M_URL('column/Index','othershow','',GP('appid-104',true));?>,columnid-'+columnlist,'1000px','650px',{title:'添加商品',type:'top'});
		}	
		top.DataCallBack = function(columnlist){
			var Tk =columnlist.split("|");
			
			$('#columnidbox').val(columnlist);
			var columnAry  = $.cookie('columnAry');
			var newary = JSON.parse(columnAry)
			var html ='';
			for (var i = 0; i<newary.length; i++) {
				html+= '<div class="form-row"><div class="correlationItem"><div class="itemImageWrapper"><img src="'+newary[i].defaultpic+'"></div><div class="infoWrapper"><div class="infoTitle">'+newary[i].title+'</div>';
				if(newary[i].chargetype!=1){
					html+='<div class="infoPrice">免费</div>';
				}else{
					html+='<div class="infoPrice">'+newary[i].price+'</div>'
				}
				html+='</div><div class="infoType">专栏</div><div class="itemIconBtn"  onclick="cel(this,'+newary[i].columnid+')">取消关联</div></div></div>'
			}
			$('#appendhtml').html(html)
		}	

		function cel(target,id){
			var columnlist = $('#columnidbox').val();
			var ab =columnlist.split("|");
			var newStr = '';
			for(var i=0;i<ab.length;i++){
			if(id!=ab[i].replace(/\s*/g,"")){
				!newStr ? newStr=ab[i] : newStr+='|'+ab[i]
			}
			}
			$('#columnidbox').val(newStr);
			$(target).parents('.form-row').remove();
		}

		function changebox(target,type){
			if($(target).attr('checked')){
				if(type==1){
					$(".radioInput").removeAttr("disabled");
					$(".price_box").removeAttr("disabled")
				}else{
					$(".addCorrelationBtn").attr("onclick","selectZl()")
				}
				
			}else{
				if(type==1){
				if($('#associated').attr('checked')){
					$(".radioInput").attr("disabled","disabled");
					$(".price_box").attr("disabled","disabled")
				}else{
						$(target).attr('checked','true')
						Alert('至少选择一种方式')
				}
				}else{
					if($('#separate').attr('checked')){
						$(".addCorrelationBtn").removeAttr("onclick")
					}else{
						$(target).attr('checked','true')
						Alert('至少选择一种方式')
					}
					
				}
			}
		}

		<?php if (ACTION=='basics' && $this->courseType==2&&($this->livetype==3||$this->livetype==4)) {?>
		/****************************填写报名表单部分********************************** */
		/**开启报名才能进入 */
		if($("#is_join").prop("checked")){
			$(".ks-table").css("display","block");
		}else{
			$(".ks-table").css("display","none");
		}
		$("#is_join").on("change",function(){
			if($("#is_join").prop("checked")){
				$(".ks-table").css("display","block");
			}else{
				$(".ks-table").css("display","none");
			}
		})
		/**
		 * 添加字段
		 * @param type text 单行文本，textarea 多行文本，radio 单选，checkbox 多选
		 */
		var formArr = new Array()//创建一个字段数组
		var paramIndex = formArr.length//用来标识name
		var param_empty = new Object()//每添加一个就push一条空数据进去
		param_empty = {
			type:'text',
			required:false,
			field:'',
			name:'',
			placeholder:'',
			content:[]
		}


		function addParam(type,obj){

			//渲染的布局
			var add_param_html
			switch (type) {
				case ('text'):
					add_param_html = '<div class="contact-info_param_info opera" data-type="text">'
						+'<label class="param-label"><input type="checkbox" class="reqired" />必选</label>'
						+'<label class="contact-info_param"><input type="text" placeholder="单行文本" value="'+obj.name+'" name="param'+paramIndex+'"/></label><input type="text" name="" value="'+obj.placeholder+'" class="param-value" placeholder="提示信息写这里~"/><a class="iconfont icon-shanchu1" onclick="deleteParam(this)"></a>'
					+'</div>'
					break;
				case ('textarea'):
					add_param_html = '<div class="contact-info_param_info opera" data-type="textarea">'
						+'<label class="param-label"><input type="checkbox" class="reqired"/>必选</label>'
						+'<label class="contact-info_param"><input type="text" placeholder="多行文本" value="'+obj.name+'" name="param'+paramIndex+'"/></label><input type="text" name="" value="'+obj.placeholder+'" class="param-value" placeholder="提示信息写这里~"/><a class="iconfont icon-shanchu1" onclick="deleteParam(this)"></a>'
					+'</div>'
					break;
				case ('radio'):
					add_param_html = '<div class="contact-info_param_info opera" data-type="radio">'
						+'<label class="param-label"><input type="checkbox" class="reqired"/>必选</label>'
						+'<label class="contact-info_param"><input type="text" placeholder="单选" name="param'+paramIndex+'" value="'+obj.name+'"/></label><span class="param-option"></span><a class="button mr20 add-option" onclick="addOption(this)">添加选项</a><a class="iconfont icon-shanchu1" onclick="deleteParam(this)"></a>'
					+'</div>'
					break;
				case ('checkbox'):
					add_param_html = '<div class="contact-info_param_info opera" data-type="checkbox">'
						+'<label class="param-label"><input type="checkbox" class="reqired"/>必选</label>'
						+'<label class="contact-info_param"><input type="text" placeholder="多选" name="param'+paramIndex+'" value="'+obj.name+'"/></label><span class="param-option"></span><a class="button mr20 add-option" onclick="addOption(this)">添加选项</a><a class="iconfont icon-shanchu1" onclick="deleteParam(this)"></a>'
					+'</div>'
					break;
			}
			$('#contact-info_more-param').append(add_param_html)

			paramIndex++

		}
		/**
		*删除字段
		*/
		function deleteParam(obj){
			$(obj).parents('.contact-info_param_info').remove()
		}
		/**
		*添加选择题的选项
		*@param obj为当前对象
		*/
		function addOption(obj){
			//渲染的选项布局
			var option_html='<span class="option-box"><input type="text" value="" name="" class="input_param-option mr20" onblur="setStyle(this)"><span class="button param-option_item mr20"><font class="option-text mr20"></font><font class="del-icon" onclick="delOption(this)">×<font></span></span>'
			$(obj).siblings('.param-option').append(option_html)
			
		}
		/**
		*失去焦点
		*/
		function setStyle(obj){
			var objVal = $(obj).val()
			$(obj).siblings('span.param-option_item').find('.option-text').text(objVal)
			$(obj).hide().siblings('span.param-option_item').css('display','inline-block')
		}
		/**
		*删除选择题的选项
		*/
		function delOption(obj){
			$(obj).parents('.option-box').remove()
		}
		/**
		 * 编辑页面填充报名表单
		 */	
		if($("#json").val().trim()){
			//字段的赋值
			var formArr = JSON.parse($("#json").val());
			for(var n=2;n<formArr.length;n++){
				addParam(formArr[n].type,formArr[n])
			}

			//必选的赋值和子项目赋值
			$('#contact-info_more-param .contact-info_param_info').each(function(index) {
				var _index = index+2;
				if(formArr[_index].required==true){
						$(this).find('.param-label').children('input[type="checkbox"]').prop("checked", true)
					}else{
						$(this).find('.param-label').children('input[type="checkbox"]').prop("checked", false)
					}
					if(formArr[_index].content && formArr[_index].content.length){
						for(var c=0;c<formArr[_index].content.length;c++){
							
							var option_html='<span class="option-box"><span class="button param-option_item mr20" style="display:inline-block"><font class="option-text mr20">'+formArr[_index].content[c]+'</font><font class="del-icon" onclick="delOption(this)">×<font></span></span>'
							
							$(this).find('.param-option').append(option_html)	
						}
					}
			});
		}
		<?php }?>	
	</script>
	<?php }?>
		

</body>
</html>