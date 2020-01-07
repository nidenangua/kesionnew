import Vue from 'vue';
import LoginQrcode from './LoginQrcode';
let LoginQrcodeInstance;
LoginQrcode.showLogin = function(params) {
    if (!LoginQrcodeInstance) {
        const LoginQrcodeController = Vue.extend(LoginQrcode);
        LoginQrcodeInstance = new LoginQrcodeController();
        LoginQrcodeInstance.$mount(document.createElement('div'));
        document.body.appendChild(LoginQrcodeInstance.$el);
    }
    LoginQrcodeInstance.update(params)
}

export default LoginQrcode