/**
 * 主要功能：用于快速创建声网的信令登录方法，提供发送消息以及消息通知回调方法，提供当前在线人员列表。
 * 容易混淆命名说明： uid是指系统的用户id  sid是指信令id（不存在用户表，仅用于信令的登录，做法目的是解决多个房间同一个用户id，信令会冲突的问题）
 * 编写：zhuang
 */
require('@/agora-sig/AgoraSig-1.4.3.2')
import { editBanned, editLiveSetting, getLiveKey, getStudentListBySID } from "@/api/live";
let Session;
let Channel;
/**当前在线的用户的信令id（数组） */
let CurSigids = null;
/**当前用户的信令id */
let SigID = "";
/**主播的信令id */
let HostSigID = "";
/**进入过该直播间的的用户列表，用户离开不会在该列表被清除 */
let UserList = [];
const live = {
    data() {
        return {

            /**直播状态 */
            liveState: 0,
            /**1 一对一，2小班，3大班，4 语音 */
            liveType: 0,
            /**直播间标题 */
            title: "",
            setting: {
                /**upperwall 是否允许用户上墙
                 * audio 是否允许发语音
                 * chat 是否允许聊天
                 */
            },
            /**当前时间 */
            currentTime: 0,
            /**当前用户是否是管理员（助教、主讲、主持人都属于管理员） */
            isAdmin: false,
            /**当前用户是否是主讲 */
            isTeacher: false,
            /**老师信息 */
            teacherInfo: {},
            /**学生信息 */
            userInfo: {},
            /**已禁言的用户列表 */
            bannedList: [],
            /**在线用户列表 */
            studentList: []
        }
    },
    methods: {
        /**
         * 初始化信令信息
         */
        resetSigKeyInfo() {
            this.channelJoined = false;
            this.liveState = 0;
            this.liveType = 0;
            this.title = "";
            this.setting = {};
            this.currentTime = 0;
            this.isAdmin = false;
            this.isTeacher = false;
            this.teacherInfo = {};
            this.userInfo = {};
            this.bannedList = [];
            this.studentList = [];
            UserList = [];
            if (Session) {
                Session.logout()
            }
        },
        /**获取声网需要用到的appid,key并登录 */
        getSigKeyInfo() {
            document.title = "";
            getLiveKey({
                courseid: this.$route.query.id,
                chapterid: this.$route.query.chapterid
            }).then(res => {
                document.title = res.course_title;
                this.title = res.course_title;
                if (res.result === 'success') {
                    this.bannedList = res.banned_list;
                    this.liveType = res.livetype;
                    this.currentTime = Number(res.time);
                    setInterval(() => {
                        this.currentTime += 1
                    }, 1000)
                    this.setting = res.setting;
                    this.userInfo = {
                        avatar: res.avatar,
                        userid: res.userid,
                        username: res.username
                    };
                    this.teacherInfo = {
                        name: res.teacher_name,
                        avatar: res.teacher_headpic,
                        teacherid: res.teacherid
                    };
                    this.liveState = res.live_status;
                    this.isAdmin = res.role > 0;
                    this.isTeacher = this.userInfo.userid == this.teacherInfo.teacherid;
                    this.getKeyInfo = function() {
                        return {
                            appid: res.appid,
                            channelKey: res.channel_key,
                            channelName: res.channel_name,
                            userid: Number(res.userid),
                            sigid: res.sigid,
                            username: res.username,
                            teacherid: res.teacherid
                        }
                    }
                    SigID = res.sigid.toString();
                    this.loginSig(res.appid, SigID, res.sign_key).then(
                        (session, sid) => {
                            this.channelJoined = true;
                            Channel = session.channelJoin(res.channel_name);
                            Channel.onChannelJoined = this.handleChannelJoined(session.account);
                            Channel.onMessageChannelReceive = this.handleMessageChannelReceive;
                            Channel.onChannelUserList = this.handleChannelUserList;
                            Channel.onChannelUserJoined = function() {
                                /**
                                 * onChannelUserJoined 其他用户加入回调
                                 * 该方法弃用，监听学员加入改成通过频道消息 action为10 来做加入回调
                                 */
                            };
                            Channel.onChannelUserLeaved = this.handleChannelUserLeaved;
                            /**添加发送频道消息方法 */
                            this.messageChannelSend = Channel.messageChannelSend;

                        }
                    );
                    if (typeof this.onGetKeySuccesed === 'function') {
                        this.onGetKeySuccesed(res)
                    }
                } else {
                    if (typeof this.onGetKeyError === 'function') {
                        this.onGetKeyError(res)
                    }
                }
            });
        },
        /**
         * 登录信令
         * @param {String} 该项目的 App ID
         * @param {String} 用户登录厂商 app 的账号，最大 128 字节可见字符（不能使用空格）。可以是用户的 uid、昵称、guid 等任何内容，但必须保证唯一。
         * @param {String} 由 App ID 和 App Certificate 生成的 SignalingToken
         * @param {Number} 最高重连次数（默认 10 次）
         * @param {Number} 最高重连时间 (默认 30 秒)
         */
        loginSig(appid, account, token, reconnect_count = 10, reconnect_time = 30) {
            return new Promise(resolve => {

                /**获取 Signal 对象 */
                let signal = Signal(appid);
                /**使用该方法登录 Agora 信令系统，它返回一个 session  */
                Session = signal.login(
                    account,
                    token,
                    reconnect_count,
                    reconnect_time
                );
                /**
                 * 登录成功回调
                 * @param {Number}
                 */
                Session.onLoginSuccess = sid => {
                    /**添加点对点消息发送方法 */
                    this.messageInstantSend = Session.messageInstantSend
                        /**接收到点对点消息 */
                    Session.onMessageInstantReceive = this.handleMessageInstantReceive;
                    /**监听当前用户离开 */
                    window.onbeforeunload = e => {
                        this.sendSigMsg({
                            action: 'userLeaved',
                            data: {
                                sigid: SigID,
                                userid: this.userInfo.userid
                            }
                        })
                        if (typeof this.onBeforeUserLeaved === 'function') {
                            this.onBeforeUserLeaved(SigID, this.userInfo.userid)
                        }
                    }
                    resolve(Session, sid);
                };
                Session.onLoginFailed = sid => {
                    this.$toast("信令连接失败");
                };
                Session.onLogout = ecode => {
                    if (this.channelJoined) {
                        this.$confirm("您意外退出了,是否重新连接？").then(() => {
                            location.reload()
                        });
                    }
                }
            });
        },
        /**
         * 处理接收到到的点对点消息
         * @param {String} 发送者的用户id（系统分配的信令id）
         * @param {Number} 发送者的用户id（声网分配,用不到，回调处转为了系统的用户id）
         * @param {String} 返回的消息，可转成json的字符串类型
         */
        handleMessageInstantReceive(account, agora_uid, msg) {
            msg = JSON.parse(msg);
            /**回调 */
            if (typeof this.onMessageInstantReceive === 'function') {
                let uid = this.getUInfoBySID(account).userid;
                this.onMessageInstantReceive(account, uid, msg)
            }
        },

        /**
         * 接收到频道消息
         * @param {String} 发送者的用户id（系统）
         * @param {Number} 发送者的用户id（声网分配,用不到，回调处转为了系统的用户id）
         * @param {String} 返回的消息，可转成json的字符串类型
         */
        handleMessageChannelReceive(account, agora_uid, msg) {
            msg = JSON.parse(msg);
            if (msg.action == 10) {
                this.addStudent(msg);
                /**新用户加入回调 */
                if (typeof this.onChannelUserJoined === 'function') {
                    this.onChannelUserJoined(account, msg.userid)
                }
            } else if (msg.action === 'userLeaved') {
                this.handleChannelUserLeaved(msg.data.sigid)
            } else if (msg.action === 'setting') {
                this.setting = msg.data
            } else if (msg.action === 'banned') {
                /**去除相同，避免存在多个 */
                this.bannedList.map((userid, i) => {
                    if (`${userid}` === `${msg.data.userid}`) {
                        this.bannedList.splice(i, 1)
                    }
                })
                if (msg.data.switch) {
                    if (`${this.userInfo.userid}` === `${msg.data.userid}`) {
                        this.$toast('你也被管理员禁言')
                    }
                    this.bannedList.push(msg.data.userid)
                } else {
                    if (`${this.userInfo.userid}` === `${msg.data.userid}`) {
                        this.$toast('管理员解除了你的禁言')
                    }
                }
            }
            /**回调 */
            if (typeof this.onMessageChannelReceive === 'function') {
                let uid = this.getUInfoBySID(account).userid;
                this.onMessageChannelReceive(account, uid, msg)
            }
        },
        /**
         * 当前在线成员(默认方法)
         * @param {Array}
         */
        handleChannelUserList(users) {
            let sids = [];
            users.map(item => {
                sids.push(item[0])
            });
            CurSigids = sids;
        },

        /**
         * 加入频道成功
         * @param {String} 当前用户id（系统分配的信令id）
         */
        handleChannelJoined(account) {
            /**
             * 准备执行加入成功后的回调，需要在用户队列信息得到后才执行
             */
            if (CurSigids === null) {
                setTimeout(() => {
                    this.handleChannelJoined(account)
                }, 200)
            } else {
                getStudentListBySID({
                    courseid: this.$route.query.id,
                    sigid: CurSigids
                }).then(res => {
                    if (res.result === 'success') {
                        res.list.map(item => {
                            this.addStudent(item)
                        })
                        let uid = this.getUInfoBySID(account).userid;
                        /**因为新用户返回的信息过少，调整方案为发送信令，通过信令获取用户详细信息 */
                        this.sendUserMsg(10);
                        /**回调 */
                        if (typeof this.onChannelJoined === 'function') {
                            this.onChannelJoined(account, uid)
                        }
                    }
                })
            }
        },

        /**
         * 处理用户离开
         * @param {String} 离开者id（系统分配的信令id）
         */
        handleChannelUserLeaved(account) {
            let uid = this.getUInfoBySID(account).userid;
            this.removeStudent(account)
                /**回调 */
            if (typeof this.onChannelUserLeaved === 'function') {
                this.onChannelUserLeaved(account, uid)
            }
        },
        /**
         * 移除在线用户
         * @param {String} 离开者id（系统分配的信令id）
         */
        removeStudent(account) {
            this.studentList.map((item, i) => {
                if (`${item.sigid}` === `${account}`) {
                    this.studentList.splice(i, 1)
                }
            })
        },
        /**
         * 添加在线用户
         * @param {Object} 用户基本信息
         */
        addStudent(uinfo) {
            if (`${uinfo.userid}` === `${this.teacherInfo.teacherid}`) {
                HostSigID = uinfo.sigid
            }
            let has = false;
            this.studentList.map((item, i) => {
                if (`${item.userid}` === `${uinfo.userid}`) {
                    has = true;
                }
                if (`${item.userid}` === `${this.teacherInfo.teacherid}`) {
                    HostSigID = item.sigid
                }
            });
            let hasRecord = false;
            UserList.map(item => {
                if (`${item.userid}` === `${uinfo.userid}`) {
                    hasRecord = true;
                }
            })
            if (!has) {
                this.studentList.push(uinfo);
            }
            if (!hasRecord) {
                UserList.push(uinfo)
            }
        },

        /**
         * 通过信令id获取用户详细信息
         */
        getUInfoBySID(sid) {
            let uinfo = {
                username: '游客'
            }
            UserList.map(item => {
                if (`${item.sigid}` === `${sid}`) {
                    uinfo = {
                        userid: item.userid,
                        sigid: item.sigid,
                        avatar: item.avatar,
                        username: item.username
                    }
                }
            })
            return uinfo
        },

        /**
         * 禁言
         * @param {Number} 要禁言或解除禁言的用户id
         */
        banned(uid) {
            editBanned({
                courseid: this.$route.query.id,
                cid: this.$route.query.chapterid,
                userid: uid
            }).then(res => {
                if (res.result === 'success') {
                    let _switch = true;
                    this.bannedList.map((userid, i) => {
                        if (`${userid}` === `${uid}`) {
                            _switch = false
                        }
                    })
                    this.sendSigMsg({
                        action: 'banned',
                        data: {
                            userid: uid,
                            switch: _switch
                        }
                    })
                }
            })
        },
        /**
         * 判断当前用户是否为禁言状态
         * @param {Number} 用户id
         */
        getIsBanned(uid) {
            if (this.bannedList.includes(uid)) {
                return true
            } else {
                return false
            }
        },
        /**
         * 发送信令消息入口
         * @param {Object}
         */
        sendSigMsg(msg) {
            if (!this.messageChannelSend) {
                return;
            } else {
                this.messageChannelSend(JSON.stringify(msg));
            }
        },
        /**
         * 发送频道消息附带个人信息
         * @param {String} 行动类型，通过行动类型不同，执行不同的处理
         * @param {Object} 除了个人信息外，要附带的其他信息
         */
        sendUserMsg(action, data) {
            var msg = {
                action: `${action}`,
                sigid: SigID,
                userid: this.userInfo.userid,
                username: this.userInfo.username,
                avatar: this.userInfo.avatar
            };
            if (typeof data === "object") {
                let keys = Object.keys(data);
                keys.map(k => [(msg[k] = data[k])]);
            }
            this.sendSigMsg(msg);
        },
        /**
         * 修改直播间的配置
         * @param {String} 
         */
        setConfSwitch(key) {
            if (!this.isTeacher) {
                this.$toast('无操作权限')
                return
            }
            /**EXECUTING不放于data中，主要用于判断避免用户多次连续点击，多次执行请求 */
            if (this.EXECUTING === true) {
                return;
            }
            this.EXECUTING = true;
            this.setting[key] = !this.setting[key];
            editLiveSetting({
                courseid: this.$route.query.id,
                setting: this.setting
            }).then(res => {
                if (res.result === "success") {
                    this.sendSigMsg({
                        action: 'setting',
                        data: this.setting
                    });
                    this.EXECUTING = false;
                }
            });
        },
        /**
         * 发送消息给教师
         */
        sendMsgToTeacher(msg) {
            /**
             * HostSigID在主播加入频道成功后，可获取到
             */
            if (HostSigID) {
                this.messageInstantSend(HostSigID, JSON.stringify(msg));
            }
        }
    }
}

export default live