<template>
    <el-dialog :visible.sync="visible" width="560px">
        <div class="ks-tips-dialog">
            <div class="ks-tips-dialog__title">
                <i class="iconfont icon-warming"></i>
                提示
            </div>
            <div class="ks-tips-dialog__content" v-html="content">
              
            </div>
            <div class="ks-tips-dialog__buttons" v-if="params.buttons">
                <el-button v-for="item in params.buttons" :type="item.type && item.type" :key="item.name" @click="buttonClick(item)">
                    {{item.name}}
                </el-button>
            </div>
        </div>
    </el-dialog>
</template>
<script>
export default {
    name:'KsTipsDialog',
    data(){
        return {
            visible:false,
            content:'',
            params:{}
        }
    },
    methods:{
        buttonClick(item){
            this.visible = false
            if(typeof item.callback === 'function'){
                item.callback()
            }
            else if(item.url){
                KTJ_RouteJump(item.url)
            }
        }
    }
}
</script>
<style scoped>

/*自定义alert样式*/
.ks-tips-dialog{
    text-align: center
}
.ks-tips-dialog__content{
  padding: 0 60px;
  margin-top: 15px;
}
.ks-tips-dialog__title{
    font-size: 18px;
}
.ks-tips-dialog__title .iconfont{
  display: block;

  font-size: 72px;
  line-height: 82px;
  color:#e5412c
}
.ks-tips-dialog .el-button{
  padding: 13px 40px;
  font-size: 16px;
  font-weight: normal;
  margin-top: 40px;
}

</style>

