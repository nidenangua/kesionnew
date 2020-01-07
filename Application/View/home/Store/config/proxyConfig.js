module.exports = {
    proxy: {
        '/': { //将www.exaple.com印射为/apis
            target: 'https://ks.zuojy.com/', // 接口域名
            secure: true, // 如果是https接口，需要配置这个参数
            changeOrigin: true, //是否跨域
            pathRewrite: {
                '^/': '/' //需要rewrite的,
            }
        }
    }
}