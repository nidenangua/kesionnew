<template>
  <div :style="{minHeight:maxLength+'px',background:'#fff'}" v-if="show">
    <div class="wrapper">
      <div class="parents">
        <textarea class="ks-textarea" maxlength="144" autofocus="true" v-model="val"></textarea>
        <span class="tips">
          <span :class="{'remnant':remnant.length==0}">{{val.length}}</span>/
          <span :class="{'remnant':remnant.length!=0}">{{remnant}}</span>
        </span>
      </div>
    </div>
    <div class="add">
      <Media-Upload @change="onMediaUploadChange"/>
      <div class="publish">
        <ks-button width="100%" type="primary" @click="publish()">发表</ks-button>
      </div>
    </div>
  </div>
</template>
 
<script>
import MediaUpload from "../../components/media-upload";
// import MediaPreview from "../../components/media-preview";
// import { addFriends } from "@/api/social";
import { friendsaddFriends } from "@/api/friend";

export default {
  components: {
    MediaUpload
  },
  data() {
    return {
      show: false,
      val: "",
      maxLength: 144,
      /**地址 */
      info: [],
      /**类型 */
      type: ""
    };
  },
  computed: {
    remnant() {
      return this.maxLength - this.val.length;
    }
  },
  mounted() {},
  methods: {
    onMediaUploadChange(info) {
      this.info = info.info;
      if (info.type == "image") {
        this.type = "1";
      } else if (info.type == "video") {
        this.type = "2";
      } else if (info.type == "audio") {
        this.type = "3";
      } else {
        this.type = "0";
      };
      if(this.info.length == 0){
        this.type = "0";
      }
    },
    publish() {
      const params = { type: this.type, content: this.val, info: this.info };
      console.log(params)
      friendsaddFriends(params)
        .then(res => {
          if (res.result == "success") {
            this.$toast("发表成功", "success");
            (this.val = ""), (this.info = []);
            this.$navigateBack()
          }
        })
        .catch();
    }
  },
  activated() {
    this.show = true;
    document.title = "发布朋友圈"
  },
  deactivated() {
    this.show = false;
  }
};
</script>
<style scope>
.wrapper {
  padding: 10px;
}
.parents {
  width: 100%;
  height: 160px;
  position: relative;
}
textarea {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  border: 1px solid #e0e0e0;
  border-radius: 3px;
  font-size: 14px;
  padding: 10px;
}
.tips {
  position: absolute;
  bottom: 2px;
  right: 5px;
  font-size: 14px;
  color: #999;
}
.remnant {
  color: rgb(174, 178, 178);
}
.add {
  padding: 0 10px 10px 10px;
}
.add-box {
  float: left;
  margin-right: 5%;
  margin-bottom: 10px;
}
.add-box img {
  width: 5rem;
  height: 5rem;
  object-fit: cover;
}
.publish {
  padding-top: 40px;
  text-align: center;
  clear: both;
}
div.popContainer {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.3);
}
.add-btn {
  position: fixed;
  bottom: 0;
  padding: 10px;
  width: 95%;
}
.add-btn ul {
  text-align: center;
  font-size: 20px;
  border-radius: 10px;
  overflow: hidden;
}
.add-btn ul li {
  line-height: 48px;
  border-bottom: 1px solid #9999992b;
  background-color: rgba(255, 255, 255, 0.9);
}
.add-btn__cancel {
  margin-top: 10px;
}
</style>