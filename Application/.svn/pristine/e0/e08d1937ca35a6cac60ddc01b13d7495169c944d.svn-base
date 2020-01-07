<template>
  <div>
    <div v-if="chapter.length">
      <!--纯课时结构-->
      <div class="keshi-box" v-if="chapterType == 2">
        <div
          class="keshi-item"
          v-for="(period,i) in chapter"
          :key="i"
          @click="play(period)"
          :class="currentPlayId == period.chapterid && 'on'"
          :style="courseType==5 && 'padding-right:130px;'"
        >
          <span class="time" v-if="courseType==5">{{formatTimestamp(period.begindate*1000)}}</span>
          <span class="time1" v-if="courseType==2">{{formatTimestamp(period.begindate*1000)}}</span>
          <!-- <span class="free" v-if="period.freeplay == 2">{{courseType == 3 ? '试听' : '试看'}}</span> -->
            <i
              class="ks-icon ks-icon-lock-outline"
              v-if="period.freeplay == 0 && !isbuy"
            ></i>
          <span class="type" v-if="courseType == 1">视频</span>
          <span class="type" v-else-if="courseType == 2">直播</span>
          <span class="type" v-else-if="courseType == 3">音频</span>
          <span class="type" v-else-if="courseType == 4">图文</span>
          <span class="per_title">{{period.title}}</span>
        </div>
      </div>
      <div v-else>
        <div class="chapter-box" v-for="(item,i) in chapter" :key="i">
          <div class="chapter-name" @click="item.slideShow = item.slideShow ? false : true">
            <i class="eva-icon arrow-ios-downward-outline" :class="item.slideShow && 'arrow-up'"></i>
            {{item.title}}
          </div>
          <!--章节时结构-->
          <div class="section-box" v-if="item.Section" v-show="item.slideShow">
            <div class="section-item" v-for="(section,k) in item.Section" :key="k">
              <div
                class="section-name"
                @click="section.slideShow = section.slideShow ? false : true"
              >
                <i
                  v-if="section.keshi && section.keshi.length"
                  class="eva-icon arrow-ios-downward-outline"
                  :class="section.slideShow && 'arrow-up'"
                ></i>
                {{section.title}}
              </div>
              <div class="keshi-box" v-if="section.keshi" v-show="section.slideShow">
                <div
                  class="keshi-item"
                  v-for="(period,s) in section.keshi"
                  :key="s"
                  @click="play(period,section)"
                  :class="currentPlayId == period.chapterid && 'on'"
                  :style="courseType==5 && 'padding-right:130px;'"
                >
                  <span class="time" v-if="courseType==5">{{formatTimestamp(period.begindate*1000)}}</span>
                  <!-- <span class="free" v-if="period.freeplay == 2">{{courseType == 3 ? '试听' : '试看'}}</span> -->
                <i
                  class="ks-icon ks-icon-lock-outline"
                  v-if="period.freeplay == 0 && !isbuy"
                ></i>
                  
                  <span class="type" v-if="courseType == 1">视频</span>
                  <span class="type" v-else-if="courseType == 2">直播</span>
                  <span class="type" v-else-if="courseType == 3">音频</span>
                  <span class="type" v-else-if="courseType == 4">图文</span>
                  <span class="per_title">{{period.title}}</span>
                </div>
              </div>
            </div>
          </div>
          <!--章时结构-->
          <div class="keshi-box" v-else-if="item.keshi" v-show="item.slideShow">
            <div
              class="keshi-item"
              v-for="(period,s) in item.keshi"
              :key="s"
              @click="play(period,item)"
              :class="currentPlayId == period.chapterid && 'on'"
              :style="courseType==5 && 'padding-right:130px;'"
            >
              <span class="time" v-if="courseType==5">{{formatTimestamp(period.begindate*1000)}}</span>
              <!-- <span class="free" v-if="period.freeplay == 2">{{courseType == 3 ? '试听' : '试看'}}</span> -->
                <i
                  class="ks-icon ks-icon-lock-outline"
                  v-if="period.freeplay == 0 && !isbuy"
                ></i>
              <span class="type" v-if="courseType == 1">视频</span>
              <span class="type" v-else-if="courseType == 2">直播</span>
              <span class="type" v-else-if="courseType == 3">音频</span>
              <span class="type" v-else-if="courseType == 4">图文</span>
              <span class="per_title">{{period.title}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <ks-empty msg="该课程下暂无课时～" type="nolesson" v-else/>
  </div>
</template>
<script>
/**
 * 字段说明
 * courseType:1点播 2语音直播 3音频 4图文
 */
export default {
  name: "CourseCatalog",
  props:{
    isbuy:Number,
    chapter:{
      type:Array,
      default(){
        return []
      }
    },
    chapterType:{
      type:[Number,String]
    },
    currentPlayId:{
      type:[Number,String]
    },
    courseType:{
      type:[Number,String]
    }
  },
  computed:{

    /**格式化时间 */
    formatTimestamp() {
      /**
       * @param {Number} 时间戳
       */
      return function(time) {
        if(!time){
          return "";
        }
        let data = new Date(parseInt(time));
        let y = data.getFullYear();
        let m = data.getMonth() + 1;
        let d = data.getDate();
        let h = data.getHours();
        let mm = data.getMinutes();
        let s = data.getSeconds();
        y = y < 10 ? "0" + y : y;
        m = m < 10 ? "0" + m : m;
        d = d < 10 ? "0" + d : d;
        h = h < 10 ? "0" + h : h;
        mm = mm < 10 ? "0" + mm : mm;
        s = s < 10 ? "0" + s : s;
        return y + "-" + m + "-" + d + " " + h + ":" + mm + ":" + s;
      };
    }
  },
  methods: {
    play(period, parentItem) {
      if (this.courseType == 1 || this.courseType == 3|| this.courseType == 2) {
        this.$emit("play", period, parentItem); 
      } else if (this.courseType == 4) {
        this.$router.push({
          name: "GraphicLearn",
          params: {
            id: period.courseid
          },
          query: {
            chapterid: period.chapterid
          }
        });
      }
    }
  },
  created() {
    console.log(this.isbuy)
  },
};
</script>
<style scoped>
.chapter-name,
.section-name {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  padding: 0 30px 0 15px;
  font-size: 14px;
  position: relative;
  border-bottom: 1px solid #fff;
}
.chapter-name .arrow-ios-downward-outline,
.section-name .arrow-ios-downward-outline {
  width: 18px;
  height: 18px;
  position: absolute;
  right: 15px;
  top: 50%;
  margin-top: -9px;
  transition: 0.4s;
}
.chapter-name .arrow-up,
.section-name .arrow-up {
  transform: rotate(-180deg);
}
.chapter-name {
  background: #f5f5f5;
}
.section-name {
  background: #fafafa;
  color: #555;
}
.keshi-box {
  padding: 0 15px;
}
.keshi-item {
  padding: 12px 45px 12px 0;
  line-height: 20px;
  font-size: 14px;
  position: relative;
  color: #555;
}
.keshi-item.on {
  color: var(--primary-color);
}
.keshi-item .type {
  border: 1px solid #555;
  font-size: 10px;
  padding: 1px 2px;
  border-radius: 3px;
  margin-right: 5px;
  color: #555;
}
.keshi-item .free,
.keshi-item .time {
  position: absolute;
  right: 0;
  font-size: 12px;
  top: 12px;
  color: #2fca4a;
  border-radius: 3px;
}
.keshi-item .time {
  color: #999;
  padding-right: 18px;
}
.keshi-item .ks-icon {
  width: 18px;
  height: 18px;
  position: absolute;
  color:var(--prompt-color);
  right: 0;
  font-size: 18px;
  top: 13px;
}
.keshi-item .faceteach-time {
  color: #969696;
}
.keshi-item:last-child::after {
  display: none;
}
.keshi-item .time1{
  position: absolute;
  right: 0;
  font-size: 12px;
  top: 12px;
  border-radius: 3px;
}
.per_title{
  display: inline-block;
  max-width: 180px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  vertical-align: middle;
}
</style>
