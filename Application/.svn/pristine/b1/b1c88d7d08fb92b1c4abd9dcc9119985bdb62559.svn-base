import Vue from 'vue'
import OrderPay from './OrderPay';
let OrderPayInstance;

function createInstance() {
    if (!OrderPayInstance) {
        const OrderPayController = Vue.extend(OrderPay);
        OrderPayInstance = new OrderPayController();
        OrderPayInstance.$mount(document.createElement('div'));
        document.body.appendChild(OrderPayInstance.$el);
    }
}
OrderPay.showPay = function(params) {
    createInstance();
    OrderPayInstance.update(params)
}
OrderPay.order = function(params = {}) {
    createInstance();
    params.step = 2;
    OrderPayInstance.resetData(params);
    OrderPayInstance.sure()
}
OrderPay.pay = function(qrcode, ordersn, price) {
    return new Promise(resolve=>{
        createInstance();
        OrderPayInstance.resetData({
            step: 2,
            price: price,
            success:function(){
                resolve()
            }
        });
        OrderPayInstance.showPayQrCode(qrcode, ordersn)
    })
}
export default OrderPay