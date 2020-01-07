<template>
    <div>
        <header>
            <ks-image
                src="http://timgsa.baidu.com/timg?image&quality=80&size=b10000_10000&sec=1563001135&di=4eb018dcc8efeca7293f2244a2161c8d&imgtype=jpg&src=http%3A%2F%2Fimg6.bdstatic.com%2Fimg%2Fimage%2Fpublic%2Fjiangsheng_yasuo1518080506.jpg"
                class="activity-cover"
            />
            <div class="ks-bg-white header-info">
                <div class="top">
                    <span class="ks-bg-primary tag">训练营</span>
                    <span class="ks-fz16">摄影学习零基础训练营</span>
                </div>
                <div class="bottom">
                    <div>
                        <div class="ks-color-info">200人购买</div>
                        <div class="ks-color-primary ks-fz14">￥ 99.00起</div>
                    </div>
                    <div class="ks-text-center ks-color-primary">
                        <div>
                            <i class="ks-icon ks-icon-gift-outline gift"></i>
                        </div>
                        <div>送好友</div>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <ks-tabs v-model="tabActive" @tab-click="handleClick" class="ks-line">
                <ks-tab-pane label="营期" name="0"></ks-tab-pane>
                <ks-tab-pane label="训练营简介" name="1"></ks-tab-pane>
            </ks-tabs>
            <div v-if="tabActive==0">
                <div class="ks-bg-white camp-period-list">
                    <div class="ks-row ks-mt10 camp-period-item" @click="goPhaseDetail">
                        <div class="ks-col-10 pic">
                            <img
                                src="http://timgsa.baidu.com/timg?image&quality=80&size=b10000_10000&sec=1563001135&di=10eb018dcc8efeca7293f221010a2161c8d&imgtype=jpg&src=http%3A%2F%2Fimg6.bdstatic.com%2Fimg%2Fimage%2Fpublic%2Fjiangsheng_yasuo1518080506.jpg"
                            >
                            <div class="tag-state tag-state__default">已结束</div>
                        </div>
                        <div class="ks-col-14 info">
                            <div class="ks-fz16">摄影学习训练第一期</div>
                            <div class="ks-color-info">开课时间: 05.17 20:00—05.31 20:00</div>
                            <div class="ks-color-info count">
                                <span>1654人加入</span>
                                <ks-button type="primary" class="pay-btn">立即购买</ks-button>
                            </div>
                        </div>
                    </div>
                    <div class="ks-row ks-mt10 camp-period-item" @click="goPhaseDetail">
                        <div class="ks-col-10 pic">
                            <img
                                src="http://timgsa.baidu.com/timg?image&quality=80&size=b10000_10000&sec=1563001135&di=10eb018dcc8efeca7293f221010a2161c8d&imgtype=jpg&src=http%3A%2F%2Fimg6.bdstatic.com%2Fimg%2Fimage%2Fpublic%2Fjiangsheng_yasuo1518080506.jpg"
                            >
                            <div class="tag-state tag-state__warning">上课中</div>
                        </div>
                        <div class="ks-col-14 info">
                            <div class="ks-fz16">摄影学习训练第二期</div>
                            <div class="ks-color-info">开课时间: 05.17 20:00—05.31 20:00</div>
                            <div class="ks-color-info">1654人加入</div>
                        </div>
                    </div>
                    <div class="ks-row ks-mt10 camp-period-item" @click="goPhaseDetail">
                        <div class="ks-col-10 pic">
                            <img
                                src="http://timgsa.baidu.com/timg?image&quality=80&size=b10000_10000&sec=1563001135&di=10eb018dcc8efeca7293f221010a2161c8d&imgtype=jpg&src=http%3A%2F%2Fimg6.bdstatic.com%2Fimg%2Fimage%2Fpublic%2Fjiangsheng_yasuo1518080506.jpg"
                            >
                            <div class="tag-state tag-state__primary">待上课</div>
                        </div>
                        <div class="ks-col-14 info">
                            <div class="ks-fz16">摄影学习训练第三期</div>
                            <div class="ks-color-info">开课时间: 05.17 20:00—05.31 20:00</div>
                            <div class="ks-color-info">1654人加入</div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="placeholder"></div>
                    <ks-button type="primary" width="100%" class="pay-btn">立即购买</ks-button>
                </div>
            </div>
            <div class="intro" v-else>
                <div v-html="content" class="ks-bg-white intro-content"></div>
                <!--店铺信息-->
                <store-info class="ks-mt10" v-if="$route.query.miniprogram != 1"/>
                <!--底部-->
                <store-footer/>
            </div>
        </main>
    </div>
</template>

<script>
export default {
  name: "TrainCamp",
  data() {
    return {
      tabActive: "0",
      content: "<p>这里是内容</p>"
    };
  },
  methods: {
    /**选项卡发生变化 */
    handleClick(index) {
      //   console.log(index);
      this.tabActive = index;
    },
    /**跳转到营期页面 */
    goPhaseDetail(){
        this.$router.push({
            name:"Phase"
        })
    }
  }
};
</script>

<style scoped>
.activity-cover {
  height: 11.5rem;
}
.header-info {
  padding: 10px;
}
.header-info .top {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
}
.header-info .tag {
  color: white;
  padding: 2px 5px;
  margin-right: 5px;
}
.header-info .bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.header-info .price {
  line-height: 2;
}
.header-info .gift {
  font-size: 30px;
}
.camp-period-list {
  padding: 0 10px 30px;
  overflow: hidden;
}
.camp-period-item .pic {
  position: relative;
}
.camp-period-item .pic img {
  min-height: 90px;
  border-radius: 5px;
}
.camp-period-item .tag-state {
  color: #ffffff;
  position: absolute;
  top: 0;
  right: 5px;
  width: 15px;
  max-height: 45px;
  line-height: 13px;
  padding: 3px 1px;
  padding-top: 5px;
  text-align: center;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}
.camp-period-item .tag-state__default {
  background-color: #b3b3b3;
}
.camp-period-item .tag-state__primary {
  background-color: #37a7ed;
}
.camp-period-item .tag-state__warning {
  background-color: #f28550;
}
.camp-period-item .tag-state__danner {
  background-color: #e5412c;
}
.camp-period-item .tag-state__success {
  background-color: #43b747;
}
.camp-period-item .info {
  padding: 5px;
  min-height: 90px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.camp-period-item .count {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.camp-period-item .pay-btn {
  font-weight: normal;
  border-radius: 50px;
  font-size: 12px;
  padding: 0 5px;
  height: 25px;
  line-height: 25px;
}
.footer .placeholder {
  height: 44px;
}
.footer .pay-btn {
  position: fixed;
  bottom: 0;
  font-weight: normal;
  border-radius: 0;
}
.intro-content {
  padding: 20px;
  min-height: 120px;
}
</style>
