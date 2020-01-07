<template>
    <div class="page">
        <div class="delimg">
            <ks-image :src="msg.head"></ks-image>
            <span>{{msg.is_sign == 0 ? "未签到" :"已签到"}}</span>
        </div>
        <div class="delmsg">
           <div>账号：{{msg.name}}</div> 
           <div>报名姓名：{{msg.json.form[0].content}}</div> 
           <div>电话：{{msg.mobile}}</div> 
           <div>报名时间：{{msg.adddate}}</div> 
           <div>票名：{{msg.ticket_info.title}}</div> 
           <div>票价：{{msg.ticket_info.chargetype == 0 ? "免费" : msg.ticket_info.price}}</div> 
           <div>有效期：{{time}}</div> 
           <div>票号：{{msg.json.number[0]}}</div> 
        </div>
    </div>    
</template>

<script>
import { showEnrol } from '@/api/activity'
export default {
    data() {
        return {
            msg:{
                name:'',
                adddate:'',
                ticket_info:{
                    title:'',
                    chargetype:'',
                    price:''
                },
                json:{
                    number:[]
                }
            },
            /**有效期 */
            time:'',
        }
    },    
    methods: {
        getmsg() {
            showEnrol({id:this.$route.query.id}).then(res=>{
                console.log(res)
                this.msg = res.list;
                let data = new Date(parseInt(res.list.ticket_info.effective_date[0]));
                let y = data.getFullYear();
                let m = data.getMonth() + 1;
                let d = data.getDate();
                let h = data.getHours();
                let mm = data.getMinutes();
                let s = data.getSeconds();
                m = m < 10 ? "0" + m : m;
                d = d < 10 ? "0" + d : d;
                h = h < 10 ? "0" + h : h;
                mm = mm < 10 ? "0" + mm : mm;
                s = s < 10 ? "0" + s : s;
                let times = `${y}-${m}-${d} ${h}:${mm}`;
                let datas = new Date(parseInt(res.list.ticket_info.effective_date[1]));
                let ys = datas.getFullYear();
                let ms = datas.getMonth() + 1;
                let ds = datas.getDate();
                let hs = datas.getHours();
                let mms = datas.getMinutes();
                let ss = datas.getSeconds();
                ms = ms < 10 ? "0" + ms : ms;
                ds = ds < 10 ? "0" + ds : ds;
                hs = hs < 10 ? "0" + hs : hs;
                mms = mms < 10 ? "0" + mms : mms;
                s = s < 10 ? "0" + s : s;
                let timess = `${ys}-${ms}-${ds} ${hs}:${mms}`;
                console.log(times,timess)
                this.time = `${times} 至 ${timess}`
            })
        }
    },
    created() {
        this.getmsg()
    },
    computed: {
        id() {
           return this.$route.query.id
        }
    },
    watch: {
        id() {
            if(this.$route.name == "activityUserdet"){
                this.getmsg()
            }
        }
    },
}
</script>

<style scoped>
.page {
    padding: 15px;
    font-size: 14px;
    height: 100vh;
    background-color: #fff;
    box-sizing: border-box;
}
.delimg{
    text-align: center;
}
.ks-image{
    width: 120px;
    height: 120px;
    margin: 0 auto;
    margin-bottom: 10px;
}
.ks-image img {
    width: 100%;
    height: 100%;
}
.delmsg div {
    margin-top: 10px;
    margin-bottom: 5px;
}
</style>
