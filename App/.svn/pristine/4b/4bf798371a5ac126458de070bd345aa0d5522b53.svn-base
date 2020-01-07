<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>开发者信息</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<style>
    .form-info {
        font-size:14px;
        line-height:44px;
    }
    .from-code {
        color:#2a75ed;
        margin-left:15px
    }
</style>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
     	
		<h3 class="ks-head-title">微信公众号</h3>
	</div> 
	    <!--header-->
					     
	
		<!--table-->
		<form target="hidframe" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','websiteAdd','',GP(''));?>" method="post" class="commentForm" enctype="multipart/form-data">
		 		    
    
            <div class="form-row clearfix">
                <span class="name"></span>         
                    <label style="display:block;float:none;margin-bottom:15px" ><input type="radio" name="isshuiyin" value="0" checked="checked" class="radioInput" onclick="kaitong(0);">我还没有微信公众号<a class="from-code" href="https://mp.weixin.qq.com/cgi-bin/readtemplate?t=register/step1_tmpl&lang=zh_CN" target="_blank">立即申请</a></label>
                    <label style="display:block;float:none" ><input type="radio" name="isshuiyin" value="1"  class="radioInput" onclick="kaitong(1);">我已经有微信公众号了</label>                
            </div>

            <div class="form-row">
                    <button class="ks-heade-button ks-head-primary" 
					<?php if(ismoduleopen($this->wxid,23,0,1)){?>
					onclick="turnAuth();"
					<?php }else{?>
					onclick="checkpower({msg:'您还未开通公众号代管插件，立即前往开通',url:'/home.html/default/Shop/appDetail/23'});"
					<?php }?>
					 >
                        立即前往微信授权
                    </button>
            </div>

	   </form>

	 
	
	</div>
	<div class="ks-wbox mt20 bRadius10">
        <div class="ks-head-box">
            <h3 class="ks-head-title">绑定公众号有什么用？</h3>
        </div> 
        <div class="form-row">
            <div class="form-info">
                公众号绑定科汛V名师后，您可在科汛V名师后台设置自定义菜单、自动回复、进行粉丝管理等。公众号是您面向粉丝的重要出口，您可向粉丝群发推送活动通告、上新通知，和您的粉丝直接的交流和沟通，粉丝可以直接
                在微信公众号内点击进入您的网校浏览课程，并完成最终的购买。  
            </div>

           
        </div>
    </div>
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage'],function(){
			
		});
		var value=0;
	    function kaitong(v){
		   value=v;
		}
		function turnAuth(){
		  if (value==1){
		  location.href='<?php echo M_URL($this->AppName.'/Index','wechatAuthor','',GP(''));?>'
		 }else{
		 Alert('需要先注册微信公众号！');
		 }
		}
		
	</script>
</body>
</html>