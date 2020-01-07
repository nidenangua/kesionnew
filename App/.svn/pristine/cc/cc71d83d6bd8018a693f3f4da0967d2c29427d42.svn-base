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
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
<div  class="clearfix">	
	<span class="form-tip fl">
	    <span class="form-tip-blick"></span>
	    <span class="form-tip-word">素材管理</span>
	</span>
	<div class="fr">
		<select class="w150 hLh35 inputText" id="keytype">
			<option value="0" <?php if(isset($keytype) and $keytype==0)echo 'selected';?>>请查询</option>
			<option value="1" <?php if(isset($keytype) and $keytype==1)echo 'selected';?>>标题</option>
			<option value="2" <?php if(isset($keytype) and $keytype==2)echo 'selected';?>>已上传</option>
			<option value="3" <?php if(isset($keytype) and $keytype==3)echo 'selected';?>>未上传</option>
		</select>
		<div class="fr ks-top-search">
			<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	       	<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','replySucai'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" >
	       		<i class="iconfont icon-sousuo"></i>
	       	</button>
		</div>
	</div>
</div>
<form>

<div >		 
	   <ul class="Suwrap" style="width: 100%; overflow: hidden;padding-bottom: 20px;padding-right: 5px;"> 
     <?php foreach($tuwen as $v){ ?>
		  	<li class="clearfix posRe">
			  	<div class="Suin">
			  		<div class="SuinImg">
			  			<span class="SuinHover">
				  			<div class="SuinDaow"></div>
				  			<div class="SuninChose">
				  				<i class="iconfont icon-xuanze3 c-green" style="font-size: 50px;"></i>
				  			</div>
			  			</span>
			  			
			  			<input class="SuninRa" type="radio" id="less<?php echo $v['id'];?>"  name="sucaibox" value="<?php echo $v['id'];?>">
			  			
			  			<img onerror="this.src='<?php echo nopic();?>'" src="<?php if($v["pic"]!=''){echo Img($v["pic"]);}else{echo '/Public/uploads/common/nopic.gif';}?>"  style="width:100%;height:100%;"  >
			  		</div>
			  		<div class="SuinMark mt5">
				  		<div class="hLh30 SuinTitle"><?php echo $v['titles'];?></div>
				  		<div class="SuinSt"><?php echo $v['author'];?>//<?php if(empty($v['media_id'])){echo "未上传";}else{echo "已经上传";}?></div>
				  		<div class="hLh30 SuinMediaid" style="display:none;"><?php echo $v['media_id'];?></div>
				  		<div class="hLh30 Suinabstract" style="display:none;"><?php echo $v['abstract'];?></div>
			  		</div>
			  		
			      
				</div>
		  	</li>
		<?php } ?>
	</ul>  
</div>
</form>
        <?php echo NoC($tuwen);?>
<div class="ks-bom clearfix">
	<input type="button" class="ks-bt bt-pue SuinPost" id="abc"  value="确认" name="confirm" />
	<div class="fr"><?php echo $page->show(3); ?></div>	
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
		Suinabstract=$(this).next().find(".Suinabstract").text();
		
//		console.log(SuinSrc+'|'+SuinId+'|'+SuinTitle+"|"+SuinSt);
	//	console.log(SuinSt);
	})
	
	$(".SuinPost").click(function(){
		var state=0;
		$('.SuinHover').each(function(){
			if($(this).css("display") == 'inline'){
				state++;
       data='<div class="Suin" style="margin-left: 2px;"><div class="SuinImg"><input class="SuninRa" type="hidden" name="sucaiid" required value="'+SuinId+'">';
		data+='<img  src="'+SuinSrc+'"  style="width:100%;height:100%;"  ></div><div class="SuinMark mt5">';
		data+='<div class="hLh30 SuinTitle">'+'标题： '+SuinTitle+'</div><div class="SuinSt">'+'作者：'+SuinSt+'</div>';
//		data+='<div class="hLh30 Suinabstract">'+'简介: '+Suinabstract+'</div></div></div>';
        data+='<input type="hidden" name="pic" id="" value="'+SuinSrc+'" />';
		data+='<input type="hidden" name="titles" id="" value="'+SuinTitle+'" />';
		data+='<input type="hidden" name="media_id" id="" value="'+SuinMediaid+'" />';

  	    top.frames["main"].$("#<?php echo $abc ?>").html(data);
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