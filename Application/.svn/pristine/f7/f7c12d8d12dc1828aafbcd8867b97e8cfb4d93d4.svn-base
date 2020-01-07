<template>
	<div class="kd-tcintro" v-if="$store.state.info.teacher_info">
	    <div class="kd-tcintro-box">
			<ks-image class="kd-tcintro-headimg" :src="$store.state.info.teacher_info.head || $store.state.info.logo"/>
			<div class="kd-tcintro-teachername">{{$store.state.info.teacher_info.name || $store.state.info.sitename}}</div>
		</div>
		<div class="kd-tcintro-brief">
			<h3>讲师简介：</h3>{{filterHtml($store.state.info.teacher_info.shortIntro || $store.state.info.intro)}}
		</div>
	</div>
</template>

<script>
export default {
	name:'KdTeacherIntro',
	props:{
		dataList:{
			type:Array,
			default(){
				return []
			}
		}
	},
	methods:{
		filterHtml(html){
			if(html){
				var _html = html.replace(/\<[^>]+\>/g,'');
				return _html;
			}
		}
	}
}
</script>

<style scoped>
	.kd-tcintro{
		background: #fff;
		padding:25px 15px;
	}
	.kd-tcintro-box,.ks-image{
		text-align: center;
	}
	.kd-tcintro-teachername{
		font-size: 16px;
		font-weight: 600;
		color: var(--ornament-color);
		line-height: 36px;
	}
	.kd-tcintro-headimg{
		width: 60px;
		height: 60px;
		border-radius: 50%;
		border:2px solid var(--ornament-color);
		margin: 0 auto;
	}
	.kd-tcintro-brief{
		border-radius: 5px;
		background-color: #f7f7f7;
		padding: 10px;
		min-height: 48px;
		font-size: 12px;
    	line-height: 24px;
		margin-top: 10px;
	}
	.kd-tcintro-brief h3{
		display: inline;
	}
	.kd-tcintro-item{
		padding: 15px;
		box-shadow: 0 1px 10px #eee;
		margin:15px 0 0 15px;
	}

	.kd-tcintro-item .kd-tcintro-img{
		margin:  13px 0;
		width: 50px;
		height: 50px;
		border-radius: 50% ;
		overflow: hidden;
		margin: 0 auto;
	}
	
	.kd-tcintro-name{
		color: #333;
		font-size: 14px;
		height: 34px;
		line-height: 34px;
		overflow: hidden;
		text-align: center;
		white-space: nowrap;
		text-overflow: ellipsis;
	}
	.kd-tcintro-introduce{
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
