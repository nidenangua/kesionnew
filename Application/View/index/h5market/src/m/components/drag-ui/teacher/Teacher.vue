<template>
	<div class="ks-row teacher-list">
	    <div class="ks-col-12" v-for="(item,i) in dataList" :key="i">
			<div class="teacher-list__item" @click="open(item.userid)">
				<ks-create-bg class="teacher-list__img" :src="item.head" type="user"></ks-create-bg>
				<div class="teacher-list__name">{{item.name}}</div>
				<div class="teacher-list__introduce">{{item.shortIntro}}</div>
			</div>
	    </div>
	</div>
</template>

<script>
export default {
	name:'KdTeacher',
	props:{
		dataList:{
			type:Array,
			default(){
				return []
			}
		}
	},
	methods:{
		open(userid){
			this.$router.push({
				name:'TeacherView',
				params:{
					id:userid
				}
			})
		}
	}
}
</script>


<style scoped>
	.teacher-list{
		background: #fff;
		padding:0 15px 15px 0;
	}
	.teacher-list__item{
		padding: 15px;
		box-shadow: 0 1px 10px #eee;
		margin:15px 0 0 15px;
	}

	.teacher-list__item .teacher-list__img{
		margin:  13px 0;
		width: 50px;
		height: 50px;
		border-radius: 50% ;
		overflow: hidden;
		margin: 0 auto;
	}
	
	.teacher-list__name{
		color: var(--title-color);
		font-size: 14px;
		height: 34px;
		line-height: 34px;
		overflow: hidden;
		text-align: center;
		white-space: nowrap;
		text-overflow: ellipsis;
	}
	.teacher-list__introduce{
		color: #999999;
		font-size: 11px;
		line-height: 22px;
		height: 44px;
		text-overflow: -o-ellipsis-lastline;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		line-clamp: 2;
		-webkit-box-orient: vertical;
		margin-top: 5px;
	}
</style>
