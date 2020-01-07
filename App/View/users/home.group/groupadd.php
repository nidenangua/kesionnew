<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title><?php if(empty($id)){ echo '添加'; }else{echo '编辑'; }?>折扣卡</title>

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
		.knowledge{ position: relative;min-height: 650px;}
		.knowledge-left{width:199px; position: absolute;left:0;top:30px;border-right:1px solid #eee;height: 100%;}
		.knowledge-left .curr{color:#e5412c}

		.liveCsecond a{display: block; line-height: 34px;}
		<?php }?>
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
		.buytimebox{
			display: none;
		}
	</style>
</head>
<body class="ks-wrap">

<div class="ks-wbox bRadius10">
	<div class="ks-head-nav">
		<!--标题-->
		<a href="javascript:history.go(-1);">折扣卡</a><em>/</em><?php if(empty($id)){ echo '添加'; }else{echo '编辑'; }?>折扣卡			<!--标题-->
	</div>
	<div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，科汛V名师保有依据国家规定及平台规则进行处理的权利。</div>
	<div class="knowledge">

		<div class="knowledge-right">
			<!--基本资料-->
			<form target="hidframe"  id="myform" class="form-horizontal" action="<?php echo M_URL($this->AppName.'/Index','doGroupAdd',$id,GP(''));  ?>" method="post" enctype="multipart/form-data">
				<div class="form-title2">基本信息</div>
				<div class="form-box">
					<div class="form-row">
						<span class="name name-nowrap">折扣卡名称<i class="form-star">*</i></span>
						<div class="form-limit" limit="30">
							<input type="text" class="form-textbox" name="name" value="<?php if(isset($value)) echo $value["name"] ?>" />
						</div>
					</div>
					<div class="form-row" style="max-width: 600px">
						<span class="name name-nowrap">简短描述(用于微信分享)</span>
						<div class="form-limit" limit="45">
							<input type="text" class="form-textbox" name="shortdesc" value="<?php if(isset($value)) echo $value["shortdesc"] ?>" />
						</div>
					</div>
					<div class="form-row" >
						<span class="name name-nowrap">折扣卡封面<i class="form-star"></i></span>
						<div class="form-upimg">

							<div class="defaultpic images" style="background-image:url('<?php if(!empty($value["defaultpic"])){echo Img($value["defaultpic"]);}else{ echo nopic(0);} ?>');"></div>
							<div class="clearfix">
								<div class="ks-bt bt-pur" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic,type-other'));?>','1000px','640px',{title:'选择图片',type:'top'});">上传图片</div>
							</div>
							<input type="hidden" name="defaultpic">
							<div class="form-tips pt20">建议尺寸750*525px，JPG、PNG格式， 图片小于1M。</div>
						</div>
					</div>
					<div class="form-row">
						<span class="name name-nowrap">折扣卡详情<i class="form-star"></i></span>
						<div  class="rightTd alignLife form-editor">
							<?php  $value1=!empty($value["detailintro"])?Img($value['detailintro']):'';$kindeditor = ks_editor('detailintro',$value1,'1',editorNum4(),'100%'); echo $kindeditor;?>
						</div>
					</div>
					<div class="form-title">商品信息</div>

					<div class="form-box" style="min-height: auto;">
						<div class="form-gray">
							<div class="form-row">
								<div class="clearfix">
									<label class="radioLabel fl" style="margin-right: 14px;">
										<span class="name name-nowrap">折扣卡类型</span>
									</label>
									<label class="radioLabel fl">
										<input onclick="isFree(this)" type="radio" class="radioInput" value="1" name="type" <?php if(isset($value)){if($value["type"]==1)echo "checked"; }else{echo 'checked';}?>>优惠折扣
									</label>
									<label class="radioLabel fl">
										<input onclick="isFree(this)" type="radio" class="radioInput" value="2" name="type" <?php if(isset($value)){if($value["type"]==2)echo "checked"; }?>>全站免费
									</label>
                                    <label class="radioLabel fl">
                                        <input onclick="isFree(this)" type="radio" class="radioInput" value="3" name="type" <?php if(isset($value)){if($value["type"]==3)echo "checked"; }?>>答疑会员
                                    </label>
								</div>

                                <?php if ($value["type"] != 3){
                                    ?>
                                    <div class="pricebox" id="discount" style="margin-top: 7px;<?php if(isset($value)&&$value["type"]==2){echo 'display: block;';}?>">
                                        <div class="item">
                                            <span>购买优惠</span><input type="text" name="discount" class="form-textbox w180 price_box" placeholder="请输入折扣" value="<?php if(isset($value["discount"])){ echo $value["discount"]; }?>" />折（数值为0-10之间）
                                        </div>
                                    </div>
                                    <div class="clearfix" id="other" style="margin-top: 7px;<?php if(isset($value)&&$value["type"]==2){echo 'display: none;';}?>">
                                        <label class="radioLabel fl" style="margin-right: 14px;">
                                            <span class="name name-nowrap">其他优惠</span>
                                        </label>
                                        <label class="radioLabel fl">
                                            <input type="radio" class="radioInput" value="0" name="other" <?php if(isset($value)){if($value["type"]==1 && $value["other"]==0)echo "checked"; }?>>否
                                        </label>
                                        <label class="radioLabel fl">
                                            <input type="radio" class="radioInput" value="1" name="other" <?php if(isset($value)){if($value["type"]==1  && $value["other"]==1)echo "checked"; }else{echo 'checked';}?>>是
                                        </label>
                                        （如果选择否，用户将不能再使用优惠券等）
                                    </div>
                                    <?php
                                } ?>


								<div class="pricebox" id="pricebox" style="<?php if(isset($value)&&$value["type"]==2){echo 'display: block;';}?>margin-top: 7px;">
									<div class="item">
										<span>售卖价格</span><input type="text" name="price" class="form-textbox w180 price_box" placeholder="请输入价格" value="<?php if(isset($value["price"])){ echo $value["price"]; }?>" ktj-price /> 元
									</div>
									<div class="item">
										<span>划线价格</span><input type="text" name="price_market" class="form-textbox w180 price_box" placeholder="请输入划线价格（选填）" value="<?php if(isset($value["price_market"])){ echo $value["price_market"];} ?>" ktj-price/> 元
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-row clearfix" id="buytime_box"  >
						<div class="clearfix pt10" id="singleKeshi">
							<div class="form-row">
								<span class="name name-nowrap">有效时长<i class="form-star">*</i>&nbsp;&nbsp;<span style="color: red;font-size: 12px">该会员享有优惠折扣的有效时间</span></span>
								<div class="mt10 clearfix">
									<div class="fl">
										<select class="form-textbox " name="effectivetime" style="width: 600px">
											<option value="1" <?php if(isset($value)&&$value['effectivetime']==1) echo 'selected' ?>>1个月</option>
											<option value="2" <?php if(isset($value)&&$value['effectivetime']==2) echo 'selected' ?>>3个月</option>
											<option value="3" <?php if(isset($value)&&$value['effectivetime']==3) echo 'selected' ?>>6个月</option>
											<option value="4" <?php if(isset($value)&&$value['effectivetime']==4) echo 'selected' ?>>一年</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-row" id="costlevel" style="max-width: 600px;<?php  if($value["type"]==3){echo 'display: none;';}?>">
						<span class="name name-nowrap">消费额度<i class="form-star">*</i>&nbsp;&nbsp;<span style="color: red;font-size: 12px">自购买本VIP折扣卡起，累计消费的金额。通过本卡折扣后总消费额超过消费额度后需原价购买</span></span>
						<input type="text" class="form-textbox" style="width:250px;" name="costlevel" value="<?php echo isset($value)?$value["costlevel"]:'0'; ?>" ktj-price /> 元（设置为0额度不限）。
					</div>
					<div class="form-title">显示设置</div>
					<div class="form-box" style="min-height: auto;">
						<div class="form-row clearfix">
							<span class="name name-nowrap">是否前台显示</span>
							<div class="form-switch" open-value="1">
								<?php if(isset($value)){?>
									<label for="isshow0"><input type="radio" value="1" name="status" <?php if(!empty($value)){if($value['status']==1){echo 'checked="checked"';}}?>></label>
									<label for="isshow1"><input type="radio" value="0" name="status" <?php if(!empty($value)&&$value['status']==0){ echo 'checked="checked"';}?>></label>
								<?php }else{?>
									<label for="isshow1"><input type="radio" value="1" name="status"></label>
									<label for="isshow1"><input type="radio" value="0" name="status" checked="checked"></label>
								<?php }?>
							</div>

						</div>
					</div>
					<div class="form-footer clearfix">
							<span class="d-inline-block">
								<input type="hidden" name="typea" id="typea"  />
								<input type="button" class="ks-bt bt-pue" onclick="do_reg();" value="确认保存" id="saveBack">
