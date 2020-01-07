<template>
  <div class="ks-pt10 registration-form" v-if="loading">
    <div class="ks-fz14 form-row" v-for="(item,index) in courseInfo.json.form" :key="index">
      <template v-if="item.name">
        <div class="title">
          <span>{{item.name}}</span>
          <span class="required" v-if="item.required==1">(必填)</span>
        </div>
        <input
          v-if="item.type=='text'"
          class="ks-mt10 ks-fz14 form-input"
          type="text"
          :placeholder="item.placeholder"
          v-model="item.content"
          :ref="`formInput${index}`"
        >
        <textarea
          v-else-if="item.type=='textarea'"
          class="form-textarea"
          :placeholder="item.placeholder"
          v-model="item.content"
        ></textarea>
        <div v-else-if="item.type=='radio'">
          <ks-radio
            v-model="item.select"
            v-for="(radioItem,radioIndex) in item.content"
            :key="radioIndex"
            :label="radioItem"
          >{{radioItem}}</ks-radio>
        </div>
        <div v-else-if="item.type=='checkbox'">
          <div v-for="(checkboxItem,checkboxIndex) in item.content" :key="checkboxIndex" class="form-checkbox-row">
            <input
              type="checkbox"
              :id="checkboxItem"
              :value="checkboxItem"
              v-model="item.selectCheckArr"
              class="form-checkbox"
            >
            <label :for="checkboxItem">{{checkboxItem}}</label>
          </div>
        </div>
      </template>
    </div>
    <div class="placeholder"></div>
    <ks-button type="primary" width="100%" class="next-step" @click="nextStep">下一步</ks-button>
  </div>
</template>

<script>
import { addSign } from "@/api/microportal";
import activity_detail from "@/mixins/activity/activity.detail";
export default {
  name: "RegistrationForm",
  mixins: [activity_detail],
  methods: {
    nextStep() {
      // let index = localStorage.getItem("currentTicket")
      // let id = this.courseInfo.json.content.ticket_info[index]
      console.log(this.courseInfo)
      let tel = this.courseInfo.json.form[1].content;
      if (this.courseInfo.json.form[0].content.length <= 0) {
        this.$toast("请输入姓名");
        this.$refs[`formInput${0}`][0].focus();
        return false;
      } else if (!/^1[3456789]\d{9}$/.test(tel)) {
        this.$toast("手机号不正确");
        this.$refs[`formInput${1}`][0].focus();
        return false;
      } else {
        for (let i = 0; i < this.courseInfo.json.form.length; i++) {
          if (this.courseInfo.json.form[i].required == 1) {
            if (this.courseInfo.json.form[i].content.length <= 0) {
              this.$toast(`请输入${this.courseInfo.json.form[i].name}`);
              this.$refs[`formInput${i}`][0].focus();
              return false;
            }
          }
        } 
        // let ind = this.currentTicket;
        let ind = this.$route.query.ticketIndex
        let params = {
          courseid: this.$route.params.id,
          mobile: this.courseInfo.json.form[1].content,
          json: {
            ticketid: this.courseInfo.json.content.ticket_info[ind].ticketid,
            num: this.$route.query.num,
            paymodel: this.$route.query.paymodel,
            form: this.courseInfo.json.form
          }
        };
        addSign(params).then(res => {
          if (res.result == "success") {
            if (this.courseInfo.json.content.ticket_info[ind].chargetype == 0) {
              if (this.courseInfo.json.setting.is_pledge == 0) {
                this.$router.push({
                  name: "PayResult",
                  params:{
                    status:res.status
                  },
                  query: {
                    payResult: true,
                    id: res.id,
                    status:res.status,
                    ticketIndex:this.$route.query.ticketIndex
                  }
                });
              } else {
                this.$router.push({
                  name: "ConfirmTicket",
                  params: {
                    id: this.$route.params.id,
                  },
                  query: {
                    realname: this.courseInfo.json.form[0].content,
                    tel: this.courseInfo.json.form[1].content,
                    id: res.id,
                    num: this.$route.query.num,
                    paymodel: this.$route.query.paymodel,
                    ticketid:this.courseInfo.json.content.ticket_info[ind].ticketid,
                    ticketIndex:this.$route.query.ticketIndex
                  }
                });
              }
            } else {
              this.$router.push({
                name: "ConfirmTicket",
                params: {
                  id: this.$route.params.id,
                  status:res.status
                },
                query: {
                  realname: this.courseInfo.json.form[0].content,
                  tel: this.courseInfo.json.form[1].content,
                  id: res.id,
                  num: this.$route.query.num,
                  paymodel: this.$route.query.paymodel,
                  ticketid:this.courseInfo.json.content.ticket_info[ind].ticketid,
                  ticketIndex:this.$route.query.ticketIndex
                }
              });
            }
          }
        });
      }
    }
  }
};
</script>

<style scoped>
.registration-form {
  background-color: #f5f5f5;
}
.form-row {
  padding: 15px;
}
.form-row .required {
  color: #e64a3b;
}
.form-row .form-input {
  border: 1px solid #cccccc;
  width: 100%;
  height: 40px;
  border-radius: 5px;
  padding: 0 10px;
}
.form-row .form-input:focus {
  border-color: #e64a3b;
}
.form-row .form-checkbox-row{
  display: inline-block;
  margin-right: 10px;
}
.form-row .form-checkbox {
  -webkit-appearance: checkbox;
  width: 14px;
  height: 14px;
}
.form-row .form-checkbox-row label{
  display: inline-block;
  vertical-align: bottom;
}
.placeholder {
  height: 44px;
}
.form-textarea {
  font-size: 14px;
  line-height: 20px;
  box-sizing: border-box;
  width: 100%;
  min-height: 120px;
  padding: 10px;
  background: #fff;
  border: 1px solid #cccccc;
  border-radius: 4px;
  color: #999;
  margin-top: 10px;
}
.form-textarea::-webkit-input-placeholder {
  color: #999;
}
.next-step {
  border-radius: 0;
  width: 100%;
  position: fixed;
  bottom: 0;
}
</style>
