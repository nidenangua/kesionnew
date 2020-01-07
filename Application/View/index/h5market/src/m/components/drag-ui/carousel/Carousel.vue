<template>
    <div class="kd-carousel" :class="(centeredSlides && slidesPerView > 1) ? 'kd-carousel--centered' : ''">
        <ks-swiper :options="swiperOption" :style="{height:swiperHeight+'px'}">
            <ks-swiper-slide v-for="(item,index) in dataList" :key="index">
                <ks-image :style="{borderRadius:radius}" :src="item.img" @click="open(item.url)" /> 
            </ks-swiper-slide>
            <div class="swiper-pagination" slot="pagination" v-if="pagination"></div>
        </ks-swiper>
    </div>
</template>
<script>
export default {
    name:'KdCarousel',
    props:{
        centeredSlides:Boolean,
        pagination:{
            type:Boolean,
            default:true
        },
        slidesPerView:{
            type:Number,
            default:1
        },
        dataList:{
            type:Array,
            default(){
                return []
            }
        },
        radius:{
            type:String,
            default:'0px'
        },
        dataRatio:{
            type:[Number,String],
            default:0.56
        }
    },
    data(){
        return {
            swiperHeight:document.body.offsetWidth / this.slidesPerView * parseFloat(this.dataRatio),
            swiperOption:{
                loop:true,
                slidesPerView:this.slidesPerView,
                centeredSlides:this.centeredSlides,
                initialSlide:(this.centeredSlides && this.dataList.length > 1) ? 1 : 0,
                autoplay:{
                    disableOnInteraction:false
                },
                pagination: {
                    el: '.swiper-pagination'
                }
            }
        }
    },
    methods:{
        open(url){
           if(url)
                location.href = url
            
        }
    }
}
</script>

<style scoped>
.kd-carousel{
    background: #fff;
}
.kd-carousel--centered{
    padding: 10px 0;
}
.kd-carousel--centered .swiper-slide {
  transform: scale(0.93);
  -ms-transform: scale(0.93);
  -moz-transform: scale(0.93);
  -webkit-transform: scale(0.93);
  -o-transform: scale(0.93);
  transition: 0.3s;
}

.swiper-slide .ks-image{
    width: 100%;
    height: 100%;
}

.kd-carousel--centered .swiper-slide-active{
   transform: scale(1);
  -ms-transform: scale(1);
  -moz-transform: scale(1);
  -webkit-transform: scale(1);
  -o-transform: scale(1);
}
</style>
