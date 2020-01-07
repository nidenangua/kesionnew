<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>问答模块</title>
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
	.ks-borde td{border:0;text-align: left;width: 10%;}
	.emptycss {text-indent: 0;}
</style>
<body class="ks-wrap" style="padding: 0;">
	<div id="ksBoxHead"> </div>
	<div class="ks-wbox">
		<form target="hidframe"  method="post" action="<?php if(isset($value)){echo M_URL($this->AppName.'/Index','changeMsg',$value['id'],GP('')); }else{echo M_URL($this->AppName.'/Index','doaddClassroom','',GP(''));} ?>"  id="myform">
  		<div id="ksBoxContent" style="padding-left: 15px;">
   
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table ks-borde">                     
                                                          
                  <tbody>
                        <tr>   
	                       	 <td>教师账号:<?php echo $info['username']?></td>
	                         <td>教师名称:<?php if($info['name']){echo $info['name'];}else{echo '无';} ?></td>
	                        
						</tr>
						
                     
                         <tr>
                        	<td>英文名称:<?php if($info['ename']){echo $info['ename'];}else{echo '无';} ?></td>
                        	<td>教师性别: <?php if($info['Sex']==0){echo '男';}else{echo '女';} ?></td>
                           
                        </tr>
                        
                        <tr>
                        	 <td>居住地址:<?php if($info['detailadd']){echo $info['detailadd'];}else{echo '无';}?></td>
                        	 <td>
                        		教师职称:<?php if($info['teacherzc']){echo $info['teacherzc'];}else{echo '无';}?>
                        	</td>
                        	
                        </tr>    
                          <tr>
                        	 <td colspan="2">教师简介:<?php if($info['shortIntro']){echo $info['shortIntro'];}else{echo '无';} ?></td>
                        	 
                        	
                        </tr>                        
                         	 
                        </tbody>
             </table>
		</div>
 	</form>   
	<div id="ksBoxFooter" >
		<div class="ks-bom clearfix" style="margin-top: -40px;">	
			<div class="col-sm-5"></div>
			<div class="col-sm-6 mt10">
					<button type="button" class="ks-bt btn-default mr10" onclick="close1();">关闭</button>
			</div>	
		</div>	
	</div>

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>

top.dataCallBack = function(data){
	$('#tempImages').attr('src',data.imagesurl);
	$('#tempid').val(data.radioID);
}
$('.upload-img').click(function(){
	$('.js_uploadText').click()
})	
function do_reg(){
	var problem = $("textarea[name='describe']").val();
	var categoryid = $("select[name='categoryid']").val();
    var reg  =/^([1-9]\d*|[0]{1,1})$/;
	if(problem==''){
		Alert('教室名不能为空');
		return false;	
    }
	$("#myform").submit();	
 }
 top.imgUploadBack = function(src,img){
	$('.defaultpic')[0].src = src;
	$('input[name="defaultpic"]')[0].value = img;
}; 
</script>
<script>
function close1(){
	//parent.closePopup('all');
	top.closePopup('all');
}
	
</script>