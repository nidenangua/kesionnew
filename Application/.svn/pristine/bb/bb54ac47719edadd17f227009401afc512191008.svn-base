<template>
	<div class="kd-teacher">
		<el-row :gutter="20">
			<el-col :span="4" v-for="(item,i) in dataList" :key="i">
				<div class="kd-teacher__item" @click="open(item)">
					<ks-image type="user" :src="item.head" />
					<h2>{{item.name}}</h2>
					<span>{{item.position}}</span>
					<p>{{item.shortIntro}}</p>
				</div>
			</el-col>
			
		</el-row>	
	</div>
</template>

<script>
	export default({
		name:"kdTeacher",
		props:{
			dataList:{
				type:Array,
				default(){
					return []
				}
			}
		},
		methods:{
			open(item){
				this.$router.push({
					name:"TeacherDetail",
					params:{
						'id':item.userid
					}
				})
			}
		}
	})
</script>

<style scoped>
	.kd-teacher{
		width: 1160px;
		padding: 20px 20px 30px 20px;
		margin: 0 auto;
		background: #fff;
	}
	.kd-teacher__item{
		width: 100%;
		height: 248px;
		border-radius: 16px;
		text-align: center;
		position: relative;
		background: #fafafa;
		margin-top: 20px;
	}
	.kd-teacher__item:hover{
		box-shadow: 0 2px 10px rgba(0,0,0,0.1);
		background: #fff;
	}
	.kd-teacher__item:hover .ks-image{
		width: 60px;
		height: 60px;
		border-radius: 50%;
		overflow: hidden;
		position: absolute;
		top:-25px;
		left: 50%;
		margin-left: -30px;
		
	}
	.kd-teacher__item:hover p{
		top:50px;
		text-align: left;
		line-height: 24px;
		transition: all 0.4s;
		background: #fff;
		text-overflow: -o-ellipsis-lastline;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 7;
		line-clamp: 7;
		-webkit-box-orient: vertical;
		height: 168px;
	}
	.el-col{
		width: 20%;
		cursor: pointer;
	}
	.kd-teacher__item h2{
		position: absolute;
		width: 100%;
		top:86px;
		font-size: 16px;
		color: #2d3336;
		text-align: center;
	}
	.kd-teacher__item span{
		display: inline-block;
		width: 160px;
		position: absolute;
		top:110px;
		left: 50%;
		margin-left: -80px;
		text-align: center;
		font-size: 12px;
		color: #585e61;
	}
	.kd-teacher__item p{
		position: absolute;
		width: 144px;
		top:140px;
		left: 50%;
		margin-left: -72px;
		height: 72px;
		text-align: left;
		line-height: 24px;
		text-overflow: -o-ellipsis-lastline;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 3;
		line-clamp: 3;
		-webkit-box-orient: vertical;
		color: #585e61;
	}
	.kd-teacher__item .ks-image{
		width: 100px;
		height: 100px;
		border-radius: 50%;
		overflow: hidden;
		position: absolute;
		top:-25px;
		left: 50%;
		margin-left: -50px;
		transition: .4s;
	}
</style>
