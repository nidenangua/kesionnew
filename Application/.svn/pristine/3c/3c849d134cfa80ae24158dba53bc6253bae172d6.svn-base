<template>
  <div class="page" v-if="$store.state.isLogin != -1 && flag">
    <div class="user--style5" v-if="$store.state.style.id == 4 || $store.state.style.id == 5">
        <div class="user-header" @click="open({url:'/user/login'})" v-if="$store.state.isLogin == 0">
          <div class="user-header__info">
            <div class="user-header__name">
              登录
            </div>
            <div class="user-header__tel">
              点击登录 享受更多精彩信息
            </div>
          </div>
          <ks-image class="user-header__avatar" type="user" src="../../../assets/common/default-avatar.jpg" />
        </div>
        <div class="user-header" @click="open({url:'/user/setting'})" v-else-if="$store.state.isLogin == 1">
          <div class="user-header__info">
            <div class="user-header__name">
              {{$store.state.userInfo.name || $store.state.userInfo.username}}
            </div>
            <div class="user-header__tel">
              {{$store.state.userInfo.encrypt_mobile}}
            </div>
          </div>
          <ks-image class="user-header__avatar" type="user" :src="$store.state.userInfo.headimg" />
        </div>
        <div class="user-menu user-box clearfix" v-if="$store.state.userInfo.usertype == 0 || $store.state.isLogin == 0">
          <div class="user-menu__item" @click="open({url:'/user/order'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_order@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_order@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                我的订单
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/user/group'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_group@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_group@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                我的社群
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/myactivity'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_activity@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_activity@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                我的活动
              </div>
          </div>
          <div class="user-menu__item"  @click="open({url:'/mentoringcollect'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_question@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_question@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                我的提问
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/user/mycard'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_card@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_card@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                折扣卡
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/user/vouceher'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_coupon@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_coupon@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                优惠券
              </div>
          </div>
          <!-- <div class="user-menu__item" @click="open({url:'/user/giftrecord'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_gift@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_gift@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                赠送记录
              </div>
          </div> -->
          <div class="user-menu__item" @click="open({url:'/user/distribution'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_retail@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_gift@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                我的分销
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/user/certificate'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/student/me_btn_bonus 2.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/student/me_btn_retail.png" v-else />
              </div>
              <div class="user-menu__text">
                我的成就
              </div>
          </div>
        </div>
        <ks-list item-height="49px" style="margin-top:20px;" v-if="$store.state.userInfo.usertype == 0 || $store.state.isLogin == 0">
          <ks-list-item
            title="升级会员"
            padding="0px"
            :arrow-color="$store.state.style.color.primary_text"
            arrow-size="18px"
            @click="open({url:'/user/uservip'})"
            show-arrow
          />
          <ks-list-item
            title="领券中心"
            padding="0px"
            :arrow-color="$store.state.style.color.primary_text"
            arrow-size="18px"
            @click="open({url:'/user/getVouceher'})"
            show-arrow
          />
          <ks-list-item
            title="消息"
            padding="0px"
            :arrow-color="$store.state.style.color.primary_text"
            arrow-size="18px"
            @click="open({url:'/user/notice'})"
            show-arrow
          />
          <ks-list-item
            title="设置"
            padding="0px"
            :arrow-color="$store.state.style.color.primary_text"
            @click="open({url:'/user/setting'})"
            arrow-size="18px"
            show-arrow
          />
        </ks-list>
        <div class="user-version" @click="open({url:'/user/UserVersions'})" v-if="$store.state.userInfo.usertype == 2">
          <div class="user-version__icon">
            <img src="../../../assets/style5/user/school/me_icon_version@2x.png" />
          </div>
          <div class="user-version__text" v-if="($store.state.info.version == 0 || $store.state.info.version == 100)">万人名师扶持计划</div>
          <div class="user-version__text" v-else-if="$store.state.info.version == 1">基础运营版</div>
          <div class="user-version__text" v-else-if="$store.state.info.version == 2">高级运营版</div>
          <div class="user-version__text" v-else-if="$store.state.info.version == 3">钻石服务版</div>
          <div class="user-version__look">
            查看权益<i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
          </div>
        </div>
        <div class="user-data user-box" v-if="$store.state.userInfo.usertype > 0">
          <div class="user-data__item" @click="open({url:'/user/studentManage'})">
            <div class="user-data__num">
              {{$store.state.userInfo.schoolinfo.payorderuser}}
            </div>
            <div class="user-data__text">
              总付费学员
            </div>
          </div>
          <div class="user-data__item" @click="open({url:'/user/studentManage'})">
            <div class="user-data__num">
              {{$store.state.userInfo.schoolinfo.daypayuser}}
            </div>
            <div class="user-data__text">
              今日付费学员
            </div>
          </div>
          <div class="user-data__item" @click="open({url:'/user/accounIncome'})">
            <div class="user-data__num">
              {{$store.state.userInfo.schoolinfo.ordernum || '0.00'}}
            </div>
            <div class="user-data__text">
              今日总销售额(元)
            </div>
          </div>
        </div>
        <div class="user-box" v-if="$store.state.userInfo.usertype == 1">
            <ks-list item-height="49px">
              <ks-list-item
                title="学员管理"
                :icon="require('../../../assets/style'+$store.state.style.id+'/user/teacher/teacher_btn_stumanage@3x.png')"
                :arrow-color="$store.state.style.color.primary_text"
                arrow-size="18px"
                @click="open({url:'/user/studentManage'})"
                show-arrow
              />
              <ks-list-item
                title="课程管理"
                :icon="require('../../../assets/style'+$store.state.style.id+'/user/teacher/teacher_btn_lesson@3x.png')"
                :arrow-color="$store.state.style.color.primary_text"
                arrow-size="18px"
                @click="open({url:'/courseIndex'})"
                show-arrow
              />
              <ks-list-item
                title="活动管理"
                :icon="require('../../../assets/style'+$store.state.style.id+'/user/teacher/teacher_btn_activity@3x.png')"
                :arrow-color="$store.state.style.color.primary_text"
                @click="open({url:'/activityList'})"
                arrow-size="18px"
                show-arrow
              />
              <ks-list-item
                title="答疑管理"
                :icon="require('../../../assets/style'+$store.state.style.id+'/user/teacher/teacher_btn_answer@3x.png')"
                :arrow-color="$store.state.style.color.primary_text"
                @click="open({url:'/MentoringAudit'})"
                arrow-size="18px"
                show-arrow
              />
            </ks-list>
        </div>
        <div class="user-box" v-if="$store.state.userInfo.usertype == 1">
            <ks-list item-height="49px">
              <ks-list-item
                title="收入管理"
                :icon="require('../../../assets/style'+$store.state.style.id+'/user/teacher/teacher_btn_income@3x.png')"
                :arrow-color="$store.state.style.color.primary_text"
                arrow-size="18px"
                @click="open({url:'/user/accounIncome'})"
                show-arrow
              />
              <ks-list-item
                title="提现管理"
                :icon="require('../../../assets/style'+$store.state.style.id+'/user/teacher/teacher_btn_withdraw@3x.png')"
                :arrow-color="$store.state.style.color.primary_text"
                arrow-size="18px"
                @click="open({url:'/user/extractManage'})"
                show-arrow
              />
            </ks-list>
        </div>
        <div class="user-title" v-if="$store.state.userInfo.usertype == 2">我的工具</div>
        <div class="user-menu user-menu--school user-box user-box--ns clearfix" v-if="$store.state.userInfo.usertype == 2">
          <div class="user-menu__item" @click="open({url:'/user/studentManage'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/school/teacher_btn_stumanage@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/school/teacher_btn_stumanage@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                学员
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/courseIndex'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/school/teacher_btn_lesson@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/school/teacher_btn_lesson@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                课程
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/activityList'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/school/teacher_btn_activity@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/school/teacher_btn_activity@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                活动
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/MentoringAudit'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/school/teacher_btn_answer@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/school/teacher_btn_answer@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                答疑
              </div>
          </div>
          <div class="user-menu__item" @click="open({url:'/user/accountManage'})">
              <div class="user-menu__icon">
                <img src="../../../assets/style4/user/school/teacher_btn_subaccount@2x.png" v-if="$store.state.style.id == 4" />
                <img src="../../../assets/style5/user/school/teacher_btn_subaccount@2x.png" v-else />
              </div>
              <div class="user-menu__text">
                子账号
              </div>
          </div>
        </div>
        <div class="user-title" v-if="$store.state.userInfo.usertype == 2">我的服务</div>
        <div class="user-menu user-menu--school user-box user-box--ns clearfix" v-if="$store.state.userInfo.usertype == 2">
            <div class="user-menu__item" @click="open({url:'/user/accounIncome'})">
                <div class="user-menu__icon">
                  <img src="../../../assets/style4/user/school/teacher_btn_income@2x.png" v-if="$store.state.style.id == 4" />
                  <img src="../../../assets/style5/user/school/teacher_btn_income@2x.png" v-else />
                </div>
                <div class="user-menu__text">
                  收入管理
                </div>
            </div>
            <div class="user-menu__item" @click="open({url:'/user/extractManage'})">
                <div class="user-menu__icon">
                  <img src="../../../assets/style4/user/school/teacher_btn_withdraw@2x.png" v-if="$store.state.style.id == 4" />
                  <img src="../../../assets/style5/user/school/teacher_btn_withdraw@2x.png" v-else />
                </div>
                <div class="user-menu__text">
                  提现管理
                </div>
            </div>
          </div>
    </div>
    <div class="user--default" v-else>
      <div @click="open({url:'/user/setting'})" class="user_header" :class="!isStudent && 'line'">
        <div class="user_id" v-if="$store.state.isLogin == 0">
          <ks-create-bg class="user_img" src="../../../assets/common/default-avatar.jpg" type="user" />
          <div class="user_name">
            <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
            <h3 style="line-height:46px;">请先登录</h3>
          </div>
        </div>
        <div class="user_id" v-else-if="$store.state.isLogin == 1">
          <ks-create-bg class="user_img" :src="$store.state.userInfo.headimg" type="user" />
          <div class="user_name">
            <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
            <h3>{{$store.state.userInfo.name || $store.state.userInfo.username}}</h3>
            <p>
              <i class="ks-icon ks-icon-smartphone-outline"></i>
              {{$store.state.userInfo.encrypt_mobile}}
            </p>
          </div>
        </div>
      </div>
      <div
        class="user_teacher"
        v-if="$store.state.userInfo.is_teacher && $store.state.userInfo.teacher_name"
      >
        <div class="user_teacher_box">
          <span class="user_teacher_tel" v-if="$store.state.userInfo.teacher_mobile">
            <a :href="'tel:'+$store.state.userInfo.teacher_mobile">
              <i class="ks-icon ks-icon-phone"></i>
              {{$store.state.userInfo.teacher_mobile}}
            </a>
          </span>
          <strong>班主任：{{$store.state.userInfo.teacher_name || "未分配"}}</strong>
        </div>
      </div>
      <!--个人会员-->
      <div class="user_menu" v-if="isStudent">
        <ks-list class="ks-mt10" v-for="(list,index) in menu" :key="index">
          <ks-list-item
            :title="item.name"
            v-for="(item,i) in list"
            :key="i"
            :icon="item.icon"
            @click="open(item)"
            show-arrow
          >
            <div class="ks-list-item__num" v-if="item.message">{{item.message}}</div>
          </ks-list-item>
        </ks-list>
      </div>
      <!--机构或教师-->
      <div v-else>
        <div class="userlist clearfix" v-if="$store.state.userInfo.schoolinfo">
          <ul>
            <li>
              <div class="number">{{$store.state.userInfo.schoolinfo.payorderuser}}</div>
              <div class="item">总付费学员</div>
            </li>
            <li>
              <div class="number">{{$store.state.userInfo.schoolinfo.daypayuser}}</div>
              <div class="item">今日付费学员</div>
            </li>
            <li>
              <div class="number">{{$store.state.userInfo.schoolinfo.ordernum || '0.00'}}</div>
              <div class="item">今日总销售额(元)</div>
            </li>
          </ul>
        </div>
        <ks-list class="ks-mt10" v-for="(list,index) in listMsg" :key="index">
          <ks-list class="ks-mt10">
            <ks-list-item
              :title="item.name"
              v-for="(item,i) in list"
              :key="i"
              :icon="item.icon"
              @click="open(item)"
              show-arrow
            >
              <div v-if="item.msg && (version==0 || version==100)">万人名师扶持计划</div>
              <div v-if="item.msg && version==1">基础运营版</div>
              <div v-if="item.msg && version==2">高级运营版</div>
              <div v-if="item.msg && version==3">钻石服务版</div>
            </ks-list-item>
          </ks-list>
        </ks-list>
      </div>
    
    </div>
    <store-footer />
    <store-footer-bar />
  </div>
