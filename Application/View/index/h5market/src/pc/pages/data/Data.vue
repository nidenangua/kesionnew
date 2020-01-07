<template>
  <div class="data">
    <!-- 内容区 -->
    <div class="data-box">
      <div class="data-background">
        <ks-image :src="url" />
      </div>
      <div class="data-tab">
        <div class="data-tab__left">
          <span :class="{active:tab==1}" @click="showTab(1)">最新发布</span>
          <span :class="{active:tab==2}" @click="showTab(2)">最热下载</span>
        </div>
        <div class="data-tab__right">
          <input type="text" placeholder="输入您想要搜索的资料名称" v-model="key" />
          <span @click="searchData">搜索</span>
        </div>
      </div>
      <div class="data-list">
        <div class="data-item" v-for="(item,i) in dataList" :key="i">
          <div class="data-item__left">
            <data-format class="data-list__format" height="72px" width="72px" :type="item.type" />

            <div class="data-item__title">
              <h1>{{item.title}} &nbsp; <el-tag type="success" size="small" v-if="item.chargetype == 1 && item.isbuy == 1">已购买</el-tag></h1>
              <div class="data-item__bottom">
                <span>文件大小：{{item.size}}</span>
                <span>下载次数：{{item.down_num}}次</span>
              </div>
            </div>
          </div>
          <div class="data-item__right">
            {{item.chargetype==0?'免费':'￥'+item.price}}
            <div v-if="item.chargetype == 0 || item.isbuy == 1" style="display:inline-block;">
              <el-button
                @click="downLoad(item)"
                type="primary"
                v-if="item.status == 1"
              >下载</el-button>
              <el-button
                @click="downLoad(item)"
                v-else-if="item.status == 2"
                disabled
              >下载失败</el-button>
            </div>
            <el-button type="danger" v-else @click="buyData(item.price,item.id)">购买</el-button>
          </div>
        </div>
      </div>
      <div style="text-align: center;">
        <el-pagination
          background
          layout="prev, pager, next"
          :page-count="pageCount"
          @current-change="getList"
          v-if="pageCount>0"
        />
        <ks-empty msg="暂无资料数据" v-else />
      </div>
    </div>
  </div>
</template>

<script>
import DataFormat from "./components/DataFormat";
import { getMaterialsList, getDownPath } from "@/api/data";
export default {
  name: "Data",
  components: {
    DataFormat
  },
  data() {
    return {
      /**默认最新排序 1最新 2最热 */
      tab: 1,
      pageCount: null,
      url: require("../../assets/user/doc_bg.png"),
      dataList: [],
      key: ""
    };
  },
  methods: {
    /**
     * @param {Object}
     * 搜索资料
     */
    searchData() {
      this.getList();
    },
    /*
     * 切换分页
     *
     */
    showTab(i) {
      this.tab = i;
      this.getList();
	},
	/**
	 * 获取资料列表
	 */
    getList(p = 1) {
      this.$showLoading();
      getMaterialsList({
        order: this.tab,
        keyword: this.key,
        p: p,
        maxperpage: 10
      }).then(res => {
        res.list.map(item => {
          item.status = 1;
          let typeMatch = item.file_name.split(".");
          let _type = typeMatch ? typeMatch[typeMatch.length - 1] : "";
          item.type = _type;
        });
        this.dataList = res.list;
        this.pageCount = res.page.total_pages;
        this.$hideLoading();
      });
	},
	/**
	 * 购买资料
	 */
	buyData(price,id){
		this.$showPay({
			payid: id,
			price: price,
			type: "data"
		})
	},
    /**
     * 下载文件
     */
    downLoad(item) {
      getDownPath({
        id: item.id
      }).then(res => {
        if (res.result === "success") {
          if(res.file_path){
            window.open(res.file_path)
          }else{
            item.status = 2;
          }
          
        }
      });
    }
  },
  mounted() {
    this.getList();
  }
};
</script>

<style scoped>
.data-background {
  width: 100%;
  height: 6rem;
}
.data-background .ks-image {
  width: 100%;
  height: 100%;
}
.data-tab {
  width: 1200px;
  margin: 40px auto 24px auto;
  height: 36px;
  line-height: 36px;
}
.data-tab__left {
  float: left;
  color: #585e61;
  font-size: 14px;
}
.data-tab__left span {
  margin-right: 30px;
  cursor: pointer;
}
.active {
  color: #2e84ee;
}
.data-tab__right {
  float: right;
}
.data-tab__right input {
  width: 362px;
  height: 36px;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
  padding-left: 18px;
}
.data-tab__right input::placeholder {
  color: #a1a4a6;
  font-size: 14px;
}
.data-tab__right span {
  display: inline-block;
  width: 86px;
  height: 34px;
  border: 1px solid #ccc;
  border-radius: 4px;
  line-height: 34px;
  text-align: center;
  font-size: 14px;
  color: #585e61;
  margin-left: 8px;
  cursor: pointer;
}
.data-list {
  width: 1200px;
  margin: 0 auto 30px auto;
}
.data-item {
  padding: 14px 20px 14px 16px;
  height: 72px;
  background: #fff;
  margin-bottom: 10px;
}
.data-item__left {
  float: left;
  height: 100%;
}
.data-list__format {
  width: 72px;
  height: 100%;
  float: left;
  margin-right: 16px;
}
.data-item__image .ks-image {
  width: 100%;
  height: 100%;
}

.data-item__title {
  float: left;
}
.data-item__title h1 {
  font-size: 16px;
  color: #2d3336;
  font-weight: 400;
  margin-top: 5px;
}
.data-item__bottom {
  margin-top: 15px;
  color: #929a9e;
  font-size: 14px;
}
.data-item__bottom span {
  margin-right: 60px;
}
.data-item__right {
  float: right;
  height: 100%;
  line-height: 72px;
  font-size: 16px;
  color: #ec4a46;
}

.data-item__right .el-button {
  margin-left: 30px;
}
</style>
