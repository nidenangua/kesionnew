var Utils;
(function(){
    var letters = [];
    for (var i = 65; i < 91; i++) {
        letters.push(String.fromCharCode(i));
    }
    Utils = {
        /**
         * 数组遍历
         * @param {Array} data 
         * @param {Function} fn 
         */
        map:function(data,fn){
            if(data instanceof Array){
                for(var i=0;i<data.length;i++){
                    typeof fn === 'function' && fn(data[i],i)
                }
            }else{
                return false
            }
        },
        /**
         * 判断数据是数组还是对象
         */
        isArrayOrObject:function(data){
            let callType = Object.prototype.toString.call(data)
            let type = false
            if(callType === '[object Array]'){
                type = 'Array'
            }else if(callType  === '[object Object]'){
                type = 'Object'
            }
            return type
        },
        
        /**
         * 根据下标返回字母
         * @param {Number}
         */
        getLetter:function(i) {
            return letters[i]
        },
        
        /**
         * 根据子母返回下标
         * @param {Number}
         */
        getLetterIndex:function(letter){
            var index = 0;
            letters.map(function(ltr,i){
                if(ltr == letter){
                    index = i
                }
            })
            return index
        },
        /**
         * 判断是否滚动至底部
         */
        getIsScrolltolower:function(el){
            var isScrolltolower = false;
            if (el) {
                if (el.scrollTop + el.offsetHeight >= el.scrollHeight) {
                    isScrolltolower = true
                }
            } else {
                if (window.scrollY + window.innerHeight >= document.getElementsByTagName('body')[0].scrollHeight) {
                    isScrolltolower = true
                }
            }
    
            return isScrolltolower
        },
        /**
         * 判断手机号
         */
        isPoneAvailable:function(str) {
            var myreg = /^[1][3,4,5,7,8,9][0-9]{9}$/;
            if (!myreg.test(str)) {
                return false;
            } else {
                return true;
            }
        },
		/**
		     * 获取时间（仿微信消息格式）
		     */
		    getHistoryTime:function (time,SERVER_TIME){
		        if(typeof time === 'string'){
		            time = time.replace(/\-/g,'/');
		        }
		        var createTime = new Date(time);
		        var diff = SERVER_TIME - createTime;
		        if (diff <= 3000)
		            return '刚刚';
		        else if (diff <= (60*1000))
		            return "1分钟内";
		        else if (diff <= (1000 * 60 * 60))
		            return parseInt(diff /  (60*1000)) + '分钟前';
		        else if (diff <= (1000 * 60 * 60))
		            return parseInt(diff / (1000 * 60 * 60)) + '小时前';
		        else if (diff <= (1000 * 60 * 60 * 12) * 2) {
		            var list = createTime.toString().split(" ");
		            var lastIndex = list[4].lastIndexOf(":")
		            var realtime = list[4].toString().substring(0, lastIndex);
		            return realtime;
		        } else if (diff < (1000 * 60 * 60 * 24 * 1) * 7) {
		            if (diff < (1000 * 60 * 60 * 24 * 1)) {
		                return parseInt(diff / (1000 * 60 * 60 * 12)) + '天前';
		            }
		            var t = createTime.toString().slice(0, 3);
		            switch (t) {
		            case "Mon":
		                return '星期一';
		            case "Tue":
		                return '星期二';
		            case "Wed":
		                return '星期三';
		            case "Thu":
		                return '星期四';
		            case "Fri":
		                return '星期五';
		            case "Sat":
		                return '星期六';
		            case "Sun":
		                return '星期日';
		            }
		        } else if (diff < (1000 * 60 * 60 * 24 * 30)*24) {
		            var list = createTime.toString().split(" ");
		            var month = list[1];
		            var realtime = "";
		            if (diff < (1000 * 60 * 60 * 24 * 30)) {
		            realtime += getNumberMonth(month);
		            } else {
		            realtime = list[3] + "-" + getNumberMonth(month);
		            }
		            return realtime + "-" + list[2];
		        }
		    }
    }
})();
export default Utils