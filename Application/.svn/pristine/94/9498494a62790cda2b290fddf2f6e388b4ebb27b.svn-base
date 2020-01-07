<template>
  <div>
    <div class="popup" v-for="item in popupList" :key="item.id">
      <el-dialog
        :visible.sync="item.visible"
        :width="item.width"
        :title="item.title"
        @closed="popupClose(item.id)"
      >
        <iframe
          :name="'popupFrame'+item.id"
          class="popup__frame"
          :src="item.url"
          v-if="item.url"
          :style="{height:item.height}"
        />
        <div class="popup__content" v-else-if="item.content" v-html="item.content"></div>
      </el-dialog>
    </div>
  </div>
</template>
<script>
let popupIndex = 0;
let popupDataStorage = {};
let closeFuntionStorage = {};
export default {
  name: "Popup",
  data() {
    return {
      popupList: []
    };
  },
  methods: {
    popupClose(id) {
      this.popupList.map((item, index) => {
        if (item.id == id) {
          this.popupList.splice(index, 1);
        }
      });
      if (closeFuntionStorage[id]) {
        closeFuntionStorage[id]();
      }
    }
  },
  mounted() {
    /**
     * 兼容旧版iframe top.popup方法
     */
    window.popup = {
      open: (url, params = {}) => {
        popupIndex++;
        params.area = params.area || ["800px", "400px"];
        this.popupList.push({
          id: popupIndex,
          title: params.title || "",
          visible: true,
          url: url,
          width: parseInt(params.area[0]) + "px",
          height: parseInt(params.area[1]) - 60 + "px",
          content: params.content
        });

        /**
         * 存储传进来的数据
         * 子页面通过top.popup.data(window.name) 获取
         */
        if (params.data) {
          popupDataStorage[popupIndex] = params.data;
        }
        /**
         * 存储关闭函数
         * 用于窗口关闭后执行
         */
        if (typeof params.close === "function") {
          closeFuntionStorage[popupIndex] = params.close;
        }
      },
      confirm: (msg, params = {}) => {
        this.$confirm(msg)
          .then(() => {
            if (typeof params.determine === "function") {
              params.determine();
            }
          })
          .catch(() => {
            if (typeof params.cancel === "function") {
              params.cancel();
            }
          });
      },
      data: name => {
        let idArr = name.match(/\d+/);
        if (idArr) {
          let id = idArr[0];
          return popupDataStorage[id];
        }
      },
      tips: (msg = "", params = {}) => {
        this.$msg(msg.toString(), params.icon).then(() => {
          if (typeof params.callBack === "function") {
            params.callBack();
          }
        });
      }
    };

    window.closePopup = name => {
      if (name === "all") {
        this.popupList.map(item => {
          item.visible = false;
        });
      } else {
        let idArr = name.match(/\d+/);
        if (idArr) {
          let id = idArr[0];
          this.popupList.map(item => {
            if (item.id == id) {
              item.visible = false;
            }
          });
        }
      }
    };
  }
};
</script>
<style scoped>
.popup__frame {
  position: relative;
  width: 100%;
  height: 100%;
  border: 0px;
}
</style>
