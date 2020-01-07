<template>
    <ks-container class="add-train-camp">
        <div>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/traincamp' }">训练营</el-breadcrumb-item>
                <el-breadcrumb-item :to="{ path: '/traincamp/campsiteindex' }">营期管理</el-breadcrumb-item>
                <el-breadcrumb-item>添加营期</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，科汛微门户保有依据国家规定及平台规则进行处理的权利。</div>
        <div class="basic-information">
            <div class="information__title">基本信息</div>
            <div class="basic-information__box">
                <div class="information__row">
                    <span class="information__name">
                        <span class="information__star">*</span>
                        营期名称
                    </span>
                    <el-input placeholder="" v-model="trainCampName">
                        <span
                            slot="suffix"
                            class="information-row-number"
                        >{{trainCampName.length}}/30</span>
                    </el-input>
                </div>
                <div class="information__row">
                    <span class="information__name">
                        <span class="information__star">*</span>
                        简短描述(用于微信分享)
                    </span>
                    <div class="basic-information-row__wechat-share">
                        <el-input placeholder="" v-model="simpleDes">
                            <span
                                slot="suffix"
                                class="information-row-number"
                            >{{simpleDes.length}}/45</span>
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
                        营期封面
                    </span>
                    <div class="basic-information__pic">
                        <div class="basic-information-pic__left">
                            <img src="" alt="">
                        </div>
                        <div class="basic-information-pic__right">
                            <el-button plain class="basic-information-pic__upload-btn">上传图片</el-button>
                            <div
                                class="basic-information-pic__advice"
                            >建议尺寸750*525px，JPG、PNG格式， 图片小于1M。</div>
                        </div>
                    </div>
                </div>
                <div class="information__row">
                    <span class="information__name">
                        <span class="information__star">*</span>
                        营期详情
                    </span>
                    <div>
                        <ks-editor/>
                    </div>
                </div>
            </div>
        </div>
        <div class="beginning-class-information">
            <div class="information__title">开课信息</div>
            <div class="beginning-class-information__box">
                <div class="information__row">
                    <span class="information__name">
                        <span class="information__star">*</span>
                        报名时间
                    </span>
                    <el-date-picker
                        v-model="value1"
                        type="datetimerange"
                        range-separator="至"
                        start-placeholder="开始日期"
                        end-placeholder="结束日期"
                        size="small"
                    ></el-date-picker>
                </div>
                <div class="information__row">
                    <span class="information__name">
                        <span class="information__star">*</span>
                        开课时间
                    </span>
                    <el-date-picker
                        v-model="value2"
                        type="datetimerange"
                        range-separator="至"
                        start-placeholder="开始日期"
                        end-placeholder="结束日期"
                        size="small"
                    ></el-date-picker>
                </div>
            </div>
        </div>
        <div class="commodity-information">
            <div class="information__title">商品信息</div>
            <div class="commodity-information__box">
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
                            v-model="commodityPrice"
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
      /**训练营名称*/
      trainCampName: "",
      /** 简短描述 */
      simpleDes: "",
      /**报名时间 */
      value1:[],
      /**开课时间 */
      value2:[],
      /**是否收费 */
      isCharge: 2,
      /**商品价格 */
      commodityPrice: "",
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
     * 保存返回
     */
    saveTrainCamp() {
      this.$router.go(-1);
    }
  }
};
</script>

<style scoped>
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
.beginning-class-information__box {
  padding: 20px;
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
