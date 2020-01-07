<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//store.kesion.com/Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/content/content.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<title>消息回复</title>  

<style type="text/css">
	.wrap{position: absolute;right: 20px;left: 20px;top:0px;bottom: 20px;}
	.tab ul{margin-top:5px;}
	.tab ul li{float: left;border-bottom: solid 1px #FFFFFF;margin-right:30px;line-height:30px;cursor: pointer;font-size: 14px;}
	.tab ul li.active{color: #557BC2;border-bottom: solid 1px #557BC2;}
	.Psend-btn{position: absolute;bottom: 0px;right: 0px;width: 100%;height:35px;color: #FFFFFF;border: none;cursor: pointer;text-align: center;}
	.card-box{position: relative;padding-left:50px;margin-bottom: 10px;padding-top: 15px;}
	.card-title{position: absolute;left: 0px;top: 15px;line-height: 35px;font-size: 15px;}
	
	.tab ul li.active{ color: #DA4F0C; border-bottom: 1px solid #DA4F0C; }

	.tab ul li.active{
		color: #DA4F0C;
		border-bottom: 1px solid #DA4F0C;
	}
	
	.card-news {font-size: 16px; color: #666;margin-top: 20px;}
	.card-news h3{font-size: 14px;color: #999;}
	
</style>
<body>
    <form target="hidframe" action="<?php echo M_URL('Content','developManageDoSave',$id,GP(''));  ?>" method="post" class="form-horizontal">
        <div class="wrap">
            <div style="position: relative;margin-top: 40px;">
                <div class="card-box">
                    <div class="card-title">标 题</div>
                    <div class="card-cont">
                        <input type="text" name="title" value="<?php if(!empty($values)){echo $values['title'];}?>" style="border: solid 1px #E5E5E5;height: 30px;width: 100%;" />
                    </div>
                </div>

                <div class="card-box">
                    <div class="card-title">发布时间</div>
                    <div class="card-cont">
                        <input type="text" id="time" name="adddate" value="<?php if(!empty($values)){echo date('Y-m-d H:i:s',$values['adddate']);}else{echo date('Y-m-d H:i:s',time());}?>" style="border: solid 1px #E5E5E5;height: 30px;width: 100%;" />
                    </div>
                </div>
                <?php echo ks_editor('content',!empty($values)?$values['content']:'',$type='1',$att='',$width='',$height='430px');?>
            </div>
            <div class="Psend-btn">
                <button class="mr20 ks-bt btn-s-md bt-pue fn" style="border-color: #DA4F0C;background: #DA4F0C;">确认</button>
                <button class="ks-bt btn-s-md bt-gray fn" type="button" onclick="top.closePopup('all');">取消</button>
                <input type="hidden" name="wxid" value="<?php echo $id ?>" />
                <input type="hidden" id="leixing" name="type" value="1" />
            </div>
        </div>

    </form>  	

<script src="//store.kesion.com/Public/common/js/common.js"></script> 
<script type="text/javascript">
	datatime('#time')
	$("#tab li").click(function(){
		
		$(".card-box").show();
		var index = $(this).index()
		if(index==1){$(".card-box").hide();
		$("#edui1_iframeholder").css("height","185px")
		$("#leixing").val(2);
		}else{
			$("#edui1_iframeholder").css("height","130px")
		}
		$("#tab li").removeClass("active");
		$(this).addClass("active");
		
	})
</script>
    
</body>
</html>
