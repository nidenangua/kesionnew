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
	.sjmoney{display: none;}
	.Created-Content input[type='number']{
		border: solid 1px #e5e5e5;
    height: 34px;
    border-radius: 3px;
	}
</style>
<body class="gray-bg">
<div id="manage_top" class="menu_top_fixed  p15 height73" style="z-index: 3;">
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;<?php if(!isset($values)){ echo'新增任务'; }else{ echo'编辑任务'; }?>
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
<?php if(!isset($values)){ ?> 
<form target="hidframe"  class="form-horizontal" action="<?php echo M_URL('Task','doaddtask')?>" method="post" enctype="multipart/form-data">
<?php }else{?>
<form target="hidframe"  class="form-horizontal" action="<?php echo M_URL('Task','doedittask',$values['id'])?>" method="post" enctype="multipart/form-data">	
<?php }?>
<div class="Created-push">
		<ul>
			
			<li>
				
				<div class="Created-ing">
					<ul>
						  
						<li>
							<h4>任务名称:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content item">
								<input type="text" class="long-text" name="name"  value="<?php if(isset($values)){echo $values['name'];} ?>" />
								
							</div>
						</li> 
						<li>
							<h4>任务内容:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content clearfix">
								<?php $contents = '';
									if(isset($values)){
										$contents = $values['content'];
									}
									echo ks_editor('content',$contents,2,"toolbars: [[
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
						<li>
							<h4>详情介绍链接:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content item">
								<input type="text" class="long-text" name="link" value="<?php if(isset($values)){echo $values['link'];} ?>" />
								
							</div>
						</li> 
						<li>
							<h4>任务类型:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content item">
								<select name="type" class="w150 inputText bRadius5 " onchange="if($(this).val()!=6&&$(this).val()!=9&& $(this).val() != 8){$('#countbox').hide()}else{$('#countbox').show()}">
									<option value="0">请选择任务类型</option>
									<?php foreach($alltypeary as $k=>$v){
											if(isset($values)){
												if($v['type']==$values['type']){?>
										          <option value="<?php echo $v['type']?>" selected><?php echo $v['name'];?></option>
									             <?php }else{?>
										           <option value="<?php echo $v['type']?>"><?php echo $v['name'];?></option>
									             <?php }
										    }else{?>
										         <option value="<?php echo $v['type']?>"><?php echo $v['name'];?></option>
									        <?php }
									}?>
								</select>
								<div style="float: right;margin-right: 828px;<?php if(isset($values)){if($values['type']!=6&&$values['type']!=9&& $v['type'] != 8){echo 'display: none;';}}else{echo 'display: none;';}?>" id='countbox'>
									具体值：<input type="text" class="inputText bRadius5 " name="numerical" value="<?php if(isset($values)){echo $values['numerical'];} ?>" style="    width: 273px;">
								</div>
									
								
								
							</div>
						</li> 
						<li>
							<h4>奖励方式:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content clearfix">
								<label for="ishot1"><input type="radio" name="rewardway" onclick="show(1)"   value="1" <?php if(isset($values)){if($values['rewardway']=='1'){ echo "checked";}}else{echo "checked";} ?>>固定金额</label>
								<label for="ishot2"><input type="radio" name="rewardway"  onclick="show(2)"  value="2" <?php if(isset($values)){if($values['rewardway']=='2'){ echo "checked";}} ?>>随机金额</label>
							</div>
						</li>  
						<li class="money" <?php if(isset($values)){if($values['rewardway']==2){ echo "style='display:none;'";}} ?>>
							<h4>金额:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content item">
								<input type="text" class="long-text" name="money" onkeyup="check(this)"   value="<?php if(isset($values)){echo $values['money'];} ?>" />
								
							</div>
						</li> 
						<li class="sjmoney" <?php if(isset($values)){if($values['rewardway']==2){echo  "style='display:block;'";}} ?>>
							<h4>最小金额:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content item">
								<input type="text" class="long-text " name="minmoney" onkeyup="check(this)"  value="<?php if(isset($values)){echo $values['minmoney'];} ?>" />
								
							</div>
						</li> 
						<li class="sjmoney" <?php if(isset($values)){if($values['rewardway']==2){echo  "style='display:block;'";}} ?>>
							<h4>最大金额:<em class="need" style="left: 40px;top: -10px;">*</em> </h4>
							<div class="Created-Content item">
								<input type="text" class="long-text " name="maxmoney" onkeyup="check(this)"  value="<?php if(isset($values)){echo $values['maxmoney'];} ?>" />
								
							</div>
						</li> 
						<li>
							<h4>有效期限:</h4>
							<div class="Created-Content">
								<select name="validity" class="w150 inputText bRadius5 ">
									<option value="0">请选择有效期限</option>
									 <option value="2" <?php if(isset($values)){if($values['validity']==2){echo 'selected';}}?>>2天</option>
									 <option value="5" <?php if(isset($values)){if($values['validity']==5){echo 'selected';}}?>>5天</option>
									 <option value="7" <?php if(isset($values)){if($values['validity']==7){echo 'selected';}}?>>7天</option>
									 <option value="10" <?php if(isset($values)){if($values['validity']==10){echo 'selected';}}?>>10天</option>
									 <option value="15" <?php if(isset($values)){if($values['validity']==15){echo 'selected';}}?>>15天</option>
									
								</select>					
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
            <button type="submit" class="btn btn-tool btn-s-md" ><?php if(!isset($values)){echo '确定添加';}else{echo '确定修改';} ?></button>
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

		function check(target){
			
			var reg = $(target).val().match(/[0-9\.]+/g);
			
			var __value = '';
			$(reg).map(function(){
				this && (__value += this)
			});
			if(__value.indexOf('.')!==-1){
				var v = __value.split('.');
				__value = v[0];
				__value += '.'+v[1].match(/\d{0,2}/)[0]
				$(target).val(__value)
			}else{
				$(target).val(__value)
			}
		}



function show(type){
	if(type==1){
		$('.money').show();
		$('.sjmoney').hide()
	}else{
		$('.sjmoney').show();
		$('.money').hide()
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
