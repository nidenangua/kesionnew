import EventEmitter from"./events";import md5 from"../utils/md5";import io from"../utils/weapp.socket.io";import Event from"./eventTypes";import EmotionList from"./emotionList";import api from"./api";import{URL}from"../utils/config";const{socketHost:socketHost}=URL,roomEvents={[Event.KICK_USER](e,t){t.user.userId==this.options.userId&&(this.trigger(Event.BAN_USER_ROOM),this.disconnectSocket())},[Event.LOGIN_KICK](e,t){this.trigger(Event.BAN_USER_ROOM),this.disconnectSocket()},[Event.LOGIN](e,t){const s=this.addUserlist([t.user]);s.length>0&&this.trigger(Event.UPDATEUSER,"add",s,!0)},[Event.LOGOUT](e,t){const s=this.removeUser(t.uid);s&&this.trigger(Event.UPDATEUSER,"remove",s)},[Event.CONNECT](e,t){this.options.isMobile||this.getOnlineUserList().then(e=>{this.getQuestionHistoryMessage();const t=this.addUserlist(e.data.data.userlist);t.length>0&&this.trigger(Event.UPDATEUSER,"add",t)})},[Event.MICROPHONE](e,t){"open"!==this.status&&this.clearChannelClock()},[Event.ONLINE_TEACHERINFO](e,t){this.teacherData=t.data,this.hasClient=!0,console.log(this.teacherData)},[Event.SET_NICK](e,t){"error"!==t.status&&t.userId===this.userId&&(this.options.userName=this.options.nick=t.nick,api.setNickname(this.options.roomId,t.nick))},[Event.SLICEID](e,t){this.options.session_id=t.data.sessionId},[Event.SET_MANAGER_INFO](e,t){}};class Chat{static parseString(e){return e?e.replace(/</g,"&lt;").replace(/>/g,"&gt;").trim():""}static FormatTime(e){const t=e=>e<10?`0${e}`:e,s=new Date(e/1);return`${s.getFullYear()}-${t(s.getMonth()+1)}-${t(s.getDate())} ${t(s.getHours())}:${t(s.getMinutes())}`}static FormatEmotions(e){if(!e)return"";let t=e.indexOf("[");for(;t>-1;){const s=e.indexOf("]",t+1);if(-1===s)break;const i=e.substring(0,t),r=e.substring(s+1);let n=e.substring(t+1,s);if(n){const e=EmotionList.filter(e=>e.title===n),t=e.length>0?e[0].url:"";t&&(n=`<img src="${t}">`)}t=(e=i+n+r).indexOf("[")}return e}static setCookie(e,t,s){const i=(new Date).getTime()+24*s*60*60*1e3;wx.setStorage({key:`${e}${t}`,data:i})}static getCookie(e){return wx.getStorageSync(e)}suppotSocket(){return!0}static getUid(e){return parseInt(e/1%Math.pow(2,32))+""}hasMoreHistory(){return this._hasMoreHistory}userlist(){return this._user.list}addUserlist(e){const{_user:t,_teacher:s}=this,i=[];return e.forEach(e=>{const r=e.userType;if("teacher"!==e.userType||"chatroom"!==e.userSource)return"manager"===r||"teacher"===r||"assistant"===r?("teacher"===r&&(this.hasClient=!0,this.teacherData=e),void(-1===s.userId.indexOf(e.userId)&&(s.list.push(e),s.id.push(e.uid),s.userId.push(e.userId),i.push(e)))):void(-1===t.userId.indexOf(e.userId)&&(t.list.push(e),t.id.push(e.uid),t.ip.push(e.clientIp),t.userId.push(e.userId),i.push(e)))}),i}removeUser(e){const{_user:t,_teacher:s}=this,i=s.id.indexOf(e);if(-1!==i)return"teacher"===s.list[i].userType&&(this.hasClient=!1),s.id.splice(i,1),s.userId.splice(i,1),s.list.splice(i,1);const r=t.id.indexOf(e);return-1!==r?(t.id.splice(r,1),t.userId.splice(r,1),t.list.splice(r,1)):void 0}static getSign(e){return md5(`polyv_room_sign${e}`)}constructor(e){this.options=Object.assign({},e),this.options.nick=e.userName,this.userId=e.userId,this.options.roomId=e.roomId||e.roomName,this.options.sign=e.sign||Chat.getSign(this.options.roomId),this.options.roomIds=e.roomIds,this.teacherData={},this.historyCount=0,this._hasMoreHistory=!1,this.roomClosed=!1,this._hasHistoryMessage=!1,this.joinChannelClock=null,this.connectDelayNumber=[2e3,3e3,4e3,5e3],this._user={list:[],id:[],userId:[],ip:[]},this._teacher={list:[],id:[],userId:[]},this.lastSpeakTime=0,this.lastAskTime=0,this.hasClient="live"===e.liveStatus;const t=this;var s=new EventEmitter;s.trigger=function(e,...i){return s.emit(e,e,...i),t},s.off=function(e,...i){return s.removeListener(e,...i),t},this.on=function(e,i){return s.on(e,i),t},this.off=s.off.bind(s),this.trigger=s.trigger.bind(s),this.events=Event;for(let e in roomEvents)roomEvents.hasOwnProperty(e)&&this.on(e,roomEvents[e].bind(this))}checkBanRoom(){const e=`ban_user_room${this.options.roomName}`,t=Chat.getCookie(e);return!!t&&(t>(new Date).getTime()||(wx.removeStorageSync(e),!1))}getIsKicked(){return api.getIsKicked(this.options.roomId,this.userId).then(e=>{if(200===e.data.code)return!0;throw e.data})}setup(){let e=!1;this.socket=this.connectSocket();const t=this.overtimeConnect(30);this.socket.on("connect",()=>{clearTimeout(t),this.trigger(Event.CONNECT).login(),e||(this.receiveMessage().receiveClassMessage().receiveJoinResponseMessage().receiveJoinSuccessMessage().socketEvent(),e=!0)})}overtimeConnect(e=30){return setTimeout(()=>{this.trigger(Event.OVERTIMECONNECT)},1e3*e)}login(){const e=this.options;return this.socket.emit("message",JSON.stringify({EVENT:"LOGIN",values:[e.userName,e.pic,e.userId],roomId:e.roomId,type:e.userType})),this._createHeartbeat(),this}_createHeartbeat(){this.heartbeatInterval&&clearInterval(this.heartbeatInterval),this.heartbeatInterval=setInterval(()=>{const e=this.options;this.socket.emit("message",JSON.stringify({EVENT:"HEARTBEAT",uid:e.userId}))},25e3)}receiveClassMessage(){return this.socket.on("class",e=>{let t=JSON.parse(e);if(t&&t.EVENT){let e;switch(t.EVENT){case"onClassStart":e=Event.CLASSSTART;break;case"onClassEnd":e=Event.CLASSEND;break;case"onClassControl":e=Event.CLASSCONTROL}if(!e)return;if(e===Event.CLASSCONTROL){this.trigger(e,t);const s=t.type;return"muteAllAudio"===s?e=Event.MUTEALLAUDIO:"muteAllVideo"===s?e=Event.MUTEALLVIDEO:"muteUserAudio"===s?e=Event.MUTEUSERAUDIO:"muteUserVideo"===s&&(e=Event.MUTEUSERVIDEO),t.EVENT=e,delete t.type,void this.trigger(e,t)}t.EVENT=e,this.trigger(Event.ALLOW_MICROPHONE,t)}}),this}receiveJoinResponseMessage(){return this.socket.on("joinResponse",e=>{let t=JSON.parse(e);t&&(t.EVENT=Event.ALLOW_MICROPHONE,this.trigger(Event.ALLOW_MICROPHONE,t))}),this}receiveJoinSuccessMessage(){return this.socket.on("joinSuccess",e=>{let t=JSON.parse(e);t&&(t.EVENT=Event.SUCCESS_MICROPHONE,this.trigger(Event.SUCCESS_MICROPHONE,t))}),this}receiveMessage(){return this.socket.on("message",e=>{let t;try{t=JSON.parse(e)}catch(e){console.error(e)}if(t&&t.EVENT){let e;switch(t.EVENT){case"CLOSEROOM":this.roomClosed=t.value.closed,e=t.value.closed?Event.CLOSE_ROOM:Event.OPEN_ROOM;break;case"GONGGAO":e=Event.SYSTEM_ANNOUNCEMENT;break;case"SPEAK":switch(t.status){case"error":e=Event.SPEAK_ERROR;break;case"censor":e=Event.SPEAK_CENSOR;break;default:e=Event.SPEAK}break;case"REWARD":e=Event.REWARD;break;case"QUESTION":e=Event.QUESTION;break;case"CLOSE_QUESTION":e=Event.CLOSE_QUESTION;break;case"ANSWER":e=Event.ANSWER;break;case"CUSTOMER_MESSAGE":e=Event.CUSTOMER_MESSAGE;break;case"ERROR":e=Event.SERVER_ERROR;break;case"KICK":e=Event.KICK_USER;break;case"LOGIN_KICK":e=Event.LOGIN_KICK;break;case"REMOVE_HISTORY":e=Event.REMOVE_HISTORY;break;case"REMOVE_CONTENT":e=Event.REMOVE_CONTENT;break;case"CLOSE_DANMU":e=Event.CLOSE_DANMU;break;case"LOGIN":e=Event.LOGIN;break;case"LOGOUT":e=Event.LOGOUT;break;case"onSliceID":e=Event.SLICEID;break;case"onSliceStart":e=Event.SLICESTART;break;case"onSliceControl":e=Event.SLICECONTROL;break;case"onSliceDraw":e=Event.SLICEDRAW;break;case"onSliceOpen":e=Event.SLICEDOPEN;break;case"S_QUESTION":e=Event.S_QUESTION;break;case"T_ANSWER":e=Event.T_ANSWER;break;case"BULLETIN":e=Event.BULLETIN;break;case"REMOVE_BULLETIN":e=Event.REMOVE_BULLETIN;break;case"FLOWERS":e=Event.FLOWERS;break;case"REDPAPER":e=Event.REDPAPER;break;case"SIGN_IN":e=Event.SIGN_IN;break;case"STOP_SIGN_IN":e=Event.STOP_SIGN_IN;break;case"LIKES":e=Event.LIKES;break;case"OPEN_MICROPHONE":e=Event.MICROPHONE;break;case"SET_NICK":e=Event.SET_NICK;break;case"O_TEACHER_INFO":e=Event.ONLINE_TEACHERINFO;break;case"SET_MANAGER_INFO":e=Event.SET_MANAGER_INFO;break;case"GET_TEST_QUESTION_CONTENT":e=Event.GET_TEST_QUESTION_CONTENT;break;case"GET_TEST_QUESTION_RESULT":e=Event.GET_TEST_QUESTION_RESULT;break;case"STOP_TEST_QUESTION":e=Event.STOP_TEST_QUESTION;break;case"SYSTEM_MESSAGE":e=Event.SYSTEM_MESSAGE;break;case"CHAT_IMG":e=Event.CHAT_IMG}if(!e)return;if(t.EVENT=e,e===Event.S_QUESTION){if(t.user.userId!==this.userId)return;t.user.nick||(t.user.nick=t.user.userName),this.lastAskTime=(new Date).getTime(),t=this.parseData([t])[0]}if(e===Event.T_ANSWER&&t.s_userId!==this.userId)return;e===Event.SPEAK&&(t.content=t.values[0],delete t.values,t=this.parseData([t])[0]),e===Event.SPEAK_ERROR&&(t=this.parseData([t])[0]),e===Event.FLOWERS&&(t.flowers=!0),e===Event.REWARD&&(t.reward=!0),e===Event.CUSTOMER_MESSAGE&&(t.customerMessage=!0),this.trigger(e,t)}}),this}socketEvent(){return this.socket.on("disconnect",()=>{this.trigger(Event.DISCONNECT)}),this.socket.on("error",()=>{this.trigger(Event.ERROR)}),this.socket.on("reconnect",e=>{this.trigger(Event.RECONNECT)}),this.socket.on("reconnect_attempt",e=>{this.trigger(Event.RECONNECT_ATTEMPT)}),this}connectSocket(){return io(socketHost,{query:{token:this.options.chatToken},transports:[this.suppotSocket()?"websocket":"polling"],reconnectionDelay:this.connectDelayNumber[Math.floor(4*Math.random())],randomizationFactor:Math.random()})}send(e){if(!this.socket)return void this.trigger(Event.PROHIBIT_TO_SPEAK);if(this.roomClosed)return;if((new Date).getTime()-this.lastSpeakTime<3e3)return void this.trigger(Event.SYSTEM_MESSAGE,{system:!0,content:"您的发言过快，请稍后再试"});const t=Chat.parseString(e),s=this.options,i={EVENT:"SPEAK",values:[t],roomId:s.roomId};return this.socket.emit("message",JSON.stringify(i)),this.lastSpeakTime=(new Date).getTime(),this.trigger(Event.SEND_MESSAGE,this.parseData([{content:t,time:(new Date).getTime(),mySelfSend:!0,id:Math.floor(1e7*Math.random()),user:{nick:s.userName,pic:s.pic,userId:s.userId,roomId:s.roomId,channelId:s.roomName}}])[0]),this}kick(e){const t=this.options,s={EVENT:"KICK",roomId:t.roomId,channelId:t.roomName,userId:e,sign:t.sign};this.socket.emit("message",JSON.stringify(s))}prohibitSpeak(e,t=!0){const s=this.options,i={EVENT:!0===t?"SHIELD":"REMOVE_SHIELD",roomId:s.roomId,channelId:s.roomName,sign:s.sign,value:e};this.socket.emit("message",JSON.stringify(i));const r=this._user,n=r.ip.indexOf(e);r.list[n]&&(r.list[n].banned=!!t)}sendQuestion(e){const t=this.options;if((new Date).getTime()-this.lastAskTime<3e3)return void this.trigger(Event.SYSTEM_MESSAGE,{system:!0,content:"您的发言过快，请稍后再试"});const s={EVENT:"S_QUESTION",roomId:t.roomId,content:e,user:{nick:t.nick,pic:t.pic,userId:t.userId,actor:t.actor?t.actor:"学生",userType:"slice"===t.userType?"student":t.userType}};this.socket.emit("message",JSON.stringify(s))}sendAnnouncement(e){const t=this.options,s={EVENT:"BULLETIN",roomId:t.roomId,channelId:t.roomName,sign:t.sign,content:e};this.socket.emit("message",JSON.stringify(s))}deleteAnnouncement(){const e=this.options,t={EVENT:"REMOVE_BULLETIN",roomId:e.roomId,channelId:e.roomName,sign:e.sign};this.socket.emit("message",JSON.stringify(t))}sendLike(e){const t=this.options,s={EVENT:"LIKES",roomId:t.roomId,channelId:t.roomName,nick:t.nick,count:e};this.socket.emit("message",JSON.stringify(s))}setNick(e){const t=this.options,s={EVENT:"SET_NICK",roomId:t.roomId,channelId:t.roomName,nick:e,userId:t.userId};this.socket.emit("message",JSON.stringify(s))}toSign(e){const{roomId:t,userId:s,nick:i}=this.options;this.socket.emit("message",JSON.stringify({EVENT:"TO_SIGN_IN",roomId:t,checkinId:e,user:{userId:s,nick:i}}))}sendSign(e,t){const s={EVENT:"SIGN_IN",roomId:this.options.roomId,data:{message:e,limitTime:t}};this.socket.emit("message",JSON.stringify(s))}endSign(){const e={EVENT:"STOP_SIGN_IN",roomId:this.options.roomId};this.socket.emit("message",JSON.stringify(e))}sendAnswer(e,t,s=function(){}){const i=this.options,r={EVENT:"ANSWER_TEST_QUESTION",roomId:i.roomId,nick:i.nick,userId:i.userId,option:e,questionId:t};this.socket.emit("message",JSON.stringify(r),s)}joinChannel(){const e=this.options,t={user:{nick:e.nick,pic:e.pic,userId:Chat.getUid(e.micUserId),userType:e.userType,sessionId:e.session_id},roomId:e.roomId,sessionId:e.session_id};this.clearChannelClock(),this.socket.emit("joinRequest",JSON.stringify(t),(e,t,s)=>{this.clearChannelClock()}),this.joinChannelClock=setTimeout(()=>{this.trigger(Event.JOIN_CHANNEL_FAIL)},2e4)}clearChannelClock(){clearTimeout(this.joinChannelClock)}joinChannelSuccess(){const e=this.options,t={user:{nick:e.nick,pic:e.pic,userId:Chat.getUid(e.micUserId),userType:e.userType,sessionId:e.session_id},roomId:e.roomId,sessionId:e.session_id};this.socket.emit("joinSuccess",JSON.stringify(t))}cancelJoinChannel(){const e=this.options,t={user:{nick:e.nick,pic:e.pic,userId:Chat.getUid(e.micUserId),userType:e.userType,sessionId:e.session_id},roomId:e.roomId,sessionId:e.session_id};this.socket.emit("joinLeave",JSON.stringify(t))}disconnectSocket(){return this.socket&&this.socket.close(),this}getActor(e){let t="";return e.actor?t=e.actor:"teacher"===e.userType?t="讲师":"manager"===e.userType?t="管理员":"assistant"===e.userType&&(t="助教"),t}parseData(e){return e.map(e=>(e.user&&(e.reward="1"===e.user.uid,e.isCustomMsg="2"===e.user.uid,e.currentUser=e.user.userId===this.options.userId,e.actor=this.getActor(e.user),e.user.pic=this.dealImgUrl(e.user.pic),e.reward&&e.content.gimg&&(e.content.gimg=this.dealImgUrl(e.content.gimg))),e.content=e.reward||"chatImg"===e.msgSource?e.content:Chat.parseString(e.content),e.time&&(e.formatTime=Chat.FormatTime(e.time)),e.system=e.system||"error"===e.status,e.system&&(e.content=e.message),e))}dealImgUrl(e){return e.replace(/^\/\//,"https://")}getOnlineUserList(){const e=this.options;return api.getOnlineUserList(e.roomName)}getHistoryMessage(e=20,t){const s=null==t?this.historyCount:t,i=this.options;return api.getHistoryMessage(i,s,e).then(t=>{const i=t.data.data;this.historyCount+=e,this._hasMoreHistory=21===i.length,this.trigger(Event.HISTORY_MESSAGE,this.parseData(i.reverse().slice(this._hasMoreHistory?1:0)),s,s+e)}),this}getQuestionHistoryMessage(){api.getQuestionHistoryMessage(this.options.roomName).then(e=>{const t=e.data.data,s=this.userId;0===t.filter(e=>e.user&&("teacher"===e.user.userType||"assistant"===e.user.userType||"manager"===e.user.userType)&&e.s_userId===s).length&&t.unshift({content:"同学，您好！请问有什么问题吗？",time:(new Date).getTime(),s_userId:s,user:{actor:"讲师",clientIp:"",nick:"讲师",pic:"//livestatic.polyv.net/assets/images/teacher.png",userType:"teacher"}}),this.trigger(Event.UPDATE_QUESTION_HISTROY,this.parseData(t.filter(e=>e.user&&("student"===e.user.userType&&e.user.userId===s||"student"!==e.user.userType&&e.s_userId===s))))})}getCurrentSignRecord(e){return api.getCurrentSignRecord(e)}getHistorySignRecord(e){return api.getHistorySignRecord(e)}getBannedList(){return api.getBannedList(this.options.roomId)}removeHistoryMessage(e){const t=this.options;api.removeHistoryUrl(e,t)}cleanHistoryMessage(){const e=this.options,t={EVENT:"REMOVE_HISTORY",roomId:e.roomId,sign:e.sign,subsidiaryRoom:e.roomIds};this.socket.emit("message",JSON.stringify(t))}checkCurrentStatus(){return api.checkCurrentStatus(this.options.roomId)}sendFlower(e){const t=this.options,s={EVENT:"LIKES",roomId:t.roomId,nick:t.userName,count:e};this.socket.emit("message",JSON.stringify(s))}}Chat.events=Event;export default Chat;