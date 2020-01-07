import {$get,$post} from './main.entrance'

export function getSignature(params){
    return new Promise(resolve=>{
        $get('/Plus/Kesion.ajax.php?act=uploadAliBos',params,{
            isFullUrl:true
        }).then(res=>{
            resolve(res)
        })
    })
}

export function uploadAliOSS(url,params){
    return new Promise(resolve=>{
        $post(url,params,{
            isFullUrl:true
        }).then(res=>{
            resolve(res)
        })
    })
}