<template>
    <view class="error-bank">
        <view class="error-bank-box">
   
          <!-- 间距 -->
          <view class="margin20"></view>
          <!-- 中部错题数量显示 -->
          <view class="error-bank-box__item">
            <image :src="baseUrl+'/static/images/exam/record.png'" />
            <view class="error-bank-box__itemp">
              <text>{{ allData.error_num }}</text>题
            </view>
          </view>
          <!-- 间距 -->
          <view class="margin20"></view>
          <!-- 底部内容显示 -->
          <view class="error-bank-box__bottom">
            <view class="error-bank-box__bottom-text1">
              <view class="margin-top5">今日错题： {{ allData.today_error }}</view>
              <view class="margin-top5">正确率：{{ allData.zhunquelv }}%</view>
            </view>
            <button style="height:32px;line-height:32px;" type="primary" @click="openSort">开始练习</button>
          </view>
        </view>
		 <uni-popup :show="showSort" :custom="true" ref="sort" type="bottom" @change="close">
			<ks-sort
			  @close-sort="closeSort"
			  :type="type"
			  name="exercise"
			  :categoryid="categoryid"
			>
			</ks-sort>
		</uni-popup>
      </view>
  </template>
  <script>
	  import {UniPopup} from 'components/uni/uni-popup/uni-popup'
	  import {KsSort} from 'components/ks-components/sort/sort'
	  import {ErrorTkHome,GetCountErrorTk} from 'api/exam'
    export default {
		components:{
			KsSort,
			UniPopup
		},
        data() {
        return {
          allData: {
			  today_error:0,
			  zhunquelv:0,
			  error_num:0
		  },
          allDataList: [],
          showSort: false,
          categoryid: 0,
          type: 2,
		   baseUrl:this.$store.state.SRC+"/config/app"
        };
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
        errorTkHome() {
          ErrorTkHome({
            categoryid: this.categoryid
          }).then(res=> {
            if (res.result) {
                this.allData = res.data;
            }
          }),
           GetCountErrorTk({
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
            this.errorTkHome();
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

.error-bank .van-icon-arrow-left {
  color: #4d4c4c !important;
}
.error-bank-box {
  width: 100%;
  min-height: 100vh;
  background: #fff;
}
/* 头部 */
.error-bank-box__head {
  width: 100%;
  position: relative;
  font-size: 0.875rem;
}
.error-bank-box__head-title {
  text-align: center;
  line-height: 2.5rem;
}
.error-bank-box__head-retrun {
  height: 2.5rem;
  line-height: 2.5rem;
  position: absolute;
  top: 0;
  left: 0.625rem;
}
/* 间距 */
.error-bank .margin20 {
  width: 100%;
  height: 0.3125rem;
  background: #f5f5f5;
}
/* 内容区 */
.error-bank-box__item {
  padding: 40px 0;
    width: 120px;
    height: 120px;
    margin:0 auto;
    position: relative;
}
.error-bank-box__item image {
  width: 120px;
    height: 120px;
    position: absolute;
    top:40px;
    left: 0;
}
.error-bank-box__itemp {
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
.error-bank-box__itemp text {
  font-size: 40px;
}
/* 查看收藏按钮 */
.error-bank .seeBtn {
  width: 6rem;
  height: 1.7rem;
  color: #fff;
  font-size: 0.9rem;
  background: #fca492;
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
.error-bank-box__bottom {
  margin-top: 1rem;
  width: 90%;
  height: 2rem;
  margin: 1.5rem auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 14px;
  color: rgba(51, 51, 51, 1);
}
.error-bank-box__bottom-text1 {
    flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  font-size: 14px;
  color: rgba(51, 51, 51, 1);
  overflow: hidden;
}
.error-bank-box__bottom-btn {

  font-size: 14px;
  width: 116px;
  height: 34px;
  line-height: 34px;
  border-radius: 34px;
  border: 1px solid #ff795c;
  background: #ff795c;
  display: flex;
  justify-content: center;
  align-items: center;
}
  </style>
  
