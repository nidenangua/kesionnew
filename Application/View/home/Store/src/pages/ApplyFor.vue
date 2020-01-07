<template>
  <div>
    <ks-container>
      <ks-title name="申请资料"/>
      <div class="top-span" v-if="isreal">
        <el-alert title="恭喜，您提交的内容已通过审核！"  v-if="status == 1" :closable="false" type="success" show-icon></el-alert>
        <el-alert title="请稍等，审核将在1-2个工作日完成"  v-else-if="status == 0" :closable="false" type="info" show-icon></el-alert>
      </div>
      <div class="top-span" v-if="status == 2">
       <el-alert :title="'很遗憾，您提交的审核因：'+ results +'未通过，请重新提交申请'" :closable="false" type="error" show-icon></el-alert>
      </div>
      <el-tabs v-model="activeName">
        <el-form
          ref="baseInfoForm"
          :rules="rules"
          :model="form"
          label-width="120px"
          v-if="formLoaded"
        >
          <el-form-item label="姓名" prop="realname" required>
            <span v-if="isreal">{{form.realname}}</span>
            <el-input v-model="form.realname" placeholder="请输入姓名" v-else></el-input>
          </el-form-item>
          <el-form-item label="手机号码" prop="tel" required>
            <span v-if="isreal">{{form.tel}}</span>
            <el-input
              v-model="form.tel"
              maxlength="11"
              validate-event:true
              placeholder="请输入手机号码"
              v-else
            />
          </el-form-item>
          <el-form-item label="所在城市" prop="areaid" required>
            <span v-if="isreal">{{cityName}}</span>
            <el-cascader
              v-model="form.areaid"
              :options="citys"
              :props="areaProps"
              @active-item-change="handleItemChange"
              v-else
            ></el-cascader>
          </el-form-item>
          <ks-title name="教学信息" border="none" />
          <el-form-item label="授课内容" prop="course_content" required>
            <el-radio v-model="form.course_content" label="1" :disabled="isreal">K12</el-radio>
            <el-radio v-model="form.course_content" label="2" :disabled="isreal">证书考试</el-radio>
            <el-radio v-model="form.course_content" label="3" :disabled="isreal">技能培训</el-radio>
            <el-radio v-model="form.course_content" label="4" :disabled="isreal">职场提升</el-radio>
            <el-radio v-model="form.course_content" label="5" :disabled="isreal">兴趣爱好</el-radio>
            <el-radio v-model="form.course_content" label="6" :disabled="isreal">其他</el-radio>
          </el-form-item>
          <el-form-item label="授课类型" prop="course_type" required>
            <el-checkbox-group v-model="form.course_type">
              <el-checkbox :disabled="isreal" label="直播"></el-checkbox>
              <el-checkbox :disabled="isreal" label="点播"></el-checkbox>
              <el-checkbox :disabled="isreal" label="音频"></el-checkbox>
              <el-checkbox :disabled="isreal" label="图文"></el-checkbox>
              <el-checkbox :disabled="isreal" label="题库"></el-checkbox>
            </el-checkbox-group>
          </el-form-item>
          <el-form-item label="授课情况" prop="course_case" required>
            <el-radio v-model="form.course_case" :disabled="isreal" label="1">全职</el-radio>
            <el-radio v-model="form.course_case" :disabled="isreal" label="2">兼职</el-radio>
          </el-form-item>
          <el-form-item label="身份证信息" required>
            <div class="verify" @click="uploadImage(form,'real_photo1')">
              <div class="logo">
                <img :src="form.real_photo1" v-if="form.real_photo1" />
              </div>
              <div>
                <span v-if="!isreal">点击添加</span>身份证
                <a>人像</a>面
              </div>
              <p v-if="!isreal">( 请保持身份证信息清晰~ )</p>
            </div>
            <div class="verify" @click="uploadImage(form,'real_photo2')">
              <div class="logo verso">
                <img :src="form.real_photo2" v-if="form.real_photo2" />
              </div>
              <div>
                <span v-if="!isreal">点击添加</span>身份证
                <a>国徽</a>面
              </div>
              <p v-if="!isreal">( 请保持身份证信息清晰~ )</p>
            </div>
          </el-form-item>
          <el-form-item label="合同上传">
            <div class="talent" v-for="(src,i) in form.contract" :key="i">
              <img v-if="!isreal" class="remove" src="../assets/remove.png" @click="remove1(i)" />
              <div class="talent-box" type="logo">
                <img :src="src" />
              </div>
            </div>
            <div class="talent" v-if="!isreal">
              <div class="talent-box" @click="updateContract"></div>
              <div>点击添加合同</div>
            </div>
          </el-form-item>
           <el-form-item label="相关资质">
            <div class="talent" v-for="(src,i) in form.teacher_photo" :key="i">
              <img v-if="!isreal" class="remove" src="../assets/remove.png" @click="remove(i)" />
              <div class="talent-box" type="logo">
                <img :src="src" />
              </div>
            </div>
            <div class="talent" v-if="!isreal">
              <div class="talent-box" @click="updateTeacherPhoto"></div>
              <div>点击添加资质</div>
            </div>
          </el-form-item>
          <el-checkbox v-model="leable" :disabled="isreal">
            <span v-if="!isreal">我已同意</span>
            <a href="//store.kesion.com/home.html/default/Register/lecturer" target="_blank">《科汛微门户万人名师计划合作协议》</a>
          </el-checkbox>
          <el-form-item class="affirm">
            <el-button type="primary" v-if="!isreal" @click="onSubmit()">确 定 提 交</el-button>
          </el-form-item>
        </el-form>
      </el-tabs>
    </ks-container>
  </div>
