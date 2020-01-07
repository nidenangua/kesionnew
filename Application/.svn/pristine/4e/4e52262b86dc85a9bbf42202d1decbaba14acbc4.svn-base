<template>
    <div class="navbanner">
      <el-row :gutter="24">
        <el-col :span="6" v-for="(item,i) in dataList" :key="i">
          <div class="navbanner__item" @click="open(item.url)">
            <div class="navbanner-box">
              <div class="navbanner-title">{{item.title}}</div>
              <div class="navbanner-desc">{{item.desc}}</div>
            </div>
            <div class="navbanner__image">
              <ks-image :src="item.imgUrl" />
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
</template>

<script>

export default {
  name: "KdNavbanner",
  props: {
    dataList: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  methods:{
    open(url){
      if(url){
        window.open(url)
      }
    }
  }
};
</script>

<style scoped>
.navbanner {
  width: 1160px;
  padding: 0 20px;
  margin: 0 auto;
  background: #fff;
  margin-top: 20px;
}
.navbanner .el-col{
    margin: 20px 0;
}
.navbanner__item {
  overflow: hidden;
  position: relative;
  cursor: pointer;
}
.navbanner-box{
  position: absolute;
  top: 10%;
  left: 10%;
  z-index: 10;
  color: #fff;
}
.navbanner-box .navbanner-title{
  font-size: 24px;
  line-height: 52px;
}
.navbanner-box .navbanner-desc{
  font-size: 14px;
}
.navbanner__image {
  width: 100%;
  height: 153px;
  overflow: hidden;
  border-radius: 10px;
}
.navbanner__image .ks-image {
  width: 100%;
  height: 153px;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.navbanner__item p {
  margin-top: 15px;
  font-size: 14px;
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

</style>
