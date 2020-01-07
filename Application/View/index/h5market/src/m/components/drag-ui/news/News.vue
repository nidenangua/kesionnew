<template>
    <div class="kd-news--default">
        <div class="kd-news__item" @click="open(item.id)" v-for="(item,i) in dataList" :key="i">
            <ks-create-bg class="kd-news__image" :src="item.defaultpic" />
           
            <div class="kd-news__name">{{item.title}}</div> 
            <div class="kd-news__sen"><span>{{item.inputer || $store.state.info.wititle}}</span><span>{{item.adddate}}</span></div>
        </div>
    </div>
</template>
<script>
export default {
    name:'KdNews',
    props:[
        'dataList',
        'dataStyle'
    ],
    methods:{
        open(id){
            this.$router.push(`/news/${id}`)
        }
    }
}
</script>
<style scoped>
.kd-news--default{
    background: #fff;
}
.kd-news__item{ 
    padding:10px 150px 10px 15px;
    position: relative;
    min-height: 74px;
}
.kd-news__item .kd-news__image{
    height: 74px;
    width: 120px;
    background-color: #f5f5f5;
    overflow: hidden;
    border-radius: 3px;
    position: absolute;
    right: 15px;
    top: 10px;
}

.kd-news__name{
    line-height: 18px;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  font-weight: bold;
  overflow: hidden;
  font-size: 14px;
  color: var(--secondary_text-color);
}
.kd-news__sen {
  color:var(--prompt-color);
  font-size: 12px;
  line-height: 20px;
  height: 20px;
  overflow: hidden;
  margin-top: 10px;
}
.kd-news__sen span{
    margin-right: 10px
}
</style>

