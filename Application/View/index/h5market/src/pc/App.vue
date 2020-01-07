<template>
  <div class="site-closed" v-if="status == 2">
	  <div class="site-closed__info">
		  <img :src="$store.state.info.logo" />
		  {{$store.state.info.sitename}}
	  </div>
	  <div class="site-closed__qrcode">
		  <img :src="$store.state.info.qrcode" />
	  </div>
	  <div class="site-closed__tips">
		  使用微信扫一扫访问店铺
	</div>
  </div>
  <div v-else-if="status != 0">
    <kd-header v-if="$route.name !== 'Index'" :data-item="headjson" />
    <keep-alive>
      <router-view></router-view>
    </keep-alive>
    <kd-footer v-if="$route.name !== 'Index'" />
  </div>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      status: 0,
      headjson: {}
    };
  },
  watch: {
    "$route.name"() {
      /**
       * 监听页面跳转，关闭可能未执行完的进程
       */
      this.$hideLoading();
      window.scrollTo(0, 0);
    }
  },
  methods: {},
  mounted() {
    this.$store.ready(state => {
      if(state.info.json){
        switch(state.info.json.service_type){
          case '53kf':
            if(state.info.json.service_url){
              let _53code = document.createElement("script")
              _53code.src = `https://tb.53kf.com/${state.info.json.service_url}`;
              document.getElementsByTagName('head')[0].appendChild(_53code)
            }
            break
        }
      }
	    this.status = state.info.status;
      this.headjson = state.headjson;
    });
  }
};
</script>
<style>
.site-closed{
	text-align: center;
	padding: 30px 0;
}
.site-closed__info{
	line-height:32px;
	font-size: 18px;
	font-weight: bold;
	display: inline-block;
	color:#555;
}
.site-closed__info img{
	width: 32px;
	height: 32px;
	float: left;
	margin-right: 15px;
	
}
.site-closed__qrcode{
	margin-top:20px;
}

.site-closed__tips{
	text-align: center;
	line-height: 44px;
	font-size: 14px;
}
</style>
