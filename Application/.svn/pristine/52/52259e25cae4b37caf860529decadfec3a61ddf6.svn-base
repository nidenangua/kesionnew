<template>
  <div v-if="visible">
    <div v-if="step===1 && helpInfo" class="model">
      <div v-if="helpInfo.is_finish==0">
        <div class="model-layer" @click="close"></div>
        <div class="model-content">
          <div class="model-content-avatar">
            <img v-if="helpInfo.head" :src="helpInfo.head">
            <img v-else src="./assets/default-avatar.jpg">
          </div>
          <div class="ks-text-center model-content-des">
            获得
            <span>{{helpInfo.num}}</span>个好友助力，即可获得免费听课资格
          </div>
          <div class="ks-mt20 model-content-share">
            <ks-button plain width="50%" style="margin-right:5px;" @click="shareFriend">分享给好友</ks-button>
            <ks-button
              type="primary"
              width="50%"
              style="margin-left:5px;"
              @click="makePoster"
            >生成分享海报</ks-button>
          </div>
          <div
            v-if="helpInfo.count==0"
            class="ks-mt30 ks-text-center model-content-already-help"
          >暂时还未有好友为你助力，快去分享吧！</div>
          <div
            v-else
            class="ks-mt30 ks-text-center model-content-already-help"
          >已有{{helpInfo.count}}名好友为你助力了，继续加油~</div>
          <div class="ks-mt10 ks-line"></div>
          <div class="model-content-helpfri-list">
            <div class="model-content-helpfri-item" v-for="item in + helpInfo.num" :key="item">
              <ks-image
                v-if="helpfriItemStyle(item)"
                :src="helpfriItemStyle(item)"
                type="user"
                class="model-content-item-user"
              />
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="model-layer" @click="close"></div>
        <div class="model-content">
          <div class="model-content-avatar">
            <img v-if="helpInfo.head" :src="helpInfo.head">
            <img v-else src="./assets/default-avatar.jpg">
          </div>
          <div class="ks-text-center model-content-des">恭喜您已经完成助力快领取您的课程吧~</div>
          <div class="ks-mt20 model-content-share">
            <ks-button type="primary" width="350px" v-if="helpInfo.is_buy==1" @click="goCourse">已领取</ks-button>
            <ks-button type="primary" width="350px" v-else @click.once="getCourse">领取课程</ks-button>
          </div>
          <div
            class="ks-mt30 ks-text-center model-content-already-help"
          >已有{{helpInfo.count}}名好友为你助力了！</div>
          <div class="ks-mt10 ks-line"></div>
          <div class="model-content-helpfri-list">
            <div class="model-content-helpfri-item" v-for="item in + helpInfo.num" :key="item">
              <ks-image
                v-if="helpfriItemStyle(item)"
                :src="helpfriItemStyle(item)"
                type="user"
                class="model-content-item-user"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else-if="step===2" class="model">
      <div class="model-layer"></div>
      <div class="model-share-pic" @click="close">
        <img src="@/m/components/market-tool/friend-help/assets/icon.png">
        <div class="model-share-pic-text">
          <p class="model-share-pic-lesson">免费好课</p>
          <p class="model-share-pic-help">邀请好友助力</p>
          <p class="model-share-pic-get">领取免费课程</p>
        </div>
      </div>
    </div>
    <div v-else-if="step===3 && helpInfo" class="model">
      <div class="model-layer" @click="close"></div>
      <div class="model-content">
        <div class="model-content-avatar">
          <img v-if="helpInfo.head" :src="helpInfo.head">
          <img v-else src="./assets/default-avatar.jpg">
        </div>
        <div class="ks-text-center model-content-des">
          获得
          <span>{{helpInfo.num}}</span>个好友助力，即可获得免费听课资格
        </div>
        <div class="ks-mt20 model-content-share">
          <ks-button type="primary" width="350px" @click="helpFriend">为好友助力</ks-button>
        </div>
        <div
          v-if="helpInfo.count==0"
          class="ks-mt30 ks-text-center model-content-already-help"
        >暂时还未有好友为他助力，去助力！</div>
        <div
          v-else
          class="ks-mt30 ks-text-center model-content-already-help"
        >已有{{helpInfo.count}}名好友为他/她助力！</div>
        <div class="ks-mt10 ks-line"></div>
        <div class="model-content-helpfri-list">
          <div class="model-content-helpfri-item" v-for="item in + helpInfo.num" :key="item">
            <ks-image
              v-if="helpfriItemStyle(item)"
              :src="helpfriItemStyle(item)"
              type="user"
              class="model-content-item-user"
            />
          </div>
        </div>
      </div>
    </div>
    <div v-else-if="step===4 && helpInfo" class="model">
      <div class="model-layer" @click="close"></div>
      <div class="model-content">
        <div class="model-content-avatar">
          <img v-if="helpInfo.head" :src="helpInfo.head">
          <img v-else src="./assets/default-avatar.jpg">
        </div>
        <div class="ks-text-center model-content-help-result">{{helpInfo.msg}}</div>
        <div class="ks-mt20 model-content-share">
          <ks-button plain width="50%" style="margin-right:5px;" @click="officialAccounts">关注公众号</ks-button>
          <ks-button type="primary" width="50%" style="margin-left:5px;" @click="gotoClass">我也要去听课</ks-button>
        </div>
        <div
          class="ks-mt30 ks-text-center model-content-already-help"
        >已有{{helpInfo.count}}名好友为他/她助力！</div>
        <div class="ks-mt10 ks-line"></div>
        <div class="model-content-helpfri-list">
          <div class="model-content-helpfri-item" v-for="item in + helpInfo.num" :key="item">
            <ks-image
              v-if="helpfriItemStyle(item)"
              :src="helpfriItemStyle(item)"
              type="user"
              class="model-content-item-user"
            />
          </div>
        </div>
      </div>
    </div>
    <div v-else-if="step===5">
      <div class="model-layer model-layer-canvas" @click="close"></div>
      <canvas
        v-if="canvasWidth && canvasHeight"
        :width="canvasWidth*2"
        :height="canvasHeight*2"
        :style="{width:canvasWidth+'px',height:canvasHeight+'px'}"
        class="canvas"
        ref="canvas"
      ></canvas>
      <div class="model-canvas-save">长按保存图片，发微信好友或微信群</div>
      <img
        v-if="canImg"
        :src="canImg"
        :style="{width:canvasWidth+'px',height:canvasHeight+'px'}"
        class="canImg"
      >
    </div>
  </div>
