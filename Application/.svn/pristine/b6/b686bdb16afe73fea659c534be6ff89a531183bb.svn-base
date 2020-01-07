<template>
  <div class="page">
    <div class="course">
      <div class="course-cover">
        <p>课程封面</p>
        <div class="course-cover__image">
          <ks-image :src="imgurl" alt="">
          </ks-image>
          <ks-button type="upload" width="90px" class="ks-btn" @click="uploadImg">点击上传</ks-button>
        </div>
        <div class="course-name">
          <P>课程名称</P>
          <div class="course-import">
            <input
              type="text"
              placeholder="请输入课程名称"
              class="courseInput"
              v-model="courseName"
              maxlength="30"
            >
            <span>{{courseName.length}}/30</span>
          </div>
        </div>
        <div class="course-name">
          <P>课程介绍</P>
          <div class="course-import">
            <input
              type="text"
              placeholder="用于微信分享说明"
              class="courseInput"
              v-model="courseIntro"
              maxlength="45"
            >
            <span>{{courseIntro.length}}/45</span>
          </div>
        </div>
      </div>
    </div>
    <!-- 课程详情 -->
    <div class="course-del">
      <ks-list>
        <ks-list-item title="课程详情">
          <div @click="courseDel">
            <span :class="coursedel == '请输入' || coursedel == '' ?'' : 'pitch pitchcourse'">{{coursedel == '' ? '请输入' : coursedel}} 
              <img
              src="../../../assets/course-manage/common_icon_moreinfor.png"
              alt=""
              class="course-del-right courseimg"
              >
            </span>
          </div>
        </ks-list-item>
        <ks-list-item title="课程类型" @click="coursetype()">
          <span :class="[coursetypes == '请选择' ? '' : 'pitch',$route.query.id ? 'pitchs' : '']">{{coursetypes}}</span>
          <img
            src="../../../assets/course-manage/common_icon_moreinfor.png"
            alt=""
            class="course-del-right"
          >
        </ks-list-item>
        <ks-list-item title="直播类型" @click="Livetype()" v-if="coursetypes == '直播'">
          <span :class="livetypes == '请选择' ?'' : 'pitch'">{{livetypes}}</span>
          <img
            src="../../../assets/course-manage/common_icon_moreinfor.png"
            alt=""
            class="course-del-right"
          >
        </ks-list-item>
        <ks-list-item title="课程分类">
          <div class="courseCate">
            <div id="trigger4" ref="trigger" :class="courseCates == '请选择' ? '' : 'pitch'"></div>
            <div @click="isshow()">{{courseCates}}</div>
            <img
              src="../../../assets/course-manage/common_icon_moreinfor.png"
              alt=""
              class="course-del-right"
            >
          </div>
        </ks-list-item>
      </ks-list>
      <div class="courseset">课时设置</div>
      <div class="courseset">
        <div v-if="$route.query.id != undefined">
          <ks-radio v-model="select" :label="0" :disable="$route.query.id != undefined && select == 0 ? false : true">单课时</ks-radio>
          <ks-radio v-model="select" :label="1" :disable="$route.query.id != undefined && select == 1 ? false : true">连载课时</ks-radio>
        </div>
        <div v-else>
          <ks-radio v-model="select" :label="0">单课时</ks-radio>
          <ks-radio v-model="select" :label="1">连载课时</ks-radio>
        </div>
      </div>
      <ks-list v-if="select == 1">
        <ks-list-item title="连载课时数">
          <input type="text" placeholder="请输入" class="courseInput course-price__input" v-model="multipleCourse">
        </ks-list-item>
      </ks-list>
    </div>
    <!-- 售卖价格 -->
    <div class="course-price">
      <div class="courseset">售卖价格</div>
      <div class="courseset" >
        <ks-radio v-model="isprice" :label="1">收费</ks-radio>
        <ks-radio v-model="isprice" :label="2">打赏</ks-radio>
        <ks-radio v-model="isprice" :label="0">免费</ks-radio>
      </div>
      <ks-list>
        <ks-list-item title="产品价格" v-if="isprice == 1">
          <div class="course-import">
            <input type="text" placeholder="请输入价格" class="courseInput course-price__input" v-model="productPrice">元
          </div>
        </ks-list-item>
        <ks-list-item title="划线价格" v-if="isprice == 1">
          <div class="course-import">
            <input type="text" placeholder="请输入价格(可不填)" class="courseInput course-price__input" v-model="priceDel">元
          </div>
        </ks-list-item>
        <ks-list-item title="销量设置">
          <div class="course-import">
            <input
              type="text"
              placeholder="请输入人数，谨慎使用"
              class="courseInput course-price__input sales"
              v-model="salesSet"
              maxlength="6"
            >
          </div>
        </ks-list-item>
      </ks-list>
    </div>
    <!-- 按钮 -->
    <div class="couresbtn" v-if="select == 0">
      <ks-button type="success" width="96%" @click="flag = true;accomplish()">保存进入下一步</ks-button>
    </div>
    <div class="couresbtn" v-else>
      <ks-button type="white" width="48%" @click="accomplish()">完成</ks-button>
      <ks-button type="success" width="48%" @click="flag = true;accomplish()">保存进入下一步</ks-button>
    </div>
    <!-- <ks-select-cate :isshow ="show"  @getmsg="getmsg"></ks-select-cate> -->
  </div>
