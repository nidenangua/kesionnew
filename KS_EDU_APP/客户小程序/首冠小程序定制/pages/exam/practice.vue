<template>
  <view class="contianer" v-if="readyStatus">
    <!-- 顶部导航 -->
		<view class="top-nav" style="font-weight: 400;" v-if="state.version!='saas' && (chaper||knowledge)">
			  <ks-tabs :value.sync="activeNav" :tabList="tabs" @change="changeTabs"></ks-tabs>
		    <view v-if="activeNav==0">
		      <!-- 章节分类列表 -->
		      <view class="exam-box" v-if="showList">
		        <!-- 章 -->
		        <view class="chaptersBox">
		          <view class="chaptersList" v-for="(item,i) in allData" :key="i" :class="{activeChapter:activeChapter==i}"
		            @click="getSectionsList(i)">
		            <!-- <p>{{item.sectionid}}</p> -->
		            <view class="chaptersList-title">第{{i+1}}章</view>
		            <text>{{item.name}}</text>
		          </view>
		        </view>
		        <!-- 节 -->
		        <view class="sectionsBox">
		          <!-- 节 -->
		          <view class="sectionsList" v-for="(child,n) in childData" :key="n">
		            <view class="sectionsList-title" @click="openSort(child.sectionid,categoryid)">{{child.name}}</view>
		            <view v-for="(subChild,m) in child.childs" :key="m">
		              <view class="sectionsList-text" @click="openSort(subChild.sectionid,categoryid)">
		                <view>{{subChild.name}}</view>
		                <view>
		                  <text>{{subChild.do_num}}</text>
		                  /{{subChild.tk_num}}
		                </view>
		              </view>
		            </view>
		          </view>
		        </view>
		      </view>
		      <!-- 无数据提示 -->
			  <ks-empty type="list"  v-if="showNodata">暂无数据</ks-empty>
			</view>
	
			<view v-else>
			
				<view class="examRecord-item" v-if="knowledgeDate.length>0">
				  <view class="examRecord-box" v-for="(item,i) in knowledgeDate" :key="i">
				    <view class="examRecord-box_top">
				      <view class="examRecord-box_title">
				        <ul>
				          <li>{{item.title}}</li>
				        </ul>
				      </view>
				      <!-- <text>{{item.do_num}}/{{item.tk_num}}</text> -->
				    </view>
				    <view class="examRecord-box_bottom">
				      <view class="examRecord-box_type">
				        <view>{{item.do_num}}/{{item.tk_num}}</view>
				      </view>
				      <view class="examRecord-box_see" @click="openSort2(item.knowledgeid,categoryid)">开始做题</view>
				    </view>
				  </view>
				</view>
				<ks-empty type="list" v-else>暂无数据</ks-empty>
			</view>
		
		  
		</view>
		<view class="sort-box" style="display: flex;" v-else>
		  <navigator  :url="`/pages/exam/exercise?type=1&categoryid=${categoryid}&isrand=0`"  open-type="navigate"><text>顺序练习</text>
		  </navigator>
		  <navigator :url="`/pages/exam/exercise?type=1&categoryid=${categoryid}&isrand=1`"  open-type="navigate"><text>随机练习</text>
		  </navigator>
		</view>
	
    
    <uni-popup :show="popupShow" :custom="true" ref="sort" type="bottom" @change="close">
		<!-- 选择考试顺序 -->
		<ks-sort v-if="showSort" @close-sort="closeSort" :type="4" name="exercise" :sectionid="sectionid"
		  :categoryid="categoryid">
		</ks-sort>
		
		<ks-sort v-if="showSort2" @close-sort="closeSort2" :type="5" name="exercise" :knowledgeid="knowledgeid"
		  :categoryid="categoryid">
		</ks-sort>
	</uni-popup>
    
  </view>
</template>

