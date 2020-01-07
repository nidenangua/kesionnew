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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/myapp.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap" style="min-width: 1200px;">
	<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
     	
		<h3 class="ks-head-title2">
	 		我的应用
		</h3>
		
	</div>
	

     <div class="ks-head-tab">
 			<ul class="clearfix">
 				<li class="curr"><a href="<?php echo M_URL('Service','myapp'); ?>">我的应用</a> </li>
 				<li><a href="<?php echo M_URL('Service','upgrade');?>">升级套餐</a></li>
				<li><a href="<?php echo M_URL('Shop','CapacityService'); ?>">扩容服务</a> </li>
				<li><a href="<?php echo M_URL('Service','orderList'); ?>">我的订单</a> </li>
				<li><a href="<?php echo M_URL('Service','Cart'); ?>">我的购物车</a> </li>
				
 			</ul>
		 </div>
		 
	
		<!--header-->
		<div class="cloud-container">
		<!--table-->
	
		<div class="tips" style="margin-top:15px;font-size:14px">免费快速搭建教育微门户，科汛V名师海量应用全免费。
            <button class="ks-heade-button ks-head-primary" onclick="window.location.href='<?php echo M_URL('Shop','index','',GP('option-0')); ?>'">前往应用中心，开通</button>
        </div>
		<!--/table-->
			<!--table-->
	        <?php foreach($appcategory as $kt=>$vt){
	        	$value = searchArray($values,'categoryid',$vt['categoryid']);
	        	if(count($value)<=0){continue;}
	      
	         {?> 	
			<div class="cloud-table">
			 
				<div class="cloud-row row<?php echo $vt['categoryid'];?>">
				<div class="cloud-title">
				   <?php echo $vt['categoryname'];?> <span class="fr" style="display:none" onClick="tabshow(this,<?php echo $vt['categoryid'];?>)">收起</span>
			   </div>
<div class="cloud-cont clearfix">
		<!--td-->
		<?php if($vt['categoryid']==9){
			$course['0']['courseType']=1;
			$course['0']['title']='视频';
			$course['1']['courseType']=3;
			$course['1']['title']='音频';
			$course['2']['courseType']=4;
			$course['2']['title']='图文';
			$course['3']['courseType']=2;
			$course['3']['title']='直播';
			$course['4']['courseType']=5;
			$course['4']['title']='面授';
			$course['5']['courseType']=6;
            $course['5']['title']='活动';
            $course['6']['courseType']=8;
            $course['6']['title']='教辅周边';
        foreach($course as $ktt=>$vtt){
            ?>
		<div class="cloud-td cloud-spe">
			<div class="show_box">
				<div class="cloud-topx clearfix">
					<div class="could-div">
					<div class="topx_img"><a href="<?php echo M_URL('course/Index','','',GP('appid-6,courseType-'.$vtt['courseType']));?>"><img src="/Images/images/201804/course<?php echo $vtt['courseType'];?>.png" onerror="this.src='<?php echo nopic(4);?>'" style="width:70px; height:70px;"></a></div>
					<div class="topx_text">
					<div class="topx_text_mome">
					<a href="<?php echo M_URL('course/Index','','',GP('appid-6,courseType-'.$vtt['courseType']));?>" ><?php echo $vtt['title'];?>管理</a>							
					</div> 
					<div class="topx_text_price clearfix"style="margin-left:-15px;margin-top:10px" >
				  	<i class="iconfont icon-shezhi" style="float:left;font-size:22px;margin-right:30px;" onClick="appSetUp({title:'应用设置',type:'app',appid:6,wxid:<?php echo $this->wxid;?>,isopen:1,types:<?php echo $vtt['courseType'];?>})"><em>设置</em></i>
					<a onClick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']);?>'"详情</a>
					</div>    
					<div class="topx_rii">
					<div><?php $courmodel = M('app_course');$count=$courmodel->getOne('count(courseid)',"where wxid=$this->wxid and courseType=".$vtt['courseType']);echo $count.'条'.$vtt['title'];?></div>
					<div><?php $time=strtotime(date('Y-m-d',time())); $count=$courmodel->getOne('count(courseid)',"where wxid=$this->wxid and courseType=".$vtt['courseType']." and adddate>$time");echo $count;?>今日新增</div>
					<div><?php $count=$courmodel->getOne('count(courseid)',"where wxid=$this->wxid and courseType=".$vtt['courseType']." and status=0");echo $count;?>个未审核</div>
					</div>
					</div>
				
				</div>    
			</div>
		              
			</div>
		</div>
		<?php }}?>
		<?php foreach($value as $k=>$v){
                  if ($v['appid']==19){  //独立收款插件，不显示
                      continue;   
                  }

        ?>
		<div class="cloud-td cloud-spe">
			<div class="show_box">
				<div class="cloud-topx clearfix">
					<div class="could-div">
					<div class="topx_img">
                        <?php
                             $url='#';
                             $urltarget='';
                             if ($v['basictype']==1){
                                 $url=M_URL(GC($v['basictype']).'/Index','','',GP('appid-'.$v['appid']));
                             }else{
                                 switch ($v['appid']){
                                     case 28:
                                         $url=M_URL('Massage','postlist','',GP('option-2'));
                                         break;
                                     case 36:  //店铺设置
                                         $url='/home.html#/store/setup';
                                         $urltarget=' target="_top"';
                                         break;
                                     case 104:
                                         $url='#';
                                         break;

                                     case 102:   //装修插件
                                         $url='/home.html#/drag';
                                         $urltarget=' target="_blank"';
                                         break;
                                     case 105:   //分销
                                         $url=M_URL('Distribution','index');
                                         break;
                                     case 3:   //折扣卡
                                         $url=M_URL('users/Index','showgroup');
                                         break;
                                     case 21:   //vip卡
                                         $url='/home.html#/privilege';
                                         $urltarget=' target="_top"';
                                         break;
                                     default:
                                         $url=M_URL($v['appename'].'/Index','','',GP('appid-'.$v['appid']));
                                         break;
                                 } 
                             }
                        ?>

				 		<a href="<?php echo $url;?>" >
						 <img src="<?php echo $v['defaultpic'] ?>" onerror="this.src='<?php echo nopic(4);?>'" style="width:70px; height:70px;">
						</a>
					</div>
					<div class="topx_text">
					<div class="topx_text_mome">
					<a href="<?php echo $url;?>"<?php echo($urltarget);?>><?php echo $v['appname'] ?></a>
					<?php if($v['isprice']==1&&$v['enddate']<=time()-24*3600*30&&$v['enddate']>time()){?>
					<a class="topx_text-arr">即将到期</a>
					<?php }elseif($v['isprice']==1&&$v['enddate']<=time()){?>	
					<a class="topx_text-arr">已经到期</a>
					<?php }?>

					<?php if($v['isprice']==1){?>
					<div class="topx-show" style="position: initial;display: inline-block;">
						<i class="iconfont icon-dengji1"></i>
						<p class="topx_text-time topx-hide" style="cursor:pointer;box-shadow: 0 1px 10px rgba(0,0,0,.16);padding: 10px;border-radius: 5px;z-index: 99;background-color:#fff" onClick="location.href='<?php echo M_URL('Service','renew',$v['appid']); ?>'"><?php echo date('Y-m-d',$v['enddate']);?>到期 <a style="display:block;width:60px;padding:0">续费</a></p>
					</div>
					<?php }?>		
					
					</div> 
					<div class="topx_text_price clearfix" style="margin-left:-15px;margin-top:10px">

						<!--<?php if($this->powertype==1){if($v['short']==0){ ?>
						<span style="display:block;position:relative;" onClick="addFast(this,'<?php echo $v['appname']; ?>','<?php echo M_URL(GC($v['basictype']).'/Index','','',GP('appid-'.$v['appid'])); ?>');" data-flag="0" cate="<?php echo $v['categoryid']; ?>" rid="<?php echo $v['id']; ?>">
						<i class="iconfont icon-kuaijiefangshi" style="float:left; font-size:22px; margin-right:30px; position:relative; margin-top:-2px;"></i></span>
						<?php }else{ ?>    
						<span style="display:block;  position:relative; " onClick="removeFast(this,'<?php echo $v['id'];?>','<?php echo M_URL('Index','noshort',$v['id']); ?>');" data-flag="1" cate="<?php echo $v['categoryid']; ?>" rid="<?php echo $v['id']; ?>">
						<i class="iconfont icon-kuaijiefangshi" style="float:left; font-size:22px; margin-right:30px; position:relative;color:#32be75; margin-top:-2px;"> <em>快捷方式</em></i> </span>
						<?php }}?> -->
						
				
						<?php 
                        if($v['appid']!=102&&$v['appid']!=104&&$v['appid']!=19){  //独立收款屏掉设置
                        ?>
						<i class="iconfont icon-shezhi" style="float:left;font-size:22px;margin-right:15px;" onClick="appSetUp({title:'应用设置',type:'app',isopen:1,appid:<?php echo $v['appid']; ?>,wxid:<?php echo $this->wxid; ?>})"><em>设置</em></i>
						<?php }?>
						<?php if($v['isprice']==0&&$v['MustChoose']==0){?>
						<i class="iconfont icon-lajitong" style="float:left;font-size:22px;margin-right:15px;" onClick="uninstall('是否卸载？该操作不可逆!','<?php echo M_URL("Index","myuninstall",$v["id"]);?>','',this);" cate="<?php echo $v['categoryid']; ?>" rid="<?php echo $v['id']; ?>"><em>删除</em></i>
						<?php }?>
						<?php if($k!=0){?>
						<!--<i class="iconfont icon-jiantoushang" style="float:left;font-size:22px;margin-right:30px;" onClick="skip('<?php echo M_URL("Index","myappup",$v["id"]);?>');"><em>向上一级</em></i>-->
						<?php } ?>
						<i class="iconfont icon-16" style="float:left;font-size:22px;margin-right:15px;" onClick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']);?>'"><em>详情</em></i>
						
						<?php if($k!=count($values)-1){?>
						<!--<i class="iconfont icon-jiantouxia-copy" style="float:left;font-size:22px;margin-right:30px;" onClick="skip('<?php echo M_URL("Index","myappdown",$v["id"]);?>');"><em>向下一级</em></i>-->
						<?php }?>		
					</div>
                   

				

					</div>
					<div class="topx_rii">
					<?php switch ($v['appid']){
					case   6:echo '<div>'.$v['count'].'个总课程</div><div>'.$v['todaycount'].'今日课程</div><div>'.$v['status0'].'待审核</div>';break;
					case  11:echo '<div>'.$v['count'].'个老师</div><div>'.$v['todaycount'].'今日新增</div>';break;
					case  10:echo '<div>'.$v['count'].'张试卷</div><div>'.$v['status0'].'张未审核</div>';break;
					case 100:echo '<div>'.$v['count'].'个新增</div><div>'.$v['todaycount'].'今日新增</div><div>'.$v['status0'].'个未审核</div>';break;
					case 101:echo '<div>'.$v['count'].'条资讯</div><div>'.$v['todaycount'].'今日新增</div><div>'.$v['status0'].'条未审核</div>';break;
					case   3:echo '<div>'.$v['count'].'个学员</div><div>'.$v['todaycount'].'今日新增</div>';break;
					case  23:echo '<div>1000个粉丝</div><div>20日新增</div>'; break;;   
					default :''; }?>
					
					</div>
				</div>    
				</div>
				<div class="topx_text_price clearfix" >
				  


				
				</div>                  
			</div>
			</div>
        <?php }}?>	
        	
        	
        	
        		
		<!--//td-->	
</div>	 
					
				</div> 	
            <?php }?>
	    <!--/table-->
			</div> 	
		</div> 		       
	</div>
	
	
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll','cookie'],function(){
	
		loadScorllJs()
		
	});
	
	
