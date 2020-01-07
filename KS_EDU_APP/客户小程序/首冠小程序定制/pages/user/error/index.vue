<template>
  
  <view>
  	<ks-tabs :value.sync="index" :tabList="tabs" @change="changeTabs" style="border-bottom: 1px solid #eee;position: fixed;top: 0;width: 100%;z-index: 100;"></ks-tabs>
  	
  	<view style="margin-top: 44px;z-index: 10;">
  		<view class="card-list" v-if="index == 0">
  			
  			<view class="error-item" v-for="(item,i) in list" :key="i">
  			  <view v-html="item.tk_content"></view>
  			  <view class="error-date">
  			    {{ item.adddate }}
  			    <view class="error-dot"></view>
  			  </view>
  			  <view class="error-box">
  			    <view class="error-title">
  			      {{ item.correction_content }}
  			    </view>
  			    <view style="overflow: hidden;margin-top: 10px;">
  			      <view
  			        class="error-status"
  			        :style="{color: item.status_name == '已纠正' ? 'rgb(49, 118, 16)' : '#ff4444',borderColor:item.status_name == '已纠正' ? 'rgb(49, 118, 16)' : '#ff4444'}"
  			      >
  			        {{ item.status_name }}
  			      </view>
  			      <view class="error-type">
  			        错误类型：<span>{{ item.errortype_name }}</span>
  			      </view>
  			    </view>
  			  </view>
  			</view>
  			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
  			<ks-empty type="list" v-else>暂无数据</ks-empty>
  		</view>
  		<view class="card-list" v-else-if="index == 1">
  			
  			<view class="error-item" v-for="(item,i) in list" :key="i">
  			  <view v-html="item.tk_content"></view>
  			  <view class="error-date">
  			    {{ item.adddate }}
  			    <view class="error-dot"></view>
  			  </view>
  			  <view class="error-box">
  			    <view class="error-title">
  			      {{ item.correction_content }}
  			    </view>
  			    <view style="overflow: hidden;margin-top: 10px;">
  			      <view
  			        class="error-status"
  			        :style="{color: item.status_name == '已纠正' ? 'rgb(49, 118, 16)' : '#ff4444',borderColor:item.status_name == '已纠正' ? 'rgb(49, 118, 16)' : '#ff4444'}"
  			      >
  			        {{ item.status_name }}
  			      </view>
  			      <view class="error-type">
  			        错误类型：<span>{{ item.errortype_name }}</span>
  			      </view>
  			    </view>
  			  </view>
  			</view>
  			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
  			<ks-empty type="list" v-else>暂无数据</ks-empty>
  		</view>
  		<view  class="card-list" v-else-if="index == 2">
  			<view class="error-item" v-for="(item,i) in list" :key="i">
  			  <view v-html="item.tk_content"></view>
  			  <view class="error-date">
  			    {{ item.adddate }}
  			    <view class="error-dot"></view>
  			  </view>
  			  <view class="error-box">
  			    <view class="error-title">
  			      {{ item.correction_content }}
  			    </view>
  			    <view style="overflow: hidden;margin-top: 10px;">
  			      <view
  			        class="error-status"
  			        :style="{color: item.status_name == '已纠正' ? 'rgb(49, 118, 16)' : '#ff4444',borderColor:item.status_name == '已纠正' ? 'rgb(49, 118, 16)' : '#ff4444'}"
  			      >
  			        {{ item.status_name }}
  			      </view>
  			      <view class="error-type">
  			        错误类型：<span>{{ item.errortype_name }}</span>
  			      </view>
  			    </view>
  			  </view>
  			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
			<ks-empty type="list" v-else>暂无数据</ks-empty>
  		</view>
  	</view>
  	
  </view>
</template>
<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {GetUserTkCorrectionList} from 'api/user'
  export default {
	  components:{
	  	UniLoadMore
	  },
    data() {
      return {
		  tabs:['所有记录','未纠正','已纠正'],
        index: 0,
        list: [],
        page: 1,
        pageCount: 1,
		moreStatus:"",
      };
    },
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
    onLoad() {
      this.getList();
    },
    methods: {
    changeTabs(e){
    	if(e.tab === '购买营销卡'){
    		this.getAllList()
    	}else if(e.tab === '我的营销卡'){
    		this.getList()
    	}
    },
      /*滚动加载*/
      onLoad() {
        this.page += 1;
        this.getList(this.page);
      },
	  /**我的营销卡列表*/
	  getList(p=1){
	  	this.page = p
	  	if(this.page==1){
	  		this.list = []
	  	}
	  	this.moreStatus = 'loading'
	  	GetUserTkCorrectionList({
			showstatus:
			  (this.index == 0 && -1) ||
			  (this.index == 1 && 1) ||
			  (this.index == 2 && 0),
	  		page:this.page,
	  		pagesize:10,
	  	}).then(res=>{
	  		uni.stopPullDownRefresh();
	  		this.pageCount = res.pagecount
	  		if(this.page >= this.pageCount){
	  			this.moreStatus = 'noMore'
	  		}else{
	  			this.moreStatus = 'more'
	  		}
	  		if(res.result){
	  			this.list = this.list.concat(res.data)
	  		}
	  	})		
	  }
     
    }
  };
</script>
<style scoped>
  .van-tab--active {
    color: #ff4444;
  }
  .van-tabs__line {
    height: 2px;
  }
  .van-list {
    margin: 0 0.75rem 0 0.75rem;
  }
  .error-item {
    padding: 1rem 0 1rem 1rem;
    border-left: 1px solid rgb(196, 219, 232);
  }
  .error-date {
    padding: 0.5rem 0;
    color: #787c82;
    font-size: 0.7rem;
    position: relative;
  }
  .error-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgb(196, 219, 232);
    position: absolute;
    left: -24.5px;
    top: 50%;
    margin-top: -4px;
  }
  .error-box {
    background: #fff;
    border-radius: 4px;
    padding: 0.5rem 0.5rem 0.75rem 0.5rem;
  }
  .error-status {
    border: 1px solid rgb(49, 118, 16);
    width: 45px;
    text-align: center;
    height: 15px;
    line-height: 17px;
    font-size: 12px;
    border-radius: 2px;
    float: left;
  }
  .error-type {
    float: right;
  }
  .error-type span {
    color: #787c82;
  }
</style>

