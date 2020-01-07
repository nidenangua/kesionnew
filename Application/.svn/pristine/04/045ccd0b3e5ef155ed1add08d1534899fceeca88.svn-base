<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<title>科汛V名师课程列表</title>
<meta name="Keywords" content="科汛V名师是一款能为中小教育培训机构快速增加营业收入，规范教学标准化、资源共享化、线上线下教育相结合等服务体系的云SaaS教育综合平台。">
<meta name="Description" content="科汛V名师是一款能为中小教育培训机构快速增加营业收入，规范教学标准化、资源共享化、线上线下教育相结合等服务体系的云SaaS教育综合平台。">
<!--//Drag reset css star-->
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<!--//Drag reset css end-->
<!--Drag module style-->
<link href="<?php echo UOOT;?>Public/app/css/assist/common.grid.css" rel="stylesheet">
<!--//Drag module style end-->
<link href="<?php echo UOOT;?>Public/app/css/assist/assistheader.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/assist/assistcourse.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/assist/swiper.min.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="/Public/common/js/html5shiv.js"></script>
<script src="/Public/common/js/respond.min.js"></script>
<![endif]-->	

</head>
<body class="gray-bgcolor">
	<div class="header">
        <div class="container">
           <div class="searchLoginBox fr">
               <div class="searchBox fl">
                  <input type="text" class="searchText" placeholder="搜索">
               </div>
               <a class="signOut fl"></a>
           </div>
           <div class="fl logoBox">
               <img src="<?php echo UOOT;?>Public/app/css/assist/logo.png" alt="" class="logoImg">
           </div>
        </div>
    </div>
	<!--课程列表-->
	<div class="container slideCosList">
        <div class="title t-a-c">课程列表</div>
        <div class="slideCosBox">
          <div class="slideCosB">
             <div class="swiper-container" id="swiper1">
               <ul class="clearfix swiper-wrapper">
               	  <?php foreach($course as $v){ ?>
               	  <!--循环体S-->
                  <li class="swiper-slide col-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="courseB">
                         <div class="cosImgB">
                            <img src="<?php echo Img($v["defaultpic"]);?>" onerror="this.src='<?php echo nopic();?>'" >
                            <em class="cos-label live-label">直播1</em>
                         </div>
                         <div class="cosInfoB">
                            <div class="cos-title">
                               
                               <h3><?php echo $v['title'];?></h3>
                            </div>
                            <a href="<?php  echo M_URL('Assistant','startLive',$v['courseid'],GP('')) ?>" title="进入课程" class="intoBtn">进入课程</a>
                         </div>
                     </div>
                  </li>
                  <!--循环体E-->
                  <?php } ?>
			
        		  <?php echo NoC($course);?>
                  
               </ul>
               
             </div>
          </div>
          <span class="f-prev"></span>
          <span class="f-next"></span>
        </div>
    </div>
    <!---班级列表-->
	<div class="container slideCosList" style="display: block;">
        <div class="title t-a-c">班级列表</div>
        <div class="slideCosBox">
          <div class="slideCosB">
             <div class="swiper-container" id="swiper2">
               <ul class="clearfix swiper-wrapper">
               	
               	  <?php foreach($class as $c){ ?>
               	  <!--循环体S-->
                  <li class="swiper-slide col-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="courseB">
                         <div class="cosImgB">
                            <img src="<?php echo Img($c["defaultpic"]);?>" onerror="this.src='<?php echo nopic();?>'" >
                            
                         </div>
                         <div class="cosInfoB">
                            <div class="cos-title">
                               <h3><?php echo $c['title'];?></h3>
                            </div>
                            <a href="<?php  echo M_URL('Assistant','startLiveClass',$c['classid'],GP('')) ?>" title="进入班级" class="intoBtn">进入班级</a>
                         </div>
                     </div>
                  </li>
                  <!--循环体E-->
                  <?php } ?>
			
        		  <?php echo NoC($class);?>
                  
               </ul>
             </div>

          </div>
          <span class="c-f-prev"></span>
          <span class="c-f-next"></span>
        </div>
    </div>
    
   
	

<script src="<?php echo UOOT;?>Public/common/js/utils.js"></script>
<script>utils.loadJs(['jquery','swiper','assembly'])</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>

<script>

var swiper1Container = $('#swiper1').html();
var swiper2Container = $('#swiper2').html();
console.log(swiper1Container)
				  
        var index = new utils.page({
              ready:function(){
				this.int();
					
              },
			  int:function(){
				  $('#swiper1').html(swiper1Container);
				   $('#swiper2').html(swiper2Container);
			  	  if(window.innerWidth<480){
					  this.setSwiper(1);
				  }else if(window.innerWidth<992){
					
					  this.setSwiper(3);
				  }else{
					  this.setSwiper(4);
				  }
				 
				  $('.slideCosB').css('opacity','1');
				
				  $('.cosImgB').aspectRatio({
					  set:0.616
				  });
				  $('.slideCosB').height($('.courseB').height())
				  $('.swiper-slide').height($('.courseB').height())
			  },
              resize:function(){
  				 this.int();
				 
              },
			  setSwiper:function(viewNum){
			  	  var mySwiper = new Swiper('#swiper1',{
					  pagination:false,
					  paginationClickable: true,
					  slidesPerView:viewNum,
				  });
				   var mySwiper2 = new Swiper('#swiper2',{
					  pagination:false,
					  paginationClickable: true,
					  slidesPerView:viewNum,
				  });
				  
				  $('.f-prev').on('click', function(e){
					  e.preventDefault()
					  mySwiper.swipePrev()
				  });
				  $('.f-next').on('click', function(e){
					  e.preventDefault()
					  mySwiper.swipeNext()
				  });
				  //班级的上一屏切换
				  $('.c-f-prev').on('click', function(e){
					  e.preventDefault()
					  mySwiper2.swipePrev()
				  });
				  //班级的下一屏
				  $('.c-f-next').on('click', function(e){
					  e.preventDefault()
					  mySwiper2.swipeNext()
				  });
			  }

        });


function submitform(type){
	
	$('#myform').submit();
}	
	
	
</script>
</body>
</html>
