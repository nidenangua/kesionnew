return {
    data: function() {
        return {
            state: store.state,
            /**用户信息 */
            userInfo: {},
            /**列表页数 */
            pageCount: null,
            currentPage: 1,
            /*当前标签页 */
            activeName: 'first',
            checked: false,
            /**消息列表 */
            msgList: [],
            /***************************收到多选框 ****************************/
            /**选中的列表 */
            checkList: [],
            /**全选状态 */
            checkAll: false,
            /**饿了么提供的不确定状态 */
            isIndeterminate: true,
            /**页面显示的列表id集合 */
            list: [],
            /**转换后台需要参数 */
            checkListStr: null,
            /**详情窗口开关 */
            msgDialogVisible: false,
            /**发送信息窗口开关 */
            sendDialogVisible: false,
            /**详情页面数据 */
            msgDetailData: {},
            form: {
                toUserName: '',
                msgTitle: '',
                msgContent: '',
            },
         
        }
    },
    methods: {
        /**标签页回调
         */
        handleClick: function(tab) {
            this.checkList = []
            this.checkAll = false
            if (tab.index == 0) {
                this.getUserMessageReciveList()
            } else if (tab.index == 1) {
                this.getUserMessageSendList()
            } else {
                this.getUserMessageGarbageList()
            }
        },
        /**我收到的消息列表 */
        getUserMessageReciveList: function(p) {
            p = p || 1
            this.msgList = []
            this.list = []
            var that = this
            this.currentPage = p
            GetUserMessageReciveList({
                page: p,
                pagesize: 10,
                apptoken: that.state.appToken
            }).then(function(res) {
                that.pageCount = res.pageCount * 10
                if (res.result == true) {
                    that.msgList = res.data
                    that.list = that.msgList.map(function(item) {
                        return item.id
                    })
                }
            })
        },
        /**我发送的消息列表 */
        getUserMessageSendList: function(p) {
            p = p || 1
            this.msgList = []
            this.list = []
            var that = this
            this.currentPage = p
            GetUserMessageSendList({
                page: p,
                pagesize: 10,
                apptoken: that.state.appToken
            }).then(function(res) {
                that.pageCount = res.pageCount * 10
                if (res.result == true) {
                    that.msgList = res.data
                    that.list = that.msgList.map(function(item) {
                        return item.id
                    })
                }
            })
        },
        /**垃圾消息列表 */
        getUserMessageGarbageList: function(p) {
            p = p || 1
            this.msgList = []
            this.list = []
            var that = this
            this.currentPage = p
            GetUserMessageGarbageList({
                page: p,
                pagesize: 10,
                apptoken: that.state.appToken
            }).then(function(res) {
                that.pageCount = res.pageCount * 10
                if (res.result == true) {
                    that.msgList = res.data
                    that.list = that.msgList.map(function(item) {
                        return item.id
                    })
                } else {

                }
            })
        },
        /**垃圾消息转回我收到的消息 */
        setUserMessageGarbage: function() {
            var that = this
            SetUserMessageGarbage({
                ids: this.checkListStr,
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.$message.success('转回成功')
                    if(that.activeName == 'first'){
                        that.getUserMessageReciveList()
                    }else if(that.activeName == 'second') {
                        that.getUserMessageSendList()
                    }else if(that.activeName == 'third') {
                        that.getUserMessageGarbageList()
                    }
                } else {
                    that.$message.error(res.msg)
                }
            })
        },
        /**打开消息详情 */
        openMsgDetail: function(type, item) {
            this.msgDialogVisible = true
            var that = this
            GetOneSiteMsgInfo({
                actiontype: type,
                id: item.id,
                apptoken: that.state.appToken
            }).then(function(res) {
                if (res.result == true) {
                    that.msgDetailData = res.data[0]
                    if(that.activeName == 'first'){
                        that.getUserMessageReciveList()
                    }else if(that.activeName == 'second') {
                        that.getUserMessageSendList()
                    }else if(that.activeName == 'third') {
                        that.getUserMessageGarbageList()
                    }
                } else {
                    that.$message.error(res.msg)
                }
            })
        },
        /**发送消息 */
        sendMsg: function() {
            var that = this
            if(!this.form.toUserName){
                that.$message.error('请输入收件人')
                return
            }
            if(!this.form.msgTitle){
                that.$message.error('请输入标题')
                return
            }
            if(!this.form.msgContent){
                that.$message.error('请输入内容')
                return
            }
            SaveUserSendMessage({
                tousername: this.form.toUserName,
                subject: this.form.msgTitle,
                msgcontent: this.form.msgContent,
                apptoken: that.state.appToken
            }).then(function(res) {
                that.sendDialogVisible = false
                if (res.result == true) {
                    that.$message.success('发送成功')
                    if(that.activeName == 'first'){
                        that.getUserMessageReciveList()
                    }else if(that.activeName == 'second') {
                        that.getUserMessageSendList()
                    }else if(that.activeName == 'third') {
                        that.getUserMessageGarbageList()
                    }
                } else {
                    that.$message.error(res.msg)
                }
            })
        },
        /**分页回调 */
        changeMsg: function(p) {
            
            if (this.activeName == 'first') {
                this.getUserMessageReciveList(p)
            } else if (this.activeName == 'second') {
                this.getUserMessageSendList(p)
            } else if (this.activeName == 'third') {
                this.getUserMessageGarbageList(p)
            }
        },
        /**收藏复选框回调 */
        handleCheckAllChange:function(val) {
            this.checkList = val ? this.list : [];
            this.checkListStr = this.checkList.join()
            this.isIndeterminate = false;
        },
        /**收藏复选框回调 */
        handleCheckedlistChange:function(value) {
            var checkedCount = value.length;
            this.checkAll = checkedCount === this.list.length;
            this.isIndeterminate = checkedCount > 0 && checkedCount < this.list.length;
            this.checkListStr = this.checkList.join()
        },
        /**删除，转为垃圾消息，设置已读接口
         * 参数do-----delete为永久删除，deletetf为转为垃圾信息，readtf设置为已读
         * 参数actiontype--0接收消息，1发送消息
         * 参数ids，id集合
         */
        doUserSiteMsg: function(type, dos) {
            var that = this
            var msg
            if (dos == 'delete') {
                msg = '确定删除吗？'
            } else if (dos == 'deletetf') {
                msg = '确定转为垃圾信息吗？'
            } else {
                msg = '确定设为已读吗？'
            }
            this.$confirm(msg).then(function(_) {
                DoUserSiteMsg({
                    actiontype: type,
                    do: dos,
                    ids: that.checkListStr,
                    apptoken: that.state.appToken
                }).then(function(res) {
                    if (res.result == true) {
                        that.$message.success('操作成功')
                        this.checkList = []
                        if (type == 0) {
                            that.getUserMessageReciveList()
                        } else if (type == 1) {
                            that.getUserMessageSendList()
                        } else {
                            that.getUserMessageGarbageList()
                        }
                    } else {
                        that.$message.error(res.msg)
                    }
                })
            })
        },

    },
    mounted: function() {
        var that = this
        that.$store.ready(function(state) {
            that.userInfo = state.userInfo
            that.state = state
            that.getUserMessageReciveList()
        })
    }
}