<template>
  <div class="admire-wrap">
    <div class="title">
      <span>感觉还不错，给点打赏吧</span>
    </div>
    <div class="admire" @click="admireFlag = true">打赏</div>
    <div class="admire-title">
      <span>{{admireCount}}</span>人赞赏
    </div>
    <div class="admire-list">
      <div class="admire-list__item" v-for="(item,i) in admire" :key="i">
        <ks-image :src="item.userhead" type="user"></ks-image>
      </div>
    </div>
    <ks-dialog title="打赏作者" :visible.sync="admireFlag">
      <reward-select :type="type" :info-id="infoId" />
    </ks-dialog>
  </div>
</template>
<script>
import RewardSelect from './RewardSelect';
import { getAdmireList } from "@/api/course";
export default {
  name: "Reward",
  components:{
    RewardSelect
  },
  props: ["infoId", "type"],
  data() {
    return {
      /**
       * 打赏列表
       */
      admire: [],
      admireCount: 0,
      admireFlag: false
    };
  },
  mounted() {
    let _type;
    switch (this.type) {
      case "exam":
        _type = 3;
        break;
      case "courseReward":
        _type = 4;
        break;
      case "classReward":
        _type = 6;
        break;
      case "columnReward":
        _type = 8;
        break;
    }
    getAdmireList({
      id: this.infoId,
      type: _type
    }).then(res => {
      this.admireCount = res.count;
      this.admire = res.list;
    });
  }
};
</script>
<style scoped>
.admire-wrap {
  padding: 15px 0;
}
.admire-wrap .title {
  height: 44px;
  line-height: 44px;
  position: relative;
  text-align: center;
  margin: 0 15px;
}
.admire-wrap .title:after {
  content: "";
  width: 100%;
  height: 1px;
  background: #eef2f5;
  position: absolute;
  top: 50%;
  left: 0;
  overflow: hidden;
}
.admire-wrap .title span {
  position: relative;
  background: #fff;
  z-index: 9;
  padding: 0 20px;
  font-size: 14px;
}
.admire {
  width: 70px;
  height: 34px;
  margin: auto;
  margin-top: 10px;
  background: #dd5e4d;
  text-align: center;
  border-radius: 4px;
  color: #fff;
  font-size: 14px;
  line-height: 34px;
}
.admire__text_btn {
  text-align: center;
  height: 44px;
  line-height: 44px;
  display: inline-block;
  padding: 0 15px;
  text-align: center;
  font-size: 14px;
}
.admire-list {
  overflow: hidden;
}
.admire-list__item {
  float: left;
  width: 12.5%;
  margin-top: 10px;
}
.admire-list__item .ks-image {
  width: 30px;
  height: 30px;
  display: block;
  margin: 0 auto;
  border-radius: 50%;
}
.admire-title {
  text-align: center;
  margin: 10px 0;
  font-size: 14px;
  color: #999;
}
.admire-list .item .inner {
  margin: 0 5px;
}
.admire-list .item .inner img {
  width: 100%;
  height: auto;
  border-radius: 50%;
}


</style>
