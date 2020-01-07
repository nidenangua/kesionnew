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
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<style>
	.exercise-title{
		padding-left:0px;
	}
	.exercise-title p{
		display: inline-block;
	}
	li {
    	list-style-type:none;
	}
	.fixed-bom{
		    position: fixed;
    bottom: 0px;
    width: 100%;
    left: 8px;
    height: 50px;
    padding: 15px 0px;
    background: rgb(235, 240, 242);
	}
	#lisHeight {padding-left: 41px;padding-top: 10px;}
	.singleType{font-size: 26px; margin-bottom: 0;}
	.exercise-answer li{line-height: 29px;}
</style>
</head>
<body>
	<div class="ks-wrap" id="ksBoxContent">
<div class="courseBox clearfix mt20">
   <div class="lLightBox bg-white bRadius10  borderSo">
   </div>
   <div class="">
      <div class="sRightBox   ">
		 <div class="infoBox">
		 	<div class="form-tip bg-white class-pd bRadius10 ks-wbox clearfix">
			    
			    <div class="form-tip-word fl">
			     	<a href="javascript:history.go(-1)" style="cursor: pointer;">
						<span class="fl ks-ss"><i class="iconfont icon-jiantou-copy"></i></span>
						 	
						<div class="form-tip-word fl">作业管理<i class="ks-back">/<?php echo $paper['Title']; ?> </i></div>
						
					</a>
					
					        
			    </div>
			   
			 	
			</div>
			<!--end-->
			
			
		
			  	<div class="class-tab clearfix job-mtb">
			       <ul>
			       	<li class="curr">全部</li>
			       	<?php foreach($memberanswer as $k=>$v){ ?>
			       	 <li><?php echo $v['tmtytitle']; ?></li>
			       	 <?php } ?>
			       </ul>
				</div>				
		  
			
			<!--end-->
			
		 	 <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','reckon',$id,GP(''));  ?>" method="post" id="myform" style="    padding-bottom: 100px;">
		    <div class="stuConBox bg-white bRadius10">
					
                 <div id="lisHeight">
					           <div class="singleBox"></div>
							 <!--单选题-->
							 <?php $is =0;$anserstr = '';  foreach($memberanswer as $k=>$v){  ?>
							 <div class="singleBox">
							 	<p class="singleType"><?php echo $k+1;?>、<?php echo $v['tmtytitle']; ?></p>
							 <div class="stuitem">
							 	<!--题目区域-->
							 	<?php foreach($v['tks'] as $kt=>$vt){
							 	     
							 		$anserstr .=$vt['tk']['anser'].'|^_^|'; 
							 	?>
							 	<div>
							 	<input type="hidden" name="tknum[]" value="<?php echo $vt['tk']['tkid']; ?>" />
							 	<?php	if($vt['tk']['tktype'] == 1){   //单选题
							 		  $a =range('A','Z') ;
							 		  $option =explode('$$$',$vt['tk']['options']);
							 		  $select=explode('|$|',$option[1]);
							 	?>
							 	<div class="exercise-box">
								<div class="exercise-title"><?php echo $k+1;?>.<?php echo $kt+1 ?>、<?php echo $option[0]; ?><span class="exercise-score">(<?php echo $v['score']; ?>分)</span></div>
								<div class="exercise-list">
									<ul>
										<?php foreach($select as $ktt=>$vtt){ ?>
										<li><span class="exerciese-choice"><?php echo  $a[$ktt]; ?>、</span><?php echo $vtt; ?></li>
										<?php } ?>
									</ul>
								</div>
								<div class="exercise-answer">
									<ul>
										<li>参考答案：<?php echo $vt['tk']['anser']; ?></li>
										<li>答案解析:<?php echo $vt['tk']['analysis']; ?></li>
										<li>学生答案:<?php echo  $vt['answer'] ?></li>
										<li>得分：<input type="number" class="textBox w300 number" min="0.0" max="<?php echo $v['score']; ?>" name="score[]" value="<?php if(!empty($stuscoe)){echo $stuscoe[$is];}else{if($vt['tk']['anser']===$vt['answer']){echo $v['score']; }else{echo 0;}} ?>"></li>
									</ul>
								</div>
								
							  </div> 					
							 <?php 	}  ?>


							 <?php if($vt['tk']['tktype'] == 2){//填空题
							 	 $find = '{#answer}';
							      $repl = '_______';
							      $str = '';
								  $options = str_replace($find,$repl,$vt['tk']['options']);
								  $anser = explode('※', $vt['answer']);
								  array_pop($anser);
								  foreach($anser as $d =>$f){
								    if(!empty($f)){
	                                    if($d!=0){
                                          $str .='，'.$f;
	                                   }else{
                                           $str .=$f;
	                                    }
								     }else{
								       	if($d!=0){
                                          $str .='，_';
	                                   }else{
                                           $str .='_';
	                                    }
								     }
								  }
							 ?>	
								 
								 	 
								 <div class="exercise-box">
								
									<div class="exercise-title">
										<!-- <ul> -->
											<?php echo $k+1;?>.<?php echo $kt+1 ?>、<?php echo $options; ?> <span class="exercise-score">(<?php echo $v['score']; ?>分)</span>
										<!-- </ul> -->
									</div>
									<div class="exercise-answer">
										<ul>
											<li>参考答案：<?php echo $vt['tk']['anser']; ?></li>
											<li>答案解析:<?php echo $vt['tk']['analysis']; ?></li>
											<li>学生答案:<?php echo  $str ?></li>
											<li>得分：<input type="number" class="textBox w300 number" min="0.0" max="<?php echo $v['score']; ?>" name="score[]" value="<?php echo $stuscoe[$is]; ?>"></li>
										</ul>
									</div>
								</div>    
							 <?php  } ?>



							 <?php if($vt['tk']['tktype']==3){ //判断题
				             
								   $options = $vt['tk']['options'];
					
					               if($vt['tk']['anser'] ==0){
									 $anser="错误";  
									}else{
									 $anser="正确";
									}						  
				            ?>	
							       <div class="exercise-box">
									<div class="exercise-title"><?php echo $k+1;?>.<?php echo $kt+1 ?>、<?php echo $options; ?><span class="exercise-score">(<?php echo $v['score']; ?>分)</span></div>
									<div class="exercise-opinion  ">
										<ul class="clearfix">
											<li>1、<span class="exerciese-choice">正确</li>
											<li>2、<span class="exerciese-choice">错误</li>
											
										</ul>
									</div>
									<div class="exercise-answer">
										<ul>
											<li>参考答案：<?php echo  $anser; ?></li>
											<li>答案解析: <?php echo  $vt['tk']['analysis']; ?></li>
											<li>学生答案：<?php if($vt['answer']==1){echo "正确";}elseif($vt['answer']==0){echo "错误";}else{ echo "";}  ?></li>
											<li>得分:<input type="number" class="textBox w300 number" min="0.0" max="<?php echo $v['score']; ?>" name="score[]" value="<?php if(!empty($stuscoe)){echo $stuscoe[$is];}else{if($vt['tk']['anser']==$vt['answer']){echo $v['score']; }else{echo 0;}} ?>"></li>
										</ul>
									</div>
								</div>   
							  <?php } ?>   
							     
							     
							  <?php  if($vt['tk']['tktype']==4){//问答题
					                   $options = $vt['tk']['options'];
									   $stem4 = $vt['tk']['options'];
						               
						               $anser = explode('$$$', $vt['tk']['anser']);
						
						               $anser4 = $anser[0];
			
								?>
							     
							    <div class="exercise-box">
									<div class="exercise-title"><?php echo $k+1;?>.<?php echo $kt+1 ?>、<?php echo $options; ?><span class="exercise-score">(<?php echo $v['score']; ?>分)</span></div>
									<div class="exercise-img"></div>
									<div class="exercise-answer">
										<ul>
											<li>参考答案：<?php echo  $anser4; ?></li>
											<li>答案解析: <?php echo  $vt['tk']['analysis']; ?></li>
											<li>学生答案：<?php echo  $vt['answer'] ?></li>
											<li>得分：<input type="number" class="textBox w300 number" min="0.0" max="<?php echo $v['score']; ?>" name="score[]" value="<?php echo $stuscoe[$is]; ?>"></li>
										</ul>
									</div>
								</div>    
							 	<?php } ?>   



							 	<?php 
							 		if($vt['tk']['tktype']==5){ 
							 			$option =explode('$$$',$vt['tk']['options']);
										$select=explode('|$|',$option[1]);
										$anser = explode('|$|', $vt['tk']['anser']);
										$sanser = explode('※',$vt['answer'])
							 	?>	
							 	<div class="exercise-box">
									<div class="exercise-title"><?php echo $k+1;?>.<?php echo $kt+1 ?>、<?php echo $option[0]; ?><span class="exercise-score">(<?php echo $v['score']; ?>分)</span></div>

									
									<div class="exercise-answer">
										<ul>
										<?php foreach($select as $ktt =>$v){?>
										<li><span class="exerciese-choice"><?php echo  $ktt+1; ?>、</span><?php echo $vtt; ?></li>
										<li>参考答案：<?php echo  $anser[$ktt]; ?></li>
										<li>学生答案：<?php echo  $sanser[$ktt] ?></li>
									<?php } ?></ul>
										<ul>
											<li>答案解析： <?php echo  $vt['tk']['analysis']; ?></li>
											<li>得分：<input type="number" class="textBox w300 number" min="0.0" max="<?php echo $v['score']; ?>" name="score[]" value="<?php echo $stuscoe[$is]; ?>"></li>
										</ul>
									</div>
								</div> 		
							 	<?php } ?>   	
							 	<?php if($vt['tk']['tktype']==6){//多选题 	
							 		
							 		
							 		  $a =range('A','Z') ;
							 		  $option =explode('$$$',$vt['tk']['options']);
							 		  $select=explode('|$|',$option[1]);
							 		  ?>
							 	<div class="exercise-box">
								<div class="exercise-title"><?php echo $k+1;?>.<?php echo $kt+1 ?>、<?php echo $option[0]; ?><span class="exercise-score">(<?php echo $v['score']; ?>分)</span></div>
								<div class="exercise-list">
									<ul>
										<?php foreach($select as $ktt=>$vtt){ ?>
										<li><span class="exerciese-choice"><?php echo  $a[$ktt]; ?>、</span><?php echo $vtt; ?></li>
										<?php } ?>
									</ul>
								</div>
								<div class="exercise-answer">
									<ul>
										<li>参考答案：<?php echo $vt['tk']['anser']; ?></li>
										<li>答案解析：<?php echo $vt['tk']['analysis']; ?></li>
										<li>学生答案：<?php echo  $vt['answer'] ?></li>
										<li>得分：<input type="number" class="textBox w300 number" min="0.0" max="<?php echo $v['score']; ?>" name="score[]" value="<?php if(!empty($stuscoe)){echo $stuscoe[$is];}else{if($vt['tk']['anser']==$vt['answer']){echo $v['score']; }else{echo 0;}} ?>"></li>
									</ul>
								</div>
								
							  </div> 	
							 		
							 		
							 			
								<?php  }$is++;?> 
                               </div>
							   <?php }; ?> 
							  <!--题目区域--> 
							  
							  
							  
							  
							 </div>
							  
							</div>
							<?php } ?>
							<!-- <input type="hidden" name="anserstr" value="<?php echo $anserstr; ?>" /> -->
							<div class="exercise-box">
					        	<div style="font-size: 14px;">教师评价：<textarea class="form-textarea" name="feel"><?php echo $paperanswers['feel']; ?></textarea></div>
							</div>					        
					        
						
                         
                         
                         </div>
                               
						 
					 </div>
				 
				 	
					</form>		 
					<div class="pb15 ks-bom fixed-bom clearfix">
						<div style="display: inline-block;">
						<?php if($type==1){?>					
						 	<button class="ks-bt bt-pue mr10 fn" type="button" onclick="de_reg()">提交</button>
						 <?php }else{?>
						 	<a onclick="history.go(-1)" class="ks-bt bt-pue mr10 fn">返回列表</a>
						 <?php }?>
						</div>
					</div>
						
					  </div>
				 </div>
				 <!--	<div class="ks-bom ks-fixed-bom clearfix" >
						<span class="fl ml30">
							<button class="ks-bt bt-pue mr10" onclick="submitform()"><i class="iconfont icon-lajitong"></i>批量删除</button>
						</span>
						<div class="mr30 fr"></div>
		
					</div>-->

			 </div>
		
		 </div>
	  </div>
   </div>



<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
$('.class-tab li').click(function(){
		$(this).addClass('curr').siblings().removeClass('curr');
		if($(this).index()==0){
           $('.singleBox:eq('+$(this).index()+')').hide().siblings().show();	
		}else{
			$('.singleBox:eq('+$(this).index()+')').show().siblings().hide();	
		}
		
	});	
	
function submitform(){
	$('#myform').submit();
}	
	
$('.class-sp,.class-choice').hover(function(){
	$('.class-choice').show()
},function(){
	$('.class-choice').hide();
});
		
// IncreaseClass(257,'.lLightBox','.liveCsecond','.liveCsecond');/*左侧高度+左侧二级栏目*/
// tapsAction('.stuTitleTab','.infoBox','.stuConBox','.studentBox');/*选项卡*/
// var selectInputs = $('.chackInput');
// var checkAllInputs = $('.check-all');
// selectall(selectInputs,checkAllInputs);

function de_reg(){

	$('#myform').submit();
}
$('.number').keyup(function(){
	max = $(this).attr('max');
	if((this.value*1/1)>max){
		this.value = max
	}else{
		this.value = this.value*1
	}
})








</script>
</body>
</html>
