<template>
	<view class="main" v-show="load">
		<view class="bg">
			<view class="main-padding">
				<view>可提现佣金余额(元)</view>
				<view class="btn">
					<view>{{data.wtxyj}}</view>
					<button @click="open('/pages/user/distribution/applycash')">申请提现</button>
				</view>
				<view class="look" @click="open('/pages/user/distribution/record')">查看提现记录</view>
				<view class="top-list">
					<view class="top-item">
						<view>累计佣金(元)</view>
						<view class="number">{{data.totalyj}}</view>
					</view>
					<view class="top-item">
						<view>佣金累计已提现(元)</view>
						<view class="number">{{data.totaltxyj}}</view>
					</view>
				</view>
			</view>
		</view>
		<view class="middle">
			<view class="middle-list">
				<view class="middle-item">
					<view class="number">{{data.yj1}}</view>
					<view class="middle-text">本店佣金(元)</view>
					
				</view>
				<view class="middle-item">
					<view class="number">{{data.yj2}}</view>
					<view class="middle-text">一级分销订单(元)</view>
					
				</view>
				<view class="middle-item">
					<view class="number">{{data.yj3}}</view>
					<view class="middle-text">二级分销订单(元)</view>
					
				</view>
			</view>
			<view class="detail" @click="open('/pages/user/distribution/order')">查看佣金明细>></view>
		</view>
		<view class="bottom">
			<view class="bottom-title">亲，您的佣金由三部分组成：</view>
			<view class="bottom-list">
				<view class="bottom-item">1、本店所销售的课程，我所获得佣金（即直接会员销售佣金）；</view>
				<view class="bottom-item">2、下级分店所销售的课程，我所获得佣金（即一级分店佣金）；</view>
				<view class="bottom-item">3、下级分店发展的分店所销售的课程，我所获得佣金（即二级销售佣金）。</view>
			</view>
		</view>
		<uni-popup ref="popup" :custom="true"  :show="show" type="center" @change="close" >
			<view class="content-box">
				<image class="close-image" :src="baseUrl+'/static/images/common/close.png'" @click="show = false"></image>
				<view class="title" >实名认证</view>
				<view class="popup-list">
					<view class="popup-item">
						<view class="item-text">身份证号码：</view>
						<input placeholder="请输入身份证号码" v-model="idcard" type="idcard" />
					</view>
					<view class="popup-item">
						<view class="item-text">真实姓名：</view>
						<input placeholder="请输入真实姓名" v-model="realname"  />
					</view>
					<view class="save-btn">
						<button class="return-btn main-btn" v-if="realname&&idcard" @click="save()">提交认证</button>
						<button class="return-btn" v-else>提交认证</button>
					</view>
				</view>	
			</view>	
		</uni-popup>
	</view>
</template>

<script>
	import {UniPopup} from 'components/uni/uni-popup/uni-popup'
	import {ApplyYjSelect,ApplyCashwhere,GetRealnameauthentication} from 'api/user'
	export default{
		components:{
			UniPopup
		},
		data(){
			return{
				data:{},
				load:false,
				show:false,
				realname:'',
				idcard:'',
				baseUrl:this.$store.state.SRC+'/config/app'
			}
		},
		methods:{
			close(e){
				this.show = e.show
			},
			open(url){
				ApplyCashwhere().then(res=>{
					if(res.result){
						uni.navigateTo({
							url:url
						})
					}else{
						this.show = true
					}
				})
				
			},
			save(){
				GetRealnameauthentication({
					idcard:this.idcard,
					realname:this.realname
				}).then(res=>{
					if(res.result){
						uni.navigateTo({
							url:'/pages/user/distribution/applycash'
						})
					}else{
						uni.showToast({
							title:res.msg,
							icon:'none'
						})
					}
				})
			}
		},
		onLoad() {
			ApplyYjSelect().then(res=>{
				if(res.result){
					this.data = res
					this.load = true
				}
			})
		}
	}
</script>

<style scoped>
	.main{
		padding: 10px;
	}
	.main-padding{
		padding: 20px 20px 10px 20px;
	}
	.bg{
		width: 100%;
		height:195px;
		background:linear-gradient(135deg,rgba(243,95,95,1),rgba(252,194,105,1));
		border-radius:8px;
		font-size: 12px;
		color:#fff;
	}
	.btn{
		display: flex;
		justify-content: space-between;
		font-size: 30px;
		font-weight: 500;
		margin-top: 20px;
	}
	.btn button{
		margin: 0;
		height: 36px;
		line-height: 36px;
		border-radius: 18px;
		background: #fff;
		color:#FF3B30;
		font-weight: 400;
		font-size: 16px;
	}
	.look{
		margin-top: 10px;
		font-size: 14px;
		font-weight:500;
	    text-decoration:underline;
	}
	.top-list{
		display: flex;
		margin-top: 20px;
	}
	.top-item{
		width: 50%;
	}
	.number{
		font-size: 16px;
		font-weight: 500;
		margin-top: 10px;
	}
	.middle{
		background:rgba(255,255,255,1);
		border-radius:8px;
		margin-top: 10px;
		text-align: center;
	}
	.middle-list{
		display: flex;
		padding-top: 10px;
	}
	.middle-item{
		width: calc(100% / 3);
	}
	.middle-text{
		font-size:12px;
		color:rgba(136,136,136,1);
		margin-top: 10px;
	}
	.detail{
		padding: 17px;
		font-size:14px;
		color:#ff663d;
	}
	.bottom{
		padding: 20px;
		background: #fff;
		border-radius: 8px;
		margin-top: 10px;
	}
	.bottom-title{
		font-size:16px;
		font-weight:500;
		color:rgba(26,26,26,1);
	}
	.bottom-item{
		font-size: 14px;
		color:#888;
		margin-top: 17px;
	}
	.content-box{
		width: 280px;
		background: #fff;
		position: relative;
		border-radius: 12px;
		overflow: hidden;
	}
	.title{
		text-align: center;
		padding: 15px 30px 10px 30px;
		font-size: 16px;
		font-weight: 500;
		color: #2F3133;
		line-height: 1;
	}
	.popup-list{
		padding: 0 15px 15px 15px;
	}
	.popup-item{
		display: flex;
		font-size: 14px;
		color: #888;
		line-height: 42px;
	}
	.item-text{
		width: 90px;
		text-align: right;
		margin-right: 5px;
	}
	.close-image{
		width: 14px;
		height: 14px;
		position: absolute;
		right: 15px;
		top: 15px;
	}
	input{
		height: 30px;
		line-height: 30px;
		padding: 6px;
	}
	.save-btn{
		display: flex;margin-top: 10px;justify-content: center;
	}
	.return-btn{
		padding: 10px 14px;
		line-height: 1;
		margin: 0 10px;
		font-size: 14px;
	}
	.main-btn{
		background: #ff663d;
		color:#fff;
	}
</style>
