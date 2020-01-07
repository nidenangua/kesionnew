<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
	<title>科汛V名师登录中心</title>
	<meta name="Keywords" content="科汛V名师是一款能为中小教育培训机构快速增加营业收入，规范教学标准化、资源共享化、线上线下教育相结合等服务体系的云SaaS教育综合平台。">
	<meta name="Description" content="科汛V名师是一款能为中小教育培训机构快速增加营业收入，规范教学标准化、资源共享化、线上线下教育相结合等服务体系的云SaaS教育综合平台。">
	<!--Drag reset css-->
	<link href="https://ks.zuojy.com/Public/common/drag/css/reset.css" rel="stylesheet">
	<!--//Drag reset css end-->
	<!--Drag module style-->
	<link href="<?php echo UOOT;?>Public/app/css/assist/common.grid.css" rel="stylesheet">
	<!--//Drag module style end-->
    <link href="<?php echo UOOT;?>Public/app/css/assist/assistheader.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/css/assist/swiper.min.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/assist/assistchat.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/css/assist/assistsearch.css" rel="stylesheet">
    <script src="<?php echo UOOT; ?>Public/agoraweb/AgoraSig-1.1.3.js"></script>

    
	<!--[if lt IE 9]>
	<script src="/Public/common/js/html5shiv.js"></script>
	<script src="/Public/common/js/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		.onReply{
        		display: none;
        	}
        .chatViewLeft{
        	display: none;
        }
        .replyNum{
        	cursor: pointer;
        }
	</style>
</head>
<body class="gray-bgcolor">
    <div class="header">
        <a class="signOut fr"></a>
        <div class="container">
           <div class="searchLoginBox fr">
               <div class="searchBox fl">
                  <input type="text" class="searchText" placeholder="搜索" id="search">
               </div>
               
           </div>
           <div class="fl logoBox">
               <img src="<?php echo UOOT;?>Public/app/css/assist/logo.png" alt="" class="logoImg">
           </div>
        </div>
    </div>
    <div class="container searcherAsk">
        <div class="chatTopRight TopRight" id="returnIcon">
           <a class="returnBtn" onclick="window.history.go(-2)">返回</a>
        </div>
        <div class="search-c">
        	<!--顶部-->
        	<div class="seaTab">
	           <div class="fr tips"></div>
	           <div class="tabItem">
	              <a>课程</a>
	              <a class="curr">问题</a>
	           </div>
	        </div>
	        <!--搜索内容-->
	        <div class="slideCosBox">
	          <div class="seaAskList">
	             <ul class="replyAskBox" id="replyAskBox">
	             	<div class="loadding" style="display: none;text-align: center;">
	           		     <img src="<?php echo UOOT;?>Public/app/css/assist/loadding.gif" alt="">
	           		</div>
	             </ul>
	           
	          </div>
	        </div>
        </div>
        <div class="chatViewLeft onReply">
	               <div class="TopRightBox askUserTop clearfix usertips">
	                 <div class="fr chatTopRight TopRight" >
	                     <a class="returnBtn" onclick="backOnChat(this)">返回</a>
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
	                           <textarea width="100%" placeholder="请输入您的回复" class="answerTxt" id="sendchat"></textarea>
	                           <div class="t-a-l clearfix">
	                             <input type="button" class="reply fr" value="回复" onclick="chat(this)">
	                           </div>
	                        </div>
	                     </div>
	                  </div>
	                  
	               </div>
	    </div>
        
        
    </div>
    <script src="<?php echo UOOT;?>Public/common/js/utils.js"></script>
    <script>utils.loadJs(['jquery','assembly'])</script>
    		
    <script>
    	var courseid = <?php  echo  $courseid  ?>;
    	<?php  if(empty(!$questionSearch)){ ?>
    	var questionContent = <?php echo $questionSearch; ?>;
    	<?php }else{ ?>
    	var questionContent='';
    	<?php } ?>		
    	
    	var scrollFlag = true;//滚动节流
    	var scrollSwitch = true;//滚动状态判断
    	var p = 0;//页数
    	var wxid       = <?php echo $this->wxid ?>;
    	var userid     = <?php echo $uid; ?>;//助教id
    	var chapterid = <?php echo $chapterid; ?>;
    	var username = '';
    	var avatar	   ='<?php echo 'http:'.$this->upload->getHead($uid); ?>';
    	var questionid = '';
        var replyNum  = 0;
        var sendNum = 0;
        var sendFlag = false;//发送状态判断是否有过发送与否
    	
		//自带
		var appid = 'a5619df7645e4720b8c00f8598308c40'; 
		var signal = Signal(appid);
		var session;
		var channel;
		var call ;
		var g_uid;	
		var channelName  ='<?php echo $channelName ?>';
		var SignKey  ='<?php echo $SignKey ?>';
		
		
		
		
		//回车事件
		$('#search').keydown(function(event){
			if(event.keyCode == "13"){
				questionContent = $('#search').val();
				initData(questionContent);
				
			}
		})
		
		
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
		 }
		do_login();	