</template>
  <script>
import { getArea, saveTeacher, getTeacher } from "@/api/applyfor";
export default {
  name: "ApplyFor",
  data() {
    let mobile = (rule, value, callback) => {
      if (value == "" || value == undefined) {
        let reg = /^[1][3,4,5,7,8,9][0-9]{9}$/;
        if (!reg.test(value)) {
          callback(new Error("手机号码不正确"));
        }
      } else {
        callback();
      }
    };
    return {
      // 单选框
      radio: "1",
      leable: false,
      activeName: "base",
      citys: [],
      handleChange: "",
      //基本信息
      formLoaded: true,
      results:"",
      form: {
        realname: "", //名字
        contract: [], //合同
        tel: "", //电话号码
        areaid: "", //所在城市
        course_content: "1", //授课内容
        teacher_photo: [], //相关资质
        course_type: ["直播"], //授课类型
        course_case: "1", //授课情况 1：全职 2：兼职
        real_photo1: "", //身份证正面
        real_photo2: "" //身份证背面
      },
      isreal: false,
      status: "0", //判断是否审核通过 0： 1：通过 2：拒绝
      cityName: "",
      areaProps: {
        value: "id",
        label: "city",
        children: "cities"
      },
      /**
       * 基本信息表单验证
       */
      rules: {
        realname: [{ required: true, message: "请输入姓名" }],
        tel: [{ validator: mobile, trigger: "blur" }],
        course_type: [{ required: true, message: "请至少选择一个授课类型" }],
        areaid: [{ required: true, message: "请选择授城市" }]
      }
    };
  },
  methods: {
    handleItemChange(ids) {
      let id = ids[ids.length - 1];
      this.form.areaid = id;
      getArea({
        id: id
      }).then(res => {
        this.setChildCitys(this.citys, id, res.list);
      });
    },
    updateTeacherPhoto() {
      this.$uploadImages(res => {
        this.form.teacher_photo.push(res.defaultpic);
      });
    },
    remove(i) {
      this.form.teacher_photo.splice(i, 1);
    },
    updateContract() {
      this.$uploadImages(res => {
        this.form.contract.push(res.defaultpic);
      });
    },
    remove1(i) {
      this.form.contract.splice(i, 1);
    },
    /**
     * 设置地区子级
     */
    setChildCitys(arr = [], id, list = [], level = 1) {
      arr.map(item => {
        if (item.id == id) {
          if (level < 2) {
            list.map(obj => {
              obj.cities = [];
            });
          }
          item.cities = list;
        } else if (item.cities) {
          this.setChildCitys(item.cities, id, list, level + 1);
        }
      });
    },
    /**
     * 提交基本信息表单
     */
    onSubmit() {
      this.$refs.baseInfoForm.validate(valid => {
        if (valid) {
          if (!this.form.real_photo2) {
            this.$msg("请添加身份证照片");
            return false;
          }
          if (!this.form.real_photo1) {
            this.$msg("请添加身份证照片");
            return false;
          }
          if (!this.leable == true) {
            this.$msg("未同意《科汛万人名师扶持计划》协议");
            return false;
          }
          saveTeacher(this.form).then(res => {
            if (res.result === "success") {
              this.$msg(res.msg, "success");
              this.$router.push("/");
            }
          });
        }
      });
    },
    /**
     * 提交介绍表单
     */
    onIntroSubmit() {
      saveSiteIntro(this.introForm).then(res => {
        if (res.result === "success") {
          this.$msg("保存成功", "success");
        }
      });
    },
    getAreaName(areaid, index = 0, areaname = "") {
      return new Promise(resolve => {
        let params = {};
        let id = areaid[index];
        let parentID = areaid[index - 1];
        if (parentID) {
          params.id = parentID;
        }
        getArea(params).then(res => {
          if(index < 2){
            if(index === 0){
              res.list.map(item=>{
                item.cities = [];
              });
              this.citys = res.list
            }else{
              this.setChildCitys(this.citys,parentID,res.list,1)
            }
          }else{
              this.setChildCitys(this.citys,parentID,res.list,2)
          }
          
          for (let i = 0; i < res.list.length; i++) {
            let item = res.list[i];
            if (item.id == id) {
              areaname += areaname ? "/" + item.city : item.city;
              if (areaid[index + 1]) {
                this.getAreaName(areaid, index + 1, areaname).then(areaname => {
                  resolve(areaname);
                });
              } else {
                resolve(areaname);
              }
              break;
            }
          }
        });
      });
    },
    uploadImage(data, key) {
      if (!this.isreal) {
        this.$uploadImages(data, key);
      }
    }
  },
  mounted() {
    // 获取名师资料
    this.$store.ready(state => {
      if (state.info.is_real) {
        this.status = state.info.teacher_info.status;
        if(this.status == 2){
          this.isreal = false;
        }else{
          this.isreal = true;
        }
        getTeacher().then(res => {
          this.form = res.detail;
          this.form.real_photo1 = res.detail.realPhoto1;
          this.form.real_photo2 = res.detail.realPhoto2;
          this.form.realname = res.detail.realName;
          let areaid = res.detail.areaid;
          this.form.teacher_photo = res.detail.teacherPhoto;
          this.form.contract = res.detail.contract;
          this.results = res.detail.result;
          this.leable = true;
          this.getAreaName(areaid).then(name => {
            this.cityName = name;
          });
        });
      } else {
        getArea().then(res => {
          res.list.map(item => {
            item.cities = [];
          });
          this.citys = res.list;
        });
      }
    });
  }
};
</script>
  <style scoped>
