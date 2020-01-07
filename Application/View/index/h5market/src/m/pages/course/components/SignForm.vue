<template>
  <div class="sign-form">
    <div class="sign-form__title">请先填写报名表单</div>
    <div class="sign-form__item" v-for="(item,i) in formData" :key="i">
      <div class="sign-form__label">
        <i class="sign-form__required ks-color-error" v-if="item.required">*</i>
        {{item.name}}
      </div>
      <div v-if="item.type === 'text'">
        <input
          type="text"
          class="sign-form__input"
          :id="'sign-form-text'+i"
          v-model="item.value"
          :placeholder="item.placeholder"
        />
      </div>
      <div v-else-if="item.type === 'textarea'" class="sign_textarea">
        <textarea
          class="sign-form__textarea"
          :id="'sign-form-text'+i"
          v-model="item.value"
          :placeholder="item.placeholder"
        />
      </div>
      <div v-else-if="item.type === 'radio'">
        <span
          class="sign-form__radio"
          :class="item.value === opt && 'sign-form__radio--checked'"
          v-for="(opt,ii) in item.content"
          :key="ii"
          @click="item.value = opt"
        >{{opt}}</span>
      </div>
      <div v-else-if="item.type === 'checkbox'">
        <span
          class="sign-form__checkbox"
          v-for="(opt,ii) in item.content"
          :key="ii"
          :class="isChecked(item.value,opt)"
          @click="addCheck(item.value,opt)"
        >{{opt}}</span>
      </div>
    </div>
    <ks-button class="sign-form__button" type="primary" @click="submit">提交</ks-button>
  </div>
</template>
<script>
import { addApply } from "@/api/live";
export default {
  /**报名表单 */
  name: "SignForm",
  props: {
    formData: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  methods: {
    /**
     * 当前值是否选中
     */
    isChecked(val, opt) {
      let has = false;
      val.map(str => {
        if (str === opt) {
          has = true;
        }
      });
      return has ? "sign-form__checkbox--checked" : "";
    },
    /**
     * 添加多选值
     */
    addCheck(val, opt) {
      let has = false;
      val.map((str, i) => {
        if (str === opt) {
          has = true;
          val.splice(i, 1);
        }
      });
      if (!has) {
        val.push(opt);
      }
    },
    /**
     * 提交
     */
    submit() {
      let _mobile = "";
      for (let i = 0; i < this.formData.length; i++) {
        let item = this.formData[i];
        if (item.required) {
          if (!item.value) {
            this.$toast(`请先填写${item.name}`);
            if (item.type === "text" || item.type === "textarea") {
              document.getElementById(`sign-form-text${i}`).focus();
            }
            return;
          } else if (item.field === "mobile") {
            let reg = /^1[345789]\d{9}$/;
            if (!reg.test(item.value)) {
              this.$toast(`请输入正确的手机号码`);
              document.getElementById(`sign-form-text${i}`).focus();
              return;
            }
            _mobile = item.value;
          }
        }
      }
      let formResult = [];
      this.formData.map(item => {
        formResult.push({
          name: item.name,
          key_value: item.value,
          type: item.type,
          field: item.field
        });
      });
      addApply({
        courseid: this.$route.query.id,
        chapterid: this.$route.query.chapterid,
        mobile: _mobile,
        json: formResult
      }).then(res => {
        if (res.result === "success") {
          location.reload();
        } else {
          this.$toast(res.msg);
        }
      });
    }
  }
};
</script>

<style scoped>
.sign-form {
  background: #fff;
  padding: 30px;

}
.sign-form__title {
  font-size: 18px;
  line-height: 32px;
  font-weight: bold;
  color: #565656;
  padding-bottom: 10px;
}
.sign-form__item {
  margin-top: 10px;
  position: relative;
  line-height: 40px;
}
.sign-form__input,
.sign-form__textarea {
  width: 100%;
  border:1px solid #ddd;
  border-radius: 4px;
  box-sizing: border-box;
  padding: 10px;
  transition: .3s;
}
.sign-form__textarea {
    min-height: 80px;
}
.sign-form__input:focus,
.sign-form__textarea:focus{
    border:1px solid #e64a3b;
}
.sign-form__label {
  left: 0;
  top: 0;
  font-size: 14px;
}
.sign-form__required {
  display: inline-block;
  font-style: normal;
}
.sign-form__radio,
.sign-form__checkbox {
  height: 36px;
  line-height: 36px;
  display: inline-block;
  margin-right: 10px;
  border: 1px solid #eee;
  padding: 0 15px 0 35px;
  font-size: 14px;
  border-radius: 4px;
  cursor: pointer;
  position: relative;
}
.sign-form__radio--checked,
.sign-form__checkbox--checked {
  border: 1px solid #fbf0ed;
  background: #fbf0ed;
  color: #e64a3b;
}
.sign-form__radio::before,
.sign-form__checkbox::before {
  content: "";
  width: 12px;
  height: 12px;
  border: 1px solid #ccc;
  border-radius: 50%;
  position: absolute;
  left: 10px;
  top: 50%;
  margin-top: -7px;
}
.sign-form__checkbox::before {
  border-radius: 3px;
}
.sign-form__radio--checked::before {
  background: #e64a3b url(../../../assets/course/icon-dot.png) no-repeat 50% 50%;
  background-size: 100% 100%;
  border: 1px solid #e64a3b;
}
.sign-form__checkbox--checked::before {
  background: #e64a3b url(../../../assets/course/icon-yes.png) no-repeat 50% 50%;
  background-size: 100% 100%;
  border: 1px solid #e64a3b;
}

.sign-form__button {
  margin-top: 10px;
  width: 100%;
  text-align: center;
  font-size: 16px;
}
.sign_textarea{
  height: 80px;
}
</style>

