
function runFn(fn){
    if(typeof fn === 'function'){
        fn()
    }
}

function playerMonitor(player, params = {}) {
    this.player = player;
    params.on = params.on || {};
    this.params = params;
    switch (params.type) {
        case 'tencent':
        case 'aliyun':
            player.on('ready', () => {
                console.log("ready");
                runFn(params.on.ready)
            })
            player.on('play', () => {
                console.log("play");
                runFn(params.on.play)
            })
            player.on('seeking', (res) => {
                console.log("seeking");
                runFn(params.on.seeking)
            })
            player.on('pause', () => {
                console.log("pause");
                runFn(params.on.pause)
            })
            player.on('error', () => {
                console.log("error");
                runFn(params.on.error)
            })
            player.on('ended', () => {
                console.log('ended');
                runFn(params.on.ended)
            })
            break
    }
    return this
}

/**
 * 获取视频总时长
 */
playerMonitor.prototype.getDuration = function (resolve) {
    let duration;
    switch (this.params.type) {
        case 'tencent':
            if(this.player.duration){
                duration = this.player.duration()
            }
            break
        case 'aliyun':
            duration = this.player.getDuration()
            break
    }
    if(duration > 0){
        resolve(duration)
    }else{
        this.getDuration(resolve)
    }
}

/**
 * 获取当前播放时间
 */
playerMonitor.prototype.getCurrentTime = function () {
    switch (this.params.type) {
        case 'tencent':
            return this.player.currentTime()
            break
        case 'aliyun':
            return this.player.getCurrentTime()
            break
    }
}

/**
 * 播放
 */
playerMonitor.prototype.play = function () {
    switch (this.params.type) {
        case 'tencent':
        case 'aliyun':
            this.player.play()
            break
    }
}

/**
 * 暂停
 */
playerMonitor.prototype.pause = function () {
    switch (this.params.type) {
        case 'tencent':
        case 'aliyun':
            this.player.pause()
            break
    }
}

/**
 * 拖动进度条
 */
playerMonitor.prototype.seek = function (time) {
    switch (this.params.type) {
        case 'tencent':
            this.player.play(time)
            break
        case 'aliyun':
            this.player.seek(time)
            break
    }
}

export default playerMonitor