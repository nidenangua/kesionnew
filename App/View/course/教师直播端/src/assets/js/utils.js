
/**
 * 遍历对象
 * @method map
 */
function domap(data,fn){
    if(typeof data === 'object' && data.length){
        for(let i=0;i<data.length;i++){
            typeof fn === 'function' && fn(data[i],i)
        }
    }else{
        return false
    }
}

/**
 * 请求服务器数据
 * @method request
 */
function request(url,data,fn,type){
    var xhr = new XMLHttpRequest();
    var requestType = typeof data === 'object' ? 'POST' : 'GET'
    xhr.open(requestType, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // 添加http头，发送信息至服务器时内容编码类型
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {
            switch (type){
                case "json":
                    fn.call(this, JSON.parse(xhr.responseText))
                    break;
                default:
                    fn.call(this, xhr.responseText)
                    break;
            }
        }
    };
    if(requestType === 'POST'){
        xhr.send(JSON.stringify(data))
    }else{
        xhr.send()
    };
    
}

export {domap,request}

