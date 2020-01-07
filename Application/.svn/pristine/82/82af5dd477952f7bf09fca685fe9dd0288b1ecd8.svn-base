<template>
  <div class="car">
    <div class="carhead">
      <h2>购物车</h2>
    </div>
    <el-table :data="list" style="width: 100%">
      <el-table-column width="55">
        <template slot-scope="scope">
          <el-checkbox v-if="scope.row.is_invalid" v-model="scope.row.flag" @change="isselect(scope.row.flag)"></el-checkbox>
          <span v-else class="over">失效</span>
        </template>
      </el-table-column>
      <el-table-column label="商品" width="420">
        <template slot-scope="scope" >
          <div class="shopping">
            <div>
              <img :src="scope.row.defaultpic">
            </div>
            <div>
              <p @click="gotodel(scope.row.goodsid)" class="ordermsg-shop__shop--title">{{scope.row.title}}</p>
              <p class="ordermsg-shop__shop--value">{{scope.row.date}}</p>
            </div>
          </div>
        </template>
      </el-table-column>
      <el-table-column prop="price" label="单价" width="180">
        <template slot-scope="scope">
          <span  v-if="scope.row.is_invalid">￥{{scope.row.price}}</span>
          <span v-else>￥ - -</span>
        </template>
      </el-table-column>
      <el-table-column label="数量">
        <template slot-scope="scope">
          <div class="shopnum" v-if="scope.row.is_invalid">
            <img
              class="pop-versions__left"
              src="../../assets/mall/common_btn_minus.png"
              @click="reducenum(scope.row.num,scope.$index,scope.row.goodsid,scope.row.attributeid,scope.row.date)"
            >
            <input
              type="number"
              v-model="scope.row.num"
              @input="totalmsg(scope.row.num,scope.row.goodsid,scope.row.stock,scope.$index,scope.row.attributeid,scope.row.date)"
            >
            <img
              class="pop-versions__right"
              src="../../assets/mall/common_btn_add.png"
              @click="addnum(scope.row.num,scope.$index,scope.row.goodsid,scope.row.attributeid,scope.row.date)"
            >
          </div>
        </template>
      </el-table-column>
      <el-table-column prop="total" label="小计">
        <template slot-scope="scope">
          <span class="subtotal" v-if="scope.row.is_invalid">￥{{(scope.row.price * scope.row.num).toFixed(2)}}</span>
          <span class="subtotal" v-else>已下架</span>
        </template>
      </el-table-column>
      <el-table-column label="操作">
        <template slot-scope="scope">
          <span class="del" @click="del(scope.row.id,scope.$index, list)">删除</span>
        </template>
      </el-table-column>
    </el-table>
    <div class="carfooter">
      <div class="carfooter-left">
        <el-checkbox v-model="flag" class="carfooter-left__input" @change="allChange"></el-checkbox>
        <span>
          全选(共
          <em>{{list.length}}</em> 件)
        </span>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
        <i class="del" @click="pitchdel">批量删除</i>
      </div>
      <div class="carfooter-right">
        已选商品
        <em>{{pitchnum}}</em> 件&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
        合计：
        <i>￥{{totalmoney}}</i>
        <span @click="gotoord">去结算</span>
      </div>
    </div>
    <el-pagination background="" layout="prev, pager, next" :total="totalnum"  :page-size="10"  @current-change="handleCurrentChange"></el-pagination>
  </div>
</template>