setTimeout("do_join('<?php echo $channelName ?>')",2000);
		
		
		
		
		//滚动加载函数(获取所有函数)
		function getList(id,questionContent){
			p++; 
			
			$('.loadding').show();
			$.ajax({
				type:"post",
				url:"<?php  echo M_URL('Assistant','problemDetail') ?>",
				data:{
					"courseid":courseid,
					"questionSearch":questionContent,
					"p":p,
					"maxpage":15,
				},
				dataType:"json",
				success : function(e) {
					
					console.log(e);
					var listLength = e.length;
					//如果一开始进来就没有数据的话
					if(p==1&&listLength==0){
						console.log(2)
						var noValue = '<li style="text-align:center;">我真的尽力，可是真的没有数据</li>';
						$('#replyAskBox').find('.loadding').before(noValue);
						scrollSwitch=false;
						return false;
						
					}
					
					//如果数据小于15条的话或者是没有数据了的话
					if(listLength<15 || listLength==0){
						var noValue = '<li style="text-align:center;">我们也是有底线的</li>';
						$('#replyAskBox').find('.loadding').before(noValue);
						scrollSwitch=false;
						return false;
						
					}
					var lengthContent = '为您查找到<font class="redColor">'+e[0].totalput+'</font>个结果';
						//把条数返还回去
					   $('.tips').html(lengthContent);
					   var allContent = ''
					   for(var i = 0;i<listLength;i++){
					   		var str = '<li class="clearfix">'+
						                 '<span class="fr replyNum" onclick="openQuestion(this)" id="'+e[i].interactid+'" data-name = "'+e[i].membername+'">回复('+e[i].count+')</span>'+
						                 '<div class="replyInfoBox clearfix">'+
						                   '<div class="replyTitle">'+
						                     '<span>'+e[i].membername+'：'+e[i].interact+'</span>'+
						                   '</div>'+
						                 '</div>'+
						              '</li>'; 
						    allContent+=str;
					   }
			           $('#replyAskBox').find('.loadding').before(allContent);
			           $('.loadding').hide();
			           
			         },
			});
		}
		
		
		
		getList(courseid,questionContent);
		
		
		
//打开问题详情
function openQuestion(target){
	
	$this = $(target);
	var id = $this.attr("id");
	var memebername = $this.attr("data-name");
	username = memebername;
	questionid = id;
	$.ajax({
		type:"post",
		url:"<?php echo UOOT;?>Plus/Kesion.ajax.php?act=getReplay",
		data:{
			'wxid':wxid,
            'interactid':id,
		},
		success : function(e) {  
	             $('.search-c').hide(); 
	           
	             $('#returnIcon').hide();
	             
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
			  	  $("#answerList").scrollTop( $("#answerList")[0].scrollHeight); 	
			  	  
	         },
	});
}
//提问的返回
function backOnChat(target){
	 $('.search-c').show();
	 $('#returnIcon').show();
	 $('.onReply').hide();
	 //判断有没有发送过，如果有发送过消息的话  则状态改成true
	 if(sendFlag){
	 	var innerid = $('.askHeadImg').attr("data-id");
	 	var replayLength = '回复('+sendNum+')'
	 	$('#'+innerid).html(replayLength);
	 }
	 
}

//发送消息
function chat(target){
	 sendNum = $('.askHeadCon').find('em').html();
	var sendchat = $("#sendchat").val();
	if(sendchat==''){
		alert("请不要发送空消息")
		return false;
	}
	//add();
	
	chatKppp(0,sendchat);

}
//回复
function chatKppp(type,title){
	  
		
	  $.ajax({
        type:'post',
        url:'<?php echo UOOT;?>Plus/Kesion.ajax.php?act=chatReplay',
        data:{
        	 'type':type,
        	 'content':title,
             'interactid':questionid,
             'wxid':wxid,
             'userid':userid,
             'membername':username,
           
        },
      
        success:function(data){
        	    var reg = /^Ok$/i;
				if(reg.test(data)){
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
				$('#answerList').append(html);
				$("#sendchat").val('');
	            $("#answerList").scrollTop( $("#answerList")[0].scrollHeight); 	
	       		sendNum++;
	       		$('.askHeadCon').find('em').html(sendNum);
	       		sendFlag = true;//发送过消息，所以把这个状态改成true
				}
	        }	
    	
    })
  }	

		$(window).on('scroll',function(){
			//响应区域为50px，如果在这个区域则执行这个函数。
			
			if(scrollTop()+windowHeight()>=(documentHeight()-50)){
                if(scrollFlag&&scrollSwitch){
                	getList(courseid,questionContent);
                	scrollFlag=false;
                	setTimeout(function(){scrollFlag=true},500)
                }
				
			}
		});
		//滚动条卷起来的高度 + 窗口高度 > 文档的总高度 + 50   滚动响应区域50px，如果这个判断为true则表示滚动条滚动到了底部；
		
		//获取页面顶部被卷起来的高度也就是已滚动的高度
		function scrollTop(){
		 return Math.max(
		  //chrome
		  document.body.scrollTop,
		  //firefox/IE
		  document.documentElement.scrollTop);
		}
		
		//获取页面文档总高度
		function documentHeight(){
			//IE9和其他的，和IE8的document.body.scrollHeight和document.documentElement.scrollHeight都可以
			return Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);
		}
		//获取页面浏览器窗口的高度
		function windowHeight(){
			 return (document.compatMode == "CSS1Compat")?
			 document.documentElement.clientHeight:
			 document.body.clientHeight;
		}
		
		//没有图片的时候
		function nofind(){
				var img=event.srcElement;
				img.src="/SysImg/nopic.gif";
				img.onerror=null; //控制不要一直跳动
		}
    </script> 
</body>
</html>
