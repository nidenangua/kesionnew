<template>
  <div>
    <div class="banner">
      <img src="../../assets/mall/banner.png" alt />
    </div>
    <ks-container>
      <!-- 课程选择导航 -->
      <!-- <div class="course-nav">
                <div class="course-nav__category" v-if="childList && childList.length">
                    <span
                        :class="{active2:currentCategoryid == child.categoryid}"
                        v-for="(child,c) in childList"
                        :key="c"
                        @click="filterList({categoryid:child.categoryid})"
                    >{{child.categoryname}}</span>
                </div>
                <div class="course-nav__category" style="margin-top:10px;">
                    <span>
                        <a @click="filterList({categoryid:0})">全部</a>
                    </span>
                    <span
                        :class="{active:courseType == item.courseType}"
                        v-for="item in courseTypes"
                        :key="item.courseType"
                        @click="filterList({coursetype:item.categoryid})"
                    >{{item.categoryname}}</span>
                </div>
      </div>-->
      <div class="course-nav">
        <div class="course-nav__category" v-if="categoryList.length">
          <span>
            <a @click="filterList({categoryid:0})">全部</a>
          </span>
          <span
            :class="{active:currentCategoryid==category.categoryid || currentTopCategoryid == category.categoryid}"
            v-for="(category,c) in categoryList"
            :key="c"
            @click="filterList({categoryid:category.categoryid})"
          >{{category.categoryname}}</span>
        </div>
        <div class="course-nav__category" v-if="childList && childList.length">
          <span
            :class="{active2:currentCategoryid == child.categoryid}"
            v-for="(child,c) in childList"
            :key="c"
            @click="filterList({categoryid:child.categoryid})"
          >{{child.categoryname}}</span>
        </div>
      </div>
    </ks-container>
    <ks-container class="course-list" title="全部商品">
      <div class="course-list__order" slot="title-right">
        <!-- 搜索框 -->

        <ul>
          <li class="search-li">
            <div class="kd-head__search">
              <input type="text" placeholder="请输入您要搜索的课程" v-model="keyword" @change="goSearch" />
              <img src="../../assets/mall/sousuo.png" />
            </div>
          </li>
          <li :class="order == 1 && 'active'" @click="filterList({order:1})">最新</li>
          <li :class="order == 2 && 'active'" @click="filterList({order:2})">热门</li>
        </ul>
      </div>
      <el-row :gutter="30">
        <ul class="share">
          <li @click="gotoorder()">
            <img src="../../assets/mall/shop_btn_order.png" />我的订单
          </li>
          <li class="goshop" @click="gotoshop">
            <img src="../../assets/mall/shop_btn_shopcart.png" />
            <span class="goshop-num">{{num}}</span>
            购物车
          </li>
          <li @click="backTop">
            <img src="../../assets/mall/shop_btn_up.png" />返回顶部
          </li>
        </ul>
        <el-col v-for="(item,e) in listt" :key="e" :span="6">
          <div class="course-list__item" @click="open(item.courseid || item.columnid)">
            <ks-image :src="item.defaultpic">
              <div class="course-list__item-shadow" v-if="$route.name === 'CourseList'">
                <span
                  v-if="item.courseType == 2"
                  class="course-list__item-tag"
                >{{item.livetype | handleLiveType}}</span>
              </div>
            </ks-image>
            <div class="course-list__item-footer">
              <div
                class="course-list__item-title"
                :class="item.title.length < 20 && 'course-list__item-title--sp'"
              >{{item.title}}</div>
              <div class="course-list__item-desc" v-if="item.title.length < 20">{{item.shortdesc}}</div>
              <div
                class="course-list__item-learn"
                v-if="$route.name === 'ColumnList'"
              >已更新{{item.qs}}期</div>
              <div class="course-list__item-learn" v-else>{{item.studentcount}} 人购买</div>
              <div
                class="course-list__item-price"
                :class="item.chargetype == 1 && 'course-list__item-price--bold'"
              >
                ￥{{item.price}}
                <!-- <span
                  v-if="Number(item.price_market) > 0 && item.chargetype == 1"
                >¥{{item.price_market}}</span>
                <el-button
                  type="primary"
                  size="small"
                  round
                  icon="el-icon-shopping-cart-2"
                  @click.stop="joincar(item.courseid)"
                >加入购物车</el-button> -->
              </div>
            </div>
          </div>
        </el-col>
      </el-row>
      <div align="center">
        <el-pagination
          background
          layout="prev, pager, next"
          :total="page"
          :page-size="12"
          @current-change="handleCurrentChange"
          v-if="listt.length>0"
        ></el-pagination>
        <ks-empty msg="该分类暂无商品" v-else />
      </div>
    </ks-container>
  </div>
