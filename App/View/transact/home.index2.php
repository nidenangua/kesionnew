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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
	.titleTab li{width: 20%;float: left;}
	.titleTab .listbox{text-align: center;height:180px;position: relative;cursor: pointer;border-radius: 10px; box-shadow: 0px 0px 6px #CCCCCC; margin:0px 40px 15px 0px;background: #fff;}
	.titleTab li p{position: absolute;bottom: 22px;margin: 0 auto; right: 0;left: 0;font-size: 17px;}
	.titleTab li span{position: absolute;bottom: 5px;margin: 0 auto; right: 0;left: 0;font-size: 13px;color: #188eee;display: none;}
	.titleTab li img{width: 65px; height: 65px; margin-top: 40px;transition: all 0.3s linear;}
	.titleTab li:hover .listbox{background: #f6f6f6;box-shadow: 0 0 10px #ccc;}
	.titleTab li:hover img{transform: scale(1.1);-webkit-transform: scale(1.1);-moz-transform: scale(1.1)}
	/*.page-animate{opacity: 0;filter:Alpha(opacity=0)}*/
</style>
</head>
<body class="ks-wrap">
<div class="bRadius10  clearfix">
	<div id="ksBoxHead">
	<!--结束-->
	<div class="Header-tool clearfix">
		<div class="Tool-Title">
		<!--图像-->
		<span class="Tool-icon">
			<i class="iconfont icon-wangxiaopeizhi"></i>
		</span>
		<!--图像-->
		<!--标题-->
		<p>管理中心</p>
		<!--标题-->
		</div>
		<!--操作范围-->
		<!--操作范围-->
	</div>
</div>
    <div id="ksBoxContent">
    	<ul class="titleTab clearfix" style="margin:35px 0px 15px 0;"> 
	        <li class="fl fsize18 page-animate">
	        	<div class="listbox">
		        	<a title="办理中心"  target="main" href="<?php echo M_URL('transact/Index','','',GP('appid-34'));?>"><img src="/Images/images/201711/5a14e5d781885.png" onerror="this.src='<?php echo nopic();?>'"/></a>
		            <div class="fsize16 hLh25"><a title="办理中心"  target="main" href="<?php echo M_URL('transact/Index','','',GP('appid-34'));?>">办理中心</a></div>
	           </div>
	        </li>
	        <li class="fl fsize18 page-animate">
	        	<div class="listbox">
		        	<a title="排课&结算"  target="main" href="<?php echo M_URL('schedule/Index','','',GP('appid-32'));?>"><img src="/Images/images/201711/5a14e5c8e0fe8.png" onerror="this.src='<?php echo nopic();?>'"/></a>
		            <div class="fsize16 hLh25"><a title="排课&结算"  target="main" href="<?php echo M_URL('schedule/Index','','',GP('appid-32'));?>">排课&结算</a></div>
	           </div>
	        </li>
	        <li class="fl fsize18 page-animate">
	        	<div class="listbox">
		        	<a title="校区教室"  target="main" href="<?php echo M_URL('classroom/Index','','',GP('appid-29'));?>"><img src="/Images/images/201711/5a14e5b8bb8ff.png" onerror="this.src='<?php echo nopic();?>'"/></a>
		            <div class="fsize16 hLh25"><a title="校区教室"  target="main" href="<?php echo M_URL('classroom/Index','','',GP('appid-29'));?>">校区教室</a></div>
	           </div>
	        </li>
     </ul>
    </div>
</div>


<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
<script>
/*$('.titleTab').find('li').each(function(){
	var a = Math.random();
	$(this).addClass('page-animate');
	$(this).attr("data-type","bounceIn");
	$(this).attr("data-delay",a);
	
});*/
 pageAnimate('.page-animate');
 $('.titleTab').find('li').hover(function(){
 	$(this).find('span').fadeIn();
 },function(){
 		$(this).find('span').hide();
 })
function updatesStatus(id){
	  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
	  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	   })
}
function oppenFast(t,title,url,myurl){
	    var cate  = $(t).attr('cate');
        $.ajax({
            type:"get",
            url:url,
            success:function(data,textStatus){
            	if(data.result=='succeed'){
					Alert(title+'开通成功');
				}else{
					$('body').append(data); 
				}
            },
            error:function(){
			   location.reload();
               Alert("网络延迟,重新操作!");
            }
        })
};
</script>
</body>
</html>








