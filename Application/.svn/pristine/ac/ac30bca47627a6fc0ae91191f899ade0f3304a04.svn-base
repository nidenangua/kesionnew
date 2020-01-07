<template>
  <ks-container class="news-detail" v-if="info">
    <div class="news-detail-pos">
      <span @click="$router.push('/')">首页</span> &gt;
      <span @click="$router.push('/news')">新闻列表</span> &gt; 新闻资讯
    </div>
    <el-row :gutter="20">
      <el-col :span="17">
        <div class="news-detail-left">
          <div class="news-detail-left__top">
            <h2>{{info.title}}</h2>
            <span>{{info.inputer}}</span>
            <span>{{info.adddate}}</span>
            <span v-if="info.allowcomment == 1">{{info.cmtnum}}人评论</span>
            <span>{{info.hits}}人浏览</span>
          </div>
          <div class="news-detail-left__middle ks-content" v-html="info.content"></div>
          <div class="news-detail-left__bottom" v-if="info.allowcomment == 1">
            <comment app-id="101" :info-id="$route.params.id" />
          </div>
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
              <ks-image :src="item.defaultpic" fit="cover"></ks-image>
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
import Comment from "@/pc/components/comment";
import {
  newsDetail
} from "@/api/news";
export default {
  name: "NewsDetail",
  components: {
    Comment
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
  data() {
    return {
      /**新闻内容信息 */
      info: null,
       /**头条推荐 */
      recommendList: [],
      /**热门资讯 */
      hotList: []
    };
  },
  activated() {
    this.getData();
    this.getHotList();
  },
  methods: {
    /*
     * 获取内容详情
     * */
    getData() {
      this.info = null;
      this.$nextTick(() => {
        this.$showLoading();
        newsDetail({
          id: this.$route.params.id
        }).then(res => {
          this.info = res;
          this.$hideLoading();
        });
      });
    },
    /*
     * 获取热门资讯
     * */
    getHotList() {
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
          callKeyName:"hotNews",
          maxperpage: 4,
          data:{
            hot: 1
          }
        }
      ]).then(res=>{
        this.recommendList = res.recommendNews.list;
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
      this.getData();
    }
  }
};
</script>

<style scoped>
.news-detail-pos {
  font-size: 14px;
  color: #929a9e;
  font-weight: 400;
  margin: 30px 0 20px 0;
}
.news-detail-pos span {
  color: #585e61;
  cursor: pointer;
}
.news-detail-left {
  width: 848px;
  float: left;
}
.news-detail-left__top {
  width: 808px;
  text-align: center;
  padding: 26px 20px 19px 20px;
  background: #fff;
  border-bottom: 1px solid #eee;
}
.news-detail-left__top h2 {
  font-size: 20px;
}
.news-detail-left__top span {
  display: inline-block;
  margin: 17px 15px 0 15px;
  font-size: 12px;
  color: #929a9e;
}
.news-detail-left__middle {
  padding: 20px;
  background: #fff;
}
.news-detail-left__bottom {
  padding: 0 10px;
  background: #fff;
  margin-top: 20px;
}
.news-detail-left__bottom h2 {
  color: #2d3336;
  font-size: 16px;
  margin-bottom: 14px;
}
.news-detail-left__btn {
  height: 54px;
  width: 100%;
}
.news-detail-left__btn span {
  width: 100px;
  height: 36px;
  border-radius: 18px;
  border: 1px solid #2e84ee;
  line-height: 36px;
  text-align: center;
  font-size: 14px;
  color: #2e84ee;
  float: right;
  margin-top: 16px;
  cursor: pointer;
}
/* 评论 */
.news-detail-left__comment {
  width: 100%;
  padding-top: 20px;
  border-bottom: 1px solid #eee;
}
.news-detail-left__left {
  width: 80%;
  display: inline-block;
}
.news-detail-left__left p {
  padding: 14px 0 11px 0;
  font-size: 14px;
  color: #929a9e;
}
.news-detail-left__avatar {
  height: 36px;
}
.news-detail-left__avatar span {
  height: 36px;
  line-height: 36px;
  font-size: 14px;
  color: #2d3336;
  float: left;
  margin-left: 10px;
}
.news-detail-left__avatar .ks-image {
  float: left;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  overflow: hidden;
}
.news-detail-left__right {
  display: inline-block;
  width: 19%;
  text-align: right;
}
.news-detail-left__right img {
  float: right;
  cursor: pointer;
  height: 14px;
  height: 14px;
}
.news-detail-left__right span {
  height: 16px;
  float: right;
  font-size: 14px;
  color: #929a9e;

  margin-left: 6px;
}

/*热门推荐*/
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
/*热门资讯*/
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
