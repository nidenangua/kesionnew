<template>
    <div class="course">
        <ks-empty msg="当前没有票种信息~" v-if="ticketmsg.length == 0"></ks-empty>
        <div class="tickets">
            <div class="bigbox" v-for="(item,i) in ticketmsg" :key="i">
                <div class="tickets-name">
                    <p>{{item.title}}</p>
                </div>
                <div class="tickets-msg">
                    <div class="tickets-msg__name">{{item.chargetype == 0 ? '免费票' : '收费票'}} <span v-if="item.chargetype == 1">￥{{item.price}}</span></div>
                    <div class="tickets-msg__num">票数{{item.num}}</div>
                </div>
                <div class="tickets-explain">票价说明：{{item.explain}}</div>
                <div class="tickets-oper">
                    <ks-button class="ks-ml5" @click="tickedel(i)">删除</ks-button>
                    <ks-button class="ks-ml5" @click="compileTick(i,item.chargetype,item.ticketid)">编辑</ks-button>
                </div>
            </div>
        </div>
        <div class="newcourse">
            <ks-button type="white" width="48%" @click="establishNew">创建新票种</ks-button>
            <ks-button type="success" width="48%" @click="goback">完成</ks-button>
        </div>
         <van-popup v-model="show" position="right" :style="{ width: '100%',height:'100%'}"  :overlay='false'>
            <acitvity-tickets :ticketmsg="ticketmsg" :ischarge="ischarge" :flag="flag" :index='index' :whether='whether' :activitytime="activitytime" :payway="payway" @close="close" @closeshow="closeshow" :pledge="is_pledge" :ticketid="ticketid" />
         </van-popup>
    </div>
</template>

<script>
import { courseDetail } from "@/api/activity";
import acitvityTickets from './acitvityTickets';
export default {
  name:'activitySelect',
  components:{
    acitvityTickets
  },
  props:{
    id:'',
    activitytime:'',
    payway:[Number,String],
    /**是否开启保证金 */
    is_pledge:[Number,String],
  },
  data() {
    return {
      /**票种信息 */
      ticketmsg:[],
      /**子组件是否显示 */
      show:false,
      /**点击索引 */
      index:'',
      /**点击收费票还是免费票 */
      whether:'',
      /**点击的票是否为收费票 */
      ischarge:'',
      flag:false,
      ticketid:''
    };
  },
  methods: {
    closeshow() {
      this.show = false
    },
    close(e) {
      if(e.action == "editTicket") {
        this.$nextTick(()=>{
          this.ticketmsg[this.index] = e.value.content.ticket_info[0]
        })
      }else {
        this.ticketmsg.push(e.content.ticket_info[0])
      }
      this.show = false
    },
    /**创建新票种 */
    establishNew() {
      this.$actionSheet({
        list: [
          {
            name: "创建收费票",
            type: "1"
          },
          {
            name: "创建免费票",
            type: "0"
          }
        ]
      }).then(res => {
        this.index = -1
        if(res.type == 1) {
          this.whether = 1
        }else {
          this.whether = 0
        }
        this.flag = !this.flag
        this.show = true
      });
    },
    
    /**删除票种信息 */
    tickedel(index) {
      this.ticketmsg.splice(index,1)
    },
    /**编辑票种信息 */
    compileTick(index,charge,id) {
      this.ticketid = id
      this.ischarge = charge
      this.index = index
      this.show = true
    },
    /**获取详情数据 */
    getmsg() {
      let id = this.id;
      courseDetail({id}).then((res)=>{
        this.ticketmsg = res.courseinfo.json.content.ticket_info
        console.log(this.ticketmsg)
      })
    },
    /**完成操作 */
    goback() {
      this.$emit('activityCon',this.ticketmsg)
    }
  },
  created() {
    if(this.$route.query.id != undefined) {
      this.getmsg()
    }
  },
  watch: {
    id() {
      if(this.$route.name == "issueActivity" && this.$route.query.id != undefined) {
        this.getmsg()
      }
    },
    $route:{
      handler() {
        if(this.$route.query.id == undefined && this.$route.name == "issueActivity") {
          this.ticketmsg = []
        }
      }
    }
  },
};
</script>

<style scoped>
* {
  font-size: 15px;
}
.course {
  padding-top: 10px;
  /* height: 100vh; */
  background-color: #f0f4f7;
  box-sizing: border-box;
  height: 100%;
  overflow: hidden;
}
.course-audition {
  display: flex;
  justify-content: space-between;
  padding: 15px 10px;
  background-color: #fff;
  border-bottom: 1px solid #f2f2f2;
}
.course-audition__upload {
  color: #b2b2b2;
}
.course-del-right {
  width: 9px;
  height: 17px;
  vertical-align: sub;
  margin-left: 8px;
}
.newcourse {
  background-color: #fff;
  position: fixed;
  bottom: 0;
  text-align: center;
  width: 100%;
  height: 45px;
}
.bigbox {
  border: 1px solid #f2f2f2;
  background-color: #fff;
  margin: 0 10px;
  padding: 10px;
  box-sizing: border-box;
  margin-bottom: 10px;
}
.tickets{
  height: 92%;
  overflow-y: auto;
}
.tickets-msg {
  display: flex;
  justify-content: space-between;
  margin: 10px 0;
}
.tickets-explain {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.ks-button--default {
  width: 47%;
  height: 35px !important;
  line-height: 35px !important;
  font-size: 15px !important;
}
.tickets-oper {
  margin-top: 10px;
}
.newwrit {
  text-align: center;
}
.van-popup{
  overflow-y: hidden;
}
</style>

<style>
/* .ks-action-sheet,
.ks-masked{
  z-index: 3333 !important;
} */
</style>
