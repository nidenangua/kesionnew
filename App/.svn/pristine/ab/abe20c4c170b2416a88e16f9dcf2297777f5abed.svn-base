<!doctype html>
<html id="html">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
	.selectImageBtn{text-align:center;cursor:pointer;display:inline-block;background:none;border:none;min-width:120px;} 
#vodInfo {width: 120px;overflow:hidden;margin-top: 20px;padding: 10px;padding-bottom: 0;border: 1px solid #eee;}
.vodInfo-img img {width: 100%;}
#vdoName {overflow: hidden;text-overflow: ellipsis;white-space: nowrap}
</style>
</head>
	<div style="padding: 25px;">
		<?php include  CURR_VIEW_PATH . "head.php";?> 
		<div class="courseBox clearfix mt20">
			<form target="hidframe"  id="myform" class="form-horizontal" action="<?php if(isset($course)){echo M_URL($this->AppName.'/Index','doedit',$courseid,GP(''));}else{echo M_URL($this->AppName.'/Index','doadd','',GP(''));} ?>" method="post" enctype="multipart/form-data">
			<div class="lLightBox bg-white bRadius10  borderSo">
				<?php include  CURR_VIEW_PATH . "menu.php";?> 
			</div>
			
			<div class="lRightBox">
				<div class="ml20 bRadius10 bg-white  borderSo"  style="position: relative; overflow: hidden;">
					<div class="bg-white bRadius10 ">
						<div class="bg-white bRadius10 borderSo ks-wbox clearfix">
							<div class="form-tip-blick"></div>
							<div class="form-tip-word">基本资料</div>
						</div>
						<div class="form-box bRadius10  bg-white  form-upload-box" id="lisHeight">
						
							<div class="form-upload">
								<div class="js_uploadBox">
									<div class="js_showBox bRadiusn">
										<img class="defaultpic js_logoBox block "  src="<?php if(!empty($course["defaultpic"])){echo Img($course["defaultpic"]);}else{ echo nopic(0);} ?>"  >
									</div>
									<div class="btn-upload clearfix">
										<a href="javascript:void(0);"  onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic,type-top'));?>','930px','610px',{title:'选择图片',type:'top'});"   class="selectImageBtn"><span class="js_uploadText" >上传图片</span></a>
										<p>限制：2MB,支持jpg|png|gif</p> 
										<input type="hidden" name="defaultpic">
									</div>
								
								</div>
							
							</div>
							
							<div class="form-row clearfix">
								<span class="name name-nowrap">课程名称</span>
								<div class="form-limit" limit=60>
									<input type="text" class="form-textbox" name="title" value="<?php if(isset($course["title"])) echo $course["title"] ?>" >
								</div>
							</div>
							
							<div class="form-row clearfix">
								<span class="name name-nowrap">课时模式</span>
								<label for="inlineRadio11">
								<input type="radio" id="inlineRadio11" value="0"   class="radioInput coursehour"  name="coursehour" <?php if(isset($course["chargetype"])){if($course["coursehour"]==0)echo "checked"; }else{echo 'checked';}?>>单课时</label>
								<label for="inlineRadio12">
								<input type="radio" id="inlineRadio12" value="1"  class="radioInput coursehour" name="coursehour" <?php if(isset($course["chargetype"])){if($course["coursehour"]==1)echo "checked"; }?> >系列课</label>
							</div>
							
							<div  class="form-row clearfix" id="vod" >
								<div  class="name add-float" style="float: none;">
									<span class="fl mr10">视频</span>
									<button class="ks-bt bt-def" type="button" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','getVodList',$courseid,GP("chapterid-0")) ?>','850px','600px',{title:'选择视频',type:'top'});">
									选择视频</button>
								</div >   
								<div  class="rightTd alignLife">
									<div id="vodInfo">
										<div class="vodInfo-img"><img id="vodImg"  width="100px" src='<?php if(!isset($vdo['vdoImg'])){ echo '/Public/uploads/common/vod.jpg' ;}else{echo $vdo['vdoImg'];}; ?>'></div> 
										<div id="vdoName"><?php if(isset($vdo)){echo $vdo['vdoName'];} ?></div>
									</div>
									<input type="hidden"  name="playurl1" id="playurl1" value="<?php if(isset($vdo)) echo $vdo["vdoId"]; ?>" class="form-textbox">
								</div >
							</div >       
							
							<?php if(iscategory($this->wxid,$this->appid)&&($this->module[0]==1)){ ?>
								<div class="form-row clearfix">
								<span class="name name-nowrap"><?php echo categoryName($this->wxid) ?></span>
							<?php echo $Linkage->Linkage(1);?>
								</div>
							<?php } ?>
							
							<div class="form-row clearfix">
								<span class="name name-nowrap">课程简要介绍</span>
								<div class="form-limit" limit=240>
									<textarea name="intro" rows="3" cols="20" class="form-textarea" placeholder="请输入内容" ><?php if(isset($course["intro"])) echo $course["intro"] ?></textarea>
								</div>
							</div>
							
							<div class="form-row clearfix">
								<span class="name name-nowrap">收费方式</span>
								<label for="inlineRadio9"><input type="radio" id="inlineRadio9" value="0"   class="radioInput"  name="chargetype" <?php if(isset($course["chargetype"])){if($course["chargetype"]==0)echo "checked"; }else{echo 'checked';}?>>免费</label>
								<label for="inlineRadio7"><input type="radio" id="inlineRadio7" value="1"  class="radioInput" name="chargetype" <?php if(isset($course["chargetype"])){if($course["chargetype"]==1)echo "checked"; }?> >收费</label>
							</div>
							
							<div class="form-row clearfix charge1">
								<span class="name name-nowrap">售价</span>
								<input type="text" class="form-textbox prices" name="price" value="<?php if(isset($course["price"])) echo $course["price"] ?>" >
							</div> 
						</div> 
						<input type="hidden" name="typea" id="typea"  />
					</div>     
					<div class="pb15 ks-bom ks-fixed-bom clearfix">
						<div class="fl ">
							<input  type="button" onclick="do_reg(2);" class="ks-bt bt-pue mr10 fn" value="保存进入下一步">	
							<input  type="button" onclick="do_reg(1);" class="ks-bt bt-white mr10 fn" value="保存返回列表">
							<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="ks-bt bt-white fn">取消返回列表</a>
						</div>
					</div>
				</div>
			</div>
			
			</form>
		</div>
	</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>

	module.require(['backstage','nicescroll'],function(){
		loadScorllJs();
		$(".prices").keyup(function () {
		var reg = $(this).val().match(/\d+\.?\d{0,2}/);
		var txt = '';
		if (reg != null) { txt = reg[0];}
			$(this).val(txt);
		}).change(function(){ $(this).keyup();});
		
		var chargetype = $('input:radio[name="chargetype"]:checked').val();
		if(chargetype == 0 || chargetype == 2){
			$('.charge1').hide();
		}
		$('input:radio[name="chargetype"]').change(function(){
			var chargetype = $('input:radio[name="chargetype"]:checked').val();
			if(chargetype == 0 || chargetype == 2){ $('.charge1').hide();}else{$('.charge1').show();}
		}); 
		changehour();
		$('input:radio[name="coursehour"]').change(function(){
			changehour();
		});
		
	});
	
	
	function do_reg(type){
		$('#typea').val(type); 
		var title        = $("input[name='title']").val();
		if(title==''){Alert('课程名称不能为空');return false;}	
		$("#myform").submit();
	}	
	function changehour(){
		var coursehour = $('input:radio[name="coursehour"]:checked').val();
		if(coursehour==1){
			$('#vod').hide();
		}else{
			$('#vod').show();
		}
	} 
 	
</script>
</body>
</html>