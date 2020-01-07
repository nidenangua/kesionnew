<template>
    <div class="big" v-if="flag">
       <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange" v-if="totalput">
          <div class="title">已更新{{totalput}}课时/共{{msg.expecthour}}课时</div>
          <div class="course" v-for="(item,i) in list" :key='i'>
              <span>课时{{i+1}}</span>
              <span class="course-name">
                  <span class="course-name__left">{{item.title}}</span>
                  <span v-if="msg.courseType != 2">
                    <span class="course-can" v-if="item.json && item.json.is_audition != 0 && msg.courseType == 3">可试听</span>
                    <span class="course-can" v-if="item.freeplay!= 0 && msg.courseType != 3">可试看</span>
                  </span>
              </span>
              <img src="../../../assets/course-manage/common_btn_action.png" alt="" @click="popup(item.title,item.chapterid,i)">
          </div>
        </ks-page-scroll-container>
        <ks-empty type="nolesson" :msg="'暂时还没有课程~'" v-else/>
        <div class="addcourse">
            <ks-button type="white"  width="25%" @click="gohome">返回</ks-button>
            <ks-button type="success" width="69%" @click="gotoAdd">添加课时</ks-button>
          </div>
    </div>
</template>

<script>
import { hourList,delHour } from "@/api/courseManage";
export default {
  data() {
    return {
      /**列表数据 */
      list:[],
      /**分页 */
      page:1,
      /**总页数 */
      pageCount:2,
      /**总条数 */
      totalput:0,
      /**节流阀 */
      flag:false,
      /**课时信息 */
      msg:'',
      /**课程类型 */
      courseType:0,
      /**课程id */
      courseID:'',
       /**当前课时 */
      coursenum:1
    };
  },
  methods: {
    gohome() {
      this.$router.push('/courseIndex')
    },
    popup(title,id,i) {
      this.$actionSheet({
        list: [
          {
            name: "编辑课时",
            type: "1"
          },
          {
            name: "删除",
            type: "2"
          }
        ]
      }).then(res => {
        if(res.type == 2) {
            this.$confirm(`是否确认删除课时${title}？`).then(()=>{
                delHour({courseid:this.msg.courseid,chapterid:id}).then(res=>{
                   this.list.splice(i,1)
                   this.totalput--
                   console.log(this.list,i)
                   this.$toast('删除成功')
                })
            })
        }else {
          this.$router.push(`/addCourse?courseHours=1&courseType=${this.courseType}&id=${this.msg.courseid}&hoursid=${id}`)
        }
      });
    },
    /**跳转添加课时 */
    gotoAdd() {
        if(this.list.length == this.msg.expecthour) {
          return this.$toast("已达到最大课时")
        }else {
        this.$router.push(`/addcourse?courseType=${this.courseType}&courseHours=1&id=${this.courseID}`)
        }
    },
    getlist(page=1) {
      this.page = page
      let id = this.$route.query.id
      hourList({p:page,maxperpage:15,courseid:id}).then(res=>{
        this.courseID = res.course.courseid
        this.courseType = res.course.courseType
        this.pageCount = res.page.total_pages
        this.totalput = res.page.totalput
        this.list = (page == 1 ? res.list : this.list.concat(res.list))
        this.msg = res.course
        this.flag = true
      })
    },
    onPageChange(page) {
      this.getlist(page)
    }
  },
  created() {
    this.getlist()
  },
  watch: {
      "$route":{
          handler() {
              console.log(this.$route.query.id)
              if(this.$route.query.id && this.$route.name == 'manageCourse') {
                  this.getlist()
              }
          }
      }
  },
};
</script>

<style scoped>
* {
  font-size: 16px;
}
.big {
  background-color: #f0f4f7;
  height: 100vh;
}
.title {
  padding: 15px 5px;
  background-color: #f0f4f7;
  font-weight: 600;
}
.course {
  display: flex;
  justify-content: space-between;
  padding: 10px 5px;
  background-color: #fff;
  border-bottom: 1px solid #f2f2f2;
}
.course img {
  width: 24px;
  height: 24px;
  vertical-align: middle;
}
.course-name {
  flex: 1;
  margin-left: 10px;
  height: 21px;
  display: inline-flex;
  line-height: 22px;
}
.course-name__left {
  max-width: 230px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}
.course-can {
  font-size: 12px;
  padding: 2px 3px;
  color: #7ba9fb;
  border: 1px solid #7ba9fb;
  margin-left: 10px;
}
.newcourse{
    background-color: #fff;
    position: fixed;
    bottom: 0;
    text-align: center;
    width: 100%;
}
.addcourse{
  display: flex;
  position: fixed;
  bottom: 0;
  width: 100%;
  background-color: #fff;
}
.addcourse button {
  margin-left: 2%;
}
</style>
