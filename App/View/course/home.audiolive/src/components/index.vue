<template>
<div>
  
  <div class="header">
    <img :src="logo" class="header-logo" />
    <div class="header-left">
        <div class="btn" @click="setLiveState" v-if="live.livetype == 1">结束直播</div>
        <div class="btn btn-start" @click="setLiveState" v-else>开始直播</div>
        <div class="text">{{num}}人进入</div>
        <div class="staus" v-if="live.livetype == 1">直播中</div>
        <div class="staus unstaus" v-else>未开始</div>
    </div>
    <div class="icon-menu">
      <span @click="phonePreview"><i class="iconfont icon-shouji"></i></span>
      <span @click.stop="settingFlag = settingFlag ? false : true"><i class="iconfont icon-Shape"></i></span>
      
    </div>
    <div class="setup-menu" v-show="settingFlag" @click.stop>
      <ul>
        <li>
          <span class="switch" @click="setSwitch('upperwall')" :class="setting.upperwall == '1' && 'switch-on'"></span>
          用户上墙讨论
        </li>
        <li>
          <span class="switch" @click="setSwitch('audio')" :class="setting.audio == '1' && 'switch-on'"></span>
          用户语音讨论
        </li>
        <li>
          <span class="switch" @click="setSwitch('chat')" :class="setting.chat == '1' && 'switch-on'"></span>
          禁言模式
        </li>
      </ul>
    </div>
    <div class="title">{{title}}</div>
  </div>
  <div class="loging" v-show="loading"><img src="../assets/img/loading.gif" />加载中...</div>
  <div class="content" :style="{height:contHeight+'px'}">
    <div class="tool">
      <div class="tool-wrap">
        <span @click="selectServerFile(1,'chat')" :class="live.livetype != 1 && 'dis'"><i class="iconfont icon-tupian"></i></span>
        <span @click="selectServerFile(2,'chat')" :class="live.livetype != 1 && 'dis'"><i class="iconfont icon-audio"></i></span>
       
        <!-- <span @click="selectFile"><i class="iconfont icon-wenjian"></i></span> -->
      </div>
    </div>
    <div class="main" :style="{height:contHeight-100+'px'}">
     
      <div class="main-chat" id="mainchat">
        
        <div class="item clearfix">
          <div class="avatar"><img :src="assistant.avatar" /></div>
          <div class="name">{{assistant.name}}</div>
          <div class="interact">
              欢迎进入直播间<br />
              1、本次直播为语音图文直播，请确保手机为非静音状态。<br />
              2、直播界面显示讲师发布的内容，听众发言可以在讨论区进行查看，给老师的提问可以再问题区查看。<br />
              3、直播结束后，您可以随时回看全部内容。
          </div> 
        </div>

        <div :id="'interactid'+item.interactid" v-for="(item,index) in list" :key="index">
          <template v-if="item.reward">
              <div class="reward-box"><div class="reward-item">{{item.name}}打赏了一个<span>{{item.rewardNumber}}</span>红包</div></div>
          </template>
          <template v-else>
          <div class="time" v-text="getTime(item.adddate,nowtime)"></div>
          <div class="item clearfix">
            <div class="avatar"><img :src="item.isuser == 0 ? teacherInfo.avatar : item.avatar" /></div>
            <div class="name">{{item.isuser == 0 ? teacherInfo.name : item.membername}}<span @click="recall(item.interactid)" v-show="(nowtime-item.adddate) < 120">撤回</span></div>
            <div class="interact" v-if="item.type==0">{{item.interact}}</div>
            <div class="interact" v-else-if="item.type==1"><img class="preview-img" :src="previmglist[item.imgindex].src" @click="$preview.open(item.imgindex, previmglist)" @load="onRead(item.imgindex)" /></div>
            <div class="audio-play" :class="item.playing && 'playing'" @click="playAudio(item)"  v-else-if="item.type==2 || item.type==3">
              <i v-if="item.isnotplay"></i>
              <span>{{item.audiotime}}"</span>
            </div>
          </div>
          </template>
        </div>
      </div>

       <div class="audio-box" v-show="recorderState.flag" @click.stop>
         <div class="audio-loading" v-show="audioLoading"><span>音频上传中...</span></div>
         <p v-if="recorderState.state === 'start'">每条语音不超过{{recorderState.max}}s</p>
         <p v-else-if="recorderState.state === 'recording'">{{recorderState.time}}s/{{recorderState.max}}s</p>
         <p v-else><span v-text="audio.currentTime ? Math.floor(audio.currentTime) : 0"></span>s/<span v-text="audio.duration ? Math.floor(audio.duration) : 0"></span>s</p>
         <span class="btn" @click="recording"><i class="iconfont icon-tubiaozhizuomoban" v-if="recorderState.state === 'start'"></i><i class="suspend" v-else-if="recorderState.state === 'recording'"></i><i class="iconfont icon-bofang" v-if="recorderState.state === 'end'"></i><i class="iconfont icon-zanting" v-else-if="recorderState.state === 'play'"></i></span>
          <p v-if="recorderState.state === 'start'">点击图标开始录音</p>
          <p v-else-if="recorderState.state === 'recording'">点击图标结束录音</p>
          <p v-else>点击图标播放录音</p>
          <div v-if="recorderState.state === 'end' || recorderState.state === 'play'">
            <div @click="recorderCancel" class="cancel">取消</div>
            <div @click="recorderSend" class="send">发送</div>
          </div>

       </div>
    </div>
    
     <div class="main-textarea">
      <div v-if="live.livetype == 1">
          <div class="audio" @click.stop="askRecorder = false;recorderState.flag = recorderState.flag ? false : true"><i class="iconfont icon-tubiaozhizuomoban"></i></div>
          <div class="send" @click="send">发送</div>
          <textarea id="chatTextArea" @keydown="chatKeydown($event)" placeholder="请在此输入聊天内容..."></textarea>
      </div>
      <div class="gray-state" v-else>您未开启直播</div>
    </div>
    <div class="right">
      <div class="teacher">
        <div class="name">{{teacherInfo.name}}</div>
        <img :src="teacherInfo.avatar" />
      </div>
     
      <div class="title-tab">
        <ul>
          <li :class="tab===2 && 'on'" @click="tab = 2">学员</li>
          <li :class="tab===0 && 'on'" @click="tab = 0">讨论</li>
          <li :class="tab===1 && 'on'" @click="tab = 1">问答</li>
        </ul>
      </div>
      <div class="student-list" v-show="tab===2" :style="{height:contHeight-315+'px'}">
        <ul>
          <!--usertype 0 为学生-->
          <li v-for="(item,i) in userlist" :key="i" v-show="item.usertype == 0">
            <div class="avatar"><img :src="item.avatar" /></div>
            <span @click="banned(true,item.userid)" v-if="item.excuse == 0">禁言</span><span @click="banned(false,item.userid)" class="banned" v-else>已禁言</span>
            {{item.username}}
          </li>
        </ul>
      </div>
      <div class="talk" v-show="tab===0">
        <ul :style="{height:contHeight-405+'px'}" id="talkScroll">
          <li class="clearfix" v-for="(item,i) in talk" :key="i" :class="item.isuser == 0 && 'me'">
            <div class="name">{{item.membername}}<span v-if="item.isuser == 0">(我)</span><span v-else>(学生)</span></div>
            <div class="info" v-if="item.type == 0">{{item.interact}}</div>
          </li>
        </ul>
        <div class="sendbox" style="margin-top:10px;">
          <textarea id="talkTextArea"></textarea>
          <div class="btn" @click="sendTalk">发送</div>
        </div>
      </div>
      <div class="ask" v-show="tab === 1">
        <ul :style="{height:contHeight-445+'px'}" id="askScroll">
          <li class="item" v-for="(item,i) in askList" :key="i" :class="replyinteractid == item.interactid && 'on'">
            <div class="name"><span v-text="getTime(item.adddate,nowtime,false)"></span><img :src="item.avatar" />{{item.membername}}</div>
            <div class="info">
              <div v-if="item.type == 0">{{item.interact}}</div>
              
              <div v-else-if="item.type == 1"><img class="preview-img" :src="previmglist[item.imgindex].src" @click="$preview.open(item.imgindex, previmglist)" @load="onRead(item.imgindex)"></div>
              
              <div class="audio-play" :class="item.playing && 'playing'" @click="playAudio(item)"  v-else-if="item.type == 2 || item.type == 3">
                <i v-if="item.isnotplay"></i>
                <span>{{item.audiotime}}"</span>
              </div>
              <span class="reply" @click="reply(item)" v-text="replyinteractid == item.interactid ? '取消' : '回复'"></span>
            </div>
            <ul v-if="item.replyinfo.length" class="ul-reply">
              <li v-for="(reply,n) in item.replyinfo" :key="'reply'+n">
                <div class="info" v-if="reply.type == 0">
                  {{reply.reply}}
                </div>
                <div class="info" v-else-if="reply.type == 1">
                  <img class="preview-img" :src="previmglist[reply.imgindex].src" @click="$preview.open(reply.imgindex, previmglist)" @load="onRead(reply.imgindex)">
                </div>
                <div class="info" v-else-if="reply.type==2 || reply.type==3">
                  <div class="audio-play" :class="reply.playing && 'playing'" @click="playAudio(reply)">
                    <i v-if="reply.isnotplay"></i>
                    <span>{{reply.audiotime}}"</span>
                  </div>
                </div>
                <!--getTime [回复时间，当前时间，是否带秒] -->
                <div class="name">{{reply.membername}}<span v-text="getTime(reply.adddate,nowtime,false)"></span></div>
              </li>
            </ul>
          </li>
        </ul>
        
        <div class="sendbox2" style="margin-top:10px;">
          <div class="audio-loading" v-show="askRecorder && audioLoading"><span>音频上传中...</span></div>
          <div class="recorder-state" v-show="askRecorder">
            <div class="start" v-if="recorderState.state === 'start' ">
              <span class="bt_r" @click="askRecorder = false">关闭</span>
              <div class="record-time" @click="askRecorderStart"><i class="iconfont icon-dianji"></i>点击开始录音</div>
            </div>
            <div class="recording" v-else-if="recorderState.state === 'recording' ">
              <span class="bt_r" @click="recording">结束</span>
              <div class="record-time">{{recorderState.time}}s / {{recorderState.max}}s</div>
            </div>
            <div class="end" v-else-if="recorderState.state === 'end' || recorderState.state === 'play' ">
                <span class="bt_r" @click="recorderCancel">取消</span>
                <div class="record-time" @click="recording">
                  <i class="iconfont icon-bofang" v-if="recorderState.state === 'end'"></i>
                  <i class="iconfont icon-zanting" v-else-if="recorderState.state === 'play'"></i>
                  <span v-text="audio.currentTime ? Math.floor(audio.currentTime) : 0"></span>s/<span v-text="audio.duration ? Math.floor(audio.duration) : 0"></span>s
                </div>
            </div>
          </div>
          <textarea id="askTextArea"></textarea>
          <div class="send-menu">
            <span @click="askRecorder = askRecorder ? false : true" :class="askRecorder && 'on'"><i class="iconfont icon-tubiaozhizuomoban"></i></span>
            <span @click="selectServerFile(1,'question')"><i class="iconfont icon-tupian1"></i></span>
            <span class="reply-man">{{replyMan}}</span>
            <div class="btn" @click="sendAsk" :class="askRecorder && (recorderState.state === 'start' || recorderState.state === 'recording') && 'dis'">发送</div>
          </div>
        </div>


      </div>

    </div>
  </div>

  <!--popup-->
  <div v-for="(item,i) in popup.open" :key="'item'+i">
    <div class="popup-gray-bg" @click="closePopup(i)"></div>
    <div class="popup-open" :style="{width:item.width+'px',height:item.height+'px',marginTop:-item.height/2+'px',marginLeft:-item.width/2+'px'}">
      <div class="popup-title">{{item.title}}</div>
      <div class="popup-close" @click="closePopup(i)">×</div>
      <div class="popup-iframe" :style="{height:item.height-50+'px'}"><iframe :src="item.src" :name="'popup-iframe'+i"></iframe></div>
    </div>
  </div>

  <div class="popup-tips" :style="{opacity:item.opacity,top:item.top+'px'}" :class="(item.icon === 'success' && 'popup-tips-success') || (item.icon === 'warning' && 'popup-tips-warning') || (item.icon === 'error' && 'popup-tips-error')" v-for="(item,i) in popup.tips" :key="'item'+i">
			<div class="popup-tips-inner">
        <i class="popupfont icon-success" v-if="item.icon === 'success'"></i>
        <i class="popupfont icon-warning" v-else-if="item.icon === 'warning'"></i>
        <i class="popupfont icon-error" v-else-if="item.icon === 'error'"></i>
        <i class="popupfont icon-tuli" v-else></i>
        {{item.text}}
      </div>
	</div>

  <!--微信录制音频提示-->
  <div class="chat-audio-code" v-show="liveCodeFlag" @click="liveCodeFlag = false">
    <div class="inner">
      <img :src="liveCode" />
      <p>该音频通过微信录制，您可扫描二维码，到手机上收听</p>
    </div>
  </div>
  <div id="upcontent"><div id="selectFile"></div></div>

