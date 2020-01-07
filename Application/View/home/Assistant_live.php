<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>首页</title>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="renderer" content="webkit"> 
	    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	    <meta name="format-detection" content="telephone=no" />
		<meta name="Keywords" content="科汛V名师是一款能为中小教育培训机构快速增加营业收入，规范教学标准化、资源共享化、线上线下教育相结合等服务体系的云SaaS教育综合平台。">
		<meta name="Description" content="科汛V名师是一款能为中小教育培训机构快速增加营业收入，规范教学标准化、资源共享化、线上线下教育相结合等服务体系的云SaaS教育综合平台。">    <!--Drag reset css-->
		<link href="https://ks.zuojy.com/Public/common/drag/css/reset.css" rel="stylesheet">
		<!--//Drag reset css end-->
		<link href="<?php echo UOOT;?>Public/app/css/assist/common.grid.css" rel="stylesheet">
		<!--//Drag module style end-->
		<link href="<?php echo UOOT;?>Public/app/css/assist/assistheader.css" rel="stylesheet">
		<link href="<?php echo UOOT;?>Public/app/css/assist/assistchat.css" rel="stylesheet">
		<link href="<?php echo UOOT;?>Public/app/css/assist/swiper.min.css" rel="stylesheet">
		<script src="<?php echo UOOT; ?>Public/agoraweb/AgoraSig-1.1.3.js"></script>
        <script src="<?php echo UOOT; ?>Public/agoraweb/AgoraRTCSDK-1.14.0.js"></script>
        <script src="<?php echo UOOT; ?>Public/agoraweb/socket.io-1.2.0.js"></script>
        <style type="text/css">
        	.onReply{
        		display: none;
        	}
        	.reply{
        		cursor: pointer;
        	}
        </style>
	</head>
	<body onbeforeunload="return studentLeave();">		
		<div class="header">
	        <div class="chatHeader">
	           <div class="searchLoginBox fr">
	               <div class="searchBox fl">
	               	  <form action="<?php  echo M_URL('Assistant','problemSearch',$infoid,GP('')) ?>" id="search" method="post">
	                  		<input type="text" class="searchText" placeholder="搜索" name="questionSearch" id="questionSearch">
	                  </form>
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
			<div class="rightChat col-3 col-md-4 col-xs-12">
	            <div class="chatViewRight">
	               <!--视频模块S-->
	               <div class="videoBox" id="video">
	                 
	               </div>
	               <!--视频模块E-->
	               
	               <!--同学列表S-->
	               <div class="stuListBox">
	                  <div class="title">
	                    	 同学：
	                  </div>
	                  <div class="stuImgList">
	                    <div class="swiper-container">
	                      <ul class="clearfix swiper-wrapper" id="studentlist">
	                      	
	                         
	                      </ul>
	                    </div>
	                  </div>
	               </div>
	               <!--同学列表E-->
	            </div>
	        </div>
	        <div class="col-9 col-md-8 col-xs-12 leftChat">
	        	<div class="chatViewLeft onChat">
	        		<div class="clearfix" id="chatTab">
		                 <div class="TopRightBox">
		                   <div class="fr chatTopRight TopRight">
		                       <a class="returnBtn" onclick="window.history.go(-2)">返回</a>
		                       <a class="refreshBtn" onclick="window.location.reload()">刷新</a>  
		                   </div>
		                   <div class="fr askTopRight TopRight">
		                       <a class="refreshBtn">刷新</a> 
		                       
		                   </div>
		                 </div>
		                 <div class="chatTitle clearfix">
		                     <span class="curr">聊天大厅</span>
		                     <span>问题回复</span>
		                 </div>
	               </div>
	               <div class="chatContainer">
	               		  <!--选项卡聊天大厅-->
		                  <div class="chatCon" style="display:block">
		                     <ul class="chatList" id="chatList">
		                        <div class="moreText t-a-c" id="showMore" onclick="clickShowMore()">显示更多</div>
		                        <div class="loading" id="loading" style="display: none;">
		                        	正在加载中
		                        </div>
		                     </ul>
		                     <!--消息发送窗口S-->
		                     <div class="chatInput">
		                        <div class="chatArea">
		                           <textarea width="100%" id="sendchat"></textarea>
		                           <div class="t-a-r">
		                           	<!--图片上传-->
		                           	<input type="button" class="photoBtn">
		                           	<input type="file" name="" id="file_upload" value="" style="display: none;" class="sendPhoto" onchange="uploadPhoto(this)"/>
		                           	<input type="button" class="reply" value="回复" onclick="chat()"></div>
		                        </div>
		                     </div>
		                     <!--消息发送窗口E-->
		                  </div>
		                  <!--选项卡问题答复-->
		                  <div class="chatCon">
		                  	<!--提问列表-->
		                     <ul class="replyAskBox" id="tiwenList">
		                     
		                       
		                        
		                     </ul>
		                  </div>
	                </div>
	        	</div>
	        	<!--回复问题-->
	        	
	        	
	        	
	        	<div class="chatViewLeft onReply">
	               <div class="TopRightBox askUserTop clearfix usertips">
	                 <div class="fr chatTopRight TopRight">
	                     <a class="returnBtn" onclick="backOnChat()">返回</a>
	                     <!--<a class="sortBtn">显示顺序</a>  -->
	                 </div>
	                 <!--学生信息-->
	                 <div class="askUserInfo clearfix" id="askUserInfo">
	                     
	                 </div>
	               </div>
	               <div class="chatContainer">
	                  <div class="chatCon" style="display:block">
	                     <ul class="chatList replyConb" id="answerList">     
	                       
	                     </ul>
	                     <div class="chatInput">
	                        <div class="chatArea">
	                           <textarea width="100%" placeholder="请输入您的回复" class="answerTxt"></textarea>
	                           <div class="t-a-l clearfix">
	                             <input type="button" class="reply fr" value="回复" onclick="tiwenReply(this)">
	                           </div>
	                        </div>
	                     </div>
	                  </div>
	                  
	               </div>
	            </div>
	        	
	        	
	        	
	        </div>
			
			
		</div>
		
		
		
		



		

	</body>
	
	<script src="<?php echo UOOT;?>Public/common/js/utils.js"></script>
    <script>utils.loadJs(['jquery','swiper','assembly'])</script>
    <script type="text/javascript" src="<?php echo UOOT; ?>Public/common/js/common.js" ></script>
    <script>
    	//触发上传图片事件
    	$('.photoBtn').click(function(){
    		$('.sendPhoto').click();
    	})
    
    	//输入框事件
    	$('#questionSearch').keydown(function(event){
    		if(event.keyCode ==13){
    			$('#search').submit();
    		}
    		
    	})
    	
		var swiperContainer = $('.swiper-container').html();		  
        var index = new utils.page({
              ready:function(){
				 
				 this.init();

				 $('.chatTitle span').click(function(){
				     var index = $(this).index();
					 $(this).addClass('curr').siblings().removeClass('curr');
					 $('.TopRightBox .TopRight').eq(index).show().siblings().hide();
					 $('.chatContainer').find('.chatCon').eq(index).show().siblings().hide();	 
				 })
				 
				 //this.allSelect('.allReply','askCheck')
				 
              },
			  init:function(){
			  	  
			  	  var chatListHeight = window.innerHeight - $('.header').outerHeight() - $('#chatTab').outerHeight() - $('.chatInput').outerHeight();
			  	  var tiwenListHeight = window.innerHeight - $('.header').outerHeight() - $('#chatTab').outerHeight();
			  	  if(window.innerWidth<=480){
			  	  	 	this.setSwiper(4);
			  	  		chatListHeight -= $('.chatViewRight').height();
			  	  		tiwenListHeight -= $('.chatViewRight').height();
			  	  }
			  	
			  	  $('#chatList').innerHeight(chatListHeight);
			  	  
			  	  $('#tiwenList').innerHeight(tiwenListHeight);
			  	  
			  	  
				  $('.videoBox').aspectRatio({
					  set:0.7
				  });
				  
				
				  $('.stuHeadIBox').aspectRatio({
					  set:1
				  });
				  
			  },
              resize:function(){
				 this.init();
 
              },
			  windowHeight:function(obj){
				  var windowHeight = $(window).height()-$('.header').innerHeight();
				  $(obj).innerHeight(windowHeight)  
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
	
	
	
	
	
	
	
</html>

<script>
var teacherid  = <?php echo $value['teacherid']; ?>;
var userid     = <?php echo $uid; ?>;//助教id
var username   = '<?php echo $this->userinfo['username']; ?>';
var avatar	   ='<?php echo 'http:'.$this->upload->getHead($uid); ?>';
var courseid   = <?php echo $infoid ?>;
var wxid       = <?php echo $this->wxid ?>;

var sendFlag = false;//发送状态判断是否有过发送与否
var sendNum = 0;

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

        var log = function(m){
//          console.log(m);
            $('#messages').append($('<li>').text(m));
            document.body.scrollTop = 1000 * 1000 * 1000;
        };

        var do_login = function(){
            session = signal.login('<?php echo $uid ?>','<?php echo $SignKey ?>');
            //session.dbg = true;
            session.onLoginSuccess = function(uid){
                log('login success ' + uid);
                g_uid = uid;
            };

            session.onLoginFailed = function(ecode){
                log('login failed ' + ecode);
            
                $('#btnLogin').text('Login');
            };

            session.onLogout = function(ecode){
                log('logouted ' + ecode);
                $('#btnLogin').text('Login');
                $('#btnJoin').text('Join');
                $('#btnCall').text('Call');

                do_leave();
            };

            session.onMessageInstantReceive = function(account, uid, msg){
            	console.log(msg);
                var msg =JSON.parse(msg);
                if(msg.action == 2){//加入连麦
                	
                	join1();
                	
                	
                }
                if(msg.action=6){//老师取消连麦
                	unpublish();
                	
                }
                
//               if(msg.action=5){
//              	
//              	
//              }
//              
//              	
                
                
                log('recv inst msg from ' + account + ' : ' + msg);
            };
            
            session.onInviteReceived = function(call){
                log('recv inst msg from ' + call.peer + ', ' + call.channelName + ', ' + call.extra);

                $('#btnCall').text('End');

                init_call(call);

                check_join( call.channelName );
            };

        };
       
       
       var do_join = function(name){
            log('Joining channel ' +  name);
              //将学员信息广播

            channel = session.channelJoin(name);
            channel.onChannelJoined = function(){
                log('channel.onChannelJoined');
                studentInfo();
                
            };
            
            channel.onChannelJoinFailed = function(ecode){
                log('channel.onChannelJoinFailed', ecode);
            };
            
            channel.onChannelLeaved = function(ecode){
                log('channel.onChannelLeaved');
            };
            //监测学员加入
            channel.onChannelUserJoined = function(account, uid){
                log('channel.onChannelUserJoined ' +  account + ' ' + uid);
            };
            //监测学员离开
            channel.onChannelUserLeaved = function(account, uid){
                $('#student'+account+'').remove();
            };
            //已在线用户
            channel.onChannelUserList = function(users){
               getStudentInfo(users);
            };

            channel.onChannelAttrUpdated = function(type, k, v){
                log('channel.onChannelAttrUpdated ' +  type + ' ' +  k + ' ' + v);
            };

            channel.onMessageChannelReceive = function(account, uid, msg){
            	
//          	console.log(msg);
                var msg =JSON.parse(msg);
                if(msg.action == 0){//教师端允许举手
                	$("#Raisehands").removeAttr("disabled");
                	$('#Raisehands').attr('onclick','Raisehands('+account+')');
                }
                if(msg.action == 10){//监测到新学员加入(助教加入)
                	 if($('#student'+msg.memberid+'').length==0){
                		 $('#studentlist').append('<li id="student'+msg.memberid+'" class="swiper-slide col-4 col-md-4 col-sm-6 col-xs-4"><div class="stuHeadImg"><div class="stuHeadIBox"><img src='+msg.avatar+' alt="" /></div><p class="stuImgName">'+msg.username+'</p></div></li>');
                		 $('.stuHeadIBox').aspectRatio({
								set:1
							});
                	 }
                }
                //关掉举手
                if(msg.action == 3){
                	$("#Raisehands").attr("disabled",'disabled');
                }
                //监测聊天
                 if(msg.action == 4 && account !== '<?php echo $uid; ?>'){
                
                	ReceiveChat(msg);
                }
                 //关掉推流，摄像头
                  if(msg.action == 6){
                	unpublish();
                }
                  //提问
                  if(msg.action == 5){
                  	   getTiwen();
                  }
                 
              
            };

           
        };
         
        var do_logout = function(){
            session.logout();
        };

      
        var do_end = function(){
            log('End call');
            call.channelInviteEnd();
        };
     
        

        var do_leave = function(){
            if(channel){
              channel.channelLeave();
            }

           
        };

        var count = 0;
        
        


     
do_login();	
setTimeout("do_join('<?php echo $channelName ?>')",2000);



//获取在线学员
function getStudentInfo(users){
	var memberid = new Array();
	memberid.push(0);
	for (var i=0;i<users.length;i++){
		 memberid.push(users[i][0])
	}
	var memberids = memberid.join(',');

	$.ajax({
	   type : "post",
	   url : "<?php echo UOOT;?>Plus/Kesion.ajax.php?act=studentlist",
	   dataType:'json',
	   data:{
		   "memberids": memberids,
	   },
	   success:function(memberlist){
			
		    var studentList = '';
		    for(var p in memberlist){//遍历json数组时，这么写p为索引，0,1
		    	studentList += '<li id="student'+memberlist[p].memberid+'" class="swiper-slide col-4 col-md-4 col-sm-6 col-xs-4"><div class="stuHeadImg"><div class="stuHeadIBox"><img src='+memberlist[p].avatar+' alt="" /></div><p  class="stuImgName">'+memberlist[p].username+'</p></div></li>';
				
			}
			
			$('#studentlist').html(studentList);
			
			$('.stuHeadIBox').aspectRatio({
				set:1
			});
		}
	
	});	
		
}
//接收消息
function ReceiveChat(msg){
		var content = '';
		if(msg.type==0){
		    content = '<p>'+msg.content+'</p>';
		}else{
			content = '<div><img src="'+msg.content+'" alt="" /></div>';
		}
		
		
		
		var html = '<li class="otherChat clearfix">'+
                       '<div class="stuHeadImg">'+
                         '<img src="'+msg.avatar+'">'+
                       '</div>'+
                       '<div class="stuInfoBox">'+
                          '<span class="stuName">'+msg.username+'</span>'+
                          '<div class="stuTopic">'+
                             '<i class="chatArrow"></i>'+
                             ''+content+''+
                         '</div>'+
                       '</div>'+
                    '</li>';
		    $('#chatList').append(html);
	}

//发送消息
function chat(){
	
	var sendchat = $("#sendchat").val();
	if(sendchat==''){
		alert("请不要发送空消息")
		return false;
	}
	//add();
	
	chatKppp(0,sendchat);

}
//聊天、个人提问
function chatKppp(type,title){
	  
	
	  $.ajax({
        type:'post',
        url:'<?php echo UOOT;?>Plus/Kesion.ajax.php?act=chatKeep',
        data:{
        	 'type':type,
        	 'title':title,
             'viewid':<?php echo $infoid; ?>,
             'moduleType':<?php echo $moduletype; ?>,
             'wxid':wxid,
             'memberid':<?php echo $uid; ?>,
             'username':username,
           
        },
      
        success:function(data){
				
				if(data=='success'){
					  msg = '{"action":"4","memberid":"'+userid+'","username":"'+username+'","avatar":"'+avatar+'","content":"'+title+'","type":"1"}';			
			
             channel.messageChannelSend( msg );
             
              var html = '<li class="myChat clearfix">'+
	                           '<div class="stuHeadImg">'+
	                              '<img src="'+avatar+'">'+
	                           '</div>'+
	                           '<div class="stuInfoBox">'+
	                              '<span class="stuName">助教回复</span>'+
	                              '<div class="stuTopic">'+
	                                 '<i class="chatArrow"></i>'+
	                                 '<p>'+title+'</p>'
	                              '</div>'+
	                           '</div>'+
	                        '</li>'
				$('#chatList').append(html);
				$("#sendchat").val('');
	            $("#chatList").scrollTop( $("#chatList")[0].scrollHeight); 	
					}
					
					
					

						

	             
	        }	
    	
    })
  }
	

//发送图片
 function uploadPhoto(target){
      var that = target;
      var files = target.files[0];   
      var form = new FormData();
      form.append('file',files);
  
	  var url = "<?php echo UOOT;?>Plus/Kesion.ajax.php?act=chatImg";
	  $.ajax({
	        type:'post',
	    url:url,
	    data:form,
	    contentType:false,
	    processData: false,//此处是data的预处理，需要设置为false才可以
	    success:function(data){
	     	 var info = JSON.parse(data);
	     	 console.log(info)
	     	 if(info.result=='success'){	
	          chatKppp(1,info.info);
	     	 }else{
	     	 	alert(info.info);
	     	 }
	     	 $("#chatList").scrollTop( $("#chatList")[0].scrollHeight); 
	     	 $("#file_upload").val('');
	       }
	  });
};	

//获取所有问题
$.ajax({
	type:"post",
	url:"<?php  echo M_URL('Assistant','problemDetail') ?>",
	data:{
		"courseid":<?php echo $infoid; ?>,
	},
	dataType:"json",
	success:function(e){
		var allContent = '';
		if(e.length==0){
			var str  = '<li>暂无问题信息</li>'
			allContent = str
		}else{
			var listLength = e.length;
			for(var i = 0;i<listLength;i++){
		   		var str = '<li class="clearfix">'+
			                 '<span class="fr replyNum" style="cursor:pointer" onclick="openQuestion(this)" id="'+e[i].interactid+'">回复('+e[i].count+')</span>'+
			                 '<div class="replyInfoBox clearfix">'+
			                   '<input type="checkbox" name="askCheck" class="checkBox fl">'+
			                   '<div class="replyTitle">'+
			                     '<em class="NO">'+i+'.</em>'+
			                     '<span>'+e[i].membername+'：'+e[i].interact+'</span>'+
			                   '</div>'+
			                 '</div>'+
			              '</li>'; 
			    allContent+=str;
		   }
		}
		
		
		   
		$('#tiwenList').append(allContent);
	}
})


//打开问题详情

function openQuestion(target){
	$this = $(target);
	var id = $this.attr("id");
	
	$.ajax({
		type:'post',
        url:'<?php echo UOOT;?>Plus/Kesion.ajax.php?act=getReplay',
        data:{
             'wxid':wxid,
             'interactid':id,
        },
		success : function(e) {  
	       
	            
	            $('.onChat').hide();
	            
	            var html = '';
	            var dataLength = e.length;
	            for(var i = 0;i<dataLength;i++){
	            	var dataArr = e[i];
	            	if(dataArr['memberid']==userid){
	            		var srtItem ='<li class="myChat clearfix" >'+
			                           '<div class="stuHeadImg">'+
			                              '<img src="'+dataArr['avatar']+'">'+
			                           '</div>'+
			                           '<div class="stuInfoBox">'+
			                              '<div class="stuTopic">'+
			                              '<i class="chatArrow"></i>'+
			                                 '<span class="stuName"><em class="fr time">'+dataArr.adddate+'</em><font class="meName">我</font></span>'+
			                                 ''+dataArr.reply+''+
			                              '</div>'+
			                           '</div>'+
			                        '</li>'
	            	}else{
	            		var srtItem ='<li class="otherChat clearfix">'+
			                           '<div class="stuHeadImg">'+
			                              '<img src="'+dataArr['avatar']+'">'+
			                           '</div>'+
			                           '<div class="stuInfoBox">'+
			                              '<div class="stuTopic">'+
			                              '<i class="chatArrow"></i>'+
			                                 '<span class="stuName"><em class="fr time">'+dataArr.adddate+'</em><font class="meName">我</font></span>'+
			                                 ''+dataArr.reply+''+
			                              '</div>'+
			                           '</div>'+
			                        '</li>'
	            	}
	            	html+=srtItem
	            };
	            
	            var headName = e[0].membername;
	            var headHtml = '<div class="askHeadImg fl" data-id="'+e[0].interactid+'" data-name="'+e[0].membername+'">'+
		                         '<img src="'+e[0].avatar+'">'+
			                     '</div>'+
			                     '<div class="askHeadCon">'+
			                        '与'+headName+'回复过<em>'+e[0].count+'</em>次'+
		                       '</div>';
	            $('#askUserInfo').html(headHtml);
	            $('#answerList').html(html);
				
	            $('.onReply').show();
	             var tiwenListHeight = window.innerHeight - $('.header').outerHeight() - 				$('.chatInput').outerHeight()-$('.usertips').outerHeight();
	            
			  	  $('#answerList').innerHeight(tiwenListHeight);
	         },
	});
}

//提问的返回
function backOnChat(){
	 $('.onChat').show();
	 $('.onReply').hide();
	  if(sendFlag){
	 	var innerid = $('.askHeadImg').attr("data-id");
	 	var replayLength = '回复('+sendNum+')'
	 	$('#'+innerid).html(replayLength);
	 }
}
//提问的回复
function tiwenReply(target){
	$this = $(target);
	var id = $('#askUserInfo').find('.askHeadImg').attr("data-id");
	sendNum = $('.askHeadCon').find('em').html();
	var username = $('#askUserInfo').find('.askHeadImg').attr("data-name")
	var content = $('.answerTxt').val();
	var nowTime = new Date().getTime();
	var changeTime = getDate(nowTime)
	if(content==''){
		alert("请输入您的评论")
		return false;
	}
	$.ajax({
		type:"post",
		url:'<?php echo UOOT;?>Plus/Kesion.ajax.php?act=chatReplay',
		data:{
			 'content':content,
             'userid':userid,
             'interactid':id,
             'membername':username,
		},
		success : function(e) { 
			var reg = /^Ok$/i
			console.log(reg.test(e));
			
	            if(reg.test(e)){
	            	var item = '<li class="myChat clearfix" >'+
			                           '<div class="stuHeadImg">'+
			                              '<img src="'+avatar+'">'+
			                           '</div>'+
			                           '<div class="stuInfoBox">'+
			                              '<div class="stuTopic">'+
			                                 '<span class="stuName"><em class="fr time">'+changeTime+'</em><font class="meName">我</font></span>'+
			                                 ''+content+''+
			                              '</div>'+
			                           '</div>'+
			                        '</li>';
			        
			        $('#answerList').append(item);
			        $("#answerList").scrollTop( $("#answerList")[0].scrollHeight); 
			        $('.answerTxt').val('');
			        sendNum++;
		       		$('.askHeadCon').find('em').html(sendNum);
		       		sendFlag = true;//发送过消息，所以把这个状态改成true
	            }
	         },
	});
	
}
//time stamp change
function getDate(tm){ 
	//insert time stamp
    var time = new Date(tm);
    //The timestamp must be an integer，or else you need parseInt change 
    //timeFormat year-month-day  houer：minutes
    var y =time.getFullYear();//year 
    var m = time.getMonth()+1;//month， the window get month is need to add 1；
    var d= time.getDate();//day
    var h = time.getHours();//hours
    var mm = time.getMinutes();//minutes
    return (y+'-'+m+'-'+d+' '+h+':'+mm); 
} 

var page = 0;
//获取之前聊天信息    

function getKeepChat(type){
	console.log(type)
	$('#loading').show();
	if(type=="add"){
       	var nowListHeight = $('#chatList')[0].scrollHeight;
       	
       }
	page++;
	$.ajax({
	        type:'post',
	        url:'<?php echo UOOT;?>Plus/Kesion.ajax.php?act=getKeepChat',
	        dataType:"json",
	        data:{
	             'viewid': <?php echo $infoid; ?>,
	             'moduleType':<?php echo $moduletype; ?>,
	             'wxid':wxid,
	             'p':page
	        },
	      
	        success:function(data){
	        	console.log(data)
	        	var chat=new Array()
	           var dataLength=data.chat.length;
	           console.log(dataLength)
	           if(dataLength<10){
	           	$('#showMore').hide();
	           }
	           
	           for(var i=0; i<dataLength;i++){
	           	      
			          var dataArr = data.chat[i];
			          var chatContent = ''
			          if(dataArr['type']==0){
			          	chatContent = '<p>'+dataArr['interact']+'</p>'
			          }else{
			          	chatContent = '<div class="inner-img"><img src="'+dataArr['interact']+'" alt="" /></div>'
			          }
			          
			          if(dataArr['memberid'] == userid){
							    
				            var html = '<li class="myChat clearfix">'+
		                           '<div class="stuHeadImg">'+
		                              '<img src="'+dataArr['avatar']+'">'+
		                           '</div>'+
		                           '<div class="stuInfoBox">'+
		                              '<span class="stuName">助教回复</span>'+
		                              '<div class="stuTopic">'+
		                                 '<i class="chatArrow"></i>'+
		                                 	''+chatContent+''+
		                              '</div>'+
		                           '</div>'+
		                        '</li>'
			          	
			          }else{
			          	 
						      var html = '<li class="otherChat clearfix">'+
				                           '<div class="stuHeadImg">'+
				                             '<img src="'+dataArr['avatar']+'">'+
				                           '</div>'+
				                           '<div class="stuInfoBox">'+
				                              '<span class="stuName">'+dataArr['membername']+'</span>'+
				                              '<div class="stuTopic">'+
				                                 '<i class="chatArrow"></i>'+
				                               ''+chatContent+''+
				                             '</div>'+
				                           '</div>'+
				                        '</li>';
							
			          }
			         
			           
			           
			           $('#chatList').find('#showMore').after(html);
	           }
	           if(type=="add"){
//	           	$('#chatList').scrollTop( $("#answerList")[0].scrollHeight); 
				var appendListHeight = $('#chatList')[0].scrollHeight;//添加内容之后的高度
				var heightDistancs = appendListHeight - nowListHeight;//添加内容之后和没有添加内容之前的高度相减的差值
				console.log(appendListHeight,nowListHeight)
				console.log(heightDistancs)
				$('#chatList').scrollTop(heightDistancs)
	           }
	           $('#loading').hide();
	        }	
	
	 })
	
}
getKeepChat();
//点击查看更多
function clickShowMore(){
	getKeepChat("add");
}
	
</script>

</script>

<script language="javascript">
	

 

var  channelName = '<?php echo $channelName; ?>';
var channel_key = '<?php echo $token ?>';
   
//进入直播	
var client, localStream, camera, microphone;
var channelvalue =channelName;

client = AgoraRTC.createClient({mode: 'interop'});
client.init(appid, function () {
	client.join(channel_key, channelvalue,userid, function(uid) {
	});
});
localStream = AgoraRTC.createStream({streamID: userid, audio: true, cameraId: camera, microphoneId: microphone, video: true, screen: false});
//加入视频连麦
	
function join1(){
	
	localStream.setVideoProfile('480p');
	localStream.init(function() {
		localStream.play('agora_local');
		client.publish(localStream, function (err) {
			
		});
		client.on('stream-published', function (evt) {
		});
	});
}

channelKey = "";
//监测
client.on('error', function(err) {
    console.log("Got error msg:", err.reason);
    if (err.reason === 'DYNAMIC_KEY_TIMEOUT') {
      client.renewChannelKey(channelKey, function(){
        console.log("Renew channel key successfully");
      }, function(err){
        console.log("Renew channel key failed: ", err);
      });
    }
});
//监测是否有新的直播流
client.on('stream-added', function (evt) {
    var stream = evt.stream;

    console.log("New stream added: " + stream.getId());
    console.log("Subscribe ", stream);
    client.subscribe(stream, function (err) {
      console.log("Subscribe stream failed", err);
    });
});

client.on('stream-subscribed', function (evt) {
    var stream = evt.stream;
    console.log("Subscribe remote stream successfully: " + stream.getId());
    if ($('div#video #agora_remote'+stream.getId()).length === 0 ) {
	     if(stream.getId() ==teacherid){
	     	
	      $('div#video').html('<div id="agora_remote'+stream.getId()+'" style=" width:100%;height:100%;display:inline-block; position:relative"></div>');
	    }else{
	    	
	      $('div#stuVdo').html('<div id="agora_remote'+stream.getId()+'" style=" width:100%;height:100%;display:inline-block; position:relative"></div>');	
	    }
    }
     stream.play('agora_remote' + stream.getId());
});
//视频播放结束移除video组件
client.on('stream-removed', function (evt) {
    var stream = evt.stream;
    stream.stop();
    $('#agora_remote' + stream.getId()).remove();
    var noVideo = '<img src="<?php echo UOOT;?>Public/app/css/assist/video.jpg" alt="">';
    $('#video').html(noVideo);
    console.log(1)
    console.log("Remote stream is removed " + stream.getId());
});
client.on('peer-leave', function (evt) {
    var stream = evt.stream;
    if (stream) {
      stream.stop();
      $('#agora_remote' + stream.getId()).remove();
      var noVideo = '<img src="<?php echo UOOT;?>Public/app/css/assist/video.jpg" alt="">';
    $('#video').html(noVideo);
    console.log(1)
      console.log(evt.uid + " leaved from this channel");
    }
});
function leave() {
document.getElementById("leave").disabled = true;
client.leave(function () {
    console.log("Leavel channel successfully");
}, function (err) {
    console.log("Leave channel failed");
});
}

function publish() {
//document.getElementById("publish").disabled = true;
//document.getElementById("unpublish").disabled = false;
localStream.play('agora_local');
client.publish(localStream, function (err) {
    console.log("Publish local stream error: " + err);
});
}
//关闭推流
function unpublish() {
   
client.unpublish(localStream, function (err) {
    console.log("Unpublish local stream failed" + err);
    
});
   localStream.close();
     $('#video'+userid).remove();
     $('#player_'+userid).remove();
   
    //通知组播已经离开
    msg = '{"action":"11","memberid":"'+userid+'"}';
    channel.messageChannelSend( msg );
}

function getDevices() {
AgoraRTC.getDevices(function (devices) {
    for (var i = 0; i !== devices.length; ++i) {
      var device = devices[i];
      var option = document.createElement('option');
      option.value = device.deviceId;
      if (device.kind === 'audioinput') {
        option.text = device.label || 'microphone ' + (audioSelect.length + 1);
        audioSelect.appendChild(option);
      } else if (device.kind === 'videoinput') {
        option.text = device.label || 'camera ' + (videoSelect.length + 1);
        videoSelect.appendChild(option);
      } else {
        console.log('Some other kind of source/device: ', device);
      }
    }
});
} 


        
   
        
     function Raisehands(teacherid){//举手
            
     	    msg = '{"action":"1","memberid":"'+userid+'","username":"'+username+'","avatar":"'+avatar+'"}';
     	    console.log(msg);
	        session.messageInstantSend(''+teacherid+'',msg );
	        $("#Raisehands").attr("disabled",'disabled');
     }
     function studentInfo(){//广播学员加入信息
     	   msg = '{"action":"10","memberid":"'+userid+'","username":"'+username+'","avatar":"'+avatar+'"}';
	       channel.messageChannelSend( msg );
     }
      function studentLeave(){//学员离开
      	   var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=studentleve';
			$.ajax({
			   type : "post",
			   url : url,
			   data:{
				   "memberid":userid,
				   "channlid":<?php echo $channl['id']; ?>,
			   },
			  success:function(data){
				},
			});	
      	    do_leave();
      	    do_logout();  
      	   
     }
	
	
	 
	
	function tiwen(){//学生提问
	   
	
		var sendchat = $("#tiwen").val();
		if(sendchat==''){
			alert('请输入内容');
			return false;
		}
		 chatKppp(0,sendchat,0,content);
	   
	}
	function delTiwen(id){
		
		var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=delTiwen';
			$.ajax({
			   type : "post",
			   url : url,
			   data:{
				   "id":id,
				   'wxid':wxid,
			   },
			  success:function(data){
			
		 	        $('#a'+id).remove();
			  },
		});	
	}
	
	
	
	//如果没有直播的话就放默认图片
	var noVideo = '<img src="<?php echo UOOT;?>Public/app/css/assist/video.jpg" alt="">';
	if($.trim($('#video').html()=='')){
		$('#video').html(noVideo)
	}
</script>