<template>
  <div>
    <div style="padding:10px;">
      <div class="cart-top">
        <span class="shopping">
          <span class="shopping-cart">购物车</span>
          （共{{totalput}}件商品）
        </span>
        <span class="cart-top__btn" @click="manage">{{managetxt}}</span>
      </div>
      <ks-page-scroll-container
        v-if="list.length"
        :page="p"
        :page-count="pageCount"
        @page-change="getList"
      >
        <div class="ks-row cart" v-for="(item,i) in list" :key="i">
          <div class="ks-col-3">
            <ks-checkbox
              v-model="item.flag"
              @change="onCheckboxChange(item.flag,item.id,item.price*item.num)"
              v-if="item.is_invalid"
            />
            <div class="lose" v-else>失效</div>
          </div>
          <div @click="put(item.goodsid)" class="ks-col-8">
            <ks-image :src="item.defaultpic"/>
          </div>
          <div class="ks-col-13">
            <div class="col_titile" @click="put(item.goodsid)">{{item.title}}</div>
            <div class="cart-pull" v-if="item.date">{{item.date}}</div>
            <div>
              <span class="price" v-if="item.is_lose1">￥{{item.price}}</span>
              <span class="price" v-else>已下架</span>
              <span class="ks-fr" v-if="item.is_lose1">
                <div class="ks-fr pop-versions__poa">
                  <img
                    @click="prepnumber(i,item,item.num,item.goodsid,item.attributeid,item.date)"
                    class="pop-versions__left"
                    src="../../assets/mall/common_btn_minus.png"
                  >
                  <input
                    type="number"
                    v-model="item.num"
                    @input="shopnum(item.num,item.goodsid,item.stock,i,item.attributeid,item.date)"
                  >
                  <img
                    @click="addnumber(i,item,item.num,item.goodsid,item.attributeid,item.date)"
                    class="pop-versions__right"
                    src="../../assets/mall/common_btn_add.png"
                  >
                </div>
              </span>
            </div>
          </div>
        </div>
      </ks-page-scroll-container>
      <ks-empty type="nolesson" :msg="'购物车空空，赶紧去瞧瞧吧！'" v-else-if="loaded"/>
    </div>
    <store-footer/>
    <div class="cart-btn">
      全选
      <ks-checkbox v-model="totalflag" @change="onCheckboxChanges()"/>
      <span v-show="manageflag==true" class="ks-fr">
        <span class="cart-btn__freight">不含运费</span>
        <span class="cart-total">合计：</span>
        <span class="cart-sum">￥{{totalPrice}}</span>
        <ks-button
          @click="balance"
          style="height: 30px;lineHeight: 30px;marginLeft: 10px;"
          class="ks-fr"
          type="primary"
        >结算({{totalmsg}})</ks-button>
      </span>
      <span @click="remove" v-show="managedel==false" class="ks-fr">
        <ks-button
          style="height: 30px;lineHeight: 30px;marginLeft: 10px;"
          class="ks-fr"
          type="primary"
        >删除</ks-button>
      </span>
    </div>
  </div>
