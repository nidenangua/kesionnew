<template>
  <ks-container class="news clearfix">
    <el-row :gutter="20">
      <el-col :span="17">
        <el-carousel height="360px" indicator-position="none" :interval="4000" v-if="slideList.length">
          <el-carousel-item v-for="item in slideList" :key="item.id">
            <ks-image class="news-banner" :src="item.defaultpic"  @click="open(item.id)">
              <div class="news-banner__title">{{item.title}}</div>
            </ks-image>
          </el-carousel-item>
        </el-carousel>

        <div class="news-nav">
          <span :class="{active:active==0}" @click="active = 0;getList()">全部</span>
          <span
            :class="{active:active==category.categoryid}"
            v-for="(category,m) in newsCategoryList"
            :key="m"
            @click="active = category.categoryid;getList()"
          >{{category.categoryname}}</span>
        </div>
        <div class="news-list"  @click="open(item.id)" v-for="(item,i) in list" :key="i">
          <div class="news-list__image">
            <ks-image :src="item.defaultpic" />
          </div>
          <div class="news-list__content">
            <h2>{{item.title}}</h2>
            <p>{{item.abstract | filterHtml}}</p>
            <div class="news-list__bottom">
              
              <span v-if="item.categoryname"><img src="../../assets/news/news_icon_tag.png" />{{item.categoryname}}</span>
              
              <span><img src="../../assets/news/news_icon_eye.png" /> {{item.hits}} 浏览</span>
              <i>{{item.adddate}}</i>
            </div>
          </div>
        </div>

        <div align="center">
          <el-pagination
            background
            layout="prev, pager, next"
            :current-page="params.p"
            :page-count="pageCount"
            @current-change="getList"
            v-if="pageCount>0"
          />
          <ks-empty msg="暂无新闻数据" v-else />
        </div>
      </el-col>
      <el-col :span="7">
        <ks-card class="news-recommend" title="头条推荐">
          <div
            class="news-recommend__item"
            :class="n === 0 && 'news-recommend__item--first'"
            v-for="(recommend,n) in recommendList"
            :key="n"
            @click="open(recommend.id)"
          >
            <div v-if="n === 0">
              <ks-image
                :src="recommend.defaultpic"
              />
              <div class="news-recommend__title">{{recommend.title}}</div>
              <div class="news-recommend__desc">{{recommend.abstract | filterHtml}}</div>
            </div>
            <div v-else>
              <div class="news-recommend__title">{{recommend.title}}</div>
              <div class="news-recommend__bottom">
                <span>{{recommend.hits}} 浏览</span>
                <p>{{recommend.adddate}}</p>
              </div>
            </div>
          </div>
        </ks-card>
        <ks-card class="news-hot" title="热门资讯">
          <div
            class="news-hot__item"
            v-for="(item,i) in hotList"
            :key="i"
            @click="open(item.id)"
          >
            <div class="news-hot__image">
              <ks-image :src="item.defaultpic" />
            </div>
            <h3>{{item.title}}</h3>
          </div>
        </ks-card>
      </el-col>
    </el-row>
  </ks-container>
</template>

<script>
import { getStoreData } from '@/api/store'
import { getNews, newsCategory } from "@/api/news";
export default {
  name: "News",
  data() {
    return {
      /**总页数 */
      pageCount: null,
      /**请求接口用到的一些参数 */
      params: {
        p: 1,
        maxperpage: 10,
        data: {}
      },
      /**当前选中的新闻分类 */
      active: 0,
      /**新闻数据列表 */
      list: [],
      /**新闻分类 */
      newsCategoryList: [],
      /**头条推荐 */
      recommendList: [],
      /**轮播图列表 */
      slideList: [],
      /**热门列表 */
      hotList:[]
    };
  },
  filters: {
    /**
     * 过滤html标签
     * @param {String}
     */
    filterHtml(html) {
      if (html) {
        return html.replace(/\<\/?[^>]+\>/g, "");
      } else {
        return "";
      }
    }
  },
  methods: {
    /*
     * 按分类id获取新闻列表
     */
    getList(p = 1) {
      this.params.data.categoryid = this.active;
      this.params.maxperpage = 10;
      this.params.p = p;
      this.$showLoading();
      getNews(this.params).then(res => {
        this.pageCount = res.page.total_pages;
        if (res.list) {
          this.list = res.list;
        }
        this.$hideLoading();
      });
    },
    /*
     * 获取新闻分类
     */
    getNewsCategory() {
      newsCategory().then(res => {
        this.newsCategoryList = res;
      });
    },
    /**
     * 获取头条推荐、幻灯文章
     * @param {String} key recommend | slide
     */
    getRecomOrSlideList(key) {
      getStoreData([
        {
          act:"appNews",
          p: 1,
          maxperpage: 7,
          callKeyName:"recommendNews",
          data:{
            recommend:1
          }
        },
        {
          act:"appNews",
          p: 1,
          maxperpage: 7,
          callKeyName:"slideNews",
          data:{
            slide:1
          }
        },
        {
          act:"appNews",
          p: 1,
          callKeyName:"hotNews",
          maxperpage: 4,
          data:{
            hot: 1
          }
        }
      ]).then(res=>{
        this.recommendList = res.recommendNews.list;
        this.slideList = res.slideNews.list;
        this.hotList = res.hotNews.list;
      })
     
    },
    /*
     * 打开新闻详情页
     */
    open(id) {
      this.$router.push({
        name: "NewsDetail",
        params: {
          id: id
        }
      });
    }
  },
  mounted() {
    this.getList();
    this.getNewsCategory();
    this.getRecomOrSlideList();
  }
};
</script>

