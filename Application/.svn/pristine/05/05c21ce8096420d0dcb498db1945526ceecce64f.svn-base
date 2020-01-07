<template>
    <div class="page">
        <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange" v-if="list && list.length">
            <ks-tabs v-model="tabActive">
                        <ks-tab-pane :label="item.name" :name="item.val" v-for="(item,i) in tabList" :key='i'></ks-tab-pane>
            </ks-tabs>
            <div class="cerlist">
                <div class="cerlist-every" v-for="(item,i) in list" :key="i" >
                    <!--  center center / contain no-repeat -->
                    <div class="cerlist-every--bg" :style="{background:'url('+item.cover+') center center / 100% 100% no-repeat'}" ref="scream" @click="getcanvas(item,i)">
                        <p :class="['cerlist-every--bg__title',item.cover == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']">{{item.title}}</p>
                        <div class="cerlist-every--bg__msg">
                            <ks-image :src="$store.state.userInfo.headimg" alt="" class="cerlist-every--bg__image"></ks-image>
                            <p :class="['cerlist-every--bg__name',item.cover == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']">{{$store.state.userInfo.nickname}}</p>
                            <p :class="['cerlist-every--bg__grade',item.cover == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']"> 在{{item.info_title}}获得了{{item.sumscore}}分</p>
                            <p :class="['cerlist-every--bg__com',item.cover == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']">
                                <span>{{item.json.comment}}</span>
                                <!-- <span>“坚持做自己，坚持进步，坚持进步，坚持进步对知识点掌握非常不错，继续加油，相信会取得更大的成就！”</span> -->
                                <!-- <span class="certcon-tem__msg--osur">—吴晓波</span> -->
                            </p>
                        </div>
                        <div class="certcon-tem__focus">
                            <div class="certcon-tem__focus--image">
                                <ks-image :src="item.qrcode" alt="" class="certcon-tem__focus--img"></ks-image>
                            </div>
                            <div class="certcon-tem__focus--info">
                                <div :class="['certcon-tem__focus--name',item.cover == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']">{{item.share_title}}</div> 
                                <div :class="['certcon-tem__focus--desc',item.cover == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']">识别二维码</div>
                            </div>
                        </div>
                    </div>
                    <p class="cerlist-every__time">{{item.adddate}}</p>
                </div>
            </div>
        </ks-page-scroll-container>
        <ks-empty v-else msg="暂时没有任何成就"></ks-empty>
        <cavansPopups :info="info" ref="canvas"></cavansPopups>
    </div>
</template>

<script>
import {getMyCertificate} from '@/api/user'
import cavansPopups from './components/cavansPopups'
export default {
    components:{
        cavansPopups
    },
    data() {
        return {
            info:{},
            tabActive:'0',
            tabList:[{name:"考试证书",val:'0'}],
            /**列表数据 */
            list:[],
            /**分页 */
            page:1,
            /**总条数 */
            pageCount:1,
        }
    },
    methods: {
        async getList(page = 1) {
            this.page = page
            const data = await getMyCertificate({p:page,maxperpage:10})
            this.list = page == 1 ? data.list : this.list.concat(data.list)
            this.pageCount = data.page.total_pages
        },
        onPageChange(page) {
            this.getList(page)
        },
        getcanvas(item,index) {
            this.info = item
            this.$nextTick(()=>{
                this.$refs.canvas.getcanvas()
            })
        }
    },
    activated() {
        this.getList()
    },
}
</script>

<style scoped>
.page {
    font-size: 12px;
    min-height: 100vh;
    background-color: #fff;
}
.page /deep/ .ks-tab__item {
    flex: inherit;
    margin-left: 35px;
}
.page /deep/ .ks-tabs__header{
    box-shadow: 0px 2px 8px 0px rgba(60, 76, 139, 0.08);
}
.cerlist-every--bg__msg /deep/ .ks-image{
    margin: 8px auto;
    width: 32px;
    height: 32px;
    border-radius: 50%;
}
.cerlist{
    display: flex;
    flex-wrap: wrap;
}
.cerlist-every{
    width: 50%;
    box-sizing: border-box;
    padding:15px 8px 0 8px;
}
.bgactive{
    color: #fff
}
.cerlist-every__time{
    color: #989daf;
    text-align: center;
    margin-top: 8px;
}
.cerlist-every--bg{
    /* background: url(/static/img/certificate_bg1.98f1380.png) no-repeat; */
    /* background-size: 100% 100%; */
    width: 100%;
    height: 290px;
    position: relative;
}
.cerlist-every--bg__title{
    padding-top: 50px;
    font-size: 16px;
    text-align: center;
}
.certcon-tem__focus--img{
    width: 40px;
    height: 40px;
}
.cerlist-every--bg__msg{
    text-align: center
}
.cerlist-every--bg__grade,
.cerlist-every--bg__com{
    padding: 7px 20px 0 20px;
    font-size: 10px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    height: 39px;
    box-sizing: border-box;
}
.certcon-tem__focus{
    font-size: 10px;
    display: flex;
    padding-top: 10px;
}
.certcon-tem__focus--image{
    padding: 0 13px 0 28px
}
.certcon-tem__focus--name{
    height: 26px;
    padding-right: 20px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
}
</style>
