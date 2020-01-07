<template>
  <div v-if="dataList.length">
    <!--样式2-->
    <div class="drag-course-style2" v-if="dataStyle == 2">
      <div class="item-first" @click="open(dataList[0])">
        <ks-create-bg :src="dataList[0].defaultpic" class="item-images">
          <div class="info">
            <div class="name">{{dataList[0].title}}</div>
            <div class="sen">{{dataList[0].shortdesc}}</div>
          </div>
        </ks-create-bg>
      </div>
      <div class="item-wrap">
        <div
          :class="index > 0 && 'item'"
          v-for="(item,index) in dataList"
          :key="index"
          @click="open(item)"
        >
          <div v-if="index > 0">
            <ks-create-bg class="item-images" :src="item.defaultpic"/>
            <div class="name">{{item.title}}</div>
            <div class="sen">{{item.shortdesc}}</div>
          </div>
        </div>
      </div>
    </div>
    <!--样式3-->
    <div class="drag-course-style3" v-else-if="dataStyle == 3">
      <div class="item" v-for="(item,index) in dataList" :key="index" @click="open(item)">
        <ks-create-bg :src="item.defaultpic" class="item-images">
          <!-- <div class="item-type" v-if="item.courseType == 1">
            <i class="eva-icon play-circle-outline"></i>
          </div>
          <div class="item-type" v-else-if="item.courseType == 2">
            <i class="eva-icon video-outline"></i>
          </div>
          <div class="item-type" v-else-if="item.courseType == 3">
            <i class="eva-icon headphones-outline"></i>
          </div>
          <div class="item-type" v-else-if="item.courseType == 4">
            <i class="eva-icon image-outline"></i>
          </div> -->
        </ks-create-bg>
        <div class="name">{{item.title}}</div>
        <div class="sen" v-if="dataType === 'column'">已更新{{item.qs}}期</div>
        <div class="sen" v-else>{{item.studentcount}}人报名</div>
        <div class="sen">
          <span class="charge">{{item.price}}</span>
        </div>
      </div>
    </div>
    <!--样式4-->
    <div class="drag-course-style4" v-else-if="dataStyle == 4">
      <div class="item" v-for="(item,index) in dataList" :key="index" @click="open(item)">
        <div class="item-inner">
          <ks-create-bg class="item-images" :src="item.defaultpic"/>
          <div class="name">{{item.title}}</div>
          <div
            class="sen"
            v-if="dataType === 'course' && item.coursehour == 1"
          >已开课{{item.hourcount}}节 | 预计更新{{item.expecthour}}节课</div>
          <div class="sen" v-else-if="item.courseType == 2">
            <span v-if="item.livetype == 1">一对一</span>
            <span v-else-if="item.livetype == 2">小班课</span>
            <span v-else-if="item.livetype == 3">千人直播</span>
            <span v-else-if="item.livetype == 4">语音直播</span>
            | 线上课堂
          </div>
          <div class="sen" v-else-if="dataType === 'column'">专栏 | 已更新{{item.qs}}期</div>
          <div class="sen" v-else>{{item.shortdesc}}</div>
          <div class="bm">
            <span class="num">
              已有
              <font>{{item.studentcount || item.soldnum}}</font>人报名
            </span>
            <span class="charge" :class="item.price === '免费' && 'charge-free'">
              <span class="rmb" v-if="item.price.indexOf('￥') !== -1">￥</span>
              {{item.price.replace('￥','')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <!--样式5-->
    <div class="drag-course-style5" v-else-if="dataStyle == 5">
      <ks-swiper :options="swiperOption">
        <ks-swiper-slide class="item" v-for="(item,index) in dataList" :key="index">
          <ks-create-bg class="item-images" :src="item.defaultpic" @click="open(item)"/>
          <div class="name" @click="open(item)">
            <div class="type" v-if="dataType === 'course'">
              <span v-if="item.courseType == 1">点播</span>
              <span v-else-if="item.courseType == 2">直播</span>
              <span v-else-if="item.courseType == 3">音频</span>
              <span v-else-if="item.courseType == 4">图文</span>
            </div>
            <div class="type" v-else-if="dataType === 'column'">
              <span>专栏</span>
            </div>
            {{item.title}}
          </div>
        </ks-swiper-slide>
      </ks-swiper>
    </div>
    <!--样式6-->
    <div class="drag-course-style6" v-else-if="dataStyle == 6">
      <div class="course"  v-for="(item,i) in dataList" :key="i" @click="open(item)">
        <div class="course-box" >
          <ks-image :src="item.defaultpic" />
          <div class="course-box__content">
            <h3>{{item.title}}</h3>
            <p>{{item.shortdesc}}</p>
          </div>
          <div class="course-bottom">
            <p class="bottom-left">{{item.studentcount}}人报名</p>
            <span class="charge" v-if="item.courseType != 6">{{item.price}}</span>
            <span class="charge" v-if="item.courseType == 6">{{item.activity_price==0?"免费":"￥"+item.activity_price}}</span>
          </div>
        </div>
      </div>
    </div>
    <!--样式7-->
    <div class="drag-course-style7" v-else-if="dataStyle == 7">
      <ks-swiper :options="swiperOption7">
        <ks-swiper-slide class="item" v-for="(item,index) in rowData" :key="index">
        <div v-for="(child,indexs) in item" :key="indexs">
          <ks-image class="item-images" :src="child.defaultpic" @click="open(child)"/>
          <div class="name" @click="open(child)">
            {{child.title}}
          </div>
          <div class="type" v-if="dataType === 'column'">已更新{{child.qs}}期</div>
          <div class="type" v-else>{{child.studentcount}}人报名</div>
        </div>
        </ks-swiper-slide>
      </ks-swiper>
    </div>
    <!--样式8-->
    <div class="drag-course-style8" v-else-if="dataStyle == 8">
      <div class="item" v-for="(item,index) in dataList" :key="index" @click="open(item)">
        <ks-image :src="item.defaultpic" class="item-images">
          <span
            class="is-relay"
            v-if="dataType === 'course'"
          >{{(item.courseType == 1 && '视频') || (item.courseType == 2 && '直播') || (item.courseType == 3 && '音频') || (item.courseType == 4 && '图文') || (item.courseType == 5 && '面授') || (item.courseType == 6 && '活动')}}</span>
          <span class="is-relay" v-else-if="dataType === 'column'">专栏</span>
        </ks-image>
        <div class="name">{{item.title}}</div>
        <div class="sen" v-if="dataType === 'column'"><span class="charge">{{item.price}}</span>
           <div class="fr">
            已更新{{item.qs}}期
          </div>
        </div>
        <div class="sen" v-else>
          <span class="charge">{{item.price}}</span>
           <div class="fr">
            {{item.studentcount}}人学习
          </div>
        </div>
      </div>
    </div>
    <!--样式9-->
    <div class="drag-course-default9" v-else-if="dataStyle == 9">
      <div class="course-item" v-for="(item,i) in dataList" :key="i" @click="open(item)">
        <ks-image :src="item.defaultpic" class="item-images">
          <span
            class="is-relay"
            v-if="dataType === 'course'"
          >{{(item.courseType == 1 && '视频') || (item.courseType == 2 && '直播') || (item.courseType == 3 && '音频') || (item.courseType == 4 && '图文') || (item.courseType == 5 && '面授') || (item.courseType == 6 && '活动')}}</span>
          <span class="is-relay" v-else-if="dataType === 'column'">专栏</span>
        </ks-image>
        <div class="main-con">
          <div class="course-name">{{item.title}}</div>
          <div class="course-price" v-if="showPrice">
            
            <span class="charge">
              <span v-if="item.courseType == 6">{{item.price == "免费" ? "￥0.00" : item.price}}起</span>
              <span v-else>{{item.price}}</span>
            </span>
            <span>{{item.studentcount}}人学习</span>
          </div>
          <div
            class="course-desc"
            v-else
          >{{item.shortdesc}}</div>
          
        </div>
      </div>
    </div>
    <!--样式10-->
    <div class="drag-course-default10" v-else-if="dataStyle == 10">
      <div class="course-item" :class="i < dataList.length-1 && 'ks-line'" v-for="(item,i) in dataList" :key="i" @click="open(item)">
        <ks-create-bg :src="item.defaultpic" class="item-images"></ks-create-bg>
         <ks-button class="buttom ks-button--primary ks-button--mini">{{dataType === 'course' ? '查看课程' : '查看专栏'}}</ks-button>
        <div class="main-con">
          <div class="course-name">{{item.title}} <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i></div>
          <div
            class="course-num"
          >{{item.shortdesc}}</div>
          
        </div>
      </div>
    </div>
    
    <div class="drag-course-default" v-else>
      <div class="course-item" v-for="(item,i) in dataList" :key="i" @click="open(item)">
        <ks-image :src="item.defaultpic" class="item-images">
          <span
            class="is-relay"
            v-if="item.courseType == 2 && dataType === 'course'"
          >{{(item.livetype == 1 && '一对一') || (item.livetype == 2 && '小班课') || (item.livetype == 3 && '千人直播') || (item.livetype == 4 && '语音直播')}}</span>
          <span class="is-relay" v-else-if="item.coursehour == 1 && dataType === 'course'">连载</span>
        </ks-image>
        <div class="main-con">
          <div class="course-name">{{item.title}}</div>
          <div
            class="course-num"
            v-if="(dataType === 'course' && item.courseType == 2) || dataType === 'column'"
          >{{item.shortdesc}}</div>
          <div class="course-num" v-else-if="dataType === 'course'">
            <span v-if="item.coursehour == 1">已开课{{item.hourcount}}节 | 预计更新{{item.expecthour}}节课</span>
          </div>
          <div class="last-con">
            <span class="learning-num" v-if="dataType === 'column'">已更新{{item.qs}}期</span>
            <span class="learning-num" v-else>{{item.studentcount}}人报名</span>
            <span class="charge" v-if="item.courseType!=6">{{item.price}}</span>
            <span class="charge" v-if="item.courseType==6">{{item.price=='免费'?"￥0起":item.price+"起"}}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { getViewRoute } from "@/utils";
export default {
  name: "KdCourse",
  props: {
    dataList: {
      type: Array,
      default() {
        return [];
      }
    },
    showPrice:Boolean,
    dataStyle: [Number, String],
    dataType: String
  },
  data() {
    return {
      swiperOption: {
        slidesPerView: 1.7,
        spaceBetween: 15
      },
      swiperOption7: {
        slidesPerView: 2.2,
        spaceBetween: 15
      },
      rowData:[]
    };
  },
  watch:{
    dataList:{
      handler(arr){
        let rowData = []
        let a = this.dataList.length > 6 ? 2 : 1
        arr.map((item,i)=>{
          let rowIndex = Math.max(rowData.length - 1,0)
          if(rowData[rowIndex] && rowData[rowIndex].length < a){
            rowData[rowIndex].push(item)
          }else{
            rowData.push([item])
          }
        })
        this.rowData = rowData
      },
      deep:true,
      immediate:true
    }
  },
  computed: {
    /**计算最低价 */
    getPrice() {
      return function(item) {
        let courseinfo = JSON.parse(item.json)
        let is_pledge = courseinfo.setting.is_pledge;
        let paymodel = courseinfo.setting.paymodel;
        let ticketArr = courseinfo.content.ticket_info;
        let price;
        if (is_pledge == 0) {
          ticketArr.forEach((el, index) => {
            if (index == 0) {
              price = el.chargetype == 0 ? 0 : el.price;
            } else {
              if (el.chargetype == 0) {
                price = price > 0 ? 0 : price;
              } else {
                price = price > el.price ? el.price : price;
              }
            }
          });
        } else {
          ticketArr.forEach((el, index) => {
            if (paymodel == 0) {
              if (index == 0) {
                price =
                  el.chargetype == 0
                    ? el.cash_deposit
                    : +el.price + +el.cash_deposit;
              } else {
                if (el.chargetype == 0) {
                  price = price > el.cash_deposit ? el.cash_deposit : price;
                } else {
                  price =
                    price > +el.cash_deposit + +el.price
                      ? (+el.cash_deposit + +el.price).toFixed(2)
                      : price;
                }
              }
            } else {
              if (index == 0) {
                price = el.cash_deposit;
              } else {
                price = price > el.cash_deposit ? el.cash_deposit : price;
              }
            }
          });
        }
        if(price==0){
          return "免费";
        }else{
          return "￥" + price;
        }
      };
    }
  },
  methods: {
    open(item) {
      if (this.dataType === "course") {
        if (item.courseType == 6) {
          this.$router.push("/activity/" + item.courseid);
        } else {
          this.$router.push("/course/" + item.courseid);
        }
      } else if (this.dataType === "class") {
        this.$router.push("/class/" + item.classid);
      } else if (this.dataType === "column") {
        this.$router.push("/column/" + item.columnid);
      }
    },
  }
};
</script>

<style lang="scss" scoped>
/*通用*/
.item-images {
  overflow: hidden;
  border-radius: 0.15rem;
  position: relative;
}

.item-type {
  width: 24px;
  height: 18px;
  background: rgba(0, 0, 0, 0.6);
  position: absolute;
  right: 10px;
  bottom: 10px;
  border-radius: 3px;
  text-align: center;
}
.item-type .eva-icon {
  width: 16px;
  height: 16px;
  display: block;
  margin: 0.05rem auto;
}

/*默认样式*/
.drag-course-default {
  background: #fff;
  .course-item {
    padding: 10px 15px 10px 150px;
    position: relative;
    min-height: 74px;
    border-radius: 3px;
  }
  .item-images {
    height: 74px;
    width: 120px;
    position: absolute;
    left: 15px;
    top: 10px;
  }
  .is-relay {
    position: absolute;
    bottom: 0;
    right: 0;
    color: #fff;
    letter-spacing: 0;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 4px 0 0 0;
    padding: 0 5px;
    font-size: 10px;
  }
  .main-con .course-name {
    line-height: 18px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    font-weight: bold;
    overflow: hidden;
    font-size: 14px;
    color: #424242;
  }
  .course-num {
    white-space: nowrap;
    text-overflow: ellipsis;
  }
  .course-num,
  .last-con {
    color:var(--auxiliary_text-color);
    font-size: 12px;
    line-height: 20px;
    height: 20px;
    overflow: hidden;
    margin-top: 3px;
  }

  .last-con .charge {
    float: right;
    color: var(--ornament-color);
  }
}
/*样式2*/
.drag-course-style2 {
  background: #fff;
  .name,.sen {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
  .item-first {
    padding: 10px 15px 15px 15px;
  }
  .item-first .info {
    position: absolute;
    width: 100%;
    z-index: 2;
    padding: 0 10px;
    box-sizing: border-box;
    top: 50%;
    margin-top: -40px;
    color: #fff;
  }
  .item-first .name {
    font-size: 20px;
    font-weight: bold;
  }
  .item-first .sen {
    font-size: 14px;
  }
  .item-first .name,.item-first .sen {
    line-height: 40px;
    height: 40px;
    margin: 0 10px;
  }
  .item-first .item-images {
    height: 10.5rem;
    text-align: center;
    color: #fff;
  }
  .item-first .item-images::before {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
  }
  .item-wrap {
    white-space: nowrap;
    padding: 0 15px 0 0;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .item-wrap .item {
    width: 55%;
    box-sizing: border-box;
    padding: 0 0 15px 15px;
    display: inline-block;
    vertical-align: top;
  }
  .item-wrap .item .item-images {
    height: 5.5rem;
  }
  .item-wrap .item .name {
    font-size: 14px;
    height: 22px;
    line-height: 22px;
    margin-top: 7px;
  }
  .item-wrap .item .sen {
    color:var(--auxiliary_text-color);
    height: 22px;
    line-height: 22px;
  }
}

/*样式3*/
.drag-course-style3 {
  background: #fff;
  padding-right: 15px;
 .name,
 .sen {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
 .item {
    width: 50%;
    box-sizing: border-box;
    padding: 10px 0 10px 15px;
    display: inline-block;
  }
 .item .item-images {
    height: 5.3rem;
  }
 .item .name {
    font-size: 14px;
    height: 22px;
    line-height: 22px;
    margin-top: 7px;
  }
 .sen {
    color: var(--auxiliary_text-color);
    height: 22px;
    line-height: 22px;
  }
 .sen .charge {
    color: var(--ornament-color);
}
}

/*样式4*/
.drag-course-style4 {
  background: #fff;
  padding-bottom: 15px;
.item-images {
  height: 100%;
  width: 110px;
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 0px;
}
.item {
  padding: 10px 15px 5px 15px;
}
.item-inner {
  position: relative;
  height: 100px;
  padding: 10px 20px 0 125px;
  background: #f5f5f5;
  border-radius: 8px;
  overflow: hidden;
  color: #787878;
}
.item .name {
  font-size: 16px;
  height: 30px;
  line-height: 30px;
  overflow: hidden;
  font-weight: bold;
  color: #777;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.item .sen {
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  font-size: 14px;
}
.item .bm {
  margin-top: 10px;
}
.item .bm .num {
  float: right;
}
.item .bm .num font {
  color: var(--ornament-color);
}
.item .bm .charge {
  font-size: 18px;
  color: var(--ornament-color);
}
.item .bm .charge-free {
  font-size: 14px;
}
.item .bm .rmb {
  font-size: 14px;
  position: relative;
  top: -2px;
}
}
/*样式5*/
.drag-course-style5 {
  background: #fff;
 .item {
  padding: 10px 0;
}
 .swiper-container {
  padding: 0 15px;
}
 .item-images {
  height: 5.8rem;
}
 .name {
  height: 40px;
  line-height: 40px;
  overflow: hidden;
  font-size: 14px;
  white-space: nowrap;
  text-overflow: ellipsis;
  color:var(--auxiliary_text-color);
}
 .name .type {
  float: right;
  color: var(--auxiliary_text-color);
  margin-left: 20px;
}
}
/*样式6*/
.drag-course-style6 {
  background: #fff;
 .course{
    padding:5px  15px 15px 15px;
  }
 .course-box{
    border-radius: 5px;
    box-shadow: 0 1px 8px rgba(0,0,0,.1);
    overflow: hidden;
  }
 .course-box .ks-image{
    height: 8.5rem;
    width: 100%;
  }
 .course-box .course-box__content{
    padding:0 10px;
  }
 .course-box .course-box__content p{
    color: var(--auxiliary_text-color);
    font-size: 14px;
    text-align: justify;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    padding-top: 3px;
  }
 .course-box .course-box__content h3{
    font-size: 15px;
    padding-top: 3px;
  }
 .course-box .course-bottom{
    font-size: 14px;
    padding:10px;
  }
 .course-box .course-bottom .bottom-left{
    text-align: left;
    display: -webkit-inline-box;
    color: var(--auxiliary_text-color);
  }
 .course-box .course-bottom .charge{
    float:right;
    color: var(--ornament-color);
  }
}

/*样式7*/
.drag-course-style7 {
  background: #fff;
  .item {
    padding: 10px 0;
  }
  .swiper-container {
    padding: 0 15px;
  }
  .item-images {
    height: 6.5rem;
  }
  .name {
    font-size: 18px;
    margin-top: 10px;
    font-weight: bold;
    color: var(--primary_text-color);
    line-height: 24px;
    min-height: 48px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    text-align: justify;
  } 
  .type {
    font-size:14px;
    color:var(--prompt-color);
    line-height:24px;
    height: 24px;
    overflow: hidden;
    margin-top: 10px;
  }
}
/*样式8*/
.drag-course-style8 {
  background: #fff;
  padding-right: 10px;
  
 .item {
    width: 50%;
    box-sizing: border-box;
    padding: 10px 5px 10px 15px;
    display: inline-block;
  }
  .item-images {
    height: 5rem;
    border-radius: 8px;
  }
  .name {
    font-size: 16px;
    font-weight: bold;
    color: var(--primary_text-color);
    line-height: 22px;
    min-height: 44px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    text-align: justify;
    margin-top: 10px;
  }
 .sen {
    color: var(--auxiliary_text-color);
    min-height: 22px;
    line-height: 22px;
    overflow: hidden;
    margin-top: 10px;
  }
 .sen .charge {
    color: var(--ornament-color);
    font-size:16px;
  }
  .is-relay {
    position: absolute;
    top: 0;
    left: 0;
    color: #fff;
    letter-spacing: 0;
    background: rgba(0,0,0,0.4);
    border-radius: 8px 0;
    padding: 1px 6px;
  }
  .fr{
    float: right;
    font-size:12px;
    color: var(--auxiliary_text-color)
  }
}
/*样式9*/
.drag-course-default9 {
  background: #fff;
  .course-item {
    padding: 15px 15px 15px 170px;
    position: relative;
    min-height: 74px;
    border-radius: 3px;
    overflow: hidden;
  }
  .item-images {
    height: 84px;
    width: 140px;
    position: absolute;
    left: 15px;
    top: 15px;
    border-radius: 8px;
  }
  .is-relay {
    position: absolute;
    top: 0;
    left: 0;
    color: #fff;
    letter-spacing: 0;
    background: rgba(0,0,0,0.4);
    border-radius: 8px 0;
    padding: 1px 6px;
  }
  .main-con .course-name {
    line-height: 2;
    display: -we4kit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    font-weight: bold;
    overflow: hidden;
    line-height: 24px;
    font-size: 18px;
    color: var(--primary_text-color);
    max-height: 48px;
    margin-top: 5px;
  }
  .course-desc {
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .course-desc,
  .course-price {
    color:var(--auxiliary_text-color);
    font-size: 12px;
    line-height: 24px;
    height: 24px;
    margin-top: 6px;
    overflow: hidden;
  }
  .course-price .charge {
    float: right;
    color: var(--ornament-color);
    font-size: 16px;
  }
}
/*样式10*/
.drag-course-default10 {
  background: #fff;
  .course-item {
    padding: 10px 95px 10px 75px;
    position: relative;
    min-height: 50px;
    border-radius: 3px;
  }
  .item-images {
    height: 48px;
    width: 48px;
    position: absolute;
    left: 15px;
    top: 10px;
  }
  .is-relay {
    position: absolute;
    bottom: 0;
    right: 0;
    color: #fff;
    letter-spacing: 0;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 4px 0 0 0;
    padding: 0 5px;
    font-size: 10px;
  }
  .main-con .course-name {
    line-height: 24px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    font-weight: bold;
    font-size: 16px;
    color:var(--primary_text-color);
    display: inline-block;
    white-space: nowrap; 
    width: 100%; 
    overflow: hidden;
    text-overflow:ellipsis;
  }
  .course-num {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    color: var(--auxiliary_text-color);
    font-size: 12px;
  }
  .ks-line::after {
    width: 90%;
    text-align: center;
    margin: 0 auto;
  }
  .buttom{
    position: absolute;
    right: 10px;
    top: 30%;
    border-radius: 24px;
    background: var(--primary-color);
    border-color: var(--primary-color);
  }
  .ks-icon{
    font-weight: 100;
  }
}


</style>
