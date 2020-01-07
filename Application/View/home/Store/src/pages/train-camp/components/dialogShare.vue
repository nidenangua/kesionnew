<template>
    <el-dialog title="分享" :visible.sync="dialogVisible" width="50%" :before-close="handleClose">
        <div class="share-dialog-container">
            <div class="share-dialog-container__header">
                <section>
                    <span :style="{color:shareObj.way=='link'?'#409eff':''}">分享链接</span>
                    <span :style="{color:shareObj.way!='link'?'#409eff':''}" @click="sharePoster">分享海报</span>
                </section>
            </div>
            <div class="share-dialog-container__main">
                <div class="by-link">
                    <h4>方法一 : 通过链接</h4>
                    <p>分享此链接到微信群和微信好友</p>
                    <p class="link">{{shareObj.link}}</p>
                    <el-button type="primary" size="small">复制链接</el-button>
                </div>
                <div class="by-qr-code">
                    <h4>方法二 : 通过二维码</h4>
                    <img src="" alt="">
                </div>
            </div>
        </div>
        <span slot="footer" class="dialog-footer"></span>
    </el-dialog>
</template>

<script>
export default {
  name: "dialogShare",
  props: {
    /**分享弹窗是否出现 */
    dialogVisible: {
      type: Boolean,
      default: false
    },
    /**
     * 分享的数据
     * {
     *    way:"link"  分享方法
     *    link:"http://t.cn/AipKRRyB" 分享链接
     *    qrCode:""  二维码
     * }
     */
    shareObj: {
      type: Object
    }
  },
  methods: {
    /**分享海报 */
    sharePoster() {
      this.$message({
        message: "开发中",
        type: "warning"
      });
    },
    /**
     * 告诉父组件分享弹窗要关闭了
     */
    handleClose(){
        this.$emit("closeShare")
    }
  }
};
</script>

<style scoped>
.share-dialog-container__header {
  display: flex;
  justify-content: center;
}
.share-dialog-container__header section {
  border: 1px solid #eeeeee;
  font-size: 0;
  height: 40px;
  display: flex;
  align-items: center;
}
.share-dialog-container__header span {
  color: #9999b3;
  font-weight: bold;
  font-size: 14px;
  height: 100%;
  padding: 0 20px;
  line-height: 40px;
}
.share-dialog-container__header span:first-child {
  border-right: 1px solid #eeeeee;
}
.share-dialog-container__main {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}
.share-dialog-container__main .by-link,
.share-dialog-container__main .by-qr-code {
  padding: 0 50px;
  text-align: center;
}
.share-dialog-container__main .by-qr-code {
  padding-left: 80px;
}
.share-dialog-container__main .by-link {
  border-right: 1px solid #eeeeee;
}
.share-dialog-container__main .by-link .link {
  color: #409eff;
  margin: 10px 0 20px;
}
.share-dialog-container__main .by-qr-code img {
  display: inline-block;
  width: 150px;
  height: 150px;
  background-color: #606266;
}
</style>