</template>

<script>
import { cloneData } from "@/utils";
// import { courseCategory } from "@/api/course";
import { mallList, addCart, mallCate } from "@/api/mall.js";
export default {
  name: "MallIndex",
  data() {
    return {
      keyword: "",
      /**控制购物车点击 */
      flag: false,
      /**购物车数量 */
      num: 0,
      /**数据加载状态 */
      loaded: false,
      /**数据总页数 */
      page: 0,
      /**请求列表数据的一些参数 */
      params: {
        act: "appCourse",
        callKeyName: "courseList",
        p: 1,
        maxperpage: 12
      },
      /**当前选择的一级分类id */
      currentTopCategoryid: "0",
      /**当前选择的分类id */
      currentCategoryid: "0",
      /**排序 */
      order: "1",
      /**数据列表
       list: [],*/
      /**数据列表 */
      listt: [],
      /**分类联动关系 */
      categoryRelations: [],
      /**分类数据列表 */
      categoryList: [],
      childList: [],
      courseType: "0",
      /**商品类型 */
      courseTypes: [],
      /**id */
      categoryid: 0
    };
  },
  watch: {
    $route: {
      handler() {
        if (
          this.$route.name === "CourseList" ||
          this.$route.name === "LiveList" ||
          this.$route.name === "ColumnList" ||
          this.$route.name === "MallIndex"
        ) {
          this.setCategoryRelation();
        }
      },
      deep: true
    }
  },
  /**
   * 获取商品列表数据
   */
  activated() {
    this.getCourseCategory().then(() => {
      this.setCategoryRelation();
    });
    // mallCate().then(res=>{
    //     console.log(res)
    //     this.courseTypes = res
    // })
  },
  methods: {
    /**
     * 根据当前路由的分类id，设置分类联动关系
     */
    setCategoryRelation() {
      let categoryid = this.$route.query.categoryid || "0";
      this.order = this.$route.query.order || "1";
      this.courseType =
        this.$route.query.courseType || this.$route.query.coursetype || "0";
      this.currentTopCategoryid = null;
      this.currentCategoryid = categoryid;
      this.categoryRelations = [];
      if (`${categoryid}` === "0") {
        this.childList = [];
        this.getList();
        return;
      }
      this.getCurCategoryRelation(categoryid, this.categoryList, "[]", arr => {
        arr.map((item, i) => {
          if (i === 0) {
            this.categoryRelations.push(item);
            this.currentTopCategoryid = item.categoryid;
            if (item.child) {
              this.childList = item.child;
            } else {
              this.childList = [];
            }
          }
        });
        this.getList();
      });
    },
    /**
     * 获取分类关系
     */
    getCurCategoryRelation(categoryid, categoryList, arr, resolve) {
      let selectedItem;
      categoryList.map(item => {
        if (item.categoryid == categoryid) {
          selectedItem = item;
        }
      });

      if (selectedItem) {
        let categoryArr = JSON.parse(arr);
        categoryArr.push(selectedItem);
        resolve(categoryArr);
      } else {
        categoryList.map(item => {
          if (item.child) {
            let categoryArr = JSON.parse(arr);
            categoryArr.push(item);
            this.getCurCategoryRelation(
              categoryid,
              item.child,
              JSON.stringify(categoryArr),
              resolve
            );
          }
        });
      }
    },
    /**
     * 筛选数据
     */
    filterList(obj) {
      this.categoryid = obj;
      let _query = cloneData(this.$route.query);
      let keys = Object.keys(obj);
      keys.map(k => {
        _query[k] = obj[k];
      });
      this.$router.push({
        path: this.$route.path,
        query: _query
      });
    },
    getList(val) {
      let maxperpage = 12;
      mallList({
        p: val,
        maxperpage,
        categoryid: this.$route.query.categoryid,
        rank: this.$route.query.order,
        keyword: this.keyword
      }).then(res => {
        this.num = res.cart_num;
        this.listt = res.list;
        this.page = parseInt(res.page.totalput);
      });
    },
    handleCurrentChange(val) {
      this.getList(val);
    },
    /*
     * 打开课程详情页
     */
    open(id) {
      this.$router.push(`commodity?id=${id}`);
    },
    /**
     * 获取课程分类
     */
    getCourseCategory() {
      return new Promise(resolve => {
        mallCate({}).then(res => {
          this.categoryList = res;
          resolve(res);
        });
      });
    },

    /**加入购物车 */
    joincar(id) {
      if (this.flag) {
        return;
      } else {
        let params = {
          num: 1,
          goodsid: id,
          attributeid: 0,
          type:2
        };
        addCart(params).then(res => {
          if (res.result == "success") {
            this.num = res.cart_num;
            this.$message({ message: "加入购物车成功", type: "success" });
            this.flag = true;
            setTimeout(() => {
              this.flag = false;
            }, 3000);
          }
        });
      }
    },

    /**进入购物车页面 */
    gotoshop() {
      this.$router.push("/mall/shopcar");
    },
    /**进入订单页面 */
    gotoorder() {
      this.$router.push("/user/order");
    },
    /**页面滚到顶部 */
    backTop() {
      const that = this;
      let timer = setTimeout(() => {
        let ispeed = Math.floor(-that.scrollTop / 5);
        document.documentElement.scrollTop = document.body.scrollTop =
          that.scrollTop + ispeed;
        if (that.scrollTop === 0) {
          clearInterval(timer);
        }
      }, 16);
    },
    /**搜索 */
    goSearch() {
      this.getList();
    }
  },
  mounted() {
    window.addEventListener("scroll", this.scrollToTop);
  },
  destroyed() {
    window.removeEventListener("scroll", this.scrollToTop);
  }
};
</script>

