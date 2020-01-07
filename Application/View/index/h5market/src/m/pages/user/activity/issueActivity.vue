<template>
  <div class="issue">
    <div class="page">
       <div class="addimg" @click="uploadImg">
      <!-- <ks-image
        src="../../../assets/course-manage/20191125173054.png"
        alt=""
        v-if="!imgurl"
      >
      </ks-image> -->
      <img src="../../../assets/course-manage/20191125173054.png" alt="" v-if="!imgurl">
      <ks-image :src="imgurl" alt="" v-else></ks-image>
    </div>
    <!-- 活动信息 -->
    <div class="msg">
      <p>活动信息</p>
      <ks-list-item title="活动标题">
        <input type="text" placeholder="请选择输入活动标题" class="courseInput" v-model="coursetypes" @focus="onTextInputFocus" @blur="onTextInputBlur">
      </ks-list-item>
      <ks-list-item title="活动主办方">
        <input type="text" placeholder="请选择输入活动主办方" class="courseInput" v-model="coursemain" @focus="onTextInputFocus" @blur="onTextInputBlur">
      </ks-list-item>
      <ks-list-item title="活动地址">
        <input type="text" placeholder="请选择输入活动地址" class="courseInput" v-model="activityWith" @focus="onTextInputFocus" @blur="onTextInputBlur">
        <!-- <img
                    src="../../../assets/course-manage/common_icon_moreinfor.png"
                    alt=""
                    class="course-del-right"
        >-->
      </ks-list-item>
      <ks-list-item title="活动时间">
        <div @click="gotoTime()">
          <span class="pitch">{{times.start}} {{times.end}}</span>
          <img
            src="../../../assets/course-manage/common_icon_moreinfor.png"
            alt=""
            class="course-del-right"
          >
        </div>
      </ks-list-item>
      <!-- <ks-list-item title="活动人数">
                <input type="text" placeholder="若不限制人数,则填0" class="courseInput" v-model="peopleNum">
      </ks-list-item>-->
      <ks-list-item title="活动详情">
        <div class="activitydetail" @click="gotodel()">
          <span class="pitch">{{activityDels == "" ? '请完善' : activityDels}}</span>
          <img
            src="../../../assets/course-manage/common_icon_moreinfor.png"
            alt=""
            class="course-del-right"
          >
        </div>
      </ks-list-item>
    </div>
    <!-- 活动设置 -->
    <div class="msg">
      <p>活动设置</p>
      <ks-list-item title="是否开启保证金" @click="coursetype()">
          <span class="pitch">{{is_pledge==1 ? "开启" : "不开启"}}</span>
          <img
            src="../../../assets/course-manage/common_icon_moreinfor.png"
            alt=""
            class="course-del-right"
          >
      </ks-list-item>
      <ks-list-item title="保证金支付方式" @click="payway()" v-if="is_pledge == 1">
          <span class="pitch">{{payways==1 ? "可以只支付保证金" : "只允许一起付"}}</span>
          <img
            src="../../../assets/course-manage/common_icon_moreinfor.png"
            alt=""
            class="course-del-right"
          >
      </ks-list-item>
      <ks-list-item title="票种设置">
        <div @click="activeset">
          <span class="pitch">{{content.length > 0 ? "已完成" :setting}}</span>
          <img
            src="../../../assets/course-manage/common_icon_moreinfor.png"
            alt=""
            class="course-del-right"
          >
        </div>
      </ks-list-item>
    </div>
    </div>
    <div class="couresbtn">
      <ks-button type="white" width="48%" @click="save()">保存为草稿</ks-button>
      <ks-button type="success" width="48%" @click="issave=true,send()">立即发布</ks-button>
    </div>
    <van-popup v-model="show" position="right" :style="{ width: '100%',height:'100%'}"  :overlay='false'>

      <activity-select :id='$route.query.id' :activitytime="timestamp"  v-if="isshow == 1" @activityCon="getlist" :payway="is_pledge" :is_pledge="is_pledge" />
     
      <acitvity-time v-else-if="isshow == 2" :starttimes='timestamp.start' :endtimes='timestamp.end' @timestamp="gettime"/>
      <compile v-else-if="isshow == 3" :actype='3' :accontent='activityDel' @accontent="getcontent"/>
    </van-popup>
  </div>
</template>