<script>
	import {UniPopup} from 'components/uni/uni-popup/uni-popup'
	import {KsSort} from 'components/ks-components/sort/sort'
	import {GetPaperKnowledge,GetPaperSection,GetSubjectStatistics} from 'api/exam'
  export default {
	  components:{
		  KsSort,
		  UniPopup
	  },
    data () {
      return {
		tabs:['章节练习','知识点'],
        showList: true,
        showNodata: false,
        // showNodata2: false,
        showSort: false,
        showSort2: false,
        allClass: [],
        active: null,
        classes: "未选择", //课程名称
        activeNav: 0, //当前选中导航
        activeChapter: 0, //当前选中章
        childData: [],
        allData: [],
        knowledgeDate: [],
        sectionid: 0,
        knowledgeid: 0,
        categoryid: 0,
        chaper: false,
        knowledge: false,
        state:{},
		popupShow:false,
		readyStatus:false
      };
    },
    methods: {
		changeTabs(e){
			if(e.tab === '章节练习'){
				if(this.chaper){
					this.getPaperSection()
				}else{
					uni.showToast({
						title:'未开启章节练习'
					})
					this.activeNav = 1
				}	
			}else if(e.tab === '知识点' && this.knowledge){
				if(this.knowledge){
					this.getKnowledgeDate()
				}else{
					uni.showToast({
						title:'未开启知识点'
					})
					this.activeNav = 0
				}
			}
		},
      openSort (sectionid, categoryid) {
		  this.sectionid = sectionid;
		  this.categoryid = categoryid;
        this.showSort = true;
        this.popupShow = true
      },
      openSort2 (knowledgeid, categoryid) {
		  this.knowledgeid = knowledgeid;
		  this.categoryid = categoryid;
        this.showSort2 = true;
        this.popupShow = true
      },
		close(e){
			this.popupShow = e.show
		},
      closeSort () {
        this.showSort = false;
		this.popupShow = false
      },
      closeSort2 () {
        this.showSort2 = false;
		this.popupShow = false
      },
      //获取节列表
      getSectionsList (index) {
        if (this.allData && this.allData.length) {
          this.childData = this.allData[index].childs;
          this.activeChapter = index;
        }
      },
 
      newClass (classes) {
        this.classes = classes;
      },

      getKnowledgeDate () {

        GetPaperKnowledge({
          categoryid: this.categoryid
        }).then(res=> {
          if (res.result == true) {
            this.knowledgeDate = res.data;
          } else {
            this.knowledgeDate = [];
          }
        });
      },
      getPaperSection () {
   
        GetPaperSection({
          sectionid: 0,
          categoryid: this.categoryid
        }).then(res=> {
          if (res.result == true) {
            this.showList = true;
            this.showNodata = false;
            this.allData = res.data;
            if (this.allData && this.allData.length) {
              this.childData = this.allData[0].childs;
              this.activeChapter = 0;
            }
          } else {
            this.showList = false;
            this.showNodata = true;
          }
        });
      },
      /*获取模块数据 **/
      getSubjectStatistics () {
   
        GetSubjectStatistics({
          categoryid: this.categoryid
        }).then(res=> {
          for (var i in res.module) {
            if (res.module[i].module_id == "0") {
              this.chaper = res.module[i].isopen_chaper==1?true:false;
              this.knowledge = res.module[i].isopen_knowledge==1?true:false;
				this.readyStatus = true
				 
              if (this.knowledge) {
                this.getKnowledgeDate();
              }
              if (this.chaper) {
                this.getSectionsList(0);
                this.getPaperSection();
              }
            }
          }
        });
      }
    },
	onLoad(query) {
		this.categoryid = query.categoryid || 0
	},
    onShow () {
      this.$store.ready(state=> {
        this.state = state
        // 获取章节知识点开关
        if (state.version !== 'saas') {
          this.getSubjectStatistics();
        }else{
			this.readyStatus = true
		}
        if (uni.getStorageSync('classes_' + this.state.userInfo.UserID)) {
          this.classes = uni.getStorageSync('classes_' + this.state.userInfo.UserID);
        } else {
          this.showPopup = true;
        }
        this.active = uni.getStorageSync('id_' + this.state.userInfo.UserID); //显示当前样式
      })

    }
  };
