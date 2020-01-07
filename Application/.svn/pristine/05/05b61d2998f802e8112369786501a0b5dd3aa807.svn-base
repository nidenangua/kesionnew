<template>
    <div>
        <div class="ks-blank10"></div>
        <div class="card-list" v-if="dataStyle == 1 || !dataStyle">
            <ks-swiper :options="swiperOption" ref="cardSwiper">
                <ks-swiper-slide v-for="(item,i) in dataList" :key="i">
                    <div
                        class="card-box"
                        :class="item.type == 2 && 'card-gold-item'"
                        @click="open(item)"
                    >
                        <h3>{{item.name}}</h3>
                        <p v-text="getDiscount(item)"></p>
                        <p>
                            <span class="price">
                                <i>￥</i>
                                {{item.price}}
                            </span>
                            <span class="effectivetime">/ {{getEffectiveTime(item.effectivetime)}}</span>
                        </p>
                        <a class="card-btn">立即开通</a>
                    </div>
                </ks-swiper-slide>
            </ks-swiper>
        </div>
        <div class="vip-list" v-else-if="dataStyle == 2">
            <div class="vip-box line" v-for="(item,i) in dataList" :key="i" @click="open(item)">
                <div class="vip-icon">
                    <img src="./assets/index_icon_vip.png">
                </div>
                <div class="vip-txt">
                    <h3>{{item.name}}</h3>
                    <p>{{getDiscount(item)}}</p>
                </div>
                <a class="vip-btn">立即开通</a>
            </div>
        </div>
    </div>
</template>
<script>
import { getUserCards } from "@/api/user";

export default {
  name: "KdVipCard",
  props: ["dataList", "dataStyle"],
  data() {
    return {
      swiperOption: {
        slidesPerView: 1.3,
        spaceBetween: 15
      }
    };
  },
  methods: {
    getEffectiveTime(effectivetime) {
      return (
        (effectivetime == 1 && "1个月") ||
        (effectivetime == 2 && "3个月") ||
        (effectivetime == 3 && "6个月") ||
        (effectivetime == 4 && "1年")
      );
    },
    getDiscount(item) {
      if (item.type == 1) {
        let discount = parseFloat(item.discount);
        return `全站${discount}折优惠`;
      } else if (item.type == 2) {
        return "全站免费";
      }
    },
    open(item) {
      this.$router.push({
        path: "/user/mycard",
        query: {
          id: item.id
        }
      });
    }
  },
  mounted() {}
};
</script>
<style scoped>
/*样式1*/
.card-list {
  background: #fff;
}
.card-list .swiper-container {
  padding: 15px;
}
.card-box {
  background: linear-gradient(to right, #97a0ab, #c9d3de);
  border-radius: 12px;
  padding: 15px;
  position: relative;
}
.card-box::after {
  content: "";
  width: 2.4rem;
  height: 2.4rem;
  background: url(./assets/card-icon.png) no-repeat;
  background-size: 100%;
  position: absolute;
  bottom: 15px;
  right: 20px;
}
.card-box h3 {
  font-size: 18px;
  line-height: 26px;
  height: 26px;
  overflow: hidden;
  color: #fff;
  background-repeat: no-repeat;
  background-position: 0 4px;
  background-image: url(./assets/v1.png);
  padding-left: 25px;
  background-size: auto 21px;
  margin-bottom: 5px;
  text-shadow: 0 1px 3px #8595a8;
}

.card-box p {
  color: #fff;
  line-height: 22px;
  font-size: 14px;
}
.card-box p .effectivetime {
  font-size: 12px;
}

.card-box p .price {
  font-size: 16px;
  color: #fff;
}
.card-box p .price i {
  font-size: 12px;
  font-style: normal;
  position: relative;
  top: -2px;
}
.card-box .card-btn {
  font-size: 14px;
  background: linear-gradient(to right, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.1));
  color: #fff;
  padding: 0 20px;
  height: 32px;
  line-height: 32px;
  display: inline-block;
  border-radius: 20px;
  margin-top: 15px;
}
.card-gold-item {
  background: linear-gradient(to right, #caa970, #e8cf9a);
}
.card-gold-item h3 {
  background-image: url(./assets/v2.png);
  text-shadow: 0 1px 3px #b99b69;
}

/*样式2*/
.vip-list {
  background: #fff;
}
.vip-list .vip-box {
  display: -webkit-flex;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  padding: 10px 15px;
}
.vip-list .vip-box:last-child::after {
  display: none;
}

.vip-list .vip-icon img {
  width: 50px;
}
.vip-list .vip-txt {
  flex: 2;
  padding-left: 15px;
}
.vip-list .vip-txt h3 {
  font-size: 15px;
  font-weight: 600;
  padding-bottom: 6px;
}
.vip-list .vip-txt p {
  font-size: 13px;
  color: var(--prompt-color);
}
.vip-list .vip-btn {
  font-size: 14px;
  color: #fff;
  background: linear-gradient(to right, #baa381, #bda283);
  padding: 0 10px;
  height: 32px;
  line-height: 32px;
  border-radius: 3px;
}
</style>
