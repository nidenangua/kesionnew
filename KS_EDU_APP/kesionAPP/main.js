import Vue from 'vue'
import App from './App'
import store from './store'
import plv from './lib/polyv/index'
/**
 * 共用组件安装
 */
import box from './components/ks-components/box/Box'
import image from './components/ks-components/image/Image'
import empty from './components/ks-components/empty/empty'
import tabs from './components/ks-components/tabs/tabs'
import cellGroup from './components/ks-components/cell-group/cell-group'
import cell from './components/ks-components/cell/cell'
import pageScroller from './components/ks-components/page-scroller/page-scroller'
Vue.component('ks-box',box)
Vue.component('ks-image',image)
Vue.component('ks-empty',empty)
Vue.component('ks-tabs',tabs)
Vue.component('ks-cell-group',cellGroup)
Vue.component('ks-cell',cell)
Vue.component('ks-page-scroller',pageScroller)
Vue.config.productionTip = false

plv.setApp({
  apiId: 'eiocqzvc0r',
  apiSecret: 'eb844f69cea740a68475205e2304009a'
});
Vue.prototype.$plvInit = function(options){
	return plv.init(options);
}
Vue.prototype.$plvDestory = function(){
	plv.destory();
}
/**
 * 处理链接地址
 * @param {String} src 链接地址
 */
Vue.prototype.$handleSrc = function(src){
	switch(src.indexOf('//')){
		case 0:
		case 5:
		case 6:
			return src
			break
		default:
			return store.state.SRC + src
	}
}

/**
 * 信息提示
 * @param {String} msg
 * @param {String} type
 */
Vue.prototype.$msg = function(msg,type){
	return new Promise(resolve=>{
		if(type == 'success'){
			uni.showToast({
			    title: msg,
			    icon:'success'
			})
		}else{
			uni.showToast({
			    title: msg,
			    icon:'none'
			})
		}
		
		setTimeout(()=>{
			resolve()
		},1500)
	})
}

App.mpType = 'app'
const app = new Vue({
    ...App,
	store
})
app.$mount()
export default app

