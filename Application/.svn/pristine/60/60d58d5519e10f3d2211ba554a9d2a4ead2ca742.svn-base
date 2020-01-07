<template>
	<div class="myGroup">
		<!-- 头部分页区 -->
		<div class="myGroup-top">
			<h1>我的社群</h1>
			<div class="myGroup-top__box">
				<div class="myGroup-top__tab">
					<span :class="{active:tab==0}" @click="showTab(0)">我的社群</span>
					<span :class="{active:tab==1}" @click="showTab(1)">我的评论</span>
					<span :class="{active:tab==2}" @click="showTab(2)">我的点赞</span>
				</div>
			</div>
		</div>
		<!-- 内容区 -->
		<div class="myGroup-my"v-if="tab==0">
				<div class="myGroup-my__item">
					<ks-image src="" fit="cover" />
					<div class="myGroup-my__right">
						<h1>社群名称社群名称社群名称社群名称</h1>
						<span>最新话题：<i>“参加摄影比赛的照片是否都后期处理过？”</i></span>
						<div class="myGroup-my__box">
							<span>111<i>人加入</i></span>
							<span>111<i>个动态</i></span>
							<p>进入社群</p>
						</div>
					</div>
				</div>
	
		</div>
		<div class="myGroup-comment" v-else-if="tab==1">
			<div class="myGroup-comment__item">
				<div class="myGroup-comment__top">
					<div class="myGroup-comment__left">
						<img src="@/pc/assets/user/default-avatar.jpg" />
						<div class="myGroup-comment__userName">
							<p>sky1011</p>
							<span>2019-01-29 18:25:14</span>
						</div>
					</div>
					<div class="myGroup-comment__right">
						<span>14</span>
						<img src="@/pc/assets/user/news_btn_like.png" />
						<img src="@/pc/assets/user/me_icon_delet.png" />
					</div>
				</div>
				<div class="myGroup-comment__main">
					<p>我先来说下我的：1：网站改版要大气的图，换了十多张，还是回到最初的蓝天、白云、加飞机，原来这就是“大气”2 : 奇葩的软件需求：通过软件来防止付错款、打错字、发错客户、选错产品名…那我写个软件可以直接打印人民币好不好？</p>
					<div class="myGroup-comment__comment">
			            评论兰芷馥郁的动态：<span>
			            你见过最奇葩的需求是什么？有没有搞笑的可以分享一下呢？或者你见过最奇怪的需求？最不可思议的需求？最想盘他的需求？
			        </span>
					</div>
				</div>
			</div>	
		</div>
		<div class="myGroup-comment"  v-else-if="tab==2">
			<div class="myGroup-comment__item">
				<div class="myGroup-comment__top">
					<div class="myGroup-comment__left">
						<img src="@/pc/assets/user/default-avatar.jpg" />
						<div class="myGroup-comment__userName">
							<p>sky1011</p>
							<span>2019-01-29 18:25:14</span>
						</div>
					</div>
					<div class="myGroup-comment__right">
						<span>14</span>
						<img src="@/pc/assets/user/news_btn_like.png" />
						<img src="@/pc/assets/user/me_icon_delet.png" />
					</div>
				</div>
				<div class="myGroup-comment__main">
					<p>我先来说下我的：1：网站改版要大气的图，换了十多张，还是回到最初的蓝天、白云、加飞机，原来这就是“大气”2 : 奇葩的软件需求：通过软件来防止付错款、打错字、发错客户、选错产品名…那我写个软件可以直接打印人民币好不好？</p>
					<div class="myGroup-comment__comment">
			            评论兰芷馥郁的动态：<span>
			            你见过最奇葩的需求是什么？有没有搞笑的可以分享一下呢？或者你见过最奇怪的需求？最不可思议的需求？最想盘他的需求？
			        </span>
					</div>
				</div>
			</div>
		</div>
		<div style="text-align: center;margin-top: 20px;">
			<el-pagination background layout="prev, pager, next" :total="pageCount" @current-change="getList" @prev-click="getList" @next-click="getList" />
		</div>
	</div>
</template>