<style scoped>
.news-banner {
  height: 360px;
  cursor: pointer;
}
.news-banner__title {
  position: absolute;
  z-index: 9;
  left: 0;
  bottom: 0;
  box-sizing: border-box;
  padding: 0 20px;
  font-size: 16px;
  color: #fff;
  width: 100%;
  padding-top: 20px;
  height: 69px;
  line-height: 49px;
  background: -webkit-gradient(
    linear,
    left top,
    left bottom,
    from(transparent),
    to(rgba(0, 0, 0, 0.6))
  );
  background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.6));
}
.news-nav {
  height: 48px;
  background: #fff;
  line-height: 48px;
  padding-left: 30px;
  margin-top: 20px;
  margin-bottom: 16px;
}
.news-nav span {
  margin-right: 38px;
  color: #585e61;
  font-size: 14px;
  cursor: pointer;
}
.news-nav .active {
  color: #2e84ee !important;
}
.news-list {
  height: 145px;
  margin-bottom: 20px;
  background: #fff;
  cursor: pointer;
}
.news-list__image {
  width: 230px;
  height: 100%;
  float: left;
  overflow: hidden;
}
.news-list__image .ks-image {
  width: 100%;
  height: 100%;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.news-list__image:hover .ks-image {
  transform: scale(1.2);
  -webkit-transform: scale(1.2);
  -o-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -ms-transform: scale(1.2);
}
.news-list__content {
  width: 580px;
  float: left;
  margin-left: 20px;
}
.news-list__content h2 {
  font-size: 16px;
  color: #555;
  font-weight: bold;
  margin-top: 15px;
}
.news-list__content p {
  font-size: 12px;
  color: #929a9e;
  margin-top: 12px;
  line-height: 22px;
  height: 44px;
  overflow: hidden;
  text-overflow: -o-ellipsis-lastline;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
}
.news-list__bottom {
  margin-top: 20px;
}
.news-list__bottom span {
  float: left;
  margin-right: 30px;
  line-height: 16px;
  color: #929a9e;
  font-size: 12px;
}
.news-list__bottom img {
  float: left;
  width: 16px;
  height: 16px;
  margin-right: 6px;
}
.news-list__bottom i {
  font-style: normal;
  float: right;
  color: #929a9e;
  font-size: 12px;
  line-height: 16px;
}
.news-recommend__item {
  padding: 15px 0;
  cursor: pointer;
  position: relative;
}
.news-recommend__item + .news-recommend__item {
  border-top: 1px solid #eee;
}
.news-recommend__item--first {
  padding-left: 115px;
  height: 64px;
}
.news-recommend__item--first .ks-image {
  width: 100px;
  height: 64px;
  position: absolute;
  left: 0;
  top: 15px;
}
.news-recommend__title {
  font-size: 14px;
  line-height: 20px;
  max-height: 40px;
  overflow: hidden;
  text-overflow: -o-ellipsis-lastline;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
}
.news-recommend__bottom {
  color: #929a9e;
  font-size: 12px;
  line-height: 16px;
  margin-top: 12px;
	overflow: hidden;
	height: 16px;
	text-overflow: -o-ellipsis-lastline;
	text-overflow: ellipsis;
	-webkit-line-clamp: 1;
	line-clamp: 1;
}
.news-recommend__bottom span {
  float: left;
}
.news-recommend__bottom p {
  float: right;
}
.news-recommend__desc {
  color: #929a9e;
  font-size: 12px;
  line-height: 20px;
  height: 20px;
  overflow: hidden;
  margin-top: 5px;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.news-hot {
  background: #fff;
}

.news-hot__item {
  margin-top: 20px;
  cursor: pointer;
}
.news-hot__image {
  width: 100%;
  height: 158px;
  overflow: hidden;
}
.news-hot__image .ks-image {
  width: 100%;
  height: 100%;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.news-hot__item:hover .ks-image {
  transform: scale(1.2);
  -webkit-transform: scale(1.2);
  -o-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -ms-transform: scale(1.2);
}
.news-hot__item h3 {
  font-size: 14px;
  color: #2d3336;
  font-weight: 400;
  margin-top: 12px;
}
</style>
