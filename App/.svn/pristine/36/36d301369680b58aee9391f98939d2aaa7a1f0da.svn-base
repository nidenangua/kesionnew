<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" /> 
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<title>消息回复</title>  
<style type="text/css">
	/*********CSS********/
.fl{ float: left; } 
	.fr{ float: right; }
	input,button,select,textarea{ outline:none;}
	::-webkit-scrollbar{width:5px;height:10px;background-color:transparent;opacity: 0;}
	::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px #fff;border-radius:10px;background-color:transparent;}
	::-webkit-scrollbar-thumb{border-radius:10px;background-color:transparent;}
	.PchatBox-infoList::-webkit-scrollbar{width:5px;height:10px;background-color:#CCC}
	.PchatBox-infoList::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px #fff;border-radius:10px;background-color:#CCC}
	.PchatBox-infoList::-webkit-scrollbar-thumb{border-radius:10px;-webkit-box-shadow:inset 0 0 6px #CCC;background-color:#CCC}
	.livePaly-PchatBox{ width: 800px; height: 600px;position: absolute; top: 50%; left: 50%; box-shadow: 0px 0px 10px #CCCCCC; margin-left: -400px; margin-top: -300px; border-radius: 10px;overflow: hidden;}
	.PchatBox-content{ position: relative; height: 100%;background: #fff; }
	.PchatBox-title{position: absolute; width: 100%; background: #188EEE; top: 0px; left: 0px; text-align: center;line-height: 40px; color: #FFFFFF; padding:6px 10px 5px 10px;z-index: 1;}  
	.PchatBox-infoList{position: absolute; top: 50px; bottom: 180px; left: 0px; right: 0px; overflow: auto; padding-top: 10px;padding-bottom: 30px;}
	.PchatBox-infoLength{max-width: 80%; color: #7d7d7d; font-size: 12px; background: #ffffff; line-height: 20px; padding: 10px; overflow: hidden; border-radius: 10px; box-shadow: 0px 0px 10px #888888; margin: 10px;}
	.PchatBox-headImg{border-radius: 50%; overflow: hidden; box-shadow: 0px 0px 10px #888888; }
	.PchatBox-media{ padding: 0px 15px;    overflow: hidden; zoom: 1;}
	.PchatBox-leftbox{ padding-left: 64px; position: relative;}
	.PchatBox-rightbox{ padding-right: 64px; position: relative;}
	.PchatBox-media{ padding: 0px 15px;    overflow: hidden; zoom: 1; min-height: 120px;}
	.Pmedia-left{ position: absolute; left: 3px; width: 64px;height: 64px;top: 5px;}
	.Pmedia-right{ position: absolute;right: 0px;width: 64px;height: 64px;}
	.Pmedia-body h6{ padding: 0px 10px;}
	.PchatBox-send{position: absolute; bottom: 0px; width: 100%; left: 0px;background: #fff; height: 150px;}
	.PchatBox-sBox{padding: 15px;}
	.Psend-title{ height: 33px; border-top: solid 1px #CCCCCC; border: solid 1px #CCCCCC;}
	.Psend-cont{ height: 100px; border: solid 1px #CCCCCC; margin-top: -1px; position: relative; padding: 5px;} 
	.Psend-text{ height: 60px; width: 100%; resize:none; border: none; } 
	.Psend-text:focus{ resize:none; border: none; } 
	.Psend-btn{position: absolute; right: 8px; bottom: 8px; height: 30px; width: 80px; color: white; background: #188EEE; font-size: 14px; border: none; border-radius: 3px;}
	.Pmedia-name{ padding: 0px 10px; color: #7d7d7d;font-size: 12px;}
</style>

</head>

<body>
<form target="hidframe" action="<?php {echo M_URL($this->AppName.'/Index','doReplyNews',$value['id'],GP(""));} ?>" method="post" class="form-horizontal">
<div class="livePaly-PchatBox">
	<div class="PchatBox-content">
		<div class="PchatBox-title"><h2>与<?php echo $value['nickname'];?>的聊天记录</h2></div>
		<div class="PchatBox-infoList">
		<?php foreach($card as $key => $val){ if($value['fromusername'] == $val['fromusername']){ ?>
		<!--循环体-->
		<input type="hidden"  name="fromusername" value="<?php echo $value['fromusername']; ?>"/>
		<input type="hidden"  name="tousername"  value="<?php echo $value['tousername']; ?>"/>
		
			<div class="PchatBox-media">
				<div class="PchatBox-leftbox">
					<div class="Pmedia-left">
						<a href="#">
						<img class="media-object PchatBox-headImg"  src="<?php echo $value['headimgurl']; ?>" onerror="this.src='<?php echo nopic();?>'"  style="width: 64px; height: 64px;">
						</a>
					</div>
					<div class="Pmedia-body">
						<div class="Pmedia-name"><?php echo $value['nickname'];?></div>
						<div class="PchatBox-infoLength fl"><?php echo $val['content']; ?></div>  
					</div>
				</div>
				
			</div>
			
		<?php }else if($value['fromusername'] == $val['tousername']){ ?>	
			
			<?php if(!empty($val['content'])){?>
					    
		    <div class="PchatBox-media">
				<div class="PchatBox-rightbox">
			    	<div class="Pmedia-body">
			    	  
			        	<div class="PchatBox-infoLength fr"><?php echo $val['content']; ?></div>
			        
			      	</div>
			      	<div class="Pmedia-right">
				        <a href="#"> 
				          <img class="media-object PchatBox-headImg" src="<?php echo Img($val['headimgurl']); ?>" onerror="this.src='<?php echo nopic();?>'" style="width: 64px; height: 64px;">
				        </a>
			     	</div>
		     	</div>
		    </div>
		    
		    
		    <?php }?>
		<!--循环体--> 
		<?php } }?>
		
		
		 
		</div>
		
		<div class="PchatBox-send">
			
			<div style="padding: 20px;border-top: 1px solid #E5E5E5;">
				<div class="Psend-cont">
					<div class="Psend-title"></div>
					<textarea name="text" class="Psend-text" rows="" cols=""></textarea>
					<input class="Psend-btn" type="submit" value="发  送" />
				</div>
				
			</div>
			
		</div>
		
		
	</div>
</div>
</form>  	


</script>   
    
</body>
</html>