<script>
import { courseDetail,addActivity } from "@/api/activity";
import activitySelect from './activitySelect';
import acitvityTime from './acitvityTime';
import compile from '../course/compile'
export default {
  name:'issueActivity',
  components:{
    acitvityTime,
    activitySelect,
    compile
  },
  data() {
    return {
      /**支付方式 */
      payways:0,
      /**是否开启保证金 */
      is_pledge:0,
      /**过滤后的内容 */
      activityDels:'',
      isshow:0,
      /**弹出层是否显示 */
      show:false,
      /**图片地址 */
      imgurl: "",
      /**活动标题 */
      coursetypes: "",
      /**活动主办方 */
      coursemain:"",
      /**活动人数 */
      peopleNum: "",
      /**活动地址 */
      activityWith: "",
      /**活动详情数据 */
      msg: "",
      /**活动详情 */
      activityDel: "",
      /**票种设置 */
      setting: "待设置",
      /**活动时间 */
      times: {
        start: "",
        end: "待完善"
      },
      /**活动时间戳 */
      timestamp:{
        start:'',
        end:''
      },
      /**票content */
      content:[],
      /**判断发布还是保存草稿 */
      issave:true
    };
  },
  methods: {
    /**保证金支付方式 */
    payway() {
       this.$actionSheet({
        list: [
          {
            name: "只允许一起支付",
            type: 0
          },
          {
            name: "可以只付保证金",
            type: 1
          }
        ]
      }).then(res => {
        this.payways = res.type
      });
    },
    coursetype() {
      this.$actionSheet({
        list: [
          {
            name: "开启",
            type: 1
          },
          {
            name: "不开启",
            type: 0
          }
        ]
      }).then(res => {
        this.is_pledge = res.type
      });
    },
    /**
     * 文本区域焦点事件,兼容微信浏览器焦点事件离开后页面位置错位问题
     */
    onTextInputFocus() {
        this.WINDOW_TOP = document.body.scrollTop;
    },
    /**
     * 文本区域焦点离开,兼容微信浏览器焦点事件离开后页面位置错位问题
     */
    onTextInputBlur() {
        window.scrollTo(0, this.WINDOW_TOP);
    },
    /**获取富文本content */
    getcontent(val){
      this.show = false
      if(val) {
        this.activityDel = val
        this.activityDels = val.replace(/\<\/?img[^>]+>/g, "[图片]");
        this.activityDels = this.activityDels.replace(/\<\/?[^>]+>/g, "");
        this.activityDels = this.activityDels.replace(/&nbsp;/gi,"")
      }else {
        this.activityDel = ""
      }
    },
    /**上传图片 */
    uploadImg() {
      this.$store.ready(state => {
        this.$uploadImages({
          wxid: state.info.wxid,
          uploaded: res => {
            this.imgurl = res.defaultpic;
          }
        });
      });
    },
    /**活动详情 */
    gotodel() {
      
      this.show = true
      this.isshow = 3
    },
    gotoTime() {
      this.show = true
      this.isshow = 2
      
    },
    /**获取详情数据 */
    async getmsg() {
        let id = this.$route.query.id;
        await courseDetail({ id: id }).then(res => {
        this.msg = res.courseinfo;
        this.content = this.msg.json.content.ticket_info
        this.coursetypes = res.courseinfo.title;
        this.activityWith = res.courseinfo.json.setting.address;
        this.peopleNum = res.courseinfo.json.content.ticket_info[0].num;
        this.activityDel  = res.courseinfo.content
        this.activityDels = res.courseinfo.content.replace(/\<\/?img[^>]+>/g, "[图片]");
        this.activityDels = this.activityDels.replace(/\<\/?[^>]+>/g, "");
        this.activityDels = this.activityDels.replace(/&nbsp;/gi,"")
        res.courseinfo.json.content.ticket_info.length == 0
          ? (this.setting = "待设置")
          : (this.setting = "已完成");
        this.timestamp.start = res.courseinfo.json.setting.begindate;
        this.timestamp.end = res.courseinfo.json.setting.enddate
        this.times.start = res.courseinfo.json.setting.begindate;
        this.times.end = res.courseinfo.json.setting.enddate
        this.imgurl = res.courseinfo.defaultpic
        this.coursemain = res.courseinfo.json.setting.sponsor
        this.is_pledge = res.courseinfo.json.setting.is_pledge
        this.payways = res.courseinfo.json.setting.paymodel
        /**时间戳 */
        let time = new Date(parseInt(this.times.start));
        let times = {
          y: time.getFullYear(),
          m: time.getMonth() + 1,
          d: time.getDate()
        };
        this.times.start = `${times.y}-${times.m}-${times.d} 至`;
        let endtime = new Date(parseInt(this.times.end));
        let endtimes = {
          y: endtime.getFullYear(),
          m: endtime.getMonth() + 1,
          d: endtime.getDate()
        };
        this.times.end = `${endtimes.y}-${endtimes.m}-${endtimes.d}`;
      });
    },
    /**发布活动 */
    send() {
      let status
      this.issave == true ? status = 2 : status = 0;
      let max 
      this.$route.query.id == undefined ? max = 0 : max = this.msg.json.content.ticket_max
      let params = {
        title:this.coursetypes,
        defaultpic:this.imgurl,
        content:this.activityDel,
        status:status,
        courseid:this.$route.query.id,
        json:{
          "setting":{
              "begindate":this.timestamp.start,
              "enddate":this.timestamp.end,
              "address":this.activityWith,
              "sponsor":this.coursemain,
              "is_pledge":this.is_pledge, //是否开启保证金  1是0否
              "paymodel":this.payways,  //保证金付款方式  1只付保证金 0只能一起付
          },
          "content":{
              "ticket_info": this.content || [],
              "ticket_max": max
          },
          "form":[
              {
                  "field":"realname",
                  "name":"姓名",
                  "type":"text",
                  "placeholder":"报名用户的姓名",
                  "content":"",
                  "required":1 //是否必填 1必填 0非必填
              },
              {
                  "field":"tel",
                  "name":"手机号码",
                  "type":"text",
                  "placeholder":"报名用户的手机号码",
                  "content":"",
                  "required":1
              }
          ]
      }

      }
      addActivity(params).then(res=>{
        if(res.result == "success") {
          this.$toast("操作成功","success")
          setTimeout(() => {
            this.$router.push('/activityList')
          }, 800);
        }
      })
    },
    /**保存为草稿 */
    save() {
      this.issave = false;
      this.send()
    },
    /**票种设置 */
    activeset(){
      this.isshow = 1
      this.show = true
    },
    /**获取时间戳 */
    gettime(msg) {
      this.show = false
      if(msg.timenum){
        this.timestamp.start = msg.timenum
        let time = new Date(parseInt(msg.timenum));
        let times = {
        y: time.getFullYear(),
        m: time.getMonth() + 1,
        d: time.getDate()
        };
        this.times.start = `${times.y}-${times.m}-${times.d} 至`;
      }
      if(msg.overtimenum) {
        this.timestamp.end = msg.overtimenum
        let time = new Date(parseInt(msg.overtimenum));
        let times = {
        y: time.getFullYear(),
        m: time.getMonth() + 1,
        d: time.getDate()
        };
        this.times.end = `${times.y}-${times.m}-${times.d}`;
      }
    },
    /**获取content数据 */
    getlist(val) {
      console.log(val)
      this.content = val
      this.show = false
    }
  },
  created() {
    if (this.$route.query.id) {
      this.getmsg();
      this.getcontent();
    }
  },
  activated() {
    // let temporaryData = this.$store.state.temporaryData
    // switch(temporaryData.action){
    //   case 'content':
    //       console.log(temporaryData)
    //       temporaryData.content.replace(/\<\/?img[^>]+>/g, "[图片]");
    //       this.activityDel = temporaryData.content.replace(/\<\/?[^>]+>/g, "");
    //       break
    // }
    document.title = "发布活动";
  },
  computed: {
    id () {
      return this.$route.query.id
    }
  },
  watch: {
    id() {
      if(this.$route.name == "issueActivity"){
        this.getmsg();
      }
    },
    $route:{
      handler(val,old) {
        if(this.$route.query.id == undefined && this.$route.name == "issueActivity") {
          this.coursetypes = ''
          this.coursemain = ''
          this.activityWith = ''
          this.times.start = '待完善'
          this.setting = '待设置'
          this.times.end = ''
          this.activityDels = ''
          this.activityDel = ''
          this.timestamp.start=''
          this.timestamp.end=''
          this.content = []
          this.imgurl= ""
          this.is_pledge=0
        }
      }
    }
  },
};
</script>

