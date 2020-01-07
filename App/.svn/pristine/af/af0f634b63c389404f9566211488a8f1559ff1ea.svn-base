<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>无标题文档</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.inputText {
height: 32px;
line-height: 32px;
}
.orz{
margin: 15px 20px;
}
.layui-table[lay-even] tr:nth-child(even) {
background: #fafafa;
}
.searchBtn {height: 32px;}
</style>


</head>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
<title>Agora Web Sample</title>

<link rel="stylesheet" href="<?php echo UOOT;?>Public/agoraweb/vendor/bootstrap.min.css">
<!--<script src="{$UOOT}Public/agoraweb/AgoraRTCSDK-1.14.0.js"></script>-->
<script src="{$UOOT}Public/agoraweb/AgoraSig-1.1.3.js"></script>

<script src="{$UOOT}Public/agoraweb/AgoraRTCSDK-1.14.0.js"></script>

<script src="{$UOOT}Public/agoraweb/socket.io-1.2.0.js"></script>
<script src="{$UOOT}Public/agoraweb/adapter.js"></script>
<!--<script src="{$UOOT}Public/agoraweb/vendor/jquery.js"></script>-->
<script src="{$UOOT}Public/common/js/jquery.js"></script>
</head>

<body onbeforeunload="return session.logout();">
<div id="div_device" class="panel panel-default" style="display:none">
<div class="select">
<label for="audioSource">Audio source: </label><select id="audioSource"></select>
</div>
<div class="select">
<label for="videoSource">Video source: </label><select id="videoSource"></select>
</div>
</div>

<div id="div_join" class="panel panel-default">
<div class="panel-body">
	
Key: <input id="key" type="text" value="a5619df7645e4720b8c00f8598308c40" size="36"></input>
Channel: <input id="channel" type="text" value="ssss" size="4"></input>
Host: <input id="video" type="checkbox" checked></input>
<button id="join" class="btn btn-primary" onclick="Raisehands()">举手</button>
<button id="join" class="btn btn-primary" onclick="join1()">Join</button>
<button id="leave" class="btn btn-primary" onclick="leave()">Leave</button>
<button id="publish" class="btn btn-primary" onclick="publish()">Publish</button>
<button id="unpublish" class="btn btn-primary" onclick="unpublish()">Unpublish</button>


</div>
</div>

    <!--style>
    .video__box{width:910px; margin:0 auto; overflow:hidden;}
    .video__main{ width:810px; height:607px;float:left }
    .video__list{ width:200px; height:607px; float:left;}
    .video__item{ width:200px; height:174px; hei background:url(/img/icon_live.png) center center no-repeat; }
    </style>
    <div class="video__main">
    </div>
    <div class="video__list">
        <div class="video__item"></div>
        <div id="video" class="video__item">
            <div id="agora_local"></div>
        </div>
    </div-->

<div id="video" style="margin:0 auto;">
    <div id="agora_local" style="float:right;width:210px;height:147px;display:inline-block;"></div>
</div>
<p></p>
<p></p>
<p></p><p></p><p></p><p></p><p></p>


<br  />


   <div class="toolbar">
    <table>
        <tr>    
            <td> <button id="btnLogin">Login</button> </td>
            <td> <input id="txtAccount1" value="hcl"> </td>
            <td> <button id="btnSwitch">Switch</button> </td>
        </tr>

        <tr>
            <td> <button id="btnCall">Call</button> </td>
            <td> <input id="txtAccount2" value="yyy"> </td>
            <td> <button id="btnInstMsg">InstMsg</button> </td>
        </tr>
        
        <tr>
            <td> <button id="btnJoin">Join</button> </td>
            <td> <input id="txtChannel" value="ssss"> </td>
            <td> <button id="btnMsg">Msg</button> </td>
        </tr>

        <tr>
            <td> </td>
            <td> <input id="m" value="" autocomplete="off"> </td>
            <td> </td>
        </tr>

    </table>    
    </div>


        
    <div class="msg">
         <ul id="messages"></ul>
    </div>

<br />











<script language="javascript">
var client, localStream, camera, microphone;

var audioSelect = document.querySelector('select#audioSource');
var videoSelect = document.querySelector('select#videoSource');

var channel_key = '{KS:$token}';
var channelvalue ='ssss';

 client = AgoraRTC.createClient({mode: 'interop'});
  client.init(key.value, function () {
  	client.join(channel_key, channelvalue,<?php echo $uid ?>, function(uid) {
	 	
	 });

  });
	 