<script>
import { cartList, delCart, addCart, confirmOrder } from "@/api/mall.js";
export default {
  name: "shopcar",
  data() {
    return {
      list: [] /**列表数据 */,
      num: Number /**购买数量 */,
      flag: false /**是否全选 */,
      totalnum:0 /**商品总数 */
    };
  },
  methods: {
    getShoplist(p) {
      cartList({
        p: p,
        maxperpage: 10
      }).then(res => {
        console.log(res)
        res.list.map(item => {
          item.flag = false;
        });
        this.list = res.list;
        this.totalnum = parseInt(res.page.totalput)
      });
    },
    /**删除 */
    del(id, index, rows) {
      rows.splice(index, 1);
      let ids = [];
      ids.push(id);
      delCart({ id: ids }).then(res => {
        if (res.result == "success") {
          this.$message({
            message: "删除成功",
            type: "success"
          });
        }
      });
    },
    /**购物数量添加 */
    addnum(num, i, goodsid,attributeid,date) {
      num++;
      addCart({ num, goodsid,attributeid}).then(res => {
        if (res.result == "error" && res.msg == "该宝贝不能购买更多哦~") {
          this.$message.error(res.msg);
        } else {
          this.list[i].num = num;
        }
      });
    },
    /**购物数量减少 */
    reducenum(num, i, goodsid,attributeid,date) {
      num--;
      addCart({ num, goodsid,attributeid }).then(res => {
        if (res.result == "error" && res.msg == "该宝贝不能购买更多哦~") {
          this.$message.error(res.msg);
        } else {
          this.list[i].num = num;
        }
      });
    },
    /**全选 */
    allChange() {
      this.list.map(item => {
        if (this.flag) {
          if(item.is_invalid) {
            item.flag = true;
          }
        } else {
          item.flag = false;
        }
      });
    },
    /**单选 */
    isselect() {
      let num = [];
      let flagnum = 0;
      this.list.map(item => {
        if (item.flag) {
          num.push(item);
        }
        if(item.is_invalid) {
        return  flagnum++
        }else {
        return  flagnum
        }
      });
      flagnum == num.length ? (this.flag = true) : (this.flag = false);
    },
    /**多选删除 */
    pitchdel() {
      let id = [];
      this.list.map(item => {
        if (item.flag) {
          id.push(item.id);
        }
      });
      if (id.length == 0) {
        this.$message({ message: "请选择要删除的商品", type: "error" });
      } else {
        delCart({ id }).then(res => {
          if (res.result == "success") {
            this.$message({
              message: "删除成功",
              type: "success"
            });
          }
          this.getShoplist();
        });
      }
    },
    /**输入框数量 */
    totalmsg(num, goodsid, total, i,attributeid) {
      if (num > total) {
        num = total;
      }
      if (num == "") {
        num = 1;
      }
      this.list[i].num = num;
      addCart({ num, goodsid,attributeid }).then(res => {});
    },
    /**分页 */
    handleCurrentChange(val) {
      this.getShoplist(val)
      this.flag = false
    },
    /**跳订单 */
    gotoord(){
      let id = []
      this.list.map((item,i)=>{
        if(item.flag) {
          id.push(item.id)
        }
      })
      if(id.length == 0) {
        this.$message({message:"请选择商品",type:"error"})
      }else {
        this.$router.push(`/mall/confirm/?type=2&id=${id}`)
      }
    },
    /**跳详情 */
    gotodel(id) {
      this.$router.push(`/commodity?id=${id}`)
    }
  }, 
  created() {
    this.getShoplist();
  },
  activated() {
    this.getShoplist()
    this.flag = false
  },
  computed: {
    pitchnum() {
      let num = [];
      this.list.map(item => {
        if (item.flag) {
          num.push(item);
        }
      });
      return num.length;
    },
    totalmoney() {
      let num = 0;
      this.list.map(item => {
        if (item.flag) {
          num += item.num * item.price;
        }
      });
      return num.toFixed(2);
    }
  }
};
</script>


<style scoped>
.el-table__header-wrapper {
  margin-bottom: 20px;
}
em,
i {
  font-style: normal;
}
.el-table {
  background-color: transparent;
}
.car {
  width: 1200px;
  margin: 0 auto;
}
.carhead h2 {
  padding: 15px;
}
.has-gutter {
  margin-bottom: 20px;
}
.el-table td,
.el-table th.is-leaf,
.el-table td {
  border-bottom: 10px solid #f8f8f8;
}
.el-table th {
  text-align: center;
  padding: 10px 0;
  line-height: 23px;
}
.el-table__row {
  padding: 0;
}
.el-table::before {
  height: 0;
}
.cell {
  text-align: center;
}
.subtotal {
  color: #ec4a46;
  font-size: 14px;
}
.shopnum {
  position: relative;
}
.shopnum img {
  position: absolute;
  top: 3px;
}
.pop-versions__left {
  left: 0;
}
.shopnum input {
  border: 1px solid #f2f2f2;
  padding-left: 3px;
  text-align: center;
  width: 80px;
  height: 30px;
  margin: 0 18px;
}
.shopping{
  display: flex
}
.shopping img {
  width: 60px;
  height: 80px;
  vertical-align: middle;
  margin-right: 10px;
  float: left;
}
.shopping span {
    overflow: hidden;
    float: left;
    padding-top: 26px;
    width: 298px;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
}
.carfooter-left {
  float: left;
}
.carfooter-right {
  float: right;
}
.carfooter {
  height: 60px;
  line-height: 60px;
  background-color: #fff;
  padding: 0 20px;
}
.carfooter-left__input {
  margin-right: 10px !important;
}
.carfooter-left em,
.carfooter-right em {
  font-size: 14px;
  color: #ff6c00;
}
.carfooter-right i {
  font-size: 16px;
  color: #ff6c00;
}
.carfooter-right span {
  padding: 10px 15px;
  font-size: 16px;
  color: #fff;
  background-color: #ff6c00;
  border-radius: 40px;
  margin-left: 10px;
  cursor: pointer;
}
.pop-versions__left,
.pop-versions__right {
  cursor: pointer;
}
.del {
  cursor: pointer;
}
.el-table_1_column_2 .shopping {
  padding-left: 30px;
  box-sizing: border-box;
  text-align: left;
}
.el-pagination{
  text-align: center;
  margin-top: 20px
}
.over{
  padding: 3px;
  color: #fff;
  background-color: #ccc;
  border-radius: 8px
}
.el-table /deep/ .cell {
  text-align: center
}
.ordermsg-shop__shop--title{
  margin: 8px 15px 8px 15px;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
}
.ordermsg-shop__shop--value{
  padding: 0 15px;
  color: #aaa;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 1;
  overflow: hidden;
}
</style>
