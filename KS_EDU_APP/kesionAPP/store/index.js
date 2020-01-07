import Vue from 'vue'
import Vuex from 'vuex'
import {
	GetUserInfo,Login,GetMiniProgramOpenID,GetIsVerify 
} from '../api/user'

Vue.use(Vuex)
const store = new Vuex.Store({
	state: {
		siteName:'科汛课堂',
		isLogin: 0,
		userInfo: {
		},
		appToken:'',
		userId:'',
		readyStatus:false,
		schoolId:'',
		model:[],
		wechatOpenID:'',
		SRC:'https://e.kesion.com',
		isshowprice:true,
		versionNum:'3.2',
		//APP是否开启缓存
		isCache:false
	},
	mutations: {
		/**
		 * 设置状态
		 */
		setState(state,data = {}){
			let keys = Object.keys(data)
			keys.map(k=>{
				state[k] = data[k]
			})
		},
		updateUserInfo(state,data){
			state.isLogin = data.UserID > 0 ? 1 : 0,
			data.UserFace = data.UserFace+'?'+Math.ceil(Math.random()*9999999999)
			state.userInfo = data;
			state.appToken = data.ApiToken || '';
			state.userId = data.UserID || '' ;
			state.schoolId = data.SchoolID||''
			state.readyStatus = true
		}
	},
	actions: {
		/**
		 * 获取用户信息
		 */
		getUserInfo({ commit }) {
			return new Promise(resolve=>{
				GetUserInfo().then(res=> {
				  var data = res.data[0] || {}
				  commit('updateUserInfo',data)
				  resolve()
				});
			})
		},
		/**
		 * 获取微信小程序当前用户的openID
		 */
		getWechatOpenID(){
			return new Promise(resolve=>{
				// #ifdef  MP-WEIXIN
				if(this.state.wechatOpenID){
					resolve(this.state.wechatOpenID)
				}else{
					uni.login({
						provider: 'weixin',
						success:loginRes=>{
							if(loginRes.code){
								GetMiniProgramOpenID({
									code:loginRes.code
								}).then(res=>{
									if(res.openId){
										store.commit('setState',{
											wechatOpenID:res.openId
										})
										resolve(res.openId)
									}else{
										resolve('unableget')
									}
									
								})
							}
						}
					})
				}
				// #endif
			})
		},
		/**
		 * 账号登陆
		 */
		login(store,data = {}){
			return new Promise(resolve=>{
				store.commit('setState',{
					readyStatus:false
				})
				let params = false
				
				if(data.username && data.password){
					params = data
				}else{
					/** 已存储用用户名、密码，自动登录获取apptoken*/
					if(uni.getStorageSync('userName') && uni.getStorageSync('passWord')){
						params = {
							username:uni.getStorageSync('userName'),
							password:uni.getStorageSync('passWord')
						}
					}
				}
				if(params){
					Login(params).then(res=>{
						store.dispatch('getIsVerify').then(()=>{
							if(res.result){
								uni.setStorageSync('userName',params.username)
								uni.setStorageSync('passWord',params.password)
								store.commit('updateUserInfo',res.data[0])
							}else{
								store.commit('updateUserInfo',{})
							}
							resolve(res)
						})
					})
				}else{
					store.dispatch('getIsVerify').then(()=>{
						store.commit('updateUserInfo',{})
					})
					
				}
			})
		},
		getIsVerify(store){
			return new Promise(resolve=>{
				GetIsVerify({
					
				}).then(res=>{
					store.commit('setState',{
						isCache:res.iscache,
					})
					// #ifdef MP-WEIXIN
					store.commit('setState',{
						isshowprice:res.isshowprice
					})
					// #endif
					
					// #ifdef APP-PLUS
					store.commit('setState',{
						isshowprice:res.isappverify
					})
					// #endif
					resolve()
				})
			})
		},
		/**
		 * 账号退出
		 */
		loginout(){
			return new Promise(resolve=>{
				uni.setStorageSync('userName','')
				uni.setStorageSync('passWord','')
				store.commit('updateUserInfo',{})
				resolve()
			})
		}
	}
})
store.dispatch('login')

/**
 * 添加ready事件
 */
store.ready = function(callback) {
    if (this.state.readyStatus) {
        callback(this.state)
    } else {
        setTimeout(() => {
            this.ready(callback)
        }, 100)
    }
}

export default store