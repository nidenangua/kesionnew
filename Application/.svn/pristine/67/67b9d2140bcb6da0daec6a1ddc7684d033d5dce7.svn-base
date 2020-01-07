<template>
  <div class="shipping">
    <ks-page-scroll-container
      v-if="list.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getList"
    >
      <div class="letter-box" v-for="(item,i) in list" :key="i" @click="selectsite(i)">
        <div class="letter-container">
          <div class="shipping-name">
            <span>{{item.realname}}</span>
            {{item.telphone}}
          </div>
          <div class="shipping-site">地址：{{item.province}}{{item.city}}{{item.area}}{{item.street}}</div>
          <div class="shipping-btn">
            <span v-if="item.is_address == 1" class="changeColor">
              <i class="ks-icon ks-icon-checkmark-circle-"></i>
            </span>
            <span v-if="item.is_address == 0" @click.stop="defaultAddress(item.id)">
              <i class="ks-icon ks-icon-checkmark-circle-"></i>
            </span>
            默认地址
            <span class="ks-fr">
              <i class="ks-icon ks-icon-checkmark-square"></i>
              <span @click.stop="editput(item.id)">编辑</span>
              <i class="ks-icon ks-icon-trash--outline"></i>
              <span @click.stop="delAddress(i,item.id)">删除</span>
            </span>
          </div>
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty msg="您还未添加任何收货地址" type="nogift" v-else-if="loaded" />
    <!-- 添加地址入口 -->
    <div class="shipping-add" @click="put"></div>
  </div>
</template>
<script>
import { addressList, delAddress,defaultAddress } from "@/api/mall";
export default {
  name: "",
  data() {
    return {
      changeColor: false,
      /**是否首次加载 */
      isFirstLoad: true,
      loaded: false,
      filterType: "",
      pageCount: null,
      filterType: "",
      p: 1,
      list: []
    };
  },
  computed: {},
  methods: {
    /**
     * 删除收货地址
     */
    delAddress(index, id) {
      this.$confirm("确定要删除该收货地址？").then(() => {
        let params = {
          id: id,
          type: 1
        };
        delAddress(params).then(res => {
          this.list.splice(index, 1);
        });
      });
    },
    /**
     * 设置默认收货地址
     */
    defaultAddress(id) {
      this.$confirm("确定要默认该收货地址？").then(() => {
        let params = {
          id: id,
        };
        defaultAddress(params).then(res => {
          this.getList();
        });
      });
    },
    /*添加地址入口*/
    put() {
      this.$router.push("/editAddress");
    },
    /*编辑收货地址*/
    editput(id) {
      console.log(111)
      this.$router.push("/editAddress?id="+id);
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

      addressList(params).then(res => {
        this.list = p == 1 ? res.list : this.list.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    /**选择收货地址 */
    selectsite(index) {
      sessionStorage.setItem('index',index)
      // let id = localStorage.getItem("cart_id")
      // this.$router.push(`/confirm?id=${id}&index=${index}`)
      this.$router.go(-1,`&index=${index}`)
    }
  },
  activated() {
    document.title = "收货地址";
    this.getList();
  }
};
</script>
<style scoped>
.shipping {
  padding: 10px;
}
.letter-box {
  padding-top: 5px;
  border-radius: 5px;
  width: 100%px;
  background: repeating-linear-gradient(
    140deg,
    #e55f56,
    #e55f56 20px,
    #fff 0,
    #fff 30px,
    #4d8ede 0,
    #4d8ede 50px,
    #fff 0,
    #fff 59px
  );
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  margin-bottom: 15px;
  overflow: hidden;
}
.letter-container {
  width: 100%;
  background: #fff;
  padding: 15px;
  font-size: 16px;
  color: #666;
}
.shipping-name span {
  font-size: 18px;
  color: #000;
  margin-right: 10px;
}
.shipping-site {
  padding: 10px 5px;
}
.shipping-btn {
  padding: 0 5px;
}
.changeColor .ks-icon-checkmark-circle- {
  color: #e55f56;
  font-size: 18px;
}
.ks-icon-checkmark-circle- {
  font-size: 18px;
}
.shipping-add {
  position: fixed;
  bottom: 115px;
  right: 20px;
  border-radius: 50%;
  width: 35px;
  height: 35px;
  background-color: #e64a3b;
}
.shipping-add:before,
.shipping-add:after {
  content: "";
  position: absolute;
  background: #fff;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.shipping-add:before {
  width: 2px;
  height: 20px;
}
.shipping-add:after {
  width: 20px;
  height: 2px;
}
</style>