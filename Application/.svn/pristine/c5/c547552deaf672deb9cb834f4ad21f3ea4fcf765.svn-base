<template>
  <div class="page">
    <div class="table">
      <div class="way">
        <ks-radio v-model="way" :label="0">个人认证</ks-radio>
        <ks-radio v-model="way" :label="1">企业认证</ks-radio>
      </div>
      <div class="select" v-if="way != 1">
        <div class="courseset">授课情况</div>
        <ks-radio v-model="select" :label="1">全职</ks-radio>
        <ks-radio v-model="select" :label="2">兼职</ks-radio>
        <div class="courseset">授课内容</div>
        <ks-radio v-model="lessons" :label="1">K12</ks-radio>
        <ks-radio v-model="lessons" :label="2">证书考试</ks-radio>
        <ks-radio v-model="lessons" :label="3">技能培训</ks-radio>
        <ks-radio v-model="lessons" :label="4">职场提升</ks-radio>
        <ks-radio v-model="lessons" :label="5">兴趣爱好</ks-radio>
        <ks-radio v-model="lessons" :label="6">其它</ks-radio>
        <div class="courseset">授课类型</div>
        <span v-for="(item,i) in courseType" :key="i" class="courseType">
          <ks-checkbox v-model="item.flag">{{item.con}}</ks-checkbox>
        </span>
      </div>
      <div>
        <ks-list-item :title="way == 0 ? '真实姓名':'企业名称'">
          <div class="course-import">
            <input
              type="text"
              placeholder="请输入"
              class="courseInput course-price__input sales"
              v-model="message.name"
            />
          </div>
        </ks-list-item>
        <ks-list-item :title="way == 0 ? '手机号':'联系电话'">
          <div class="course-import">
            <input
              type="text"
              placeholder="请输入"
              class="courseInput course-price__input sales"
              v-model="message.tel"
            />
          </div>
        </ks-list-item>
        <ks-list-item v-if="way == 1" title="营业证件号">
          <!-- <div class="course-import idCard" v-if="way == 0">中国居民身份证</div> -->
          <input type="text" placeholder="请输入" class="messageNum" v-model="message.num"/>
        </ks-list-item>

        <ks-list-item title="经营类别范围" v-if="way == 1">
          <input type="text" placeholder="请输入" class="messageNum" v-model="message.scope" />
        </ks-list-item>
        <ks-list-item title="所在城市">
          <span @click="placeCity">{{city}}</span>
          <!-- <img
                    src="../../../assets/course-manage/common_icon_moreinfor.png"
                    alt=""
                    class="course-del-right"
          >-->
        </ks-list-item>
        <ks-list-item title="具体地址">
          <input type="text" placeholder="请输入" class="messageNum" v-model="message.site" />
        </ks-list-item>
      </div>
      <div class="autonym">
        <p class="autonym-photo">身份照片</p>
        <p>1.身份证照片不得有遮挡，保证自己清洗</p>
        <p>2.请在白色背景下拍摄，保证身份证边缘清晰</p>
        <p>3.请从证件的正上方拍摄，防止画面变形</p>
      </div>
      <!-- 上传照片 -->
      <div class="upload">
        <div class="upload-before" @click="uploadHead">
          <img :src="img.head" alt v-if="img.head" />
          <img src="../../../assets/extract/common_icon_certifi1.png" v-else />
          <p>上传身份证头像面</p>
        </div>
        <div class="upload-after" @click="uploadNational">
          <img :src="img.national" alt v-if="img.national" />
          <img src="../../../assets/extract/common_icon_certifi2.png" v-else />
          <p>上传身份证国徽面</p>
        </div>
      </div>
      <!-- 上传营业执照 -->
      <div class="upload-permit" @click="uploadLicense">
        <div class="upload-before">
          <img :src="img.license" alt v-if="img.license" />
          <img src="../../../assets/extract/common_icon_certifi3.png" v-else />
          <p v-if="way == 1">上传营业执照</p><p v-if="way == 0">上传相关资质</p>
        </div>
      </div>
    </div>
    <div class="subimt">
      <ks-button width="100%" type="primary" @click="put">确认提交</ks-button>
    </div>
    <ks-select-city :isshow="show" @getmsg="getmsg" />
  </div>
</template>

