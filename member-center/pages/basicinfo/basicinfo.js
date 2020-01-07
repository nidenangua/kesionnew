return {
    data: function() {
        /**表单验证 */
        /**姓名验证 */
        var that = this
        var checkRealName = function(rule, value, callback) {
                var reg = /^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,5}$/
                if (!reg.test(value)) {
                    return callback(new Error('请输入2-5字中文姓名'));
                } else {
                    callback()
                }
            }
            /**邮箱验证 */
        var checkEmail = function(rule, value, callback) {
                var reg = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i
                if (!reg.test(value)) {
                    return callback(new Error('请输入正确的邮箱'));
                } else {
                    callback()
                }
            }
            /**旧密码验证 */
        var checkOldPass = function (rule, value, callback){
                var reg = /^\w{6,20}$/
                if (!reg.test(value)) {
                    return callback(new Error('请输入6-20字符旧密码'))
                } else {
                    callback()
                }
            }
            /**新密码验证 */
        var checkPassWord = function (rule, value, callback){
                var reg = /^\w{6,20}$/
                if (!reg.test(value)) {
                    callback(new Error('请输入6-20字符登陆密码'))
                } else {
                    callback()
                }
            }
            /**新密码再次确认验证 */
        var checkRePassword = function (rule, value, callback){
                if (value === '') {
                    callback(new Error('请再次输入密码'))
                } else if (value !== this.passForm.passWord) {
                    callback(new Error('两次输入密码不一致!'))
                } else {
                    callback()
                }
            }
            /**图形验证码验证 */
        var checkYzCode = function (rule, value, callback){
                var reg = that.showNum.join('')
                if (value === '') {
                    callback(new Error('请输入验证码'))
                } else if (value != reg) {
                    callback(new Error('输入正确验证码!'))
                } else {
                    callback()
                }
            }
            /**手机号验证 */
        var checkPhone = function (rule, value, callback){
                var reg = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
                if (value === '' || !reg.test(value)) {
                    callback(new Error('请输入有效11位数字手机号码'));
                } else {
                    callback()
                }
            }
            /**密保问题 */
        var checkQuestion = function (rule, value, callback){
                if (value === '') {
                    callback(new Error('请输入提示问题'));
                } else {
                    callback()
                }
            }
            /**密保答案 */
        var checkAnswer = function (rule, value, callback){
                if (value === '') {
                    callback(new Error('请输入提示答案'));
                } else {
                    callback()
                }
            }
            /**短信验证码验证 */
        var checkDxCode = function (rule, value, callback){
                if (value === '') {
                    callback(new Error('请输入验证码'))
                } else if (value != that.dxCode) {
                    callback(new Error('输入正确验证码!'))
                } else {
                    callback()
                }
            }
            /**收货地区验证 */
        var checkCounty = function (rule, value, callback){
                if (value === '') {
                    callback(new Error('请选择您所在的省份、市区'))
                } else {
                    callback()
                }
            }
            /**收货邮编验证 */
        var checkZipCode = function (rule, value, callback){
                var reg = /^[1-9][0-9]{5}$/
                if (value === '' || !reg.test(value)) {
                    callback(new Error('请输入正确的邮政编码'))
                } else {
                    callback()
                }
            }
            /**收货地址验证 */
        var checkAddress = function (rule, value, callback){
                if (value === '') {
                    callback(new Error('请输入您的街道地址及门牌号'))
                } else {
                    callback()
                }
            }
            /**收货地址别名 */
        var checkName = function (rule, value, callback){
                if (value == '') {
                    callback(new Error('请输入您的地址别名'))
                } else {
                    callback()
                }
            }
            /**发票单位验证 */
        var checkCompany = function (rule, value, callback){
                console.log(value)
                if (value == null) {
                    callback(new Error('请输入您的单位'))
                } else {
                    callback()
                }
            }
            /**发票纳税识别码验证 */
        var checkCode = function (rule, value, callback){
                var reg = /^([0-9ABCDEFGHJKLMNPQRTUWXY]{2})([0-9]{6})([0-9ABCDEFGHJKLMNPQRTUWXY]{9})([0-9Y])$/
                if (!reg.test(value)) {
                    callback(new Error('请输入18位纳税识别号'))
                } else {
                    callback()
                }
            }
            /**身份证号 */
            var checkCardnum = function (rule, value, callback){
                var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/
                if (!reg.test(value)) {
                    callback(new Error('请输入正确身份证号'))
                } else {
                    callback()
                }
            }
            /**注册地址验证 */
        var checkZcAddress = function (rule, value, callback){
                if (value == null) {
                    callback(new Error('请输入注册地址'))
                } else {
                    callback()
                }
            }
            /**开户银行验证 */
        var checkBank = function (rule, value, callback){
                if (value == '') {
                    callback(new Error('请输入开户银行'))
                } else {
                    callback()
                }
            }
            /**开户账户验证 */
        var checkAccount = function (rule, value, callback){
                if (value == '') {
                    callback(new Error('请输入开户账户'))
                } else {
                    callback()
                }
            }
            /**收票地址验证 */
        var checkAddress = function (rule, value, callback){
                if (value == '') {
                    callback(new Error('请输入收票人地址'))
                } else {
                    callback()
                }
            }
            /**收票姓名验证 */
        var checkUserName = function (rule, value, callback){
                if (value == '') {
                    callback(new Error('请输入收票人姓名'))
                } else {
                    callback()
                }
            }
            /**注册手机号验证 */
        var checkZcPhone = function (rule, value, callback){
            var reg = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if (value === '' || !reg.test(value)) {
                callback(new Error('请输入有效11位数字手机号码'));
            } else {
                callback()
            }
        }

        return {
            /**apptoken */
            appToken: '',
            /**当前选中项 */
            activeName: 'first',
            /**表单数据 */
            infoForm: store.state.userInfo,
            /**省市区联动 */
            provinceId: '',
            cityId: '',
            countyId: '',
            province: '',
            city: '',
            county: '',
            /**省数据 */
            provinceList: [],
            /**市数据 */
            cityList: [],
            /**区数据 */
            areaList: [],
            /*******************个人信息************** */
            /**表单验证 */
            rules: {
                RealName: [
                    { required: true, validator: checkRealName, trigger: 'blur' }
                ],
                Email: [
                    { required: true, validator: checkEmail, trigger: 'blur' }
                ],
                cardnum:[
                    { required: true, validator: checkCardnum, trigger: 'blur' }
                ]
            },
            /**设置标签开关 */
            dialogSetLabelVisible: false,
            /**自定义表单 */
            formList:[],
            /**标签数据 */
            tagsList: [],
            /**选中标签 */
            xztagsList: [],
            /*******************修改密码************** */
            /**表单数据 */
            passForm: {
                oldPass: '',
                passWord: '',
                rePassword: '',
                yzCode: ''
            },
            /**随机验证码 */
            showNum: [],
            /**表单验证 */
            passRules: {
                oldPass: [
                    { required: true, validator: checkOldPass, trigger: 'blur' }
                ],
                passWord: [
                    { required: true, validator: checkPassWord, trigger: 'blur' }
                ],
                rePassword: [
                    { required: true, validator: checkRePassword, trigger: 'blur' }
                ],
                yzCode: [
                    { required: true, validator: checkYzCode, trigger: 'blur' }
                ],
            },
            /*******************账号安全************** */
            /**表单数据 */
            safeForm: {
                passWord: '',
                question: '',
                answer: '',
                yzCode: ''
            },
            /**表单验证 */
            safeRules: {
                passWord: [
                    { required: true, validator: checkPassWord, trigger: 'blur' }
                ],
                yzCode: [
                    { required: true, validator: checkYzCode, trigger: 'blur' }
                ],
                question: [
                    { required: true, validator: checkQuestion, trigger: 'blur' }
                ],
                answer: [
                    { required: true, validator: checkAnswer, trigger: 'blur' }
                ],
            },
            /******************账号绑定************** */
            /**会话框开关 */
            dialogBindVisible: false,
            /**绑定数据列表 */
            userBindList: [],
            /**表单数据 */
            bindForm: {
                phone: '',
                dxCode: ''
            },
            /**短信验证码 */
            dxCode: '',
            /**表单验证 */
            bindRules: {
                phone: [
                    { required: true, validator: checkPhone, trigger: 'blur' }
                ],
                dxCode: [
                    { required: true, validator: checkDxCode, trigger: 'blur' }
                ],
            },
            /******************收货人地址************** */
            /**新增地址会话显示开关 */
            dialogAddressVisible: false,
            /**地址列表 */
            addressList: [],
            /**表单数据 */
            addressForm: {
                province: '',
                city: '',
                county: '',
                address: '',
                zipCode: '',
                realName: '',
                phone: '',
                email: '',
                name: '',
                default: false,
                id: null,
            },
            /**表单验证 */
            addressRules: {
                county: [
                    { required: true, validator: checkCounty, trigger: 'blur' }
                ],
                address: [
                    { required: true, validator: checkAddress, trigger: 'blur' }
                ],
                zipCode: [
                    { required: true, validator: checkZipCode, trigger: 'blur' }
                ],
                realName: [
                    { required: true, validator: checkRealName, trigger: 'blur' }
                ],
                phone: [
                    { required: true, validator: checkPhone, trigger: 'blur' }
                ],
                email: [
                    { validator: checkEmail, trigger: 'blur' }
                ],
                name: [
                    { required: true, validator: checkName, trigger: 'blur' }
                ],
            },
            /****************************发票管理**************************** */
            /**发票列表 */
            invoiceList: [],
            /**新增发票会话显示开关 */
            dialogInvoiceVisible: false,
            /**单选框 1普通发票 2增值发票 */
            invoiceRadio: '1',
            /**1个人，2单位 */
            invoiceTypeRadio: '1',
            /**表单数据 */
            invoiceForm: {
                company: null,
                code: '',
                email: '',
                /**注册地址 */
                zcAddress: null,
                /**注册手机号 */
                zcPhone: '',
                bank: '',
                account: '',
                email: '',
                name: '',
                /**手机号 */
                phone: '',
                /**地址 */
                address: '',
                province: '',
                city: '',
                county: '',
                mobile: '',
                id: null,
            },
            /**表单验证 */
            invoiceRules: {
                company: [
                    { required: true, validator: checkCompany, trigger: 'blur' }
                ],
                code: [
                    { required: true, validator: checkCode, trigger: 'blur' }
                ],
                email: [
                    { required: true, validator: checkEmail, trigger: 'blur' }
                ],
                zcAddress: [
                    { required: true, validator: checkZcAddress, trigger: 'blur' }
                ],
                zcPhone: [
                    { required: true, validator: checkZcPhone, trigger: 'blur' }
                ],
                bank: [
                    { required: true, validator: checkBank, trigger: 'blur' }
                ],
                account: [
                    { required: true, validator: checkAccount, trigger: 'blur' }
                ],
                address: [
                    { required: true, validator: checkAddress, trigger: 'blur' }
                ],
                county: [
                    { required: true, validator: checkCounty, trigger: 'blur' }
                ],
                mobile: [
                    { required: true, validator: checkPhone, trigger: 'blur' }
                ],
                phone: [
                    { required: true, validator: checkPhone, trigger: 'blur' }
                ],
                name: [
                    { required: true, validator: checkUserName, trigger: 'blur' }
                ],
            },
        }
    },
    methods: {
        /***********************************个人信息******************************************************* */
        /**打开下拉框获取省级数据
         *  e 回调参数 布尔值
         */
        getProvinceList: function(e) {
            var that = this
            if (e) {
                if (that.provinceList.length == 0) {
                    GetArea({
                        areaid: 0
                    }).then(function(res) {
                        that.provinceList = res.data
                    })
                }
            }
        },
        /**打开下拉框获取市级数据
         *  e 回调参数 布尔值
         */
        getCityList: function(e) {
            var that = this
            if (e) {
                if (that.cityList.length == 0 && that.provinceId != '') {
                    GetArea({
                        areaid: that.provinceId
                    }).then(function(res) {
                        that.cityList = res.data
                    })
                }
            }
        },
        /**打开下拉框获取区级数据
         *  e 回调参数 布尔值
         */
        getAreaList: function(e) {
            var that = this
            if (e) {
                if (that.areaList.length == 0 && that.cityId != '') {
                    GetArea({
                        areaid: that.cityId
                    }).then(function(res) {
                        that.areaList = res.data
                    })
                }
            }
        },
        /**选中省级菜单回调获取市级列表 */
        changeProvince:function(e) {
       
            var that = this
            that.provinceId = e
            GetArea({
                areaid: e
            }).then(function(res) {
                if (that.activeName == 'first') {
                    if (res.result == true) {
                        that.cityList = res.data
                        that.cityId = res.data[0].id
                        that.infoForm.city = res.data[0].city
                        that.countyId = ''
                        that.infoForm.county = ''
                        that.areaList = []
                    } else {
                        that.infoForm.county = ''
                        that.infoForm.city = ''
                        that.countyId = ''
                        that.cityId = ''
                        that.cityList = []
                        that.areaList = []
                    }
                } else if (that.activeName == 'five') {
                    if (res.result == true) {
                        that.cityList = res.data
                        that.cityId = res.data[0].id
                        that.addressForm.city = res.data[0].city
                        that.countyId = ''
                        that.addressForm.county = ''
                        that.areaList = []
                    } else {
                        that.addressForm.county = ''
                        that.addressForm.city = ''
                        that.countyId = ''
                        that.cityId = ''
                        that.cityList = []
                        that.areaList = []
                    }
                } else if (that.activeName == 'six') {
                    if (res.result == true) {
                        that.cityList = res.data
                        that.cityId = res.data[0].id
                        that.invoiceForm.city = res.data[0].city
                        that.countyId = ''
                        that.invoiceForm.county = ''
                        that.areaList = []
                    } else {
                        that.invoiceForm.county = ''
                        that.invoiceForm.city = ''
                        that.countyId = ''
                        that.cityId = ''
                        that.cityList = []
                        that.areaList = []
                    }
                }

            })
        },
        /**选中市级菜单回调获取区县列表 */
        changeCity:function(e) {
            /**强制刷新值的方法 */
            this.$forceUpdate()
            var that = this
            that.cityId = e
            GetArea({
                areaid: e
            }).then(function(res) {
                if (that.activeName == 'first') {
                    if (res.result == true) {
                        that.areaList = res.data
                        that.infoForm.county = res.data[0].city
                        that.countyId = res.data[0].id
                    } else {
                        that.areaList = []
                        that.infoForm.county = ''
                        that.countyId = ''
                    }
                } else if (that.activeName == 'five') {
                    if (res.result == true) {
                        that.areaList = res.data
                        that.addressForm.county = res.data[0].city
                        that.countyId = res.data[0].id
                    } else {
                        that.areaList = []
                        that.addressForm.county = ''
                        that.countyId = ''
                    }
                } else if (that.activeName == 'six') {
                    if (res.result == true) {
                        that.areaList = res.data
                        that.invoiceForm.county = res.data[0].city
                        that.countyId = res.data[0].id
                    } else {
                        that.areaList = []
                        that.invoiceForm.county = ''
                        that.countyId = ''
                    }
                }

            })
        },
        /**选中区县更新区县id */
        changeCounty:function(e) {
            /**强制刷新值的方法 */
            this.$forceUpdate()
            this.countyId = e
        },
        /**标签页点击回调 */
        handleClick: function(tab, event) {
            var that = this
            if (tab.index == 0) {
                this.cityList = []
                this.areaList = []
                that.provinceId = that.infoForm.ProID
                that.cityId = that.infoForm.CityID
                that.countyId = that.infoForm.CountyID
            } else if (tab.index == 1) {
                this.draw([], 'canvasOne')
            } else if (tab.index == 2) {
                this.draw([], 'canvasTwo')
            } else if (tab.index == 3) {
                this.getUserBindList()
            } else if (tab.index == 4) {
                this.cityList = []
                this.areaList = []
                this.countyId = ''
                this.provinceId = ''
                this.cityId = ''
                this.getUserReciveAddressList()
            } else if (tab.index == 5) {
                this.getUserInvoiceList()
            } else if (tab.index == 6) {
                this.cityList = []
                this.areaList = []
                this.countyId = ''
                this.provinceId = ''
                this.cityId = ''
                this.getUserInvoiceList()
            }
        },
        /**设置标签 */
        setLabel: function() {
            var that = this
            this.dialogSetLabelVisible = true
            GetKeyTagsList({}).then(function(res) {
                that.tagsList = res.data
            })
        },
        /**选中标签 */
        addTags: function(item) {
            var that = this
            if (this.xztagsList.indexOf(item) == -1) {
                this.xztagsList.push(item)
                if (this.infoForm.tagsids == '') {
                    this.infoForm.tagsids = item.tagsid
                } else {
                    this.infoForm.tagsids = this.infoForm.tagsids + ',' + item.tagsid
                }
            }
        },
        /**删除标签 */
        delTags: function(item) {
            var that = this
            var index = this.xztagsList.indexOf(item)
            this.xztagsList.splice(index, 1)
            var list = this.xztagsList.map(function(item) {
                return item.tagsid
            })
            this.infoForm.tagsids = list.join()
        },
        /**添加标签到页面 */
        pushTags: function(item) {
            this.dialogSetLabelVisible = false
        },
        /**提交保存资料 */
        onSubmit: function () {
            var that = this
            var obj = {
                email: that.infoForm.Email,
                realname: that.infoForm.RealName,
                sex: that.infoForm.Sex,
                tagsids: that.infoForm.tagsids,
                provinceid: that.provinceId,
                cityid: that.cityId,
                countyid: that.countyId,
                open_space: that.infoForm.open_space,
                space_name: that.infoForm.space_name,
                apptoken: that.appToken
            }
            if (this.formList != undefined) {
                for (var i = 0; i < this.formList.length; i++) {
                    var key = this.formList[i].fieldid
                    obj[key] = this.formList[i].defaultvalue
                }

            }
           // console.log(obj)
            that.$refs.infoForm.validate(function(valid) {
                if (valid == true) {
                    SaveUesrBasicInfo(obj).then(function(res) {
                        if(res.result){
                            that.$message.success('修改资料成功');
                        }else{
                            that.$message.error(res.msg);
                        }
                        
                    })
                }
            })
        },
        /**
         * 选择头像
         */
        changeAvatar:function() {
            this.$refs.file_avatar.click()
        },
        /**
         * 修改头像
         */
        uploadAvatar: function(e) {
            // this.$showLoading('#userRight')
            var that = this
            var file = that.$refs.file_avatar.files[0];
            var infoFormData = new FormData();
            infoFormData.append('file', file)
            infoFormData.append('userid', that.infoForm.UserID)
            ModifyUserFace(infoFormData).then(function(res) {
                // that.$hideLoading('#userRight')
                 /**强制刷新值的方法 */
                 that.$forceUpdate()
                if (res.result === true) {
                    that.$message.success('修改头像成功')
                    that.$store.dispatch("updateUserInfo").then(function() {
                        location.reload()
                    })
                } else {
                    that.$message.error('修改头像失败')
                }
            })
        },
        /***********************************修改密码******************************************************* */
        /** 生成并渲染出验证码图形*/
        draw: function(show_num, id) {
            var canvas = this.$refs[id]; //获取到canvas的对象，演员
            var canvas_width = canvas.width;
            var canvas_height = canvas.height;
            var context = canvas.getContext("2d"); //获取到canvas画图的环境，演员表演的舞台
            canvas.width = 88;
            canvas.height = 36;
            var sCode = "a,b,c,d,e,f,g,h,i,j,k,m,n,p,q,r,s,t,u,v,w,x,y,z,A,B,C,E,F,G,H,J,K,L,M,N,P,Q,R,S,T,W,X,Y,Z,1,2,3,4,5,6,7,8,9,0";
            var aCode = sCode.split(",");
            var aLength = aCode.length; //获取到数组的长度
            for (var i = 0; i < 4; i++) { //这里的for循环可以控制验证码位数（如果想显示6位数，4改成6即可）
                var j = Math.floor(Math.random() * aLength); //获取到随机的索引值
                // var deg = Math.random() * 30 * Math.PI / 180;//产生0~30之间的随机弧度
                var deg = Math.random() - 0.5; //产生一个随机弧度
                var txt = aCode[j]; //得到随机的一个内容
                show_num[i] = txt.toLowerCase();
                var x = 10 + i * 20; //文字在canvas上的x坐标
                var y = 20 + Math.random() * 8; //文字在canvas上的y坐标
                context.font = "bold 20px 微软雅黑";
                context.translate(x, y);
                context.rotate(deg);
                context.fillStyle = this.randomColor();
                context.fillText(txt, 0, 0);
                context.rotate(-deg);
                context.translate(-x, -y);
            }
            this.showNum = show_num
            for (var i = 0; i <= 5; i++) { //验证码上显示线条
                context.strokeStyle = this.randomColor();
                context.beginPath();
                context.moveTo(Math.random() * canvas_width, Math.random() * canvas_height);
                context.lineTo(Math.random() * canvas_width, Math.random() * canvas_height);
                context.stroke();
            }
            // for (var i = 0; i <= 30; i++) { //验证码上显示小点
            //     context.strokeStyle = this.randomColor();
            //     context.beginPath();
            //     var x = Math.random() * canvas_width;
            //     var y = Math.random() * canvas_height;
            //     context.moveTo(x, y);
            //     context.lineTo(x + 1, y + 1);
            //     context.stroke();
            // }
        },
        /**得到随机的颜色值 */
        randomColor: function() {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            return "rgb(" + r + "," + g + "," + b + ")";
        },
        /**保存密码 */
        savePass: function() {
            var that = this
            that.$refs.passForm.validate(function(valid) {
                if (valid == true) {
                    ModifyPass({
                        oldpass: that.passForm.oldPass,
                        password: that.passForm.passWord,
                        repassword: that.passForm.rePassword,
                        apptoken: that.appToken
                    }).then(function(res) {
                        if (res.result == true) {
                            that.$store.dispatch("updateUserInfo").then(function() {
                                that.$message.success('修改密码成功')
                                    // that.$router.push({
                                    //     name: "UserLogin"
                                    // });
                            });
                        } else {
                            that.$message.error(res.msg);
                        }
                    })
                }
            })
        },
        /**清除表单 */
        clearForm: function(name) {
            this.$refs[name].resetFields();
        },
        /***********************************账户安全******************************************************* */
        /**保存账户安全设置 */
        saveSafe: function() {
            var that = this
            that.$refs.safeForm.validate(function(valid) {
               
                if (valid == true) {
                    ModifyQuestion({
                        password: that.safeForm.passWord,
                        question: that.safeForm.question,
                        answer: that.safeForm.answer,
                        apptoken: that.appToken
                    }).then(function(res) {
                        if (res.result == true) {
                            that.$store.dispatch("updateUserInfo").then(function() {
                                that.$message.success('设置成功')
                            });
                        } else {
                            that.$message.error(res.msg);
                        }
                    })
                }
            })
        },
        /***********************************账号绑定******************************************************* */
        /**手机号码绑定设置 */
        setBind: function() {
            var that = this
            that.dialogBindVisible = true
        },
        /**其他绑定设置 */
        getUserBindList: function() {
            var that = this
            GetUserBindList({
                apptoken: that.appToken
            }).then(function(res) {
                that.userBindList = res.data
            })
        },
        /**绑定地址 */
        setBindUrl: function(item) {
            if (item.id == "mobilebind") {
                this.dialogBindVisible = true
            } else {
                location.href = item.bind_url
            }
        },
        delBindUrl: function(item) {
           
            var that = this
            DelUserBind({
                id: 'unbindmobile',
                apptoken: that.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.getUserBindList()
                    that.$message.success('解除绑定成功')
                }
            })
        },
        /**发送短信验证码 */
        sendYzCode: function() {
            var that = this
            SendSmsCode({
                mobile: Number(that.bindForm.phone),
                apptoken: that.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.$message.success('验证码发送成功')
                    that.dxCode = res.code
                    console.log(that.dxCode)
                } else {
                    that.$message.error(res.msg)
                    that.dxCode = res.code
                    console.log(that.dxCode)
                }
            })
        },
        /**绑定手机号 */
        mobileBind: function() {
            var that = this
            that.$refs.bindForm.validate(function(valid) {
                if (valid == true) {
                    MobileBind({
                        model:'modifymobile',
                        mobile: Number(that.bindForm.phone),
                        apptoken: that.appToken
                    }).then(function(res) {
                        if (res.result == true) {
                            that.$message.success('绑定号码成功')
                            that.dialogBindVisible = true
                        } else {
                            that.$message.error(res.msg)
                        }
                    })
                }
            })
        },
        /*************************************************收货地址******************************************************* */
        /**收货地址列表 */
        getUserReciveAddressList: function() {
            var that = this
            that.addressList = []
            GetUserReciveAddressList({
                apptoken: that.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.addressList = res.data
                }
            })
        },
        addAddress: function() {
            this.dialogAddressVisible = true
            this.addressForm = {}
            this.addressForm.id = -1
            this.cityList = []
            this.areaList = []
            this.countyId = ''
            this.provinceId = ''
            this.cityId = ''
        },
        /**保存地址 */
        saveAddress: function(id) {
            var that = this
            that.$refs.addressForm.validate(function(valid) {
                console.log(valid)
                if (valid == true) {
                    if (id == -1) {
                        SaveAddUserReciveAddres({
                            recive_name: that.addressForm.realName,
                            title: that.addressForm.name,
                            zipcode: that.addressForm.zipCode,
                            address: that.addressForm.address,
                            mobile: that.addressForm.phone,
                            provinceid: that.provinceId,
                            cityid: that.cityId,
                            countyid: that.countyId,
                            email: that.addressForm.email,
                            isdefault: that.addressForm.default == true ? 1 : 0,
                            apptoken: that.appToken
                        }).then(function(res) {

                            if (res.result == true) {
                                that.$store.dispatch("updateUserInfo").then(function() {
                                    that.$message.success('添加收货地址成功')
                                    that.dialogAddressVisible = false
                                    that.getUserReciveAddressList()
                                });
                            } else {
                                that.$message.error(res.msg);
                            }
                        })
                    } else {
                        SaveModifyUserReciveAddres({
                            recive_name: that.addressForm.realName,
                            title: that.addressForm.name,
                            zipcode: that.addressForm.zipCode,
                            address: that.addressForm.address,
                            mobile: that.addressForm.phone,
                            provinceid: that.provinceId,
                            cityid: that.cityId,
                            countyid: that.countyId,
                            email: that.addressForm.email,
                            isdefault: that.addressForm.default == true ? 1 : 0,
                            addressid: id,
                            apptoken: that.appToken
                        }).then(function(res) {

                            if (res.result == true) {
                                that.$store.dispatch("updateUserInfo").then(function() {
                                    that.$message.success('修改收货地址成功')
                                    that.dialogAddressVisible = false
                                    that.getUserReciveAddressList()
                                });
                            } else {
                                that.$message.error(res.msg);
                            }
                        })
                    }

                }
            })
        },
        /**修改收货地址 */
        modifyAddress:function(item) {
            var that = this
                /**强制刷新值的方法 */
            this.$forceUpdate()
            ModifyUserReciveAddress({
                addressid: item.addressid,
                apptoken: this.appToken
            }).then(function(res) {
                var data = res.data
                that.addressForm.address = data.address
                that.addressForm.zipCode = data.zipcode
                that.addressForm.realName = data.recive_name
                that.addressForm.phone = data.mobile
                that.addressForm.email = data.email
                that.addressForm.name = data.title
                that.addressForm.province = data.province
                that.addressForm.city = data.city
                that.addressForm.county = data.county
                that.countyId = data.countyid
                that.provinceId = data.provinceid
                that.cityId = data.cityid
                that.addressForm.default = data.isdefault == 1 ? true : false
                that.addressForm.id = data.addressid
                that.dialogAddressVisible = true
            })

        },
        /**删除收货地址 */
        delAddress: function(item) {
            var that = this
            this.$confirm('确定删除吗？').then(function(_) {
                DeleteUserReciveAddress({
                    addressids: item.addressid,
                    apptoken: that.appToken
                }).then(function(res) {
                    if (res.result == true) {
                        that.$message.success('删除收货地址成功')
                        that.getUserReciveAddressList()
                    } else {
                        that.$message.error(res.msg);
                    }
                })
            })
        },
        /**设置默认收货地址 */
        setDefault: function(item) {
            var that = this
            SetUserReciveAddress({
                addressid: item.addressid,
                apptoken: that.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.$message.success('设置默认地址成功')
                    that.getUserReciveAddressList()
                } else {
                    that.$message.error(res.msg);
                }
            })
        },
        /********************************************************发票管理********************************************** */
        /**发票列表 */
        getUserInvoiceList: function() {
            var that = this
            that.invoiceList = []
            GetUserInvoiceList({
                apptoken:that.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.invoiceList = res.data
                }
            })
        },
        addInvoice: function() {
            this.dialogInvoiceVisible = true
            this.invoiceForm = {}
            this.invoiceForm.id = -1
            this.cityList = []
            this.areaList = []
            this.countyId = ''
            this.provinceId = ''
            this.cityId = ''
        },
        /**修改发票 */
        modifyUserInvoice: function(item) {
            /**强制刷新值的方法 */
            this.$forceUpdate()
            var that = this
            ModifyUserInvoice({
                invoiceid: item.invoiceid,
                appToken: that.appToken
            }).then(function(res) {
                var data = res.data
                that.invoiceForm.id = data.invoiceid
                that.invoiceRadio = data.invoicetype == 0 ? '1' : '2'
                that.invoiceTypeRadio = data.titletype == 0 ? '1' : '2'
                that.invoiceForm.code = data.taxpayer_number
                that.invoiceForm.company = data.companyname
                that.invoiceForm.zcAddress = data.address
                that.invoiceForm.zcPhone = data.tel
                that.invoiceForm.bank = data.bank
                that.invoiceForm.account = data.banknum
                that.invoiceForm.name = data.contactman
                that.invoiceForm.mobile = data.mobile
                that.invoiceForm.address = data.contactaddress
                that.invoiceForm.province = data.province
                that.invoiceForm.city = data.city
                that.invoiceForm.county = data.county
                that.invoiceForm.email = data.email
                that.countyId = data.countyid
                that.provinceId = data.provinceid
                that.cityId = data.cityid
                that.dialogInvoiceVisible = true
            })
        },
        /**保存发票 */
        saveInvoice: function(id) {
            var that = this
           
            that.$refs.invoiceForm.validate(function(valid) {
                if (valid) {
                    if (id == -1) {
                        if (that.invoiceRadio == 1) {
                            SaveAddUserInvoice({
                                invoicetype: 0,
                                titletype: that.invoiceTypeRadio == 1 ? 0 : 1,
                                taxpayer_number: that.invoiceForm.code,
                                companyname: that.invoiceForm.company,
                                email:that.invoiceForm.email,
                                apptoken: that.appToken
                            }).then(function(res) {
                                if (res.result == true) {
                                    that.$message.success('保存发票成功')
                                    that.getUserInvoiceList()
                                    that.dialogInvoiceVisible = false
                                } else {
                                    that.$message.error(res.msg);
                                }
                            })
                        } else if (that.invoiceRadio == 2) {
                            SaveAddUserInvoice({
                                invoicetype: 1,
                                titletype: that.invoiceTypeRadio == 1 ? 0 : 1,
                                taxpayer_number: that.invoiceForm.code,
                                address: that.invoiceForm.zcAddress,
                                tel: that.invoiceForm.zcPhone,
                                bank: that.invoiceForm.bank,
                                banknum: that.invoiceForm.account,
                                contactman: that.invoiceForm.name,
                                mobile: that.invoiceForm.mobile,
                                contactaddress: that.invoiceForm.address,
                                companyname: that.invoiceForm.company,
                                email: that.invoiceForm.email,
                                provinceid: that.provinceId,
                                cityid: that.cityId,
                                countyid: that.countyId,
                                apptoken: that.appToken
                            }).then(function(res) {
                                if (res.result == true) {
                                    that.$message.success('保存发票成功')
                                    that.getUserInvoiceList()
                                    that.dialogInvoiceVisible = false
                                } else {
                                    that.$message.error(res.msg);
                                }
                            })
                        }
                    } else {
                        if (that.invoiceRadio == 1) {
                            SaveModifyUserInvoice({
                                invoiceid: id,
                                invoicetype: 0,
                                email:that.invoiceForm.email,
                                titletype: that.invoiceTypeRadio == 1 ? 0 : 1,
                                taxpayer_number: that.invoiceForm.code,
                                companyname: that.invoiceForm.company,
                                apptoken: that.appToken
                            }).then(function(res) {
                                if (res.result == true) {
                                    that.$message.success('修改发票成功')
                                    that.getUserInvoiceList()
                                    that.dialogInvoiceVisible = false
                                } else {
                                    that.$message.error(res.msg);
                                }
                            })
                        } else if (that.invoiceRadio == 2) {
                            SaveModifyUserInvoice({
                                invoiceid: id,
                                invoicetype: 1,
                                titletype: that.invoiceTypeRadio == 1 ? 0 : 1,
                                taxpayer_number: that.invoiceForm.code,
                                address: that.invoiceForm.zcAddress,
                                tel: that.invoiceForm.zcPhone,
                                bank: that.invoiceForm.bank,
                                banknum: that.invoiceForm.account,
                                contactman: that.invoiceForm.name,
                                mobile: that.invoiceForm.mobile,
                                contactaddress: that.invoiceForm.address,
                                companyname: that.invoiceForm.company,
                                email: that.invoiceForm.email,
                                provinceid: that.provinceId,
                                cityid: that.cityId,
                                countyid: that.countyId,
                                apptoken: that.appToken
                            }).then(function(res) {
                                if (res.result == true) {
                                    that.$message.success('修改发票成功')
                                    that.getUserInvoiceList()
                                    that.dialogInvoiceVisible = false
                                } else {
                                    that.$message.error(res.msg);
                                }
                            })
                        }
                    }

                }
            })
        },
        /**删除发票 */
        delInvoice: function(item) {
            var that = this
            this.$confirm('确定删除吗？').then(function(_) {
                DeleteUserInvoice({
                    invoiceids: item.invoiceid,
                    apptoken: that.appToken
                }).then(function(res) {
                    if (res.result == true) {
                        that.$message.success('删除发票成功')
                        that.getUserInvoiceList()
                    } else {
                        that.$message.error(res.msg);
                    }
                })
            })
        },
        /**获取自定义用户信息 */
        initUserInfo:function(){
            var that = this
            InitializateUesrBasicField({
                apptoken: that.appToken
            }).then(function(res){
            
                that.formList = res.data
            })
        }
        

    },
    created: function() {

    },
    mounted: function() {
        var that = this
        that.$store.ready(function(state) {
            that.infoForm = state.userInfo
            that.provinceId = that.infoForm.ProID
            that.cityId = that.infoForm.CityID
            that.countyId = that.infoForm.CountyID
            that.xztagsList = state.userInfo.tagslist
            that.appToken = state.appToken
            that.safeForm.question = that.infoForm.Question
            that.initUserInfo()
        })
    }
}