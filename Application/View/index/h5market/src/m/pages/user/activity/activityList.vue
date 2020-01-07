<template>
  <div class="bigpage">
    <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange"  v-if="flag">
      <div class="pages">
        <ks-tabs v-model="tabActive" @tab-click="handleClick">
          <ks-tab-pane label="全部" name="0"></ks-tab-pane>
          <ks-tab-pane label="未发布" name="1"></ks-tab-pane>
          <ks-tab-pane label="已发布" name="2"></ks-tab-pane>
          <ks-tab-pane label="即将开始" name="3"></ks-tab-pane>
          <ks-tab-pane label="报名中" name="4"></ks-tab-pane>
          <ks-tab-pane label="进行中" name="5"></ks-tab-pane>
          <ks-tab-pane label="已结束" name="6"></ks-tab-pane>
        </ks-tabs>
        <!-- 课程列表 -->
        <div class="courseList" v-for="(item,i) in list" :key="i" >
          <div class="courseLists">
            <div class="courseList-msg">
              <div class="courseList-msg__img">
                <ks-image :src="item.defaultpic" alt></ks-image>
              </div>
            </div>
            <div class="courseList-msg__content">
              <p @click="gotodel(item.courseid)">{{item.title}}</p>
              <span>{{item.enddate}}-{{item.begindate}}</span>
              <span>地点:{{item.address}}</span>
            </div>
          </div>
          <div class="courseList-foot ks-line ks-line--top">
            <div class="courseList-foot_-time">
              <span v-if="item.rank == 5" style="color:#ff0000">未发布</span>
              <span v-if="item.rank == 1" style="color:#ff9933">即将开始</span><span v-if="item.rank == 2" style="color:#ff66cc">报名中</span>
              <span v-if="item.rank == 3" style="color:#66cc66">进行中</span><span v-if="item.rank == 4" style="color:#999999">已结束</span>
            </div>
            <div class="courseList-foot_-switch">
              <ks-button
                class="ks-ml5"
                @click="popup(item.courseid,i)"
              >活动管理</ks-button>
            </div>
          </div>
        </div>
        <ks-empty msg="当前没有更多数据~" v-if="!list.length"></ks-empty>
        <div class="newcourse">
          <ks-button type="success" width="95%" class="ks-btn" @click="newcourse()">创建活动</ks-button>
        </div>
      </div>
    </ks-page-scroll-container>
  </div>
</template>

<script>
import { activityManage } from "@/api/activity";
import { delCourse } from '@/api/courseManage'
export default {
  data() {
    return {
      flag:false,
      tabActive: "0",
      is_show: true,
      /**分页 */
      page: 1,
      /**总条数 */
      pageCount: 1,
      /**列表数据 */
      list: [],
      /**活动状态 */
      status: -1,
      rank: -1,
    };
  },
  activated() {
    this.getList();
  },
  methods: {
    /**table切换 */
    handleClick(name) {
      if (name==1) {
        this.status = 1;
        this.rank = -1;
      }
      if(name==2){
        this.status = 2;
        this.rank = -1;
      }
      if (name==3) {
        this.rank = 1;
      }
      if(name==4){
        this.rank = 2;
      }
      if(name==5){
        this.rank = 3;
      }
      if(name==6){
        this.rank = 4;
      }
      if (name == 0) {
        this.rank = -1;
        this.status = -1;
      }
      
      this.getList();
    },
    /**显示弹出框 */
    popup(courseid,index) {
      this.$actionSheet({
        list: [
          {
            name: "编辑活动",
            type: "1"
          },
          {
            name: "报名管理",
            type: "2"
          },
          {
            name: "签到管理",
            type: "3"
          },
          {
            name: "删除活动",
            type: "4"
          }
        ]
      }).then(res => {
        if (res.type == 4) {
          /**删除操作 */
          this.$confirm("是否确认删除？").then(() => {
            delCourse({ courseid: courseid }).then(res => {
              if (res.result == "success") {
                this.list.splice(index, 1);
                this.$toast("删除成功", "success");
              }
            });
          });
        } else if (res.type == 3) {
          this.$router.push(`/activityManage?id=${courseid}&type=2`);
        } else if (res.type == 2) {
          this.$router.push(`/activityManage?id=${courseid}&type=1`);
        }else if (res.type == 1) {
          this.$router.push(`/issueActivity?id=${courseid}`);
        }
      });
    },
    /**获取列表数据 */
    getList(page = 1) {
      // this.$showLoading();
      this.page = page;
      activityManage({
        p: page,
        maxperpage: 10,
        status:this.status,
        rank:this.rank,
      }).then(res => {
        this.pageCount = res.page.total_pages;
        this.list = page == 1 ? res.list : this.list.concat(res.list);
        this.flag = true
      });
    },
    onPageChange(page) {
      this.getList(page);
    },
    newcourse() {
      this.$router.push('/issueActivity')
    },
    gotodel(id){
      this.$router.push(`/activity/${id}`)
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
.courseList-msg__content span {
  line-height: 19px;
}
.courseList-msg__content p {
  width: 210px;
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 10px;
  /* white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  -ms-text-overflow: ellipsis; */
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
.courseList-foot {
  display: flex;
  justify-content: space-between;
  margin-top: 12px;
  /* border-top: 1px solid #ccc; */
}
.courseList-foot__time {
  color: #2d2d2d;
}
.newcourse {
  background-color: #fff;
  position: fixed;
  bottom: 0;
  text-align: center;
  width: 100%;
}
.ks-image {
  height: 80px;
}
/* .bigpage {
  margin-bottom: 44px;
} */
.courseList-foot_-switch /deep/ .ks-button {
  height: 30px;
  line-height: 30px;
}
.courseList-foot_-time{
  margin-top: 11px;
  font-size: 14px;
}
.courseList-foot_-switch{
  margin-top: 9px;
}
.bigpage /deep/ .ks-tabs__header {
  overflow: auto;
}
.bigpage /deep/ .ks-tabs__header::-webkit-scrollbar {
    display: none;
}
.bigpage /deep/ .ks-tab__item{
    width: 20%;
    flex: 1 0 auto;
}
</style>