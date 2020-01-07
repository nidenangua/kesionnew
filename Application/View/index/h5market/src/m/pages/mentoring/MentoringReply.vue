<template>
  <!-- 查看回复 -->
  <div :style="{minHeight:minHeight+'px',background:'#fff'}">
    <!-- 发布者信息部分 -->
    <div class="mentoring">
      <div class="mentoring-name">{{social_data.inputer}}</div>
      <p class="mentoring-time">{{social_data.adddate}}</p>
      <ks-image class="mentoring-head" :src="social_data.head" />
      <p class="mentoring-content">{{social_data.title}}</p>
      <p class="mentoring-content mentoring-details">{{social_data.json.content}}</p>
      <media-preview :type="social_data.json.$type" :info="social_data.json.$info" />
      <div class="mentoring-tool">
        <span class="mentoring-tool__delete">{{social_data.reply_num}}人围观</span>
        <span class="mentoring-tool__like">
        <img  v-if="usertype == '2' || usertype =='1' || is_me =='1'" src="@/m/assets/mentoring/common_btn_delet.png" @click="delask(1,social_data.id)" />
          <!-- <a class="mentoring-tool__circusee">免费围观</a> -->
        </span>
      </div>
    </div>
    <div class="gridClass"></div>
   <!-- 教师回答部分 -->
    <div class="mentoring" v-for="(item,i) in reply_data" :key="i">
      <ks-image class="mentoring-head" :src="item.head" />
      <div class="mentoring-name">{{item.inputer}}</div>
      <p class="mentoring-time">
        {{item.adddate}}回答
        <img v-if="usertype === '2' || item.is_me ==='1' || usertype === '1'" src="@/m/assets/mentoring/common_btn_delet.png" @click="delask(2,item.id)"/>
      </p>
      <div class="mentoring-content mentoring-details">{{item.json.content}}</div>
      <media-preview :type="item.json.$type" :info="item.json.$info" />
    </div>
  </div>
</template>
<script>
import { showAnswer,delAsk } from "@/api/teacher.answer.js";
import MediaPreview from '../../components/media-preview';
export default {
  name:'MentoringReply',
  components:{
    MediaPreview
  },
  data() {
    return {
      minHeight: window.innerHeight,
      usertype:"",
      is_me:"",
      social_data:{
        json:{}
      },
      reply_data:[]
    };
  },
  computed: {
    
  },
  activated(){
      let id = this.$route.query.id;  
      document.title = "查看回答";
      showAnswer({id}).then(res => {
          this.usertype = res.usertype,
          this.is_me = res.is_me
          if(res.social_data.json){
            this.resetJson(res.social_data.json)
          }
          this.social_data = res.social_data;
         res.reply_data.map(item=>{
           if(item.json){
             this.resetJson(item.json)
           }
         })
        this.reply_data = res.reply_data;
      });
  },
  methods:{
    /**
     * 删除问答
     */
    delask(type,id) {
      this.$confirm("确定要删除该提问吗？").then(() => {
        let params = {
          id: id,
          type: type
        };
        delAsk(params).then(res => {
          //跳转
          if (this.usertype == 0) {
            this.$router.push({path:'/mentoringcollect'})
          }else{
            this.$router.push({path:'/Mentoring'})
          }
        });
      });
    },
    //处理
    resetJson(json = {}){
      json.$info = {};
      switch(Number(json.type)){
        case 1:
          json.$type = 'image';
          let _list = [];
          if(json.info instanceof Array){
            json.info.map(src=>{
              _list.push({
                src:src
              })
            })
          }
          // 给list加json.$info节点
          json.$info = {
            list:_list
          }
          break
        case 2:
          json.$type = 'video';
          json.$info = {
            src:json.info[0] || ''
          }
          break
        case 3:
          json.$type = 'audio';
          json.$info = {
            src:json.info[0] || ''
          }
          break
      }
    }
  }
};
</script>
<style scoped>
.mentoring {
  padding: 20px 20px 10px 60px;
  position: relative;
}
.mentoring-name {
  font-size: 14px;
}
.mentoring-head {
  border-radius: 50%;
  width: 35px;
  height: 35px;
  position: absolute;
  top: 22px;
  left: 15px;
}
.mentoring-time {
  font-size: 12px;
  padding-top: 5px;
  color: #999;
}
.mentoring-time img {
  width: 26px;
  float: right;
  margin-top: -6px;
}
.mentoring-content {
  font-size: 14px;
  text-align: justify;
  padding: 8px 0;
}
.mentoring-details {
  color: #666;
}
.mentoring-tool {
  font-size: 14px;
  margin-top: 15px;
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
  margin-top: -4px;
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
  border: 1px solid #e5e5e5;
}
</style>