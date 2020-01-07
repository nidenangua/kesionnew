<!doctype html>
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
<!--Drag reset css-->
<link href="https://ks.zuojy.com/Public/common/drag/css/reset.css" rel="stylesheet">
<!--//Drag reset css end-->
<link href="<?php echo UOOT;?>Public/app/css/assist/common.grid.css" rel="stylesheet">
<!--//Drag module style end-->
<link href="<?php echo UOOT;?>Public/app/css/assist/assistheader.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/assist/swiper.min.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/assist/assistheader.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/assist/assistchat.css" rel="stylesheet">
</head>
<body class="gray-bgcolor over-hide">
	<div class="header">
        <div class="chatHeader">
           <div class="searchLoginBox fr">
               <div class="searchBox fl">
                  <input type="text" class="searchText" placeholder="搜索">
               </div>
               <a class="signOut fl"></a>
           </div>
           <div class="fl logoBox">
              <img src="<?php echo UOOT;?>Public/app/css/assist/logo.png" alt="" class="logoImg">
              <span>欢迎您，<?php  echo $this->userinfo['name'] ?>助教</span><span>当前课程：<?php echo $value['title'] ?></span><span>主讲老师：<?php echo $teacherName ?></span>
           </div>
        </div>
    </div>
     	<div class="chatView clearfix">
	        <div class="rightChat col-3 col-md-4 col-sm-4 col-xs-12">
	            <div class="chatViewRight">
	               <div class="videoBox" id="video">
	                  
	               </div>
	               <div class="stuListBox">
	                  <div class="title">
	                     同学：
	                  </div>
	                  <div class="stuImgList">
	                    <div class="swiper-container">
	                      <ul class="clearfix swiper-wrapper">
	                      	 <!--循环体S-->
	                         <li class="swiper-slide col-4 col-md-4 col-sm-6 col-xs-4">
	                           <div class="stuHeadImg">
	                              <div class="stuHeadIBox"><img src="images/stu1.png"></div>
	                              <h6 class="stuImgName">Carrie</h6>
	                           </div>
	                         </li>
	                         <!--循环体E-->
	                      </ul>
	                    </div>
	                  </div>
	               </div>
	            </div>
	        </div>
	        <div class="col-9 col-md-8 col-sm-8 col-xs-12">
	            <div class="chatViewLeft">
	               <div class="TopRightBox askUserTop clearfix">
	                 <div class="fr chatTopRight TopRight">
	                     <a class="returnBtn">返回</a>
	                     <a class="sortBtn">显示顺序</a>  
	                 </div>
	                 <div class="askUserInfo clearfix">
	                     <div class="askHeadImg fl">
	                        <img src="images/stu1.png">
	                     </div>
	                     <div class="askHeadCon">
	                        与Carrie回复过3次
	                     </div>
	                 </div>
	               </div>
	               <div class="chatContainer">
	                  <div class="chatCon" style="display:block">
	                     <ul class="chatList replyConb">
	                        <div class="moreText t-a-c">显示更多</div>
	                        <li class="otherChat clearfix">
	                           <div class="stuHeadImg">
	                              <img src="<?php echo UOOT;?>Public/app/css/assist/stu1.png">
	                           </div>
	                           <div class="stuInfoBox">
	                              <div class="stuTopic">
	                                 <span class="stuName">2018-12-20&nbsp;&nbsp;12:00:00</span>
	                                 <p>您说的我还是不太明白？您可以说的更详细一点吗？拜托了，嘻嘻嗯呢</p>
	                              </div>
	                           </div>
	                        </li>
	                        <li class="myChat clearfix">
	                           <div class="stuHeadImg">
	                              <img src="<?php echo UOOT;?>Public/app/css/assist/stu4.png">
	                           </div>
	                           <div class="stuInfoBox">
	                              <div class="stuTopic">
	                                 <span class="stuName"><em class="fr time">2018-12-20&nbsp;&nbsp;12:00:00</em><font class="meName">我</font></span>
	                                 <p>那就是用二代几何来计算的，你可以看看书，第45页的。</p>
	                              </div>
	                           </div>
	                        </li>
	                     </ul>
	                     <div class="chatInput">
	                        <div class="chatArea">
	                           <textarea width="100%" placeholder="请输入您的回复"></textarea>
	                           <div class="t-a-l clearfix">
	                             <span class="tips">还可以输入200字</span>
	                             <input type="button" class="reply fr" value="回复">
	                           </div>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	            </div>
	        </div>
	        
	    </div>
	
