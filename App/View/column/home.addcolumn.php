<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<title><?php if(empty($this->columnInfoid)){ echo '添加'; }else{echo '编辑'; }?>专栏</title>
	
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
		<?php if($this->setting[3]==1){?>
		.knowledge{ position: relative;padding-left: 240px; min-height: 650px;}
		.knowledge-left{width:199px; position: absolute;left:0;top:30px;border-right:1px solid #eee;height: 100%;}
		.knowledge-left .curr{color:#e5412c}
		
		.liveCsecond a{display: block; line-height: 34px;}
		<?php }?>
</style>
</head>
<body class="ks-wrap">
	
		<div class="ks-wbox bRadius10">
			<div class="ks-head-nav">
				<!--标题-->
				<a href="javascript:history.go(-1);">专栏管理</a><em>/</em><?php if(empty($this->columnid)){ echo '添加'; }else{echo '编辑'; }?>专栏		<!--标题-->
			</div>
			<div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，科汛V名师保有依据国家规定及平台规则进行处理的权利。</div>
			<div class="knowledge">
				<div class="knowledge-right">
					<!--基本资料-->
					<form target="hidframe"  id="myform" class="form-horizontal" action="<?php if(isset($columnInfo)){echo M_URL($this->AppName.'/Index','doedit',$this->columnid,GP(''));}else{echo M_URL($this->AppName.'/Index','doaddcolumn','',GP(''));} ?>" method="post" enctype="multipart/form-data">
						<div class="form-title2">基本信息</div>
						<div class="form-box">
							<div class="form-row">
								<span class="name name-nowrap">专栏名称<i class="form-star">*</i></span>
								<div class="form-limit" limit="30">
									<input type="text" class="form-textbox" name="title" value="<?php if(isset($columnInfo)) echo $columnInfo["title"] ?>" />
								</div>
							</div>
							<div class="form-row" style="max-width: 600px">
								<span class="name name-nowrap">简短描述(用于微信分享)</span>
								<div class="form-limit" limit="45">
									<input type="text" class="form-textbox" name="shortdesc" value="<?php if(isset($columnInfo)) echo $columnInfo["shortdesc"] ?>" />
								</div>
							</div>
							<div class="form-row" >
								<span class="name name-nowrap">专栏封面<i class="form-star">*</i></span>
								<div class="form-upimg">
									
									<div class="defaultpic images" style="background-image:url('<?php if(isset($columnInfo)){echo Img($columnInfo["defaultpic"]);}else{ echo nopic(0);} ?>');"></div>
									<div class="clearfix">
										<div class="ks-bt bt-pur" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic,type-other'));?>','1000px','640px',{title:'选择图片',type:'top'});">上传图片</div>
									</div>
									<input type="hidden" name="defaultpic">
									<div class="form-tips pt20">建议尺寸750*525px，JPG、PNG格式， 图片小于1M。</div>
								</div>
							</div>
							<div class="form-row">
								<span class="name name-nowrap">专栏简介<i class="form-star">*</i></span>
								<div  class="rightTd alignLife">
									<textarea class="form-textarea" name="intro"><?php if(isset($columnInfo)){echo $columnInfo["intro"];}?></textarea>
								</div>	
							</div>
							
							
							<div class="form-row">
								<span class="name name-nowrap">专栏详情<i class="form-star">*</i></span>
								<div  class="form-editor">
								<?php  $value=isset($columnInfo["detailintro"])?Img($columnInfo['detailintro']):'';$kindeditor = ks_editor('detailintro',$value,'1',editorNum4(),'100%'); echo $kindeditor;?>
								</div>	
							</div>
							<div class="form-row">
								<span class="name name-nowrap">销量设置</span>
								<div class="form-limit" limit="6" style="max-width: 100px;">
									<input type="number" class="form-textbox" name="soldnum" value="<?php if(isset($columnInfo["soldnum"])) echo $columnInfo["soldnum"] ?>" />
								</div>
							</div>
							<div class="form-row clearfix">
				                <span class="name name-nowrap">文字防复制</span>
				               	<div class="form-switch" open-value="1">
				                    <label for="isshow0"><input type="radio" value="1" name="iscopy" <?php if(isset($columnInfo["iscopy"])&&$columnInfo['iscopy']==1){ echo 'checked="checked"';}?>></label>
				                    <label for="isshow1"><input type="radio" value="0" name="iscopy" <?php if(isset($columnInfo["iscopy"])){if($columnInfo['iscopy']==0){echo 'checked="checked"';}}else{echo 'checked="checked"';}?>></label>
								</div>
				            </div>
							<div class="form-tips">商品的文字内容允许复制，图片点击放大和长按识别二维码功能则允许使用。</div>

						</div>
						<div class="form-title">商品信息</div>
						
						<div class="form-box" style="min-height: auto;">	
							<div class="form-gray">
								<div class="form-row">
									<span class="name name-nowrap">售卖价格<i class="form-star">*</i></span>
									<div class="clearfix">
									    <label class="radioLabel fl">
											<input onclick="isFree(this)" type="radio" class="radioInput" value="1" name="chargetype" <?php if(isset($columnInfo)){if($columnInfo["chargetype"]==1)echo "checked"; }else{echo 'checked';}?>>收费
									    </label>
									 	<label class="radioLabel fl">
											<input onclick="isFree(this)" type="radio" class="radioInput" value="2" name="chargetype" <?php if(isset($columnInfo)){if($columnInfo["chargetype"]==2)echo "checked"; }?>>打赏
										</label>
									    <label class="radioLabel fl">
											<input onclick="isFree(this)" type="radio" class="radioInput" value="0" name="chargetype" <?php if(isset($columnInfo)){if($columnInfo["chargetype"]==0)echo "checked"; }?>>免费
									 	</label>
									</div>
									
									<div class="pricebox" id="pricebox">
										<div class="item">
											<span>商品价格</span><input type="text" name="price" class="form-textbox w180" placeholder="请输入价格" value="<?php if(isset($columnInfo["price"]))echo $columnInfo["price"];?>" ktj-price /> 元
										</div>
										<div class="item">
											<span>划线价格</span><input type="text" name="price_market" class="form-textbox w180" placeholder="请输入划线价格（选填）" value="<?php if(isset($columnInfo["price_market"]))echo $columnInfo["price_market"];?>" ktj-price/> 元
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-title">上架设置</div>
						<div class="form-box" style="min-height: auto;">	
							<div class="form-row clearfix">
				                <span class="name name-nowrap">是否上架</span>
				               	<div class="form-switch" open-value="2">
				               		<?php if(isset($columnInfo)){?>
				                    <label for="isshow0"><input type="radio" value="2" name="status" <?php if(isset($columnInfo)){if($columnInfo['status']==2){echo 'checked="checked"';}}?>></label>
				                    <label for="isshow1"><input type="radio" value="0" name="status" <?php if(isset($columnInfo)&&$columnInfo['status']==0){ echo 'checked="checked"';}?>></label>
				                <?php }elseif(isset($setting)){if($setting[1]==1){?>
                                   <label for="isshow0"><input type="radio" value="2" name="status" checked="checked"></label>
				                <?php }else{?>
				                	 <label for="isshow1"><input type="radio" value="0" name="status" checked="checked"></label>
				                <?php }}else{?>
				                	<label for="isshow1"><input type="radio" value="0" name="status" checked="checked"></label>
				                	<label for="isshow0"><input type="radio" value="2" name="status" ></label>
				                <?php }?>
								</div>
				
				            </div>
						</div>
						<div class="form-footer clearfix">
							<span class="d-inline-block">
								<input type="hidden" name="typea" id="typea"  />
								
								<input type="button" class="ks-bt bt-pue" onclick="do_reg(1);" value="保存返回" id="saveBack">
								
						        <button onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>
					    	</span>
						</div>
					</form>
					

				</div>
				
			</div>
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage'],function(){	
			
			
			$('.knowledge-right').css('min-height',(window.innerHeight-240)+'px');
				var chargetype = $('input:radio[name="chargetype"]:checked').val();
				
				(chargetype == 0 || chargetype == 2) && $('#pricebox').hide();

			});
		//接收图片返回值
		top.imgUploadBack = function(src,img){
			$('.defaultpic').css('background-image','url('+src+')');
			$('input[name="defaultpic"]')[0].value = img;
		};
		function vod(__name,__src){
	        getId('file_Name').innerHTML = __name;
			getId('fileName').value = __name;
			getId('fileUrl').value = __src
		}
		function do_reg(type){
			getId('typea').value = type;
			var title = $("input[name='title']").val();
			if(title==''){Alert('专栏名称不能为空');return false}
	        var price = $('input[name="price"]').val();
	        var price2 = $('input[name="price_market"]').val();
	        for(i=0;i<$('input[name="chargetype"]').length;i++){
	        	if($('input[name="chargetype"]')[i].value==1&&$('input[name="chargetype"]')[i].checked==true){
		        	if(price<=0 ||price2<=0){
			        	Alert('价格需要大于0');return false
			        } 
			        var reg = /(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/;
			        if(reg.test(price)&&reg.test(price2)) {}else{
			        	Alert('价格输入有误');return false;
			        }
		        }
	        }
	        
			$("#myform").submit()
		};
		function isFree(el){
			document.getElementById('pricebox').style.display = el.value == 1 ? 'block' : 'none'
		}
	</script>

	

</body>
</html>