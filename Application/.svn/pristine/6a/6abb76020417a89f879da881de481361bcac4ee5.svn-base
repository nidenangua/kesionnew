<template>
  <div>
    <ks-container>
      <!-- 课程选择导航 -->
      <div class="course-nav" v-if="$route.name === 'CourseList'">
        
        <div class="course-nav__relations" v-if="categoryList.length">
          <span>
            <a
              @click="filterList({categoryid:0})">
              全部
            </a>
          </span>
          <span v-for="(site,c) in categoryRelations"
            :key="c">
            <i class="el-icon-arrow-right"></i> 
            {{site.categoryname}}
          </span>
        </div>
        <div class="course-nav__category" v-if="categoryList.length">
            <div class="course-nav__title">
              学习方向
            </div>
            <span
            :class="{active:currentCategoryid==category.categoryid || currentTopCategoryid == category.categoryid}"
            v-for="(category,c) in categoryList"
            :key="c"
            @click="filterList({categoryid:category.categoryid})"
          >{{category.categoryname}}</span>
        </div>
        <div
          class="course-nav__category"
          v-if="childList && childList.length"
        >
          <span
            :class="{active2:currentCategoryid == child.categoryid}"
            v-for="(child,c) in childList"
            :key="c"
            @click="filterList({categoryid:child.categoryid})"
          >{{child.categoryname}}</span>
        </div>
        
        <div class="course-nav__category" style="margin-top:10px;">
            <div class="course-nav__title">
              类型
            </div>
            <span :class="{active:courseType == item.courseType}" v-for="item in courseTypes" :key="item.courseType" @click="filterList({coursetype:item.courseType})">
              {{item.name}}
            </span>
        </div>
      </div>
    </ks-container>
    <ks-container
       class="course-list"
      :title="($route.name === 'CourseList' && '全部课程') || ($route.name === 'ColumnList' && '专栏列表')"
      v-if="loaded"
    >
      <div class="course-list__order" slot="title-right" v-if="$route.name === 'CourseList'">
          <ul>
            <li :class="order == 1 && 'active'" @click="filterList({order:1})">最新</li>
            <li :class="order == 2 && 'active'" @click="filterList({order:2})">热门</li>
          </ul>
      </div>
      <el-row :gutter="30">
        <el-col v-for="(item,e) in list" :key="e" :span="6">
          <div class="course-list__item" @click="open(item.courseid || item.columnid)">
            <ks-image :src="item.defaultpic">
              <div
                class="course-list__item-shadow"
                v-if="$route.name === 'CourseList'"
              >
                <span
                  v-if="item.courseType == 2"
                  class="course-list__item-tag"
                >{{item.livetype | handleLiveType}}</span>
                <span
                  class="course-list__item-tag"
                  v-else
                >{{(item.courseType == 1 && '视频') || (item.courseType == 3 && '音频') || (item.courseType == 4 && '图文') || (item.courseType == 6 && '活动')}}</span>
              </div>
              <div class="course-list__item-shadow" v-else-if="$route.name === 'ColumnList'">
                <span class="course-list__item-tag">专栏</span>
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
              <div class="course-list__item-learn" v-else>{{item.soldnum}} 人学过</div>
              <div
                class="course-list__item-price"
                :class="item.chargetype == 1 && 'course-list__item-price--bold'"
              >{{item.price}}<span v-if="Number(item.price_market) > 0 && item.chargetype == 1">¥{{item.price_market}}</span></div>
            </div>
          </div>
        </el-col>
      </el-row>
      <div align="center">
        <el-pagination
          background
          layout="prev, pager, next"
          :current-page.sync="params.p"
          :page-count="pageCount"
          @current-change="getList"
          v-if="pageCount>0"
        />
        <ks-empty msg="该分类暂无课程" v-else />
      </div>
    </ks-container>
  </div>
</template>

