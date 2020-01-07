<template>
	
		
			<view style="padding-bottom: 40px;background: #fff;border-radius: 10px 10px 0px 0px;overflow: hidden;">
				<view class="ks-sort-box__title">
				  <view class="ks-sort__title">选择做题模式</view>
				  <image :src="baseUrl+'/static/images/common/close.png'" @click="close">
				</view>
				<view class="ks-sort-box" style="display: flex;justify-content: center;">
					<text @click="open(0)">顺序练习</text>
					<text @click="open(1)">随机练习</text>
				</view>
			</view>

		
	
</template>

<script>
	
	export default{

		props: ['name', 'type', 'sectionid', 'knowledgeid', 'categoryid', 'paperid', 'title'],
		    data () {
		      return {
				baseUrl:this.$store.state.SRC+"/config/app"
		      };
		    },
		    methods: {
		      close () {
		        this.$emit("close-sort");
		      },
			  open(isrand){
				  var url 
				  if(this.name == 'exercise'){
					  url = `/pages/exam/testpage?type=${this.type}&categoryid=${this.categoryid}&paperid=${this.paperid}&sectionid=${this.sectionid}&knowledgeid=${this.knowledgeid}&isrand=${isrand}&name=${this.name}`
					  
				  }else{
					  url = `/pages/exam/${this.name}?type=${this.type}&categoryid=${this.categoryid}&paperid=${this.paperid}&sectionid=${this.sectionid}&knowledgeid=${this.knowledgeid}&isrand=${isrand}&name=${this.name}`
					 
				  }
				  console.log(url)
				  uni.navigateTo({
				  	url:url
				  }) 
				  
			  }
		    }
	}
</script>

<style scoped>
	
	.ks-sort-popup {
	  width: 100%;
	  height: 178px;
	  border-radius: 10px 10px 0px 0px;
	  background: #fff;
	  position: fixed;
	  bottom: 0;
	  text-align: center;
	}
	.ks-sort-box__title {
	  height: 40px;
	  border-bottom: 1px solid #eee;
	  margin-top: 15px;
	}
	.ks-sort__title {
	  width: 100px;
	  font-size: 16px;
	  color: rgba(26, 26, 26, 1);
	  float: left;
	  padding-left: 50%;
	  margin-left: -50px;
	  text-align: center;
	}
	.ks-sort-box__title image {
	  width: 16px;
	  height: 16px;
	  margin-right: 20px;
	  float: right;
	  margin-top: 2.5px;
	}
	.ks-sort-box text {
	  display: inline-block;
	  width: 120px;
	  height: 40px;
	  background: #ff663d;
	  border-radius: 4px;
	  font-size: 16px;
	  color: rgba(255, 255, 255, 1);
	  line-height: 40px;
	  text-align: center;
	  margin: 45px 20px 0 20px;
	}
</style>
