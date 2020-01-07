<template>
	<div class="giftRecord">
		<!-- 头部分页区 -->
		<div class="giftRecord-top">
			<h1>赠送记录</h1>
			<div class="giftRecord-top__box">
				<div class="giftRecord-top__tab">
					<span :class="{active:tab==0}" @click="slideTab(0)">未赠送</span>
					<span :class="{active:tab==1}" @click="slideTab(1)">已赠送</span>
				</div>
			</div>
		</div>
		<!-- 内容区 -->
		<div class="giftRecord-list" v-if="tab==0">
			<el-row :gutter="42" >
				<el-col :span="8" v-for="(item,i) in datalist" :key="i">
					<div class="giftRecord-list__box" >
						<div class="giftRecord-list__image">
							<ks-image :src="item.defaultpic" fit="cover" />
							<i>图文</i>
						</div>
						<h2>{{item.title}}</h2>
						<p>购买时间：<i>2019-06-13 15:12:14</i></p>
						<span>送好友</span>
					</div>
				</el-col>
			</el-row>
		</div>
		<div class="giftRecord-list" v-else-if="tab==1">
			<el-row :gutter="42" >
				<el-col :span="8"  v-for="(item,i) in datalist" :key="i">
					<div class="giftRecord-list__box" >
						<div class="giftRecord-list__image">
							<ks-image :src="item.defaultpic" fit="cover" />
							<i>图文</i>
						</div>
						<img src="../../assets/user/me_bg_gift_o.png" />
						<h2>{{item.title}}</h2>
						<p>领取时间：<i>2019-06-13 15:12:14</i></p>
						<h3>领取人：<i>{{item.name}}</i></h3>
					</div>
				</el-col>
			</el-row>
		</div>
		<div style="text-align: center;" >
			<el-pagination background layout="prev, pager, next" :page-count="pageCount" @current-change="getGiftList" v-if="pageCount>0" />
			<ks-empty msg="该分类下暂无赠送记录" v-else />
		</div>
	</div>
</template>

<script>
	import { getGiftRecord } from "@/api/user"
	export default {
	  name: "GiftRecord",
	  data() {
	    return {
	      datalist: [],
	      tab: 0,
	      page: 1,
	      loaded: false,
	      shareFlag: false,
	      pageCount: null
	    };
	  },
	
	  methods: {
	    slideTab(val) {
			this.tab = val
			this.getGiftList()
	    },
	    getGiftList(page = 1) {
	      this.$showLoading('#user')
	      this.page = page
	      if (page === 1) {
	        this.loaded = false
	        this.datalist = []
	      }
	      getGiftRecord({
	        type: this.tab,
	        p: page,
	        maxperpage: 10
	      }).then(res => {
		
	        this.pageCount = res.page.total_pages 
	        this.datalist = res.values
	        this.loaded = true
	        this.$hideLoading('#user')
	      })
	    },
	    /**
	     * 送好友
	     */
	    onShare(_id, _type, _ordersn) {
	      this.$router.push({
	        name: "ToGift",
	        query: {
	          id: _id,
	          type: _type,
	          ordersn: _ordersn
	        }
	      });
	    }
	  },
	  mounted() {
	    this.getGiftList()
	  }
	}
</script>

<style scoped>
	.giftRecord{
		width: 100%;
	}
	.giftRecord-top{
		width: 100%;
		border-bottom: 1px solid #eee;
	}
	.giftRecord-top h1{
		font-size: 20px;
		color: #2D3336;
		font-weight: 400;
		padding: 21px 24px;
	}
	.giftRecord-top__box{
		height: 44px;
		width: 100%;
		position: relative;
	}
	.giftRecord-top__tab{
		height: 44px;
		line-height: 44px;
		position: absolute;
		top: 0;
		left: 0;
	}
	.giftRecord-top__tab span{
		display: inline-block;
		min-width: 64px;
		height: 100%;
		text-align: center;
		margin-left: 40px;
		font-size: 16px;
		color: #585E61;
		cursor: pointer;
	}
	.giftRecord-top__tab i{
		display: inline-block;
		width: 1px;
		height: 20px;
		background: #ddd;
		margin-left: 40px;
		margin-bottom: -5px;
	}
	.active{
		border-bottom: 2px solid #2E84EE;
		color: #2E84EE !important;
	}
	/* 内容区 */
	.giftRecord-list{
		padding: 0 30px 40px 30px;
	}
	.giftRecord-list__box{
		width: 100%;
		height: 280px;
		margin-top: 30px;
		text-align: center;
		box-shadow:0px 2px 4px 0px rgba(0, 0, 0, 0.05);
		border-radius:6px;
		position: relative;
	}
	.giftRecord-list__image{
		width: 100%;
		height: 153px;
		position: relative;
	}
	.giftRecord-list__image .ks-image{
		width: 100%;
		height: 100%;
	}
	.giftRecord-list__image i{
		display: inline-block;
		position: absolute;
		left: 10px;
		top: 10px;
		width:36px;
		height:20px;
		background:rgba(0,0,0,0.4);
		border-radius:2px;
		line-height: 20px;
		text-align: center;
		font-size: 12px;
		color: #fff;
		font-style: normal;
	}
	.giftRecord-list__box h2{
		font-size: 14px;
		color: #2D3336;
		line-height: 24px;
		font-weight: 400;
		text-align: left;
		margin: 5px 10px 0 10px;
	}
	.giftRecord-list__box p{
		font-size: 14px;
		color: #929A9E;
		margin: 5px 10px 0 10px;
		text-align: left;
	}
	.giftRecord-list__box p i{
		color: #2E84EE;
		font-style: normal;
	}
	.giftRecord-list__box span{
		display: inline-block;
		width:100px;
		height:30px;
		border:1px solid #2E84EE;
		border-radius:15px;
		color: #2E84EE;
		line-height: 30px;
		text-align: center;
		margin-top: 11px;
		font-size: 14px;
	}
	.giftRecord-list__box h3{
		color: #929A9E;
		font-size: 14px;
		text-align: left;
		font-weight: 400;
		margin-top: 11px;
		margin-left: 10px;
	}
	.giftRecord-list__box h3 i{
		color: #2E84EE;
		font-style: normal;
	}
	.giftRecord-list__box img{
		position: absolute;
		right: 10px;
		top: 117px;
	}
</style>
