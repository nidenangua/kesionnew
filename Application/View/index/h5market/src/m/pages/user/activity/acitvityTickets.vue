<template>
    <div>
        <div class="page">
          <div class="tickmsg">
            <ks-list-item title="票种名称">
                <div class="course-import">
                    <input
                        type="text"
                        placeholder="请输票种名称"
                        class="courseInput course-price__input sales"
                        v-model="ticket.name"
                    >
                </div>
            </ks-list-item>
            <ks-list-item title="票种数量">
                <div class="course-import">
                    <input
                        type="text"
                        placeholder="请输票种数量"
                        class="courseInput course-price__input sales"
                        v-model="ticket.num"
                    >
                </div>
            </ks-list-item>
            <ks-list-item title="票种价格" v-if="whether == 1 || ischarge == 1">
                <div class="course-import">
                    <input
                        type="text"
                        placeholder="请输入票种价格"
                        class="courseInput course-price__input sales"
                        v-model="ticket.price"
                    >
                </div>
            </ks-list-item>
            <ks-list-item title="购买限制">
                <div class="course-import">
                    <input
                        type="text"
                        placeholder="限制用户购买的数量"
                        class="courseInput course-price__input sales"
                        v-model="ticket.max"
                    >
                </div>
            </ks-list-item>
            <!-- 1111111111111111111111111111 -->
            <!-- <ks-list-item title="保证金">
                <div class="course-import">
                    <ks-radio v-model="is_pledge" :label="0">不开启</ks-radio>
                    <ks-radio v-model="is_pledge" :label="1">开启</ks-radio>
                </div>
            </ks-list-item> -->
             <ks-list-item title="保证金金额" v-if="payway == 1">
                <div class="course-import">
                    <input
                        type="text"
                        placeholder="请输入保证金金额"
                        class="courseInput course-price__input sales"
                        v-model="ticket.is_pledge"
                    >
                </div>
            </ks-list-item>
            <ks-list-item title="是否审核">
                <div class="course-import">
                    <ks-radio v-model="isprice" :label="0">不审核</ks-radio>
                    <ks-radio v-model="isprice" :label="1" :disable="whether ? true:false || pledge == 1">审核</ks-radio>
                </div>
            </ks-list-item>
        </div>
        
        <!-- 门票时间 -->
        <div class="tickTime">
            <ks-list-item title="可定日期">
                <div>
                    <span @click="beforeEnd" v-if="starttime.startstamp && starttime.endstamp">
                        {{starttime.startstamp | timecon}} 至 {{starttime.endstamp | timecon}}
                        <!-- <span v-if="!starttime.start && !starttime.end">请选择可定日期</span> -->
                        <img
                            src="../../../assets/course-manage/common_icon_moreinfor.png"
                            alt=""
                            class="course-del-right courseimg"
                        >
                    </span>
                    <span @click="beforeEnd" v-else>
                        请完善
                        <img
                            src="../../../assets/course-manage/common_icon_moreinfor.png"
                            alt=""
                            class="course-del-right courseimg"
                        >
                    </span>
                </div>
            </ks-list-item>
            <ks-list-item title="票据有效期">
                <div>
                    <span @click="period" v-if="starttime.endstartstamp && starttime.endendstamp">
                        {{starttime.endstartstamp | timecon}} 至 {{starttime.endendstamp | timecon}}
                         <!-- <span v-if="!starttime.endstart && !starttime.endend">请选择票据有效期</span> -->
                        <img
                            src="../../../assets/course-manage/common_icon_moreinfor.png"
                            alt=""
                            class="course-del-right courseimg"
                        >
                    </span>
                    <span @click="period" v-else>
                         请完善
                         <!-- <span v-if="!starttime.endstart && !starttime.endend">请选择票据有效期</span> -->
                        <img
                            src="../../../assets/course-manage/common_icon_moreinfor.png"
                            alt=""
                            class="course-del-right courseimg"
                        >
                    </span>
                </div>
            </ks-list-item>
        </div>
        <!-- 票种说明 -->
        <div class="tickExplain">
            <p>票种说明(选填)</p>
            <textarea
                name=""
                id=""
                cols="30"
                rows="10"
                class="explain"
                placeholder="请输入票种说明"
                v-model="explain"
                @focus="onTextInputFocus"
                @blur="onTextInputBlur"
            ></textarea>
            <!-- <ks-input type="textarea" placeholder="请输入票种说明" v-model="explain" class="explain"></ks-input> -->
        </div>
        </div>
        <div class="newcourse">
            <ks-button type="white" width="48%" @click="goback">返回</ks-button>
            <ks-button type="success" width="48%" @click="complete">完成</ks-button>
        </div>
        <van-popup
            v-model="show"
            position="right"
            :style="{ width: '100%',height:'100%'}"
            :overlay="false"
        >
            <acitvity-time
                v-if="this.judge == 1"
                :starttimes="starttime.startstamp"
                :endtimes="starttime.endstamp"
                @timestamp="getfirst"
            />
            <acitvity-time
                v-if="this.judge == 2"
                :starttimes="starttime.endstartstamp"
                :endtimes="starttime.endendstamp"
                @timestamp="getsecond"
            />
        </van-popup>
    </div>
