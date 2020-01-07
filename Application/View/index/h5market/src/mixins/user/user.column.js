import { getParams, getViewRoute } from "@/utils";
import { getMyPurchase } from "@/api/user";

const userColumnMixin = {
    data() {
        return {
            loaded: false,
            pageCount: null,
            hasToken: -1,
            p: 1,
            list: [],
            tabActive: "column"
        };
    },
    methods: {
        handleClick(name) {
            this.getList();
        },
        getList(p = 1) {
            this.$showLoading();
            this.p = p;
            if (p == 1) {
                this.list = [];
            }
            let params = {
                p: p,
                maxperpage: 10,
                gettype: this.tabActive
            };
            let par = getParams();
            if (par.h5token) {
                params.h5token = par.h5token;
                this.hasToken = 1;
            } else {
                this.hasToken = 0;
            }
            getMyPurchase(params).then(res => {
                if (res.result === "success") {
                    this.list = res.values;
                    this.pageCount = res.page.total_pages * 10;
                }
                this.loaded = true;
                this.$hideLoading();
            });
        }
    }
}
export default userColumnMixin