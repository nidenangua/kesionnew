<template>
  <div class="analysis-contianer" :style="{minHeight:windowHeight+'px'}" v-if="loaded">
    <div class="analysis-contianer-inner">
	<swiper  ref="ownscore" v-if="anliysisList.length" :style="{minHeight:windowHeight+'px'}">
	  <swiper-item
	    v-for="(item,i) in anliysisList"
	    :key="i">
		<scroll-view style="height: 100%;" :scroll-y="true">
          <analysis-item :routers="routers" :item="item" :level="1"></analysis-item>
          <div class="score-input" v-if="item.tktype!=6">
            自己评分<input v-model="item.new_score" placeholder="请输入分数" class="score-box" @input="JudgeScore(item)"/>
          </div>
          <div v-if="item.tktype==6">
            <div v-for="(child,c) in item.tkinfo.childtk" :key="c">
              <!--组合题部分-->
              <analysis-item
			  
			  :routers="routers"
                :item="child"
                :number="c+1+')'"
                :class="c < item.tkinfo.childtk.length-1 && 'ktj-line'"
              />
              <div class="score-input">
                自己评分<input v-model="child.new_score" placeholder="请输入分数" class="score-box" @input="JudgeScore(child)"/>
              </div>
            </div>
          </div>
		  </scroll-view>
        </swiper-item>
      </swiper>
	  <ks-empty type="list" v-else>暂无数据</ks-empty>
    </div>
    <div class="save-btn">
      <div class="paper-header-sumbit" @click="save">提交</div>
    </div>
  </div>
</template>

<script>
	import {AnalysisItem} from 'components/ks-components/analysis-item/analysis-item'
	import {PaperSubjective,SubmitGrade} from 'api/exam'
export default {
	components:{
		AnalysisItem
	},
	data() {
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

      /**
       * 解析列表
       */
      anliysisList: [],
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
	  this.routers.type = query.type
	  this.routers.name = query.name
  	this.query = query
	this.paper_title = this.query.title
	this.answerId=this.query.answerid
	var that = this
	uni.getSystemInfo({
	    success: function (res) {
			that.windowHeight = res.windowHeight    
	    }
	});
  },
  onShow() {
    this.anliysisList = [];
    var params = {
      answerid: this.answerId,
      paperid: this.query.paperid
    };
    uni.showLoading({
		icon:'loading'
	});
    PaperSubjective(params).then( (res)=> {
      if (res.result) {
        var _anliysisList = [];
        res.data.map(item=> {
          if (item.tktype == 6) {
            item.tkinfo.childtk.map( (child)=> {
              /**即时显示答题对错状态 */
              child.showAnswerStatus = true;
              /**禁止改变答案 */

              child.changeAnswer = false;
            });
          }
          /**即时显示答题对错状态 */


          item.showAnswerStatus = true;
          /**禁止改变答案 */

          item.changeAnswer = false;

          _anliysisList.push(item);
        });
        this.anliysisList = _anliysisList;
      } else {
        this.$msg(res.msg).then(()=> {
		  uni.navigateBack()
        });
      }

      this.loaded = true;

      uni.hideLoading();
    });
  },
  methods: {
    /**
     * 判断分值
     */
    JudgeScore(item) {
      if (Number(item.new_score) > Number(item.score)) {
        this.$msg('分值不能超过题目总分');
        item.new_score = item.score;
      }
    },

    /**
     * 保存评分
     */
    save() {
      

      var scorelist = [];
      this.anliysisList.map(item=> {
        var userscore = [];

        if (item.tktype == 6) {
          item.tkinfo.childtk.map( (citem, c)=> {
            if (citem.new_score) {
              citem.userscore = citem.new_score;
            }

            userscore.push({
              tkid: c,
              userscore: citem.userscore
            });
          });
        } else {
          if (item.new_score) {
            item.userscore = item.new_score;
          }

          userscore.push(item.userscore);
        }

        scorelist.push({
          tkid: item.tkid,
          userscore: userscore
        });
      });
      var data = {
        paperid: this.query.paperid,
        answerid: this.answerId,
        scorelist: scorelist
      };
      uni.showLoading({title:"正在提交"});
      SubmitGrade(data).then( (res)=> {
        uni.hideLoading();

        if (res.result) {
          this.$msg("提交成功", "success").then(()=> {
			  console.log(999)
			  uni.navigateTo({
			  	url:`/pages/exam/result?categoryid=${this.query.categoryid}&id=${this.answerId}&type=${this.query.type}&paperid=${this.query.paperid}&title=${this.paper_title}`
			  })
           
          });
        } else {
          this.$msg(res.msg);
        }
      });
    }

  }
};
</script>
<style scoped>
.van-icon-arrow-left {
  color: #4d4c4c !important;
}
.analysis-contianer {
  /* background: #fff; */
  padding-bottom: 2.5rem;
  box-sizing: border-box;
}
.analysis-contianer-inner{
  padding: 0 15px;
  background: #fff;
}
.score-input{
  font-size: 14px;
  margin-bottom: 20px;
}
.score-input .score-box{
  border: 1px solid #ddd;
  display: inline-block;
  width: 70px;
  border-radius: 5px;
  overflow: hidden;
  vertical-align: middle;
  margin-left: 10px;
  padding: 10px 16px;
  height: 24px;
}
.paper-header-sumbit {
  float: right;
  padding: 0 20px;
  background: #2987EE;
  color: #fff;
  height: 26px;
  line-height: 26px;
  font-size: 12px;
  border-radius: 2px;
  position: relative;
  z-index: 100;
  margin-top: 7px;
}
.save-btn{
  background: #fff;
  height: 40px;
  position:fixed;
  width: 100%;
  bottom: 0;
  max-width: 480px;
  padding: 7px 10px;
  box-sizing: border-box;
  z-index: 10;
}
.save-btn .paper-header-sumbit{
  margin-top: 0;
}
</style>