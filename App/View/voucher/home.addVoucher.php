<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title><?php if(!empty($values)){echo "修改优惠券";}else{echo "添加优惠券";} ?></title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
.label-on {
	color:#666
}
.form-row .name{
	font-size: 18px;
    height: 43px;
}
</style>
</head>
<body class="ks-wrap">
<!--开始-->
<form target="hidframe"  method="post" id="myform"  action="<?php if(!empty($values)){echo M_URL($this->AppName.'/Index','doEidtVoucher',$id,GP(''));}else{echo M_URL($this->AppName.'/Index','doAddVoucher','',GP(''));} ?>"
		enctype="multipart/form-data">
		<div class="ks-wbox bRadius10"> 
			<div class="ks-head-nav">
	<!--标题-->
	<a href="javascript:history.go(-1);">优惠券管理</a> <em>/</em><?php if(!empty($values)){echo "修改优惠券";}else{echo "添加优惠券";} ?>
	<!--标题-->
</div>
		<div class="form-box ">
			<div class="form-row">
			    <span class="name" ><i class="form-star">*</i>选择优惠券</span>
					<div class="clearfix">
						<label class="radioLabel fl <?php if(isset($values)){if($values['type']==0){ echo 'label-on'; }}else{ echo 'label-on'; } ?>"  >
							<input type="radio" value="0" name="type" <?php if(isset($values)){if($values['type'] ==0){ echo 'checked=""'; }}else{ echo 'checked=""'; } ?>   onclick="radioClick(1,this)">网校通用优惠券 </label>
						<label class="radioLabel fl"  >
							<input type="radio" value="1" name="type" <?php if(isset($values)){if($values['type'] !=0){ echo 'checked=""'; }} ?>  onclick="radioClick(1,this)">指定商品优惠券
						</label>
						<select class="w300 inputText bRadius5 fl" id="showCourse" <?php if(isset($values)){if($values['type'] !=0){ echo 'style="display:block"'; }else{ echo 'style="display:none"'; }}else{ echo 'style="display:none"'; } ?>   name="ctype" onchange="getinfo(this)">
							<option value="-1">选择知识课程</option>
							<option value="0" <?php if(isset($values)){if($values['ctype'] == 0){ echo 'selected';}} ?>>课程</option>
                            <option value="8" <?php if(isset($values)){if($values['ctype'] == 8){ echo 'selected';}} ?>>教辅周边</option>
							<option value="7" <?php if(isset($values)){if($values['ctype'] == 7){ echo 'selected';}} ?>>专栏</option>
							<option value="10" <?php if(isset($values)){if($values['ctype'] == 10){ echo 'selected';}} ?>>社群</option>

						</select>
						<select onchange="getprice(this)" class="w300 inputText bRadius5 fl" id="showCourse1" <?php if(isset($values)){if($values['type'] !=0){ echo 'style="display:block"'; }else{ echo 'style="display:none"'; }}else{ echo 'style="display:none"'; } ?>  name="infoid">
							<option value="0">选择对应课程</option>
						</select>
						<input class="w300 inputText bRadius5 fl" type="text" readonly=""   id="price" style="display: none;color: red">
					</div>
		    </div>
			<div class="form-row">
			    <span class="name"><i class="form-star">*</i>填写优惠券金额</span>
			    <input type="number" class="form-textbox w150 mr10" name="money" value="<?php if(isset($values)){ echo $values['money'];}else{ echo '10';} ?>"  />元
		    </div>
			<div class="form-row">
			    <span class="name"><i class="form-star">*</i>选择使用条件</span>
                <div class="clearfix">
					<label class="radioLabel fl label-on">
						<input type="radio" value="1" name="vocher2term" <?php if(isset($values)){if($values['term'] !=0){ echo 'checked=""'; }}else{ echo 'checked=""'; } ?> onclick="radioClick(3,this)">满
						<input type="number" class="form-textbox w150 mr10" id="money" name="term" value="<?php if(isset($values)){ echo $values['term'];}else{ echo '10';} ?>"  />元使用			
					</label>
				</div>	
				<div class="clearfix mt10"> 
					<label class="radioLabel fl">
							<input type="radio" value="0" name="vocher2term" <?php if(isset($values)){if($values['term'] ==0){ echo 'checked=""'; }} ?> onclick="radioClick(3,this)">无门槛使用 （若优惠金额大于产品金额，则该产品价格为免费）
					</label>
				</div>		              	 
		    </div>
			<div class="form-row">
			    <span class="name" ><i class="form-star">*</i>选择有效时间（<span style="color: red;font-size: 10px;">注：优惠券创建后，有效时间不可更改</span>）</span>
				<div class="clearfix">  
					<label class="radioLabel fl label-on">
						<input type="radio" value="1" name="awarddate" <?php if(isset($values)){if($values['awarddate'] ==1){ echo 'checked=""'; }}else{ echo 'checked=""'; } ?>>指定
						<input type="text" name="time" id="selectTime" class="ks-head-input ks-head-time w300 ml20" placeholder="自定义时间段" lay-key="1" value="<?php if(!empty($values['redemptionstarttime'])){ echo date('Y-m-d H:i:s',$values['redemptionstarttime']).' - '.date('Y-m-d H:i:s',$values['redemptionendtime']);} ?>">
					</label>
				</div>
				<div class="clearfix mt10"> 
					<label class="radioLabel fl">
							<input type="radio" <?php if(isset($values)){if($values['awarddate'] ==0){ echo 'checked=""'; }} ?> value="0" name="awarddate">无时间限制
					</label>
				</div>
		    </div>
			<div class="form-row">
				<span class="name name-nowrap" ><i class="form-star">*</i>计划人数<i class="iconfont icon-iconfontwenhao"style="color:orange"> 
					<div class="ks-remind"> 用户领取：创建成功后会生成领取链接，您可以在优惠券列表分享链接，或设为公号自动回复将链接发</br>
						送给用户。用户点击链接后即可领取并使用优惠券。也可以设置在网校里进行领取。</br>
						指定用户：创建成功后会发送到指定用户的账户，当用户进入对应的页面时会弹窗提示
					</div></i>
				</span>
				<div class="clearfix">
					<label class="radioLabel fl label-on">
						<input type="radio" value="1" name="isuser" <?php if(isset($values)){if($values['isuser'] ==1){ echo 'checked=""'; }}else{ echo 'checked=""'; } ?>  onclick="radioClick(4,this)">用户领取								
					</label>
					<label class="radioLabel fl">
						<input type="radio" value="0" name="isuser" <?php if(isset($values)){if($values['isuser'] ==0){ echo 'checked=""'; }} ?>  onclick="radioClick(4,this)">指定用户
					</label>
				</div>
		    </div>
			<div class="form-row" id="userCode" <?php if(isset($values)){if($values['isuser'] ==1){ echo 'style="display:block"'; }else{ echo 'style="display:none"';	}}else{ echo 'style="display:block"'; } ?>>
				<div class="clearfix" style="background:#eef2f5;padding:20px;font-size:14px">	
					<div>  <font style="min-width:120px;display:inline-block">填写优惠券数量：</font><input type="number" class="form-textbox w150 mr10" name="number" value="<?php if(isset($values)){ echo $values['number']; }else{ echo '10'; } ?>" style="background:#fff" /> 张
						<span style="color:#e5412c;padding-left:10px"> 注：(暂时支持300张)后续编辑数量只能增加不可减少，请谨慎设置！</span>
					</div>
					<div class="mt20"><font  style="min-width:120px;display:inline-block" >每人限领：</font><input type="number" class="form-textbox w150 mr10" name="oneusers" value="<?php if(isset($values)){ echo $values['oneusers']; }else{ echo '1'; } ?>" style="background:#fff" /> 张								
					</div>
				</div>
			</div> 	
            <div class="form-row"  id="userSign" <?php if(isset($values)){if($values['isuser'] ==0){ echo 'style="display:block"'; }else{echo 'style="display:none"';}}else{ echo 'style="display:none"';} ?>>
				<div class="clearfix" style="background:#eef2f5;padding:20px;font-size:14px">
					<?php if(!isset($values)){ ?>
					<div class="clearfix"> 	
						<label class="radioLabel fl label-on">
							<input type="radio" value="0" name="vocherall" checked="" onclick="radioClick(5,this)"  >选择部分用户								
						</label>
						<label class="radioLabel fl">
							<input type="radio" value="1" name="vocherall" onclick="radioClick(5,this)" >选择全部用户
						</label>
						<label class="radioLabel fl">
							<input type="radio" value="2" name="vocherall" onclick="radioClick(5,this)" >选择会员组
						</label>
					</div>
					<div class="mt20" id="choiceStd">
						<!--class="form-textbox"-->
						<textarea type="text" name="names" readonly="true" disabled="false" style="width: 900px;height: 120px;overflow-y:scroll"></textarea>
						<input type="hidden" name="ids" id="ids"/>  
						<button type="button" class="ks-heade-button mr10"  style="border-color:#e5412c;background:transparent;color:#e5412c;display: block;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addStudent','',GP('')) ?>','850px','600px',{title:'选择学员发放',type:'top'})" >选择用户</button>			
					</div>
					<div class="mt20" id="choiceStd2" style="display: none;">
						<select name="groupid" id="cid"  class="form-textbox w300">
							<?php foreach($groupary as $k=>$v){?>
								<option value="<?php echo $v['id']; ?>"><?php echo Field($v['name']); ?></option>
							<?php }?>
						</select>	
					</div>
				<?php }else{ ?>
					<div class="clearfix"> 	
						<label class="radioLabel fl label-on">
							<input type="radio" value="0" name="vocherall" checked="" onclick="radioClick(5,this)"  >发放列表用户列表			
							<input type="hidden" name="ids" id="ids" value="<?php echo $uid ?>"/>  
						</label>
					</div>
					<div class="mt20" id="choiceStd">
						<textarea  name="names" readonly="true" disabled="false" style="width: 900px;height: 120px;overflow-y:scroll"> <?php echo $uname; ?></textarea>
					</div>
				<?php } ?>
				</div>
			</div>      
		</div>     
		<div class="ks-bom form-footer" style="text-align: center;">
		<span class="d-inline-block">
            <?php if(empty($values) || (!empty($values) && $values['isuser']==1)){?>
			<input type="button" onClick="do_reg()" class="ks-bt bt-pue mr10" value="<?php if(!empty($values)){echo "确认修改";}else{echo "确认添加";} ?>" id="smb" >
            <?php } ?>
			<input type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-white" value="取消">
		</span>
	</div> 
	</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','laydate','cookie'],function(){
	laydate.render({
		elem: '#selectTime'
		,type: 'datetime'
		,range: true
		,btns: ['clear', 'confirm','now']
	});
	$.cookie('StuName','',{expires:7,path:'/'});
	$.cookie('StuCheck','',{expires:7,path:'/'});
})
top.dataCallBack = function(data){
	$('#ids').val(data.radioID);
	$('[name=names]').val(data.radioname);
    //console.log(data.radioID);
}	
function radioClick(step,target) {
	var number = $(target).val();
	switch (step) {
		case 1:if(number==1) {
			$('#showCourse').show();
		}else {
			$('#showCourse').hide();
			$('#showCourse1').hide();
			$('#price').hide();
		}break;
		case 3:if(number==0) {
			$('#money').attr('disabled',true)
		}else {
			$('#money').attr('disabled',false)
		}break;
		case 4 :if(number==0) {
			$('#userCode').hide();
			$('#userSign').show();
		}else{
			$('#userCode').show();
			$('#userSign').hide();
		}break;
		case 5 :if(number==1) {
			$('#choiceStd').hide();				
			$('#choiceStd2').hide();				
		}else if(number==2){
			$('#choiceStd2').show();		
			$('#choiceStd').hide();	
		}else{
            $('#choiceStd').show();	
            $('#choiceStd2').hide();
		}
	}	
}
function do_reg(){
	$('#myform').submit();	
}
function getinfo(that){
	var obj = that;
	$('#showCourse1').show();
	var url = "/Json/index.php?act=Microportal.Store.getCourseList";
	var type = $(obj).val();
	$.ajax({
		type:"post",
		url:url,
		data:{'type':type},
		success:function(datas){

			 var datas = JSON.parse(datas);
			 $('#showCourse1').html('');
			 var str = '<option value="0">选择对应课程</option>';
			 if(datas.length>0){
				 for(var i = 0;i<datas.length;i++){
						str += '<option value="'+datas[i].id+'" price="'+datas[i].price+'">'+datas[i].title+'</option>'
				 }
				 $('#showCourse1').append(str);
				 // $('#price').val('￥'+datas[0].price);
				 // $('#price').show();
			 }
		},
		
	});
}
function getprice(that){
	var obj = that;
	var type = $(obj).find('option:selected').attr('price');
	console.log(type);
	 $('#price').val('￥'+type);
	 $('#price').show();
}
//$('#id3').parent('label').html('<input type="checkbox" id="id3" value="3" class="radioInput" name="messagetype[]" checked="">站内信息')
</script>
<?php if(isset($values)){ ?>
<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
<?php if(isset($values)){if($values['type'] !=0){ ?>
<script>
function getinfos(){
	var url = "/Json/index.php?act=Microportal.Store.getCourseList";
	var type = '<?php echo $values["ctype"]  ?>';
	var id = '<?php echo $values["infoid"]  ?>';
	$.ajax({
		type:"post",
		url:url,
		data:{'type':type},
		success:function(datas){
            // console.log(datas)
            // return
				var datas = JSON.parse(datas);
				$('#showCourse1').html('');
				var str = '<option value="0">选择对应商品</option>';
				if(datas.length>0){
					for(var i = 0;i<datas.length;i++){
						if(datas[i].id == id){
							str += '<option value="'+datas[i].id+'" selected>'+datas[i].title+'</option>'
						}else{
							str += '<option value="'+datas[i].id+'">'+datas[i].title+'</option>'
						}
					}
					$('#showCourse1').append(str);
				}
		},
	});
}
getinfos();
</script>
<?php }} ?>

<script>
$('input').attr('disabled',true);
$('select').attr('disabled',true);
$('.ks-bt').removeAttr("disabled"); 
$('[name=number]').removeAttr("disabled"); 
console.log($('input'));
</script>
<?php } ?>
</body>
</html>

