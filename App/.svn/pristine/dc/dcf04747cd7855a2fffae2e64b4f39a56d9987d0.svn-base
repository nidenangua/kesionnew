/**
 * 主要功能：用于创建视频互动直播，包括计费方法。
 * 编写：zhuang
 */
import AgoraRTC from 'agora-rtc-sdk'
AgoraRTC.Logger.setLogLevel(AgoraRTC.Logger.ERROR);
let Client, LocalStream;
let RemoteStreamList = {};
/**声网项目appid */
let AppID = "";
/**加入频道需要的key */
let ChannelKey = "";
/**加入的频道名 */
let ChannelName = "";
/**当前的用户id */
let UID = "";
/**主播（老师）id */
let HostID = "";
/**信令id，用于登录聊天与视频互动频道 */
let SigID = "";
/**当前用户的角色(主播或听众) */
let Role = "";
const live_RTC = {
    data() {
        return {

            /**主播视频设置 */
            hostConf: {},
            /**观众视频流列表 */
            audienceList: [],
            /**计算用户离开时间，超过15秒则视为断开，并结束计费 */
            leaveTimer: []

        }
    },
    mounted() {
        /**监测用户离开 */
        setInterval(() => {
            this.leaveTimer.map(item => {
                if (item.second >= 15) {
                    this.streamRemovedBilling(item.sid, item.uid)
                } else {
                    item.second += 1
                }
            })
        }, 1000)
    },
    methods: {
        /**
         * 创建 Client 对象
         */
        createClient(info) {
            AppID = info.appid;
            ChannelKey = info.channelKey;
            ChannelName = info.channelName;
            UID = info.userid;
            HostID = info.teacherid;
            SigID = info.sigid;
            Role = `${UID}` === `${HostID}` ? "host" : "audience";
            Client = AgoraRTC.createClient({ mode: 'live', codec: "h264" });
            this.clientInit();

        },
        /**
         * 初始化 Client 对象
         * 创建 Client 对象后，将项目的 App ID 填入 client.init 方法，即可初始化 Client。
         */
        clientInit() {
            Client.enableAudioVolumeIndicator(); //开启声音大小监测
            Client.init(AppID, () => {
                this.clientJoin()
            }, function(err) {
                console.log("AgoraRTC client init failed", err);
            });

        },
        /**
         * 加入频道
         */
        clientJoin() {
            Client.join(ChannelKey, ChannelName, SigID, sid => {
                //设置 role（用户角色）。role 分为 “host”（主播）和 “audience”（观众）。
                Client.setClientRole(Role, () => {
                    console.log(`set ${Role} success`);
                }, function(e) {
                    console.log(`set ${Role} failed`, e);
                })
                Client.on('stream-added', this.onStreamAdded);
                Client.on('stream-subscribed', this.onStreamSubscribed)
                Client.on("peer-leave", this.onPeerLeave);
                Client.on("mute-audio", this.onMuteAudio);
                Client.on("unmute-audio", this.onUnmuteAudio);
                Client.on("mute-video", this.onMuteVideo);
                Client.on("unmute-video", this.onUnmuteVideo);
                Client.on("volume-indicator", this.onVolumeIndicator);
                if (typeof this.onChientJoined === 'function') {
                    this.onChientJoined(SigID, UID)
                }
                /**创建音视频流 */
                if (this.audienceList.length <= 16) {
                    this.createStream()
                }

            }, err => {
                console.log("Join channel failed", err);
            });
        },
        /**
         * 关闭频道
         */
        closeClient() {
            Client.leave(() => {
                console.log("client leaves channel");
            }, err => {
                console.log("client leave failed ", err);
            });
            this.hostConf = {}
            this.audienceList = []
            this.leaveTimer = []
        },
        /**
         * 创建音视频流
         */
        createStream() {
            /**
             * @param streamID：音视频流 ID。设置为用户 ID （uid），可通过 client.join 的回调获取。
             * @param audio: 是否开启音频。
             * @param video: 是否开启视频。
             * @param screen: 是否开启屏幕共享功能。请勿将 video 和 screen 同时设置为 true 。
             */
            LocalStream = AgoraRTC.createStream({
                streamID: SigID,
                audio: true,
                video: true,
                screen: false
            });

            /**初始化音视频流 */
            LocalStream.init(() => {
                if (Role === 'host') {
                    this.hostConf = {
                        audio: 1, //音频状态 0无音频 1存在音频 2音频通道禁止 
                        video: 1, //视频状态 0无视频 1存在视频 2视频通道禁止 
                        voice: 0, //声音大小等级 最高100
                        leave: false,
                        sid: SigID
                    };
                } else {
                    /**getUInfoBySID 方法来自live.sig.js */
                    let uinfo = this.getUInfoBySID(SigID);
                    /**开启音频轨道，但默认停止发送音频 */
                    LocalStream.muteAudio();
                    this.audienceList.push({
                        audio: 2,
                        video: 1,
                        voice: 0,
                        leave: false,
                        sid: SigID,
                        uid: uinfo.userid,
                        uname: uinfo.username
                    });
                }
                this.$nextTick(() => {
                    LocalStream.play(`STREAM_PLAYER${SigID}`);
                    this.publishStream()
                })

            }, err => {
                console.log("getUserMedia failed", err);
            });
            LocalStream.on('accessAllowed', this.onAccessAllowed)
            LocalStream.on('accessDenied', this.onAccessDenied)
        },
        /**
         * 已获取本地摄像头／麦克风使用权限 
         */
        onAccessAllowed() {
            console.log('Stream access allowed')
        },
        /**
         * 已禁止本地摄像头／麦克风使用权限
         */
        onAccessDenied() {
            this.$layer.alert('无法获取摄像头/麦克风，请检查是否有设备或已开启使用权限。')
        },
        /**
         * 发布本地音视频流
         */
        publishStream() {
            Client.publish(LocalStream, err => {
                console.log("Publish local stream error: " + err);
            });
            Client.on('stream-published', evt => {
                console.log("Publish local stream successfully");
            });
        },
        /**
         * 当有人发布音视频流到频道里时
         */
        onStreamAdded(evt) {
            let stream = evt.stream;
            let sid = stream.getId();
            if (`${sid}` !== `${SigID}`) {
                /**订阅远端音视频流 */
                Client.subscribe(stream, err => {
                    console.log("Subscribe stream failed", err);
                });
            }

        },

        /**
         * 订阅流成功
         */
        onStreamSubscribed(evt) {
            let remoteStream = evt.stream;
            let _sid = remoteStream.getId();
            /**getUInfoBySID 方法来自live.sig.js */
            let uinfo = this.getUInfoBySID(_sid);
            let uid = uinfo.userid;
            this.removeLeaveTimerItem(_sid);

            if (`${uid}` === `${HostID}`) {
                /**初始化，重置播放器内容与设置 */
                this.hostConf = {};
                remoteStream.unmuteAudio();
                remoteStream.unmuteVideo();
                this.$nextTick(() => {
                    this.hostConf = {
                        audio: 1,
                        video: 1,
                        voice: 0,
                        leave: false,
                        sid: _sid
                    }
                    RemoteStreamList[_sid] = remoteStream
                    this.$nextTick(() => {
                        remoteStream.play(`STREAM_PLAYER${_sid}`);
                    })
                })

            } else {

                /**去重 */
                this.audienceList.map((item, i) => {
                    if (`${_sid}` === `${item.sid}`) {
                        this.audienceList.splice(i, 1)
                    }
                })
                remoteStream.muteAudio();
                remoteStream.unmuteVideo();
                this.$nextTick(() => {
                    /**观众默认停止播放音频轨道 */
                    this.audienceList.push({
                        audio: 2,
                        video: 1,
                        voice: 0,
                        leave: false,
                        sid: _sid,
                        uid: uinfo.userid,
                        uname: uinfo.username
                    })
                    RemoteStreamList[_sid] = remoteStream
                    this.$nextTick(() => {
                        remoteStream.play(`STREAM_PLAYER${_sid}`);
                    })
                })
            }
            console.log("Subscribe stream successfully");
        },

        /**
         * 用户在语音通话中将自己的声音关掉
         */
        onMuteAudio(evt) {
            let sid = evt.uid;
            if (`${sid}` === `${this.hostConf.sid}`) {
                this.hostConf.voice = 0;
                this.hostConf.audio = 2
            } else {
                this.audienceList.map(item => {
                    if (`${sid}` === `${item.sid}`) {
                        item.voice = 0;
                        item.audio = 2
                    }
                })
            }
            console.log("mute audio:" + sid);
        },
        /**
         * 用户在语音通话中将自己的声音打开
         */
        onUnmuteAudio(evt) {
            let sid = evt.uid;
            if (`${sid}` === `${this.hostConf.sid}`) {
                this.hostConf.audio = 1
            } else {
                this.audienceList.map(item => {
                    if (`${sid}` === `${item.sid}`) {
                        item.audio = 1
                    }
                })
            }
            console.log("unmute audio:" + sid);
        },
        /**
         * 用户在视频通话中将自己的视频关掉
         */
        onMuteVideo(evt) {
            let sid = evt.uid;
            if (`${sid}` === `${this.hostConf.sid}`) {
                this.hostConf.video = 2
            } else {
                this.audienceList.map(item => {
                    if (`${sid}` === `${item.sid}`) {
                        item.video = 2
                    }
                })
            }
            console.log("mute video:" + sid);
        },
        /**
         * 用户在视频通话中将自己的视频打开
         */
        onUnmuteVideo(evt) {
            let sid = evt.uid;
            if (`${sid}` === `${this.hostConf.sid}`) {
                this.hostConf.video = 1
            } else {
                this.audienceList.map(item => {
                    if (`${sid}` === `${item.sid}`) {
                        item.video = 1
                    }
                })
            }
            console.log("unmute video:" + sid);
        },
        /**
         * 提示频道内正在说话的远端用户及其音量
         */
        onVolumeIndicator(evt) {
            evt.attr.forEach((volume, index) => {
                let sid = volume.uid;
                if (`${sid}` === `${this.hostConf.sid}` && this.hostConf.audio == 1) {
                    this.hostConf.voice = volume.level * 2
                } else {
                    this.audienceList.map(item => {
                        if (`${item.sid}` === `${sid}` && item.audio == 1) {
                            item.voice = volume.level * 2
                        }
                    })
                }
            });
        },
        /**
         * 用户已离开频道
         */
        onPeerLeave(evt) {
            let sid = evt.uid;
            /**设置用户离开状态 */
            if (`${sid}` === `${this.hostConf.sid}`) {
                this.hostConf.leave = true
                console.log("remote teacher left ", sid);
            } else {
                this.audienceList.map(item => {
                    if (`${sid}` === `${item.sid}`) {
                        item.leave = true
                    }
                })
                console.log("remote user left ", sid);
            }
            let uTimer;
            this.leaveTimer.map(item => {
                if (`${item.sid}` === `${sid}`) {
                    uTimer = item;
                }
            })
            if (uTimer) {
                uTimer.second = 0;
            } else {
                let uinfo = this.getUInfoBySID(sid);
                this.leaveTimer.push({
                    uid: uinfo.userid,
                    sid: sid,
                    second: 0
                })
            }
        },

        /**
         * 设置流的视频、音频状态
         * @param {Number} 媒体唯一id（信令id）
         * @param {Boolean} 音视频开关
         * @param {String} 类别
         */
        setStreamConf(sid, flag, type) {
            if (type === 'audio') {
                if (`${sid}` === `${SigID}`) {
                    if (Role === 'host') {
                        this.$layer.msg(`${flag ? '打开' : '关闭'}了音频通道`);
                    } else {
                        this.$layer.msg(`老师${flag ? '打开' : '关闭'}了你的音频权限`);
                    }
                    flag ? LocalStream.unmuteAudio() : LocalStream.muteAudio()
                } else {
                    flag ? RemoteStreamList[sid].unmuteAudio() : RemoteStreamList[sid].muteAudio()
                }
            } else if (type === 'video') {
                if (`${sid}` === `${SigID}`) {
                    if (Role === 'host') {
                        this.$layer.msg(`${flag ? '打开' : '关闭'}了视频通道`);
                    } else {
                        this.$layer.msg(`老师${flag ? '打开' : '关闭'}了你的视频权限`);
                    }
                    flag ? LocalStream.unmuteVideo() : LocalStream.muteVideo()
                } else {
                    flag ? RemoteStreamList[sid].unmuteVideo() : RemoteStreamList[sid].muteVideo()
                }
            }
            if (`${sid}` === `${this.hostConf.sid}`) {
                this.hostConf[type] = flag ? 1 : 2
            } else {
                this.audienceList.map(item => {
                    if (`${item.sid}` === `${sid}`) {
                        item[type] = flag ? 1 : 2
                    }
                })
            }
        },
        /**
         * 从离开者监测列表清除
         */
        removeLeaveTimerItem(sid) {
            this.leaveTimer.map((item, i) => {
                if (`${item.sid}` === `${sid}`) {
                    this.leaveTimer.splice(i, 1)
                }
            })
        },
        /**
         * 视频流断开，结束计费
         */
        streamRemovedBilling(sid, uid) {
            if (`${sid}` === `${this.hostConf.sid}`) {
                /**主播断开 */
                this.hostConf = {};

            } else {
                /**学员断开了音视频，从远程视频流列表移除该学员的视频流 */
                this.audienceList.map((item, i) => {
                    if (`${item.sid}` === `${sid}`) {
                        this.audienceList.splice(i, 1)
                    }
                });

            }
            this.removeLeaveTimerItem(sid);

            console.log("remote stream was removed", sid)
        }
    }
}
export default live_RTC