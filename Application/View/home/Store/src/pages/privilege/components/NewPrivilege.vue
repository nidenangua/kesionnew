<template>
    <el-dialog title="新增VIP" :visible.sync="dialogFormVisible" @close="close">
        <el-form :model="form">
            <el-form-item label="VIP类型" :label-width="formLabelWidth">
                <el-radio v-model="form.type" label="0">VIP</el-radio>
                <el-radio v-model="form.type" label="1">SVIP</el-radio>
            </el-form-item>
            <el-form-item label="有效时间" :label-width="formLabelWidth">
                <el-input oninput = "value=value.replace(/[^\d.]/g,'')" v-model="form.time" autocomplete="off" class="timetype"  placeholder="请输入" maxlength="2" show-word-limit></el-input>
                <el-select v-model="form.timetype"  placeholder="请选择">
                    <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                    >
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="排序" :label-width="formLabelWidth">
                <el-input v-model="form.sort" autocomplete="off" class="timetype" placeholder="请输入" maxlength="6" show-word-limit oninput = "value=value.replace(/[^\d.]/g,'')"></el-input>
                <span class="sortnum">数值越大越靠前</span>
            </el-form-item>
            <el-form-item label="价格" :label-width="formLabelWidth">
                <el-input oninput = "value=value.replace(/[^\d.]/g,'')" v-model="form.price" autocomplete="off" class="timetype" placeholder="请输入"></el-input> <span class="isprice">元</span>
            </el-form-item>
            <!-- <el-form-item label="划线价格" :label-width="formLabelWidth">
                <el-input oninput = "value=value.replace(/[^\d.]/g,'')" v-model="form.uprice" autocomplete="off" class="timetype" placeholder="请输入"></el-input> <span class="isprice">元</span>
            </el-form-item> -->
        </el-form>
        <div slot="footer" class="dialog-footer">
            <el-button @click="dialogForm">取 消</el-button>
            <el-button type="primary" @click="adduser">确 定</el-button>
        </div>
    </el-dialog>
</template>

<script>
import {editprivilege} from '@/api/privilege'
export default {
    props:{
        info:Object,
        PrivilegeId:String
    },
    data() {
        return {
            options:[
                {label:"天",value:"0"},
                {label:"月",value:"1"},
                {label:"年",value:"2"}
            ],
            value:'0',
            form: {
                id:'',
                type: '0',// vip类型
                timetype: '0',// 有效时间种类
                time: '', // 有效时间
                sort:'',
                price:'',
                uprice:''
            },
            formLabelWidth: '120px',
            dialogFormVisible:true
        }
    },
    methods: {
        close() {
            this.$emit("isshow",false)
        },
        dialogForm() {
            this.$emit("isshow",false)
        },
        async adduser() {
            const res = await editprivilege(this.form)
            if(res.result === "success"){
                this.$message.success(`${res.msg}`)
                this.$emit("addusers",false)
            }
        },
        /**数据查询 */
        getmsg() {
            let {info,form} = this
            form.type = info.type
            form.time = info.time
            form.timetype = info.timetype
            form.sort = info.sort
            form.price = info.price
            form.uprice = info.uprice
        }
    },
    created() {
        this.form.id = this.info.id
        this.getmsg()
    },
    watch: {
        info() {
            this.getmsg()
        },
        deep: true
    },
}
</script>

<style>
.timetype{
    width: 100px;
}
.timetype{
    margin-right: 8px;
}
.sortnum{
    font-size: 12px;
}
</style>
