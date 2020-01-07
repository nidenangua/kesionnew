<template>
  <div class="ks-bg-white">
    <div class="verified-type">
      <ks-radio v-model="verifiedType" :label="1">个人认证</ks-radio>
      <ks-radio v-model="verifiedType" :label="2">企业认证</ks-radio>
    </div>
    <ks-list>
      <ks-list-item title="企业名称">
        <input type="text" class="ks-input" placeholder="请输入">
      </ks-list-item>
      <ks-list-item title="联系电话">
        <input type="text" class="ks-input" placeholder="请输入">
      </ks-list-item>
      <ks-list-item title="营业证件号">
        <input type="text" class="ks-input" placeholder="请输入">
      </ks-list-item>
      <ks-list-item title="经营类目范围">
        <input type="text" class="ks-input" placeholder="请输入">
      </ks-list-item>
    </ks-list>
    <div class="verified-photo">
      <div class="verified-photo__title">证件照片</div>
      <div class="verified-photo__tip">
        1.证件照片不得有遮挡，保证清晰
        <br>2.请在白色背景下拍摄，保证证件边缘清晰
        <br>3.请从证件的正上方拍摄，防止画面变形
      </div>

      <div class="verified-photo-list clearfix">
        <div class="verified-photo__item">
          <div class="verified-photo__default verified-photo__tx"></div>上传法人身份证头像面
        </div>
        <div class="verified-photo__item">
          <div class="verified-photo__default verified-photo__gh"></div>上传法人身份证国徽面
        </div>
        <div class="verified-photo__item">
          <div class="verified-photo__default verified-photo__yyzz"></div>上传营业执照
        </div>
      </div>
    </div>
    <ks-list>
      <ks-list-item title="所在省市" show-arrow>请选择</ks-list-item>
      <ks-list-item title="具体地址">
        <input type="text" class="ks-input" placeholder="请输入">
      </ks-list-item>
    </ks-list>
    <div class="verified-button ks-mt15">
      <ks-button type="primary" width="100%">确认提交</ks-button>
    </div>
  </div>
</template>
<script>
/**
 * 实名认证
 */
export default {
  name: "UserVerified",
  data() {
    return {
      verifiedType: 1
    };
  }
};
</script>
<style scoped>
.verified-type {
  padding: 20px 15px;
}
.verified-photo__tip {
  line-height: 24px;
  color: #999;
  padding: 10px 0 20px 0;
}

.verified-photo,
.verified-button {
  padding: 0 15px;
}

.verified-photo__title {
  font-size: 14px;
  margin-top: 20px;
}

.verified-photo__item {
  width: 50%;
  float: left;
}
</style>

