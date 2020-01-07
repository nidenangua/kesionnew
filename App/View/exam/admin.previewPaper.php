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
    <link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <style>
        .title-box {
            padding: 10px;
            background: #f7f7f7;
            border: 1px solid #eee;
        }

        .titleTab li.curr {
            border-bottom: 0 !important;
        }

        .titleTab li.curr a {
            color: #fff;
            background-color: #333;
            font-size: 16px;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .center {
            width: 950px;
            margin: 0 auto;
            clear: both;
        }

        .main {
            margin-top: 43px !important;
            border-top: 2px solid #f29149;
        }

        .main .main-content {
            background-color: #fff;
            padding: 36px 50px 0 50px;
            border: 1px solid #e3e3e3;
            border-top: 0;
            position: relative;
        }

        .source {
            font-size: 28px;
            font-weight: normal;
            line-height: 40px;
            padding-left: 40px;
        }

        .content-head p {
            line-height: 26px;
            font-size: 14px;
            padding: 5px 0;
            color: #6c6c6c;
        }

        .control-label {
            display: inline-block;
            vertical-align: top;
            height: 25px;
            line-height: 25px;
            margin-left: 5px;
        }

        .radiobox {
            float: left;
            margin-right: 10px;
        }

        .question {
            padding-left: 50px;
        }

        .question .cho {
            margin-bottom: 10px;
        }

        .question .cho span {
            padding-right: 10px;
        }
     .float-div p,.float-div span{display:inline-block;vertical-align: top;}
	 /*.float-div span{width:4%}*/
	  .float-div p {width:95%}
    </style>
</head>

<body class="bg-gary">
<div class="contentBox bRadius10 bg-white w100">

    <ul class="titleTab title-box clearfix ">
        <?php foreach($tmtype as $k=>$v){ ?>
        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($k==0){echo 'curr';} ?>"><a href="javascript:void(0)"
                                                                                        class="c-92"><?php echo $v["title"] ?></a>
        </li>
        <?php } ?>
    </ul>
    <div class="infoBox">
        <form target="hidframe"  action="" name="">
            <div class="webConBox">
                <?php  foreach($tmtype as $k=>$v){ ?>
                <div class="configTab" style="display:<?php if($k==0){echo 'block';}else{echo 'none';} ?>;">
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
			
								$select = explode('|-|',$select);
			
								$anser1 = $vtk['anser'];
                      ?>
                    <!-- 选择题-->
                    <div class="content-body">
                        <div class="clearfix">
                            <div class="float-div">题目：<?php echo $i.'、'.$stem; $i++; ?></div>
                            <div class="question">
                                <?php   foreach($select as $k=>$v){ ?>
                                
                                <p class="cho"><input type="checkbox" <?php  if($a[$k] == $anser1) echo 'checked'; ?> >
                                <span><?php echo $a[$k] ?>.</span><?php echo $v; ?></p>
                                <?php } ?>
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                    </div>
            
                    <?php }elseif($vtk['tktype']==2){
						       
						      $find = '{#answer}';
						      $repl = '_______';
							  $options = str_replace($find,$repl,$vtk['options']);
							  
						
						 ?>
                           <!-- 填空题-->
					         <div class="float-div"><span>题目：<?php echo  $i.'、</span>'.$options;$i++; ?></div><br/>
                             <div>答案：<?php echo $vtk['anser'] ?></div>
				   <?php }elseif($vtk['tktype']==3){ 
				             
						   $options = $vtk['options'];
			
			               if($vtk['anser'] ==0){
							 $anser="错误";  
							}else{
							 $anser="正确";
							} 
						  
				   ?>
                 <!-- 判断题-->
				          <div  class="float-div">题目：<?php echo  $i.'、'.$options;$i++; ?> </div>   
                          <div>答案：<?php echo $anser ?></div>
				   
				   <?php }elseif($vtk['tktype']==4){
					       
						   $stem4 = $vtk['options'];
			               
			               $anser = explode('$$$', $vtk['anser']);
			
			               $anser4 = $anser[0];

					   ?>
                      <!-- 问答题-->
				        <div  class="float-div">题目：<?php echo  $i.'、'.$stem4;$i++; ?> </div>   
                          <div>答案：<?php echo $anser4 ?></div>
				          
				   
				   
                   <?php }elseif($vtk['tktype']==5){
					      
						  
						  
						  $option5 = explode('$$$',$vtk['options']);
			
			              $option = $option5[0];
					
			             $stem5 =  explode('|$|',$option5[1]);
			
			             $anser5 =  explode('|$|',$vtk['anser']);
					   
					   ?>
                    <!--   材料题-->
                        <div  class="float-div">题目：<?php echo  $i.'、'.$option;$i++; ?> </div>   
                          
                          <?php $n=1; foreach($stem5 as $ktt=>$vtt){ ?>
                          <div>第(<?php echo $n; ?>)小题：<?php echo $vtt; ?></div>
                          <div>答案：<?php echo $anser5[$ktt]; ?></div>
                          <?php $n++;} ?>
                           
				   <?php }}}}?>
                </div> 
                <?php } ?>
            </div>
        </form>
        <div class="hLh40"></div>
    </div>
</div>

<script>
    $('.titleTab li').click(function () {
        $(this).addClass('curr').siblings().removeClass('curr');
        $('.infoBox .webConBox>.configTab:eq(' + $(this).index() + ')').show().siblings().hide();

    })
</script>
</body>
</html>
