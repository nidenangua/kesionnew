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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>
<body class="ks-wrap">
<div class="bRadius10  clearfix">
	<div id="ksBoxHead">
	<!--结束-->
	<div class="Header-tool clearfix">
		<div class="Tool-Title">
		
		<!--图像-->
		<span class="Tool-icon">
			<i class="iconfont icon-xitongyouxiangshezhi"></i>
		</span>
		<!--图像-->
		
		
		<!--标题-->
		<p>家校互通</p>
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
		        	<a title="站内消息"  target="main" href="<?php echo M_URL('Massage','postlist','',GP('option-2')); ?>"><img src="/Images/images/201711/5a14e5e860105.png" onerror="this.src='<?php echo nopic();?>'"/></a>
		            <div class="fsize16 hLh25"><a title="站内消息"  target="main" href="<?php echo M_URL('Massage','postlist','',GP('option-2')); ?>">站内消息</a></div>
	           </div>
	        </li>
	        <li class="fl fsize18 page-animate">
	        	<div class="listbox">
		        	<a title="公告"  target="main" href="<?php echo M_URL('Massage','postlist','',GP('option-1')); ?>"><img src="/Images/images/201711/5a14e5d781885.png" onerror="this.src='<?php echo nopic();?>'"/></a>
		            <div class="fsize16 hLh25"><a title="公告"  target="main" href="<?php echo M_URL('Massage','postlist','',GP('option-1')); ?>">公告管理</a></div>
	           </div>
	        </li>	
	        <li class="fl fsize18 page-animate">
	        	<div class="listbox">
		        	<a title="互动管理"  target="main" href="<?php echo M_URL('interact/Index','index','',GP('appid-8')); ?>"><img src="/Images/images/201711/5a14e5c8e0fe8.png" onerror="this.src='<?php echo nopic();?>'"/></a>
		            <div class="fsize16 hLh25"><a title="聊天数据"  target="main" href="<?php echo M_URL('interact/Index','index','',GP('appid-8')); ?>">聊天数据</a></div>
	           </div>
	        </li>
	        <li class="fl fsize18 page-animate">
	        	<div class="listbox">
		        	<a title="评价管理"  target="main" href="<?php echo M_URL('reviews/Index','index','',GP('appid-13')); ?>"><img src="/Images/images/201711/5a14e62f25490.png" onerror="this.src='<?php echo nopic();?>'"/></a>
		            <div class="fsize16 hLh25"><a title="评价管理"  target="main" href="<?php echo M_URL('reviews/Index','index','',GP('appid-13')); ?>">评价管理</a></div>
	           </div>
	        </li>
	          <!-- <li class="fl fsize18 page-animate">
	        	<div class="listbox">
		        	<a title="信息"  target="main" href="<?php echo M_URL('Massage','postmassage','',GP('option-2')); ?>"><img src="/Images/images/201711/5a003453a8edd.png" onerror="this.src='<?php echo nopic();?>'"/></a>
		            <div class="fsize16 hLh25"><a title="信息"  target="main" href="<?php echo M_URL('Massage','postmassage','',GP('option-2')); ?>">发送站内信息</a></div>
	           </div>
	        </li>	-->
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








