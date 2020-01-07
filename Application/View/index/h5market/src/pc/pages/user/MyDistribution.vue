<template>
	<div class="myDistribution">
		<!-- 头部分页区 -->
		<div class="myDistribution-top">
			<h1>我的分销</h1>
		</div>
		<!-- 内容区 -->
		<div class="myDistribution-record">
			<div class="myDistribution-record__item">
				<span>累计收益</span>
				<h2>￥16583.00</h2>
			</div>
			<i></i>
			<div class="myDistribution-record__item">
				<span>未入账</span>
				<h2>￥500.00</h2>
			</div>
			<i></i>
			<div class="myDistribution-record__item">
				<span>可提现金额</span>
				<div class="myDistribution-record__withdraw">
					￥684.00
					<span>提现</span>
				</div>
			</div>
		</div>
		<div style="height: 20px;background: #F8F8F8;"></div>
		<div class="myDistribution-tab">
			<div class="myDistribution-tab__box">
				<span :class="{active:tabActive==0}" @click="showTab(0)">推广赚钱</span>
				<span :class="{active:tabActive==1}" @click="showTab(1)">我的收益</span>
				<span :class="{active:tabActive==2}" @click="showTab(2)">提现记录</span>
			</div>
		</div>
		<!-- 列表 -->
		<div class="myDistribution-extension" v-if="tabActive==0">
			<el-row :gutter="42" >
				<el-col :span="8" v-for="(item,i) in distributeList.list" :key="i">
					<div class="myDistribution-extension__box" >
						<div class="myDistribution-extension__image">
							<ks-image :src="item.defaultpic" fit="cover" />
							<i>图文</i>
						</div>
						<h2>{{item.title}}</h2>
						<p>共 1 课时 | {{item.studentcount}}人学过</p>
						<div class="myDistribution-extension__price">
							￥{{item.price}}
							<span>推广赚￥59.00</span>
						</div>
					</div>
				</el-col>
			</el-row>
		</div>
		<!-- 我的收益 -->
		<div class="myDistribution-income" v-else-if="tabActive==1">
			<div  v-for="(item,i) in myDistributton.list" :key="i">
				<div class="myDistribution-income__title">
					<div class="myDistribution-income__courseName">课程名称</div>
					<div class="myDistribution-income__name">购买人</div>
					<div class="myDistribution-income__date">下单时间</div>
					<div class="myDistribution-income__state">订单状态</div>
					<div class="myDistribution-income__money">收益（元）</div>
				</div>
				<div class="myDistribution-income__text">
					<div class="myDistribution-income__courseName">{{item.title}}</div>
					<div class="myDistribution-income__name">{{item.name}}</div>
					<div class="myDistribution-income__date">2019-06-13 17:31:14</div>
					<div class="myDistribution-income__state">待支付</div>
					<div class="myDistribution-income__money">+{{item.price}}</div>
				</div>
			</div>
		</div>
		<!-- 提现记录 -->
		<div class="myDistribution-withdrawRecord" v-else-if="tabActive==2">
			<div class="myDistribution-withdrawRecord__title">
				<div class="myDistribution-withdrawRecord__date">提现时间</div>
				<div class="myDistribution-withdrawRecord__method">提现方式</div>
				<div class="myDistribution-withdrawRecord__number">提现账号</div>
				<div class="myDistribution-withdrawRecord__money">提现金额</div>
				<div class="myDistribution-withdrawRecord__state">状态</div>
			</div>
			<div class="myDistribution-withdrawRecord__text">
				<div class="myDistribution-withdrawRecord__date">2019-06-13 17:45:14</div>
				<div class="myDistribution-withdrawRecord__method">微信</div>
				<div class="myDistribution-withdrawRecord__number">1388888888888</div>
				<div class="myDistribution-withdrawRecord__money">￥100.00</div>
				<div class="myDistribution-withdrawRecord__state">已到账</div>
			</div>
		</div>
	</div>
</template>

