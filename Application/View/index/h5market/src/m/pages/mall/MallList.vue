<template>
  <div>
    <div class="search" @click="filterType = ''">
      <kd-search />
    </div>
    <div class="filter">
      <div class="filter-header ks-row ks-line">
        <div
          class="ks-col-12"
          @click="filterType = filterType === 'sort' ? '' : 'sort'"
          :class="filterType === 'sort' && 'active'"
        >
          {{($route.query.rank == 2 && '销量排序') || ($route.query.rank == 3 && '价格最低') || ($route.query.rank == 4 && '价格最高') || '最新排序'}}
          <i
            class="ks-icon ks-icon-chevron-down"
          ></i>
        </div>
        
        <div
          class="ks-col-12"
          @click="filterType = filterType === 'classify' ? '' : 'classify'"
          :class="filterType === 'classify' && 'active'"
        >
          {{categoryName}}
          <i class="ks-icon ks-icon-chevron-down"></i>
        </div>

      </div>
      <transition name="fade-up">
        <div class="filter-box" v-if="filterType === 'sort'">
          <div class="filter-classify__item" @click="filter({'rank':'1'})">最新排序</div>
          <div class="filter-classify__item" @click="filter({'rank':'2'})">销量排序</div>
          <div class="filter-classify__item" @click="filter({'rank':'3'})">价格最低</div>
          <div class="filter-classify__item" @click="filter({'rank':'4'})">价格最高</div>
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

      </transition>
    </div>
    <transition name="fade">
      <div class="ks-masked" v-show="filterType !== ''" @click="filterType = ''"></div>
    </transition>
    <ks-page-scroll-container
      v-if="list.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getList"
    >
    <div class="ks-row malist">
          <div class="ks-col-12 ks-pr-10 shopdel" v-for="(item,i) in list" :key="i" @click="open(item.courseid)">
              <ks-image style="height: 180px;" :src="item.defaultpic"/>
              <div class="malist-title">{{item.title.substring(0,20)}}<a v-if="item.title.length>20">...</a></div>
              <span class="malist-price">￥{{item.price}}</span><span class="ks-fr malist-people">{{item.studentcount}}人购买</span>
          </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty msg="没有找到任何课程~" type="nogift" v-else-if="loaded" />
    <div class="malist-icon">
            <i class="ks-icon ks-icon-shopping-cart" @click="jumpCart()"></i>
          </div>
  <store-footer/>
  </div>
</template>

<script>
import { cloneData, getTypeName } from "@/utils";
import { mallList,mallCate } from "@/api/mall";
let Categorys = [];
export default {
  name: "MallList",
  data() {
    return {

      loaded: false,
      filterType: "",
      pageCount: null,
      filterType: "",
      p: 1,
      list: [],
      params:'',
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
    };
  },
  watch: {
    "$route.query": {
      handler() {
        this.getList();
      },
      deep: true
    }
  },
  mounted() {
    mallCate().then(res => {
      this.parentCategorys = res;
      this.addCategory(res);
      this.setCategory(this.$route.query.categoryid,true);

    });
  },
  methods: {
    jumpCart(){
        this.$router.push('/cart')
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
        this.categoryName = "选择分类";
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
            if (!item.child || isReloadList || item.level === 2 ) {
              this.categoryName = item.categoryname;
              this.filter({ categoryid: item.categoryid });
            }
          }
        });
      }
    },

    open(id) {
      this.$router.push('/commodity?id='+id)
    },
     /**
     * 搜索
     * @param {String} 搜索关键词
     */
    goSearch(key) {
      this.params = key;
      this.resetParams();
      this.getList();
    },
     /**
     * 重置参数
     */
    resetParams(params) {
      params = params || {};
      this.pageCount = params.pageCount || null;
      this.params.p = params.p || 1;
      this.list = params.list || [];
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
     * 获取数据列表
     */
    getList(p = 1) {
      return new Promise(resolve=>{
        this.$showLoading();
        this.p = p;
        if (p == 1) {
          this.list = [];
        }
        let params = {
          keyword:this.$route.query.key,
          p: p,
          maxperpage: 10,
        };
        if(this.$route.query.categoryid > 0){
          params.categoryid = this.$route.query.categoryid;
        }
        if(this.$route.query.rank > 0){
          params.rank = this.$route.query.rank;
        }
        mallList(params).then(res => {
          this.list = p == 1 ? res.list : this.list.concat(res.list);
          this.pageCount = res.page.total_pages;
          this.loaded = true;
          this.$hideLoading();
          resolve(res)
        });
      })
    },


  },
  activated() {
    document.title = "商品列表";
    this.getList();

  },
};
</script>

<style scoped>
.malist-icon{
    position: fixed;
    clear: both;
    overflow: hidden;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: #fff;
    padding: 6px;
    text-align: center;
    box-shadow: -1px 1px 3px 0 rgb(230, 74, 59);
    bottom: 60px;
    right: 10px;
}
.malist-icon i{
    color: #e64a3b;
    font-size: 20px;
}
.search {
  background: #f5f5f5;
}
/*筛选栏*/
.filter,
.search {
  position: relative;
  z-index: 100;
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
  color: #e64a3b;
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
  color: #666;
  margin-top: 20px;
}
.filter-types__list {
  padding: 0 10px 20px 10px;
}
.filter-types__list span {
  margin: 10px 5px 0 5px;
  display: block;
  background: #f5f5f5;
  font-size: 14px;
  border-radius: 34px;
  height: 34px;
  line-height: 34px;
  text-align: center;
  border: 1px solid #f5f5f5;
}
.filter-types__list .active {
  background: #fff;
  border: 1px solid #e64a3b;
  color: #e64a3b;
}
.filter-types__footer {
  height: 32px;
  line-height: 32px;
  padding: 10px 15px;
}
.filter-types__footer .ks-fl {
  font-size: 14px;
  color: #999;
}
.filter-types__footer .highlight {
  color: #e64a3b;
}
/* 商品列表 */
.malist{
  background-color: #fff;
  padding-top: 10px;
  font-size: 15px;
}
.malist-title{
  font-weight:initial;
  line-height: 22px;
  white-space : nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin: 4px 0;
}
.malist-price{
  color: red;
}
.malist-people{
    color: #999;
    font-size: 12px;
    line-height: 24px;
}
.malist .ks-col-12{
    padding-bottom: 5px;
}
.malist-icon{
    clear: both;
    overflow: hidden;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: #fff;
    padding: 6px;
    text-align: center;
    box-shadow: -1px 1px 3px 0 rgb(230, 74, 59);
    position: fixed;
    bottom: 120px;
    right: 10px;
}
.malist-icon i{
    color: #e64a3b;
    font-size: 20px;
}
.ks-row .ks-col-12:nth-child(2n-1) {
   border-right: .5px solid rgba(0, 0, 0, 0.1);
}
.ks-row .ks-col-12{
  border-bottom: .5px solid rgba(0, 0, 0, 0.1);
}
.shopdel{
  padding-top: 5px;
  padding-left: 10px;
}
 .ks-image{
  padding-left: 10%;
}
/* .ks-row .ks-col-12:nth-child(1),
.ks-row .ks-col-12:nth-child(2){
  border: none;
} */
</style>
