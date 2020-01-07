<template>
    <div class="ks-table-footer clearfix">
        
        <div class="ks-fl">
            <el-checkbox v-model="checkbox_all" @change="selectAll">{{checkbox_all ? '反选' : '全选'}}</el-checkbox>
            <el-button @click="handleClick">{{customizeButton.text || '删除'}}</el-button>
            <slot />
        </div>
        <el-pagination v-if="pagination" class="ks-fr" @current-change="currentChange" layout="prev, pager, next" :page-count="pagination.total" :current-page="pagination.current" background>
        </el-pagination>
    </div>
</template>
<script>
export default {
    name:'KsTableFooter',
    props:{
        pagination:Object,
        tableData:Array,
        selectKey:String,
        callType:String,
        customizeButton:{
            type:Object,
            default(){
                return {}
            }
        }
    },
    data(){
        return {
            checkbox_all:false
        }
    },
    watch:{
        tableData:{
            handler(){
                this.setSelectAllState()
            },
            deep:true
        }
    },
    methods:{
        /**
         * 设置全选状态
         */
        setSelectAllState(){
            let checkedLength = 0;
            this.tableData.map(item=>{
                if(item.checked){
                    checkedLength++;
                }
            })
            
            if(checkedLength === this.tableData.length){
                this.checkbox_all = true
            }else{
                this.checkbox_all = false
            }
        },
        /**
         * 全选
         */
        selectAll(v){
            
            this.tableData.map(item=>{
                item.checked = v
            })

        },
        /**
         * 当前页数回调
         */
        currentChange(p){
            this.pagination.current = p
            this.$emit('current-change',p)
        },
        /**
         * 点击回调
         */
        handleClick(){
            let key = this.selectKey || 'id'
            let arr = []
            this.tableData.map(item=>{
                if(item.checked){
                    arr.push(item[key])
                }
            })
            if(arr.length){
               
                if(this.callType === 'array'){
                    this.$emit('trigger',arr)
                }else{
                    this.$emit('trigger',arr.join(','))
                }
                
            }else{
                this.$msg('请先选择操作项')
            }
        }
    },
    mounted(){
        if(this.tableData){
            this.setSelectAllState()
        }
    }
}
</script>