</template>

<script>
import acitvityTime from "./acitvityTime";
export default {
  name: "acitvityTickets",
  components: {
    acitvityTime
  },
  props: {
    ticketmsg: Array,
    index: Number,
    /**0免费票 1收费票 */
    whether: [Number, String],
    activitytime:{},
    ischarge:'',
    payway:[Number,String],
    flag:Boolean,
    /**是否开启保证金 */
    pledge:[Number,String],
    /**编辑票ID */
    ticketid:[Number,String],
  },
  data() {
    return {
      /**是否开启保证金 */
      is_pledge:0,
      /**判断是可定日期还是票据有效期 */
      judge: "",
      selectType: 1,
      /**票种信息 */
      ticket: {
        name: "",
        num: "",
        price: "",
        max: "",
        /**保证金金额 */
        is_pledge:''
      }, 
      /**是否审核 */
      isprice: 0,
      /**详情数据 */
      msg: [],
      /**票种说明 */
      explain: "",
      /**可定日期 */
      starttime: {
        /**时间戳 */
        startstamp: "",
        endstamp: "",
        endstartstamp: "",
        endendstamp: ""
      },
      show: false
    };
  },
  methods: {
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

    /**获取修改之后的时间戳 */
    getfirst(val) {
      console.log(val.timenum, val.overtimenum);
      this.starttime.startstamp = val.timenum
      this.starttime.endstamp = val.overtimenum
      this.show = false;
    },
    /**获取有效期时间戳 */
    getsecond(val) {
      console.log(val.timenum, val.overtimenum);
      this.starttime.endstartstamp = val.timenum
      this.starttime.endendstamp = val.overtimenum
      this.show = false;
    },
    /**活动结束前时间 */
    beforeEnd() {
      this.judge = 1;
      this.show = true;
    },
    /**门票期间时间 */
    period() {
      this.judge = 2;
      this.show = true;
    },
    goback() {
      this.$emit("closeshow");
    },
    /**完成操作 */
    complete() {
      if(this.ticket.name == "" || this.ticket.num == "" ||  this.starttime.startstamp == "" || this.starttime.endstamp == "" || this.starttime.endstartstamp == "" ||             this.starttime.endendstamp == "") {
      return  this.$toast("请将信息补充完整")
      }else {
        let data = {};
        // 编辑
      if (this.index >=0) {
        data = {
          action: "editTicket",
          value: {
            content: {
              ticket_info: [
                {
                  title: this.ticket.name,
                  chargetype: this.ischarge, //票种类型 0免费 1收费
                  price: this.ticket.price,
                  num: this.ticket.num, //票张数
                  purchase_limit: this.ticket.max, // 限购张数
                  check: this.isprice, //是否需要审核 0不需要审核 1需要审核
                  cash_deposit: this.ticket.is_pledge, //保证金
                  status: 0, //状态 0暂未开始 1发售中 2结束发售
                  explain: this.explain, //票种说明
                  ticketid:this.ticketid,
                  order_date_type: 1, //订购日期类型 0默认为活动发布后至活动结束前 1自定义
                  order_date: [this.starttime.startstamp, this.starttime.endstamp],
                  effective_date_type: 1, //有效日期类型 0默认为活动发布后至活动结束前 1自定义
                  effective_date: [this.starttime.endstartstamp, this.starttime.endendstamp] //有效期
                }
              ],
            }
          }
        };
      } else {
        data = {
          content: {
            ticket_info: [
                {
                  title: this.ticket.name,
                  chargetype: this.whether || '0', //票种类型 0免费 1收费
                  price: this.ticket.price,
                  num: this.ticket.num, //票张数
                  purchase_limit: this.ticket.max, // 限购张数
                  check: this.isprice, //是否需要审核 0不需要审核 1需要审核
                  cash_deposit: this.ticket.is_pledge, //保证金
                  status: 0, //状态 0暂未开始 1发售中 2结束发售
                  explain: this.explain, //票种说明
                  order_date_type: 1, //订购日期类型 0默认为活动发布后至活动结束前 1自定义
                  order_date: [this.starttime.startstamp, this.starttime.endstamp],
                  effective_date_type: 1, //有效日期类型 0默认为活动发布后至活动结束前 1自定义
                  effective_date: [this.starttime.endstartstamp, this.starttime.endendstamp]
                }
            ],
          },
        };
      }
      this.$emit("close", data);
      }
    },
    /**时间操作 */
    gettimes() {
      /**可定日期   获取时间戳 */
      this.starttime.startstamp = this.ticketmsg[this.index].order_date[0];
      this.starttime.endstamp = this.ticketmsg[this.index].order_date[1];
      /**票据有效期 获取时间戳 */
      this.starttime.endstartstamp = this.ticketmsg[this.index].effective_date[0];
      this.starttime.endendstamp = this.ticketmsg[this.index].effective_date[1];
    },
    /**新增时间操作 */
    getnewtimes() {
      /**可定日期   获取时间戳 */
      this.starttime.startstamp = this.activitytime.start;
      this.starttime.endstamp = this.activitytime.end;
      /**票据有效期 获取时间戳 */
      this.starttime.endstartstamp = this.activitytime.start;
      this.starttime.endendstamp = this.activitytime.end;
      console.log(this.starttime.startstamp,this.starttime.endstamp,this.starttime.endstartstamp,this.starttime.endendstamp)
    }
  },
  filters:{
    timecon(val) {
      let time = new Date(parseInt(val))
      let y = time.getFullYear()
      let m = time.getMonth() + 1
      let d = time.getDate()
      return `${y}-${m}-${d}`
    }
  },
  created() {
    if (this.ticketmsg && this.index >=0) {
      this.ticket.name = this.ticketmsg[this.index].title;
      this.ticket.is_pledge = this.ticketmsg[this.index].cash_deposit
      this.ticket.num = this.ticketmsg[this.index].num;
      this.ticket.price = this.ticketmsg[this.index].price;
      this.isprice = parseInt(this.ticketmsg[this.index].check);
      if(this.pledge == 1) {
        this.isprice = 0
      }
      this.explain = this.ticketmsg[this.index].explain;
      this.ticket.max = this.ticketmsg[this.index].purchase_limit;
      this.gettimes()
    }else {
      this.getnewtimes()
      this.ticket.name = ""
      this.ticket.num = ""
      this.ticket.price = ""
      this.explain =""
      this.ticket.max = ""
      this.isprice = 0
    }
  },
  computed: {
    id() {
      return this.$route.query.id
    }
  },
  watch: {
    index() {
      if (this.index >= 0) {
        this.ticket.name = this.ticketmsg[this.index].title;
        this.ticket.num = this.ticketmsg[this.index].num;
        this.ticket.price = this.ticketmsg[this.index].price;
        this.explain = this.ticketmsg[this.index].explain;
        this.ticket.max = this.ticketmsg[this.index].purchase_limit;
        this.ticket.is_pledge = this.ticketmsg[this.index].cash_deposit;
        this.isprice = parseInt(this.ticketmsg[this.index].check);
        if(this.pledge == 1) {
          this.isprice = 0
        }
        if (this.ticketmsg[this.index].chargetype == 0) {
          this.ticket.price = "免费";
        }
        this.gettimes()
      } else {
        // this.getnewtimes()
        // this.ticket.name = "";
        // this.ticket.num = "";
        // this.ticket.price = "";
        // this.explain = "";
        // this.ticket.max = "";
        // this.isprice = 0
      }
    },
    flag() {
        this.ticket.name = "";
        this.ticket.num = "";
        this.ticket.price = "";
        this.explain = "";
        this.ticket.max = "";
        this.ticket.is_pledge = "";
        this.isprice = 0
    },
    ticketmsg() {
      if (this.ticketmsg && this.index >=0) {
      this.ticket.name = this.ticketmsg[this.index].title;
      this.ticket.is_pledge = this.ticketmsg[this.index].cash_deposit
      console.log(this.ticketmsg[this.index].cash_deposit)
      this.ticket.num = this.ticketmsg[this.index].num;
      this.ticket.price = this.ticketmsg[this.index].price;
      this.isprice = parseInt(this.ticketmsg[this.index].check);
      if(this.pledge == 1) {
        this.isprice = 0
      }
      this.explain = this.ticketmsg[this.index].explain;
      this.ticket.max = this.ticketmsg[this.index].purchase_limit;
      this.gettimes()
    }else {
      this.getnewtimes()
      this.ticket.name = ""
      this.ticket.num = ""
      this.ticket.price = ""
      this.explain =""
      this.ticket.max = ""
      this.isprice = 0
    }
    }
  },
};
</script>

<style scoped>
.page{
  height: 93vh;
  margin-bottom: 44px;
  overflow-y: auto;
}
input {
  border: none;
  list-style: none;
}
.tickmsg {
  margin: 0 10px;
  padding-top: 10px;
  margin-bottom: 10px;
}
.course-del-right {
  width: 9px;
  height: 17px;
  vertical-align: sub;
  margin-left: 8px;
}
.tickTime {
  margin: 0 10px 10px 10px;
}
.tickExplain {
  margin: 0 10px;
  padding: 0 15px;
  background-color: #fff;
  font-size: 16px;
}
.tickExplain p {
  padding: 10px 0;
}
.newcourse {
  background-color: #fff;
  position: fixed;
  bottom: 0;
  text-align: center;
  width: 100%;
  height: 45px;
}
.explain {
  width: 100%;
  border-color: #f2f2f2;
  padding: 5px;
  position: relative;
}
.van-popup {
  overflow-y: hidden;
  overflow-x: hidden;
}
.ks-list-item{
  height: 44px;
}
</style>