<script>
	export default({
		name:"MyGroup",
		data() {
			return {
				tab:0,//默认我的社群
				pageCount:10,
			}
		},
		methods:{
			/*
			* 切换分页
			* 
			* */
			showTab(i){
				this.tab = i
			},
			getList(){}
		}
	})
</script>

<style scoped>
	.myGroup{
		width: 100%;
	}
	.myGroup-top{
		width: 100%;
		border-bottom: 1px solid #eee;
	}
	.myGroup-top h1{
		font-size: 20px;
		color: #2D3336;
		font-weight: 400;
		padding: 21px 24px;
	}
	.myGroup-top__box{
		height: 44px;
		width: 100%;
		position: relative;
	}
	.myGroup-top__tab{
		height: 44px;
		line-height: 44px;
		position: absolute;
		top: 0;
		left: 0;
	}
	.myGroup-top__tab span{
		display: inline-block;
		width: 64px;
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
	/* 内容区 */
	/* 我的社群 */
	.myGroup-my{
		padding: 0 30px 40px 30px;
	}
	.myGroup-my__item{
		padding: 20px;
		height:135px;
		background:rgba(255,255,255,1);
		box-shadow:0px 2px 4px 0px rgba(0, 0, 0, 0.1);
		border-radius:6px;
		margin-top: 20px;
	}
	.myGroup-my__item .ks-image{
		width: 240px;
		height: 100%;
		margin-right: 20px;
		float: left;
	}
	.myGroup-my__right{
		width: calc(100% - 260px);
		float: right;
	}
	.myGroup-my__right h1{
		font-weight: 400;
		font-size: 16px;
		color: #353535;
		margin-top: 5px;
		margin-bottom: 25px;
	}

	.myGroup-my__right span{
		font-size: 14px;
		color: #929A9E;
		margin-top: 10px;
		
	}
	.myGroup-my__right span i{
		color: #2E84EE;
		font-style: normal;
		margin-left: 20px;
	}
	.ks-ft-12px{
		font-size: 12px !important;
	}
	.myGroup-my__box{
		height: 32px;
		margin-top: 25px;
	}
	.myGroup-my__box p{
		width:120px;
		height:30px;
		border:1px solid #2E84EE;
		border-radius:15px;
		float: right;
		line-height: 30px;
		font-size: 14px;
		color: #fff;
		text-align: center;
		background: #2E84EE;
	}
	.myGroup-my__box span{
		margin-right: 40px;
		color: #2E84EE;
	}
	.myGroup-my__box span i{
		font-style: normal;
		color: #353535;
		margin-left: 3px;
	}
	/* 我的评论 */
	.myGroup-comment__item{
		padding: 20px 20px 0 20px;
		
	}
	.myGroup-comment__top{
		height: 50px;
		padding-right: 20px;
	}
	.myGroup-comment__left{
		height: 100%;
		float: left;
	}
	.myGroup-comment__left img{
		width: 50px;
		height: 50px;
		overflow: hidden;
		border-radius: 50%;	
		float: left;
	}
	.myGroup-comment__userName{
		float: left;
		font-size: 14px;
		margin-left: 10px;
		height: 50px;
		line-height: 25px;
	}
	.myGroup-comment__userName p{
		color: #353535;
	}
	.myGroup-comment__userName span{
		color: #888888;
		font-size: 12px;
	}
	.myGroup-comment__right{
		float: right;
		line-height: 16px;
	}
	.myGroup-comment__right img{
		margin-left: 20px;
		float: right;
	}
	.myGroup-comment__right span{
		margin-left: 10px;
		float: right;
		color: #666666;
	}
	.myGroup-comment__main{
		padding-left: 60px;
		padding-right: 20px;
		padding-bottom: 20px;
		border-bottom: 1px solid #eee;
	}
	.myGroup-comment__main p{
		font-size: 14px;
		line-height: 28px;
		color: #2D3336;
		padding: 10px 0;
	}
	.myGroup-comment__comment{
		line-height: 28px;
		color: #929A9E;
		font-size: 14px;
		padding: 10px 20px;
		background: #F4F6FA;
	}
	.myGroup-comment__comment span{
		color: #585E61;
	}
</style>
