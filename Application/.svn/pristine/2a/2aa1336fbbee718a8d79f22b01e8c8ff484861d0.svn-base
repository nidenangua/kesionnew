<template>
  <div v-if="loaded">
    <ks-loading type="partial" v-show="loading" />
    <div class="form-row banner" v-if="managementData.other && managementData.other.banner">
      <span class="name">左侧分类封面</span>
      <div class="banner-box" v-if="managementData.other">
        <div class="banner-image ks-fl">
          <img :src="managementData.other.banner.src" />
        </div>
        <div class="banner-text ks-fl">
          <el-button
            size="small"
            type="primary"
            @click="$uploadImages(managementData.other.banner)"
          >更改封面</el-button>
          <p v-if="managementData.other.banner.size">建议上传封面尺寸为{{managementData.other.banner.size}}</p>
          <div class="clearfix" style="margin-top:20px; color:#666;">
            <span class="ks-fl">设置链接：</span>
            <span
              class="ks-switch ks-fl ks-ml10"
              @click="managementData.other.banner.flag = managementData.other.banner.flag ? false : true"
              :class="managementData.other.banner.flag && 'open'"
            ></span>
          </div>
          <div v-show="managementData.other.banner.flag" class="ks-mt10">
            <input
              class="form-textbox ks-fl"
              style="width:155px;"
              type="text"
              v-model="managementData.other.banner.url"
            />
            <div
              class="ks-bt ks-link-bt ks-fl ks-ml10"
              @click.stop="$selectLink(managementData.other.banner)"
            ></div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row clearfix" v-if="managementData.type !== 'news'">
      <span class="name">数据类型</span>
      <div class="clearfix">
        <label class="ks-fl" :class="managementData.type == 'course' && 'label-on'">
          <input type="radio" value="course" v-model="managementData.type" />课程
        </label>
        <label class="ks-fl" :class="managementData.type == 'column' && 'label-on'">
          <input type="radio" value="column" v-model="managementData.type" />专栏
        </label>
        <label class="ks-fl" :class="managementData.type == 'mall' && 'label-on'">
          <input type="radio" value="mall" v-model="managementData.type" />教辅周边
        </label>
      </div>
    </div>
    <div class="form-row clearfix">
      <span class="name">内容来源</span>
      <div class="clearfix">
        <label class="ks-fl" :class="contSource == 0 && 'label-on'">
          <input type="radio" value="0" v-model="contSource" />按内容
        </label>
        <label class="ks-fl" :class="contSource == 1 && 'label-on'">
          <input type="radio" value="1" v-model="contSource" />按条件
        </label>
      </div>
    </div>
    <select-item v-if="contSource == 0" :config="managementData.api" />
    <div v-else>
      <div class="form-row clearfix" v-if="managementData.type === 'course'">
        <span class="name">课程分类</span>
        <select class="form-select" v-model="managementData.api.data.courseType">
          <option value="-1001">不限</option>
          <option value="4">图文</option>
          <option value="3">音频</option>
          <option value="1">点播</option>
          <option value="2">直播</option>
        </select>
      </div>
      <div class="form-row clearfix" v-if="managementData.type !== 'news'">
        <span class="name">售卖价格</span>
        <select class="form-select" v-model="managementData.api.data.chargetype">
          <option value="-1001">不限</option>
          <option value="1">收费</option>
          <option value="2">打赏</option>
          <option value="0">免费</option>
        </select>
      </div>
      <div class="form-row clearfix">
        <span class="name">显示个数</span>
        <input
          v-model="managementData.api.maxperpage"
          type="text"
          @keyup="limitNumber(managementData.api,'maxperpage',20)"
          class="form-textbox fl"
          style="width:150px"
        />
        <span class="form-tips fsize12 ml10" style="line-height:34px">最多显示20条</span>
      </div>
    </div>
  </div>
</template>
<script>
import SelectItem from "@/pages/drag/management/SelectItem";
import { getStoreData } from "@/api/store";
import { cloneData, limitNumber } from "@/utils";

