<template>
  <div>
    <plv-vod-uploader
      :wxid="wxid"
      ref="plvVodComponent"
      @change="vodChange"
      @progress="vodProgress"
      @uploaded="vodUploaded"
      v-if="options.type === 'polyv'" />
    <tc-vod-uploader
      :wx-id="wxid"
      ref="tcVodComponent"
      @change="vodChange"
      @progress="vodProgress"
      @uploaded="vodUploaded"
      v-else
    />
    <el-dialog
      width="400px"
      :title="vod.progress < 100 ? '正在上传' : '上传成功'"
      :visible.sync="vod.visible"
      v-if="vod.visible"
      :show-close="false"
    >
      <div class="vod__file_name">上传文件：{{vod.fileName}}</div>
      <el-progress :percentage="vod.progress" v-if="vod.progress < 100"></el-progress>
      <el-progress :percentage="vod.progress" status="success" v-else></el-progress>
    </el-dialog>
  </div>
</template>
<script>
import store from '@/store'
import TcVodUploader from '@/plugins/tcvod'
import PlvVodUploader from '@/plugins/polyv-vod'
export default {
  name: "UploadVod",
  components: {
    TcVodUploader,
    PlvVodUploader
  },
  data() {
    return {
      options:{
        type:'polyv'
      },
      wxid:0,
      vod: {
        fileName: "",
        progress: 0,
        visible: false
      }
    };
  },
  methods: {
    /**
     * 上传视频文件
     */
    uploadVideoFile(options) {
      this.options = options
      this.$nextTick(()=>{
        switch(options.type){
          case 'polyv':
            this.$refs.plvVodComponent.start()
            break
          default:
            this.$refs.tcVodComponent.start()
        }
      })
    },
    /**
     * 上传视频，文件进入
     */
    vodChange(file) {
      this.vod.fileName = file.name;
      this.vod.progress = 0;
      this.vod.visible = true;
    },
    /**
     * 上传视频，进度变化
     */
    vodProgress(progress) {
      this.vod.progress = progress;
    },
    vodUploaded(res) {
      this.vod.visible = false
      if(typeof this.options.onUploaded === 'function'){
        this.options.onUploaded(res)
      }
    }
  },
  mounted() {
    store.onStoreReady().then(info=>{
      this.wxid = info.wxid
    })
    
  }
};
</script>
<style scoped>
.vod__file_name {
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  margin-bottom: 10px;
}
</style>

