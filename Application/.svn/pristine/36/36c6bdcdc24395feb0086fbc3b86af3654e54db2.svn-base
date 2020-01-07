<template>
  <div class="select-style" v-if="loaded">
    <ks-swiper :options="swiperOption" ref="styleSwiper">
      <ks-swiper-slide v-for="(item,i) in list" :key="i">
        <div class="phone">
          <img :src="item.defaultpic">
          <div class="current" v-if="item.tempid == mydiyid">正在使用</div>
          <div class="isedit" v-else-if="item.isedit">已修改</div>
        </div>
      </ks-swiper-slide>
    </ks-swiper>
    <div class="select-style__button ks-mt30">
      <ks-button
        type="primary"
        :disabled="mydiyid == currentid ? true : false"
        :round="true"
        @click="useStyle"
      >{{mydiyid == currentid ? '正在使用' : '使用该风格'}}</ks-button>
    </div>
    <store-footer/>
  </div>
</template>
<script>
import { getTemplist, saveChangeTemp } from "@/api/drag";
export default {
  name: "SetStoreStyle",
  data() {
    return {
      loaded: false,
      currentid: null,
      mydiyid: null,
      swiperOption: {
        slidesPerView: 1.5,
        centeredSlides: true,
        initialSlide: null,
        on: {
          transitionEnd: () => {
            this.$nextTick(() => {
              let index = this.$refs.styleSwiper.swiper.snapIndex;
              this.currentid = this.list[index].tempid;
            });
          }
        }
      },
      list: []
    };
  },
  methods: {
    /**
     * 使用风格
     */
    useStyle() {
      this.$showLoading("正在切换风格");
      saveChangeTemp({
        tempid: this.currentid
      }).then(res => {
        if (res.result === "success") {
          this.$store.dispatch("updateStoreInfo").then(() => {
            this.$hideLoading();
            this.$toast("设置成功", "success").then(() => {
              this.$router.push({
                name: "Index",
                query: {
                  reload: 1
                }
              });
            });
          });
        } else {
          this.$toast(res.msg);
        }
      });
    }
  },
  activated() {
    this.loaded = false;
    this.$showLoading();
    getTemplist().then(res => {
      this.mydiyid = res.mydiyid;
      this.currentid = res.mydiyid;
      this.list = res.values;
      res.values.map((item, index) => {
        if (item.tempid == res.mydiyid) {
          this.swiperOption.initialSlide = index;
        }
      });
      this.loaded = true;
      this.$hideLoading();
    });
  }
};
</script>
<style scoped>
.select-style {
  padding: 1.25rem 0;
}
.select-style .phone {
  width: 12.5rem;
  height: 25.625rem;
  box-sizing: border-box;
  background: url(../../../assets/user/phone.png) no-repeat;
  background-size: 100%;
  padding-top: 2.9166666666666665rem;
  margin: 0 auto;
}
.select-style .phone img {
  width: 11.583333333333334rem;
  height: 19.5rem;
  border: 0.041666666666666664rem solid #eee;
  display: block;
  margin: 0 auto;
}
.select-style .swiper-slide {
  transition: 0.4s;
  -webkit-transition: 0.4s;
}
.select-style .swiper-slide {
  transform: scale(0.8);
  transition: 0.3s;
  opacity: 0.85;
}
.select-style .swiper-slide-active {
  transform: scale(1);
  opacity: 1;
}
.phone .isedit,
.phone .current {
  padding: 0 0.416rem;
  height: 0.833rem;
  line-height: 0.833rem;
  text-align: center;
  color: #fff;
  position: absolute;
  top: 3.75rem;
  right: 0.45rem;
  font-size: 0.5rem;
  border-radius: 1.4166666666666667rem 0 0 1.4166666666666667rem;
}
.phone .isedit {
  background: #f98879;
}
.phone .current {
  background: #42b157;
}
.select-style__button {
  padding: 0 40px;
}
.select-style__button .ks-button {
  width: 100%;
}
</style>