</template>

<script>
import { cloneData } from "@/utils";
import { saveModuleSwitch } from "@/api/store";
import { getMessageNum, userPower } from "@/api/user";
/**点击按钮复制 */
import Clipboard from "clipboard";
let originalSwitch;
export default {
  name: "user",
  data() {
    return {
      /**当前版本号 */
      version: "",
      tab: 0,
      isStudent: true,
      moduleList: [],
      moduleSwitch: {},
      menu: [
        [
          {
            icon: require("../../../assets/user/me_icon_order.png"),
            name: "我的订单",
            url: "/user/order"
          },
          {
            icon: require("../../../assets/user/me_icon_gift.png"),
            name: "赠送记录",
            url: "/user/giftrecord"
          }
        ],
        [
          {
            icon: require("../../../assets/user/me_icon_vip.png"),
            name: "升级会员",
            url: "/user/uservip "
          },
          {
            icon: require("../../../assets/user/me_icon_card.png"),
            name: "我的折扣卡",
            url: "/user/mycard"
          },
          {
            icon: require("../../../assets/user/me_icon_coupon.png"),
            name: "领券中心",
            url: "/user/getVouceher"
          },
          {
            icon: require("../../../assets/user/me_icon_coupon.png"),
            name: "我的优惠券",
            url: "/user/vouceher"
          }
        ],
        [
          {
            icon: require("../../../assets/user/me_icon_share.png"),
            name: "我的分销",
            url: "/user/distribution"
          },
          {
            icon: require("../../../assets/user/me_icon_distribute.png"),
            name: "我的社群",
            url: "/user/group"
          },
          {
            icon: require("../../../assets/user/me_icon_activity.png"),
            name: "我的活动",
            url: "/myactivity"
          },
          {
            icon: require("../../../assets/user/me_icon_question.png"),
            name: "我的提问",
            url: "/mentoringcollect"
          }
        ],
        [
          {
            icon: require("../../../assets/user/me_icon_message.png"),
            name: "消息",
            url: "/user/notice",
            message: 0
          },
          {
            icon: require("../../../assets/user/me_icon_setting.png"),
            name: "设置",
            url: "/user/setting"
          }
        ]
      ],
      setMenu: [
        {
          icon: require("../../../assets/user/epicon/me_student@2x.png"),
          name: "学员管理",
          url: "/home.html/default/WeChat/stuadmin",
          type: "location"
        },
        {
          icon: require("../../../assets/user/epicon/me_wechat@2x.png"),
          name: "微门户设置",
          url: "/home.html/default/WeChat/gateset",
          type: "location"
        },
        {
          icon: require("../../../assets/user/epicon/me_banner@2x.png"),
          name: "banner设置",
          url: "/home.html/default/WeChat/bannerset",
          type: "location"
        },
        {
          icon: require("../../../assets/user/epicon/me_style@2x.png"),
          name: "切换风格",
          url: "/user/storestyle"
        },
        {
          icon: require("../../../assets/user/epicon/me_pic@2x.png"),
          name: "新闻管理",
          url: "/home.html/default/WeChat/gateNews",
          type: "location"
        },
        {
          icon: require("../../../assets/user/epicon/me_question.png"),
          name: "我的答疑",
          url: "/mentoringaudit"
        }
      ],
      teacherMenu: [
        [
          {
            icon: require("../../../assets/user/teacher_btn_version.png"),
            name: "微名师版本",
            url: "/user/UserVersions",
            msg: 1
          }
        ],
        [
          {
            icon: require("../../../assets/user/teacher_btn_lesson.png"),
            name: "课程管理",
            url: "/courseIndex"
          },
          {
            icon: require("../../../assets/user/teacher_btn_activity.png"),
            name: "活动管理",
            url: "/activityList"
          },
          {
            icon: require("../../../assets/user/teacher_btn_answer.png"),
            name: "讲师答疑",
            url: "/MentoringAudit"
          }
        ],
        [
          {
            icon: require("../../../assets/user/teacher_btn_other.png"),
            name: "子账号管理",
            url: "/user/accountManage"
          },
          {
            icon: require("../../../assets/user/teacher_btn_stumanage.png"),
            name: "学员管理",
            url: "/user/studentManage"
          }
        ],
        [
          {
            icon: require("../../../assets/user/teacher_btn_order.png"),
            name: "订单管理",
            url: "/user/order",
            message: 0
          },
          {
            icon: require("../../../assets/user/teacher_btn_income.png"),
            name: "收入管理",
            url: "/user/accounIncome"
          },
          {
            icon: require("../../../assets/user/teacher_btn_withdraw.png"),
            name: "提现管理",
            url: "/user/extractManage"
          }
        ]
      ],
      listMsg: [],
      flag: false
    };
  },
  methods: {
    open(item) {
      let isLogin = this.$store.state.isLogin;
      if (isLogin == -1) {
        return false;
      } else if (isLogin == 0) {
        this.$router.push("/user/login");
      } else {
        if (item.type === "location") {
          location.href = item.url;
        } else {
          this.$router.push(item.url);
        }
      }
    },

    /**复制电话 */
    copyMobile() {
      let clipboard = new Clipboard(this.$refs.copyMobile.$el);
      clipboard.on("success", e => {
        // 释放内存
        clipboard.destroy();
        this.teacherVisible = false;
        this.$toast("复制成功", "success");
      });
      clipboard.on("error", e => {
        // 不支持复制
        // console.log("该浏览器不支持自动复制"); // 释放内存
        clipboard.destroy();
        this.teacherVisible = false;
        this.$toast("复制失败");
      });
    },
 
    
    /**
     * 更新消息数量
     */
    updateMessageNum(num) {
      this.menu.map(arr => {
        arr.map(item => {
          if (item.message !== undefined) {
            item.message = num;
          }
        });
      });
    }
  },

  activated() {
    userPower().then(res => {
      res.list.unshift([
        {
          icon: require("../../../assets/user/teacher_btn_version.png"),
          name: "微名师版本",
          url: "/user/UserVersions",
          msg: 1
        }
      ]);
      this.listMsg = res.list;
      this.flag = true;
    });
    document.title = "我的";
    this.$store.ready(state => {
      this.version = state.info.version;
      if (state.isLogin == 1) {
        let usertype = state.userInfo.usertype;

        /**
         * 机构或教师
         */
        if (usertype > 0) {
          this.isStudent = false;
        } else {
          /**
           * 学员获取消息数量
           */
          getMessageNum().then(res => {
            if (res.result === "success") {
              this.updateMessageNum(res.informationNum + res.noticeNum);
            }
          });
        }
      } else {
        this.isStudent = true;
        this.updateMessageNum(0);
      }
    });
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.user--style5{
  background: #fff;
  padding: 20px 0;
  .user-header{
    display: flex;
    padding: 10px 15px;
    align-items: center;
  }
  .user-header__info{
    flex: 1;
  }
  .user-header__name{
    font-size: 22px;
    font-weight: bold;
  }
  .user-header__tel{
    font-size: 12px;
    color:var(--auxiliary_text-color);
    margin-top: 10px;
  }
  .user-header__avatar{
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
  }
  .user-menu{
    padding: 15px 0;
  }
  .user-menu__item{
    width: 25%;
    float: left;
    text-align: center;
    padding: 5px 0;
  }
  .user-menu__icon{
    width: 32px;
    height: 32px;
    display: block;
    margin: 0 auto;
    img{
      width: 100%;
      height: 100%;
    }
  }
  .user-menu__text{
    color:var(--secondary_text-color);
    font-weight: bold;
    font-size: 13px;
    height: 28px;
    line-height: 28px;
    overflow: hidden;
  }
  .user-menu--school{
    padding: 0px;
    .user-menu__icon{
      width: 40px;
      height: 40px;
    }
    .user-menu__item{
      width: 33.3%;
    }
    .user-menu__text{
      font-size:14px
    }
  }
  .ks-list-item::after{
    display: none;
  }
  .user-title{
    font-size: 18px;
    font-weight: bold;
    color:var(--secondary_text-color);
    margin:30px 15px 0 15px;
  }
  .user-box{
    box-shadow:0px 2px 8px 0px rgba(60,76,139,0.08);
    margin: 20px 15px 0 15px;
    border-radius: 10px;
  }
  .user-box--ns{
    box-shadow:0px 0 0 #fff;
  }
  .user-version{
    display: flex;
    height: 50px;
    align-items: center;
    background: var(--prompt-color);
    color:#fff;
    margin: 20px 15px 0 15px;
    border-radius: 5px;
    padding: 0 15px;
    font-size: 14px;
  }
  .user-version__text{
    flex: 1;
    font-size: 16px;
  }
  .user-version__icon{
    width: 26px;
    height: 26px;
    margin-right: 10px;
    img{
      width: 100%;
      height: 100%;
    }
  }
  .user-version__look{
    font-size: 12px;
    .ks-icon{
      position: relative;
      top: 2px;
    }
  }
  .user-data{
    display: flex;
    padding: 15px 0;
    text-align: center;
  }
  .user-data__item{
    flex:1
  }
  .user-data__num{
    font-size: 22px;
    font-weight: bold;
    height:32px;
    line-height: 32px;
    overflow: hidden;
  }
  .user-data__text{
    color:var(--auxiliary_text-color);
    height: 24px;
    line-height: 24px;
    overflow: hidden;
  }

}

/**默认风格 */
.user--default{

  .user_header {
    background: #fff;
    padding: 15px;
    height: 60px;
    position: relative;
    overflow: hidden;
  }
  .user_header .user_img {
    height: 60px;
    width: 60px;
    overflow: hidden;
    border-radius: 50%;
    position: absolute;
    left: 15px;
    top: 15px;
  }
  .user_header .user_img img {
    max-width: 100%;
    height: auto;
  }
  .user_header .ks-icon-arrow-ios-forward-outline {
    position: absolute;
    right: 15px;
    width: 16px;
    height: 16px;
    top: 50%;
    margin-top: -8px;
    color: #b3b3b3;
  }

  .user_id .user_name {
    padding: 7px 0 0 75px;
  }

  .user_id h3 {
    font-size: 16px;
  }
  .user_id p {
    font-size: 12px;
    color: #999;
    margin-top: 7px;
    line-height: 16px;
  }
  .user_id .ks-icon-smartphone-outline {
    width: 14px;
    height: 14px;
    float: left;
    margin-right: 2px;
    font-size: 14px;
  }
  .user_id .user_code {
    position: absolute;
    right: 25px;
    width: 20px;
    height: 20px;
    padding: 10px;
    top: 50%;
    margin-top: -20px;
  }
  .user_id .user_code img {
    width: 20px;
  }

  .user_teacher {
    background: #fff;
    padding: 0 10px 10px 10px;
  }
  .user_teacher_box {
    background: linear-gradient(left, #eafdf5, #cef8e7);
    height: 44px;
    color: #23b87b;
    line-height: 44px;
    padding: 0 15px;
    font-size: 14px;
    border-radius: 44px;
  }
  .user_teacher_box a {
    color: #23b87b;
    font-weight: bold;
  }
  .user_teacher_tel {
    float: right;
    font-size: 12px;
  }
  .user_teacher_tel i {
    color: #23b87b;
    position: relative;
    font-weight: normal;
    top: 2px;
    margin-right: 5px;
  }

  /*机构会员*/

  .menu-tab {
    height: 49px;
    line-height: 49px;
    background: #fff;
    margin-top: 10px;
    overflow: hidden;
    position: relative;
  }
  .menu-tab ul {
    overflow-x: auto;
    margin-right: 44px;
    -webkit-overflow-scrolling: touch;
    white-space: nowrap;
  }
  .menu-tab li {
    margin: 0 15px;
    font-size: 16px;
    box-sizing: border-box;
    color: #5b6067;
    display: inline-block;
  }
  .menu-tab .curr {
    position: relative;
    color: #e64a3b;
  }
  .menu-tab .curr:after {
    content: "";
    height: 2px;
    background: #e64a3b;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
  }

  .userlist {
    overflow: hidden;
    padding: 10px 0;
    text-align: center;
    background: #fff;
  }
  .userlist li {
    float: left;
    width: 33.3%;
  }
  .userlist li .number {
    font-size: 20px;
    line-height: 20px;
  }
  .userlist li .item {
    font-size: 11px;
    line-height: 14px;
    color: #999;
    margin-top: 6px;
  }

  /*list*/
  .menu-cont-list {
    background: #fff;
    margin-top: 10px;
  }
  .menu-cont-list li {
    height: 44px;
    line-height: 44px;
    position: relative;
    padding-left: 36px;
    margin-left: 15px;
    font-size: 14px;
  }
  .menu-cont-list li .icon {
    width: 32px;
    height: 44px;
    position: absolute;
    left: 0;
    top: 0;
    background-size: 18px;
    background-repeat: no-repeat;
    background-position: 50% 50%;
  }
  .menu-cont-list li .me_order {
    background-image: url(../../../assets/user/epicon/me_order.png);
  }
  .menu-cont-list li .me_enter {
    background-image: url(../../../assets/user/epicon/me_enter.png);
  }
  .menu-cont-list li .me_balance {
    background-image: url(../../../assets/user/epicon/me_balance.png);
  }

  .menu-cont-list .set {
    padding-left: 0;
    text-align: center;
    color: #37a7ed;
    margin-left: 0;
  }

  .menu-cont-li {
    background: #fff;
    margin-top: 10px;
  }
  .menu-cont-li .icon-box {
    position: absolute;
    top: 0;
    left: 50%;
    width: 30px;
    height: 30px;
    margin-left: -15px;
  }
  .menu-cont-li .icon-box img {
    width: 100%;
  }
  .menu-cont-li ul {
    padding-top: 15px;
  }
  .menu-cont-li li {
    position: relative;
    padding-top: 35px;
    margin-bottom: 15px;
    font-size: 15px;
    box-sizing: border-box;
    text-align: center;
    width: 33.3333%;
    float: left;
    color: #777;
  }
  .menu-cont-li .menu-title {
    background: #fff;
    font-size: 16px;
    height: 49px;
    line-height: 49px;
    padding: 0 15px;
  }
}

</style>
