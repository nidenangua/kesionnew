<template>
  <div class="data-format">
    <img
      src="../../assets/data/file_pic.png"
      v-if="type == 'jpeg' || type == 'jpg' || type == 'gif' || type == 'png'"
    >
    <img src="../../assets/data/file_zip.png" v-else-if="type == 'zip' || type == 'rar'">
    <img src="../../assets/data/file_video.png" v-else-if="type == 'mp4'">
    <img src="../../assets/data/file_music.png" v-else-if="type == 'mp3'">
    <img src="../../assets/data/file_ppt_office.png" v-else-if="type == 'ppt'">
    <img src="../../assets/data/file_pdf.png" v-else-if="type == 'pdf'">
    <img src="../../assets/data/file_txt.png" v-else-if="type == 'txt'">
    <img src="../../assets/data/file_word_office.png" v-else-if="type == 'doc' || type == 'docx'">
    <img src="../../assets/data/file_unknown.png" v-else>
    {{fileName}}
  </div>
</template>
<script>
export default {
  name: "DataFormat",
  props: {
    fileName: String
  },
  data() {
    return {
      type: ""
    };
  },
  watch: {
    fileName() {
      this.updateType();
    }
  },
  methods: {
    updateType() {
      let _type = this.fileName.split(".");
      if (_type) {
        _type = _type[_type.length - 1];
      }
      this.type = _type;
    }
  },
  created() {
    this.updateType();
  }
};
</script>
<style scoped>
.data-format {
  line-height: 44px;
}
.data-format img {
  height: 26px;
  float: left;
  margin: 9px 10px 0 0;
}
</style>

