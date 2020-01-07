
/**
 * 判断手机号
 */
function isPoneAvailable(str) {
    var myreg=/^[1][3,4,5,7,8,9][0-9]{9}$/;
    if (!myreg.test(str)) {
        return false;
    } else {
        return true;
    }
}
/**
 * 时间格式
 */
function countdown(nowTime,timestamp){
    var endTime = timestamp
    var t = endTime - nowTime
    var format = {}
    if (t > 0) {
        var day = Math.floor(t / 86400000)
        var hour = Math.floor((t / 3600000) % 24)
        var min = Math.floor((t / 60000) % 60)
        var sec = Math.floor((t / 1000) % 60)
        hour = hour < 10 ? '0' + hour : hour
        min = min < 10 ? '0' + min : min
        sec = sec < 10 ? '0' + sec : sec
        
        format = {
            day:day,
            hour:hour,
            min:min,
            sec:sec
        }
    } else {
        format = {
            day:0,
            hour:0,
            min:0,
            sec:0
        }
    } 
    return format
}

/**
 * 判断数据是数组还是对象
 */
function isArrayOrObject(data){
    let callType = Object.prototype.toString.call(data)
    let type = false
    if(callType === '[object Array]'){
        type = 'Array'
    }else if(callType  === '[object Object]'){
        type = 'Object'
    }
    return type
}
/**
 * 拷贝对象
 */
function cloneObject(obj){
    let newObj = new Object();
    let keys = Object.keys(obj);
    keys.map(key=>{
        let item = obj[key];
        let itemCallType = isArrayOrObject(item)
        if(itemCallType === 'Array'){
            let arrItem = cloneArray(item)
            newObj[key] = arrItem
        }else if(itemCallType === 'Object'){
            let objItem = cloneObject(item)
            newObj[key] = objItem
        }else{
            newObj[key] = item
        }
    })
    return newObj
}

/**
 * 拷贝数组
 */
function cloneArray(arr){
    let newArr = new Array();
    arr.map(item=>{
        let itemCallType = isArrayOrObject(item)
        if(itemCallType === 'Array'){
            let arrItem = cloneArray(item)
            newArr.push(arrItem)
        }else if(itemCallType === 'Object'){
            let objItem = cloneObject(item)
            newArr.push(objItem)
        }else{
            newArr.push(item)
        }
    })
    
    return newArr
}

/**
 * 深度克隆数据
 */
function cloneData(data){
    let dataCallType = isArrayOrObject(data);
    let newData = dataCallType === 'Array' ? cloneArray(data) : cloneObject(data);
    return newData
}

/**
 * 删除对象某个字段
 */
function deleteObject(obj,key){
    let keys = Object.keys(obj);
    let newObj = {};
    keys.map(k=>{
        if(k!== key){
            newObj[k] = obj[k]
        }
    })
    return newObj
}

/**
 * 监听是否滚动到底部
 */
function getIsScrolltolower(el){
    var isScrolltolower = false;
    if(el){
        if(el.scrollTop + el.offsetHeight >= el.scrollHeight){
            isScrolltolower = true
        }
        
    }else{
        if(window.scrollY + window.innerHeight >= document.getElementsByTagName('body')[0].scrollHeight){
            isScrolltolower = true
        }
    }
    return isScrolltolower
}

/*
*获取合适的大小
*containerArea 容器宽高
*contentArea 内容宽高
*/
function getSuitableArea(containerArea,contentArea){
    
    let scale = contentArea.width / contentArea.height,w,h,
        containerScale = containerArea.width / containerArea.height;

    if(scale > containerScale){
        w = containerArea.width;
        h = contentArea.height*(containerArea.width/contentArea.width)
        
    }else{
        h = containerArea.height;
        w = contentArea.width*(containerArea.height/contentArea.height)
    }

    return {
        width:w,
        height:h
    }
}

/**
 * 获取url参数
 */
function getParams(_search){
    let locationSearch = _search || location.search
    let params = {}
    if(locationSearch){
        let splitArr = locationSearch.split('?')[1]
        if(splitArr){
            splitArr = splitArr.split('&')
        }
        
        splitArr.map(str=>{
            let strSplit = str.split('=')
            params[strSplit[0]] = strSplit[1]
        })
        
    }
    return params
}

export {
    countdown,
    getIsScrolltolower,
    isArrayOrObject,
    cloneObject,
    cloneArray,
    cloneData,
    deleteObject,
    getSuitableArea,
    isPoneAvailable,
    getParams
}