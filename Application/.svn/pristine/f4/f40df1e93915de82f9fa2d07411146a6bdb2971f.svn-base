<template>
    <div ref="title" class="ks-pt10">
        <div class="drag-title" v-if="!dataTitle.style || dataTitle.style == 1">
            <i class="drag-title__stand"></i>
            <span class="more" v-show="dataTitle.more && dataTitle.more.length">
                <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
                <a :href="item.url" v-for="(item,i) in dataTitle.more" :key="i">{{item.text}}</a>
            </span>
            {{dataTitle.name}}
        </div>
        <div class="drag-title-style2" v-else-if="dataTitle.style == 2">
            <i class="welt" :style="{background:$store.state.stylecolor}"></i>
            <span class="more" v-show="dataTitle.more && dataTitle.more.length">
                <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
                <a :href="item.url" v-for="(item,i) in dataTitle.more" :key="i">{{item.text}}</a>
            </span>
            {{dataTitle.name}}
        </div>
        <div class="drag-title-style3" v-else-if="dataTitle.style == 3">
            <div class="more-btn line line-top" v-show="dataTitle.more && dataTitle.more.length">
                <span>
                    <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
                    <a :href="item.url" v-for="(item,i) in dataTitle.more" :key="i">{{item.text}}</a>
                </span>
            </div>
            <div class="title">{{dataTitle.name}}</div>
        </div>
    </div>
</template>
<script>
export default {
    name:'KdTitle',
    props:[
        'dataTitle'
    ]
}
</script>
<style scoped>
.drag-title{
    font-size:18px;
    height: 38px;
    line-height: 38px;
    overflow: hidden;
    padding:15px 15px 0 15px;
    background: #fff;
    font-weight: bold;
}
.drag-title__stand {
    width: 4px;
    background: var(--primary-color);
    height: 18px;
    border-radius: 10px;
    display: block;
    float: left;
    margin-top: 10px;
    margin-right: 10px;
}
.drag-title-style2{
    font-size:16px;
    height: 28px;
    line-height: 28px;
    overflow: hidden;
    padding:15px 15px 0 15px;
    background: #fff;
    position: relative;
    font-weight: bold;
}
.drag-title-style2 .welt{
    content: '';
    width: 3px;
    height: 16px;
    position: absolute;
    left: 0;
    top: 21px;
}
.more{
    float: right;
    font-size: 12px;
    position: relative;
    padding-right: 15px
}
.more a{
    color:var(--secondary_text-color);
    margin-left:15px;
    font-weight: normal
}
.more .ks-icon{
    width: 16px;
    height: 16px;
    line-height: 16px;
    font-size: 14px;
    font-weight: normal;
    color:var(--secondary_text-color);
    position: absolute;
    right:0;
    top: 50%;
    margin-top: -8px
}

.drag-title-style3{
    background: #fff;
}
.drag-title-style3 .title{
    font-size: 18px;
    text-align: center;
    line-height: 28px;
    height: 28px;
    padding:15px 0 20px 0;
    position: relative;
}

.drag-title-style3 .title::after{
    content: '';
    width: 30px;
    height: 3px;
    background: #ddd;
    position: absolute;
    bottom: 10px;
    left:50%;
    margin-left: -15px;
}
.drag-title-style3 .more-btn{
    position: absolute;
    bottom: 0;
    height: 44px;
    line-height: 44px;
    background: #fff;
    text-align: center;
    font-size: 14px;
    width: 100%;
    left: 0;
}
.drag-title-style3 .more-btn a{
    color: var(--auxiliary_text-color);
    padding:0 10px;
    display: inline-block;
}
.drag-title-style3 .more-btn span{
    position: relative;

}
.drag-title-style3 .more-btn .eva-icon{
    width: 16px;
    height: 16px;
    position: absolute;
    right:-16px;
    top: 50%;
    margin-top: -8px
}
</style>

