<template>
    <div class="selectWhiteboard">
        <ul class="clearfix">   
            <li @click="selected = i" v-for="(item,i) in styleList" :key="'item'+i" :class="selected === i && 'on'">
                <div class="inner">
                    <img :src="item.bg" />
                    <p>{{item.name}}</p>
                </div>
            </li>
        </ul>

        <div class="button" @click="selectStyle">确认</div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            selected:0,
            styleList:[
                {
                    bg:'https://www.ketangjie.com/App/View/class/home.interactlive/style/bg1.3f6ec69.jpg',
                    name:'默认'
                },
                {
                    bg:'https://www.ketangjie.com/App/View/class/home.interactlive/style/bg2.9594466.jpg',
                    name:'插画'
                },
                {
                    bg:'https://www.ketangjie.com/App/View/class/home.interactlive/style/bg3.e3a6871.jpg',
                    name:'科技'
                },
                {
                    bg:'https://www.ketangjie.com/App/View/class/home.interactlive/style/bg4.0c170f0.jpg',
                    name:'梦幻'
                },
                {
                    bg:'https://www.ketangjie.com/App/View/class/home.interactlive/style/bg5.0751d7b.jpg',
                    name:'卡通'
                },
                {
                    bg:'https://www.ketangjie.com/App/View/class/home.interactlive/style/bg6.5e716ea.jpg',
                    name:'水墨'
                }
            ]
        }
    },
    methods:{
        selectStyle(){
            this.$parent.addWhiteboardFile(this.styleList[this.selected].bg,this.styleList[this.selected].name);
            this.$parent.$layer.closeAll()
        }
    }
}
</script>
<style scoped>
.selectWhiteboard{ padding-bottom: 78px}
.selectWhiteboard li{width:25%; float:left; }
.selectWhiteboard .inner{margin:10px;text-align: center; cursor: pointer;}
.selectWhiteboard li img{width: 100%; display: block;border: 1px solid #e6e6e6;}
.selectWhiteboard li p{font-size: 14px; line-height: 34px;}
.selectWhiteboard .on{color:#e6412c}
.selectWhiteboard .on img{border:1px solid #e6412c}
.button{width: 90px;height: 38px; background: #e6412c; color:#fff; text-align: center; line-height: 38px; font-size:14px;border-radius: 4px; cursor: pointer; position: absolute;bottom:20px;left:50%;margin-left:-45px;}
</style>

