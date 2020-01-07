import { getParams, getViewRoute } from "@/utils";
import { getUserCourseOrder, deleteOrder , confirmReceip } from "@/api/user";
const userOrderMixin = {
    data() {
        return {
            hasToken: -1,
            /**
             * 分页信息
             */
            page: 1,
            pageCount: null,
            /**
             * 当前筛选类型
             */
            paystatus: -1,
            orderstatus:-1,

            /**
             * 数据信息
             */
            loaded: false,
            datas: [],
            /**
             * 退款信息
             */
            refund: false,
            tel: "",
            wechat: "",
            tuikuanindex: -1
        };
    },
    methods: {
        /**
         * 选项卡切换回调
         */
        changeTab(pay) {
            if (pay ==3) {
                this.orderstatus = 1;
                this.paystatus = 3;
              }
              if(pay == 4){
                this.orderstatus = 2;
                this.paystatus = 4;
              }
              if (pay == -1 || pay == 1 || pay == 2) {
                this.paystatus = pay;
                this.orderstatus = -1;
              }
            //this.paystatus = pay;
            this.pageCount = null;
            this.loaded = false;
            this.getOrderList();
        },

        /**
         * 删除订单
         */
        delorder(index, sn) {
            this.$confirm("确定要删除该订单吗？", "提示", {
                type: 'warning'
            }).then(() => {
                let params = {
                    ordersn: sn
                };
                let par = getParams();
                if (par.h5token) {
                    params.h5token = par.h5token;
                }
                deleteOrder(params).then(res => {
                    this.$toast(res.msg, "success").then(() => {
                        this.datas.splice(index, 1);
                    });
                });
            });
        },
        /**
         * 确认收货
         */
        confirmReceip(index, sn) {
            this.$confirm("确定要确认收货吗？", "提示", {
                type: 'warning'
            }).then(() => {
                let params = {
                    ordersn: sn
                };
                confirmReceip(params).then(res => {
                    this.$toast(res.msg, "success").then(() => {
                        this.datas.splice(index, 1);
                    });
                });
            });
        },
        /**
         * 跳链接
         */
        open(url) {
            location.href = url;
        },
        /**
         * 打开详情页
         */
        openView(item, storeUrl) {
            if (item.type != 9) {
                let params = getViewRoute(item, "courseid");
                location.href = storeUrl + "/#" + params;
            }
        },
        /**
         * 查看订单
         */
        chakanDetail(sn) {
            this.$router.push({
                name: "UserOrderInfo",
                params: {
                    id: sn
                }
            });
        },
        /**
         * 支付
         */
        pay(url) {
            location.href = url;
        },
        /**
         * 获取订单列表
         */
        getOrderList(page = 1) {
            this.$showLoading();
            this.page = page;
            let params = {
                paystatus: this.paystatus,
                orderstatus:this.orderstatus,
                p: this.page,
                maxperpage: 10
            };
            let par = getParams();
            if (par.h5token) {
                params.h5token = par.h5token;
                this.hasToken = 1;
            } else {
                this.hasToken = 0;
            }
            getUserCourseOrder(params).then(res => {
                this.datas = res.values;
                this.pageCount = res.page.total_pages * 10;
                this.loaded = true;
                this.$hideLoading();
            });
        }
    }
}

export default userOrderMixin