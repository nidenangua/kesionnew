<template>
<div :class="isFullScreen && 'fullScreen'">
  
  <div class="mask" @click="maskClick" v-show="files.flag || media.flag"></div>
  <div class="class-loading" v-show="pageLoading.flag">
    <div class="text">
      <p>{{pageLoading.text}}</p>
    </div>
  </div>
  <div class="header">
    <img :src="logo" class="header-logo" />
    <div class="header-left" v-if="isTeacher">
      <div class="btn" @click="setClassStatus" v-if="classStatus == 1">结束下课</div>
      <div class="btn btn-start" @click="setClassStatus" v-else>开始上课</div>
      <div class="time" v-if="classStatus == 1">{{timeStr}}<br /><span>已消费{{alreadyConsumed}}连麦币，剩余{{balance}}连麦币</span></div>
    </div>
    <div class="staus" :class="classStatus !== 0 && 'on'" v-else>
      <span class="un" v-if="classStatus === 0">未开始</span>
      <span v-else>正在上课</span>
    </div>
    <div class="title">{{title}}</div>
    <div class="icon-menu">
      <span @click="popup.flag = true"><i class="iconfont icon-shouji"></i></span>
    </div>
  </div>

  <!--图文材料-->
  <template v-if="classlevel !== 0">
  <div class="live-data-list" :class="files.className && files.className" v-show="files.flag" :style="{height:pageHeight-60+'px'}">
    <div class="title">图文材料</div>
    <div class="list" v-if="files.flag" :style="{height:pageHeight-180+'px'}">
      <ul>
        <li :class="item.id == whiteboard.selectedCanvasId ? 'on ' + item.fileType : item.fileType" v-for="(item,i) in files.list" :key="'item'+i" @click="addLiveFile(item)">
          <div class="opr" v-if=" i > 0"><i class="iconfont icon-yanjing"></i><i @click.stop="deleteLiveFile(item)" class="iconfont icon-shanchu"></i></div>
          {{item.name}}
        </li>
      </ul>
    </div>
    <div class="foot">
      <div class="foot-inline" id="materialContainer">
        <div class="button" id="materialSelectId">添加材料</div>
        <div class="button" @click="addWhiteboardFile(null)">添加白板</div>
      </div>
    </div>
  </div>
  <!---->
  <!--媒体资料-->
  <div class="live-data-list" :class="media.className && media.className" v-show="media.flag" :style="{height:pageHeight-60+'px'}">
    <div class="title">媒体资料</div>
    <div class="list" v-if="media.flag" :style="{height:pageHeight-180+'px'}">
      <ul>
        <li class="media-file" :class="item.id == media.selected ? 'media-file'+item.id+' on' : 'media-file'+item.id" v-for="(item,i) in media.list" :key="'item'+i" @click="selectMedia(item)">
          <div class="opr" v-if="item.id !== 0"><i class="iconfont icon-shanchu"></i></div>
          {{item.name}}
        </li>
        
      </ul>
    </div>
    <div class="foot">
      <div class="foot-inline" id="mediaContainer">
        <input type="file" id="mediaFile" style="display:none">
        <div class="button" @click="addMeadiFile('mediaFile')">添加媒体</div>
      </div>
    </div>
  </div>
  <!---->
  </template>

  <div class="progress" v-show="progress.flag">
    <div class="progress-bar"><div class="progress-completed" :style="{width:progress.completed+'%'}"></div></div>
    <div v-if="progress.completed < 100">上传中 {{progress.completed}}%</div><div v-else>上传成功</div>
  </div>

  <div class="wrapper" :class="whiteboard.toolFlag && classlevel !== 0 && 'wrapper-pl'">
    <div class="tool-mask" v-if="whiteboard.toolFlag && classlevel !== 0" @click="maskClick" v-show="files.flag || media.flag"></div>
    <div class="tool" v-if="whiteboard.toolFlag && classlevel != 0">
        <div class="icon-wrap">
          <div class="icon-item" :class="whiteboard.tool === 'grab' && 'on'" @click="slideTool('grab')"><i class="iconfont icon-zhuashou"></i></div>
          <div class="icon-item" style=" cursor: no-drop;" :class="whiteboard.tool === 'text' && 'on'" @click="slideTool('text')"><i class="iconfont icon-wenzi1"></i></div>
          <div class="icon-item" :class="whiteboard.tool === 'pen' && 'on'" @click="slideTool('pen')"><i class="iconfont icon-pencil-copy"></i></div>
          <div class="icon-item" :class="whiteboard.tool === 'eraser' && 'on'" @click="slideTool('eraser')"><i class="iconfont icon-xiangpica"></i></div>
          <div class="icon-item" v-if="isTeacher" @click="clearCanvas"><i class="iconfont icon-shanchu"></i></div>
          <div class="icon-item" @mouseenter="whiteboard.selectColorFlag = true" @mouseleave="whiteboard.selectColorFlag = false">
            <i class="color" :style="{backgroundColor:'#'+whiteboard.color}"></i>
            <div class="select-color" v-show="whiteboard.selectColorFlag">
              <div class="name">选择粗细</div>
              <div class="size-list">
                <span v-for="(size,i) in whiteboard.penSize" :key="'item'+i" :class="size === whiteboard.pen && 'on'" @click="whiteboard.pen = size"><i :style="{width:size+'px',height:size+'px',marginTop:-size/2+'px',marginLeft:-size/2+'px'}"></i></span>
              </div>
              <div class="name">选择颜色</div>
              <div class="color-list">
                <span v-for="(color,i) in whiteboard.colorList" :key="'item'+i" @click="whiteboard.color = color" :style="{backgroundColor:'#'+color}"></span>
              </div>
            </div>
          </div>
          <div class="icon-item" v-if="isTeacher" :class="files.flag && 'hover'" style="margin-top:80px;" @click="openFilesBox(files)"><i class="iconfont icon-wenjian1"></i></div>
          <div class="icon-item" v-if="isTeacher" :class="media.flag && 'hover'" @click="openFilesBox(media)"><i class="iconfont icon-shipin1"></i></div>
        </div>
    </div>
    
    <div class="container" :style="{width:container.width+'px'}">
      <div id="J_prismPlayer"></div>
      <!--加载图标-->
      <div class="loading" v-show="loading"></div>
      
      <!--白板部分-->
      <template v-if="classlevel !== 0">
      
      <div class="whiteboard" :style="{height:container.height+'px'}">
        <!-- <textarea @focus="whiteboard.isFocus = true" class="filltext" id="fillCanvasText" v-show="whiteboard.textFlag && whiteboard.tool === 'text'" @mousedown.stop @mouseup.stop="fillTextKeyUp" :style="{color:'#'+whiteboard.color,left:whiteboard.startX+'px',top:whiteboard.startY+'px',fontSize:whiteboard.fontSize+'px',fontFamily:whiteboard.font,lineHeight:whiteboard.lineHeight+'px',width:whiteboard.fontSize+'px',height:whiteboard.lineHeight+'px',transform:'scale('+whiteboard.scale+')'}"></textarea> -->
        <div v-for="(item,i) in whiteboard.canvasList" :key="'item'+i">
          <div v-if="item.fileType === 'blank' || item.fileType === 'img'" class="whiteboard-img" v-show="whiteboard.selectedCanvasId == item.id && item.width && item.height" :style="{top:item.top+'px',left:item.left+'px'}">
            <!-- <div v-show="whiteboard.drawFlag && whiteboard.tool === 'grab'">
                <div class="whiteboard-line-y" :style="{left:-item.left+(container.width-item.width)/2+'px',top:-item.top+'px'}"></div>
                <div class="whiteboard-line-y" :style="{left:-item.left + item.width +(container.width-item.width)/2 +'px',top:-item.top+'px'}"></div>
            </div> -->
            <div class="whiteboard-canvas" :style="{top:item.canvas.y+'px',left:item.canvas.x+'px',transform:'scale('+item.scale+')',cursor:whiteboard.cursor,width:item.canvas.width+'px',height:item.canvas.height+'px'}">
              <canvas @mousedown="canvasMousedown($event)" @mousemove="canvasMousemove($event)" :id="'canvas'+item.id"  :height="item.canvas.height" :width="item.canvas.width"></canvas>    
              <img :src="item.src" :width="item.width" :height="item.height" @load="canvasImgLoad(item)" :style="{position:'relative',left:(item.canvas.width - item.width)/2+'px',top:(item.canvas.height-item.height)/2+'px'}" />
                
            </div>
          </div>

          <div v-else-if="item.fileType === 'word' || item.fileType === 'pdf'" v-show="whiteboard.selectedCanvasId == item.id">
            <!--img存在width与height说明已加载完成-->
            <div class="whiteboard-img" v-show="img.width && img.height && item.current == index+1" v-for="(img,index) in item.list" :key="'img'+index" :style="{top:img.top+'px',left:img.left+'px'}">
              <div class="whiteboard-canvas" :style="{top:img.canvas.y+'px',left:img.canvas.x+'px',transform:'scale('+img.scale+')',cursor:whiteboard.cursor,width:img.canvas.width+'px',height:img.canvas.height+'px'}" v-if="img.flag">
                <canvas @mousedown="canvasMousedown($event)" @mousemove="canvasMousemove($event)" :id="'canvas'+img.id"  :height="img.canvas.height" :width="img.canvas.width"></canvas>
                <img :src="img.src" :width="img.width" :height="img.height" :style="{position:'relative',left:(img.canvas.width - img.width)/2+'px',top:(img.canvas.height-img.height)/2+'px'}" @load="canvasImgLoad(img)" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="canvas-state" :class="classlevel === 2 && 'canvas-state-black'">
        <div v-if="!isTeacher && classStatus === 1" class="button" :class="isPutUpHands && 'button_on'" @click="putUpHands" v-text="isPutUpHands ? '取消举手' : '我要举手'"></div>
        <div class="tool-wrap" :class="isTeacher && 'teacher-tool-wrap'">
          <span class="icon-bt" @click="slideCanvas('prev')"><i class="iconfont icon-left"></i></span>
          <span>{{whiteboard.state.current}}/{{whiteboard.state.max}}</span>
          <span class="icon-bt" @click="slideCanvas('next')"><i class="iconfont icon-right"></i></span>
          <span title="抓手" class="icon-bt" :class="whiteboard.tool === 'grab' && 'on' " @click="slideTool('grab')" v-if="isTeacher"><i class="iconfont icon-zhuashou"></i></span>
          <span title="放大" class="icon-bt" @click="zoom(true)" v-if="isTeacher"><i class="iconfont icon-fangda"></i></span>
          <span title="缩小" class="icon-bt" @click="zoom(false)" v-if="isTeacher"><i class="iconfont icon-suoxiao"></i></span>
          <span title="复位" class="icon-bt" @click="canvasRestoration" v-if="isTeacher"><i class="iconfont icon-fuwei"></i></span>
          <span title="全屏" class="icon-bt icon-full-bt" @click="fullScreen()"><i class="iconfont icon-fullscreen-exit" v-if="isFullScreen"></i><i class="iconfont icon-full_screen" v-else></i></span>
        </div>
      </div>
      </template>
      <div v-show="classlevel === 0" id="id_video_container" :style="{height:container.height+'px'}"></div>

    </div>
    <div class="student-video-list" v-if="classlevel === 1" :style="{height:streamBoxHeight+'px'}">
      <ul>
        <li v-for="(item,i) in streamList" :key="'item'+i" :style="{width:streamBoxHeight+'px'}" v-show="item.userid || (i === 0 && item.userid === null)">
          <div class="avatar" :style="{width:streamBoxHeight-10+'px',height:streamBoxHeight-10+'px'}">
            <img src="../assets/img/seat2.png" />
            <div class="student_agora" :id="'stream'+item.userid"></div>
            <div class="jushou" v-show="item.putUpHands"><i class="iconfont icon-jushouxin"></i></div>
            <div class="state">
              <div class="state-icon" :class="isTeacher && 'state-icon-opr'" v-if="classStatus === 1 && item.userid">
                <i @click="setMediaSwitch('audio',item)" :class="item.audio ? 'iconfont icon-tubiaozhizuomoban' : 'iconfont icon-tubiaozhizuomoban dis' "></i>
                <i @click="setMediaSwitch('video',item)" :class="item.video ? 'iconfont icon-shipin' : 'iconfont icon-shipin dis' "></i>
              </div>
              {{item.username}}
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="right">
      <div class="user">
        <div class="state">
          <div class="state-icon" :class="isTeacher && 'state-icon-opr'" v-if="classStatus === 1 && classlevel !== 0">
            <i @click="setMediaSwitch('audio',teacherInfo)" :class="teacherInfo.audio ? 'iconfont icon-tubiaozhizuomoban' : 'iconfont icon-tubiaozhizuomoban dis' "></i>
            <i @click="setMediaSwitch('video',teacherInfo)" :class="teacherInfo.video ? 'iconfont icon-shipin' : 'iconfont icon-shipin dis' "></i>
          </div>
          {{teacherInfo.teachername}}
        </div>
        <img :src="teacherInfo.avatar" />
        <div class="user-stream" :id="'stream'+teacherInfo.teacherid"></div>
      </div>
      <template v-if="classlevel === 2">
      <div class="user" v-if="streamList[0]">
        <div class="state">
          <div class="state-icon" :class="isTeacher && 'state-icon-opr'" v-if="classStatus == 1 && streamList[0].userid">
            <i @click="setMediaSwitch('audio',streamList[0])" :class="streamList[0].audio ? 'iconfont icon-tubiaozhizuomoban' : 'iconfont icon-tubiaozhizuomoban dis' "></i>
            <i @click="setMediaSwitch('video',streamList[0])" :class="streamList[0].video ? 'iconfont icon-shipin' : 'iconfont icon-shipin dis' "></i>
          </div>
          {{streamList[0].username}}
        </div>
        <img src="../assets/img/seat.png" />
        <div class="user-stream" :id="'stream'+streamList[0].userid"></div>
      </div>
      </template>
      <div class="title-tab" v-if="classlevel !== 2">
        <ul>
          <li @click="tab=0" :class="tab === 0 && 'on'">聊天</li>
          <li @click="tab=1" :class="tab === 1 && 'on'">学员({{userList.length}})</li>
        </ul>
      </div>
    
      <div class="talk" v-show="tab === 0">
        
        <div class="talk-list" ref="talkList" :style="{height:chatScrollHeight+'px',backgroundColor:'#151a20'}">
          <div class="load-more"><span @click="getChatList">{{chatState}}</span></div>
          <div class="item clearfix" v-for="(item,i) in chatList" :key="'item'+i" :class="item.memberid == userInfo.userid && 'me'">
            <div class="time" v-if="item.adddate">{{item.adddate}}</div>
            <div class="name">{{item.name || item.membername}}<span v-if="item.memberid == teacherInfo.teacherid">(老师)</span><span v-else-if="item.memberid == userInfo.userid">(我)</span><span v-else>(学生)</span></div>
            <div class="info" v-if="item.type == 0" v-html="item.interact.replace(/\#[\u4E00-\u9FA5]{1,3}\;/gi, emotion)"></div>
            <div class="info img-info" v-else-if="item.type == 1"><img class="preview-img" :src="previmglist[item.imgindex].src" @click="$preview.open(item.imgindex, previmglist)" @load="onRead(item.imgindex)" /></div>
          </div>
        </div>
        
        <div class="send-menu">
          <emotion ref="emotion" v-show="emotionFlag" class="send-emotion" @emotion="handleEmotion" :height="200"></emotion>
          <span @click.stop="emotionFlag = emotionFlag ? false : true" :class="emotionFlag && 'on'"><i class="iconfont icon-face"></i></span>
          <span id="imageContainer"><i class="iconfont icon-tupian1" id="imageSelectId"></i></span>
        </div>
        <div class="sendbox">
          <textarea v-model="sendContent" id="sendText" @keypress="sendTextKeypress($event)" placeholder="Ctrl+Enter发送"></textarea>
          <div class="btn" @click="send">发送</div>
        </div>
      </div>
      
      <div class="user-list" v-if="tab === 1">
        <div :style="{height:pageHeight-425+'px',backgroundColor:'#151a20'}">
        <ul>
          <li v-for="(item,i) in userList" :key="'item'+i">
            <span class="btn" :class="item.whiteboardPermission && 'on'" title="授权使用白板" @click="whiteboardAuthorization(item)" v-if="isTeacher"><i class="iconfont icon-huabi"></i></span>
            <span><i class="iconfont icon-shouji1" v-if="item.device === 'phone'"></i>
            <i class="iconfont icon-diannao" v-else></i></span>
            
            <div class="avatar"><img :src="item.avatar" /></div>
            {{item.membername || item.username}}
          </li>
        </ul>
        </div>
      </div>
      
    </div>
  </div>

  <div v-show="popup.flag" class="popup-gray-bg" @click="popup.flag = false"></div>
  <div v-show="popup.flag" class="popup-open">
    <div class="popup-title">使用手机访问</div>
    <div class="popup-close" @click="popup.flag = false">×</div>
    <div class="popup-iframe"><iframe :src="popup.src"></iframe></div>
  </div>
