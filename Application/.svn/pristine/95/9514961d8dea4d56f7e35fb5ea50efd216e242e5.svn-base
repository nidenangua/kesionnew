
import { getCourseDetail } from "@/api/course";
import { getUserWealth } from "@/api/user";
const activity_detail = {
    data() {
        return {
            loading: false,
            activityId: null,
            /**页面数据 */
            courseInfo: {},
            /**选中票索引 */
            currentTicket: -1
        }
    },
    computed: {
        /**格式化时间 */
        formatTimestamp() {
            /**
             * @param {Number} 时间戳
             * @param {String} 需要返回的格式
             */
            return function (time, style = "style1") {
                let data = new Date(parseInt(time));
                let y = data.getFullYear();
                let m = data.getMonth() + 1;
                let d = data.getDate();
                let h = data.getHours();
                let mm = data.getMinutes();
                let s = data.getSeconds();
                m = m < 10 ? "0" + m : m;
                d = d < 10 ? "0" + d : d;
                h = h < 10 ? "0" + h : h;
                mm = mm < 10 ? "0" + mm : mm;
                s = s < 10 ? "0" + s : s;
                if (style == "style1") {
                    return y + "." + m + "." + d + " " + h + ":" + mm;
                } else if (style == "style2") {
                    return m + "." + d + " " + h + ":" + mm;
                } else if (style == "style3") {
                    return y + "." + m + "." + d
                } else if (style == "style4") {
                    return m + "月" + d + "日" + " " + h + ":" + mm;
                }
            };
        },
        /**当不存在urrentTicket判断票种最低价 */
        getPrice(){
            return function(courseinfo){
                let is_pledge = courseinfo.json.setting.is_pledge;
                let paymodel = courseinfo.json.setting.paymodel;
                let ticketArr = courseinfo.json.content.ticket_info;
                let price;
                if(is_pledge==0){
                    ticketArr.forEach((el,index)=>{
                        if(index==0){
                            price = el.chargetype==0?0:el.price;
                        }else{
                            if(el.chargetype==0){
                                price = price>0?0:price;
                            }else{
                                price = price>el.price?el.price:price;
                            }
                        }
                    })
                }else{
                    ticketArr.forEach((el,index)=>{
                        if(paymodel==0){
                            if(index==0){
                                price = el.chargetype==0?el.cash_deposit:+el.price + +el.cash_deposit;
                            }else{
                                if(el.chargetype==0){
                                    price = price > el.cash_deposit? el.cash_deposit:price;
                                }else{
                                    price = price > +el.cash_deposit + +el.price?(+el.cash_deposit + +el.price).toFixed(2):price;
                                }
                            }
                        }else{
                            if(index==0){
                                price = el.cash_deposit;
                            }else{
                                price = price > el.cash_deposit? el.cash_deposit:price;
                            }
                        }
                    })
                }

                return price;
            }
        },
        /**当存在currentTicket时判断票种最低价 */
        getMinPrice() {
            if(this.$route.query.ticketIndex || this.$route.query.ticketIndex == 0) {
                let obj = this.courseInfo.json.content.ticket_info[this.$route.query.ticketIndex];
                if (obj.chargetype == 0) {
                    if (this.courseInfo.json.setting.is_pledge == 1) {
                        return Number(obj.cash_deposit)
                    }
                }else{
                    if(this.courseInfo.json.setting.is_pledge == 0) {
                        return Number(obj.price)
                    }else {
                        if(this.courseInfo.json.setting.paymodel == 0){
                            return Number(obj.price)+Number(obj.cash_deposit)
                        }else{
                            return obj.cash_deposit
                        }
                    }
                }
            }
        }
    },
    activated() {
        this.loading = false;
        this.currentTicket = this.$route.query.ticketIndex;
        this.activityId = this.$route.params.id;
        getCourseDetail({
            id: this.activityId
        }).then(res => {
            if(res.courseinfo.json.content.ticket_info.length && res.courseinfo.json.content.ticket_info[0].status < 2) {
                this.currentTicket = 0
            }
            // this.currentTicket = this.$route.query.ticketIndex;
            this.courseInfo = res.courseinfo;
            this.loading = true;
            if (typeof this.onGetDetailSuccess === 'function') {
                this.onGetDetailSuccess(res)
            }
            /**更改表单部分 如果是类型是radio单选 给它加上一个select字段 用于v-model绑定 */
            let tempObj = JSON.parse(JSON.stringify(res.courseinfo));
            tempObj.json.form.forEach(el => {
                if (el.type == 'radio') {
                    el.select = el.content[0];
                }
                if(el.type == "checkbox") {
                    el.selectCheckArr = [];
                }
            })
           
            this.courseInfo = tempObj;
            if(this.$route.name === 'ActivityDetail'){
                document.title = this.courseInfo.title
            }
            if(this.$route.name === "ConfirmTicket") {
                this.paymodel = "";
                this.realname = this.$route.query.realname;
                this.tel = this.$route.query.tel;
                this.ticket_num = this.$route.query.num;
                this.currentTickets = this.$route.query.ticketIndex;
                this.paymodel = this.$route.query.paymodel;
                let id = this.$route.params.id;
                let ticketid = this.$route.query.ticketid;
                getUserWealth({ id, type: 2, ticketid }).then(res => {
                if ((res.resule = "success")) {
                    this.vouceherList = res.list;
                }
                });
            }
            if(this.$route.name === "PayModel") {
                this.now_currentTicket = this.$route.query.ticketIndex
            }
            if(this.$route.name === "RegistrationForm") {
                document.title = "订单支付"
            }
            if(this.$route.name === "SelectTicket") {
                document.title = "选择票种"
                this.payNum = "1";
                this.currentTicket = -1;
                this.time = new Date().valueOf()
            }
            /**配置微信分享 */
            this.$wxShare({
                title: this.courseInfo.title,
                desc: this.courseInfo.shortdesc,
                imgUrl: this.courseInfo.defaultpic
            });
        });
    }
}

export default activity_detail