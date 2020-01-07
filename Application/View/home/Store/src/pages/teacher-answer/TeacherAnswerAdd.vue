<template>
  <ks-container v-if="is_show">
    <ks-title name="答疑中心/查看问题" style="margin-bottom: 20px;" />
    <el-form ref="form" :model="form" label-width="80px">
      <el-row>
        <el-col :span="1">
          <el-avatar :size="40" :src="head"></el-avatar>
        </el-col>
        <el-col :span="9">
          <el-row>{{social_data.inputer}}</el-row>
          <el-row>{{social_data.adddate}}</el-row>
        </el-col>
      </el-row>
      <el-row>
        <el-col :span="1">&nbsp;</el-col>
        <el-col :span="9" class="title">{{social_data.title}}</el-col>
      </el-row>
      <el-row>
        <el-col :span="1">&nbsp;</el-col>
        <el-col :span="9" class="content title">{{social_data.json.content}}</el-col>
      </el-row>
      <el-row class="info_img">
        <el-col :span="1">&nbsp;</el-col>
        <el-col :span="9">
          <div>
            <media-preview :type="social_data.json.$type" :info="social_data.json.$info"/>
          </div>
        </el-col>
      </el-row>
      <div class="circuse">
        <el-switch
            v-model="social_data.is_show"
            active-color="#13ce66"
            inactive-text="是否前台展示">
        </el-switch>
        <span class="font">选择关闭，该问题仅老师和提问人可见</span>
        <span class="circusee">{{social_data.reply_num}}人围观</span>
      </div>
      <el-row class="del">
        <el-col :span="1">&nbsp;</el-col>
        <el-col :span="9">
          <span @click="delAsk(answerid)">
            <a class="font-a">删除问题</a>
          </span>
        </el-col>
      </el-row>
      <el-row class="del-line"></el-row>
      <el-row class="status">
        <el-col :span="1">&nbsp;</el-col>
        <el-col style="width: 4%">审核状态</el-col>
        <el-col :span="1">
          <el-switch
            v-model="social_data.status"
            active-color="#13ce66"
          ></el-switch>
        </el-col>
      </el-row>
      <el-row>
        <el-col :span="1">&nbsp;</el-col>
        <el-col :span="9">
          <el-input type="textarea" v-model="addAnswer.content" placeholder="请输入回复内容"  resize="none" maxlength="144"></el-input>
        </el-col>
      </el-row>

      <el-row class="upload">
        <el-col :span="1">&nbsp;</el-col>
        <el-col :span="9">
          <media-upload @change="onMediaUploadChange" />
        </el-col>
      </el-row>
      <el-row class="open">
        <el-col :span="1">&nbsp;</el-col>
        <el-col style="width: 5.3%">回答是否公开</el-col>
        <el-col :span="1">
          <el-switch
            v-model="social_data.is_open"
            active-color="#13ce66"
          ></el-switch>
        </el-col>
        <el-col :span="6" class="font">
          若不公开，则学员需要成为付费会员才可以查看
          <a class="font-a" @click="open()">设置付费会员</a>
        </el-col>
      </el-row>
      <div class="add-answer-footer">
        <el-button type="primary" size="small" @click="confirmAnswer">确认回复</el-button>
      </div>
    </el-form>
  </ks-container>
</template>

<script>
import { showAnswer, delAsk, replyTeacher } from "@/api/teacher.answer";
import MediaUpload from '@/components/media-upload';
import mediaPreview from '@/components/media-preview';
export default {
    components:{
        MediaUpload,
        mediaPreview
    },
  name: "answer",
  data() {
    return {
      loading: false,
      answerid: null,
      head: "",
      type: "",
      items: "",
      social_data: {
        json:{}
      },
      form:{
        name:"",
      },
      addAnswer: {
        is_show: '',
        status: '',
        is_open: false,
        content: "",
        info:[]
      },
      is_show:false
    };
  },
  watch: {
    $route(to, from) {
      this.$router.go(0);
    }
  },
  computed: {
    
  },
  activated() {
    let id = this.$route.query.id;
    showAnswer({ id }).then(res => {
      this.resetJson(res.social_data.json);
      this.social_data = res.social_data;
      this.head = res.social_data.head;
      this.answerid = res.social_data.id;
      this.social_data.is_show = res.social_data.is_show;
      this.social_data.status = res.social_data.status;
      this.social_data.is_open = res.social_data.is_open;
    });
    this.is_show = true
  },
  deactivated(){
    this.is_show = false
  },
  methods: {
     /**判断 */
    resetJson(json = {}) {
      json.$info = {};
      switch (Number(json.type)) {
        case 1:
          json.$type = "image";
          let _list = [];
          if (json.info instanceof Array) {
            json.info.map(src => {
              _list.push({
                src: src
              });
            });
          }
          // 给list加json.$info节点
          json.$info = {
            list: _list
          };
          break;
        case 2:
          json.$type = "video";
          json.$info = {
            src: json.info[0] || ""
          };
          break;
        case 3:
          json.$type = "audio";
          json.$info = {
            src: json.info[0] || ""
          };
          break;
      }
    },
     onMediaUploadChange(data){
      if(data.type == "image"){
        this.type = "1"  
      }if(data.type == "video"){
        this.type = "2"  
      }if(data.type == "audio"){
        this.type = "3"  
      }
      this.addAnswer.info = data.info;
    },
    upload() {
      this.$uploadImage(res => {
      });
    },
    delAsk(id) {
          this.$confirm("确认删除吗？该操作不可逆", {
            confirmButtonText: "确定",
            cancelButtonText: "取消",
            type: "warning"
          }).then(() => {
             delAsk({ id: id, type: 1 }).then(res => {
        if ((res.result = "success")) {
          this.$router.push({path:'/?url=home.html/answer/Index/Index'})
        }
      });   
    })
  },
    /**保存返回 */
    confirmAnswer() {
      let params = {
        id: this.answerid,
        type:this.type,
        info:this.addAnswer.info,
        content: this.addAnswer.content,
        status: this.social_data.status,
        is_open: this.social_data.is_open,
        is_show:this.social_data.is_show
      };
      replyTeacher(params).then(res => {
        this.$msg("回复成功！","success");
        this.$router.push({path:'/?url=home.html/answer/Index/Index'})
      });
    },
    /** 跳转*/
    open() {
    this.$router.push('/?url=home.html/users/Index/showgroup?appid-9')
    },
  }
};
</script>

<style scoped>
.info_img {
  margin-top: 8px;
  margin-bottom: 10px;
}

.info_img img {
  height: 100px;
  width: 100px;
  padding-right: 10px;
}

.title {
  font-size: 14px;
  color: #666;
}

.del {
  margin: 10px 0;
}
.del-line{
  border-bottom: 1px solid #eee;
}

.status {
  margin: 10px 0px 25px;
}

.open {
  margin: 15px 0px 20px;
}

.add-answer-footer {
  margin-left: 67px;
}

.font {
  font-size: 14px;
  color: #ababab;
}

.circuse{
  margin-left: 4%;
  width: 36.5%;
}

.circusee{
  font-size: 12px;
  color: #444;
  float: right;
}

.upload{
  margin-top: 11px;
}
.font-a{
  color: #488bff;
  cursor:pointer;
}
</style>