</div>
</template>

<script>
import selectWhiteboard from '@/components/selectWhiteboard';
import Emotion from '@/components/emotion/index'
const utils = require('../assets/js/utils');
const domap = utils.domap;
const request = utils.request;
const ApiUrl = `/Json/index.php?act=`;
const ApiUrl2 = `/Plus/Kesion.ajax.php?act=`;

/**
 * 配置信息通过页面全局函数getConfig接收
 */
let config     = getConfig(),
    onlineUids = [],
    liveData   = {},
    session,
    channel,
    client,
    myQcVideo,
    localStream,
    logid,
    mediaPlayer;

export default {
  components: {Emotion},
  data () {
    return {
      aluploaderIsLoaded:false,
      /**
       * 上传进度
       */
      progress:{
        flag:false,
        completed:0
      },
      /**
       * 课堂类型 (0大班, 1小班, 2一对一)
       */
      classlevel:null,
      /**
       * 记录上课时间
       */
      time:null,
      timeStr:'00:00:00',
      /**
       * 倒计时时间，用于计费，1分钟重置一次
       */
      billingTime:0,
      /**
       * 是否全屏
       */
      isFullScreen:false,
      /**
       * 推流地址，用户大班课教师推流
       */
      pushUrl:null,
      /**
       * 页面高度
       */
      pageHeight:null,
      /**
       * 上课区域容器大小
       */
      container:{
        width:null,
        height:null
      },
      /**
       * 打开iframe
       */
      popup:{
        src:config.shareUrl,
        flag:false
      },
      loading:false,
      /**
       * 互动白板
       */
      whiteboard:{
       
        /**
         * 当前画布的context, 通过context进行绘图
         */
        ctx:{},
        /**
         * 当前画布的详细信息
         */
        canvas:{},
        /**
         * 当前画布的缩放比例
         */
        scale:1,
        /**
         * 记录当前画布触发时的坐标
         */
        startX:0,
        startY:0,
        /**
         * 当前画布的进度
         */
        state:{
          current:1,
          max:1
        },
        /**
         * 绘图开关
         * 鼠标按住画布后会将此开关打开，此时鼠标移动将会进行绘图，鼠标松开后则关闭开关，绘图结束。
         */
        drawFlag:false,
        /**
         * 记录每张画布的绘图记录
         */
        drawingRecord:{},
        /**
         * 画布列表
         */
        
        canvasList:[],
        /**
         * 记录每一笔的坐标
         */
        coordinate:new Array(),
        /**
         * 当前选中的画布
         */
        selectedCanvasId:0,
        
        //白板光标图片
        cursor:null,
        isFocus:true,
        lineHeight:24,
        tool:null,
        toolFlag:false,
        textFlag:false,
        font:'Optima,hiragino sans gb,microsoft yahei,simsun,sans-serif',
        fontSize:18,
        pen:4,
        color:'ff0000',
        selectColorFlag:false,
        penSize:[4,8,12,16],
        colorList:['000000','002d00','015b00','028e01','03c501','06ff02','2d0000','2d2d00','2d5b00','2d8e01','2dc501','2eff02','5b0000','5b2d00','5b5b00','5b8e01','5bc501','5cff02','00002d','002d2d','015b2d','028e2d','03c52d','05ff2d','2d002d','2d2d2d','2d5b2d','2d8e2d','2dc52d','2eff2d','5b002d','5b2d2d','5b5b2d','5b8e2d','5bc52d','5cff2d','00015b','002d5b','005b5b','018e5b','02c55b','05ff5b','2d015b','2d2d5b','2d5b5b','2d8e5b','2dc55b','2eff5b','5b005b','5b2d5b','5b5b5b','5b8e5b','5bc55b','5cff5b','00038e','002d8e','005b8e','008ec5','01c58e','03ff8e','2c038e','2d2d8e','2d5b8e','2d8e8e','2dc58e','2dff8e','5b028e','5b2d8e','5b5b8e','5b8e8e','5bc58e','5bff8e','0005c5','002ec5','005bc5','008ec5','00c5c5','01ffc5','2c05c5','2c2ec5','2c5bc5','2c8ec5','2cc5ff','2dffc5','5b04c5','5b2ec5','5b5bc5','5b8ec5','5bc5c5','5bffc5','0009ff','002eff','005cff','008fff','00c5ff','00ffff','2c08ff','2c2eff','2c2eff','2c8fff','2cc5ff','2dffff','5b08ff','5b2eff','5b5cff','5b8fff','5bc5ff','5bffff','8e002d','8e2d00','8e5b01','8e8e01','8fc502','8fff03','c50001','c52c01','c55b01','c58e01','c5c502','c5ff03','ff0001','ff2c01','ff5b01','ff8e02','ffc502','ffff03','8e002d','8e2d2d','8e5b2d','8e8e2d','8fc52d','8fff2d','c5002d','c52c2d','c55b2d','c58e2d','c5c52d','c5ff2d','ff002d','ff2c2d','ff5b2d','ff8e2d','ffc52d','ffff2d','8e005b','8e2d5b','8e5b5b','8e8e5b','8fc55b','8fff5b','c5005b','c52c5b','c55b5b','c58e5b','c5c55b','c5ff5b','ff005b','ff2c5b','ff5b5b','ff8e5b','ffc55b','ffff5b','8e018e','8e2d8e','8e5b8e','8e8e8e','8ec58e','8fff8e','c5008e','c52d8e','c55b8e','c58e8e','c5c58e','c5ff8e','ff008e','ff2c8e','ff5b8e','ff8e8e','ff8e8e','ffff8e','8e03c5','8e2dc5','8e5bc5','8e8ec5','8ec5c5','8effc5','c502c5','c52dc5','c55bc5','c58ec5','c5c5c5','c5ffc5','ff00c5','ff2dc5','ff5bc5','ff8ec5','ffc5c5','ffffc5','8e07ff','8e2eff','8e5cff','8e8fff','8ec5ff','8effff','c505ff','c52eff','c55bff','c58eff','c5c5ff','c5ffff','ff03ff','ff2dff','ff5bff','ff8eff','ffc5ff','ffffff']

      },
      /**
       * 材料
       */
      files:{
        index:0,
        className:null,
        flag:false,
        list:[
          {
            id:0,
            fileType:'blank',
            name:'主白板',
            src:'/App/View/class/home.interactlive/style/bg1.3f6ec69.jpg'
          }
        ]
      },
      /**
       * 媒体
       */
      media:{
        selected:0,
        className:null,
        flag:false,
        list:[
          {
            id:0,
            name:'不播放媒体'
          }
        ]
      },
      /**
       * 加载教室
       */
      pageLoading:{
        flag:true,
        text:'正在加载网页资源...'
      },
      logo:require('../assets/img/logo.png'),
      
      /**
       * 上课状态 0未开始  1已开始
       */
      classStatus:0,
      /**
       * 消费信息
       * alreadyConsumed 已消费
       * balance 余额
       */
      alreadyConsumed:0,
      balance:0,
      /**
       * 当前选项卡
       */
      tab:0,
      emotionFlag:false,
      sendContent:null,
      /**
       * 聊天容器高度
       */
      chatScrollHeight:null,
      /**
       * 加载聊天数据，文字提示信息
       */
      chatState:'查看更多消息',
  
      /**
       * 通过interactid加载之前的聊天数据
       */
      interactid:null,
      /**
       * 聊天记录
       */
      chatList:[],
      /**
       * 预览图片列表
       */
      previmglist:[],
      /**
       * 学员列表
       */
      userList:[],
      /**
       * 课堂标题
       */
      title:config.title,
      /**
       * 当前会员是否是老师
       */
      isTeacher:false,
      /**
       * 会员信息
       */
      userInfo:{
        userid:config.userid,
        avatar:null,
        username:null
      },
      /**
       * 老师信息
       */
      teacherInfo:{
        teacherid:null,
        avatar:null,
        teachername:null,
        teacherheadid:null,
        video:false,
        audio:false
      },
      //举手状态
      isPutUpHands:false,
      streamBoxHeight:null,
      //音视频流列表
      streamList:[]
    }
  },
  mounted(){
    
    var zoom = e=>{ 
      var e = e || window.event; 
      if(e.wheelDelta && event.ctrlKey){
          event.returnValue = false
      }else if(e.detail){
          event.returnValue = false;
      } 
    }  
    if(document.addEventListener){ 
        document.addEventListener('DOMMouseScroll' , zoom , false); 
    }
    window.onmousewheel = document.onmousewheel = zoom;
    /**
     * 获取课堂基础信息
     */
    request(ApiUrl+'Member.getliveKey',{
      wxid:config.wxid,
      token:config.token,
      userid:this.userInfo.userid,
      classid:config.classid,
      chapterid:config.chapterid
    },res=>{
      var data = res.getliveKey;
      this.classlevel = parseInt(data.classlevel);
      this.title = data.courseTitle;
      this.teacherInfo.teacherid = data.teacherid;
      this.teacherInfo.teacherheadid = data.teacherheadid;
      this.teacherInfo.avatar = data.teacherheadpic;
      this.teacherInfo.teachername = data.teachername;
      this.userInfo.avatar = data.avatar;
      this.userInfo.username = data.username;
      this.isTeacher = `${data.teacherid}` === `${data.userid}`;
      this.pushUrl = data.pushUrl;
      
      liveData.appId = data.appId;
      liveData.SignKey = data.SignKey;
      liveData.channelName = data.channelName;
      liveData.channelKey = data.ChannelKey;
      liveData.playUrl = data.playUrl

      if(this.isTeacher && this.classlevel !== 0){
        /**
         * 老师端开启白板权限
         */
        this.whiteboard.toolFlag = true
        
        /**
         * 选择图文材料
         */
        ossWebUpload({
          wxid:config.wxid,
          classid:config.classid,
          type:4,
          selectId:'materialSelectId',
          containerId:'materialContainer',
          UploadProgress:(up,file)=>{
            this.progress.flag = true;
            this.progress.completed = file.percent
          },
          FileUploaded:res=>{
            /**
             * 上传成功，动态追加数据
             */
            if(typeof res === 'object'){
              this.files.index++;
              let type = this.getFileSuffix(res.name);
              this.files.list.push({
                id:this.files.index,
                fileid:res.fileid,
                name:res.name,
                src:res.defaultpic,
                fileType:type
              })
            }
            this.progress.flag = false;
            this.progress.completed = 0

          }
        })

        /**
         * 添加媒体
         */
        uploadFileByAliyun('mediaFile',
            {
              wxid:config.wxid,
              classid:config.classid,
              onUploadProgress:percent=>{
                this.progress.flag = true;
                this.progress.completed = percent
              },
              success:res=>{
                this.media.list.push({
                  id:this.media.list.length,
                  name:res.vdoId,
                  playauth:res.playauth,
                  vid:res.vdoId
                });
                this.progress.flag = false;
                this.progress.completed = 0
              }
            }
        )
        
        
        /**
         * 请求媒体资料
         */
        request(ApiUrl+'Live.courseMediaFiles',{
          wxid:config.wxid,
          token:config.token,
          userid:this.userInfo.userid,
          classid:config.classid,
          maxPerPage:100
        },res=>{
          domap(res.courseMediaFiles,item=>{
            this.media.list.push({
              id:this.media.list.length,
              name:item.vdoName,
              playauth:item.PlayAuth,
              vid:item.vdoId
            })
          })

        },'json')

        /**
         * 请求在线文件
         */
        request(ApiUrl+'Live.classfile',{
          wxid:config.wxid,
          token:config.token,
          liveType:1,
          userid:this.userInfo.userid,
          classid:config.classid,
          chapterid:config.chapterid,
          maxPerPage:100
        },res=>{
          domap(res.classfile.value,item=>{
            let type = this.getFileSuffix(item.filename)
            this.files.index++;
            this.files.list.push({
              id:this.files.index,
              fileid:item.fileid,
              name:item.filename,
              src:item.filePath,
              fileType:type
            })
          })
        },'json')
      }

      window.onresize = ()=>{
        this.setPageArea()
      }
      window.onresize()
      /**
       * 初始化座位
       */
      this.setInitStreamList()
      
      /**
       * 选择图片上传
       */
      ossWebUpload({
        wxid:config.wxid,
        type:1,
        selectId:'imageSelectId',
        containerId:'imageContainer',
        FileUploaded:res=>{
          this.sendChatMsg(1,res.defaultpic)
        }
      })

      /**
       * 请求聊天记录
       */
      this.getChatList()

      /**
       * 加载声网SDK
       */
      let arr = ['/Public/agoraweb/AgoraSig-1.4.0.js','/Public/agoraweb/AgoraRTCSDK-2.4.0.js'];
      let loaded = 0;
      let loadAgoraJs = ()=>{
        let agoraweb = document.createElement('script');
        agoraweb.src = arr[loaded];
        document.head.appendChild(agoraweb);
        agoraweb.addEventListener('load',()=>{
          agoraweb.outerHTML = '';
          loaded++;
          if(loaded === arr.length){
            this.login()
          }else{
            loadAgoraJs()
          }
        })
      }
      loadAgoraJs();
      
    },'json')

    /**
     * 鼠标点击
     */
    document.addEventListener('click',e=>{
      this.emotionFlag = false
    })
    /**
     * 鼠标按下
     */
    document.addEventListener('mousedown', e=>{
      if(this.whiteboard.textFlag && this.whiteboard.tool === 'text'){
        return false
      }
    })

    /**
     * 鼠标松开
     */
    document.addEventListener('mouseup',e=>{
      
      this.canvasMouseup()
    })

    /**
     * 捕捉键盘事件
     */
    document.addEventListener('keydown',e=>{ 
      if(e.keyCode === 122){
        /**
         * 捕捉F11键盘动作，阻止F11默认动作
         */
        e.preventDefault();  
        
      }
    })

    document.addEventListener('keyup',e=>{ 
      
    })
    
    /**
     * 监听不同浏览器的全屏事件，并件执行相应的代码
     */
    document.addEventListener("webkitfullscreenchange", ()=> {
        if (document.webkitIsFullScreen) {
          //全屏后要执行的代码
          this.isFullScreen = true
          this.setPageArea()
        }else{
          this.isFullScreen = false
          this.setPageArea()
    　　}
    }, false); 
    document.addEventListener("fullscreenchange", ()=> {
        if (document.fullscreen) {
            //全屏后执行的代码
            this.isFullScreen = true
            this.setPageArea()
        }else{
            //退出全屏后要执行的代码
            this.isFullScreen = false
            this.setPageArea()
        }
    }, false); 
    document.addEventListener("mozfullscreenchange", ()=> {
        if (document.mozFullScreen) {
            //全屏后要执行的代码
            this.isFullScreen = true
            this.setPageArea()
        }else{
            //退出全屏后要执行的代码
            this.isFullScreen = false
            this.setPageArea()
        }
    }, false); 
    document.addEventListener("msfullscreenchange", ()=> {
        if (document.msFullscreenElement) {
            //全屏后要执行的代码
            this.isFullScreen = true
            this.setPageArea()
        }else{
            //退出全屏后要执行的代码
            this.isFullScreen = false
            this.setPageArea()
        }
    }, false)

  },
  methods:{
    getBody(){
      return document.body || document.getElementsByTagName('body')[0]
    },
    addMeadiFile(id){
      document.getElementById(id).click()
    },

    /**
     * 设置页面容器信息
     */
    setPageArea(){

      let pageWidth = 1920;
      let scale = 1/1920;
      let newScale = scale*window.innerWidth;
      let pageHeight = window.innerHeight/newScale;
      this.pageHeight = pageHeight;
      let toolWidth = this.whiteboard.toolFlag ? 60 : 0;
      let studentHeight = (pageWidth - 330 - toolWidth) / 8;
      if(this.classlevel === 0){
        toolWidth = 0;
      }
      this.container.width = this.isFullScreen ? pageWidth - toolWidth : pageWidth - 320 - toolWidth
      switch(this.classlevel){
        case 0:
          this.container.height = this.isFullScreen ? pageHeight - 50 : pageHeight - 60
          this.chatScrollHeight = pageHeight - 535
          break;
        case 1:
          this.streamBoxHeight = studentHeight;
          this.container.height = this.isFullScreen ? pageHeight - 50 : pageHeight - 110 - studentHeight-10
          this.chatScrollHeight = pageHeight - 535
          break;
        case 2:
          this.container.height = this.isFullScreen ? pageHeight - 50 : pageHeight - 110
          this.chatScrollHeight = pageHeight - 810
          break
      }
      this.$nextTick(()=>{
        let body = this.getBody();
        body.style.width = `${pageWidth}px`;
        body.style.height = `${pageHeight}px`;
        body.style.transform = `scale(${newScale})`;
        body.style.transformOrigin = 'left top';
      })
    },
    handleEmotion (emo) {
      this.sendContent ? this.sendContent += emo : this.sendContent = emo
    },
    /**
     * 将匹配结果替换表情图片
     */
    emotion (name) {
      return this.$refs.emotion.codeToExpression(name)
     
    
    },
    /**
     * 获取文件后缀
     */
    getFileSuffix(name){
      
      if(typeof name !== 'string'){
        return false
      }
      let type = name.match(/\.\w+/);
  
      if(type === null){
        return false
      }
      type = type[type.length-1];
      
      if(type === '.docx' || type === '.doc'){
        type = 'word'
      }else if(type === '.pdf'){
        type = 'pdf'
      }else{
        type = 'img'
      }
      return type
    },
    
    setInitStreamList(){
      if(this.isTeacher){
        this.streamList.push({
          username:'待加入',
          userid:null,
          video:true,
          audio:false,
          putUpHands:false
        })
      }else{
        this.streamList.push({
          username:this.userInfo.username,
          userid:config.userid,
          video:false,
          audio:false,
          putUpHands:false
        })
      }
    },
    /**
     * 画布触发
     */
    canvasMousedown(e){
      this.getBody().setAttribute('onselectstart','return false')
      let errY = this.whiteboard.errY;
      let selectedCanvas = this.getSelectedCanvas();
      
      this.whiteboard.ctx = selectedCanvas.ctx;
      this.whiteboard.canvas = selectedCanvas.canvas;
      this.whiteboard.startX = e.offsetX;
      this.whiteboard.startY = e.offsetY;
      switch(this.whiteboard.tool){
        case 'grab':
          this.whiteboard.drawFlag = true;
          break
        case 'pen':
          this.whiteboard.prevX = e.offsetX;
          this.whiteboard.prevY = e.offsetY + errY;
          this.whiteboard.drawFlag = true;
          break
        case 'eraser':
          this.whiteboard.drawFlag = true;
          break
        case 'text':
          if(this.whiteboard.textFlag){
            return false
          }
          this.whiteboard.textFlag = true
          break
      }
    },
    /**
     * 开始绘图
     */
    canvasMousemove(e){
      var ctx = this.whiteboard.ctx;
      if(this.whiteboard.drawFlag){
        switch(this.whiteboard.tool){
          case 'grab':
            this.whiteboard.canvas.x += e.offsetX - this.whiteboard.startX;
            this.whiteboard.canvas.y += e.offsetY - this.whiteboard.startY;
            break
          case 'pen':
            ctx.beginPath();
            ctx.strokeStyle = `#${this.whiteboard.color}`;
            ctx.lineWidth = this.whiteboard.pen / 2;
            ctx.moveTo(this.whiteboard.startX,this.whiteboard.startY);
            ctx.lineTo(e.offsetX,e.offsetY);
            ctx.stroke();
            this.whiteboard.coordinate.push([this.whiteboard.startX,this.whiteboard.startY,e.offsetX,e.offsetY]);
            this.whiteboard.startX = e.offsetX;
            this.whiteboard.startY = e.offsetY;
            break
          case 'eraser':
            ctx.clearRect(e.offsetX,e.offsetY,30,30);
            this.whiteboard.coordinate.push([e.offsetX,e.offsetY,30,30]);
            break
        }
      }
    },

    /**
     * 鼠标松开
     */
    canvasMouseup(){
      
      this.getBody().setAttribute('onselectstart','return true')
      let tool = this.whiteboard.tool,
          coordinate = this.whiteboard.coordinate;
      switch(tool){
        case 'grab':
          this.whiteboard.drawFlag = false;
          this.sendWhiteboardMsg('grab',{
            left:this.whiteboard.canvas.x,
            top:this.whiteboard.canvas.y
          })
          break
        case 'pen':
        case 'eraser':
          if(this.whiteboard.drawFlag){
            
            /**
             * 由于消息大小限制，分次发送
             */
            if(coordinate.length > 550){
              var n = Math.ceil(coordinate.length / 550);
              for(var i=0;i<n;i++){
                var maxN = (i+1)*550;
                var arr = new Array();
                for(var s=i*550;s<maxN;s++){
                  if(coordinate[s]){
                    arr.push(coordinate[s]);
                  }else{
                    break
                  }
                }
                this.sortOutWhiteboardMsg(tool,arr)
              }

            }else{
              this.sortOutWhiteboardMsg(tool,coordinate)
            }
            this.whiteboard.coordinate = new Array();
            this.whiteboard.drawFlag = false
          }
          break
        case 'text':
          let selectedCanvas = this.getSelectedCanvas();
          let ctx = selectedCanvas.ctx;
          if(this.whiteboard.textFlag){
            if(this.whiteboard.isFocus){
              this.whiteboard.isFocus = false
            }else{
              var v = fillCanvasText.value;
              if(v.replace(/\s+/,'') !== ''){
                ctx.font = `${this.whiteboard.fontSize}px ${this.whiteboard.font}`;
                ctx.fillStyle = `#${this.whiteboard.color}`;
                let x = this.whiteboard.startX - selectedCanvas.offsetLeft - 54;
                let y = this.whiteboard.startY - selectedCanvas.offsetTop;
                let w = fillCanvasText.offsetWidth - 20;
                this.canvasTextAutoLine({
                  text:v,
                  ctx:ctx,
                  x:x,
                  y:y,
                  fillWidth:w,
                  lineHeight:this.whiteboard.lineHeight
                })
                //发送白板更新消息
                this.sendWhiteboardMsg('text',{
                  fillWidth:w,
                  font:this.whiteboard.font,
                  lineHeight:this.whiteboard.lineHeight,
                  fontSize:this.whiteboard.fontSize,
                  color:this.whiteboard.color,
                  text:v,
                  x:x,
                  y:y
                })
              }
              fillCanvasText.value = null
              this.whiteboard.textFlag = false
              this.whiteboard.isFocus = true
            }
          }
          break
      }
    },
    /**
     * 绘制多行文本
     */
    canvasTextAutoLine(parameter){
        let chr = parameter.text.split(""),
        ctx = parameter.ctx,
        temp = "",       
        row = [];
        domap(chr,t=>{
          if( ctx.measureText(temp).width < parameter.fillWidth){
            }else{
              row.push(temp);
              temp = "";
            }
            temp += t;
        })
        row.push(temp);
        domap(row,(t,b)=>{
          ctx.fillText(t,parameter.x,parameter.y+(b+1)*parameter.lineHeight);
        })
      
    },
    /**
     * 检测画布是否为空
     */
    isCanvasBlank(canvas) {
        var blank = document.createElement('canvas');
        blank.width = canvas.width;
        blank.height = canvas.height;
        return canvas.toDataURL() == blank.toDataURL();
    },

    /**
     * 整理画布消息
     */
    sortOutWhiteboardMsg(cur,arr){
      var obj = {
        coordinate:arr
      }
      switch(cur){
        case 'pen':
          obj.lineWidth = this.whiteboard.pen / 2;
          obj.color = this.whiteboard.color;
          break
      }
      this.sendWhiteboardMsg(cur,obj)
    },
    /**
     * 画布切换
     */
    slideCanvas(type){
      if(!this.isTeacher){
        return false
      }
      let canvasItem;
      domap(this.whiteboard.canvasList,item=>{
        if(item.id == this.whiteboard.selectedCanvasId){
          canvasItem = item
        }
      })
      if(!canvasItem.current && !canvasItem.list){
        return false
      }
      let max = canvasItem.list.length;
      switch(type){
        case 'prev':
          canvasItem.current = Math.max(canvasItem.current-1,1)
          break
        case 'next':
          canvasItem.current = Math.min(canvasItem.current+1,max)
          break
      }
      domap(canvasItem.list,(item,i)=>{
        if(canvasItem.current == i+1){
          if(!item.flag){
            item.flag = true
            this.loading = true
          }
        }
      })
      this.whiteboard.state.current = canvasItem.current
      this.sendWhiteboardMsg('slideCanvas')
    },

    /**
     * 获取当前画布信息
     */
    getSelectedCanvas(id){
      
      let selectedCanvasId = typeof id !== 'undefined' ? id : this.whiteboard.selectedCanvasId,
          canvasItem = {}, canvas = {}, canvasId, current, ctx, scale;
      
      domap(this.whiteboard.canvasList,item=>{
        if(`${item.id}` === `${selectedCanvasId}`){
          if (typeof item.list === 'object' && typeof item.current !== 'undefined') {
            current = item.current;
            canvasId = `${item.id}_${current}`;
            domap(item.list,obj=>{
              if(`${obj.id}` === `${canvasId}`){
                canvas = obj.canvas;
                canvasItem = obj;
                scale = obj.scale
              }
            })
          }else{
            canvasId = item.id;
            canvasItem = item;
            current = 1;
            canvas = item.canvas;
            scale = item.scale
          }
        }
      });
      
      if(document.getElementById(`canvas${canvasId}`)){
        ctx = document.getElementById(`canvas${canvasId}`).getContext("2d")
      }
     
      let offset = this.getOffset(canvas);
      
      return {
        selectedId:selectedCanvasId,
        ctx:ctx,
        canvas:canvas,
        canvasId:canvasId,
        canvasItem:canvasItem,
        scale:scale,
        current:current,
        offsetTop:offset.top,
        offsetLeft:offset.left
      }

    },

    /**
     * 获取dom坐标信息
     */
    getOffset(el){
      let offsetTop = el.offsetTop;
      let offsetLeft = el.offsetLeft;
      if(el.parentNode){
        get(el.parentNode)
      }
      function get(el){
        if(el.offsetTop){
          offsetTop += el.offsetTop
          offsetLeft += el.offsetLeft
        }
        if(el.parentNode){
          get(el.parentNode)
        }
      }
      return {
        left:offsetLeft,
        top:offsetTop
      }
     
    },
    /**
     * 得到画布基础消息
     */
    getWhiteboardBaseMsg(selectedCanvasInfo){
      let msg = {
            action:'whiteboard',
            selectedId:selectedCanvasInfo.selectedId,
            width:selectedCanvasInfo.canvas.width,
            current:selectedCanvasInfo.current
          }
      return msg
    },
    /**
     * 发送画布信息
     */
    sendWhiteboardMsg(type,data){
      let selectedCanvasInfo = this.getSelectedCanvas();
      let msg = this.getWhiteboardBaseMsg(selectedCanvasInfo);
      msg.type = type;
      if(typeof data === 'object'){
        let keys = Object.keys(data);
        domap(keys,k=>[
          msg[k] = data[k]
        ])
      }
      switch(type){
        case 'text':
        case 'pen':
        case 'eraser':

          var canvasId = selectedCanvasInfo.canvasId,
              canvas = document.getElementById(`canvas${canvasId}`);
          
          /**
           * 检查画布是否为空，为空则清除存储记录
           */
          if(type === 'eraser' && this.isCanvasBlank(canvas)){
            msg['isEmpty'] = true;
            this.addDrawingRecord(canvasId,'clear');
          }else{
            msg['isEmpty'] = false;
            this.addDrawingRecord(canvasId,msg);
           
          }
          break
        case 'clearRect':
          var canvasId = selectedCanvasInfo.canvasId;
          this.addDrawingRecord(canvasId,'clear');
          break
      }
      
      channel.messageChannelSend(JSON.stringify(msg))
    
    },

    /**
     * 添加绘图记录
     */
    addDrawingRecord(key,data){
      if(!this.whiteboard.drawingRecord[key] || data === 'clear'){
        this.whiteboard.drawingRecord[key] = new Array()
      }

      data !== 'clear' && this.whiteboard.drawingRecord[key].push(data)
  
    },
    /**
     * 清除画布
     */
    clearCanvas(){
      let canvasInfo = this.getSelectedCanvas();
      canvasInfo.ctx.clearRect(0,0,canvasInfo.canvas.width,canvasInfo.canvas.height);
      //通知学生清除画布
      this.sendWhiteboardMsg('clearRect')
      
    },
    /**
     * 切换画布工具
     */
    slideTool(name){
      if(name === 'text'){
        return false
      }
      this.whiteboard.tool = name
      switch(name){
        case 'pen':
          this.whiteboard.cursor = `url(${require('../assets/img/pen.png')}), auto`
          break
        case 'eraser':
          this.whiteboard.cursor = `url(${require('../assets/img/eraser.png')}), auto`
          break
        case 'grab':
          this.whiteboard.cursor = '-webkit-grab';
          break
        default:
          this.whiteboard.cursor = `inherit`
      }
    },
    /**
     * 举手
     */
    putUpHands(){
      this.isPutUpHands = this.isPutUpHands ? false : true
      domap(this.userList,item=>{
        if(item.memberid = this.userInfo.userid){
          this.isPutUpHands ? this.sendUserMsg(20) : this.sendUserMsg(21)
        }
      })
    },
    /*
     *获取合适的大小
     *containerArea 容器宽高
     *contentArea 内容宽高
     */
    getSuitableArea(containerArea,contentArea,minWidth){
      let scale = contentArea.width / contentArea.height,w,h,
          containerScale = containerArea.width / containerArea.height;
      
      if(scale > containerScale){
        w = containerArea.width;
        h = contentArea.height*(containerArea.width/contentArea.width)
        
      }else{
        h = containerArea.height;
        w = contentArea.width*(containerArea.height/contentArea.height)
      }
      if(minWidth){
        if(w < minWidth){
          scale = w/minWidth;
          w = w/scale;
          h = h/scale;
        }
      }
      
      return {
        width:w,
        height:h
      }
    },
    /**
     * 加载白板图片
     */
    canvasImgLoad(imgItem){
      
      let img = new Image();
      img.src = imgItem.src;
      img.onload = ()=>{
        let area = this.getSuitableArea(
          {
            width:this.container.width,
            height:this.container.height
          },
          {
            width:img.width,
            height:img.height
          },
          1200
        )
        imgItem.width = area.width;
        imgItem.height = area.height;
        imgItem.canvas.width = area.width * 2;
        imgItem.canvas.height = area.height + area.width;
        imgItem.left = (this.container.width - area.width*2)/2;
        imgItem.top = (this.container.height - area.width - area.height)/2;
        this.loading = false
      }
      img.onerror = ()=>{
        this.loading = false
      }
      /**
       * 画布加载完成，请求绘图记录(用于学生)
       */
      if(!this.isTeacher){
        this.sendMsgToTeacher({
          action:'getDrawingInfo',
          key:imgItem.id
        })
      }
      
    },
    /**
     * 触发遮罩层
     */
    maskClick(){
      this.files.className = 'animate-left-out';
      this.media.className = 'animate-left-out';
      setTimeout(()=>{
        this.media.flag = false;
        this.files.flag = false
      },400)
     
    },
    /**
     * 打开文件选择
     */
    openFilesBox(data){
      data.className = 'animate-left-show';
      data.flag = true;
    },

    /**
     * 添加白板文件
     */
    addWhiteboardFile(bg,name){
      
      if(bg && name){
        let num = Math.floor(Math.random() * 10000000);
        this.files.index++;
        let item = {
          id:this.files.index,
          fileType:'blank',
          src:bg,
          name:`${name}白板${num}`
        }
        this.files.list.push(item)
        this.addLiveFile(item)

      }else{
        this.$layer.iframe({
          content: {
            content: selectWhiteboard, //传递的组件对象
            parent: this,//当前的vue对象
            data:{}//props
          },
          area:['800px','500px'],
          title: '选择白板主题'
        });
      }
    },

    /**
     * 发送消息给教师
     */
    sendMsgToTeacher(msg){
      if(session && typeof session.messageInstantSend === 'function'){
        session.messageInstantSend(this.teacherInfo.teacherid,JSON.stringify(msg))
      }else{
        setTimeout(()=>{
          this.sendMsgToTeacher(msg)
        },100)
      }
    },

    /**
     * 添加在线文件，生成画布
     * @param type [img,word]
     */
    addLiveFile(item){
      
      this.whiteboard.selectedCanvasId = item.id;
      let isRepeat = false;
      domap(this.whiteboard.canvasList,canvas=>{
        if(`${canvas.id}` === `${item.id}`){
          isRepeat = true;
          /**
           * 设置当前选中画布信息，确保底图一致
           */
          if(typeof canvas.current !== 'undefined' && typeof item.current !== 'undefined'){
            canvas.current = item.current
          }
          this.whiteboard.state.current = canvas.current || 1;
          this.whiteboard.state.max = canvas.list ? canvas.list.length : 1;
        }
      });
     
      switch(item.fileType){
        case 'blank':
        case 'img':
          if(!isRepeat){
            this.loading = true;
            this.whiteboard.canvasList.push({
              id:item.id,
              fileid:item.fileid,
              fileType:item.fileType,
              src:item.src,
              width:null,
              height:null,
              canvas:{
                x:0,
                y:0,
                width:null,
                height:null
              },
              left:0,
              top:0,
              scale:1
            })
          }  
          this.isTeacher && this.sendWhiteboardMsg('selectedCanvasId',item);
          break
        case 'word':
        case 'pdf':
          item.current = item.current || 1
          if(!isRepeat){
            this.loading = true;
            request(`${ApiUrl}Live.courseware`,{
              wxid:config.wxid,
              token:config.token,
              userid:config.userid,
              fileid:item.fileid
            },res=>{
              
              let list = [];
              domap(res.courseware.value,(img,imgIndex)=>{
                list.push({
                  id:`${item.id}_${imgIndex+1}`,
                  flag:false,
                  src:img.urls,
                  width:null,
                  height:null,
                  canvas:{
                    x:0,
                    y:0,
                    width:null,
                    height:null
                  },
                  left:0,
                  top:0,
                  scale:1
                })
              });

              //默认加载第一张
              list[item.current-1].flag = true;
              this.whiteboard.canvasList.push({
                id:item.id,
                fileid:item.fileid,
                fileType:item.fileType,
                current:item.current,
                list:list
              });
              this.whiteboard.state.current = item.current;
              this.whiteboard.state.max = list.length;
              
              this.isTeacher && this.sendWhiteboardMsg('selectedCanvasId',item);
              
            },'json')
          }else{
            this.isTeacher && this.sendWhiteboardMsg('selectedCanvasId',item);
          }
          break
      }
    },
    
    /**
     * 选择媒体文件
     */
    selectMedia(item){
      if(`${this.media.selected}` === `${item.id}`){
        return false
      }

      this.media.selected = item.id;
      /**
       * 老师端发送消息通知学员播放媒体视频
       */
      this.sendUserMsg('media',{
        method:'ready',
        vid:item.vid,
        playauth:item.playauth
      })
    },
    clearMeida(){
      if(mediaPlayer){
        mediaPlayer.dispose();
        mediaPlayer = null
      }
      document.getElementById('J_prismPlayer').className = null;
    },
    /**
     * 处理媒体视频
     */
    handleMedia(msg){
      if(!mediaPlayer || (mediaPlayer && `${mediaPlayer.vid}` !== `${msg.vid}`)){
        
        this.playMedia({
          vid:msg.vid,
          playauth:msg.playauth
        },mediaPlayer=>{
          
          /**
           * 播放器视频初始化按钮渲染完毕。
           * 播放器UI初始设置需要此事件后触发，避免UI被初始化所覆盖。
           * 播放器提供的方法需要在此事件发生后才可以调用。
           */
          mediaPlayer.on('ready',e=>{
            mediaPlayer.play();
            this.handleMedia(msg)
          })
        })
        return false
      }
      switch(msg.method){
        case 'ready':

          if(this.isTeacher){
            /**
             * 视频由暂停恢复为播放时触发
             */
            mediaPlayer.on('play',e=>{
              this.sendMediaMsg('play')
            })

            /**
             * 视频暂停时触发
             */
            mediaPlayer.on('pause',e=>{
              this.sendMediaMsg('pause')
            })
            /**
             * 完成拖拽 参数返回拖拽点的时间
             */
            mediaPlayer.on('completeSeek',e=>{
              this.sendMediaMsg('completeSeek')
              
            })
          }

          break
        case 'play':
        case 'completeSeek':
          if(!this.isTeacher){
            mediaPlayer.seek(msg.paramData);
            mediaPlayer.play()
          }
          break
        case 'pause':
          if(!this.isTeacher){
            mediaPlayer.seek(msg.paramData)
            mediaPlayer.pause()
          }
          break
        
      }
    },
    sendMediaMsg(method){
      let msg = {
        action:'media',
        method:method,
        paramData:mediaPlayer.getCurrentTime(),
        vid:mediaPlayer.vid,
        playauth:mediaPlayer.playauth
      }
      channel.messageChannelSend(JSON.stringify(msg))
    },
    /**
     * 播放媒体设备
     */
    playMedia(data,fn){
      this.clearMeida();
      if(!data.vid && !data.playauth){
        return false
      }
      let parameter = {
        id: 'J_prismPlayer',
        width: '100%',
        height: '100%',
        autoplay: false,
        vid : data.vid,
        playauth : data.playauth,
        cover: '//liveroom-img.oss-cn-qingdao.aliyuncs.com/logo.png'
      }
      if(this.isTeacher){
        parameter.skinLayout = [
          {
            name: "controlBar", align: "blabs", x: 0, y: 0,
            children: [
              {name: "progress", align: "blabs", x: 0, y: 44},
              {name: "playButton", align: "tl", x: 15, y: 12},
              {name: "timeDisplay", align: "tl", x: 10, y: 7},
              {name: "fullScreenButton", align: "tr", x: 10, y: 12}
            ]
          }
        ]
      }else{
        parameter.skinLayout = [
          {
            name: "controlBar", align: "blabs", x: 0, y: 0,
            children: [
              {name: "fullScreenButton", align: "tr", x: 10, y: 12},
            ]
          }
        ]
      }
      new Aliplayer(parameter,player=>{
        mediaPlayer = player;
        mediaPlayer.vid = data.vid;
        mediaPlayer.playauth = data.playauth;
        typeof fn === 'function' && fn(mediaPlayer)

      })
    },
    /**
     * 删除材料文件
     */
    deleteLiveFile(item){
      if(`${item.id}` === `${this.whiteboard.selectedCanvasId}`){
        return false
      }
      if(item.fileType === 'blank'){
        let confirmId =  this.$layer.confirm('您确定要删除该白板吗？',()=>{
          this.$layer.close(confirmId)
          domap(this.files.list,(obj,i)=>{
            if(`${obj.id}` === `${item.id}`){
              //从数组中移除对应文件
              this.files.list.splice(i,1)
              if(this.whiteboard.drawingRecord[item.id]){
                this.whiteboard.drawingRecord[item.id] = new Array()
              }
            }
          })
          this.$layer.msg('删除成功')
        })
      }else{

        let confirmId =  this.$layer.confirm('您确定要删除该文件吗？',()=>{
          request(`${ApiUrl}Live.delFile`,{
            wxid:config.wxid,
            token:config.token,
            userid:this.userInfo.userid,
            liveType:1,
            classid:config.classid,
            fileid:item.fileid
          },res=>{
            if(res.delFile === 'ok'){
              this.$layer.close(confirmId)
              domap(this.files.list,(obj,i)=>{
                if(`${obj.id}` === `${item.id}`){
                  //从数组中移除对应文件
                  this.files.list.splice(i,1)
                }
              })
              this.$layer.msg('删除成功')
            }
          },'json')
          
        })
      }
    },
    /**
     * 画布复位
     */
    canvasRestoration(){
      if(this.isTeacher){
        let canvasItem = this.getSelectedCanvas().canvasItem;
        canvasItem.scale = 1;
        canvasItem.canvas.x = 0;
        canvasItem.canvas.y = 0;
        this.sendWhiteboardMsg('zoom',{
          scale:1
        })
        this.sendWhiteboardMsg('grab',{
          left:0,
          top:0
        })
      }
    },
    /**
     * 操作画布，放大或缩小
     */
    zoom(flag){
      if(this.isTeacher){
        let selectedCanvas = this.getSelectedCanvas(),
            canvasItem     = selectedCanvas.canvasItem,
            scale          = selectedCanvas.scale;
        let newScale       = flag ? Math.min(scale+0.2,3) : Math.max(scale-0.2,1);
        this.$layer.msg(`${(100*newScale).toFixed(0)}%`);
        if(`${scale}` !== `${newScale}`){
          canvasItem.scale = newScale;
          this.sendWhiteboardMsg('zoom',{
            scale:newScale
          })
        }
        
      }
    },
    /**
     * 清除所有画布
     */
    clearAllCanvas(){
      domap(this.whiteboard.canvasList, item => {
        if (typeof item.list === 'object' && typeof item.current !== 'undefined'){
          domap(item.list,obj=>{
            if(obj.flag && obj.width && obj.height){
              let ctx = window[`canvas${obj.id}`].getContext("2d");
              ctx.clearRect(0, 0, obj.width, obj.height);
            }
          })
        }else{
          let ctx = window[`canvas${item.id}`].getContext("2d");
          ctx.clearRect(0, 0, item.width, item.height);
        }
      })
    },
    /**
     * 收到画布消息，进行绘图（用于学生端）
     */
    drawCanvas(msg){
      domap(this.whiteboard.canvasList, (canvas,i)=>{
        if (`${canvas.id}` === `${msg.selectedId}` && canvas.current !== undefined){
          canvas.current = msg.current
        }
      })
      let selectedCanvas = this.getSelectedCanvas(msg.selectedId),
          ctx            = selectedCanvas.ctx,
          width          = selectedCanvas.canvas.width,
          height         = selectedCanvas.canvas.height,
          canvasItem     = selectedCanvas.canvasItem,
          ratio          = width / msg.width,
          canvasId       = selectedCanvas.canvasId;
      
      switch(msg.type){
        case 'pen':
          domap(msg.coordinate,obj=>{
            ctx.beginPath();
            ctx.lineWidth = msg.lineWidth * ratio;
            ctx.strokeStyle = '#'+msg.color;
            ctx.moveTo(obj[0]*ratio,obj[1]*ratio);
            ctx.lineTo(obj[2]*ratio,obj[3]*ratio);
            ctx.stroke();
          });
          this.addDrawingRecord(canvasId,msg)
          break
        case 'eraser':
          domap(msg.coordinate,obj=>{
            ctx.clearRect(obj[0]*ratio,obj[1]*ratio,obj[2]*ratio,obj[3]*ratio)
          });
          if(msg.isEmpty){
            this.addDrawingRecord(canvasId,'clear')
          }else{
            this.addDrawingRecord(canvasId,msg)
          }
          break
        case 'text':
          ctx.font = msg.fontSize*ratio+'px '+msg.font
          ctx.fillStyle = '#'+msg.color
          this.canvasTextAutoLine({
            text:msg.text,
            ctx:ctx,
            x:msg.x,
            y:msg.y,
            fillWidth:msg.fillWidth,
            lineHeight:msg.lineHeight
          });
          this.addDrawingRecord(canvasId,msg)
          break
        case 'clearRect':
          ctx.clearRect(0,0,width,height);
          this.addDrawingRecord(canvasId,'clear')
          break
        case 'selectedCanvasId':
          this.addLiveFile(msg)
          break
        case 'slideCanvas':
          domap(this.whiteboard.canvasList,item=>{
            if(item.id == msg.selectedId){
              domap(item.list,(obj,i)=>{
                if(i+1 == msg.current){
                  obj.flag = true
                }
              });
              item.current = msg.current;
              this.whiteboard.state.current = msg.current
            }
          })
          break
        case 'photoProblem':
          let confirmId =  this.$layer.confirm('接收到学生的问题图片，是否展示到白板上？',()=>{
              let id = this.files.list.length;
              let file = {
                id:id,
                fileid:msg.fileid,
                fileType:'img',
                name:msg.filename,
                src:msg.src
              }
              this.files.list.push(file);
              this.addLiveFile(file);
              this.$layer.close(confirmId)
            }
          )
          break
        case 'zoom':
          canvasItem.scale = msg.scale
          break
        case 'grab':
          canvasItem.canvas.x = msg.left * ratio;
          canvasItem.canvas.y  = msg.top * ratio;
          break
      }
    },

    /**
     * 浏览器全屏
     */
    setFullScreen() {
        var el = document.documentElement,
            rfs = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullScreen,
            wscript;
        if(typeof rfs != "undefined" && rfs) {
            rfs.call(el);
            return;
        }

        if(typeof window.ActiveXObject != "undefined") {
            wscript = new ActiveXObject("WScript.Shell");
            if(wscript) {
                wscript.SendKeys("{F11}");
            }
        }
    },
     /**
     * 浏览器退出全屏
     */
    exitFullScreen() {
        var el = document,
            cfs = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullScreen,
            wscript;
    
        if (typeof cfs != "undefined" && cfs) {
          cfs.call(el);
          return;
        }
    
        if (typeof window.ActiveXObject != "undefined") {
            wscript = new ActiveXObject("WScript.Shell");
            if (wscript != null) {
                wscript.SendKeys("{F11}");
            }
      }
    },
    /**
     * 全屏
     */
    fullScreen(){
      if(this.isFullScreen){
        this.exitFullScreen()
        
      }else{
        this.setFullScreen()
      }
      
    },
    /**
     * 登录信令
     */
    login(){
      var appId = liveData.appId,
          SignKey = liveData.SignKey,
          channelName = liveData.channelName;
 
      this.pageLoading.text = '正在加入房间...'
      let signal = Signal(appId);
      session = signal.login(`${this.userInfo.userid}`,SignKey);
  
      /**
       * 信令登录成功
       */
      session.onLoginSuccess = uid=>{
        
        this.pageLoading.text = '加入房间成功';
        this.pageLoading.flag = false;
        this.$layer.msg('登录成功')
        /**
         * 接收点对点消息
         */
        session.onMessageInstantReceive = (account, uid, msg)=>{
          
          msg = JSON.parse(msg);
          switch(msg.action){

            /**
             * 绘制白板
             * @description 此为白板消息，收到后按消息信息绘制\设置白板
             */
            case 'whiteboard':
              this.drawCanvas(msg)
              break
            /**
             * 开始上课
             * @description 听众进入房间，该房间正处于直播状态
             * @description 大班课拉流，非大班课则加入视频直播互动
             */
            case 'classesBegin':
              this.classStatus = 1;
              this.classlevel === 0 ? this.startLivePullFlow() : this.addJoinLive()
              this.sendBillMsg()
              break
            /**
             * 学生进入互动直播
             * @description 教师收到此消息后发起计费请求
             */
            case 'billing':
              this.studentBill(msg.memberid)
              break
            
            /**
             * 获取画布信息
             * @description 教师才会收到此信息，按此信令返回对应画布信息
             */
            case 'getDrawingInfo':
              var drawingRecord = this.whiteboard.drawingRecord[msg.key];
              if(drawingRecord){
                domap(drawingRecord,record=>{
                  session.messageInstantSend(account,JSON.stringify(record))
                })
              }
              
              /**
               * 发送画布位置信息与缩放比例
               */
              let canvasData = this.getSelectedCanvas(msg.key.toString().match(/\d+/)[0]);
              let zoomMsg = this.getWhiteboardBaseMsg(canvasData);
              zoomMsg.type = 'zoom';
              zoomMsg.scale = canvasData.canvasItem.scale;
              session.messageInstantSend(account,JSON.stringify(zoomMsg))

              let grabMsg = this.getWhiteboardBaseMsg(canvasData);
              grabMsg.type = 'grab';
              grabMsg.left = canvasData.canvas.x;
              grabMsg.top = canvasData.canvas.y;
              session.messageInstantSend(account,JSON.stringify(grabMsg))
              break
            case 'media':
              this.handleMedia(msg)
              break
          }
        }
        /**
         * 加入频道
         */
        channel = session.channelJoin(channelName);
        
        /**
         * 加入频道成功
         */
        channel.onChannelJoined = ()=>{
          
          if(this.isTeacher){
            
            /**
             * 定时发送，检测学员在线列表
             */
            this.detectionOnline();

            /**
             * 设置初始白板与白板大小
             */
            this.addLiveFile(this.files.list[0])

          }else{
            
            /**
             * 学生加入，发送新学员加入通知
             */
            this.sendUserMsg(10)

          }
        }
        
        /**
         * 加入频道失败
         */
        channel.onChannelJoinFailed = ecode=>{
         
        }

        /**
         * 离开频道
         */
        channel.onChannelLeaved = ecode=>{
         
        }
        
        /**
         * 监听用户加入
         */
        channel.onChannelUserJoined = (account, uid)=>{
         
          if(`${account}` === `${this.teacherInfo.teacherid}`){
            /**
             * 老师进入房间
             */
            this.$layer.msg('老师进入房间')

          }else{
            /**
             * 监听到学员加入
             * 教师端向新加入学员发送点对点消息，告知当前上课信息
             */
            if(this.isTeacher){
              
              /**
               * 发送白板信息
               * @description 条件：非大班课，因为大班课下无白板
               */
              if(this.classlevel !== 0){
                let canvasItem, selectedCanvasIdMsg = {};
                domap(this.whiteboard.canvasList,item=>{
                  if(`${item.id}` === `${this.whiteboard.selectedCanvasId}`){
                    canvasItem = item;
                  }
                })
                domap(Object.keys(canvasItem),key=>{
                  if(key !== 'width' && key !== 'height' && key !== 'list'){
                    selectedCanvasIdMsg[key] = canvasItem[key]
                  }
                })
                selectedCanvasIdMsg.action   = 'whiteboard';
                selectedCanvasIdMsg.type     = 'selectedCanvasId';
                selectedCanvasIdMsg.canvasId = this.whiteboard.selectedCanvasId;
                session.messageInstantSend(account,JSON.stringify(selectedCanvasIdMsg))
              }

              /**
               * 当前正在播放视频
               */
              if(this.media.selected > 0 && mediaPlayer){
                
                let method = mediaPlayer.getStatus() === 'pause' ? 'pause' : 'completeSeek';
                let mediaMsg = {
                  action:'media',
                  method:method,
                  paramData:mediaPlayer.getCurrentTime(),
                  vid:mediaPlayer.vid,
                  playauth:mediaPlayer.playauth
                }
                session.messageInstantSend(account,JSON.stringify(mediaMsg))  
              }

              /**
               * 发送上课通知
               * @description 条件：该房间正处于上课状态
               */
              if(this.classStatus === 1 ){
                let msgObj = {
                  action:'classesBegin'
                }
                session.messageInstantSend(account,JSON.stringify(msgObj))  
              }
            }
          }

        }
        /**
         * 监测用户离开
         */
        channel.onChannelUserLeaved = (account, uid)=>{
          if(`${account}` === `${this.teacherInfo.teacherid}`){
            if(this.classlevel !== 0){
              /**
               * 所有画布重置
               */
              this.clearAllCanvas()
              /**
               * 切回主白板
               */
              this.whiteboard.selectedCanvasId = 0;
              this.clearMeida();
              if(this.classStatus === 1 && !this.isTeacher){
                this.alert('老师离开了房间，课程结束','下课通知')
                this.classStatus = 0;
                this.unpublish();
                window[`stream${this.teacherInfo.teacherid}`].innerHTML = null;
                
              }else{
                this.$layer.msg('老师离开了房间')
              }
            }
         
          }else{
            this.userLeaved(account)
          }
          
        }
        /**
         * 登录成功获取已在线用户
         */
        channel.onChannelUserList = users=>{ 
          this.getUserListInfo(users)
          
        }
        /**
         * 接收广播
         */
        channel.onMessageChannelReceive = (account, uid, msg)=>{
        
            var msg = JSON.parse(msg);
            
            switch(msg.action){
              /**
               * 收到聊天消息
               */
              case '4':
                var obj = {
                  adddate:msg.adddate,
                  avatar:msg.avatar,
                  interact:msg.content,
                  memberid:msg.memberid,
                  name:msg.username,
                  type:msg.type
                }
                if(msg.type == 1){
                  obj.imgindex = this.previmglist.length
                  this.previmglist.push({
                    src:msg.content,
                    w:null,
                    h:null
                  })
                }
                
                this.chatList.push(obj);
                this.$nextTick(()=>{
                  this.$refs.talkList.scrollTop = this.$refs.talkList.scrollHeight
                  
                })
                break
              /**
               * 开启音频
               */
              case '8':
                if(`${msg.streamId}` === `${this.userInfo.userid}`){
                  localStream.enableAudio();
                  this.isTeacher ? this.$layer.msg('您启用了语音') : this.$layer.msg('老师开启了你的语音')
                }
                this.setMediaStatus(msg.streamId,true,'audio')
                break
              /**
               * 禁止音频
               */
              case '9':
                if(`${msg.streamId}` === `${this.userInfo.userid}`){
                  localStream.disableAudio();
                  this.isTeacher ? this.$layer.msg('您禁用了语音') : this.$layer.msg('老师禁用了你的语音');
                }
                this.setMediaStatus(msg.streamId,false,'audio')
                break
              /**
               * 新学员加入
               */
              case '10':
                var isRepeat = false;
                domap(this.userList,item=>{
                  if(item.memberid == msg.memberid){
                    isRepeat = true;
                  }
                })
                msg.newEntry = true;
                if(!isRepeat && msg.memberid != this.teacherInfo.teacherid){
                  this.userList.push(msg)
                }
                break
              
              /**
               * 收到教师端检测在线情况信令
               * @description 收到后，回复17，告知本人在线
               */
              case '16':
                !this.isTeacher && this.sendUserMsg(17)
                break
              
              /**
               * 匹对在线列表
               */
              case '17':
                onlineUids.push(msg.memberid);
                if(onlineUids.length === 1){
                  setTimeout(()=>{
                    domap(this.userList,item=>{
                      let isHaveThisStudent = false;
                      domap(onlineUids,a=>{
                        if(item.memberid == a){
                          isHaveThisStudent = true
                        }
                      })
                      if(!isHaveThisStudent && !item.newEntry){
                        this.userLeaved(item.memberid)
                      }else{
                        item.newEntry = false
                      }
                      
                    })
                    onlineUids = new Array();
                    this.isTeacher && this.detectionOnline()
                  },2000)
                }
                break
              /**
               * 学员举手
               */
              case '20':
                domap(this.streamList,item=>{
                  if(`${item.userid}` === `${msg.memberid}`){
                    item.putUpHands = true
                  }
                })
                break
              /**
               * 学员松开举手
               */
              case '21':
                domap(this.streamList,item=>{
                  if(`${item.userid}` === `${msg.memberid}`){
                    item.putUpHands = false
                  }
                })
                break
              /**
               * 开启指定视频流
               */
              case '22':
                if(`${msg.streamId}` === `${this.userInfo.userid}`){
                  localStream.enableVideo()
                  this.isTeacher ? this.$layer.msg('您开启了视频') : this.$layer.msg('老师开启了你的视频');
                }
                this.setMediaStatus(msg.streamId,true,'video')
                break

              /**
               * 关闭指定视频流
               */
              case '23':
                if(`${msg.streamId}` === `${this.userInfo.userid}`){
                  localStream.disableVideo()
                  this.isTeacher ? this.$layer.msg('您关闭了视频') : this.$layer.msg('老师关闭了你的视频');
                }
                this.setMediaStatus(msg.streamId,false,'video')
                break

              /**
               * 接收到白板消息
               */
              case 'whiteboard':
                /**
                 * 如果是自己发送到绘图消息，则不接收
                 */
                if(`${account}` !== `${this.userInfo.userid}`){
                  this.drawCanvas(msg)
                }
                break
              /**
               * 白板授权
               */
              case 'whiteboardAuthorization':
                if(`${msg.authorizedUserId}` === `${this.userInfo.userid}`){
                  msg.flag ? this.$layer.msg('老师允许了你使用白板') : this.$layer.msg('老师禁止了你使用白板')
                  this.whiteboard.toolFlag = msg.flag;
                  this.setPageArea()
                };
                domap(this.userList,user=>{
                  if(`${user.memberid}` === `${msg.authorizedUserId}`){
                    user.whiteboardPermission = msg.flag;
                  }
                })
                
                break
              
              /**
               * 播放媒体设备
               */
              case 'media':
                this.handleMedia(msg)
                break

              /**
               * 开始上课
               */
              case 'classesBegin':
                this.classStatus = 1;
                /**
                 * 大班的情况下，学员拉流
                 * 非大班情况，学员加入视频直播
                 * 
                 */
                if(this.isTeacher){
                  this.time = 0;
                  this.timing()
                }else{
                  this.classlevel === 0 ? this.startLivePullFlow() : this.addJoinLive();
                  this.sendBillMsg()
                }
                break
              /**
               * 下课
               */
              case 'getOutOfClass':
                this.classStatus = 0;
                if(this.isTeacher){
                  this.time = null;
                  this.timeStr = '00:00:00';
                  if(this.classlevel === 0){
                    this.stopPushing();
                  }else{
                    this.unpublish()
                  }
                  
                }else{
                  this.alert('同学们，下课啦～','下课通知')
                  this.classlevel !== 0 && this.unpublish()
                }
                break
 
            }
          }
      }

      /**
       * 信令登录失败
       */
      session.onLoginFailed = ecode=>{
        this.$layer.msg('登录失败，正在重连...')
        this.login()
      }
      /**
       * 信令退出，如果老师信令断开，将通知下课
       */
      session.onLogout = ecode=>{
        if(this.isTeacher && this.classStatus === 1){
          this.setClassStatus()
        }
        let msg = this.isTeacher ? '检测到您的信令断开了，这将影响您的教学，是否立即重连？' : '同学，你的信令断开了哦，这将影响到你的学习，是否立即重连？';
        this.$layer.confirm(msg,()=>{
          location.reload()
        })
      }

    },
    /**
     * 老师开始上课，开始计费
     */
    startBilling(){
      if(this.classStatus !== 1){
        return false
      }
      setTimeout(()=>{
        this.billingTime++;
        if(this.billingTime >= 60){
          request(ApiUrl+'Live.liveContinue',{
            wxid:config.wxid,
            userid:config.userid,
            classid:config.classid,
            logid:logid
          },res=>{
            if(res.liveContinue.result === 'insufficient'){
              this.alert('您的连麦币余额不足，请先充值！');
              this.setClassStatus()
            }else{
              this.billingTime = 0;
              this.balance = res.liveContinue.balance;
              this.alreadyConsumed = res.liveContinue.cost;
              this.startBilling()
            }
          },'json')
        }else{
          this.startBilling()
        }
      },1000)
      
    },
    /**
     * 学生进入视频互动，准备计费（由学生发给教师）
     */
    sendBillMsg(){
      if(!this.isTeacher){
        this.sendMsgToTeacher({
          action:'billing',
          memberid:this.userInfo.userid
        })
        
      }
    },
    /**
     * 学生离开视频互动，结束计费
     */
    studentEndBilling(memberid){
      request(`${ApiUrl}Live.leaveStudent`,{
        wxid:config.wxid,
        channelName:liveData.channelName,
        memberid:memberid,
        classid:config.classid,
        logid:logid
      },res=>{
        if(res.leaveStudent.result !== 'success'){
          this.alert('学生结束连麦计费接口出错')
        }
      },'json')
    },
    /**
     * 学生进入视频互动，开始计费
     */
    studentBill(memberid){
      request(`${ApiUrl}Class.lianmaibagain`,{
        wxid:config.wxid,
        channelName:liveData.channelName,
        memberid:memberid,
        classid:config.classid,
        logid:logid
      },res=>{
        if(res.lianmaibagain.result !== 'success'){
          this.alert('学生连麦计费接口出错')
        }
      },'json')
    },
    /**
     * 提示窗口
     */
    alert(msg,title){
      this.$layer.closeAll();
      this.$layer.alert(msg,{
        title:title || '出错了'
      })
    },
    /**
     * 计时
     */
    timing(){
      setTimeout(()=>{
        if(typeof this.time === 'number'){
          this.time++;
          this.getTime();
          this.timing()
        }
      },1000)
    },
    /**
     * 获取时间
     */
    getTime(){
      let hour = Math.floor(this.time / 3600);
      let minute = Math.floor((this.time - hour*3600) / 60);
      let second = this.time - hour*3600 - minute*60
      hour = hour.toString().length < 2 ? `0${hour}` : hour
      minute = minute.toString().length < 2 ? `0${minute}` : minute
      second = second.toString().length < 2 ? `0${second}` : second
      this.timeStr = `${hour}:${minute}:${second}`
      
    },
    /**
     * 学员离开
     */
    userLeaved(account){
      /**
       * 删除座位
       */
      domap(this.streamList,(st,i)=>{
        if(`${st.userid}` === `${account}`){
          window[`stream${account}`].innerHTML = null;
          st.userid = null;
          st.username = '待加入'
          
        }
      })
      /**
       * 删除学员
       */
      domap(this.userList,(item,i)=>{
        if(`${item.memberid}` === `${account}`){
          this.userList.splice(i,1)
        }
      })

      if(this.isTeacher && this.classStatus === 1){
        this.studentEndBilling(account);
      }
      
    },
    
    /**
     * 匹对在线学员列表
     */
    detectionOnline(time){
      if(typeof time === 'undefined'){
        time = 16
      }
      setTimeout(()=>{
        time--;
        if(time <= 0){
          this.sendUserMsg(16)
        }else{
          this.detectionOnline(time)
        }
      },1000)
    },
    /**
     * 加入频道，生成client对象
     * @param {Function} 成功回调
     */
    join(rosolve){
      let userid = parseInt(this.userInfo.userid);
      client = AgoraRTC.createClient({mode: "live", codec: "h264"})
      client.init(liveData.appId,()=> {
        client.join(liveData.channelKey, liveData.channelName, userid, account=> {
          typeof rosolve === 'function' && rosolve(account)
        })
      })
    },
    whiteboardAuthorization(item){
      if(this.isTeacher){
        let flag = item.whiteboardPermission ? false : true;
        this.sendUserMsg('whiteboardAuthorization',{
          authorizedUserId:item.memberid,
          flag:flag
        })
      }
    },
    /**
     * 加入互动直播
     */
    addJoinLive(rosolve,reject){
      
      /**
       * 检查是否已有本地stream事件，避免重复加入
       */
      if(localStream){
        localStream.play('stream'+this.userInfo.userid);
        client.publish(localStream)
        return false   
      }
      
      this.join(account=>{
        
        this.createLocalStream(account,localStream=>{
          //播放本地视频流
          localStream.play('stream'+account);
          //推流
          client.publish(localStream);
          
        },fail=>{
          typeof reject === 'function' && reject()
        })
        /**
         * 已成功推流
         */
        client.on('stream-published', evt=> {
          typeof rosolve === 'function' && rosolve()
        })

        /**
         * 监听流（用户）加入频道事件
         */
        client.on('stream-added', evt=> {
          let stream = evt.stream,
              uid = stream.getId()
          // 收到流加入频道的事件后，先判定是不是本地的
          if(`${uid}` !== `${this.userInfo.userid}`) {

            if(this.streamList.length < 8){
              client.subscribe(stream);
            }else{
              let isHaveSeat = false;
              domap(this.streamList,item=>{
                if(item.userid === null){
                  isHaveSeat = true
                }
              });

              isHaveSeat && client.subscribe(stream)

            }
            
          }
        })

        /**
         * 通知应用程序已接收远程音视频流
         */
        client.on('stream-subscribed', evt=> { 
          let stream = evt.stream; 
          let uid = stream.getId();
          
          /**
           * 教师视频流直接播放即可，而非教师视频流需判断播放器显示位置
           */
          if(`${uid}` === `${this.teacherInfo.teacherid}`){
            this.teacherInfo.audio = true;
            this.teacherInfo.video = true;
            stream.play(`stream${uid}`)
          }else{

            /**
             * 第一步，先检测远程视频流之前是否加入过
             */
            let isHaveMySeat = false;
            domap(this.streamList,item=>{
              if(`${item.userid}` === `${uid}`){
                isHaveMySeat = true;
              }
            })

            /**
             * 第二步，如果加入过，则直接播放，否则检查是否有空座位
             */
            if(isHaveMySeat){
              stream.play(`stream${uid}`)
            }else{
              let isHaveSeat = false, seat;
              //霸占座位
              for(var i=0;i<this.streamList.length;i++){
                if(this.streamList[i].userid === null){
                  isHaveSeat = true;
                  seat = this.streamList[i];
                  break
                }
              }
              
              if(isHaveSeat){
                seat.userid = uid;
                this.getUserInfo(uid,info=>{
                  seat.username = info.username
                })

              }else{

                /**
                 * 无座位，自己搬把椅子
                 */
                this.getUserInfo(uid,info=>{
                  this.streamList.push(
                    {
                      username:info.username,
                      userid:uid,
                      video:true,
                      audio:false,
                      putUpHands:false
                    }
                  )
                })
              }

              /**
               * 播放音视频流
               */
              this.playStream(stream,`stream${uid}`)
            }
          }
        });
        /**
         * 对方用户已开启语音通话静音
         */
        client.on('mute-audio', evt=> {
          this.setMediaStatus(evt.uid,false,'audio')
        });
        
        /**
         * 对方用户已取消语音通话静音
         */
        client.on('unmute-audio', evt=> {
          this.setMediaStatus(evt.uid,true,'audio')
        });

        /**
         * 对方用户已关闭视频
         */

        client.on('mute-video', evt=> {
          this.setMediaStatus(evt.uid,false,'video')
        });

        /**
         * 对方用户已开启视频
         */
        client.on('unmute-video', evt=> {
          this.setMediaStatus(evt.uid,true,'video')
        });
        
        
        /**
         * 接收到用户离开
         */
        client.on('peer-leave', evt=> {
          
        });
        
        /**
         * 该回调通知应用程序已删除远程音视频流
         */
        client.on('stream-removed', evt=> {
          let stream = evt.stream;
          let uid = stream.getId();
          window[`stream${uid}`].innerHTML = null;
          if(`${uid}` === `${this.teacherInfo.teacherid}`){
            /**
             * 老师意外断开了，直接下课，并断开本地音视频上传
             */
            if(this.classStatus === 1){
              this.classStatus = 0;
              this.unpublish();
              this.alert('系统检测到老师断开的连接，中断上课','下课提示');
            }

          }else{

            /**
             * 删除座位用户
             */
            domap(this.streamList,(st,i)=>{
              if(`${st.userid}` === `${uid}`){
                st.userid = null;
                st.username = '待加入'
              }
            })

            /**
             * 结束计费
             */
            if(this.isTeacher){
              this.studentEndBilling(uid)
            }
          }

        }) 
      })
    },
    /**
     * 设置媒体状态
     */
    setMediaStatus(uid,flag,type){
      if(`${uid}` === `${this.teacherInfo.teacherid}`){
        this.teacherInfo[type] = flag
      }else{
        domap(this.streamList,item=>{
          if(`${uid}` === `${item.userid}`){
            item[type] = flag
          }
        })
      }

    },

    /**
     * 播放音视频流
     * @param {Object} 
     * @param {String}
     */
    playStream(stream,id){
      if(window[id]){
        stream.play(id)
      }else{
        setTimeout(()=>{
          this.playStream(stream,id)
        },100)
      }
    },

    /**
     * 停止推流
     */
    stopPushing(){
      if(!localStream){
        return false
      }
      localStream.stop();
      client.unpublish(localStream);
      client.stopLiveStreaming(this.pushUrl)
    },
    /**
     * 取消上传本地音视频流
     */
    unpublish(){
      if(!localStream){
        return false
      }
      localStream.stop();
      client.unpublish(localStream);
    },
    /**
     * 创建本地音视频流
     */
    createLocalStream(account,rosolve,reject){
      
      localStream = AgoraRTC.createStream({
        streamID:account,
        audio: true, 
        video: true
      });
      
      /**
       * 初始化
       */
      localStream.init(()=> {
        
        if(this.isTeacher){
          this.teacherInfo.audio = true;
          this.teacherInfo.video = true
        }else{
          
          //如果非教师端，则默认禁言
          localStream.disableAudio();
          this.streamList[0].video = true;
          this.streamList[0].username = this.userInfo.username;

        }
        typeof rosolve === 'function' && rosolve(localStream)

      },err=>{
        this.alert('无法访问您的媒体资源，请先检查您的媒体设备');
        typeof reject === 'function' && reject('creation failed')
      });
      localStream.on("accessDenied", ()=>{
        this.alert('获取本地摄像头／麦克风权限失败！');
        typeof reject === 'function' && reject('creation failed')
      })
    },
    /**
     * 开始直播推流（旁路推流，用于大班课）
     * @param {Function} 成功推流后回调函数
     */
    startLivePushing(rosolve,reject){
      if(localStream){
        localStream.play('id_video_container');
        client.publish(localStream);
        return false
      }
      this.join(account=>{
        this.createLocalStream(account,localStream=>{
          localStream.play('id_video_container');
          client.publish(localStream);
          
        },err=>{
         
          typeof reject === 'function' && reject()
        })

        /**
         * 已成功推流
         */
        client.on('stream-published', evt=> {
          
          /**
           * 开始旁路推流
           */
          client.setLiveTranscoding({
            width: this.container.width,
            height: this.container.height,
            videoBitrate: 400,
            videoFramerate: 15,
            lowLatency: true,
            audioSampleRate: AgoraRTC.AUDIO_SAMPLE_RATE_48000,
            audioBitrate: 48,
            audioChannels: 1,
            videoGop: 30,
            videoCodecProfile: AgoraRTC.VIDEO_CODEC_PROFILE_HIGH,
            userCount: 1,
            userConfigExtraInfo: {},
            backgroundColor: 0x000000,
            transcodingUsers: [{ uid: evt.stream.getId(), x: 0, y: 0, width: this.container.width, height: this.container.height, zOrder: 100, alpha: 1.0, }]
          });
          client.startLiveStreaming(this.pushUrl,true);
          typeof rosolve === 'function' && rosolve()
        })
      })
    
    },
    /**
     * 开始直播拉流（学生）
     */
    startLivePullFlow(){

      this.join(account=>{
        client.on('stream-added', evt=> {
          if(myQcVideo){
            myQcVideo.play()
            return false
          }
          //加载直播视频
          var live_connect = document.createElement('script');
          live_connect.src = '/Public/qcVideo/live_connect.js';
          document.head.appendChild(live_connect);
          live_connect.onload = ()=>{
            live_connect.outerHTML = null;
            myQcVideo = new qcVideo.Player("id_video_container", {
              "live_url" : liveData.playUrl.m3u8,
              "live_url2" : liveData.playUrl.flv
            });
            myQcVideo.play()

          }
        })

      })
    },
    /**
     * 设置媒体开关，仅允许教师操作
     */
    setMediaSwitch(type,item){
      if(!this.isTeacher){
        return false
      }
      
      let uid = item.userid || item.teacherid;
      if(`${uid}` === `${this.teacherInfo.teacherid}`){
        
        if(this.teacherInfo[type]){
          this.sendUserMsg(this.getMediaTypeSig(type,false),{
            streamId:uid
          })
        }else{
          this.sendUserMsg(this.getMediaTypeSig(type,true),{
            streamId:uid
          })
        }
      }else{

        domap(this.streamList,item=>{
          if(`${item.userid}` === `${uid}`){
            if(item[type]){
              this.sendUserMsg(this.getMediaTypeSig(type,false),{
                streamId:uid
              })
            }else{
              this.sendUserMsg(this.getMediaTypeSig(type,true),{
                streamId:uid
              })
            }
          }
        })
      }
    },
    getMediaTypeSig(type,flag){
      let sig;
      switch(type){
        case 'video':
          sig = flag ? 22 : 23
          break
        case 'audio':
          sig = flag ? 8 : 9
          break
      }
      return sig
    },
    
    /** 
     * 获取学员信息
     * @param {String}
     * @param {Function} 回调函数
     */
    getUserInfo(userid,fn){

      request(ApiUrl2+'studentlist',{
        wxid:config.wxid,
        memberids:userid
      },res=>{
        typeof fn === 'function' && fn(res[0])
      },'json')
    },
    /** 
     * 获取学员信息
     * @param {Object} 
     */
    getUserListInfo(users){
      
      if(!users){
        return false
      }
      var memberid = new Array();
      
      domap(users,item=>{
        memberid.push(item[0]);
      })
      var memberids = memberid.join(',');  
      request(ApiUrl2+'studentlist',{
        wxid:config.wxid,
        memberids:memberids
      },res=>{
        
        domap(res,(item,i)=>{
          var isRepeat = false;
          domap(this.userList,obj=>{
            if(`${obj.memberid}` === `${item.memberid}`){
              isRepeat = true
            }
          })
          if(!isRepeat && `${item.memberid}` !== `${this.teacherInfo.teacherid}`){
            item.putUpHands = false;
            item.whiteboardPermission = false;
            this.userList.push(item)
          }
        })
        
      },'json')
    },
    /**
     * 触发ctrl+enter键发送
     */
    sendTextKeypress(e){
      if(e.keyCode === 10){
        this.send()
      } 
      
    },
    /**
     * 发送聊天消息 
     */
    send(){
      if(!this.sendContent.replace(/\s+/g,'')){
        sendText.focus();
        this.sendContent = '';
        return false
      }
      /**
       * @param Number 发送消息或提问的类别 0文字 1图片
       * @param String 消息内容
       */
      this.sendChatMsg(0,this.sendContent)    

    },

    /**
     * 发送聊天消息
     */
    sendChatMsg(msgType,content){
      
      request(ApiUrl2+'chatKeep2',{
	  		type:msgType,
        moduleType:1,
        title:content,
        viewid:config.classid,
        chapterid:config.chapterid,
        wxid:config.wxid,
        memberid:this.userInfo.userid,
        username:this.userInfo.username
	  	},res=>{
        if(res.result === 'success'){
          this.sendContent = null;
          this.sendUserMsg(4,{
            adddate:res.adddate,
            type:msgType,
            content:content,
            interactid: res.interactid
          })
          
        }else{
          this.$layer.msg(res)
        }
       
	  	},'json')
    },
    /**
     * 设置课程状态 (上课、下课)
     */
    setClassStatus(){
      
      switch(this.classStatus){
        case 0:
          /**
           * 请求当前余额信息
           * @description 余额必须大于0，才可开始上课
           */
          if(!liveData.channelName){
            return false
          }
          this.loading = true;
          request(ApiUrl+'Live.classBegins',{
            wxid:config.wxid,
            channelName:liveData.channelName,
            userid:config.userid,
            classid:config.classid
          },res=>{
            
            let classBegins = res.classBegins;
            logid = classBegins.logid;
            if(typeof classBegins.balance !== 'undefined' && typeof classBegins.starter !== 'undefined'){
              if(parseInt(classBegins.balance) > parseInt(classBegins.starter)){
                
                /**
                 * 当前余额满足上课需求，通知开始上课
                 */
                this.balance = classBegins.balance;
                this.alreadyConsumed = 0;
                if(this.classlevel == 0){
                  this.startLivePushing(()=>{
                    this.classStatus = 1;
                    this.sendUserMsg('classesBegin');
                    this.startBilling();
                    this.loading = false
                  
                  },fail=>{
                    this.loading = false
                  })
                }else{
                  this.addJoinLive(()=>{
                    this.classStatus = 1;
                    this.sendUserMsg('classesBegin');
                    this.startBilling();
                    this.loading = false
                  },fail=>{
                    this.loading = false
                  })
                }
                
 
              }else{
                this.alert('您的连麦币余额不足，请先充值！')
                this.loading = false
              }
            }else{
              this.alert('接口错误')
              this.loading = false
            }
            
          },'json')
          
          break
        case 1:
          /**
           * 通知下课
           */
          this.sendUserMsg('getOutOfClass');
          
          request(`${ApiUrl}Live.ClassIsOver`,{
            wxid:config.wxid,
            userid:this.teacherInfo.teacherid,
            classid:config.classid,
            channelName:liveData.channelName,
            logid:logid
          },res=>{
            if(typeof res === 'object' && res.ClassIsOver.result === 'success'){
              //执行成功
            }else{
              this.alert('接口错误')
            }
          },'json')
          break
      }
    },
    /**
     * 发送频道消息附带个人信息
     */
    sendUserMsg(action,data){
      var msg = {
        action:action.toString(),
        memberid:this.userInfo.userid,
        username:this.userInfo.username,
        avatar:this.userInfo.avatar
      }
      if(typeof data === 'object'){
        var keys = Object.keys(data);
        domap(keys,k=>[
          msg[k] = data[k]
        ])
      }
      channel.messageChannelSend(JSON.stringify(msg))
    },
    /**
     * 图片加载完成
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
     * 获取聊天记录
     * @param {Function} 回调函数
     */
    getChatList(resolve){
      if(this.interactid === 'nomore'){
        return false
      }
      this.pageLoading.text = '正在获取聊天数据...'
      this.chatState = '正在加载'
      var flag = this.interactid ? true : false;
      request(ApiUrl2+'getKeepChat',{
        viewid: config.classid,
        moduleType:1, //0课程 1班级
        chapterid:config.chapterid,
        wxid:config.wxid,
        interactid:this.interactid
      },res=>{

        if(res.interactid){
          this.interactid = res.interactid
          this.chatState = '查看更多消息'
        }else{
          this.interactid = 'nomore'
          this.chatState = '已全部加载完'
        }
        
        domap(res.chat,item=>{
          if(item.type == 1){
            item.imgindex = this.previmglist.length;
            this.previmglist.push({
              src:item.interact,
              w:null,
              h:null
            })
          }
        });
        
        if(!flag){
          this.chatList = res.chat;
          this.$nextTick(()=>{
            this.$refs.talkList.scrollTop = this.$refs.talkList.scrollHeight
            
          })
        }else{
          var prevHeight = this.$refs.talkList.scrollHeight;
          
          domap(res.chat,(item,i)=>{
            this.chatList.unshift(res.chat[res.chat.length-i-1])
          })
          this.$nextTick(()=>{
            var nowHeight = this.$refs.talkList.scrollHeight;
            this.$refs.talkList.scrollTop = nowHeight - prevHeight
            
          })
          
        }
        typeof resolve === 'function' && resolve();
      },'json')

    }
  }
}



