<template>
  <div>
    <div v-if="groupList.length" class="page">
      <ks-swiper :options="swiperOption" class="card-swiper" ref="cardSwiper">
        <ks-swiper-slide v-for="(item,index) in groupList" :key="index">
          <div :class="{'card-item card-item--ask carditemask0':index === 0,'card-item card-item--ask carditemask1':index === 1,'card-item card-item--ask carditemask2':index === 2,'card-item card-item--ask carditemask3':index === 3,}">
              <div class="card-item__have" v-if="version < 4 && version >= index && version < 4 && version != 0"></div>
              <div v-if="index == 0" class="name">万人名师
                <div class="price" v-if="index == 0 && version < 4 && version !=index" >免费/年</div>
                <div class="price" v-if="version < 4 && version ==index" >到期时间{{version_msg}}</div>
              </div>
              <div v-if="index == 1" class="name">基础运营版
                <div class="price" v-if="index == 1 && version < 4 && version !=index" >￥ 12888/年</div>
                <div class="price" v-if="version < 4 && version ==index" >到期时间{{version_msg}}</div>
              </div>
              <div v-if="index == 2" class="name">高级运营版
                 <div class="price" v-if="index == 2 && version < 4 && version !=index" >￥ 28888/年  </div>
                 <div class="price" v-if="version < 4 && version ==index" >到期时间{{version_msg}}</div>
              </div>
              <div v-if="index == 3" class="name">钻石服务版
                 <div class="price" v-if="index == 3 && version < 4 && version !=index" >￥ 52888/年</div>
                 <div class="price" v-if="version < 4 && version ==index" >到期时间{{version_msg}}</div>
              </div>
          </div>
        </ks-swiper-slide>
      </ks-swiper>

      <div class="card-intro">
        <h4>版本权益</h4>
        <div class="intro">
          <a v-for="(item,index) in list" :key="index">{{index+1}}、{{item}}<br></a>
        </div>
      </div>
      <div class="card-button-footer">
        <ks-button
          width="100%"
          class="card-button"
          type="primary"
          :disabled="version > index ? true :false"
          @click="dredge"
          v-if="version != index"
        >立即开通</ks-button>
        <ks-button
          width="100%"
          class="card-button"
          type="primary"
          :disabled="version > index ? true :false ||  version == 0 ? true : false"
          @click="dredge"
          v-if="version == index"
        >立即续费</ks-button>
      </div>
    </div>
    <ks-empty v-else-if="loaded" msg="没有找到会员卡～"/>
  </div>
</template>
<script>
import { showVersion,upVersion } from "@/api/user";

