<template>
    <div class="page-scroll-container">
        <slot />

        <div class="ks-nomore" v-if="pageCount > 0 && page >= pageCount">
            没有更多数据了~
        </div>
        <div class="ks-nomore" v-else-if="pageCount > 0">
            上拉加载更多
        </div>
    </div>
</template>
<script>
export default {
    name:'KsPageScrollContainer',
    props:{
        page:[String,Number],
        pageCount:[String,Number]
    },
    data(){
        return {
            routeName:''
        }
    },
    methods:{
        /**
         * 监听是否滚动到底部
         */
        getIsScrolltolower(el){
            var isScrolltolower = false;
            if(el){
                if(el.scrollTop + el.offsetHeight >= el.scrollHeight){
                    isScrolltolower = true
                }
                
            }else{
                if(window.scrollY + window.innerHeight >= document.getElementsByTagName('body')[0].scrollHeight){
                    isScrolltolower = true
                }
            }

            return isScrolltolower
        }
    },
    mounted(){
        this.routeName = this.$route.name
        
        /**
         * 监听滚动事件
         */
        window.addEventListener('scroll',e=>{
            let scrollFlag = this.getIsScrolltolower()
            
            if (scrollFlag &&  this.page < this.pageCount && this.$route.name === this.routeName){
                
                let page = this.page+1
                this.$emit('update:page',page)
                this.$emit('page-change',page)
            }
        })
    }
}
</script>


