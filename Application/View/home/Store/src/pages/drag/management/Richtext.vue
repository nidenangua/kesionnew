<template>
  <div>
    <div id="richtext"></div>
  </div>
</template>
<script>
let richtextEditor;
import { domap } from "@/utils";
export default {
  name: "Richtext",
  props: {
    managementData:Object
  },
  methods: {
    createEditor() {
      if (richtextEditor) {
        richtextEditor.destroy();
      }
      richtextEditor = UE.getEditor("richtext", {
        initialFrameWidth: "100%",
        initialFrameHeight: "500",
        toolbars: [
          [
            "fullscreen",
            "myinsertimage",
            "undo",
            "redo",
            "|",
            "fontsize",
            "forecolor",
            "bold",
            "italic",
            "underline",
            "fontborder",
            "strikethrough",
            "|",
            "justifyleft",
            "justifycenter",
            "justifyright",
            "|",
            "removeformat",
            "formatmatch",
            "autotypeset",
            "pasteplain",
            "|",
            "backcolor"
          ]
        ]
      });
      richtextEditor.commands["myinsertimage"] = {
        execCommand: function() {
          top.addTypeChange(
            "/home.html/home/Index/imageslist?appid-6,courseType-4,name-richtext,type-top,chektype-0",
            "930px",
            "610px",
            { title: "选择图片", type: "top" }
          );
          return true;
        },
        queryCommandState: function() {}
      };

      richtextEditor.addListener("ready", e => {
        richtextEditor.setContent(this.managementData.code);
      });
      richtextEditor.addListener("contentChange", e => {
        this.managementData.code = richtextEditor.getContent();
      });
    }
  },
  mounted() {
    this.createEditor();
  }
};
</script>

