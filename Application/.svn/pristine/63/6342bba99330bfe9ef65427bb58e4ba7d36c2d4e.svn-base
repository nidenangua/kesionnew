/**
 * 聊天讨论公用逻辑部分
 * 注意：sendSigMsg方法来源于兄弟目录的live.sig.js，需先引入live.sig.js
 * 编写：zhuang
 */
import {
    getKeepChat,
    addChat
} from "@/api/live";
import {
    checkOrdersn
} from "@/api/microportal"
const instant_chat = {
    data() {
        return {
            /**当前聊天页码 */
            chatPage:0,
            /**当前聊天数据总页码 */
            chatTotalPage:0,
            /**聊天记录 */
            chatData: [],
            /**讨论总条数 */
            totalTalkPut: 0,
            /**当前讨论页码 */
            talkPage: 0,
            /**当前讨论数据总页码 */
            talkTotalPage: 0,
            /**讨论记录 */
            talkList: [],
            /**讨论文本区域内容 */
            talkTextAreaContent: "",
            /**讨论文本区域默认提示内容 */
            talkTextAreaPlace: "点此输入讨论内容",
            /**回复源 */
            replySource: {},
            /**当前状态是否为发送中 */
            sending:false
        }
    },
    watch: {
        /**setting、channelJoined 字段来自live.sig.js */
        "setting.chat"(bl) {
            if(!this.channelJoined){
                return false;
            }
            if (this.IS_CHAT_SWITCH_FIRST_CHANGE == 1) {
                if (bl) {
                    this.chatData.push({
                        content: {
                            msg: `老师开启了禁言模式`,
                            msg_type: 'tips'
                        }
                    })
                } else {
                    this.chatData.push({
                        content: {
                            msg: `老师关闭了禁言模式`,
                            msg_type: 'tips'
                        }
                    })
                }
            } else {
                this.IS_CHAT_SWITCH_FIRST_CHANGE = 1
            }
        }
    },
    mounted() {
        document.addEventListener('touchstart', () => {
            this.talkTextAreaPlace = "点此输入讨论内容";
            this.replySource = {}
        })

    },
    methods: {
        /**
         * 初始化数据
         */
        resetChatData(res){
            this.talkPage = 0;
            this.talkTotalPage = 0;
            this.chatPage = 0;
            this.chatTotalPage = 0;
            this.chatData =  [];
            this.talkList =  [];
            this.talkTextAreaContent =  "";
            this.talkTextAreaPlace =  "点此输入讨论内容";
            this.replySource =  {};
        },
        /**
         * 获取聊天数据
         * @param {String} 用户id,用于本地存储记录当前音频是否已听
         */
        getChatData(userid) {
            return new Promise(resolve=>{
                this.chatPage += 1;
                getKeepChat({
                    courseid: this.$route.query.id,
                    chattype: 1,
                    p:this.chatPage
                }).then(res => {
                    if(res.result === "success"){
                        res.chat.map(item => {
                            if (item.content && item.content.msg_type === 'audio') {
                                item.playing = false;
                                item.unread = localStorage[`AUDIO_READ_STATE${userid}${item.redisid}`] == 1 ? false : true
                            }
                            this.chatData.unshift(item)
                        });
                        if(this.chatPage == 1){
                            this.chatData.unshift({
                                membername: "微门户助手",
                                avatar: require("@/m/assets/audio-live/icon.jpg"),
                                content: {
                                    msg: `欢迎进入直播间
                                    <br>1、本次直播为语音图文直播，请确保手机为非静音状态。
                                    <br>2、直播界面显示讲师发布的内容，听众发言、提问可以在讨论区进行查看。
                                    <br>3、直播结束后，您可以随时回看全部内容。`,
                                    msg_type: 'text'
                                },
                                redisid:0
                            })
                        }
                        if(res.page){
                            this.chatTotalPage = res.page.total_pages
                        }
                    }else{
                        this.$toast(res.msg)
                    }
                    resolve()
                });
            
            })
        },
        /**
         * 获取讨论数据
         */
        getTalkData() {
            return new Promise(resolve => {
                this.talkPage += 1;
                getKeepChat({
                    courseid: this.$route.query.id,
                    chattype: 2,
                    p: this.talkPage
                }).then(res => {
                    if (res.result === 'success') {
                        res.chat.map(item => {
                            this.talkList.unshift(item)
                        });
                        if (res.page) {
                            this.talkTotalPage = res.page.total_pages
                            this.totalTalkPut = Number(res.page.totalput)
                            
                        }
                    } else {
                        this.$toast(res.msg)
                    }
                    resolve(res)
                });
            })
        },

        /**
         * 消息撤回
         * @param {Object} 撤回信息
         */
        handleWithdraw(info) {
            this.sendSigMsg({
                action: 'withdraw',
                data: info
            })
        },
        /**
         * 聊天区域滚动至顶部
         */
        chatScrollToUpper(){
            if(this.liveState != 1 && this.chatPage < this.chatTotalPage && !this.EXECUTING){
                this.EXECUTING = true;
                this.getChatData().then(res=>{
                    this.EXECUTING = false
                })
            }
        },
        /**
         * 讨论区域滚动至顶部
         */
        talkScrollToUpper() {
            if (this.talkPage < this.talkTotalPage && !this.EXECUTING) {
                this.EXECUTING = true;
                this.getTalkData().then(res => {
                    this.EXECUTING = false
                })
            }
        },
        /**
         * 处理回复选择变化
         * @param {Object}
         */
        handleReplySelected(item) {
            this.replySource = item;
            this.talkTextAreaPlace = `回复：${item.content.msg}`;
            this.$refs.talkTextArea.focus();
        },
        /**
         * 存储新消息
         * @param {String} 消息类别
         * @param {Object} 消息数据
         */
        addChatMsg(_action, _content) {
            return new Promise(resolve => {
                let _chatType = (_action === 'chat' && 1) || (_action === 'talk' && 2)
                addChat({
                    courseid: this.$route.query.id,
                    chattype: _chatType,
                    cid: this.$route.query.chapterid,
                    content: _content
                }).then(res => {
                    if (res.result === "success") {
                        this.sendSigMsg({
                            action: _action,
                            data: {
                                memberid: this.userInfo.userid,
                                membername: this.userInfo.username,
                                avatar: this.userInfo.avatar,
                                chattype: _chatType,
                                content: res.content,
                                redisid: res.redisid,
                                time: res.time
                            }
                        });
                        resolve();
                    } else {
                        this.$toast(res.msg);
                    }
                });
            });
        },
        /**
         * 发送讨论消息
         * @param {String} 消息内容
         */
        sendTalkMsg() {
            if (!this.talkTextAreaContent) {
                this.$refs.talkTextArea.focus();
                this.$toast("请先输入要发送的内容");
                return;
            }
            let msgData = {
                msg_type: 'text',
                msg_action: 'talk',
                msg: this.talkTextAreaContent
            };
            if (this.replySource.memberid) {
                msgData.msg_action = 'reply';
                msgData.reply_source = this.replySource;
            }
            this.sending = true;
            this.addChatMsg("talk", msgData).then(() => {
                this.replySource = {};
                this.talkTextAreaPlace = "点此输入讨论内容";
                this.talkTextAreaContent = "";
                this.sending = false;
            });
        },
        /**
         * 处理收到的聊天消息
         * @param {Object} 消息信息
         */
        handleReceiveChatMsg(msgData) {
            switch (msgData.action) {
                /**聊天消息 */
                case "chat":
                    if (
                        msgData.data.content &&
                        msgData.data.content.msg_type === "audio"
                    ) {
                        msgData.data.playing = false;
                        msgData.data.unread = true;
                    }
                    this.chatData.push(msgData.data);
                    break;
                /**讨论消息 */
                case "talk":
                    this.talkList.push(msgData.data);
                    this.totalTalkPut += 1;
                    break;
                /**消息撤回 */
                case "withdraw":
                    let _redisid = msgData.data.redisid;
                    let dataArr =
                        msgData.data.chattype == 1 ? this.chatData : this.talkList;
                    for (let i = 0; i < dataArr.length; i++) {
                        if (dataArr[i].redisid == _redisid) {
                            dataArr.splice(i, 1);
                            this.totalTalkPut -= 1;
                        }
                    }
                    break;
            }
        },
        /**
         * 发送红包, 通过红包订单编号验证红包是否有效
         */
        sendReward (_ordersn) {  
            checkOrdersn({
                ordersn:_ordersn
            }).then(res=>{
                if(res.result === 'success'){
                    this.addChatMsg('talk',{
                        msg_type: 'reward',
                        reward_number:res.price
                    })
                }
            })
        }
    }
}
export default instant_chat