import { getParams, getViewRoute } from "@/utils";
import { getMyPurchase } from "@/api/user";

const userCourseMixin = {
    data() {
        return {
            loaded: false,
            pageCount: null,
            hasToken: -1,
            p: 1,
            list: [],
            tabActive: "course"
        };
    },
    methods: {
        open(item) {
            let params = getViewRoute(item);
            location.href = item.storeinfo.storeurl + "/#" + params;
        },
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
                maxperpage: 6,
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
                    this.pageCount = res.page.total_pages;
                }
                this.loaded = true;
                this.$hideLoading();
            });
        }
    }

}

export default userCourseMixin