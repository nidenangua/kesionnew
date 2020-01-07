<template>
    <div class="kd-search" :style="{padding:padding}" :class="bg && 'kd-search-'+bg">
        <div class="kd-search__input_box">
            <i class="kd-search__icon ks-icon ks-icon-search-outline"></i>
            <input type="serach" class="kd-search__input" v-model="keyword" @focus="onfocus" @blur="onblur" id="search" :placeholder="placeholder || '请输入要搜索的内容~'" @keyup="goSearch">
        </div>
    </div>
</template>
<script>
import {cloneData} from '@/utils'
export default {
    name:'KdSearch',
    props:{
        placeholder:String,
        padding:{
            type:String,
            default:'10px'
        },
        bg:String
    },
    data(){
        return {
            keyword:this.$route.query.key || ''
        }
    },
    watch:{
        "$route.query"(query){
            this.keyword = query.key || ''
        }
    },
    methods:{
        goSearch(e){
            if(e.keyCode === 13){
               let query = cloneData(this.$route.query);
               query.key = this.keyword;
               let name = this.$route.query.name;
              
            
            
               if(this.type){
                   let _name;
                   switch(this.type){
                       case 'course':
                       _name = 'CourseList'
                       break
                   }
                   if(_name){
                        this.$router.push({
                            name:_name,
                            query:query
                        })
                    }
               }else if(name == "教辅周边") {
                   this.$router.push({path:'/malist',query:query})
                   }
                   else{
                    this.$router.push({
                        path:this.$route.path,
                        query:query
                    })
               }
               this.$emit('enter',this.keyword)
            } 
        },
        onfocus(){
            this.$emit('focus')
        },
        onblur(){
            this.$emit('blur')
        }
    }
}
</script>
<style scoped>


.kd-search__input_box{
  background: #fff;
  border-radius:40px;
  height: 20px;
  padding: 8px 15px;
  position: relative;
  font-size: 14px;
}
.kd-search__icon{
    position: absolute;
    left: 10px;
    top: 50%;
    width: 20px;
    height: 20px;
    line-height: 20px;
    text-align: center;
    margin-top: -10px;
    font-size: 20px;
    color:var(--prompt-color)
}
.kd-search-gray{
    background: #fff;
}
.kd-search-gray .kd-search__input_box{
    background: var(--background-color)
}
.kd-search__input{
    width: 100%;
    border:0px;
    height: 20px;
    line-height: 20px;
    font-size: 14px;
    box-sizing: border-box;
    padding-left: 20px;
    background: none;
}

</style>
