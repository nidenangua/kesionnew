<template>
    <div>
        <!--默认样式-->
        <div class="kd-leaderboard">
            <ks-swiper :options="swiperOption">
                <ks-swiper-slide class="item" v-for="(item,index) in topList" :key="index">
                    <ks-image class="item-images" :src="item.list[0] && (item.api.act === 'appTeacher' ? item.list[0].head : item.list[0].defaultpic)" />
                    <div class="item-list">
                        <div class="item-list__top">TOP{{item.api.maxperpage || 10}}</div>
                        <div class="item-list__rank">{{item.title}}</div>
                        <div class="item-list__img" v-if="item.list[0]">
                            <ks-image class="item-list__image" :src="item.api.act === 'appTeacher' ? item.list[0].head : item.list[0].defaultpic" />
                        </div>
                    </div>
                    <ul class="name">
                        <li @click="open(child,item.api.act)" v-for="(child,i) in item.list" :key="i"><a>{{i+1}}</a>{{item.api.act === 'appTeacher' ? child.name : child.title}}</li>
                        <li class="name-all" @click="openMore(item.more)">查看全{{item.totalput}}{{item.api.act === 'appTeacher' ? '名' : '门'}}<i class="ks-icon ks-icon-arrow-ios-forward-outline"></i></li>
                    </ul>
                </ks-swiper-slide>
            </ks-swiper>
        </div>
       
    </div>
</template>
<script>
export default {
    name:'KdLeaderboard',
    props:{
        topList: {
            type: Array,
            default() {
                return []
            }
        }
    },
    data(){
        return {
            swiperOption: {
                slidesPerView: 1.7,
                spaceBetween: 15
            }
        }
    },
    methods:{
        openMore(url){
            this.$router.push(url)
        },
        open(item,act){
           switch(act){
               case 'appCourse':
                   if(item.courseType == 6){
                       this.$router.push('/activity/'+item.courseid)
                   }else{
                       this.$router.push('/course/'+item.courseid)
                   }
                   break
                case 'appTeacher':
                    this.$router.push('/teacher/'+item.userid)
                    break
                case 'appColumn':
                    this.$router.push('/teacher/'+item.columnid)
                    break
                case 'appTeam':
                    this.$router.push('/group/'+item.id)
                    break
           }
        }
    }
}
</script>
<style lang="scss" scoped>
/*样式11*/
.kd-leaderboard {
    padding:10px 0;
    .item {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }
    .swiper-container {
        padding: 0 15px;
    }
    .item-images {
        height: 3rem;
        border-radius: 0px;
    }
    .item-images::after{
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        background: rgba(0, 0, 0, 0.3);
    }
    .item-images /deep/ img{
        -webkit-filter: blur(10px); 
        -moz-filter: blur(10px);
        -ms-filter: blur(10px);
        filter: blur(10px);
        filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius=5, MakeShadow=false); 
    }
    .name {
        overflow: hidden;
        font-size: 14px;
        color:var(--primary_text-color);
        padding:10px;
    }
    .name .type {
        float: right;
        color: var(--auxiliary_text-color);
        margin-left: 20px;
    }
  .item-bg{
    position: absolute;
    right: 20px;
  }
  .name a{
    color: var(--prompt-color);
    margin-right:10px;
  }
  .name li{
    height: 32px;
    line-height: 32px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
  }
  .name-all{
    font-size: 12px;
    color: var(--secondary_text-color);
    .ks-icon{
      position: relative;
      top: 2px;
    }
  }
  .item-list{
    position: absolute;
    width: 100%;
    top: 8px;
    left: 0;
    font-size:16px;
    font-weight:bold;
    line-height:22px;
    box-sizing: border-box;
    padding:0 10px;
  }
  .item-list__image{
    width: 56px;
    height: 42px;
    position:absolute;
    right:10px;
    top:0;
    border-radius: 3px;
  }
  .item-list__top{
    color:rgba(255,230,45,1);
  }
  .item-list__rank{
    color:rgba(255,255,255,1);
  }
}
</style>