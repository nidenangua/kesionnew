<template>
  <div class="kd-course">
    <div class="kd-course--default" v-if="!dataStyle || dataStyle == 1">
      <el-row :gutter="20">
        <el-col :span="8" v-for="(item,i) in dataList" :key="i">
          <div class="kd-course--default__item" @click="open(item)">
            <ks-image class="kd-course--default__image" hover="scale" :src="item.defaultpic"></ks-image>
            <div class="kd-course--default__content">
              <div class="kd-course--default__time" v-if="item.courseType == 2">直播时间：{{item.begindate_time}}</div>
              <p>{{item.title}}</p>
              <div class="kd-course--default__teacher">
                <span v-if="item.courseType == 2">主讲老师：{{item.teacher_name}}</span>
                <span v-else>{{item.soldnum}} 人学习</span>
                <el-button size="mini" round class="kd-course--default__btn">立即进入</el-button>
              </div>
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
    <!-- 样式2 -->
    <div class="kd-course--style2" v-else-if="dataStyle == 2">
      <el-row :gutter="24">
        <el-col :span="6" v-for="(item,i) in dataList" :key="i">
          <div class="kd-course--style2__item" @click="open(item)">
            <div class="kd-course--style2__image">
              <ks-image :src="item.defaultpic" />
            </div>
            <p>{{item.title}}</p>
            <div class="kd-course--style2__number">
              <h5>{{item.soldnum}}人学习</h5>
              <span :class="item.price !== '免费' && 'bold'">{{item.price}}</span>
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
    <!-- 样式3 -->
    <div class="kd-course--style3" v-else-if="dataStyle == 3">
      <div class="kd-course--style3__image" :class="other.banner.flag !== false && other.banner.url && 'ks-cursor-pointer'">
        <ks-image :src="other.banner.src" v-if="other.banner" @click="openBannerUrl(other.banner)" />
      </div>
      <div class="kd-course--style3__item">
        <div class="kd-course--style3__item-box" v-for="(item,i) in dataTop6" :key="i"  @click="open(item)">
          <div class="kd-course--style3__img">
            <ks-image hover="scale" :src="item.defaultpic"></ks-image>
          </div>
          <p>{{item.title}}</p>
        </div>
      </div>
    </div>
    <!-- 样式4 -->
    <div class="kd-course--style4" v-else-if="dataStyle == 4">
      <div class="kd-course--style4__image" :class="other.banner.flag !== false && other.banner.url && 'ks-cursor-pointer'">
        <ks-image :src="other.banner.src" v-if="other.banner" @click="openBannerUrl(other.banner)" />
      </div>
      <div class="kd-course--style5__item">
        <div class="kd-course--style5__item-top">
          <div class="kd-course--style5__item-left" @click="open(data0)" v-if="data0">
            <ks-image class="kd-course--style5__item-image" hover="scale" :src="data0.defaultpic"></ks-image>
            <p>{{data0.title}}</p>
          </div>
          <div class="kd-course--style5__item-right">
            <div class="kd-course--style5__img" :class="{ksmt20 : i === 1}"  v-for="(item,i) in data12" :key="i"  @click="open(item)">
              <ks-image hover="scale" :src="item.defaultpic"></ks-image>
              <p>{{item.title}}</p>
            </div>
          </div>
        </div>
        <div class="kd-course--style5__item-bottom ksmt20">
          <div class="kd-course--style5__img ksfl" :class="{ksml20 : i > 0}"  v-for="(item,i) in data345" :key="i"  @click="open(item)">
            <ks-image hover="scale" :src="item.defaultpic"></ks-image>
            <p>{{item.title}}</p>
          </div>
        </div>
      </div>
      <div class="kd-course--style4__course">
        <div class="kd-course--style4__course-content" v-for="(item,i) in data6789" :key="i"  @click="open(item)">
          <div class="kd-course--style4__course-title">{{item.title}}</div>
          <div class="kd-course--style4__time" v-if="item.courseType == 2">
            直播时间：{{item.begindate_time}}
          </div>
          <div class="kd-course--style4__time" v-else>
            {{item.shortdesc}}
          </div>
          <div class="kd-course--style4__course-teacher">
            <span v-if="item.courseType == 2">主讲老师：{{item.teacher_name}}</span>
            <span v-else>{{item.soldnum}} 人学习</span>
            <el-button type="primary" size="mini" round>立即进入</el-button>
          </div>
        </div>
      </div>
    </div>
    <!-- 样式5 -->
    <div class="kd-course--style5" v-else-if="dataStyle == 5">
      <div class="kd-course--style5__image" :class="other.banner.flag !== false && other.banner.url && 'ks-cursor-pointer'">
        <ks-image :src="other.banner.src" v-if="other.banner" @click="openBannerUrl(other.banner)" />
      </div>
      <div class="kd-course--style5__item">
        <div class="kd-course--style5__item-top">
          <div class="kd-course--style5__item-left"  @click="open(data0)" v-if="data0">
						<div class="kd-course--style5__item-image">
							<ks-image :src="data0.defaultpic" />
						</div>
						<p>{{data0.title}}</p>
          </div>
          <div class="kd-course--style5__item-right">
            <div class="kd-course--style5__img" :class="{ksmt20 : i === 1}"  v-for="(item,i) in data12" :key="i"  @click="open(item)">
							<div class="kd-course--style5__item-image">
								<ks-image :src="item.defaultpic"></ks-image>
							</div>
							<p>{{item.title}}</p>
            </div>
          </div>
        </div>
        <div class="kd-course--style5__item-bottom ksmt20">
          <div class="kd-course--style5__img ksfl" :class="{ksml20 : i > 0}"  v-for="(item,i) in data345" :key="i"  @click="open(item)">
            <div class="kd-course--style5__item-image">
            	<ks-image :src="item.defaultpic"></ks-image>
            </div>
            <p>{{item.title}}</p>
          </div>
        </div>
      </div>
      <div class="kd-course--style5__course">
        <div class="kd-course--style5__course-image" @click="open(dataAbove5[0])">
          <ks-image :src="dataAbove5[0] && dataAbove5[0].defaultpic"></ks-image>
        </div>
        <div class="kd-course--style5__course-list" v-for="(item,i) in dataAbove5" :key="i"  @click="open(item)">
          <span>{{i+1}}</span>
          <p>{{item.title}}</p>
        </div>
      </div>
    </div>
    <!-- 样式6 -->
    <div class="kd-course--style6" v-else-if="dataStyle == 6">
      <el-row :gutter="24">
        <el-col :span="12">
          <div class="kd-course--style6__item kd-course--style6__banner">
            <ks-image :src="other.banner.src" @click="openBannerUrl(other.banner)" />
          </div>
        </el-col>
        <el-col :span="6" v-for="(item,i) in dataList" :key="i">
          <div class="kd-course--style6__item" @click="open(item)">
            <div class="kd-course--style6__image">
              <ks-image :src="item.defaultpic" />
            </div>
            <p>{{item.title}}</p>
            <div class="kd-course--style6__number">
              <h5>{{item.soldnum}}人学习</h5>
              <span :class="item.price !== '免费' && 'bold'">{{item.price}}</span>
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
export default {
  name: "KdCourse",
  props: {
    /**数据列表 */
    dataList: {
      type:Array,
      default(){
        return []
      }
    },
    /**信息类型 course | column */
    dataType:String,
    /**样式风格 */
    dataStyle: Number,
    other: {
      type:Object,
      default(){
        return {}
      }
    }
  },
  data(){
    return {
      activeName: 'second',
      /**第一条数据 */
      data0:null,
      /**第2、3条数据 */
      data12:[],
      /**第3、4、5条数据 */
      data345:[],
      /**第6、7、8、9条数据 */
      data6789:[],
      /**第5以上的数据 */
      dataAbove5:[],
      /**前6条数据 */
      dataTop6:[]
    }
  },
  watch:{
    dataList:{
      handler(list){
        let _data0 = null;
        let _data12 = [];
        let _data345 = [];
        let _data6789 = [];
        let _dataAbove5 = [];
        let _dataTop6 = [];
        if(list.length){
          list.map((item,i)=>{
            if(i === 0){
              _data0 = item
            }else if(i > 0 && i < 3){
              _data12.push(item)
            }else if(i>=3 && i < 6){
              _data345.push(item)
            }else if(i>=6 && i < 10){
              _data6789.push(item)
            }
            if(i<6){
              _dataTop6.push(item)
            }
            if(i>=6 && i < 15){
              _dataAbove5.push(item)
            }
          })
        }
        this.data0 = _data0;
        this.data12 = _data12;
        this.data345 = _data345;
        this.data6789 = _data6789;
        this.dataAbove5 = _dataAbove5;
        this.dataTop6 = _dataTop6;
      },
      immediate:true
    }
  },
  methods: {
    /**
     * 打开图片地址
     */
    openBannerUrl(obj){
      if(obj.flag === false){
        return
      }
      if(obj.url){
        location.href = obj.url
      }
    },
    /**打开内容 */
    open(item = {}) {
      if (this.dataType === "course") {
        this.$router.push({
					name:"CourseDetail",
					params:{
						id:item.courseid
					}
				});
      } else if (this.dataType === "column") {
        this.$router.push({
					name:"ColumnDetail",
					params:{
						id:item.columnid
					}
				});
      }
    },
    handleClick(tab, event) {
      console.log(tab, event);
    }
  }
};
</script>

