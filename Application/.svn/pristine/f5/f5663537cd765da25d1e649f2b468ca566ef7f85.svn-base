<template>
	<div v-if="loaded">
		<router-link
			:to="{name:'CourseView',params:{id:courseInfo.courseid}}"
			tag="div"
			class="graphic-course"
		>
			<i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
			<ks-create-bg class="graphic-course__img" :src="courseInfo.defaultpic"/>
			<div class="graphic-course-info">
				<div class="graphic-course__title">{{courseInfo.title}}</div>
				<div class="graphic-course__desc">{{courseInfo.shortdesc}}</div>
			</div>
		</router-link>
		<div class="graphic-info ks-mt10">
			<div class="graphic-info__title">{{currentKeshi.title}}</div>
			<div class="ks-content ks-mt20">
				<!--连载图文、免费、已购买显示详细内容-->
				<div v-if="isCanShow && (currentKeshi.freeplay == 1 || isCanLearn || isbuy == 1)">
					<div v-html="currentKeshi.content" ref="content"></div>
				</div>
				<!--未购买-->
				<div v-else>
					<div v-html="currentKeshi.intro" ref="skContent"></div>
					<div class="buy-article-tips line line-top" v-if="!isFree">本内容需要购买之后才能阅读全文</div>
					<div class="buy-article-tips line line-top" v-else>本内容需要加入学习之后才能阅读全文</div>
				</div>
			</div>
		</div>
		<store-footer/>
		<div class="ks-col-5 ks-text-center course-title-box" @click="gift">
			<p class="course-title-tag">免费送好友</p>
			<div class="course-title-box-bg">
				<i class="ks-icon ks-icon-gift-outline"></i>
				<p>送好友</p>
			</div>
		</div>
		<div class="graphic-footer-blank"></div>
		<div class="graphic-footer line line-top">
			<ul>
				<li @click="prev" :class="currentPlayId == firstKeshiId && 'disabled'">
					<i class="ks-icon ks-icon-arrow-back-outline"></i>上一篇
				</li>
				<li @click="catalog">目录</li>
				<li @click="next" :class="currentPlayId == lastKeshiId && 'disabled'">
					下一篇
					<i class="ks-icon ks-icon-arrow-forward-outline"></i>
				</li>
			</ul>
		</div>
		<transition name="slide-in-up">
			<div class="graphic-catalog" v-show="catalogShow">
				<div class="graphic-catalog__title">课程目录</div>
				<course-catalog
					class="graphic-catalog__body"
					:course-type="4"
					:current-play-id="currentPlayId"
					:is-can-learn="isCanLearn"
					:chapter="chapter"
					:chapter-type="chapterType"
          :isbuy="isbuy"
				/>
			</div>
		</transition>
	</div>
