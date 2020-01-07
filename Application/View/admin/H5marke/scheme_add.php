<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php if(!isset($app)){echo '添加应用';}else{echo '修改应用';} ?></title>

<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.Created-title{margin-left: 15px;}
	.Created-title span:nth-of-type(2){margin-left: 1px;}
</style>
<body class="gray-bg">
<div id="manage_top" class="menu_top_fixed  p15 height73" style="z-index: 3;">
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;<?php if(empty($values)){ echo'新增营销方案'; }else{ echo'编辑营销方案'; }?>
        </h3>
        
		<div class="fr">
           <div class="fl ks-top-search">
			<!--搜索-->
				<button type="button" class="ks-bt bt-def back"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div> 
              
               
        </div>
    </div>
</div>	
<br /><br /><br />	
<?php if(empty($values)){ ?> 
<form target="hidframe"  class="form-horizontal" action="<?php echo M_URL('H5market','doaddscheme')?>" method="post" enctype="multipart/form-data">
<?php }else{?>
<form target="hidframe"  class="form-horizontal" action="<?php echo M_URL('H5market','doeditscheme')?>" method="post" enctype="multipart/form-data">	
<?php }?>
<div class="Created-push">
		<ul>
			
			<li>
				
				<div class="Created-ing">
					<ul>
						<li>
							<input name="id" type="hidden" value="<?php if(!empty($values)){echo $values['id'];} ?>"/>
							<h4>方案名称:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="name" flag='活动名称' value="<?php if(!empty($values)){echo $values['name'];} ?>">
								<em class="need">*</em>
							</div>
						</li>
						<li>
							<h4>添加时间:</h4>
							<div class="Created-Content">
								<input type="text"  id="time" class="long-text laydate-icon" name="time" flag='添加时间' value="<?php if(!empty($values)){echo date('Y-m-d',$values['addtime']);} ?>">
								<em class="need">*</em>						
							</div>
						</li>
						
						<li>
							<h4>方案作者:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="author" flag='应用作者' value="<?php if(!empty($values)){echo $values['author'];} ?>">	
								<em class="need">*</em>					
							</div>
						</li>
						
						
						
						<li>
							<h4>是否收费:</h4>
							<div class="Created-Content clearfix" id="changeRaido">
								<label for="mianfree1"><input id="mianfree1" name="marketing" type="radio" value="0" flag='收费模式' <?php if(!empty($values)){if($values['marketing']==0){ echo "checked";}} ?>><?php echo wx_version_itemvalue('','',2);?></label>
								<!--<label for="mianfree2"><input id="mianfree2" name="marketing" type="radio" value="1" flag='收费模式' <?php if(!empty($values)){if($values['marketing']==1){ echo "checked";}} ?>>收费</label>-->
								<label for="mianfree3"><input id="mianfree3" name="marketing" type="radio" value="2" flag='收费模式' <?php if(!empty($values)){if($values['marketing']==2){ echo "checked";}} ?>>绑定版本</label>
							</div>
						</li>
						
						<span class="showBan" id="canuse">
						<li>
							<h4>可使用版本:</h4>
							<div class="Created-Content clearfix">
								<!--<label for="package2"><input id="package2" name="package" type="radio" flag='套餐版本' value="v1" <?php if(!empty($values)){if($values['package']=='v1'){ echo "checked";}} ?>><?php echo wx_version_itemvalue('','',2);?></label>-->
								<label for="package2"><input id="package2" name="package" type="radio" flag='套餐版本' value="v2" <?php if(!empty($values)){if($values['package']=='v2'){ echo "checked";}} ?>><?php echo wx_version_itemvalue('','',3);?></label>
								<label for="package4"><input id="package4" name="package" type="radio" flag='套餐版本' value="v3" <?php if(!empty($values)){if($values['package']=='v3'){ echo "checked";}} ?>><?php echo wx_version_itemvalue('','',4);?></label>	
							</div>
						</li>
						</span>
						
						 
						<span class="showBan" id="timesuse"> 
						
						</span>
						<li>
							<h4>是否为热门方案:</h4>
							<div class="Created-Content clearfix">
								<label for="ishot1"><input type="radio" name="ishot" id='ishot1'  value="1" <?php if(!empty($values)){if($values['ishot']=='1'){ echo "checked";}} ?>>是</label>
								<label for="ishot2"><input type="radio" name="ishot" id='ishot2'  value="0" <?php if(!empty($values)){if($values['ishot']=='0'){ echo "checked";}} ?>>否</label>
							</div>
						</li>  
						<li>
							<h4>方案类型:</h4>
							<div class="Created-Content">
								<select name="type" id="type" flag='活动时间'>
									<?php foreach($scheme as $k =>$v){?>
									<option value="<?php echo $v['id']; ?>" <?php if(!empty($values)){if($values['type']==$v['id']){ echo "selected";}} ?>><?php echo $v['name'];?></option>
									<?php }?>
									
								</select>
							</div>
						</li>
						
						<li>
							<h4>方案内容:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content clearfix">
								<?php $contents = '';
									if(!empty($values)){
										$contents = $values['contents'];
									}
									echo ks_editor('contents',$contents,2,"toolbars: [[
            'fullscreen','source', 'undo', 'redo', '|',
			, 'myinsertimage', 'myinsertvideo', 'mymusic', 'myattachment', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'map','emotion', 'scrawl', 'insertframe', 'insertcode', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen', '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
            'print', 'preview', 'searchreplace', 'drafts', 'help'
        ]]",'100%','300px');
								?>
							</div>
						</li>  
					</ul>
					
				</div>
				
				
			</li>
		</ul>
		<br /><br /><br /><br /><br />
	</div>	

	
	<div class="footer-page">
        <div class="col-sm-5"></div>
        <div class="col-sm-6 mt10">
            <button type="submit" class="btn btn-tool btn-s-md" ><?php if(empty($values)){echo '确定添加';}else{echo '确定修改';} ?></button>
            <a href="javascript:history.go(-1);" class="btn  btn-s-md" style="background: #CCCCCC;">取消</a> 
        </div>
    </div>
</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function csh(){
	var values = $("#changeRaido input:checked").val();
	$(".showBan").hide(); 
	if(values==1){
		$("#timesuse").show();
		$("#priced").show();
	}else if(values==2){
		$("#canuse").show();
	}
}
csh();
	//版本切换
	
		
	
		$("#changeRaido input").click(function(){
		var values = $(this).val();

		$(".showBan").hide(); 
		if(values==1){
			$("#timesuse").show();
			$("#priced").show();
		}else if(values==2){
			$("#canuse").show();
		}

	})	
						
			
    $(function(){
        taps();//选项卡
        uploadView('100','100');//图片上传	
//      datatime('#test');//时间选择器
        radioTaps();
        loadScorllJs();
        datatime('#time')
        //判断是否选中	
        //$("input[name='isweb']").reset();	
    });
    top.imgUploadBack = function(editname,data){
		UE.getEditor(editname).execCommand('insertHtml',data);
	};
</script>

</body>

</html>
