<template>
  <div v-if="type">
    <div class="wechat-material-head clearfix">
      <div class="ks-fl" v-if="type === 'voice'">由于版本兼容的原因,你暂时只可以选择60秒内的语音发送</div>
      <div class="ks-fr">
        <el-button
          @click="updateMaterial()"
        >从微信更新{{(type === 'image' && '图片') || (type === 'video' && '视频') || (type === 'voice' && '语音')}}</el-button>
        <el-button type="primary" v-if="type === 'image'" @click="uploadFile('fileInputImage')">上传文件</el-button>
        <el-button
          type="primary"
          v-else-if="type === 'video'"
          @click="uploadFile('fileInputVideo')"
        >新建视频</el-button>
        <el-button
          type="primary"
          v-else-if="type === 'voice'"
          @click="uploadFile('fileInputVoice')"
        >新建语音</el-button>
        <input
          type="file"
          class="ks-hide"
          ref="fileInputVoice"
          accept=".mp3, .wma, .wav, .amr"
          @change="uploadFileChange"
        >
        <input
          type="file"
          class="ks-hide"
          ref="fileInputImage"
          accept=".bmp, .png, .jpeg, .jpg, .gif"
          @change="uploadFileChange"
        >
        <input
          type="file"
          class="ks-hide"
          ref="fileInputVideo"
          accept=".mp4"
          @change="uploadFileChange"
        >
      </div>
    </div>

    <div class="wechat-material ks-mt20">
      <ks-loading v-show="loading"/>
      <div class="wechat-material__photo" v-if="type === 'image'">
        <el-row class="wechat-material__photo__item_row" :gutter="15">
          <el-col :span="4" v-for="item in list" :key="item.id">
            <div class="wechat-material__photo__item" @click="selectItem(item)">
              <ks-create-bg :src="item.url" :ratio="1">
                <div class="ks-select-mask" v-show="item.id == current">
                  <i class="el-icon-check"></i>
                </div>
              </ks-create-bg>
              <div class="wechat-material__photo__item_title">
                <span class="ks-text-nowrap">{{item.title}}</span>
              </div>
            </div>
          </el-col>
        </el-row>
      </div>
      <div class="wechat-material__video" v-else-if="type === 'video'">
        <el-row :gutter="20">
          <el-col :span="8" v-for="item in list" :key="item.id">
            <div class="wechat-material__video__item" @click="selectItem(item)">
              <div class="ks-select-mask" v-show="item.id == current">
                <i class="el-icon-check"></i>
              </div>
              <div class="wechat-material__video__title">{{item.title}}</div>
              <div class="wechat-material__video__adddate">更新于 {{item.update_time}}</div>
              <ks-create-bg :ratio="9/16" :src="videoImg"/>
            </div>
          </el-col>
        </el-row>
      </div>
      <div v-else-if="type === 'voice'">
        <div class="wechat-material__voice">
          <el-row class="wechat-material__voice__item" v-for="item in list" :key="item.id">
            <el-col :span="16">
              <el-radio v-model="current" :label="item.id">{{item.title}}</el-radio>
            </el-col>
            <el-col :span="5">2019-03-04</el-col>
            <el-col :span="3">
              <div
                :class="currentPlay == item.id ? 'wechat-material__voice__playing_icon' : 'wechat-material__voice__play_icon'"
                @click="play(item)"
              ></div>
            </el-col>
          </el-row>
        </div>
      </div>
    </div>
    <div class="footer clearfix">
      <div class="ks-fl">
        <el-button type="primary" :disabled="current === null">确定</el-button>
        <el-button @click="$emit('update:visible',false)">取消</el-button>
      </div>
      <div class="ks-fr">
        <el-pagination
          @current-change="handleCurrentChange"
          :current-page.sync="page"
          :page-count="pageCount"
          layout="prev, pager, next"
          background
        ></el-pagination>
      </div>
    </div>
  </div>