</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.loading{width: 100px;height: 100px; background: #fff url(../assets/img/loading.gif) no-repeat 50% 50%; background-size: 50px 50px; position: absolute;left:50%;top:50%;margin-left:-50px;margin-top:-50px; z-index: 99; border-radius: 10px;}

.class-loading{ width: 100%; height: 100%; position: fixed;left:0;top:0; text-align: center; background: #0e1215; z-index: 1000;}
.class-loading .text{ position: absolute;top:50%; margin-top:-100px; color: #fff; width: 100%; font-size: 30px}

.progress{ position: absolute;left:50%;top:50%; width: 200px; margin-left:-100px;margin-top:-60px; background: rgba(0, 0, 0, 0.3); z-index: 100; border-radius: 5px;color:#fff; text-align: center; line-height: 24px; padding: 20px; font-size: 14px;}

.progress-bar{height: 6px; background: rgba(0, 0, 0, 0.2); position: relative;border-radius: 6px; margin-bottom:5px;}
.progress-completed{ border-radius:6px; height: 6px; background: #fff; width: 20%; position: absolute;left:0;top:0;}

/*窗口*/
.popup-iframe{ position: relative;}
.popup-gray-bg{width: 100%;height: 100%; position: fixed; left:0;top:0; z-index: 9; background: rgba(0, 0, 0, 0.3)}
.popup-open{background: #fff;border-radius: 6px;width: 700px; height: 370px;margin-left:-350px;margin-top:-185px; position: fixed;left:50%;top:50%; z-index: 10;}
.popup-title{ padding: 0 15px; font-size:18px; color:#666; height: 50px; line-height: 50px;}
.popup-close{position: absolute;right:0;top:0;width:50px;height:50px; line-height: 50px; text-align: center; color:#999; cursor: pointer; font-size: 24px; font-family: simsun}
.popup-close:hover{ color:#e1341f;}
.popup-open .popup-iframe{ height: 320px;}
.popup-open iframe{border:0px; position: absolute;width: 100%; height: 100%;border: 0px; }

/*全屏*/
.fullScreen .header,
.fullScreen .wrapper .right,
.fullScreen .student-video-list{display: none}

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

.wrapper,
.container,
.whiteboard{ position: relative; overflow: hidden;}
.wrapper{ background: #edf2f5; }
.wrapper .student-operating{ position: absolute;right: 10px;bottom: 10px;}
.wrapper .student-operating i{ width:40px;height: 40px;float: left; text-align: center; line-height: 40px;font-size: 24px; cursor: pointer; }
.wrapper-pl{padding-left: 60px;}

#id_video_container{ background: #000}


/*画布*/
.whiteboard-img{position: absolute;left: 0;top:0; width: 100%; height: 100%;}
.whiteboard-canvas{ position: relative;background: #fff}
.whiteboard-img canvas{ position: absolute;left: 0;top:0; z-index: 1;}

.whiteboard-tips{ position: absolute;width:150px;bottom:20px; left:50%;height: 22px; line-height: 22px;background: rgba(0,0,0,0.4);color:#fff; z-index: 9; text-align: center;border-radius: 4px; margin-left: -75px;}
.whiteboard-line-y{width: 0px; height: 100%; position: absolute;left:0;top:0;border-left:1px dashed #e6412d; z-index: 9;}

.whiteboard-line-x{width: 100%; height: 1px; position: absolute;left:0;top:0;border-top:1px dashed #e6412d; z-index: 9;}




.select-color{width: 240px;height: 270px; background: #1f242a; position: absolute;left:60px;top:0; text-align: left; padding: 10px; z-index: 9; line-height: 22px;}
.select-color .name{ margin-bottom: 10px;}
.select-color .size-list{ height: 50px;}
.select-color .size-list span{width: 30px; height: 30px; float:left;margin: 0 10px; box-sizing: border-box; position: relative; }
.select-color .size-list .on{border: 1px solid #e6412d;}
.select-color .size-list i{  background: #fff; border-radius: 50%; position: absolute;left:50%;top:50%;}
.select-color .color-list span{width: 12px;height: 12px;float: left;border:1px solid #1f242a;margin:-1px -1px 0 0;}

.header{height:60px; background: #14191d; color:#fff; }
.header-logo{ position: absolute;left:20px;top:14px;height: 32px;}
.header .btn{width: 130px;height:38px; background: #de341f;color:#fff; text-align: center;border-radius: 4px; line-height: 38px; position: absolute;left:0;top:1px;font-size: 14px; cursor: pointer;}

.header-left{ position: absolute;left:180px;top:10px; width:240px; padding-left: 150px;}
.header-left .time{ line-height:20px;font-size: 14px;}
.header-left .btn-start{background: #e6412d}
.header-left span{font-size: 12px;}
.header-left .btn-share-whiteboard{left: 140px;}
.header .title{line-height: 60px;text-align: center;font-size: 14px;}

.header .staus{ position: absolute;left:180px;top:0; line-height: 60px; font-size: 14px; color:#fff; padding-left: 15px;}
.header .staus .un::after{content: '';width: 6px;height: 6px; background: #fff; position: absolute;left:0;top:50%;margin-top:-3px;border-radius: 50%;}
.header .staus.on{background: url(../assets/img/zhibo.gif) no-repeat 0 45%; padding-left:30px;}

.header .icon-menu{ position: absolute;right:20px;top:0; line-height: 60px;}
.header .icon-menu span{width: 60px;height: 60px; cursor: pointer;float:left; text-align: center}
.header .icon-menu i{font-size: 22px;}



/*左侧工具栏*/
.tool-mask,
.tool{width:60px;height: 100%; position: absolute;left:0;top:0;}
.tool{ background: #1a1a1a; z-index: 90;}
.tool-mask{ z-index: 99;}
.tool .icon-wrap{top: 50%; position: absolute;width: 100%;left:0;top:150px;margin-top:-105px;}
.tool .icon-wrap .color{ width: 18px;height: 18px; position: absolute;left:50%;top:50%;margin-top: -9px;margin-left: -9px;}
.tool .icon-item{height: 70px; display: block; text-align: center; line-height: 70px; cursor: pointer;color:#fff; position: relative;}
.tool .icon-item:hover,
.tool .icon-item.hover,
.tool .on{ background: #1f242a;}
.tool .icon-item i{font-size:22px;}

.canvas-state{height: 50px; overflow: hidden;font-size:18px; text-align: center; line-height: 50px; position: relative;}
.canvas-state .button{ position: absolute;height: 36px; line-height: 36px; background: #e6412d; color: #fff; width: 110px;  text-align: center;right: 15px;border-radius:3px;top:50%;margin-top:-18px; font-size: 14px; cursor: pointer;}
.canvas-state .button_on,
.canvas-state .button:hover{background: #e1341f}
.canvas-state .tool-wrap{ display: inline-block}
.canvas-state .teacher-tool-wrap .icon-bt,
.canvas-state .icon-full-bt{ cursor: pointer;}

.canvas-state span{float:left;}
.canvas-state span i{font-size: 18px;}
.canvas-state .icon-full_screen{ font-size: 22px}
.canvas-state .icon-bt{ width: 36px; height: 36px; line-height: 36px; border-radius: 4px;margin: 7px 5px 0 5px;}
.canvas-state .teacher-tool-wrap .icon-bt:hover,
.canvas-state .icon-full-bt:hover,
.canvas-state .icon-bt.on{ background: #d8e0e4}
.canvas-state-black{background: #212429;color: #fff}
/*选择在线文件*/
.live-data-list{ position: absolute;left:60px;top:60px; background: #1e2126;width: 300px; height: 100%; z-index: 80; }
.live-data-list .list{
  overflow-x: hidden;
  overflow-y: auto
}
.live-data-list .title{height: 40px; line-height: 40px;border-bottom: 1px solid #2d3037; color: #e1e3e4;padding: 0 15px;font-size: 14px;}
.live-data-list li{ height: 50px; line-height: 50px; padding: 0 10px 0 50px; color:#e4e7e7; overflow: hidden;background-repeat: no-repeat; background-position: 15px 50%; cursor: pointer;}
.live-data-list li .opr{float:right}
.live-data-list li .opr i{cursor: pointer; display: block; width: 30px; float: left; text-align: center}
.live-data-list li .opr i:hover{color:#e6412d}
.live-data-list li.blank{ background-image: url(../assets/img/blank.png);}
.live-data-list li.img{ background-image: url(../assets/img/img.png);}
.live-data-list li.word{background-image: url(../assets/img/word.png);}
.live-data-list li.pdf{background-image: url(../assets/img/pdf.png);}
.live-data-list li.media-file{background-image: url(../assets/img/media.png);}
.live-data-list li.media-file0{background-image: url(../assets/img/none.png);}

.live-data-list li:hover,.live-data-list li.on {background-color: #14191d}
.live-data-list li .icon-yanjing{ font-size: 18px; color:#5f6871;}
.live-data-list li.on .icon-yanjing,
.live-data-list li.on .icon-yanjing:hover{color: #e4e7e7}
.live-data-list li.on .icon-shanchu:hover,
.live-data-list li.on .icon-shanchu{color:#5f6871; cursor: no-drop}

.live-data-list .foot{ position: absolute;bottom:15px;left:0;width: 100%; text-align: center}
.live-data-list .foot-inline{ display: inline-block;}
.live-data-list .foot .button{width:124px;height: 40px; background:#e6412c; color:#fff; text-align: center; line-height: 40px; float:left; border-radius: 4px; margin:0 6px; cursor: pointer;}
.live-data-list .foot .button:hover{ background: #de341f}

/*白板文本输入*/
.filltext{position: fixed;left:0;top:0; resize:none; z-index: 1; background: none;border:0px; overflow: hidden; white-space: nowrap;border:1px dashed #000}
.filltext:focus{ background: #fff; outline: none;}

/*教师信息*/
.wrapper .right{width: 320px;height: 100%; position: absolute;right:0;top:0; background: #1f242a; box-sizing: border-box;padding: 10px}
.wrapper .right .user{height: 300px; overflow: hidden; position: relative; margin-bottom: 10px}
.wrapper .right .user img{height: 100%;width:100%;}
.wrapper .right .user .state{ position: absolute; width: 100%; bottom: 0; left: 0; background: rgba(0,0,0,0.6);height: 30px; line-height: 30px; box-sizing: border-box; padding: 0 10px; color: #fff; font-size: 14px; z-index: 9;}

.wrapper .right .user .state-icon{ float: right}
.wrapper .right .user .state-icon i{width: 24px;height: 24px; text-align: center; line-height: 24px;margin-top:3px; color:#30a2e9; float:left; font-size:18px}
.wrapper .right .user .state-icon .dis{color:#999}
.wrapper .right .user .state-icon-opr i{cursor: pointer;}
.wrapper .right .user .state-icon-opr i:hover{background: rgba(0,0,0,0.4);border-radius: 4px;}


.wrapper .right .user-stream{ width: 100%; height: 100%; position: absolute;left:0;top:0;}


.title-tab{height: 36px; line-height: 36px; background: #2a343e;text-align: center;color:#fff;font-size: 14px;}
.title-tab li{width: 50%;float:left;  cursor: pointer;}
.title-tab .on{color: #fff;background: #151a20}

/*聊天区域*/

.load-more{ text-align: center; line-height:34px; color: #5f6871}
.load-more span{ cursor: pointer;}

.talk-list,
.student-list{background: #151a20;
  overflow-y: auto
} 
.talk .item{padding:10px 15px; }
.talk .item .name{height: 24px; line-height: 24px; overflow: hidden; color: #30a2e9}
.talk .item .info{float:left; padding:3px 10px; background: #30a2e9;color:#fff;border-radius: 4px; line-height: 24px;}
.talk .item .img-info{max-width:60%;}
.talk .item .info img{ max-width: 100%; display: block;}
.talk .item .img-info{padding: 4px;}
.talk .item.me .name{ text-align: right}
.talk .item.me .info{float: right}

.talk .time{ text-align: center; color: #5f6871;}

.sendbox{ background: #151a20; position: relative;}
.sendbox textarea{width: 100%;height: 60px; box-sizing:border-box; background: none;border:0px; padding: 10px 80px 10px 10px;color:#bfc0c4; resize: none; overflow: hidden;}
.sendbox .btn{width: 80px; border-left: 1px solid #4c5155;height:40px; position: absolute;right:0;top:50%;margin-top:-20px;font-size: 14px; text-align: center; line-height: 40px; color:#bfc0c4; cursor: pointer;}

.send-emotion{ position: absolute;width:100%;border-radius:6px;bottom: 40px;left: 0; background: #fff; z-index: 9; overflow: hidden;}

.send-menu{border-top:1px solid #1f242a;height: 40px; line-height: 40px; color: #6d757d;position: relative;}
.send-menu span{float: left;margin:0 7px; cursor: pointer;}
.send-menu span i{font-size: 20px;}
.send-menu span:hover,
.send-menu .on{color:#fff;}
/*学员列表*/
.user-list ul{padding: 10px;}
.user-list li{height: 28px; line-height:28px; position: relative; overflow: hidden; padding: 10px 0 10px 45px; color:#fff;border-bottom: 1px solid #262b2f;font-size: 14px;margin-top:10px;}
.user-list li:last-child{border-bottom: 0px;}
.user-list li .avatar{width:24px;height: 24px;border-radius: 50%; position: absolute;left:10px;top:12px;}
.user-list li .avatar img{width: 100%;height: 100%;border-radius: 50%}
.user-list li span{float: right; margin: 0 10px; width: 28px; height: 28px;color: #a2a5aa; text-align: center;border-radius: 4px; }
.user-list li span.btn{background: #2a343e;cursor: pointer;}
.user-list li span.on{color:#fff; background: #e1341f}
.user-list li .whiteboard-share{border:1px solid #a2a5aa}


.student-video-list{ background: #14191d; padding-bottom: 10px}
.student-video-list ul{padding-left: 5px;}
.student-video-list li{ position: relative; float: left; padding-top: 10px}
.student-video-list .jushou{position: absolute;top:0px;right: 10px; z-index: 9; color: #e6412d}
.student-video-list .jushou i{font-size: 24px;}
.student-video-list .avatar{background: #000; overflow: hidden; position: relative; display: block; margin: 0 auto}
.student-video-list .avatar img{height: 100%; width: 100%; display: block; }
.student-video-list .state{ position: absolute; width: 100%; bottom: 0; left: 0; background: rgba(0,0,0,0.6);height: 28px; line-height: 28px; box-sizing: border-box; padding: 0 10px; color: #fff; z-index: 9;}
.student-video-list .state-icon{ float: right}
.student-video-list .state-icon i{width: 22px;height: 22px; text-align: center; line-height: 22px;margin-top:4px; color:#30a2e9; float:left;}
.student-video-list .state-icon .dis{color:#999}
.student-video-list .state-icon-opr i{cursor: pointer;}
.student-video-list .state-icon-opr i:hover{background: rgba(0,0,0,0.4);border-radius: 4px;}

.student-video-list .student_agora{ position: absolute; width: 100%; height: 100%; left: 0;top:0;}

.animate-left-show{
  animation: animateleftshow 0.4s;
  -moz-animation: animateleftshow 0.4s;	/* Firefox */
  -webkit-animation: animateleftshow 0.4s;	/* Safari 和 Chrome */
  -o-animation: animateleftshow 0.4s;	/* Opera */
  transform:translate(0px)
}
@keyframes animateleftshow
{
from {transform:translate(-300px)}
to {transform:translate(0px)}
}

@-moz-keyframes animateleftshow /* Firefox */
{
from {transform:translate(-300px)}
to {transform:translate(0px)}
}

@-webkit-keyframes animateleftshow /* Safari 和 Chrome */
{
from {transform:translate(-300px)}
to {transform:translate(0px)}
}

@-o-keyframes animateleftshow /* Opera */
{
from {transform:translate(-300px)}
to {transform:translate(0px)}
}

.animate-left-out{
  animation: animateleftout 0.4s;
  -moz-animation: animateleftout 0.4s;	/* Firefox */
  -webkit-animation: animateleftout 0.4s;	/* Safari 和 Chrome */
  -o-animation: animateleftout 0.4s;	/* Opera */
  transform:translate(-300px)
}
@keyframes animateleftout
{
from {transform:translate(0px)}
to {transform:translate(-300px)}
}

@-moz-keyframes animateleftout /* Firefox */
{
from {transform:translate(0px)}
to {transform:translate(-300px)}
}

@-webkit-keyframes animateleftout /* Safari 和 Chrome */
{
from {transform:translate(0px)}
to {transform:translate(-300px)}
}

@-o-keyframes animateleftout /* Opera */
{
from {transform:translate(0px)}
to {transform:translate(-300px)}
}

</style>