</script>

<style scoped>
  .van-tab,
  .van-tag--large {
    font-size: 16px;
  }

  .van-icon-arrow-left {
    color: #4d4c4c !important;
  }
	.uni-popup__wrapper{
		border-radius: 20px;
	}
  .contianer {
    width: 100%;
    min-height: 100vh;
    /* background: #f5f4f9; */
  }

  /* 顶部导航 */
  .top-nav {
    font-weight: bold;
  }

  .navtitle img {
    width: 10px;
    height: 10px;
    margin-left: 5px;
  }

  /* 章节分类列表 */
  .exam-box {
    width: 100%;
    min-height: 89vh;
  }

  /* 章 */
  .chaptersBox {
    width: 33%;
    min-height: 89vh;
    float: left;
  }

  .chaptersList {
    width: 100%;
    height: 70px;
    text-align: center;
    border-bottom: 1px solid #ebedef;
  }

  .chaptersList-title {
    color: #333;
    font-size: 11px;
    font-family: PingFang-SC-Bold;
    font-weight: bold;
    padding-top: 12px;
  }

  .chaptersList text {
    display: inline-block;
    margin-top: 10px;
    color: #999;
    /* font-size: 10px;
  font-family: PingFang-SC-Regular; */
    font-weight: 400;
	font-size: 12px;
  }

  .activeChapter {
    background: #fff;
  }

  /* 节 */
  .sectionsBox {
    width: 67%;
    min-height: 89vh;
    background: #fff;
    float: right;
  }

  .sectionsList {
    width: 90%;
    padding: 0 5%;
    float: right;
    background: #fff;
  }

  .sectionsList-title {
    width: 100%;
    height: 40px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ebedef;
    /* color: #333; */
    font-size: 14px;
    /* font-family: PingFang-SC-Medium; */
    font-weight: 500;
  }

  .sectionsList-text {
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ebedef;
    color: #999;
    font-size: 11px;
    font-family: PingFangSC-Regular;
    font-weight: 400;
    display: flex;
    justify-content: space-between;
  }

  .sectionsList-text text {
    color: #ff663d;
  }

  .examRecord-item {
    width: 90%;
    margin: 0 auto;
    padding: 13px 5% 0 5%;
    background: #fff;
  }

  .examRecord-box {
    margin-bottom: 13px;
    border-bottom: 1px solid #ebedef;
  }

  .examRecord-box_top {
    display: flex;
    justify-content: space-between;
    margin-top: 3px;
  }

  .examRecord-box_top text {
    font-size: 14px;
    color: #ff795c;
  }

  .examRecord-box_title {
    width: 75%;
    font-size: 14px;
    color: #333;
    float: left;
  }

  .examRecord-box_title ul li {
    list-style: disc inside none;
  }

  .examRecord-box_top text {
    width: 25%;
    float: right;
    text-align: right;
  }

  .examRecord-box_bottom {
    margin-top: 6px;
    width: 100%;
    height: 32px;
    display: flex;
    justify-content: space-between;
  }

  .examRecord-box_type {
    width: 75%;
    font-size: 10px;
    font-family: PingFangSC-Light;
    font-weight: 300;
    color: #999;
    display: flex;
    justify-content: space-between;
  }

  .examRecord-box_see {
    font-size: 12px;
    color: #fff;
    width: 65px;
    height: 20px;
    border-radius: 10px;
    background: #ff663d;
    text-align: center;
    line-height: 20px;
  }

  .sort-box {
    text-align: center;
  }

  .sort-box text {
    display: inline-block;
    width: 120px;
    height: 40px;
    background: #fb6e52;
    border-radius: 4px;
    font-size: 16px;
    color: rgba(255, 255, 255, 1);
    line-height: 40px;
    text-align: center;
    margin: 45px 30px 0 30px;
  }
</style>
