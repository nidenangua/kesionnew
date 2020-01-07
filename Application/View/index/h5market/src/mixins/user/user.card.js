import { getUserCards } from "@/api/user";

const userCardMixin = {
    data() {
        return {
            loaded: false,
            pageCount: null,
            mygroup: {},
            groupList: []
        };
    },

    methods: {
        /**
         * 开通会员卡
         */
        cardPay(id, price) {
            this.$showPay({
                payid: id,
                price: price,
                type: "vipCard"
            });
        },
        getCardList() {
            this.$showLoading();
            this.loaded = false;
            getUserCards({
                p: 1,
                maxperpage: 20,
            }).then(res => {
                if (res.grouplist.length) {
                    this.groupList = res.grouplist;
                    this.pageCount = res.page.total_pages;
                }
                if (res.mygroup) {
                    this.mygroup = res.mygroup;
                }
                this.loaded = true;
                this.$hideLoading();
            });

        }

    }
}
export default userCardMixin