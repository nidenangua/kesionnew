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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
	.ks-txtLeft h3{height: 20px;line-height: 20px;margin-bottom: 10px;}
	.ks-first {margin-left: -15px;padding-left: 10px;border-left:3px solid #2878FF}
	.ml50{margin-left: 50px!important;}
	.check-crb{padding: 30px;text-align: center;}
	.check-empty{text-align: center;font-size: 16px;color:#333;margin-bottom: 20px;}
	.check-icon {display: inline-block;width: 45px;height: 45px;border-radius: 50%;background: red;vertical-align: middle;text-align: center;line-height: 45px;margin-bottom: 10px;}
	.check-icon i{font-size: 24px;color: #fff;}
</style>
</head>
<body class="ks-wrap">
<div id="ksBoxHead">
	<!--结束-->
	<div class="Header-tool clearfix">
		<div class="Tool-Title">
		<!--标题-->
		<p>
			<a href="<?php echo M_URL('Website'); ?>"><i class="iconfont icon-jiantou-copy"></i>网站设置</a><span>/</span>短信设置
		</p>
		<!--标题-->
		</div>
		<!--操作范围-->
		<!--按钮组件-->
		<div class="Tool-btnGroup">
		  <div class="fr">
		   <!-- <ul>
		    	<li class="fl">
		        	<label class="c-red" for="">短信剩余条数 <?php echo  !empty($smsnum) ?  $smsnum :0  ?>条</label>
		        </li>
		        <li class="fl">
		       		<a class="ks-bt bt-def" href="<?php echo M_URL($this->AppName.'/Index','config','',GP('')); ?>"><i 
class="iconfont icon-shezhi"></i>短信配置</a>
		        </li>
		    </ul>-->
		  		<div class="mt20">
					   <div class="fr">
						<span class="name-nowrap fl fsize14 hLh30 mr10">是否开启短信</span>
						<div class="form-switch fl clearfix" open-value="1">
	                        <label for="isshow0">
	                        	<input type="radio" name="issms" value="1"  <?php if(isset($issms))if($issms ==1) echo 'checked'; ?> 

class="radioInput">启用
	                        </label>
	                        <label for="isshow1">
	                        	 <input type="radio" name="issms" value="0"  <?php if(isset($issms))if($issms ==0) echo 'checked'; ?> 

class="radioInput">不启用
	                        </label>
						</div>
					</div>
				</div>
	    	</div>
		</div>
		<!--按钮组件-->
		<!--操作范围-->
	</div>
		<div class=" mt20 clearfix">
			<div class="ks-clist">
				<ul class="clearfix">
				<li>
            	<div class="ks-cbox clearfix">
					<div class="fl ks-txtLeft" style="width: 100%;">
						<h3 class="ks-first">短信使用情况</h3>
						<p>累计充值短信：<i class="c-2878FF"><?php echo getLimitService(1,1);?></i>条 
							<span class="ml50">剩余短信 <span class="c-86A8F ml10" style="margin-right:0;"><?php echo getLimitService(1);?></span>条<a href="<?php echo M_URL('Shop','consumptionRecord',1);?>" class="c-86A8F " style="margin-left: 20px;">购买</a></span> <a href="<?php echo M_URL($this->AppName.'/Index','config','',GP('')); ?>
" class=" ks-bt bt-pue" style="float: right;margin-top: -7px;">查看短信使用明细</a>
						</p>
					</div>
				</div>
		        </li>
				</ul>
			</div>
		</div>
			<div class=" mt20 clearfix">
			<div class="ks-clist">
				<ul class="clearfix">
				<li>
            	<div class="ks-cbox clearfix">
            		<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','smssign','',GP('')); ?>" method="post" id="myform1" > 		
					<div class="fl ks-txtLeft ks-wauto">
						<h3 class="ks-first">短信签名</h3>
						<p>
							<input type="text" class="form-textbox w200 fl" <?php if($smssignstatus!=0){?>disabled="disabled"<?php }?> name="signsms" value="<?php echo $signvalue['signsms'];?>">
							<?php if($smssignstatus==0){?>	 
							<button <?php if($realnamestatus==1){?>type="submit"<?php }else{?>type="button" onClick="checkAffirm();"<?php }?> class="ks-bt bt-pue ml ml10">提交审核</button>
							<?php }elseif($smssignstatus==1){ ?>
							<span style="color: red;display:inline-block ;margin-left:10px ;">审核中</span>
							<?php }elseif($smssignstatus==2){ ?>
							<span style="color: green;display: inline-block;margin-left:10px">审核通过</span>
							<?php }?>
						</p>
					</div>
					</form>
				</div>
		        </li>
				</ul>
			</div>
		</div>
</div>
<div class="bRadius10 bg-white ks-wbox mt20 " >
    <div class="infoBox">
        <div class="webConBox ">
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','doUpdateSms','',GP('')); ?>" method="post" id="myform" >        
            <div class="configTab clearfix" style="display: block" id="ksBoxContent">
            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
	            <thead>
		            <tr>
		            	<th style="width: 120px;position: relative;"> <input type="checkbox" class="select-checks selectAll "><span style="position: absolute;right: -10px;top:10px;">是否启用</span></th>
		            	<th>模板名字</th>
		                <th class="alignCenter hLh40 pt0 pb0 fsize14">内容</th>    
		            </tr>
	            </thead>
	            <tbody>
  <?php foreach($values as $k=>$v){ ?>
		            <tr>
		                <td class="alignLife hLh40 pt0 pb0 fsize14 c-92">	<input type="hidden" name="id[]" value="<?php echo $v['id'] ?>">
<input id='checkbox<?php echo $v['id'] ?>' type='checkbox' name="status[]" value="<?php echo $v['id'] ?>" class=' select-checks ' <?php if($v["status"]==1){echo "checked";}?>>
                        </td>
                        <td class="alignCenter"  style="width: 30%;"><?php echo $v['model'] ?></td>
		                <td style="text-align: left;"><?php echo $v['content'] ?><!--<input type="text" name="content[]" value="<?php echo $v['content'] ?>" style="width: 680px;"/>--></td>
		            </tr>
	             <?php } ?>   
	            </tbody>
		        </table>
         	</div>
         	<div style="text-align: center;">
         		<button type="button" class="ks-bt bt-pue" onClick="submitform(1)" style="display: inline-block;float: none;">批量设置</button>
         	</div>
         	
        <input type="hidden" name="batch" id="batch1" />
</form>
        </div>
    </div>
</div></div>
<div id="ksBoxFooter" style="height:120px;">
		<div class="ks-bom clearfix" style="padding-left: 100px;">
			<span class="fl">
				<label class="mr20 fl">全选</label>
				
			</span>
		</div>
</div>
<script>
function updatesStatus(id){
  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
   })
}
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}
function checkAffirm() {
	var contentValue='',
	e = window.event || event;
	contentValue ='<div class="check-crb">'+
				 '<div class="check-icon"><i class="icon-gantanhao iconfont"></i></div> '+
	 			 '<div class="check-empty">您还未进行实名认证</div>'	+
	 			 '<div class="check-btn clearfix"><button  class="ks-bt " onclick="closePopupBox()">取消</button>'+
	 			 '<a href="<?php echo M_URL('User','realName'); ?>" class="ks-bt bt-pue" style="float:right">去认证</a></div></div>'
	popup.box({
				title:'实名认证',
				width:300,
			    content:contentValue,
			    event:e
			});
}
</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>

