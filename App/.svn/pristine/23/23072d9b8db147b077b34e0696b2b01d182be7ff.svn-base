<template>
    <div class="share-box ks-row">
        <div class="link ks-col-12">
            <strong>方法一: 通过链接</strong>
            <div>分享此链接到微信群和微信好友</div>
            <div class="ks-color--primary">{{link}}</div>	
            <div class="ks-button ks-button--plain ks-button--medium" @click="$copyUrl('share-link')">复制链接</div>
        </div>
        <div class="code ks-col-12">
            <strong>方法二: 通过二维码</strong>
            <img :src="code" />		
        </div>

        <input type="text" style="height:0px;border:0px;" id="share-link" :value="link" />
	
    </div>
</template>
<script>
export default {
    name:'ShareToPhone',
    props:{
        /**二维码地址 */
        code:String,
        /**链接地址 */
        link:String
    }
}
</script>

<style scoped>

.share-box{
    padding: 30px 20px;
    box-sizing: border-box;
    width: 100%;
}
.share-box .ks-button{
    margin-top:15px;
}
.share-box .link,
.share-box .code{width: 50%; text-align: center;height: 190px; font-size:14px; line-height: 30px;}
.share-box .link{position: relative;}
.share-box .link:after{content: '';width:1px;height: 100%; position: absolute;right:0;top:0;background: #eee;}
.share-box .link strong,
.share-box .code strong{ display: block;}
.share-box .code img{width: 150px;height: 150px;}
</style>
