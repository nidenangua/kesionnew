<template>
  <ks-container class="add-data" v-if="loaded">
    <div class="ks-breadcrumb">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item :to="{ path: '/?url=/home.html/materials/Index?appid-14' }">资料列表</el-breadcrumb-item>
        <el-breadcrumb-item>添加资料</el-breadcrumb-item>
      </el-breadcrumb>
    </div>
    <el-form class="ks-mt30" ref="dataForm" :rules="rules" :model="form" label-width="100px">
      <el-form-item label="资料标题" prop="title" required>
        <el-input v-model="form.title" maxlength="50"></el-input>
      </el-form-item>
      <el-form-item label="资料介绍" prop="intro" required>
        <el-input type="textarea" v-model="form.intro"/>
      </el-form-item>

      <el-form-item label="上传资料" required>
        <el-button type="primary" @click="uploadData">本地上传</el-button>
        <el-button @click="chooseExisting">选择已有文件</el-button>
        <br>

        <data-format :file-name="form.file_name" v-if="form.file_name"/>
      </el-form-item>

      <el-form-item label="资料价格">
        <el-radio v-model="form.chargetype" label="0">免费</el-radio>
        <el-radio v-model="form.chargetype" label="1">收费</el-radio>
        <div class="add-data__price-input" v-show="form.chargetype == 1">
          资料价格：
          <el-input style="width:200px;" @change="setPrice" v-model="form.price"/>元
        </div>
      </el-form-item>
      <el-form-item label="下载次数">
        <ks-input-number v-model="form.down_num" style="width:100px" />
      </el-form-item>
      <el-form-item label="发布状态">
        <el-switch
          v-model="form.isopen"
          :active-color="$store.state.switch_on"
          :inactive-color="$store.state.switch_off"
        ></el-switch>
      </el-form-item>
      
    </el-form>
    <div class="add-data-footer" align="center">
      <el-button type="primary" @click="onSubmit">保存设置</el-button>
      <el-button @click="$router.back(-1)">取消</el-button>
    </div>
    <el-dialog title="选择资料" width="920px" :visible.sync="visible" @closed="loadSelectData = false">
      <select-data @cancel="visible = false" v-if="loadSelectData" @sure="selectDataCallback"/>
    </el-dialog>
  </ks-container>
</template>
<script>
import { cloneData } from "@/utils";
import DataFormat from "./DataFormat";
import SelectData from "./SelectData";
import { addMaterials, getMaterialsDetail } from "@/api/data";
export default {
  name: "AddData",
  data() {
    return {
      loaded: false,
      visible: false,
      loadSelectData: true,
      fileType: "",
      form: {},
      rules: {
        title: [{ required: true, message: "请输入资料名称" }],
        intro: [{ required: true, message: "请输入资料介绍" }]
      }
    };
  },
  methods: {
    /**
     * 本地上传
     */
    uploadData() {
      this.$store.ready(state => {
        this.$aliUpload({
          wxid: state.info.wxid,
          type: "data",
          uploaded: info => {
            this.form.file_path = info.path;
            this.form.file_name = info.file.name;
            this.form.size = info.file.size;
          }
        });
      });
    },
    /**
     * 选择已有文件
     */
    chooseExisting() {
      this.loadSelectData = true;
      this.visible = true;
    },

    setPrice() {
      let reg = /\d+\.?\d{0,2}/;
      let priceMatch = this.form.price.match(reg);
      let _price = priceMatch ? priceMatch[0] : "";
      this.form.price = _price;
    },
    /**
     * 保存
     */
    onSubmit() {
      this.$refs.dataForm.validate(valid => {
        if (valid) {
          if (!this.form.file_path) {
            this.$msg("请先上传资料");
            return;
          } else if (
            this.form.chargetype == 1 &&
            parseFloat(this.form.price) <= 0
          ) {
            this.$msg("收费价格必须大于0");
            return;
          }
          let params = cloneData(this.form);
          params.isopen = params.isopen ? 1 : 0;
          addMaterials(params).then(res => {
            if (res.result === "success") {
              this.$msg(res.msg, "success").then(res => {
                this.$router.back();
              });
            }
          });
        }
      });
    },
    /**
     * 选择已有资料回调
     */
    selectDataCallback(data) {
      this.visible = false;
      this.form.file_name = data[0].file_name;
      this.form.file_path = data[0].file_path;
      this.form.size = data[0].size;
    }
  },
  activated() {
    this.loaded = false;
    this.visible = false;
    this.loadSelectData = true;
    this.dataName = "";
    let _id = this.$route.params.id;
    if (_id > 0) {
      getMaterialsDetail({
        id: _id
      }).then(res => {
        if (res.result === "success") {
          let detail = res.detail;
          detail.isopen = detail.isopen == 1 ? true : false;
          this.form = detail;
        }
        this.loaded = true;
      });
    } else {
      this.form = {
        id: "0",
        title: "",
        intro: "",
        isopen: true,
        chargetype: "0",
        file_path: "",
        file_name: "",
        price: "",
        down_num:'0'
      };
      this.loaded = true;
    }
  },
  components: {
    SelectData,
    DataFormat
  }
};
</script>
<style scoped>
.add-data__cover {
  width: 150px;
  height: 150px;
  border: 1px solid #eee;
  border-radius: 4px;
  float: left;
  margin-right: 20px;
}
.add-data-footer {
  border-top: 1px solid #eee;
  padding-top: 20px;
}
</style>

