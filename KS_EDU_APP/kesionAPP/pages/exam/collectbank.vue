<template>
    <view class="collect-bank">
        <view class="collect-bank-box">
        
          <!-- 间距 -->
          <view class="margin20"></view>
          <!-- 中部收藏数量显示 -->
          <view class="collect-bank-box__item">
            <image :src="baseUrl+'/static/images/exam/record.png'" />
            <view class="collect-bank-box__itemp">
              <text>{{ allData.collect_num }}</text>题
            </view>
          </view>
          <!-- 间距 -->
          <view class="margin20"></view>
          <!-- 底部内容显示 -->
          <view class="collect-bank-box__bottom">
            <view class="collect-bank-box__bottom-text">
              今日收藏： {{ allData.today_collect }}
            </view>
            <button
              style="height:32px;line-height:32px"
              type="primary"
              @click="openSort"
              >开始练习</button
            >
          </view>
        </view>
		<uni-popup :show="showSort" :custom="true" ref="sort" type="bottom" @change="close">
			<ks-sort
			  @close-sort="closeSort"
			  :type="type"
			  name="exercise"
			  :categoryid="categoryid"
			></ks-sort>
		</uni-popup>
      </view>
  </template>
  <script>
	  import {UniPopup} from 'components/uni/uni-popup/uni-popup'
	  import {KsSort} from 'components/ks-components/sort/sort'
	  import {CollectTkHome,GetCountCollectTk} from 'api/exam'
    export default {
		components:{
			KsSort,
			UniPopup
		},
      data() {
        return {
          allData: {},
          allDataList: [],
          showSort: false,
          categoryid:  0,
          type: 3,
		  baseUrl:this.$store.state.SRC+"/config/app"
        }
      },
      methods: {
		  close(e){
		  	this.showSort = e.show
		  },
        openSort() {
          this.showSort = true;
        },
        closeSort() {
          this.showSort = false;
        },
   
        collectTkHome() {
            
          CollectTkHome({
            categoryid: this.categoryid
          }).then(res=>{
            if (res.result) {
                this.allData = res.data;
            }
          }),
         GetCountCollectTk({
              categoryid: this.categoryid
            }).then(res=> {
              if (res.result) {
                this.allDataList = res.data;
              }
            });
        }
      },
	  onLoad(query) {
	  	this.categoryid = query.categoryid
	  },
      onShow() {
        
     
        this.$store.ready(state=>{
          if(state.isLogin == 1){
            this.collectTkHome();
          }else{
            uni.navigateTo({
            	url:'/pages/user/login/index'
            })
          }
          
        })
        
      }
  };
  </script>
<style>
.van-icon-arrow-left {
  color: #4d4c4c !important;
}
.collect-bank-box {
  width: 100%;
  min-height: 100vh;
  background: #fff;
}
/* 头部 */
.collect-bank-box__head {
  width: 100%;
  position: relative;
  font-size: 0.875rem;
}
.collect-bank-box__head-title {
  text-align: center;
  line-height: 2.5rem;
}
.collect-bank-box__head-retrun {
  height: 2.5rem;
  line-height: 2.5rem;
  position: absolute;
  top: 0;
  left: 0.625rem;
}
/* 间距 */
.margin20 {
  width: 100%;
  height: 0.3125rem;
  background: #f5f5f5;
}

/* 内容区 */
.collect-bank-box__item {
  padding: 40px 0;
    width: 120px;
    height: 120px;
    margin:0 auto;
    position: relative;
}
.collect-bank-box__item image {
  width: 120px;
    height: 120px;
    position: absolute;
    top:40px;
    left: 0;
}
.collect-bank-box__itemp {
  /* font-weight: bold; */
  width: 120px;
  height: 120px;
  position: absolute;
  top: 40px;
  left: 0;
  font-size: 16px;
  color: #fff;
  line-height: 120px;
  text-align: center;
}
.collect-bank-box__itemp text {
  font-size: 40px;
}
/* 查看收藏按钮 */
.collect-ban .seeBtn {
  width: 6rem;
  height: 1.7rem;
  color: #fff;
  font-size: 18px;
  background: #2987EE;
  border-radius: 0.75rem;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  top: 9.3rem;
  left: 50%;
  margin-left: -3rem;
  font-weight: bold;
  letter-spacing: 2px;
}
/* 底部内容显示 */
.collect-bank-box__bottom {
  margin-top: 1rem;
  color: #333;
  /* font-weight: bold; */
  width: 90%;
  margin: 1.5rem auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.collect-bank-box__bottom-text {
  flex: 1;
  font-size: 14px;
  /* font-family: PingFang-SC-Medium; */
  font-weight: 500;
  color: rgba(51, 51, 51, 1);
}
.collect-bank-box__bottom-btn {
  width: 116px;
  height: 34px;
  line-height: 34px;
  border-radius: 34px;
  border: 1px solid #2987EE;
  background: #2987EE;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 15px;
  /* font-family: PingFang-SC-Bold;
  font-weight: bold;
  color: rgba(51, 51, 51, 1); */
}
  </style>
  