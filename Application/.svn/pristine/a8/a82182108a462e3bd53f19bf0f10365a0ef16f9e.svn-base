<template>
  <div>
    <ks-loading type="partial" v-show="selectedLoad"/>
    <div class="select-list">
      <ul>
        <li v-for="(item,index) in selected" :key="index">
          <div class="inner">
            <div class="close" @click="deleteSelected(index)">×</div>
            <div class="images" :style="{backgroundImage:'url('+item.defaultpic+')'}"></div>
            <div class="name">{{item.title}}</div>
          </div>
        </li>
        <li class="add">
          <div class="inner" @click="selectDataFlag = true">
            <i>+</i>
            添加内容
          </div>
        </li>
      </ul>
    </div>

    <div class="select-data" v-show="selectDataFlag">
      <ks-loading type="partial" v-show="loading"/>
      <div class="title">
        <div class="close" @click="selectDataFlag = false">×</div>
        <span v-if="config.act === 'appCourse'">选择课程</span>
        <span v-else-if="config.act === 'appClass'">互动课堂</span>
        <span v-else-if="config.act === 'appPaper'">选择试卷</span>
        <span v-else-if="config.act === 'appNews'">选择文章</span>
        <span v-if="config.act == 'appColumn'">选择专栏</span>
      </div>
      <div class="tab" v-if="tabList.length">
        <li
          v-for="(item,i) in tabList"
          :class="item.type == type && 'on'"
          @click="slideData(item.type)"
          :key="i"
        >{{item.name}}</li>
      </div>

      <div class="sc">
        <input type="text" v-model="key" placeholder="请输入关键词">
      </div>

      <div class="list" :style="{height:height+'px'}">
        <ul>
          <li v-for="(item,index) in list" :key="index">
            <label :for="'item'+item.$id">
              <input
                type="checkbox"
                :ref="'checkbox'+item.$id"
                class="ks-checkbox"
                :id="'item'+item.$id"
                :checked="isDataSelected(item.$id)"
                :value="item.$id"
                @click="selectDataItem(item)"
              >
              {{item.title}}
            </label>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
