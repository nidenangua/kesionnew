<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>kesion教育平台</title>
    <meta name="Keywords" content="kesion教育平台"/>
    <meta name="Description" content="kesion教育平台"/>
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
        <link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <style>
        .radiobox { float: left; margin-right: 10px; }
        
        .question .cho { margin-bottom: 10px; }
        .question .cho span { padding-right: 10px; }
		.titleTab .curr a{color:#476dbe}
		.questin-sub{text-align: left;font-size: 14px;padding-bottom: 8px;padding-top: 8px;line-height: 28px;padding-left: 20px;
 padding-right: 20px;float: left;background: #f9f9f9;}
 		.question-title {background: #f9f9f9;line-height: 45px;margin-bottom: 10px;}
 		.question .cho{    padding: 2px 15px;margin-right: 10px; border-radius: 30px;cursor: pointer;cursor: pointer;height: 27px;line-height: 27px;}
 		.question-title p{padding: 10px 0;line-height: 24px;font-size: 14px;}
 		.question{background: #f9f9f9;}
 		.question-box {background: #fff;border-radius: 10px;margin-bottom: 20px;padding: 20px 0;}
 		.answer {padding: 15px 0 10px 0;line-height: 38px;}
 		input[type=radio] {position: relative;top: 4px;}
    </style>
</head>

<body class="ks-wrap">
	<!--开始-->



	<!--结束-->

	<div class="ks-wbox bRadius10">
	<!--header-->
			<div class="ks-head-box clearfix">
				<div class="ks-head-nav">
			<!--标题-->
			 <a href="javascript:history.go(-1);">试卷管理</a><span><em>/</em>试卷预览</span>
			<!--标题-->
				</div>
			</div>
			
	<!--header-->
	<!--tab-->
     	<div class="ks-head-tab">
 			<ul class="clearfix">
 				<?php foreach($tmtype as $k=>$v){   ?>
        	
		        <li class=" <?php if($k==0){echo 'curr';} ?>">
		        	<?php echo $v["title"] ?>
		        </li>
		        <?php } ?>
 			</ul>
     	</div>
    <!--/tab-->
	
	
	
<div class="contentBox ">

    
    <div class="infoBox">
        <form target="hidframe"  action="" name="">
            <div class="webConBox">
                <?php  foreach($tmtype as $k=>$v){ ?>
                <div class="configTab bRadius10" style="display:<?php if($k==0){echo 'block';}else{echo 'none';} ?>;">
                <?php 
			      $tkIds = explode(',',$v['tkIds']);
				    $i=1;
				  foreach($tkIds as $kt=>$vt){
					
                       foreach($tk as $ktk=>$vtk){
                          if($vtk['tkid']==$vt)
						  {  
                            if($vtk['tktype']==1){
								$a =range('A','Z') ;
								$stem1 = explode('$$$',$vtk['options']);
			
								$stem = $stem1[0];
			
								$select = $stem1[1];
			
								$select = explode('|$|',$select);
			
								$anser1 = $vtk['anser'];
                      ?>

                   
                        <div class="clearfix question-box">
                            <div class="question-title clearfix"><div class="questin-sub "><span class="fl">题目：</span><?php echo '<span class="fl">'.$i.'、</span></div>'.$stem; $i++; ?></div>
                            <div class="clearfix"></div>
                            <div class="question">
                                <?php   foreach($select as $k=>$v){ ?>
                                <p class="cho"><span><?php echo $a[$k] ?>.</span><?php echo $v; ?></p>
                                <?php } ?>
                            </div>
                            <div class="answer clearfix">
                                <?php foreach($select as $kt=>$vt) {?>
                                <div class="radiobox">
                                    <input type="radio" class="radioInput" name="select<?php echo $ktk ?>"
                                           value="<?php echo $a[$kt] ?>" <?php if($a[$k]==$anser1) echo 'checked'; ?>>
                                    <label class="control-label"><?php echo $a[$kt] ?></label>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
             
                    <!--选择-->


                    <?php }elseif($vtk['tktype']==2){
						       
						      $find = '{#answer}';
						      $repl = '_______';
							  $options = str_replace($find,$repl,$vtk['options']);
							  
						
						 ?>   <div class="clearfix question-box">
					          <div class="question-title clearfix"><div class="questin-sub"><span class="fl">题目：</span><?php echo '<span class="fl">'.$i.'、</span></div>'.$options; $i++; ?></div>
                             <div class="answer">答案：<?php echo $vtk['anser'] ?></div>
                            </div>
				   <?php }elseif($vtk['tktype']==3){ 
				             
						   $options = $vtk['options'];
			
			               if($vtk['anser'] ==0){
							 $anser="错误";  
							}else{
							 $anser="正确";
							} 
						  
				   ?> <div class="clearfix question-box">
				          <div class="question-title clearfix"><div class="questin-sub "><span class="fl">题目：</span><?php echo '<span class="fl">'.$i.'、</span></div>'.$options; $i++; ?></div>
                           <div class="answer">答案：<?php echo $anser ?></div>
				    </div>
				   <?php }elseif($vtk['tktype']==4){
					       
						   $stem4 = $vtk['options'];
			               
			               $anser = explode('$$$', $vtk['anser']);
			
			               $anser4 = $anser[0];

					   ?>
					   <div class="clearfix question-box clearfix">
					   	 <div class="question-title"><div class="questin-sub "><span class="fl">题目：</span><?php echo '<span class="fl">'.$i.'、</span></div>'.$stem4; $i++; ?></div>
				        
                         <div class="answer">答案：<?php echo $anser4 ?></div>
				        </div>  
				   
				   
                   <?php }elseif($vtk['tktype']==5){
					      
						  
						  
						  $option5 = explode('$$$',$vtk['options']);
			
			              $option = $option5[0];
					
			             $stem5 =  explode('|$|',$option5[1]);
			
			             $anser5 =  explode('|$|',$vtk['anser']);
					   
					   ?>
                        <div class="clearfix question-box clearfix">
                       <div class="question-title"><div class="questin-sub "><span class="fl">题目：</span><?php echo '<span class="fl">'.$i.'、</span></div>'.$options; $i++; ?></div>
                          
                          <?php $n=1; foreach($stem5 as $ktt=>$vtt){ ?>
                          <div class="question">第(<?php echo $n; ?>)小题：<?php echo $vtt; ?></div>
                          <div class="answer">答案：<?php echo $anser5[$ktt]; ?></div>
                          </div>
                          <?php $n++;} ?>
                           
				   <?php }elseif($vtk['tktype']==6){
				   	            
				   	            $a =range('A','Z') ;
								$stem1 = explode('$$$',$vtk['options']);
			
								$stem = $stem1[0];
			
								$select = $stem1[1];
			
								$select = explode('|$|',$select);
			
								$anser1 = $vtk['anser'];
				   	       
				   	       ?>
				   	
				   	
                        <div class="clearfix question-box">
                            <div class="question-title clearfix"><div class="questin-sub "><span class="fl">题目：</span><?php echo '<span class="fl">'.$i.'、</span></div>'.$stem; $i++; ?></div>
                            <div class="clearfix"></div>
                            <div class="question">
                                <?php   foreach($select as $k=>$v){ ?>
                                <p class="cho"><span><?php echo $a[$k] ?>.</span><?php echo $v; ?></p>
                                <?php } ?>
                            </div>
                            <div class="answer clearfix">
                                <?php foreach($select as $kt=>$vt) {?>
                                <div class="radiobox">
                                    <input type="checkbox" class="radioInput" name="select<?php echo $ktk ?>"
                                           value="<?php echo $a[$kt] ?>" <?php if($a[$k]==$anser1) echo 'checked'; ?>>
                                    <label class="control-label"><?php echo $a[$kt] ?></label>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
              	  </div>
				   	
				   	
				   <?php } ?>	
        

                <?php }}}?>   </div> <?php } ?>
           </div>
            
        </form>
         <?php echo NoC($tks);?>
      
    </div>
</div>
</div>





<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.require(['$','backstage','nicescroll','laydate'],function(){
		loadScorllJs();
		  $('.ks-head-tab li').click(function () {
	        $(this).addClass('curr').siblings().removeClass('curr');
	        $('.configTab:eq(' + $(this).index() + ')').show().siblings().hide();

   		 })
	})
  
</script>
</body>
</html>