</template>
<script>
import {
  wechatMaterialList,
  synchroMaterialList,
  wechatMaterialCount,
  getWechatAccessToken,
  uploadWeachtMaterial
} from "@/api/wechat";
export default {
  name: "SelectWechatMaterial",
  props: ["visible", "type"],
  data() {
    return {
      loading: true,
      /**
       * 分页信息
       */
      page: 1,
      pageCount: 1,
      /**
       * 当前选中的item id
       */
      current: null,
      /**
       * 当前正在播放的音频
       */
      currentPlay: null,
      /**
       * 默认video图片
       */
      videoImg: require("./video-bg.jpg"),
      /**
       * 微信accessToken
       */
      accessToken: "",
      /**
       * 素材列表
       */
      list: []
    };
  },
  methods: {
    /**
     * 选择
     */
    selectItem(item) {
      this.current = this.current == item.id ? null : item.id;
    },
    /**
     * 页数变化
     */
    handleCurrentChange() {},

    /**
     * 获取素材列表
     */
    getMaterialList(p = 1) {
      this.loading = true;
      wechatMaterialList({
        page: p,
        maxperpage: 12,
        type: this.type
      }).then(res => {
        if (res.result === "success") {
          let list = [];
          res.item.map(item => {
            if (item.list && item.list[0]) {
              list.push(item.list[0]);
            }
          });
          this.list = list;
          this.pageCount = res.page.total_pages;
          this.page = res.page.now_page;
        }

        this.loading = false;
      });
    },

    /**
     * 从微信更新素材
     */
    updateMaterial() {
      wechatMaterialCount({
        type: this.type
      }).then(res => {
        let count = 10; //每次更新数量
        let total_pages = Math.ceil(res.count.news_count / count);
        this.synchroMaterial(
          {
            count: count,
            offset: 0,
            type: this.type
          },
          total_pages,
          1
        );
      });
    },
    /**
     * 轮询请求更新素材
     * @param {Object} params
     */
    synchroMaterial(params, total, p) {
      synchroMaterialList(params).then(res => {
        if (p < total) {
          this.$showProgress("正在更新", Math.ceil((100 / total) * p));
          params.offset = params.offset + params.count;
          this.synchroMaterial(params, total, p + 1);
        } else {
          this.$showProgress("更新完成", 100);
          setTimeout(() => {
            this.$hideProgress();
            /**
             * 更新列表数据
             */
            this.getMaterialList();
          }, 500);
        }
      });
    },
    /**
     * 播放音频
     */
    play(item) {
      this.currentPlay = this.currentPlay == item.id ? null : item.id;
    },
    /**
     * 上传文件
     */
    uploadFile(name) {
      this.$refs[name].click();
    },
    uploadFileChange(file) {
      var formData = new FormData();
      formData.append("access_token", this.accessToken);
      formData.append("type", this.type);
      formData.append("media", file.target.files[0]);
      uploadWeachtMaterial(formData).then(res => {
        console.log(res);
      });
      //?access_token=ACCESS_TOKEN&type=TYPE
    }
  },
  mounted() {
    this.getMaterialList();
    /**
     * 获取微信accessToken
     */
    getWechatAccessToken().then(res => {
      if (res.result === "success") {
        this.accessToken = res.accesstoken;
      } else {
        this.$msg(res.msg);
      }
    });
  }
};
</script>

<style scoped>
.wechat-material-head {
  line-height: 40px;
}
.wechat-material {
  overflow-x: hidden;
  height: 460px;
  overflow-y: auto;
  position: relative;
}

/*图片*/
.wechat-material__photo__item_row {
  width: 100%;
}
.wechat-material__photo__item {
  border: 1px solid #eee;
  cursor: pointer;
  margin-top: 20px;
}
.wechat-material__photo__item .ks-create-bg {
  border-radius: 0px;
}

.wechat-material__photo__item_title {
  padding: 5px 10px;
}

/*语音*/
.wechat-material__voice__item {
  line-height: 42px;
  padding: 15px 0;
  border-bottom: 1px solid #eee;
  padding: 10px;
}

.wechat-material__voice__play_icon,
.wechat-material__voice__playing_icon {
  width: 42px;
  height: 42px;
  display: block;
  margin: 0 auto;
  cursor: pointer;
  background-repeat: no-repeat;
  background-size: 100%;
}
.wechat-material__voice__play_icon {
  background-image: url(./voice.png);
}
.wechat-material__voice__playing_icon {
  background-image: url(./voice-play.gif);
}

/*视频*/
.wechat-material__video__item {
  padding: 15px;
  border: 1px solid #eee;
  position: relative;
}
.wechat-material__video__item .ks-create-bg {
  border-radius: 0px;
}

.wechat-material__video__title {
  font-size: 18px;
}
.wechat-material__video__adddate {
  margin-bottom: 15px;
}

.footer {
  border-top: 1px solid #eee;
  padding-top: 20px;
}
</style>

