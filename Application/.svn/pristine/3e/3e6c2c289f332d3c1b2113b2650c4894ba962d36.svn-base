<template>
  <div>
    <ks-tabs v-model="tabActive" @tab-click="handleClick">
      <ks-tab-pane label="全部" name="3"></ks-tab-pane>
      <ks-tab-pane label="已回复" name="1"></ks-tab-pane>
      <ks-tab-pane label="未回复" name="2"></ks-tab-pane>
    </ks-tabs>
    <div :style="{minHeight:minHeight+'px',background:'#fff',marginTop: '10px'}">
      <ks-page-scroll-container
        v-if="list.length"
        :page="p"
        :page-count="pageCount"
        @page-change="getList"
      >
        <div class="mentoring" v-for="(item,i) in list" :key="i">
          <div class="mentoring-name">
            {{item.inputer}}
            <span class="ks-fr mentoring-noreply" v-if="item.is_reply === '0'">未回复</span>
            <span class="ks-fr mentoring-reply" v-if="item.is_reply === '1'">已回复</span>
          </div>
          <p class="mentoring-time">{{item.adddate}}</p>
          <ks-image class="mentoring-head" :src="item.head" />
          <p class="mentoring-content">{{item.title}}</p>
          <media-preview :type="item.$type" :info="item.$info" />
          <div class="mentoring-tool">
            <span class="mentoring-tool__lock">
              <img src="@/m/assets/mentoring/me_icon_lock.png" v-if="item.is_show === '0' "/>
            </span>
            <ks-button size="small" @click="delask(i,item.id)">删除</ks-button>
            <ks-button size="small" type="primary" @click="open(item.id)" v-if="item.is_reply === '1'">查看回复</ks-button>
            <!-- <ks-button size="small" type="plain" @click="put(item.id)" v-if="item.is_reply === '0'">编辑</ks-button> -->
          </div>
        </div>
      </ks-page-scroll-container>
      <ks-empty
            type="nolesson"
            :msg="'去多问问题吧！'"
            v-else-if="loaded"
        />
    </div>
  </div>
</template>
<script>
import { myAsk,delAsk } from "@/api/teacher.answer.js";
import MediaPreview from '../../components/media-preview';
export default {
  components:{
    MediaPreview
  },
  data() {
    return {
      loaded: false,
      minHeight: window.innerHeight,
      pageCount: null,
      p: 1,
      list:{
        json:{
          type:0,
          info:[]
        }
      },
      tabActive:"3"
    };
  },
  computed: {
   
  },
  methods: {
    //查看跳转
    open(id) {
      this.$router.push('/mentoringreply?id='+id)
    },
    //编辑
    put(id) {
      this.$router.push('/mentoringquiz?id='+id)
    },
    handleClick(name) {
      this.getList();
    },
    getList(p = 1) {
      this.$showLoading();
      this.p = p;
      if (p == 1) {
        this.list = [];
      }
      let params = {
        p: p,
        maxperpage: 10,
        is_reply: this.tabActive
      };

      myAsk(params).then(res => {
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
        this.loaded = true;
        this.$hideLoading();
      });
    },
    /**
     * 删除订单
     */
    delask(index,id) {
      this.$confirm("确定要删除该提问吗？").then(() => {
        let params = {
          id: id,
          type: 1
        };
        delAsk(params).then(res => {
          this.$toast(res.msg, "success").then(() => {
           this.list.splice(index,1);
          });
        });
      });
    },

  },
  activated() {
    document.title = "我的提问";
    this.getList();
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
/*默认样式*/
.mentoring {
  padding: 20px 20px 10px 60px;
  position: relative;
  clear: both;
  overflow: hidden;
}
.mentoring-name {
  font-size: 14px;
}
.mentoring-reply {
  color: #999;
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
.mentoring-content {
  font-size: 14px;
  text-align: justify;
  padding: 8px 0;
}
.mentoring-tool {
  font-size: 14px;
  margin-top: 10px;
}
.mentoring-tool__lock img {
  width: 20px;
  margin-top: 7px;
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
.mentoring-tool__delete {
  padding: 5px;
  border: 1px solid #e64a3b;
  color: #e64a3b;
}
.mentoring-tool i {
  padding-right: 5px;
}
.mentoring-noreply {
  color: #e64a3b;
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
.mentoring-bottom {
  text-align: center;
  margin: 0 auto;
  width: 30%;
}
.mentoring-bottom .ks-button {
  border-radius: 50px;
}
.ks-button {
  float: right;
  margin-left: 10px;
}
</style>
