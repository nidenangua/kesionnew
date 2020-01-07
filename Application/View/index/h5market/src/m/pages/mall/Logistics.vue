<template>
    <div>
        <ul class="stice">
            <li>下单时间<span>{{info.adddate}}</span></li>
            <li>下单商品<span>{{info.title}}...等共{{info.number}}件商品</span></li>
            <li>物流快递<span>{{info.logistics}}</span></li>
            <li>快递单号<span>{{info.expressNumber}}</span></li>
        </ul>
        <div class="stice-item">物流信息</div>
        <ul class="stice-path" >
            <li v-for="(item,i) in date" :key="i">
                <div>{{item.time}}</div>
                <div>{{item.context}}</div>
            </li>
        </ul>
    </div>
</template>
<script>
import { showLogistics } from "@/api/mall";
export default {
    name:'',
    data(){
        return{
            info:{
                ordersn:'',
                expressNumber:'',//订单号
                logistics: '', //物流名称
                adddate:'',//下单时间
                number:'', //购买数
                title: "" //商品标题
            },
            date:[]
        }
    },
    computed: {
        
    },
    methods: {
     
    },
    activated() {
        let ordersn =  this.$route.query.sn
        showLogistics({ordersn}).then(res=>{
            this.info = res.info;
            this.info.title = res.info.title.substring(0,5);
            this.date = res.data;
        });
  },
}
</script>
<style scoped>
.stice{
    background-color: #fff;
    font-size: 14px;
    line-height: 32px;
    padding: 10px;
    color: #666;
}
.stice span{
    float: right;
}
.stice-item{
    font-size: 16px;
    padding: 10px;
}
.stice-path{
    padding: 10px 10px 10px 50px;
    background-color: #fff;
    font-size: 14px;
}
.stice-path li{
    padding-bottom: 20px; 
    position: relative;
}
.stice-path li::after{
    content: '↑';
    position: absolute;
    left: -30px;
    top: 5px;
    text-align: center;
    color: #FFF;
    width: 20px;
    height: 20px;
    font-size: 8px;
    border-radius: 50%;
    line-height: 20px;
    background: #E55F56;
}
</style>