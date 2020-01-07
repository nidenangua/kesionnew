/**
 * 我的订单
 */
(function(){
    new Vue({
        el: '#app',
        data: {
            list:[],
            page:1,
            pageCount:1,
            payStatus:-1
        },
        methods:{
            /**
             * 获取订单列表
             */
            getList:function(page){
                this.$showLoading()
                var _page = page || 1;
                var _this = this;
                getOrderList({
                    p:_page,
                    maxperpage:10,
                    paystatus:this.payStatus
                }).then(function(res){
                    _this.list = res.values
                    _this.pageCount = res.page.total_pages
                    _this.$hideLoading()
                })
            },
            /**
             * 支付
             */
            pay:function(url){
                location.href=url
            },
            /**
             * 确认申请退款
             */
            confirmsure:function(){
               
                if(!this.tel.replace(/\s+/g, "").length){
                    this.$toast('手机号不能为空')
                    this.$refs.tel.focus()
                    return false
                }else if(!isPoneAvailable(this.tel)){
                    this.$toast('请输入正确的手机号')
                    this.$refs.tel.focus()
                    return false
                }else if(!this.wechat.replace(/\s+/g, "").length){
                    this.$toast('微信号不能为空')
                    this.$refs.wechat.focus()
                    return false
                }
                var _this = this
                refundOrder({
                    ordersn:this.sn,
                    wxnum:this.wechat,
                    phone:this.tel
                }).then(function(res){
                    if(res.errCode==200){
                        _this.$toast('申请退款成功','success')
                        _this.list[_this.tuikuanindex].paystatus = 3
                        
                    }else{
                        _this.$toast(res.msg)
                    }
                })

            },
            /**
             * 确认删除
             */
            delsure:function(index,sn){
                var _this = this
                deleteOrder({
                    ordersn:sn
                }).then(function(res){
                    if(res.result === 'success'){
                        _this.$toast(res.msg,'success')
                        _this.list.splice(index,1);
                    }
                    
                })
                
            },
            /**
             * 删除订单
             */
            delorder:function (index,sn) { 
                if(confirm('确定要删除该订单吗？')){
                    this.delsure(index,sn)
                }
                
            },
            tabClick:function(v){
                this.payStatus = v
                this.getList()
            },
            open:function(url){
                location.href = url
            }
            
        },
        mounted:function(){
            this.getList()
        }
    })
})()