</template>

<script>
import { courseCategory, addCourse,showCourse} from "@/api/courseManage";
import PickerExtend from "picker-extend";
export default {
  data() {
    return {
      /**开关状态 */
      flagStatus:2,
      show:true,
      /**封面图片地址 */
      imgurl: "",
      /**单选课时 */
      select: 0,
      /**单选价格 */
      isprice: 1,
      /**课程类型 */
      coursetypes: "请选择",
      /**直播类型 */
      livetypes: "请选择",
      /**课程名称 */
      courseName: "",
      /**课程介绍 */
      courseIntro: "",
      /**课程详情 */
      coursedel: "",
      /**分类id */
      cateID: 0,
      /**单课时id */
      chapterid:'',
      /**课程分类 */
      courseCates:'请选择',
      /**分类id */
      courseCatesid:0,
      /**连载课时数 */
      multipleCourse:'',
      /**产品价格 */
      productPrice:'',
      /**划线价格 */
      priceDel:'',
      /**销量设置 */
      salesSet:'',
      /**未过滤内容 */
      coursedels:'',
      /**判断点击保存进入下一步 */
      flag:false,
      /**课程id */
      courseIDs:'',
      /**类型 */
      chapterTemplate:3,
      /**为转换的课程类型 */
      typeC:'',
      catelist:[]
    };
  },
  methods: {
    /**上传图片 */
    uploadImg() {
      this.$store.ready(state => {
        this.$uploadImages({
          wxid: state.info.wxid,
          uploaded: res => {
            this.imgurl = res.defaultpic;
          }
        });
      });
    },
    /**课程类型 */
    coursetype() {
      if(!this.$route.query.id) {
        this.$actionSheet({
        list: [
          {
            name: "图文",
            type: "1"
          },
          {
            name: "视频",
            type: "2"
          },
          {
            name: "音频",
            type: "3"
          },
          {
            name: "直播",
            type: "4"
          }
        ]
      }).then(res => {
        this.coursetypes = res.name;
      });
      }else {
        return
      }
    },
    /**直播类型 */
    Livetype() {
      if(!this.$route.query.id){
        this.$actionSheet({
        list: [
          {
            name: "语音直播",
            type: "1"
          },
          {
            name: "一对一视频直播",
            type: "2"
          },
          {
            name: "小班视频直播",
            type: "3"
          },
          {
            name: "千人视频直播",
            type: "4"
          }
        ]
      }).then(res => {
        this.livetypes = res.name;
      });
      } else {
        return
      }
    },
    /**课程详情 */
    courseDel() {
      this.$router.push(`/compile?type=1`);
    },
    /**点击完成按钮 */
    accomplish() {
      const {imgurl,courseName,coursedel,coursetypes,courseCates,select,isprice,multipleCourse,productPrice,priceDel,salesSet} = this
      if(!imgurl) return this.$toast("请选择图片")
      if(courseName == "") return this.$toast("请输入课程名称")
      if(coursedel == "") return this.$toast("请输入课程详情")
      if(coursetypes == "请选择") return this.$toast("请选择课程类型")
      // if(courseCates == "请选择") return this.$toast("请选择课程分类")
      if(select == 1 && multipleCourse == "") return this.$toast("请输入连载课时数")
      if(isprice == 1) {
        if(productPrice == "") return this.$toast("请输入产品价格")
        if(priceDel == "") return this.$toast("请输入划线价格")
        if(salesSet == "") return this.$toast("请输入销量设置")
      }
      if(isprice == 0 || isprice == 2) {
        if(salesSet == "") return this.$toast("请输入销量设置")
      }
      // if(this.imgurl == "") {
      //   return this.$toast("请添加图片")
      // }else if(this.courseName == ""){
      //   return this.$toast("请输入课程名称")
      // }else if(this.coursedel == ""){
      //   return this.$toast("请输入课程详情")
      // }else if (this.coursetypes == "请选择"){
      //   return this.$toast("请选择课程类型")
      // }else if(this.courseCates == "请选择"){
      //   return this.$toast("请选择课程分类")
      // }else if(this.select == 1){
      //   if(this.multipleCourse == "") {
      //     return this.$toast("请输入连载课时数")
      //   }
      // }else if(this.isprice == 1){
      //   if(this.productPrice == ""){
      //     return this.$toast("请输入产品价格")
      //   }else if(this.priceDel == "") {
      //     return this.$toast("请输入划线价格")
      //   }else if(this.salesSet == "") {
      //     return this.$toast("请输入销量设置")
      //   }
      // }else if(this.isprice == 0 || this.isprice == 2){
      //   if(this.salesSet == ""){
      //      return this.$toast("请输入销量设置")
      //   }
      // }
        let type = 0
        switch(this.coursetypes){
          case '视频':
            type = 1
            break
          case '直播':
            type = 2
            break
          case '音频':
            type = 3
            break
          case '图文':
            type = 4
            break
        }
        
        let liveType = ''
        switch(this.livetypes){
          case '一对一视频直播':
            liveType = 1
            break
          case '小班视频直播':
            liveType = 2
            break
          case '千人视频直播':
            liveType = 3
            break
          case '语音直播':
            liveType = 4
            break
        }
        
        let id = this.$route.query.id
        this.cateID == "" ? this.cateID = this.courseCatesid :this.cateID = this.cateID
        this.coursedels = localStorage.getItem("courseContent")
        let params = {
          courseid:id,
          courseType:type,
          livetype:liveType,
          title:this.courseName,
          categoryid:this.cateID,
          content:this.coursedels,
          defaultpic:this.imgurl,
          price:this.productPrice,
          price_market:this.priceDel,
          studentcount:this.salesSet,
          coursehour:this.select,
          chargetype:this.isprice,
          shortdesc:this.courseIntro,
          expecthour:this.multipleCourse,
          chapterTemplate:this.chapterTemplate,
          status:this.flagStatus
        };
        addCourse(params).then(res => {
          if(res.result == "success"){
            this.$toast("操作成功",'success');
            if(!this.flag) {
              this.$router.push('/courseIndex')
            }else if(this.flag && this.select == 0){
              if(this.$route.query.id) {
                  this.$router.push(`/addcourse?id=${res.courseid}&hoursid=${this.chapterid}&courseHours=${this.select}&courseType=${type}`)
              }else {
                  this.$router.push(`/addcourse?id=${res.courseid}&courseHours=${this.select}&courseType=${type}`)
              }
            }else {
              this.$router.push(`/manageCourse?id=${res.courseid}`)
            }
          }
        });
      
    },
    async getlist() {
      let id = this.$route.query.id
      await showCourse({courseid:id}).then(res=>{
        this.flagStatus = res.data.status
        localStorage.setItem("courseContent",res.data.content)
        this.chapterid = res.chapterid
        this.imgurl = res.data.defaultpic
        this.courseIDs = res.data.courseid
        this.courseName = res.data.title
        this.chapterTemplate = res.data.chapterTemplate
        this.courseIntro = res.data.shortdesc
        res.data.content = res.data.content.replace(/\<\/?img[^>]+>/g, "[图片]");
        res.data.content = res.data.content.replace(/\<\/?[^>]+>/g, "");
        res.data.content = res.data.content.replace(/&nbsp;/gi,"")
        let flag = localStorage.getItem('flag')
        let content = localStorage.getItem("courseContent");
        flag ? this.coursedels = content:
        this.coursedels = res.data.content
        content = content.replace(/\<\/?img[^>]+>/g, "[图片]");
        content = content.replace(/\<\/?[^>]+>/g, "");
        content = content.replace(/&nbsp;/gi,"")
        localStorage.removeItem('flag')
        flag ? this.coursedel = content:
        this.coursedel = res.data.content
        
        if(res.data.courseType == "1") {
          this.coursetypes = "视频"
        }else if(res.data.courseType == "2") {
          this.coursetypes = "直播"
        }else if(res.data.courseType == "3"){
          this.coursetypes = "音频"
        }else if(res.data.courseType == "4"){
          this.coursetypes = "图文"
        }else {
          this.coursetypes = "请选择"
        }
        if(res.data.livetype == 1) {
          this.livetypes = "一对一视频直播"
        }else if(res.data.livetype == 2){
          this.livetypes = "小班视频直播"
        }else if(res.data.livetype == 3) {
          this.livetypes = "牛人视频直播"
        }else if(res.data.livetype == 4){
          this.livetypes = "语音直播"
        }else {
          this.livetypes = "请选择"
        }
        this.courseCatesid = parseInt(res.data.categoryid)
        this.select = parseInt(res.data.coursehour)
        this.multipleCourse = res.data.expecthour
        this.isprice = parseInt(res.data.chargetype)
        this.productPrice = res.data.price
        this.priceDel = res.data.price_market
        this.salesSet = res.data.studentcount
      });
      courseCategory().then(res => {
        res.map(item=>{
        if(this.courseCatesid == item.categoryid) {
           this.courseCates = item.categoryname
        } else if(this.courseCatesid != item.categoryid && item.child){
          item.child.map(items=>{
            if(this.courseCatesid == items.categoryid) {
             this.courseCates = items.categoryname
            }else if(this.courseCatesid != item.categoryid && items.child){
              items.child.map(itemss=>{
                if(this.courseCatesid == itemss.categoryid) {
                 this.courseCates = itemss.categoryname
                }
              })
            }
          })
        }
      })
      })
    },
    getCate() {
      let that  = this
      courseCategory().then(res => {
      this.catelist = res
      res.map(item=>{
        if(this.courseCatesid == item.categoryid) {
          this.courseCates = item.categoryname
        } else if(this.courseCatesid != item.categoryid && item.child){
          item.child.map(items=>{
            if(this.courseCatesid == items.categoryid) {
              this.courseCates = items.categoryname
            }else if(this.courseCatesid != item.categoryid && items.child){
              items.child.map(itemss=>{
                if(this.courseCatesid == itemss.categoryid) {
                  this.courseCates = itemss.categoryname
                }
              })
            }
          })
        }
      })
      this.mobileSelect4 = new PickerExtend({
        trigger: "#trigger4",
        title: "课程分类",
        wheels: [{ data: res }],
        keyMap: {
          id: "categoryid",
          value: "categoryname",
          childs: "child"
        },
        triggerDisplayData:false,
        callback: function(indexArr, data) {
          that.courseCates = data[data.length-1].categoryname
          that.cateID = data[data.length - 1].categoryid;
        },
      });
      // this.mobileSelect4
    });
    },
    getmsg(val){
      console.log(val)
    },
    isshow() {
      this.catelist == [] ? this.$toast("暂时没有分类选择") : this.mobileSelect4.show()
    }
  },
  async mounted() {
    if(this.$route.query.id){
      await this.getlist()
    }
    /**获取分类 */
    this.getCate()
  },
  activated() {
    this.flag = false 
  },
  watch: {
    $route: {
      handler(old,val) {
        if (this.$route.name == "newCourse") {
          let content = localStorage.getItem("courseContent");
          content = content.replace(/\<\/?img[^>]+>/g, "[图片]");
          content = content.replace(/\<\/?[^>]+>/g, "");
          content = content.replace(/&nbsp;/gi,"")
          if (content) {
            this.coursedel = content;
          } else {
            this.coursedel = "请输入";
          }
        }
        
        if(this.$route.name == 'newCourse'){
        if(val.name == "compile"){
          return
        }else {
           this.courseName = ''
           this.cateID = ''
           this.imgurl=''
           this.productPrice=''
           this.priceDel=''
           this.salesSet=''
           this.select=''
           this.isprice=''
           this.courseIntro=''
           this.multipleCourse=''
           this.courseCates = '请选择'
           this.coursetypes = '请选择'
           this.coursedel = ''
           this.select = 0
           this.isprice = 1
           // this.$router.go(0) 
           if (this.$route.query.id) {
             this.getlist();
            }
           }
        }
      }
    }
  }
};
</script>