function join1(){
	localStream = AgoraRTC.createStream({streamID: <?php echo $uid ?>, audio: true, cameraId: camera, microphoneId: microphone, video: true, screen: false});
	localStream.setVideoProfile('480p_6');
	localStream.init(function() {
		localStream.play('agora_local');
		client.publish(localStream, function (err) {
			
		});
		client.on('stream-published', function (evt) {
		});
	});
}




//function join1() {
//document.getElementById("join").disabled = true;
//document.getElementById("video").disabled = true;
//var channel_key = '{KS:$token}';
//var channelvalue ='ssss';
//console.log("Init AgoraRTC client with vendor key: " + key.value);
//client = AgoraRTC.createClient({mode: 'interop'});
//client.init(key.value, function () {
//  console.log("AgoraRTC client initialized");
// 
//  client.join(channel_key, channelvalue,<?php echo $uid ?>, function(uid) {
//    console.log("User " + uid + " join channel successfully");
//
//    if (document.getElementById("video").checked) {
//      camera = videoSource.value;
//      microphone = audioSource.value;
//      localStream = AgoraRTC.createStream({streamID: uid, audio: true, cameraId: camera, microphoneId: microphone, video: document.getElementById("video").checked, screen: false});
//      //localStream = AgoraRTC.createStream({streamID: uid, audio: false, cameraId: camera, microphoneId: microphone, video: false, screen: true, extensionId: 'minllpmhdgpndnkomcoccfekfegnlikg'});
//      if (document.getElementById("video").checked) {
//        localStream.setVideoProfile('480p_6');
//      }
//      localStream.init(function() {
//        console.log("getUserMedia successfully");
//        localStream.play('agora_local');
//
//        client.publish(localStream, function (err) {
//          console.log("Publish local stream error: " + err);
//        });
//
//        client.on('stream-published', function (evt) {
//          console.log("Publish local stream successfully");
//        });
//      }, function (err) {
//        console.log("getUserMedia failed", err);
//      });
//    }
//  }, function(err) {
//    console.log("Join channel failed", err);
//  });
//}, function (err) {
//  console.log("AgoraRTC client init failed", err);
//});

  channelKey = "";
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
    if ($('div#video #agora_remote'+stream.getId()).length === 0) {
    
      $('div#video').append('<div id="agora_remote'+stream.getId()+'" style=" width:300px;height:150px;display:inline-block;"></div>');
    }
     stream.play('agora_remote' + stream.getId());
  });

  client.on('stream-removed', function (evt) {
    var stream = evt.stream;
    stream.stop();
    $('#agora_remote' + stream.getId()).remove();
    console.log("Remote stream is removed " + stream.getId());
  });

  client.on('peer-leave', function (evt) {
    var stream = evt.stream;
    if (stream) {
      stream.stop();
      $('#agora_remote' + stream.getId()).remove();
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
  document.getElementById("publish").disabled = true;
  document.getElementById("unpublish").disabled = false;
  client.publish(localStream, function (err) {
    console.log("Publish local stream error: " + err);
  });
}

function unpublish() {
  document.getElementById("publish").disabled = false;
  document.getElementById("unpublish").disabled = true;
  client.unpublish(localStream, function (err) {
    console.log("Unpublish local stream failed" + err);
  });
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

</script>
</body>
</html>



<script>
	  $('#btnLogin').on("click", function(){
            var b = $('#btnLogin');
            if (b.text()=='Login'){
                b.text('Logout');
                do_login();
            }else{
                b.text('Login');
                do_logout();
            }
        });
        
        $('#btnCall').on("click", function(){
            var b = $('#btnCall');
            if (b.text()=='Call'){
                b.text('End');
                do_call();
                check_join();
            }else{
                b.text('Call');
                do_end();
            }
        });

        var check_join = function(channelName){
            if (!channelName){
                channelName = $('#txtChannel').val();
            }else{
                $('#txtChannel').val( channelName );
            }

            var b = $('#btnJoin');
            if (b.text()=='Join'){
                b.text('Leave');
                do_join( channelName );
            }
        }
        
        var check_leave = function(){
            var b = $('#btnJoin');
            if (b.text()!='Join'){
                b.text('Join');
                do_leave();
            }
        }
        
        $('#btnJoin').on("click", function(){
            var b = $('#btnJoin');
            if (b.text()=='Join'){
                b.text('Leave');
                do_join( $('#txtChannel').val() );
            }else{
                b.text('Join');
                do_leave();
            }
        });
        
        $('#btnSwitch').on("click", function(){
            var v1 = $('#txtAccount1').val();
            var v2 = $('#txtAccount2').val();

            $('#txtAccount1').val( v2 );
            $('#txtAccount2').val( v1 );
        });
        
        $('#btnInstMsg').on("click", function(){
            var peer = $('#txtAccount2').val();
            session.messageInstantSend(peer, 'hello world' + count++);
        });
        
        $('#btnMsg').on("click", function(){
            var peer = $('#txtAccount2').val();
            var msg = $('#m').val();
            if (msg==''){
                msg = 'hello world ' + count++;
            }

            channel.messageChannelSend( msg );
        });
       
        var appid = 'a5619df7645e4720b8c00f8598308c40'; 
        var signal = Signal(appid);
        var session;
        var channel;
        var call ;
        var g_uid;

        var log = function(m){
            console.log(m);
            $('#messages').append($('<li>').text(m));
            document.body.scrollTop = 1000 * 1000 * 1000;
        };

        var do_login = function(){
            session = signal.login($('#txtAccount1').val(), '_no_need_token');
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
                log('recv inst msg from ' + account + ' : ' + msg);
            };
            
            session.onInviteReceived = function(call){
                log('recv inst msg from ' + call.peer + ', ' + call.channelName + ', ' + call.extra);

                $('#btnCall').text('End');

                init_call(call);

                check_join( call.channelName );
            };

        };

        var do_logout = function(){
            session.logout();
        };

        var init_call = function(call){
            call.onInviteReceivedByPeer = function(extra){
                log('call.onInviteReceivedByPeer ' + extra);
            }

            call.onInviteAcceptedByPeer = function(extra){
                log('call.onInviteAcceptedByPeer ' + extra);
            }

            call.onInviteRefusedByPeer = function(extra){
                log('call.onInviteRefusedByPeer ' + extra);
                clear_call();
            }
            
            call.onInviteFailed = function(extra){
                log('call.onInviteRefusedByPeer ' + extra);
                clear_call();
            }

            call.onInviteEndByPeer = function(extra){
                log('call.onInviteEndByPeer ' + extra);
                clear_call();
            }
            
            call.onInviteEndByMyself = function(extra){
                log('call.onInviteEndByMyself ' + extra);
                clear_call();
            }

            call.onInviteMsg = function(extra){
                log('call.onInviteMsg ' + extra);
            }


        }
            
        var clear_call = function(){
            $('#btnCall').text('Call');
            check_leave();
        }

        var do_call = function(){
            var channelName = $('#txtChannel').val();
            var peer = $('#txtAccount2').val();


            log('call ' + peer + ' , channelName : ' + channelName + ', extra : ' + JSON.stringify({hi:'from web'}) );

            call = session.channelInviteUser2 ( channelName , peer, JSON.stringify({hi:'from web'}));
            init_call(call);
        };

        var do_end = function(){
            log('End call');
            call.channelInviteEnd();
        };

        var do_join = function(name){
            log('Joining channel ' +  name);

            channel = session.channelJoin(name);
            channel.onChannelJoined = function(){
                log('channel.onChannelJoined');
            };
            
            channel.onChannelJoinFailed = function(ecode){
                log('channel.onChannelJoinFailed', ecode);
            };
            
            channel.onChannelLeaved = function(ecode){
                log('channel.onChannelLeaved');
            };

            channel.onChannelUserJoined = function(account, uid){
                log('channel.onChannelUserJoined ' +  account + ' ' + uid);
            };

            channel.onChannelUserLeaved = function(account, uid){
                log('channel.onChannelUserLeaved ' + account + ' ' + uid);
            };

            channel.onChannelUserList = function(users){
                log('channel.onChannelUserList ' + users);
            };

            channel.onChannelAttrUpdated = function(type, k, v){
                log('channel.onChannelAttrUpdated ' +  type + ' ' +  k + ' ' + v);
            };

            channel.onMessageChannelReceive = function(account, uid, msg){
                log('channel.onMessageChannelReceive ' + account + ' ' + uid + ' : ' + msg);
            };

           
        };
        

        var do_leave = function(){
            if(channel){
              channel.channelLeave();
            }

           
        };

        var count = 0;
        
        
          $('form').submit(function(){
                channel.messageChannelSend($('#m').val());
                channel.channelSetAttr('hello', count++);
                $('#m').val('');
                return false;
                });
       

     
	
</script>