</template>
<script>
import { addHelp, showHelp, assistance, showBill } from "@/api/friends.help.js";
export default {
  name: "FriendHelp",
  props: {
    /**是否显示 */
    visible: {
      type: Boolean,
      default: false
    },
    /**模板索引 */
    step: {
      type: Number,
      default: 1
    },
    /**活动id */
    marketid: {
      type: [String, Number]
    },
    /**商品id */
    goodsid: {
      type: [String, Number]
    },
    /**助力id */
    id: {
      type: [String, Number]
    },
    /**类型 */
    type: {
      type: [String, Number]
    },
    /**课程信息 */
    courseInfo: {
      type: Object,
      default() {
        return {};
      }
    }
  },
  data() {
    return {
      /**助力信息 */
      helpInfo: null,
      /**画布宽度 */
      canvasWidth: window.innerWidth * 0.88,
      /**画布高度 */
      canvasHeight: (window.innerWidth * 0.88) / 0.69,
      canImg: ""
    };
  },
  mounted() {
    if (this.visible) {
      this.getInfo();
    }
  },
  computed: {
    helpfriItemStyle() {
      return function(index) {
        if (this.helpInfo.json && this.helpInfo.json.length >= index) {
          if (this.helpInfo.json[index - 1].portrait) {
            return this.helpInfo.json[index - 1].portrait;
          } else {
            return require("./assets/default-avatar.jpg");
          }
        } else {
          return false;
        }
      };
    }
  },
  watch: {
    visible: function() {
      if (this.visible) {
        this.getInfo();
      }
    }
  },
  methods: {
    /**分享给好友 */
    shareFriend() {
      this.$router.push({
        name: "CourseView",
        params: { id: this.$route.params.id },
        query: { helpid: this.helpInfo.id }
      });
      this.$emit("update:step", 2);
      /**配置微信分享 */
      this.$wxShare({
        title: "我正参与课程接力，快来参加吧！",
        desc: this.courseInfo.title,
        imgUrl: this.courseInfo.defaultpic
      });
    },
    /** 生成分享海报 */
    makePoster() {
      this.$showLoading();
      if (this.courseInfo.iscopy == 1) {
        this.$antiCopy(false);
      }
      this.$emit("update:step", 5);
      this.$emit("update:id", this.helpInfo.id);

      this.$nextTick(() => {
        this.getInfo();
      });
    },
    /**为好友助力 */
    helpFriend() {
      this.$emit("update:step", 4);
      this.helpInfo = null;
      this.$nextTick(() => {
        this.getInfo();
      });
    },
    /**关注公众号 */
    officialAccounts() {
      location.href =
        "https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzUxNDU2NTc1Mw==&scene=124#wechat_redirect";
    },
    /**我也要去听课 */
    gotoClass() {
      this.$emit("update:visible", false);
      this.$router.push({
        name: "CourseView",
        params: { id: this.$route.params.id }
      });
      location.reload();
    },
    /**创建img标签 */
    createImage(src, type, ipComparison) {
      return new Promise(resolve => {
        if(src.startsWith === "http://thirdwx.qlogo.cn"){
          src = src.replace('http:','https:')
        }
        let canvasImg = new Image();
        canvasImg.crossOrigin = "Anonymous";
        if (ipComparison) {
          let imgOrign = src.match(/https?:\/\/?[^/]+/);
          if (
            (imgOrign && imgOrign[0] == location.origin) ||
            (imgOrign && imgOrign[0] == "https://obj.kesion.com") ||
            (imgOrign && imgOrign[0] == "https://thirdwx.qlogo.cn")
          ) {
            canvasImg.src = src;
          } else {
            if (type == "default") {
              canvasImg.src = require("./assets/img-icon.png");
            } else if (type == "user") {
              canvasImg.src = require("./assets/default-avatar.jpg");
            } else {
              canvasImg.src = src;
            }
          }
        } else {
          canvasImg.src = src;
        }
        canvasImg.onload = () => {
          resolve(canvasImg);
        };
        canvasImg.onerror = () => {
          switch (type) {
            case "user":
              resolve(require("./assets/default-avatar.jpg"));
              break;
            default:
              resolve(require("./assets/img-icon.png"));
          }
        };
      });
    },
    /**领取课程 */
    getCourse() {
      this.$pay({
        type: "13",
        id: this.$route.params.id,
        json: { start_id: this.helpInfo.id }
      });
    },
    /**返回课程页 */
    goCourse() {
      this.$router.push({
        name: "CourseView",
        params: { id: this.$route.params.id }
      });
    },
    /**关闭弹窗 */
    close() {
      this.$emit("update:step", 1);
      this.$emit("update:visible", false);
    },
    /**根据step类型发送请求 */
    getInfo() {
      if (this.step == 1) {
        addHelp({
          marketid: this.marketid,
          goodsid: this.goodsid,
          type: this.type
        }).then(res => {
          this.helpInfo = res;
        });
      } else if (this.step == 3) {
        showHelp({ id: this.id }).then(res => {
          if (res.is_me == 1) {
            this.$emit("update:step", 1);
            this.$emit("update:marketid",res.marketid)
            this.getInfo();
            return false;
          }
          if (res.is_finish == 1) {
            this.$emit("update:step", 4);
            this.getInfo();
          } else {
            this.helpInfo = res;
          }
        });
      } else if (this.step == 4) {
        assistance({ id: this.id }).then(res => {
          if ((res.result = "error" && res.msg == "你不能为自己助力")) {
            this.$toast(res.msg);
            this.$emit("update:step", 1);
            this.$emit("update:visible", false);
            this.$router.push({
              name: "CourseView",
              params: { id: this.$route.params.id }
            });
            return;
          }
          this.helpInfo = res;
        });
      } else if (this.step == 5) {
        showBill({ id: this.id }).then(res => {
          const canvas = this.$refs.canvas;
          const ctx = canvas.getContext("2d");
          this.createImage(require("./assets/canvas_bg.png")).then(canvasBg => {
            this.createImage(res.defaultpic, "default", true).then(
              canvasBan => {
                this.createImage(res.qrcode, "default", true).then(qrcode => {
                  this.createImage(res.portrait, "user", true).then(avatar => {
                    this.createImage(
                      require("./assets/canvas-avatar-bg.png")
                    ).then(avatarBg => {
                      this.createImage(
                        require("./assets/canvas-round-gray-bg.png")
                      ).then(avatarGrayBg => {
                        let canWidth = this.canvasWidth * 2;
                        ctx.drawImage(
                          canvasBg,
                          0,
                          0,
                          canWidth,
                          canWidth / 0.69
                        );
                        ctx.drawImage(
                          canvasBan,
                          0,
                          0,
                          canWidth,
                          canWidth / 1.777
                        );
                        ctx.textAlign = "center";
                        ctx.font = "28px Arial bold";
                        ctx.fillText(
                          res.course_title,
                          canWidth * 0.5,
                          canWidth * 0.62,
                          canWidth * 0.95
                        );
                        ctx.fillStyle = "#999999";
                        ctx.font = "24px Arial";
                        ctx.fillText(
                          (res.teacher_name
                            ? "授课老师: " + res.teacher_name + " | "
                            : "") +
                            "价值" +
                            res.price +
                            "元的付费知识",
                          canWidth * 0.5,
                          canWidth * 0.68
                        );
                        ctx.drawImage(
                          avatar,
                          canWidth * 0.05,
                          canWidth * 0.72,
                          canWidth * 0.16,
                          canWidth * 0.16
                        );
                        ctx.drawImage(
                          avatarBg,
                          canWidth * 0.05,
                          canWidth * 0.72,
                          canWidth * 0.16,
                          canWidth * 0.16
                        );
                        ctx.drawImage(
                          avatarGrayBg,
                          canWidth * 0.21,
                          canWidth * 0.72,
                          canWidth * 0.74,
                          canWidth * 0.16
                        );
                        ctx.textAlign = "left";
                        ctx.fillText(
                          "我很想学习这门课程，需要" + res.num + "个好友助力，",
                          canWidth * 0.23,
                          canWidth * 0.79
                        );
                        ctx.fillText(
                          "快来为我助力吧~",
                          canWidth * 0.23,
                          canWidth * 0.84
                        );
                        ctx.drawImage(
                          qrcode,
                          canWidth / 3,
                          canWidth * 0.95,
                          canWidth / 3,
                          canWidth / 3
                        );
                        ctx.textAlign = "center";
                        ctx.fillText(
                          "长按识别二维码， 为我助力吧",
                          canWidth * 0.5,
                          canWidth * 1.37
                        );
                        this.canImg = canvas.toDataURL("image/png");
                        this.$hideLoading();
                      });
                    });
                  });
                });
              }
            );
          });
        });
      }
    }
  }
};
</script>
<style scoped>
.model {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1000;
}
.model-layer {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: black;
  opacity: 0.7;
}
.model-layer-canvas {
  z-index: 200;
}
.model-content {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 70%;
  /* height: 0%; */
  padding: 10px;
  box-sizing: border-box;
  background-color: white;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  animation: show 0.3s;
}
@keyframes show {
  from {
    height: 0%;
  }
  to {
    height: 70%;
  }
}
.model-content-avatar {
  height: 30px;
  position: relative;
}
.model-content-avatar img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: 2px solid #e44c3e;
  position: absolute;
  left: 50%;
  top: -35px;
  transform: translateX(-50%);
}
.model-content-des,
.model-content-already-help {
  color: #999999;
}
.model-content-des span {
  color: #e54a38;
  font-size: 14px;
  font-weight: bold;
}
.ks-button {
  font-weight: normal;
}
.model-content-share {
  padding: 0 10px;
  display: flex;
  justify-content: space-between;
}

