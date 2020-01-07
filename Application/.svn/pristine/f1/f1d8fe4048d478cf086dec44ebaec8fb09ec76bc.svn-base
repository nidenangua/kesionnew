import { $post } from './main.entrance'

/**
 * 获取资料列表
 */
export function getMaterialsList(params) {
    return new Promise((resolve) => {
        $post(`Microportal.Common.getMaterialsList`, params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 修改资料开放状态
 */
export function changeMaterialsOpen(params) {
    return new Promise((resolve) => {
        $post(`Microportal.store.changeMaterialsOpen`, params).then(res => {
            resolve(res)
        })
    })
}
/**
 * 添加资料
 */
export function addMaterials(params) {
    return new Promise((resolve) => {
        $post(`Microportal.store.addMaterials`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 删除课程资料
 */
export function delMaterials(params) {
    return new Promise((resolve) => {
        $post(`Microportal.store.delMaterials`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 添加课程资料
 */
export function addCourseMaterials(params) {
    return new Promise((resolve) => {
        $post(`Microportal.store.addCourseMaterials`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取资料
 */
export function getMaterialsDetail(params) {
    return new Promise((resolve) => {
        $post(`Microportal.store.getMaterialsDetail`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取资料文件列表
 */
export function getFileList(params) {
    return new Promise((resolve) => {
        $post(`Home.store.getFileList`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 删除资料
 */
export function delFile(params) {
    return new Promise((resolve) => {
        $post(`Home.store.delFile`, params).then(data => {
            resolve(data)
        })
    })
}