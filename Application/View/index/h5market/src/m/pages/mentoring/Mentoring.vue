<template>
  <!-- 答疑中心 -->
  <div class="page">
    <!-- 发布者信息部分 -->
    <img src="@/m/assets/mentoring/question_banner.png" @click="jumpvip()" v-if="is_buy === 0 && usertype === '0'"/>
    <ks-page-scroll-container
      v-if="list.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getList"
    >
      <div class="mentoring" v-for="(item,i) in list" :key="i">
        <div class="mentoring-name">{{item.inputer}}</div>
        <p class="mentoring-time">{{item.adddate}}</p>
        <ks-image class="mentoring-head" :src="item.head" />
        <p class="mentoring-content">{{item.title}}</p>
        <media-preview :type="item.$type" :info="item.$info" />
        <div class="mentoring-tool">
          <span class="mentoring-tool__delete">{{item.reply_num}}人围观</span>
          <span class="mentoring-tool__like">
            <img v-if="usertype === '2' || item.is_me ==='1' || usertype === '1'"   @click="delask(i,item.id)" src="@/m/assets/mentoring/common_btn_delet.png" />
            <a class="mentoring-tool__circusee" v-if="item.is_open == 1" @click="open(item.id)">免费围观</a>
            <a class="mentoring-tool__circusee" v-if="item.is_open == 0" @click="open(item.id,is_buy,is_free)">立即围观</a>
          </span>
        </div>
      </div>
      <div class="gridClass"></div>
    </ks-page-scroll-container>
    <ks-empty
            type="nolesson"
            :msg="'还没有人提问，赶紧提问吧！'"
            v-else-if="loaded"
        />
    <!-- 发布入口 -->
    <div class="issue" @click="put" v-if="usertype === '0' || usertype === -1"></div>
    <store-footer/>
     
    
  </div>
</template>
<script>
import { answerCenter,delAsk } from "@/api/teacher.answer.js";
import MediaPreview from '../../components/media-preview';
export default {
  name:'',
  components:{
    MediaPreview
  },
  data() {
    return {
      loaded: false,
      pageCount: null,
      p: 1,
      is_buy:"0",
      is_free:'',
      usertype:0,
      list:{
        json:{
          type:0,
          info:[]
        }
      }
    };
  },
  computed: {
    
  },
  methods: {
    /**
     * 删除问答
     */
    delask(index,id) {
      this.$confirm("确定要删除该提问吗？").then(() => {
        let params = {
          id: id,
          type: 1
        };
        delAsk(params).then(res => {
          this.list.splice(index,1);
        });
      });
    },
    open(id,isbuy,is_free) {
      if(isbuy == 0 && this.usertype == 0 && is_free == 1){
         this.$confirm("您还不是答疑会员，该问题需要答疑会员才能查看到老师回答~").then(() =>{
            this.$router.push('/user/mycard')
         })
      }else{
        this.$router.push('/mentoringreply?id='+id)
      }
    },
    put(){
      this.$router.push('/MentoringQuiz')
    },
    /**
     * 开通答疑会员
     */
    jumpvip(){
      this.$router.push('/user/mycard')
    },
    /**
     * 获取数据列表
     */
    getList(p = 1) {
      this.$showLoading();
      this.p = p;
      if (p == 1) {
        this.list = [];
      }
      let params = {
        p: p,
        maxperpage: 10
      };
      answerCenter(params).then(res => {
        this.is_free = res.is_free;
        res.list.map(item=>{
          item.$info = {};
          item.$type = '';
          if(item.json && item.json.info){
            if(typeof item.json.info === 'string'){
              item.json.info = []
            }
            item.$type = (item.json.type == 1 && 'image') || (item.json.type == 2 && 'video') || (item.json.type == 3 && 'audio') || ''
            switch(Number(item.json.type)){
              case 1:
                let _info = [];
                item.json.info.map(src=>{
                  _info.push({
                    src:src
                  })
                })
                item.$info = {
                  list:_info
                }
                break
              case 2:
              case 3:
                item.$info = {
                  src:item.json.info[0] || ''
                }
                break
            }
          }
        });
        this.list = p == 1 ? res.list : this.list.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.is_buy = res.is_buy;
        this.usertype = res.usertype;
        this.loaded = true;
        this.$hideLoading();
      });
    }
  },
  activated() {
    this.getList();
    document.title = "答疑中心";
  },
};
</script>
<style scoped>
.mentoring {
  padding: 20px 20px 10px 60px;
  position: relative;
  clear: both;
}
.mentoring-name {
  font-size: 14px;
}
.mentoring-head {
  border-radius: 50%;
  width: 35px;
  height: 35px;
  position: absolute !important;
  top: 22px;
  left: 15px;
}
.mentoring-time {
  font-size: 12px;
  padding-top: 5px;
  color: #999;
}
.mentoring-content {
  font-size: 14px;
  text-align: justify;
  padding-top: 8px;
  padding-bottom: 8px;
  line-height: 22px;
}
.mentoring-tool {
  font-size: 14px;
  margin-top: 10px;
  clear: both;
}
.mentoring-tool__delete {
  color: #999;
}
.mentoring-tool__like {
  float: right;

}
.mentoring-tool__like img {
  width: 26px;
  float: left;
  margin-top: -2px;
  margin-right: 10px;
}
.mentoring-tool__comment {
  float: right;
  margin-left: 14px;
}
.mentoring-tool__circusee {
  padding: 5px;
  border: 1px solid #e64a3b;
  color: #e64a3b;
}
.mentoring-tool i {
  padding-right: 5px;
}
.critic-tool {
  font-size: 14px;
  margin-top: 6px;
}
.critic {
  color: #4c8bf8;
}
.critic-tool__delete {
  float: right;
  color: #999;
}
.gridClass {
  position: relative;
  width: 90%;
  margin: 0 auto;
}
.gridClass:after {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 1px;
  border-top: 1px solid #e9e9e9 !important;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.bubble {
  background-color: #999;
  color: #fff;
  font-size: 14px;
  line-height: 32px;
  border-radius: 20px;
  text-align: center;
  padding: 0 10px;
  display: table;
  margin: 0 auto;
}
.more {
  padding: 15px;
}
.more .more-reply {
  background-color: #fff;
  color: #666;
  font-size: 12px;
  line-height: 25px;
  border-radius: 5px;
  text-align: center;
  padding: 0 20px;
  display: table;
  margin: 0 auto;
}
.issue {
  position: fixed;
  bottom: 69px;
  right: 20px;
  border-radius: 50%;
  width: 44px;
  height: 44px;
  background-color: var(--primary-color);
}
.issue:before,
.issue:after {
  content: "";
  position: absolute;
  background: #fff;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.issue:before {
  width: 2px;
  height: 20px;
}
.issue:after {
  width: 20px;
  height: 2px;
}
</style>