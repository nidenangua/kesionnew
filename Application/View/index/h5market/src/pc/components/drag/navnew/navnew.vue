<template>
    <div class="navnew">
      <el-row :gutter="24">
        <el-col :span="3">
          <div class="kd-title__item">
            <a class="kd-title__link"></a>
            热点资讯
          </div>
        </el-col>
        <el-col :span="7" v-for="(item,i) in dataList" :key="i">
          <div class="kd-course__newitem" @click="open(item.id)">{{item.title}}</div>
        </el-col>
      </el-row>
    </div>
</template>

<script>

export default {
  name: "KdNavnew",
  props: {
    dataList: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  methods:{
    open(id){
      window.open('#/news/'+id)
    }
  }
};
</script>

<style scoped>
.navnew {
  width: 1160px;
  padding: 10px 20px;
  margin: 0 auto;
  background: #fff;
  margin-top: 20px;
}
.navnew__item {
  overflow: hidden;
}
.navnew .kd-title__link{
  width: 2px;
  height: 20px;
  background: #2e84ee;
  display: block;
  float: left;
  margin: 9px 10px 6px 0;
}
.navnew .kd-course__newitem{
    font-size: 14px;
    line-height: 38px;
    cursor: pointer;
    text-overflow: -o-ellipsis-lastline;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    color: #FF1A1A;
}
.navnew .el-col{
  margin-bottom: 0px;
}
.navnew .kd-title__item{
    font-size: 20px;
    line-height: 38px;
    overflow: hidden;
    color: #2d3336;
}
</style>
