<template>
	<view>
		<view class="user-list">
			<view class="user-item flex-box__space">
				<text>头像</text>
				<ks-image radius="50%" class="ks-image" type="user" :src="photoUrl" @click="changeAvatar"></ks-image>	
			</view>
			<view class="user-item flex-box__space">
				<text>姓名</text>
				<input style="text-align: right;" v-model="userInfo.RealName" placeholder="点击填写" @blur="save" />
			</view>
			<view class="user-item flex-box__space">
				<text>性别</text>
					<view class="flex-box" @click="showPicker">
						<text>{{pickerText.label}}</text>
						<image :src="baseUrl+'/static/images/my/me_icon_more@2x.png'"></image>
					</view>
			</view>
			<view class="user-item flex-box__space">
				<text>电子邮箱</text>
				<input style="text-align: right;" v-model="userInfo.Email" placeholder="点击填写" @blur="save" />
			</view>
			<view class="user-item flex-box__space">
				<text>所在地区</text>
				<view class="flex-box" @click="showMulLinkageThreePicker">
					<text>{{pickerCityText.name}}</text>
					<image :src="baseUrl+'/static/images/my/me_icon_more@2x.png'"></image>
				</view>	
			</view>
		</view>
		<mpvue-city-picker :themeColor="themeColor" ref="mpvueCityPicker" :pickerValueDefault="cityPickerValueDefault"
		    @="" @onConfirm="onCityConfirm"></mpvue-city-picker>
		<mpvue-picker :themeColor="themeColor" ref="mpvuePicker" mode="selector" :deepLength="1" :pickerValueDefault="pickerValueDefault"
		         @onConfirm="onConfirm" @="" :pickerValueArray="pickerValueArray"></mpvue-picker>				
	</view>
</template>

<script>
	import {KsImage} from 'components/ks-components/image/Image'
	import {MpvuePicker} from 'components/uni/mpvue-picker/mpvue-picker'
	import {MpvueCityPicker} from 'components/uni/mpvue-citypicker/mpvue-citypicker'
	import {SaveUesrBasicInfo} from 'api/user'
	export default {
		components:{
			KsImage,
			MpvuePicker,
			MpvueCityPicker
		},
		data() {
			return {
				email:'',
				photoUrl:'',
				pickerText:{
					label:'请选择'
				},
				pickerCityText:{
					name:'请选择'
				},
				cityPickerValueDefault: [0, 0, 1],
				themeColor: '#ff663d',
				pickerValueDefault:[1],
				pickerValueArray:[
					{
						label: '男',
                        value: '男',
					},{
						label: '女',
                        value: '女',
				}],
				userInfo:{},
				state:{},
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		onShow() {
			this.$store.ready(state=>{
				this.state=state
				this.userInfo = state.userInfo
		
				if(this.userInfo.province && this.userInfo.city && this.userInfo.county){
					this.pickerCityText.name = this.userInfo.province + '-'+this.userInfo.city+'-'+this.userInfo.county
				}
				this.pickerCityText.ids = [this.userInfo.ProID,this.userInfo.CityID,this.userInfo.CountyID]
				if(this.userInfo.Sex){
					this.pickerText.label = this.userInfo.Sex
				}
				this.userInfo.RealName = this.userInfo.RealName?this.userInfo.RealName:""
				this.photoUrl = this.userInfo.UserFace+'?'+Math.ceil(Math.random() * 9999999999)
			})
		},
		methods: {
			save(){
				SaveUesrBasicInfo({
					email:this.userInfo.Email,
					realname:this.userInfo.RealName,
					sex:this.pickerText.label,
					provinceid:this.pickerCityText.ids[0]||null,
					cityid:this.pickerCityText.ids[1]||null,
					countyid:this.pickerCityText.ids[2]||null,
				}).then(res=>{
					if(res.result){
						this.$store.dispatch('getUserInfo').then(()=>{
							this.$store.ready(state=>{
								this.userInfo = state.userInfo
			
							})
						})
					}else{
						uni.showToast({
							title: res.msg,
							icon:'none'
						});
						this.$store.ready(state=>{
							this.userInfo = state.userInfo
						})
					}
				})
			},
		    /** 选择头像*/
		    changeAvatar() {
				uni.chooseImage({
				    count: 1, //默认9
				    sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
				    sourceType: ['album'], //从相册选择
				    success: res=> {

						var tempFilePaths = res.tempFilePaths;
						var uploadTask = uni.uploadFile({
						    url : this.state.SRC+'/webapi/user/ModifyUserFace',
						    filePath: tempFilePaths[0],
						    name: 'file',
						    formData: {
								userid: this.userInfo.UserID,
								apptoken:this.userInfo.ApiToken
						    },
						    success: response=> {
					
								var data = JSON.parse(response.data)
								if(data.result){
									this.photoUrl = data.userface+'?'+Math.ceil(Math.random() * 9999999999)
									this.$store.dispatch('getUserInfo').then(()=>{
										this.$store.ready(state=>{
											this.userInfo = state.userInfo
										})
									})
								} else {
									uni.showToast({
										title: '修改头像失败',
										icon:'none'
									});
								}
						    }
						})
				    }
				});
		    },
		   
			onCityConfirm(e) {
			    this.pickerCityText = e
				this.save()
			},
			onConfirm(e) {

			    this.pickerText = e
				this.save()
			},
			showMulLinkageThreePicker() {
			    this.$refs.mpvueCityPicker.show()
			},
			showPicker(){
				this.$refs.mpvuePicker.show()
			}
		}
	}
</script>

<style scoped>
	.user-list{
		background: #fff;
	}
	.user-item{
		padding:14px 10px 14px 15px;
		font-size:16px;
		color:rgba(26,26,26,1);
		border-top: 1px solid #eee;
	}
	.user-item image{
		width:15px;
		height:15px;
	}
	.user-item .ks-image{
		width:50px;
		height:50px;
		border-radius: 50%;
		overflow: hidden;
	}
</style>
