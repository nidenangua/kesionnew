<template>
	<div class="group">
		<!-- 内容区 -->
		<div class="group-box">
			<!-- 推荐社群 -->
			<div class="group-recommend">
				<h1>推荐社群</h1>
				<div class="group-recommend__box">
					<el-row :gutter="80" >
						<el-col :span="4" >
							<el-image src="" fit="cover" />
							<h2>C4D讨论社群</h2>
						</el-col>
					</el-row>
				</div>
			</div>
			<!-- 所有社群 -->
			<div class="group-list">
				<h1>所有社群<span>按最新排序</span><span>按热门排序</span></h1>
				<div class="group-list__item">
					<el-image src="" fit="cover"/>
					<div class="group-list__box">
						<h2>厨艺烹饪</h2>
						<div class="group-list__join">
                            1458<i>人加入</i>
                            1458<i>个动态</i>
						</div>
						<p>这是一个讨论厨艺烹饪的社群，厨艺完全可以用零散时间学习，成员都积极打卡啊！虽然成员们都很害羞，但是群主还是挺负责的啦～！希望大家越来越好啦~</p>
						<span>立即加入</span>
					</div>
				</div>
				<div style="text-align: center;margin-top: 20px;">
					<el-pagination background layout="prev, pager, next" :total="pageCount" @current-change="getList" @prev-click="getList" @next-click="getList" />
				</div>
			</div>
			<!-- 热门动态 -->
			<div class="group-hot">
				<h1>热门动态</h1>
				<div class="group-hot__list">
					<div class="group-hot__item">
						<div class="group-hot__userName">
							<img src="../../assets/user/default-avatar.jpg" />
							且听且看
						</div>
						<p>UI设计素材10G，需要的留邮箱，有空会一个一个发送的~</p>
						<span><i>UI学习社群</i> · 评论1234 · 点赞3452</span>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</template>

<script>
	export default({
		name:"Group",
		data() {
			return {
				pageCount:10,
			}
		},
		methods:{
			getList(){
				
			}
		}
	})
</script>

<style scoped>
	.group-box{
		width: 1200px;
		margin: 0 auto;
		overflow: hidden;
	}
	
	.group-recommend h1{
		font-size: 18px;
		color: #2D3336;
		margin: 25px 0 15px 0;
	}
	
	.group-recommend__box{
		padding: 24px 40px 0 40px;
		background: #fff;
		height: 164px;
		text-align: center;
	}
	.group-recommend__box .el-image{
		height: 120px;
		width: 100%;
	}
	.group-recommend__box h2{
		font-size: 14px;
		font-weight: 400;
		color: #2D3336;
	}
	.group-list{
		padding-top: 10px;
		width: 880px;
		margin-right: 20px;
		float: left;
	}
	.group-list h1{
		font-size: 18px;
		color: #2D3336;
		margin: 25px 0 15px 0;
	}
	.group-list h1 span{
		font-size: 14px;
		color: #666;
		font-weight: 400;
		margin-left: 26px;
	}
	.group-list__item{
		padding: 20px;
		height: 200px;
		background: #fff;
		border-radius:8px;
		margin-bottom: 10px;
	}
	.group-list__item .el-image{
		width: 200px;
		height: 100%;
		border-radius:6px;
		float: left;
		margin-right: 20px;
	}
	.group-list__box{
		
	}
	.group-list__box h2{
		font-size: 16px;
		color: #353535;
		font-weight: 400;
		margin-top: 5px;
	}
	.group-list__join{
		font-size: 14px;
		 color: #2E84EE;
		 margin-top: 20px;
	}
	.group-list__join i{
		font-style: normal;
		color: #353535;
	}
	.group-list__box p{
		font-size: 14px;
		color: #666;
		line-height: 32px;
		margin-top: 10px;
	}
	.group-list__box span{
		display: inline-block;
		width:120px;
		height:36px;
		background:#2E84EE;
		border-radius:18px;
		float: right;
		color: #fff;
		font-size: 16px;
		line-height: 36px;
		text-align: center;
		margin-top: 20px;
	}
	/* 热门动态 */
	.group-hot{
		width: 300px;
		float: right;
		padding-top: 10px;
	}
	.group-hot h1{
		font-size: 18px;
		color: #2D3336;
		margin: 25px 0 15px 0;
	}
	.group-hot__list{
		padding: 0 10px 30px 10px;
		background: #fff;
	}
	.group-hot__item{
		border-bottom: 1px solid #eee;
	}
	.group-hot__userName{
		font-size: 12px;
		color: #929A9E;
		line-height: 30px;
		margin-top: 16px;
	}
	.group-hot__userName img{
		width: 30px;
		height: 30px;
		border-radius: 50%;
		overflow: hidden;
		float: left;
		margin-right: 9px;
	}
	.group-hot__item p{
		font-size: 14px;
		color: #585E61;
		line-height:24px;
		margin-top: 10px;
	}
	.group-hot__item span{
		display: inline-block;
		font-size: 12px;
		color: #929A9E;
		margin:10px 0;
	}
	.group-hot__item span i{
		color: #2E84EE;
		font-style: normal;
	}
</style>