<style scoped>
.issue {
  padding: 15px;
  box-sizing: border-box;
  background-color: #f8f9fd;
  min-height: 100vh;
  padding-bottom: 60px;
}
.page{
  overflow-y: auto;
}
.addimg {
  width: 100%;
  height: 180px;
  border-radius: 8px;
  overflow: hidden;
}
.addimg img {
  width: 100%;
  height: 100%;
}
.msg p {
  padding: 10px 0;
  font-weight: 900;
  font-size: 16px;
}
.ks-list-item {
  padding: 0 5px !important;
  font-size: 15px !important;
  height: 44px !important;
}
input {
  border: 0;
  list-style: none;
}
.courseInput {
  text-align: right;
}
.course-del-right {
  width: 9px;
  height: 17px;
  vertical-align: sub;
  margin-left: 8px;
}
.pitch {
  color: black;
}
.couresbtn {
  display: inline-flex;
  width: 91%;
  position: fixed;
  bottom: 0;
  justify-content: space-between;
  height: 48px;
  background-color: #fff;
  line-height: 48px;
  padding: 0 5px;
  box-sizing: border-box;
  z-index: 99;
}
.ks-image{
  height: 100%;
}
.uploadimg{
  position: absolute;
  top: 0;
  left: 0;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%)
}
.van-popup::-webkit-scrollbar {
  /* overflow-y: hidden; */
  width: 0;
  height: 0;
}
.activitydetail{
    max-width: 200px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.issue /deep/ .van-popup--right{
  z-index: 99 !important;
}
</style>
