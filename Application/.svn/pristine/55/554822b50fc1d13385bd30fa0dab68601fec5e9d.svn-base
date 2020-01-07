<template>
  <div>
    <el-dialog title="设置链接" :visible.sync="visible" width="680px">
      <div class="link-box">
        <ks-loading type="partial" v-show="loading"/>
        <div class="lk-left">
          <div
            class="lk-item"
            v-for="(item,i) in tabs"
            @click="current = i"
            :class="current == i && 'on'"
            :key="i"
          >{{item.name}}</div>
        </div>
        <div class="lk-right" @scroll="scroll()" id="scrollView">
          <div class="lk-column-wrap" v-if="current == 0">
            <div
              class="lk-column"
              v-for="(item,index) in system"
              :key="index"
              @click="selectUrl(item.text,item.url)"
            >
              <span>{{item.text}}</span>
            </div>
          </div>
          <div class="lk-column-wrap" v-else-if="current == 1">
            <div
              class="lk-column"
              v-for="(item,index) in user"
              :key="index"
              @click="selectUrl(item.text,item.url)"
            >
              <span>{{item.text}}</span>
            </div>
          </div>
          <div v-else>
            <div class="lk-item" v-for="(item,index) in list" :key="index">
              <span @click="selectUrl(item.title,item.url)">{{item.title}}</span>
            </div>
            <div class="load-text" v-if="totalPages !== null && p < totalPages">滚动加载更多</div>
            <div class="load-text" v-else-if="!loading">已全部加载完成</div>
          </div>
        </div>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import { getStoreData } from "@/api/store";
import { getIsScrolltolower, getIdNodeNameByAct, domap } from "@/utils";
import systemLinks from "./link";
export default {
  name: "SelectLink",
  watch: {
    current() {
      if (this.current > 1) {
        this.p = 1;
        this.totalPages = null;
        this.list = [];
        this.getList();
      }
    }
  },
  data() {
    return {
      visible: false,
      loading: false,
      current: 0,
      user: systemLinks.user,
      system: systemLinks.common,
      tabs: [
        {
          name: "常用"
        },
        {
          name: "会员"
        },
        {
          name: "课程",
          act: "appCourse"
        },
        {
          name: "教辅周边",
          act: "appMall"
        },
        {
          name: "直播",
          act: "appClass"
        },
        {
          name: "专栏",
          act: "appColumn"
        },
        {
          name: "社群",
          act: "appTeam"
        },
        {
          name: "新闻",
          act: "appNews"
        }
      ],
      p: 1,
      totalPages: null,
      list: []
    };
  },
  methods: {
    callback() {
      //...
    },
    /**
     * 选择链接
     */
    selectUrl(title, url) {
      title = `${this.tabs[this.current].name} - 《${title}》`;
      this.callback(title, url);
      this.visible = false;
    },
    /**
     * 获取列表
     */
    getList() {
      if (this.loading) {
        return false;
      }
      this.loading = true;
      let act = this.tabs[this.current].act;
      getStoreData([
        {
          callKeyName: "defaultName",
          act: act,
          maxperpage: 20,
          p: this.p
        }
      ]).then(res => {
        let data = res.defaultName.list || [];
        /**
         * 链接重定向
         */
        let act = this.tabs[this.current].act;
        domap(data, item => {
          switch (act) {
            case "appCourse":
              item.url = "#/course/" + item.courseid;
              break;
            case "appClass":
              item.url = "#/class/" + item.classid;
              break;
            case "appColumn":
              item.url = "#/column/" + item.columnid;
              break;
            case "appNews":
              item.url = "#/news/" + item.id;
              break;
            case "appMall":
              item.url = "#/commodity?id=" + item.courseid;
              break;
          }
        });
        this.list = this.list.length ? this.list.concat(data) : data;
        this.totalPages = res.defaultName.page.total_pages;
        this.loading = false;
      });
    },
    /**
     * 监听滚动
     */
    scroll() {
      if (this.current > 1) {
        let is = getIsScrolltolower(scrollView);
        if (is && this.totalPages !== null && this.p < this.totalPages) {
          this.p++;
          this.getList();
        }
      }
    }
  }
};
</script>
<style scoped>
.link-mask {
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 999;
  background: rgba(0, 0, 0, 0.4);
}
.link-box {
  border: 1px solid #eee;
}
.link-box .link-title {
  height: 49px;
  line-height: 49px;
  overflow: hidden;
}

.link-title {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  padding: 0 10px;
  font-size: 16px;
  border-bottom: 1px solid #e3e3e3;
  position: relative;
}
.link-title span {
  width: 44px;
  height: 44px;
  position: absolute;
  right: 0;
  top: 0;
  cursor: pointer;
}
.link-title span .eva-icon {
  width: 24px;
  height: 24px;
  position: relative;
  top: 10px;
  display: block;
  margin: 0 auto;
}
.link-box {
  position: relative;
  padding-left: 130px;
  height: 400px;
}
.link-box .lk-left {
  width: 110px;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  background: #fff;
  border-right: 1px solid #eee;
  background: #f9f9f9;
}

.link-box .lk-left .lk-item {
  text-align: center;
  height: 40px;
  line-height: 40px;
  cursor: pointer;
  border-bottom: 1px solid #eee;
}
.link-box .lk-left .on {
  background: #fff;
  position: relative;
}
.link-box .lk-left .on::before {
  content: "";
  width: 2px;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  background: #488bff;
}

.link-box .lk-left .on::after {
  content: "";
  width: 1px;
  height: 100%;
  position: absolute;
  right: -1px;
  top: 0;
  background: #fff;
}

.link-box .lk-right {
  padding: 10px 0;
  height: 100%;
  position: relative;
  overflow-y: auto;
  box-sizing: border-box;
}

.link-box .lk-right .lk-item {
  height: 36px;
  line-height: 36px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  position: relative;
  padding-left: 15px;
}
.link-box .lk-right .lk-item span {
  cursor: pointer;
}
.link-box .lk-right .lk-item span:hover {
  color: #488bff;
}
.link-box .lk-right .lk-item::before {
  content: "";
  width: 4px;
  height: 4px;
  background: #b3b3b3;
  border-radius: 50%;
  position: absolute;
  left: 0;
  top: 16px;
}
.link-box .lk-column-wrap {
  margin-left: -5px;
}

.link-box .lk-column {
  height: 26px;
  line-height: 26px;
  display: inline-block;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  background: #fafafa;
  padding: 0 15px;
  margin: 5px;
  color: #666;
  cursor: pointer;
}

.link-box .lk-column:hover {
  background: #fff;
  border: 1px solid #488bff;
  color: #488bff;
}

.load-text {
  text-align: center;
  line-height: 44px;
  color: #b3b3b3;
  font-size: 12px;
}
</style>

