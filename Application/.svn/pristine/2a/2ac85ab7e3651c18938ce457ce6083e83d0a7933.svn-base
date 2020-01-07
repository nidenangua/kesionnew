<template>
    <div>
        <div :class="'drag-nav'+(dataStyle || '')">
            <ul class="clearfix">
                <li v-for="(item,i) in dataList" :key="i" @click="open(item)">
                    <img :src="item.icon" />
                    <p>{{item.name}}</p>
                </li>
            </ul>
        </div>
        <ks-dialog width="64%" curtain :visible.sync="teacherWechatCodeVisible">
            <div class="drag-code">
                <ks-image :src="$store.state.info.json.teacher_wechat_code" />
            </div>
            <div class="drag-text">
                班主任微信号：{{$store.state.info.json.teacher_wechat}}
            </div>
        </ks-dialog>
        <ks-dialog width="64%" curtain :visible.sync="wechatCodeVisible">
            <div class="drag-code">
                <ks-image :src="$store.state.info.weixinqr" />
            </div>
            <div class="drag-text">
                关注微信公众号
            </div>
        </ks-dialog>
    </div>
</template>
<script>
export default {
    name:'KdNav',
    props:[
        'dataList',
        'dataStyle'
    ],
    data(){
        return {
            wechatCodeVisible:false,
            teacherWechatCodeVisible:false
        }
    },
    methods:{
        open(item){
            let url = item.url
            if(!url){
                return false
            }
            if(url.indexOf('#') !== -1){
                let path = url.split('#')[1]
                if(path.indexOf('?') !== -1){
                    path += `&name=${item.name}`
                }else{
                    path += `?name=${item.name}`
                }
                this.$router.push(path)
            }else{
                switch(url){
                    case 'ks:concernHeadTeacher':
                        this.teacherWechatCodeVisible = true
                        break
                    case 'ks:concernWeiXinPublicNo':
                        this.wechatCodeVisible = true
                        break
                    default:
                        location.href = url
                }
                
            }
        }
    }
}
</script>
<style lang="scss" scoped>
.drag-nav,
.drag-nav1{
    padding: 10px 0;
    background: #fff;
    ul{
        text-align: center; 
        display: -webkit-box;  
        display: -moz-box;     
        display: -ms-flexbox; 
        display: -webkit-flex; 
        display: flex;
    }
    li{ 
        -webkit-box-flex: 1;
        -moz-box-flex: 1;     
        -webkit-flex: 1;  
        -ms-flex: 1;
        flex: 1;         
    }
    img{
        height: 32px;
    }
    p{
        line-height: 20px;
        height: 20px;
        overflow: hidden;
    }
}

.drag-nav2{
    padding: 10px 0;
    background: #fff;
    ul{
        text-align: center; 
        display: -webkit-box;  
        display: -moz-box;     
        display: -ms-flexbox; 
        display: -webkit-flex; 
        display: flex;
    }
    li{ 
        -webkit-box-flex: 1;
        -moz-box-flex: 1;     
        -webkit-flex: 1;  
        -ms-flex: 1;
        flex: 1;         
    }
    img{
        height: 42px;
    }
    p{
        font-size: 14px;
        line-height: 20px;
        height: 20px;
        overflow: hidden;
        color: var(--secondary_text-color);
    }
}
.drag-nav3{
    padding: 5px 0;
    background: #F8F7FA;
    ul{
        text-align: center; 
        display: -webkit-box;  
        display: -moz-box;     
        display: -ms-flexbox; 
        display: -webkit-flex; 
        display: flex;
    }
    li{ 
        -webkit-box-flex: 1;
        -moz-box-flex: 1;     
        -webkit-flex: 1;  
        -ms-flex: 1;
        flex: 1;         
    }
    img{
        height: 42px;
    }
    p{
        font-size: 14px;
        line-height: 20px;
        height: 20px;
        overflow: hidden;
        color: var(--secondary_text-color);
    }
}
.drag-code{
    border: 2px dotted #ddd;
    padding: 5px;
    margin-top: 5px;
    border-radius: 4px;
}
.drag-text{
    height: 22px;
    line-height: 22px;
    margin-top: 10px;
    font-size: 14px;
    text-align: center;
}

</style>