</div>
</template>

<script>
import Recorder from 'recorder-js';
const audioContext =  new (window.AudioContext || window.webkitAudioContext)()
let blob = null;
let recorder = null;
/**
 * 遍历数组
 * @param {Array} 数组
 * @param {Function} 回调函数
 */
const domap = function(data,fn){
  if(data.length){
    for(var i=0;i<data.length;i++){
      typeof fn === 'function' && fn(data[i],i)

    }
  }else{
    return false
  }
}
export default {
  data () {
    return {
      /**窗口对象 */
      popup:{
        open:[],
        confirm:[],
        tips:[]
      },
      /**提示微信录制的语音到微信上听 */
      liveCodeFlag:false,
      /**微信音频直播室二维码 */
      liveCode:config.code,
      /**用户id */
      userid:config.userid,
      /**信息id（语音课程id） */
      infoid:config.infoid,
      cid:config.cid,
      loading:true,
      /**websock对象 */
      websock:null,
      /**阿里oss对象 */
      oss:undefined,
      /**选项卡选中值 */
      tab:2,
      /**当前时间 */
      nowtime:0,
      /**当前在线人数 */
      num:0,
      vs:config.vs,
      assistant:{
        name:'课堂街助手',
        avatar:require('../assets/img/icon.jpg')
      },
      logo:require('../assets/img/logo.png'),
      /**设置窗口开关 */
      settingFlag:false,
      /**音频标题 */
      title:config.title,
      /**当前设置的一些开关，包括用户上墙讨论、用户语音讨论、禁言模式 */
      setting:{},
      /**直播间参数，当前直播的状态等 */
      live:{},
      /**讨论列表 */ 
      talk:[],
      /**主墙聊天记录 */
      list:[],
      /**学员列表 */
      userlist:[],
      /**提问记录 */
      askList:[],
      /**当前要回复的问题id */
      replyinteractid:null,
      /**当前要回复的提问者 */
      replyMan:'',
      /**页面主容器高度 */
      contHeight:window.innerHeight - 60,
      /**老师信息 */
      teacherInfo:{
        avatar:config.avatar,
        name:config.name
      },
      /**显示音频上传状态 */
      audioLoading:false,
      /**用于录音临时音频播放 */
      audio:document.createElement('audio'),
      /**用于聊天列表音频播放 */
      chatAudio:document.createElement('audio'),
      /**录音需要的一些参数 */
      recorderState:{
        flag:false,
        time:0,
        max:60,
        state:'start',
        src:''
      },
      /**显示录音功能区域 */
      askRecorder:false,
      /**可放大预览图片数组 */
      previmglist:[]
    }
  },
  mounted(){
     let that = this;
     window.Alert = function(msg,myicon){
       switch(myicon){
        case 0:myicon = 'default';break;
        case 1:myicon = 'warning';break;
        case 2:myicon = 'success';break;
        case 3:myicon = 'error';break;
        default:myicon = 'error';break;
      }
      var obj = {
        text:msg,
        opacity:0,
        top:0,
        icon:myicon,
        interval:2000
      }
      that.popup.tips.push(obj);
      setAnimatePopupAlert(obj,true)
    }
    
    function setAnimatePopupAlert(item,flag){
      if(flag){
        setTimeout(()=>{
          item.opacity += 0.04;
          item.top += 1.2;
          if(item.opacity < 1){
            setAnimatePopupAlert(item,true)
          }else{
            setTimeout(()=>{
              setAnimatePopupAlert(item,false)
            },item.interval)
          }
        },20)
      }else{
        setTimeout(()=>{
          item.opacity -= 0.04;
          item.top -= 1.2;
          if(item.opacity > 0){
            setAnimatePopupAlert(item,false)
          }else{
            domap(that.popup.tips,(t,i)=>{
              if(t === item){
                that.popup.tips.splice(i,1);
              }
            })
           
          }
        },20)
      }
    }
    window.addEventListener('resize',()=>{
       this.contHeight = window.innerHeight - 60
    })
    this.initWebSocket();
    this.recorderInit();
    document.addEventListener('click',e=>{
      this.recorderState.flag = false;
      this.settingFlag = false
    });
    
    this.oss = ossWebUpload({
      wxid:config.wxid,
      selectId:'selectFile',
      containerId:'upcontent',
      type:4,
      FilesAdded(){
        that.audioLoading = true
      },
      FileUploaded(res){
        var __src = res.defaultpic;
        that.audioLoading = false;
        //发送音频
        if(that.askRecorder){
          //问题区
          if(that.replyinteractid){
            //回复
            that.websocketsend({
              key:'reply',
              src:__src,
              interactid:that.replyinteractid,
              type:2,
              audiotime:Math.floor(that.audio.duration)
            });
          }else{
            //自己提问
            that.websocketsend({
              key:'question',
              src:__src,
              type:2,
              audiotime:Math.floor(that.audio.duration)
            });
          }
          
        }else{
          that.websocketsend({
            key:'send',
            src:__src,
            type:2,
            audiotime:Math.floor(that.audio.duration)
          });
        }
        
        that.recorderCancel();

      }
    });
    window.closePopup = function(id){
      var id = typeof id === 'number' ? id : id.match(/\d+/);
      that.closePopup(id)
    }
    window.popup = {
      data(id){
        var id = typeof id === 'number' ? id : id.match(/\d+/);
        return that.popup.open[id].data
      }
    }
  },
  methods:{
    /**
     * 图片加载完成
     * @param {Number} 图片绑定的索引值
     */
    onRead(i){
      var that = this;
      var img = new Image(); 
      img.src = this.previmglist[i].src;
      img.onload = function () {  
        that.previmglist[i].w = img.width;
        that.previmglist[i].h = img.height
      } 
    },
    /**
     * 聊天文本域的键盘输入
     * @param {Object} event
     */
    chatKeydown(e){
      e.keyCode === 13 && this.send()
    },
    /**
     * 关闭弹窗
     * @param {Number} 窗口绑定的索引值
     */
    closePopup(index){
      typeof this.popup.open[index].close === 'function' && this.popup.open[index].close();   
      this.popup.open.splice(index,1);
    },
    getAudioDuration(audio,fn){ 
      if(audio.error && audio.error.code === 4){
        Alert('您传的文件地址有误')
      }else if(audio.readyState === 4){
        typeof fn === 'function' && fn(audio.duration)
      }else{
        setTimeout(()=>{
          this.getAudioDuration(audio,fn)
        },100)
      }
    },
    selectServerFile(selectType,contType){
      if(contType === 'chat' && this.live.livetype != 1){
        Alert('请先开启直播')
        return false
      }
      let that = this;
      let frameSrc = selectType == 1 ? '/home.html/home/Index/imageslist?type-fn,chektype-1' : '/home.html/home/Index/wxfile?type-fn,chektype-1,type1-3';
      let popupTitle = (selectType === 1 && '选择图片') || (selectType === 2 && '选择音频');

      this.popup.open.push({
        title:popupTitle,
        src:frameSrc,
        width:1000,
        height:620,
        data(par1,par2,par3){
          var __src = selectType == 1 ? par1 : par3;
          if(contType === 'chat'){
            
            if(selectType == 1){
              //选择图片文件
              that.websocketsend({
                key:'send',
                src:__src,
                type:selectType //0 text  1 images  2 audio
              });
            }else if(selectType == 2){
              //选择音频文件
              var audio = new Audio(__src);
              that.getAudioDuration(audio,audiotime=>{
                that.websocketsend({
                  key:'send',
                  src:__src,
                  audiotime:Math.floor(audiotime),
                  type:selectType //0 text  1 images  2 audio
                });
              })
            }
          }else if(contType === 'question'){
            if(that.replyinteractid){
              that.websocketsend({
                key:'reply',
                src:__src,
                interactid:that.replyinteractid,
                type:selectType
              })
            }else{
              that.websocketsend({
                key:'question',
                src:__src,
                type:selectType //0 text  1 images  2 audio
              })
            }
          }

        }
      })
    },
    //初始化websocket
    initWebSocket() { 

      var _link =  `?infoid=${this.infoid}&cid=${this.cid}&userid=${this.userid}`
      var _vs = 'ws:';
      if(location.protocol=='https:'){ 
        _vs = 'wss:'
      } 
      if ("WebSocket" in window) {
        this.websock = new WebSocket(_vs+this.vs+_link);
      } else if ("MozWebSocket" in window) {
        this.websock = new MozWebSocket(_vs+this.vs+_link);
      };
      this.websock.onopen = this.websocketonopen;
      this.websock.onmessage = this.websocketonmessage;
      this.websock.onclose = this.websocketclose;
      this.websock.onerror  = this.websocketonerror;
    },
    //链接成功
    websocketonopen() {
      let dataed=  {};
      dataed.key = "link";
      dataed.userid = config.userid;
      this.websocketsend(dataed)
　　　 console.log("连接成功");
　　},
    setTime(){
      setTimeout(()=>{
        if(this.recorderState.state === 'recording'){
          this.recorderState.time++;
          if(this.recorderState.time < this.recorderState.max){
            this.setTime()
          }else{
            this.recording()
          }
        } 
      },1000)
    },
    //数据接收
    websocketonmessage(e){
      let redata = JSON.parse(e.data);
      let key = redata.key;
      if(key === 'send' || key === 'question' || key === 'reply'){
       
        if(redata.list.type == 1){
            var imgSrc = key === 'reply' ? redata.list.reply : redata.list.interact;
            redata.list.imgindex = this.previmglist.length;
            this.previmglist.push({
              src:imgSrc,
              w:'',
              h:''
            })
        } else if(redata.list.type == 2 || redata.list.type == 3){
          //2 普通音频  3 微信音频
          redata.list.isnotplay = true;
          redata.list.playing = false
        }
      }
      switch(key){
        case 'link':
          this.userlist = redata.userlist;
          var newlist = new Array();
          
          domap(redata.list,item=>{
            if(item.type == 1){
               item.imgindex = this.previmglist.length;
               this.previmglist.push({
                 src:item.interact,
                 w:'',
                 h:''
               })
            }else if(item.type == 2 || item.type == 3){
              item.isnotplay = true
              item.playing = false
            }
            newlist.push(item)
          });

          var askList = new Array();
          domap(redata.tiwenlist,item=>{
            if(item.type == 1){
              item.imgindex = this.previmglist.length;
              this.previmglist.push({
                 src:item.interact,
                 w:'',
                 h:''
               })
            }else if(item.type == 2 || item.type == 3){
              item.isnotplay = true
              item.playing = false
            }

            //遍历回复
            domap(item.replyinfo,t=>{
              if(t.type == 1){
                t.imgindex = this.previmglist.length;
                this.previmglist.push({
                  src:t.reply,
                  w:'',
                  h:''
                })
              }else if(t.type == 2 || t.type == 3){
                t.isnotplay = true
                t.playing = false
              }
            })

            askList.push(item);
          });
          this.list = newlist;
          this.askList = askList;
          this.nowtime = redata.nowtime;
          this.setting = redata.setting;
          this.live = redata.live;
          this.loading = false;
          var that = this;
          function countdown(){
            setTimeout(()=>{
              that.nowtime++;
              countdown()
            },1000)
          }
          countdown()
          this.$nextTick(()=>{
            mainchat.scrollTop = mainchat.scrollHeight
            
          })

          break
        case 'num':
          this.num = redata.num;
          if(!redata.newuser){
            return false
          };
          var uid = redata.newuser.userid;
          var isHasUid = false;
          domap(this.userlist,item =>{
            if(item.userid == uid){
              isHasUid = true
            }
          });
          !isHasUid && this.userlist.push(redata.newuser)
          
          break;
        case 'recall':
          window[`interactid${redata.interactid}`].innerHTML = `<div align="center" style="padding:15px 0;"><div style="background:rgba(0,0,0,0.2); color:#fff; text-align:center;border-radius:30px; display:inline-block; line-height:22px; padding:0 10px;">${redata.username}撤回了一条消息</div></div>`
          break
        case 'errcode':
          Alert(redata.msg);
          break
        case 'send':
          
          this.list.push(redata.list);
          this.nowtime = redata.nowtime;
          
          this.$nextTick(()=>{
            mainchat.scrollTop = mainchat.scrollHeight
          })

          break;
        case 'talk':
          this.talk.push(redata.list);
          this.$nextTick(()=>{
            talkScroll.scrollTop = talkScroll.scrollHeight
          })
          break;
        case 'addexcuse':
        case 'delexcuse':
          //禁言
          var userid = redata.userid; 
          var that = this;
          domap(this.userlist,(item,i) =>{
            if(item.userid == userid){
              this.userlist[i].excuse = key === 'addexcuse' ? 1 : 0
            }
          })
          break;
        case 'startlive':
        case 'endlive':
          //设置直播状态
          this.live.livetype = key === 'startlive' ? 1 : 0
          break;
        case 'userout':
          this.num--;
          var newuserlist = new Array();
          var uid = redata.userid;
          domap(this.userlist,item=>{
            if(uid != item.userid){
              newuserlist.push(item)
            }
          });
          this.userlist = newuserlist;
          break
        case 'question':
          this.askList.push(redata.list);
          if(!this.replyinteractid){
            this.$nextTick(()=>{
              askScroll.scrollTop = askScroll.scrollHeight
            })
          }
          break
        case 'reply':
          var id = redata.list.interactid;
          domap(this.askList,(item,v)=>{
            if(item.interactid == id){
              item.replyinfo.push(redata.list)
            }
          })
          break
        case 'reward':
          this.list.push(redata.list);
          break
      }
      
    },
    playAudio(item){
      if(item.playing){
        item.playing = false;
        this.chatAudio.pause();
        return false
      }
      domap(this.list,(t,i)=>{
        if(t.type == 2){
          t.playing = false
        }
      });
      domap(this.askList,(t,i)=>{
        if(t.type == 2){
          t.playing = false
        }
      });
      if(item.type == 3){
        this.liveCodeFlag = true;
        return false
      }
      this.chatAudio.src = item.interact;
      this.chatAudio.load();
      this.chatAudio.play();
      item.playing = true;
      item.isnotplay = false;
      this.chatAudio.addEventListener('ended',e=>{
        item.playing = false
      })
    },
    //数据发送
    websocketsend(agentData){   
      agentData.infoid = this.infoid;
      agentData.cid = this.cid;
      agentData.moduletype = 0;
      this.websock.send(JSON.stringify(agentData))
    },
    //连接失败
    websocketonerror(e){
        console.log("WebSocket连接失败");
    },
    //数据关闭
    websocketclose(e){
        this.websocketsend({
          key:'userout'
        })
        console.log("connection closed (" + e.code + ")");
    },
    recall(id){
      this.websocketsend({
        key:'recall',
        id:id
      })
    },
    //发送上墙消息
    send(){
      if(chatTextArea.value.replace(/\s+/g,'') === ''){
        chatTextArea.focus()
        return false
      }else{
        this.websocketsend({
          key:'send',
          text:chatTextArea.value,
          type:0 //0 text  1 images  2 audio
        });
        chatTextArea.value = ''
      }
    },
    sendTalk(){
      if(!talkTextArea.value){
        talkTextArea.focus()
        return false
      }else{
        this.websocketsend({
          key:'talk',
          text:talkTextArea.value,
          type:0
        });
        talkTextArea.value = ''
      }
    },
    sendAsk(){
      //发送文字或音频
      if(!this.askRecorder && !askTextArea.value){
        //不处于录音状态，但文本域为空
        askTextArea.focus()
        return false
      }else if(this.askRecorder && (this.recorderState.state === 'start' || this.recorderState.state === 'recording')){
        //处于录音状态，但未录制完成
        return false
      }else{

        if(this.askRecorder){
            this.recorderSend()
        }else{
          if(this.replyinteractid){
            this.websocketsend({
              key:'reply',
              text:askTextArea.value,
              interactid:this.replyinteractid,
              type:0
            });
          }else{
            this.websocketsend({
              key:'question',
              text:askTextArea.value,
              type:0
            });
          }
          askTextArea.value = ''
        }
        
      }
    },
    phonePreview(){
      this.popup.open.push({
        width:700,
        height:400,
        src:config.phoneUrl
        
      })
    },
    setLiveState(){
      var __key = this.live.livetype == 1 ? 'endlive' : 'startlive';
      this.websocketsend({
        key:__key
      })
    },
    banned(flag,uid){
      var __key = flag ? 'addexcuse' : 'delexcuse';
      this.websocketsend({
        key:__key,
        userid:uid
      })
    },
    askRecorderStart(){
      //关闭主屏幕的录音控件
      this.recorderState.flag = false;
      this.recorderCancel();
      this.recording()
    },
    recording(){
      switch(this.recorderState.state){
        case 'start':
          //start recording
          this.startRecording();
          this.recorderState.state = 'recording';
          this.setTime()
          break
        case 'recording':
          this.stopRecording();
          this.recorderState.state = 'end';
          break
        case 'end':
         
          this.audio.play();
          this.recorderState.state = 'play';          
          this.audio.addEventListener('ended',e=>{
            this.recorderState.state = 'end';
            
          })
          break
        case 'play':
          this.audio.pause();
          this.recorderState.state = 'end';
          break
      }
      
    },
    setSwitch(name){
      this.setting[name] = this.setting[name] == '0' ? '1' : '0';
      var keys = Object.keys(this.setting);
      var __str;
      domap(keys,(v,i)=>{
        i === 0 ? __str = this.setting[v] : __str += ',' + this.setting[v]
      });
      this.websocketsend({
        key:'editsetting',
        str:__str
      })
    },
    reply(item){
      
      if(this.replyinteractid == item.interactid){
        this.replyinteractid = null;
        this.replyMan = ''
      }else{

        this.replyinteractid = item.interactid;
        this.replyMan = '回复：'+item.membername;
        askTextArea.focus()
      }
    },
    getTime(unixtimestamp,nowtime,issecond){
     
      var now = getDate(nowtime);
      var curtime = getDate(unixtimestamp);
      var __second = issecond === false ? '' : ':' + curtime.second
      var time;
      if(curtime.year === now.year && curtime.month === now.month && curtime.date === now.date){
        time = curtime.hour + ':' + curtime.minute + __second
      }else if(curtime.year === now.year){
        time = curtime.month + '/' + curtime.date + ' ' + curtime.hour + ':' + curtime.minute + __second
      }else{
        time = curtime.year + '/' + curtime.month + '/' + curtime.date + ' ' + curtime.hour + ':' + curtime.minute + __second
      }
      return time;
      function getDate(unixtimestamp){
        var unixtimestamp = new Date(unixtimestamp*1000);
        var year = 1900 + unixtimestamp.getYear();
        var month =  "0" + (unixtimestamp.getMonth() + 1);
        var date =   "0" + unixtimestamp.getDate();
        var hour =   "0" + unixtimestamp.getHours();
        var minute = "0" + unixtimestamp.getMinutes();
        var second = "0" + unixtimestamp.getSeconds();
        return {
          year:year,
          month:month.substring(month.length-2, month.length),
          date:date.substring(date.length-2, date.length),
          hour:hour.substring(hour.length-2, hour.length),
          minute:minute.substring(minute.length-2, minute.length),
          second:second.substring(second.length-2, second.length)
        }
      }
    },
    recorderInit(){
      navigator.mediaDevices.getUserMedia({audio: true})
      .then(stream => recorder.init(stream))
      .catch(err => console.log('Uh oh... unable to get stream...', err));
      
      recorder = new Recorder(audioContext, {
        // An array of 255 Numbers
        // You can use this to visualize the audio stream
        // If you use react, check out react-wave-stream
        onAnalysed: data =>{
         // console.log(data)
        } 
      })      
    },
    recorderCancel(){
      recorder.stop();
      this.recorderState.state = 'start';
      this.recorderState.time = 0;
    },
    recorderSend(){
      if(!this.audio.duration || !blob){
        return false
      }
      var uploader = this.oss;
      uploader.addFile(blob,'record'+new Date().getTime()+'.wav');      
    },
    startRecording() {
      recorder.start()
    },
    stopRecording() {
     recorder.stop()
      .then(res => {

        blob = res.blob;

        //Recorder.download(blob, 'my-audio-file');
        // buffer is an AudioBuffer
        
        var url = URL.createObjectURL(blob);
        this.audio.src = url;
        this.audio.load();

      })
    }

  }
}