<script>
	/**
	 * 分销
	 */
	import { getTypeName, getViewRoute } from "@/utils";
	import {
	  myDistributeList,
	  distributionList,
	  applyDistributeWithdrawal,
	  checkApplyBindWechat
	} from "@/api/distribution";
	export default {
	  name: "MyDistribution",
	  data() {
	    return {
	      windowHeight: window.innerHeight,
	      /**
	       * 分享开关
	       */
	      shareFlag: false,
	      /**
	       * 提现开关
	       */
	      openid: "",
	      realyname: "",
	      withdrawalVisible: false,
	      tabActive: 0,
	      currentIncome: "",
	      wrz: "",
	      allMoney: "",
	      kjs: "",
	      /**
	       * 我的分销
	       */
	      myDistributton: {
	        p: 1,
	        pageCount: null,
	        loaded: false,
	        list: []
	      },
	      /**
	       * 分销列表
	       */
	      distributeList: {
	        p: 1,
	        pageCount: null,
	        loaded: false,
	        list: []
	      },
		  
	    };
	  },
	  methods: {
		  showTab(i){
			 this.tabActive = i 

			 this.getList()
			
		  },
	    /**
	     * 处理选项卡点击
	     */
	    handleClick(active) {
	      let dataNode = active == 0 ? "distributeList" : "myDistributton";
	      if (!this[dataNode].loaded) {
	        this.getList();
	      }
	    },
	    /**
	     * 去提现
	     */
	    goWithdrawal() {
	      if (parseFloat(this.kjs) > 0) {
	        this.$store.ready(state => {
	          checkApplyBindWechat().then(res => {
	            if (res.result === "success") {
	              this.openid = res.openid;
	              this.realyname = res.name;
	              this.withdrawalVisible = true;
	            } else {
	              this.$toast(res.msg).then(() => {
	                let path = location.href.split("#")[1];
	                res.authorurl += `&wxid=${state.info.wxid}&turnurl=${path}`;
	                location.href = res.authorurl;
	              });
	            }
	          });
	        });
	      } else {
	        this.$toast("没有可结算的余额！", "tips", 2000);
	      }
	    },
	    /**
	     * 提交提现申请
	     */
	    withdrawalSubmit() {
	      applyDistributeWithdrawal({
	        realyname: this.realyname,
	        openid: this.openid
	      }).then(res => {
	        if (res.result === "success") {
	          this.$toast("提交成功", "success").then(() => {
	            this.kjs = res.balance;
	            this.withdrawalVisible = false;
	          });
	        }
	      });
	    },
	    /**
	     * 分享
	     */
	    share(item) {
	      this.$store.ready(state => {
	        if (state.isLogin == 0) {
	          this.$toast("请先登录").then(() => {
	            this.$router.push({
	              name: "UserLogin"
	            });
	          });
	        } else {
	          let typeName = getTypeName(item.type);
	          let company = typeName === "课程" ? "门" : "个";
	          this.currentIncome = item.commission;
	
	          let path = getViewRoute(item, "id");
	          let _link = `${
	            location.href.split("#")[0]
	          }#${path}?distributeUserId=${state.userInfo.userid}`;
	
	          this.$wxShare({
	            title: item.title,
	            desc: `这${company}${typeName}不错，快来跟我一起学~`,
	            imgUrl: item.defaultpic,
	            link: _link
	          });
	          this.$showMask({
	            click: () => {
	              this.shareFlag = false;
	              this.$hideMask();
	            }
	          });
	          this.shareFlag = true;
	        }
	      });
	    },
	    /**
	     * 查看详情
	     */
	    open(item) {
	      let _path = getViewRoute(item, "id");
	      this.$router.push({
	        path: _path
	      });
	    },
	    /**
	     * 获取数据列表
	     */
	    getList(p = 1, loadMyDistribute) {
	      this.$showLoading();
	      let dataNode = this.tabActive == 0 ? "distributeList" : "myDistributton";
	      this[dataNode].p = p;
	      if (p == 1) {
	        this[dataNode].loaded = false;
	        this[dataNode].list = [];
	      }
	      if (this.tabActive == 0) {
	        distributionList({
	          p: p,
	          maxperpage: 10,
	          title: this.$route.query.key || ""
	        }).then(res => {
				console.log(res)
	          this.distributeList.pageCount = res.page.total_pages;
	          this.distributeList.list = res.list
	          this.distributeList.loaded = true;
	          this.$hideLoading();
	        });
	      }
	      if (this.tabActive == 1 || loadMyDistribute) {
	        myDistributeList({
	          p: p,
	          maxperpage: 10
	        }).then(res => {
				console.log(res)
	          this.wrz = res.djs || "0.00";
	          this.allMoney = res.allmoney || "0.00";
	          this.kjs = res.kjs || "0.00";
	          this.myDistributton.pageCount = res.page.total_pages
	          this.myDistributton.list = res.list
	          this.myDistributton.loaded = true;
	          this.$hideLoading();
	        });
	      }
	    }
	  },
	  mounted() {
	    window.addEventListener("resize", () => {
	      this.windowHeight = window.innerHeight;
	    });
	  },
	  activated() {
	    document.title = "我的分销";
	    this.getList(1, true);
	  }
	};
</script>

