return {

    data: function() {
        /**表单验证 */
        /**姓名验证 */
        var checkName = function(rule, value, callback) {
                var reg = /^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,5}$/
                if (!reg.test(value)) {
                    return callback(new Error('请输入2-5字中文姓名'));
                } else {
                    callback()
                }
            }
            /**银行名称验证 */
        var checkBank = function(rule, value, callback) {
                if (value == '') {
                    callback(new Error('请输入银行名称'))
                } else {
                    callback()
                }
            }
            /**银行卡号验证 */
        var checkAccount = function(rule, value, callback) {
            if (value == '') {
                callback(new Error('请输入银行卡号'))
            } else {
                callback()
            }
        }
        return {
            state: store.state,
            userInfo: {},
            /**搜索关键字 */
            keyWord: "",
            key: "",
            /**选择器选项 */
            /**当前选中项 */
            activeName: 'first',
            /**课程订单数据列表 */
            courseOrderList: [],
            /**商城订单 */
            shopOrderList: [],
            /**我的拼团数据列表 */
            assembleList: [],
            /**选择器选项 */
            /**筛选参数 -1全部订单,2三个月内的订单,*/
            statusCourseList: [{
                value: -1,
                label: '全部订单'
            }, {
                value: 0,
                label: '未付款'
            }, {
                value: 1,
                label: '已付款'
            }, {
                value: 2,
                label: '三个月内'
            }],
            statusCourse: -1,
            /**筛选参数 0全部订单,2三个月内的订单,-2待付款,-3待收货,-4退换货*/
            statusList: [{
                value: 0,
                label: '全部订单'
            }, {
                value: 2,
                label: '三个月内'
            }, {
                value: -2,
                label: '待付款'
            }, {
                value: -3,
                label: '待收货'
            }, {
                value: -4,
                label: '退换货'
            }],
            status: 0,
            /**拼团筛选 */
            groupStatusList: [{
                value: 0,
                label: '全部拼团'
            }, {
                value: 1,
                label: '进行中'
            }, {
                value: 2,
                label: '已成功'
            }, {
                value: 3,
                label: '未成功'
            }],
            groupStatus: 0,
            /**砍价筛选 */
            bargainStatusList: [{
                value: 0,
                label: '全部砍价'
            }, {
                value: 1,
                label: '已成功'
            }, {
                value: 2,
                label: '进行中'
            }, {
                value: 3,
                label: '已失效'
            }, {
                value: 4,
                label: '未支付'
            }],
            bargainStatus: 0,
            /**选择器选项 */
            typeList: [],
            /**选择器默认值 */
            type: 1,
            condition: 1,
            /**课程页数 */
            coursePageCount: null,
            /**商城页数 */
            shopOrderPageCount: null,
            /**拼团页数 */
            assemblePageCount: null,
            currentPage: 1,
            /**列表与详情,评价开关 ， 0列表，1详情，2评价 */
            visible: 0,
            /**订单详情数据 */
            orderDetail: {},
            /**退款表单数据 */
            form: {
                bank: '',
                account: '',
                name: ''
            },
            /**表单验证 */
            rules: {
                bank: [
                    { required: true, validator: checkBank, trigger: 'blur' }
                ],
                name: [
                    { required: true, validator: checkName, trigger: 'blur' }
                ],
                account: [
                    { required: true, validator: checkAccount, trigger: 'blur' }
                ],
            },
            refundDetail: {},
            /**商城退款会话开关 */
            shopDialogVisible: false,
            /**课程退款会话开关 */
            courseDialogVisible: false,
            /**单选框 */
            radio: '1',
            /**富文本内容 */
            content: '',
            /**订单详情，1课程详情，2商品详情 */
            detailType: 1,
            /**文件地址列表 */
            fileUrlList: [],
            /**默认支付方式 -1 余额 */
            activePay: -1,
            /**支付数据 */
            initPayData: {},
            /**id */
            id: 0,
            payId: '0',
            /**支付方式 */
            paymentList: [],
            /**余额支付金额 */
            money: 0,
            /**商品价格 */
            price: 0,
            /**支付框开关 */
            payDialogVisible: false,
            /**评价数据 */
            commentData: {},
            /**星级 */
            star: 0,
            /**评价内容 */
            textarea: '',
            /**订单id */
            orderId:'',
            showMall:false,
            /**砍价 */
            bargainOrderList:[],
            bargainPageCount:null,
            /**试卷 */
            paperOrderList:[],
            paperPageCount:null,
            paperFlag:0,
            paperFlagList:[{
                value: 0,
                label: '资金购买'
            },{
                value: 1,
                label: '点券购买'
            },{
                value: 2,
                label: '积分购买'
            }]
        }
    },
    watch: {
        'money': function(money) {
            if (money - this.price >= 0) {
                this.money = this.price
                this.activePay = -1
                this.payId = 0
            }
            if (money - this.userInfo.Money > 0) {
                this.money = this.userInfo.Money
            }
            if (this.price > this.userInfo.Money) {
                if (this.activePay == -1) {
                    this.activePay = 0
                    this.money = 0
                    this.payId = this.paymentList[0].payid
                }
            }
        },
    },
    methods: {
        /**打开支付页面 */
        openPay: function(item) {
         
            this.payDialogVisible = true
            var that = this
            this.id = item.id
            if (this.activeName == 'first') {
                InitialUserPayCourse({
                    id: item.id,
                    apptoken: that.state.appToken
                }).then(function(res) {

                    if (res.result == true) {
                        that.initPayData = res.data
                        that.price = that.initPayData.ordertotalprice
                        that.money = that.initPayData.ordertotalprice
                        that.paymentList = res.data.payment_list
                    } else {
                        that.$message.error(res.msg)
                    }
                })
            } else if (this.activeName == 'second') {
                InitialUserPayShop({
                    id: item.id,
                    apptoken: that.state.appToken
                }).then(function(res) {

                    if (res.result == true) {
                        that.initPayData = res.data
                        that.price = that.initPayData.orderprice
                        that.money = that.initPayData.orderprice
                        that.paymentList = res.data.payment_list
                    } else {
                        that.$message.error(res.msg)
                    }
                })
            }

        },
        /**选择支付类型 */
        payType:function(i) {
            this.activePay = i
            if (i == -1) {
                this.payId = '0'
                this.money = this.initPayData.orderprice
                console.log(this.money)
            } else {
                this.money = 0
                this.payId = this.paymentList[i].payid
            }
        },
        /**支付 */
        pay: function() {
            var that = this
            if (this.activeName == 'first') {
                DoUserPayCourse({
                    id: this.id,
                    payid: this.payId,
                    user_pay_money: this.money,
                    apptoken: this.state.appToken
                }).then(function(res) {
                    if (that.activePay == -1) { /**余额支付 */
                        if (res.result == true) {
                            that.$message.success('购买成功')
                            that.getUserCourseOrderList()
                            that.payDialogVisible = false
                        } else {
                            that.$message.error(res.msg)
                        }
                    } else { /**其他支付 */
                        if (res.result == true) {
                            location.href = res.payurl
                        } else {
                            that.$message.error(res.msg)
                        }
                    }
                })
            } else if (that.activeName == 'second') {
                DoUserPayShop({
                    id: this.id,
                    payid: this.payId,
                    user_pay_money: this.money,
                    apptoken: this.state.appToken
                }).then(function(res) {
                    if (that.activePay == -1) { /**余额支付 */
                        if (res.result == true) {
                            that.$message.success('购买成功')
                            that.getUesrShopOrderList()
                            that.payDialogVisible = false
                        } else {
                            that.$message.error(res.msg)
                        }
                    } else { /**其他支付 */
                        if (res.result == true) {
                            location.href = res.payurl
                        } else {
                            that.$message.error(res.msg)
                        }
                    }
                })
            }
        },

        /**搜索框，选择框,标签页回调 */
        change: function() {
            if (this.activeName == 'first') {
                this.getUserCourseOrderList()
            } else if (this.activeName == 'second') {
                this.getUesrShopOrderList()
            } else if (this.activeName == 'third') {
                this.getUserGroupOrderList()
            }else if (this.activeName == 'four') {
                this.getUserBargainOrderList()
            }else if (this.activeName == 'five') {
                this.getUserPaperOrderList()
            }
        },
        /**跳转页面
         * @params string
         */
        open: function(url) {
            location.href = url
        },
        /**请求试卷订单数据列表
         *  p:页数
         */
        getUserPaperOrderList: function(p) {
            p = p || 1
            var that = this
            // this.$showLoading('#userRight')
            that.paperOrderList = []
            this.currentPage = p
            GetUserPaperOrderList({
                flag:this.paperFlag,
                page: p,
                pagesize: 5,
                apptoken: that.state.appToken
            }).then(function(res) {
                // that.$hideLoading('#userRight')
                that.paperPageCount = res.pagecount * 10
                if (res.result == true) {
                    that.paperOrderList = res.data
                }
        
            })
        },
        /**请求砍价订单数据列表
         *  p:页数
         */
        getUserBargainOrderList: function(p) {
            p = p || 1
            var that = this
            // this.$showLoading('#userRight')
            that.bargainOrderList = []
            this.currentPage = p
            GetUserBargainList({
                showstatus:this.bargainStatus,
                page: p,
                pagesize: 5,
                apptoken: that.state.appToken
            }).then(function(res) {
                // that.$hideLoading('#userRight')
                that.bargainPageCount = res.pagecount * 10
                if (res.result == true) {
                    that.bargainOrderList = res.data
                }
        
            })
        },
        /**请求课程订单数据列表
         *  p:页数
         */
        getUserCourseOrderList: function(p) {
            p = p || 1
            var that = this
            // this.$showLoading('#userRight')
            that.courseOrderList = []
            this.currentPage = p
            GetUserCourseOrderList({
                show: that.statusCourse,
                condition: that.type,
                key: that.key,
                page: p,
                pagesize: 5,
                apptoken: that.state.appToken
            }).then(function(res) {
                // that.$hideLoading('#userRight')
                that.coursePageCount = res.pagecount * 10
                if (res.result == true) {
                    that.courseOrderList = res.data
                }
             
            })
        },
        /**请求商城订单列表
         *  p:页数
         */
        getUesrShopOrderList: function(p) {
            p = p || 1
            var that = this
            // this.$showLoading('#userRight')
            that.shopOrderList = []
            this.currentPage = p
            GetUesrShopOrderList({
                show: that.status,
                condition: 1,
                key: that.keyWord,
                page: p,
                pagesize: 5,
                apptoken: that.state.appToken
            }).then(function(res) {

                // that.$hideLoading('#userRight')
                that.shopOrderPageCount = res.pagecount * 10
                if (res.result == true) {
                    that.shopOrderList = res.data
                }
            })
        },
        /**拼团订单列表
         *  p:页数
         */
        getUserGroupOrderList: function(p) {
            p = p || 1
            var that = this
            // this.$showLoading('#userRight')
            that.assembleList = []
            this.currentPage = p
            GetUserGroupOrderList({
                showstatus: that.groupStatus,
                page: p,
                pagesize: 5,
                apptoken: that.state.appToken
            }).then(function(res) {

                // that.$hideLoading('#userRight')
                that.assemblePageCount = res.pagecount * 10
                if (res.result == true) {
                    that.assembleList = res.data
                }
            })
        },
        /**打开商城订单详情
         *  
         */
        getUesrShopOrderDetail: function(item) {
            this.detailType = 2
            this.visible = 1
            var that = this
            GetUesrShopOrderDetail({
                id: item.id,
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.orderDetail = res.data
                }
            })
        },
        /**打开课程订单详情页
         *  item:打开的订单
         */
        getUserCourseOrderDetail: function(item) {
            this.detailType = 1
            var that = this
            this.visible = 1
   
            GetUserCourseOrderDetail({
                id: item.id,
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.orderDetail = res.data
                } else {
                    that.$message.error(res.msg)
                }
            })
        },
        /**商城订单申请退款
         *  item
         */
        returnUserShopOrder: function(item) {
            var that = this
            that.fileUrlList = []
            that.refundDetail = {}
            ReturnUserShopOrder({
                id: item.id,
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.refundDetail = res.data
                    that.shopDialogVisible = true
                } else {
                    that.$message.error(res.msg)
                }
            })
        },
        /**上传图片
         *  
         */
        upload: function() {
            this.$refs.file_image.click()
        },
        uploadImage: function() {
            var that = this
            var file = that.$refs.file_image.files[0];
            var infoFormData = new FormData();
            infoFormData.append('file', file)
            infoFormData.append('apptoken', that.appToken)
            UploadFile(infoFormData).then(function(res) {
                if (res.result == true) {
                    that.fileUrlList.push(res.fileUrl)
                } else {
                    that.$message.error(res.msg)
                }
            })
        },
        /**删除照片 */
        delPhoto:function(item){
            this.fileUrlList.splice(this.fileUrlList.indexOf(item),1)
            console.log(this.fileUrlList)
            
        },
        /**保存商城订单申请退款
         *  
         */
        saveReturnUserShopOrder: function(item) {
            var that = this
            that.$refs.form.validate(function(valid) {
                if (valid == true) {
            SaveReturnUserShopOrder({
                id: item.id,
                flag: item.flag,
                reason: that.content,
                moneytype: that.radio,
                moneyreturnbankcard: that.form.bank,
                moneyreturnbankname: that.form.name,
                moneyreturncardname: that.form.account,
                files: that.fileUrlList.join('§'),
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.$store.dispatch("updateUserInfo").then(function() {
                        that.$message.success('提交成功')
                        that.shopDialogVisible = false
                    })
                } else {
                    that.$message.error(res.msg)
                }

            })
        }
    })
        },
        /**商城订单再次购买
         *  
         */
        reBuyUserShop: function(item) {
            var that = this
            ReBuyUserShop({
                orderid: item.id,
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    location.href = res.url
                } else {
                    that.$message.error(res.msg)
                }
            })
        },
        /**打印订单
         *  item
         */
        printOrder: function() {
            window.print();
            // this.$print(document.getElementById('print'))
        },
        /**课程订单申请退款
         *  item
         */
        returnUserCourseOrder: function(item) {
            var that = this
            that.refundDetail = {}
            ReturnUserCourseOrder({
                id: item.id,
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.refundDetail = res.data
                    that.courseDialogVisible = true
                } else {
                    that.$message.error(res.msg)
                }
            })
        },
        /**课程订单退款提交
         *  item
         */
        saveReturnUserCourseOrder: function(item) {
            var that = this
            that.$refs.form.validate(function(valid) {
                if (valid == true) {
            SaveReturnUserCourseOrder({
                id: item.id,
                reason: that.content,
                moneytype: that.radio,
                bankcard: that.form.bank,
                bankname: that.form.name,
                cardname: that.form.account,
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.$store.dispatch("updateUserInfo").then(function() {
                        that.$message.success('提交成功')
                        that.courseDialogVisible = false
                    })
                } else {
                    that.$message.error(res.msg)
                }

            })
        }
    })
        },
        /**删除课程订单
         *  item
         */
        deleteUserCourseOrder: function(item) {
            var that = this
            this.$confirm('确认删除该订单吗？').then(function(_) {
                DeleteUserCourseOrder({
                    ids: item.id,
                    apptoken: that.state.appToken
                }).then(function(res) {
                    if (res.result == true) {
                        that.$message.success('删除成功')
                        that.getUserCourseOrderList()
                    } else {
                        that.$message.error(res.msg)
                    }
                })
            })
        },
        /**课程订单确认收货
         *  item
         */
        receiptUserCourseOrder: function(item) {
            var that = this
            this.$confirm('确认收货吗？').then(function(_) {
                ReceiptUserCourseOrder({
                    orderid: item.id,
                    apptoken: that.state.appToken
                }).then(function(res) {
                    if (res.result == true) {
                        that.$message.success('确认收货成功')
                        that.getUserCourseOrderDetail()
                    } else {
                        that.$message.error(res.msg)
                    }
                })
            })
        },
        /**删除商城订单
         *  item
         */
        deleteUserShopOrder: function(item) {
            var that = this
            this.$confirm('确认删除该订单吗？').then(function(_) {
                DeleteUserShopOrder({
                    ids: item.id,
                    apptoken: that.state.appToken
                }).then(function(res) {
                    if (res.result == true) {
                        that.$message.success('删除成功')
                        that.getUserCourseOrderList()
                    } else {
                        that.$message.error(res.msg)
                    }
                })
            })
        },
        /**商城订单确认收货
         *  item
         */
        receiptUserShopOrder: function(item) {
            var that = this
            this.$confirm('确认收货吗？').then(function(_) {
                ReceiptUserShopOrder({
                    id: item.id,
                    apptoken: that.state.appToken
                }).then(function(res) {
                    if (res.result == true) {
                        that.$message.success('确认收货成功')
                        that.getUserCourseOrderDetail()
                    } else {
                        that.$message.error(res.msg)
                    }
                })
            })
        },
        /**去评价
         *  item
         */
        openComment: function(item,list) {
            console.log(item)
            this.visible = 2
            this.orderId = list.orderid
            this.commentData = item
        },
        /**保存发表评价 */
        saveUserComment:function() {
            var that = this
            SaveUserComment({
                apptoken: that.state.appToken,
                channelid:that.activeName == 'first' ? 10002 : 4,
                content:that.textarea,
                star:that.star,
                orderid:this.orderId,
                ordertype:this.commentData.ordertype,
                id:this.commentData.courseid, 
                userid:that.userInfo.UserID
            }).then(function(res) {
                if (res.result == true) {
                    that.$message.success('发表成功')
                } else {
                    that.$message.error(res.msg)
                }
            })
        }
    },
    mounted: function() {
        var that = this
        that.$store.ready(function(state) {
            var modelList = [
                {
                    value: 1,
                    label: '订单号'
                }
            ]
            
            if(state.model.edu){
                modelList.push({
                    value: 2,
                    label: '课程'
                },{
                    value: 3,
                    label: '专栏'
                })
            }
            if(state.model.activity){
                modelList.push({
                    value: 4,
                    label: '活动'
                })
            }
            if(state.model.checkpackage){
                modelList.push({
                    value: 5,
                    label: '训练营'
                })
            }
            if(state.model.classroom){
                modelList.push({
                    value: 6,
                    label: '班级'
                })
            }
            if(state.model.group){
                modelList.push({
                    value: 7,
                    label: '社群'
                })
            }
            if(state.model.mall){
                that.showMall = true
            }
            that.typeList = modelList
            that.userInfo = state.userInfo
          
            that.state = state
            that.getUserCourseOrderList()
        })
    }
}