<style scoped>
.kd-course {
  width: 1160px;
  padding: 0 20px;
  margin: 0 auto;
  background: #fff;
}
.el-col {
  margin-bottom: 20px;
}
/* 默认样式 */
.kd-course--default {
  padding: 10px 0;
}
.kd-course--default__item {
  overflow: hidden;
}
.kd-course--default__image {
  width: 160px;
  height: 90px;
  float: left;
  overflow: hidden;
  cursor: pointer;
}

.kd-course--default__content {
  width: 200px;
  margin-left: 10px;
  float: right;
}
.kd-course--default__time {
  font-size: 12px;
  color: #929a9e;
  cursor: pointer;
}
.kd-course--default__content p {
  font-size: 14px;
  color: #2d3336;
  margin-top: 6px;
  line-height: 20px;
  height: 40px;
  cursor: pointer;
  text-overflow: -o-ellipsis-lastline;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
}
.kd-course--default__item:hover p {
  color: #2e84ee;
}
.kd-course--default__teacher {
  color: #929a9e;
  overflow: hidden;
  height: 28px;
  line-height: 28px;
  margin-top:5px;
}
.kd-course--default__teacher span {
  font-size: 12px;
  float: left;
  cursor: pointer;
}
.kd-course--default__btn {
  float: right;
  border:1px solid #409EFF;
  color:#409EFF;
}
/* 样式2 */
.kd-course--style2 {
  padding: 10px 0 5px 0;
}
.kd-course--style2__item {
  overflow: hidden;
}
.kd-course--style2__image {
  width: 100%;
  height: 153px;
  overflow: hidden;
}
.kd-course--style2__image .ks-image {
  width: 100%;
  height: 153px;
  cursor: pointer;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.kd-course--style2__item p {
  margin-top: 15px;
  font-size: 14px;
  line-height: 21px;
  cursor: pointer;
  margin-bottom: 5px;
  height: 42px;
  text-overflow: -o-ellipsis-lastline;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
}
.kd-course--style2__item:hover .ks-image {
  transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -o-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -ms-transform: scale(1.1);
}
.kd-course--style2__number {
  height: 30px;
  line-height: 30px;
  cursor: pointer;
}
.kd-course--style2__number h5 {
  float: left;
  color: #929a9e;
  font-size: 14px;
  cursor: pointer;
  font-weight: normal;
}
.kd-course--style2__number span {
  font-size: 14px;
  color: #555;
  float: right;
}
.kd-course--style2__number .bold {
  font-weight: bold;
}
/* 样式3 */
.kd-course--style3 {
  padding: 10px 0 30px 0;
  height: 445px;
}
.kd-course--style3__image {
  width: 250px;
  height: 445px;
  float: left;
  overflow: hidden;
}
.kd-course--style3__image .ks-image{
  width: 100%;
  height: 100%;
}
.kd-course--style3__item {
  width: 910px;
  height: 436px;
  float: right;
}

.kd-course--style3__item-box {
  width: 272px;
  height: 210px;
  margin-left: 24px;
  float: left;
  padding-bottom: 16px;
}
.kd-course--style3__img {
  width: 100%;
  height: 153px;
  cursor: pointer;
  overflow: hidden;
}
.kd-course--style3__item-box p {
  margin-top: 13px;
  font-size: 14px;
  line-height: 22px;
  height: 44px;
  cursor: pointer;
  text-overflow: -o-ellipsis-lastline;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
}
/* 样式4 */
.kd-course--style4 {
  height: 475px;
  padding: 10px 0 30px 0;
  background: #fff;
}
.kd-course--style4__image {
  width: 250px;
  height: 475px;
  float: left;
  overflow: hidden;
}
.kd-course--style4__image .ks-image {
  width: 100%;
  height: 100%;
}
.kd-course--style4__item {
  float: left;
  margin-left: 20px;
  width: 640px;
}
.kd-course--style4__item-top {
  overflow: hidden;
}
.kd-course--style4__item-left {
  width: 420px;
  height: 236px;
  float: left;
  overflow: hidden;
  cursor: pointer;
}
.kd-course--style4__item-left .ks-image {
  width: 100%;
  height: 100%;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.kd-course--style4__item-left:hover .ks-image {
  transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -o-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -ms-transform: scale(1.1);
}
.kd-course--style4__item-right {
  width: 200px;
  height: 236px;
  float: right;
}
.kd-course--style4__item-bottom {
  width: 100%;
  height: 112px;
}
.kd-course--style4__img {
  width: 200px;
  height: 112px;
  cursor: pointer;
  overflow: hidden;
}

.kd-course--style4__course {
  width: 224px;
  float: right;
  height: 480px;
  overflow: hidden;
}

.kd-course--style4__course-content {
  padding-bottom: 9px;
  border-bottom: 1px dashed #eeeeee;
}
.kd-course--style4__course-title {
  font-size: 14px;
  color: #2d3336;
  margin-top: 10px;
  cursor: pointer;
  text-overflow: ellipsis;
  height:24px;
  line-height: 24px;
  overflow: hidden;
}
.kd-course--style4__time {
  margin-top: 5px;
  color: #929a9e;
  cursor: pointer;
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.kd-course--style4__course-teacher {
  color: #929a9e;
  margin-top: 20px;
  line-height: 28px;
  height: 28px;
  overflow: hidden;
}
.kd-course--style4__course-teacher span {
  float: left;
  cursor: pointer;
}
.kd-course--style4__course-teacher .el-button{
  float: right;
}
.kd-course--style4__img .ks-image {
  width: 100%;
  height: 100%;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.kd-course--style4__img:hover .ks-image {
  transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -o-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -ms-transform: scale(1.1);
}
/* 样式5 */
.kd-course--style5 {
  height: 490px;
  padding: 10px 0 30px 0;
  background: #fff;
}
.kd-course--style5__image {
  width: 260px;
  height: 100%;
  float: left;
  overflow: hidden;
}
.kd-course--style5__image .ks-image {
  width: 100%;
  height: 100%;
}

.kd-course--style5__item {
  float: left;
  margin-left: 20px;
  width: 640px;
}
.kd-course--style5__item-top {
  width: 100%;
  overflow: hidden;
}
.kd-course--style5__item-left {
  width: 420px;
  height: 310px;
  float: left;
  cursor: pointer;
  overflow: hidden;
}

.kd-course--style5__item-left .kd-course--style5__item-image{
	width: 100%;
	height: 240px;
	overflow: hidden;
}
.kd-course--style5__item p {
  margin-top: 6px;
  font-size: 14px;
  line-height: 24px;
  height: 24px;
  cursor: pointer;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  
}

.kd-course--style5__item-right {
  width: 200px;
	overflow: hidden;
  float: right;
}

.kd-course--style5__img {
  width: 200px;
  height: 140px;
  cursor: pointer;
  overflow: hidden;
}
.kd-course--style5__img .ks-image{
  height: 112px;
}

.kd-course--style5__item-bottom {
  width: 100%;
  height: 150px;
}

.kd-course--style5__course {
  width: 232px;
  height: 320px;
  float: right;
  cursor: pointer;
}
.kd-course--style5__course-image {
  width: 100%;
  height: 150px;
  margin-bottom: 10px;
  cursor: pointer;
  overflow: hidden;
}
.kd-course--style5__course-list {
  height: 36px;
  line-height: 36px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.kd-course--style5__course-list + .kd-course--style5__course-list{
  border-top:1px dashed #dedede;
}
.kd-course--style5__course-list span {
  width: 14px;
  height: 14px;
  color: #2e84ee;
  background: rgba(208, 237, 255, 0.3);
  margin-right: 10px;
  text-align: center;
  line-height: 14px;
  float: left;
  position: relative;
  top:11px;
}
.kd-course--style5__course-list p {
  width: 205px;
  color: #2d3336;
  font: 16px;
  float: left;
  text-overflow: -o-ellipsis-lastline;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  line-clamp: 1;
  -webkit-box-orient: vertical;
}

/* 样式6 */
.kd-course--style6 {
  padding: 10px 0 5px 0;
}
.kd-course--style6__item {
  overflow: hidden;
  height: 236px;
  cursor: pointer;
}
.kd-course--style6__image {
  width: 100%;
  height: 153px;
  overflow: hidden;
  border-radius: 10px;
}
.kd-course--style6__image .ks-image {
  width: 100%;
  height: 153px;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.kd-course--style6__item p:first-child{
  display: none;
}
.kd-course--style6__item p {
  margin-top: 15px;
  font-size: 16px;
  line-height: 21px;
  
  margin-bottom: 5px;
  height: 42px;
  text-overflow: -o-ellipsis-lastline;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
}
.kd-course--style6__item:hover .ks-image {
  transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -o-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -ms-transform: scale(1.1);
}
.kd-course--style6__banner:hover .ks-image{
  transform: scale(1);
  -webkit-transform: scale(1);
  -o-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
}
.kd-course--style6__number {
  height: 30px;
  line-height: 30px;
}
.kd-course--style6__number h5 {
  float: right;
  font-size: 14px;
  color:#999;
  font-weight: normal;
}
.kd-course--style6__number span {
  font-size: 14px;
  color: #e00;
  float: left;
}

.ksmt20 {
  margin-top: 20px;
}
.ksfl {
  float: left;
}
.ksml20 {
  margin-left: 20px;
}

</style>