export default {
  name: "UserCard",
  data() {
    return {
      loaded: false,
      special:false,
      version:'',
      /**到期时间 */
      version_msg:'',
      /**
       * 当前选择的会员卡信息
       */
      selected: {
        price: "",
        other: "",
        offer: "",
        costlevel: "",
        id: "",
        type:"",
        effectivemonth: ""
      },
      index:0,
      list:[],
      mygroup: {},
      groupList: [],
      swiperOption: {
        slidesPerView: 1.1,
        centeredSlides: true,
        initialSlide: null,
        on: {
        initialSlide: null,
          transitionEnd: () => {
            this.$nextTick(() => {
              let index = this.$refs.cardSwiper.swiper.snapIndex;
              this.index = index
              this.setSelected(this.groupList[index]);
            });
          }
        }
      }
      
    };
  },

  methods: {
    /**
     * 设置当前选中的会员卡信息
     */
    setSelected(item) {
      this.list = item;
    },
    /**开通 */
    dredge() {
      let id = 0;
        switch(this.index){
          case 1:
            id = 104
            break;
          case 2:
            id = 107
            break;
          case 3:
            id = 111
          break;
        }
      upVersion({appid:id}).then(res=>{
        location.href = res.url
      })
    }
  },
  activated() {
    showVersion().then(res => {
       let selected;
       this.groupList = res.list;
       this.list = res.list[0],
       this.special = res.special,
       this.version = res.version
       this.version_msg = res.term
      });
  }
};
</script>
<style scoped>
.card-swiper {
  padding: 20px;
}
.card-item {
  height: 4rem;
  background: linear-gradient(to right, #97a0ab, #c9d3de);
  border-radius: 12px;
  padding: 20px 30px;
  position: relative;
}

.card-item__have {
  width: 3rem;
  height: 3.2rem;
  background: url(../../../assets/user/have.png) no-repeat;
  background-size: 100% auto;
  position: absolute;
  right: -0.1rem;
  top: -0.1rem;
}
/* .card-item::after {
  content: "";
  width: 3rem;
  height: 3rem;
  background-repeat: no-repeat;
  background-image: url(../../../assets/user/card-icon.png);
  background-size: 100%;
  position: absolute;
  bottom: 20px;
  right: 30px;
} */
.card-item .discount {
  text-align: right;
  color: rgba(255, 255, 255, 0.7);
}
.card-item .discount__have {
  padding-right: 30px;
}
/* .card-item .name {
  font-size: 20px;
  line-height: 32px;
  color: #fff;
  background-repeat: no-repeat;
  background-position: 0 6px;
  background-image: url(../../../assets/user/v1.png);
  padding-left: 34px;
  background-size: auto 24px;
} */
.card-item .price {
  color: #FFF;
  font-size: 14px;
  line-height: 24px;
  text-align: center;
}
.card-item--gold {
  background: linear-gradient(to right, #caa970, #e8cf9a);
}
.card-item--gold .name {
  background-image: url(../../../assets/user/v2.png);
}
.carditemask0{background: url(https://v.kesion.com/Template/skin1/public/VT/images/title1.png) no-repeat;}
.carditemask1{background: url(https://v.kesion.com/Template/skin1/public/VT/images/title2.png) no-repeat;}
.carditemask2{background: url(https://v.kesion.com/Template/skin1/public/VT/images/title3.png) no-repeat;}
.carditemask3{background: url(https://v.kesion.com/Template/skin1/public/VT/images/title4.png) no-repeat;}
.card-item--ask{
    display: -moz-box;
    display: -webkit-box;
    -moz-box-align: center;
    -webkit-box-align: center;
    -moz-box-pack: center;
    -webkit-box-pack: center;
    background-size: 100% 100%;
    color: #fff;
    font-size: 1.2rem;
    text-align: center;
}
/* .card-item--ask .name{
  color:#f6f09f
}
.card-item--ask .price{
  color:#d1b77e;
}
.card-item--ask .name {
  background-image: url(../../../assets/user/v3.png);
} */
.card-item--ask::after{
  background-image: url(../../../assets/user/card-icon2.png);
}
.card-intro {
  line-height: 2;
  padding: 20px;
}
.card-intro h4 {
  font-size: 16px;
  font-weight: normal;
}
.card-intro .intro {
  font-size: 14px;
  color: #999;
}
.card-button-footer {
  height: 49px;
  overflow: hidden;
  position: fixed;
  max-width: 480px;
  left: auto;
  bottom: 0;
  width: 100%;
  box-sizing: border-box;
  padding: 0 15px;
  background-color: #f5f5f5;
}

.swiper-slide {
  transform: scale(0.85);
  -ms-transform: scale(0.85);
  -moz-transform: scale(0.85);
  -webkit-transform: scale(0.85);
  -o-transform: scale(0.85);
  transition: 0.3s;
  opacity: 0.85;
}
.swiper-slide-active {
  transform: scale(1);
  -ms-transform: scale(1);
  -moz-transform: scale(1);
  -webkit-transform: scale(1);
  -o-transform: scale(1);
  opacity: 1;
}
.intro a{
  font-size: 14px;
  color: #999
}
.page{
  margin-bottom: 49px;
}
</style>