<!--						        <button onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>-->
                                <a class="ks-bt bt-pue" href="javascript:history.go(-1);" >取消</a>
					    	</span>
					</div>
			</form>
		</div>

	</div>
</div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','Jcrop','cookie','plupload','laydate'],function(){
		$('.knowledge-right').css('min-height',(window.innerHeight-240)+'px');
		var type = $('input:radio[name="type"]:checked').val();
		(type == 0) && $('#pricebox').hide();
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
	function do_reg(){
		var title = $("input[name='title']").val();
		if(title==''){Alert('名称不能为空');return false}
		if($('#separate').attr('checked')){
			var price = $('input[name="price"]').val();
			var price2 = $('input[name="price_market"]').val();
			for(i=0;i<$('input[name="type"]').length;i++){
				if($('input[name="type"]')[i].value==1&&$('input[name="type"]')[i].checked==true){
					if(price<=0){
						Alert('价格需要大于0');return false
					}
					var reg = /(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/;
					if(reg.test(price)) {}else{
						Alert('价格输入有误');return false;
					}
				}
			}
		}
		$("#myform").submit()
	};
	function isFree(el){
		document.getElementById('pricebox').style.display = el.value == 0 ? 'none' : 'block'
		document.getElementById('buytime_box').style.display = el.value == 0 ? 'none' : 'block'
		document.getElementById('costlevel').style.display = el.value == 1 ? 'block' : 'none'
		document.getElementById('discount').style.display = el.value == 1 ? 'block' : 'none'
		document.getElementById('other').style.display = el.value == 1 ? 'block' : 'none'
	}
</script>



</body>
</html>