<template>
	<div class="kd-group">
		<el-row>
			<el-col :span="12" v-for="(item,i) in dataList" :key="i" v-if="i<2">
				<div class="kd-group__item">
					<div class="kd-group__image"><ks-image  :src="item.defaultpic"></ks-image></div>
					<div class="kd-group__right">
						<h3><span></span>{{item.title}}</h3>
						<p>{{item.description}}</p>
					</div>
				</div>
			</el-col>
		</el-row>
		<el-row >
			<el-col :span="12" v-for="(item,i) in dataList" :key="i" v-if="i>=2">
				<div class="kd-group__item">
					<div class="kd-group__left">
						<h3 class="kd-fr">{{item.title}}<span></span></h3>
						<p class="kd-fr">{{item.description}}</p>
					</div>
					<div class="kd-group__image"><ks-image  :src="item.defaultpic"></ks-image></div>
				</div>
			</el-col>
		</el-row>
	</div>
</template>

<script>
	export default({
		name:"KdGroup",
		props:['dataList'],
		data() {
			return {
				
			}
		},
	})
</script>

<style scoped>
	.el-col{
		cursor: pointer;
	}
	.kd-group{
		width: 1160px;
		padding: 10px 20px 30px 20px;
		margin: 0 auto;
		background: #fff;
	}
	.kd-group__item{
		width: 100%;
		height: 162px;
	}
	.kd-group__right{
		width: 50%;
		height: 100%;
		float: right;
		background: #fafafa;
	}
	.kd-group__image{
		width: 50%;
		height: 100%;
		overflow: hidden;
		float: left;
	}
	.kd-group__image .ks-image{
		width: 100%;
		height: 100%;
		transition: all 0.6s;
		-webkit-transition: all 0.6s;
		-o-transition: all 0.6s;
		-moz-transition: all 0.6s;
		-ms-transition: all 0.6s;
	}
	.kd-group__item:hover .ks-image{
		transform: scale(1.2);
		-webkit-transform: scale(1.2);
		-o-transform: scale(1.2);
		-moz-transform: scale(1.2);
		-ms-transform: scale(1.2);
	}
	.kd-group__item h3{
		font-size: 16px;
		margin-top: 50px;
		margin-left: 20px;
		height: 20px;
		line-height: 20px;
		color: #2d3336;
	}
	
	.kd-group__item h3 span{
		display: inline-block;
		width: 3px;
		height: 18px;
		background: #2e84ee;
		margin-right: 5px;
		float: left;
	}
	.kd-group__item p{
		width: 200px;
		color: #585e61;
		font-size: 12px;
		margin-top: 10px;
		margin-left: 20px;
		line-height: 18px;
		text-overflow: -o-ellipsis-lastline;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		line-clamp: 2;
		-webkit-box-orient: vertical;
	}
	.kd-group__left{
		width: 50%;
		height: 100%;
		float: left;
		background: #fafafa;
	}
	.kd-group__left h3 span{
		float: right;
		margin-right: 20px;
		margin-left: 5px;
	}
	.kd-group__left p{
		text-align: right;
		margin-right: 20px;
	}
	.kd-fr{
		float: right;
	}
	
</style>