</body>
</html>	
<script src="<?php echo UOOT;?>Public/common/js/utils.js"></script>
<script>utils.loadJs(['jquery','swiper','assembly'])</script>
<script type="text/javascript" src="<?php echo UOOT; ?>Public/common/js/common.js"></script>
<script type="text/javascript">
	var swiperContainer = $('.swiper-container').html();		  
        var index = new utils.page({
              ready:function(){
				 
				 this.int();
				 if(window.innerWidth>480){
				   this.windowHeight('.chatViewLeft,.chatViewRight');
				 }else{
				   this.phoneHeight();
				 }
				 $('.videoBox').aspectRatio({
					  set:0.56
				 });
				 
				 this.studentList();
				 $('.stuHeadIBox').aspectRatio({
					  set:1
				 });

				 
              },
			  int:function(){
				  $('.swiper-container').html(swiperContainer);
				  if(window.innerWidth<480){
					  this.setSwiper(4);
					  $('.stuImgList').height($('.stuHeadImg').height())
				  }
			  },
              resize:function(){
				 this.int();
				 if(window.innerWidth>480){
				   this.windowHeight('.chatViewLeft,.chatViewRight');
				 }else{
				   this.phoneHeight();
				 }
				 $('.videoBox').aspectRatio({
					  set:0.56
				  });
				  
				  this.studentList();
				  $('.stuHeadIBox').aspectRatio({
					  set:1
				  });
				  
              },
			  windowHeight:function(obj){
				  var windowHeight = $(window).height()-$('.header').innerHeight();
				  $(obj).innerHeight(windowHeight)  
			  },
			  studentList:function(){
				  if(window.innerWidth>480){
					  
					$('.stuImgList').innerHeight($('.chatViewRight').innerHeight()-$('.videoBox').innerHeight()-$('.stuListBox .title').outerHeight(true))
					$('.chatList').innerHeight($('.chatViewLeft').innerHeight()-$('.askUserTop').outerHeight(true)-$('.chatInput').innerHeight());                 
					$('.replyAskBox').innerHeight($('.chatViewLeft').innerHeight()-$('.askUserTop').outerHeight(true));
					$('.chatContainer').innerHeight($('.chatViewLeft').innerHeight()-$('.askUserTop').innerHeight(true));
					
				  }else{
					  
					var chatListHeight = $(window).height()-$('.header').innerHeight()-$('.videoBox').innerHeight()-$('.stuImgList').innerHeight()-$('.askUserTop').outerHeight(true)-$('.chatInput').innerHeight();
					var replyAskBoxHeight = $(window).height()-$('.header').innerHeight()-$('.videoBox').innerHeight()-$('.stuImgList').innerHeight()-$('.askUserTop').outerHeight(true);
					$('.chatList').innerHeight(chatListHeight)
					$('.replyAskBox').innerHeight(replyAskBoxHeight)
					
				  }
			  },
			  phoneHeight:function(){
				  $('.chatViewLeft').innerHeight($(window).height()-$('.header').innerHeight()-$('.videoBox').innerHeight()-$('.stuImgList').innerHeight())
				   $('.chatContainer').innerHeight($(window).height()-$('.header').innerHeight()-$('.videoBox').innerHeight()-$('.stuImgList').innerHeight()-$('.askUserTop').outerHeight(true))
				   $('.chatViewRight').css('height','auto');
			  },
			  setSwiper:function(viewNum){
			  	  var mySwiper = new Swiper('.swiper-container',{
					  pagination:false,
					  paginationClickable: true,
					  slidesPerView:viewNum
				  });
			  },
			  allSelect:function(obj,itemlist){
				  $(obj).click(function(){  
					  if($(obj).find('input[type="checkbox"]').is(':checked')){  
						  $('input[name="'+itemlist+'"]').each(function(){  
							  //此处如果用attr，会出现第三次失效的情况  
							  $(this).prop("checked",true);  
						  });  
					  }else{  
						  $('input[name="'+itemlist+'"]').each(function(){  
							  $(this).removeAttr("checked",false);  
						  });  
					  }  
							
				  });
			  }  

        });
</script>

<script>
var username = '<?php  echo $this->userinfo['username']; ?>',
 userid   = '<?php  echo $this->userid; ?>',
 avatar   = '<?php  echo 'http:'.$this->upload->getHead($this->userid); ?>',
interactid = '<?php echo $problem['interactid']; ?>'
wxid = '<?php  echo $this->wxid; ?>',

//自带
var appid = 'a5619df7645e4720b8c00f8598308c40'; 
var signal = Signal(appid);
var session;
var channel;
var call ;
var g_uid;	
var channelName  ='<?php echo $channelName ?>';
var channel_key = '{KS:$token}';//
var SignKey  ='<?php echo $SignKey ?>';
function chatsend(){
		
		var sendchat = $("#sendchat").val();
	    chatKppp(sendchat)
	 	
	}



 function chatKppp(content){
    
    	  $.ajax({
	        type:'post',
	        url:'<?php echo UOOT;?>Plus/Kesion.ajax.php?act=chatReplay',
	        data:{
	             'content':content,
	             'userid':userid,
	             'interactid':interactid,
	        },
	      
	        success:function(data){
	             if(data =='OK'){
	             	 
	             	 
	             	  
	             }
	                 
	        }	
    	
    })
 }
</script>

