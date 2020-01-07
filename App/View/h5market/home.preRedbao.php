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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
	
<div class="bRadius10 ks-wbox">
	<!--开始-->
	<div id="ksBoxHead">
		<div class="generalTitle clearfix">
		    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
	        <span class="gTitle fsize18"><?php echo $H5name;?></span>
		   <div class="fr">
		  <a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','createteam','',GP("p-$page->now_page")); ?>" style="margin-left:15px;display:inline-block">
			<i class="iconfont icon-jiahao"></i>创建队伍</a>
					  <a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','jointeam','',GP("p-$page->now_page")); ?>" style="margin-left:15px;display:inline-block">
			<i class="iconfont icon-jiahao"></i>加入队伍</a>

		   </div>
		</div>
		
		
		<!--结束-->
	</div>

	<div id="ksBoxContent">
      
            <table width="100%" cellpadding="0" cellspacing="0" border="0"  class="ks-table">
	            <thead>
		            <tr >
		           
		                <th >积分</th>
                        <th >奖励</th>

		            </tr>
	            </thead>
                <tbody>
                <?php for($i=0;$i<=$num;$i++){ ?>
                    <tr>
  
                        <td class="w200"><?php if(isset($pointValue[$i]))echo Field($pointValue[$i]);?></td>
                         
                        <td class="w200"><?php if(isset($moneyValue[$i]))echo Field($moneyValue[$i]);?></td>
                        
                    </tr>
                <?php }?>
                </tbody>
        </table>

      <?php for($i=4;$i<=7;$i++){ ?>
         <div><?php echo $setGameVal[$i]['title']." :&nbsp&nbsp&nbsp".$setGameVal[$i]['value'];?></div>
      <?php }?>
      

    </div>

</div>
<div id="ksBoxFooter">
	
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
    
</script>
</body>
</html>





<!--

<?php

for($i=0;$i<$num['hongbaonum'];$i++){
			echo '这个红包需要积分'.$score[$i].',奖励金额为：'.$money[$i].'<br/>';
		}
		
		
		

?>-->