import Vue from 'vue'
import OrderPay from './OrderPay'
let OrderPayInstance;

function createOrderPayInstance() {
    if (!OrderPayInstance) {
        const OrderPayConstructor = Vue.extend(OrderPay)
        OrderPayInstance = new OrderPayConstructor()
        OrderPayInstance.$mount(document.createElement('div'))
        document.body.appendChild(OrderPayInstance.$el)
    }
}
OrderPay.showPay = function (payInfo = {}) {
    // let u = navigator.userAgent;
    // let isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
    // if (window.__wxjs_environment === 'miniprogram' && isIOS) {
    //     this.$alert('十分抱歉，由于相关规范，您暂时无法使用支付功能。',{
    //         title:'暂不支持',
    //         sureButtonText:'好的'
    //     });
    //     return
    // }
    createOrderPayInstance();
    let type = null;
    switch (payInfo.type) {
        case 'course':
        case 'faceTeach':
            type = 0
            break
        case 'class':
            type = 1
            break
        case 'recharge':
            type = 2
            break
        case 'examReward':
            type = 3
            break
        case 'courseReward':
            type = 4
            break
        case 'exam':
            type = 5
            break
        case 'classReward':
            type = 6
            break
        case 'column':
            type = 7
            break
        case 'columnReward':
            type = 8
            break
        case 'vipCard':
            type = 9
            break
        case 'group':
            type = 10
            break
        case 'data':
            type = 11
            break
        case 'activity':
            type = 12
            break
        case 'vipsvip':
            type = 16
            break
    }

    if (type === null) {
        alert('当前内容不在可支付的范围内！')
        return false
    }

    payInfo.type = type
    if (type === 12) {
        OrderPayInstance.pay(payInfo)
    } else if (type === 3 || type === 4 || type === 6 || type === 8) {
        /**打赏 */
        OrderPayInstance.reward(payInfo)
    } else {
        /**其他支付（课程、班级、专栏等） */
        OrderPayInstance.updateData(payInfo).then(() => {
            OrderPayInstance.show = true
        })

    }
}
OrderPay.hidePay = function () {
    if (OrderPayInstance) {
        OrderPayInstance.show = false
        OrderPayInstance.resetData()
    }
}

OrderPay.pay = function (payInfo) {
    createOrderPayInstance();
    OrderPayInstance.pay(payInfo)
}

export default OrderPay