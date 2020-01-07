<template>
    <div>
        <div>
            <div class="course-audition">
                <div class="course-audition__msg">开始时间</div>
                <div class="course-audition__upload" @click="isPopShow = !isPopShow;flag = false">
                    {{time.starttime}}
                    <img
                        src="../../../assets/course-manage/common_icon_moreinfor.png"
                        class="course-del-right"
                    >
                </div>
            </div>
            <div class="course-audition">
                <div class="course-audition__msg">结束时间</div>
                <div class="course-audition__upload" @click="endshow =!endshow;flag = true">
                    {{time.overstarttime}}
                    <img
                        src="../../../assets/course-manage/common_icon_moreinfor.png"
                        class="course-del-right"
                    >
                </div>
            </div>
        </div>
        <!-- 开始时间 -->
        <van-popup v-model="isPopShow" position="bottom">
            <van-datetime-picker
                v-model="currentDate"
                type="datetime"
                :min-date="minDate"
                :max-date="maxDate"
                @confirm="confirmPicker"
                @cancel="cancelCon"
            />
        </van-popup>
        <van-popup v-model="endshow" position="bottom">
            <!-- 结束时间 -->
            <van-datetime-picker
                v-model="currentDate"
                type="datetime"
                :min-date="endtime"
                :max-date="maxDate"
                @confirm="confirmPicker"
                @cancel="cancelCon"
            />
        </van-popup>
        <div class="newcourse">
            <ks-button type="success" width="95%" class="ks-btn" @click="save">保存下一步</ks-button>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    id: "",
    starttimes: "",
    endtimes: ""
  },
  data() {
    return {
      /**直播开始时间 */
      time: {
        starttime: "请选择",
        timenum: "",
        /**结束时间 */
 
        overstarttime: "请选择",
        overtimenum: ""
      },
      /**结束时间 */
      overtime: { starttime: "请选择", timenum: "" },
      /**时间组件 */
      isPopShow: false,
      endshow: false,
      //
      minHour: 10,
      maxHour: 20,
      minDate: new Date(),
      maxDate: new Date(new Date().valueOf()+93312000000),
      currentDate: new Date(),
      flag: false,
      endtime: new Date()
    };
  },
  methods: {
    confirmPicker(value) {
      let time = value.valueOf();
      this.timenow = time;
      this.isPopShow = false;
      this.endshow = false;
      var date = value;
      var m = date.getMonth() + 1;
      var d = date.getDate();
      var h = date.getHours();
      var s = date.getMinutes();
      if (m >= 1 && m <= 9) {
        m = "0" + m;
      }
      if (d >= 0 && d <= 9) {
        d = "0" + d;
      }
      var timer = date.getFullYear() + "年" + m + "月" + d + "日" + h + "时" + s + "分";
      if (this.flag == false) {
        this.time.starttime = timer;
        this.endtime = value;
        // 开始时间戳
        this.time.timenum = value.valueOf();
      } else {
        this.time.overstarttime = timer;
        // 结束时间戳
        this.time.overtimenum = value.valueOf();
      }
    },
    cancelCon() {
      this.isPopShow = false;
      this.endshow = false;
    },
    /**保存进入下一步 */
    save() {
      this.$emit("timestamp", this.time);
    },
    /**获取默认时间 */
    gettime(time) {
      let data = new Date(parseInt(time));
      let y = data.getFullYear();
      let m = data.getMonth() + 1;
      let d = data.getDate();
      let h = data.getHours();
      let mm = data.getMinutes();
      let s = data.getSeconds();
      m = m < 10 ? "0" + m : m;
      d = d < 10 ? "0" + d : d;
      h = h < 10 ? "0" + h : h;
      mm = mm < 10 ? "0" + mm : mm;
      s = s < 10 ? "0" + s : s;
      let times = `${y}年${m}月${d}日${h}时${mm}分`;
      time == "" ? this.time.starttime = "请选择开始时间"  : this.time.starttime = times;
    },
    getendtime(time) {
      let data = new Date(parseInt(time));
      let y = data.getFullYear();
      let m = data.getMonth() + 1;
      let d = data.getDate();
      let h = data.getHours();
      let mm = data.getMinutes();
      let s = data.getSeconds();
      m = m < 10 ? "0" + m : m;
      d = d < 10 ? "0" + d : d;
      h = h < 10 ? "0" + h : h;
      mm = mm < 10 ? "0" + mm : mm;
      s = s < 10 ? "0" + s : s;
      let times = `${y}年${m}月${d}日${h}时${mm}分`;
      time == "" ? this.time.overstarttime = "请选择结束时间"  : this.time.overstarttime = times;
    }
  },
  created() {
    this.time.timenum = this.starttimes
    this.time.overtimenum = this.endtimes
    let start = this.starttimes;
    let end = this.endtimes;
    this.gettime(start);
    this.getendtime(end);
  },
  watch: {
    starttimes() {
      this.time.timenum = this.starttimes
      this.gettime(this.starttimes);
    },
    endtimes() {
      this.time.overtimenum = this.endtimes
      this.getendtime(this.endtimes);
    }
  }
};
</script>

<style scoped>
* {
  font-size: 15px;
}
.course {
  padding-top: 10px;
  height: 100vh;
  background-color: #f0f4f7;
  box-sizing: border-box;
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
.van-popup {
  overflow-y: hidden;
}
</style>