function tabshow(target,row){
	
	$(target).parents('.cloud-table').find('.row'+row).slideToggle();

}	
	
function uninstall(msg,url1,url2,t){//确认+取消 弹窗；
	var id   = $(t).attr('rid');
    var cate = $(t).attr('cate');
	top.popup.confirm(msg,{ 
	    determine:function(){ 
		   $('#id_'+id,window.parent.document).remove();
		   $.ajax({
			type:"get",
			url:url1,
			success:function(data,textStatus){
        		   var catelength = $("body",parent.document).find(".leftBoxUl").find(".yyyy_"+cate+" ul li").length;
				   if(catelength==0){$("body",parent.document).find(".leftBoxUl").find(".yyyy_"+cate).hide();}
				   $.cookie('indoor','/home.html/default/Index/myapp',{expires:7,path:'/'});
				   parent.location.reload();
				   return false;
			   }
			})
	    }
	})
}
function oppenFast(t,title,url,myurl){
    var cate = $(t).attr('cate');
    $.ajax({
        type:"get",
        url:url,
        success:function(data,textStatus){
        	if(data.result=='succeed'){
				var $yCate = $("body",parent.document).find(".leftBoxUl").find(".yyyy_"+cate);
            	$yCate.show();
	            $yCate.children(".second").append("<li id='id_"+data.id+"'><a href='"+myurl+"' title='"+title+"' target='main'>"+title+"</a></li>");
                if($yCate[0].className.indexOf('curr')==-1){
	                $yCate.click();
	                setTimeout(function(){
	                	location.reload(); 
	                },300);
                }else{
                	location.reload(); 
                };
			}
       },
       error:function(){
		   location.reload();
           Alert("网络延迟,重新操作!");
       }
    })
};
function addFast(t,title,myurl){
	var id   = $(t).attr('rid');
	var cate = $(t).attr('cate');
	var url ="<?php echo M_URL('Index','short'); ?>";
    $.ajax({
        type:"post",
        url:url,
        data:{id:id},
        success:function(data,textStatus){
        	var $yCate = $("body",parent.document).find(".leftBoxUl").find(".yyyy_"+cate);
        	$yCate.show();
            $yCate.children(".second").append("<li id='id_"+id+"'><a href='"+myurl+"' title='"+title+"' target='main'>"+title+"</a></li>");
            if($yCate[0].className.indexOf('curr')==-1){
                $yCate.click();
                setTimeout(function(){
                	location.reload(); 
                },300);
            }else{
            	location.reload(); 
            };
       },
       error:function(){
		   location.reload();
           Alert("网络延迟,重新操作!");
       }
    })
};
function removeFast(t,id,url){
	var flag       = $(t).attr('data-flag');
	$('#id_'+id,window.parent.document).remove();
    var cate       = $(t).attr('cate');
    var catelength = $("body",parent.document).find(".leftBoxUl").find(".yyyy_"+cate+" ul li").length;
    if(catelength==0){$("body",parent.document).find(".leftBoxUl").find(".yyyy_"+cate).hide();}
	$.ajax({
		type:"get",
		url:url,
		data:{id:id},
		success:function(data,textStatus){
			   location.reload();
		},
	    error:function(){
		   location.reload();
		   return false;
		   Alert("网络延迟,重新操作!");
	    }
	})
};
</script>
</body>
</html>
