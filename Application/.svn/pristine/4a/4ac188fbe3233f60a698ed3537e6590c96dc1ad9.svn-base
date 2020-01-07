<template>
  <div v-if="loaded">
    <el-row class="msg-template-list" :gutter="20">
      <el-col class="item" :md="12" :lg="8" :xl="6" v-for="item in list" :key="item.id">
        <div class="inner">
          <div class="name">{{item.title}}</div>
          <div class="msg-phone">
            <img :src="'/Images/msg-cover/'+item.number+'.jpg'">
          </div>
          <div class="msg-state-change">
            <el-radio-group v-model="item.is_open" @change="changeMsgTemplate(item.number)">
              <el-radio :label="0">关闭</el-radio>
              <el-radio :label="1">开启</el-radio>
            </el-radio-group>
          </div>
        </div>
      </el-col>
    </el-row>
    <el-alert class="msg-alert" type="info">
      <p>1、只有认证通过的微信服务号才能使用本功能。</p>

      <p>2、需要登录微信公众平台中心,开通模版消息。</p>

      <p>3、需要登录微信公众平台中心，将行业分类设置为：IT科技/互联网|电子商务，教育/培训 或者教育/院校</p>
    </el-alert>
  </div>
</template>
<script>
import { getWechatMsgTemplate, wechatMsgTemplateOpen } from "@/api/wechat";
export default {
  name: "MsgTemplate",
  data() {
    return {
      loaded: false,
      list: []
    };
  },
  methods: {
    /**
     * 获取消息模板封面
     */
    getMsgCover(code) {
      return require(`../../assets/store/msg-cover/${code}.jpg`);
    },
    /**
     * 切换消息
     */
    changeMsgTemplate(number) {
      wechatMsgTemplateOpen({
        number: number
      }).then(res => {
        this.$msg(res.msg, res.result);
      });
    }
  },
  mounted() {
    this.$showLoading();
    getWechatMsgTemplate().then(res => {
      this.list = res.list;
      this.$nextTick(() => {
        this.$hideLoading();
        this.loaded = true;
      });
    });
  }
};
</script>
<style scoped>
.msg-alert {
  padding: 10px;
  line-height: 24px;
}
.msg-template-list {
  padding-bottom: 40px;
}
.msg-template-list .item {
  margin-top: 40px;
}
.msg-template-list .inner {
  border: 1px solid #e7eaf3;
  width: 290px;
  display: block;
  margin: 0 auto;
  border-radius: 15px;
}
.msg-template-list .name {
  text-align: center;
  height: 44px;
  line-height: 44px;
  font-size: 14px;
  border-bottom: 1px solid #e7eaf3;
}
.msg-template-list .msg-phone {
  width: 272px;
  height: 340px;
  background: url(../../assets/store/msg-phone.png) no-repeat;
  display: block;
  margin: 0 auto;
  margin-top: 20px;
  padding-top: 34px;
}
.msg-template-list .msg-phone img {
  width: 262px;
  display: block;
  margin: 0 auto;
}
.msg-state-change {
  text-align: center;
  height: 44px;
  line-height: 44px;
  border-top: 1px solid #e7eaf3;
  margin-top: 20px;
}
</style>


