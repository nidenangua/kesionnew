<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">

<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
	.info-ul ul{ padding-top: 20px;}
	.info-ul li{font-size: 16px;margin-bottom: 10px; text-align: center;}
	.info-ul li input{border: #E5E5E5 1px solid;border-radius: 3px;height:35px; width: 300px;margin-left:10px;padding-left: 10px;box-sizing: border-box;}
	input[type="checkbox"] {top: 2px;position: relative;}
	.Created-Content {min-width: 25%;}
	@media (max-width: 1366px) {
		.Created-Content {min-width: 35%;}
		
	}
</style>
<body class="gray-bg">
	<div class="row">
	<div id="manage_top" class="menu_top_fixed  p15 height73">
	    <div class="ibox-title">
	        <h3 class="fl">
				<?php if(!isset($admin)){echo '添加权限';}else{echo '修改权限';} ?>
	        </h3>
	        <div class="fr">
	             <div class="fl ks-top-search">
				<!--搜索-->
					<button type="button" class="ks-bt bt-def" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
				<!--搜索-->
				</div>  
	              
	               
	        </div>
	    </div>
	</div>
</div>
<div class="wrapper" style="margin-top:65px;margin-bottom: 65px;">
	<div id="ksBoxContent">
		<form target="hidframe" id="myform" action="<?php echo M_URL('Admin','adminLevelDoSave',isset($admin['id'])?$admin['id']:'','p-'.$now_page); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="tab-pane" id="active">
				<div class="form-box form-upload-box">
					<div class="Created-ing" style="margin-bottom: 120px;">
						<ul >
							<li class="clearfix">
								<h4>添加权限:</h4> 
								<div class="Created-Content ">
									<input class="t1 fl"  type="text" class="form-control" style="width: 300px !important;" name="rulename" value="<?php if(!isset($admin)){echo '';}else{echo $admin['rulename'];} ?>">
								</div>
							</li>
                            <?php foreach ($this->navList as $k=>$v){
                                   echo "<li class='clearfix'>";
                                   echo "<h4>".$v['title'].'<input type="checkbox" value="'.$v['controller'].'*index'.'" class="level-all" onclick="LeftToggle(this)" name="rules[]"/>:</h4>';
                                 
                                   foreach($v['secondnav'] as $k1=>$v1){
                                       echo '<div class="Created-Content fl">';
                                       echo '<input class="t1 level-check fl " onclick="a(this)"  type="checkbox" value="'.$v1['controller'].'|'.$v1['action'].'" name="rules[]"';
                                       if(isset($admin)){
                                           if(strpos(','.$admin['rule'].',',','.$v1['controller'].'|'.$v1['action'].',') !== false){
                                               echo 'checked';
                                           }
                                       } 
                                       echo '>';
                                       echo '<label class="fl">【'. $v1['title'].'】</label>';

                                       /***************************************三级 begin***************************/
                                       if (isset($v1['thirdnav'])){
                                           echo '<span class="clearfix">';
                                           foreach($v1['thirdnav'] as $k2=>$v2){
                                               echo '<div class="Created-Content fl">';
                                               echo '<input class="t1 level-check fl " onclick="a(this)"  type="checkbox" value="'.$v2['controller'].'|'.$v2['action'].'" name="rules[]"';
                                               if(isset($admin)){
                                                   if(strpos(','.$admin['rule'].',',','.$v2['controller'].'|'.$v2['action'].',') !== false){
                                                       echo 'checked';
                                                   }
                                               } 
                                               echo '>';
                                               echo '<label class="fl">'. $v2['title'].'</label>';
                                               echo "</div>";
                                           }
                                           echo '</span>';
                                       }
                                       /***************************************三级 end***************************/

                                       echo '</div>';
                                   }

                                   echo "</li>";
                                  }

                             ?>

                           
						</ul>
					</div>
				<div class="footer-page h60" style="text-align: center;">
        		<button class="btn btn-default mt10" type="submit"  name="batch" value="4"><?php if(!isset($admin)){echo '确定添加';}else{echo '确定修改';} ?></button>
			</div>
		</form>
	</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

 <script>		


	$('.Created-ing').find('li').each(function(){

			if($(this).find('div input').prop('checked')===true){
				$(this).find('.level-all').prop('checked',true);
			}

		
	})

	
		              function a(target){
		              	
		          		//单选点击事件
			          	var  a = $(target).parents('li').find('div input').length;
			          	//21
			          	//判断是否有全部选中
			          	var b = 0;
			          	for(var i = 0;i<a;i++){
			          		
			          		if($(target).parents('li').find('div').eq(i).find('input').is(':checked')){
			          			//选中的条数小于
			          			if(b<a){
			          				b++
			          			}else{
			          				b=a;
			          			}		
			          					          			
			          		}
			          		
				          	if(b ==a) {
				          		
				          	$(target).parents('li').find('.level-all').prop('checked',true);
				          	
				      
				          	}else if(b<a){
				          		$(target).parents('li').find('.level-all').prop('checked',false);
				          	}	
			          	}
			          	
			          
		          		console.log(b)
		          	
		          	}
	         		  function LeftToggle(obj){
	           			var $check =$(obj).parents('li').find('input[type="checkbox"]');
	           			var objLength = $(obj).parents('li').find(' div input[type="checkbox"]').length;
	                   if (obj.checked)  {
	                   		 $check.prop("checked",true); 
	                   	 } 
					   else {  
					    	 $check.prop("checked",false);
					   }
					
				 }
		          
		            </script>

</body>