</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>


.chat-audio-code{ position: fixed;width: 100%;height: 100%; z-index: 9; background:rgba(0,0,0,0.4);top:0; left:0; text-align: center; color: #fff; line-height: 100%}
.chat-audio-code .inner{ position: absolute;width: 100%;left:0;top:50%;margin-top:-110px}
.chat-audio-code img{width: 200px;height: 200px; display: block; margin: 0 auto}
.chat-audio-code p{ line-height: 46px;}

.switch{width:46px;height:28px; background:#d5dade;border-radius:50px; position:relative; cursor:pointer; -webkit-transition:0.3s; transition:0.3s; float:left;}
.switch:before{content:'';width:24px;height:24px; background:#fff;border-radius:50%; box-shadow: 0 0 6px rgba(0,0,0,0.2); position:absolute;top:2px;right:20px; -webkit-transition:0.3s; transition:0.3s;}
.switch-on{ background:#44d58e;}
.switch-on:before{right:2px;}

.audio-loading{width: 100%;height: 100%; position: absolute; background: rgba(0,0,0,0.4); color: #fff; left:0;top:0;z-index: 99; text-align: center;font-size: 14px; }
.audio-loading span{ position: absolute;left:0;width:100%;height: 44px; line-height: 44px; top:50%;margin-top:-22px;}

.loging{width: 130px;height: 130px; background: #fff; position: absolute; left:50%;top:50%;margin-left:-65px;margin-top:-65px; z-index: 9;border-radius: 10px; text-align: center; color: #999; font-size:13px; box-shadow: 0 2px 10px rgba(0,0,0,0.1)}
.loging img{ display: block; margin: 0 auto;padding:20px 0 15px 0;}

.reward-box{ text-align: center; padding: 5px 0;}
.reward-item{
    background: #ffe8bb;
    text-align: center;
    display: inline-block;
    color: #e98c21;
    font-size: 12px;
    border-radius: 10px;
    position: relative;
    padding: 6px 14px;
    line-height: 12px;
}
.reward-item sapn{
    color: #e64a3b
}


.main-chat{ overflow-y: auto; position: absolute;width: 100%;height: 100%;left:0;top:0; box-sizing: border-box; padding:15px 30px;}
.main-chat .item{padding:15px 15px 30px 51px; position: relative; min-height: 36px; font-size: 13px;}
.main-chat .avatar{width: 36px;height: 36px;border-radius: 50%; overflow: hidden; position: absolute;left:0px;top:15px;}
.main-chat .avatar img{width: 100%;height: 100%;}
.main-chat .name span{margin-left:10px;color:#37a7ed;font-size: 12px; cursor: pointer;}
.main-chat .interact{float: left; background: #fff; padding:9px 10px;border-radius: 5px;margin-top:5px; }
.main-chat .interact img{max-width: 260px; display: block;}
.main-chat .time{ text-align: center; display: block; color:#999; height: 34px; line-height: 34px;}

.audio-play{width:180px;height: 36px;background-color:#fff; background-image: url(../assets/img/audiolive_icon_audiodoc.png); background-repeat: no-repeat; background-position: 10px 50%; position: relative; cursor: pointer; border-radius: 5px; line-height: 36px; background-size:24px 24px;}
.audio-play.playing{background-image:url(../assets/img/audiolive_icon_audiodoc.gif);}
.audio-play span{float:right; padding-right: 10px; color:#3a3d89}
.audio-play i{width: 7px;height: 7px; position: absolute;right:-2px;top:-2px; background: #e6412d;border-radius: 50%}

.audio-box{width:340px;height: 140px; position: absolute;bottom:10px;right: 10px; background: #fff; text-align: center; line-height:30px; padding:30px 15px; color:#666; font-size: 13px; box-shadow: 0 3px 15px rgba(0,0,0,0.1)}
.audio-box .btn{width: 60px;height: 60px; display: block; background: #1297dc;border-radius: 50%; margin:5px auto;border:4px solid #abd7ed; line-height: 60px; cursor: pointer; position: relative;}
.audio-box .btn i{font-size: 30px;width: 40px;height: 40px; line-height: 40px; text-align: center; color:#fff; text-align: center; -webkit-transition: .3s; transition: .3s; position: absolute;left:50%;top:50%; margin-left:-20px;margin-top:-20px;}

.audio-box .btn .suspend{background: #fff;border-radius: 4px;width: 20px;height: 20px;margin-left: -10px;margin-top:-10px;}
.audio-box .cancel,
.audio-box .send{width: 68px;height: 34px; position: absolute;top:50%;margin-top:-18px; text-align: center; box-sizing: border-box; line-height: 34px; border-radius: 4px; cursor: pointer;}
.audio-box .cancel{border:1px solid #e6e6e6;left:40px;}
.audio-box .send{right:40px; background:#e6412d; color:#fff;}
.audio-box .btn:hover i{ transform:scale(1.2);
-ms-transform:scale(1.2); 	/* IE 9 */
-moz-transform:scale(1.2); 	/* Firefox */
-webkit-transform:scale(1.2); /* Safari 和 Chrome */
-o-transform:scale(1.2); 	/* Opera */}
.main-textarea{height: 100px; overflow: hidden; position: relative; background: #fff}
.main-textarea .gray-state{ text-align: center; line-height: 100px; font-size: 16px; color:#aaa;z-index: 9;}
.main-textarea .audio{width: 36px; text-align: center; position: absolute;right:140px;top:50%; height: 36px; line-height: 36px;margin-top:-18px; cursor: pointer; color: #999;border:1px solid #eee; border-radius: 4px;}
.main-textarea .audio i{ font-size: 22px;}
.main-textarea textarea{width:100%;height:100px;border:0px; box-sizing: border-box; padding: 20px 150px 20px 20px;}
.main-textarea .send{width:82px;height:36px; background: #e6412d; color: #fff; position: absolute;right:20px;top:50%;margin-top:-18px; text-align: center;font-size: 14px; line-height: 36px; cursor: pointer; border-radius: 4px;} 
.main-textarea .send:hover{background: #de341f} 
.content{ background: #edf2f5;position: relative; }
.main,.main-textarea{margin:0 280px 0 70px; position: relative;}
.header{height:60px; background: #14191d; color:#fff;}
.header-logo{ position: absolute;left:20px;top:14px;height: 32px;}
.header .btn{width: 130px;height:40px; background: #e6412d;color:#fff; text-align: center;border-radius: 4px; line-height: 40px; position: absolute;left:0;top:0;font-size: 14px; cursor: pointer;}
.header .btn-start{background: #37a7ed}
.header-left{ position: absolute;left:260px;top:10px; width:200px; padding-left: 150px;}
.header-left .text{font-size: 14px;color:#fff; line-height: 18px;}
.header-left .staus{font-size:14px; color:#e6412d; position: relative; padding-left: 12px;}
.header-left .staus::before{content: '';width: 6px;height: 6px; background: #e6412d;border-radius: 50%; position: absolute;left:0;top:50%;margin-top:-3px;}
.header-left .unstaus{color:#37a7ed}
.header-left .unstaus::before{background: #37a7ed}
.header .title{line-height: 60px;text-align: center;font-size: 14px;}

.header .icon-menu{ position: absolute;right:20px;top:0; line-height: 60px;}
.header .icon-menu span{width: 60px;height: 60px; cursor: pointer;float:left; text-align: center}
.header .icon-menu i{font-size: 22px;}

.setup-menu{width:310px; position: absolute;right:10px;top:60px; z-index: 9; background: #fff; border-radius: 4px; box-shadow: 0 3px 15px rgba(0,0,0,0.1);font-size: 13px;}
.setup-menu li{height: 44px; line-height: 44px; overflow: hidden; color:#2a343e; padding: 0 15px;border-top:1px solid #eee;}
.setup-menu li:first-child{border-top:0px;}
.setup-menu li .switch{float:right;margin-top: 10px;}

.tool{width:70px;height: 100%; position: absolute;left:0;top:0; background: #1a1a1a}
.tool .tool-wrap{top: 50%; position: absolute;width: 100%;left:0;top:50%;margin-top:-105px;}
.tool .tool-wrap .dis{ cursor:no-drop}
.tool span{width: 70px;height: 70px; display: block; text-align: center; line-height: 70px; cursor: pointer;color:#fff;}
.tool span:hover{ background: #1f242a;color: #e6412d}
.tool span i{font-size:24px;}
.content .right{width: 280px;height: 100%; position: absolute;right:0;top:0; background: #1f242a; box-sizing: border-box;padding: 10px; font-size: 13px;}
.content .right .teacher{height: 260px; overflow: hidden; position: relative;}
.content .right .teacher img{height: 100%;width:100%;}
.content .right .teacher .name{ position: absolute;width: 100%; box-sizing: border-box;height: 24px; line-height: 24px; background: rgba(0,0,0,0.6);bottom: 0;left:0;color:#fff; padding: 0 15px;}

.title-tab{height: 36px; line-height: 36px; background: #2a343e}
.title-tab li{width: 33.3%;float:left; text-align: center;color:#fff;font-size: 14px; cursor: pointer;}
.title-tab .on{color: #e6412d}

.talk ul,
.student-list{background: #151a20; overflow-y: auto} 
.talk li{padding: 15px; }
.talk li .name{height: 24px; line-height: 24px; overflow: hidden; color: #30a2e9}
.talk li .info{float:left; padding: 5px 10px; background: #30a2e9;color:#fff;border-radius: 4px;}
.talk li.me .name{ text-align: right}
.talk li.me .info{float: right}
.talk li.me .info img{max-width: 100%; display: block;}

.sendbox{ background: #151a20; position: relative;}
.sendbox textarea{width: 100%;height: 70px; box-sizing:border-box; background: none;border:0px; padding: 10px 90px 10px 10px;color:#bfc0c4;}

.sendbox .btn{width: 80px; border-left: 1px solid #4c5155;height:50px; position: absolute;right:0;top:15px;font-size: 16px; text-align: center; line-height: 50px; color:#bfc0c4; cursor: pointer;}


.sendbox2{ background: #151a20; position: relative;}
.sendbox2 textarea{width: 100%;height: 70px; box-sizing:border-box; background: none;border:0px; padding: 10px 90px 10px 10px;color:#bfc0c4;}
.sendbox2 .send-menu{border-top:1px solid #1f242a;height: 40px; line-height: 40px; color: #898fa2}
.sendbox2 .send-menu span{float: left;margin-left:15px; cursor: pointer;}
.sendbox2 .send-menu span i{font-size: 20px;}
.sendbox2 .send-menu span:hover,
.sendbox2 .send-menu .on{color:#fff;}
.sendbox2 .send-menu .btn{float: right;border-left:1px solid #1f242a;width: 60px; text-align: center;color:#30a2e9; cursor: pointer;}
.sendbox2 .send-menu .btn:hover{background: #2a343e}
.sendbox2 .send-menu .btn.dis{color:#898fa2; cursor:no-drop}
.sendbox2 .send-menu .reply-man{ width:100px; overflow:hidden; height:40px; white-space: nowrap; text-overflow: ellipsis;}
.recorder-state{height: 40px; background:#151a20; position: absolute;left:0;top:0;width: 100%; z-index: 9; line-height: 40px; color: #fff;text-align: center; padding: 15px 0}
.recorder-state .start{ color:#fff; cursor: pointer;}
.recorder-state .start i{font-size: 14px;margin-right: 10px}
.recorder-state .record-time{width: 141px;  position: absolute;top:50%;height: 26px; line-height: 26px; margin-top:-13px;left:15px; text-align: left; cursor: pointer;}
.recorder-state .recording .record-time{ text-align:center;font-size: 14px;background: url(../assets/img/state.png) no-repeat;}
.recorder-state .bt_r{float: right;width: 60px; cursor: pointer;border-left:1px solid #1f242a;}


.ask{font-size: 12px}
.ask .audio-play{width: 140px; height: 32px; line-height: 32px; }
.ask ul{background: #151a20; overflow-y: auto}
.ask ul ul{background: none}
.ask li.item{ padding: 15px; border-top:5px solid #1f242a;}
.ask li.on{ background: #2a343e}
.ask li{position: relative; }
.ask li .name{color: #fff; line-height: 20px;}
.ask li .name span{float:right}
.ask li .name img{width: 20px; height: 20px; border-radius: 50%; float:left; margin-right: 10px;}
.ask li .info{color:#fff; line-height: 22px; margin-top:15px; position: relative; padding-right: 40px}
.ask li .reply{ position: absolute;right:0;bottom:0; line-height: 22px; color: #30a2e9; cursor: pointer; }
.ask li li{border-top: 1px solid #1f242a;margin-top:15px;}
.ask li li .info,
.ask li li .name{ color:#b0b7c0}
.ask li li .name{margin-top: 10px;}
.ask li li .name span{float: inherit; margin-left:15px;}
.ask li img{max-width: 100%; display: block; border-radius: 3px}

.student-list ul{padding: 10px 0;}
.student-list li{padding: 10px 15px 10px 55px; position: relative; line-height: 32px;color: #fff}
.student-list li .avatar{width: 32px;height: 32px; border-radius: 50%; overflow: hidden; position: absolute;left:15px;top:10px;}
.student-list li .avatar img{width: 100%;height: 100%; }
.student-list li span{float: right;color:#30a2e9; cursor: pointer;}
.student-list li .banned{color: #e6412d}

</style>