</template>
<script>
import { cartList, delCart, addCart, confirmOrder } from "@/api/mall.js";
export default {
  data() {
    return {
      number: "1",
      loaded: false,
      pageCount: null,
      totalput: "",
      num: "1", //购买数量
      p: 1,
      list: [],
      idArr: [], //点击添加到数组
      flag: false, //选中状态
      /**显示状态 */
      manageflag: true,
      managedel: true,
      managetxt: "管理", //管理按钮
      unit: [], //所有勾选商品的价格
      units: "0", //所有勾选商品的价格总和
      totalflag: false,
      inputflag: false
    };
  },
  computed: {
    totalPrice() {
      let price = 0;
      this.list.map(item => {
        if (item.flag) {
          price += item.num * item.price;
        }
      });
      return price.toFixed(2);
    },
    totalmsg() {
      let total = [];
      this.list.map(item => {
        if (item.flag) {
          total.push(item);
        }
      });
      return total.length;
    }
  },
  methods: {
    put(id) {
      this.$router.push("/commodity?id=" + id);
    },
    /**添加数量 */
    addnumber(i, item, num, goodsid,attributeid,date) {
      num++;
      addCart({ num, goodsid,attributeid }).then(res => {
        if (res.result == "error" && res.msg == "该宝贝不能购买更多哦~") {
          this.$toast(res.msg);
        } else {
          this.$set(this.list, i, {
            num: num,
            defaultpic: item.defaultpic,
            title: item.title,
            price: item.price,
            is_invalid: item.is_invalid,
            id: item.id,
            goodsid: item.goodsid,
            flag: item.flag,
            is_lose1: 1,
            attributeid:attributeid,
            date:date
          });
        }
      });
    },
    /**减少数量 */
    prepnumber(i, item, num, goodsid,attributeid,date) {
      num--;
      addCart({ num, goodsid,attributeid }).then(res => {
        if (res.result == "error" && res.msg == "该宝贝不能购买更多哦~") {
          this.$toast(res.msg);
        } else {
          this.$set(this.list, i, {
            num: num,
            defaultpic: item.defaultpic,
            title: item.title,
            price: item.price,
            is_invalid: item.is_invalid,
            id: item.id,
            goodsid: item.goodsid,
            flag: item.flag,
            is_lose1: 1,
            attributeid:attributeid,
            date:date
          });
        }
      });
    },
    /**点击管理*/
    manage() {
      if (this.managetxt == "管理") {
        this.manageflag = false;
        this.managetxt = "完成";
        this.managedel = false;
        // this.inputflag = true
        console.log(this.list);
        this.list.map(item => {
          item.is_invalid = 1;
        });
      } else {
        this.manageflag = true;
        this.managetxt = "管理";
        this.managedel = true;
        this.inputflag = false;
        this.totalflag = false;
        this.list.map(item => {
          item.is_lose == 0 ? (item.is_invalid = 0) : (item.is_invalid = 1);
          item.flag = false;
        });
      }
    },
    /**点击复选框*/
    onCheckboxChange(flag, id, unit) {
      if (flag == true) {
        this.idArr.push(id); //如果选中则将其id存入数组，否 则删除
        this.unit.push(unit); //价格
      } else {
        this.idArr = this.idArr.filter(t => t != id);
        this.unit = this.unit.filter(i => i != unit);
      }
      let sum = 0;
      let total = [];
      let msg = 0;
      let num = this.list.length;
      this.list.forEach(item => {
        if (item.flag) {
          total.push(item);
          msg = total.length;
        }
        item.is_invalid == 0 ? (num = num - 1) : (num = num);
        num == msg ? (this.totalflag = true) : (this.totalflag = false);
      });
    },
    remove() {
      let id = [];
      this.list.map((item, i) => {
        if (item.flag) {
          id.push(item.id);
        }
      });
      console.log(id);
      delCart({ id }).then(res => {
        if (res.result == "success") {
          this.$toast("正在删除中").then(this.getList());
          this.$nextTick(() => {
            this.idArr.length = 0;
            this.units = "0";
          });
        }
      });
    },
    /**订单结算*/
    balance() {
      let id = [];
      this.list.map((item, i) => {
        if (item.flag) {
          id.push(item.id);
        }
      });
      console.log(id);
      let type = 2;
      cartList({ type, cart_id: id }).then(res => {
        if (id.length == "") {
          return this.$confirm("请勾选商品").then(() => {});
        } else {
          this.$router.push("/shop/confirm?id=" + id);
        }
      });
    },
    /**
     * 获取数据列表
     */
    getList(p = 1) {
      this.$showLoading();
      this.p = p;
      if (p == 1) {
        this.list = [];
      }
      let params = {
        p: p,
        maxperpage: 10
      };
      cartList(params).then(res => {
        res.list.map(item => {
          item.flag = false;
        });
        this.list = p == 1 ? res.list : this.list.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.totalput = res.page.totalput;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    change(flag) {
      this.list.map(item => {
        item.flag = flag;
      });
    },
    onCheckboxChanges() {
      if (this.totalflag) {
        this.list.map(item => {
          item.is_invalid == 1 ? (item.flag = true) : (item.flag = false);
        });
      } else {
        this.list.map(item => {
          item.flag = false;
        });
        // this.unit = []
      }
    },
    shopnum(num, goodsid, total, i,attributeid,date) {
      if (num > total) {
        num = total;
      }
      if (num == "") {
        num = 1;
      }
      this.list[i].num = num;
      addCart({ num, goodsid,attributeid }).then(res => {});
    }
  },
  activated() {
    document.title = "教辅周边";
    this.getList();
  },
  watch: {
    $route(to, from) {
      this.$router.go(0);
    }
  }
};
</script>
<style scoped>
.cart-top {
  font-size: 14px;
}
.shopping {
  line-height: 24px;
  color: #666;
}
.cart-top__btn {
  padding: 2px 5px;
  box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
  float: right;
}
.shopping-cart {
  font-size: 16px;
  color: black;
}
.cart {
  margin-top: 10px;
  background-color: #fff;
  border-radius: 5px;
  padding: 10px;
  font-size: 14px;
}
.cart-pull {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 1;
  overflow: hidden;
  font-size: 12px;
  background-color: #eee;
  color: #727272;
  padding: 2px;
  margin-bottom: 5px
}
.cart .ks-col-8 {
  padding-right: 28px;
  /* margin-top: 10px; */
}
.cart-btn {
  background-color: #fff;
  overflow: hidden;
  padding: 10px;
  font-size: 14px;
  line-height: 28px;
  position: fixed;
  bottom: 0;
  width: 100%;
}
.cart-total {
  margin-left: 10px;
  font-size: 16px;
  color: black;
}
.cart-sum {
  font-size: 16px;
  color: red;
}
.cart-btn__freight {
  color: #9a9a9a;
}
.cart-btn /deep/ .ks-button {
  margin: 0 15px 0 10px;
  border-radius: 25px;
}
.ks-col-3 {
  margin-top: 35px;
}
.ks-checkbox-outer {
  padding-left: 10px;
}
/* .versions-left
{
  width: 15px;
  position: absolute;
  left: -22px;
}
.versions-right{
  width: 15px;
  position: absolute;
  right: 0;
  top: 0;
} */
.versions-poa {
  position: relative;
}
.versions-poa input {
  width: 60px;
  margin-right: 20px;
  border: 1px solid #dbdbdb;
  /* box-shadow: 2px 2px 4px 0px #dbdbdb; */
  text-align: center;
  color: #999;
}
.price {
  color: red;
  font-size: 18px;
  line-height: 16px;
}
.pop-versions__poa {
  position: relative;
}
.pop-versions__poa input {
  width: 60px;
  margin-right: 20px;
  border: 1px solid #dbdbdb;
  text-align: center;
}
.pop-versions__left {
  width: 15px;
  position: absolute;
  left: -22px;
  top: 2px;
}
.pop-versions__right {
  width: 15px;
  position: absolute;
  right: 0;
  top: 2px;
}
div /deep/.cart /deep/.ks-image img {
  width: 75px;
  height: 75px;
}
.col_titile {
  height: 38px;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
}
.lose {
  width: 35px;
  height: 20px;
  line-height: 20px;
  color: #fff;
  font-size: 12px;
  background-color: #ccc;
  margin-right: 10px;
  text-align: center;
  border-radius: 10px;
}
.address-container {
  color: #000;
}
</style>