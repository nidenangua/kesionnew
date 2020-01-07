<template>
 <div class="bigpage">
   <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange">
    <div class="pages">
        <ks-tabs v-model="tabActive" @tab-click="handleClick">
            <ks-tab-pane label="全部" name="0"></ks-tab-pane>
            <ks-tab-pane label="视频" name="1"></ks-tab-pane>
            <ks-tab-pane label="直播" name="2"></ks-tab-pane>
            <ks-tab-pane label="图文" name="4"></ks-tab-pane>
            <ks-tab-pane label="音频" name="3"></ks-tab-pane>
        </ks-tabs>
        <!-- 课程列表 -->
        <div class="courseList" v-for="(item,i) in list" :key="i">
            <div class="courseLists">
                <div class="courseList-msg">
                    <div class="courseList-msg__img"  @click="godel(item.courseid,item.chapterid,item.expecthour)">
                        <ks-image
                            :src="item.defaultpic"
                            alt=""
                        >
                        </ks-image>
                        <span v-if="item.courseType == 1">点播</span>
                        <span v-else-if="item.courseType == 2">直播</span>
                        <span v-else-if="item.courseType == 3">音频</span>
                        <span v-else>图文</span>
                    </div>
                </div>
                <div class="courseList-msg__content" @click="godel(item.courseid,item.chapterid,item.expecthour)">
                    <p>{{item.title}}</p>
                    <span v-if="item.coursehour == 0">单课时</span>
                    <span v-else>已更新{{item.hourcount}} | 共{{item.expecthour}}课时</span>
                </div>
                <div class="courseList-managee">
                    <div class="courseList-managee__img">
                        <img src="../../../assets/course-manage/common_btn_action.png" alt="" @click="popup(item.courseid,i,item.chapterTemplate,item.coursehour,item.courseType,item.chapterid)">
                    </div>
                    <div class="courseList-managee__price">{{item.price}}</div>
                </div>
            </div>
            <div class="courseList-foot">
                <div class="courseList-foot_-time">
                    <span v-if="item.courseType == 2">直播时间 : {{item.begindate_time}}</span>
                    <span v-else>上传时间 : {{item.adddate}}</span>
                </div>
                <div class="courseList-foot_-switch" @click="putaway(item.courseid)">
                    <ks-switch v-model="item.statuss"></ks-switch>
                </div>
            </div>
        </div>
        <div class="newcourse">
            <ks-button type="success" width="95%" class="ks-btn" @click="newcourse()">创建新课程</ks-button>
        </div>
    </div>
  </ks-page-scroll-container>
 </div>
</template>

<script>
import { getCourseList,delCourse,downAndUp} from '@/api/courseManage'
export default {
  data() {
    return {
      tabActive: "0",
      is_show:true,
      /**分页 */
      page:1,
      /**总条数 */
      pageCount:1,
      /**列表数据 */
      list:[],
      /**课程类型 */
      courseType:0
    };
  },
  activated() {
    document.title="课程列表"
    this.getList()
  },
  methods: {
    /**table切换 */
    handleClick(name) {
      this.courseType = name
      this.getList()
    },
    /**显示弹出框 */
    popup(id,index,chapterTemplate,coursehour,courseType,chapterid) {
      this.$actionSheet({
        list: [
          {
            name:"编辑课程",
            type:'1'
          },
          {
            name:"课时管理",
            type:"2"
          },
          {
            name:"查看学员",
            type:"3"
          },
          // {
          //   name:"课程资料",
          //   type:"4"
          // },
          {
            name:"删除课程",
            type:"5"
          }
        ]
      }).then(res=>{
        if(res.type == 5) {
          /**删除操作 */
          this.$confirm("是否确认删除？").then(()=>{
            delCourse({courseid:id}).then(res=>{
              if(res.result == "success") {
                this.list.splice(index,1)
                this.$toast("删除成功", "success");
              }
            })
          })
        }else if(res.type == 3){
          this.$router.push(`/studentlist?id=${id}`)
        }else if(res.type == 2) {
          // 课时管理操作
          if(chapterTemplate != 3 && chapterTemplate != 0) {
             this.$toast("该课程章节结构不是纯课时结构，请到PC进行管理")
          }else {
            coursehour == 0 ? this.$router.push(`/addCourse?id=${id}&courseHours=0&courseType=${courseType}&hoursid=${chapterid}`) :this.$router.push(`/manageCourse?id=${id}`)
          }
        }else if(res.type == 1) {
          this.$router.push(`/newCourse?id=${id}`)
        }
      })
    },
    /**获取列表数据 */
    getList(page = 1) {
      // this.$showLoading();
      this.page = page;
      getCourseList({p:page,maxperpage:10,courseType:this.courseType}).then(res=>{
        console.log(res)
        res.list.map(item=>{
          item.status == 0 ? item.statuss = false : item.statuss = true
        })
        this.pageCount = res.page.total_pages;
        this.list = (page == 1 ? res.list : this.list.concat(res.list))
      })
    },
    onPageChange(page) {
      this.getList(page)
    },
    /**课程上下架 */
    putaway(id) {
      downAndUp({courseid:id})
    },
    /**创建新课时 */
    newcourse(){
      localStorage.setItem("courseContent","")
      this.$router.push('/newCourse')
    },
    /**跳转课程详情 */
    godel(id,chapterid,expecthour) {
      if(chapterid==0){
        return this.$toast("请先添加课时")
      }else {
        this.$router.push(`/course/${id}`)
      }
    }
  }
};
</script>

<style scoped>
.courseList {
  padding: 10px;
  box-sizing: border-box;
  width: 95%;
  margin: 0 auto;
  background-color: #fff;
  margin-top: 10px;
}
.courseLists {
  display: flex;
  justify-content: space-between;
}
.courseList-msg {
  width: 30%;
  height: 80px;
}
.courseList-msg__img {
  position: relative;
  height: 80px;
}
.courseList-msg__img img {
  width: 100%;
  height: 100%;
  border-radius: 5px;
}
.courseList-msg__img span {
  position: absolute;
  right: 0;
  bottom: 0;
  color: #fff;
  padding: 4px;
  background-color: rgba(0, 0, 0, 0.5);
}
.courseList-msg__content {
  flex: 1;
  margin-left: 10px;
}
.courseList-msg__content p {
  width: 150px;
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  -ms-text-overflow: ellipsis;
}
.courseList-msg__content span {
  font-size: 14px;
  color: #aaa;
}
.courseList-managee__img {
  text-align: right;
}
.courseList-managee__img img {
  width: 24px;
  height: 24px;
}
.courseList-managee__price {
  font-size: 14px;
  color: #ff6f68;
  padding-top: 32px;
}
.courseList-foot{
    display: flex;
    justify-content: space-between;
    margin-top: 5px;
}
.courseList-foot__time{
    color: #2d2d2d;
}
.newcourse{
    background-color: #fff;
    position: fixed;
    bottom: 0;
    text-align: center;
    width: 100%;
}
.ks-image{
  height: 80px;
}
.bigpage{
  margin-bottom: 44px
}
</style>