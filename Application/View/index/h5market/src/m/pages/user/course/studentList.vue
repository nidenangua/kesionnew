<template>
    <div class="big" v-if="loaded">
        <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange" v-if="totalput">
            <div class="studentnum">共{{totalput}}个学员</div>
            <div class="student" v-for="(item,i) in list" :key='i'>
                <div class="student-msg">
                    <div class="student-msg__img">
                        <ks-image
                            :src="item.head"
                            class="studentImg"
                        ></ks-image>
                    </div>
                    <div class="student-msg__info">
                        <div class="student-msg__name">{{item.name}}</div>
                        <div class="student-msg__tel">手机： {{item.mobile}}</div>
                    </div>
                </div>
                <div class="student-plan">学习进度： {{item.speed}}</div>
            </div>
        </ks-page-scroll-container>
        <ks-empty type="nolesson" :msg="'暂时还没有学员~'" v-else/>
    </div>
</template>

<script>
import { getStudentList } from "@/api/courseManage";
export default {
  data() {
    return {
      /**学员列表 */
      list: [],
      /**分页 */
      page:1,
      /**总页数 */
      pageCount:0,
      /**总数量 */
      totalput:0,
      loaded:false
    };
  },
  methods: {
    getlist(page = 1) {
        this.page = page;
        let id = this.$route.query.id
        getStudentList({p:page,maxperpage:10,courseid:id}).then(res=>{
            this.pageCount = res.page.total_pages
            this.totalput = res.page.totalput
            this.list = (page == 1 ? res.list : this.list.concat(res.list))
            this.loaded = true
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
              if(this.$route.query.id) {
                  console.log(this.$route.query.id)
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
  height: 100vh;
  background-color: #f0f4f7;
}
.studentnum {
  padding: 15px 10px;
  background-color: #f0f4f7;
  font-weight: 500;
}
.student {
  padding: 15px 10px;
  background-color: #fff;
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid #f2f2f2;
}
.student-msg__img {
  width: 38px;
  height: 38px;
}
.studentImg {
  width: 100%;
  height: 100%;
  border-radius: 50%;
}
.student-msg__name,
.student-msg__tel {
  font-size: 13px;
}
.student-msg__info {
  margin-left: 10px;
}
.student-msg__tel {
  margin-top: 3px;
  color: #717171;
}
.student-msg {
  display: flex;
}
.student-plan {
  font-size: 13px;
  padding-top: 20px;
  box-sizing: border-box;
  color: #aaa;
}
</style>
