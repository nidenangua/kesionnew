<template>
  <div class="kd-footer" v-if="$store.state.storeInfoReady">
    <ks-container class="kd-footer__box">
      <div class="kd-footer__code">
        <div class="kd-footer__code-item">
          <ks-image :src="info.qrcode" fit="cover" />
          <p>微信扫一扫，进入店铺</p>
        </div>
      </div>
      <div class="kd-footer__text" v-if="$store.state.info.version > 0 && $store.state.info.copyright">
        <!-- <div class="kd-footer__about">
					<a href="#">关于我们</a><span>|</span>
					<a href="#">联系我们</a><span>|</span>
					<a href="#">常见问题</a><span>|</span>
					<img src="./icon_wechat_publicAccount.png" /><a href="#">微信公众号</a>
				</div>
        <div class="kd-footer__link">友情链接：<a href="#">课堂街</a><span><a href="#">科汛在线教育</a></span></div>-->
        <div class="kd-footer__copyright" v-html="$store.state.info.copyright"></div>
      </div>
      <div class="kd-footer__text" v-else>
        <div class="kd-footer__copyright">
            <a href="#">厦门科汛有限公司</a>
            <span>&copy; 版权所有 2006-2019</span>
          </div>
          <div class="kd-footer__number">
            <img src="./icon_beian.png" />闽公网安备 35020302033007号
          </div>
      </div>
    </ks-container>
  </div>
</template>

<script>
export default {
  name: "KdFooter",
  data() {
    return {
      info: this.$store.state.info
    };
  },
  mounted() {
    this.$store.ready(state => {
      this.info = state.info;
    });
  }
};
</script>

<style scoped>
.kd-footer {
  padding: 20px 0;
  background: #fff;
  margin-top: 60px;
}

.kd-footer__text {
  color: #818a92;
  font-size: 14px;
}
.kd-footer__about {
  font-size: 14px;
  overflow: hidden;
}
.kd-footer__about span {
  margin: 0 20px;
  color: #cccccc;
}
.kd-footer__about a {
  float: left;
}
.kd-footer__about img {
  width: 14px;
  height: 14px;
  margin-right: 10px;
  float: left;
  margin-top: 2.5px;
}
.kd-footer__about span {
  float: left;
}
.kd-footer__link {
  margin-top: 25px;
}
.kd-footer__link span {
  margin-left: 10px;
}
.kd-footer__copyright {
  overflow: hidden;
  margin-top: 25px;
  line-height: 32px;
}
.kd-footer__copyright a {
  float: left;
}
.kd-footer__copyright span {
  margin-left: 10px;
  float: left;
}
.kd-footer__copyright img {
  width: 14px;
  height: 14px;
  margin-left: 10px;
  float: left;
  margin-top: 2px;
}

.kd-footer__number {
  margin-top: 25px;
  overflow: hidden;
  line-height: 20px;
}
.kd-footer__number img {
  float: left;
  margin-right: 5px;
}
.kd-footer__text a {
  color: #818a92;
  cursor: pointer;
}
.kd-footer__code {
  float: right;
  color: #818a92;
  font-size: 14px;
}
.kd-footer__code-item {
  float: right;
  margin-left: 60px;
  font-size: 14px;
  text-align: center;
  position: relative;
  top: -10px;
}
.kd-footer__code-item .ks-image {
  width: 100px;
  height: 100px;
  margin-left: 27px;
}
.kd-footer__code-item p {
  margin-top: 5px;
  text-align: center;
}
</style>
