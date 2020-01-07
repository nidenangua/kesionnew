<template>
  <div class="page" :class="'page--style'+$store.state.style.id">
    <div class="page-header" v-if="$store.state.style.id == 4 || $store.state.style.id == 5" @click="filterType = ''">
      <kd-big-title title="课程" show-search />
    </div>
    <div class="search" v-else @click="filterType = ''">
      <kd-search />
    </div>
    <div class="filter">
      <div class="filter-header ks-row ks-line">
        <div
          class="ks-col-8"
          @click="filterType = filterType === 'sort' ? '' : 'sort'"
          :class="filterType === 'sort' && 'active'"
        >
          {{($route.query.order == 2 && '人气排序') || ($route.query.order == 3 && '价格最低') || ($route.query.order == 4 && '价格最高') || '最新排序'}}
          <i
            class="ks-icon ks-icon-chevron-down"
          ></i>
        </div>
        <div
          class="ks-col-8"
          @click="filterType = filterType === 'classify' ? '' : 'classify'"
          :class="filterType === 'classify' && 'active'"
        >
          {{categoryName}}
          <i class="ks-icon ks-icon-chevron-down"></i>
        </div>
        <div
          class="ks-col-8"
          @click="filterType = filterType === 'types' ? '' : 'types'"
          :class="filterType === 'types' && 'active'"
        >
          筛选
          <i class="ks-icon ks-icon-funnel-outline"></i>
        </div>
      </div>
      <transition name="fade-up">
        <div class="filter-box" v-if="filterType === 'sort'">
          <div class="filter-classify__item" @click="filter({'order':'1'})">最新排序</div>
          <div class="filter-classify__item" @click="filter({'order':'2'})">人气排序</div>
          <div class="filter-classify__item" @click="filter({'order':'3'})">价格最低</div>
          <div class="filter-classify__item" @click="filter({'order':'4'})">价格最高</div>
        </div>
        <div class="filter-box" v-else-if="filterType === 'classify'">
          <div class="filter-classify ks-row">
            <div class="ks-col-8">
              <div
                class="filter-classify__item"
                :class="parentActive == 0 && 'active'"
                @click="setCategory('0')"
              >全部</div>
              <div
                class="filter-classify__item"
                v-for="item in parentCategorys"
                :key="item.categoryid"
                :class="parentActive == item.categoryid && 'active'"
                @click="setCategory(item.categoryid)"
              >{{item.categoryname}}</div>
            </div>
            <div class="ks-col-8">
              <div v-if="childCategorys.length">
                <div
                  class="filter-classify__item"
                  :class="childActive == parentActive && 'active'"
                  @click="setCategory(parentActive,true)"
                >全部</div>
                <div
                  class="filter-classify__item"
                  v-for="item in childCategorys"
                  :key="item.categoryid"
                  :class="childActive == item.categoryid && 'active'"
                  @click="setCategory(item.categoryid)"
                >{{item.categoryname}}</div>
              </div>
            </div>
            <div class="ks-col-8">
              <div v-if="sunCategorys.length">
                <div
                  class="filter-classify__item"
                  :class="sunActive == childActive && 'active'"
                  @click="setCategory(childActive,true)"
                >全部</div>
                <div
                  class="filter-classify__item"
                  v-for="item in sunCategorys"
                  :key="item.categoryid"
                  :class="sunActive == item.categoryid && 'active'"
                  @click="setCategory(item.categoryid)"
                >{{item.categoryname}}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="filter-box" v-else-if="filterType === 'types'">
          <div class="filter-types">
            <div class="filter-types__title">价格区间（元）</div>
             <div class="filter-types__list range">
               <div class="ks-row">
                 <div class="ks-col-11">
                  <ks-input line type="number" v-model="rangemin" ref="sendreply" placeholder="最低价"/>
                 </div>
                 <div class="ks-col-2"><i></i></div>
                 <div class="ks-col-11">
                  <ks-input line type="number" v-model="rangemix" ref="sendreply" placeholder="最高价"/>
                 </div>
               </div>
               <div class="ks-row range">
                <div class="ks-col-8">
                  <span
                    :class="rangeType == 1 && 'active'"
                    @click="rangeType = rangeType == 1 ? -1 : 1;onrange(rangeType)"
                  >0 - 99</span>
                </div>
                <div class="ks-col-8">
                  <span
                    :class="rangeType == 2 && 'active'"
                    @click="rangeType = rangeType == 2 ? -1 : 2;onrange(rangeType)"
                  >100 - 199</span>
                </div>
                <div class="ks-col-8">
                  <span
                    :class="rangeType == 3 && 'active'"
                    @click="rangeType = rangeType == 3 ? -1 : 3;onrange(rangeType)"
                  >200以上</span>
                </div>
               </div>
             </div>
            <div class="filter-types__title">类型</div>
            <div class="filter-types__list">
              <div class="ks-row">
                <div class="ks-col-8">
                  <span
                    :class="courseType == 1 && 'active'"
                    @click="courseType = courseType == 1 ? -1 : 1"
                  >点播课程</span>
                </div>
                <div class="ks-col-8
                ">
                  <span
                    :class="courseType == 2 && 'active'"
                    @click="courseType = courseType == 2 ? -1 : 2"
                  >直播课程</span>
                </div>
                <div class="ks-col-8">
                  <span
                    :class="courseType == 3 && 'active'"
                    @click="courseType = courseType == 3 ? -1 : 3"
                  >音频课程</span>
                </div>
                <div class="ks-col-8">
                  <span
                    :class="courseType == 4 && 'active'"
                    @click="courseType = courseType == 4 ? -1 : 4"
                  >图文课程</span>
                </div>
                <div class="ks-col-8">
                   <span
                    :class="courseType == 5 && 'active'"
                    @click="courseType = courseType == 5 ? -1 : 5"
                  >面授</span>
                </div>
                <div class="ks-col-8">
                  <span
                    :class="courseType == 6 && 'active'"
                    @click="courseType = courseType == 6 ? -1 : 6"
                  >活动</span>
                </div>
              </div>
            </div>
            <div class="filter-types__title">价格</div>
            <div class="filter-types__list ks-line">
              <div class="ks-row">
                <div class="ks-col-8">
                  <span
                    :class="chargeType == 0 && 'active'"
                    @click="chargeType = chargeType == 0 ? -1 : 0"
                  >免费</span>
                </div>
                <div class="ks-col-8">
                  <span
                    :class="chargeType == 1 && 'active'"
                    @click="chargeType = chargeType == 1 ? -1 : 1"
                  >付费</span>
                </div>
              </div>
            </div>
            <div class="filter-types__footer">
              <ks-button
                size="small"
                type="primary"
                class="ks-fr"
                @click="filter({'chargetype':chargeType,'coursetype':courseType,'sql_between':[rangemin,rangemix]})"
              >确定</ks-button>
              <div
                class="ks-fl"
                @click="chargeType = -1;courseType = -1;rangeType = -1;rangemix = '',rangemin=''"
                :class="(chargeType > -1 || courseType > -1) && 'cleartj'"
              >清空筛选</div>
            </div>
          </div>
        </div>
      </transition>
    </div>
    <transition name="fade">
      <div class="ks-masked" v-show="filterType !== ''" @click="filterType = ''"></div>
    </transition>
    <ks-page-scroll-container
      style="padding-top:10px;background:#fff;"
      v-if="list.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getList"
    >
      <kd-course data-type="course" show-price :data-style="$store.state.style.course_list_style" :data-list="list" />
    </ks-page-scroll-container>
    <ks-empty msg="没有找到任何课程~" type="nogift" v-else-if="loaded" />
    <store-footer-bar />
  </div>
