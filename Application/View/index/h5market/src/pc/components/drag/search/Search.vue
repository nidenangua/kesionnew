<template>
	<div class="kd-search">
		<input type="text" :placeholder="placeholder||'请输入您要搜索的课程'" />
		<i class="el-icon-search"></i>
	</div>
</template>

<script>
	export default({
		name:"KdSearch",
		props:['placeholder'],
		data() {
			return {
				keyword:''
			}
		},
		methods:{
			
		}
	})
</script>

<style scoped>
	
	.kd-search{
		width: 300px;
		height: 30px;
		border-radius: 20px;
		background: #fafafa;
		margin-left: 10%;
		float: left;
	}
	.kd-search input{
		border: none;
		outline: none;
		background: #fafafa;
		margin-left: 10px;
		height: 30px;
		width: 200px;
		line-height: 30px;
	}
	.kd-search input::placeholder{
		font-size: 10px;
		line-height: 30px;
		color: #999;
	}
	.kd-search i{
		margin-right: 10px;
		float: right;
		line-height: 30px;
	}
</style>
