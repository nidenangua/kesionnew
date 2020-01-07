<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css"> 
	.fn{float:none!important;}
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;}
	.Created-ing>ul li h4 {font-weight: normal;}
	.need {left: 40px;top: -10px;font-size: 24px;}
</style>
<body class="gray-bg"  id="ksBoxContent" >

<div >
<form target="hidframe" class="form-horizontal" action="<?php if(empty($value)){echo M_URL('Temp','tempdoAdd');}else{echo M_URL('Temp','tempdoEdit',$value['tempid'],GP('p-'.$now_page));} ?>" id="myform" method="post" enctype="multipart/form-data">
<div class="Created-push"style="position: relative;">
		<ul>
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>基本信息</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box form-upload-box" style="padding-top: 0;">
					<div class="Created-ing">
					<ul>
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>模板标题:<em class="need">*</em></h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="tempname" value="<?php if(!empty($value)){echo $value['tempname'];} ?>">
							</div>
						
						</li>
						<input name="temptype" value="<?php echo $temptype ;?>" type="hidden">
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>模板适用:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
				                    <input name="skintype" id="temptype1" type="radio" <?php if(!empty($value)){if($value['skintype']=='0'){echo ' checked="checked" ';}}else{echo ' checked="checked" ';} ?> value="0"><label for="temptype1">通用</label>
				                </div>
                                <div class="radio radio-info  radio-inline">
				                    <input name="skintype" id="temptype4" type="radio" <?php if(!empty($value)){if($value['skintype']=='1'){echo ' checked="checked" ';}} ?> value="1"><label for="temptype4">个人</label>
				                </div>				                
                                <div class="radio radio-info  radio-inline">
				                    <input name="skintype" id="temptype3" type="radio" <?php if(!empty($value)){if($value['skintype']=='2'){echo ' checked="checked" ';}} ?> value="2"><label for="temptype3">企业</label>
				                </div>
				               
							</div>
						</li>
						<?php if ($temptype!=3) {?>
						<li>
							<h4>模板目录:</h4>
							<div class="form-group radio-tabs val-0" >
					        <select class="form-control" style="min-width: 150px;max-width: 200px;" name="installdir">
					            <option value="">-选择模板目录-</option>
					            <?php foreach($dirname as $k=>$v){?>
					            <option <?php if(!empty($value)){if(strtolower($value['installdir'])==strtolower($v)){echo 'selected="selected"';}}?> value="<?php echo $v;?>"><?php echo str_replace(ROOT.TP_DIR.DS,"",$dir).$v;?></option>
					            <?php }?>
					        </select>
							</div>
						</li>
						<?php }?>
						<li>
							<h4>可使用版本:</h4>
							<div class="Created-Content clearfix">

                                 <div class="col-sm-4">
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input type="checkbox" id="allowversion1"  value="v1" <?php if(isset($value)){if(strstr($value['package'],"v1")){echo "checked";}}?> name="allowversion[]">
                                                <label for="allowversion1">基础版</label>
                                            </div>
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input type="checkbox"  id="allowversion2" value="v2" <?php if(isset($value)){if(strstr($value['package'],"v2")){echo "checked";}}?> name="allowversion[]">
                                                <label for="allowversion2">高级版</label>
                                            </div>
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input type="checkbox"  id="allowversion3"  value="v3" <?php if(isset($value)){if(strstr($value['package'],"v3")){echo "checked";}}?> name="allowversion[]">
                                                <label for="allowversion3">钻石版</label>
                                            </div>
                                        </div>
                                        ( tips：所有版本可以用的话，请不要勾选。)

							</div>
						</li>
						<li>
							<h4>模板价格:</h4>
							<div class="Created-Content">
								<input type="text"  id="price"  name="price" value="<?php if(!empty($value)){echo $value['price'];}else { echo '0';} ?>">		
									<select style="width: 50px" name="chargetype">
							            <option <?php if(!empty($value)){if($value['chargetype']==0){echo 'selected="selected"';}}?> value="0">月</option>
							            <option <?php if(!empty($value)){if($value['chargetype']==1){echo 'selected="selected"';}}?> value="1">季</option>
							            <option <?php if(!empty($value)){if($value['chargetype']==2){echo 'selected="selected"';}}?> value="2">年</option>
							        </select>				
							</div>
							<script>
							$("#price").keyup(function () {
							    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
							    var txt = '';
							    if (reg != null) {txt = reg[0];}
							    $(this).val(txt);
							}).change(function () {
							    $(this).keyup();
							});
							</script>
						</li>
						<li>
							<h4>config.json:</h4>
							<div class="Created-Content">
								<textarea class="form-control" style="min-height: 150px" name="configjson"><?php if(!empty($value)){echo $value['configjson'];} ?></textarea>
							</div>
						</li>
						<li>
							<h4>head.json:</h4>
							<div class="Created-Content">
								<textarea class="form-control" style="min-height: 150px" name="headjson"><?php if(!empty($value)){echo $value['headjson'];} ?></textarea>
							</div>
						</li>
						<li>
							<h4>foot.json:</h4>
							<div class="Created-Content">
								<textarea class="form-control" style="min-height: 150px" name="footjson"><?php if(!empty($value)){echo $value['footjson'];} ?></textarea>
							</div>
						</li>
						<li>
							<h4>style.color:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text"  name="stylecolor" value="<?php if(!empty($value)){echo $value['stylecolor'];} ?>">
							</div>
						</li>
						<li>
							<h4>style.json:</h4>
							<div class="Created-Content">
								<textarea class="form-control" style="min-height: 150px" name="stylejson"><?php if(!empty($value)){echo $value['stylejson'];} ?></textarea>
							</div>
						</li>
						<li>
							<h4>模板作者:<em class="need">*</em></h4>
							<div class="Created-Content">
								<input type="text" class="long-text"  name="author" value="<?php if(!empty($value)){echo $value['author'];}else{ echo("科汛V名师官方");} ?>">						
							</div>
						</li>
						<li>
							<h4>模板简要介绍:</h4>
							<div class="Created-Content">
								<textarea class="form-control" style="min-height: 150px" name="intro"><?php if(!empty($value)){echo $value['intro'];} ?></textarea>
							</div>
						</li>
						<li>
							<h4>发布时间:</h4>
							<div class="Created-Content">
								<input id="testtime" class="laydate-icon form-control" value="<?php if(!empty($value)){echo date('Y-m-d H:i:s',$value['adddate']);}else{ echo KS_DATE(time()); } ?>" name="adddate" aria-required="true" style="height: 34px; width: 360px;"> 
							</div>
						</li>

						<li>
							<h4>模板状态:</h4>
							<div class="Created-Content clearfix">
								<label for="ispub1"><input type="radio" id="ispub1" name="ispub" value="0" <?php if(!empty($value)){   if ($value['ispub']=='0') echo ' checked=true'; }else{ echo 'checked=true'; } ?>/>未发布</label>
								<label for="ispub2"><input type="radio" id="ispub2" name="ispub" value="1"<?php if(!empty($value)){   if ($value['ispub']=='1') echo ' checked=true'; } ?>/>已发布</label>
							</div>
						</li>

						<li>
							<br />
							<br />
						
						</li>
					</ul>
					
				</div>
				
					<div class="form-upload">
		          		<div class="js_uploadBox">
		          			<div class="js_showBox" style="border-radius:0 ;"><img class="js_logoBox block defaultpic" onerror="this.src='//ks.kesion.com/Public/uploads/common/nopic.gif'" src="<?php if(!empty($value)){echo $value['defaultpic'];} ?>"></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn" >
			                    	<span class="js_uploadText">上传图片</span></a>
			                    <p>限制：2MB,支持jpg|png|gif</p> 
			                    <input type="hidden" name="defaultpic">
			               </div>
					    </div>
		          	</div>
				</div>
				
				
			</li>
			</ul>
		
	</div>
	
