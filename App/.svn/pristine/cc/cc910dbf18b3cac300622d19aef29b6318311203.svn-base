<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<title>添加课时</title>
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">	
	<style></style>
</head>
<body class="ks-wrap<?php if($this->courseType != 4){ echo ' pt10 pb0'; } ?>">
	
<?php if($this->courseType == 4){ ?>
	
	<div class="ks-wbox bRadius10">
		<div class="ks-head-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">图文管理</a><em>/</em><a href="javascript:history.go(-1);">编辑图文</a><em>/</em>添加课时
			<!--标题-->
		</div>
		
	<?php }?>
	<form target="hidframe" id="myform"  action="<?php  if($typeKeshi == 'add'){echo M_URL($this->AppName.'/Index','doaddkeshi',$this->courseid,GP(''));} 
				 else{echo M_URL($this->AppName.'/Index','doeditkeshi',$this->courseid,GP("chapterid-$chapterid"));} ?>" method="post" class="form-horizontal">
		
	<div id="wrap-box">
		<?php if($this->course['chapterTemplate'] == 1 || $this->course['chapterTemplate'] == 2){  ?>
	
		<?php if($this->courseType == 4){ ?>
		<div class="form-box">
			<div class="form-row">
				<span class="name name-nowrap">所属课程</span>
				<div class="fsize16"><?php echo $this->course['title'] ?></div>
			</div>
		<?php }?>
			
			<div class="form-row">
			
				<span class="name name-nowrap">所属章节<i class="form-star">*</i></span>
				<select class="form-textbox w300" name="parentid">
	            <?php
					foreach($chapterAll as $k=>$v){
						 $html="<option value='$v[chapterid]' ";
	                if($v['chapterid']==$parentid)
	                {
	                    $html=$html."selected = 'selected'";
	                }
	                if($this->course['chapterTemplate']==1){
	                   if($v['depth']==1){
	                   	    $html=$html."disabled";
	                   }
	                }   
	                $html=$html.">".KS_INDENT($v['depth'])."$v[title]</option>" ;
	                echo $html;
					}
					
	            ?>
	    		</select>
			</div>
			<?php } ?>
			<div  class="form-row">

		     	<div  class="name name-nowrap"><?php echo $this->courseType==5?'课时名称':'标题'?> <i class="form-star">*</i></div >
			 	<div  class="form-limit"  limit="50">
			   		<input type="text"  name="title" value="<?php if(isset($chapter))echo $chapter["title"]; ?>" class="form-textbox" required>
			 	</div >
			</div >
			<?php if($this->courseType==1||$this->courseType==3){?>
			<div class="form-row clearfix" style="margin-bottom: 20px;">
		     	<div class="name fl mr10">是否可以试听</div >
			 	<div class="fl" style="margin-top:3px">
			 		<input type="checkbox" name="is_audition" value="1" class="new-form" <?php if(isset($chapter)){if($chapter['json']['is_audition']){echo 'checked';}} ?>>
			 	</div >
		   	</div>
			<div  class="form-row">
				<div  class="name name-nowrap">试听时间 <i class="form-star">*</i><span style="color: red">(秒单位，设置0表示不限制)</div >
				<input type="text"  name="audition_time" value="<?php if(isset($chapter))echo $chapter['json']["audition_time"]; ?>" class="form-textbox" required>
			</div >
		   	<?php }else{if($this->course['chargetype']==1&&$this->courseType!=5){?>
		   	<div class="form-row clearfix" style="margin-bottom: 20px;">
		     	<div class="name fl mr10">是否免费阅读</div >
			 	<div class="fl" style="margin-top:3px">
			 		<input type="checkbox" name="freeplay" value="1" class="new-form" <?php if(isset($chapter)){if($chapter['freeplay']){echo 'checked';}} ?>>
			 	</div >
		    </div>
		   	<?php }}?>
			<?php if($this->courseType==2){?>
			<div class="form-row">
				<span class="name name-nowrap">直播时间<i class="form-star">*</i></span>
				<div class="mt10 clearfix">
					<div class="ks-head-tbox fl"><font class="mr10 fsize14">开始时间</font><span class="ks-head-ticon"><i class="iconfont icon-date"></i></span><input type="text"  name="begindate" class="form-textbox w200 selectLiveTime" value="<?php if(isset($chapter['begindate']))echo date('Y-m-d H:i:s',$chapter['begindate']); ?>"/></div>
					<div class="fl">
						<font class="ml20 mr10 fsize14">直播时长</font><select class="form-textbox w120" name="livehours"><option value="1" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==1))echo 'selected="selected"'; ?>>1小时</option><option value="1.5" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==1.5))echo 'selected="selected"'; ?>>1.5小时</option><option value="2" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==2))echo 'selected="selected"'; ?>>2小时</option><option value="2.5" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==2.5))echo 'selected="selected"'; ?>>2.5小时</option><option value="3" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==3))echo 'selected="selected"'; ?>>3小时</option><option value="5" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==5))echo 'selected="selected"'; ?>>5个小时</option><option value="24" <?php if(isset($chapter['livehours'])&&($chapter['livehours']==24))echo 'selected="selected"'; ?>>1天</option></select>
					</div>
				</div>
			</div>
			<div class="form-row" >
				 <span class="name name-nowrap">直播方式</span>
						<label class="radioLabel">
								<input type="radio" class="radioInput" value="1" name="livetype" <?php if(!empty($chapter)){if($chapter['livetype']==1){echo 'checked="checked"';}}else{echo 'checked="checked"';}?>>语音+图文
						</label>
						<div class="clear blank10"></div>
						<!--<label class="radioLabel">
							<input type="radio" class="radioInput" value="0" name="livetype" <?php if(!empty($chapter)&&$chapter['livetype']==0){ echo 'checked="checked"';}?>>视频+图文
						</label>-->
					</div>
			</div>

			<?php }elseif($this->courseType==1 || $this->courseType==3){?>
			<!--音频或点播-->
			<?php if($this->courseType==1){?>
			<div  class="form-row clearfix">
		     	<div  class="name name-nowrap">文件上传<i class="form-star">*</i></div >
				<div class="form-tips pt10">格式支持mp4、mov、avi，建议大小不超过1G。</div>
				<iframe name="uploadVod" src="/home.html#/uploadVod?callback=vod" style="display:none"></iframe>
<!--	     		<div class="ks-heade-button ks-head-primary fl mt10" onclick="$(frames['uploadVod'].document).find('button').click()">本地上传</div>-->
				<div class="ks-bt bt-pur mt10 ml10" onclick="addTypeChange('/home.html#/getVodList?from=popup','850px','600px',{title:'选择视频',data:function(__name,__src){vod(__name,__src);}});">选择文件</div> 
				
			</div>
			<div class="item audiomodul">
				<h4 class="info" id="file_Name"><?php if(isset($vdo)){echo $vdo['vdoName'];} ?><?php if(isset($vdo)){?>__<a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','viewplay','',GP("videoId-".$chapter["videoId"]))?>','800px','630px',{title:'预览',type:'top'});">点击预览</a><?php } ?></h4>
			</div>
			<input id="fileUrl" type="hidden" name="fileurl" value="<?php if(isset($chapter)) echo $chapter["videoId"]; ?>"/>
			<input id="fileName" type="hidden" name="filename" />
			<?php }else{ ?>
			<div  class="form-row clearfix" id="singleKeshi">
		     	<div  class="name name-nowrap">文件上传<i class="form-star">*</i></div >
				<div class="form-tips pt10">格式支持mp3、m4a，为保证音频加载与播放的流畅性，建议上传大小不超过50M</div>
<!--				<div id="selectfiles" class="ks-heade-button ks-head-primary" style="position: relative; z-index: 1;">选择本地</div><div id="container" style="display: none;"></div>-->
				<div class="ks-bt bt-pur fn" style="margin:5px 0 0 5px" onclick="selectFile('<?php echo M_URL('Index','wxfile','',GP('name-555,type1-3,type-fn,chektype-1'));?>')">选择文件</div> 
				<input id="fileUrl" type="hidden" name="fileurl" value="<?php if(isset($chapter['videoId'])) echo $chapter['videoId']; ?>"/>
			    <input id="fileName" type="hidden" name="filename" />
				<div class="item audiomodul">
			        <h4 class="info" id="file_Name">
			        <?php if(isset($chapter['videoId'])&&!empty(Img($chapter['videoId'],0,'filename'))){?><?php echo Img($chapter['videoId'],0,'filename');?>(<?php echo Img($chapter['videoId'],0,'size');?>M)__<a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','audioplay',$this->courseid,GP("chapterid-".$chapter["chapterid"]))?>','600px','130px',{title:'<?php echo Img($chapter['videoId'],0,'filename');?>(<?php echo Img($chapter['videoId'],0,'size');?>M)',type:'top'});">点击试听</a>
				    <?php }?>
				</h4>
			    </div>
			</div>	
			<?php } ?>
			<?php }elseif($this->courseType==4){?>
			<div class="form-row" id="tryIt">
				<span class="name name-nowrap">试看内容</span>
				<div  class="rightTd alignLife" style="max-width:750px;width:100%;margin-bottom: 20px;" >
				<?php  $value=!empty($chapter["intro"])?$chapter['intro']:'';$kindeditor1 = ks_editor('intro',$value,'1',editorNum4(),'100%');  echo $kindeditor1;?>
				</div>
			</div>
			
			<div class="form-row">
				<span class="name name-nowrap">图文详情<i class="form-star">*</i></span>
				<div  class="form-editor">
				<?php  $value=!empty($chapter["content"])?$chapter['content']:'';$kindeditor = ks_editor('content',$value,'1',editorNum4(),'100%'); echo $kindeditor;?>
				</div>	
			</div>
		
		<?php if($this->courseType == 4){ echo '</div>'; } ?>
		
		<?php }elseif($this->courseType == 5) {?>
				<div  class="form-row">
					<div  class="name name-nowrap">上课时间 <i class="form-star">*</i></div >
					<div  >
						<input type="text"  name="begindate3" value="<?php if(isset($chapter))echo KS_DATE($chapter["begindate"]); ?>" class="form-textbox w200 selectLiveTime" required>
					</div >
				</div >
		<?php }?>
	</div>
	<div class="form-footer clearfix">
		<span class="d-inline-block">
			<input  type="button" onclick="do_reg();" class="ks-bt bt-pue mr10" value="确认保存">
			<?php if($this->courseType == 4){ ?>
			<a href="javascript:history.go(-1)" class="ks-bt bt-white">取消返回</a>
			<?php }else{?>
			<a href="javascript:top.closePopup(window.name)" class="ks-bt bt-white">取消返回</a>
			<?php }?>
	       	
	    </span>
	</div>

	</form>
	