.remove {
  width: 20px;
  height: 20px;
  position: absolute;
  top: -8px;
  right: -8px;
}
.verify {
  float: left;
  text-align: center;
  width: 300px;
  margin-right: 40px;
  cursor: pointer;
}
.verify p {
  color: #999;
  line-height: 4px;
}
.logo {
  width: 300px;
  height: 180px;
  border: 1px solid #eee;
  border-radius: 4px;
  margin-right: 20px;
  overflow: hidden;
  background: url("../assets/front-img.png");
}
.logo img {
  width: 300px;
  height: 180px;
}
.talent {
  text-align: center;
  width: 150px;
  margin-right: 20px;
  cursor: pointer;
  float: left;
  position: relative;
}
.talent-box {
  width: 150px;
  float: left;
  height: 190px;
  border: 1px solid #eee;
  border-radius: 4px;
  margin-right: 20px;
  overflow: hidden;
  background: url("../assets/talent-img.png");
}
.talent-box img {
  width: 150px;
  height: 190px;
}
.banner {
  width: 200px;
  height: 112px;
}
.banner .masked {
  height: 32px;
  line-height: 32px;
  position: absolute;
  left: 0;
  color: #fff;
  text-align: center;
  bottom: 0;
  width: 100%;
  z-index: 9;
  background: rgba(0, 0, 0, 0.6);
  cursor: pointer;
}
.operat-icon i {
  width: 44px;
  height: 34px;
  display: inline-block;
  line-height: 34px;
  color: #aaa;
  cursor: pointer;
  text-align: center;
}
.operat-icon i:hover {
  color: #fc6b32;
}

.ks-link {
  position: relative;
}
.ks-link-input {
  max-width: 400px;
}
.ks-link-title {
  height: 32px;
  line-height: 32px;
  border: 1px solid #ddd;
  box-sizing: border-box;
  border-radius: 3px;
  padding: 0 30px 0 10px;
  position: absolute;
  left: 5px;
  background: #fff;
  max-width: 360px;
  top: 4px;
}
.ks-link-title .el-icon-close {
  position: absolute;
  right: 0;
  top: 0;
  width: 32px;
  height: 32px;
  text-align: center;
  line-height: 32px;
  cursor: pointer;
}
.ks-link-title .el-icon-close:hover {
  color: #fc6b32;
}
.verso {
  background: url("../assets/verso-img.png");
}
.affirm {
  text-align: center;
}
a {
  color: #409eff;
}
.top-span {
  margin-top: 10px;
}

</style>
  
  
  