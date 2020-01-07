<template>
    <div>
        <ks-container>
            <el-breadcrumb separator="/" class="bread">
                <el-breadcrumb-item :to="{ path: '/privilege' }">VIP中心</el-breadcrumb-item>
                <el-breadcrumb-item>VIP设置</el-breadcrumb-item>
            </el-breadcrumb>
            <h3 style="color: #303133;">是否开启全站免费(SVIP)</h3>
            <div class="setPrice">
                <el-radio v-model="msg.is_whole" label="0">否</el-radio>
                <el-radio v-model="msg.is_whole" label="1">是</el-radio>
            </div>
            <div class="information__row">
                <span class="information__name">
                    <span class="information__star">*</span>
                    VIP说明
                </span>
                <div>
                    <ks-editor
                        title="VIP说明"
                        v-model="msg.vip_content"
                        :height="200"
                        :z-index="90"
                        :wordCount="true"
                    />
                </div>
            </div>
            <div class="information__row">
                <span class="information__name">
                    <span class="information__star">*</span>
                    SVIP说明
                </span>
                <div>
                    <ks-editor
                        title="SVIP说明"
                        v-model="msg.svip_content"
                        :height="200"
                        :z-index="90"
                        :wordCount="true"
                    />
                </div>
            </div>
            <div class="add-activity-footer">
                <el-button type="primary" size="small" @click="save">保存返回</el-button>
                <el-button plain size="small" @click="$router.go(-1)">取消</el-button>
            </div>
        </ks-container>
    </div>
</template>

<script>
import {explainShow,explainVip} from '@/api/privilege'
import { setTimeout } from 'timers';
export default {
    data() {
        return {
            msg:{
                vip_content:'',
                svip_content:'',
                is_whole:'1'
            }
        }
    },
    methods: {
        async getMsg() {
            const res = await explainShow()
            this.msg = res.data
            console.log(res)
        },
        async save() {
            const res = await explainVip(this.msg)
            this.$message.success("保存成功")
            setTimeout(()=>{
                this.$router.push('/privilege')
            },500)
            console.log(res)
        }
    },
    created() {
        this.getMsg()
    },
};
</script>

<style scoped>
.add-activity-footer {
  border-top: 1px solid #eee;
  padding: 20px 0;
  text-align: center;
}
.information__star {
  position: relative;
  color: red;
  vertical-align: middle;
}
.information__name {
  display: block;
  font-size: 14px;
  line-height: 34px;
  height: 34px;
  color: #666;
  padding-bottom: 10px;
}
.bread{
    margin-bottom: 30px;
}
.setPrice{
    margin: 10px 0;
}
</style>
