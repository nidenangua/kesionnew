<template>
  <div>
    <ks-page-scroll-container
      :page="params.p"
      :page-count="pageCount"
      @page-change="getList"
      class="teacher-list"
      v-if="teacherList.length"
    >
      <div
        class="teacher-list__item"
        v-for="(item,i) in teacherList"
        :key="i"
        @click="open(item.userid)"
      >
        <ks-create-bg
          border-radius="50%"
          position="absolute"
          class="teacher-list__head"
          :src="item.head"
          type="user"
        ></ks-create-bg>
        <div class="teacher-list__text">
          <div class="teacher-list__name">
            {{item.name}}
            <span>{{item.position}}</span>
          </div>
          <div class="teacher-list__introduce">{{item.shortIntro}}</div>
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty msg="暂未发现任何老师~" v-else-if="loaded"/>
  </div>
</template>

<script>
import { getStoreData } from "@/api/store";
export default {
  name: "TeacherList",
  data() {
    return {
      loaded: false,
      teacherList: [],
      params: {
        act: "appTeacher",
        callKeyName: "getTeacherList",
        p: 1,
        data: {
          //...
        },
        maxperpage: 10
      },
      pageCount: null
    };
  },
  methods: {
    open(userid) {
      this.$router.push(`/teacher/${userid}`);
    },
    getList(p = 1) {
      this.loaded = false;
      this.$showLoading();
      this.params.p = p;
      /**
       * 获取数据
       */
      getStoreData([this.params]).then(res => {
        this.teacherList = res.getTeacherList.list;
        this.pageCount = res.getTeacherList.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    }
  },
  activated() {
    document.title = "名师大咖";
  },
  created() {
    this.getList();
  }
};
</script>
	
<style scoped>
.teacher-list {
  padding-top: 20px;
}
.teacher-list__item {
  background: #fff;
  margin: 0 20px;
  padding: 20px 20px 20px 90px;
  position: relative;
  min-height: 55px;
}
.teacher-list__item + .teacher-list__item {
  margin-top: 20px;
}
.teacher-list__head {
  width: 55px;
  height: 55px;
  left: 20px;
  top: 20px;
}

.teacher-list__name {
  color: #333;
  height: 26px;
  line-height: 26px;
  overflow: hidden;
  font-size: 16px;
}
.teacher-list__name span {
  color: #999999;
  font-size: 11px;
  margin-left: 20px;
}
.teacher-list__introduce {
  margin-top: 10px;
  font-size: 13px;
  color: #666666;
  display: block;
  line-height: 22px;
  max-height: 66px;
  overflow: hidden;
}
</style>