<script>
import { cloneData } from "@/utils";
import { getStoreData, getStoreInfo } from "@/api/store";
import { courseCategory } from "@/api/course";
export default {
  name: "CourseList",
  filters:{
    handleLiveType(type = 0){
      let typeName = "直播";
      switch(Number(type)){
        case 1:
          typeName = "一对一"
          break
        case 2:
          typeName = "小班课"
          break
        case 3:
          typeName = "千人直播"
          break
        case 4:
          typeName = "语音直播"
          break
      }
      return typeName
    }
  },
  data() {
    return {
      /**数据加载状态 */
      loaded: false,
      /**数据总页数 */
      pageCount: null,
      /**请求列表数据的一些参数 */
      params: {
        act: "appCourse",
        callKeyName: "courseList",
        p: 1,
        maxperpage: 12
      },
      /**当前选择的一级分类id */
      currentTopCategoryid:'0',
      /**当前选择的分类id */
      currentCategoryid:'0',
      /**排序 */
      order:'1',
      /**数据列表 */
      list: [],
      /**分类联动关系 */
      categoryRelations: [],
      /**分类数据列表 */
      categoryList: [],
      childList: [],
      courseType:'0',
      /**课程类型 */
      courseTypes:[
        {
          courseType:'0',
          name:'不限'
        },
        {
          courseType:'1',
          name:'点播'
        },
        {
          courseType:'2',
          name:'直播'
        },
        {
          courseType:'3',
          name:'音频'
        },
        {
          courseType:'4',
          name:'图文'
        }
      ]
    };
  },
  watch:{
    $route:{
      handler(){
        if(this.$route.name === 'CourseList' || this.$route.name === 'LiveList' || this.$route.name === 'ColumnList'){
          this.setCategoryRelation();
        }
      },
      deep:true
    }
  },
  activated() {
    this.getCourseCategory().then(()=>{
      this.setCategoryRelation();
    })
  },
  methods: {
    /**
     * 根据当前路由的分类id，设置分类联动关系
     */
    setCategoryRelation(){
      let categoryid = this.$route.query.categoryid || '0';
      this.order = this.$route.query.order || '1';
      this.courseType = this.$route.query.courseType || this.$route.query.coursetype || '0';
      this.currentTopCategoryid = null;
      this.currentCategoryid = categoryid;
      this.categoryRelations = [];
      if(`${categoryid}` === '0'){
        this.childList = [];
        this.getList();
        return
      }
      this.getCurCategoryRelation(
        categoryid,
        this.categoryList,
        "[]",
        arr => {
          arr.map((item, i) => {
            if(i === 0){
              this.categoryRelations.push(item);
              this.currentTopCategoryid = item.categoryid;
              if(item.child){
                this.childList = item.child
              }else{
                this.childList = []
              }
            }
          });
          this.getList();
        }
      );
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
    /**
     * 获取数据列表
     */
    getList(p = 1) {
      this.loaded = false;
      this.params.p = p;
      let keyword = this.$route.query.key || "";
      if (this.$route.name === "CourseList") {
        this.params.act = "appCourse";
        this.params.data = {
          sql_or_like: {
            title: keyword
          }
        };
        if(this.courseType == 0){
          this.params.data.courseType = [1,2,3,4];
        }else if(this.courseType == 2){
          this.params.data.courseType = 2;
        }else{
          this.params.data.courseType = this.courseType;
        }
        if(this.$route.query.order == 2){
          this.params.data.sql_order = {
            studentcount:'desc'
          }
        }
      } else if (this.$route.name === "ColumnList") {
        this.params.act = "appColumn";
        this.params.data = {
          sql_or_like: {
            title: keyword
          }
        };
        if(this.$route.query.order == 2){
          this.params.data.sql_order = {
            studentcount:'desc'
          }
        }
      }

      let query = this.$route.query;
      if (query.categoryid) {
        this.params.data.categoryid = query.categoryid;
      } else {
        this.params.data.categoryid = 0;
      }
      this.$showLoading()
      getStoreData([this.params]).then(data => {
        let res = data.courseList;
        this.pageCount = res.page.total_pages;
        this.list = res.list;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    /*
     * 打开课程详情页
     */
    open(id) {
      if (this.$route.name === "CourseList" || this.$route.name === "LiveList") {
        this.$router.push({
          name: "CourseDetail",
          params: {
            id: id
          }
        });
      } else if (this.$route.name === "ColumnList") {
        this.$router.push({
          name: "ColumnDetail",
          params: {
            id: id
          }
        });
      }
    },
    /**
     * 获取课程分类
     */
    getCourseCategory() {
      return new Promise(resolve=>{
        courseCategory({}).then(res => {
          this.categoryList = res;
          resolve(res)
        });
      })
    }
  }
};
</script>

<style scoped>
/**分类筛选部分*/
.course-nav {
  color: #2d3336;
  font-size: 14px;
  background: #fff;
  padding: 20px 20px 10px 20px;
}
.course-nav__relations{
  color:#999;
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
.course-nav__relations{
  padding-left: 10px;
}
.course-nav__relations a{
  cursor: pointer;
}
.course-nav__relations span{
  margin:0 5px;
}
.course-nav__relations span i{
  margin-right: 5px;
}
.course-nav__title{
  position: absolute;
  width: 100px;
  left:15px;
  top: 0;
  color:#999;
}
.course-nav__category{
  padding-left: 100px;
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
  margin:0 15px;
  cursor: pointer;
}

.course-nav__category .active,
.course-nav__category span:hover {
  color: #2e84ee;
}
.course-nav__category .active2,
.course-nav__category .active2:hover{
  background: #2e84ee;
  color:#fff;
  padding: 4px 7px;
  border-radius: 3px;
}

/**课程列表*/
.course-list__order{
  font-size: 14px;
  border-radius: 4px;
  position: relative;
  top:6px;
  overflow: hidden;
}
.course-list__order li{
  height: 30px;
  line-height: 30px;
  float: left;
  padding: 0 15px;
  border:1px solid #ddd;
  cursor: pointer;
  color:#666;
}
.course-list__order .active{
  border:1px solid #2e84ee;
  background: #2e84ee;
  color:#fff;
  position: relative;
}
.course-list .el-col{
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
  height: 22px;
  line-height: 22px;
  overflow: hidden;
}
.course-list__item-price--bold {
  font-weight: bold;
}
.course-list__item-price span{
  margin-left: 15px;
  text-decoration: line-through;
  font-weight: normal;
  color: #999;
  font-size: 12px;
}
</style>