<style scoped>
* {
  font-size: 14px;
}

.course {
  margin-bottom: 8px;
  padding: 15px;
  background-color: #fff;
}
.course-cover p {
  margin-top: 8px;
  margin-bottom: 10px;
}
.ks-image {
  width: 100px;
  height: 80px;
  margin-right: 10px;
  vertical-align: bottom;
  display: inline-block;
}
.course-name {
  margin: 15px 0;
  border-top: 1px solid #eee;
}
.course-name p {
  margin: 10px 0;
}
.course-import {
  width: 100%;
  display: inline-flex;
  justify-content: space-between;
}
.course-import input {
  font-size: 16px;
  flex: 1;
  border: none;
  list-style: none;
  text-align: left;
}
.course-import span {
  font-size: 16px;
  padding-left: 20px;
  color: #aaa;
}
.course-del {
  margin-bottom: 8px;
}
.course-del-right {
  width: 9px;
  height: 17px;
  vertical-align: sub;
  margin-left: 8px;
}
.courseset {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  background: #fff;
  padding: 0 15px;
  position: relative;
  font-size: 16px;
}
.radio {
  width: 20px;
  height: 20px;
}
.course-price__input {
  text-align: right !important;
  padding-right: 10px;
  font-size: 14px !important;
}
.sales {
  padding-right: 0;
}
.couresbtn {
  display: flex;
  align-items: center;
  width: 100%;
  justify-content: space-between;
  height: 56px;
  background-color: #fff;
  margin-top: 30px;
  padding: 0 5px 0 15px;
  box-sizing: border-box;
}
.courseInput {
  border: 0;
}
.pitch {
  color: black;
}
.courseCate {
  display: flex;
  align-items: center;
}
.pitchcourse{
  display: inline-block;
  max-width: 200px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  text-align: right;
}
.pitchs{
  color:#999;
}
</style>
