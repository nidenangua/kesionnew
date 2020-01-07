import axios from 'axios'

function setNoPowerPage() {
    let body = document.getElementsByTagName('body')[0];
    body.innerHTML = `
        <div class="ktj-nopower">
            对不起，您暂无该页面的访问权限
            <div class="ktj-red ktj-mt10 ktj-cursor-pointer" onclick="location.href='/home.php'">点我回首页</div>
        </div>
    `
}

function dellError(data) {
    if (data.result === 'error') {
        if (data.code === 'nopower') {
            setNoPowerPage()
        } else if (data.code === 'nologin') {
            top.location.href = '/login'
        } else {
            return true
        }
    } else {
        return true
    }

}

export function $post(act, params) {
    return new Promise(resolve => {
        let url = `/Json/index.php?act=${act}`
        axios.post(url, params).then(res => {
            let pathKeys = act.split('.');
            let key = pathKeys[pathKeys.length - 1];
            let data = res.data[key] ? res.data[key] : res.data;

            if (dellError(data)) {
                resolve(data)
            }
        })
    })
}

export function $get(act, params) {
    return new Promise(resolve => {
        let obj = '';
        if (params) {
            obj = {
                params: params
            }
        }
        let url = `/Json/index.php?act=${act}`
        axios.get(url, obj).then(res => {
            let pathKeys = act.split('.');
            let key = pathKeys[pathKeys.length - 1];
            let data = res.data[key] ? res.data[key] : res.data;
            if (dellError(data)) {
                resolve(data)
            }
        })
    })
}