<?php if($this->courseType == 4){ echo '</div>'; } ?>	
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script src="<?php echo UOOT;?>Public/common/js/aliyun/es6-promise.min.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/aliyun/aliyun-oss-sdk4.13.2.min.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/aliyun/aliyun-upload-sdk1.3.1.min.js" type="text/javascript"></script>		
	<script>
		module.require(['$','backstage','laydate','plupload'],function(){
			$('#wrap-box').css('min-height',(window.innerHeight-100)+'px');
			<?php if($this->courseType==3){?>
			ossWebUpload(false,<?php echo $this->wxid;?>,'0',{type:'3',
				success:function(res){
					   getId('file_Name').innerHTML = res.name+'('+res.size+')';
					   getId('fileUrl').value = res.Jmimg;
				}
		    });
			
			<?php }?>
			<?php if($this->courseType==2||$this->courseType==5){?>
			//选择直播时间
//			laydate.render({
//			  elem: '#selectLiveTime'
//			  ,type:'datetime'
//			})
			lay('.selectLiveTime').each(function(){
				laydate.render({
					elem: this,
					trigger: 'click',
					type:'datetime'
				});
			});
			<?php }elseif($this->courseType==4){?>
			isFree();
			$('[name="freeplay"]')[0].onchange = function(){
				isFree()
			};
			function isFree(){
				getId('tryIt').style.display = $('[name="freeplay"]')[0].checked ? 'none' : 'block'
			}
			<?php }?>
		});
		function vod(__name,__src){
	        getId('file_Name').innerHTML = __name;
			getId('fileName').value = __name;
			getId('fileUrl').value = __src
		}
		function selectFile(__url){
			top.popup.open(__url,{
				area:['1000px','620px'],
				title:'选择文件',
				data:function(__name,__url){
					getId('file_Name').innerHTML = __name;
					getId('fileName').value = __name;
					getId('fileUrl').value = __url
				}
			})

		}
		
		function do_reg(){
			if(!$('[name="title"]').val().replace(/\s+/g,'')){
				Alert('请先输入标题');
				return false
			};
			<?php if($this->courseType==1 || $this->courseType==3){?>
			if(!getId('fileUrl').value){
				Alert('请先选择文件');
				return false
			};
			<?php }?>
			$('#myform').submit()
			
		}

</script>
</body>
</html>