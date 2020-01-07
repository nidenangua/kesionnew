<template>
    <div>
        <div class="group-list">
          <div class="group-item" v-for="(item,i) in dataList" :class="i < dataList.length-1 && 'line'" :key="i" @click="open(item.id)">
              <ks-create-bg class="group-img" :src="item.defaultpic" />
              <div class="group-txt">
                    <div class="group-name">{{item.title}}</div>
                    <div class="group-intro">{{item.description}}</div>
                    <div class="group-commit">
                        <span class="group-price" v-if="item.price > 0 && item.chargetype == 1">
                           ¥{{item.price}}
                        </span>
                        <i class="ks-icon ks-icon-person"></i>{{item.member_num}}
                    </div>
              </div>
          </div>
     </div>  
    </div>
</template><script>
export default {
    name:'KdGroup',
    props:{
        dataList:{
            type:Array,
            default(){
                return []
            }
        }
    },
    methods:{
        open(id){
            this.$router.push({
                name:'GroupDetail',
                params:{
                    id:id
                }
            })
        }
    }
}
</script>
<style scoped>

.group-list .group-item { 
    padding: 15px 15px 15px 95px;
    background: #fff;
    position: relative;
    min-height: 80px;
}

.group-list .group-item .group-img {
    width:80px;
    height:80px;
    position: absolute;
    left: 15px;
    top: 15px;
}
.group-list .group-item .group-txt {
    padding-left: 15px;
}
.group-list .group-item .group-name {
    font-size: 16px;
    height: 26px;
    line-height: 26px;
    overflow: hidden;
    white-space: nowrap;
    font-weight: bold;
    text-overflow:ellipsis;
    
}
.group-list .group-item .group-intro {
    color: #999;
    font-size: 12px;
    margin-top: 5px;
    line-height: 18px;
    min-height: 18px;
    max-height: 36px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.group-commit{
    margin-top: 6px;
    color:#aaa;

}
.group-commit .ks-icon{
    font-size: 13px;
    color:#bbb;
}
.group-commit .group-price{
    float:right;
    color:var(--ornament-color);
}
</style>

