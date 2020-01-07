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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.selectImageBtn{text-align:center;cursor:pointer;display:inline-block;background:none;border:none;min-width:120px;}

</style>
</head>
<body class="ks-wrap">
    <?php include  CURR_VIEW_PATH . "head.php";?> 
	<div class="courseBox clearfix mt20">
		 <div class="lLightBox bg-white bRadius10  borderSo">
       	<?php include  CURR_VIEW_PATH . "menu.php";?> 
    	</div>
    
    <div class="lRightBox">
        <div class="ml20 bg-white bRadius10 borderSo ks-wbox"  style="position: relative; overflow: hidden;">
        	<div id="wrapHeight">
         	<div class="form-tip clearfix">
         		<div class="form-tip-blick"></div>
         		<div class="form-tip-word">基本资料</div>
         	</div>
	    <form target="hidframe" method="post" id="myform" enctype="multipart/form-data" action="<?php if(!empty($classroominfo)){echo M_URL($this->AppName.'/Index','doeditClassroom',$classroominfo["id"],GP(''));}else{echo M_URL($this->AppName.'/Index','doaddClassroom','',GP(""));} ?>">
		    
		    <div id="ksBoxContent">
			<div class="form-box form-upload-box tab-pane" style="display:block">
				<div class="form-row">        		
              		
					<div class="form-row">
						<span class="name"><i class="form-star">*</i>班级类型:</span>
						<?php echo $Linkage->Linkage(2);?>
					</div>
					         
                </div>
				<div class="form-row">
              		<label class="name"><i class="form-star">*</i>班级名称:</label></br></br>
              		<input type="text" class="form-textbox"  name="classroomname" style="width: 389px;" value="<?php if(!empty($classroominfo)) echo $classroominfo['classroomname'] ?>" />
                </div>
                <div class="form-row clearfix">
	                <span class="name"><i class="form-star">*</i>是否显示:</span>
                    <label for="powertype0"><input type="radio" id="powertype0" value="0" name="classroomshow" <?php  if(!empty($classroominfo)){if($classroominfo['classroomshow']==0) echo "checked";}?> >隐藏</label>
                    <label for="powertype1"><input type="radio" id="powertype1" value="1" name="classroomshow" <?php  if(!empty($classroominfo)){if($classroominfo['classroomshow']==1) echo "checked";}?> >显示</label>
	            </div>
                <div class="form-row">
              		<label class="name"><i class="form-star">*</i>价格:</label></br></br>
              		<input type="text" class="form-textbox"  name="classroomprice" style="width: 389px;" value="<?php if(!empty($classroominfo)) echo $classroominfo['classroomprice'] ?>" />
                </div>
				<div class="form-upload">
              		<div class="js_uploadBox">
              			<div class="js_showBox"><img class="js_logoBox block defaultpic" src="<?php if(!empty($classroominfo)){echo Img($classroominfo['defaultpic']);}else{ echo nopic(1);} ?>" ></div>
		                <div class="btn-upload clearfix">
		                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传班级图片</span></a>
		                    <p>限制：2MB,支持jpg|png|gif</p> 
		                    <input type="hidden" name="defaultpic" value="<?php if(!empty($classroominfo)){echo Img($classroominfo['defaultpic']);}?>">
		               </div>    
				    </div>
                </div>	
                <div class="form-row">
              		<label class="name"><i class="form-star">*</i>选择班主任:</label></br></br>           		
              		<select class="w150 inputText bRadius5" name="teacherid">
              			<?php foreach($teacher as $k => $v){?>
              			<option value="<?php echo $v['userid'];?>" <?php if(!empty($classroominfo)){if( $classroominfo['teacherid']==$v['userid']){?>selected="selected"<?php }}?>><?php echo $v['name'];?></option>
              			<?php };?>
              		</select>   
                </div>
                <div  class="form-row clearfix">
					<span class="name"><i class="form-star">*</i>是否开启招生营销活动:</span>
					<div  class="rightTd alignLife">
						<label for="powertype1"><input type="radio" id="powertype1" value="1" name="classroomyingxiao" <?php  if(!empty($classroominfo)){if($classroominfo['classroomyingxiao']==1) echo "checked";}?> >开启</label>
						<label for="powertype0"><input type="radio" id="powertype0" value="0" name="classroomyingxiao" <?php  if(!empty($classroominfo)){if($classroominfo['classroomyingxiao']==0) echo "checked";}?> >不开启</label>
					</div>
				</div>
                <div  class="form-row">
					<span class="name"><i class="form-star">*</i>班级介绍:</span>
					<div  class="rightTd alignLife">
						<?php echo $kindeditor;?>
					</div>
				</div>	
			</div>
			
    </div>
		     
			  <input type="hidden" name="typea" id="typea"  />
			 </div>       
	 
		
			<div class="clearfix ksBoxLine" id="ksBoxLine">
			 	<input  type="button" onclick="do_reg();" class="ks-bt bt-pue mr10" value="保存">
			  	<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="ks-bt bt-pue">取消返回列表</a>
			</div>
	
		
	  </div>

    </div></form>

    
	</div>
 
	</div>

<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
/***********高度***********/
	
	
function do_reg(){

	$("#myform").submit();
}	
$(".prices").keyup(function () {
	var reg = $(this).val().match(/\d+\.?\d{0,2}/);
	var txt = '';
	if (reg != null) { txt = reg[0];}
	$(this).val(txt);
}).change(function(){ $(this).keyup();});

var chargetype = $('input:radio[name="chargetype"]:checked').val();
if(chargetype == 0 || chargetype == 2){
	$('.charge1').hide();
}
$('input:radio[name="chargetype"]').change(function(){
	var chargetype = $('input:radio[name="chargetype"]:checked').val();
	if(chargetype == 0 || chargetype == 2){ $('.charge1').hide();}else{$('.charge1').show();}
}); 
 
</script>
</body>
</html>
