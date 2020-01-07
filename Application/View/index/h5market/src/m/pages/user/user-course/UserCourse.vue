<template>
    <div class="page">
        <ks-tabs :shadow="$store.state.style.id == 5" v-model="tabActive" @tab-click="handleClick">
            <ks-tab-pane label="课程" name="1"></ks-tab-pane>
            <ks-tab-pane label="专栏" name="7"></ks-tab-pane>
            <ks-tab-pane label="社群" name="10"></ks-tab-pane>
        </ks-tabs>
        <ks-page-scroll-container
            v-if="list.length"
            :page="p"
            :page-count="pageCount"
            @page-change="getList"
        >
            <div class="drag-course-default">
                <div class="course-item" v-for="(item,i) in list" :key="i" @click="open(item)">
                    <ks-create-bg class="course-item__image" :src="item.defaultpic">
                        <span
                            class="course-item__type"
                            v-if="tabActive == 1 && item.courseType == 1"
                        >点播课程</span>
                        <span
                            class="course-item__type"
                            v-else-if="tabActive == 1 && item.courseType == 2"
                        >直播课程</span>
                        <span
                            class="course-item__type"
                            v-else-if="tabActive == 1 && item.courseType == 3"
                        >音频课程</span>
                        <span
                            class="course-item__type"
                            v-else-if="tabActive == 1 && item.courseType == 4"
                        >图文课程</span>
                        <span
                            class="course-item__type"
                            v-else-if="tabActive == 1 && item.courseType == 5"
                        >面授课程</span>
                    </ks-create-bg>
                    <div class="main-con">
                        <div class="course-name">{{item.title}}</div>
                        <div class="course-num" v-if="tabActive == '1'">
                            <span
                                v-if="item.coursehour == 1"
                            >已开课{{item.hourcount}}节 | 预计更新{{item.expecthour}}节课</span>
                        </div>
                        <div class="course-num" v-else-if="tabActive == '7'">已更新{{item.nper}}期</div>
                        <div
                            class="course-num"
                            v-else-if="tabActive == '10'"
                        >{{item.member_num}}成员 | {{item.topic_num}}话题</div>
                        <div class="last-con" v-if="hasToken">知识店铺：{{item.storeinfo.storename}}</div>
                        <div class="last-con" v-else>
                            <span v-if="tabActive == '10'">{{item.description}}</span>
                            <span v-else>{{item.shortdesc}}</span>
                        </div>
                        <div v-if="tabActive == '1' && item.courseType == 1">
                            <ks-progress :percentage="item.rate"/>
                        </div>
                    </div>
                </div>
            </div>
        </ks-page-scroll-container>
        <ks-empty
            type="nolesson"
            :msg="'你还没有购买任何'+((tabActive == '1' && '课程') || (tabActive == '7' && '专栏') || (tabActive == '10' && '社群'))+'哦~'"
            v-else-if="loaded"
        />
        <store-footer-bar />
    </div>
</template>

<script>
import { getParams } from "@/utils";
import { getMyPurchase, showCourse } from "@/api/user";
export default {
  name: "UserCourse",
  data() {
    return {
      loaded: false,
      pageCount: 0,
      hasToken: -1,
      p: 1,
      list: [],
      tabActive: "1"
    };
  },
  methods: {
    open(item) {
      let type = item.type;
      let params = this.getViewRoute(item);
      location.href = item.storeinfo.storeurl + "/#" + params;
    },
    handleClick(name) {
      this.getList();
    },
    getList(p = 1) {
      this.$showLoading();
      this.p = p;
      if (p == 1) {
        this.list = [];
      }
      let params = {
        p: p,
        maxperpage: 10,
        gettype: this.tabActive
      };
      let par = getParams();
      if (par.h5token) {
        params.h5token = par.h5token;
        this.hasToken = 1;
      } else {
        this.hasToken = 0;
      }
      showCourse(params).then(res => {
        if (res.result === "success") {
          this.list = this.list.concat(res.values);
          this.pageCount = res.page.total_pages;
        }
        this.loaded = true;
        this.$hideLoading();
      });

    },
    getViewRoute(item) {
      let path;
      if (item.type == 7) {
        path = "/column/" + item.columnid;
      } else if (item.type == 10) {
        path = "/group/" + item.id;
      } else {
        path = "/course/" + item.courseid;
      }
      return path;
    }
  },
  activated() {
    document.title = "已购";
    this.getList();
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
/*默认样式*/
.drag-course-default {
  background: #fff;
  margin-top: 10px;
}
.drag-course-default .course-item {
  padding: 10px 15px 10px 150px;
  position: relative;
  min-height: 74px;
}

.drag-course-default .course-item__image {
  height: 74px;
  width: 120px;
  position: absolute;
  left: 15px;
  top: 10px;
  overflow: hidden;
}

.drag-course-default .course-item__type {
  position: absolute;
  top: 5px;
  left: 5px;
  color: #fff;
  letter-spacing: 0;
  background: rgba(0, 0, 0, 0.5);
  border-radius: 30px;
  padding: 2px 6px;
  font-size: 10px;
}

.drag-course-default .main-con .course-name {
  line-height: 18px;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  font-weight: bold;
  overflow: hidden;
  font-size: 14px;
  color: var(--secondary_text-color);
}
.drag-course-default .course-num {
  white-space: nowrap;
  text-overflow: ellipsis;
}
.drag-course-default .course-num,
.drag-course-default .last-con {
  color:var(--prompt-color);
  font-size: 12px;
  line-height: 20px;
  height: 20px;
  overflow: hidden;
  margin-top: 3px;
}

.drag-course-default .last-con .charge {
  float: right;
  color: var(--ornament-color);
}
</style>