.model-content-helpfri-item {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  margin-left: 8px;
  margin-top: 5px;
  display: inline-block;
  background-color: #f7f7f7;
  overflow: hidden;
}
.model-content-item-user {
  width: 100%;
  height: 100%;
  border-radius: 50%;
}

.model-share-pic {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.model-share-pic img {
  position: absolute;
  top: 40px;
  right: 40px;
  width: 250px;
}
.model-share-pic-text {
  position: absolute;
  right: 136px;
  top: 210px;
  text-align: center;
}
.model-share-pic-lesson {
  color: #d82524;
  font-size: 24px;
  font-weight: bold;
}
.model-share-pic-help {
  margin-top: 47px;
  color: white;
  margin-bottom: 3px;
}
.model-share-pic-get {
  color: white;
  font-size: 18px;
  font-weight: bold;
}
.model-content-help-result {
  font-weight: bold;
  font-size: 18px;
}
.model-canvas {
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  box-sizing: border-box;
  z-index: 1001;
}
.canvas {
  transform: scale(0.5);
  z-index: 200;
  position: fixed;
  top: 30px;
  left: 50%;
  transform: translateX(-50%);
  border-radius: 10px;
  display: none;
}
.model-canvas-save {
  z-index: 200;
  width: 100%;
  color: #fff;
  position: fixed;
  top: 510px;
  left: 0;
  text-align: center;
}
.canImg {
  z-index: 200;
  position: fixed;
  top: 30px;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  border-radius: 10px;
}
</style>