</template>
<script>
import { getCourseDetail } from "@/api/course";
import CourseCatalog from "./components/CourseCatalog";
export default {
  name: "GraphicLearn",
  data() {
    return {
      flag:false,
      /**是否购买了课程 */
      isbuy: 0,
      /**是否加入学习 */
      isjoin:'',
      /**
       * 加载状态
       */
      loaded: false,
      /**是否赠好友开启活动 */
      free_id: null,
      /**
       * 是否有学习权限
       */
      isCanLearn: false,
      /**
       * 显示课时目录
       */
      catalogShow: false,
      /**
       * 是否为免费课程
       */
      isFree: false,
      /**
       * 课程信息
       */
      courseInfo: {},
      /**
       * 所有课时列表
       */
      keshiList: [],
      /**
       * 当前课时信息
       */
      currentKeshi: {},
      currentPlayId: this.$route.query.chapterid,
      firstKeshiId: "",
      lastKeshiId: "",
      /**
       * 目录信息
       */
      chapter: [],
      chapterType: null
    };
  },
  computed: {
    /**当类型为图文时 判断图文是否有权限看 */
    isCanShow() {
      if (
        this.courseInfo.courseType == 4 &&
        this.courseInfo.order_json &&
        this.courseInfo.order_json.length > 0
      ) {
        return this.courseInfo.order_json.some(el => {
          return el == this.$route.query.chapterid;
        });
      } else {
        return true;
      }
    }
  },
  watch: {
    "$route.query.chapterid"(chapterid) {
      this.currentPlayId = chapterid;
      this.getCurrentKeshi();
      this.playChange();
    },
    catalogShow() {
      this.flag = this.catalogShow ? true : false
    }
  },
  methods: {
    /**送好友 */
    gift() {
      this.$hideMask();
      let queryObj = {};
      if (this.$route.query.chapterid) {
        queryObj.chapterid = this.$route.query.chapterid;
      }
      if (this.free_id) {
        queryObj.free_id = this.free_id;
      }
      this.$router.push({
        name: "ShowGift",
        params: {
          id: this.$route.params.id
        },
        query: queryObj
      });
    },
    /**
     * 获取当前课时信息
     */
    getCurrentKeshi() {
      this.keshiList.map(item => {
        if (item.chapterid == this.currentPlayId) {
          this.currentKeshi = item;
          this.$nextTick(() => {
            /**
             * 设置图片放大预览
             */
            if (this.$refs.skContent) {
              this.$setPreview(this.$refs.skContent);
            } else if (this.$refs.content) {
              this.$setPreview(this.$refs.content);
            }
          });
        }
      });
    },
    /**
     * 重新构造课程目录
     */
    setChapterData(data) {
      data.map(item => {
        if (item.depth == 1 || item.depth == 2) {
          item.slideShow = true;
        } else if (item.depth == 3) {
          /**
           * 将课时单独抽出
           */
          this.keshiList.push(item);
        }
        if (item.Section) {
          this.setChapterData(item.Section);
        } else if (item.keshi) {
          this.setChapterData(item.keshi);
        }
      });
    },
    /**
     * 触发显示目录
     */
    catalog() {
      if(!this.flag) {
        this.catalogShow = true;
        this.$showMask({
          click: () => {
            this.catalogShow = false;
            this.$hideMask();
          }
        });
      }
    },
    /**
     * 课时切换后，隐藏目录
     */
    playChange() {
      this.catalogShow = false;
      this.$hideMask();
    },
    /**
     * 课时跳转
     */
    keshiRouteJump(_chapterid) {
      this.$router.push({
        name: "GraphicLearn",
        params: {
          id: this.$route.params.id
        },
        query: {
          chapterid: _chapterid
        }
      });
    },
    /**
     * 上一篇
     */
    prev() {
      let index = null;
      this.keshiList.map((item, i) => {
        if (item.chapterid == this.currentPlayId) {
          index = i;
        }
      });
      if (index !== null) {
        let prevKeshi = this.keshiList[index - 1];
        if (prevKeshi) {
          this.keshiRouteJump(prevKeshi.chapterid);
        }
      }
    },
    /**
     * 下一篇
     */
    next() {
      let index = null;
      this.keshiList.map((item, i) => {
        if (item.chapterid == this.currentPlayId) {
          index = i;
        }
      });
      if (index !== null) {
        let nextKeshi = this.keshiList[index + 1];
        if (nextKeshi) {
          this.keshiRouteJump(nextKeshi.chapterid);
        }
      }
    }
  },
  activated() {
    // this.$showLoading();
    /**
     * 获取课程详情
     */

    this.loaded = false;
    let courseId = this.$route.params.id;
    this.currentPlayId = this.$route.query.chapterid;
    getCourseDetail({
      id: courseId
    }).then(res => {
      this.isbuy = res.courseinfo.isbuy
      this.isjoin = res.is_join
      this.free_id = res.free_id ? res.free_id : null;
      let courseInfo = res.courseinfo;
      this.courseInfo = courseInfo;
      /**
       * 开启防复制
       */
      if (courseInfo.iscopy == 1) {
        this.$antiCopy(true);
      }

      let chapterData = res.chapter.chapter;
      this.setChapterData(chapterData);

      /**
       * 获取课时第一条与最后一条的chaperid
       */
      if (this.keshiList.length) {
        this.firstKeshiId = this.keshiList[0].chapterid;
        this.lastKeshiId = this.keshiList[this.keshiList.length - 1].chapterid;
      }
      this.chapter = chapterData;
      this.chapterType = res.chapter.istype;
      if (courseInfo.price == "0.00" || courseInfo.chargetype != 1) {
        this.isFree = true;
      }
      switch (this.isjoin) {
        case undefined:
          this.isCanLearn = false;
          break;
      
        default:
           if (
            courseInfo.price == "0.00" ||
            courseInfo.isbuy == 1 ||
            courseInfo.chargetype != 1
          ) {
            this.isCanLearn = true;
          }
      }
     

      this.loaded = true;

      /**
       * 配置微信分享
       */
      this.$wxShare({
        title: courseInfo.title,
        desc: courseInfo.shortdesc,
        imgUrl: courseInfo.defaultpic
      });

      /**
       * 获取当前课时信息
       */
      this.getCurrentKeshi();

      this.$hideLoading();
    });
  },
  components: {
    CourseCatalog
  }
};
</script>
<style scoped>
.graphic-course {
  padding: 15px;
  background: #fff;
  position: relative;
  min-height: 50px;
}
.graphic-course .graphic-course__img {
  width: 50px;
  height: 50px;
  overflow: hidden;
  line-height: 50px;
  position: absolute;
  left: 15px;
  top: 15px;
}

