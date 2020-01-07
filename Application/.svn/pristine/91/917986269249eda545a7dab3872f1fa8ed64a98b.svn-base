<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
   	<link rel="shortcut icon" href="favicon.ico">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css?t=<?php echo rand(100000,100000000);?>" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css?t=<?php echo rand(100000,100000000);?>" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?t=<?php echo rand(100000,100000000);?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <style>
    	.col-sm-2 {width: 16.66666%}
    	.form-group-box .btn {padding: 5px 12px;}
    	
    </style>
</head>
<body style="background-color: #f2f4f8;">
    <div class="row">
        <div class="tabs-container" id="ksBoxContent">
           
            <div class="tab-content">
                <div class="tap-pane" style="display: block">
                    <div class="panel-body">
                        <form id="myform"   class="form-horizontal" method="post" action="<?php echo M_URL('home/Domain','dolive',$wxid,GP('')); ?> ?>">
                         	<div class="form-group-box">
                         	<!--   -->	
                         	
                         <div class="form-group">
                                <label class="col-sm-2 control-label">一对一分辨率 ：</label>
                                <div class="col-sm-4">
                                    <?php foreach($resolution as $kt=>$vt){ ?>
                                    	<input type="checkbox" name="onetype[]" value="<?php echo $vt['id']; ?>" 
                                    		<?php if(in_array($vt['id'],$onetype)){echo 'checked=checked'; } ?> />
                                    	<?php echo $vt['title'] ?>
                                    	
                                    <?php  } ?>	
                                </div>
                            </div>
                         	
                         	
                         	
                              声网配置：
	                             <div class="line line-dashed b-b line-lg pull-in"></div>	
                         	
                         	   <div class="form-group">
                                <label class="col-sm-2 control-label">是否启用 ：</label>
                                <div class="col-sm-4">
                                    <div class="radio radio-info radio-inline">
                                        <input name="isenable" id="mbings6"  type="radio" value="1"  <?php if(isset($live))if($live['isenable']==1){echo 'checked';} ?>  ><label for="mbings6">是 </label>
                                    </div>
                                    <div class="radio radio-info  radio-inline">
                                        <input name="isenable" id="mbings7" type="radio"  value="0" <?php if(isset($live)){if($live['isenable']==0){echo 'checked';}}else{echo 'checked';} ?>><label for="mbings7"> 否 </label>
                                    </div>
                                </div>
                            </div>
                           	
	                              <div class="form-group">
                                <label class="col-sm-2 control-label">是否开启ssl ：</label>
                                <div class="col-sm-4">
                                    <div class="radio radio-info radio-inline">
                                        <input name="isssl" id="mbings10"  type="radio" value="1"  <?php if(isset($live))if($live['isssl']==1){echo 'checked';} ?>   ><label for="mbings10">是 </label>
                                    </div>
                                    <div class="radio radio-info  radio-inline">
                                        <input name="isssl" id="mbings11" type="radio"  value="0"  <?php if(isset($live)){if($live['isssl']==0){echo 'checked';}}else{echo 'checked';} ?> ><label for="mbings11"> 否 </label>
                                    </div>
                                </div>
                            </div>
	                            
	                           <div id="messageInfo" style="display: none;">
	                            <div class="form-group">
	                                <label class="col-sm-2  control-label">key:</label>
	                                <div class="col-sm-4">
	                                    <input type="text" class="form-control" name="Agorakey" value="<?php if(isset($Agora))echo $Agora[0]; ?>">
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                            
	                             <div class="form-group">
	                                <label class="col-sm-2  control-label">AppCertificate:</label>
	                                <div class="col-sm-4">
	                                    <input type="text" class="form-control" name="AppCertificate" value="<?php if(isset($Agora))echo $Agora[1]; ?>">
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                            
	                            
	                            
	                            
	                            
	                            
	                           第三方配置：
	                             <div class="line line-dashed b-b line-lg pull-in"></div>
                         		
                         		<?php foreach($keytitle as $k=>$v){ ?>
	                            <div class="form-group">
	                                <label class="col-sm-2  control-label"><?php echo $v; ?></label>
	                                <div class="col-sm-4">
	                                    <input type="text" class="form-control" name="key[]" value="<?php  if(isset($key)) {echo $key[$k];} ?>">
	                                </div>
	                            </div>
	                            <div class="line line-dashed b-b line-lg pull-in"></div>
	                            <?php } ?>
	    
	                       
	                           	
	                           	
	                        
	                          </div>  
	                            <div  class="form-add btn bt-gray" onclick="add()">添加</div>
	                            
	                        </div>                                           
	                            
	                            
	                            
	                            
	                            
	                            
                           
                       
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                         
                            
                              <div class="footer-page">
                                <div class="col-sm-5"></div>
                                <div class="col-sm-7 mt3"> <button class="btn btn-primary mt7"  type="button" onClick="do_reg()">确定保存</button> </div>
                             </div>  
                        </form>
                    </div>
                    
                    <br />
                    <br />
                    <br />
                    <br />
                </div>

            </div>
        </div>


    </div>


<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
 <script>
 	
 	var a =$('input[name="isenable"]:checked').val();
	
if(a == 1){
		
		$("#messageInfo").show();
		
	}else{
		$("#messageInfo").hide();
	} 	




 	
$('input[name="isenable"]').click(function(){
	var a =$(this).val();
	
	if(a == 1){
		
		$("#messageInfo").show();
		
	}else{
		$("#messageInfo").hide();
	}
});

function do_reg()
{
	
	$("#myform").submit();
	
}


	function add(){
		
		var html='';
		html+='<div class="form-group mt10">';
		html+='<label class="col-sm-2 "><input type="text" class="form-control" name="keytitle[]" value="appid"></label>';	
		html+='<div class="col-sm-4"> <input type="text" class="form-control" name="key[]" value=""></div>';
		html+='<div class="col-sm-2"><button class="btn btn-defalut " onclick="del(this)">删除</button></div>';
		html+='</div>';
		html+='<div class="line line-dashed b-b line-lg pull-in"></div>';	 
		$('.form-group-box').append(html);  
                        
	}

	function del(obj){
		$obj =$(obj);
		$obj.parents('.form-group').next('.line-dashed').remove();
		$obj.parents('.form-group').remove();
		
	
	}
	
</script>
</body>
</html>