<script>
import { getArea } from "@/api/mall";
import { dorealName, saveTeacher } from "@/api/user";
export default {
  data() {
    return {
      city: "请选择",
      /**地区索引 */
      index: 0,
      /**地区选择是否显示 */
      show: false,
      /**认证方式 */
      way: 0,
      /**用户信息 */
      message: {
        name: "",
        tel: "",
        /**营业证件号 */
        num: "",
        /**经营类别范围 */
        scope: "",
        /**具体地址 */
        site: ""
      },
      /**授课情况 */
      select: 1,
      /**授课内容 */
      lessons: 1,
      /**授课类型 */
      courseType: [
        { flag: false, con: "直播" },
        { flag: false, con: "点播" },
        { flag: false, con: "音频" },
        { flag: false, con: "图文" },
        { flag: false, con: "题库" }
      ],
      /**上传图片地址 */
      img: {
        /**头像 */
        head: "",
        /**国徽 */
        national: "",
        /**营业执照 */
        license: ""
      },
      /**地区数组 */
      cityArr:[]
    };
  },
  methods: {
    uploadHead() {
      this.$store.ready(state => {
        this.$uploadImages({
          wxid: state.info.wxid,
          uploaded: res => {
            this.img.head = res.defaultpic;
          }
        });
      });
    },
    uploadNational() {
      this.$store.ready(state => {
        this.$uploadImages({
          wxid: state.info.wxid,
          uploaded: res => {
            this.img.national = res.defaultpic;
          }
        });
      });
    },
    uploadLicense() {
      this.$store.ready(state => {
        this.$uploadImages({
          wxid: state.info.wxid,
          uploaded: res => {
            this.img.license = res.defaultpic;
          }
        });
      });
    },
    /**完成选择 */
    done(val) {
      this.show = false;
      console.log(val);
    },
    /**取消 */
    cancel() {
      this.show = false;
    },
    placeCity() {
      this.show = !this.show;
      console.log(this.show);
    },
    getmsg(val) {
      this.city = val.site;
      /**城市ID数组 */
      this.cityArr = val.ids
    },
    put() {
      console.log(this.message.site)
      if (this.way == 0) {
        let arr = [];
        this.courseType.map(item => {
          if (item.flag == true) {
            arr.push(item.con);
          }
        });
        let params = {
          realname: this.message.name,
          real_photo1: this.img.head,
          real_photo2: this.img.national,
          teacher_photo: this.img.license,
          course_type: arr,
          course_case: this.select,
          //numberId: "",
          tel: this.message.tel,
          areaid: this.cityArr,
          course_content: this.lessons,
          address:this.message.site
        };
        saveTeacher(params).then(res => {
          this.$toast("实名认证提交成功", "success");
          if(res.result == "success"){
            this.$router.push('/user/extractManage')
          }
        });
      } else if (this.way == 1) {
        let params = {
          realname: this.message.name,
          real_photo1: this.img.head,
          real_photo2: this.img.national,
          teacher_photo: this.img.license,
          numberId: this.message.num,
          tel: this.message.tel,
          areaid: this.cityArr,
          address:this.message.site,
          range:this.message.scope,
        };
        dorealName(params).then(res => {
          this.$toast("实名认证提交成功", "success");
          this.$router.push('/user/extractManage')
        });
      }
    }
  },
  created() {}
};
</script>

<style>
.table {
  margin-bottom: 44px;
}
.page {
  background-color: #fff;
}
input {
  border: none;
}
.course-import input {
  text-align: right;
}
.way {
  padding: 15px;
}
.autonym {
  padding: 0 15px;
}
.autonym p {
  margin-bottom: 4px;
}
.autonym-photo {
  font-size: 16px;
  padding: 8px 0;
  margin-bottom: 0;
}
.upload {
  display: flex;
  margin-top: 10px;
  padding: 0 15px;
}
.upload-before,
.upload-after {
  width: 130px;
  height: 110px;
  text-align: center;
}
.upload-before {
  margin-right: 30px;
}
.idCard {
  color: black;
}
.select {
  padding: 0 15px;
  font-size: 14px;
}
.courseset {
  padding: 5px 0;
  font-size: 16px;
}
.courseType {
  margin-right: 8px;
}
.upload-before img,
.upload-after img {
  width: 100%;
  height: 80%;
}
.upload-permit {
  margin-top: 10px;
  padding: 0 15px;
}
.messageNum {
  text-align: right;
}
.course-del-right {
  width: 9px;
  height: 17px;
  vertical-align: sub;
  margin-left: 8px;
}
.subimt {
  position: fixed;
  bottom: 0;
  width: 100%;
}
</style>
