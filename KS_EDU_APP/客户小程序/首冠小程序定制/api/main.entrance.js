
import store from '../store'
function getStore(){
	return new Promise(resolve=>{
		if(typeof store === 'object'){
			resolve(store)
		}else{
			setTimeout(()=>{
				getStore().then(store=>{
					resolve(store)
				})
			},100)
		}
	})
}
function loginVerification(res){
	if(res.data.msg && (res.data.msg === '无效apptoken' || res.data.msg.indexOf('请先登录') !== -1)){
		uni.hideLoading()
		store.dispatch('loginout').then(()=>{
			uni.showModal({
				title:'提示',
				content:'您的账户未登陆，或在异地登陆，请重新登陆！',
				success:res=>{
					if(res.confirm){
						uni.navigateTo({
							url:'/pages/user/login/index'
						})
					}
				}
			})
		})
	}else{
		return true
	}
}
export function GET(url,params = {},defultParams){
	return new Promise((resolve,reject)=>{
		getStore().then(store=>{
			//from有的地方传的不是student
			if(params.from === ''){
				params.from = 'student';
			}
			params.version = store.state.versionNum;
			if(typeof defultParams === 'object'){
				store.ready(state=>{
					
					if(defultParams.indexOf('userId')!= -1){
						params.userid = state.userId	
					}
					if(defultParams.indexOf('appToken')!= -1){	
						params.apptoken = state.appToken
					}
	
					uni.request({
						url:state.SRC+url,
						method:'GET',
						sslVerify:false,
						data:params,
						success(res){
							if(loginVerification(res)){
								resolve(res.data)
							}
						},
						fail(err){
							reject(err)
						}
					})
				})	
			
			
			}else{
				uni.request({
					url:store.state.SRC+url,
					method:'GET',
					data:params,
					sslVerify:false,
					success(res){
						if(loginVerification(res)){
							resolve(res.data)
						}
					},
					fail(err){
						reject(err)
					}
				})
			}
		})
	})
}

export function POST(url,params = {},defultParams){
	return new Promise((resolve,reject)=>{
		getStore().then(store=>{
			if(params.from === ''){
				params.from = 'student';
			}
			params.version = store.state.versionNum;
			if(typeof defultParams === 'object'){
				store.ready(state=>{
		
					if(defultParams.indexOf('userId')!= -1){
						params.userid = state.userId
					}
					if(defultParams.indexOf('appToken')!= -1){	
						params.apptoken = state.appToken
					}
					uni.request({
						url:state.SRC+url,
						method:'POST',
						sslVerify:false,
						data:params,
						success(res){
							if(loginVerification(res)){
								resolve(res.data)
							}
						},
						fail(err){
							reject(err)
						}
					})
				})	
			
			}else{
				uni.request({
					url:store.state.SRC+url,
					method:'POST',
					sslVerify:false,
					data:params,
					success(res){
						if(loginVerification(res)){
							resolve(res.data)
						}
					},
					fail(err){
						reject(err)
					}
				})
			}	
		})
	})
}