<template>
	<!-- type 1 限时抢购 ， 2 课堂直播 3 课程套餐 4 精选课程 5 精品班级-->
	<view class="ks-course__list" v-if="type == 1">
		<view class="ks-course__item" v-for="(item,i) in list" :key="i" @click="open(item)">			
			<ks-image radius="5px" class="ks-image" :src="item.photo"></ks-image>
			<view>
				<view class="ks-course__title--1">{{item.name}}</view>
				<view class="rush-course__date">
					<uni-countdown 
					v-if="item"
					splitor-color="#ff3b30"
					color="#ff3b30"
					border-color="#fff"
					:day="item.count_down" 
					    >
					</uni-countdown>
				</view>
				<view v-if="isshowprice">
					<text class="ks-course__price">￥{{item.price}}</text>
					<text class="ks-course__marketprice" style="margin-left:5px;text-decoration: line-through;">￥{{item.oldprice}}</text>
				</view>
				<view class="flex-box__space">
					<uni-tag style="margin-top: 9px;" :text="item.limitcount" type="danger" size="small"></uni-tag>
					<button style="background: #FF9500;color:#fff;margin: 0;" size="mini">马上抢</button>
				</view>
			</view>	
		
		</view>
	</view>
	<view class="ks-course__list" v-else-if="type == 2">
		<view class="live-course__item" v-for="(item,i) in list" :key="i" @click="open(item)">
		
				<!-- <view class="ks-course__title--1">{{item.name}}</view>
				<view class="live-course__date">
					<text>最新直播：{{item.date}}</text><text>{{item.countpid}}课时</text>
				</view>
				<view class="flex-box__space" style="padding-bottom: 10px;">
					<view class="live-course__name">
						<ks-image type="teacher" radius="50%" class="ks-image" :src="item.teacherphoto"></ks-image>
						<text>{{item.teacher}}</text>
					</view>
					<view style="text-align: right;" v-if="isshowprice">
						<view  class="ks-course__price">{{item.jifen - 0 > 0?(item.price - 0 >0?item.jifen+'积分+￥'+item.price:item.jifen+'积分'):(item.price - 0 >0?'￥'+item.price:'免费')}}</view>
						<view style="font-size: 12px;">已有{{item.count}}人购买</view>
					</view>
				</view> -->
			<view style="display: flex;align-items: center;padding: 10px;">
				<ks-image type="teacher" radius="50%" class="ks-image" :src="item.teacherphoto"></ks-image>
				<view class="live-course__name">
					<view class="ks-course__title--1">{{item.name}}</view>
					<view class="live-course__date">
						<text>最新直播：{{item.date}}</text>
					</view>
					<view style="display: flex;justify-content: space-between;">
						<view>老师：{{item.teacher}}</view>
						<view  class="ks-course__price">{{item.jifen - 0 > 0?(item.price - 0 >0?item.jifen+'积分+￥'+item.price:item.jifen+'积分'):(item.price - 0 >0?'￥'+item.price:'免费')}}</view>
						
					</view>
				</view>
					
				
			</view>
				
			
			<view class="ks-cell--line" v-if="i+1<list.length"></view>
		</view>
	</view>
	<view class="ks-course__list" v-else-if="type == 3">
		<view class="ks-course__item" v-for="(item,i) in list" :key="i" @click="open(item)">
			<ks-image radius="5px" class="ks-image" :src="item.photo"></ks-image>
			<view style="display: flex;flex-direction: column;justify-content: space-between;height: 100px;">
				<view style="height: 70px;">
					<view class="ks-course__title--2">{{item.name}}</view>
					<view class="package-course__count">
						{{item.bindinfo}}
					</view>
				</view>
				<view style="text-align: right;" v-if="isshowprice">
					<text class="ks-course__marketprice" style="margin-right:5px;text-decoration: line-through;">￥{{item.oldprice}}</text>
					<text class="ks-course__price">￥{{item.price}}</text>
				</view>
			</view>	
			
		</view>
	</view>
	<view class="ks-course__list" style="display: flex;justify-content: space-between;flex-wrap:wrap;" v-else-if="type == 4">
		<view class="concentration-course__item" v-for="(item,i) in list" :key="i" @click="open(item)">
			<view style="display: flex;flex-direction: column;">
			<ks-image class="ks-image" :src="item.photo"></ks-image>
			<view class="ks-course__title--1">{{item.name}}</view>
			<view class="flex-box__space" style="font-size: 12px;">
				<view class="flex-box" style="height:16px;">
					<uni-rate disabled="true" :value="item.pjnum" size="14" active-color="#007aff"></uni-rate>
					<text style="color:#007AFF;margin-left:10px;">{{item.pjnum}}分</text>
				</view>
				<view>{{item.count}}人学习</view>
			</view>
			<view class="ks-course__price" v-if="isshowprice">{{item.jifen - 0 > 0?(item.price - 0 >0?item.jifen+'积分+￥'+item.price:item.jifen+'积分'):(item.price - 0 >0?'￥'+item.price:'免费')}}</view>
			</view>
		
		</view>
	</view>
	<view class="ks-course__list" v-else-if="type == 5">
		<view class="ks-course__item" v-for="(item,i) in list" :key="i" @click="openClass(item)">
			<ks-image radius="5px" class="ks-image"
			 :src="item.photo" ></ks-image>
			<view style="display: flex;flex-direction: column;justify-content: space-between;height: 100px;">
				<view style="height: 70px;">
					<view class="ks-course__title--2">{{item.name}}</view>
					<view class="class-course__introduction" v-html="item.info">
					</view>
				</view>
				<view class="flex-box__space">
					<uni-tag :text="'共'+item.coursenum+'门课'" inverted="true" size="small"></uni-tag>
					<view style="font-size: 12px;">{{item.count}}人学习</view>
				</view>
				
			</view>	
			
		</view>
	</view>
