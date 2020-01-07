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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wbox" style="overflow: hidden;">
<div id="ksBoxHead" class="clearfix">	
	<span class="form-tip fl">
	    <span class="form-tip-blick"></span>
	    <span class="form-tip-word">课程选择</span>
	</span>
	<div class="fr">
		<select class="w150 hLh35" id="keytype">
			<option value="0" <?php if(isset($keytype) and $keytype==0)echo 'selected';?>>请查询</option>
			<option value="1" <?php if(isset($keytype) and $keytype==1)echo 'selected';?>>标题</option>
			<option value="2" <?php if(isset($keytype) and $keytype==2)echo 'selected';?>>姓名</option>
		
		</select>
		<div class="fr ks-top-search">
			<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	       	<input type="submit" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','replyCourse'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
		</div>
	</div>
</div>
<form>

<div id="ksBoxContent">		 
	   <ul class="Suwrap" style="width: 100%; overflow: hidden;padding-bottom: 20px;padding-right: 5px;"> 
     <?php foreach($course as $v){ ?>
		  	<li class="clearfix posRe">
			  	<div class="Suin">
			  		<div class="SuinImg">
			  			<span class="SuinHover">
				  			<div class="SuinDaow"></div>
				  			<div class="SuninChose">
				  				<i class="iconfont icon-xuanze3 c-green" style="font-size: 50px;"></i>
				  			</div>
			  			</span>
			  			
			  			<input class="SuninRa" type="radio" id="less<?php echo $v['courseid'];?>"  name="sucaibox" value="<?php echo $v['courseid'];?>">
			  			
			  			<img onerror="this.src='<?php echo nopic();?>'" src="<?php if($v["defaultpic"]!=''){echo '/'.XImg($v["defaultpic"],0);}else{echo '/Public/uploads/common/nopic.gif';}?>"  style="width:100%;height:100%;"  >
			  		</div>
			  		<div class="SuinMark mt5">
				  		<div class="hLh30 SuinTitle"><?php echo $v['title'];?></div>
				  		<div class="hLh30 SuinSt"><?php echo $v['name'];?>//<?php if(empty($v['media_id'])){echo "未上传";}else{echo "已经上传";}?></div>
				  		<div class="hLh30 SuinMediaid" style="display:none;"><?php echo $v['media_id'];?></div>
				  		<div class="hLh30 Suinintro" style="display:none;"><?php echo $v['intro'];?></div>
				  		<input type="hidden" class="Suinauthor" name=""  value="<?php echo $v['name'];?>"/>
				  		<input type="hidden" class="Suintext" name=""  value='<?php echo XImg($v['content'],2);?>'/>
				  		<input type="hidden" class="Suinlinkurl" name=""  value="http://www.baidu.com"/>
				  
            		</div>
              </div>
		  	</li>
		<?php } ?>
	</ul>  
</div>
</form>

<div id="ksBoxFooter" style="height: 100px;">
	<input type="button" class="ks-bt bt-pue SuinPost" id="abc"  value="确认" name="confirm" />
	<div class="mt20"><?php echo $page->show(3); ?></div>	
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
	var SuinSrc,SuinId,SuinTitle,SuinSt,data,SuinMediaid;
	$(".SuinImg").click(function(){
	//	$("input[type=radio]").removeAttr("checked")
		$(this).find("input[type=radio]")[0].checked = true;
		$(".SuinHover").hide();
		$(this).find(".SuinHover").show();
		SuinSrc=$(this).find("img").attr("src");
		SuinId=$(this).find(".SuninRa").val();
		SuinTitle=$(this).next().find(".SuinTitle").text();
		SuinSt=$(this).next().find(".SuinSt").text();
		SuinMediaid=$(this).next().find(".SuinMediaid").text();
		Suinintro=$(this).next().find(".Suinintro").text();
		
		Suinauthor=$(this).next().find(".Suinauthor").val();
		Suintext=$(this).next().find(".Suintext").val();
		Suinlinkurl=$(this).next().find(".Suinlinkurl").val();		
//		console.log(SuinSrc+'|'+SuinId+'|'+SuinTitle+"|"+SuinSt);
	//	console.log(SuinSt);
	})
	$(".SuinPost").click(function(){
		var state=0;
		$('.SuinHover').each(function(){
			if($(this).css("display") == 'inline'){
				state++;
				data='<div class="Suin"><div class="SuinImg"><input class="SuninRa" type="hidden" required name="courseid" value="'+SuinId+'">';
				data+='<img  src="'+SuinSrc+'"  style="width:100%;height:100%;"></div><div class="SuinMark mt5">';
				data+='<div class=" SuinTitle">'+'名称： '+SuinTitle+'</div><div class="SuinSt">'+'授课老师：'+SuinSt+'</div>';
		//		data+='<div class="hLh30 Suinintro">'+'课程介绍： '+Suinintro+'</div></div></div>';
				data+='<input type="hidden" name="url" id="" value="'+SuinSrc+'" />';
				data+='<input type="hidden" name="titles" id="" value="'+SuinTitle+'" />';
				data+='<input type="hidden" name="media_id" id="" value="'+SuinMediaid+'" />';
				
                top.frames["main"].$("#<?php echo $ab; ?>").html(data);
				 /****犯返回值 仅用于微信素材管理，误删！***/
		  	    top.frames["main"].$(".xz").find(".showImg").attr("src",SuinSrc);
				top.frames["main"].$(".xz").find(".pic").val(SuinSrc);
				top.frames["main"].$(".xz").find(".titleMark").text(SuinTitle);
				top.frames["main"].$(".xz").find(".title").val(SuinTitle);
				
				top.frames["main"].$(".xz").find(".author").val(Suinauthor);
				top.frames["main"].$(".xz").find(".text").val(Suintext);
				top.frames["main"].$(".xz").find(".abstract").val(Suinintro);
				top.frames["main"].$(".xz").find(".linkurl").val(Suinlinkurl);  	   
				parent.closePopup(window.name);
			}
				
		});
		if(state == 0){
			Alert("请选择一项");
		}
	})

</script>
</body>
</html> 