<template>
  <div class="footer" v-if="show">
    <div class="footer-bar" :class="'footer-bar--style'+$store.state.style.id">
      <ul>
        <li
          :class="$route.path === item.url && 'active'"
          v-for="(item,index) in list"
          :key="index"
          @click="$router.push(item.url)"
        >
          <div class="icon" :class="item.icon"></div>
          <div
            class="name"
          >{{item.name}}</div>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import { getParams } from "@/utils";
export default {
  name: "StoreFooterBar",
  data() {
    return {
      show: false,
      list: []
    };
  },
  watch: {
    "$route.path"() {
      this.footerShow();
    }
  },
  methods: {
    footerShow() {
      let show = false;
      let params = getParams();
      this.list.map(item => {
        if (
          item.url === this.$route.path.toLocaleLowerCase() &&
          !params.h5token &&
          window.__wxjs_environment !== "miniprogram"
        ) {
          show = true;
        }
      });
      this.show = show;
    }
  },
  mounted() {
    this.$store.ready(state => {
      var tabBar = [
        {
          url: "/",
          name: "首页",
          icon: "icon-index"
        },
        {
          url: "/course",
          name: "课程",
          icon: "icon-course"
        }
      ];
      if (state.info.is_friends == 1) {
        tabBar.push({
          url: "/friend",
          name: "朋友圈",
          icon: "icon-blog"
        });
      }
      if(state.userInfo.usertype == 0){
        tabBar.push({
          url: "/user/course",
          name: "已购",
          icon: "icon-learn"
        })
      }
      tabBar.push(
        {
          url: "/user",
          name: "我的",
          icon: "icon-me"
        }
      );
      this.list = tabBar;
      this.footerShow();
    });
  }
};
</script>
<style lang="scss" scoped>
/*底部菜单*/

.footer,
.footer-bar {
  height: 49px;
  overflow: hidden;
}
.footer-bar {
  width: 100%;
  max-width: 480px;
  background: #fff;
  position: fixed;
  left: auto;
  bottom: 0;
  z-index: 90;
  ul {
    display: flex;
  }
  li {
    text-align: center;
    flex: 1;
  }
  .icon {
    width: 23px;
    height: 23px;
    display: block;
    margin: 0 auto;
    margin-top: 6px;
    background-size: 100%;
    background-position: 50% 50%;
    background-repeat: no-repeat;
  }
  .name {
    line-height: 20px;
    color: #999;
    font-size: 10px;
  }
  ::after{
    content: '';
    width: 100%;
    height: 1px;
    background: var(--prompt-color);
    -webkit-transform: scaleY(0.5);
    -ms-transform: scaleY(0.5);
    transform: scaleY(0.5);
    -webkit-transform-origin: 0 0;
    -ms-transform-origin: 0 0;
    transform-origin: 0 0;
    position: absolute;
    top: 0px;
    left: 0;
    right: 0;
  }
}

.footer-bar--style1{
  .icon-index {
    background-image: url(./assets/style1/nav_icon_index_n.png);
  }
  .icon-course {
    background-image: url(./assets/style1/nav_icon_lesson_n.png);
  }
  .icon-learn {
    background-image: url(./assets/style1/nav_icon_buy_n.png);
  }
  .icon-me {
    background-image: url(./assets/style1/nav_icon_me_n.png);
  }
  .icon-blog {
    background-image: url(./assets/style1/nav_icon_blog_n.png);
  }
  .active{
    .name {
      color: #333232;
    }
    .icon-index {
      background-image: url(./assets/style1/nav_icon_index_s.png);
    }
    .icon-course {
      background-image: url(./assets/style1/nav_icon_lesson_s.png);
    }
    .icon-learn {
      background-image: url(./assets/style1/nav_icon_buy_s.png);
    }
    .icon-me {
      background-image: url(./assets/style1/nav_icon_me_s.png);
    }
    .icon-blog {
      background-image: url(./assets/style1/nav_icon_blog_s.png);
    }
  }
}


