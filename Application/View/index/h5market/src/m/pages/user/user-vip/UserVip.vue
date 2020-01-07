<template>
    <div class="page">
        <div class="vipcombo">
            <ks-tabs v-model="tabActive" @tab-click="handleClick">
                <ks-tab-pane label="VIP套餐" name="0"></ks-tab-pane>
                <ks-tab-pane label="SVIP套餐" name="1"></ks-tab-pane>
            </ks-tabs>
            <div class="vipcombo-user">
                <div class="vipcombo-user__left">
                    <ks-image :src="$store.state.userInfo.headimg" class="vipcombo-user__image"></ks-image>
                </div>
                <div class="vipcombo-user__msg">
                    <p class="vipcombo-user__name">{{$store.state.userInfo.nickname}}</p>
                    <p class="vipcombo-user__serve">
                        <span v-if="msg.status == -1">暂未开通</span>
                        <span v-if="msg.status == 0">会员已过期</span>
                        <span v-if="msg.status == 1">将于 {{msg.expiretime}} 到期</span>
                    </p>
                </div>
            </div>
        </div>
        <div v-if="msg.list && msg.list.length">
            <div class="vipprice">
            <div :class="['vippricee-msg',index == i ? 'vippricee_active' : '']" v-for="(item,i) in msg.list" :key="i" @click="selectVip(i,item)">
                <p class="vippricee-msg__time">
                    {{item.time}}
                    <span v-if="item.timetype ==  0">天</span>
                    <span v-else-if="item.timetype ==  1">个月</span>
                    <span v-else >年</span>
                </p>
                <p class="vippricee-msg__price">￥<span class="pricenum">{{item.price}}</span></p>
                <p class="vippricee-msg__all">
                    <a v-if="item.timetype==0">{{(item.price/item.time).toFixed(2)}}元/天</a>
                    <a v-if="item.timetype==1">{{(item.price/item.time).toFixed(2)}}元/月</a>
                    <a v-if="item.timetype==2">{{(item.price/(item.time*12)).toFixed(2)}}元/月</a>
                    </p>
                </div>
            </div>
            <div class="vipbuy">
                <ks-button class="buynow" @click="buynow">立即购买</ks-button>
            </div>
            <div class="vipequity">
                <h3>会员权益说明</h3>
                <div v-html="content" class="vipcontent">

                </div>
            </div>
        </div>
        <ks-empty msg="暂无数据~" v-else/>
        <store-footer />
        <store-footer-bar />
    </div>
</template>

<script>
import {vipInfo} from '@/api/user'
export default {
    data() {
        return {
            index:'0',
            tabActive:"0",
            msg:'',
            content:'',
            /**支付信息 */
            paymsg:{
                price:'',
                id:'',

            }
        }
    },
    methods: {
        async handleClick() {
            this.index = 0
            await this.getVip()
            if(this.msg.list && this.msg.list.length) {
                this.paymsg.id = this.msg.list[0].id
                this.paymsg.price = this.msg.list[0].price
            }
        },
        async getVip() {
            const msg  = await vipInfo({type:this.tabActive})
            this.msg = msg
            this.content = this.tabActive == 0 ? msg.vip_content : msg.svip_content
        },
        selectVip(index,item) {
            this.index = index
            this.paymsg.price = item.price
            this.paymsg.id = item.id
        },
        /**购买会员 */
        buynow() {
            this.$showPay({
                payid: this.paymsg.id,
                price: this.paymsg.price,
                msg: "VIP充值",
                type: "vipsvip"
            });
        }
    },
    created() {
       
    },
    async activated() {
        if(this.$route.query.type == 1) {
             this.tabActive = '1'
         }else {
             this.tabActive = '0'
         }
        await this.getVip()
        if(this.msg.list && this.msg.list.length) {
            this.paymsg.id = this.msg.list[0].id
            this.paymsg.price = this.msg.list[0].price
        }
        document.title = "升级会员"
    }
}
</script>

<style scoped>
.page /deep/ .ks-tab__active_line{
    width: 50%;
}
.page /deep/ .ks-tab__item.active{
    color: #fff;
}
.page /deep/ .ks-tab__item{
    color: #bec3d6
}
.page /deep/ .ks-tabs__header{
    background-color: #2e344c;
    height: 2.2rem;
}
.vipcombo{
    height: 9rem;
    background-color: #2e344c;
}
.vipcombo-user{
    width: 90%;
    height: 6rem;
    margin: 0 auto;
    margin-top: .8rem;
    background-size: 100% 100%;
    background-image: url('../../../assets/uservip/vip_bg.png');
    padding: 1.5rem 0 0 1rem;
    box-sizing: border-box;
    display: flex
}
.vipcombo-user__image{
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    border: 2px solid #f9c892
}
.vipcombo-user__left{
    margin-right: .5rem
}
.vipcombo-user__msg{
    padding-top: .3rem;
}
.vipcombo-user__name{
    font-size: .9rem;
    font-weight: 700;
    color: #8e5c28
}
.vipcombo-user__serve{
    color: #8a5720;
    margin-top: .3rem
}
.vipprice{
    padding: 1.5rem .9rem;
    display: flex;
    flex-shrink: 0;
    display: -webkit-box; 
    -webkit-overflow-scrolling: touch; 
    overflow-x: auto
}
.vipprice::-webkit-scrollbar { display: none}
.vippricee-msg{
    border-radius: .4rem;
    padding: 1rem;
    text-align: center;
    border: 1px solid #d5d7e2;
    width: 4rem;
    margin-right: .9rem;
    font-size: .7rem;
}
.vippricee-msg__time,
.vippricee-msg__price{
    margin-bottom: .7rem
}
.vippricee-msg__price{
    font-size: .8rem;
    color: #cf8231;
}
.pricenum{
    font-size: 1.2rem 
}
.vippricee-msg__all{
    color: #d99d5e;
    /* text-decoration:line-through */
}
.vippricee_active{
    background-color: #ffe8d3;
    border-color: #efc186
}
.vipbuy{
    text-align: center;
}
.buynow{
    width: 90%;
    border-radius: 1rem !important;
    color: #b06c25 !important;
    background-image: linear-gradient(to right, #fddebc , #f8c486);
    border-color: none;
}
.buynow:focus{
    background-image: linear-gradient(to right, #fddebc , #f8c486) !important;
}
.vipequity{
    margin-top: 1.2rem;
    padding: 0 .9rem;
}
.vipequity h3 {
    font-size: .8rem;
    margin-bottom: .7rem;
}
.vipequity div {
    color: #9ea2b4;
    font-size: .7rem;
    margin-bottom: .3rem;
}
</style>
