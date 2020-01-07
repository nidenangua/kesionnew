<template>
  <ks-container class="add-train-camp">
    <div class="add-train-camp__form">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item :to="{ path: '/traincamp' }">训练营</el-breadcrumb-item>
        <el-breadcrumb-item>添加训练营</el-breadcrumb-item>
      </el-breadcrumb>
      <div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，科汛微门户保有依据国家规定及平台规则进行处理的权利。</div>
      <div class="basic-information">
        <div class="information__title">基本信息</div>
        <div class="basic-information__box">
          <div class="information__row">
            <span class="information__name">选择分类</span>
            <el-select
              v-model="value"
              placeholder="请选择"
              size="small"
              class="basic-information__select"
            >
              <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value"
              ></el-option>
            </el-select>
          </div>
          <div class="information__row">
            <span class="information__name">
              <span class="information__star">*</span>
              训练营名称
            </span>
            <el-input placeholder="" v-model="trainCampName">
              <span slot="suffix" class="information-row-number">{{trainCampName.length}}/30</span>
            </el-input>
          </div>
          <div class="information__row">
            <span class="information__name">
              <span class="information__star">*</span>
              简短描述(用于微信分享)
            </span>
            <div class="basic-information-row__wechat-share">
              <el-input placeholder="" v-model="simpleDes">
                <span slot="suffix" class="information-row-number">{{simpleDes.length}}/45</span>
              </el-input>
              <div class="basic-information__example">
                例 :
                <img src="" alt="">
              </div>
            </div>
          </div>
          <div class="information__row">
            <span class="information__name">
              <span class="information__star">*</span>
              训练营封面
            </span>
            <div class="basic-information__pic">
              <div class="basic-information-pic__left">
                <img src="" alt="">
              </div>
              <div class="basic-information-pic__right">
                <el-button plain class="basic-information-pic__upload-btn">上传图片</el-button>
                <div class="basic-information-pic__advice">建议尺寸750*525px，JPG、PNG格式， 图片小于1M。</div>
              </div>
            </div>
          </div>
          <div class="information__row">
            <span class="information__name">
              <span class="information__star">*</span>
              训练营详情
            </span>
            <div>
              <ks-editor/>
            </div>
          </div>
        </div>
      </div>
      <div class="commodity-information">
        <div class="information__title">商品信息</div>
        <div class="commodity-information__box">
          <div class="information__row">
            <span class="commodity-information__name">售卖方式</span>
            <el-radio-group v-model="radio">
              <el-radio :label="1">按期购买</el-radio>
              <el-radio :label="2">一次性购买整个训练营</el-radio>
            </el-radio-group>
          </div>
          <div class="commodity-information-box__disposable">
            <div class="information__row">
              <span class="commodity-information__name">售卖价格</span>
              <el-radio-group v-model="isCharge">
                <el-radio :label="1">免费</el-radio>
                <el-radio :label="2">收费</el-radio>
              </el-radio-group>
            </div>
            <div class="information__row">
              <span class="commodity-information__name">商品价格</span>
              <el-input
                v-model="commodityPrice"
                placeholder="请输入价格"
                class="commodity-information-price__input"
              ></el-input>元
            </div>
            <div class="information__row">
              <span class="commodity-information__name">划线价格</span>
              <el-input
                v-model="commodityPrice2"
                placeholder="请输入划线价格(选填)"
                class="commodity-information-price__input"
              ></el-input>元
            </div>
          </div>
        </div>
      </div>
      <div class="putaway-set">
        <div class="information__title">上架设置</div>
        <div class="putaway-set__box">
          <div class="information__row">
            <span class="putaway-set__name">是否上架</span>
            <el-switch v-model="isPutaway" active-color="#13ce66"></el-switch>
          </div>
        </div>
      </div>
    </div>
    <div class="add-train-camp__save">
      <el-button type="primary" size="small" @click="saveTrainCamp">保存进入营期目录</el-button>
      <el-button type="primary" size="small" @click="saveTrainCamp">保存返回</el-button>
      <el-button plain size="small" @click="saveTrainCamp">取消</el-button>
    </div>
  </ks-container>
</template>