</template>

<script>
	import {UniCountdown} from 'components/uni/uni-countdown/uni-countdown'
	import {UniTag} from 'components/uni/uni-tag/uni-tag'
	import {UniRate} from 'components/uni/uni-rate/uni-rate'
	export default {
		components:{UniCountdown,UniTag,UniRate},
		name:'KsCourseList',
		props:{
			type:{
				/*1抢购,2直播*/
				type:Number,
				default:1	
			},
			list:Array,
		},
		data() {
			return {
				isshowprice:false
			};
		},
		methods:{
			open(item){
				uni.navigateTo({
					url:'/pages/web/web?url='+encodeURIComponent(item.web_url)+'&title='+item.name
				})
			},
			openClass(item){
				uni.navigateTo({
					url:'/pages/web/web?url=/room/'+item.id+'&title='+item.name
				})
			}
		},
		mounted(){
			this.isshowprice = this.$store.state.isshowprice
		}
	}
</script>

<style>
	.ks-cell--line{
			position: relative;
		}
		.ks-cell--line::after{
			content: '';
			width: 100%;
			height: 1px;
			background: #e3e3e3;
			position: absolute;
			left: 0;
			bottom: 0;
			transform: scaleY(0.5);
			transform-origin: 0 100%;
		}
	.ks-course__marketprice{
		font-size:12px;
		color:#888888;
	}
	.ks-course__price{
		color:#FF3B30;
		font-size:16px;
	}
	.ks-course__title--1{
		overflow: hidden;
		white-space: nowrap;
		word-wrap:break-word;
		text-overflow: ellipsis;
		font-size:16px;
		font-family:PingFang SC;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height: 24px;
	}
	.ks-course__title--2{
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		word-wrap:break-word;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		font-size:16px;
		font-family:PingFang SC;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height: 24px;
		max-height: 48px;
	}
	.ks-course__item{
		border-radius: 8px;
		padding: 15px 5px 10px 160px;
		min-height: 100px;
		position: relative;	
	}

	.ks-course__item .ks-image{
		width: 150px;
		height: 100px;
		position: absolute;
		left: 0;
		top: 15px;
		border-radius: 5px;
		overflow: hidden;
	}
	/*抢购课程*/
	.rush-course__date{
		font-size: 14px;
		color:#666666;
	}
	.rush-course__date text{
		font-size:15px;
		color:#FF3B30;
	}
	
	
	/*直播课程*/
	
	
	.live-course__date text{
		font-size:12px;
		color:rgba(136,136,136,1);
		margin-right: 20px;
	}
	.live-course__name{
		flex: 1;
		font-size:14px;
		line-height: 28px;
		color:rgba(102,102,102,1);
	}
	.live-course__item .ks-image{
		width:70px;
		height:70px;
		margin-right: 20px;
	}
	/*套餐课程*/
	.package-course__count{
		font-size:12px;
		font-family:PingFang SC;
		font-weight:400;
		color:rgba(102,102,102,1);
		line-height:18px;
		margin-top: 10px;
	}
	.package-course__count text{
		margin: 0 5px;
	}
	/*精选课程*/
	.concentration-course__item{
		width:calc(50% - 10px);
		padding: 15px 0 10px 0;
	}
	.concentration-course__item .ks-image{
		width: 100%;
		height:114px;
		border-radius:5px;
		overflow: hidden;	
	}

	/*精品班级*/
	.class-course__introduction{
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		word-wrap:break-word;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
		font-size:14px;
		color:rgba(102,102,102,1);
	}	
</style>


