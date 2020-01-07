<template>
  <div>
    <div class="tx_name">
      <div class="name__row">
        <div class="tx__title">姓名</div>
        <div class="address__right">
          <input type="text" class="address__control" v-model="name" placeholder="请填写真实姓名" />
        </div>
      </div>
    </div>

    <div class="tx_je">
      <a class="je_title">提现金额</a>
      <div class="address__row">
        <div class="address__title">￥</div>
        <div class="address__right">
          <input type="text" class="address__control" v-model="withdrawmoney" placeholder="请输入提现金额" />
        </div>
      </div>
      <span class="tx_title">可提现金额{{money}}元</span>
    </div>

    <ks-button style="background:#e40c0c;color:#fff;" class="pre-step" @click="publish">申请提现</ks-button>
  </div>
</template>
<script>
import { carryCash,weChat } from "@/api/user";
export default {
  data() {
    return {
      money: "0",
      withdrawmoney:'',
      name:'',
      nickname:'',
      openid:''
    };
  },
  methods: {
    /**保存 */
    publish() {
      let params = {
        withdrawmoney: this.withdrawmoney,
        name: this.name,
        openid:this.openid,
        nickname:this.nickname
      };
      
      carryCash(params).then(res => {
        this.$toast("提现已提交,三天内到账", "success");
        this.withdrawmoney = ''
        this.name = ''
        setTimeout(() => {
              this.$router.go(-1)
            }, 2000);
        
      });
    }
  },
  activated() {
    weChat().then(res=>{
      if(res.authorurl) {
        location.href = res.authorurl
      }else {
        this.nickname = res.nickname,
        this.openid = res.openid
      }
    })
    this.money = this.$route.query.money;
  }
};
</script>
<style scoped>
.tx_je {
  background: #fff;
}
.tx_name {
  background: #fff;
  margin-bottom: 12px;
}
.tx__title {
  width: 57px;
  float: left;
  font-size: 16px;
}
.name__row {
  height: 50px;
  margin: 0px 3%;
  font-size: 18px;
  line-height: 45px;
  color: #000;
}
.pre-step {
  border-radius: 0;
  width: 94%;
  position: fixed;
  margin-left: 3%;
  margin-top: 20px;
}
.address__row {
  height: 50px;
  margin: 0px 3%;
  font-size: 18px;
  line-height: 45px;
  color: #000;
  border-bottom: 1px #e0e7f0 solid;
}
.address__title {
  width: 35px;
  float: left;
  font-size: 30px;
}
.address__right {
  float: left;
}
.address__control {
  width: 150%;
  color: #3c3c3c;
  text-align: left;
  border: 0;
}
.je_title {
  margin-left: 9px;
  line-height: 34px;
}
.tx_title {
  line-height: 36px;
  font-size: 15px;
  margin-left: 11px;
}
</style>