</form>	
<div class="footer-page h60">
			<div style="text-align: center;position: absolute;bottom: 20px;width: 300px;left: 50%;margin-left: -150px; top: 10px;">
				<button type="button" onClick="do_reg()" class="btn btn-tool btn-s-md bt-pue" ><?php if(empty($value)){echo '确定添加';}else{echo '确定修改';} ?></button>
           		<button onClick="location.href = '<?php echo(M_URL("Temp","","",GP('temptype-'.$temptype))); ?>';"  class="btn bt-gray  btn-s-md" >取消</button>
			</div>
	</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
<script type="text/javascript">
top.imgUploadBack = function(src,img){
	$('.defaultpic')[0].src = src;
	$('input[name="defaultpic"]')[0].value = src;
};	
	
datatime('#testtime')
$("#tablist li").click(function(){
	$("#tablist li").removeClass("active"); 
	$(this).addClass("active");
	var index = $(this).index();
	$(".Created-push").removeAttr("id")
	console.log(index);
	$(".Created-push").eq(index).attr("id","active");
})
radiotabs('temptype','.radio-tabs');
function do_reg(){
	var tempname  = $("input[name='tempname']").val();
	var author    = $("input[name='author']").val();
	if (tempname == '') { Alert('模板标题不能为空'); $("input[name='tempname']").focus();return false;}	
	if(author ==''){Alert('模板作者不能为空');return false;}	
	$("#myform").submit();	
} 
</script>
</html>


