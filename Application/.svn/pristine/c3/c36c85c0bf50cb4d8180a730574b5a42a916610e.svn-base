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
                    <span class="ks-fz16">摄影学习零基础训练营第一期</span>
                </div>
                <div class="ks-line bottom">
                    <div>
                        <div class="ks-color-info">200人购买</div>
                        <div class="ks-color-primary ks-fz14 price">
                            <span>￥ 99.00</span>
                            <span class="ks-color-info ks-ml10 original-price">￥ 120.00</span>
                        </div>
                    </div>
                    <div class="ks-text-center ks-color-primary">
                        <div>
                            <i class="ks-icon ks-icon-gift-outline gift"></i>
                        </div>
                        <div>送好友</div>
                    </div>
                </div>
                <div class="ks-mt10 ks-color-info">开课时间: 05月13日 12:00 - 06月13日 12:00</div>
            </div>
        </header>
        <main class="ks-mt10">
            <ks-tabs v-model="tabActive" @tab-click="handleClick">
                <ks-tab-pane label="简介" name="0"></ks-tab-pane>
                <ks-tab-pane label="目录" name="1"></ks-tab-pane>
            </ks-tabs>
        </main>
        <footer>
            <div class="placeholder"></div>
            <ks-button type="primary" width="100%" class="pay-btn">立即购买 (￥ 99.00)</ks-button>
        </footer>
    </div>
</template>

<script>
export default {
  name: "Phase",
  data() {
    return {
      tabActive: "0"
    };
  },
  methods: {
    /**选项卡发生变化 */
    handleClick(index) {
      console.log(index);
      this.tabActive = index;
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
  align-items: flex-end;
  justify-content: space-between;
  padding-bottom: 15px;
}
.header-info .price {
  position: relative;
  top: 5px;
}
.header-info .original-price {
  text-decoration: line-through;
}
.header-info .gift {
  font-size: 30px;
}

footer .placeholder {
  height: 44px;
}
footer .pay-btn {
  position: fixed;
  bottom: 0;
  font-weight: normal;
  border-radius: 0;
}
</style>
