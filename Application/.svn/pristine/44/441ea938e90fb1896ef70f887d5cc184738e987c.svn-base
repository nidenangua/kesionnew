<template>
  <!-- 查看回复 -->
  <div :style="{minHeight:minHeight+'px',background:'#fff'}" v-if="loaded">
    <!-- 发布者信息部分 -->
    <div class="mentoring">
      <div class="mentoring-name">{{social.inputer}}</div>
      <p class="mentoring-time">{{social.adddate}}</p>
      <ks-image class="mentoring-head" :src="social.head" />
      <p class="mentoring-content">{{social.title}}</p>
      <p class="mentoring-content mentoring-details">{{social.json.content}}</p>
      <media-preview :type="social.json.$type" :info="social.json.$info" />
      <div class="mentoring-tool" >
        <span class="mentoring-tool__delete">{{social.reply_num}}人围观</span>
        <span v-if="usertype === '2' || is_me =='1' || usertype === '1'"   @click="delask(type,$route.query.id)" class="mentoring-tool__like">
          <img src="@/m/assets/mentoring/common_btn_delet.png" />
        </span>
      </div>
      <div>
        <span class="ks-word ks-fl">是否前台展示</span>
        <ks-switch v-model="social.is_show" class="ks-fl"></ks-switch>
      </div>
      <div class="ks-word--lightgray ks-pt10">选择关闭，则该问题仅自己和老师可见</div>
    </div>
    <div class="gridClass"></div>
    <div class="mentoring-box">
      <div>
        <ks-switch v-model="social.status" class="ks-fl"></ks-switch>
        <span class="ks-word ks-fl">审核状态</span>
      </div>
      <div class="ks-textarea ks-pt10 upboth">
        <textarea
          autocomplete="off"
          v-model="social.content"
          placeholder="请输入回复内容"
          class="ks-textarea__inner"
          style="height: 160px;"
        ></textarea>
      </div>
         <media-upload @change="onMediaUploadChange" />
      <div>
        <span class="ks-word ks-fl">回答是否公开</span>
        <ks-switch v-model="social.is_open" class="ks-fl"></ks-switch>
      </div>
      <div class="ks-word--lightgray ks-pt10">若不公开，则学生需要成为付费会员才能查看回答</div>
      <ks-button class="ks-mt30" type="primary" width="100%" @click="publishh()">发表</ks-button>
    </div>
  </div>
</template>
<script>
import { showAnswer,replyTeacher,delAsk } from "@/api/teacher.answer.js";
import MediaUpload from '../../components/media-upload';
import MediaPreview from '../../components/media-preview';
export default {
    components:{
        MediaUpload,
        MediaPreview
    },
    data(){
        return {
            loaded:false,
            usertype:0,
            is_me:"",
            minHeight:window.innerHeight,
            social:{
                adddate:'',//发表时间
                head:'',//头像
                inputer:'',//名字
                reply_num:'',//围观人数
                is_open:'true',//公开
                title:'',//提问标题
                status:'true',//是否审核
                is_show:'true',//是否展示
                json:{
                    content:'',//提问内容
                    info:[] //图片
                },
                id:'',//答疑id
                type:'',//类型（0：其它 1:图片；2：视频；3：音频）
                content:'',	//内容
                info:[],//存放视频或图片或音频地址的
            },
        }
    },

    activated() {
         let id = this.$route.query.id;
         showAnswer({id}).then(res => {
             this.is_me = res.is_me
             this.resetJson(res.social_data.json)
             this.usertype = res.usertype;
             this.social = res.social_data;
             this.social.is_open = res.social_data.is_open;
             this.social.status = res.social_data.status;
             this.social.is_show = res.social_data.is_show;
             this.loaded = true;
         });
    },
    deactivated(){
        this.loaded = false
    },
    methods:{
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
                //跳转
                this.$router.push({path:'/MentoringAudit'})
            });
        });
        },
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
        },
        /**
         * 提交介绍表单
         */
        onMediaUploadChange(info){
            this.social.info = info.info;
            if(info.type == "image"){
                 this.social.type = "1"
            }else if(info.type == "video"){
                 this.social.type = "2"
            }else if(info.type == "audio"){
                 this.social.type = "3"
            }else{
                this.social.type = "0"
            }
        },
        publishh() {
            let params = {
                id: this.social.id,
                type: this.social.type,
                info: this.social.info,
                content:this.social.content,
                is_open:this.social.is_open,
                status:this.social.status,
                is_show:this.social.is_show,
            };
            replyTeacher(params).then(res => {
                if (res.result === "success") {
                this.$toast("回复成功", "success");
                this.$router.push({path:'/Mentoringaudit'})
                }
            });
        }
    }
}
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
  padding-top: 8px;
  padding-right: 5px;
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
.mentoring-img {
  margin: 5px 0;
}
.mentoring-img img {
  width: 32%;
  height: 32%;
  margin-right: 1%;
}
.mentoring-box {
  padding: 10px 20px;
}
.mentoring-box__add img {
  width: 100px;
}
/* 开关样式 */
.ks-word {
  color: #888;
  font-size: 14px;
  line-height: 20px;
}
.ks-word--lightgray {
  color: #bdbdbd;
  font-size: 14px;
  clear: both;
}
.ks-textarea__inner {
  display: block;
  resize: vertical;
  padding: 5px 15px;
  line-height: 1.5;
  box-sizing: border-box;
  width: 100%;
  font-size: inherit;
  color: #606266;
  background-color: #fff;
  background-image: none;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
}
.ks-textarea__inner:focus {
  outline: none;
  border-color: #409eff;
}
.ks-textarea {
  position: relative;
  display: inline-block;
  width: 100%;
  vertical-align: bottom;
  font-size: 14px;
}
.upboth{
  clear: both;
  overflow: hidden;
  padding: 8px 0;
  height: 160px;
  margin-top: 10px;
}
</style>