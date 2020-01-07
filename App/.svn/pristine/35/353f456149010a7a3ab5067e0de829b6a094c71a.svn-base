
function $post(act,params){
    return new Promise(resolve=>{
        axios.post('/Json/index.php?act='+act,params).then(function(res){
            let keys = act.match(/\w+/g);
            let key = keys[keys.length-1];
            res = res.data[key] ? res.data[key] : res.data;
            resolve(res)
        })
        .catch(function(error){
            console.error(error)
        })
    })
    
}


function $get(act,params){
    return new Promise(function(resolve){
        var _params = '';
        if(params){
            _params = {
                "params":params
            }
        }
        axios.get('/Json/index.php?act='+act,_params).then(function(res){
            let keys = act.match(/\w+/g);
            let key = keys[keys.length-1];
            res = res.data[key] ? res.data[key] : res.data;
            resolve(res)
        })
        .catch(function(error){
            console.error(error)
        })
    })
    
}