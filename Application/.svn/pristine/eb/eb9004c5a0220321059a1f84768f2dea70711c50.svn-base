<template>
  <ks-container v-if="loading">
    <el-breadcrumb separator="/" class="breadcrumb">
      <el-breadcrumb-item :to="{ path: '/goodsset' }">教辅周边设置</el-breadcrumb-item>
      <el-breadcrumb-item>添加规格组</el-breadcrumb-item>
    </el-breadcrumb>
    <main>
      <el-row>
        <h4 class="group-theme">
          <span class="group__star">*</span>规格组名称
        </h4>
        <el-input v-model="groupInfo.name" ref="groupName">
          <span slot="suffix" class="groupName-limit">{{groupInfo.name.length}}/30</span>
        </el-input>
      </el-row>
      <el-row>
        <h4 class="group-theme">
          <span class="group__star">*</span>规格组属性
        </h4>
        <el-table
          ref="multipleTable"
          :data="groupInfo.json"
          tooltip-effect="dark"
          style="width: 700px;"
        >
          <el-table-column label="属性名称" width="150">
            <template slot-scope="scope">
              <el-input
                v-model="scope.row.name"
                placeholder="属性名称"
                :ref="`attrName${scope.$index}`"
              ></el-input>
            </template>
          </el-table-column>
          <el-table-column label="属性内容">
            <template slot-scope="scope">
              <div class="attr-content-row" v-for="(item,index) in scope.row.content" :key="index">
                <el-input
                  v-model="item.name"
                  placeholder="属性内容"
                  class="attr-content-input"
                  :ref="`attrContent${scope.$index}${index}`"
                ></el-input>
                <el-tooltip
                  effect="dark"
                  content="删除"
                  placement="bottom"
                  v-if="scope.row.content.length>1"
                >
                  <i
                    class="iconfont icon-shanchu1 delete-icon"
                    @click="delAttrContent(scope.$index,index)"
                  ></i>
                </el-tooltip>
              </div>
            </template>
          </el-table-column>
          <el-table-column label="操作" align="center" width="150">
            <template slot-scope="scope">
              <el-tooltip effect="dark" content="添加属性内容" placement="bottom" :enterable="false">
                <i class="iconfont icon-tianjia add-icon" @click="addAttrContent(scope.$index)"></i>
              </el-tooltip>
              <el-tooltip effect="dark" content="删除" placement="bottom">
                <i class="iconfont icon-shanchu1 delete-icon" @click="delAttr(scope.$index)"></i>
              </el-tooltip>
            </template>
          </el-table-column>
        </el-table>
        <el-button type="primary" plain class="add-attr-btn" @click="addAttr">添加属性</el-button>
      </el-row>
    </main>
    <footer>
      <el-button type="primary" @click="saveTrainCamp">保存返回</el-button>
      <el-button plain @click="$router.go(-1)">取消</el-button>
    </footer>
  </ks-container>
</template>

<script>
import { showCommodity, editCommodity } from "@/api/microportal";
export default {
  name: "AddGroup",
  data() {
    return {
      loading: false,
      groupInfo: null
    };
  },
  watch: {
    /**规格组名称字数限制 */
    "groupInfo.name": function(newValue, oldValue) {
      if (newValue.length > 30) {
        this.groupInfo.name = oldValue;
      }
    }
  },
  methods: {
    /**添加属性 */
    addAttr() {
      let obj = {
        name: "",
        content: [
          {
            name: ""
          }
        ]
      };
      if(this.groupInfo.json.length>3) return this.$message.error("最多只能4行")
      this.groupInfo.json.push(obj);
    },
    /**删除属性 */
    delAttr(index) {
      this.groupInfo.json.splice(index, 1);
    },
    /**保存返回 */
    saveTrainCamp() {
      if (!this.groupInfo.name.length > 0) {
        this.$msg("规格组名称不能为空");
        this.$refs.groupName.focus();
        return false;
      } 
      if (!this.groupInfo.json.length > 0) {
        this.$msg("规格组属性不能为空");
        return false;
      }

      for (let i = 0; i < this.groupInfo.json.length; i++) {
        if (!this.groupInfo.json[i].name.length) {
          this.$refs[`attrName${i}`].focus();
          this.$msg("属性名称不能为空");
          return;
        }
        for (let j = 0; j < this.groupInfo.json[i].content.length; j++) {
          if (!this.groupInfo.json[i].content[j].name.length) {
            this.$refs[`attrContent${i}${j}`][0].focus();
            this.$msg("属性内容不能为空");
            return;
          }
        }
      }
      editCommodity(this.groupInfo).then(res => {
        this.$msg("保存成功", "success").then(() => {
          this.$router.push({
            name: "GoodsSet"
          });
        });
      });
    },
    /**添加属性内容 */
    addAttrContent(index) {
      if(this.groupInfo.json[index].content.length > 4) return this.$message.error("最多只能添加5项")
      this.groupInfo.json[index].content.push({ name: "" });
    },
    /**
     * 删除属性内容
     * @param {Number} 属性的索引
     * @param {Number} 属性内容的索引
     *  */
    delAttrContent(arrtIndex, conIndex) {
      this.groupInfo.json[arrtIndex].content.splice(conIndex, 1);
    }
  },
  activated() {
    this.loading = false;
    if (this.$route.query.id) {
      // 编辑
      showCommodity({ id: this.$route.query.id }).then(res => {
        this.groupInfo = res;
        delete this.groupInfo.result;
        this.loading = true;
      });
    } else {
      // 添加
      this.groupInfo = {
        name: "",
        json: [
          {
            name: "",
            content: [
              {
                name: ""
              }
            ]
          }
        ]
      };
      this.loading = true;
    }
  }
};
</script>

<style scoped>
.breadcrumb {
  font-size: 15px;
  border-bottom: 1px solid #eee;
  padding: 20px 0;
}
main {
  padding: 0 40px;
}
.group-theme {
  font-size: 14px;
  padding: 25px 0 15px;
  font-weight: normal;
  color: #ababab;
}
.group__star {
  position: relative;
  color: red;
  margin-right: 2px;
  vertical-align: middle;
}
.attr-content-row {
  margin-bottom: 10px;
}
.groupName-limit {
  line-height: 40px;
}
.attr-content-row:last-child {
  margin-bottom: 0;
}
.attr-content-input {
  width: 80%;
}
.add-attr-btn {
  margin-top: 10px;
}
.add-icon,
.delete-icon {
  color: #c2c2c2;
  margin-left: 5px;
  font-size: 20px;
  cursor: pointer;
}
.add-icon {
  margin-left: 0;
  margin-right: 5px;
}
footer {
  border-top: 1px solid #eee;
  padding-top: 10px;
  margin-top: 50px;
  text-align: center;
}
</style>