<style scoped>
/**分类筛选部分*/
.course-nav {
  color: #2d3336;
  font-size: 14px;
  background: #fff;
  padding: 10px 20px;
}
.course-nav__relations {
  color: #999;
  border-bottom: 10px;
  border-bottom: 1px solid #eee;
  margin-bottom: 15px;
}
.course-nav__relations,
.course-nav__category {
  line-height: 23px;
  height: 23px;
  padding-bottom: 10px;
}
.course-nav__relations {
  padding-left: 10px;
}
.course-nav__relations a {
  cursor: pointer;
}
.course-nav__relations span {
  margin: 0 5px;
}
.course-nav__relations span i {
  margin-right: 5px;
}
.course-nav__title {
  position: absolute;
  width: 100px;
  left: 15px;
  top: 0;
  color: #999;
}
.course-nav__category {
  position: relative;
}
.course-nav__category i {
  font-style: normal;
  cursor: pointer;
}
.course-nav__category img {
  display: inline-block;
  margin: 3px 10px 0 10px;
}
.course-nav__category span {
  color: #585e61;
  margin: 0 15px;
  cursor: pointer;
}

.course-nav__category .active,
.course-nav__category span:hover {
  color: #2e84ee;
}
.course-nav__category .active2,
.course-nav__category .active2:hover {
  background: #2e84ee;
  color: #fff;
  padding: 4px 7px;
  border-radius: 3px;
}

