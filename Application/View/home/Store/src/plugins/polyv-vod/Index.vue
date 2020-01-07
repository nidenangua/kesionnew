<template>
    <div>
        <input style="display:none" type="file" ref="plvVodFile" @change="fileChange">
    </div>
</template>
<script>
import { addVodList } from "@/api/tcvod";
import { getServiceKey } from '@/api/tcvod'
import PlvVideoUpload from '@polyv/vod-upload-js-sdk'
export default {
    name:'PolyvVod',
    props:{
        wxid:[String,Number]
    },
    mounted(){
        this.plvVideoUpload = new PlvVideoUpload({
            events: {
                Error: (err) => { 
                    console.log(err);
                },
                UploadComplete: () => {
                    
                }
            }
        })
        
    },
    methods:{
        /**
         * 调用上传方法
         */
        start() {
            this.$refs.plvVodFile.click();
        },
        /**
         * 文件进入
         */
        fileChange(e){

            let file = e.target.files[0]
            /**
             *  常见在线流媒体格式mp4、flv、f4v、webm

                移动设备格式：m4v、mov、3gp、3g2

                RealPlayer ：rm、rmvb

                微软格式 ：wmv、avi、asf

                MPEG 视频 ：mpg、mpeg、mpe、ts

                DV格式 ：div、dv、divx

                其他格式 ：vob、dat、mkv、lavf、cpk、dirac、ram、qt、fli、flc、mod
                */
            let formatArr = [
                "mp4",
                "flv",
                "f4v",
                "webm",
                "m4v",
                "mov",
                "3gp",
                "3g2",
                "rm",
                "rmvb",
                "wmv",
                "avi",
                "asf",
                "mpg",
                "mpeg",
                "mpe",
                "ts",
                "div",
                "dv",
                "divx",
                "vob",
                "dat",
                "mkv",
                "lavf",
                "cpk",
                "dirac",
                "ram",
                "qt",
                "fli",
                "flc",
                "mod"
            ];
            let fileFormat = file.name.match(/\.\w+/gi)
            if (fileFormat) {
                fileFormat = fileFormat[fileFormat.length - 1]
                fileFormat = fileFormat.toLowerCase()
                fileFormat = fileFormat.split(".")[1]
                let licit = false
                formatArr.map(format => {
                    if (format === fileFormat) {
                        licit = true
                    }
                });
                if (!licit) {
                    this.$msg("请选择媒体格式文件")
                } else {
                    this.addFile(file)
                }
            } else {
                this.$msg("请选择媒体格式文件")
            }
        },
       
        /**
         * 添加上传文件
         */
        addFile(file){
            this.updatePolyvData().then(()=>{
                this.plvVideoUpload.addFile(file,{
                    FileStarted:uploadInfo=>{ // 文件开始上传回调
                        this.$emit('change',file)
                    },
                    FileProgress:uploadInfo=> { // 文件上传过程返回上传进度信息回调
                        this.$emit('progress',Math.round(uploadInfo.progress * 100))
                    },
                    FileStopped: uploadInfo=> { // 文件暂停上传回调
                        console.log("文件上传停止: " + uploadInfo.fileData.title);
                    },
                    FileSucceed: uploadInfo=> { // 文件上传成功回调
                        
                         /**
                         * 上传完成记录到数据库
                         */
                        let {title:name,vid:mediaId} = uploadInfo.fileData
                        addVodList({
                            vdoService: 11,
                            name,
                            mediaId,
                            wxid: this.wxid
                        }).then(res => {
                            if(res.result === 'success'){
                                this.$emit('uploaded',uploadInfo)
                            }else{
                                console.error(res.msg);
                            }
                            if (res.result === "error") {
                                console.error(res.msg);
                            }
                            
                        });
                    },
                    FileFailed: uploadInfo=> { // 文件上传失败回调
                        console.log("文件上传失败: " + uploadInfo.fileData.title);
                    }
                },{
                    title:file.name,
                    luping:1,
                    keepsource:0
                })
                this.plvVideoUpload.startAll()
            })
        },
        /**
         * 更新保利威账号信息
         */
        updatePolyvData(){
            return new Promise(resolve=>{
                getServiceKey().then(res=>{
                    if(res.result === 'success'){
                        let {userid,ptime,sign,hash} = res.detail
                        this.plvVideoUpload.updateUserData({
                            userid , // Polyv云点播账号的ID
                            ptime , // 时间戳，注意：系统时间不正确会导致校验失败
                            sign, // 是根据将secretkey和ts按照顺序拼凑起来的字符串进行MD5计算得到的值
                            hash, // 是根据将ts和writeToken按照顺序拼凑起来的字符串进行MD5计算得到的值
                        })
                        resolve()
                    }else{
                        this.$msg(res.msg)
                    }
                })
            })
            
        },
    }
}
</script>
<style scoped>

</style>