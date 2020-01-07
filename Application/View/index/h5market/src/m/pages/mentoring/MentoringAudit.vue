<template>
  <div>
    <div class="filter">
      <div class="filter-header ks-row ks-line">
        <div class="ks-col-8"
         @click="filterType = filterType === 'status' ? '' : 'status'"
          :class="filterType === 'status' && 'active'"
        >
          {{($route.query.status == '' && '查看全部') || ($route.query.status == 1 && '已审核') || ( $route.query.status == 2 && '未审核')  || '审核状态'}}
          <i class="ks-icon ks-icon-chevron-down"></i>
        </div>
        <div class="ks-col-8"
         @click="filterType = filterType === 'is_reply' ? '' : 'is_reply'"
          :class="filterType === 'is_reply' && 'active'"
        >
          {{($route.query.is_reply == '' && '查看全部') || ($route.query.is_reply == 1 && '已回复') || ( $route.query.is_reply == 2 && '未回复') || '回复状态'}}
          <i class="ks-icon ks-icon-chevron-down"></i>
        </div>
        <div class="ks-col-8"
         @click="filterType = filterType === 'is_open' ? '' : 'is_open'"
          :class="filterType === 'is_open' && 'active'"
        >
          {{($route.query.is_open == '' && '查看全部') || ($route.query.is_open == 1 && '已公开') || ( $route.query.is_open == 2 && '未公开') || '公开状态'}}
          <i class="ks-icon ks-icon-chevron-down"></i>
        </div>
      </div>
      <transition>
        <div class="filter-box" v-if="filterType === 'status'">
          <div class="filter-classify__item" @click="filter({'status':'-1'})">查看全部</div>
          <div class="filter-classify__item" @click="filter({'status':'1'})">已审核</div>
          <div class="filter-classify__item" @click="filter({'status':'2'})">未审核</div>
        </div>
        <div class="filter-box" v-else-if="filterType === 'is_reply'">
          <div class="filter-classify__item" @click="filter({'is_reply':'-1'})">查看全部</div>
          <div class="filter-classify__item" @click="filter({'is_reply':'1'})">已回复</div>
          <div class="filter-classify__item" @click="filter({'is_reply':'2'})">未回复</div>
        </div>
        <div class="filter-box" v-else-if="filterType === 'is_open'">
          <div class="filter-classify__item" @click="filter({'is_open':'-1'})">查看全部</div>
          <div class="filter-classify__item" @click="filter({'is_open':'1'})">已公开</div>
          <div class="filter-classify__item" @click="filter({'is_open':'2'})">未公开</div>
        </div>
      </transition>
    </div>
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
              <img src="@/m/assets/mentoring/me_icon_lock.png" v-if="item.is_open === '0' "/>
              <!-- status = 1 审核通过，2 不通过 -->
              <img src="@/m/assets/mentoring/me_icon_question_o.png" v-if="item.status == 1"/>
              <img src="@/m/assets/mentoring/me_icon_question_n.png" v-if="item.status == 0"/>
            </span>
            <ks-button @click="delask(i,item.id)" size="small">删除</ks-button>
            <ks-button v-if="item.is_reply ==1" size="small" type="primary" @click="ropen(item.id)">查看回复</ks-button>
            <ks-button v-if="item.is_reply ==0" size="small" type="primary" @click="open(item.id)">回复</ks-button>
          </div>
        </div>
        <transition name="fade">
          <div class="ks-masked" v-show="filterType !== ''" @click="filterType = ''"></div>
        </transition>
      </ks-page-scroll-container>
      <ks-empty msg="没有找到任何问题！" v-else />
    </div>
  </div>
</template>

<script>
import { askTeacherList,delAsk} from "@/api/teacher.answer.js";
import { cloneData, getTypeName } from "@/utils";
import MediaPreview from '../../components/media-preview';
let Categorys = [];
export default {
  name:'',
  components:{
    MediaPreview
  },
  data() {
    return {
      loaded: false,
      minHeight: window.innerHeight,
      pageCount: null,
      filterType: "",
      p: 1,
      list:[]
    };
  },
  computed: {
   
  },
  activated() {
    this.getList();
  },
  methods: {
    /**
     * 跳转
     */
    open(id) {
      this.$router.push('/mentoringseereply?id='+id)
    },
    ropen(id) {
      this.$router.push('/mentoringreply?id='+id)
    },
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
        maxperpage: 10,
        status:this.$route.query.status,
        is_reply:this.$route.query.is_reply,
        is_open:this.$route.query.is_open,
      };

      askTeacherList(params).then(res => {
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
    },
    /**
     * 筛选
     * @param {Object}
     */
    filter(data) {
      let query = cloneData(this.$route.query);
      let keys = Object.keys(data);
      keys.map(key => {
        query[key] = data[key];
      });
      this.$router.push({
        name: this.$route.name,
        query: query
      });
      this.filterType = "";
      this.getList()
    },
  }
};
</script>
<style scoped>
.search {
  background: #f5f5f5;
}
/*筛选栏*/
.filter,
.search {
  position: relative;
  z-index: 100;
}
.filter-header {
  height: 44px;
  line-height: 44px;
  background: #fff;
  text-align: center;
  font-size: 14px;
}
.filter-header .ks-icon {
  font-size: 14px;
}
.filter-header .active {
  color: #e64a3b;
}
.filter-box {
  position: absolute;
  background: #fff;
  top: 44px;
  left: 0;
  width: 100%;
  z-index: 9;
}
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
.filter-classify [class^="ks-col-"]:first-child {
  background: #f3f3f3;
}
.filter-classify [class^="ks-col-"]:nth-child(2) {
  background: #f9f9f9;
}
.filter-classify [class^="ks-col-"]:nth-child(3) {
  background: #fff;
}
.filter-classify__item {
  height: 44px;
  line-height: 44px;
  padding: 0 10px;
  font-size: 14px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

</style>
