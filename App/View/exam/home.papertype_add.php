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
    <link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>

<body class="ks-wrap">	


	<form target="hidframe" method="post" id="myform"  action="<?php if(isset($papertype)){ echo M_URL($this->AppName.'/Index','doEditPaperType',$papertype['id'],GP('')); }
		                     else{ echo M_URL($this->AppName.'/Index','dotypeAdd','',GP(''));} ?>" >
		<div >
			<div class="ks-wbox  view-content bRadius10">
					<div class="ks-head-nav">
							<!--标题-->
							<a href="javascript:history.go(-1);">试卷类型设置</a><span><em>/</em>修改试卷类型</span>
							<!--标题-->
					</div>
				
		         <div class="form-row ">
		         	<span class="form-star">*</span>
              		<span class="name"><i class="required"></i>试卷类型名称</span>
              		<div class="form-limit" limit="50">
              			<input type="text" class="form-textbox" name="typeName" value="<?php if(isset($papertype)) echo $papertype['typeName'] ;?>" />
              		</div>
              	</div>
              	 <div class="form-row clearfix">
					<span class="form-star">*</span>
					<span class="name">是否显示</span>
					<div class="form-switch" open-value="1">
			            <label for="isshow1">
			                <input type="radio" name="isdisplay" class="test1"  data="1" value="1" 
			                	<?php if(isset($papertype['isdisplay'])){if($papertype['isdisplay']==1) echo 'checked="checked"';} ?> />是
			            </label>
			            <label for="isshow0">
			                <input type="radio" name="isdisplay" class="test1" data="0" value="0" 
			                	<?php if(isset($papertype['isdisplay'])){if($papertype['isdisplay']==0) echo 'checked="checked"';}else{echo 'checked="checked"';} ?> /> 否
			            </label>   
		            </div>
	           </div>
            	 <div class="form-row">
              		<span class="form-star">*</span>
              		<span class="name"><i class="required"></i>描述</span>
              		<div class="form-limit" limit="50">
              			<input type="text" class="form-textbox" name="intro" value="<?php if(isset($papertype)) echo $papertype['intro'] ;?>" />
              		</div>
           		
	           		  <div class="form-footer " style="margin-top: 40px;">
			 			
			 			<span class="d-inline-block">
			 				<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr10"><?php if(!empty($papertype)){echo "确认修改";}else{echo "确认添加";} ?></button>
					       <a href="javascript:history.go(-1);" class="ks-bt bt-def">取消返回</a>
			 			</span>
						   
				     
				     </div>		
           		</div> 
       			
		                   
              	
           
        </form>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['laydate','backstage','nicescroll','cookie'],function(){
		
		loadScorllJs();
	})
function do_reg(){
	
	var orderid  = $("input[name='orderid']").val();
	var typeName  = $("input[name='typeName']").val();
	/*数字验证*/
	var num =/^\d+(\.\d+)?$/;
	

    if(typeName==''){
		Alert('类型名称不能为空');
		return false;	
    }	
	
	$("#myform").submit();	
} 
</script>
</script>
</body>
</html>
