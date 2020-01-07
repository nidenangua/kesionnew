<template>
    <div @click="alert_show">
        <div class="address">
            <div class="address__row">
                <div class="address__title">收货人</div>
                <div class="address__right"><input type="text" v-model="editAddress.realname" class="address__control" placeholder="请输入收货人姓名"></div>
            </div>
            <div class="address__row">
                <div class="address__title">手机号码</div>
                <div class="address__right"><input v-model="editAddress.telphone" type="text" class="address__control" placeholder="请输入手机号码"></div>
            </div>
            <div @click.stop="choose" class="address__row">
                <div class="address__title" >所在地区</div>
                <div class="address__right">
                    <div class="addr" :class="show?'addressclick':''">{{province.value}} {{city.value}} {{area.value}}</div>
                </div>
            </div>
            <div class="address__row">
                <div class="address__title">收货地址</div>
                <div class="address__right"> 
                    <input v-model="editAddress.street" type="text" class="address__control" placeholder="请输入详细收货地址">
                </div>
            </div>
            <div class="address__row">
                <div class="address__title">设为默认</div>
                <div class="address__right" style="float: right;margin-top: 14px;">
                    <ks-switch v-model="editAddress.is_address" class="ks-fl"></ks-switch>
                </div>
            </div>
        </div>
        <ks-button style="background:#e40c0c;color:#fff;" class="pre-step" @click="publish">保存</ks-button>
        <div  v-if="show" class="masked"></div>
        <div v-if="show" class="site" @click.stop>
            <v-distpicker @province="onChangeProvince" @city="onChangeCity" @area="onChangeArea" type="mobile"></v-distpicker>
        </div>
    </div>
</template>
<script>
import VDistpicker from 'v-distpicker'
import { editAddress,showAddress } from "@/api/mall.js";
export default {
    name:"",
    data(){
        return{
            show:false,
            province:{
                value:'点击选择所在地区'
            },
            city:{
                value:''
            },
            area:{
                value:''
            },
            components: { VDistpicker },//distpicker地址选择组件
            list:[], 
            editAddress:{
               realname:"",
               telphone:"",
               street:"",
               is_address:false
            }
        };
    },
    methods: {
    // selected(data){
    //     this.province = data.province.value
    //     this.city = data.city.value
    // },
    /**地址选择*/
    choose(){
        this.show= true
    },
    onChangeProvince(a){
        this.province = a
    },
    onChangeCity(a){
        this.city = a
    },
    onChangeArea(a){
        this.area = a
        this.show=false
    }, 

    /**保存 */
    publish() {
      let params = {
        realname: this.editAddress.realname,
        telphone: this.editAddress.telphone,
        street: this.editAddress.street,
        province: this.province.value,
        city: this.city.value,
        area:this.area.value,
        is_address:this.editAddress.is_address,
      };
      if (this.$route.query.id) {
            params.id = this.$route.query.id;
          }
      editAddress(params).then(res => {
          this.editAddress.realname = ""
          this.editAddress.telphone = ""
          this.editAddress.street = ""
          this.province.value = "点击选择所在地区"
          this.city.value = ""
          this.area.value = ""
        //   this.editAddress.is_address = ""
          this.$router.go(-1)
      });
    },
    alert_show() {
        this.show=false
    },
  },
  activated() {
    document.title = "添加地址";
    let id = this.$route.query.id;
    if (id) {
        showAddress({id}).then(res => {
        this.editAddress.realname = res.data.realname;
        this.editAddress.telphone = res.data.telphone;
        this.editAddress.street = res.data.street;
        this.province.value = res.data.province;
        this.editAddress.is_address = res.data.is_address;
        this.city.value = res.data.city;
        this.area.value = res.data.area;
      });
    }
  },
  watch: {
    $route(to, from) {
      this.$router.go(0)
    }
  }
}
</script>
<style scoped>
.address{
    background: #fff;
}
.address__row{
    height: 50px;
    margin:0px 3%;
    font-size: 18px;
    line-height: 45px;
    color: #000;
    border-bottom: 1px #e0e7f0 solid;
}
.address__title{
    width: 100px;
    float: left;
    font-size: 16px;
}
.address__right{
    float: left;
}
.address__control {
    width: 150%;
    color: #3c3c3c;
    text-align: left;
    border: 0;
}
.pre-step {
  border-radius: 0;
  width: 94%;
  position: fixed;
  margin-left: 3%;
  margin-top: 55px;
}
.addr{
    font-size: 14px;
    color: #3c3c3c;
}
.addr .addressclick{
    font-size: 14px;
    color: #b2b2b2;
}
.site{
    position: fixed;
    width: 100%;
    bottom: 0;
    z-index: 6;
}
.site >>> .address-container {
    height: 300px;
    z-index: 10;
}
.masked{
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, .3);
    top: 0;
    left: 0;
    z-index: 5;
}
.distpicker-address-wrapper{
    color: #3c3c3c;
    font-size: 14px;
}
</style>