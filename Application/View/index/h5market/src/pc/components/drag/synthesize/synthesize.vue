<template>
    <div class="synthesize">
      <el-row :gutter="24">
      <el-col :span="18">
        <div class="synthesize__left">
          <el-tabs v-model="activeName">
            <el-tab-pane :label="item.label" :name="'tab'+i" v-for="(item,i) in tabsData" :key="i">  
              <el-row :gutter="24" style="margin-top:-15px">
                <el-col :span="6" v-for="course in item.list" :key="course.courseid">
                  <div class="synthesize__item" @click="open(course)">
                    <div class="synthesize__image">
                      <ks-image :src="course.defaultpic" />
                    </div>
                    <div class="synthesize__title">{{course.title}}</div>
                    <div class="synthesize__number">
                      {{course.shortdesc}}
                    </div>
                  </div>
                </el-col>
                
              </el-row>
            </el-tab-pane>
          </el-tabs>
        </div>
      </el-col>
      <el-col :span="6">
         <div class="synthesize-ranking">
            <div class="synthesize-ranking__head">
              {{ranking.title.name}}
            </div>
            <ul>
              <li v-for="(item,i) in ranking.list" :key="i" @click="open(item)">
                <div class="synthesize-ranking__num">{{i+1}}</div>
                <div class="synthesize-ranking__title">
                  {{item.title}}
                </div>
                <div class="synthesize-ranking__desc">{{item.studentcount}}人学习</div>
              </li>
            </ul>
            <div class="synthesize-ranking__more" @click="openLink(ranking.title.more)">查看更多></div>
          </div>
      </el-col>
      </el-row>
    </div>
</template>

<script>

export default {
  name: "KdSynthesize",
  props: {
    tabsData: {
      type: Array,
      default() {
        return []
      }
    },
    ranking:{
      type: Object,
      default() {
        return {
          title:{},
          list:[]
        }
      }
    }
  },
  data() {
     return {
      activeName: 'tab0',
     }
  },
  methods: {
    openLink(url){
      if(!url){
        return
      }
      location.href = url
    },
    open(item){
      window.open('#/course/'+item.courseid)
    }
  },
  mounted() {
       
  }
};
</script>

<style scoped>
.synthesize {
  width: 1200px;
  margin: 0 auto;
  margin-top: 20px;
}
.synthesize__left{
  background: #fff;
  padding: 10px 20px 20px 20px;
}
.synthesize__item {
  overflow: hidden;
  margin-top: 20px;
}
.synthesize__image {
  width: 100%;
  height: 120px;
  overflow: hidden;
  border-radius: 10px;
}
.synthesize__image .ks-image {
  width: 100%;
  height: 100%;
  cursor: pointer;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.synthesize__title{
  margin-top: 10px;
  font-size: 16px;
  line-height: 22px;
  height: 22px;
  cursor: pointer;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;

}
.synthesize__item:hover .ks-image {
  transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -o-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -ms-transform: scale(1.1);
}
.synthesize__number {
    height: 40px;
    overflow: hidden;
    line-height: 20px;
    cursor: pointer;
    color: #999;
    margin-top: 10px;
}
.synthesize__number h5 {
  float: left;
  color: #929a9e;
  font-size: 14px;
  cursor: pointer;
  font-weight: normal;
}
.synthesize__number span {
  font-size: 14px;
  color: #555;
  float: right;
}

.synthesize >>>.el-tabs__nav-wrap::after {
    height: 1px;
}
.synthesize >>> .el-tabs__item{
  font-size: 16px;
  color:#999;
}
.synthesize >>> .el-tabs__item.is-active{
  color:#2e84ee;
  font-size: 18px;
}
.synthesize-ranking{
  background: #fff;
  padding: 10px 15px 
}
.synthesize-ranking__head{
  font-size: 18px;
  height: 38px;
  line-height: 38px;
  overflow: hidden;
  background: #fff;
  color: #2d3336;
  border-bottom: 1px solid #e4e7ed;
}

.synthesize-ranking li{
  position: relative;
  padding: 3px 15px 3px 40px;
  margin-top: 10px;
  cursor: pointer;
}
.synthesize-ranking li:hover{
  background: #f9f9f9;
}
.synthesize-ranking__num{
  width: 20px;
  height: 20px;
  background: #cdcdce;
  color:#fff;
  border-radius: 50%;
  text-align: center;
  line-height: 20px;
  position: absolute;
  left: 10px;
  top: 10px;
}
.synthesize-ranking__title{
  font-size: 16px;
  height: 24px;
  line-height: 24px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
.synthesize-ranking__desc{
  font-size: 12px;
  color:#999;
  height: 20px;
  line-height: 20px;
}
.synthesize-ranking li:first-child .synthesize-ranking__num{
  background: #fdba07;
}
.synthesize-ranking li:nth-child(2) .synthesize-ranking__num{
  background: #fdd50a;
}
.synthesize-ranking li:nth-child(3) .synthesize-ranking__num{
  background: #fd7903;
}
.synthesize-ranking__more{
  text-align: center;
  line-height: 34px;
  font-size: 14px;
  color:#999;
}
</style>
