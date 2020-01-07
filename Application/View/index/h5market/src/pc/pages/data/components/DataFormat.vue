<template>
  <div class="data-format">
    <img
      src="@/m/assets/data/file_style2/file_pic.png"
      v-if="type === 'jpg' || type === 'jpeg' || type === 'png' || type === 'gif'"
      :style="{width:width,height:height}"
    >
    <img
      src="@/m/assets/data/file_style2/file_video.png"
      v-else-if="type === 'mp4'"
      :style="{width:width,height:height}"
    >
    <img
      src="@/m/assets/data/file_style2/file_music.png"
      v-else-if="type === 'mp3'"
      :style="{width:width,height:height}"
    >
    <img
      src="@/m/assets/data/file_style2/file_word_office.png"
      v-else-if="type === 'doc' || type === 'docx'"
      :style="{width:width,height:height}"
    >
    <img
      src="@/m/assets/data/file_style2/file_txt.png"
      v-else-if="type === 'txt'"
      :style="{width:width,height:height}"
    >
    <img
      src="@/m/assets/data/file_style2/file_zip.png"
      v-else-if="type === 'rar' || type === 'zip'"
      :style="{width:width,height:height}"
    >
    <img
      src="@/m/assets/data/file_style2/file_pdf.png"
      v-else-if="type === 'pdf'"
      :style="{width:width,height:height}"
    >
    <img
      src="@/m/assets/data/file_style2/file_ppt_office.png"
      v-else-if="type === 'ppt'"
      :style="{width:width,height:height}"
    >
    <img
      src="@/m/assets/data/file_style2/file_unknown.png"
      v-else
      :style="{width:width,height:height}"
    >
  </div>
</template>
<script>
export default {
  name: "DataFormat",
  props: {
    type: String,
    height: String,
    width: String
  }
};
</script>
<style scoped>
/* 	img{
		background-size: contain;
	} */
</style>