export default {
  name: "LabelManagement",
  props: {
    managementData: {
      type: Object,
      default() {
        return {};
      }
    }
  },
  data() {
    return {
      loaded: false,
      loading: false,
      contSource: null,
      /**
       * 停顿后执行，避免执行多次请求，减少服务器压力
       */
      resetFlag: true,
      resetTime: 1
    };
  },
  watch: {
    "managementData.type"(v) {
      /**
       * 监听type变化，改变配置api
       * 当api变化，会重新执行加载
       */
      switch (v) {
        case "course":
          this.managementData.api.act = "appCourse";
          this.managementData.api.data = {
            courseType: -1001,
            chargetype: -1001,
            sql_or_like: {}
          };
          break;
        case "mall":
          this.managementData.api.act = "appMall";
          this.managementData.api.data = {
            courseType: -1001,
            chargetype: -1001,
            sql_or_like: {}
          };
          break;
        case "class":
          this.managementData.api.act = "appClass";
          this.managementData.api.data = {
            classlevel: -1001,
            chargetype: -1001,
            sql_or_like: {}
          };
          break;
        case "column":
          this.managementData.api.act = "appColumn";
          this.managementData.api.data = {
            chargetype: -1001,
            sql_or_like: {}
          };
          break;
      }
      this.resetTime = 1;
    },
    /**
     * 监听api变化，重新加载
     */
    "managementData.api": {
      handler() {
        if (this.loaded) {
          /**
           * 更新视图数据
           */
          this.resetTime = 1;
          if (this.resetFlag) {
            this.resetList();
          }
        }
      },
      deep: true
    },
    contSource() {
      if (this.loaded) {
        if (this.contSource == 0) {
          /**
           * 按内容，清除所有条件限制
           */
          switch (this.managementData.type) {
            case "course":
              this.managementData.api.data.courseType = -1001;
              this.managementData.api.data.chargetype = -1001;
              break;
            case "mall":
              this.managementData.api.data.courseType = -1001;
              this.managementData.api.data.chargetype = -1001;
              break;
            case "class":
              this.managementData.api.data.classlevel = -1001;
              this.managementData.api.data.chargetype = -1001;
              break;
            case "column":
              this.managementData.api.data.chargetype = -1001;
              break;
          }
        } else {
          /**
           * 按条件，把内容筛选项清空
           */
          this.managementData.api.data.sql_or_like = {};
        }
      }
    }
  },
  methods: {
    resetList() {
      this.resetFlag = false;
      if (this.resetTime > 0) {
        setTimeout(() => {
          this.resetTime--;
          this.resetList();
        }, 500);
        return false;
      }

      this.resetFlag = true;
      this.loading = true;
      getStoreData([this.managementData.api]).then(res => {
        let list = res[this.managementData.api.callKeyName].list;
        this.managementData.list = list;
        this.loading = false;
      });
    },
    limitNumber(obj, key, num) {
      limitNumber(obj, key, num);
    }
  },
  mounted() {
    /**
     * 初始化默认值
     */
    let newApi = cloneData(this.managementData.api);
    newApi.data = newApi.data || {};
    switch (newApi.act) {
      case "appCourse":
        newApi.data.courseType = newApi.data.courseType || -1001;
        newApi.data.chargetype = newApi.data.chargetype || -1001;
        break;
      case "appMall":
        newApi.data.courseType = newApi.data.courseType || -1001;
        newApi.data.chargetype = newApi.data.chargetype || -1001;
        break;  
      case "appClass":
        newApi.data.classlevel = newApi.data.classlevel || -1001;
        newApi.data.chargetype = newApi.data.chargetype || -1001;
        break;
      case "column":
        newApi.data.chargetype = newApi.data.chargetype || -1001;
        break;
    }

    newApi.data.sql_or_like = newApi.data.sql_or_like || {};
    newApi.maxperpage = newApi.maxperpage || 10;
    if (newApi.data.sql_or_like.courseid) {
      this.contSource = 0;
    } else {
      this.contSource = 1;
    }
    this.managementData.api = newApi;
    this.$nextTick(() => {
      this.loaded = true;
    });

    if (this.managementData.other && this.managementData.other.banner) {
      let _banner = cloneData(this.managementData.other.banner);
      if (_banner.flag === undefined) {
        _banner.flag = _banner.url ? true : false;
      }
      this.managementData.other.banner = _banner;
    }
  },
  components: {
    SelectItem
  }
};
</script>
<style scoped>
.banner-box {
  width: 100%;
  overflow: hidden;
}
.banner-image {
  width: 136px;
  height: 218px;
  margin-top: 10px;
}
.banner-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.banner-text {
  margin-left: 20px;
  width: calc(100% - 156px);
}
.el-button {
  margin-top: 20px;
}
.banner-text p {
  font-size: 12px;
  color: #ccc;
  margin-top: 5px;
}
</style>
		
	}
</style>