.graphic-course-info {
  padding: 0 70px 0 65px;
}
.graphic-course__title {
  font-size: 14px;
  font-weight: bold;
  line-height: 24px;
  height: 24px;
  overflow: hidden;
}
.graphic-course__desc {
  color: #999;
  font-size: 12px;
  line-height: 22px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.graphic-course .ks-icon {
  position: absolute;
  right: 10px;
  top: 50%;
  line-height: 20px;
  margin-top: -10px;
  color: #999;
}

.graphic-info {
  background: #fff;
  padding: 20px;
}
.graphic-info__title {
  font-size: 22px;
  font-weight: bold;
}

.graphic-catalog {
  position: fixed;
  bottom: 49px;
  left: 0;
  width: 100%;
  max-width: 480px;

  left: 0;
  right: 0;
  margin: 0 auto;
  z-index: 1000;
  background: #fff;
}
.graphic-catalog__body {
  height: 400px;
  overflow-x: hidden;
  overflow-y: auto;
}
.graphic-catalog__title {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  font-size: 16px;
  padding: 0 15px;
  font-weight: bold;
}
.graphic-footer-blank {
  height: 49px;
  overflow: hidden;
}
.graphic-footer {
  background: #fff;
  height: 49px;
  line-height: 49px;
  background: #fff;
  position: fixed;
  width: 80%;
  z-index: 1000;
  max-width: 480px;
  /* left: 0; */
  right: 0;
  bottom: 0;
  margin: 0 auto;
}
.graphic-footer li {
  width: 33.3%;
  float: left;
  text-align: center;
  font-size: 14px;
  position: relative;
  color: var(--ornament-color);
}
.graphic-footer li:before {
  content: "";
  width: 1px;
  height: 36px;
  position: absolute;
  top: 50%;
  margin-top: -18px;
  left: 0;
  background: #eee;
}
.graphic-footer .disabled {
  color: #999;
  cursor: no-drop;
}
.buy-article-tips {
  text-align: center;
  padding: 75px 0 30px 0;
  font-size: 14px;
  letter-spacing: 1px;
  background: url(../../assets/course/money.png) no-repeat 50% 30px;
  background-size: auto 34px;
  margin-top: 15px;
}
.course-title-box {
  color: #9b9b9b;
  position: fixed;
  bottom: 0;
  left: 0;
  z-index: 999;
}
.course-title-box-bg {
  height: 49px;
  background-color: #fff;
}
.course-title-box .course-title-tag {
  padding: 2px 3px;
  background-color: #e74a3b;
  border-radius: 10px;
  color: #f6fffe;
  position: relative;
  bottom: 5px;
}
.course-title-tag::after {
  content: "";
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-top: 7px solid #e74a3b;
  border-bottom: 7px solid transparent;
  position: absolute;
  left: 50%;
  transform: translate(-50%);
  bottom: -14px;
}
.ks-icon-gift-outline {
  font-size: 28px;
  color: #e74a3b;
}
</style>