<script>
export default {
  data() {
    return {
      /**分类列表 */
      options: [
        {
          value: "选项1",
          label: "黄金糕"
        },
        {
          value: "选项2",
          label: "双皮奶"
        },
        {
          value: "选项3",
          label: "蚵仔煎"
        },
        {
          value: "选项4",
          label: "龙须面"
        },
        {
          value: "选项5",
          label: "北京烤鸭"
        }
      ],
      /**选择分类 */
      value: "",
      /**训练营名称*/
      trainCampName: "",
      /** 简短描述 */
      simpleDes: "",
      /** 商品信息 */
      radio: 2,
      /**是否收费 */
      isCharge: 2,
      /**商品价格 */
      commodityPrice: "",
      /**划线价格 */
      commodityPrice2: "",
      /**是否上架 */
      isPutaway: true
    };
  },
  watch: {
    trainCampName: function(v) {
      this.wordLimit("trainCampName", 30);
    },
    simpleDes: function(v) {
      this.wordLimit("simpleDes", 45);
    },
    commodityPrice:function(){
      this.priceVerify("commodityPrice");
    },
    commodityPrice2:function(){
      this.commodityPrice2("commodityPrice2");
    }

  },
  methods: {
    /**
     * 输入字数限制
     * @param {String} 要限制对象的目标
     * @param {Number} 要限制字数长度为多少
     */
    wordLimit(v, wordLength) {
      if (this[v].length > wordLength) {
        this[v] = this[v].slice(0, wordLength);
      }
    },
    /**
     * 价格正则验证
     * @param {String} 要验证的对象
     */
    priceVerify(v){
      let reg = /^\d{0,1}[\d.]{0,}\d{0,1}$/;
      let result = this[v].match(reg);
      if(result){
        this[v] = result[0];
      }else{
        this[v] = this[v].slice(0,this[v].length-1);
      }
    },
    /**
     * 保存返回
     */
    saveTrainCamp() {
      this.$router.go(-1);
    },
  }
};
</script>

<style scoped>
.add-train-camp__form {
  border-bottom: 1px solid #eee;
}
.add-train-camp .tips {
  background-color: #fdf6ec;
  color: #e6a23c;
  line-height: 22px;
  padding: 12px 15px;
  border-radius: 4px;
  margin: 20px 0;
}
.information__title {
  line-height: 34px;
  position: relative;
  padding-left: 15px;
  font-size: 16px;
}
.basic-information__box {
  padding: 20px;
  min-height: 200px;
}
.basic-information__select {
  width: 280px;
}
.basic-information-row__wechat-share {
  display: flex;
}
.basic-information__example {
  display: flex;
  margin-left: 10px;
  /* align-items: flex-end; */
}

.basic-information__example img {
  width: 300px;
  height: 100px;
  background-color: #ccc;
  margin-left: 10px;
}

.basic-information__pic {
  display: flex;
}

.basic-information-pic__left {
  width: 150px;
  height: 150px;
  background-color: #ccc;
  margin-right: 20px;
}

.basic-information-pic__upload-btn {
  margin-bottom: 20px;
}

.basic-information-pic__advice {
  font-size: 14px;
  color: #ababab;
}
.commodity-information__box {
  padding: 30px;
}

.commodity-information__name {
  margin-right: 20px;
  color: #ababab;
}
.commodity-information-box__disposable {
  background: #f6f9fb;
  padding: 15px;
  max-width: 750px;
  box-sizing: border-box;
  border-radius: 4px;
}
.commodity-information-price__input {
  width: 180px;
  font-size: 12px;
}

.putaway-set__box {
  padding: 30px;
}
.putaway-set__name {
  margin-right: 20px;
  color: #ababab;
}

.add-train-camp__save {
  padding: 20px 0;
  text-align: center;
}

/* 公用样式 */
.information__title::before {
  content: "";
  width: 3px;
  height: 18px;
  background: #488bff;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -9px;
}
.information__row {
  padding-bottom: 15px;
  position: relative;
}
.information__name {
  display: block;
  font-size: 14px;
  line-height: 34px;
  height: 34px;
  color: #ababab;
}
.information__star {
  position: relative;
  color: red;
  vertical-align: middle;
}
.information-row-number {
  height: 40px;
  display: flex;
  align-items: center;
}
</style>