.footer-bar--style2 {
  .icon-index {
    background-image: url(./assets/style2/nav_icon_index_n.png);
  }
  .icon-course {
    background-image: url(./assets/style2/nav_icon_lesson_n.png);
  }
  .icon-learn {
    background-image: url(./assets/style2/nav_icon_buy_n.png);
  }
  .icon-me {
    background-image: url(./assets/style2/nav_icon_me_n.png);
  }
  .active {
    .icon-index {
      background-image: url(./assets/style2/nav_icon_index_s.png);
    }
    .icon-course {
      background-image: url(./assets/style2/nav_icon_lesson_s.png);
    }
    .icon-learn {
      background-image: url(./assets/style2/nav_icon_buy_s.png);
    }

    .icon-me {
      background-image: url(./assets/style2/nav_icon_me_s.png);
    }
  }
}

.footer-bar--style3 {
  .icon-index {
    background-image: url(./assets/style3/nav_icon_index_n.png);
  }
  .icon-course {
    background-image: url(./assets/style3/nav_icon_lesson_n.png);
  }
  .icon-learn {
    background-image: url(./assets/style3/nav_icon_buy_n.png);
  }
  .icon-me {
    background-image: url(./assets/style3/nav_icon_me_n.png);
  }
  .active {
    .icon-index {
      background-image: url(./assets/style3/nav_icon_index_s.png);
    }
    .icon-course {
      background-image: url(./assets/style3/nav_icon_lesson_s.png);
    }
    .icon-learn {
      background-image: url(./assets/style3/nav_icon_buy_s.png);
    }

    .icon-me {
      background-image: url(./assets/style3/nav_icon_me_s.png);
    }
  }
}

.footer-bar--style4 {
  .icon-index {
    background-image: url(../../../assets/style4/tabbar/nav_icon_index_n.png);
  }
  .icon-course {
    background-image: url(../../../assets/style4/tabbar/nav_icon_lesson_n.png);
  }
  .icon-blog {
    background-image: url(../../../assets/style4/tabbar/nav_icon_moment_n.png);
  }
  .icon-learn {
    background-image: url(../../../assets/style4/tabbar/nav_icon_buy_n.png);
  }
  .icon-me {
    background-image: url(../../../assets/style4/tabbar/nav_icon_me_n.png);
  }
  .active {
    .name{
      color:#313033;
    }
    .icon-index {
      background-image: url(../../../assets/style4/tabbar/nav_icon_index_s.png);
    }
    .icon-course {
      background-image: url(../../../assets/style4/tabbar/nav_icon_lesson_s.png);
    }
    .icon-blog {
      background-image: url(../../../assets/style4/tabbar/nav_icon_moment_s.png);
    }
    .icon-learn {
      background-image: url(../../../assets/style4/tabbar/nav_icon_buy_s.png);
    }

    .icon-me {
      background-image: url(../../../assets/style4/tabbar/nav_icon_me_s.png);
    }
  }
}

.footer-bar--style5 {
  border-radius: 12px 12px 0 0;
  box-shadow:0px -4px 16px 0px rgba(60,76,139,0.08);
  .name{
    color:#A4A8BA
  }
  .icon-index {
    background-image: url(../../../assets/style5/tabbar/nav_icon_index_n.png);
  }
  .icon-course {
    background-image: url(../../../assets/style5/tabbar/nav_icon_lesson_n.png);
  }
  .icon-blog {
    background-image: url(../../../assets/style5/tabbar/nav_icon_moment_n.png);
  }
  .icon-learn {
    background-image: url(../../../assets/style5/tabbar/nav_icon_buy_n.png);
  }
  .icon-me {
    background-image: url(../../../assets/style5/tabbar/nav_icon_me_n.png);
  }
  .active {
    .name{
      color:#2E344C
    }
    .icon-index {
      background-image: url(../../../assets/style5/tabbar/nav_icon_index_s.png);
    }
    .icon-course {
      background-image: url(../../../assets/style5/tabbar/nav_icon_lesson_s.png);
    }
    .icon-blog {
      background-image: url(../../../assets/style5/tabbar/nav_icon_moment_s.png);
    }
    .icon-learn {
      background-image: url(../../../assets/style5/tabbar/nav_icon_buy_s.png);
    }

    .icon-me {
      background-image: url(../../../assets/style5/tabbar/nav_icon_me_s.png);
    }
  }
  ::after{
    display: none;
  }
}
</style>
