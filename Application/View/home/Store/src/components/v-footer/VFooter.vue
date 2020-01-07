<template>
    <div class="copyright">
        <div class="copyright-cmp">
            <div class="copyright-cmp-text">
                科汛<span class="dot"></span>专注新教育的技术服务商
            </div>
        </div>
        <div class="copyright-text">
            Copyright © 2015-2019 厦门科汛软件有限公司 All Rights Reserved. 闽ICP备06009871号
        </div>
        <div class="copyright-text">
            <a target="_blank" href="//www.beian.gov.cn/portal/registerSystemInfo?recordcode=35020302001540" style="display:inline-block;">
                <img src="//www.kesion.com/kesion-ui/footer/ghs.png" style="float:left;margin:5px 5px 0 0">
                    闽公网安备 35020302001540号
            </a>
        </div>
    </div>
</template>
<script>
export default {
    name:'FooterCopyright',
    data(){
        return {}
    }
}
</script>
<style lang="scss" scoped>
.copyright{
    text-align: center;
    color: $gray-color;
    line-height: 28px;
    padding-bottom: 30px;
}
.copyright-cmp{
    font-size: 14px;
    color:$info-deep-color;
}
.copyright-text a{
    color:$gray-color;
}
.copyright-cmp-text{
    display: inline-block;
    position: relative;
}
.copyright-cmp-text::before{
    content: '';
    width: 30px;
    height: 2px;
    background: $info-color;
    position: absolute;
    left: -40px;
    top: 50%;
    margin-top: -1px;
}
.copyright-cmp-text::after{
    content: '';
    width: 30px;
    height: 2px;
    background: $info-color;
    position: absolute;
    right: -40px;
    top: 50%;
    margin-top: -1px;
}
.copyright-cmp .dot{
    display: inline-block;
    width: 3px;
    height: 3px;
    margin: 3px 5px;
    border-radius: 50%;
    background-color: $info-color;
}
</style>