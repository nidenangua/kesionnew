<template>
  <div>
    <div @click.stop="$emit('update:visible',true)">
      <slot name="switch"></slot>
    </div>
    <div class="emotions" v-if="visible" :style="getStyle()">
      <ul class="clearfix">
        <li v-for="(code,i) in emotions_code" :key="i" @click.stop="selectEmotion(code)">
          <img
            :src="'//res.wx.qq.com/mpres/en_US/htmledition/pages/modules/common/emoji/images/smiley/smiley_'+emotions[code]+'.png'"
          >
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import { domap } from "@/utils";
export default {
  name: "Emotion",
  props: ["visible", "top"],
  data() {
    return {
      emotions: {
        "/::)": "0",
        "/::~": "1",
        "/::B": "2",
        "/::|": "3",
        "/:8-)": "4",
        "/::<": "5",
        "/::$": "6",
        "/::X": "7",
        "/::Z": "8",
        "/::'(": "9",
        "/::-|": "10",
        "/::@": "11",
        "/::P": "12",
        "/::D": "13",
        "/::O": "14",
        "/::(": "15",
        "/::+": "16",
        "/:--b": "17",
        "/::Q": "18",
        "/::T": "19",
        "/:,@P": "20",
        "/:,@-D": "21",
        "/::d": "22",
        "/:,@o": "23",
        "/::g": "24",
        "/:|-)": "25",
        "/::!": "26",
        "/::L": "27",
        "/::>": "28",
        "/::,@": "29",
        "/:,@f": "30",
        "/::-S": "31",
        "/:?": "32",
        "/:,@x": "33",
        "/:,@@": "34",
        "/::8": "35",
        "/:,@!": "36",
        "/:!!!": "37",
        "/:xx": "38",
        "/:bye": "39",
        "/:wipe": "40",
        "/:dig": "41",
        "/:handclap": "42",
        "/:&-(": "43",
        "/:B-)": "44",
        "/:<@": "45",
        "/:@>": "46",
        "/::-O": "47",
        "/:>-|": "48",
        "/:P-(": "49",
        "/::'|": "50",
        "/:X-)": "51",
        "/::*": "52",
        "/:@x": "53",
        "/:8*": "54",
        "/:pd": "55",
        "/:<W>": "56",
        "/:beer": "57",
        "/:basketb": "58",
        "/:oo": "59",
        "/:coffee": "60",
        "/:eat": "61",
        "/:pig": "62",
        "/:rose": "63",
        "/:fade": "64",
        "/:showlove": "65",
        "/:heart": "66",
        "/:break": "67",
        "/:cake": "68",
        "/:li": "69",
        "/:bome": "70",
        "/:kn": "71",
        "/:footb": "72",
        "/:ladybug": "73",
        "/:shit": "74",
        "/:moon": "75",
        "/:sun": "76",
        "/:gift": "77",
        "/:hug": "78",
        "/:strong": "79",
        "/:weak": "80",
        "/:share": "81",
        "/:v": "82",
        "/:@)": "83",
        "/:jj": "84",
        "/:@@": "85",
        "/:bad": "86",
        "/:lvu": "87",
        "/:no": "88",
        "/:ok": "89",
        "/:love": "90",
        "/:jump": "92",
        "/:shake": "93",
        "/:circle": "95",
        "/:kotow": "96",
        "/:turn": "97",
        "/:skip": "98",
        "/:oY": "99",
        "/:#-0": "100",
        "/:hiphot": "101",
        "/:kiss": "102",
        "/:<&": "103",
        "/:&>": "104"
      },
      emotions_code: []
    };
  },
  methods: {
    /**
     * 选择表情
     */
    selectEmotion(code) {
      let emotion = document.createElement("img");
      emotion.setAttribute("emotion", code);
      emotion.src = `//res.wx.qq.com/mpres/en_US/htmledition/pages/modules/common/emoji/images/smiley/smiley_${
        this.emotions[code]
      }.png`;
      emotion.className = "ks-emotion";

      this.$emit("select", emotion);
    },
    /**
     * 文本替换
     */
    codeReplaceToEmotion(text) {
      domap(this.emotions_code, (code, i) => {
        let reg = "";
        /**
         * 处理特殊符号 ^ $ . * +  - ? = ! : | \ / ( ) [ ] { }
         */
        let specialSymbol = [
          "^",
          "$",
          ".",
          "*",
          "+",
          "-",
          "?",
          "=",
          "!",
          ":",
          "|",
          "\\",
          "/",
          "(",
          ")",
          "[",
          "]",
          "{",
          "}"
        ];
        domap(code.split(""), t => {
          let is = false;
          domap(specialSymbol, s => {
            if (s === t) {
              reg += "\\" + t;
              is = true;
            }
          });
          if (!is) {
            reg += t;
          }
        });
        text = text.replace(
          new RegExp(reg, "g"),
          `<img emotion="{{emotion${i}}}" src="//res.wx.qq.com/mpres/en_US/htmledition/pages/modules/common/emoji/images/smiley/smiley_${i}.png" class="ks-emotion" />`
        );
      });

      let emotions = text.match(/{{emotion\d+}}/g);
      if (emotions) {
        domap(emotions, a => {
          let index = a.match(/\d+/)[0];
          text = text.replace(a, this.emotions_code[index]);
        });
      }

      return text;
    },
    /**
     * 表情转为代码符号
     */
    emotionReplaceToCode(text) {
      let div = document.createElement("div");
      div.innerHTML = text;
      let emotions = div.querySelectorAll("img[emotion]");
      domap(emotions, img => {
        text = text.replace(img.outerHTML, img.getAttribute("emotion"));
      });
      return text;
    },
    getStyle() {
      if (this.top) {
        return {
          top: this.top
        };
      }
    }
  },
  mounted() {
    document.addEventListener("click", e => {
      this.$emit("update:visible", false);
    });

    this.emotions_code = Object.keys(this.emotions);
  }
};
</script>
<style scoped>
.emotions {
  width: 426px;
  box-sizing: border-box;
  padding: 24px;
  box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.1);
  position: absolute;
  left: 0;
  top: 0;
  z-index: 99;
  background: #fff;
}
.emotions-mask {
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 90;
}
.emotions li {
  float: left;
  height: 20px;
  width: 20px;
  padding: 3px;
  cursor: pointer;
}
.emotions li:hover {
  background: #f3f3f3;
}
.emotions li img {
  width: 20px;
  display: block;
}
</style>