</template>

<script>
import { courseCategory } from "@/api/course";
import { cloneData, getTypeName } from "@/utils";
import { getStoreData } from "@/api/store";
let Categorys = [];
export default {
  name: "CourseList",
  data() {
    return {
      sql_between:[],
      rangemin:'',
      rangemix:'',
      /**是否首次加载 */
      isFirstLoad:true,
      loaded: false,
      pageCount: null,
      filterType: "",
      /**价格区间 1价格一，2价格二，3价格三*/
      rangeType:-1,
      /**课程类型 1视频，2直播，3音频，4图文，5面授，6活动，7训练营 */
      courseType: -1,
      /**收费类型 0 免费 1付费 */
      chargeType: -1,
      /**当前页码 */
      p: 1,
      /**当前分类名称 */
      categoryName: "",
      /**父级分类当前选中 */
      parentActive: 0,
      /**父级分类列表 */
      parentCategorys: [],
      /**子级分类当前选中 */
      childActive: 0,
      /**子级分类列表 */
      childCategorys: [],
      /**孙级分类当前选中 */
      sunActive: 0,
      /**孙级分类列表 */
      sunCategorys: [],
      /**数据列表 */
      list: []
    };
  },
  watch: {
    "$route.query": {
      handler() {
        if (this.$route.name === "CourseList") {
          this.getList();
        }
      },
      deep: true
    }
  },
  mounted() {
    courseCategory().then(res => {
      this.parentCategorys = res;
      this.addCategory(res);
      this.setCategory(this.$route.query.categoryid);
      this.getList();
    });
  },
  activated() {
    let name = this.$route.query.name;
    document.title = name || '发现';
    this.courseType = this.$route.query.courseType || this.$route.query.coursetype;
    this.chargeType = this.$route.query.chargetype;
  },
  methods: {
    onrange(rangeType){
       if(rangeType == 1){
        this.rangemin = '0'
        this.rangemix = '99'
      }else if(rangeType == 2){
        this.rangemin = '100'
        this.rangemix = '199'
      }else if(rangeType == 3){
        this.rangemin = '200'
        this.rangemix = ''
      }else{
        this.rangemin = ''
        this.rangemix = ''
      }
    },
    /**
     * 添加一级分类，此方法可以将子、孙级分类与父分类放在同一维数组
     * @param {Array}  分类数组
     * @param {Object} 父亲对象
     * @param {Number} 当前分类等级
     */
    addCategory(arr, obj, level = 0) {
      arr.map(item => {
        if (obj) {
          item.parent = obj;
        }
        item.level = level;
        Categorys.push(item);
        if (item.child && level < 2) {
          this.addCategory(item.child, item, level + 1);
        }
      });
    },
    /**
     * 筛选
     * @param {Object}
     */
    filter(data) {
      let query = cloneData(this.$route.query);
      let keys = Object.keys(data);
      keys.map(key => {
        query[key] = data[key];
      });
      this.$router.push({
        name: this.$route.name,
        query: query
      });
      this.filterType = "";
    },
    /**
     * 设置当前分类关系
     * @param {String} 分类id
     * @param {Boolean} 是否重新加载列表
     */
    setCategory(categoryid = 0, isReloadList) {
      if (categoryid == 0) {
        this.parentActive = 0;
        this.childActive = 0;
        this.childCategorys = [];
        this.sunActive = 0;
        this.sunCategorys = [];
        this.categoryName = "全部课程";
        this.filter({ categoryid: "0" });
      } else {
        Categorys.map(item => {
          if (item.categoryid == categoryid) {
            if (item.level === 0) {
              this.parentActive = item.categoryid;
              this.childActive = item.categoryid;
              this.childCategorys = item.child || [];
              this.sunActive = 0;
              this.sunCategorys = [];
            } else if (item.level === 1) {
              this.parentActive = item.parent.categoryid;
              this.childCategorys = item.parent.child;
              this.childActive = item.categoryid;
              this.sunActive = item.categoryid;
              this.sunCategorys = item.child || [];
            } else if (item.level === 2) {
              this.parentActive = item.parent.parent.categoryid;
              this.childCategorys = item.parent.parent.child;
              this.childActive = item.parent.categoryid;
              this.sunActive = item.categoryid;
              this.sunCategorys = item.parent.child;
            }
            if (!item.child || isReloadList || item.level === 2 || this.isFirstLoad) {
              this.categoryName = item.categoryname;
              this.filter({ categoryid: item.categoryid });
            }
          }
        });
      }
    },
    /**
     * 获取数据列表
     */
    getList(p = 1) {
      this.$showLoading();
      this.p = p;
      let params = {
        act: "appCourse",
        callKeyName: "courseList",
        p: p,
        data: {},
        maxperpage: 10
      };
      let keyword = this.$route.query.key;
      params.data.sql_or_like = {
        title: keyword
      };
      if(this.$route.query.categoryid > 0){
        params.data.categoryid = this.$route.query.categoryid;
      }
      if (this.$route.query.order == 2) {
        params.data.sql_order = {
          studentcount: "desc"
        };
      } else if (this.$route.query.order == 3) {
        params.data.sql_order = {
          price: "asc"
        };
      } else if (this.$route.query.order == 4) {
        params.data.sql_order = {
          price: "desc"
        }
      };
      // 价格区间
      params.data.sql_between = {
        "price":this.$route.query.sql_between
      };
      if (this.$route.query.chargetype >= 0) {
        if(this.$route.query.chargetype == 0){
          params.data.chargetype = [0,2]
        }else{
          params.data.chargetype = this.$route.query.chargetype;
        }
      }
      if (this.$route.query.coursetype > 0 || this.$route.query.courseType > 0) {
        params.data.courseType = this.$route.query.coursetype || this.$route.query.courseType;
      }
      getStoreData([params]).then(data => {
        let res = data.courseList;
        this.pageCount = res.page.total_pages;
        this.list = p == 1 ? res.list : this.list.concat(res.list);
        this.loaded = true;
        this.isFirstLoad = false;
        this.$hideLoading();
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.search {
  background: var(--background-color);
}
.page-header{
  background: #fff;
}
/*筛选栏*/
.page-header,
.filter,
.search {
  position: relative;
  z-index: 100;
}
.filter{
  background: #fff;
}
.filter-header {
  height: 44px;
  line-height: 44px;
  background: #fff;
  text-align: center;
  font-size: 14px;
}
.filter-header .ks-icon {
  font-size: 14px;
}
.filter-header .active {
  color: var(--primary-color);
}
.filter-box {
  position: absolute;
  background: #fff;
  top: 44px;
  left: 0;
  width: 100%;
  z-index: 9;
}

/*分类区域*/
.filter-classify {
  position: relative;
  height: 18rem;
}
.filter-classify [class^="ks-col-"] {
  position: relative;
  height: 100%;
  overflow-x: hidden;
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
}
.filter-classify [class^="ks-col-"]:first-child {
  background: #f3f3f3;
}
.filter-classify [class^="ks-col-"]:nth-child(2) {
  background: #f9f9f9;
}
.filter-classify [class^="ks-col-"]:nth-child(3) {
  background: #fff;
}
.filter-classify__item {
  height: 44px;
  line-height: 44px;
  padding: 0 10px;
  font-size: 14px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

.filter-classify [class^="ks-col-"]:first-child .active {
  background: #e9e9e9;
}
.filter-classify [class^="ks-col-"]:nth-child(2) .active {
  background: #fff;
}

/*筛选类型*/

.filter-types__title {
  height: 24px;
  line-height: 24px;
  padding: 0 15px;
  font-size: 14px;
  color: var(--secondary_text-color);
  margin-top: 20px;
}
.filter-types__list {
  padding: 0 10px 20px 10px;
}
.filter-types__list span {
  margin: 10px 5px 0 5px;
  display: block;
  background: var(--background-color);
  font-size: 14px;
  border-radius: 34px;
  height: 34px;
  line-height: 34px;
  text-align: center;
  border: 1px solid var(--background-color);
}
.filter-types__list .active {
  background: #fff;
  border: 1px solid var(--primary-color);
  color: var(--primary-color);
}
.filter-types__footer {
  height: 32px;
  line-height: 32px;
  padding: 10px 15px;
}
.filter-types__footer .ks-fl {
  font-size: 14px;
  color: var(--auxiliary_text-color);
}
.filter-types__footer .cleartj {
  color: var(--auxiliary_text-color);
}
//价格区间
.range{
  padding-top:20px; 
}
.range /deep/ .ks-input--line{
    border-radius: 35px;
    background:var(--background-color);
    text-align: center; 
    width: calc(100% - 20px);
    padding-left: 0px;
}
.range i{
  width: 1rem;
  height: 2px;
  background: var(--auxiliary_text-color);
  margin: 16px auto;
  display: block;
}
.range .filter-types__list span{
  margin-top:20px; 
}

/**风格区分 */
.page--style4,
.page--style5{
  .filter-header{
    margin: 0 15px;
    border-radius: 5px;
    box-shadow:0px 2px 8px 0px rgba(60,76,139,0.08);
    position: relative;
    z-index: 10;
  }
  .filter-header::after{
    display: none;
  }
  .filter-box{
    border-radius: 0 0 8px 8px;
    overflow: hidden;
  }
} 

</style>