<template>

    <view class="examBank">

      <!-- 头部导航 -->
      <view class="examBank-nav" v-if="typeData.length > 0">
        <text :class="{ active: typeid == 0 }" @click="sidebar(0)">全部试卷</text>
        <text :class="{ active: typeid == site.typeid }" v-for="(site, n) in typeData" :key="n"
          @click="sidebar(site.typeid)">{{ site.typename }}</text>
      </view>
      <!-- 考试题库列表 -->
      <view class="examBank-item">
        <!-- 题库列表 -->
        <view class="examBank-box" v-for="(item, index) in list" :key="index" v-if="list.length>0">
          <view class="examBank-box_top">
            <view class="examBank-box_title">
              {{item.title}}
            </view>
            <view class="examBank-box_score" v-if="item.sumscore == -1">- -</view>
            <view class="examBank-box_score" v-else>{{ item.sumscore }}分</view>
          </view>
          <view class="examBank-box_bottom">
            <view class="examBank-box_difficulty">
              <view>{{ item.studentcount }}人参考</view>
              <view class="difficulty-flex">
                <text>难度</text>
              
				<uni-rate disabled="true" :value="difficulty[index]" size="12" active-color="#ff663d"></uni-rate>
              </view>
            </view>
            
			<navigator class="examBank-box_again" :url="`/pages/exam/paperinfo?paperid=${item.paperid}&categoryid=${item.categoryid}`"  v-if="item.is_repractice != 0"  open-type="navigate"><text>{{
              item.is_repractice == -1
              ? "开始练习"
              : item.is_repractice == 2
              ? "继续练习"
              : "重新练习"
              }}</text>
			</navigator>
          </view>
        </view>
       <uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
		<ks-empty type="list" v-else>暂无数据</ks-empty>
      </view>

    </view>

</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {UniRate} from 'components/uni/uni-rate/uni-rate'
	import {GetAllPaperType,GetPaperList} from 'api/exam'
  export default {
	components:{
		UniRate,
		UniLoadMore
	},
    data () {
      return {
        pageCount: 1,
        page: 0,
        classes: "未选择", //选中课程
        searchText: "", //搜索内容
        value: null,
        size: 9,
        readonly: true,
        list: [], //接口返回数组
        difficulty: [0], //难度星星
        allClass: [],
        active: null,
        id: null,
        typeData: [],
        typeId: 0,
        paperid: 0,
        categoryid: 0,
		moreStatus:"",
      };
    },
	/*下拉刷新*/
	onPullDownRefresh() {
		this.getList()	 
	},
	/*滚动加载*/
	onReachBottom(){
		this.page++
		if(this.page<=this.pageCount){
			this.getList(this.page)	
		}	
	},
    methods: {

      // 跳转考试内容
      getExamList (url) {
        this.$router.push(url);
      },

      open () {
        this.$router.push({
          name: "examselect"
        });
      },
      newClass (classes) {
        this.classes = classes;
      },
      sidebar (id) {
        this.typeId = id;
        this.getList();
      },
	  getList(p=1){
	  	this.page = p
	  	if(this.page==1){
	  		this.list = []
	  	}
	  	this.moreStatus = 'loading'
	  	GetPaperList({
	  		categoryid: this.categoryid,
	  		typeid: this.typeId,
	  		page: p,
	  		pagesize: 15
	  	}).then(res=>{
	  		this.pageCount = res.pagecount
	  		if(this.page >= this.pageCount){
	  			this.moreStatus = 'noMore'
	  		}else{
	  			this.moreStatus = 'more'
	  		}
	  		if(res.result){
	  			this.list = this.list.concat(res.data)
				for (var i in this.list) {
				  //根据难度返回星星颗数
				  this.difficulty.push(
				    (this.list[i].paper_level == 0 && 1) ||
				    (this.list[i].paper_level == 1 && 2) ||
				    (this.list[i].paper_level == 2 && 3)
				  );
				}
	  		}
	  	})		
	  }
     
    },
    onLoad (query) {
		this.categoryid = query.categoryid
      this.$store.ready(state=> {
        // 获取用户课程记录
        if (uni.getStorageSync('classes_'+state.userInfo.UserID)) {
          this.classes = uni.getStorageSync('classes_'+state.userInfo.UserID);
        }
        //获取套卷练习分类名称
        GetAllPaperType().then(res=> {
          if (res.result) {
            this.typeData = res.data;
			
          }
		  this.getList();
        });
     
      })

    },
    onShow () {
      
    }
  };
</script>

<style scoped>
  .van-icon-arrow-left {
    color: #4d4c4c !important;
  }

  .active {
    background: #fca492 !important;
    color: #fff !important;
  }

  .navtitle img {
    width: 10px;
    height: 10px;
    margin-left: 5px;
  }

  .examBank {
    width: 100%;
    min-height: 100vh;
    background: #fff;
  }

  /* 导航 */
  .examBank-nav {
    border-bottom: 1px solid #ebebeb;
    font-size: 14px;
    /* font-family: PingFang-SC-Regular; */
    font-weight: 400;
    background: #f5f5f5;
    width: 90%;
    padding: 0 5% 10px 5%;
  }

  .examBank-nav text {
    margin-right: 10px;
    display: inline-block;
    height: 28px;
    width: 74px;
    font-size: 14px;
    /* font-family: PingFang-SC-Regular;
  font-weight: 400;
  color: #010c17; */
    line-height: 28px;
    text-align: center;
    background: #fff;
    border-radius: 4px;
    border: 1px solid #fca492;
    margin-top: 10px;
  }

  /* 考试题库列表 */
  .examBank-item {
    padding: 0 15px;
    background: #fff;
  }

  .examBank-box {
    padding-top: 13px;
    border-bottom: 1px solid #ebedef;
  }

  .examBank-box_top {
    display: flex;
    justify-content: space-between;
  }

  .examBank-box_bottom {
    margin-top: 6px;
    width: 100%;
    height: 31px;
    display: flex;
    justify-content: space-between;
    font-size: 10px;
    /* font-family: PingFangSC-Light;
  font-weight: 300; */
    color: #999;
  }

  .examBank-box_title {
    width: 75%;
    font-size: 14px;
    /* font-family: PingFang-SC-Medium;
  font-weight: 500; */
    color: #333;
    float: left;
  }

  .examBank-box_title ul li {
    list-style: disc inside none;
  }

  .examBank-box_score {
    /* display: inline-block; */
    width: 25%;
    line-height: 20px;
    float: right;
    text-align: right;
  }

  .examBank-box_difficulty {
    width: 50%;
    font-size: 10px;
    color: #999;
    display: flex;
    flex: 1;
  }

  .examBank-box_again {
    font-size: 12px;
    /* font-family: PingFangSC-Semibold;
  font-weight: 600; */
    color: #fff;
    width: 65px;
    height: 20px;
    border-radius: 10px;
    background: #ff663d;
    text-align: center;
    line-height: 20px;
  }

  .difficulty-flex {
    display: flex;
    margin-left: 20px;
  }

  .difficulty-flex text {
    /* display: inline-block; */
    float: left;
  }

  .uni-rate {
    float: left;
    margin-top: 1px;
  }
</style>