<style scoped>
	.myDistribution{
		width: 100%;
	}
	.myDistribution-top{
		width: 100%;
		border-bottom: 1px solid #eee;
	}
	.myDistribution-top h1{
		font-size: 20px;
		color: #2D3336;
		font-weight: 400;
		padding: 21px 24px;
	}
	/* 内容区 */
	.myDistribution-record{
		width: 100%;
		height: 140px;
		text-align: center;
	}
	.myDistribution-record__item{
		width: calc((100% - 2px) / 3);
		height: 100%;
		float: left;
	}
	.myDistribution-record__item span{
		display: inline-block;
		margin-top: 32px;
		font-size: 16px;
		color: #929A9E;
	}
	.myDistribution-record__item h2{
		color: #2D3336;
		font-size: 24px;
		font-weight: 400;
		margin-top: 14px;
	}
	.myDistribution-record i{
		display: inline-block;
		height: 80px;
		width: 1px;
		background: #eee;
		margin-top: 30px;
		float: left;
	}
	.myDistribution-record__withdraw{
		width: 100%;
		height: 30px;
		text-align: center;
		margin-top: 14px;
		font-size: 24px;
		color: #2D3336;
		
	}
	.myDistribution-record__withdraw span{
		display: inline-block;
		width:60px;
		height:30px;
		background:#2E84EE;
		border-radius:15px;
		line-height: 30px;
		color: #fff;
		font-size: 14px;
		text-align: center;
		font-style: normal;
		margin: -10px 0 0 5px;
	}
	/* 分页 */
	.myDistribution-tab{
		height: 44px;
		width: 100%;
		position: relative;
		border-bottom: 1px solid #eee;
	}
	.myDistribution-tab__box{
		height: 44px;
		line-height: 44px;
		position: absolute;
		top: 0;
		left: 0;
	}
	.myDistribution-tab__box span{
		display: inline-block;
		min-width: 64px;
		height: 100%;
		text-align: center;
		margin-left: 40px;
		font-size: 16px;
		color: #585E61;
		cursor: pointer;
	}
	.active{
		border-bottom: 2px solid #2E84EE;
		color: #2E84EE !important;
	}
	/* 列表 */
	/* 推广赚钱 */
	.myDistribution-extension{
		padding: 0 30px 40px 30px;
	}
	.myDistribution-extension__box{
		width: 100%;
		height: 280px;
		margin-top: 30px;
		text-align: center;
		box-shadow:0px 2px 4px 0px rgba(0, 0, 0, 0.05);
		border-radius:6px;
		position: relative;
	}
	.myDistribution-extension__image{
		width: 100%;
		height: 153px;
		position: relative;
	}
	.myDistribution-extension__image .ks-image{
		width: 100%;
		height: 100%;
	}
	.myDistribution-extension__image i{
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
	.myDistribution-extension__box h2{
		font-size: 14px;
		color: #2D3336;
		line-height: 24px;
		font-weight: 400;
		text-align: left;
		margin: 5px 10px 0 10px;
	}
	.myDistribution-extension__box p{
		font-size: 12px;
		color: #929A9E;
		margin: 5px 10px 0 10px;
		text-align: left;
	}
	.myDistribution-extension__price{
		font-size: 14px;
		color: #2D3336;
		padding: 0 10px;
		text-align: left;
		line-height: 30px;
		margin-top: 10px;
	}
	.myDistribution-extension__price span{
		display: inline-block;
		width:120px;
		height:30px;
		border:1px solid #EC4A46;
		border-radius:15px;
		line-height: 30px;
		text-align: center;
		color: #EC4A46;
		float: right;
	}
	/* 我的收益 */
	.myDistribution-income{
		padding: 20px 20px 24px 20px;
	}
	.myDistribution-income__title{
		height: 40px;
		background: #F4F6FA;
		line-height: 40px;
		text-align: center;
		font-size: 14px;
		color: #929A9E;
	}

	.myDistribution-income__courseName{
		width: 376px;
		padding-left: 20px;
		text-align: left;
		float: left;
	}
	.myDistribution-income__name{
		width: 123px;
		float: left;
		text-align: left;
	}
	.myDistribution-income__date{
		width: 140px;
		float: left;
	}
	.myDistribution-income__state{
		width: 167px;
		float: left;
	}
	.myDistribution-income__money{
		width: 70px;
		float: left;
	}
	.myDistribution-income__text{
		height: 48px;
		border-bottom: 1px solid #eee;
		text-align: center;
		line-height: 48px;
		color: #585E61;
		font-size: 14px;
	}
	/* 提现记录 */
	.myDistribution-withdrawRecord{
		padding: 20px 20px 24px 20px;
	}
	.myDistribution-withdrawRecord__title{
		height: 40px;
		background: #F4F6FA;
		line-height: 40px;
		text-align: center;
		font-size: 14px;
		color: #929A9E;
	}
	
	.myDistribution-withdrawRecord__date{
		width: 206px;
		padding-left: 20px;
		text-align: left;
		float: left;
	}
	.myDistribution-withdrawRecord__method{
		width: 56px;
		float: left;
	}
	.myDistribution-withdrawRecord__number{
		width: 350px;
		float: left;
	}
	.myDistribution-withdrawRecord__money{
		width: 82px;
		float: left;
		margin-right: 80px;
	}
	.myDistribution-withdrawRecord__state{
		width: 70px;
		float: left;
	}
	.myDistribution-withdrawRecord__text{
		height: 48px;
		border-bottom: 1px solid #eee;
		text-align: center;
		line-height: 48px;
		color: #585E61;
		font-size: 14px;
	}
</style>