/**课程列表*/
.course-list__order {
  font-size: 14px;
  border-radius: 4px;
  position: relative;
  top: 6px;
  overflow: hidden;
}
.course-list__order li {
  height: 30px;
  line-height: 30px;
  float: left;
  padding: 0 15px;
  border: 1px solid #ddd;
  cursor: pointer;
  color: #666;
}
.course-list__order .active {
  border: 1px solid #2e84ee;
  background: #2e84ee;
  color: #fff;
  position: relative;
}
.course-list .el-col {
  padding-bottom: 30px;
}
.course-list__item {
  position: relative;
  cursor: pointer;
  border-radius: 4px;
  background: #fff;
  -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.01),
    0 6px 12px 0 rgba(0, 0, 0, 0.06);
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.01), 0 6px 12px 0 rgba(0, 0, 0, 0.06);
  color: #353535;
  overflow: hidden;
  -webkit-transition: transform 0.3s ease-in-out;
  transition: transform 0.3s ease-in-out;
}
.course-list__item:hover {
  -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.06),
    0 20px 40px 0 rgba(0, 0, 0, 0.06);
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.06), 0 20px 40px 0 rgba(0, 0, 0, 0.06);
  -webkit-transform: translate3d(0, -2px, 0);
  transform: translate3d(0, -2px, 0);
}
.course-list__item .ks-image {
  height: 160px;
}
.course-list__item-shadow {
  position: absolute;
  z-index: 9;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 32px;
  line-height: 32px;
  background: -webkit-gradient(
    linear,
    left top,
    left bottom,
    from(transparent),
    to(rgba(0, 0, 0, 0.5))
  );
  background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.5));
}
.course-list__item-tag {
  float: right;
  height: 18px;
  line-height: 16px;
  padding: 0 5px;
  font-size: 12px;
  margin: 7px 12px 0 0;
  text-align: center;
  color: #fff;
  border: 1px solid #fff;
  border-radius: 2px;
}
.course-list__item-footer {
  padding: 15px;
  overflow: hidden;
}
.course-list__item-title {
  height: 44px;
  line-height: 22px;
  font-size: 14px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
.course-list__item-title--sp {
  height: 22px;
  -webkit-line-clamp: 1;
}
.course-list__item-desc {
  height: 22px;
  line-height: 22px;
  font-size: 12px;
  overflow: hidden;
  text-overflow: ellipsis;
  color: #b2b2b2;
  white-space: nowrap;
}
.course-list__item-learn {
  line-height: 18px;
  color: #999;
  margin-top: 12px;
  font-size: 12px;
}
.course-list__item-price {
  font-size: 14px;
  margin-top: 20px;
  color: #555;
  height: 36px;
  line-height: 36px;
  overflow: hidden;
}
.course-list__item-price--bold {
  font-weight: bold;
}
.course-list__item-price span {
  margin-left: 15px;
  text-decoration: line-through;
  font-weight: normal;
  color: #999;
  font-size: 12px;
}
.el-button--primary {
  background-color: #ff6c00;
  border-color: #ff6c00;
  float: right;
}
.share {
  position: fixed;
  text-align: center;
  top: 65%;
  right: 11%;
  box-shadow: 0px 2px 6px 0px rgba(0, 67, 184, 0.1);
  background-color: #fff;
}
.share li {
  width: 60px;
  height: 60px;
  box-shadow: 0px 2px 2px 0px rgba(0, 67, 184, 0.1);
}
.share li img {
  padding: 8px 17px 5px;
}
.share li {
  cursor: pointer;
}
.goshop {
  position: relative;
}
.goshop-num {
  position: absolute;
  top: 2px;
  right: 4px;
  background-color: #ec4a46;
  padding: 2px 5px;
  border-radius: 8px;
  color: #fff;
  text-align: center;
}
.kd-head__search {
  width: 250px;
  border-radius: 22px;
  background: #fafafa;
  /* float: left; */
}
.kd-head__search input {
  border: none;
  outline: none;
  background: #fafafa;
  margin-left: 15px;
  height: 44px;
  width: 200px;
  line-height: 44px;
  padding-bottom: 8px;
}
.kd-head__search input::placeholder {
  font-size: 14px;
  color: #a1a4a6;
}
.kd-head__search img {
  width: 20px;
  height: 20px;
  margin-right: 15px;
  float: right;
  margin-top: 6px;
}
.search-li {
  border: none !important;
}
body {
  width: 100% !important;
}
.banner img {
  width: 100%;
}
</style>
