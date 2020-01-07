<template>
  <div class="analysis-contianer" :style="{minHeight:windowHeight+'px'}" v-if="loaded">
	<swiper  ref="analysis" v-if="anliysisList.length" :style="{minHeight:windowHeight+'px'}">
	  <swiper-item
	    v-for="(item,i) in anliysisList"
	    :key="i">
		<scroll-view style="height: 100%;" :scroll-y="true">
        <analysis-item  :routers="routers" :iscorrect="iscorrect" :item="item" :level="1"></analysis-item>
        <div v-if="item.tktype==6">
          <div v-for="(child,c) in item.tkinfo.childtk" :key="c">
            <!--组合题部分-->
            <analysis-item
			
			 :routers="routers"
              :item="child"
              :iscorrect="iscorrect"
              :number="c+1+')'"
              :class="c < item.tkinfo.childtk.length-1 && 'ktj-line'"
              :parenttkid="item.tkid"
            ></analysis-item>
          </div>
        </div>
		</scroll-view>
      </swiper-item>
    </swiper>
    <ks-empty type="list" v-else>暂无数据</ks-empty>
  </div>
</template>

<script>
	import {AnalysisItem} from 'components/ks-components/analysis-item/analysis-item'
	import {GetRecordDetail,GetTestTk} from 'api/exam'
export default {
	components:{
		AnalysisItem
	},
  data () {
    return {
      loaded: false,
      windowHeight: '',
      swiperOption: {
        slidesPerView: 1,
        spaceBetween: 0,
        autoHeight: true
      },

      /**答题id */
      answerId: '',

      /**阅卷状态 */
      iscorrect: -1,

      /**
       * 解析列表
       */
      anliysisList: [],

      /**收藏解析 做题解析*/
      moduleName: '',

      /**
       * 标题
       */
      paper_title: '',
	  query:{},
	  routers:{},

    };
  },
  onHide() {
	 
  	this.loaded = false
  },
  //监听页面卸载
  onUnload(){
	this.loaded = false
  },
  onLoad(query) {
	  console.log(query)
	  this.routers.type = query.type
	  this.routers.name = query.name
  	this.query = query
  	this.paper_title = this.query.title
  	this.answerId=this.query.id
	this.moduleName = this.query.name
  	var that = this
  	uni.getSystemInfo({
  	    success: function (res) {
  			that.windowHeight = res.windowHeight    
  	    }
  	});
  },
  onShow() {

    this.anliysisList = [];
    var REQUEST_API;
    var params = {};

    if (this.moduleName == "analysis") {
      REQUEST_API = GetRecordDetail;
      params = {
        id: this.answerId,
        categoryid: this.query.categoryid,
        paperid: this.query.paperid,
        type: this.query.type || 1 //1整卷 2随机、错题

      };
    } else if (this.moduleName == "erroranaysis") {
      REQUEST_API = GetTestTk;
      params = {
        categoryid: this.query.categoryid
      };
    }

    if (!REQUEST_API) {
      return;
    }

    uni.showLoading();
    REQUEST_API(params).then(res=> {
      if (res.result) {
        var _anliysisList = [];
        res.data.map(item=> {
          item.tklist.map( (tk)=> {
            if (tk.tktype == 6) {
              tk.tkinfo.childtk.map(child=> {
                /**即时显示答题对错状态 */
                child.showAnswerStatus = true;
                /**禁止改变答案 */

                child.changeAnswer = false;
              });
            }
            /**即时显示答题对错状态 */


            tk.showAnswerStatus = true;
            /**禁止改变答案 */

            tk.changeAnswer = false;

            _anliysisList.push(tk);
          });
        });
        this.iscorrect = 1;
        this.anliysisList = _anliysisList;
      } else {
        this.iscorrect = 0;

        this.$msg(res.msg).then( ()=> {
		  uni.navigateBack()
        });
      }

      this.loaded = true;

      uni.hideLoading();
    });
  },
  methods: {
   
  }
}
</script>
<style scoped>
.van-icon-arrow-left {
  color: #4d4c4c !important;
}
.analysis-contianer {
  background: #fff;
  padding: 0 15px;
}
</style>
