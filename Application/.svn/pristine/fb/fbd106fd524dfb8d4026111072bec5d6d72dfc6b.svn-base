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
    <link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style>
		.ml30{position: relative;top: 5px; margin-left: 20px!important;}
		.span-inline label{display: block;float: none!important;margin-bottom: 10px;}
		#datatime{-webkit-appearance:none;background-color:#fff;background-image:none;border-radius:4px;border:1px solid #dcdfe6;box-sizing:border-box;color:#606266;display:inline-block;font-size:inherit;height:35px;
line-height:35px;outline:none;padding:0 15px;transition:border-color .2s cubic-bezier(.645,.045,.355,1);width:100%}
	</style>
</head>
<body class="ks-wrap"> 


 	<form target="hidframe" id="myform"  action="<?php echo M_URL('Massage','dosend','',GP("option-".$option));?>"  method="post" enctype="multipart/form-data">
	<div  class="ks-wbox  bRadius10 " >
		
		<div class="ks-head-nav">
			<!--标题-->
			<?php if($entrance==1){?>
				<a href="<?php echo M_URL('Website'); ?>">网站配置</a><span>/</span><a href="<?php echo M_URL('Massage','config');?>">站内信设置</a>
				<?php }else{?>
			   <a href="<?php echo M_URL('Massage','postlist','',GP('option-'.$option));?>"><?php if($option==1){ echo '公告管理';}else{echo '站内消息';} ?></a>
			    <?php }?>
				<em>/</em><?php if($option==1){ echo '发送公告';}else{echo '发送站内信';} ?>
			<!--标题-->
		</div>
		
		<div class="view-content" style="padding-left: 0;">
			<!--公告-->
			<?php if($option == 1){ ?>
			<div class="message">
					<div class="form-row clearfix">
			          		<span class="name name-nowrap">公告标题</span>
							<div class="form-limit" limit="50">
			          			<input type="text" class="form-textbox" name="title" >
							</div>
				    </div>
				         
					<div class="form-row clearfix">
						<span class="name name-nowrap">公告内容</span>
						<?php echo ks_editor('content','',1,''); ?>
					</div>
					<div class="form-row clearfix">
						<span class="name name-nowrap">公告发布时间</span>
						<input id="datatime" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" name="adddate" class="w300  laydate-icon">
					</div>
					
					<div class="form-row clearfix">
						<span class="name name-nowrap">发布者</span>
						<input type="text" class="form-textbox w300" name="inputer" value="系统">
					</div>
		    </div>	
		    <?php }else{?>
		  	<!--公告结束-->
			<!--消息-->
			<div class="news">
					<div class="form-row span-inline clearfix">
			          		<span class="name name-nowrap">通知人员（通知所有人请发<a href="<?php echo M_URL('Massage','postmassage','',GP('option-1')); ?>" ><font color="#476dbe">公告</font></a>）</span>
						     <label for="inlineRadio13" >
							     <input type="radio" id="inlineRadio13" value="1" class="radioInput" name="chargetype" checked="checked"><span class="fl">指定用户名</span>
							     <input type="text" class="form-textbox w300" name="names" value="" style="margin: 0 5px;"><span >多个用户名间请用<font color="#476dbe">英文的逗号</font>分隔</span>
						     </label>
						     <label for="inlineRadio14" >
							     <input type="radio" id="inlineRadio14" value="2" class="radioInput" name="chargetype"><span class="fl">绑定班级 &nbsp&nbsp&nbsp&nbsp</span>
								<select name="infoid" id="cid"  class="form-textbox w300">
									<option>text1</option>
								</select>
						     </label>
						     <label for="inlineRadio15" >
							     <input type="radio" id="inlineRadio15" value="3" class="radioInput" name="chargetype"><span class="fl">绑定会员组</span>
								<select name="groupid" id="cid"  class="form-textbox w300">
									<?php foreach($groupary as $k=>$v){?>
										<option value="<?php echo $v['id']; ?>"><?php echo Field($v['name']); ?></option>
									<?php }?>
								</select>
						     </label>
				    </div>     
			         <div class="form-row clearfix">
						<span class="name name-nowrap"><i class="form-star">*</i>消息标题</span>
						<input type="text" class="form-textbox " name="title" value="">
					</div>
					  <div class="form-row clearfix">
						<span class="name name-nowrap"><i class="form-star">*</i>消息内容</span>
						<?php echo ks_editor('content','',1,''); ?>
					</div>
					<div class="form-row  clearfix">
						<span class="name name-nowrap">发件人：</span>
						<input type="text" class="form-textbox " name="inputer" value="系统">
					</div>
		    </div>	
		  <!--消息结束-->
		  <?php }?>
	   </div>	
	   	<div  class="form-footer clearfix" style="height: 120px;">
			<span class="d-inline-block">
				<input type="button" onClick="do_reg()"  class="ks-bt bt-pue mr10" value="开始发送" name="save" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,8,false,true);?>'})" >
		       	<input type="button" onClick="history.go(-1);" class="ks-bt bt-defalut" value="取消">
			</span>
		
		</div>		    
	</div>
	</form>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<?php if($option==1){ ?>
<script>
	module.require(['$','backstage','nicescroll','laydate'],function(){
		loadScorllJs();
		  laydate.render({
		    elem: '#datatime'
		    ,type: 'datetime'
		  });
	})	
	
</script>
<?php }else{?>
<script>
	module.require(['$','backstage','nicescroll','laydate'],function(){
		
		loadScorllJs();
		banding();
	})
	
function banding(){
	var key =1;
	$.ajax({
		type:"post",
		data:{key:key},
		url:"<?php echo M_URL('h5market/Index','reward','',GP(''));?>",
		dataType:'json',
		success:function(data){
			var str = '';
			for(var i =0;i<data.length;i++){
					str += '<option value="'+data[i].classid+'" selected="selected">'+data[i].title+'</option>';
			}
			$('[name =infoid]').html(str);
		}
	});
}

</script>
<?php }?>
<script>
function do_reg(){
	var title      = $("input[name='title']").val();
	var content    = $("textarea[name='content']").val();
	var inputer    = $("input[name='inputer']").val();
    if(title==''){Alert('标题不能为空');return false;}	
	if(content==''){Alert('内容不能为空');return false;}	
	if(inputer==''){Alert('发件人不能为空');return false;}
	$('#myform').submit();
}
</script>
</body>
</html>
