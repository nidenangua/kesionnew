<template>
    <view>
    
        
        <view style="display: flex;">
      

			  <scroll-view style="width: 29.17%;height:100vh;"  scroll-y="true">
			  <view style="border-bottom:1px solid #eeeeee; text-align: center;padding: 20px 12px 20px 8px;font-size: 16px;"
			  :style="{background:i==index?'#fff':''}"
                v-for="(item,i) in allClass"
                :key="i" @click="sideBarBack(i)">
				  {{item.categoryname}}
			  </view>

		  </scroll-view>
		  <scroll-view style="width: 70.83%;height:100vh;background:#fff;"  scroll-y="true">
            <view style="margin:0.5rem">
              <button
			  size="mini"
                type="default"
                style="margin-left: 10px;line-height: 32px;height: 32px;font-size: 14px;"
                @click="open(allClass[index].categoryid,allClass[index].categoryname)"
              >全部</button>
              <view v-for="(item,i) in secondList" :key="i">
                <view style="margin:1rem 0;font-size:16px;">{{item.categoryname}}</view>
                <button
                  size="mini"
                    type="default"
                  style="height: 32px;line-height: 32px;font-size: 14px;margin:0 0.2rem 0.5rem 0.5rem"
                  @click="open(item.categoryid,item.categoryname)"
                >全部</button>
                <button
                  size="mini"
                    type="default"
                  style="height: 32px;line-height: 32px;font-size: 14px;margin:0 0.2rem 0.5rem 0.5rem"
                  v-for="(site,s) in item.childs"
                  :key="s"
                  @click="open(site.categoryid,site.categoryname)"
                >{{site.categoryname}}</button>
              </view>
            </view>
          </scroll-view>
        </view>
      </view>
</template>
<script>
	import {GetAllPaperCategory} from 'api/exam'
export default {
data() {
  return {
    showPopup: true,
      active: null,
      classes: "未选择",
      isshow: false,
      allClass: [],
      secondList: [],
	  state:{},
	  index:0
  }
},
onBackPress(){
	
	if (!uni.getStorageSync('classes_' + this.state.userInfo.UserID)) {
	  uni.switchTab({
	      url: '/pages/index/index'
	  });
	}
},
methods: {
    // 选择课程并存储
    open(id, classes) {
    
	 
	  if (id&&classes) {
	            uni.setStorageSync('classes_' + this.state.userInfo.UserID, classes)
	            this.classes = classes;
	            uni.setStorageSync('id_' + this.state.userInfo.UserID,id)
	            this.active = id;
	        
				uni.redirectTo({
					url:'/pages/exam/index?categoryid'+id
				})
	          }else{
	            uni.setStorageSync('classes_' + this.state.userInfo.UserID, '全部')
	            this.classes = '全部';
	            uni.setStorageSync('id_' + this.state.userInfo.UserID,'') 
	            this.active = '';
	            uni.redirectTo({
	            	url:'/pages/exam/index?categoryid'+0
	            })
	          }
    },
    /************** */
    sideBarBack(i) {
		this.index = i
      if (this.allClass[i].childs) {
        this.secondList = this.allClass[i].childs;
      } else {
        this.secondList = [];
      }
   
    }
  },
  onLoad() {
   
	      this.$store.ready(state=> {
	        this.state = state
	        this.active = uni.getStorageSync('id_' + this.state.userInfo.UserID);
	        if (uni.getStorageSync('classes_' + this.state.userInfo.UserID)) {
	          this.classes = uni.getStorageSync('classes_' + this.state.userInfo.UserID);
	        }
	        //请求接口获取一级课程列表
	       GetAllPaperCategory().then(res=> {
	          if (res.result) {
	            this.allClass = res.data;
	            this.secondList = res.data[0].childs;
				uni.setStorageSync('allClass',JSON.stringify(res.data))
	          }
	        });
	      })
  }
};
</script>
<style scoped>
.van-icon-arrow-left {
  color: #4d4c4c !important;
}
.van-sidebar-item {
  background-color: rgb(245, 245, 245);
}
.van-sidebar-item--select {
  background-color: #fff;
  border-color: #fff;
}
</style>