import { domap, deleteArray } from "@/utils";
import { getStoreData } from "@/api/store";
export default {
  name: "SelectItem",
  props: ["config"],
  data() {
    return {
      selectDataFlag: false,
      loading: false,
      scFlag: true,
      scTime: 2,
      height: window.innerHeight - 200,
      /**
       * 已选择的内容
       */
      selected: [],
      selectedLoad: true,
      /**
       * 模块子类别
       */
      tabList: [],
      type: null,
      /**
       * 数据列表
       */
      list: [],
      /**
       * 关键词
       */
      key: ""
    };
  },
  watch: {
    "config.act"() {
      this.updateList(true);
    },
    key() {
      /**
       * 稍停顿后执行搜索，避免执行多次搜索请求，减少服务器压力
       */
      if (this.scFlag) {
        this.scFlag = false;
        this.goSearch();
      } else {
        this.scTime = 2;
      }
    },
    selected() {
      this.updateViewData();
    },
    type() {
      this.updateList();
    }
  },
  methods: {
    /**
     * 搜索
     */
    goSearch() {
      if (this.scTime === 0) {
        this.scFlag = true;
        this.scTime = 2;
        this.updateList();
      } else {
        this.scTime--;
        setTimeout(() => {
          this.goSearch();
        }, 250);
      }
    },
    getIdNodeNameByAct(act) {
      let keyName;
      switch (act) {
        case "appCourse":
          keyName = "courseid";
          break;
        case "appClass":
          keyName = "classid";
          break;
        case "appColumn":
          keyName = "columnid";
          break;
        case "appPaper":
          keyName = "paperId";
          break;
        default:
          keyName = "id";
      }
      return keyName;
    },
    /**
     * 更新数据
     */
    updateList(isFirstUpdate) {
      this.loading = true;
      if (isFirstUpdate) {
        switch (this.config.act) {
          case "appCourse":
            this.tabList = [
              {
                type: 4,
                name: "图文"
              },
              {
                type: 3,
                name: "音频"
              },
              {
                type: 1,
                name: "点播"
              },
              {
                type: 2,
                name: "直播"
              }
            ];
            this.type = this.tabList[0].type;
            break;
          case "appClass":
            this.tabList = [
              {
                type: 0,
                name: "大班课"
              },
              {
                type: 1,
                name: "小班课"
              },
              {
                type: 2,
                name: "一对一"
              }
            ];
            this.type = this.tabList[0].type;
            break;
          default:
            this.tabList = [];
        }
      }
      let data = {
        sql_or_like: {
          title: this.key
        }
      };
      switch (this.config.act) {
        case "appCourse":
          data.courseType = this.type;
          break;
        case "appClass":
          data.classlevel = this.type;
          break;
      }

      let moduleConfigList = [
        {
          callKeyName: "defaultName",
          act: this.config.act,
          data: data,
          maxperpage: 1000
        }
      ];

      /**
       * 获取已选择的内容
       */
      if (isFirstUpdate) {
        moduleConfigList.push(this.config);
      }

      /**
       * 获取当前模块数据列表
       */
      getStoreData(moduleConfigList).then(res => {
        let callKeyName = this.config.callKeyName;
        if (res[callKeyName]) {
          this.selected = this.resetList(res[callKeyName].list);
        }
        let list = this.resetList(res.defaultName.list);
        this.list = list;
        this.loading = false;
        this.selectedLoad = false;
      });
    },
    /**
     * 重新处理数据列表
     * 增加$id唯一标识
     */
    resetList(list) {
      let nodeName = this.getIdNodeNameByAct(this.config.act);
      domap(list, item => {
        item.$id = item[nodeName];
      });
      return list;
    },
    /**
     * 更新页面数据
     */
    updateViewData() {
      let selectedIds = new Array();
      domap(this.selected, item => {
        selectedIds.push(item.$id);
      });
      let nodeName = this.getIdNodeNameByAct(this.config.act);
      /**
       * classid 字段特殊处理
       */
      if (nodeName === "classid") {
        nodeName = "a.classid";
      }
      let like = {};
      like[nodeName] = selectedIds;
      /**
       * 更新配置接口信息，父亲层监听到配置变化会重新请求接口
       */
      this.config.maxperpage = selectedIds.length || 4;
      this.config.data.sql_or_like = like;
    },

    /**
     * 是否为选中信息
     */
    isDataSelected(current) {
      let is = false;
      domap(this.selected, item => {
        if (item.$id == current) {
          is = true;
        }
      });
      return is;
    },
    /**
     * 选择信息
     */
    selectDataItem(selectedItem) {
      let el = this.$refs[`checkbox${selectedItem.$id}`][0];
      if (el.checked) {
        this.selected.push(selectedItem);
      } else {
        let newSelectedArr = new Array();
        for (let i = 0; i < this.selected.length; i++) {
          let item = this.selected[i];
          if (selectedItem.$id != item.$id) {
            newSelectedArr.push(item);
          }
        }
        this.selected = newSelectedArr;
      }
    },
    /**
     * 信息类别切换
     */
    slideData(val) {
      this.type = val;
    },
    /**
     * 删除已选中的内容
     */
    deleteSelected(index) {
      this.selected = deleteArray(this.selected, index);
    }
  },
  mounted() {
    this.updateList(true);
  }
};
</script>
<style scoped>
.select-list {
  margin-left: -15px;
}
.select-list li {
  width: 33.3%;
  float: left;
}
.select-list .inner {
  margin: 15px 0 0 15px;
  border: 1px solid #eef2f5;
  height: 105px;
  position: relative;
}
.select-list .images {
  height: 80px;
  background-size: contain;
  background-repeat: no-repeat;
  background-position: 50% 50%;
}
.select-list .close {
  width: 20px;
  height: 20px;
  background: #e56352;
  text-align: center;
  line-height: 20px;
  position: absolute;
  right: -10px;
  top: -10px;
  color: #fff;
  border-radius: 50%;
  font-size: 16px;
  cursor: pointer;
}
.select-list .close:hover {
  background: #e5412c;
}
.select-list .name {
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  padding: 0 5px;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.select-list .add .inner {
  text-align: center;
  line-height: 32px;
  cursor: pointer;
  color: #aaa;
}
.select-list .add .inner:hover {
  color: #e5412c;
}
.select-list .add i {
  font-size: 48px;
  display: block;
  font-family: simsun;
  margin-top: 24px;
  font-style: normal;
}

.select-data {
  width: 280px;
  height: 100%;
  background: #fff;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 99;
  box-sizing: border-box;
  padding: 20px;
  border-left: 1px solid #eee;
}
.select-data .title {
  font-size: 18px;
  line-height: 38px;
  position: relative;
}
.select-data .title .close {
  width: 38px;
  height: 38px;
  text-align: center;
  position: absolute;
  right: 0;
  top: 0;
  font-size: 22px;
  font-family: simsun;
  cursor: pointer;
}
.select-data .title .close:hover {
  color: #e5412c;
}
.select-data .tab {
  height: 34px;
  margin-top: 10px;
}
.select-data .tab li {
  float: left;
  width: 25%;
  font-size: 14px;
  height: 34px;
  line-height: 34px;
  cursor: pointer;
}
.select-data .tab .on {
  color: #e5412c;
  position: relative;
}
.select-data .tab .on::after {
  content: "";
  width: 30px;
  height: 2px;
  background: #e5412c;
  position: absolute;
  bottom: 0;
  left: 0;
}
.select-data .list {
  overflow-y: auto;
}
.select-data .list ul {
  padding: 10px 0;
}
.select-data .list li {
  height: 34px;
  line-height: 34px;
  font-size: 14px;
  padding: 10px 0;
  border-top: 1px solid #eee;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.select-data .list li:first-child {
  border-top: 0px;
}
.select-data .list li label {
  cursor: pointer;
}
.select-data .list .ks-checkbox {
  position: relative;
  top: 4px;
}
.select-data .sc {
  margin-top: 15px;
}
.select-data .sc input {
  width: 100%;
  height: 32px;
  line-height: 32px;
  border-radius: 40px;
  border: 0px;
  background: #eef2f5 url(../../../assets/drag/icon-sc.png) no-repeat 15px 50%;
  box-sizing: border-box;
  padding-left: 40px;
}
</style>

